@extends('layouts.dashboard')

@section('title', 'Cursos')
@section('page-title', 'Cursos')
@section('page-description', 'Gestão de Cursos do Ensino Médio')

@section('content')
<div class="shadow-xl border-0 bg-white/90 backdrop-blur-sm rounded-lg">
    <!-- Header do Card -->
    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Gestão de Cursos</h3>
                <p class="text-sm text-slate-600">Gerencie os cursos do Ensino Médio: Básico, Itinerários e Técnicos</p>
            </div>
            <button 
                onclick="openModal()"
                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 px-4 py-2 rounded-lg"
            >
                <i data-lucide="plus" class="h-4 w-4 mr-2 inline"></i>
                Novo Curso
            </button>
        </div>
    </div>
    
    <!-- Conteúdo do Card -->
    <div class="p-6">
        <!-- Filtros e Busca -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">Show</span>
                    <select 
                        class="w-20 border border-blue-200 rounded-md px-2 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400"
                        onchange="updatePerPage(this.value)"
                    >
                        <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                    </select>
                    <span class="text-sm text-gray-600">entries</span>
                </div>
                
                <!-- Filtro por Tipo -->
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">Tipo:</span>
                    <select 
                        class="border border-blue-200 rounded-md px-2 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400"
                        onchange="filterByType(this.value)"
                    >
                        <option value="">Todos</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo }}" {{ $tipo == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Search:</span>
                <form method="GET" class="flex items-center space-x-2">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search" 
                        class="w-48 border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400"
                    />
                    <input type="hidden" name="per_page" value="{{ $perPage }}">
                    <input type="hidden" name="tipo" value="{{ $tipo }}">
                    <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        <i data-lucide="search" class="h-4 w-4"></i>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Tabela de Cursos -->
        <div class="border rounded-lg overflow-hidden shadow-sm bg-white">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-100 to-slate-100 border-b border-blue-200">
                        <th class="text-slate-700 font-semibold px-3 py-2 text-left w-20">Código</th>
                        <th class="text-slate-700 font-semibold px-3 py-2 text-left">Nome do Curso</th>
                        <th class="text-slate-700 font-semibold px-3 py-2 text-left w-24">Tipo</th>
                        <th class="text-slate-700 font-semibold px-3 py-2 text-left w-20">Alunos</th>
                        <th class="text-slate-700 font-semibold px-3 py-2 text-left w-24">Disciplinas</th>
                        <th class="text-slate-700 font-semibold px-3 py-2 text-center w-16">Ações</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @forelse($cursos as $curso)
                    <tr class="hover:bg-blue-50/50 transition-colors border-b border-gray-100">
                        <td class="font-medium text-slate-700 px-3 py-2">{{ $curso['codigo'] }}</td>
                        <td class="px-3 py-2">
                            <div class="flex flex-col">
                                <span class="font-medium text-slate-800 text-sm">{{ $curso['nome'] }}</span>
                                <span class="text-xs text-gray-500 leading-tight">{{ Str::limit($curso['descricao'], 60) }}</span>
                            </div>
                        </td>
                        <td class="px-3 py-2">
                            @php
                                $cores = [
                                    'Básico' => 'bg-blue-100 text-blue-800',
                                    'Itinerário' => 'bg-green-100 text-green-800', 
                                    'Técnico' => 'bg-orange-100 text-orange-800'
                                ];
                                $corClasse = $cores[$curso['tipo']] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $corClasse }}">
                                {{ $curso['tipo'] }}
                            </span>
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex items-center space-x-1">
                                <i data-lucide="graduation-cap" class="h-3 w-3 text-slate-500"></i>
                                <span class="text-slate-700 text-sm">{{ $curso['alunos_count'] ?? 0 }}</span>
                            </div>
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex items-center space-x-1">
                                <i data-lucide="book-open" class="h-3 w-3 text-slate-500"></i>
                                <span class="text-slate-700 text-sm">{{ $curso['disciplinas_count'] ?? 0 }}</span>
                            </div>
                        </td>
                        <td class="text-center px-3 py-2">
                            <div class="relative inline-block text-left" x-data="{ open: false }">
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
                                    class="absolute right-0 z-10 mt-2 w-52 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                                >
                                    <div class="py-1">
                                        <a 
                                            href="{{ route('cursos.turmas', $curso['id']) }}"
                                            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >
                                            <i data-lucide="users" class="h-4 w-4 mr-2"></i>
                                            Visualizar Turmas
                                        </a>
                                        <a 
                                            href="{{ route('cursos.materias', $curso['id']) }}"
                                            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >
                                            <i data-lucide="book-open" class="h-4 w-4 mr-2"></i>
                                            Visualizar Matérias
                                        </a>
                                        <a 
                                            href="{{ route('cursos.alunos', $curso['id']) }}"
                                            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >
                                            <i data-lucide="graduation-cap" class="h-4 w-4 mr-2"></i>
                                            Visualizar Alunos
                                        </a>
                                        <a 
                                            href="{{ route('cursos.edit', $curso['id']) }}"
                                            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >
                                            <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                                            Editar
                                        </a>
                                        <button 
                                            onclick="deleteCurso({{ $curso['id'] }})"
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
                        <td colspan="6" class="text-center py-8 text-gray-500">
                            <i data-lucide="book-open" class="h-12 w-12 mx-auto mb-4 text-gray-300"></i>
                            <p>Nenhum curso encontrado</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginação -->
        <div class="flex items-center justify-between mt-4">
            <p class="text-sm text-gray-500">
                Showing {{ $cursos->firstItem() ?? 0 }} to {{ $cursos->lastItem() ?? 0 }} of {{ $cursos->total() }} entries
            </p>
            <div class="flex items-center space-x-2">
                @if($cursos->previousPageUrl())
                    <a href="{{ $cursos->previousPageUrl() }}" class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 hover:bg-blue-50">
                        <i data-lucide="chevron-left" class="h-4 w-4"></i>
                    </a>
                @else
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed" disabled>
                        <i data-lucide="chevron-left" class="h-4 w-4"></i>
                    </button>
                @endif
                
                <span class="text-sm font-medium text-slate-700">{{ $cursos->currentPage() }} / {{ $cursos->lastPage() }}</span>
                
                @if($cursos->nextPageUrl())
                    <a href="{{ $cursos->nextPageUrl() }}" class="px-3 py-1 border border-blue-200 rounded-md text-blue-600 hover:bg-blue-50">
                        <i data-lucide="chevron-right" class="h-4 w-4"></i>
                    </a>
                @else
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed" disabled>
                        <i data-lucide="chevron-right" class="h-4 w-4"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal de Adicionar/Editar Curso -->
