<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserToken;
use App\Notifications\SendOtpOnEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ],['email.exists'=>"Email Id doesn't exist reach hr@manojbabu.info"]);
        $user = User::where('email',$request->email)->first();
        if(!$user->active) {
            return back()->withErrors(['email'=>'Your account is inactive']);
        }
        UserToken::where('email',$request->email)->delete();
        UserToken::create([
            'email' => $request->email,
            'token' => rand(11111,99999),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $user->notify(new SendOtpOnEmail($user));

        return redirect(route('otp.confirm'))->with('email', $user->email);
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // return $status == Password::RESET_LINK_SENT
        //             ? back()->with('status', __($status))
        //             : back()->withInput($request->only('email'))
        //                     ->withErrors(['email' => __($status)]);
    }
}
