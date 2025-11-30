<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddTask;
use Illuminate\Console\View\Components\Task;


class TaskController extends Controller
{
    public  function    index()
    {
        $user   =   auth()->user()->id;
        
        

        $tasksTimeLine  =   AddTask::whereIN('board_id', boardIds)->orderBy('due_date', 'asc')->get();

        return view('task.timeline',    compact('tasksTimeLine'));
    }

    public function create(Request  $request)
    {
        $tasks =   AddTask::orderBy('created_at','desc')->get();

        return  view('boards.show');
    }

public function store(Request $request, $boardId)
    {
        // dd('STORE HIT', $request->all());

        $validated  =   $request->validate([
        'title' =>  'required|string|max:255',
        'discription'   =>  'nullable|string|max:500', 
        'priority'  =>  'string',  
        'due_date'  =>  'nullable|date', 
        'category'  =>  'nullable|string|max:255', 
        'status'    =>  'required|string', 
        'board_id'  =>  'required|integer'
        ]);
    $validated['board_id']  =   $boardId;

    AddTask::create($validated);

    return redirect()->route('boards.show', $boardId);
    }    

    public  function    updateStatus(Request    $request)
    {
        $tasks  =   AddTask::find($request ->  id);

        if(!$tasks)
        {
            return  response()->json(['error' =>  'task not found'],    404);
        }

        $tasks->status  =   $request->status;
        $tasks->save();

        return  response()->json(['success' => true]);

    }
    
}

