@extends('layouts.dashboard')

@section('title', 'Minhas Turmas - Conselho Pronto')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-sm border-b border-blue-100 sticky top-0 z-40">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Minhas Turmas</h1>
                    <p class="text-slate-600">Conselho Pronto - Sistema de Gestão Educacional</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-500">
                        <i data-lucide="info" class="h-4 w-4 inline mr-1"></i>
                        Apenas suas turmas são exibidas
                    </span>
                </div>
            </div>
        </div>
    </div>

    <main class="p-6">
        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Card Total de Turmas -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-lg transition-shadow duration-200 bg-gradient-to-br from-blue-50 to-white border-blue-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600">Minhas Turmas</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $totalTurmas }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-full">
                        <i data-lucide="users" class="h-6 w-6 text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Card Turmas Ativas -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-lg transition-shadow duration-200 bg-gradient-to-br from-slate-50 to-white border-slate-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Turmas Ativas</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $turmasAtivas }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-slate-500 to-slate-600 p-3 rounded-full">
                        <i data-lucide="check-circle" class="h-6 w-6 text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Card Total de Alunos -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-lg transition-shadow duration-200 bg-gradient-to-br from-green-50 to-white border-green-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-600">Total de Alunos</p>
                        <p class="text-2xl font-bold text-green-900">{{ $totalAlunos }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-green-500 to-green-600 p-3 rounded-full">
                        <i data-lucide="graduation-cap" class="h-6 w-6 text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Card Total de Disciplinas -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-lg transition-shadow duration-200 bg-gradient-to-br from-purple-50 to-white border-purple-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-purple-600">Disciplinas</p>
                        <p class="text-2xl font-bold text-purple-900">{{ $totalDisciplinas }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-3 rounded-full">
                        <i data-lucide="book-open" class="h-6 w-6 text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Principal -->
        <div class="bg-white/80 backdrop-blur-sm border-blue-100 rounded-lg shadow-lg">
            <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6">
                <h2 class="text-slate-800 text-xl font-semibold">Suas Turmas</h2>
                <p class="text-slate-600">Visualize e gerencie as turmas sob sua responsabilidade</p>
            </div>
            
            <div class="p-6">
                <!-- Filtros e Busca -->
                <form method="GET" class="flex items-center justify-between mb-6">
                    <!-- Seletor de Itens por Página -->
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Show</span>
                            <select name="per_page" class="w-20 border border-blue-200 rounded-md px-2 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400" onchange="this.form.submit()">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            </select>
                            <span class="text-sm text-gray-600">entries</span>
                        </div>
                    </div>
                    
                    <!-- Campo de Busca -->
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600">Search:</span>
                        <input type="text" 
                               name="search" 
                               placeholder="Buscar turma..."
                               value="{{ request('search') }}"
                               class="w-64 border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700 transition-colors">
                            <i data-lucide="search" class="h-4 w-4"></i>
                        </button>
                    </div>
                </form>

                <!-- Tabela Principal -->
                <div class="border rounded-lg bg-blue-50/30">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-blue-100/50">
                                    <th class="text-blue-900 font-semibold px-4 py-3 text-left">Nome</th>
                                    <th class="text-blue-900 font-semibold px-4 py-3 text-left">Código</th>
                                    <th class="text-blue-900 font-semibold px-4 py-3 text-left">Nível</th>
                                    <th class="text-blue-900 font-semibold px-4 py-3 text-left">Período</th>
                                    <th class="text-blue-900 font-semibold px-4 py-3 text-left">Alunos</th>
                                    <th class="text-blue-900 font-semibold px-4 py-3 text-left">Status</th>
                                    <th class="text-blue-900 font-semibold px-4 py-3 text-left">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($turmas as $turma)
                                <tr class="hover:bg-blue-50/50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="flex flex-col">
                                            <span class="font-medium text-slate-800">{{ $turma['nome'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $turma['sala'] }}</span>
                                        </div>
                                    </td>
                                    <td class="font-medium text-slate-700 px-4 py-3">{{ $turma['codigo'] }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ \App\Models\Turma::getNivelColor($turma['nivel']) }}">
                                            {{ $turma['nivel'] }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ \App\Models\Turma::getPeriodoColor($turma['periodo']) }}">
                                            {{ $turma['periodo'] }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-1">
                                            <i data-lucide="graduation-cap" class="h-4 w-4 text-slate-600"></i>
                                            <span class="text-slate-700">{{ $turma['alunos_count'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ \App\Models\Turma::getStatusColor($turma['status']) }}">
                                            {{ $turma['status'] }}
                                        </span>
                                    </td>
                                    <td class="text-center px-4 py-3">
                                        <!-- Botões de ação específicos para professor -->
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('alunos.index') }}?turma={{ $turma['id'] }}" 
                                               class="bg-blue-600 text-white px-3 py-1 rounded-md text-xs hover:bg-blue-700 transition-colors">
                                                <i data-lucide="users" class="h-3 w-3 inline mr-1"></i>
                                                Ver Alunos
                                            </a>
                                            <a href="{{ route('notas.index') }}?turma={{ $turma['id'] }}" 
                                               class="bg-green-600 text-white px-3 py-1 rounded-md text-xs hover:bg-green-700 transition-colors">
                                                <i data-lucide="clipboard-list" class="h-3 w-3 inline mr-1"></i>
                                                Notas
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center space-y-2">
                                            <i data-lucide="users" class="h-12 w-12 text-gray-300"></i>
                                            <p>Nenhuma turma encontrada</p>
                                            <p class="text-sm">Entre em contato com a coordenação para ser atribuído a turmas</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Paginação -->
                <div class="flex items-center justify-between mt-4">
                    <p class="text-sm text-gray-500">
                        Showing {{ $turmas->firstItem() }} to {{ $turmas->lastItem() }} of {{ $turmas->total() }} entries
                    </p>
                    <div class="flex items-center space-x-2">
                        @if($turmas->onFirstPage())
                            <button disabled class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 bg-gray-100 cursor-not-allowed">
                                Previous
                            </button>
                        @else
                            <a href="{{ $turmas->previousPageUrl() }}" class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 hover:bg-blue-50">
                                Previous
                            </a>
                        @endif
                        
                        <span class="text-sm font-medium text-slate-700">
                            {{ $turmas->currentPage() }} / {{ $turmas->lastPage() }}
                        </span>
                        
                        @if($turmas->hasMorePages())
                            <a href="{{ $turmas->nextPageUrl() }}" class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 hover:bg-blue-50">
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
@endsection
