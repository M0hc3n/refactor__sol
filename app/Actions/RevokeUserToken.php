<?php
namespace App\Actions;

use App\Models\User;

class RevokeUserToken
{
    public function execute(User $user, $tokenId)
    {
        $token = $user->tokens()->find($tokenId);

        if (!$token) {
            return false;
        }

        $token->delete();
        return true;
    }
}