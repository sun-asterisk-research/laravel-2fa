<?php

namespace SunAsterisk\Laravel2FA\Models;

use Illuminate\Database\Eloquent\Model;

class TwoFactorsVerificationCode extends Model
{
    protected $table = 'two_factors_verification_codes';

    protected $fillable = [
        'user_id',
        'verification_code',
        'revoked',
        'expires_at',
    ];
}
