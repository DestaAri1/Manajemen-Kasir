<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promos';

    protected $fillable = [
        'name',
        'type',
        'value',
        'user_id',
    ];

    public function productPromos() {
        return $this->hasMany(Product_promo::class, 'promo_id');
    }

    public function cart() {
        return $this->hasMany(Cart::class, 'promo_id');
    }
}
