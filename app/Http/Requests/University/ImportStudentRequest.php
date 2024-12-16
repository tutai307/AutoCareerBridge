<?php

namespace App\Http\Requests\University;

use App\Models\Major;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rule;

class ImportStudentRequest extends FormRequest
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
            'student_code' => ['required', 'string', 'max:15', 'regex:/^(?=.*[a-zA-Z0-9])[a-zA-Z0-9\-_]+$/', 'unique:students,student_code'],
            'major' => ['required', 'string', 'min:3', 'max:255', function ($attribute, $value, $fail) {
                if (!Major::where('name', $value)->exists()) {
                    $fail(Lang::get('validation.exists', ['attribute' => Lang::get('validation.attributes.major')]));
                }
            }],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'phone' => ['required', 'regex:/^(0(2\d{8,9}|3\d{8}|5\d{8}|7\d{8}|8\d{8}|9\d{8}))$/', 'unique:students,phone'],
            'gender' => ['required', 'string', Rule::in(['nam', 'nữ'])],
            'entry_year' => ['required', 'date_format:U'],
            'graduation_year' => ['nullable', 'date_format:U', function ($attribute, $value, $fail) {
                if ($value < $this->input('6')) {
                    $fail(Lang::get('validation.date_after', ['attribute' => Lang::get('validation.attributes.graduation_year'), 'date' => Lang::get('validation.attributes.entry_year_lower')]));
                }
            }],
        ];
    }
}
