<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KingOfCode\Upload\Uploadable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasTranslations, HasSlug, Uploadable;

    public $translatable = ['name'];

    public $uploadFolderName = 'category'; // Name of your folder


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'status'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    // Array of uploadable images. These fields need to be existent in your database table
    protected $uploadableImages = [
        'image'
    ];

    protected $imageResizeTypes = [
        'medium' => false,
        'thumb'  => false
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

}
