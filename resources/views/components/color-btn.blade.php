<button {{ $attributes->merge(['class' => 'color-btn py-3 px-3 rounded-lg hover:ring-2 hover:ring-offset-2', 'type' => 'button']) }}>
    {{ $slot }}
</button>
