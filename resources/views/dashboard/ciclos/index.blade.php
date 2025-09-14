@extends('layouts.dashboard')

@section('title', 'Anos Letivos')
@section('page-title', 'Anos Letivos')
@section('page-description', 'Gerencie os anos letivos do sistema')

@section('content')
<div class="shadow-xl border-0 bg-white/90 backdrop-blur-sm rounded-lg">
    <!-- Header do Card -->
    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Gestão de Anos Letivos</h3>
                <p class="text-sm text-slate-600">Adicione, edite ou remova anos letivos</p>
            </div>
            <button 
                onclick="openModal()"
                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 px-4 py-2 rounded-lg"
            >
                <i data-lucide="plus" class="h-4 w-4 mr-2 inline"></i>
                Incluir Novo Ano
            </button>
        </div>
    </div>
    
    <!-- Conteúdo do Card -->
    <div class="p-6">
        <!-- Filtros e Busca -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Show</span>
                <select class="w-20 px-3 py-1 border border-gray-300 rounded-md text-sm">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                </select>
                <span class="text-sm text-gray-600">entries</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Search:</span>
                <input 
                    type="text" 
                    id="search"
                    placeholder="Search" 
                    class="w-48 px-3 py-1 border border-gray-300 rounded-md text-sm"
                    onkeyup="filterTable()"
                />
            </div>
        </div>
        
        <!-- Tabela de Anos Letivos -->
        <div class="border rounded-lg overflow-hidden shadow-sm bg-gradient-to-r from-slate-50 to-blue-50">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-100 to-slate-100 border-b border-blue-200">
                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Ano</th>
                        <th class="text-slate-700 font-semibold px-4 py-3 text-left">Descrição</th>
                        <th class="w-20 text-center text-slate-700 font-semibold px-4 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach($anos as $ano)
                    <tr class="hover:bg-blue-50/50 transition-colors">
                        <td class="font-medium text-slate-700 px-4 py-3">{{ $ano['ano'] }}</td>
                        <td class="text-slate-600 px-4 py-3">{{ $ano['descricao'] }}</td>
                        <td class="text-center px-4 py-3">
                            <div class="relative inline-block text-left" x-data="{ open: false }">
                                <button 
                                    @click="open = !open" 
                                    @click.away="open = false"
                                    class="hover:bg-blue-100 transition-colors p-2 rounded-md"
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
                                        <button 
                                            onclick="openTrimestresModal({{ json_encode($ano) }})"
                                            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >
                                            <i data-lucide="eye" class="h-4 w-4 mr-2"></i>
                                            Visualizar Trimestres
                                        </button>
                                        <button 
                                            onclick="openModal({{ json_encode($ano) }})"
                                            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >
                                            <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                                            Alterar
                                        </button>
                                        <button 
                                            onclick="deleteAno({{ $ano['id'] }})"
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
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Paginação -->
        <div class="flex items-center justify-between mt-4">
            <p class="text-sm text-gray-500">
                Showing 1 to {{ count($anos) }} of {{ count($anos) }} entries
            </p>
            <div class="flex items-center space-x-2">
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50 disabled:opacity-50" disabled>
                    <i data-lucide="chevron-left" class="h-4 w-4"></i>
                </button>
                <span class="text-sm font-medium">1 / 1</span>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50 disabled:opacity-50" disabled>
                    <i data-lucide="chevron-right" class="h-4 w-4"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Adicionar/Editar Ano -->
