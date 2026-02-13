<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $plan = 'basic')
    {
        $priceId = 'price_'.($plan === 'basic' ? '1SzaAwLiFiZNqao9Q2aalUeL' : '1T0IgtLiFiZNqao9H5pmoBgi');
        return Auth::user()->newSubscription('prod_TxVBCgQ6C90dQX', $priceId)
            ->checkout([
                'success_url' => route('checkout_success', $plan),
                'cancel_url' => route('dashboard'),
            ]);
    }

    public function success(Request $request, string $plan = 'basic')
    {
        $priceId = 'price_'.($plan === 'basic' ? '1SzaAwLiFiZNqao9Q2aalUeL' : '1T0IgtLiFiZNqao9H5pmoBgi');

        $request->user()->newSubscription('prod_TxVBCgQ6C90dQX', $priceId)->create($request->paymentMethodId);

        return view('checkout.success', ['plan' => $plan]);
    }

    public function cancel(Request $request, string $plan = 'basic')
    {
        $request->user()->subscription('prod_TxVBCgQ6C90dQX')->cancel();

        return Redirect::to('dashboard');
    }
}
