<?php

namespace SunAsterisk\Laravel2FA\Mails\VerificationCode;

use Illuminate\Mail\Mailable;

class VerificationCode extends Mailable
{
    protected $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('laravel-2fa::emails.verification_code')
                    ->with([
                        'code' => $this->code,
                    ]);
    }

}
