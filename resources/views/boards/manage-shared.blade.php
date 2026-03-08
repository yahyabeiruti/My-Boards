<x-layout :pageClass="''" :bgColor="'#fdf0d5'">
<x-slot:sidebar>
    
</x-slot:sidebar>

<div class="pb-80">
        <div class=" flex flex-wrap items-center justify-between p-4 border-b mb-2 border-gray-400 ">
            
            <div class="justify-between">
            <h2 class="text-4xl pb-4 font-bold " >Manage Shared Boards</h2>
            <p></p>
            </div>
            
        </div>

        <div>
        
            @foreach($sharedBoards as $board)
                    <div class="mb-5 border border-gray-500 p-5 shadow-sm rounded-xl background
                                    transition-all duration-300
                                    hover:shadow-lg " 
                            onmouseover="this.style.background='{{ $board->color }}';"
                            onmouseout="this.style.background='none'; ">

                            <h4 class="text-2xl font-semibold mb-1 text-gray-800">
                                {{ $board->name }}
                            </h4>
                            <div class="text-m">
                            <p class="mb-3">Shared With:</p>
                            @foreach($board->sharedUsers as $user)
                                <div class="mb-5 flex items-center justify-between border border-gray-300 p-5 shadow-sm rounded-xl hover:shadow-lg hover:scale-102 transition-transform duration-500">
                                {{ $user->name }} ({{$user->email}})
                                <form action="{{    route('boards.remove-share', [ 'board' => $board->id, 'user' => $user->id ] )  }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"   class="hover:text-white hover:dark:bg-gray-600 hover:shadow-xl transition-transform p-1 rounded-lg text-3xl fa-solid fa-xmark"></button>
                                </form>
                                </div>
                            
                            
                            @endforeach
                            </div>
                    </div>
            @endforeach
        
        </div>

</div>


</x-layout>

