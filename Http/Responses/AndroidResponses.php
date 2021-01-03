<?php


namespace TwoFactorAuth\Http\Responses;


use Illuminate\Http\Response;

class AndroidResponses
{
    public function blockedUser()
    {
        return response()->json(['err' => 'You are blocked from android'],Response::HTTP_BAD_REQUEST);
    }

    public function tokenSent()
    {
        return response()->json(['msg' => 'Token was sent from android.'],Response::HTTP_OK);
    }

    public function userNotFound()
    {
        return response()->json(['error' => 'User not found.'],Response::HTTP_BAD_REQUEST);
    }

    public function emailNotValid($error)
    {
        return response()->json($error,Response::HTTP_BAD_REQUEST);
    }

    public function youShouldBeGuest()
    {
        return response()->json(['error' => 'You are login.'],Response::HTTP_BAD_REQUEST);
    }
}
