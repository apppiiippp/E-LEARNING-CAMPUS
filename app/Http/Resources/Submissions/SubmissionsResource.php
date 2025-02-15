<?php

namespace App\Http\Resources\Submissions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmissionsResource extends JsonResource
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
            'assignments_id' =>$this->assignments->title,
            'students_id' => $this->students->name,
            'file_path' => Storage::url($this->file_path),
            'score' => $this->score,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
