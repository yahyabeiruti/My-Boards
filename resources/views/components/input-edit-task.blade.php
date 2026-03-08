@props(['label',    'name', 'type'=>'text'])

<label for="$name" class="block mb-1 tracking-wide text-lg font-semibold text-gray-700">{{ $label }}</label>

<input  type="{{ $type  }}"
        name="{{ $name  }}"
        {{  $attributes->merge([
            'class' =>  '
                mt-3
                mb-2
                block
                w-60
                border border-transparent
                rounded-xl
                px-2
                py-1
                text-white
                bg-gray-600
                transition
            ']) }}
            >