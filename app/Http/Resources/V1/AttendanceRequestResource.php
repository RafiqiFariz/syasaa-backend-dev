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
        $courseClass = null;

        if ($this->whenLoaded('courseClass')) {
            $courseClass = (new CourseClassResource($this->courseClass))->toArray($request);
            $courseClass['course'] = new CourseResource($this->courseClass->course);
            $courseClass['lecturer'] = new UserResource($this->courseClass->lecturer->user);
            $this->courseClass->class->major->load('faculty');
            $courseClass['class'] = new ClassResource($this->courseClass->class);
        }

        return [
            'id' => $this->id,
            'course_class_id' => $this->course_class_id,
            'student_id' => $this->student_id,
            'course_class' => $courseClass,
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
