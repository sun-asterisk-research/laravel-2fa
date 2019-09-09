<?php

namespace SunAsterisk\Laravel2FA\Models;

use Illuminate\Database\Eloquent\Model;

class AuthenticatorKey extends Model
{
    protected $table = 'two_factors_authenticator_keys';

    protected $fillable = [
        'user_id',
        'authenticator_key',
    ];
}
