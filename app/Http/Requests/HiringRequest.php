<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HiringRequest extends FormRequest
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
                'user_name' => ['required', 'regex:/^[a-z0-9_]+$/', 'unique:users', 'min:3', 'max:255'],
                'phone' => ['required', 'unique:hirings', 'regex:/^(\+84 ?)?\d{10}$/'],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->whereNull('deleted_at'); // Bỏ qua các bản ghi bị xóa mềm
                    }),
                ],
                'avatar_path' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'password' => ['required', 'string', 'confirmed','regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$@#%])[a-zA-Z0-9!$@#%]{8,25}$/'
            ],
            ];

        if ($this->isMethod('put')) {
            return [
                'full_name' => ['required', 'string', 'max:255'],
                'avatar_path' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'phone' => ['required', 'regex:/^(\+84 ?)?\d{10}$/'],
            ];
        }
        return [];
    }
}
