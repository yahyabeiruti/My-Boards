<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateProfileReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return auth()->check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user   =   auth()->user();

        return [
            
                'name'  =>  'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password'=>'nullable|string|min:8|confirmed',
                'image' =>  'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];
        
    }
}
