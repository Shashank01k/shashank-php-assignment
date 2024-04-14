<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUnAssignRequest extends FormRequest
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
            'data' => 'required|array',
            'data.user_id' => 'required|integer',
            'data.task_id.*' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'The :attribute field is required.',
            'data.array' => 'The :attribute must be an array.',
            'data.user_id.required' => 'The user_id field is required.',
            'data.user_id.integer' => 'The user_id must be an integer.',
            'data.task_id.required' => 'The task_id field is required.',
            'data.task_id.integer' => 'Each task_id must be an integer.'
        ];
    }
}
