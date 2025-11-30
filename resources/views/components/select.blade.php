@props(['label',    'name'])

<label for="$name" class="block mb-1 font-medium text-white">{{ $label }}</label>

<select name="{{ $name  }}"
        {{  $attributes->merge([
            'class' =>  '
                mt-1
                mb-2
                block
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
        {{  $slot   }}
        </select>