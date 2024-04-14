<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskAssignRequest extends FormRequest
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
            
            'data' => 'required|array',
            'data.task_id' => 'required|integer',
            // 'data.task_id' => [
            //     'required',
            //     'integer',
            //     Rule::unique('users_tasks')->where(function ($query) {
            //         // Get task_id and user_id from the request data
            //         $task_id = $this->input('data.task_id');
            //         $user_id = $this->input('data.user_id');
    
            //         // Add where conditions for task_id and user_id
            //         return $query->where('task_id', $task_id)->whereIn('user_id', $user_id);
            //     }),
            // ],
            'data.user_id' => 'required|array',
            'data.user_id.*' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'The :attribute field is required.',
            'data.array' => 'The :attribute must be an array.',
            'data.task_id.required' => 'The task_id field is required.',
            'data.task_id.integer' => 'The task_id must be an integer.',
            'data.user_id.required' => 'The user_id field is required.',
            'data.user_id.array' => 'The user_id must be an array.',
            'data.user_id.*.integer' => 'Each user_id must be an integer.'
        ];
    }

}
