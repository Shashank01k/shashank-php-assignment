<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
        //
        return [
            //
            'data.*.name' => 'required|string|max:255',
            'data.*.email' => 'required|string|email|max:255|unique:users,email',
            'data.*.title' => 'nullable|string|max:255',
            'data.*.password' => 'required|string|min:6|confirmed',
            'data.*.description' => 'nullable|string|regex:/^[a-zA-Z0-9\s.,\-]+$/',
            'data.*.status' => 'required|string|in:Pending,In-Progress,Completed',
            'data.*.due_date' => 'required|date|date_format:Y-m-d|after:today',
        ];
    }

    public function messages()
    {

        // $daa = $this->rules();
        // print_R($daa);
        return [
            'data.*.name.required' => 'The name field is required.',
            'data.*.email.required' => 'The email field is required.',
            'data.*.email.email' => 'The email must be a valid email address.',
            'data.*.email.unique' => 'The email has already been taken.',
            'data.*.password.required' => 'The password field is required.',
            'data.*.password.min' => 'The password must be at least :min characters.',
            'data.*.password.confirmed' => 'The password confirmation does not match.',
            'data.*.description.regex' => 'The description may only contain letters, numbers, and whitespace characters.',
            'data.*.status.required' => 'The status field is required.',
            'data.*.status.in' => 'The selected status is invalid.',
            'data.*.due_date.required' => 'The due date field is required.',
            'data.*.due_date.date' => 'The due date must be a valid date.',
            'data.*.due_date.date_format' => 'The due date format should be Y-m-d Ex:'.date('Y-m-d'),
            'data.*.due_date.after' => 'The due date must be a date after today.',
        ];
    }
}
