<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'object' => 'branch',
            'name' => $this->getTranslations('name'),
            'slug' => $this->slug,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'fax' => $this->fax,
            'branch_manger' => $this->branch_manger,
            'branch_phone' => $this->branch_phone,
            'status' => $this->status,
            'city' => new CityResource($this->city),
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }

    public function getBranch()
    {
        return [
            'id' => $this->id,
            'object' => 'branch',
            'name' => $this->getTranslations('name'),
            'status' => $this->status,
        ];
    }
}
