<?php

namespace App\Services;

use App\Mail\Approved;
use App\Mail\Declined;
use App\Models\Boards;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
// use App\Http\Controllers\Auth;
use App\Models\Task;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BoardService
{

    public function index(int $user)
    {
        $boards =   Boards::query()->where('user_id',$user)->get();

        $boardId    =   $boards->pluck('id');

        $tasksTimeLine  =   Task::whereIN('board_id', $boardId)->orderBy('due_date', 'asc')->get();

        return [
            "Boards"=>$boards,  
            "tasksTimeLine" =>   $tasksTimeLine
        ];
    }

    public function show($userId)
    {        
        $board = Boards::with(['Tasks', 'sharedUsers'])->findOrFail($userId);       

        $tasks   =   $board->Tasks;

        return [
            'board' => $board,
            'Tasks' =>  $tasks, 
        ];
    }

    public function store($validated)
    {
        Boards::create($validated);
    }

    public function share($sender ,$reciever , $board)
    {
       
        if ($reciever->id === $sender->id) {
            return ([
                'status' => false,
                'message' => 'You cannot share the board whith yourself!'
            ]);
        }
        elseif (!$reciever->id) {
            return ([
                'status' => false,
                'message' => 'No such user'
            ]);
        }
        elseif ($sender->id !== $board->user_id) {
            return ([
                'status' => false,
                'message' => 'You Do Not own this board, and you cannot share it with other users'
            ]);
        }
        elseif ($board->sharedUsers()->where('user_id', $reciever->id)->exists()){
            return ([
                'status' => false,
                'message' => 'You cannot share the board whith the same user twice'
            ]);
        }
        else{
            $board->sharedUsers()->attach($reciever->id, [
                'status' => 'pending',
                
            ]);
            return([
                'status' => true,
                'message' => 'share request sent!'
            ]);
        }
        // if ($reciever->id === $sender->id) { abort( 403, 'You cannot share the board whith yourself!'); };
    }

    public function acceptRequest($userId, $boardId, $board)
    {
        \DB::table('board_user')
            ->where('board_id', $boardId)
            ->where('user_id', $userId)
            ->update(['status' => 'accepted']);

        Mail::to($board->user->email)->send(
            new Approved(
                $board->name,
                auth()->user()->name
            )
            );
    }

    public function rejectRequest($userId, $boardId, $board)
    {
        \DB::table('board_user')
            ->where('board_id', $boardId)
            ->where('user_id', $userId)
            ->update(['status' => 'rejected']);
        Mail::to($board->user->email)->send(
            new Declined(
                $board->name,
                auth()->user()->name
            )
            );
    }

    
}
