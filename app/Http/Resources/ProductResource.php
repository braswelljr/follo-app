<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'user_id' => $request->user_id,
            'product' => $request->product,
            'status' => $request->status,
            'amount' => $request->amount,
            'payment_mode' => $request->payment_mode,
            'description' => $request->description,
        ];
    }
}
