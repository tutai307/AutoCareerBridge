<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'user_name' => ['required', 'regex:/^[a-z0-9_]+$/', 'unique:users', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => ['required', 'min:8', 'regex:/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/'],
            'password_confirmation' => ['required', 'same:password'],
            'role' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Tên không được để trống.',
            'user_name.unique' => 'Tên đã được sử dụng.',
            'user_name.regex' => 'Tên đăng nhập phải là chữ thường và không chứa ký tự đặc biệt',
            'user_name.min' => 'Tên phải có ít nhất 3 ký tự.',
            'user_name.max' => 'Tên phải không quá 225 ký tự.',
            'email.regex' => 'Email không đúng định dạng.',
            'email.email' => 'Email phải là địa chỉ email hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'email.required' => 'Email không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống.',
            'password.regex' => 'Mật khẩu từ 8-25 ký tự, chứa ít nhất một chữ cái hoa, chữ cái thường, số và ký tự đặc biệt.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải có ít nhất 8 ký tự.',
            'password_confirmation.same' => 'Mật khẩu nhập lại không khớp.',
            'role' => 'Vai trò không được bỏ trống.',
        ];
    }
}
