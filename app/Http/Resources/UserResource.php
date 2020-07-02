<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'first_name' => $this->first_name,
            'middle_name'=> $this->middle_name,
            'last_name' => $this->last_name,
            'date_of_birth_or_age' => $this->date_of_birth_or_age,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'telephone' => $this->telephone,
            'residence' => $this->residence,
            'email' => $this->email,
        ];
    }
}
