<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'max:15'],
            'birth_date' => [
                'required',
                'date',
                'before_or_equal:' . today()->subYears(18)->toDateString(),
            ],
            'department_id' => ['nullable', 'integer', 'min:1'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'role' => ['nullable','in:manager,employee,teacher,student,exam_officer',],
        ];
    }
}
