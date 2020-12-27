<?php


namespace TwoFactorAuth\Http\Controllers;


use Illuminate\Routing\Controller;
use TwoFactorAuth\Facades\TokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Facades\UserProviderFacade;

class TokenSenderController extends Controller
{
    public function issueToken()
    {
        $email = request('email');

        // find user row in DB or fail
        $user = UserProviderFacade::getUserByEmail($email);
        // check user block
        if (UserProviderFacade::isBanned($user->id))
        {
            return response()->json(['error' => 'You are blocked'],400);
        }
        //generate token
        $token = TokenGeneratorFacade::generateToken();
        //save token
        TokenStoreFacade::tokenStore($token,$user->id);

    }
}
