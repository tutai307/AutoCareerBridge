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
            return [
               'full_name' => 'required|string|max:255',
                'phone' => 'required|digits:10',
                'user_name'=>  'required|string|max:255',
                'email'=>  'required|email|unique:users,email|max:255',
                'password'=>  'required|string|min:8|confirmed|regex:/[A-Z]/|regex:/[^a-zA-Z0-9]/',
            ];
          
        }
    
    public function messages(): array
    {
        return [
            'full_name.required' => 'Vui lòng nhập tên đầy đủ.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.digits' => 'Số điện thoại không hợp lệ.',
            'user_name.required' => 'Vui lòng nhập tên người dùng.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.unique' => 'Địa chỉ email này đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 chữ viết hoa và 1 ký tự đặc biệt.'
      
        ];
    }
}
