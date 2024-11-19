<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'size' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'about' => ['required', 'string'],
            // Validate các trường trong bảng address
            'province_id' => ['required'],
            'district_id' => ['required'],
            'ward_id' => ['required'],
            'specific_address' => ['required', 'string', 'max:255'],
        ];
    }
}
