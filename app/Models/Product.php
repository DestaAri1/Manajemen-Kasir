<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function user() {
        return $this->belongsTo(User::class, 'users');
    }

    public function productsPromo() {
        return $this->hasMany(Promo::class, 'promos');
    }
}
