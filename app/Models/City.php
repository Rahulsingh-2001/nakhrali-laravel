<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $table = 'cities';

    public $timestamps = false;

    public function state(): HasOne
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
}