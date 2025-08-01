<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public  function toArray(Request $request): array
    {
        return [
          'id' => $this->id,
            'code' => $this->code,
            'name_fr' => $this->name_fr,
            'name_latin'  => $this->name_latin,
            'description_fr' => $this->description_fr,
            'description_en' => $this->description_en,
            'category_id' => $this->categorie_id,
            'subcategory_id' => $this->subcategorie_id,
            'image_path' => $this->image_path,
            'active_price' => $this->activePrice ? [
                'amount' => $this->activePrice->amount,
                'type' => $this->activePrice->type,
                'is_active' => $this->activePrice->is_active,
                'effectives_date' => $this->activePrice->effectives_date,
            ]: null
        ];
    }
}
