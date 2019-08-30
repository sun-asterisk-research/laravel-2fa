<?php

namespace SunAsterisk\DomainVerifier\Tests\Strategies;

use PHPUnit\Framework\TestCase;
use SunAsterisk\Laravel2FA\VerificationCodeGenerator;
use Mockery as m;

class VerificationCodeGeneratorTest extends TestCase
{
    public function testGenerator()
    {
        $code = VerificationCodeGenerator::generate();
        $this->assertTrue(is_numeric($code) && strlen($code) == 6);
    }
}
