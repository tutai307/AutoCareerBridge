<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AcademicAffairsRequest extends FormRequest
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
        if ($this->isMethod('post'))
            return [
                'full_name' => ['required', 'string', 'max:255'],
                'user_name' => ['required', 'regex:/^(?=.*[a-zA-Z])[a-z0-9_]+$/i', 'unique:users', 'min:3', 'max:255'],
                'phone' => ['required','unique:hirings', 'regex:/^(\+84 ?)?\d{10}$/'],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->whereNull('deleted_at'); // Bỏ qua các bản ghi bị xóa mềm
                    }),
                ],
                'password' => ['required', 'min:8', 'string', 'confirmed', 'regex:/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/'],
            ];

        if ($this->isMethod('put')) {
            return [
                'full_name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'regex:/^(\+84 ?)?\d{10}$/'],
            ];
        }
        return [];
    }







    public function messages(): array
    {
        return [
            'full_name.required' => 'Tên đầy đủ không được để trống.',
            'user_name.required' => 'Tên đăng nhập không được để trống.',
            'user_name.unique' => 'Tên đã được sử dụng.',
            'user_name.regex' => 'Tên phải là chữ thường không ký tự đăc biệt.',
            'user_name.min' => 'Tên phải có ít nhất 3 ký tự.',
            'user_name.max' => 'Tên phải không quá 225 ký tự.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'phone.unique' => 'Số điện thoại đã được sử dụng.',
            'email.required' => 'Email không được để trống.',
            'email.unique' => 'Địa chỉ email này đã tồn tại.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu từ 8-25 ký tự, chứa ít nhất một chữ cái hoa, chữ cái thường, số và ký tự đặc biệt.',


        ];
    }
}
