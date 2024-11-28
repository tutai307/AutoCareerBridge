<?php

namespace App\Http\Requests\Company;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
        $id = $this->route('id');

        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'slug' => ['required', 'string', 'min:3', 'max:255'],
            'detail' => ['required', 'string'],
            'major_id' => ['required', 'exists:majors,id'],
            'end_date' => ['required', 'date', 'after_or_equal:today'],
            'skill_name' => ['required', 'array', 'min:1'],
            'skill_name.*' => ['string', 'max:242'],
        ];

        if ($id) {
            $rules['slug'][] = 'unique:jobs,slug,' . $id;
        } else {
            $rules['slug'][] = 'unique:jobs,slug';
        }

        return $rules;
    }
}
