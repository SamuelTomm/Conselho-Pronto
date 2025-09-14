<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index()
    {
        return view('dashboard.turmas.index');
    }
    
    public function create()
    {
        return view('dashboard.turmas.create');
    }
    
    public function store(Request $request)
    {
        // Implementar criação de turma
    }
    
    public function show($id)
    {
        return view('dashboard.turmas.show', compact('id'));
    }
    
    public function edit($id)
    {
        return view('dashboard.turmas.edit', compact('id'));
    }
    
    public function update(Request $request, $id)
    {
        // Implementar atualização de turma
    }
    
    public function destroy($id)
    {
        // Implementar exclusão de turma
    }
}
