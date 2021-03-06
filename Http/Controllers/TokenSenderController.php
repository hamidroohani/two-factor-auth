<?php


namespace HamidRoohani\TwoFactorAuth\Http\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use HamidRoohani\TwoFactorAuth\Facades\TokenGeneratorFacade;
use HamidRoohani\TwoFactorAuth\Facades\TokenStoreFacade;
use HamidRoohani\TwoFactorAuth\Facades\UserProviderFacade;
use HamidRoohani\TwoFactorAuth\Http\ResponderFacade;

class TokenSenderController extends Controller
{
    public function issueToken()
    {
        $email = request('email');

        //validate
        $this->validateEmail();

        // return if user is login
        $this->checkUserIsGuest();

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

    private function validateEmail(): void
    {
        $validate = Validator::make(request()->all(), [
            'email' => 'required|email'
        ]);
        if ($validate->fails()) {
            ResponderFacade::emailNotValid($validate->errors())->throwResponse();
        }
    }

    private function checkUserIsGuest(): void
    {
        if (Auth::check()) {
            ResponderFacade::youShouldBeGuest()->throwResponse();
        }
    }
}