<div id="modal-anos" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2" id="form-title">
                            Novo Ano Letivo
                        </h3>
                        <p class="text-sm text-gray-500 mb-4">
                            Adicione um novo ano letivo ao sistema.
                        </p>
                        
                        <form id="form-anos" method="POST" action="{{ route('ciclos.store') }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Ano</label>
                                    <input 
                                        type="number" 
                                        id="ano"
                                        name="ano"
                                        placeholder="Ex: 2025"
                                        min="1900"
                                        max="2100"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                                    <input 
                                        type="text" 
                                        id="descricao"
                                        name="descricao"
                                        placeholder="Ex: Ano letivo de 2025"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>
                            </div>
                            
                            <!-- Mensagem de erro -->
                            <div id="error-message" class="mt-4 p-3 bg-red-50 border border-red-200 rounded-md hidden">
                                <p class="text-sm text-red-600">Mensagem de erro aqui</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button 
                    type="submit" 
                    form="form-anos"
                    id="submit-btn"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                >
                    Adicionar
                </button>
                <button 
                    onclick="closeModal()"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                >
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Visualizar Trimestres -->
<div id="modal-trimestres" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeTrimestresModal()"></div>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2" id="trimestres-title">
                            Trimestres do Ano Letivo: 2024
                        </h3>
                        <p class="text-sm text-gray-500 mb-4" id="trimestres-description">
                            Ano letivo de 2024
                        </p>
                        
                        <div class="space-y-4">
                            @foreach($trimestres as $trimestre)
                            <!-- Card do {{ $trimestre['nome'] }} -->
                            <div class="flex items-center justify-between p-4 border border-blue-100 bg-blue-50/30 hover:bg-blue-50/50 transition-colors rounded-lg">
                                <div>
                                    <h4 class="text-lg text-blue-800 font-semibold">{{ $trimestre['nome'] }}</h4>
                                    <p class="text-blue-600 text-sm">{{ $trimestre['periodo'] }}</p>
                                </div>
                                <button 
                                    onclick="openDashboardModal({{ json_encode($trimestre) }})"
                                    class="px-4 py-2 border border-blue-200 text-blue-700 hover:bg-blue-50 hover:border-blue-300 rounded-md text-sm"
                                >
                                    <i data-lucide="eye" class="h-4 w-4 mr-2 inline"></i>
                                    Visualizar Dashboard
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50/30 border-t border-blue-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button 
                    onclick="closeTrimestresModal()"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-base font-medium text-white hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                >
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal do Dashboard -->
<div id="modal-dashboard" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeDashboardModal()"></div>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-7xl sm:w-full">
            <!-- Header do Dashboard -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-white" id="dashboard-title">
                            Dashboard do Trimestre
                        </h3>
                        <p class="text-blue-100 text-sm" id="dashboard-subtitle">
                            Visualize turmas, alunos e itinerários
                        </p>
                    </div>
                    <button 
                        onclick="closeDashboardModal()"
                        class="text-white hover:text-blue-200 transition-colors"
                    >
                        <i data-lucide="x" class="h-6 w-6"></i>
                    </button>
                </div>
            </div>
            
            <!-- Conteúdo do Dashboard -->
            <div class="bg-gray-50 p-6">
                <!-- Tabs de Navegação -->
                <div class="mb-6">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8">
                            <button 
                                onclick="switchTab('turmas')"
                                id="tab-turmas"
                                class="tab-button active py-2 px-1 border-b-2 font-medium text-sm"
                            >
                                <i data-lucide="users" class="h-4 w-4 mr-2 inline"></i>
                                Turmas e Alunos
                            </button>
                            <button 
                                onclick="switchTab('itinerarios')"
                                id="tab-itinerarios"
                                class="tab-button py-2 px-1 border-b-2 font-medium text-sm"
                            >
                                <i data-lucide="book-open" class="h-4 w-4 mr-2 inline"></i>
                                Itinerários/Técnicos
                            </button>
                        </nav>
                    </div>
                </div>
                
                <!-- Conteúdo das Tabs -->
                <div id="tab-content">
                    <!-- Tab Turmas -->
                    <div id="content-turmas" class="tab-content">
                        <div class="bg-white rounded-lg shadow-sm border">
                            <!-- Header da seção Turmas -->
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-200 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-semibold text-green-800">Turmas e Alunos</h4>
                                        <p class="text-green-600 text-sm">Gerencie turmas, alunos e suas notas</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                                            <i data-lucide="plus" class="h-4 w-4 mr-2 inline"></i>
                                            Nova Turma
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Filtros -->
                            <div class="p-4 border-b border-gray-200">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-2">
                                        <label class="text-sm text-gray-600">Filtrar por:</label>
                                        <select class="px-3 py-1 border border-gray-300 rounded-md text-sm">
                                            <option value="">Todas as turmas</option>
                                            <option value="1ano">1º Ano</option>
                                            <option value="2ano">2º Ano</option>
                                            <option value="3ano">3º Ano</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <label class="text-sm text-gray-600">Buscar:</label>
                                        <input 
                                            type="text" 
                                            placeholder="Nome do aluno ou turma"
                                            class="px-3 py-1 border border-gray-300 rounded-md text-sm w-64"
                                        />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Lista de Turmas -->
                            <div class="p-6">
                                <div class="space-y-4">
                                    <!-- Turma 1 -->
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h5 class="font-semibold text-gray-800">1º Ano A - Manhã</h5>
                                                    <p class="text-sm text-gray-600">30 alunos • Professor: João Silva</p>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Ativa</span>
                                                    <button class="text-blue-600 hover:text-blue-800">
                                                        <i data-lucide="chevron-down" class="h-4 w-4"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Lista de Alunos (expandida) -->
                                        <div class="p-4 bg-white">
                                            <div class="overflow-x-auto">
                                                <table class="w-full text-sm">
                                                    <thead>
                                                        <tr class="border-b border-gray-200">
                                                            <th class="text-left py-2 font-medium text-gray-700">Aluno</th>
                                                            <th class="text-center py-2 font-medium text-gray-700">Matrícula</th>
                                                            <th class="text-center py-2 font-medium text-gray-700">Nota 1</th>
                                                            <th class="text-center py-2 font-medium text-gray-700">Nota 2</th>
                                                            <th class="text-center py-2 font-medium text-gray-700">Nota 3</th>
                                                            <th class="text-center py-2 font-medium text-gray-700">Média</th>
                                                            <th class="text-center py-2 font-medium text-gray-700">Status</th>
                                                            <th class="text-center py-2 font-medium text-gray-700">Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                                            <td class="py-2">
                                                                <div class="flex items-center">
                                                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                                        <span class="text-blue-600 font-medium text-xs">AS</span>
                                                                    </div>
                                                                    <div>
                                                                        <div class="font-medium text-gray-900">Ana Silva</div>
                                                                        <div class="text-gray-500 text-xs">Física</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center py-2 text-gray-600">2024001</td>
                                                            <td class="text-center py-2">
                                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">8.5</span>
                                                            </td>
                                                            <td class="text-center py-2">
                                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">9.0</span>
                                                            </td>
                                                            <td class="text-center py-2">
                                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">7.5</span>
                                                            </td>
                                                            <td class="text-center py-2">
                                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">8.3</span>
                                                            </td>
                                                            <td class="text-center py-2">
                                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Aprovado</span>
                                                            </td>
                                                            <td class="text-center py-2">
                                                                <button class="text-blue-600 hover:text-blue-800 mr-2">
                                                                    <i data-lucide="edit" class="h-4 w-4"></i>
                                                                </button>
                                                                <button class="text-gray-600 hover:text-gray-800">
                                                                    <i data-lucide="eye" class="h-4 w-4"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                                            <td class="py-2">
                                                                <div class="flex items-center">
                                                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                                                        <span class="text-purple-600 font-medium text-xs">BS</span>
                                                                    </div>
                                                                    <div>
                                                                        <div class="font-medium text-gray-900">Bruno Santos</div>
                                                                        <div class="text-gray-500 text-xs">Física</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center py-2 text-gray-600">2024002</td>
                                                            <td class="text-center py-2">
                                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">6.0</span>
                                                            </td>
                                                            <td class="text-center py-2">
                                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">7.0</span>
                                                            </td>
                                                            <td class="text-center py-2">
                                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">6.5</span>
                                                            </td>
                                                            <td class="text-center py-2">
                                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-semibold">6.5</span>
                                                            </td>
                                                            <td class="text-center py-2">
                                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Recuperação</span>
                                                            </td>
                                                            <td class="text-center py-2">
                                                                <button class="text-blue-600 hover:text-blue-800 mr-2">
                                                                    <i data-lucide="edit" class="h-4 w-4"></i>
                                                                </button>
                                                                <button class="text-gray-600 hover:text-gray-800">
                                                                    <i data-lucide="eye" class="h-4 w-4"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Turma 2 -->
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h5 class="font-semibold text-gray-800">2º Ano B - Tarde</h5>
                                                    <p class="text-sm text-gray-600">28 alunos • Professor: Maria Costa</p>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Ativa</span>
                                                    <button class="text-blue-600 hover:text-blue-800">
                                                        <i data-lucide="chevron-right" class="h-4 w-4"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab Itinerários/Técnicos -->
                    <div id="content-itinerarios" class="tab-content hidden">
                        <div class="bg-white rounded-lg shadow-sm border">
                            <!-- Header da seção Itinerários -->
                            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border-b border-purple-200 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-semibold text-purple-800">Itinerários e Cursos Técnicos</h4>
                                        <p class="text-purple-600 text-sm">Gerencie matérias e itinerários formativos</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm">
                                            <i data-lucide="plus" class="h-4 w-4 mr-2 inline"></i>
                                            Nova Matéria
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Filtros -->
                            <div class="p-4 border-b border-gray-200">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-2">
                                        <label class="text-sm text-gray-600">Tipo:</label>
                                        <select class="px-3 py-1 border border-gray-300 rounded-md text-sm">
                                            <option value="">Todos</option>
                                            <option value="itinerario">Itinerário</option>
                                            <option value="tecnico">Técnico</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <label class="text-sm text-gray-600">Buscar:</label>
                                        <input 
                                            type="text" 
                                            placeholder="Nome da matéria ou professor"
                                            class="px-3 py-1 border border-gray-300 rounded-md text-sm w-64"
                                        />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Lista de Itinerários/Técnicos -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <!-- Card Itinerário -->
                                    <div class="border border-purple-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="book-open" class="h-5 w-5 text-purple-600"></i>
                                                </div>
                                                <div>
                                                    <h5 class="font-semibold text-gray-800">Física Aplicada</h5>
                                                    <p class="text-sm text-gray-600">Itinerário</p>
                                                </div>
                                            </div>
                                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Ativo</span>
                                        </div>
                                        <div class="space-y-2 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <i data-lucide="user" class="h-4 w-4 mr-2"></i>
                                                <span>Prof. João Silva</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-lucide="users" class="h-4 w-4 mr-2"></i>
                                                <span>25 alunos</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-lucide="clock" class="h-4 w-4 mr-2"></i>
                                                <span>40h semanais</span>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex space-x-2">
                                            <button class="flex-1 bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded text-sm">
                                                <i data-lucide="eye" class="h-4 w-4 mr-1 inline"></i>
                                                Ver Detalhes
                                            </button>
                                            <button class="px-3 py-2 border border-purple-300 text-purple-700 hover:bg-purple-50 rounded text-sm">
                                                <i data-lucide="edit" class="h-4 w-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Card Técnico -->
                                    <div class="border border-indigo-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="wrench" class="h-5 w-5 text-indigo-600"></i>
                                                </div>
                                                <div>
                                                    <h5 class="font-semibold text-gray-800">Informática</h5>
                                                    <p class="text-sm text-gray-600">Técnico</p>
                                                </div>
                                            </div>
                                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Ativo</span>
                                        </div>
                                        <div class="space-y-2 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <i data-lucide="user" class="h-4 w-4 mr-2"></i>
                                                <span>Prof. Maria Costa</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-lucide="users" class="h-4 w-4 mr-2"></i>
                                                <span>30 alunos</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-lucide="clock" class="h-4 w-4 mr-2"></i>
                                                <span>60h semanais</span>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex space-x-2">
                                            <button class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-sm">
                                                <i data-lucide="eye" class="h-4 w-4 mr-1 inline"></i>
                                                Ver Detalhes
                                            </button>
                                            <button class="px-3 py-2 border border-indigo-300 text-indigo-700 hover:bg-indigo-50 rounded text-sm">
                                                <i data-lucide="edit" class="h-4 w-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Card Itinerário -->
                                    <div class="border border-purple-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="microscope" class="h-5 w-5 text-purple-600"></i>
                                                </div>
                                                <div>
                                                    <h5 class="font-semibold text-gray-800">Química Experimental</h5>
                                                    <p class="text-sm text-gray-600">Itinerário</p>
                                                </div>
                                            </div>
                                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Ativo</span>
                                        </div>
                                        <div class="space-y-2 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <i data-lucide="user" class="h-4 w-4 mr-2"></i>
                                                <span>Prof. Carlos Lima</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-lucide="users" class="h-4 w-4 mr-2"></i>
                                                <span>22 alunos</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-lucide="clock" class="h-4 w-4 mr-2"></i>
                                                <span>35h semanais</span>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex space-x-2">
                                            <button class="flex-1 bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded text-sm">
                                                <i data-lucide="eye" class="h-4 w-4 mr-1 inline"></i>
                                                Ver Detalhes
                                            </button>
                                            <button class="px-3 py-2 border border-purple-300 text-purple-700 hover:bg-purple-50 rounded text-sm">
                                                <i data-lucide="edit" class="h-4 w-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize Lucide icons
