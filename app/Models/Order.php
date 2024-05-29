<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;
use App\Models\User;
use App\Models\orderLine;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_number',
        'user_id',
        'totalPrice',
        'status',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderLines()
    {
        return $this->hasMany(orderLine::class);
    }
}
