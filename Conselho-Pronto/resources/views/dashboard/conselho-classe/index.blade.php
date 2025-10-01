@extends('layouts.dashboard')

@section('title', 'Conselho de Classe')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Conselho de Classe</h1>
                    <p class="text-slate-600">Conselho Pronto - Sistema de Gestão Educacional</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="bg-gradient-to-r from-green-600 to-green-700 text-white px-4 py-2 rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="plus" class="h-4 w-4"></i>
                        <span>Novo Conselho</span>
                    </button>
                </div>
            </div>
        </div>

        <main class="p-6">
            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Card Total de Conselhos -->
                <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-xl transition-all duration-300 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Total de Conselhos</p>
                            <p class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                                8
                            </p>
                        </div>
                        <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-3 rounded-full">
                            <i data-lucide="users" class="h-6 w-6 text-blue-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Card Conselhos Realizados -->
                <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-xl transition-all duration-300 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Conselhos Realizados</p>
                            <p class="text-2xl font-bold bg-gradient-to-r from-green-600 to-green-800 bg-clip-text text-transparent">
                                5
                            </p>
                        </div>
                        <div class="bg-gradient-to-r from-green-100 to-green-200 p-3 rounded-full">
                            <i data-lucide="check-circle" class="h-6 w-6 text-green-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Card Conselhos Pendentes -->
                <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-xl transition-all duration-300 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Conselhos Pendentes</p>
                            <p class="text-2xl font-bold bg-gradient-to-r from-orange-600 to-orange-800 bg-clip-text text-transparent">
                                2
                            </p>
                        </div>
                        <div class="bg-gradient-to-r from-orange-100 to-orange-200 p-3 rounded-full">
                            <i data-lucide="clock" class="h-6 w-6 text-orange-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Card Conselhos Agendados -->
                <div class="bg-white rounded-lg shadow-lg border-0 hover:shadow-xl transition-all duration-300 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Conselhos Agendados</p>
                            <p class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-purple-800 bg-clip-text text-transparent">
                                1
                            </p>
                        </div>
                        <div class="bg-gradient-to-r from-purple-100 to-purple-200 p-3 rounded-full">
                            <i data-lucide="calendar" class="h-6 w-6 text-purple-600"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-xl border-0">
                <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                    <h2 class="text-slate-800 text-xl font-semibold">Gestão de Conselhos de Classe</h2>
                    <p class="text-slate-600">Visualize e gerencie todos os conselhos de classe</p>
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
                            
                            <!-- Filtro por Status -->
                            <select name="status" class="border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400" onchange="this.form.submit()">
                                <option value="">Todos os Status</option>
                                <option value="agendado" {{ request('status') == 'agendado' ? 'selected' : '' }}>Agendado</option>
                                <option value="em_andamento" {{ request('status') == 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                                <option value="realizado" {{ request('status') == 'realizado' ? 'selected' : '' }}>Realizado</option>
                                <option value="cancelado" {{ request('status') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>
                        
                        <!-- Campo de Busca -->
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Search:</span>
                            <input type="text" 
                                   name="search" 
                                   placeholder="Buscar conselho..."
                                   value="{{ request('search') }}"
                                   class="w-64 border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400"
                                   onchange="this.form.submit()">
                        </div>
                    </form>

                    <!-- Tabela Principal -->
                    <div class="border rounded-lg overflow-hidden shadow-sm bg-gradient-to-r from-slate-50 to-blue-50">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-gradient-to-r from-blue-100 to-slate-100 border-b border-blue-200">
                                    <tr>
                                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Turma</th>
                                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Data</th>
                                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Status</th>
                                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Participantes</th>
                                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Alunos</th>
                                        <th class="w-20 text-center text-slate-700 font-semibold px-4 py-3">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dados mockados dos conselhos -->
                                    @php
                                        $conselhos = [
                                            [
                                                'id' => 1,
                                                'turma' => '3º Ano A',
                                                'data' => '2024-06-15',
                                                'status' => 'agendado',
                                                'participantes' => 8,
                                                'alunos' => 28
                                            ],
                                            [
                                                'id' => 2,
                                                'turma' => '2º Ano B',
                                                'data' => '2024-06-18',
                                                'status' => 'em_andamento',
                                                'participantes' => 6,
                                                'alunos' => 30
                                            ],
                                            [
                                                'id' => 3,
                                                'turma' => '1º Ano C',
                                                'data' => '2024-06-20',
                                                'status' => 'realizado',
                                                'participantes' => 7,
                                                'alunos' => 25
                                            ],
                                            [
                                                'id' => 4,
                                                'turma' => '1º Técnico em Informática',
                                                'data' => '2024-06-22',
                                                'status' => 'realizado',
                                                'participantes' => 5,
                                                'alunos' => 22
                                            ],
                                            [
                                                'id' => 5,
                                                'turma' => '2º Técnico em Design',
                                                'data' => '2024-06-25',
                                                'status' => 'cancelado',
                                                'participantes' => 0,
                                                'alunos' => 18
                                            ]
                                        ];
                                    @endphp
                                    
                                    @foreach($conselhos as $conselho)
                                    <tr class="hover:bg-blue-50/50 transition-colors">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-3">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold">
                                                    {{ substr($conselho['turma'], 0, 2) }}
                                                </div>
                                                <div>
                                                    <div class="font-medium text-slate-800">{{ $conselho['turma'] }}</div>
                                                    <div class="text-sm text-gray-500">ID: {{ $conselho['id'] }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-sm text-slate-700 px-4 py-3">{{ date('d/m/Y', strtotime($conselho['data'])) }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                @if($conselho['status'] == 'agendado') bg-blue-100 text-blue-800
                                                @elseif($conselho['status'] == 'em_andamento') bg-yellow-100 text-yellow-800
                                                @elseif($conselho['status'] == 'realizado') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $conselho['status'])) }}
                                            </span>
                                        </td>
                                        <td class="text-sm text-slate-700 px-4 py-3">{{ $conselho['participantes'] }}</td>
                                        <td class="text-sm text-slate-700 px-4 py-3">{{ $conselho['alunos'] }}</td>
                                        <td class="text-center px-4 py-3">
                                            <!-- Dropdown de ações -->
                                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                                <button 
                                                    @click="open = !open" 
                                                    type="button" 
                                                    class="flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" 
                                                    id="menu-button-{{ $conselho['id'] }}" 
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
                                                    aria-labelledby="menu-button-{{ $conselho['id'] }}"
                                                >
                                                    <div class="py-1" role="none">
                                                        <a href="#" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">
                                                            <i data-lucide="eye" class="h-4 w-4 mr-2"></i>
                                                            Visualizar
                                                        </a>
                                                        <a href="#" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">
                                                            <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                                                            Editar
                                                        </a>
                                                        <a href="#" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">
                                                            <i data-lucide="users" class="h-4 w-4 mr-2"></i>
                                                            Participantes
                                                        </a>
                                                        <button type="button" class="text-red-600 flex items-center w-full px-4 py-2 text-sm hover:bg-red-50" role="menuitem">
                                                            <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                                                            Excluir
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Paginação -->
                    <div class="flex items-center justify-between mt-4">
                        <p class="text-sm text-gray-500">
                            Showing 1 to 5 of 5 entries
                        </p>
                        <div class="flex items-center space-x-2">
                            <button disabled class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 bg-gray-100 cursor-not-allowed">
                                Previous
                            </button>
                            
                            <span class="text-sm font-medium text-slate-700">
                                1 / 1
                            </span>
                            
                            <button disabled class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 bg-gray-100 cursor-not-allowed">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
// Initialize Lucide icons
lucide.createIcons();
</script>
@endsection
