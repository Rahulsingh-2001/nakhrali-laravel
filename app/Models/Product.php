<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model  implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasSlug;
    protected $guarded = ['id'];
    public $timestamps = true;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(Media $media = null): void
    {

        $this->addMediaConversion('thumb')
            ->crop('crop-center', 630, 630);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function type(): HasOne
    {
        return $this->hasOne(ProductType::class, 'id', 'type_id');
    }

    public function color(): HasMany
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }

    public function variant(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }
}