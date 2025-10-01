<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    // Relacionamentos
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    // Scopes
    public function scopePorSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    // Accessors
    public function getFormattedNameAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->name));
    }
}
