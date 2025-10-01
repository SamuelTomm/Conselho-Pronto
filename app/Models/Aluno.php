<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricula',
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'endereco',
        'turma',
        'curso',
        'responsavel',
        'telefone_responsavel',
        'status', // Ativo, Inativo, Transferido
        'observacoes',
        'foto'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    // Relacionamentos (assumindo que serão implementados futuramente)
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function faltas()
    {
        return $this->hasMany(Falta::class);
    }

    public function turmaRelacionamento()
    {
        return $this->belongsTo(Turma::class, 'turma', 'nome');
    }

    public function cursoRelacionamento()
    {
        return $this->belongsTo(Curso::class, 'curso', 'nome');
    }

    // Scopes
    public function scopeAtivo($query)
    {
        return $query->where('status', 'Ativo');
    }

    public function scopePorStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePorTurma($query, $turma)
    {
        return $query->where('turma', $turma);
    }

    public function scopePorCurso($query, $curso)
    {
        return $query->where('curso', 'like', "%{$curso}%");
    }

    // Accessors para cores dos badges
    public function getStatusColorAttribute()
    {
        $statusColors = [
            'Ativo' => 'bg-green-100 text-green-800',
            'Inativo' => 'bg-red-100 text-red-800',
            'Transferido' => 'bg-yellow-100 text-yellow-800'
        ];
        return $statusColors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    // Função para gerar iniciais do nome
    public function getIniciaisAttribute()
    {
        $nomes = explode(' ', $this->nome);
        $iniciais = '';
        foreach ($nomes as $nome) {
            if (!empty($nome)) {
                $iniciais .= strtoupper(substr($nome, 0, 1));
            }
        }
        return substr($iniciais, 0, 2);
    }

    // Método estático para gerar iniciais (usado nas views)
    public static function getInitials($nome)
    {
        $nomes = explode(' ', $nome);
        $iniciais = '';
        foreach ($nomes as $nome) {
            if (!empty($nome)) {
                $iniciais .= strtoupper(substr($nome, 0, 1));
            }
        }
        return substr($iniciais, 0, 2);
    }

    // Método estático para obter cor do status (usado nas views)
    public static function getStatusColor($status)
    {
        $statusColors = [
            'Ativo' => 'bg-green-100 text-green-800',
            'Inativo' => 'bg-red-100 text-red-800',
            'Transferido' => 'bg-yellow-100 text-yellow-800'
        ];
        return $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
    }

    // Função para obter idade
    public function getIdadeAttribute()
    {
        return $this->data_nascimento ? $this->data_nascimento->age : null;
    }
}
