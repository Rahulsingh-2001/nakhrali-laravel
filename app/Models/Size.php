<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public $table = 'sizes';

    protected $guarded = ['id'];

    public $timestamps = false;
}