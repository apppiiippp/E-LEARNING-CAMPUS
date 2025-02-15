<?php

namespace App\Http\Resources\Materials;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialsResource extends JsonResource
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
            'courses_id' => $this->courses->name,
            'title' => $this->title,
            'file_path' => Storage::url($this->file_path),
        ];
    }
}
