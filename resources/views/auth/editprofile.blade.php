<x-layout>    
    <div class="min-h-screen flex mt-20 justify-center">        
        <form action="{{ route('updateprofile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2  class="text-xl font-semibold mb-4">Edit your account</h2>
            
            <div>
                <input type="file" class="form-control" id="image"  name="image" accept="image/*">
            </div>

            <x-input label="Name" name="name" type="text" value="{{ old('name', $user->name) }}"/>
            <x-input label="Email" name="email" type="email" value="{{ old('email', $user->email) }}"/>
            <x-input label="Enter your new Password" name="password" type="password" />
            <x-input label="Confirm your new Password" name="password_confirmation" type="password" />
            <x-button>Update</x-button>
            
        </form>
    </div>
</x-layout>