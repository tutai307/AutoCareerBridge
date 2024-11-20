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
                'date_range' => ['nullable', 'regex:/to/'],
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
                'date_range' => ['nullable', 'regex:/to/'],
                'description' => ['nullable', 'string'],
                'avatar_path' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'major_id' => ['required', 'exists:majors,id'],
            ];
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Họ và tên là bắt buộc.',
            'name.string' => 'Họ và tên phải là một chuỗi ký tự.',
            'name.min' => 'Họ và tên phải có ít nhất 3 ký tự.',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            
            'slug.required' => 'Bạn cần nhập họ tên và mã sinh viên để có slug.',
            'slug.string' => 'Slug phải là một chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại.',
            
            'student_code.required' => 'Mã sinh viên là bắt buộc.',
            'student_code.string' => 'Mã sinh viên phải là một chuỗi ký tự.',
            'student_code.max' => 'Mã sinh viên không được vượt quá 15 ký tự.',
            'student_code.unique' => 'Mã sinh viên đã tồn tại.',
            
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email phải có định dạng hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',
            
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            
            'gender.required' => 'Giới tính không được để trống.',
            'gender.integer' => 'Giới tính không hợp lệ.',
            'gender.in' => 'Giới tính không hợp lệ.',
            
            'date_range.regex' => 'Cần chọn cả ngày ra trường".',
            
            'description.string' => 'Mô tả phải là một chuỗi ký tự.',
            
            'avatar_path.image' => 'Ảnh đại diện phải là một bức ảnh hợp lệ.',
            'avatar_path.mimes' => 'Ảnh đại diện phải có định dạng jpeg, jpg, png.',
            'avatar_path.max' => 'Ảnh đại diện không được vượt quá 2MB.',
            
            'major_id.required' => 'Ngành học là bắt buộc.',
            'major_id.exists' => 'Ngành học không tồn tại.',
        ];
    }
}
