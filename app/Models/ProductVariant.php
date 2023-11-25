<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductVariant extends Model
{
    use HasFactory;

    public $table = 'product_variants';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function size(): HasOne
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }

    public function color(): HasOne
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id', 'color_id');
    }
}
