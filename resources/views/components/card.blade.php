<div @class([
        'w-full bg-white sm:shadow-md overflow-hidden sm:rounded-lg',
        $attributes->get('class'),
])>
    @if(isset($header))
        <div @class([
                'mb-4 p-6',
                $attributes->get('header-class'),
             ])>
            {{ $header }}
        </div>
    @endif
    <div class="p-6 border-t border-b">
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div @class([
                'mt-4 p-6',
                $attributes->get('footer-class'),
             ])>
            {{ $footer }}
        </div>
    @endif
</div>
