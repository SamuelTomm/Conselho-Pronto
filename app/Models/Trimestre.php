<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    use HasFactory;

    protected $fillable = [
        'ciclo_id',
        'numero',
        'nome',
        'periodo',
        'data_inicio',
        'data_fim',
        'ativo',
        'observacoes'
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'ativo' => 'boolean',
        'numero' => 'integer',
    ];

    // Relacionamentos
    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class);
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

    public function scopePorNumero($query, $numero)
    {
        return $query->where('numero', $numero);
    }

    public function scopePorCiclo($query, $cicloId)
    {
        return $query->where('ciclo_id', $cicloId);
    }

    // Accessors
    public function getStatusAttribute()
    {
        $hoje = now();
        
        if ($hoje < $this->data_inicio) {
            return 'Futuro';
        } elseif ($hoje >= $this->data_inicio && $hoje <= $this->data_fim) {
            return 'Em Andamento';
        } else {
            return 'Finalizado';
        }
    }

    public function getStatusColorAttribute()
    {
        $status = $this->status;
        
        return [
            'Futuro' => 'bg-blue-100 text-blue-800',
            'Em Andamento' => 'bg-green-100 text-green-800',
            'Finalizado' => 'bg-gray-100 text-gray-800'
        ][$status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getNomeCompletoAttribute()
    {
        return "{$this->nome} - {$this->ciclo->ano}";
    }

    // Métodos auxiliares
    public function getNotasPorTurma($turmaId)
    {
        return $this->notas()
            ->where('turma_id', $turmaId)
            ->with(['aluno', 'disciplina', 'professor'])
            ->get();
    }

    public function getNotasPorDisciplina($disciplinaId)
    {
        return $this->notas()
            ->where('disciplina_id', $disciplinaId)
            ->with(['aluno', 'turma', 'professor'])
            ->get();
    }

    public function getNotasPorAluno($alunoId)
    {
        return $this->notas()
            ->where('aluno_id', $alunoId)
            ->with(['disciplina', 'turma', 'professor'])
            ->get();
    }

    public function getEstatisticas()
    {
        $notas = $this->notas;
        
        return [
            'total_notas' => $notas->count(),
            'aprovados' => $notas->where('media', '>=', 6.0)->count(),
            'recuperacao' => $notas->whereBetween('media', [4.0, 5.9])->count(),
            'reprovados' => $notas->where('media', '<', 4.0)->count(),
            'media_geral' => $notas->avg('media') ?? 0,
        ];
    }
}
