<?php


namespace TwoFactorAuth\Http\Controllers;


use Illuminate\Routing\Controller;
use TwoFactorAuth\Facades\TokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Facades\UserProviderFacade;
use TwoFactorAuth\Http\ResponderFacade;

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
            return ResponderFacade::blockedUser();
        }
        //generate token
        $token = TokenGeneratorFacade::generateToken();
        //save token
        TokenStoreFacade::tokenStore($token,$user->id);

        return ResponderFacade::tokenSent();
    }
}
