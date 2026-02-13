<section class="w-full flex flex-col min-h-full">
    <div class="w-full flex grow">
        Current subscription: {{ ucfirst($subscribedTo) }}<br/>
        Status: {{ ucfirst($subscriptionStatus) }}
    </div>
    @if( $showCancelButton )
        <flux:button href="{{ route('cancel_subscription', ['plan' => $subscribedTo]) }}" class="w-full">Cancel subscription</flux:button>
    @else
        <flux:button href="{{ route('checkout', ['plan' => 'basic']) }}" class="w-full mb-2">Upgrade to Basic (Free)</flux:button>
        <flux:button href="{{ route('checkout', ['plan' => 'professional']) }}" class="w-full">Upgrade to Professional (&euro;5 Monthly)</flux:button>
    @endif
</section>
