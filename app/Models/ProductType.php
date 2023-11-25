<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductType extends Model implements HasMedia

{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = 'product_types';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('img');
    }
}
