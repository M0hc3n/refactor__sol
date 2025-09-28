<?php
namespace App\Actions;

use App\Models\User;

class UpdateUserProfile
{
    public function execute(User $user, array $data)
    {
        $user->update([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
        ]);
        return $user;
    }
}