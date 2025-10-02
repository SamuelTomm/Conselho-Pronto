<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ciclo;
use App\Models\Trimestre;

class CicloController extends Controller
{
    public function index()
    {
        $anos = Ciclo::orderBy('ano', 'desc')->get();
        $trimestres = Trimestre::with('ciclo')->orderBy('ciclo_id')->orderBy('numero')->get();
        
        return view('dashboard.ciclos.index', compact('anos', 'trimestres'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'ano' => 'required|integer|min:1900|max:2100|unique:ciclos,ano',
            'descricao' => 'nullable|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
        ]);
        
        try {
            $ciclo = Ciclo::create([
                'ano' => $request->ano,
                'descricao' => $request->descricao ?? "Ano letivo de {$request->ano}",
                'data_inicio' => $request->data_inicio,
                'data_fim' => $request->data_fim,
                'ativo' => true,
            ]);

            // Criar os 3 trimestres automaticamente
            $this->criarTrimestres($ciclo);
            
            // Definir o primeiro trimestre como ativo
            $primeiroTrimestre = $ciclo->trimestres()->orderBy('numero')->first();
            if ($primeiroTrimestre) {
                $ciclo->definirTrimestreAtivo($primeiroTrimestre->id);
            }
            
            return redirect()->route('ciclos.index')->with('success', 'Ano letivo adicionado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao criar ano letivo: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    public function update(Request $request, $id)
    {
        $ciclo = Ciclo::findOrFail($id);
        
        $request->validate([
            'ano' => 'required|integer|min:1900|max:2100|unique:ciclos,ano,' . $id,
            'descricao' => 'nullable|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
        ]);
        
        try {
            $ciclo->update([
                'ano' => $request->ano,
                'descricao' => $request->descricao ?? "Ano letivo de {$request->ano}",
                'data_inicio' => $request->data_inicio,
                'data_fim' => $request->data_fim,
            ]);
            
            return redirect()->route('ciclos.index')->with('success', 'Ano letivo atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao atualizar ano letivo: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    public function destroy($id)
    {
        try {
            $ciclo = Ciclo::findOrFail($id);
            $ciclo->delete();
            
            return redirect()->route('ciclos.index')->with('success', 'Ano letivo excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao excluir ano letivo: ' . $e->getMessage());
        }
    }
    
    public function getTrimestres($cicloId)
    {
        $ciclo = Ciclo::with('trimestres')->findOrFail($cicloId);
        
        return response()->json([
            'trimestres' => $ciclo->trimestres->map(function($trimestre) {
                return [
                    'id' => $trimestre->id,
                    'nome' => $trimestre->nome,
                    'periodo' => $trimestre->periodo,
                    'numero' => $trimestre->numero,
                    'ativo' => $trimestre->ativo
                ];
            })
        ]);
    }

    public function trocarTrimestreAtivo(Request $request, $cicloId)
    {
        $request->validate([
            'trimestre_id' => 'required|exists:trimestres,id'
        ]);

        try {
            $ciclo = Ciclo::findOrFail($cicloId);
            $trimestre = $ciclo->definirTrimestreAtivo($request->trimestre_id);
            
            return redirect()->back()->with('success', "Trimestre ativo alterado para: {$trimestre->nome}");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao alterar trimestre ativo: ' . $e->getMessage());
        }
    }

    private function criarTrimestres(Ciclo $ciclo)
    {
        $ano = $ciclo->ano;
        $dataInicio = $ciclo->data_inicio;
        $dataFim = $ciclo->data_fim;
        
        // Calcular duração de cada trimestre
        $duracaoTotal = $dataInicio->diffInDays($dataFim);
        $duracaoTrimestre = intval($duracaoTotal / 3);
        
        $trimestres = [
            [
                'numero' => 1,
                'nome' => '1º Trimestre',
                'periodo' => 'Fevereiro a Abril',
                'data_inicio' => $dataInicio,
                'data_fim' => $dataInicio->copy()->addDays($duracaoTrimestre),
            ],
            [
                'numero' => 2,
                'nome' => '2º Trimestre',
                'periodo' => 'Maio a Julho',
                'data_inicio' => $dataInicio->copy()->addDays($duracaoTrimestre + 1),
                'data_fim' => $dataInicio->copy()->addDays($duracaoTrimestre * 2),
            ],
            [
                'numero' => 3,
                'nome' => '3º Trimestre',
                'periodo' => 'Agosto a Novembro',
                'data_inicio' => $dataInicio->copy()->addDays($duracaoTrimestre * 2 + 1),
                'data_fim' => $dataFim,
            ],
        ];
        
        foreach ($trimestres as $trimestreData) {
            Trimestre::create([
                'ciclo_id' => $ciclo->id,
                'numero' => $trimestreData['numero'],
                'nome' => $trimestreData['nome'],
                'periodo' => $trimestreData['periodo'],
                'data_inicio' => $trimestreData['data_inicio'],
                'data_fim' => $trimestreData['data_fim'],
                'ativo' => true,
            ]);
        }
    }
}