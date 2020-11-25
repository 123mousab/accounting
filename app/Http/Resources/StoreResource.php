<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'object' => 'store',
            'name' => $this->getTranslations('name'),
            'slug' => $this->slug,
            'store_manager' => $this->store_manager,
            'store_mobile' => $this->store_mobile,
            'status' => $this->status,
            'branch' => (new BranchResource($this->branch))->getBranch(),
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }
}
