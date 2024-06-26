<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasAvatar
{

    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->avatar) {
            // Menggunakan Laravel Storage untuk mendapatkan URL gambar dari penyimpanan
            return Storage::url($this->avatar);
        }

        // Jika tidak ada gambar avatar, kembalikan URL default atau null
        return null;
    }

    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
        'name',
        'email',
        'email_verified_at',
        'role',
        'phone',
        'country',
        'address',
        'token',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "admin"][$value],
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->role, 'admin');
    }
    public function orders()
    {
    return $this->hasMany(Order::class);
    }

    public function notifys()
    {
        return $this->belongsTo(NotificationFontee::class,'notify_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