lucide.createIcons();

// Modal de Anos
function openModal(ano = null) {
    const modal = document.getElementById('modal-anos');
    const form = document.getElementById('form-anos');
    
    if (ano) {
        // Preencher formulário para edição
        document.getElementById('ano').value = ano.ano;
        document.getElementById('descricao').value = ano.descricao;
        document.getElementById('form-title').textContent = 'Editar Ano Letivo';
        document.getElementById('submit-btn').textContent = 'Salvar';
        form.action = '{{ route("ciclos.update", ":id") }}'.replace(':id', ano.id);
        form.innerHTML += '<input type="hidden" name="_method" value="PUT">';
    } else {
        // Limpar formulário para novo ano
        form.reset();
        document.getElementById('form-title').textContent = 'Novo Ano Letivo';
        document.getElementById('submit-btn').textContent = 'Adicionar';
        form.action = '{{ route("ciclos.store") }}';
        // Remover input _method se existir
        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }
    }
    
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal-anos').classList.add('hidden');
}

// Modal de Trimestres
function openTrimestresModal(ano) {
    const modal = document.getElementById('modal-trimestres');
    document.getElementById('trimestres-title').textContent = `Trimestres do Ano Letivo: ${ano.ano}`;
    document.getElementById('trimestres-description').textContent = ano.descricao;
    modal.classList.remove('hidden');
}

