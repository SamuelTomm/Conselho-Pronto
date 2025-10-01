<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nome', 
        'descricao',
        'tipo', // Básico, Itinerário, Técnico
        'cor', // blue, green, purple, orange, pink, emerald
        'alunos_count',
        'disciplinas_count',
        'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'alunos_count' => 'integer',
        'disciplinas_count' => 'integer'
    ];

    // Relacionamentos
    public function disciplinas()
    {
        return $this->hasMany(Disciplina::class);
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    public function alunos()
    {
        return $this->hasManyThrough(Aluno::class, Turma::class);
    }

    // Scopes
    public function scopeAtivo($query)
    {
        return $query->where('ativo', true);
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    // Accessors
    public function getTipoColorAttribute()
    {
        $cores = [
            'Básico' => 'bg-blue-100 text-blue-800',
            'Itinerário' => 'bg-green-100 text-green-800', 
            'Técnico' => 'bg-orange-100 text-orange-800'
        ];

        return $cores[$this->tipo] ?? 'bg-gray-100 text-gray-800';
    }

    public function getCorBadgeAttribute()
    {
        $cores = [
            'blue' => 'bg-blue-100 text-blue-800',
            'green' => 'bg-green-100 text-green-800',
            'purple' => 'bg-purple-100 text-purple-800',
            'orange' => 'bg-orange-100 text-orange-800',
            'pink' => 'bg-pink-100 text-pink-800',
            'emerald' => 'bg-emerald-100 text-emerald-800'
        ];

        return $cores[$this->cor] ?? 'bg-gray-100 text-gray-800';
    }
}
