<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        return view('dashboard.cursos.index');
    }
    
    public function create()
    {
        return view('dashboard.cursos.create');
    }
    
    public function store(Request $request)
    {
        // Implementar criação de curso
    }
    
    public function show($id)
    {
        return view('dashboard.cursos.show', compact('id'));
    }
    
    public function edit($id)
    {
        return view('dashboard.cursos.edit', compact('id'));
    }
    
    public function update(Request $request, $id)
    {
        // Implementar atualização de curso
    }
    
    public function destroy($id)
    {
        // Implementar exclusão de curso
    }
}
