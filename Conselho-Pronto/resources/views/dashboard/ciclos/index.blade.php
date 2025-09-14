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
                                <button class="px-4 py-2 border border-blue-200 text-blue-700 hover:bg-blue-50 hover:border-blue-300 rounded-md text-sm">
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
</script>
@endsection
