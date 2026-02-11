<section class="w-full flex flex-col min-h-full">
    <div class="w-full flex grow">
    Current Subscription: {{ ucfirst($subscribedTo) }}
    </div>
    @if( $showCancelButton )
        <flux:button class="w-full">Cancel subscription</flux:button>
    @else
        <flux:button class="w-full" href="{{ url('/') }}">Subscribe</flux:button>
    @endif
</section>
