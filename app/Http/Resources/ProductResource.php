<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'object' => 'product',
            'name' => @$this->getTranslations('name'),
            'slug' => $this->slug,
            'image' => $this->getImagePath('image'),
            'barcode' => $this->barcode,
            'description' => @$this->description,
            'product_type' => (new ProductTypeResource($this->productType))->getProductType(),
            'category' => (new CategoryResource($this->category))->getCategory(),
            'branch_section' => (new BranchSectionResource($this->branchSection))->getBranchSection(),
            'company_manufacture' => new CompanyManufactureResource(@$this->companyManufacture),
            'store' => new StoreResource(@$this->store),
            'unit' => (new UnitResource($this->unit))->getUnit(),
            'size' => new SizeResource(@$this->size),
            'color' => new ColorResource(@$this->color),
            'currency' => (new CurrencyResource($this->currency))->getCurrency(),
            'dealer' => new DealersResource(@$this->dealer),
            'expire_date' => $this->expire_date,
            'limit_demand' => @$this->limit_demand,
            'sale_price1' => $this->sale_price1,
            'sale_price2' => @$this->sale_price2,
            'sale_price3' => @$this->sale_price3,
            'purchase_price1' => @$this->purchase_price1,
            'purchase_price2' => @$this->purchase_price2,
            'purchase_price3' => @$this->purchase_price3,
            'multiply_factor' => @$this->multiply_factor,
            'number_of_small_unit' => @$this->number_of_small_unit,
            'contain_child_from_parent' => @$this->contain_child_from_parent,
            'total_quantity' => $this->total_quantity,
            'balance_last_date' => $this->balance_last_date,
            'start_amount' => $this->start_amount,
            'favorite' => $this->favorite,
            'related_store' => $this->related_store,
            'related_tax' => $this->related_tax,
            'status' => $this->status,
            'has_parent' => $this->has_parent,
            'parent_id' => $this->parent_id,
            $this->mergeWhen(isset($this->parent),
                ['parent' => new ProductResource(@$this->parent)]
            ),
            $this->mergeWhen(!isset($this->parent),
                ['children' => ProductResource::collection(@$this->children)->map->getChildren()]
            ),
            'created_at' => DateHelper::getTimestamp($this->created_at),
            'updated_at' => DateHelper::getTimestamp($this->updated_at),
        ];
    }

    public function getParent()
    {
        return [
            'id' => $this->id,
            'object' => 'product',
            'name' => @$this->getTranslations('name'),
            'slug' => $this->slug,
        ];
    }

    public function getChildren()
    {
        return [
            'id' => $this->id,
            'object' => 'product',
            'name' => @$this->getTranslations('name'),
            'slug' => $this->slug,
        ];
    }
}
