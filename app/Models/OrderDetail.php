<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'room_id',
        'room_name',
        'checkin_date',
        'checkout_date',
        'night',
        'adult',
        'children',
        'additional_services',
        'subtotal',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
