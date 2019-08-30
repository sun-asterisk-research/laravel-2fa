<?php

namespace SunAsterisk\DomainVerifier\Tests\Strategies;

use PHPUnit\Framework\TestCase;
use SunAsterisk\Laravel2FA\VerificationCodeGenerator;

class VerificationCodeGeneratorTest extends TestCase
{
    public function testGenerator()
    {
        $code = VerificationCodeGenerator::generate();
        $this->assertTrue(isset($code));
    }
}
