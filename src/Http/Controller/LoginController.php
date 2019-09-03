<?php

namespace SunAsterisk\Laravel2FA\Http\Controllers\Auth\Login;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use SunAsterisk\Laravel2FA\VerificationCodeGenerator;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $code = VerificationCodeGenerator::generate();
            $user = $request->user();
            $this->sendVerifyMail($code, $user->email);
            $this->insertVerifyCodeToDatabase($user->id, $code);
            $request->session()->put('2fa:user:id', encrypt($user->id));
            return redirect('2fa/verify');
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendVerifyMail($code, $email)
    {
        Mail::to($email)->send(new VerificationCode($code));
    }

    protected function insertVerifyCodeToDatabase($user_id, $code)
    {
        DB::table('two_factors_verification_codes')
            ->insert([
                'user_id' => $user_id,
                'verification_code' => $code,
                'revoked' => false,
                'expires_at' => now()->addMinutes(config('laravel-2fa.verification_code_ttl')),
                'create_at' => now(),
                'update_at' => now(),
            ]);
    }
}
