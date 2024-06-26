<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'favicon',
        'name',
        'description',
        'phone',
        'fax',
        'email',
        'address',
        'facebook',
        'linkedin',
        'instagram',
        'twitter',
        'analytic_id',
    ];
}
