<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeLogResource extends JsonResource
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
            'employee' => $this->employee->name ?? "NA",
            'task' => $this->task->title ?? "NA",
            'description' => $this->description ?? "",
            'working_hours' => $this->working_hours ?? "",
            'date' => !empty($this->date) ? date('d-m-Y', strtotime($this->date)) : '',
        ];
    }
}
