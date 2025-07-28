<?php

namespace App\Http\Resources;

use App\Enums\Statuses;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProjectResource
 *
 * @package App\Http\Resources
 */
class ProjectResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => Statuses::getDescription($this->status),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
