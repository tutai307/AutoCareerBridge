<?php

namespace App\Http\Requests\University;

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

        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('students', 'slug')->ignore($id)->withoutTrashed()],
            'student_code' => ['required', 'string', 'max:15', 'regex:/^(?=.*[a-zA-Z0-9])[a-zA-Z0-9\-_]+$/', Rule::unique('students', 'student_code')->ignore($id)->withoutTrashed()],
            'email' => ['required', 'email', 'max:255', Rule::unique('students', 'email')->ignore($id)],
            'phone' => ['required', 'regex:/^(0(2\d{8,9}|3\d{8}|5\d{8}|7\d{8}|8\d{8}|9\d{8}))$/', 'numeric', Rule::unique('students', 'phone')->ignore($id)->withoutTrashed()],
            'gender' => ['required', 'integer', Rule::in([MALE_GENDER, FEMALE_GENDER])],
            'date_range' => ['required'],
            'description' => ['nullable', 'string'],
            'avatar_path' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'major_id' => ['required', 'exists:majors,id'],
            'skill_name' => ['required', 'array', 'min:1', 'distinct'],
            'skill_name.*' => ['string', 'max:242'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $skillNames = $this->input('skill_name', []);

            if (count($skillNames) !== count(array_unique($skillNames))) {
                $attributeName = __('validation.attributes.skill_name');
                $validator->errors()->add('skill_name', __('validation.distinct', ['attribute' => $attributeName]));
            }
        });
    }
}
