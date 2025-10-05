<?php
namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class DeleteUserAccount
{
    // It would be nice specifying the return type of the execute function
    public function execute(User $user, string $password)
    {
        if (!Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided password is incorrect.'],
            ]);
        }

        $user->tokens()->delete();
        $user->delete();
    }
}
