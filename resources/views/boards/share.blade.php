<x-layout :pageClass="''" :bgColor="'#fdf0d5'" >
<x-slot:sidebar>
    
</x-slot:sidebar>
<div class="min-h-screen flex flex-col items-center mt-6 gap-6">
    <div class="">
        @if($board->sharedUsers->count())
        <div class="max-w-md p-4 shadow-md border border-gray-400 rounded-lg">
            <h3 class="text-lg font-semibold mb-3">Users You've Sent Requsts To:</h3>
                <ul class="space-y-2">
                    @foreach($board->sharedUsers as $user)
                    

                        <li class="p-3 flex justify-between gap-5 items-center text-sm border border-gray-400 shadow-sm rounded-lg">
                            <div>
                                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                <p class="font-medium text-gray-500">{{ $user->email }}</p>
                            </div>
                            <span class="w-20 text-xs px-2 py-1 rounded
                                    @if($user->pivot->status === 'accepted')bg-green-200
                                    @elseif($user->pivot->status === 'pending')bg-yellow-200
                                    @else bg-red-200
                                    @endif">
                                    @if($user->pivot->status === 'accepted')    
                                    
                                        <i class="fa-solid fa-check "></i>
                                        Accepted
                                    
                                    @elseif($user->pivot->status === 'pending')
                                    
                                        <i class="fa-solid fa-hourglass-half "></i>
                                        Pending
                                    
                                    @elseif($user->pivot->status === 'rejected') 
                                    
                                        <i class="fa-solid fa-xmark "></i>
                                        Rejected
                                    
                                    @endif
                            </span>

                        </li>
                    @endforeach
                </ul>
        </div>
        @endif
    </div>
    <form method="POST" action="{{    route('boards.share', $board->id)   }}">
        @csrf
        <x-input class="border-black" label="User Email" name="email" type="email" value="{{ old('email') }}"/>
        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100 rounded-xl">
                @foreach($errors->all() as $error)
                    <li class="alert alert-danger">{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <button class="px-4 py-2 mt-3 border border-2 font-medium border-gray-900 hover:bg-gray-900 text-gray-900 hover:text-white rounded-md" type="submit">Share</button>
    </form>
</div>

</x-layout>