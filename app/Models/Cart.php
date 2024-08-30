<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'promo_id',
        'product_id',
        'quantity',
        'user_id',
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function promo() {
        return $this->belongsTo(Promo::class, 'promo_id');
    }
}
