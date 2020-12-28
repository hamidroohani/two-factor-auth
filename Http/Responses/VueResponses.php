<?php


namespace TwoFactorAuth\Http\Responses;


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
}
