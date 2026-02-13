<?php

namespace App\Livewire\Subscriptions;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

/** Livewire component voor subscriptions.
 *
 * We willen geen kruisbestuiving van front-end en back-end code. Daarom kiezen we voor een multi-file component.
 * Zo blijft de back-end/processong code in App/Http, en front-end in resources staan.
 * Omdat we in dit geval ook geen Javascript/css nodig hebben, zijn de bestanden aangemaakt zonder Artisan.
 *
 * Component class: App/Http/Livewire/Subscriptions/Subscription.php
 * View: resources/views/livewire/subscriptions/subscription.blade.php
 */

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
