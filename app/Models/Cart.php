<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;
use App\Models\Product;
use App\Models\Order;


class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'price',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Product::class, 'cart_product')
                    ->withPivot('quantity', 'color')
                    ->withTimestamps();
    }

}
