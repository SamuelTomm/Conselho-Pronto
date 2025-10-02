@extends('layouts.dashboard')

@section('title', 'Editar Professor')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Editar Professor</h1>
                    <p class="text-slate-600">Edite as informações do professor: {{ $professor->name }}</p>
                </div>
                <a href="{{ route('professores.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    <span>Voltar</span>
                </a>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-xl border-0">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <h2 class="text-slate-800 text-xl font-semibold">Informações do Professor</h2>
                        <p class="text-slate-600">Edite os dados do professor</p>
                    </div>
                    
                    <form method="POST" action="{{ route('professores.update', $professor->id) }}" class="p-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Dados Pessoais -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="user" class="h-5 w-5 mr-2 text-blue-600"></i>
                                Dados Pessoais
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nome -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nome Completo *</label>
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $professor->name) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('name') border-red-500 @enderror"
                                           required>
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email *</label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $professor->email) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('email') border-red-500 @enderror"
                                           required>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Senha -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Nova Senha</label>
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('password') border-red-500 @enderror"
                                           placeholder="Deixe em branco para manter a senha atual">
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirmação de Senha -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Confirmar Nova Senha</label>
                                    <input type="password" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('password_confirmation') border-red-500 @enderror"
                                           placeholder="Confirme a nova senha">
                                    @error('password_confirmation')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Dados Profissionais -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="briefcase" class="h-5 w-5 mr-2 text-green-600"></i>
                                Dados Profissionais
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Função -->
                                <div>
                                    <label for="role" class="block text-sm font-medium text-slate-700 mb-2">Função *</label>
                                    <select id="role" 
                                            name="role" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('role') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione a função</option>
                                        <option value="professor" {{ old('role', $professor->role) == 'professor' ? 'selected' : '' }}>Professor</option>
                                        <option value="coordenador" {{ old('role', $professor->role) == 'coordenador' ? 'selected' : '' }}>Coordenador</option>
                                    </select>
                                    @error('role')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Especialidades -->
                                <div>
                                    <label for="especialidade" class="block text-sm font-medium text-slate-700 mb-2">Especialidades</label>
                                    
                                    <!-- Campo oculto para enviar os dados -->
                                    <input type="hidden" name="especialidade" id="especialidade-hidden" value="{{ old('especialidade', $professor->especialidade ?? '') }}">
                                    
                                    <!-- Select para adicionar especialidades -->
                                    <select id="especialidade" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('especialidade') border-red-500 @enderror">
                                        <option value="">Selecione uma especialidade para adicionar</option>
                                        <option value="História">História</option>
                                        <option value="Matemática">Matemática</option>
                                        <option value="Português">Português</option>
                                        <option value="Geografia">Geografia</option>
                                        <option value="Física">Física</option>
                                        <option value="Química">Química</option>
                                        <option value="Biologia">Biologia</option>
                                        <option value="Educação Física">Educação Física</option>
                                        <option value="Arte">Arte</option>
                                        <option value="Filosofia">Filosofia</option>
                                        <option value="Sociologia">Sociologia</option>
                                        <option value="Inglês">Inglês</option>
                                        <option value="Espanhol">Espanhol</option>
                                        <option value="Informática">Informática</option>
                                        <option value="Eletrotécnica">Eletrotécnica</option>
                                    </select>
                                    
                                    <!-- Container para mostrar as especialidades selecionadas -->
                                    <div id="especialidades-container" class="mt-2 flex flex-wrap gap-2">
                                        <!-- As especialidades selecionadas aparecerão aqui -->
                                    </div>
                                    
                                    <p class="text-xs text-gray-500 mt-1">Selecione especialidades do dropdown acima para adicioná-las</p>
                                    @error('especialidade')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Telefone -->
                                <div>
                                    <label for="telefone" class="block text-sm font-medium text-slate-700 mb-2">Telefone</label>
                                    <input type="text" 
                                           id="telefone" 
                                           name="telefone" 
                                           value="{{ old('telefone', $professor->telefone ?? '') }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('telefone') border-red-500 @enderror">
                                    @error('telefone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Data de Admissão -->
                                <div>
                                    <label for="data_admissao" class="block text-sm font-medium text-slate-700 mb-2">Data de Admissão</label>
                                    <input type="date" 
                                           id="data_admissao" 
                                           name="data_admissao" 
                                           value="{{ old('data_admissao', $professor->data_admissao ?? '') }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('data_admissao') border-red-500 @enderror">
                                    @error('data_admissao')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Turmas e Disciplinas -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="graduation-cap" class="h-5 w-5 mr-2 text-purple-600"></i>
                                Atribuições
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Turmas -->
                                <div>
                                    <label for="turmas_ids" class="block text-sm font-medium text-slate-700 mb-2">Turmas</label>
                                    
                                    <!-- Campo oculto para enviar os dados -->
                                    <input type="hidden" name="turmas_ids" id="turmas-hidden" value="{{ old('turmas_ids', json_encode($professor->turmas_ids ?? [])) }}">
                                    
                                    <!-- Select para adicionar turmas -->
                                    <select id="turmas-select" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('turmas_ids') border-red-500 @enderror">
                                        <option value="">Selecione uma turma para adicionar</option>
                                        @foreach($turmas as $turma)
                                            <option value="{{ $turma->id }}" data-nome="{{ $turma->nome }}">
                                                {{ $turma->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    <!-- Container para mostrar as turmas selecionadas -->
                                    <div id="turmas-container" class="mt-2 flex flex-wrap gap-2">
                                        <!-- As turmas selecionadas aparecerão aqui -->
                                    </div>
                                    
                                    <p class="text-xs text-gray-500 mt-1">Selecione turmas do dropdown acima para adicioná-las</p>
                                    @error('turmas_ids')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Disciplinas -->
                                <div>
                                    <label for="disciplinas_ids" class="block text-sm font-medium text-slate-700 mb-2">Disciplinas</label>
                                    <select id="disciplinas_ids" 
                                            name="disciplinas_ids[]" 
                                            multiple
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('disciplinas_ids') border-red-500 @enderror"
                                            size="4">
                                        @foreach($disciplinas as $disciplina)
                                            <option value="{{ $disciplina->id }}" {{ in_array($disciplina->id, old('disciplinas_ids', $professor->disciplinas_ids ?? [])) ? 'selected' : '' }}>
                                                {{ $disciplina->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Segure Ctrl (ou Cmd no Mac) para selecionar múltiplas disciplinas</p>
                                    @error('disciplinas_ids')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Observações -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="file-text" class="h-5 w-5 mr-2 text-orange-600"></i>
                                Observações
                            </h3>
                            
                            <div>
                                <label for="observacoes" class="block text-sm font-medium text-slate-700 mb-2">Observações</label>
                                <textarea id="observacoes" 
                                          name="observacoes" 
                                          rows="3"
                                          class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('observacoes') border-red-500 @enderror"
                                          placeholder="Observações adicionais sobre o professor...">{{ old('observacoes', $professor->observacoes ?? '') }}</textarea>
                                @error('observacoes')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="settings" class="h-5 w-5 mr-2 text-slate-600"></i>
                                Configurações
                            </h3>
                            
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           id="ativo" 
                                           name="ativo" 
                                           value="1"
                                           {{ old('ativo', $professor->ativo ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="ativo" class="ml-2 text-sm font-medium text-slate-700">
                                        Professor ativo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('professores.index') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center space-x-2">
                                <i data-lucide="save" class="h-4 w-4"></i>
                                <span>Salvar Alterações</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
// Initialize Lucide icons
lucide.createIcons();

// Sistema de especialidades múltiplas
document.addEventListener('DOMContentLoaded', function() {
    const especialidadeSelect = document.getElementById('especialidade');
    const especialidadeHidden = document.getElementById('especialidade-hidden');
    const especialidadesContainer = document.getElementById('especialidades-container');
    
    // Array para armazenar especialidades selecionadas
    let especialidadesSelecionadas = [];
    
    // Carregar especialidades do old input ou do professor
    const oldEspecialidade = especialidadeHidden.value;
    if (oldEspecialidade) {
        // Se for uma string com vírgulas, dividir em array
        especialidadesSelecionadas = oldEspecialidade.includes(',') 
            ? oldEspecialidade.split(',').map(e => e.trim()).filter(e => e)
            : [oldEspecialidade];
        renderizarEspecialidades();
    }
    
    // Inicializar opções disponíveis
    atualizarOpcoesDisponiveis();
    
    // Event listener para o select
    especialidadeSelect.addEventListener('change', function() {
        const valorSelecionado = this.value;
        
        if (valorSelecionado && !especialidadesSelecionadas.includes(valorSelecionado)) {
            especialidadesSelecionadas.push(valorSelecionado);
            renderizarEspecialidades();
            atualizarCampoHidden();
            atualizarOpcoesDisponiveis();
            
            // Resetar o select
            this.value = '';
        }
    });
    
    // Função para renderizar as especialidades selecionadas
    function renderizarEspecialidades() {
        especialidadesContainer.innerHTML = '';
        
        especialidadesSelecionadas.forEach((especialidade, index) => {
            const tag = document.createElement('div');
            tag.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200';
            tag.innerHTML = `
                <span>${especialidade}</span>
                <button type="button" 
                        onclick="removerEspecialidade(${index})" 
                        class="ml-2 text-blue-600 hover:text-blue-800 focus:outline-none">
                    <i data-lucide="x" class="h-3 w-3"></i>
                </button>
            `;
            especialidadesContainer.appendChild(tag);
        });
        
        // Re-inicializar ícones Lucide para os novos elementos
        lucide.createIcons();
    }
    
    // Função para remover especialidade
    window.removerEspecialidade = function(index) {
        especialidadesSelecionadas.splice(index, 1);
        renderizarEspecialidades();
        atualizarCampoHidden();
        atualizarOpcoesDisponiveis();
    };
    
    // Função para atualizar as opções disponíveis no select
    function atualizarOpcoesDisponiveis() {
        // Lista completa de especialidades
        const todasEspecialidades = [
            'História', 'Matemática', 'Português', 'Geografia', 'Física', 
            'Química', 'Biologia', 'Educação Física', 'Arte', 'Filosofia', 
            'Sociologia', 'Inglês', 'Espanhol', 'Informática', 'Eletrotécnica'
        ];
        
        // Filtrar especialidades já selecionadas
        const especialidadesDisponiveis = todasEspecialidades.filter(
            especialidade => !especialidadesSelecionadas.includes(especialidade)
        );
        
        // Limpar o select (exceto a primeira opção)
        especialidadeSelect.innerHTML = '<option value="">Selecione uma especialidade para adicionar</option>';
        
        // Adicionar opções disponíveis
        especialidadesDisponiveis.forEach(especialidade => {
            const option = document.createElement('option');
            option.value = especialidade;
            option.textContent = especialidade;
            especialidadeSelect.appendChild(option);
        });
    }
    
    // Função para atualizar o campo hidden
    function atualizarCampoHidden() {
        // Como o controller espera uma string única, vamos enviar todas as especialidades
        // separadas por vírgula ou apenas a primeira se preferir
        especialidadeHidden.value = especialidadesSelecionadas.join(', ');
    }
    
    // Tornar as funções globais para acesso via onclick
    window.renderizarEspecialidades = renderizarEspecialidades;
    window.atualizarCampoHidden = atualizarCampoHidden;
});
</script>
@endsection
