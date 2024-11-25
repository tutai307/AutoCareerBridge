<?php

namespace App\Http\Requests\Workshop;

use Illuminate\Foundation\Http\FormRequest;

class WorkshopEditRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:work_shops,name,' . $this->route('workshop')],
            'slug' => ['required', 'string', 'max:255', 'unique:work_shops,slug,' . $this->route('workshop')],
            'content' => ['required', 'string'],
            'avatar_path' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,svg,webp', 'max:2048'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d H:i:s'], // Định dạng ngày hợp lệ
            'end_date' => ['required', 'date', 'after:start_date', 'date_format:Y-m-d H:i:s'],
            'amount' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên workshop là bắt buộc.',
            'name.string' => 'Tên workshop phải là chuỗi ký tự.',
            'name.max' => 'Tên workshop không được vượt quá 255 ký tự.',
            'name.unique' => 'Tên workshop tồn tại.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.string' => 'Slug phải là chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại.',
            'content.required' => 'Nội dung là bắt buộc.',
            'content.string' => 'Nội dung phải là chuỗi ký tự.',
            'avatar_path.image' => 'Ảnh đại diện phải là một bức ảnh hợp lệ.',
            'avatar_path.mimes' => 'Ảnh đại diện phải có định dạng jpeg, jpg, png.',
            'avatar_path.max' => 'Ảnh đại diện không được vượt quá 2MB.',
            'start_date.required' => 'Ngày bắt đầu là bắt buộc.',
            'end_date.required' => 'Ngày kết thúc là bắt buộc.',
            'end_date.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu.',
            'amount.required' => 'Số lượng là bắt buộc.',
            'amount.numeric' => 'Số lượng phải là số.',
        ];
    }
}
