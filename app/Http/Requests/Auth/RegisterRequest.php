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
            'user_name' => ['required', 'regex:/^[a-z0-9_]+$/i', 'unique:users', 'min:3','max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => ['required', 'min:8', 'regex:/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/'],
            'password_confirmation' => ['required', 'same:password'],
            'role' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Vui lòng nhập tên đăng nhập !',
            'user_name.unique' => 'Tên người dùng đã được sử dụng !',
            'user_name.regex' => 'Tên phải là chữ thường không ký tự đăc biệt !',
            'user_name.min' => 'Tên phải có ít nhất 3 ký tự !',
            'user_name.max' => 'Tên phải không quá 225 ký tự !',
            'email.regex' => 'Nhập email đúng định dạng email !',
            'email.email' => 'Trường email phải là địa chỉ email hợp lệ !',
            'email.unique' => 'Email đã được sử dụng !',
            'email.required' => 'Vui lòng nhập email !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'password_confirmation.required' => 'Vui lòng nhập mật khẩu confirm mật khẩu !',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 8 ký tự, một chữ cái hoa, một chữ cái thường, một số và một ký tự đặc biệt !',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự !',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải có ít nhất 8 ký tự !',
            'password_confirmation.same' => 'Mật khẩu nhập không khớp nhau !',
            'role' => 'Vui lòng chọn trường này !',
        ];
    }
}
