<?php

namespace App\Http\Controllers;

use App\Models\AddTask;
use Illuminate\Http\Request;


abstract class Controller
{
    // public function store(Request $request)
    // {
    //     $validated  =   $request->validate([
    //         'name' =>  'required|string|max:255',
    //         'color' =>  'required|string',
    //         'discription'   =>  'nullable|string|max:500',
    //         'user_id'   =>  'required|integer'
    //     ]);

    //     AddTask::create($validated);
    //     return redirect()->route('boards.index');
    // }
}
