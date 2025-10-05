<?php
namespace App\Actions;

use App\Models\User;

class RevokeUserToken
{
    // It would be nice specifying the return type of the execute function
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
