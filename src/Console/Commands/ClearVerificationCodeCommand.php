<?php

namespace SunAsterisk\Laravel2FA\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearVerificationCodeCommand extends Command
{
    /**
     * The name and signature of the Console command.
     *
     * @var string
     */
    protected $signature = '2fa:clear';

    /**
     * The Console command description.
     *
     * @var string
     */
    protected $description = 'Clear expired & revoked verification codes';

    /**
     * Execute the Console command.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('two_factors_verification_codes')
            ->where('revoked', true)
            ->orWhere('expires_at', '<', now())
            ->delete();
    }
}
