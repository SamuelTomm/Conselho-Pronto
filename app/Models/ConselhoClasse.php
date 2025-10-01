<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConselhoClasse extends Model
{
    use HasFactory;

    protected $fillable = [
        'turma_id',
        'data',
        'status',
        'participantes',
        'observacoes',
        'ata'
    ];

    protected $casts = [
        'data' => 'date',
        'participantes' => 'integer',
    ];

    // Relacionamentos
    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function participantes()
    {
        return $this->belongsToMany(Professor::class, 'conselho_participantes');
    }

    // Scopes
    public function scopePorStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePorTurma($query, $turmaId)
    {
        return $query->where('turma_id', $turmaId);
    }

    public function scopePorData($query, $data)
    {
        return $query->where('data', $data);
    }

    // Accessors
    public function getStatusColorAttribute()
    {
        return [
            'agendado' => 'bg-blue-100 text-blue-800',
            'em_andamento' => 'bg-yellow-100 text-yellow-800',
            'realizado' => 'bg-green-100 text-green-800',
            'cancelado' => 'bg-red-100 text-red-800',
        ][$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusFormatadoAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }
}
