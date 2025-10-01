@extends('layouts.dashboard')

@section('title', 'Editar Turma')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Editar Turma</h1>
                    <p class="text-slate-600">Edite as informações da turma: {{ $turma->nome }}</p>
                </div>
                <a href="{{ route('turmas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    <span>Voltar</span>
                </a>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-xl border-0">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <h2 class="text-slate-800 text-xl font-semibold">Informações da Turma</h2>
                        <p class="text-slate-600">Edite os dados da turma</p>
                    </div>
                    
                    <form method="POST" action="{{ route('turmas.update', $turma->id) }}" class="p-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Dados Básicos -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="users" class="h-5 w-5 mr-2 text-blue-600"></i>
                                Dados Básicos
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Código -->
                                <div>
                                    <label for="codigo" class="block text-sm font-medium text-slate-700 mb-2">Código da Turma *</label>
                                    <input type="text" 
                                           id="codigo" 
                                           name="codigo" 
                                           value="{{ old('codigo', $turma->codigo) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('codigo') border-red-500 @enderror"
                                           placeholder="Ex: 3A2024, 2B2024, 1TI2024"
                                           required>
                                    @error('codigo')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nome -->
                                <div>
                                    <label for="nome" class="block text-sm font-medium text-slate-700 mb-2">Nome da Turma *</label>
                                    <input type="text" 
                                           id="nome" 
                                           name="nome" 
                                           value="{{ old('nome', $turma->nome) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('nome') border-red-500 @enderror"
                                           placeholder="Ex: 3º Ano A, 2º Ano B, 1º Técnico em Informática"
                                           required>
                                    @error('nome')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nível -->
                                <div>
                                    <label for="nivel" class="block text-sm font-medium text-slate-700 mb-2">Nível *</label>
                                    <select id="nivel" 
                                            name="nivel" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('nivel') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione o nível</option>
                                        <option value="Ensino Fundamental" {{ old('nivel', $turma->nivel) == 'Ensino Fundamental' ? 'selected' : '' }}>Ensino Fundamental</option>
                                        <option value="Ensino Médio" {{ old('nivel', $turma->nivel) == 'Ensino Médio' ? 'selected' : '' }}>Ensino Médio</option>
                                        <option value="Técnico" {{ old('nivel', $turma->nivel) == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                                    </select>
                                    @error('nivel')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Ano -->
                                <div>
                                    <label for="ano" class="block text-sm font-medium text-slate-700 mb-2">Ano Letivo *</label>
                                    <input type="text" 
                                           id="ano" 
                                           name="ano" 
                                           value="{{ old('ano', $turma->ano) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('ano') border-red-500 @enderror"
                                           placeholder="Ex: 2024"
                                           required>
                                    @error('ano')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Período -->
                                <div>
                                    <label for="periodo" class="block text-sm font-medium text-slate-700 mb-2">Período *</label>
                                    <select id="periodo" 
                                            name="periodo" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('periodo') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione o período</option>
                                        <option value="Matutino" {{ old('periodo', $turma->periodo) == 'Matutino' ? 'selected' : '' }}>Matutino</option>
                                        <option value="Vespertino" {{ old('periodo', $turma->periodo) == 'Vespertino' ? 'selected' : '' }}>Vespertino</option>
                                        <option value="Noturno" {{ old('periodo', $turma->periodo) == 'Noturno' ? 'selected' : '' }}>Noturno</option>
                                        <option value="Integral" {{ old('periodo', $turma->periodo) == 'Integral' ? 'selected' : '' }}>Integral</option>
                                    </select>
                                    @error('periodo')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sala -->
                                <div>
                                    <label for="sala" class="block text-sm font-medium text-slate-700 mb-2">Sala</label>
                                    <input type="text" 
                                           id="sala" 
                                           name="sala" 
                                           value="{{ old('sala', $turma->sala) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('sala') border-red-500 @enderror"
                                           placeholder="Ex: Sala 101, Lab 01, Ateliê 01">
                                    @error('sala')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Responsável -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="user-check" class="h-5 w-5 mr-2 text-green-600"></i>
                                Responsável
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Conselheiro -->
                                <div>
                                    <label for="conselheiro" class="block text-sm font-medium text-slate-700 mb-2">Conselheiro *</label>
                                    <input type="text" 
                                           id="conselheiro" 
                                           name="conselheiro" 
                                           value="{{ old('conselheiro', $turma->conselheiro) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('conselheiro') border-red-500 @enderror"
                                           placeholder="Ex: Prof. Maria Silva"
                                           required>
                                    @error('conselheiro')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Cor -->
                                <div>
                                    <label for="cor" class="block text-sm font-medium text-slate-700 mb-2">Cor do Badge *</label>
                                    <select id="cor" 
                                            name="cor" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('cor') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione a cor</option>
                                        <option value="blue" {{ old('cor', $turma->cor) == 'blue' ? 'selected' : '' }}>Azul</option>
                                        <option value="green" {{ old('cor', $turma->cor) == 'green' ? 'selected' : '' }}>Verde</option>
                                        <option value="purple" {{ old('cor', $turma->cor) == 'purple' ? 'selected' : '' }}>Roxo</option>
                                        <option value="orange" {{ old('cor', $turma->cor) == 'orange' ? 'selected' : '' }}>Laranja</option>
                                        <option value="pink" {{ old('cor', $turma->cor) == 'pink' ? 'selected' : '' }}>Rosa</option>
                                        <option value="emerald" {{ old('cor', $turma->cor) == 'emerald' ? 'selected' : '' }}>Esmeralda</option>
                                    </select>
                                    @error('cor')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Estatísticas -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="bar-chart-3" class="h-5 w-5 mr-2 text-purple-600"></i>
                                Estatísticas
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Número de Alunos -->
                                <div>
                                    <label for="alunos_count" class="block text-sm font-medium text-slate-700 mb-2">Número de Alunos</label>
                                    <input type="number" 
                                           id="alunos_count" 
                                           name="alunos_count" 
                                           value="{{ old('alunos_count', $turma->alunos_count) }}"
                                           min="0"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('alunos_count') border-red-500 @enderror">
                                    @error('alunos_count')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Número de Disciplinas -->
                                <div>
                                    <label for="disciplinas_count" class="block text-sm font-medium text-slate-700 mb-2">Número de Disciplinas</label>
                                    <input type="number" 
                                           id="disciplinas_count" 
                                           name="disciplinas_count" 
                                           value="{{ old('disciplinas_count', $turma->disciplinas_count) }}"
                                           min="0"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('disciplinas_count') border-red-500 @enderror">
                                    @error('disciplinas_count')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="file-text" class="h-5 w-5 mr-2 text-orange-600"></i>
                                Descrição
                            </h3>
                            
                            <div>
                                <label for="descricao" class="block text-sm font-medium text-slate-700 mb-2">Descrição da Turma</label>
                                <textarea id="descricao" 
                                          name="descricao" 
                                          rows="3"
                                          class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('descricao') border-red-500 @enderror"
                                          placeholder="Descreva a turma, suas características e objetivos...">{{ old('descricao', $turma->descricao) }}</textarea>
                                @error('descricao')
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
                                           id="status" 
                                           name="status" 
                                           value="Ativa"
                                           {{ old('status', $turma->status) == 'Ativa' ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="status" class="ml-2 text-sm font-medium text-slate-700">
                                        Turma ativa
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('turmas.index') }}" 
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
</script>
@endsection
