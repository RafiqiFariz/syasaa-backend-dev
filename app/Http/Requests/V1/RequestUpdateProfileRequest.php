<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class RequestUpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows(['update_profile_request_create', 'update_profile_request_update']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'student_id' => 'required|exists:students,id',
            'image' => 'required|mimes:jpg,jpeg,png|max:10240',
            'changed_data' => 'required|string',
            'change_to' => 'required|string',
            'description' => 'nullable|string',
        ];

        if ($this->isMethod('PUT') && $this->user()->role_id === 1) {
            $rules['status'] = 'required|in:pending,accepted,rejected';
        }

        return $rules;
    }
}
