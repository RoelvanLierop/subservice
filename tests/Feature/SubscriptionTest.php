<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    public function test_if_user_can_subscribe(): void
    {
        $user = $this->createUser();
        $this->get(route('checkout'))->assertStatus(302);

        $response = $this->actingAs($user)->get(route('checkout_success', ['plan' => 'basic']));
        $response->assertOk();
    }

    public function test_if_user_can_unbscribe(): void
    {
        $this->get(route('cancel_subscription', ['plan' => 'basic']))->assertStatus(302);
    }

    public function createUser()
    {
        $user = User::factory()->create();
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'github_id' => $user->github_id,
            'github_token' => $user->github_token,
            'github_refresh_token' => $user->github_refresh_token,
        ]);

        return $user;
    }
}
