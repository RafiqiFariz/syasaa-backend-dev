<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class AttendanceRequest extends FormRequest
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
        $rules = [
            'student_id' => 'required|exists:students,id',
            'is_present' => 'required|boolean',
            'course_class_id' => 'nullable',
        ];

        if (request()->is_absent) {
            $rules['course_class_id'] = 'required|exists:course_class,id';
            $rules['attendance_request_id'] = 'nullable|exists:attendance_requests,id';
        }

        if ($this->isMethod('POST') && request()->is_absent) {
            $rules['student_image'] = 'required|image|mimes:jpeg,png,jpg|max:4096';
            $rules['lecturer_image'] = 'required|image|mimes:jpeg,png,jpg|max:4096';

            return $rules;
        }

        $rules['student_image'] = 'sometimes';
        $rules['lecturer_image'] = 'sometimes';

        if (request()->hasFile('student_image')) {
            $rules['student_image'] = 'required|image|mimes:jpeg,png,jpg|max:4096';
        }

        if (request()->hasFile('lecturer_image')) {
            $rules['lecturer_image'] = 'required|image|mimes:jpeg,png,jpg|max:4096';
        }

        return $rules;
    }
}
