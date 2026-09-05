<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'role_category_id',
        'status',
        'email_notifications',
        'two_factor_enabled',
        'has_custom_permissions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'boolean',
            'email_notifications' => 'boolean',
            'two_factor_enabled' => 'boolean',
            'has_custom_permissions' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    // ── Relations ──

    // ── Accessors ──
    public function getFullNameAttribute(): string
    {
        $full = trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
        return $full !== '' ? $full : ($this->name ?? 'Unknown');
    }

    public function getInitialsAttribute(): string
    {
        $a = $this->first_name ? mb_substr($this->first_name, 0, 1) : mb_substr($this->name ?? '?', 0, 1);
        $b = $this->last_name ? mb_substr($this->last_name, 0, 1) : '';
        return mb_strtoupper($a . $b) ?: '?';
    }

    public function getAvatarColorAttribute(): string
    {
        $palette = ['#303d89', '#0069d9', '#6d28d9', '#007a5e', '#c0392b', '#916a00', '#2980b9', '#7f8c8d'];
        return $palette[$this->id % count($palette)];
    }


}
