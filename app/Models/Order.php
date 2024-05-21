<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;
use App\Models\User;
use App\Models\orderLine;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_number',
        'client_id',
        'price',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderLines()
    {
        return $this->hasMany(orderLine::class);
    }
}
