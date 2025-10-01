@extends('layouts.dashboard')

@section('title', 'Alunos')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <!-- Header -->
        <div class="bg-white/80 backdrop-blur-sm border-b border-blue-100 sticky top-0 z-40">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800">Alunos</h1>
                        <p class="text-slate-600">Conselho Pronto - Sistema de Gestão Educacional</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        @php
                            $userRole = session('user_data.role', 'professor');
                        @endphp
                        
                        @if(in_array($userRole, ['admin', 'coordenador']))
                        <a href="{{ route('alunos.create') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center space-x-2">
                            <i data-lucide="plus" class="h-4 w-4"></i>
                            <span>Novo Aluno</span>
                        </a>
                        @endif
                        
                        @if($userRole === 'professor')
                        <span class="text-sm text-slate-500">
                            <i data-lucide="info" class="h-4 w-4 inline mr-1"></i>
                            Apenas alunos das suas turmas são exibidos
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <main class="p-6">
            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Card Total de Alunos -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total de Alunos</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalAlunos }}</p>
                        </div>
                        <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-3 rounded-full">
                            <i data-lucide="graduation-cap" class="h-6 w-6 text-blue-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Card Alunos Ativos -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Alunos Ativos</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $alunosAtivos }}</p>
                        </div>
                        <div class="bg-gradient-to-r from-green-100 to-green-200 p-3 rounded-full">
                            <i data-lucide="users" class="h-6 w-6 text-green-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Card Cursos Técnicos -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Cursos Técnicos</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $cursosTecnicos }}</p>
                        </div>
                        <div class="bg-gradient-to-r from-slate-100 to-slate-200 p-3 rounded-full">
                            <i data-lucide="book-open" class="h-6 w-6 text-slate-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Card Turmas -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Turmas</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalTurmas }}</p>
                        </div>
                        <div class="bg-gradient-to-r from-gray-100 to-gray-200 p-3 rounded-full">
                            <i data-lucide="school" class="h-6 w-6 text-gray-600"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-xl border-0">
                <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6">
                    <h2 class="text-slate-800 text-xl font-semibold">Gestão de Alunos</h2>
                    <p class="text-slate-600">Visualize e gerencie todos os alunos sob sua responsabilidade</p>
                </div>
                
                <div class="p-6">
                    <!-- Filtros e Busca -->
                    <div class="flex items-center justify-between mb-6">
                        <!-- Seletor de Itens por Página -->
                        <form method="GET" action="{{ route('alunos.index') }}" class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-600">Show</span>
                                <select name="per_page" onchange="this.form.submit()" class="w-20 border border-blue-200 rounded-md px-2 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                </select>
                                <span class="text-sm text-gray-600">entries</span>
                            </div>
                        </form>
                        
                        <!-- Campo de Busca -->
                        <form method="GET" action="{{ route('alunos.index') }}" class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Search:</span>
                            <input type="text" 
                                   name="search" 
                                   placeholder="Buscar aluno..."
                                   value="{{ $search }}"
                                   onchange="this.form.submit()"
                                   class="w-64 border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                        </form>
                    </div>

                    <!-- Tabela Principal -->
                    <div class="border rounded-lg overflow-hidden shadow-sm bg-gradient-to-r from-slate-50 to-blue-50">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-gradient-to-r from-blue-100 to-slate-100 border-b border-blue-200">
                                    <tr>
                                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Aluno</th>
                                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Matrícula</th>
                                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Turma</th>
                                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Curso</th>
                                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Status</th>
                                        <th class="w-20 text-center text-slate-700 font-semibold px-4 py-3">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($alunos as $aluno)
                                    <tr class="hover:bg-blue-50/50 transition-colors">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-3">
                                                <!-- Avatar do Aluno -->
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold">
                                                    {{ \App\Models\Aluno::getInitials($aluno->nome) }}
                                                </div>
                                                <div>
                                                    <div class="font-medium text-slate-800">{{ $aluno->nome }}</div>
                                                    <div class="text-sm text-gray-500">{{ $aluno->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="font-medium text-slate-700 px-4 py-3">{{ $aluno->matricula }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                {{ $aluno->turma }}
                                            </span>
                                        </td>
                                        <td class="text-sm text-slate-700 px-4 py-3">{{ $aluno->curso }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ \App\Models\Aluno::getStatusColor($aluno->status) }}">
                                                {{ $aluno->status }}
                                            </span>
                                        </td>
                                        <td class="text-center px-4 py-3">
                                            <!-- Dropdown de ações -->
                                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                                <button 
                                                    @click="open = !open" 
                                                    type="button" 
                                                    class="flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" 
                                                    id="menu-button-{{ $aluno->id }}" 
                                                    aria-expanded="true" 
                                                    aria-haspopup="true"
                                                >
                                                    <i data-lucide="more-horizontal" class="h-4 w-4"></i>
                                                </button>
                                                <div 
                                                    x-show="open" 
                                                    @click.away="open = false"
                                                    x-transition:enter="transition ease-out duration-100"
                                                    x-transition:enter-start="transform opacity-0 scale-95"
                                                    x-transition:enter-end="transform opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-75"
                                                    x-transition:leave-start="transform opacity-100 scale-100"
                                                    x-transition:leave-end="transform opacity-0 scale-95"
                                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10" 
                                                    role="menu" 
                                                    aria-orientation="vertical" 
                                                    aria-labelledby="menu-button-{{ $aluno->id }}"
                                                >
                                                    <div class="py-1" role="none">
                                                        <a href="{{ route('alunos.show', $aluno->id) }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">
                                                            <i data-lucide="eye" class="h-4 w-4 mr-2"></i>
                                                            Visualizar
                                                        </a>
                                                        <a href="{{ route('alunos.edit', $aluno->id) }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">
                                                            <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                                                            Editar
                                                        </a>
                                                        <form method="POST" action="{{ route('alunos.destroy', $aluno->id) }}" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 flex items-center w-full px-4 py-2 text-sm hover:bg-red-50" role="menuitem" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">
                                                                <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                                                                Excluir
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-3 text-center text-gray-500">Nenhum aluno encontrado.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Paginação -->
                    <div class="flex items-center justify-between mt-4">
                        <p class="text-sm text-gray-500">
                            Showing {{ $alunos->firstItem() }} to {{ $alunos->lastItem() }} of {{ $alunos->total() }} entries
                        </p>
                        <div class="flex items-center space-x-2">
                            @if($alunos->onFirstPage())
                                <button disabled class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 bg-gray-100 cursor-not-allowed">
                                    Previous
                                </button>
                            @else
                                <a href="{{ $alunos->previousPageUrl() }}" class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 hover:bg-blue-50">
                                    Previous
                                </a>
                            @endif
                            
                            <span class="text-sm font-medium text-slate-700">
                                {{ $alunos->currentPage() }} / {{ $alunos->lastPage() }}
                            </span>
                            
                            @if($alunos->hasMorePages())
                                <a href="{{ $alunos->nextPageUrl() }}" class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 hover:bg-blue-50">
                                    Next
                                </a>
                            @else
                                <button disabled class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 bg-gray-100 cursor-not-allowed">
                                    Next
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection