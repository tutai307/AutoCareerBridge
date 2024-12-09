<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

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
        $company = $user->company;

        if (!$company) {
            return [
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255','unique:companies,slug' ],
                'phone' => ['required', 'numeric'],
                'size' => ['required', 'numeric'],
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

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255','unique:companies,slug,' . $company->id],
            'size' => ['required', 'numeric'],
            'map' => ['nullable', 'string'],
            'fields' => ['required', 'array', 'exists:fields,id'],
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
