<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Aluno;
use App\Models\Curso;

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);
        $status = $request->get('status', '');

        // Query base
        $query = Professor::query();

        // Aplicar filtros
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('especialidade', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('ativo', $status === 'ativo');
        }

        // Ordenar por nome
        $query->orderBy('name');

        // Paginar
        $professores = $query->paginate($perPage);
        $professores->withQueryString();

        // Estatísticas
        $totalProfessores = Professor::count();
        $professoresAtivos = Professor::where('ativo', true)->count();
        $coordenadores = Professor::where('role', 'coordenador')->count();
        $conselheiros = Professor::where('role', 'conselheiro')->count();

        return view('dashboard.professores.index', compact(
            'professores', 
            'totalProfessores', 
            'professoresAtivos', 
            'coordenadores',
            'conselheiros',
            'search', 
            'perPage', 
            'status'
        ));
    }

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
                  ->orWhere('curso_nome', 'like', '%'.$search.'%')
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
            // Como 'turma_nome' é string, vamos filtrar por nomes das turmas
            $turmasNomes = Turma::whereIn('id', $professorTurmasIds)->pluck('nome');
            $query->whereIn('turma_nome', $turmasNomes);
        }

        // Aplicar filtros
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('matricula', 'like', '%'.$search.'%')
                  ->orWhere('nome', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%')
                  ->orWhere('turma_nome', 'like', '%'.$search.'%');
            });
        }

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        if ($turmaFilter) {
            $query->where('turma_nome', $turmaFilter);
        }

        // Ordenar e paginar
        $alunos = $query->orderBy('nome')->paginate($perPage);
        $alunos->withQueryString();

        // Dados para filtros
        $statusOptions = Aluno::select('status')->distinct()->pluck('status');
        $turmas = Aluno::select('turma_nome')->distinct()->pluck('turma_nome');

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

    public function create()
    {
        $cursos = Curso::where('ativo', true)->select('id', 'nome')->orderBy('nome')->get();
        
        return view('dashboard.professores.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:professores',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:professor,coordenador',
            'especialidade' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'data_admissao' => 'nullable|date',
            'curso_id' => 'required|exists:cursos,id',
            'turmas_ids' => 'nullable|array',
            'disciplinas_ids' => 'nullable|array',
            'observacoes' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        Professor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'especialidade' => $request->especialidade,
            'telefone' => $request->telefone,
            'data_admissao' => $request->data_admissao,
            'curso_id' => $request->curso_id,
            'turmas_ids' => $request->turmas_ids ?? [],
            'disciplinas_ids' => $request->disciplinas_ids ?? [],
            'observacoes' => $request->observacoes,
            'ativo' => $request->has('ativo'),
        ]);

        return redirect()->route('professores.index')
            ->with('success', 'Professor criado com sucesso!');
    }

    public function show(Professor $professor)
    {
        return view('dashboard.professores.show', compact('professor'));
    }

    public function edit(Professor $professor)
    {
        $cursos = Curso::where('ativo', true)->select('id', 'nome')->orderBy('nome')->get();
        
        return view('dashboard.professores.edit', compact('professor', 'cursos'));
    }

    public function update(Request $request, Professor $professor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:professores,email,' . $professor->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:professor,coordenador',
            'especialidades' => 'nullable|array',
            'telefone' => 'nullable|string|max:20',
            'data_admissao' => 'nullable|date',
            'turmas_ids' => 'nullable|array',
            'disciplinas_ids' => 'nullable|array',
            'observacoes' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'especialidades' => $request->especialidades ?? [],
            'telefone' => $request->telefone,
            'data_admissao' => $request->data_admissao,
            'turmas_ids' => $request->turmas_ids ?? [],
            'disciplinas_ids' => $request->disciplinas_ids ?? [],
            'observacoes' => $request->observacoes,
            'ativo' => $request->has('ativo'),
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $professor->update($data);

        return redirect()->route('professores.index')
            ->with('success', 'Professor atualizado com sucesso!');
    }

    public function destroy(Professor $professor)
    {
        $professor->delete();

        return redirect()->route('professores.index')
            ->with('success', 'Professor excluído com sucesso!');
    }

    public function getTurmasDisciplinas(Request $request)
    {
        $cursoId = $request->get('curso_id');
        
        if (!$cursoId) {
            return response()->json([
                'turmas' => [],
                'disciplinas' => []
            ]);
        }

        $turmas = Turma::where('curso_id', $cursoId)
            ->where('status', 'Ativa')
            ->select('id', 'nome')
            ->orderBy('nome')
            ->get();

        $disciplinas = Disciplina::where('curso_id', $cursoId)
            ->where('ativo', true)
            ->select('id', 'nome')
            ->orderBy('nome')
            ->get();

        return response()->json([
            'turmas' => $turmas,
            'disciplinas' => $disciplinas
        ]);
    }
}