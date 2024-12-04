<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
        $id = $this->route('student');
        $idExist = (bool) $id;
        
        if ($idExist) {
            return [
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'slug' => ['required', 'string', 'max:255', 'unique:students,slug,' . $id],
                'student_code' => ['required', 'string', 'max:15', 'unique:students,student_code,' . $id],
                'email' => ['required', 'email', 'max:255', 'unique:students,email,' . $id],
                'phone' => ['required', 'regex:/^(\+84 ?)?\d{9,10}$/'],
                'gender' => ['required', 'integer', Rule::in([MALE_GENDER, FEMALE_GENDER])],
                'date_range' => ['required'],
                'description' => ['nullable', 'string'],
                'avatar_path' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'major_id' => ['required', 'exists:majors,id'],
            ];
        } else {
            return [
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'slug' => ['required', 'string', 'max:255', 'unique:students,slug'],
                'student_code' => ['required', 'string', 'max:15', 'unique:students,student_code'],
                'email' => ['required', 'email', 'max:255', 'unique:students,email'],
                'phone' => ['required', 'regex:/^(\+84 ?)?\d{9,10}$/'],
                'gender' => ['required', 'integer', Rule::in([MALE_GENDER, FEMALE_GENDER])],
                'date_range' => ['required'],
                'description' => ['nullable', 'string'],
                'avatar_path' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'major_id' => ['required', 'exists:majors,id'],
            ];
        }
    }
}
