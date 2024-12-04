<?php

namespace App\Http\Requests\University;

use Illuminate\Foundation\Http\FormRequest;

class UniversityUpdateImageRequest extends FormRequest
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
            'university_image' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ];
    }

    public function messages(): array 
    {
        return [
            'university_image.image' => "Trường này phải là ảnh!",
            'university_image.mimes:jpeg,png,jpg,gif,webp' => "Trường ảnh này phải có đuôi jpeg,png,jpg,gif!",
            'university_image.max' => "Trường ảnh này cần dung lượng không quá 2MB!",
        ];
    }
}
