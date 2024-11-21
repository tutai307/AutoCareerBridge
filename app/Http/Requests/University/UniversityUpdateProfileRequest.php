<?php

namespace App\Http\Requests\University;

use Illuminate\Foundation\Http\FormRequest;

class UniversityUpdateProfileRequest extends FormRequest
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
        $universityId = $this->route('university'); // Lấy ID của trường học từ route

        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|',
            'website' => 'nullable|url',
            'specific_address' => 'required|string|max:255',
            'intro' => 'nullable|string',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên trường là bắt buộc.',
            'slug.required' => 'Slug URL là bắt buộc.',
            'website.url' => 'Website phải là một URL hợp lệ.',
            'specific_address.required' => 'Địa chỉ cụ thể là bắt buộc.',
            'intro.string' => 'Cần có giới thiệu trường học.',
            'description.string' => 'Cần có mô tả trường học.',
        ];
    }
}
