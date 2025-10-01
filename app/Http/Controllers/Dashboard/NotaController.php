<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nota;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Turma;

class NotaController extends Controller
{
    public function index(Request $request)
    {
        // Verificar se o usuário pode ver notas
        $userRole = session('user_data.role', 'professor');
        if (!in_array($userRole, ['admin', 'coordenador', 'conselheiro', 'professor'])) {
            return redirect()->route('dashboard')
                ->with('error', 'Acesso negado. Você não tem permissão para visualizar notas.');
        }

        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);
        $turmaId = $request->get('turma');
        $disciplinaId = $request->get('disciplina');
        $periodo = $request->get('periodo');

        // Query base
        $query = Nota::with(['aluno', 'disciplina', 'turma']);

        // Se for professor, filtrar apenas suas turmas/disciplinas
        if ($userRole === 'professor') {
            $userData = session('user_data', []);
            $professorTurmasIds = $userData['turmas_ids'] ?? [];
            $professorDisciplinasIds = $userData['disciplinas_ids'] ?? [];

            if (!empty($professorTurmasIds)) {
                $query->whereIn('turma_id', $professorTurmasIds);
            }
            if (!empty($professorDisciplinasIds)) {
                $query->whereIn('disciplina_id', $professorDisciplinasIds);
            }
        }

        // Aplicar filtros
        if ($search) {
            $query->whereHas('aluno', function($q) use ($search) {
                $q->where('nome', 'like', '%'.$search.'%')
                  ->orWhere('matricula', 'like', '%'.$search.'%');
            });
        }

        if ($turmaId) {
            $query->where('turma_id', $turmaId);
        }

        if ($disciplinaId) {
            $query->where('disciplina_id', $disciplinaId);
        }

        if ($periodo) {
            $query->where('periodo', $periodo);
        }

        // Ordenar e paginar
        $notas = $query->orderBy('created_at', 'desc')->paginate($perPage);
        $notas->withQueryString();

        // Dados para filtros
        $turmas = Turma::select('id', 'nome')->orderBy('nome')->get();
        $disciplinas = Disciplina::select('id', 'nome')->orderBy('nome')->get();
        $periodos = Nota::select('periodo')->distinct()->pluck('periodo')->sort()->values();

        return view('dashboard.notas.index', compact(
            'notas', 
            'turmas', 
            'disciplinas', 
            'periodos', 
            'search', 
            'perPage', 
            'turmaId', 
            'disciplinaId', 
            'periodo'
        ));
    }

    public function create()
    {
        $alunos = Aluno::select('id', 'nome', 'matricula')->orderBy('nome')->get();
        $disciplinas = Disciplina::select('id', 'nome')->orderBy('nome')->get();
        $turmas = Turma::select('id', 'nome')->orderBy('nome')->get();
        
        return view('dashboard.notas.create', compact('alunos', 'disciplinas', 'turmas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'disciplina_id' => 'required|exists:disciplinas,id',
            'turma_id' => 'required|exists:turmas,id',
            'professor_id' => 'required|exists:professores,id',
            'nota1' => 'required|numeric|min:0|max:10',
            'nota2' => 'required|numeric|min:0|max:10',
            'nota3' => 'required|numeric|min:0|max:10',
            'periodo' => 'required|string|max:255',
            'data_avaliacao' => 'required|date',
            'tipo_avaliacao' => 'required|string|max:255',
            'peso' => 'nullable|integer|min:1',
            'observacoes' => 'nullable|string',
        ]);

        // Calcular média
        $media = ($request->nota1 + $request->nota2 + $request->nota3) / 3;

        $nota = Nota::create([
            'aluno_id' => $request->aluno_id,
            'disciplina_id' => $request->disciplina_id,
            'turma_id' => $request->turma_id,
            'professor_id' => $request->professor_id,
            'nota1' => $request->nota1,
            'nota2' => $request->nota2,
            'nota3' => $request->nota3,
            'media' => round($media, 1),
            'periodo' => $request->periodo,
            'data_avaliacao' => $request->data_avaliacao,
            'tipo_avaliacao' => $request->tipo_avaliacao,
            'peso' => $request->peso ?? 1,
            'observacoes' => $request->observacoes,
        ]);

        return redirect()->route('notas.index')
            ->with('success', 'Nota cadastrada com sucesso!');
    }

    public function show(Nota $nota)
    {
        $nota->load(['aluno', 'disciplina', 'turma', 'professor']);
        return view('dashboard.notas.show', compact('nota'));
    }

    public function edit(Nota $nota)
    {
        $alunos = Aluno::select('id', 'nome', 'matricula')->orderBy('nome')->get();
        $disciplinas = Disciplina::select('id', 'nome')->orderBy('nome')->get();
        $turmas = Turma::select('id', 'nome')->orderBy('nome')->get();
        
        return view('dashboard.notas.edit', compact('nota', 'alunos', 'disciplinas', 'turmas'));
    }

    public function update(Request $request, Nota $nota)
    {
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'disciplina_id' => 'required|exists:disciplinas,id',
            'turma_id' => 'required|exists:turmas,id',
            'professor_id' => 'required|exists:professores,id',
            'nota1' => 'required|numeric|min:0|max:10',
            'nota2' => 'required|numeric|min:0|max:10',
            'nota3' => 'required|numeric|min:0|max:10',
            'periodo' => 'required|string|max:255',
            'data_avaliacao' => 'required|date',
            'tipo_avaliacao' => 'required|string|max:255',
            'peso' => 'nullable|integer|min:1',
            'observacoes' => 'nullable|string',
        ]);

        // Calcular média
        $media = ($request->nota1 + $request->nota2 + $request->nota3) / 3;

        $nota->update([
            'aluno_id' => $request->aluno_id,
            'disciplina_id' => $request->disciplina_id,
            'turma_id' => $request->turma_id,
            'professor_id' => $request->professor_id,
            'nota1' => $request->nota1,
            'nota2' => $request->nota2,
            'nota3' => $request->nota3,
            'media' => round($media, 1),
            'periodo' => $request->periodo,
            'data_avaliacao' => $request->data_avaliacao,
            'tipo_avaliacao' => $request->tipo_avaliacao,
            'peso' => $request->peso ?? 1,
            'observacoes' => $request->observacoes,
        ]);

        return redirect()->route('notas.index')
            ->with('success', 'Nota atualizada com sucesso!');
    }

    public function destroy(Nota $nota)
    {
        $nota->delete();

        return redirect()->route('notas.index')
            ->with('success', 'Nota excluída com sucesso!');
    }
}