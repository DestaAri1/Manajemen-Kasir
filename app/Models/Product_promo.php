<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_promo extends Model
{
    use HasFactory;

    protected $table = 'product_promos';

    protected $fillable = [
        'product_id',
        'amount',
        'promo_id',
    ];
}
