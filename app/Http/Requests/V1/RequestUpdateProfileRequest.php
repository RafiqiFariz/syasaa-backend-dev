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
        return [
            'student_id' => 'required|exists:students,id',
            'changed_data' => 'required|string',
            'old_value' => 'required_unless:changed_data,image|string',
            'new_value' => 'required_unless:changed_data,image|string',
            'image' => 'required_if:changed_data,image|mimes:jpg,jpeg,png|max:5120',
            'description' => 'nullable|string',
        ];
    }
}
