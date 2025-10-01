<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Aluno;

class ProfessorController extends Controller
{
    public function turmas(Request $request)
    {
        // Verificar se é professor
        $userRole = session('user_data.role', 'professor');
        if ($userRole !== 'professor') {
            return redirect()->route('dashboard')
                ->with('error', 'Acesso negado. Apenas professores podem acessar esta página.');
        }

        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);

        // Obter turmas do professor
        $userData = session('user_data', []);
        $professorTurmasIds = $userData['turmas_ids'] ?? [];

        // Query base
        $query = Turma::query();

        // Filtrar apenas turmas do professor
        if (!empty($professorTurmasIds)) {
            $query->whereIn('id', $professorTurmasIds);
        }

        // Aplicar filtros
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('codigo', 'like', '%'.$search.'%')
                  ->orWhere('nome', 'like', '%'.$search.'%')
                  ->orWhere('nivel', 'like', '%'.$search.'%')
                  ->orWhere('conselheiro', 'like', '%'.$search.'%');
            });
        }

        // Ordenar e paginar
        $turmas = $query->orderBy('nome')->paginate($perPage);
        $turmas->withQueryString();

        return view('dashboard.professor.turmas', compact('turmas', 'search', 'perPage'));
    }

    public function disciplinas(Request $request)
    {
        // Verificar se é professor
        $userRole = session('user_data.role', 'professor');
        if ($userRole !== 'professor') {
            return redirect()->route('dashboard')
                ->with('error', 'Acesso negado. Apenas professores podem acessar esta página.');
        }

        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);

        // Obter disciplinas do professor
        $userData = session('user_data', []);
        $professorDisciplinasIds = $userData['disciplinas_ids'] ?? [];

        // Query base
        $query = Disciplina::query();

        // Filtrar apenas disciplinas do professor
        if (!empty($professorDisciplinasIds)) {
            $query->whereIn('id', $professorDisciplinasIds);
        }

        // Aplicar filtros
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('codigo', 'like', '%'.$search.'%')
                  ->orWhere('nome', 'like', '%'.$search.'%')
                  ->orWhere('curso', 'like', '%'.$search.'%')
                  ->orWhere('descricao', 'like', '%'.$search.'%');
            });
        }

        // Ordenar e paginar
        $disciplinas = $query->orderBy('nome')->paginate($perPage);
        $disciplinas->withQueryString();

        return view('dashboard.professor.disciplinas', compact('disciplinas', 'search', 'perPage'));
    }

    public function alunos(Request $request)
    {
        // Verificar se é professor
        $userRole = session('user_data.role', 'professor');
        if ($userRole !== 'professor') {
            return redirect()->route('dashboard')
                ->with('error', 'Acesso negado. Apenas professores podem acessar esta página.');
        }

        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);
        $statusFilter = $request->get('status', '');
        $turmaFilter = $request->get('turma', '');

        // Obter turmas do professor
        $userData = session('user_data', []);
        $professorTurmasIds = $userData['turmas_ids'] ?? [];

        // Query base
        $query = Aluno::query();

        // Filtrar apenas alunos das turmas do professor
        if (!empty($professorTurmasIds)) {
            // Como 'turma' é string, vamos filtrar por nomes das turmas
            $turmasNomes = Turma::whereIn('id', $professorTurmasIds)->pluck('nome');
            $query->whereIn('turma', $turmasNomes);
        }

        // Aplicar filtros
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('matricula', 'like', '%'.$search.'%')
                  ->orWhere('nome', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%')
                  ->orWhere('turma', 'like', '%'.$search.'%');
            });
        }

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        if ($turmaFilter) {
            $query->where('turma', $turmaFilter);
        }

        // Ordenar e paginar
        $alunos = $query->orderBy('nome')->paginate($perPage);
        $alunos->withQueryString();

        // Dados para filtros
        $statusOptions = Aluno::select('status')->distinct()->pluck('status');
        $turmas = Aluno::select('turma')->distinct()->pluck('turma');

        return view('dashboard.professor.alunos', compact(
            'alunos', 
            'search', 
            'perPage', 
            'statusOptions', 
            'turmas', 
            'statusFilter', 
            'turmaFilter'
        ));
    }
}