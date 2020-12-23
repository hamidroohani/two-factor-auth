<?php


namespace TwoFactorAuth\tests;


use App\Models\User;
use Tests\TestCase;
use TwoFactorAuth\Facades\UserProviderFacade;

class TwoFactorAuthTokenTest extends TestCase
{
    public function test_sample()
    {
        UserProviderFacade::shouldReceive('getUserByEmail')
            ->once()
            ->with('hamid@gmail.com')
            ->andReturn(new User(['email' => 'hamid@gmail.com']));
        $response = $this->get('/api/two-factor-auth/request-token');
        $this->assertTrue($response->content() == 'hello');
    }
}
