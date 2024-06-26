<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Kyslik\ColumnSortable\Sortable;

class Room extends Model
{
    use HasFactory;
    use Sortable;

    protected $guarded = [];

    protected $casts = [
        'amenities' => 'array',
        'featured_photo' => 'array',
    ];

    protected $attributes = [
        'amenities' => 'string',
    ];

    public function room()
    {
    return $this->belongsTo(Room::class);
    }

    
    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('adults', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['search_adults'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('adults', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['search_childrens'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('childrens', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['priceRange'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('price', '<=', $search . '%');
            });
        });
    }

    public function bed_type()
    {
        return $this->belongsTo(BedType::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    

}
