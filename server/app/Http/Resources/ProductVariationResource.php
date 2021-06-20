<?php

namespace App\Http\Resources;

use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->resource instanceof Collection)
            return ProductVariationResource::collection($this->resource);

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'price'        => $this->formattedPrice,
            'price_varies' => $this->priceVaries(),
            'stock_count'  => $this->stockCount(),
            'in_stock'     => $this->inStock(),
            'product'      => new ProductIndexResource($this->product),
            'type'         => $this->type->name,
        ];
    }
}
