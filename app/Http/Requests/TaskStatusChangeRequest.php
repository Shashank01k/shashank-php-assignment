<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStatusChangeRequest extends FormRequest
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
            //
            'data.status' => 'required|string|in:Pending,In-Progress,Completed'
        ];
    }
    public function messages()
    {
        return [
            'data.status.required' => 'The status field is required.',
            'data.status.string' => 'The status field should be string.',
            'data.status.unique' => 'The status has already been taken.'
        ];
    }
}
