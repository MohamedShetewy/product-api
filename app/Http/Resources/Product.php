<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'detail'=>$this->detail,
            'price'=>$this->price,
            'created_at'=>$this->created_at->format('d/m/Y'),
            'updated_at'=>$this->updated_at->format('d/m/Y'),
        ];
    }
}
