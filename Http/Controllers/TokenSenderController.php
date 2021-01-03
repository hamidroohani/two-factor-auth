<?php


namespace TwoFactorAuth\Http\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use TwoFactorAuth\Facades\TokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Facades\UserProviderFacade;
use TwoFactorAuth\Http\ResponderFacade;

class TokenSenderController extends Controller
{
    public function issueToken()
    {
        $email = request('email');

        //validate
        $validate = Validator::make(request()->all(),[
            'email' => 'required|email'
        ]);
        if ($validate->fails())
        {
            return ResponderFacade::emailNotValid($validate->errors());
        }

        // find user row in DB or fail
        $user = UserProviderFacade::getUserByEmail($email);
        if (!$user) {
            return ResponderFacade::userNotFound();
        }
        // check user block
        if (UserProviderFacade::isBanned($user->id))
        {
            return ResponderFacade::blockedUser();
        }
        //generate token
        $token = TokenGeneratorFacade::generateToken();
        //save token
        TokenStoreFacade::tokenStore($token,$user->id);

        // send token
        TokenSenderFacade::send($token,$user);

        return ResponderFacade::tokenSent();
    }
}
