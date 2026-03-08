@props([    'name', 'type'=>'text'])



<input  type="{{ $type  }}"
        name="{{ $name  }}"
        {{  $attributes->merge([
            'class' =>  '
                mt-1
                mb-2
                
                w-full
                border border-transparent
                rounded-l
                px-2
                py-1
                text-white
                bg-gray-600
                transition
            ']) }}
            >