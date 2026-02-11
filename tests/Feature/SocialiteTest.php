<?php

namespace Tests\Feature;

use Laravel\Socialite\Socialite;
use Tests\TestCase;
use App\Models\User;

class SocialiteTest extends TestCase
{
    public function test_if_user_is_redirected_to_github(): void
    {
        Socialite::fake('github');
        $response = $this->get('/auth/redirect');
        $response->assertRedirect();
    }

    public function test_if_user_can_login_with_github(): void
    {
        $user = User::factory()->create();
        Socialite::fake('github', $user);

        $response = $this->get('/auth/callback');

        $response->assertRedirect('/dashboard');

        /*
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'github_id' => $user->github_id,
        ]);
        */
    }
}
