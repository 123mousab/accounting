<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyManufactureResource extends JsonResource
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
            'object' => 'company manufacture',
            'name' => $this->getTranslations('name'),
            'slug' => $this->slug,
            'status' => $this->status,
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }

    public function getCompanyManufacture()
    {
        return [
            'id' => $this->id,
            'object' => 'company manufacture',
            'name' => $this->getTranslations('name'),
        ];
    }
}
