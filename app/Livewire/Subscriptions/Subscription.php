<?php

namespace App\Livewire\Subscriptions;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Subscription extends Component
{
    public string $subscribedTo;

    public bool $showCancelButton = false;

    public function mount(): void
    {
        $this->subscribedTo = 'none';
        if (Auth::user()->subscribed('basic')) {
            $this->subscribedTo = 'basic';
            $this->showCancelButton = true;
        } elseif (Auth::user()->subscribed('professional')) {
            $this->subscribedTo = 'professional';
            $this->showCancelButton = true;
        }
    }

    public function subscribe($subscrptionKey){
        return Auth::user()
            ->newSubscription($subscrptionKey, 'price_basic_monthly')
            ->checkout([
                'success_url' => route('dashboard'),
                'cancel_url' => route('dashboard'),
            ]);
    }
}
