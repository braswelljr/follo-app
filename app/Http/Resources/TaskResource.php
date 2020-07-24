<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'appointment' => $request->appointment,
            'type' => $request->type,
            'status' => $request->status,
            'body' => $request->body,
            'reminder' => $request->reminder,
        ];
    }
}
