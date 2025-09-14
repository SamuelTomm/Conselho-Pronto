<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        return view('dashboard.alunos.index');
    }
    
    public function create()
    {
        return view('dashboard.alunos.create');
    }
    
    public function store(Request $request)
    {
        // Implementar criação de aluno
    }
    
    public function show($id)
    {
        return view('dashboard.alunos.show', compact('id'));
    }
    
    public function edit($id)
    {
        return view('dashboard.alunos.edit', compact('id'));
    }
    
    public function update(Request $request, $id)
    {
        // Implementar atualização de aluno
    }
    
    public function destroy($id)
    {
        // Implementar exclusão de aluno
    }
}
