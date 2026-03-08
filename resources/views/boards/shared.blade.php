<x-layout :pageClass="'' " :bgColor="'#fdf0d5'" >

<x-slot:sidebar>
    
</x-slot:sidebar>

<div class="max-w-3xl mx-auto space-y-6">
    @if($boards -> isEmpty())

        <div class="min-h-screen mt-20 justify-center text-center py-14">
            <p class="text-3xl font-bold text-gray-700">
                No Boards Are Shared With You Yet.
            </p>
            <p class="text-gray-500 mt-2">
                You're all caught up!
            </p>
        </div>

    @else

        <div>
            @foreach($boards as $board)
                <div    div    class="mb-5 border border-gray-300 p-5 shadow-sm rounded-xl background
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
                    <a href="{{ route('boards.show', $board->id) }}"
                       class="text-sm font-medium text-gray-800 underline hover:text-gray-600">
                        View Board
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>



</x-layout>