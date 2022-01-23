<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'card_img' => $this->card_img,
            'created_at' => $this->created_at,
        ];
    }
}
