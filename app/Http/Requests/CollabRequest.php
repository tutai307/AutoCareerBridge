<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollabRequest extends FormRequest
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
            'university_id' => ['nullable', 'exists:universities,id'],
            'company_id' => ['nullable', 'exists:companies,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'status' => ['nullable'],
            'start_date' => ['nullable', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:' . now()->addMonths(3)->toDateString()],
        ];
    }
}
