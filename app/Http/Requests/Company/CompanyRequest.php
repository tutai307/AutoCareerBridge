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
    public function rules($id = null): array
    {
        $user = auth('admin')->user();
        $company = $user->company;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                $id
                    ? 'unique:companies,slug,' . $id
                    : ($company
                    ? 'unique:companies,slug,' . $company->id
                    : 'unique:companies,slug')
            ],
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

            ...(($id || $company ? [] : [
                'phone' => [
                    'required',
                    'numeric',
                    'digits:10',
                    'regex:/^0[0-9]{9}$/'
                ]
            ]))
        ];
    }
}
