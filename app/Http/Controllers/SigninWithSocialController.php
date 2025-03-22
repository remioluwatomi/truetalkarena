<?php

namespace App\Http\Controllers;

use App\Mail\Verification;
use App\Models\Social;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Validator;

class SigninWithSocialController extends Controller
{
    private $company_email;
    public function __construct()
    {
        $info = new PageController();
        $this->company_email = $info->getInfos()['email'];
    }
    public function getSocialByName($name)
    {
        $info = Social::where('soc_name', '=', $name)->first();
        return $info;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        session()->reflash();
        // dd(session('redirect'));
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {

        session()->reflash();
        // $socials = Social::whereget();
        // dd($this->company_email);
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();
            // dd($user);
            if ($finduser) {

                if ($finduser->status === 'active') {

                    // Auth::login($finduser);
                    Session::put('user', $finduser);
                    if (session('redirect')) {
                        return redirect()->intended(session('redirect'));
                    } else {
                        return redirect()->intended('/login');
                    }
                } elseif ($finduser->status === 'inactive') {
                    return redirect('/login')->with('info', 'Your account has not been verified yet, please check you mail.');
                } else {
                    return redirect('/login')->with('error', 'Dear Customer, your account has been deactivated for security reasons, there have been some suspecious activities on your account, please contact support@stilttech.com for more information.  <br> <hr> Thanks Stilt-tech Team');
                }
            } else {
                $googleUser = $user->user;
                // dd($googleUser);
                $email = $googleUser['email'];
                $checkEmail = User::where('email', '=', $email)->first();
                if ($checkEmail) {
                    if ($checkEmail->status === 'active') {
                        User::where('email', '=', $email)->update([
                            'google_id' => $googleUser['id'],
                        ]);
                        // Auth::login($checkEmail);
                        Session::put('user', $checkEmail);
                        if (session('redirect')) {
                            return redirect()->intended(session('redirect'));
                        } else {
                            return redirect()->intended('/login');
                        }
                    } elseif ($checkEmail->status === 'inactive') {
                        return redirect('/login')->with('info', 'Your account has not been verified yet, please check you mail.');
                    } else {
                        return redirect('/login')->with('error', 'Dear Customer, your account has been deactivated for security reasons, there have been some suspecious activities on your account, please contact support@stilttech.com for more information.  <br> <hr> Thanks Stilt-tech Team');
                    }
                } else {
                    return redirect('/login')->with('error', 'Invalid email or password.');
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();

            if ($isUser) {
                Auth::login($isUser);
                return redirect('/user');
            } else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($createUser);
                return redirect('/user');
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
