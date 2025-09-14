@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Visão geral do sistema educacional')

@section('content')
<!-- Header com Notificações -->
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-lg font-semibold text-slate-800">Bem-vindo ao Conselho Pronto</h2>
        <p class="text-sm text-slate-600">Acompanhe o status dos conselhos e atividades da escola</p>
    </div>
    <div class="flex items-center space-x-2">
        <button class="relative px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
            <i data-lucide="bell" class="h-4 w-4 mr-2 inline"></i>
            Notificações
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                {{ count($alertas) }}
            </span>
        </button>
    </div>
</div>

<!-- Cards de Estatísticas (4 colunas) -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Total de Turmas -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105 rounded-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total de Turmas</p>
                    <p class="text-2xl font-bold text-slate-900">5</p>
                    <p class="text-xs text-green-600 mt-1">+2 este mês</p>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-full shadow-md">
                    <i data-lucide="users" class="h-6 w-6 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total de Alunos -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105 rounded-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total de Alunos</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $metricas['alunosAtivos'] }}</p>
                    <p class="text-xs text-blue-600 mt-1">+12 este mês</p>
                </div>
                <div class="bg-gradient-to-r from-slate-500 to-slate-600 p-3 rounded-full shadow-md">
                    <i data-lucide="graduation-cap" class="h-6 w-6 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Taxa de Aprovação -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105 rounded-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Taxa de Aprovação</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $metricas['aprovacaoGeral'] }}%</p>
                    <p class="text-xs text-green-600 mt-1">+2.1% este mês</p>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-3 rounded-full shadow-md">
                    <i data-lucide="award" class="h-6 w-6 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Conselhos Pendentes -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105 rounded-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Conselhos Pendentes</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $metricas['turmasPendentes'] }}</p>
                    <p class="text-xs text-orange-600 mt-1">2 agendados</p>
                </div>
                <div class="bg-gradient-to-r from-orange-500 to-red-600 p-3 rounded-full shadow-md">
                    <i data-lucide="clock" class="h-6 w-6 text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ações Rápidas (4 colunas) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <!-- Gerenciar Turmas -->
    <a href="{{ route('turmas.index') }}" class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105 rounded-lg p-6 group">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-lg shadow-md group-hover:shadow-lg transition-all duration-300">
                <i data-lucide="users" class="h-6 w-6 text-white"></i>
            </div>
            <div>
                <h3 class="font-semibold text-slate-900 group-hover:text-blue-600 transition-colors">Gerenciar Turmas</h3>
                <p class="text-sm text-slate-600">Acessar e configurar turmas</p>
            </div>
        </div>
    </a>
    
    <!-- Conselhos de Classe -->
    <a href="{{ route('conselho-classe') }}" class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105 rounded-lg p-6 group">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-green-500 to-green-600 p-3 rounded-lg shadow-md group-hover:shadow-lg transition-all duration-300">
                <i data-lucide="file-bar-chart" class="h-6 w-6 text-white"></i>
            </div>
            <div>
                <h3 class="font-semibold text-slate-900 group-hover:text-green-600 transition-colors">Conselhos de Classe</h3>
                <p class="text-sm text-slate-600">Acompanhar conselhos</p>
            </div>
        </div>
    </a>
    
    <!-- Professores -->
    <a href="{{ route('professores.index') }}" class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105 rounded-lg p-6 group">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-3 rounded-lg shadow-md group-hover:shadow-lg transition-all duration-300">
                <i data-lucide="user-check" class="h-6 w-6 text-white"></i>
            </div>
            <div>
                <h3 class="font-semibold text-slate-900 group-hover:text-purple-600 transition-colors">Professores</h3>
                <p class="text-sm text-slate-600">Gerenciar permissões</p>
            </div>
        </div>
    </a>
    
    <!-- Relatórios -->
    <a href="#" class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105 rounded-lg p-6 group">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-3 rounded-lg shadow-md group-hover:shadow-lg transition-all duration-300">
                <i data-lucide="download" class="h-6 w-6 text-white"></i>
            </div>
            <div>
                <h3 class="font-semibold text-slate-900 group-hover:text-orange-600 transition-colors">Relatórios</h3>
                <p class="text-sm text-slate-600">Gerar relatórios</p>
            </div>
        </div>
    </a>
</div>

