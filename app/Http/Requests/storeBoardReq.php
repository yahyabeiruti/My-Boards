<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeBoardReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user_id = auth()->user()->id;

        return [
            'name' =>  'required|string|max:255',
            'color' =>  'required|string',
            'discription'   =>  'nullable|string|max:500',
            'user_id' => $user_id
        ];
    }
}
