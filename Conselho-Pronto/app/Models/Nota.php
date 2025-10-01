<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'disciplina_id',
        'turma_id',
        'professor_id',
        'nota1',
        'nota2',
        'nota3',
        'media',
        'periodo',
        'data_avaliacao',
        'tipo_avaliacao',
        'peso',
        'observacoes'
    ];

    protected $casts = [
        'nota1' => 'decimal:1',
        'nota2' => 'decimal:1',
        'nota3' => 'decimal:1',
        'media' => 'decimal:1',
        'peso' => 'integer',
        'data_avaliacao' => 'date',
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

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    // Scopes
    public function scopePorPeriodo($query, $periodo)
    {
        return $query->where('periodo', $periodo);
    }

    public function scopePorAluno($query, $alunoId)
    {
        return $query->where('aluno_id', $alunoId);
    }

    public function scopePorDisciplina($query, $disciplinaId)
    {
        return $query->where('disciplina_id', $disciplinaId);
    }

    // Accessors
    public function getStatusAttribute()
    {
        if ($this->media >= 6.0) {
            return 'Aprovado';
        } elseif ($this->media >= 4.0) {
            return 'Recuperação';
        } else {
            return 'Reprovado';
        }
    }

    public function getStatusColorAttribute()
    {
        if ($this->media >= 6.0) {
            return 'bg-green-100 text-green-800';
        } elseif ($this->media >= 4.0) {
            return 'bg-yellow-100 text-yellow-800';
        } else {
            return 'bg-red-100 text-red-800';
        }
    }

    // Mutators
    public function setMediaAttribute($value)
    {
        $this->attributes['media'] = ($this->nota1 + $this->nota2 + $this->nota3) / 3;
    }
}
