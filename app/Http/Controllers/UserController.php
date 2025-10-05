<?php

namespace App\Http\Controllers;

use App\Actions\ChangeUserPassword;
use App\Actions\DeleteUserAccount;
use App\Actions\UpdateUserProfile;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function show(Request $request)
    {
        return new UserResource($request->user());
    }
    // Great one
    public function update(UpdateUserRequest $request)
    {
        $user = (new UpdateUserProfile())->execute($request->user(), $request->validated());

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => new UserResource($user),
        ]);
    }

    // Great one
    public function changePassword(ChangePasswordRequest $request)
    {
        (new ChangeUserPassword())->execute($request->user(), $request->current_password, $request->password);

        return response()->json([
            'message' => 'Password changed successfully',
        ]);
    }

    // Great one
    public function destroy(DeleteUserRequest $request)
    {
        (new DeleteUserAccount())->execute($request->user(), $request->password);

        return response()->json([
            'message' => 'Account deleted successfully',
        ]);
    }
}
