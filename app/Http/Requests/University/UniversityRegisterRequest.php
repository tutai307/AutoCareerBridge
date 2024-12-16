<?php

namespace App\Http\Requests\University;

use Illuminate\Foundation\Http\FormRequest;

class UniversityRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:universities,slug,' . $this->route('user_id'),
            'abbreviation' => 'required|string|max:255',
            'website' => 'nullable|required|url|unique:universities,website_link,' . $this->route('user_id'),
            'province' => ['required'],
            'district' => ['required'],
            'ward' => ['required'],
            'specific_address' => ['required', 'string', 'max:255'],
            'intro' => 'nullable|required|string',
            'description' => 'nullable|required|string',
        ];
    }

    public function messages(): array 
    {
        return [
            'name.required' => 'Tên trường không được để trống.',
            'slug.required' => 'Slug URL không được để trống.',
            'slug.unique' => 'Slug URL này đã tồn tại',
            'abbreviation.required' => 'Tên viết tắt không được để trống.',
            'website.required' => 'Website nhà trường không được để trống.',
            'website.url' => 'Website phải là một URL hợp lệ.',
            'website.unique' => 'Website đã tồn tại.',
            'province' => 'Tỉnh/Thành phố không được để trống',
            'district' => 'Quận/Huyện không được để trống',
            'ward' => 'Phường/Xã không được để trống',
            'specific_address.required' => 'Địa chỉ cụ thể không được để trống.',
            'intro.required' => 'Giới thiệu trường học không được để trống.',
            'description.required' => 'Mô tả trường học không được để trống.',
        ];
    }
}
