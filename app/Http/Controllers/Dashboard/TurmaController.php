<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Turma;

class TurmaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $perPage = $request->get('per_page', 10);
        $nivel = $request->get('nivel', '');
        $periodo = $request->get('periodo', '');
        $status = $request->get('status', '');

        // Query base
        $query = Turma::query();

        // Aplicar filtros
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('codigo', 'like', '%'.$search.'%')
                  ->orWhere('nome', 'like', '%'.$search.'%')
                  ->orWhere('nivel', 'like', '%'.$search.'%')
                  ->orWhere('conselheiro', 'like', '%'.$search.'%')
                  ->orWhere('sala', 'like', '%'.$search.'%');
            });
        }

        if ($nivel) {
            $query->where('nivel', $nivel);
        }

        if ($periodo) {
            $query->where('periodo', $periodo);
        }

        if ($status) {
            $query->where('status', $status);
        }

        // Ordenar e paginar
        $turmas = $query->orderBy('nome')->paginate($perPage);
        $turmas->withQueryString();

        // Estatísticas
        $totalTurmas = Turma::count();
        $turmasAtivas = Turma::where('status', 'Ativa')->count();
        $ensinoMedio = Turma::where('nivel', 'Ensino Médio')->count();
        $ensinoFundamental = Turma::where('nivel', 'Ensino Fundamental')->count();

        // Dados para filtros
        $niveis = Turma::select('nivel')->distinct()->pluck('nivel')->sort()->values();
        $periodos = Turma::select('periodo')->distinct()->pluck('periodo')->sort()->values();
        $statusOptions = Turma::select('status')->distinct()->pluck('status')->sort()->values();

        return view('dashboard.turmas.index', compact(
            'turmas', 
            'totalTurmas', 
            'turmasAtivas', 
            'ensinoMedio', 
            'ensinoFundamental',
            'niveis',
            'periodos',
            'statusOptions',
            'search',
            'perPage',
            'nivel',
            'periodo',
            'status'
        ));
    }
    
    public function create()
    {
        return view('dashboard.turmas.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:255|unique:turmas',
            'nome' => 'required|string|max:255',
            'nivel' => 'required|in:Ensino Fundamental,Ensino Médio,Técnico',
            'ano' => 'required|string|max:255',
            'periodo' => 'required|in:Matutino,Vespertino,Noturno,Integral',
            'sala' => 'nullable|string|max:255',
            'conselheiro' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Turma::create($request->all());

        return redirect()->route('turmas.index')
            ->with('success', 'Turma criada com sucesso!');
    }
    
    public function show(Turma $turma)
    {
        return view('dashboard.turmas.show', compact('turma'));
    }
    
    public function edit(Turma $turma)
    {
        return view('dashboard.turmas.edit', compact('turma'));
    }
    
    public function update(Request $request, Turma $turma)
    {
        $request->validate([
            'codigo' => 'required|string|max:255|unique:turmas,codigo,' . $turma->id,
            'nome' => 'required|string|max:255',
            'nivel' => 'required|in:Ensino Fundamental,Ensino Médio,Técnico',
            'ano' => 'required|string|max:255',
            'periodo' => 'required|in:Matutino,Vespertino,Noturno,Integral',
            'sala' => 'nullable|string|max:255',
            'conselheiro' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $turma->update($request->all());

        return redirect()->route('turmas.index')
            ->with('success', 'Turma atualizada com sucesso!');
    }
    
    public function destroy(Turma $turma)
    {
        $turma->delete();

        return redirect()->route('turmas.index')
            ->with('success', 'Turma excluída com sucesso!');
    }
}