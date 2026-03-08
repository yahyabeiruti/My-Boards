
    <aside class="w-80 bg-gray-900 text-white px-6 py-8 space-y-6 min-h-screen">
                    
        <nav class="space-y-2 block" >
            @auth
            <a  href="{{ route('boards.index')  }}" 
                class="flex items-center justify-center gap-3 py-2 px-3 border-r-4 pl-2 border-l-4  pr-2 text-white  hover:bg-gray-700 rounded-lg ">
                @if(auth()->user()->image)
                <img src="{{  asset('storage/' . auth()->user()->image) }}" 
            
                class="h-8 rounded-full" alt="Profile image" >
                @endif
                <span class="">
                    {{ Auth::User()->name }}
                </span>
            </a>

            <a  href="{{ route('show.request') }}"
                class="flex items-center justify-center gap-3 py-2 px-3 border-r-4 pl-2 border-l-4  pr-2 text-white  hover:bg-gray-700 rounded-lg ">
                Shared Requests
            </a>

            <a href="{{ route('boards.shared') }}" 
               class="flex items-center justify-center gap-3 py-2 px-3 border-r-4 pl-2 border-l-4  pr-2 text-white  hover:bg-gray-700 rounded-lg ">
               Shared With Me
            </a>

            <a href="{{ route('boards.manage-shared') }}" 
               class="flex items-center justify-center gap-3 py-2 px-3 border-r-4 pl-2 border-l-4  pr-2 text-white  hover:bg-gray-700 rounded-lg ">
               Boards I’ve Shared
            </a>

            @endauth
        </nav>
        {{ $slot }}

        @auth
            <div class="mt-8 pb-8">
            <a href="{{ route('boards.create')  }}" 
            class="flex items-center gap-3 w-full text-white text-lg font-semibold px-3 py-2 rounded hover:bg-gray-700">
                <i class="fa-solid fa-plus"></i>
                <span>Create Board</span>
            </a>
            </div>
        @endauth
    </aside>
