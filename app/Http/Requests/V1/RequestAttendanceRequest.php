<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class RequestAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows(['attendance_request_create', 'attendance_request_update']);
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
            'student_image' => $this->isMethod('POST') ? 'required|image|max:4096' : 'nullable|image|max:4096',
            'evidence' => 'required|string|in:present,absent,late,permit,sick,other',
            'description' => 'required|string',
        ];
    }
}
