<?php

namespace App\Http\Requests;

use App\Utils\ViewUserUtils;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UserSearchRequest extends FormRequest
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


    
    // Alternatively, you can use the Carbon class directly
    
    
    public function rules(): array
    {
        return [
            'data' => 'required|array',
            'data.*' => 'nullable',
            'data.assigned_user_id' => 'nullable|integer',
            'data.status' => 'nullable|string|in:Pending,In-Progress,Completed',
            'data.due_date' => 'nullable|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'The data field is required.',
            'data.array' => 'The data must be an array.',
            'data.status.in' => 'The :attribute field must be one of: Pending, In-Progress, Completed.',
            'data.status.string' => 'The :attribute field must be string.',
            'data.due_date' => 'The due date must be a date after today, due date format should be Y-m-d Ex:'.date('Y-m-d')
        ];
    }
}
