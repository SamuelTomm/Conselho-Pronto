@extends('layouts.dashboard')

@section('title', 'Minhas Disciplinas - Conselho Pronto')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-sm border-b border-blue-100 sticky top-0 z-40">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Minhas Disciplinas</h1>
                    <p class="text-slate-600">Conselho Pronto - Sistema de Gestão Educacional</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-500">
                        <i data-lucide="info" class="h-4 w-4 inline mr-1"></i>
                        Apenas suas disciplinas são exibidas
                    </span>
                </div>
            </div>
        </div>
    </div>

    <main class="p-6">
        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Card Total de Disciplinas -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-lg transition-shadow duration-200 bg-gradient-to-br from-blue-50 to-white border-blue-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600">Minhas Disciplinas</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $totalDisciplinas }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-full">
                        <i data-lucide="book-open" class="h-6 w-6 text-white"></i>
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
                        <i data-lucide="users" class="h-6 w-6 text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Card Carga Horária Total -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-lg transition-shadow duration-200 bg-gradient-to-br from-orange-50 to-white border-orange-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-orange-600">Carga Horária</p>
                        <p class="text-2xl font-bold text-orange-900">{{ $cargaHorariaTotal }}h</p>
                    </div>
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-3 rounded-full">
                        <i data-lucide="clock" class="h-6 w-6 text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Card Cursos Diferentes -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-lg transition-shadow duration-200 bg-gradient-to-br from-purple-50 to-white border-purple-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-purple-600">Cursos</p>
                        <p class="text-2xl font-bold text-purple-900">{{ $cursosDiferentes }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-3 rounded-full">
                        <i data-lucide="graduation-cap" class="h-6 w-6 text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Principal -->
        <div class="bg-white/80 backdrop-blur-sm border-blue-100 rounded-lg shadow-lg">
            <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6">
                <h2 class="text-slate-800 text-xl font-semibold">Suas Disciplinas</h2>
                <p class="text-slate-600">Visualize e gerencie as disciplinas sob sua responsabilidade</p>
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
                               placeholder="Buscar disciplina..."
                               value="{{ request('search') }}"
                               class="w-64 border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700 transition-colors">
                            <i data-lucide="search" class="h-4 w-4"></i>
                        </button>
                    </div>
                </form>

                <!-- Grid de Disciplinas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($disciplinas as $disciplina)
                    <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-xl transition-all duration-300 p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <!-- Badge do Código -->
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ \App\Models\Disciplina::getCorClass($disciplina['cor']) }}">
                                        {{ $disciplina['codigo'] }}
                                    </span>
                                </div>
                                
                                <!-- Nome e Curso -->
                                <h3 class="font-semibold text-slate-800 mb-1">{{ $disciplina['nome'] }}</h3>
                                <p class="text-sm text-slate-600 mb-2">{{ $disciplina['curso'] }}</p>
                                <p class="text-xs text-slate-500">{{ $disciplina['descricao'] }}</p>
                            </div>
                        </div>

                        <!-- Informações da Disciplina -->
                        <div class="flex items-center justify-between text-sm text-slate-600 mb-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-1">
                                    <i data-lucide="users" class="h-4 w-4"></i>
                                    <span>{{ $disciplina['total_alunos'] }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <i data-lucide="clock" class="h-4 w-4"></i>
                                    <span>{{ $disciplina['carga_horaria'] }}h</span>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="flex space-x-2">
                            <a href="{{ route('alunos.index') }}?disciplina={{ $disciplina['id'] }}" 
                               class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 px-4 py-2 rounded-md text-sm font-medium text-center">
                                <i data-lucide="users" class="h-4 w-4 inline mr-2"></i>
                                Ver Alunos
                            </a>
                            <a href="{{ route('notas.index') }}?disciplina={{ $disciplina['id'] }}" 
                               class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 px-4 py-2 rounded-md text-sm font-medium text-center">
                                <i data-lucide="clipboard-list" class="h-4 w-4 inline mr-2"></i>
                                Notas
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-500">
                        <i data-lucide="book-open" class="h-12 w-12 text-gray-300 mb-4"></i>
                        <p class="text-lg font-medium">Nenhuma disciplina encontrada</p>
                        <p class="text-sm">Entre em contato com a coordenação para ser atribuído a disciplinas</p>
                    </div>
                    @endforelse
                </div>

                <!-- Paginação -->
                <div class="flex items-center justify-between mt-8">
                    <p class="text-sm text-gray-500">
                        Showing {{ $disciplinas->firstItem() }} to {{ $disciplinas->lastItem() }} of {{ $disciplinas->total() }} entries
                    </p>
                    <div class="flex items-center space-x-2">
                        @if($disciplinas->onFirstPage())
                            <button disabled class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 bg-gray-100 cursor-not-allowed">
                                Previous
                            </button>
                        @else
                            <a href="{{ $disciplinas->previousPageUrl() }}" class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 hover:bg-blue-50">
                                Previous
                            </a>
                        @endif
                        
                        <span class="text-sm font-medium text-slate-700">
                            {{ $disciplinas->currentPage() }} / {{ $disciplinas->lastPage() }}
                        </span>
                        
                        @if($disciplinas->hasMorePages())
                            <a href="{{ $disciplinas->nextPageUrl() }}" class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 hover:bg-blue-50">
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
