<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name_fr' => $this->name_fr,
            'name_en' => $this->name_en,
            'name_latin' => $this->name_latin,
            'description_fr' => $this->description_fr,
            'description_en' => $this->description_en,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->sub_category_id, 
            'image_path' => $this->image_path,
            'active_price' => $this->activePrice ? [
                'amount' => $this->activePrice->amount,
                'amount_mga' => $this->activePrice->amount_mga,
                'type' => $this->activePrice->type,
                'is_active' => $this->activePrice->is_active,
                'effectives_date' => $this->activePrice->effectives_date,
            ] : null
        ];
    }
}

