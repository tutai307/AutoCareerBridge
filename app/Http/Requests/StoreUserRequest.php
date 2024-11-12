<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'user_name' => ['required', 'string', 'min:3', 'max:255', 'unique:users,user_name'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in([ROLE_ADMIN, ROLE_COMPANY, ROLE_UNIVERSITY])],
        ];
    }

    public function messages(): array
    {
        return [
            'user_name.required' => 'Tên đăng nhập là bắt buộc.',
            'user_name.string' => 'Tên đăng nhập phải là một chuỗi ký tự.',
            'user_name.min' => 'Tên đăng nhập phải có ít nhất 3 ký tự.',
            'user_name.max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',
            'user_name.unique' => 'Tên đăng nhập đã tồn tại.',

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 255 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',

            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email phải có định dạng hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',

            'role.required' => 'Vai trò là bắt buộc.',
            'role.in' => 'Vai trò không hợp lệ.',
        ];
    }
}
