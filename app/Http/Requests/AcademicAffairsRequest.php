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
                'full_name' => ['required','string','max:255'],
                'user_name' => ['required', 'regex:/^(?=.*[a-zA-Z])[a-z0-9_]+$/i', 'unique:users', 'min:3', 'max:255'],
                'phone' => ['required', 'regex:/^(\+84 ?)?\d{9,10}$/'],
                'email' => ['required','email','unique:users','email','max:255'],
                'password' => ['required', 'min:8','string','confirmed', 'regex:/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/'],
            ];
        
        if ($this->isMethod('put')) {
            return [
              'full_name' => ['required','string','max:255'],
              'phone' => ['required', 'regex:/^(\+84 ?)?\d{9,10}$/'],
            ];
        }
            return [];
        }
        
 
        
    

    

    public function messages(): array
    {
        return [
            'full_name.required' => 'Vui lòng nhập tên đầy đủ.',
            'user_name.required' => 'Tên không được để trống.',
            'user_name.unique' => 'Tên đã được sử dụng!',
            'user_name.regex' => 'Tên phải là chữ thường không ký tự đăc biệt!',
            'user_name.min' => 'Tên phải có ít nhất 3 ký tự!',
            'user_name.max' => 'Tên phải không quá 225 ký tự!',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.unique' => 'Địa chỉ email này đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 chữ viết hoa và 1 ký tự đặc biệt.',

      
        ];
    }
}