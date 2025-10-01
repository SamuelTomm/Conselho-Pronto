@extends('layouts.dashboard')

@section('title', 'Editar Disciplina')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Editar Disciplina</h1>
                    <p class="text-slate-600">Edite as informações da disciplina: {{ $disciplina->nome }}</p>
                </div>
                <a href="{{ route('disciplinas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    <span>Voltar</span>
                </a>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-xl border-0">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <h2 class="text-slate-800 text-xl font-semibold">Informações da Disciplina</h2>
                        <p class="text-slate-600">Edite os dados da disciplina</p>
                    </div>
                    
                    <form method="POST" action="{{ route('disciplinas.update', $disciplina->id) }}" class="p-6">
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
                                    <label for="codigo" class="block text-sm font-medium text-slate-700 mb-2">Código da Disciplina *</label>
                                    <input type="text" 
                                           id="codigo" 
                                           name="codigo" 
                                           value="{{ old('codigo', $disciplina->codigo) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('codigo') border-red-500 @enderror"
                                           placeholder="Ex: MAT301, FIS201, PROG101"
                                           required>
                                    @error('codigo')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nome -->
                                <div>
                                    <label for="nome" class="block text-sm font-medium text-slate-700 mb-2">Nome da Disciplina *</label>
                                    <input type="text" 
                                           id="nome" 
                                           name="nome" 
                                           value="{{ old('nome', $disciplina->nome) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('nome') border-red-500 @enderror"
                                           placeholder="Ex: Matemática III, Física II, Programação I"
                                           required>
                                    @error('nome')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Curso -->
                                <div>
                                    <label for="curso" class="block text-sm font-medium text-slate-700 mb-2">Curso *</label>
                                    <input type="text" 
                                           id="curso" 
                                           name="curso" 
                                           value="{{ old('curso', $disciplina->curso) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('curso') border-red-500 @enderror"
                                           placeholder="Ex: Formação Básica, Itinerário de Exatas, Técnico em Informática"
                                           required>
                                    @error('curso')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Período -->
                                <div>
                                    <label for="periodo" class="block text-sm font-medium text-slate-700 mb-2">Período *</label>
                                    <input type="text" 
                                           id="periodo" 
                                           name="periodo" 
                                           value="{{ old('periodo', $disciplina->periodo) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('periodo') border-red-500 @enderror"
                                           placeholder="Ex: 2024/1, 2024/2"
                                           required>
                                    @error('periodo')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Carga Horária -->
                                <div>
                                    <label for="carga_horaria" class="block text-sm font-medium text-slate-700 mb-2">Carga Horária *</label>
                                    <input type="number" 
                                           id="carga_horaria" 
                                           name="carga_horaria" 
                                           value="{{ old('carga_horaria', $disciplina->carga_horaria) }}"
                                           min="1"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('carga_horaria') border-red-500 @enderror"
                                           placeholder="Ex: 80, 120, 60"
                                           required>
                                    @error('carga_horaria')
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
                                        <option value="blue" {{ old('cor', $disciplina->cor) == 'blue' ? 'selected' : '' }}>Azul</option>
                                        <option value="green" {{ old('cor', $disciplina->cor) == 'green' ? 'selected' : '' }}>Verde</option>
                                        <option value="purple" {{ old('cor', $disciplina->cor) == 'purple' ? 'selected' : '' }}>Roxo</option>
                                        <option value="orange" {{ old('cor', $disciplina->cor) == 'orange' ? 'selected' : '' }}>Laranja</option>
                                        <option value="pink" {{ old('cor', $disciplina->cor) == 'pink' ? 'selected' : '' }}>Rosa</option>
                                        <option value="emerald" {{ old('cor', $disciplina->cor) == 'emerald' ? 'selected' : '' }}>Esmeralda</option>
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
                                <label for="descricao" class="block text-sm font-medium text-slate-700 mb-2">Descrição da Disciplina *</label>
                                <textarea id="descricao" 
                                          name="descricao" 
                                          rows="4"
                                          class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('descricao') border-red-500 @enderror"
                                          placeholder="Descreva a disciplina, seus objetivos e conteúdo programático..."
                                          required>{{ old('descricao', $disciplina->descricao) }}</textarea>
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
                                    <label for="total_alunos" class="block text-sm font-medium text-slate-700 mb-2">Número de Alunos</label>
                                    <input type="number" 
                                           id="total_alunos" 
                                           name="total_alunos" 
                                           value="{{ old('total_alunos', $disciplina->total_alunos) }}"
                                           min="0"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('total_alunos') border-red-500 @enderror">
                                    @error('total_alunos')
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
                                           {{ old('ativo', $disciplina->ativo) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="ativo" class="ml-2 text-sm font-medium text-slate-700">
                                        Disciplina ativa
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('disciplinas.index') }}" 
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
