<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $courseClass = null;

        if ($this->whenLoaded('courseClass')) {
            $courseClass = (new CourseClassResource($this->courseClass))->toArray($request);
            $courseClass['course'] = new CourseResource($this->courseClass->course);
            $courseClass['lecturer'] = new UserResource($this->courseClass->lecturer->user);
        }

        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'course_class_id' => $this->course_class_id,
            'student_image' => $this->student_image,
            'lecturer_image' => $this->lecturer_image,
            'is_present' => $this->is_present,
            'student' => $this->whenLoaded('student'),
            'course_class' => $courseClass,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
