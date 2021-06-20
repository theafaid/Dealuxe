<?php

namespace App\Http\Resources;

class ProductResource extends ProductIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), $this->singleProductData());
    }

    /**
     * Get additional single product data
     * @return array
     */
    protected function singleProductData()
    {
        return [
            'description' => $this->description,
            'images' => $this->additional_images,
            'variations' => ProductVariationResource::collection(
                $this->variations->groupBy('type.name')
            ),
        ];
    }
}
