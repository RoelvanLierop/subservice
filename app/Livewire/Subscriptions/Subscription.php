<?php

namespace App\Livewire\Subscriptions;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Subscription extends Component
{
    public string $subscribedTo = 'none';

    public string $subscriptionStatus = 'none';

    public bool $showCancelButton = false;

    public function mount(): void
    {
        $user = Auth::user();

        if ($user->subscription('prod_TxVBCgQ6C90dQX') !== null)
        {
            if ($user->subscription('prod_TxVBCgQ6C90dQX')->stripe_price === 'price_1SzaAwLiFiZNqao9Q2aalUeL') {
                $this->subscriptionStatus = (!$user->subscription('prod_TxVBCgQ6C90dQX')->canceled() ? 'active' : 'canceled');
                $this->subscribedTo = 'basic';
                $this->showCancelButton = true;
            } elseif ($user->subscription('prod_TxVBCgQ6C90dQX')->stripe_price === 'price_1T0IgtLiFiZNqao9H5pmoBgi') {
                $this->subscriptionStatus = (!$user->subscription('prod_TxVBCgQ6C90dQX')->canceled() ? 'active' : 'canceled');
                $this->subscribedTo = 'professional';
                $this->showCancelButton = true;
            }
        }
    }
}
