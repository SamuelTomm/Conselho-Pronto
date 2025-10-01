<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nome',
        'curso',
        'carga_horaria',
        'periodo',
        'descricao',
        'cor', // blue, green, purple, orange, pink, emerald
        'total_alunos',
        'ativo'
    ];

    protected $casts = [
        'carga_horaria' => 'integer',
        'total_alunos' => 'integer',
        'ativo' => 'boolean',
    ];

    // Relacionamentos (assumindo que serão implementados futuramente)
    public function turmas()
    {
        return $this->belongsToMany(Turma::class);
    }

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class);
    }

    public function cursoRelacionamento()
    {
        return $this->belongsTo(Curso::class, 'curso', 'nome');
    }

    // Scopes
    public function scopeAtivo($query)
    {
        return $query->where('ativo', true);
    }

    public function scopePorCurso($query, $curso)
    {
        return $query->where('curso', 'like', "%{$curso}%");
    }

    public function scopePorPeriodo($query, $periodo)
    {
        return $query->where('periodo', $periodo);
    }

    // Accessors para cores dos badges
    public function getCorClassAttribute()
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

    // Função para obter cor da disciplina
    public static function getCorClass($cor)
    {
        $cores = [
            'blue' => 'bg-blue-100 text-blue-800',
            'green' => 'bg-green-100 text-green-800',
            'purple' => 'bg-purple-100 text-purple-800',
            'orange' => 'bg-orange-100 text-orange-800',
            'pink' => 'bg-pink-100 text-pink-800',
            'emerald' => 'bg-emerald-100 text-emerald-800'
        ];
        return $cores[$cor] ?? 'bg-gray-100 text-gray-800';
    }
}
