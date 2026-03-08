<?php

namespace App\Http\Controllers;

use App\Http\Requests\shareBoardReq;
use App\Http\Requests\storeBoardReq;
use App\Mail\Approved;
use App\Mail\Declined;
use App\Models\Boards;
use App\Models\User;
use App\Services\BoardService;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
// use App\Http\Controllers\Auth;
use App\Models\Task;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BoardsController extends Controller
{
    public function index()
    {
        $user   =   auth()->user()->id;

        if(!$user)
        {
            return view('auth.login');
        }

        $service = new BoardService();

        $serviceData = $service->index($user);

        return view('boards.index',
        ["Boards"=> $serviceData['Boards'],  
        "tasksTimeLine" =>   $serviceData['tasksTimeLine']
        ]);
    }

    public function show($id)
    {
        $service = new BoardService();

        $serviceData = $service->show($id);
        
        return view('boards.show', [
            'board' => $serviceData['board'],
            'Tasks' =>  $serviceData['Tasks'], 
        ]);
    }
    
    public function create()
    {

        return view('boards.create');
        
    }

    public function store(storeBoardReq $validate, Request $request)
    {
        // $validated  =   $request->validate([
        //     'name' =>  'required|string|max:255',
        //     'color' =>  'required|string',
        //     'discription'   =>  'nullable|string|max:500'
        // ]);
        // $user_id = auth()->user()->id;

        // $validated['user_id'] = $user_id;
            
        $validated = $validate -> validated();

        $service = new BoardService();

        $serviceData = $service->store($validated);

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

    public function shareBoard(Boards $board)
    {
        $board->load('sharedUsers');

        return view('boards.share')->with('board', $board);
    }

    public function share(shareBoardReq $validate, Boards $board)
    {
        // $validated  =   $request->validate([
        //     'email' =>  'required|email|exists:users,email'
        // ]);

        $validated = $validate -> validated();

        $reciever = User::where('email', $validated['email'])->first();

        $sender = Auth::user();

        $service = new BoardService();

        // $service->share($sender ,$reciever , $board);

        $result = $service->share($sender ,$reciever , $board);

        if ($result['status'] == false)
        {
            return back()->withErrors([
                'email' => $result['message']
        ]);
        };

        

        return redirect()->route('boards.show', $board->id)->with('success', 'Boared share request sent!');

    }

    // public function showRequestPage()
    // {
    //     return view('boards.request');
    // }

    public function showRequestPage()
    {
        $requests = auth()->user()->sharedBoards()
        ->wherePivot('status', 'pending')->with('user')->get();

        return view('boards.request', ['requests' => $requests]);
    }

    public function acceptRequest(Boards $board)
    {
        $userId = Auth::id();
        $boardId = $board->id;

        $service = new BoardService();

        $service -> acceptRequest($userId, $boardId, $board);

        
        return redirect()->route('show.request')->with('success', 'Request have been accepted, access granted.');

    }

    public function rejectRequest(Boards $board)
    {
        $userId = Auth::id();
        $boardId = $board->id;
        // $boardOwner = $board->email;

        $service = new BoardService();

        $service -> rejectRequest($userId, $boardId, $board);
        
        
        return redirect()->route('show.request')->with('reject', 'Request have been rejected, access denied.');
    }

    public function listSharedBoards()
    {
        $boards = auth()->user()->sharedBoards()->wherePivot('status', 'accepted')->with('user')->get();
        
        return view('boards.shared', ['boards' => $boards]);
    }

    public function viewManageBoards() 
    {
        $user = auth()->user();

        $sharedBoards = Boards::where('user_id', $user->id)->whereHas('sharedUsers')->with('sharedUsers')->get();

        return view('boards.manage-shared', [
            'sharedBoards' => $sharedBoards,
            
        ]);
    }

    public function removeShare(Boards $board, User $user)
    {
        $board -> sharedUsers()->detach($user->id);

        return redirect()->back();

    }


    
}
