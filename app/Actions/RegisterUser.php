<?php
namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUser
{
    // It would be nice specifying the return type of the execute function
    public function execute(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
