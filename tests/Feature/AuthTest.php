<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Joe Doe',
            'email' => 'joedoe@example.com',
            'password' => 'mohcentesting',
            'password_confirmation' => 'mohcentesting',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'user' => ['id', 'name', 'email'],
                'token',
                'token_type',
            ]);
    }

    public function test_user_register_fails_with_wrong_password_confirmation()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'password' => 'mohcentesting',
            'password_confirmation' => 'mohcen_testing',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    public function test_user_login()
    {
        $user = User::factory()->create([
            'email' => 'loginuser@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'loginuser@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'user' => ['id', 'name', 'email'],
                'token',
                'token_type',
            ]);
    }

    public function test_login_fails_with_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'failuser@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'failuser@example.com',
            'password' => 'password123isdifferent',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson(['message' => 'Logged out successfully']);
    }

    public function test_user_can_logout_all()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/logout-all');

        $response->assertStatus(200)
            ->assertJson(['message' => 'Logged out from all devices successfully']);
    }
}