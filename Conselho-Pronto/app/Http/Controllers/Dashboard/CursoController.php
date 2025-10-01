<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);
        $tipo = $request->get('tipo', '');

        // Query base
        $query = Curso::query();

        // Aplicar filtros
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('codigo', 'like', '%'.$search.'%')
                  ->orWhere('nome', 'like', '%'.$search.'%')
                  ->orWhere('descricao', 'like', '%'.$search.'%')
                  ->orWhere('tipo', 'like', '%'.$search.'%');
            });
        }

        if ($tipo) {
            $query->where('tipo', $tipo);
        }

        // Ordenar e paginar
        $cursos = $query->orderBy('nome')->paginate($perPage);
        $cursos->withQueryString();

        // Dados para filtros
        $tipos = Curso::select('tipo')->distinct()->pluck('tipo')->sort()->values();

        return view('dashboard.cursos.index', compact('cursos', 'tipos', 'search', 'perPage', 'tipo'));
    }

    public function create()
    {
        return view('dashboard.cursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:255|unique:cursos',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'tipo' => 'required|in:Básico,Itinerário,Técnico',
            'cor' => 'required|string|max:255',
            'alunos_count' => 'nullable|integer|min:0',
            'disciplinas_count' => 'nullable|integer|min:0',
        ]);

        Curso::create($request->all());

        return redirect()->route('cursos.index')
            ->with('success', 'Curso criado com sucesso!');
    }

    public function show(Curso $curso)
    {
        return view('dashboard.cursos.show', compact('curso'));
    }

    public function edit(Curso $curso)
    {
        return view('dashboard.cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'codigo' => 'required|string|max:255|unique:cursos,codigo,' . $curso->id,
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'tipo' => 'required|in:Básico,Itinerário,Técnico',
            'cor' => 'required|string|max:255',
            'alunos_count' => 'nullable|integer|min:0',
            'disciplinas_count' => 'nullable|integer|min:0',
        ]);

        $curso->update($request->all());

        return redirect()->route('cursos.index')
            ->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso excluído com sucesso!');
    }

    public function turmas($id)
    {
        $curso = Curso::findOrFail($id);
        return redirect()->route('cursos.index')
            ->with('info', 'Funcionalidade de visualização de turmas será implementada em breve.');
    }

    public function materias($id)
    {
        $curso = Curso::findOrFail($id);
        return redirect()->route('cursos.index')
            ->with('info', 'Funcionalidade de visualização de matérias será implementada em breve.');
    }

    public function alunos($id)
    {
        $curso = Curso::findOrFail($id);
        return redirect()->route('cursos.index')
            ->with('info', 'Funcionalidade de visualização de alunos será implementada em breve.');
    }
}