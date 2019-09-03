<?php

use Illuminate\Support\Facades\Route;

Route::post("2fa/login", "SunAsterisk\Laravel2FA\Http\Controllers\Auth\Login\LoginControler@login");
