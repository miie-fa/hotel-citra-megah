<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
