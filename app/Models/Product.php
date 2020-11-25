<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use KingOfCode\Upload\Uploadable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasTranslations, HasSlug, Uploadable;

    public $translatable = ['name'];

    public $uploadFolderName = 'product'; // Name of your folder

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

   /* protected $fillable = [
        'name',
        'slug',
        'barcode',
        'description',
        'product_type_id',
        'category_id',
        'branch_section_id',
        'company_manufacture_id',
        'store_id',
        'has_parent',
        'parent_id',
        'unit_id',
        'size_id',
        'color_id',
        'currency_id',
        'dealer_id',
        'expire_date',
        'limit_demand',
        'sale_price1',
        'sale_price2',
        'sale_price3',
        'purchase_price1',
        'purchase_price2',
        'purchase_price3',
        'multiply_factor',
        'number_of_small_unit',
        'contain_child_from_parent',
        'total_quantity',
        'balance_last_date',
        'start_amount',
        'favorite',
        'related_store',
        'related_tax',
        'status'
    ];*/

    protected $guarded = [];

    protected $hidden = [
        'deleted_at'
    ];


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('en');
    }

    // Array of uploadable images. These fields need to be existent in your database table
    protected $uploadableImages = [
        'image'
    ];

    protected $imageResizeTypes = [
        'medium' => false,
        'thumb'  => false
    ];

    /**
     * Get the productType record associated with the productType.
     * @return BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    /**
     * Get the category record associated with the category.
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the branchSection record associated with the branchSection.
     * @return BelongsTo
     */
    public function branchSection()
    {
        return $this->belongsTo(BranchSection::class);
    }

    /**
     * Get the companyManufacture record associated with the companyManufacture.
     * @return BelongsTo
     */
    public function companyManufacture()
    {
        return $this->belongsTo(CompanyManufacture::class);
    }

    /**
     * Get the store record associated with the store.
     * @return BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the product record associated with the product.
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Get the products record associated with the products.
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Get the unit record associated with the unit.
     * @return BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get the size record associated with the size.
     * @return BelongsTo
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    /**
     * Get the color record associated with the color.
     * @return BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * Get the currency record associated with the currency.
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the dealer record associated with the dealer.
     * @return BelongsTo
     */
    public function dealer()
    {
        return $this->belongsTo(Dealers::class);
    }
}
