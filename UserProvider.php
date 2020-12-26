<?php


namespace TwoFactorAuth;


use App\Models\User;

class UserProvider
{
    public function getUserByEmail($email)
    {
        return User::where('email',$email)->first();
    }

    public function isBanned($user)
    {
        return $user->is_ban == 1;
    }
}
