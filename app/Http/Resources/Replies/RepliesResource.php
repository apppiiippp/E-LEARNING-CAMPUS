<?php

namespace App\Http\Resources\Replies;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepliesResource extends JsonResource
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
            'discussions_id' => $this->discussion->content,
            'user_id' => $this->user->name,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
