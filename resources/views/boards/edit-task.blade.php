<x-layout :pageClass="''" :bgColor="'#fdf0d5'">
<x-slot:sidebar>
    
</x-slot:sidebar>
    <div class=" flex mt-15 justify-center">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" >
            @csrf
            <x-input-edit-task name="title"  label="Title"   type="text" :value="old('title', $task->title)"></x-input-edit-task>
            <x-input-edit-task name="discription"  label="Discription"   type="text" :value="old('discription', $task->discription)"></x-input-edit-task>

            <x-edit-task-select label="Priority" type="text" name="priority" :value="old('title', $task->priority)">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </x-edit-task-select>
            <x-input-edit-task label="Category" type="text" name="category" :value="old('category', $task->category)"></x-input-edit-task>

            <x-input-edit-task label="Due Date" type="date" name="due_date" :value="old('due_date', $task->due_date)"></x-input-edit-task>
            <x-edit-task-select class="mb-4" label="Status" type="text" name="status" :value="old('status', $task->status)">
                <option value="todo">To Do</option>
                <option value="in_progress">In progress</option>
                <option value="done">Done</option>
            </x-edit-task-select>

            <x-button class="bg-rose-500 hover:bg-rose-700 mt-4">Update</x-button>

        </form>
    </div>
</x-layout>

