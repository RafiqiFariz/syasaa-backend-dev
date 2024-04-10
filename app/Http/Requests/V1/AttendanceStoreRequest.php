<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class AttendanceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows(['attendance_create', 'attendance_update']);
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
            'course_class_id' => 'required|exists:course_class,id',
            'attendance_request_id' => 'nullable|exists:attendance_requests,id',
            'student_image' => 'required|image|max:10240',
            'lecturer_image' => 'required|image|max:10240',
            'is_present' => 'required|boolean',
        ];
    }
}
