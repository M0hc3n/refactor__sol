<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_profile()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/user');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'name', 'email']]);
    }

    public function test_unauthenticated_user_cannot_view_profile()
    {
        $response = $this->getJson('/api/user');
        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_update_profile()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson('/api/user', [
                'name' => 'Updated Name',
                'email' => 'updated@example.com',
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Profile updated successfully',
            ])
            ->assertJsonStructure(['user' => ['id', 'name', 'email']]);
    }

    public function test_update_profile_fails_with_invalid_data()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson('/api/user', [
                'name' => '', // should be required
                'email' => 'thisisnotanemail',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email']);
    }

    public function test_authenticated_user_can_change_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('oldpassword'),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson('/api/password', [
                'current_password' => 'oldpassword',
                'password' => 'newpassword',
                'password_confirmation' => 'newpassword',
            ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Password changed successfully']);
    }

    public function test_change_password_fails_with_wrong_current_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('oldpassword'),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson('/api/password', [
                'current_password' => 'thisiswrong',
                'password' => 'newpassword',
                'password_confirmation' => 'newpassword',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['current_password']);
    }

    public function test_authenticated_user_can_delete_account()
    {
        $user = User::factory()->create([
            'password' => bcrypt('iamdeletingthis'),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->deleteJson('/api/user', [
                'password' => 'iamdeletingthis',
            ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Account deleted successfully']);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_delete_account_fails_with_wrong_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('iamdeletingthis'),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->deleteJson('/api/user', [
                'password' => 'iam___deletingthis',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }
}