<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'password' => ['required', 'min:8', 'regex:/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'password_confirmation.required' => 'Vui lòng nhập xác nhận mật khẩu !',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 8 ký tự, một chữ cái hoa, một chữ cái thường, một số và một ký tự đặc biệt !',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự !',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải có ít nhất 8 ký tự !',
            'password_confirmation.same' => 'Mật khẩu nhập không khớp nhau !',
        ];
    }
}
