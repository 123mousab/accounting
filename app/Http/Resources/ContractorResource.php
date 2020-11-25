<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractorResource extends JsonResource
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
            'object' => 'contractor',
            'name' => $this->name,
            'slug' => $this->slug,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'status' => $this->status,
            'city' => new CityResource($this->city),
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }

    public function getContactor()
    {
        return [
            'id' => $this->id,
            'object' => 'contractor',
            'name' => $this->getTranslations('name'),
            'status' => $this->status,
        ];
    }
}
