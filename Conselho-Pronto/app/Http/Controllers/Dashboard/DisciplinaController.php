<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disciplina;

class DisciplinaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);
        $curso = $request->get('curso', '');
        $periodo = $request->get('periodo', '');

        // Query base
        $query = Disciplina::query();

        // Aplicar filtros
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('codigo', 'like', '%'.$search.'%')
                  ->orWhere('nome', 'like', '%'.$search.'%')
                  ->orWhere('curso', 'like', '%'.$search.'%')
                  ->orWhere('descricao', 'like', '%'.$search.'%');
            });
        }

        if ($curso) {
            $query->where('curso', $curso);
        }

        if ($periodo) {
            $query->where('periodo', $periodo);
        }

        // Ordenar e paginar
        $disciplinas = $query->orderBy('nome')->paginate($perPage);
        $disciplinas->withQueryString();

        // Estatísticas
        $totalDisciplinas = Disciplina::count();
        $totalAlunos = Disciplina::sum('total_alunos');
        $cargaHorariaTotal = Disciplina::sum('carga_horaria');

        // Dados para filtros
        $periodosDisponiveis = Disciplina::select('periodo')->distinct()->pluck('periodo')->sort()->values();
        $cursosDisponiveis = Disciplina::select('curso')->distinct()->pluck('curso')->sort()->values();

        return view('dashboard.disciplinas.index', compact(
            'disciplinas', 
            'totalDisciplinas', 
            'totalAlunos', 
            'cargaHorariaTotal', 
            'search', 
            'perPage', 
            'curso', 
            'periodo', 
            'periodosDisponiveis', 
            'cursosDisponiveis'
        ));
    }
    
    public function create()
    {
        return view('dashboard.disciplinas.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:255|unique:disciplinas',
            'nome' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
            'carga_horaria' => 'required|integer|min:1',
            'periodo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'cor' => 'required|string|max:255',
            'total_alunos' => 'nullable|integer|min:0',
        ]);

        Disciplina::create($request->all());

        return redirect()->route('disciplinas.index')
            ->with('success', 'Disciplina criada com sucesso!');
    }
    
    public function show(Disciplina $disciplina)
    {
        return view('dashboard.disciplinas.show', compact('disciplina'));
    }
    
    public function edit(Disciplina $disciplina)
    {
        return view('dashboard.disciplinas.edit', compact('disciplina'));
    }
    
    public function update(Request $request, Disciplina $disciplina)
    {
        $request->validate([
            'codigo' => 'required|string|max:255|unique:disciplinas,codigo,' . $disciplina->id,
            'nome' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
            'carga_horaria' => 'required|integer|min:1',
            'periodo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'cor' => 'required|string|max:255',
            'total_alunos' => 'nullable|integer|min:0',
        ]);

        $disciplina->update($request->all());

        return redirect()->route('disciplinas.index')
            ->with('success', 'Disciplina atualizada com sucesso!');
    }
    
    public function destroy(Disciplina $disciplina)
    {
        $disciplina->delete();

        return redirect()->route('disciplinas.index')
            ->with('success', 'Disciplina excluída com sucesso!');
    }
}