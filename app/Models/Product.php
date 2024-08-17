<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'products',
        'stock',
        'price',
        'image',
        'user_id',
    ];

    public function productsPromo() {
        return $this->hasMany(Product_promo::class, 'product_id');
    }
}
