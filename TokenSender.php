<?php

namespace HamidRoohani\TwoFactorAuth;

use Illuminate\Support\Facades\Notification;
use HamidRoohani\TwoFactorAuth\Notifications\LoginTokenNotification;

class TokenSender{
    public function send($token, $user)
    {
        Notification::send($user,new LoginTokenNotification($token));
    }
}
