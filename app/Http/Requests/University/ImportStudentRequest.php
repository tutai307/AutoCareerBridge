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
            'student_code' => ['required', 'string', 'max:15', 'regex:/^(?=.*[a-zA-Z0-9])[a-zA-Z0-9\-_]+$/', Rule::unique('students', 'student_code')],
            'major' => ['required', 'string', 'min:3', 'max:255',
                function ($attribute, $value, $fail) {
                    if (!Major::where('name', $value)->exists()) {
                        $fail(__('validation.exists', [
                            'attribute' => __('validation.attributes.major'),
                        ]));
                    }
                },
            ],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('students', 'email') ],
            'phone' => ['required', 'regex:/^(0(2\d{8,9}|3\d{8}|5\d{8}|7\d{8}|8\d{8}|9\d{8}))$/', Rule::unique('students', 'phone')],
            'gender' => ['required', 'string', Rule::in(['nam', 'nữ'])],
            'entry_year' => ['required', 'date_format:U' ],
            'graduation_year' => ['nullable', 'date_format:U',
                function ($attribute, $value, $fail) {
                    if ($value < $this->input('entry_year')) {
                        $fail(__('validation.date.after', [
                            'attribute' => __('validation.attributes.graduation_year'),
                            'date' => __('validation.attributes.entry_year_lower'),
                        ]));
                    }
                },
            ],
            'skills' => ['required', 'string',
                function ($attribute, $value, $fail) {
                    $skills = array_map('trim', explode(',', $value));

                    foreach ($skills as $skill) {
                        if (strlen($skill) < 3 || strlen($skill) > 242) {
                            $fail(__('validation.skill_length', ['skill' => $skill]));
                        }
                    }

                    if (count($skills) !== count(array_unique($skills))) {
                        $fail(__('validation.skill_duplicate'));
                    }
                },
            ],
        ];
    }

    public function prepareForValidation()
    {
        if (is_string($this->skills)) {
            $skills = collect(explode(',', $this->skills))
                ->map(fn($item) => trim($item))
                ->filter() // Loại bỏ phần tử rỗng (nếu có)
                ->values() // Reset lại chỉ số mảng
                ->toArray();

            $this->merge(['skills' => $skills]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $skills = $this->input('skills', []);

            // Kiểm tra trùng lặp trong mảng skills
            if (count($skills) !== count(array_unique($skills))) {
                $attributeName = __('validation.attributes.skills');
                $validator->errors()->add('skills', __('validation.distinct', ['attribute' => $attributeName]));
            }
        });
    }
}
