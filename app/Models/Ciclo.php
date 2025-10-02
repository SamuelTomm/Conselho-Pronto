<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;

    protected $fillable = [
        'ano',
        'descricao',
        'data_inicio',
        'data_fim',
        'ativo',
        'trimestre_ativo_id',
        'observacoes'
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'ativo' => 'boolean',
    ];

    // Relacionamentos
    public function trimestres()
    {
        return $this->hasMany(Trimestre::class);
    }

    public function trimestreAtivo()
    {
        return $this->belongsTo(Trimestre::class, 'trimestre_ativo_id');
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    public function notas()
    {
        return $this->hasManyThrough(Nota::class, Trimestre::class);
    }

    // Scopes
    public function scopeAtivo($query)
    {
        return $query->where('ativo', true);
    }

    public function scopePorAno($query, $ano)
    {
        return $query->where('ano', $ano);
    }

    // Accessors
    public function getNomeCompletoAttribute()
    {
        return "Ano Letivo {$this->ano}";
    }

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

    // Métodos auxiliares
    public function getTrimestreAtual()
    {
        $hoje = now();
        
        return $this->trimestres()
            ->where('data_inicio', '<=', $hoje)
            ->where('data_fim', '>=', $hoje)
            ->where('ativo', true)
            ->first();
    }

    public function getProximoTrimestre()
    {
        $hoje = now();
        
        return $this->trimestres()
            ->where('data_inicio', '>', $hoje)
            ->where('ativo', true)
            ->orderBy('data_inicio')
            ->first();
    }

    public function definirTrimestreAtivo($trimestreId)
    {
        // Verificar se o trimestre pertence a este ciclo
        $trimestre = $this->trimestres()->find($trimestreId);
        
        if (!$trimestre) {
            throw new \Exception('Trimestre não pertence a este ciclo');
        }

        $this->update(['trimestre_ativo_id' => $trimestreId]);
        return $trimestre;
    }

    public function getTrimestreAtivoOuAtual()
    {
        // Se há um trimestre ativo definido, usar ele
        if ($this->trimestre_ativo_id) {
            return $this->trimestreAtivo;
        }

        // Senão, usar o trimestre atual baseado na data
        return $this->getTrimestreAtual();
    }

    // Método estático para obter o ciclo ativo do sistema
    public static function getCicloAtivo()
    {
        return self::where('ativo', true)
            ->orderBy('ano', 'desc')
            ->first();
    }

    // Método estático para obter o trimestre ativo do sistema
    public static function getTrimestreAtivoSistema()
    {
        $cicloAtivo = self::getCicloAtivo();
        
        if (!$cicloAtivo) {
            return null;
        }

        return $cicloAtivo->getTrimestreAtivoOuAtual();
    }
}
