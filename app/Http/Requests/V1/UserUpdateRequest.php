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
        $id = $this->request->get('id');
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => [
                'nullable',
                'string',
                'min:10',
                Rule::unique('users', 'phone')->ignore($id),
            ],
            'role_id' => 'required|exists:roles,id',
            'faculty_id' => 'required_if:role_id,2|exists:faculties,id',
            'address' => 'required_if:role_id,3|string',
            'class_id' => 'required_if:role_id,4|exists:classes,id',
        ];
    }
}
