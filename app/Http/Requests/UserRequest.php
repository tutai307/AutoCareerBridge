<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route('user');
        $idExist = (bool) $id;
        if ($idExist) {
            return [
                'user_name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-z0-9_]+$/', Rule::unique('users', 'user_name')->ignore($id)->withoutTrashed()],
                'password' => ['nullable', 'min:8', 'max:25', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!$@#%&*?])[A-Za-z\d!$@#%&*?]{8,}$/', 'confirmed'],
            ];
        } else {
            return [
                'user_name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-z0-9_]+$/', Rule::unique('users', 'user_name')->withoutTrashed()],
                'password' => ['required', 'min:8', 'max:25', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!$@#%&*?])[A-Za-z\d!$@#%&*?]{8,}$/', 'confirmed'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->withoutTrashed()],
                'role' => ['required', Rule::in([ROLE_SUB_ADMIN, ROLE_COMPANY, ROLE_UNIVERSITY])],
            ];
        }
    }
}
