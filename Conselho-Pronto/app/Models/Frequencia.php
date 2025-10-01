<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'disciplina_id',
        'turma_id',
        'data',
        'presenca',
        'observacoes'
    ];

    protected $casts = [
        'data' => 'date',
        'presenca' => 'boolean',
    ];

    // Relacionamentos
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    // Scopes
    public function scopePorAluno($query, $alunoId)
    {
        return $query->where('aluno_id', $alunoId);
    }

    public function scopePorDisciplina($query, $disciplinaId)
    {
        return $query->where('disciplina_id', $disciplinaId);
    }

    public function scopePorTurma($query, $turmaId)
    {
        return $query->where('turma_id', $turmaId);
    }

    public function scopePorData($query, $data)
    {
        return $query->where('data', $data);
    }

    public function scopePresencas($query)
    {
        return $query->where('presenca', true);
    }

    public function scopeFaltas($query)
    {
        return $query->where('presenca', false);
    }

    // Accessors
    public function getStatusAttribute()
    {
        return $this->presenca ? 'Presente' : 'Falta';
    }

    public function getStatusColorAttribute()
    {
        return $this->presenca ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
    }
}
