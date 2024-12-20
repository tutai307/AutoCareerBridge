<?php

namespace App\Http\Requests\Fields;

use Illuminate\Foundation\Http\FormRequest;

class FieldsRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'name' => ['required', 'string', 'max:255', 'unique:fields,name'],
                'slug' => ['required', 'string', 'max:255', 'unique:fields,slug'],
                'description' => ['max:255'],
            ];
        } else {
            return [
                'name' => ['required', 'string', 'max:255', 'unique:fields,name,' . $this->route('field')],
                'slug' => ['required', 'string', 'max:255', 'unique:fields,slug,' . $this->route('field')],
                'description' => ['max:255'],
            ];
        }
    }
}
