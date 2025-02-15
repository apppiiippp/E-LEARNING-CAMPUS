<?php

namespace App\Http\Resources\CoursesStudents;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesStudentsResource extends JsonResource
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
            'course_id' => $this->courses->name,
            'student_id' => $this->students->name,
        ];
    }
}
