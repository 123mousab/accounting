<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchSectionResource extends JsonResource
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
            'object' => 'branch section',
            'name' => $this->getTranslations('name'),
            'slug' => $this->slug,
            'status' => $this->status,
            'branch' => (new BranchResource($this->branch))->getBranch(),
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }

    public function getBranchSection()
    {
        return [
            'id' => $this->id,
            'object' => 'branch section',
            'name' => $this->getTranslations('name')
        ];
    }
}
