<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendOtpOnEmail;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        $request->validate([
            'otp' => ['required',"exists:password_reset_tokens,token,email,{$request->email}"]
        ]);
        return view('auth.reset-password', ['request' => $request]);
    }
    
    public function reSendOtp(Request $request){
        $user = User::where('email',$request->email)->first();
        $user->notify(new SendOtpOnEmail($user));
        
        return redirect(route('otp.confirm'))->with('email', $user->email);
    }
    
    public function otpScreen(Request $request): View
    {
        return view('auth.otp-screen');
    }
    
    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required',"exists:password_reset_tokens,token,email,{$request->email}"],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = UserToken::where(['email'=>$request->email,"token"=>$request->token])->first()->user;
        try{

            $user->forceFill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
                ])->save();
                event(new PasswordReset($user));
                // Here we will attempt to reset the user's password. If it is successful we
                // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        // $status = Password::reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user) use ($request) {
        //         $user->forceFill([
        //             'password' => Hash::make($request->password),
        //             'remember_token' => Str::random(60),
        //         ])->save();

        //         event(new PasswordReset($user));
        //     }
        // );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
    return  redirect()->route('login')->with('status', __(Password::PASSWORD_RESET));
        // return $status == Password::PASSWORD_RESET
        // ? redirect()->route('login')->with('status', __($status))
        // : back()->withInput($request->only('email'))
        // ->withErrors(['email' => __($status)]);
    }catch(Exception $e){
      return  back()->withInput($request->only('email'))
        ->withErrors(['email' => __($e->getMessage())]);
    }

    }
}
