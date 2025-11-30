<x-layout :pageClass="''" :bgColor="'#fdf0d5'">
    
<x-slot:sidebar>
    @auth
    
        @foreach($Boards as $board) 
        <a href="{{ route('boards.show',$board->id)}}" 
        class="block px-3 py-2 rounded hover:bg-gray-700 border-r-2 pl-2 border-l-2 " style="border-color: {{ $board->color }};"
        onmouseover="this.style.background='{{ $board->color }}';   this.style.color='black'"
        onmouseout="this.style.background='none';   this.style.color='inherit';">
        {{ $board->name }} </a> 
        @endforeach
        
    @endauth    
</x-slot:sidebar>

<div class="timeline border-l-4 border-gray-500 pl-4 ml-6 space-y-6">

    @foreach($tasksTimeLine as $task)
        
        <div class="relative">
            

            <p class="text-lg text-gray-600"><i class="mr-2 text-gray-400 fa-solid fa-circle"></i>{{ $task->due_date }}</p>

            <div class="p-3 bg-gray-900 rounded-lg border border-gray-600">
                <h4 class="text-white text-lg font-semibold">{{ $task->title }}</h4>
                <p class="text-gray-300">{{ $task->discription }}</p>
                <p class="text-sm text-gray-400">Board: {{ $task->board->name }}</p>
            </div>

        </div>
    @endforeach

</div>

</x-layout>
