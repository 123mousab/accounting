<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
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
            'object' => 'currency',
            'name' => $this->getTranslations('name'),
            'slug' => $this->slug,
            'symbol' => $this->symbol,
            'price' => $this->price,
            'image' => $this->getImagePath('image'),
            'status' => $this->status,
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }

    public function getCurrency()
    {
        return [
            'id' => $this->id,
            'object' => 'currency',
            'name' => $this->getTranslations('name')
        ];
    }
}
