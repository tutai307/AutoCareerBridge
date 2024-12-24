<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
        $user = auth('admin')->user();
        $companyId = $user->company?->id;
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('companies', 'slug')->ignore($companyId)],
            'size' => ['required', 'min:2', 'numeric'],
            'avatar_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            'phone' => ['required','numeric','digits:10','regex:/^0[0-9]{9}$/'],
            'fields' => ['required', 'array', 'exists:fields,id'],
            'map' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'about' => ['required', 'string'],
            'website_link' => ['nullable', 'url'],
            'province_id' => ['required'],
            'district_id' => ['required'],
            'ward_id' => ['required'],
            'specific_address' => ['required', 'string', 'max:255'],
        ];
    }
}
