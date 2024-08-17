<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_promo extends Model
{
    use HasFactory;

    protected $table = 'product_promos';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'amount',
        'promo_id',
    ];

    public function promo() {
        return $this->belongsTo(Promo::class, 'promo_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
