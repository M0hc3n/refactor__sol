<?php
namespace App\Actions;

use App\Models\User;

class UpdateUserProfile
{
    // It would be nice specifying the return type of the execute function
    public function execute(User $user, array $data)
    {
        $user->update([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
        ]);
        return $user;
    }
}
