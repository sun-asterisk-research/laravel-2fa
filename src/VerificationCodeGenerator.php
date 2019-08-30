<?php

namespace SunAsterisk\Laravel2FA;

class VerificationCodeGenerator
{
    public static function generate()
    {
       return str_pad(random_int(0, 999999), 0, 6, STR_PAD_LEFT);
    }
}
