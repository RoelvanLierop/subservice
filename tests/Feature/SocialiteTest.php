<?php

namespace Tests\Feature;

use Laravel\Socialite\Socialite;
use Tests\TestCase;

class SocialiteTest extends TestCase
{
    public function test_if_user_is_redirected_to_github(): void
    {
        Socialite::fake('github');
        $response = $this->get('/auth/github/redirect');
        $response->assertRedirect();
    }
}
