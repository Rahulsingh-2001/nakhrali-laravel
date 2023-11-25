<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;

    public $table = 'carts';

    protected $guarded = ['id'];

    // Relation between user and cart
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    // Relation between product and cart

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    // Relation between variant and cart
    public function variant(): HasOne
    {
        return $this->hasOne(ProductVariant::class, 'id', 'variant_id');
    }

    public function color(): HasOne
    {
        return $this->hasOne(Color::class, 'id', 'variant_id');
    }

    // Relation between transaction and cart

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }
}
