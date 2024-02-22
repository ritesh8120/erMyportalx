<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'title' => $this->title ?? "NA",
            'start_date' => $this->start_date ? date('d-m-Y',strtotime($this->start_date)) : "NA",
            'end_date' => $this->end_date ? date('d-m-Y',strtotime($this->end_date)) : "NA"
        ];
    }
}
