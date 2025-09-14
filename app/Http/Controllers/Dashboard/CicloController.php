<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CicloController extends Controller
{
    public function index()
    {
        $anos = $this->getAnos();
        $trimestres = $this->getTrimestres();
        
        return view('dashboard.ciclos.index', compact('anos', 'trimestres'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'ano' => 'required|integer|min:1900|max:2100',
            'descricao' => 'nullable|string|max:255',
        ]);
        
        // Lógica para salvar ano letivo
        // Por enquanto, apenas simular sucesso
        return redirect()->route('ciclos.index')->with('success', 'Ano letivo adicionado com sucesso!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'ano' => 'required|integer|min:1900|max:2100',
            'descricao' => 'nullable|string|max:255',
        ]);
        
        // Lógica para atualizar ano letivo
        // Por enquanto, apenas simular sucesso
        return redirect()->route('ciclos.index')->with('success', 'Ano letivo atualizado com sucesso!');
    }
    
    public function destroy($id)
    {
        // Lógica para excluir ano letivo
        // Por enquanto, apenas simular sucesso
        return redirect()->route('ciclos.index')->with('success', 'Ano letivo excluído com sucesso!');
    }
    
    private function getAnos()
    {
        return [
            ['id' => 1, 'ano' => 2023, 'descricao' => 'Ano letivo de 2023'],
            ['id' => 2, 'ano' => 2024, 'descricao' => 'Ano letivo de 2024'],
            ['id' => 3, 'ano' => 2025, 'descricao' => 'Ano letivo de 2025'],
        ];
    }
    
    private function getTrimestres()
    {
        return [
            ['id' => 1, 'nome' => '1º Trimestre', 'periodo' => 'Janeiro - Abril'],
            ['id' => 2, 'nome' => '2º Trimestre', 'periodo' => 'Maio - Agosto'],
            ['id' => 3, 'nome' => '3º Trimestre', 'periodo' => 'Setembro - Dezembro'],
        ];
    }
}