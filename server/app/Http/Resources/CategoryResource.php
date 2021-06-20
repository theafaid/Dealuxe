<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id' => $this->id,
            'name'     => $this->name,
            'slug'     => $this->slug,
            'is_parent' => $this->isParent(),
            'image' => $this->image,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}
