<?php


namespace TwoFactorAuth\tests;


use Tests\TestCase;

class TwoFactorAuthTokenTest extends TestCase
{
    public function test_sample()
    {
        $response = $this->get('/api/two-factor-auth/request-token');
        $this->assertTrue($response->content() == 'hello');
    }
}
