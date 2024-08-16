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

    public function promoProducts() {
        return $this->belongsTo(Product::class, 'products');
    }
}
