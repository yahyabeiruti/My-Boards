<button 
    {{ $attributes->merge([
        'class' => '
            
            text-black
            bg-inherit
            rounded-full 
            text-white 
            font-semibold 
            py-1
            px-1 
            mr-2
            border
            border-gray-600
            shadow-md 
            hover:shadow-lg
            hover:shadow-gray-600
            transition 
            duration-200 
            ease-out
        '
    ]) }}
>
    {{ $slot }}
</button>