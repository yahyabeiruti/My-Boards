<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeTaskReq;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Console\View\Components\Tasks;


class TaskController extends Controller
{
    // public  function    index()
    // {
    //     $user   =   auth()->user()->id;

    //     $tasksTimeLine  = Task::whereIN('board_id', boardIds)->orderBy('due_date', 'asc')->get();
    //     return view('task.timeline',    compact('tasksTimeLine'));
    // }

    public function create(Request  $request)
    {
        return  view('boards.show');
    }

    public function store(storeTaskReq $validate, $boardId)
    {
        // dd('STORE HIT', $request->all());

        // $validated  =   $request->validate([
        // 'title' =>  'required|string|max:255',
        // 'discription'   =>  'nullable|string|max:500', 
        // 'priority'  =>  'string',  
        // 'due_date'  =>  'nullable|date', 
        // 'category'  =>  'nullable|string|max:255', 
        // 'status'    =>  'required|string', 
        // 'board_id'  =>  'required|integer'
        // ]);
        
        $validated = $validate -> validated();

        $validated['board_id']  =   $boardId; 

        Task::create($validated);

        return redirect()->route('boards.show', $boardId);
    }    

    public  function    updateStatus(Request    $request)
    {
        $tasks  =   Task::find($request ->  id);

        if(!$tasks)
        {
            return  response()->json(['error' =>  'task not found'],    404);
        }

        $tasks->status  =   $request->status;
        $tasks->save();

        return  response()->json(['success' => true]);

    }

    public function destroy(Task $task)
    {
        $task = Task::find($task -> id);

        $task->delete();

        return redirect()->back();
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        return view('boards.edit-task', compact('task'));
    }

    public function updateTask(Request $request, $taskId)
    {
        $validated  =   $request->validate([
            'title' =>  'required|string|max:255',
            'discription'   =>  'nullable|string|max:500', 
            'priority'  =>  'string',  
            'due_date'  =>  'nullable|date', 
            'category'  =>  'nullable|string|max:255', 
            'status'    =>  'required|string', 
        ]);
            

            $task = Task::findOrFail($taskId);

            $task -> update($validated);
    
            return redirect()->route('boards.show', $task->board_id);
    }
}

