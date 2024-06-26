<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifie extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'payment_notif',
        'payment_success',
        'payment_failed',

    ];
}
