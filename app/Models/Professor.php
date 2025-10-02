<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Professor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'professores';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'especialidades',
        'telefone',
        'data_admissao',
        'turmas_ids',
        'disciplinas_ids',
        'observacoes',
        'ativo'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'especialidades' => 'array',
        'turmas_ids' => 'array',
        'disciplinas_ids' => 'array',
        'ativo' => 'boolean',
    ];

    // Relacionamentos
    public function turmas()
    {
        return $this->belongsToMany(Turma::class);
    }

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    // Scopes
    public function scopeAtivo($query)
    {
        return $query->where('ativo', true);
    }

    public function scopePorRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // Accessors
    public function getInitialsAttribute()
    {
        $names = explode(' ', $this->name);
        $initials = '';
        foreach ($names as $name) {
            if (!empty($name)) {
                $initials .= strtoupper(substr($name, 0, 1));
            }
        }
        return substr($initials, 0, 2);
    }

    public function getRoleColorAttribute()
    {
        return [
            'professor' => 'bg-blue-100 text-blue-800',
            'coordenador' => 'bg-purple-100 text-purple-800',
            'conselheiro' => 'bg-orange-100 text-orange-800',
            'admin' => 'bg-red-100 text-red-800',
        ][$this->role] ?? 'bg-gray-100 text-gray-800';
    }
}
