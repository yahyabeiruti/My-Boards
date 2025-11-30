<x-layout>    
    <div class="min-h-screen flex mt-20 justify-center">        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h2  class="text-xl font-semibold mb-4">Register your new account</h2>
            <x-input label="Name" name="name" type="text" value="{{ old('name') }}"/>
            <x-input label="Email" name="email" type="email" value="{{ old('email') }}"/>
            <x-input label="Password" name="password" type="password" />
            <x-input label="Confirm Password" name="password_confirmation" type="password" />
            <x-button>Register</x-button>
            @if ($errors->any())
                <ul class="px-4 py-2 bg-red-100">
                    @foreach($errors->all() as $error)
                        <li class="my-2 text-red-500">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>
</x-layout>