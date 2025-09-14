<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    public function index()
    {
        return view('dashboard.disciplinas.index');
    }
    
    public function create()
    {
        return view('dashboard.disciplinas.create');
    }
    
    public function store(Request $request)
    {
        // Implementar criação de disciplina
    }
    
    public function edit($id)
    {
        return view('dashboard.disciplinas.edit', compact('id'));
    }
    
    public function update(Request $request, $id)
    {
        // Implementar atualização de disciplina
    }
    
    public function destroy($id)
    {
        // Implementar exclusão de disciplina
    }
}
