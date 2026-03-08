<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeTaskReq extends FormRequest
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
        return [
            'title' =>  'required|string|max:255',
            'discription'   =>  'nullable|string|max:500', 
            'priority'  =>  'string',  
            'due_date'  =>  'nullable|date', 
            'category'  =>  'nullable|string|max:255', 
            'status'    =>  'required|string', 
            'board_id'  =>  'required|integer'
        ];
    }
}
