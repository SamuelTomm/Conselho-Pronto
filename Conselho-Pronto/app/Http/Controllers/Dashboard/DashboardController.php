<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $turmas = $this->getTurmas();
        $metricas = $this->calcularMetricas();
        $alertas = $this->getAlertas();
        $conselhos = $this->getConselhos();
        $eventos = $this->getEventos();
        $relatorios = $this->getRelatorios();
        
        return view('dashboard.index', compact('turmas', 'metricas', 'alertas', 'conselhos', 'eventos', 'relatorios'));
    }
    
    private function getTurmas()
    {
        return [
            ['id' => 1, 'nome' => '3º Ano A - Ensino Médio', 'conselheiro' => 'Prof. Maria Silva', 'ano' => '2024', 'alunos' => 28, 'disciplinas' => 12],
            ['id' => 2, 'nome' => '2º Ano B - Ensino Médio', 'conselheiro' => 'Prof. João Santos', 'ano' => '2024', 'alunos' => 30, 'disciplinas' => 11],
            ['id' => 3, 'nome' => '1º Ano C - Ensino Médio', 'conselheiro' => 'Prof. Ana Costa', 'ano' => '2024', 'alunos' => 25, 'disciplinas' => 10],
            ['id' => 4, 'nome' => '9º Ano A - Fundamental', 'conselheiro' => 'Prof. Carlos Lima', 'ano' => '2024', 'alunos' => 32, 'disciplinas' => 9],
            ['id' => 5, 'nome' => '8º Ano B - Fundamental', 'conselheiro' => 'Prof. Lucia Ferreira', 'ano' => '2024', 'alunos' => 29, 'disciplinas' => 9],
        ];
    }
    
    private function calcularMetricas()
    {
        return [
            'aprovacaoGeral' => 85.2,
            'reprovacaoGeral' => 8.5,
            'recuperacaoGeral' => 6.3,
            'mediaGeral' => 7.8,
            'turmasComConselho' => 3,
            'turmasPendentes' => 2,
            'professoresAtivos' => 12,
            'alunosAtivos' => 144,
        ];
    }
    
    private function getAlertas()
    {
        return [
            ['id' => 1, 'tipo' => 'avaliacao', 'titulo' => 'Avaliações Pendentes', 'descricao' => '5 professores ainda não finalizaram as avaliações', 'prioridade' => 'alta', 'turma' => '3º Ano A'],
            ['id' => 2, 'tipo' => 'conselho', 'titulo' => 'Conselho de Classe', 'descricao' => 'Conselho do 2º Ano B em andamento', 'prioridade' => 'media', 'turma' => '2º Ano B'],
            ['id' => 3, 'tipo' => 'relatorio', 'titulo' => 'Relatórios Disponíveis', 'descricao' => '3 relatórios de desempenho prontos para download', 'prioridade' => 'baixa', 'turma' => 'Geral'],
        ];
    }
    
    private function getConselhos()
    {
        return [
            ['id' => 1, 'turma' => '3º Ano A', 'data' => '2024-06-15', 'status' => 'agendado', 'participantes' => 8, 'alunos' => 28],
            ['id' => 2, 'turma' => '2º Ano B', 'data' => '2024-06-18', 'status' => 'em_andamento', 'participantes' => 6, 'alunos' => 30],
            ['id' => 3, 'turma' => '1º Ano C', 'data' => '2024-06-20', 'status' => 'pendente', 'participantes' => 0, 'alunos' => 25],
        ];
    }
    
    private function getEventos()
    {
        return [
            ['id' => 1, 'titulo' => 'Conselho 3º Ano A', 'data' => '2024-06-15', 'tipo' => 'conselho', 'turma' => '3º Ano A'],
            ['id' => 2, 'titulo' => 'Conselho 2º Ano B', 'data' => '2024-06-18', 'tipo' => 'conselho', 'turma' => '2º Ano B'],
            ['id' => 3, 'titulo' => 'Prazo Avaliações', 'data' => '2024-06-10', 'tipo' => 'prazo', 'turma' => 'Todas'],
            ['id' => 4, 'titulo' => 'Conselho 1º Ano C', 'data' => '2024-06-20', 'tipo' => 'conselho', 'turma' => '1º Ano C'],
        ];
    }
    
    private function getRelatorios()
    {
        return [
            ['id' => 1, 'titulo' => 'Relatório de Desempenho Geral', 'tipo' => 'desempenho', 'dataGeracao' => '2024-06-12', 'tamanho' => '2.3 MB', 'status' => 'disponivel'],
            ['id' => 2, 'titulo' => 'Relatório de Conselhos de Classe', 'tipo' => 'conselho', 'dataGeracao' => '2024-06-10', 'tamanho' => '1.8 MB', 'status' => 'disponivel'],
            ['id' => 3, 'titulo' => 'Relatório de Frequência', 'tipo' => 'frequencia', 'dataGeracao' => '2024-06-08', 'tamanho' => '3.1 MB', 'status' => 'disponivel'],
            ['id' => 4, 'titulo' => 'Relatório de Avaliações Pendentes', 'tipo' => 'avaliacao', 'dataGeracao' => '2024-06-14', 'tamanho' => '0.9 MB', 'status' => 'gerando'],
        ];
    }
}
