<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\SettingsController;
use App\Mail\UserNotification;
use App\Mail\Verification;
// use App\Models\Account;
use App\Models\Social;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Contracts\Session\Session;

// use Validator;

class AuthController extends Controller
{

    private $apiToken;
    private $hash;
    private $company_email;
    public function __construct()
    {
        $this->apiToken = uniqid(base64_encode(Str::random(20)));
        $this->hash = uniqid(base64_encode(Str::random(25)));

        $info = new PageController();
        $this->company_email = $info->getInfos()['email'];
    }
    public function getSocialByName($name)
    {
        $info = Social::where('soc_name', '=', $name)->first();
        return $info;
    }
    public function forgetPassword(Request $request)
    {
        $postArray = $request->all();
        $count = User::where('email', '=', $postArray['email'])->count();
        if ($count > 0) {
            $user = User::where('email', '=', $postArray['email'])
                ->first();
            $email = $postArray['email'];
            $name = $user->firstname;
            $postArray['remember_token'] = $this->hash;
            $userHash = $postArray['remember_token'];
            $update = User::where('email', '=', $postArray['email'])
                ->update([
                    'remember_token' => $userHash
                ]);
            $base_url = url('');
            $details = array(
                "SITE_ADDR" => "$base_url",
                "EMAIL_LOGO" => "$base_url/assets/img/logo-icon.png",
                "EMAIL_TITLE" => "Reset Password!",
                "CUSTOM_URL" => "$base_url/ChangePassword/$userHash",
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

    public function register(Request $request)
    {
        $postArray = $request->all();
        $postArray['remember_token'] = $this->hash;


        $userHash = $postArray['remember_token'];
        $name = $postArray['firstname'];
        $email = $postArray['email'];
        $base_url = url('');
        $postArray['password'] = isset($postArray['password']) ? $postArray['password'] : strtoupper(uniqid(Str::random(12)));
        $password = $postArray['password'];
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
            "TYPE" => 'admin',

        );
        // $this->sendMail($name, $email,$userHash)

        $checkEmail = User::where('email', '=', $email)
            ->count();
        $checkName = User::where('email', '=', $email)
            ->count();
        if ($checkEmail > 0) {
            $responses = array(
                'message' => 'Sorry! - Email already exist. ',
                'type' => 'red',
                'icon' => 'fa-bell',
                'title' => 'Sorry'
            );
        } else {
            if ($checkName > 0) {
                $responses = array(
                    'message' => 'Sorry! - Email already exist. ',
                    'type' => 'red',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                );
            } else {
                $user = User::create($postArray);
                if ($user) {
                    Mail::mailer('smtp')->to($email)->send(new Verification($details));

                    $currentUser = User::where('email', '=', $email)
                        ->first();
                    $user_id = $currentUser->id;

                    $report = Activity::create([
                        'user_id' => $user_id,
                        'user_note' => "Welcome to D'Perennial Entertainment Limited, Thank you for choosing us.",
                        'admin_note' => "A new user $name just registered"
                    ]);

                    $responses = array(
                        'message' => 'Your account has been created',
                        'type' => 'green',
                        'token' => $this->apiToken,
                        'icon' => 'fa-bell',
                        'title' => 'Hello!'
                    );
                } else {
                    $responses = array(
                        'message' => 'Sorry! - something went wrong. ',
                        'type' => 'red',
                        'icon' => 'fa-bell',
                        'title' => 'Sorry'
                    );
                }
            }
        }


        return json_encode($responses);
    }
    public function login(Request $request)
    {
        // dd($location);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->status === 'active') {
                Session::put('user', $user);
                // return redirect()->intended('User');
                return response()->json([
                    'message' => 'Welcome',
                    'type' => 'green',
                    'id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'token' => $user->remember_token,
                    'icon' => 'fa-bell',
                    'title' => 'Hello!'
                ]);
            } elseif ($user->status === 'inactive') {
                return response()->json([
                    'message' => 'Your account has not been verified yet, please check you mail.',
                    'type' => 'blue',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                ]);
            } else {
                return response()->json([
                    'message' => 'Dear Customer, your account has been deactivated for security reasons, there have been some suspecious activities on your account, please contact support@greenhillcredits.com for more information.  <br> <hr> Thanks Greenhill Team',
                    'type' => 'red',
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
    }
    // public function sendmailAdmin($details, $location)
    // {
    //     Mail::mailer('smtp')->to($this->getCompanyEmail())->send(new LocationNotification($details, $location));
    //     if (Mail::failures()) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
}