<div id="modal-curso" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2" id="form-title">
                            Novo Curso
                        </h3>
                        <p class="text-sm text-gray-500 mb-4">
                            Adicione um novo curso ao sistema.
                        </p>
                        
                        <form id="form-curso" method="POST" action="{{ route('cursos.store') }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Código</label>
                                    <input 
                                        type="text" 
                                        id="codigo"
                                        name="codigo"
                                        placeholder="Ex: TEC_TI"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Curso</label>
                                    <input 
                                        type="text" 
                                        id="nome"
                                        name="nome"
                                        placeholder="Ex: Técnico em Informática"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                                    <textarea 
                                        id="descricao"
                                        name="descricao"
                                        placeholder="Descrição do curso"
                                        rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    ></textarea>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                                        <select 
                                            id="tipo"
                                            name="tipo"
                                            required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        >
                                            <option value="">Selecione</option>
                                            <option value="Básico">Básico</option>
                                            <option value="Itinerário">Itinerário</option>
                                            <option value="Técnico">Técnico</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Cor</label>
                                        <select 
                                            id="cor"
                                            name="cor"
                                            required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        >
                                            <option value="">Selecione</option>
                                            <option value="blue">Azul</option>
                                            <option value="green">Verde</option>
                                            <option value="purple">Roxo</option>
                                            <option value="orange">Laranja</option>
                                            <option value="pink">Rosa</option>
                                            <option value="emerald">Esmeralda</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <input 
                                        type="checkbox" 
                                        id="ativo"
                                        name="ativo"
                                        value="1"
                                        checked
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                    />
                                    <label for="ativo" class="ml-2 block text-sm text-gray-700">
                                        Curso ativo
                                    </label>
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
                    form="form-curso"
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

<script>
// Initialize Lucide icons
lucide.createIcons();

// Modal de Cursos
function openModal(curso = null) {
    const modal = document.getElementById('modal-curso');
    const form = document.getElementById('form-curso');
    
    if (curso) {
        // Preencher formulário para edição
        document.getElementById('codigo').value = curso.codigo;
        document.getElementById('nome').value = curso.nome;
        document.getElementById('descricao').value = curso.descricao || '';
        document.getElementById('tipo').value = curso.tipo;
        document.getElementById('cor').value = curso.cor;
        document.getElementById('ativo').checked = curso.ativo;
        document.getElementById('form-title').textContent = 'Editar Curso';
        document.getElementById('submit-btn').textContent = 'Salvar';
        form.action = '{{ route("cursos.update", ":id") }}'.replace(':id', curso.id);
        form.innerHTML += '<input type="hidden" name="_method" value="PUT">';
    } else {
        // Limpar formulário para novo curso
        form.reset();
        document.getElementById('form-title').textContent = 'Novo Curso';
        document.getElementById('submit-btn').textContent = 'Adicionar';
        form.action = '{{ route("cursos.store") }}';
        // Remover input _method se existir
        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }
    }
    
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal-curso').classList.add('hidden');
}

// Filtros
function updatePerPage(value) {
    const url = new URL(window.location);
    url.searchParams.set('per_page', value);
    window.location.href = url.toString();
}

function filterByType(value) {
    const url = new URL(window.location);
    if (value) {
        url.searchParams.set('tipo', value);
    } else {
        url.searchParams.delete('tipo');
    }
    window.location.href = url.toString();
}

// Excluir Curso
function deleteCurso(id) {
    if (confirm('Tem certeza que deseja excluir este curso?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("cursos.destroy", ":id") }}'.replace(':id', id);
        
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
