<?php

namespace SunAsterisk\Laravel2FA\Models;

use Illuminate\Database\Eloquent\Model;

class RecoveryCode extends Model
{
    protected $table = 'two_factors_recovery_codes';

    protected $fillable = [
        'user_id',
        'recovery_code',
    ];
}
