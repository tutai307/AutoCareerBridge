<?php

namespace App\Http\Requests\University;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImportStudentRequest extends FormRequest
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
            '0' => ['required', 'string', 'max:15', 'unique:students,student_code'],
            '1' => ['required'],
            '2' => ['required', 'string', 'min:3', 'max:255'],
            '3' => ['required', 'email', 'max:255', 'unique:students,email'],
            '4' => ['required', 'regex:/^(\+84 ?)?\d{9,10}$/'],
            '5' => ['required', 'string', Rule::in(['nam', 'nữ'])],
            '6' => ['required', 'date_format:U'],
            '7' => ['required', 'date_format:U'],
        ];
    }
}
