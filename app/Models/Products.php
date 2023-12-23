<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
