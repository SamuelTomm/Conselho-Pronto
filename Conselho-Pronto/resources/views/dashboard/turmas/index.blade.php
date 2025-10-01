@extends('layouts.dashboard')

@section('title', 'Turmas - Conselho Pronto')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-sm border-b border-blue-100 sticky top-0 z-40">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Turmas</h1>
                    <p class="text-slate-600">Conselho Pronto - Sistema de Gestão Educacional</p>
                </div>
                <div class="flex items-center space-x-4">
                    @php
                        $userRole = session('user_data.role', 'professor');
                    @endphp
                    
                    @if(in_array($userRole, ['admin', 'coordenador']))
                    <button class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="plus" class="h-4 w-4"></i>
                        <span>Nova Turma</span>
                    </button>
                    @endif
                    
                    @if($userRole === 'professor')
                    <span class="text-sm text-slate-500">
                        <i data-lucide="info" class="h-4 w-4 inline mr-1"></i>
                        Apenas suas turmas são exibidas
                    </span>
                    @endif
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
                        <p class="text-sm font-medium text-blue-600">Total de Turmas</p>
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

            <!-- Card Ensino Médio -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-lg transition-shadow duration-200 bg-gradient-to-br from-blue-50 to-white border-blue-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600">Ensino Médio</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $ensinoMedio }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-full">
                        <i data-lucide="graduation-cap" class="h-6 w-6 text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Card Ensino Fundamental -->
            <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-lg transition-shadow duration-200 bg-gradient-to-br from-slate-50 to-white border-slate-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Ensino Fundamental</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $ensinoFundamental }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-slate-500 to-slate-600 p-3 rounded-full">
                        <i data-lucide="school" class="h-6 w-6 text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Principal -->
        <div class="bg-white/80 backdrop-blur-sm border-blue-100 rounded-lg shadow-lg">
            <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6">
                <h2 class="text-slate-800 text-xl font-semibold">Gerenciar Turmas</h2>
                <p class="text-slate-600">Visualize e gerencie todas as turmas do sistema</p>
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
                        
                        <!-- Filtro por Nível -->
                        <select name="nivel" class="border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400" onchange="this.form.submit()">
                            <option value="">Todos os Níveis</option>
                            @foreach($niveis as $nivelOption)
                                <option value="{{ $nivelOption }}" {{ request('nivel') == $nivelOption ? 'selected' : '' }}>
                                    {{ $nivelOption }}
                                </option>
                            @endforeach
                        </select>
                        
                        <!-- Filtro por Período -->
                        <select name="periodo" class="border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400" onchange="this.form.submit()">
                            <option value="">Todos os Períodos</option>
                            @foreach($periodos as $periodoOption)
                                <option value="{{ $periodoOption }}" {{ request('periodo') == $periodoOption ? 'selected' : '' }}>
                                    {{ $periodoOption }}
                                </option>
                            @endforeach
                        </select>
                        
                        <!-- Filtro por Status -->
                        <select name="status" class="border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400" onchange="this.form.submit()">
                            <option value="">Todos os Status</option>
                            @foreach($statusOptions as $statusOption)
                                <option value="{{ $statusOption }}" {{ request('status') == $statusOption ? 'selected' : '' }}>
                                    {{ $statusOption }}
                                </option>
                            @endforeach
                        </select>
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
                                    <th class="text-blue-900 font-semibold px-4 py-3 text-left">Conselheiro</th>
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
                                    <td class="text-sm text-slate-700 px-4 py-3">{{ $turma['conselheiro'] }}</td>
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
                                        <!-- Dropdown de ações -->
                                        <div class="relative" x-data="{ open: false }">
                                            <button 
                                                @click="open = !open"
                                                @click.away="open = false"
                                                class="hover:bg-blue-100 transition-colors p-1 rounded"
                                            >
                                                <i data-lucide="more-horizontal" class="h-4 w-4 text-blue-600"></i>
                                            </button>
                                            <div 
                                                x-show="open" 
                                                x-transition:enter="transition ease-out duration-100"
                                                x-transition:enter-start="transform opacity-0 scale-95"
                                                x-transition:enter-end="transform opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-75"
                                                x-transition:leave-start="transform opacity-100 scale-100"
                                                x-transition:leave-end="transform opacity-0 scale-95"
                                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                                            >
                                                <div class="py-1">
                                                    <a 
                                                        href="{{ route('turmas.show', $turma['id']) }}"
                                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    >
                                                        <i data-lucide="eye" class="h-4 w-4 mr-2"></i>
                                                        Visualizar
                                                    </a>
                                                    <a 
                                                        href="{{ route('turmas.edit', $turma['id']) }}"
                                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    >
                                                        <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                                                        Editar
                                                    </a>
                                                    <button 
                                                        onclick="deleteTurma({{ $turma['id'] }})"
                                                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                                    >
                                                        <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                                                        Excluir
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center space-y-2">
                                            <i data-lucide="users" class="h-12 w-12 text-gray-300"></i>
                                            <p>Nenhuma turma encontrada</p>
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

<script>
function deleteTurma(id) {
    if (confirm('Tem certeza que deseja excluir esta turma?')) {
        // Simular exclusão
        window.location.href = '{{ route("turmas.index") }}?deleted=' + id;
    }
}
</script>
@endsection
