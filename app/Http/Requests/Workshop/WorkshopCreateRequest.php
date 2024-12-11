<?php

namespace App\Http\Requests\Workshop;

use Illuminate\Foundation\Http\FormRequest;

class WorkshopCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:work_shops,name'],
            'slug' => ['required', 'string', 'max:255', 'unique:work_shops,slug'],
            'content' => ['required', 'string'],
            'avatar_path' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,svg,webp', 'max:2048'],
            'start_date' => ['required'],
            'end_date' => ['required', 'after:start_date'],
            'amount' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên hội thảo không được để trống.',
            'name.string' => 'Tên hội thảo phải là chuỗi ký tự.',
            'name.max' => 'Tên hội thảo không được vượt quá 255 ký tự.',
            'name.unique' => 'Tên hội thảo tồn tại.',
            'slug.required' => 'Slug không được để trống.',
            'slug.string' => 'Slug phải là chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại.',
            'content.required' => 'Nội dung không được để trống.',
            'content.string' => 'Nội dung phải là chuỗi ký tự.',
            'avatar_path.image' => 'Ảnh đại diện phải là một bức ảnh hợp lệ.',
            'avatar_path.mimes' => 'Ảnh đại diện phải có định dạng jpeg, jpg, png.',
            'avatar_path.max' => 'Ảnh đại diện không được vượt quá 2MB.',
            'avatar_path.required' => 'Ảnh đại diện không được để trống.',
            'start_date.required' => 'Thời gian bắt đầu không được để trống.',
            'end_date.required' => 'Thời gian kết thúc không được để trống.',
            'end_date.after' => 'Thời gian kết thúc phải lớn hơn thời gian bắt đầu.',
            'amount.required' => 'Số lượng không được để trống.',
            'amount.numeric' => 'Số lượng phải là số.',
        ];
    }
}
