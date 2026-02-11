<?php

namespace Tests\Feature;

use Laravel\Socialite\Socialite;
use Tests\TestCase;

class CashierTest extends TestCase
{
    public function test_if_a_user_can_subscribe_to_basic_plan()
    {
        $this->actingAs($this->user);
        $this->setUpBilling();

        $enterprise = Plan::where('name', 'Enterprise')->first()->stripe_plan_id;

        $response = $this->post(route('paywall.payment'), [
            'payment_method' => 'pm_card_visa',
            'stripe_plan_id' => $enterprise
        ])
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect();
    }
    public function test_if_user_can_cancel_subscription(): void
    {

    }
}
