<?php
namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginUser
{
    public function execute(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }

        return $user;
    }
}