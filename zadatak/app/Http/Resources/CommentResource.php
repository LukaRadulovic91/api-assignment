<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CommentResource
 *
 * @package App\Http\Resources
 */
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'task_id' => $this->task_id,
            'comment_text' => $this->comment_text,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
