<?php

namespace App\Http\Requests\Company;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'slug' => ['required', 'string', 'min:3', 'max:255', Rule::unique('jobs', 'slug')->ignore($id)],
            'detail' => ['required', 'string'],
            'major_id' => ['required', 'exists:majors,id'],
            'end_date' => ['required', 'date', 'after_or_equal:today'],
            'skill_name' => ['required', 'array', 'min:1', 'distinct'],
            'skill_name.*' => ['string', 'max:242'],
        ];
    }
    
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $skillNames = $this->input('skill_name', []);
        
            if (count($skillNames) !== count(array_unique($skillNames))) {
                $attributeName = __('validation.attributes.skill_name');
                $validator->errors()->add('skill_name', __('validation.distinct', ['attribute' => $attributeName]));
            }
        });
    }
}
