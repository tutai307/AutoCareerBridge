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

    public function messages()
    {
        return [
            '0.required' => 'Mã sinh viên không được để trống',
            '0.string' => 'Mã sinh viên phải là chuỗi ký tự',
            '0.max' => 'Mã sinh viên quá dài',
            '0.unique' => 'Mã sinh viên đã tồn tại',
            '1.required' => 'Ngành không được để trống',
            '2.required' => 'Tên không được để trống',
            '2.string' => 'Tên phải là chuỗi ký tự',
            '2.min' => 'Tên quá ngắn',
            '2.max' => 'Tên quá dài',
            '3.required' => 'Email không được để trống',
            '3.email' => 'Email không hợp lệ',
            '3.max' => 'Email quá dài',
            '3.unique' => 'Email đã tồn tại',
            '4.required' => 'Số điện thoại không được để trống',
            '4.regex' => 'Số điện thoại không hợp lệ',
            '5.required' => 'Giới tính không được để trống',
            '5.in' => 'Giới tính không hợp lệ',
            '6.required' => 'Năm vào học không được để trống',
            '6.date_format' => 'Năm vào học không hợp lệ',
            '7.required' => 'Năm tốt nghiệp không được để trống',
            '7.date_format' => 'Năm tốt nghiệp không hợp lệ',
        ];
    }
}
