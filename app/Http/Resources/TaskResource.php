<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'todo_list' => $this->todo_list->name,
            'label' => new LabelResource($this->label),
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
