<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Dados básicos do dashboard
        $metricas = $this->calcularMetricas();
        
        return view('dashboard.index', compact('metricas'));
    }
    
    private function calcularMetricas()
    {
        return [
            'aprovacaoGeral' => 0,
            'reprovacaoGeral' => 0,
            'recuperacaoGeral' => 0,
            'mediaGeral' => 0,
            'turmasComConselho' => 0,
            'turmasPendentes' => 0,
            'professoresAtivos' => 0,
            'alunosAtivos' => 0,
        ];
    }
}
