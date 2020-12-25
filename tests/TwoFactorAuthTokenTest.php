<?php


namespace TwoFactorAuth\tests;


use App\Models\User;
use Tests\TestCase;
use TwoFactorAuth\Facades\TokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Facades\UserProviderFacade;

class TwoFactorAuthTokenTest extends TestCase
{
    public function test_sample()
    {
        UserProviderFacade::shouldReceive('getUserByEmail')
            ->once()
            ->with('hamid@gmail.com')
            ->andReturn($user = new User(['email' => 'hamid@gmail.com']));

        TokenGeneratorFacade::shouldReceive('generateToken')
            ->once()
            ->withNoArgs()
            ->andReturn('1q2w3e');

        TokenStoreFacade::shouldReceive('tokenStore')
            ->once()
            ->with('1q2w3e',$user);
        $response = $this->get('/api/two-factor-auth/request-token');
        $this->assertTrue($response->content() == 'hello');
    }
}