<!-- Métricas de Desempenho (2 colunas) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Desempenho por Turma -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg rounded-lg">
        <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border-b border-blue-100 p-6 rounded-t-lg">
            <div class="flex items-center space-x-3">
                <i data-lucide="bar-chart-3" class="h-5 w-5 text-purple-600"></i>
                <h3 class="text-lg font-semibold text-slate-900">Desempenho por Turma</h3>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <!-- 3º Ano A -->
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-slate-900">3º Ano A</span>
                            <span class="text-sm text-slate-600">Média: 8.2</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full" style="width: 82%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-slate-600 mt-1">
                            <span>24 aprovados</span>
                            <span>2 reprovação</span>
                            <span>2 recuperação</span>
                        </div>
                    </div>
                </div>
                
                <!-- 2º Ano B -->
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-slate-900">2º Ano B</span>
                            <span class="text-sm text-slate-600">Média: 7.9</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full" style="width: 79%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-slate-600 mt-1">
                            <span>26 aprovados</span>
                            <span>3 reprovação</span>
                            <span>1 recuperação</span>
                        </div>
                    </div>
                </div>
                
                <!-- 1º Ano C -->
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-slate-900">1º Ano C</span>
                            <span class="text-sm text-slate-600">Média: 8.1</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full" style="width: 81%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-slate-600 mt-1">
                            <span>22 aprovados</span>
                            <span>1 reprovação</span>
                            <span>2 recuperação</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Relatórios Disponíveis -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg rounded-lg">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-blue-100 p-6 rounded-t-lg">
            <div class="flex items-center space-x-3">
                <i data-lucide="file-bar-chart" class="h-5 w-5 text-green-600"></i>
                <h3 class="text-lg font-semibold text-slate-900">Relatórios Disponíveis</h3>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($relatorios as $relatorio)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-slate-900">{{ $relatorio['titulo'] }}</h4>
                        <p class="text-xs text-slate-600">{{ $relatorio['dataGeracao'] }} • {{ $relatorio['tamanho'] }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($relatorio['status'] == 'disponivel')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Disponível
                            </span>
                            <button class="text-blue-600 hover:text-blue-800">
                                <i data-lucide="download" class="h-4 w-4"></i>
                            </button>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Gerando...
                            </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Grid Principal (3 colunas) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Alertas Importantes -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg rounded-lg">
        <div class="bg-gradient-to-r from-red-50 to-orange-50 border-b border-blue-100 p-6 rounded-t-lg">
            <div class="flex items-center space-x-3">
                <i data-lucide="alert-triangle" class="h-5 w-5 text-red-600"></i>
                <h3 class="text-lg font-semibold text-slate-900">Alertas Importantes</h3>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($alertas as $alerta)
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        @if($alerta['prioridade'] == 'alta')
                            <div class="w-2 h-2 bg-red-500 rounded-full mt-2"></div>
                        @elseif($alerta['prioridade'] == 'media')
                            <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></div>
                        @else
                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-slate-900">{{ $alerta['titulo'] }}</h4>
                        <p class="text-xs text-slate-600">{{ $alerta['descricao'] }}</p>
                        <p class="text-xs text-slate-500 mt-1">{{ $alerta['turma'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Conselhos de Classe -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg rounded-lg">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100 p-6 rounded-t-lg">
            <div class="flex items-center space-x-3">
                <i data-lucide="file-bar-chart" class="h-5 w-5 text-blue-600"></i>
                <h3 class="text-lg font-semibold text-slate-900">Conselhos de Classe</h3>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($conselhos as $conselho)
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-slate-900">{{ $conselho['turma'] }}</h4>
                        <p class="text-xs text-slate-600">{{ $conselho['data'] }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($conselho['status'] == 'agendado') bg-blue-100 text-blue-800
                            @elseif($conselho['status'] == 'em_andamento') bg-green-100 text-green-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $conselho['status'])) }}
                        </span>
                        <p class="text-xs text-slate-500 mt-1">{{ $conselho['participantes'] }} participantes</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Próximos Eventos -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg rounded-lg">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-blue-100 p-6 rounded-t-lg">
            <div class="flex items-center space-x-3">
                <i data-lucide="calendar" class="h-5 w-5 text-green-600"></i>
                <h3 class="text-lg font-semibold text-slate-900">Próximos Eventos</h3>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($eventos as $evento)
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        @if($evento['tipo'] == 'conselho')
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i data-lucide="users" class="h-4 w-4 text-blue-600"></i>
                            </div>
                        @else
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                <i data-lucide="clock" class="h-4 w-4 text-orange-600"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-slate-900">{{ $evento['titulo'] }}</h4>
                        <p class="text-xs text-slate-600">{{ $evento['data'] }} • {{ $evento['turma'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Seção de Turmas (Tabela) -->
<div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg rounded-lg">
    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-slate-900">Gestão de Turmas</h3>
                <p class="text-sm text-slate-600">Gerencie as turmas e acesse os conselhos de classe</p>
            </div>
            <button class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-md hover:shadow-lg transition-all duration-200 px-4 py-2 rounded-lg">
                <i data-lucide="plus" class="h-4 w-4 mr-2 inline"></i>
                Nova Turma
            </button>
        </div>
    </div>
    
    <div class="p-6">
        <!-- Filtros -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"></i>
                    <input type="text" placeholder="Buscar turmas..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Itens por página:</span>
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                </select>
            </div>
        </div>
        
        <!-- Tabela -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Turma</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Conselheiro</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ano</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alunos</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disciplinas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($turmas as $turma)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $turma['nome'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $turma['conselheiro'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $turma['ano'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $turma['alunos'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $turma['disciplinas'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="text-gray-400 hover:text-gray-600">
                                    <i data-lucide="more-vertical" class="h-4 w-4"></i>
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Alterar</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Excluir</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Paginação -->
        <div class="flex items-center justify-between mt-6">
            <div class="text-sm text-gray-700">
                Mostrando <span class="font-medium">1</span> a <span class="font-medium">{{ count($turmas) }}</span> de <span class="font-medium">{{ count($turmas) }}</span> resultados
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50" disabled>
                    <i data-lucide="chevron-left" class="h-4 w-4"></i>
                </button>
                <span class="px-3 py-2 text-sm bg-blue-600 text-white rounded-lg">1</span>
                <button class="px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50" disabled>
                    <i data-lucide="chevron-right" class="h-4 w-4"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize Lucide icons
lucide.createIcons();
</script>
@endsection