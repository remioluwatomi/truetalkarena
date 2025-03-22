<?php

namespace App\Http\Controllers;

use App\Mail\UserNotification;
use App\Mail\Verification;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Chat;
use App\Models\Social;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    private $apiToken;
    private $hash;
    private $company_email;
    private $faker;
    public function __construct()
    {
        $this->apiToken = uniqid(base64_encode(Str::random(20)));
        $this->hash = uniqid(base64_encode(Str::random(25)));
        $info = new PageController();
        $this->company_email = $info->getInfos()['email'];
        $this->faker = Container::getInstance()->make(Generator::class);
    }

    public function login(Request $request)
    {

        $email = $request->email;
        $password = $request->password;
        $user = Admin::where('adm_email', '=', $email)->first();
        //User check
        if ($user) {
            // $user = Auth::guard('admin')->user();

            $stored_password = $user->adm_password;
            if (password_verify($password, $stored_password)) {
                if ($user->adm_status === 'deactivated') {
                    return response()->json([
                        'message' => 'Your account has been deactivated',
                        'type' => 'red',
                        'icon' => 'fa-bell',
                        'title' => 'Sorry'
                    ]);
                } elseif ($user->adm_status === 'active') {

                    return response()->json([
                        'message' => 'Welcome',
                        'type' => 'green',
                        'id' => $user->adm_id,
                        'email' => $user->adm_email,
                        'name' => $user->adm_name,
                        'token' => $this->apiToken,
                        'icon' => 'fa-bell',
                        'title' => 'Hello!'
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Your account is still inactive please verify your account from the mail sent to your email ' . $user->adm_email,
                        'type' => 'blue',
                        'icon' => 'fa-bell',
                        'title' => 'Sorry'
                    ]);
                }
            } else {

                return response()->json([
                    'message' => 'Invalid email or password',
                    'type' => 'orange',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Invalid email or password',
                'type' => 'red',
                'icon' => 'fa-bell',
                'title' => 'Sorry'
            ]);
        }
    }
    public function changePassword(Request $request, $id)
    {
        $postArray = $request->all();
        //User check
        $user = Admin::where('adm_id', '=', $id)->first();
        $password = $request->oldPassword;
        $stored_password = $user->adm_password;
        if (password_verify($password, $stored_password)) {

            $user = Admin::where('adm_id', '=', $id)
                ->update([
                    'adm_password' => bcrypt($postArray['password'])
                ]);

            if (!$user) {
                $responses = array(
                    'message' => 'Sorry! An error occured',
                    'type' => 'red',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry!'
                );
            } else {
                $responses = array(
                    'message' => 'Profile updated successfully.',
                    'type' => 'green',
                    'icon' => 'fa-check-circle',
                    'title' => 'Hello'
                );
            }
        } else {
            $responses = array(
                'message' => 'Incorrect password.',
                'type' => 'red',
                'icon' => 'fa-bell',
                'title' => 'Sorry'
            );
        }

        echo json_encode($responses);
    }

    public function ChangePasswordFromMail($hash)
    {
        $admin = Admin::where('remember_token', '=', $hash)->first();
        if ($admin) {
            return view('dashboard.changePassword', compact('admin'));
        } else {
            return Redirect::to('/admin/login');
        }
    }

    public function resetPassword(Request $request)
    {
        $postArray = $request->all();
        $count = Admin::where('adm_email', '=', $postArray['adm_email'])
            ->where('remember_token', '=', $postArray['hash'])->count();
        if ($count > 0) {
            $user = Admin::where('adm_email', '=', $postArray['adm_email'])
                ->where('remember_token', '=', $postArray['hash'])
                ->update([
                    'adm_password' => bcrypt($postArray['password'])
                ]);

            if (!$user) {
                $responses = array(
                    'message' => 'Sorry! An error occured',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                $responses = array(
                    'message' => 'Password updated successfully.',
                    'type' => 'green',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            }
        } else {
            $responses = array(
                'message' => 'Incorrect password.',
                'type' => 'red',
                'icon' => 'fa-check-circle',
                'title' => 'Thank you'
            );
        }

        echo json_encode($responses);
    }
    public function verify($hash)
    {
        // dd($hash);
        $count = Admin::where('remember_token', '=', $hash)->count();
        if ($count) {
            $user = Admin::where('remember_token', '=', $hash)->first();

            $userToken = Admin::where('remember_token', '=', $hash)->first();
            if ($userToken) {
                if ($user->adm_status === 'active') {
                    $responses = array(
                        'message' => 'Account has already been verified.',
                        'type' => 'blue',
                        'icon' => 'fa-check-circle',
                        'title' => 'Hello!'
                    );
                } elseif ($user->adm_status === 'deactivated') {
                    $responses = array(
                        'message' => 'Account has already been deactivated.',
                        'type' => 'red',
                        'icon' => 'fa-bell',
                        'title' => 'Sorry!'
                    );
                } else {
                    $userUpdate = Admin::where('remember_token', '=', $hash)->update([
                        'adm_status' => 'active'
                    ]);
                    if ($userUpdate) {
                        $responses = array(
                            'message' => 'Account has been verified successfully.',
                            'type' => 'green',
                            'icon' => 'fa-check-circle',
                            'title' => 'Congrats!'
                        );
                    } else {
                        $responses = array(
                            'message' => 'Sorry! An error occured',
                            'type' => 'red',
                            'icon' => 'fa-check-circle',
                            'title' => 'Sorry!'
                        );
                    }
                }
            } else {
                $responses = array(
                    'message' => 'Invalid token',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Sorry!'
                );
            }
        } else {
            $responses = array(
                'message' => 'Sorry! User not found',
                'type' => 'orange',
                'icon' => 'fa-check-circle',
                'title' => 'Sorry!'
            );
        }
        return view('verify', compact('responses'));
    }
    public function setSession($token)
    {
        $count = Admin::where('adm_id', '=', $token)->count();
        if ($count > 0) {
            $user = Admin::where('adm_id', '=', $token)
                ->first();
            Session::put('admin', $user);
            return redirect()->intended('/admin/dashboard');
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::has('admin')) {
            $admin = Session::get('admin');
            // dd($admin);
            $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
            if ($admin) {
                $total_amount = Transaction::where('tran_status', '=', 'successful')
                    ->whereYear('created_at', date('Y'))
                    ->sum('amount');
                $users = User::count();
                $admins = Admin::where('adm_level', '!=', 0)->count();
                // $transactions = new TransactionController();
                // $transactions = $transactions->getByAccount(1);
                $successful = Transaction::join('orders', 'orders.orderCode', '=', 'transactions.orderCode')
                    ->where('transactions.tran_status', '=', 'successful')
                    ->select(DB::raw("COUNT(*) as count"))
                    ->whereYear('transactions.created_at', date('Y'))
                    ->groupBy(DB::raw("Month(transactions.created_at)"))
                    ->pluck('count');
                $pending = Transaction::join('orders', 'orders.orderCode', '=', 'transactions.orderCode')
                    ->where('transactions.tran_status', '=', 'pending')
                    ->select(DB::raw("COUNT(*) as count"))
                    ->whereYear('transactions.created_at', date('Y'))
                    ->groupBy(DB::raw("Month(transactions.created_at)"))
                    ->pluck('count');

                return view('dashboard.index', compact('admin',  'pending', 'successful', 'admins', 'users', 'total_amount'));
            } else {
                return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function users()
    {
        if (Session::has('admin')) {
            $admin = Session::get('admin');
            // dd($admin);
            $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
            if ($admin) {
                $users = User::orderBy('id', 'DESC')->paginate(12);
                return view('dashboard.users', compact('admin', 'users'));
            } else {
                return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function profile()
    {
        if (Session::has('admin')) {
            $admin = Session::get('admin');
            // dd($admin);
            $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
            if ($admin) {
                return view('dashboard.profile', compact('admin'));
            } else {
                return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function admins()
    {
        if (Session::has('admin')) {
            $admin = Session::get('admin');
            // dd($admin);
            $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
            if ($admin) {
                $admins = Admin::where('adm_level', '!=', 0)->get();
                return view('dashboard.admins', compact('admin', 'admins'));
            } else {
                return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function gallery()
    {
        if (Session::has('admin')) {
            $admin = Session::get('admin');
            // dd($admin);
            $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
            if ($admin) {
                $gallery = new GalleryController();
                $gallery = $gallery->admIndex();



                return view('dashboard.gallery', compact('admin', 'gallery'));
            } else {
                return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function blog()
    {
        if (Session::has('admin')) {
            $admin = Session::get('admin');
            // dd($admin);
            $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
            if ($admin) {
                // $gallery = User::all();
                $blogs = Blog::orderBy('blog_id', 'DESC')
                    ->paginate(12);
                // $chats = Chat::hydrate($chats);

                return view('dashboard.blogs', compact('admin', 'blogs'));
            } else {
                return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function videos()
    {
        if (Session::has('admin')) {
            $admin = Session::get('admin');
            // dd($admin);
            $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
            if ($admin) {
                // $gallery = User::all();
                $videos = new VideoController();
                $videos = $videos->index();

                return view('dashboard.videos', compact('admin', 'videos'));
            } else {
                return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function adverts()
    {
        if (Session::has('admin')) {
            $admin = Session::get('admin');
            // dd($admin);
            $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
            if ($admin) {
                // $gallery = User::all();
                $adverts = new AdvertController();
                $adverts = $adverts->index();

                return view('dashboard.adverts', compact('admin', 'adverts'));
            } else {
                return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function books()
    {
        if (Session::has('admin')) {
            $admin = Session::get('admin');
            // dd($admin);
            $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
            if ($admin) {
                // $gallery = User::all();
                $books = new BookController();
                $books = $books->index();

                return view('dashboard.books', compact('admin', 'books'));
            } else {
                return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function settings()
    {
        if (Session::has('admin')) {
            $admin = Session::get('admin');
            // dd($admin);
            $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
            if ($admin) {
                $settings = new CompanyInfoController();
                $infos = $settings->index();
                $socials = Social::get();
                // dd($chats);
                return view('dashboard.settings', compact('admin', 'infos', 'socials'));
            } else {
                return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
        }
    }

    // public function notifications()
    // {
    //     if (Session::has('admin')) {
    //         $admin = Session::get('admin');
    //         // dd($admin);
    //         $admin = Admin::where('adm_id', '=', $admin->adm_id)->first();
    //         if ($admin) {
    //             // $account = Account::where('user_id', '=', $user->id)->get();
    //             $notifications = new ActivityController();
    //             $notifications = $notifications->index();
    //             // dd($transactions);
    //             return view('dashboard.notifications', compact('admin', 'notifications'));
    //         } else {
    //             return Redirect::to('/admin/logout')->withSuccess('Opps! You do not have access');
    //         }
    //     } else {
    //         return Redirect::to('/admin/login')->withSuccess('Opps! You do not have access');
    //     }
    // }

    public function logout()
    {
        Session::flush();
        return redirect('/admin/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function forgetPassword(Request $request)
    {
        $postArray = $request->all();
        $count = Admin::where('adm_email', '=', $postArray['email'])->count();
        if ($count > 0) {
            $user = Admin::where('adm_email', '=', $postArray['email'])
                ->first();
            $email = $postArray['email'];
            $name = $user->firstname;
            $postArray['remember_token'] = $this->hash;
            $userHash = $postArray['remember_token'];
            $update = Admin::where('adm_email', '=', $postArray['email'])
                ->update([
                    'remember_token' => $userHash
                ]);
            $base_url = url('');
            $details = array(
                "SITE_ADDR" => "$base_url",
                "EMAIL_LOGO" => "$base_url/assets/img/logo-icon.png",
                "EMAIL_TITLE" => "Reset Password!",
                "CUSTOM_URL" => "$base_url/admin/change-password/$userHash",
                "CUSTOM_IMG" => "$base_url/assets/img/mail/password.png",
                "TO_NAME" => $name,
                "VIEW" => 'password-reset',
                "REPLY_TO" => $this->company_email,
                "MESSAGE" => "You requested to change your password please the link below to change your password.",
                "TO_EMAIL" => $email
            );
            if (!$update) {
                $responses = array(
                    'message' => 'Sorry! An error occured',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                Mail::mailer('smtp')->to($email)->send(new UserNotification($details));
                $responses = array(
                    'message' => 'A message has been sent to your email address, please use the link to retrieve your account and change password.',
                    'type' => 'green',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            }
        } else {
            $responses = array(
                'message' => 'Email not found.',
                'type' => 'red',
                'icon' => 'fa-check-circle',
                'title' => 'Thank you'
            );
        }

        echo json_encode($responses);
    }
    public function getSocialByName($name)
    {
        $info = Social::where('soc_name', '=', $name)->first();
        return $info;
    }
    public function store(Request $request)
    {
        $postArray = $request->all();
        if (!isset($message)) {
            $count = Admin::where('adm_email', '=', $postArray['adm_email'])->count();
            // $count = $query->num_rows;
            if ($count != 0) {
                $message = "User Email is already in use.";
                $responses = array(
                    'message' => 'User Email is already in use.',
                    'type' => 'orange',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                );
            }
        }
        if (!isset($message)) {
            $count = Admin::where('adm_tel', '=', $postArray['adm_tel'])->count();
            // $count = $query->num_rows;
            if ($count != 0) {
                $message = "phone number is already in use.";
                $responses = array(
                    'message' => 'Phone number is already in use.',
                    'type' => 'orange',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                );
            }
        }
        if (!isset($message)) {
            $password = strtoupper(uniqid(Str::random(12)));
            $postArray['remember_token'] = $this->hash;
            $postArray['adm_password'] = bcrypt($password);
            $userHash = $postArray['remember_token'];
            $name = $postArray['adm_firstname'];
            $email = $postArray['adm_email'];
            $base_url = url('');
            $info = new PageController();
            $info = $info->getInfos();
            $details = array(
                "SITE_ADDR" => "$base_url",
                "EMAIL_LOGO" => "$base_url/assets/img/logo-icon.png",
                "EMAIL_TITLE" => "Verification Message!",
                "CUSTOM_URL" => "$base_url/Verify/$userHash",
                "CUSTOM_IMG" => "$base_url/assets/img/mail/Illustration-PNG.png",
                "TO_NAME" => $name,
                "REPLY_TO" => $this->company_email,
                "DATE" => date("l, F d, Y"),
                "MESSAGE" => "Welcome to D'Perennial Entertainment Limited, You were registered as part of our team. Please ignore if you were not informed of this",
                "TO_EMAIL" => $email,
                "PASSWORD" => $password,
                "USER_EMAIL" => $email,
                "USER_TYPE" => 'admin',
                "FB" => $this->getSocialByName('facebook'),
                "TW" => $this->getSocialByName('twitter'),
                "IG" => $this->getSocialByName('instagram')
            );
            Mail::mailer('smtp')->to($email)->send(new Verification($details));
            $admin = Admin::create($postArray);
            if (!$admin) {
                $responses = array(
                    'message' => 'An error occurred',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                $responses = array(
                    'message' => 'A message has been sent to your email address, please use the link to retrieve your account and change password.',
                    'type' => 'green',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            }
        }
        return json_encode($responses);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $postArray = $request->all();
        if (isset($postArray['changeDp'])) {

            $imageName = 'profile-' . time() . '.png';
            $path = './assets/img/team/' . $imageName;
            $postArray['image']->move(public_path('assets/img/team'), $imageName);
            $user = Admin::where('adm_id', '=', $id)
                ->update(['adm_dp' => $imageName]);
            if ($user) {
                $responses = array(
                    'message' => 'Profile updated successfully.',
                    'type' => 'green',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                $responses = array(
                    'message' => 'Sorry! An error occured',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Sorry'
                );
            }
        } elseif (isset($postArray['changeStatus'])) {
            $user = Admin::where('adm_id', '=', $id)
                ->update(['adm_status' => $postArray['status']]);
            if (!$user) {
                $responses = array(
                    'message' => 'Sorry! An error occured',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                $responses = array(
                    'message' => 'Profile updated successfully.',
                    'type' => 'green',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            }
        } else {
            $userCount = Admin::where('adm_email', '=', $postArray['adm_email'])
                ->where('adm_id', '!=', $id)->count();
            if ($userCount > 0) {
                $responses = array(
                    'message' => 'Sorry! Email already exists.',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                $user = Admin::where('adm_id', '=', $id)
                    ->update($postArray);

                if (!$user) {
                    $responses = array(
                        'message' => 'Sorry! An error occured',
                        'type' => 'red',
                        'icon' => 'fa-check-circle',
                        'title' => 'Thank you'
                    );
                } else {
                    $responses = array(
                        'message' => 'Profile updated successfully.',
                        'type' => 'green',
                        'icon' => 'fa-check-circle',
                        'title' => 'Thank you'
                    );
                }
            }
        }
        return json_encode($responses);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
