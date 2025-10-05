<?php
namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangeUserPassword
{
    // It would be nice specifying the return type of the execute function
    public function execute(User $user, string $currentPassword, string $newPassword)
    {
        if (!Hash::check($currentPassword, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        // revoke all other tokens except current one
        $user->tokens()->where('id', '!=', $user->currentAccessToken()->id)->delete();
    }
}
