<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pack;
use App\Models\orderLine;
use App\Models\Review;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'oldPrice',
        'price',
        'color'
    ];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')
                    ->withPivot('quantity', 'color')
                    ->withTimestamps();
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

    public function orderLines()
    {
        return $this->hasMany(orderLine::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
