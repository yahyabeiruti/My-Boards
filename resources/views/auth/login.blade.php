<x-layout>    
    <div class="min-h-screen flex mt-20 justify-center">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <h2 class="text-xl font-semibold mb-4">Login to your account</h2>
            <x-input class="border-black" label="Email" name="email" type="email" value="{{ old('email') }}"/>
            <x-input label="Password" name="password" type="password" />
            <x-button>Login</x-button>

            @if ($errors->any())
                <ul class="px-4 py-2 bg-red-100 rounded-xl">
                    @foreach($errors->all() as $error)
                        <li class="my-2 text-red-500">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>
</x-layout>