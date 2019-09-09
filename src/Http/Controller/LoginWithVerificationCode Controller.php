<?php

namespace SunAsterisk\Laravel2FA\Http\Controllers\Auth\LoginWithVerificationCode;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;
use SunAsterisk\Laravel2FA\Models\TwoFactorsVerificationCode;
use Illuminate\Http\Request;

class LoginWithVerificationCodeController extends BaseController
{
    use AuthenticatesUsers;

    protected $redirectTo = '\home';

    function verify(Request $request)
    {
        $secret = $request->session()->get('2fa:user:id');
        $verifyCode = $request->verify_code;
        $userId = Crypt::decrypt($secret);
        $verify = TwoFactorsVerificationCode::where('user_id', $userId)
            ->where('verification_code', $verifyCode)
            ->where('expires_at', '<=', now())
            ->where('revoked', false)
            ->first();

        if (isset($verify)) {
            TwoFactorsVerificationCode::where('user_id', $userId)
                ->update(['revoked' => true]);
            $request->session()->forget('2fa:user:id');
            $this->sendLoginResponse($request);
        } else
            redirect('/home');
    }

    function showVerifyView()
    {
        return view(config('laravel-2fa.views.verify'));
    }
}
