<?php

namespace App\Http\Requests\Majors;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:majors,name'],
            'slug' => ['required', 'string', 'max:255', 'unique:majors,slug'],
            'field_id' => ['required', 'integer', 'exists:fields,id'],
        ];
    }
}
