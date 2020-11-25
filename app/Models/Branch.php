<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use KingOfCode\Upload\Uploadable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Branch extends Model
{
    use HasFactory, SoftDeletes, HasTranslations, HasSlug;

    public $translatable = ['name'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'mobile',
        'email',
        'fax',
        'branch_manger',
        'branch_phone',
        'status',
        'area_id',
        'city_id'
    ];

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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the area record associated with the areas.
     * @return BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get the city record associated with the cities.
     * @return BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }


}
