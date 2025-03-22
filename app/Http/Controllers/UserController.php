<?php

namespace App\Http\Controllers;

use App\Mail\Verification;
use App\Models\Booking;
use App\Models\Record;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        // $this->faker = Container::getInstance()->make(Generator::class);
    }

    public function setSession($token)
    {
        $count = User::where('remember_token', '=', $token)->count();
        if ($count > 0) {
            $user = User::where('remember_token', '=', $token)
                ->first();
            Session::put('user', $user);
            return redirect()->intended('account');
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }

    public function index()
    {
        // $finduser = User::where('id', '=', 1)->first();
        // Session::put('user', $finduser);
        if (Session::has('user')) {
            $user = Session::get('user');
            // dd($user);
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                $events = new EventController();
                $events = $events->index();
                return view('user.index', compact('user', 'events'));
            } else {
                return Redirect::to('/User/LogOut')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function events()
    {
        // $finduser = User::where('id', '=', 1)->first();
        // Session::put('user', $finduser);
        if (Session::has('user')) {
            $user = Session::get('user');
            // dd($user);
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                $events = new EventController();
                $events = $events->index();
                $socials = Social::where('soc_status', '=', 'active')->get();
                return view('user.events', compact('user', 'events'));
            } else {
                return Redirect::to('/User/LogOut')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function event($slug)
    {
        // $finduser = User::where('id', '=', 1)->first();
        // Session::put('user', $finduser);
        if (Session::has('user')) {
            $user = Session::get('user');
            // dd($user);
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                $event = new EventController();
                $event = $event->showBySlug($slug);
                $events = new EventController();
                $events = $events->index();
                $socials = Social::where('soc_status', '=', 'active')->get();
                $hasReg = new ContestantController();
                $hasReg = $hasReg->checkUser($event->event_id, $user->id);
                $contestants = new ContestantController();
                $contestants = $contestants->showByEvent($event->event_id);
                $info = new PageController();
                $info = $info->getInfos();
                return view('user.event', compact('user', 'events', 'contestants', 'event', 'hasReg', 'info', 'socials'));
            } else {
                return Redirect::to('/User/LogOut')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }

    public function profile()
    {
        if (Session::has('user')) {
            $user = Session::get('user');
            // dd($user);
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                return view('user.profile', compact('user'));
            } else {
                return Redirect::to('/User/LogOut')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }

    public function bookings()
    {
        // $finduser = User::where('id', '=', 1)->first();
        // Session::put('user', $finduser);
        if (Session::has('user')) {
            $user = Session::get('user');
            // dd($user);
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                $services = new ServiceController();
                $services = $services->index();
                $bookings = new EventController();
                $bookings = $bookings->index();
                $eventData = new EventController();
                $eventData = $eventData->getByArray();
                return view('user.bookings', compact('user', 'bookings', 'eventData', 'services'));
            } else {
                return Redirect::to('/User/LogOut')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function services()
    {
        if (Session::has('user')) {
            $user = Session::get('user');
            // dd($user);
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                $services = new ServiceController();
                $services = $services->index();
                // $chats = new ChatController();
                // $chats = $chats->index();
                // $chats = Chat::hydrate($chats);

                return view('user.services', compact('user', 'services'));
            } else {
                return Redirect::to('/User/LogOut')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function users()
    {
        if (Session::has('user')) {
            $user = Session::get('user');
            // dd($user);
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                $users = User::all();
                // $chats = new ChatController();
                // $chats = $chats->index();
                // $chats = Chat::hydrate($chats);

                return view('user.users', compact('user', 'users'));
            } else {
                return Redirect::to('/User/LogOut')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function gallery()
    {
        if (Session::has('user')) {
            $user = Session::get('user');
            // dd($user);
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                // $gallery = User::all();
                $gallery = new SlideController();
                $gallery = $gallery->index();
                // $chats = Chat::hydrate($chats);

                return view('user.gallery', compact('user', 'gallery'));
            } else {
                return Redirect::to('/User/LogOut')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function editservices($id)
    {
        if (Session::has('user')) {
            $user = Session::get('user');
            // dd($user);
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                $serv = new ServiceController();
                $serv = $serv->show($id);
                $info = new PageController();
                $info = $info->getInfos();

                return view('user.edit-service', compact('user', 'serv', 'info'));
            } else {
                return Redirect::to('/LogOut')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }
    public function settings()
    {
        if (Session::has('user')) {
            $user = Session::get('user');
            // dd($user);
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                $settings = new CompanyInfoController();
                $infos = $settings->index();
                $socials = Social::get();
                // dd($chats);
                return view('user.settings', compact('user', 'infos', 'socials'));
            } else {
                return Redirect::to('/LogOut')->withSuccess('Opps! You do not have access');
            }
        } else {
            return Redirect::to('/login')->withSuccess('Opps! You do not have access');
        }
    }

    public function notifications()
    {

        if (Session::has('user')) {
            $user = Session::get('user');
            $user = User::where('id', '=', $user->id)->first();
            if ($user) {
                // $account = Account::where('user_id', '=', $user->id)->get();
                $notifications = new ActivityController();
                $notifications = $notifications->show($user->id);
                // dd($transactions);
                return view('user.notifications', compact('user', 'notifications'));
            } else {
                return Redirect::to('/LogOut');
            }
        } else {
            return Redirect::to('login')->withSuccess('Opps! You do not have access');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
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
    public function resendVerification(Request $request)
    {
        $postArray = $request->all();
        if (!isset($message)) {
            $count = User::where('email', '=', $postArray['email'])->count();
            // $count = $query->num_rows;
            if ($count != 0) {
                $user = User::where('email', '=', $postArray['email'])->first();
                $userHash = $user->remember_token;
                $name = $user->othernames;
                $email = $user->email;
                $base_url = url('');
                $password = '*************************';
                $details = array(
                    "SITE_ADDR" => "$base_url",
                    "EMAIL_LOGO" => "$base_url/assets/img/logo-icon.png",
                    "EMAIL_TITLE" => "Verification Message!",
                    "CUSTOM_URL" => "$base_url/User/Verify/$userHash",
                    "CUSTOM_IMG" => "$base_url/assets/img/mail/Illustration-PNG.png",
                    "TO_NAME" => $name,
                    "REPLY_TO" => $this->company_email,
                    "DATE" => date("l, F d, Y"),
                    "MESSAGE" => "Welcome to D'Perennial Entertainment Limited, Thank you for choosing us.",
                    "TO_EMAIL" => $email,
                    "PASSWORD" => $password,
                    "USER_EMAIL" => $email,
                    "TYPE" => 'user',

                );

                Mail::mailer('smtp')->to($email)->send(new Verification($details));
                $responses = array(
                    'message' => 'Mail resent successfully.',
                    'type' => 'green',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                );
            } else {
                $responses = array(
                    'message' => 'User Email does not exist in our database.',
                    'type' => 'orange',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                );
            }
        }

        return json_encode($responses);
    }
    public function store(Request $request)
    {
        $postArray = $request->all();
        if (!isset($message)) {
            $count = User::where('email', '=', $postArray['email'])->count();
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
            $count = User::where('tel', '=', $postArray['tel'])->count();
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
            $postArray['password'] = strtoupper(uniqid(Str::random(12)));
            $postArray['remember_token'] = $this->hash;

            $userHash = $postArray['remember_token'];
            $name = $postArray['firstname'];
            $email = $postArray['email'];
            $base_url = url('');
            $info = new PageController();
            $info = $info->getInfos();
            $details = array(
                "SITE_ADDR" => "$base_url",
                "EMAIL_LOGO" => "$base_url/img/logo.png",
                "EMAIL_TITLE" => "Verification Message!",
                "CUSTOM_URL" => "$base_url/Verify/$userHash",
                "CUSTOM_IMG" => "$base_url/img/mail/welcome.png",
                "TO_NAME" => $name,
                "REPLY_TO" => $info['email'],
                "DATE" => date("l, F d, Y"),
                "MESSAGE" => "Welcome to Show Modern Kitchen, We hope you have a great time with us.",
                "TO_EMAIL" => $email,
                "PASSWORD" => $postArray['password'],
                "USER_EMAIL" => $email,
            );
            Mail::mailer('smtp')->to($email)->send(new Verification($details));
            if (Mail::failures()) {
                $responses = array(
                    'message' => 'Sorry! - something went wrong while trying to send email try again ',
                    'type' => 'red',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                );
            } else {
                $User = User::create($postArray);
                if (!$User) {
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
        }
        return json_encode($responses);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', '=', $id)->first();
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $postArray = $request->all();
        if (isset($postArray['changeDp'])) {

            $imageName = 'profile-' . time() . '.png';
            // $path = './User/assets/img/' . $imageName;
            $postArray['image']->move(public_path('assets/img/users'), $imageName);
            $user = User::where('id', '=', $id)
                ->update(['profile_pic' => $imageName]);
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

            $user = User::where('id', '=', $id)
                ->update(['status' => $postArray['status']]);
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
            $userCount = User::where('email', '=', $postArray['email'])
                ->where('id', '!=', $id)->count();
            if ($userCount > 0) {
                $responses = array(
                    'message' => 'Sorry! Email already exists.',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                $userCount1 = User::where('othernames', '=', $postArray['othernames'])
                    ->where('id', '!=', $id)->count();
                if ($userCount1 > 0) {
                    $responses = array(
                        'message' => 'Sorry! Username already exists.',
                        'type' => 'red',
                        'icon' => 'fa-check-circle',
                        'title' => 'Thank you'
                    );
                    return json_encode($responses);
                }
                $user = User::where('id', '=', $id)
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

    public function ChangePasswordFromMail($hash)
    {
        $user = User::where('remember_token', '=', $hash)->first();
        if ($user) {
            return view('user.changePassword', compact('user'));
        } else {
            return Redirect::to('/login');
        }
    }
    public function resetPassword(Request $request)
    {
        $postArray = $request->all();
        $count = User::where('email', '=', $postArray['email'])
            ->where('remember_token', '=', $postArray['hash'])->count();
        if ($count > 0) {
            $user = User::where('email', '=', $postArray['email'])
                ->where('remember_token', '=', $postArray['hash'])
                ->update([
                    'password' => bcrypt($postArray['password'])
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

    public function changePassword(Request $request, $id)
    {
        $postArray = $request->all();
        //User check
        $user = User::where('id', '=', $id)->first();
        $password = $request->oldPassword;
        $stored_password = $user->password;
        if (password_verify($password, $stored_password)) {

            $user = User::where('id', '=', $id)
                ->update([
                    'password' => bcrypt($postArray['password'])
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function verify($hash)
    {
        // dd($hash);
        $count = User::where('remember_token', '=', $hash)->count();
        if ($count) {
            $user = User::where('remember_token', '=', $hash)->first();

            $userToken = User::where('remember_token', '=', $hash)->first();
            if ($userToken) {
                if ($user->status === 'active') {
                    $responses = array(
                        'message' => 'Account has already been verified.',
                        'type' => 'blue',
                        'icon' => 'fa-check-circle',
                        'title' => 'Hello!'
                    );
                } elseif ($user->status === 'deactivated') {
                    $responses = array(
                        'message' => 'Account has already been deactivated.',
                        'type' => 'red',
                        'icon' => 'fa-bell',
                        'title' => 'Sorry!'
                    );
                } else {
                    $userUpdate = User::where('remember_token', '=', $hash)->update([
                        'status' => 'active'
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
        $user = 'user';
        return view('verify', compact('responses', 'user'));
    }
    public function destroy($id)
    {
        //
    }
}
