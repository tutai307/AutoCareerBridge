<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'min:3', 'max:255'],
            'password' => ['required', 'min:8', 'regex:/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.min' => 'Trường này phải có ít nhất 3 ký tự',
            'email.max' => 'Trường này không được quá 255 ký tự',
            'email.required' => 'Trường không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password_confirmation.required' => 'Vui lòng nhập mật khẩu confirm mật khẩu !',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 8 ký tự, một chữ cái hoa, một chữ cái thường, một số và một ký tự đặc biệt !',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự !',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải có ít nhất 8 ký tự !',
            'password_confirmation.same' => 'Mật khẩu nhập không khớp nhau !',
        ];
    }
}
