<x-layout :pageClass="'' " :bgColor="'#fdf0d5'" >
<x-slot:sidebar>
    
</x-slot:sidebar>
<div class="max-w-3xl mx-auto space-y-6">
    @if($requests -> isEmpty())

        <div class="min-h-screen mt-20 justify-center text-center py-14">
            <p class="text-3xl font-bold text-gray-700">
                No pending requests
            </p>
            <p class="text-gray-500 mt-2">
                You're all caught up!
            </p>
        </div>

    @else

        @foreach ($requests as $board)
        
            <div    class="border border-gray-300 p-5 shadow-sm rounded-xl background
                            transition-all duration-300
                            hover:shadow-lg " 
                    onmouseover="this.style.background='{{ $board->color }}';"
                    onmouseout="this.style.background='none'; ">
                
                <h4 class="text-lg font-semibold mb-1 text-gray-800">
                    {{ $board->name }}
                </h4>
                <p class="text-sm font-medium text-gray-600">
                    Owner: <span class="font-medium text">{{ $board->User->name}}</span> | Email: <span class="font-medium text">{{ $board->User->email}}</span>
                </p>

                <div class="flex gap-3 ">
                    <form action="{{ route('accept.request', $board->id) }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 mt-3 bg-gray-900 hover:bg-gray-700 text-white rounded-md">
                            Approve
                        </button>
                    </form>
                    <form action="{{ route('reject.request', $board->id) }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 mt-3 border border-gray-900 hover:bg-gray-900 text-gray-900 hover:text-white rounded-md">
                            Decline
                        </button>
                    </form>
                </div>

            </div>
        
        @endforeach
</div>
@endif







</x-layout>