<?php

namespace App\Http\Controllers;

use App\Models\Boards;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\AddTask;

class BoardsController extends Controller
{
    public function index()
    {
        $user   =   auth()->user()->id;

        $boards =   Boards::query()->where('user_id',$user)->get();

        $boardId    =   $boards->pluck('id');

        $tasksTimeLine  =   AddTask::whereIN('board_id', $boardId)->orderBy('due_date', 'asc')->get();

        return view('boards.index',
        ["Boards"=>$boards,  
        "tasksTimeLine" =>   $tasksTimeLine
        ]);
    }

    public function show($id)
    {
        $board = Boards::findOrFail($id);
    
        $Boards = Boards::where('user_id', auth()->id())->get();

        $Task   =   AddTask::where('board_id',  $id)->get();
    
        return view('boards.show', [
            'board' => $board,
            'Boards' => $Boards,
            'Tasks' =>  $Task,
        ]);
    }
    
    public function create()
    {

        return view('boards.create');
        
    }

    public function store(Request $request)
    {
        $validated  =   $request->validate([
            'name' =>  'required|string|max:255',
            'color' =>  'required|string',
            'discription'   =>  'nullable|string|max:500',
            'user_id'   =>  'required|integer'
        ]);

        Boards::create($validated);
        return redirect()->route('boards.index');
    }

    public function edit(Boards $board)
    {
    }

    public function update(Request $request, Boards $board)
    {
    }

    public function destroy(Boards $board)
    {
        $board->delete();

        return redirect()->route('boards.index');
    }
}
