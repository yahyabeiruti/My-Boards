<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginReq;
use App\Http\Requests\StoreRegister;

use App\Http\Requests\updateProfileReq;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function showRegisterPage() {
        return view('auth.register');
    }
    
    public function showLoginPage() {
        return view('auth.login');
    }

    public function Register(StoreRegister $validate) {
        // $validated  =   $request->validate([
        //     'name'  =>  'required|string|max:255',
        //     'email' =>  'required|email|unique:users',
        //     'password'=>'required|string|min:8|confirmed'
        // ]);
        
        $user = User::create($validate-> validated());

        Auth::login($user);

        return redirect('/');
    }
    
    public function login(LoginReq $validate) {
        // $validated  =   $request->validate([
        //     'email' =>  'required|email',
        //     'password'=>'required|string'
        // ]);
        
        $validated = $validate -> validated();

        // if (Auth::attempt($validate)){  -----> this line is wrong because attempt expects an array
        if (Auth::attempt($validated)){
            $validate->session()->regenerate();

            return redirect('/');

        }

        throw ValidationException::withMessages([
            'credintials' => 'Sorry, Incorrect credintials'
        ]);

        // $service = new AuthService();

        // $approved = $service -> login($validated, $request);

        // if($approved)

    
    }
    
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');

    }
    public function editprofile()
    {
        $user = auth()->user();
        return view('auth.editprofile', compact('user'));
    }
    public  function    updateprofile(updateProfileReq $validate, Request   $request)
    {
        $user   =   auth()->user();

        // $validated  =   $request->validate([
        //     'name'  =>  'required|string|max:255',
        //     'email' => 'required|email|unique:users,email,' . $user->id,
        //     'password'=>'nullable|string|min:8|confirmed',
        //     'image' =>  'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        // ]);

        $validated = $validate -> validated();

        if($request->hasFile('image')){
            if($user->image){
                Storage::disk('public')->delete($user->image);
            }

            $path   =   $request->file('image')->store('profile', 'public');
            $validated['image']   =   $path;
        }

        if(!$request->filled('password'))   {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect('/');

    }
    
}
