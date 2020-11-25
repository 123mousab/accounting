<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
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
            'object' => 'color',
            'name' => $this->getTranslations('name'),
            'slug' => $this->slug,
            'color' => $this->color,
            'status' => $this->status,
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at)
        ];
    }

    public function getColor()
    {
        return [
            'id' => $this->id,
            'object' => 'color',
            'name' => $this->getTranslations('name')
        ];
    }
}
