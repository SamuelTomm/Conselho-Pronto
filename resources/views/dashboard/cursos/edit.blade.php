@extends('layouts.dashboard')

@section('title', 'Editar Curso')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Editar Curso</h1>
                    <p class="text-slate-600">Edite as informações do curso: {{ $curso->nome }}</p>
                </div>
                <a href="{{ route('cursos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    <span>Voltar</span>
                </a>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-xl border-0">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <h2 class="text-slate-800 text-xl font-semibold">Informações do Curso</h2>
                        <p class="text-slate-600">Edite os dados do curso</p>
                    </div>
                    
                    <form method="POST" action="{{ route('cursos.update', $curso->id) }}" class="p-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Dados Básicos -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="book-open" class="h-5 w-5 mr-2 text-blue-600"></i>
                                Dados Básicos
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Código -->
                                <div>
                                    <label for="codigo" class="block text-sm font-medium text-slate-700 mb-2">Código do Curso *</label>
                                    <input type="text" 
                                           id="codigo" 
                                           name="codigo" 
                                           value="{{ old('codigo', $curso->codigo) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('codigo') border-red-500 @enderror"
                                           placeholder="Ex: BASICO, EXATAS, TEC_TI"
                                           required>
                                    @error('codigo')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nome -->
                                <div>
                                    <label for="nome" class="block text-sm font-medium text-slate-700 mb-2">Nome do Curso *</label>
                                    <input type="text" 
                                           id="nome" 
                                           name="nome" 
                                           value="{{ old('nome', $curso->nome) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('nome') border-red-500 @enderror"
                                           placeholder="Ex: Formação Básica, Itinerário de Exatas"
                                           required>
                                    @error('nome')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Tipo -->
                                <div>
                                    <label for="tipo" class="block text-sm font-medium text-slate-700 mb-2">Tipo do Curso *</label>
                                    <select id="tipo" 
                                            name="tipo" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('tipo') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione o tipo</option>
                                        <option value="Básico" {{ old('tipo', $curso->tipo) == 'Básico' ? 'selected' : '' }}>Básico</option>
                                        <option value="Itinerário" {{ old('tipo', $curso->tipo) == 'Itinerário' ? 'selected' : '' }}>Itinerário</option>
                                        <option value="Técnico" {{ old('tipo', $curso->tipo) == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                                    </select>
                                    @error('tipo')
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
                                        <option value="blue" {{ old('cor', $curso->cor) == 'blue' ? 'selected' : '' }}>Azul</option>
                                        <option value="green" {{ old('cor', $curso->cor) == 'green' ? 'selected' : '' }}>Verde</option>
                                        <option value="purple" {{ old('cor', $curso->cor) == 'purple' ? 'selected' : '' }}>Roxo</option>
                                        <option value="orange" {{ old('cor', $curso->cor) == 'orange' ? 'selected' : '' }}>Laranja</option>
                                        <option value="pink" {{ old('cor', $curso->cor) == 'pink' ? 'selected' : '' }}>Rosa</option>
                                        <option value="emerald" {{ old('cor', $curso->cor) == 'emerald' ? 'selected' : '' }}>Esmeralda</option>
                                    </select>
                                    @error('cor')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="file-text" class="h-5 w-5 mr-2 text-green-600"></i>
                                Descrição
                            </h3>
                            
                            <div>
                                <label for="descricao" class="block text-sm font-medium text-slate-700 mb-2">Descrição do Curso *</label>
                                <textarea id="descricao" 
                                          name="descricao" 
                                          rows="4"
                                          class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('descricao') border-red-500 @enderror"
                                          placeholder="Descreva o curso, suas disciplinas e objetivos..."
                                          required>{{ old('descricao', $curso->descricao) }}</textarea>
                                @error('descricao')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
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
                                           value="{{ old('alunos_count', $curso->alunos_count) }}"
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
                                           value="{{ old('disciplinas_count', $curso->disciplinas_count) }}"
                                           min="0"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('disciplinas_count') border-red-500 @enderror">
                                    @error('disciplinas_count')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="settings" class="h-5 w-5 mr-2 text-orange-600"></i>
                                Configurações
                            </h3>
                            
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           id="ativo" 
                                           name="ativo" 
                                           value="1"
                                           {{ old('ativo', $curso->ativo) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="ativo" class="ml-2 text-sm font-medium text-slate-700">
                                        Curso ativo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('cursos.index') }}" 
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
