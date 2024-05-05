<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_class_id' => $this->course_class_id,
            'student_id' => $this->student_id,
            'course_class' => new CourseClassResource($this->whenLoaded('courseClass')),
            'student' => new StudentResource($this->whenLoaded('student')),
            'student_image' => $this->student_image,
            'evidence' => $this->evidence,
            'status' => $this->status,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