function closeTrimestresModal() {
    document.getElementById('modal-trimestres').classList.add('hidden');
}

// Filtros e Busca
function filterTable() {
    const searchTerm = document.getElementById('search').value.toLowerCase();
    const rows = document.querySelectorAll('#table-body tr');
    
    rows.forEach(row => {
        const ano = row.cells[0].textContent.toLowerCase();
        const descricao = row.cells[1].textContent.toLowerCase();
        
        if (ano.includes(searchTerm) || descricao.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Excluir Ano
function deleteAno(id) {
    if (confirm('Tem certeza que deseja excluir este ano letivo?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("ciclos.destroy", ":id") }}'.replace(':id', id);
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        const tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = '{{ csrf_token() }}';
        
        form.appendChild(methodInput);
        form.appendChild(tokenInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Modal do Dashboard
function openDashboardModal(trimestre) {
    const modal = document.getElementById('modal-dashboard');
    document.getElementById('dashboard-title').textContent = `Dashboard - ${trimestre.nome}`;
    document.getElementById('dashboard-subtitle').textContent = `Período: ${trimestre.periodo}`;
    modal.classList.remove('hidden');
    
    // Reinicializar ícones após abrir o modal
    setTimeout(() => {
        lucide.createIcons();
    }, 100);
}

function closeDashboardModal() {
    document.getElementById('modal-dashboard').classList.add('hidden');
}

// Sistema de Tabs
function switchTab(tabName) {
    // Remover classes ativas de todas as tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Esconder todos os conteúdos
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Ativar tab selecionada
    const activeButton = document.getElementById(`tab-${tabName}`);
    const activeContent = document.getElementById(`content-${tabName}`);
    
    activeButton.classList.add('active', 'border-blue-500', 'text-blue-600');
    activeButton.classList.remove('border-transparent', 'text-gray-500');
    activeContent.classList.remove('hidden');
    
    // Reinicializar ícones após trocar de tab
    setTimeout(() => {
        lucide.createIcons();
    }, 100);
}

// Inicializar com a primeira tab ativa
document.addEventListener('DOMContentLoaded', function() {
    // Adicionar estilos CSS para as tabs
    const style = document.createElement('style');
    style.textContent = `
        .tab-button.active {
            border-color: #3b82f6;
            color: #2563eb;
        }
        .tab-button {
            border-color: transparent;
            color: #6b7280;
        }
        .tab-button:hover {
            color: #374151;
            border-color: #d1d5db;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection
