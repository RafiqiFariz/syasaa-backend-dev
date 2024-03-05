<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('user_update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->request->get('id')),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|min:10|unique:users,phone',
            'role_id' => 'required|exists:roles,id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name tidak boleh kosong',
            'name.string' => 'Name harus berupa string',
            'name.max' => 'Name maksimal 255 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.string' => 'Email harus berupa string',
            'email.email' => 'Email harus berupa email',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'password.confirmed' => 'Password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
            'password.string' => 'Password harus berupa string',
            'phone.string' => 'Phone harus berupa string',
            'phone.min' => 'Phone minimal 10 karakter',
            'phone.unique' => 'Phone sudah terdaftar',
            'role_id.required' => 'Role tidak boleh kosong',
            'role_id.exists' => 'Role tidak ditemukan'
        ];
    }
}
