<?php

namespace App\Http\Resources;

use App\Enums\Priorities;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TaskResource
 *
 * @package App\Http\Resources
 */
class TaskResource extends JsonResource
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
            'project_id' => $this->project_id,
            'task_name' => $this->task_name,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'priority' => Priorities::getDescription($this->priority),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
