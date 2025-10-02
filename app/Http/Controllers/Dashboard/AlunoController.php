<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Curso;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);
        $status = $request->get('status', '');
        $turma = $request->get('turma', '');
        $curso = $request->get('curso', '');
        
        // Verificar permissões do usuário
        $userRole = session('user_data.role', 'professor');
        $userData = session('user_data', []);

        // Buscar alunos do banco de dados
        $query = Aluno::query();

        // Se for professor, filtrar apenas alunos das suas turmas
        if ($userRole === 'professor') {
            $professorTurmasIds = $userData['turmas_ids'] ?? [];
            if (!empty($professorTurmasIds)) {
                // Como 'turma' é string, vamos filtrar por nomes das turmas
                $turmasNomes = Turma::whereIn('id', $professorTurmasIds)->pluck('nome');
                $query->whereIn('turma', $turmasNomes);
            } else {
                // Se não tem turmas atribuídas, não mostrar nenhum aluno
                $query->whereRaw('1 = 0');
            }
        }

        // Aplicar filtros
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('matricula', 'like', "%{$search}%")
                  ->orWhere('nome', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('turma_nome', 'like', "%{$search}%")
                  ->orWhere('curso_nome', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($turma) {
            $query->where('turma_nome', $turma);
        }

        if ($curso) {
            $query->where('curso_nome', $curso);
        }

        // Ordenar por nome
        $query->orderBy('nome');

        // Paginar
        $alunos = $query->paginate($perPage);
        $alunos->withQueryString();

        // Estatísticas
        $totalAlunos = Aluno::count();
        $alunosAtivos = Aluno::where('status', 'Ativo')->count();
        $cursosTecnicos = Aluno::where('curso_nome', 'like', '%Técnico%')->count();
        $totalTurmas = Aluno::distinct('turma_nome')->count('turma_nome');

        return view('dashboard.alunos.index', compact(
            'alunos', 
            'totalAlunos', 
            'alunosAtivos', 
            'cursosTecnicos', 
            'totalTurmas', 
            'search', 
            'perPage', 
            'status', 
            'turma', 
            'curso'
        ));
    }

    public function create()
    {
        $turmas = Turma::select('id', 'nome')->orderBy('nome')->get();
        $cursos = Curso::select('id', 'nome')->orderBy('nome')->get();
        
        return view('dashboard.alunos.create', compact('turmas', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required|string|max:255|unique:alunos',
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:alunos',
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'endereco' => 'nullable|string|max:500',
            'turma_id' => 'required|exists:turmas,id',
            'curso_id' => 'required|exists:cursos,id',
            'responsavel' => 'required|string|max:255',
            'telefone_responsavel' => 'nullable|string|max:20',
            'status' => 'required|in:Ativo,Inativo,Transferido',
            'observacoes' => 'nullable|string|max:1000',
        ]);

        // Buscar dados da turma e curso
        $turma = Turma::findOrFail($request->turma_id);
        $curso = Curso::findOrFail($request->curso_id);

        Aluno::create([
            'matricula' => $request->matricula,
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'endereco' => $request->endereco,
            'turma_id' => $request->turma_id,
            'curso_id' => $request->curso_id,
            'turma_nome' => $turma->nome,
            'curso_nome' => $curso->nome,
            'responsavel' => $request->responsavel,
            'telefone_responsavel' => $request->telefone_responsavel,
            'status' => $request->status,
            'observacoes' => $request->observacoes,
        ]);

        return redirect()->route('alunos.index')
            ->with('success', 'Aluno criado com sucesso!');
    }

    public function show(Aluno $aluno)
    {
        return view('dashboard.alunos.show', compact('aluno'));
    }

    public function edit(Aluno $aluno)
    {
        $turmas = Turma::select('id', 'nome')->orderBy('nome')->get();
        $cursos = Curso::select('id', 'nome')->orderBy('nome')->get();
        
        return view('dashboard.alunos.edit', compact('aluno', 'turmas', 'cursos'));
    }

    public function update(Request $request, Aluno $aluno)
    {
        $request->validate([
            'matricula' => 'required|string|max:255|unique:alunos,matricula,' . $aluno->id,
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:alunos,email,' . $aluno->id,
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'endereco' => 'nullable|string|max:500',
            'turma_id' => 'required|exists:turmas,id',
            'curso_id' => 'required|exists:cursos,id',
            'responsavel' => 'required|string|max:255',
            'telefone_responsavel' => 'nullable|string|max:20',
            'status' => 'required|in:Ativo,Inativo,Transferido',
            'observacoes' => 'nullable|string|max:1000',
        ]);

        // Buscar dados da turma e curso
        $turma = Turma::findOrFail($request->turma_id);
        $curso = Curso::findOrFail($request->curso_id);

        $aluno->update([
            'matricula' => $request->matricula,
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'endereco' => $request->endereco,
            'turma_id' => $request->turma_id,
            'curso_id' => $request->curso_id,
            'turma_nome' => $turma->nome,
            'curso_nome' => $curso->nome,
            'responsavel' => $request->responsavel,
            'telefone_responsavel' => $request->telefone_responsavel,
            'status' => $request->status,
            'observacoes' => $request->observacoes,
        ]);

        return redirect()->route('alunos.index')
            ->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy(Aluno $aluno)
    {
        $aluno->delete();

        return redirect()->route('alunos.index')
            ->with('success', 'Aluno excluído com sucesso!');
    }
}