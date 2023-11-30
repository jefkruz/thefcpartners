<?php

namespace App\Http\Controllers;

use App\Models\RegistrationMail;
use App\Models\SuccessfulRegistration;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister($username = 'admin')
    {
        $data['refer'] = User::whereUsername($username)->firstOrFail();
        return view('auth.register', $data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::whereEmail($request->email)->first();
        if(!$user){
            return back()->withInput()->with('error', 'Incorrect credentials');
        }

        $validated = password_verify($request->password, $user->password);
        if(!$validated){
            return back()->withInput()->with('error', 'Incorrect credentials');
        }

        if($user->status == 'inactive'){
            return back()->withInput()->with('error', 'Please check your mailbox for verification link');
        }

        if($user->status == 'banned'){
            return back()->withInput()->with('error', 'This account has been flagged. Please contact administrator.');
        }


        if($user->role == 'admin'){
            session()->put('admin', $user);
            return to_route('admin');
        } else {
            session()->put('user', $user);

            if(session('redirectTo')){
                $ref = session('redirectTo');
                session()->forget('redirectTo');
                return to_route('checkout', $ref);
            }

            return to_route('home');
        }

    }

    public function register(Request $request, $username = 'admin')
    {
        $request->validate([
            'referral_id' => 'required',
            'email' => 'required|email',
            'username' => 'required|unique:users|alpha_dash|min:4',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed',
            'b_month' => 'required',
            'b_date' => 'required'
        ],[

            'username.required' => 'The username field is required.',
            'username.unique' => 'This username is already taken.',
            'username.alpha_dash' => 'The username may only contain letters, numbers, dashes, and underscores.',
            'username.min' => 'The username must be at least 4 characters.'

        ]);


        $refer = User::findOrFail($request->referral_id);

        $userExists = User::whereEmail($request->email)->orWhere('username', $request->username)->exists();
        if($userExists){
            return back()->withInput()->with('error', 'User exists already');
        }

        $verification_code = md5(time()) . md5(uniqid());

        $user = new User();
        $user->referral_id = $refer->id;
        $user->email = $request->email;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->b_month = $request->b_month;
        $user->b_date = $request->b_date;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->verification_code = $verification_code;
        $user->status = 'inactive';
        $user->save();

        $mail = new RegistrationMail();
        $mail->email = $user->email;
        $mail->username = $user->username;
        $mail->verification_code = $user->verification_code;
        $mail->save();

        if(session('redirectTo')){
            $ref = session('redirectTo');
            session()->forget('redirectTo');
            return to_route('checkout', $ref);
        }

        return view('pages.successful_registration');
    }

    public function verifyRegistration($username, $code)
    {
        $user = User::whereStatusAndUsernameAndVerificationCode('inactive', $username, $code)->firstOrFail();
        $user->status = 'active';
        $user->verification_code = null;
        $user->save();

        $s = new SuccessfulRegistration();
        $s->name = $user->firstname . ' ' . $user->lastname;
        $s->email = $user->email;
        $s->username = $user->username;
        $s->save();

        session()->put('user', $user);

        return to_route('home')->with('message', 'Welcome to Zularich Properties');
    }

    public function logout()
    {
        session()->flush();
        return to_route('login');
    }
}
