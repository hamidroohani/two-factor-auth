<?php


namespace TwoFactorAuth\tests;


use App\Models\User;
use Tests\TestCase;
use TwoFactorAuth\Facades\TokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Facades\UserProviderFacade;

class TwoFactorAuthTokenTest extends TestCase
{
   /** @test */ 
    public function test_sample()
    {
        User::unguard();
        $this->withoutExceptionHandling();
        UserProviderFacade::shouldReceive('getUserByEmail')
            // ->once()
            ->with('hamid@gmail.com')
            ->andReturn($user = new User(['id' => 1, 'email' => 'hamid@gmail.com']));

        TokenGeneratorFacade::shouldReceive('generateToken')
            // ->once()
            ->withNoArgs()
            ->andReturn('1q2w3e');

        TokenStoreFacade::shouldReceive('tokenStore')
            // ->once()
            ->with('1q2w3e', $user->id);
//        $response = $this->get('/api/two-factor-auth/request-token');
//        $this->assertTrue($response->content() == 'hello');
    }

/** @test */
    public function test_user_is_blocked()
    {
        User::unguard();

        UserProviderFacade::shouldReceive('isBanned')
        // ->once()
        ->with(1)
        ->andReturn(true);

        UserProviderFacade::shouldReceive('getUserByEmail')
            // ->once()
            ->with('hamid@gmail.com')
            ->andReturn($user = new User(['id' => 1, 'email' => 'hamid@gmail.com']));

        TokenGeneratorFacade::shouldReceive('generateToken')
            ->never();

        TokenStoreFacade::shouldReceive('tokenStore')
            ->never();
       $response = $this->get('/api/two-factor-auth/request-token?email=hamid@gmail.com');
       $response->assertJson(['error' => 'You are blocked']);
       $response->assertStatus(400);
    }
}
