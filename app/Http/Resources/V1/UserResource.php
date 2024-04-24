<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $this->image,
            'role_id' => $this->role_id,
            'role' => $this->whenLoaded('role'),
            'faculty_staff' => $this->when($this->role_id === 2, $this->facultyStaff),
            'lecturer' => $this->when($this->role_id === 3, $this->lecturer),
            'student' => $this->when($this->role_id === 4, $this->student),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
