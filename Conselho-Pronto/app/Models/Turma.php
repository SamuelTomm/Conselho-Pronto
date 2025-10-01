<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nome',
        'nivel', // Fundamental, Ensino Médio, Técnico
        'ano',
        'periodo', // Matutino, Vespertino, Noturno, Integral
        'conselheiro',
        'sala',
        'descricao',
        'cor', // blue, green, purple, orange, pink, emerald
        'alunos_count',
        'disciplinas_count',
        'status' // Ativa, Inativa
    ];

    protected $casts = [
        'alunos_count' => 'integer',
        'disciplinas_count' => 'integer',
        'ano' => 'integer',
    ];

    // Relacionamentos (assumindo que serão implementados futuramente)
    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class);
    }

    // Scopes
    public function scopeAtiva($query)
    {
        return $query->where('status', 'Ativa');
    }

    public function scopePorNivel($query, $nivel)
    {
        return $query->where('nivel', $nivel);
    }

    public function scopePorPeriodo($query, $periodo)
    {
        return $query->where('periodo', $periodo);
    }

    public function scopePorAno($query, $ano)
    {
        return $query->where('ano', $ano);
    }

    // Accessors para cores dos badges
    public function getStatusColorAttribute()
    {
        $statusColors = [
            'Ativa' => 'bg-green-100 text-green-800',
            'Inativa' => 'bg-red-100 text-red-800'
        ];
        return $statusColors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getNivelColorAttribute()
    {
        $nivelColors = [
            'Fundamental' => 'bg-emerald-100 text-emerald-800',
            'Ensino Médio' => 'bg-blue-100 text-blue-800',
            'Técnico' => 'bg-orange-100 text-orange-800'
        ];
        return $nivelColors[$this->nivel] ?? 'bg-gray-100 text-gray-800';
    }

    public function getPeriodoColorAttribute()
    {
        $periodoColors = [
            'Matutino' => 'bg-blue-100 text-blue-800',
            'Vespertino' => 'bg-yellow-100 text-yellow-800',
            'Noturno' => 'bg-purple-100 text-purple-800',
            'Integral' => 'bg-green-100 text-green-800'
        ];
        return $periodoColors[$this->periodo] ?? 'bg-gray-100 text-gray-800';
    }

    // Funções estáticas para obter cores
    public static function getStatusColor($status)
    {
        $statusColors = [
            'Ativa' => 'bg-green-100 text-green-800',
            'Inativa' => 'bg-red-100 text-red-800'
        ];
        return $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
    }

    public static function getNivelColor($nivel)
    {
        $nivelColors = [
            'Fundamental' => 'bg-emerald-100 text-emerald-800',
            'Ensino Médio' => 'bg-blue-100 text-blue-800',
            'Técnico' => 'bg-orange-100 text-orange-800'
        ];
        return $nivelColors[$nivel] ?? 'bg-gray-100 text-gray-800';
    }

    public static function getPeriodoColor($periodo)
    {
        $periodoColors = [
            'Matutino' => 'bg-blue-100 text-blue-800',
            'Vespertino' => 'bg-yellow-100 text-yellow-800',
            'Noturno' => 'bg-purple-100 text-purple-800',
            'Integral' => 'bg-green-100 text-green-800'
        ];
        return $periodoColors[$periodo] ?? 'bg-gray-100 text-gray-800';
    }
}
