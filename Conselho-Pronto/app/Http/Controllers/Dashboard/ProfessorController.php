<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index()
    {
        return view('dashboard.professores.index');
    }
    
    public function create()
    {
        return view('dashboard.professores.create');
    }
    
    public function store(Request $request)
    {
        // Implementar criação de professor
    }
    
    public function show($id)
    {
        return view('dashboard.professores.show', compact('id'));
    }
    
    public function edit($id)
    {
        return view('dashboard.professores.edit', compact('id'));
    }
    
    public function update(Request $request, $id)
    {
        // Implementar atualização de professor
    }
    
    public function destroy($id)
    {
        // Implementar exclusão de professor
    }
}
