<?php

namespace SunAsterisk\Laravel2FA\Mails\VerificationCode;
use Illuminate\Support\Facades\Mail as IlluminateMail;

class VerificationCode
{
    /**
     * Verfiy domain ownership via administrator mail
     *
     * @param string $email
     * @return view login
     */
    public function verify(string $email)
    {

        $view = config('domain_verifier.mail.view');
        $subject = config('domain_verifier.mail.subject');

        public function send_mail_verify(string $email)
		{   $email = 'viniciusdemourarosa@gmail.com';
		    $code = "123244";
		    Mail::send($view, $code, function($message) use ($email, $subject) {
		      $message->to($email);
		      $message->subject($subject);
		    });
		}
    }

}
