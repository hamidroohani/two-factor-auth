<?php


namespace HamidRoohani\TwoFactorAuth\Http\Responses;


use Illuminate\Http\Response;

class VueResponses
{
    public function blockedUser()
    {
        return response()->json(['error' => 'You are blocked'],Response::HTTP_BAD_REQUEST);
    }
    public function tokenSent()
    {
        return response()->json(['message' => 'Token was sent.'],Response::HTTP_OK);
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
