<x-layout :pageClass="''" :bgColor="$board->color">
<x-slot:sidebar>
    
</x-slot:sidebar>
    <div class="pb-80">
        <div class=" flex flex-wrap items-center justify-between p-4 border-b mb-2 border-gray-400 ">
            
            <div class="justify-between">
            <h2 class="text-4xl pb-4 font-bold " >{{ $board->name }}</h2>
            <p>{{    $board->discription   }}</p>
            </div>
            

            @if(auth()->id() === $board->user_id)
                <div class="flex items-center gap-3">
                    <form  class="flex items-center gap-3">
                        @csrf
                        <!-- <x-input-share-board name="email" value="username@gmail.com"></x-input-share-board> -->
                        <a href="{{    route('boards.shareBoard', $board->id)   }}" :active="request()->is('share')"  class="hover:text-white hover:dark:bg-gray-900 hover:shadow-xl p-1 rounded-lg text-3xl fa-solid fa-share-from-square"></a>
                        
                    </form>
                    <form action="{{    route('boards.destroy', $board->id)   }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"   class="hover:text-white hover:dark:bg-gray-600 hover:shadow-xl p-1 rounded-lg text-3xl fa-solid fa-trash-can"></button>
                    </form>
                </div>
            @else()
                <div class="flex items-center gap-3">
                    <form  class="flex items-center gap-3">
                        @csrf
                        <!-- <x-input-share-board name="email" value="username@gmail.com"></x-input-share-board> -->
                        <p title="You Cannot Share This Board" class=" text-gray-600  p-1 rounded-lg text-3xl fa-solid fa-share-from-square"></p>
                          
                        
                    </form>
                    <p title="You Cannot Delete This Board" class=" text-gray-600  p-1 rounded-lg text-3xl fa-solid fa-trash-can">
                        
                          
                    </p>
                </div>
            @endif
            
            
        <!-- To Do, In progress, Done ---------------------- -->
        </div>
        <div class="board grid grid-cols-3 gap-4 items-start">
            <div class="bg-[#fdf0d5] status-table  border-b border-gray-500 hover:scale-105 transition-transform duration-500 rounded-sm p-4 mr-4 max-w-90" 
                 data-status="todo">
                <div class="border-b border-gray-400">
                    <h3 class="text-xl font-semibold mb-3">To Do</h3>
                </div>
                    <div>
                        @foreach($Tasks ->where('status',   'todo') as $task)
                            
                            <div  class="flex justify-between bg-gray-100 mt-2 task items-center px-3 py-2 rounded-sm mb-2 hover:shadow-xl hover:scale-105 transition-transform duration-500 border-gray-600 pl-2 cursor-grabbing" 
                                draggable=true
                                data-id="{{ $task->id   }}">

                                <div class="flex items-center">
                                    <i class="fa-solid fa-circle mr-2 text-gray-600"></i>
                                    <div>
                                        <div class="text-xl font-semibold">{{    $task->title   }}</div>
                                        <div class="text-sm">{{  $task->discription  }}</div>
                                        <div class="text-xs text-gray-600"><i class="fa-regular fa-calendar"></i> {{  $task->due_date }} | {{  $task->category }} | <i class="fa-regular fa-flag"></i> {{  $task->priority }}</div>
                                    </div>
                                </div>
                                <div>
                                    @if(auth()->id() === $board->user_id)
                                        <form action="{{ route('tasks.edit', $task->id) }} " method="GET" >
                                            @csrf
                                            
                                            <button type="submit"   class=" hover:text-white hover:dark:bg-gray-600 hover:shadow-xl p-1 rounded-lg text-3xl  text-gray-600"><i class="fa-solid fa-pen-to-square "></i></button>
                                        </form>
                                        <form action="{{ route('tasks.delete', $task->id) }} " method="POST" >
                                            @csrf
                                            
                                            <button type="submit"   class=" hover:text-white hover:dark:bg-gray-600 hover:shadow-xl p-1 rounded-lg text-3xl  text-gray-600"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    @else
                                    <form  >
                                        @csrf
                                        
                                        <p type="submit"   class="  p-1 rounded-lg text-3xl  text-gray-300"><i class="fa-solid fa-pen-to-square "></i></p>
                                    </form>
                                    <form>
                                        @csrf
                                        
                                        <p type="submit"   class="  p-1 rounded-lg text-3xl  text-gray-300"><i class="fa-solid fa-trash-can"></i></p>
                                    </form>
                                    @endif
                                </div>
                            
                            </div>
                        @endforeach
                    
                    </div>
                    
                
            </div>
            <div class="bg-[#fdf0d5] status-table  border-b border-gray-500 hover:scale-105 transition-transform duration-500 rounded-sm p-4 mr-4 max-w-90" 
                 data-status="in_progress">
                <div class="border-b border-gray-400">
                    <h3 class="text-xl font-semibold mb-3">In Progress</h3>
                </div>
                    <div>
                        @foreach($Tasks ->where('status',   'in_progress') as $task)
                            
                            <div  class="flex justify-between bg-gray-100 mt-2 task items-center px-3 py-2 rounded-sm mb-2 hover:shadow-xl hover:scale-105 transition-transform duration-500 border-gray-600 pl-2 cursor-grabbing" 
                                draggable=true
                                data-id="{{ $task->id   }}">

                                <div class="flex items-center">
                                    <i class="fa-solid fa-circle mr-2 text-gray-600"></i>
                                    <div>
                                        <div class="text-xl font-semibold">{{    $task->title   }}</div>
                                        <div class="text-sm">{{  $task->discription  }}</div>
                                        <div class="text-xs text-gray-600"><i class="fa-regular fa-calendar"></i> {{  $task->due_date }} | {{  $task->category }} | <i class="fa-regular fa-flag"></i> {{  $task->priority }}</div>
                                    </div>
                                </div>
                                <div>
                                    @if(auth()->id() === $board->user_id)
                                        <form action="{{ route('tasks.edit', $task->id) }} " method="GET" >
                                            @csrf
                                            
                                            <button type="submit"   class=" hover:text-white hover:dark:bg-gray-600 hover:shadow-xl p-1 rounded-lg text-3xl  text-gray-600"><i class="fa-solid fa-pen-to-square "></i></button>
                                        </form>
                                        <form action="{{ route('tasks.delete', $task->id) }} " method="POST" >
                                            @csrf
                                            
                                            <button type="submit"   class=" hover:text-white hover:dark:bg-gray-600 hover:shadow-xl p-1 rounded-lg text-3xl  text-gray-600"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    @else
                                    <form  >
                                        @csrf
                                        
                                        <p type="submit"   class="  p-1 rounded-lg text-3xl  text-gray-300"><i class="fa-solid fa-pen-to-square "></i></p>
                                    </form>
                                    <form>
                                        @csrf
                                        
                                        <p type="submit"   class="  p-1 rounded-lg text-3xl  text-gray-300"><i class="fa-solid fa-trash-can"></i></p>
                                    </form>
                                    @endif
                                </div>
                            
                            </div>
                        @endforeach
                    
                    </div>
                    
                
            </div>
            <div class="bg-[#fdf0d5] status-table  border-b border-gray-500 hover:scale-105 transition-transform duration-500 rounded-sm p-4 mr-4 max-w-90" 
                 data-status="done">
                <div class="border-b border-gray-400">
                    <h3 class="text-xl font-semibold mb-3">Done</h3>
                </div>
                    <div>
                        @foreach($Tasks ->where('status',   'done') as $task)
                            
                            <div  class="flex justify-between bg-gray-100 mt-2 task items-center px-3 py-2 rounded-sm mb-2 hover:shadow-xl hover:scale-105 transition-transform duration-500 border-gray-600 pl-2 cursor-grabbing" 
                                draggable=true
                                data-id="{{ $task->id   }}">

                                <div class="flex items-center">
                                    <i class="fa-solid fa-circle mr-2 text-gray-600"></i>
                                    <div>
                                        <div class="text-xl font-semibold">{{    $task->title   }}</div>
                                        <div class="text-sm">{{  $task->discription  }}</div>
                                        <div class="text-xs text-gray-600"><i class="fa-regular fa-calendar"></i> {{  $task->due_date }} | {{  $task->category }} | <i class="fa-regular fa-flag"></i> {{  $task->priority }}</div>
                                    </div>
                                </div>
                                <div>
                                    @if(auth()->id() === $board->user_id)
                                        <form action="{{ route('tasks.edit', $task->id) }} " method="GET" >
                                            @csrf
                                            
                                            <button type="submit"   class=" hover:text-white hover:dark:bg-gray-600 hover:shadow-xl p-1 rounded-lg text-3xl  text-gray-600"><i class="fa-solid fa-pen-to-square "></i></button>
                                        </form>
                                        <form action="{{ route('tasks.delete', $task->id) }} " method="POST" >
                                            @csrf
                                            
                                            <button type="submit"   class=" hover:text-white hover:dark:bg-gray-600 hover:shadow-xl p-1 rounded-lg text-3xl  text-gray-600"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    @else
                                        <form  >
                                            @csrf
                                            
                                            <p type="submit"   class="  p-1 rounded-lg text-3xl  text-gray-300"><i class="fa-solid fa-pen-to-square "></i></p>
                                        </form>
                                        <form>
                                            @csrf
                                            
                                            <p type="submit"   class="  p-1 rounded-lg text-3xl  text-gray-300"><i class="fa-solid fa-trash-can"></i></p>
                                        </form>
                                    @endif
                                </div>
                            
                            </div>
                        @endforeach
                    
                    </div>
                    
                
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded",   ()  =>  {
            let dragged =   null;

            document.querySelectorAll('.task').forEach(task =>  {
                task.addEventListener('dragstart', e   =>  {
                    dragged =   e.target;
                    dragged.classList.add('dragging');
                });

                task.addEventListener('dragend',    e   =>  {
                    dragged.classList.remove('dragging')
                });
            });

            document.querySelectorAll('.status-table').forEach(one  =>  {
                one.addEventListener('dragover',    e   =>{
                    e.preventDefault();
                });

                one.addEventListener('drop',    e   =>  {
                    e.preventDefault();
                    one.appendChild(dragged);

                    const   id  =   dragged.dataset.id;
                    const   status  =   one.dataset.status;

                    fetch('/task/update',   {
                        method: "POST",
                        headers:    {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        
                        },
                        body:   JSON.stringify({    id, status  })
                    });
                });
            });
        });
    </script>
    <!-- <div class="justify-between">
        <p><strong></strong>{{    $board->discription   }}</p>
    </div>
     -->
    <div class="fixed bottom-4 right-4 rounded-xl h-[160px] w-[1000px] dark:bg-gray-900 shadow-md border-t p-4 flex items-center gap-3">
        
            <form action="{{ route('tasks.store',   $board->id) }}" method="POST" class="flex w-full items-center gap-3">
                @csrf
                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <x-input-task name="title"  label="Title"   type="text"></x-input-task>
                        <x-input-task name="discription"  label="Discription"   type="text"></x-input-task>
                    </div>
                    <div>
                        <x-select name="priority" label="Priority">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            
                        </x-select>

                        <x-input-task name="category" label="Category" type="text"></x-input-task>

                    </div>
                    <div>
                        
                        <x-input-task name="due_date" label="Due Date" type="date"></x-input-task>

                        <x-select name="status" label="Status">
                            <option value="todo">To Do</option>
                            <option value="in_progress">In progress</option>
                            <option value="done">Done</option>
                            
                        </x-select>

                    </div>
                </div>
                    
                <input type="hidden" name="board_id" value="{{ $board->id }}">

           


                <button type="submit" class="ml-auto flex items-center gap-3 text-white text-lg font-semibold px-3 py-2 rounded-lg hover:text-white hover:bg-gray-600 hover:shadow-xl hover:inset-shadow">
                    <i class="text-3xl mr-1 fa-solid fa-solid fa-plus"></i>
                    <span>Add task </span>
                </button>
            </form>
    </div>

</x-layout>