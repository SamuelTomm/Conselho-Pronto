@extends('layouts.dashboard')

@section('title', 'Disciplinas - Conselho Pronto')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-sm border-b border-blue-100 sticky top-0 z-40">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Disciplinas</h1>
                    <p class="text-slate-600">Conselho Pronto - Sistema de Gestão Educacional</p>
                </div>
                <div class="flex items-center space-x-4">
                    @php
                        $userRole = session('user_data.role', 'professor');
                    @endphp
                    
                    @if(in_array($userRole, ['admin', 'coordenador']))
                    <button class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="plus" class="h-4 w-4"></i>
                        <span>Nova Disciplina</span>
                    </button>
                    @endif
                    
                    @if($userRole === 'professor')
                    <span class="text-sm text-slate-500">
                        <i data-lucide="info" class="h-4 w-4 inline mr-1"></i>
                        Apenas suas disciplinas são exibidas
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <main class="p-6">
        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Card Total de Disciplinas -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-xl transition-all duration-300 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Total de Disciplinas</p>
                        <p class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                            {{ $totalDisciplinas }}
                        </p>
                    </div>
                    <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-3 rounded-full">
                        <i data-lucide="book-open" class="h-6 w-6 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Card Alunos Total -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-xl transition-all duration-300 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Alunos Total</p>
                        <p class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                            {{ $totalAlunos }}
                        </p>
                    </div>
                    <div class="bg-gradient-to-r from-slate-100 to-slate-200 p-3 rounded-full">
                        <i data-lucide="users" class="h-6 w-6 text-slate-600"></i>
                    </div>
                </div>
            </div>

            <!-- Card Carga Horária Total -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-xl transition-all duration-300 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Carga Horária Total</p>
                        <p class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                            {{ $cargaHorariaTotal }}h
                        </p>
                    </div>
                    <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-3 rounded-full">
                        <i data-lucide="clock" class="h-6 w-6 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Card Período Atual -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-xl transition-all duration-300 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Período Atual</p>
                        <p class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                            2024/1
                        </p>
                    </div>
                    <div class="bg-gradient-to-r from-slate-100 to-slate-200 p-3 rounded-full">
                        <i data-lucide="calendar" class="h-6 w-6 text-slate-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Principal -->
        <div class="bg-white rounded-lg shadow-xl border-0">
            <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6">
                <h2 class="text-slate-800 text-xl font-semibold">Minhas Disciplinas</h2>
                <p class="text-slate-600">Visualize e gerencie todas as disciplinas sob sua responsabilidade</p>
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
                        
                        <!-- Filtro por Curso -->
                        <select name="curso" class="border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400" onchange="this.form.submit()">
                            <option value="">Todos os Cursos</option>
                            @foreach($cursosDisponiveis as $cursoOption)
                                <option value="{{ $cursoOption }}" {{ request('curso') == $cursoOption ? 'selected' : '' }}>
                                    {{ $cursoOption }}
                                </option>
                            @endforeach
                        </select>
                        
                        <!-- Filtro por Período -->
                        <select name="periodo" class="border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400" onchange="this.form.submit()">
                            <option value="">Todos os Períodos</option>
                            @foreach($periodosDisponiveis as $periodoOption)
                                <option value="{{ $periodoOption }}" {{ request('periodo') == $periodoOption ? 'selected' : '' }}>
                                    {{ $periodoOption }}
                                </option>
                            @endforeach
                        </select>
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
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $disciplina->codigo }}
                                    </span>
                                </div>
                                
                                <!-- Nome e Curso -->
                                <h3 class="font-semibold text-slate-800 mb-1">{{ $disciplina->nome }}</h3>
                                <p class="text-sm text-slate-600 mb-2">{{ $disciplina->curso_nome ?? 'N/A' }}</p>
                                <p class="text-xs text-slate-500">{{ $disciplina->descricao ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Informações da Disciplina -->
                        <div class="flex items-center justify-between text-sm text-slate-600 mb-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-1">
                                    <i data-lucide="users" class="h-4 w-4"></i>
                                    <span>{{ $disciplina->total_alunos ?? 0 }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <i data-lucide="clock" class="h-4 w-4"></i>
                                    <span>{{ $disciplina->carga_horaria ?? 0 }}h</span>
                                </div>
                            </div>
                        </div>

                        <!-- Botão Ver Alunos -->
                        <div class="flex space-x-2">
                            <button class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 px-4 py-2 rounded-md text-sm font-medium">
                                <i data-lucide="eye" class="h-4 w-4 inline mr-2"></i>
                                Ver Alunos
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-500">
                        <i data-lucide="book-open" class="h-12 w-12 text-gray-300 mb-4"></i>
                        <p class="text-lg font-medium">Nenhuma disciplina encontrada</p>
                        <p class="text-sm">Tente ajustar os filtros de busca</p>
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
