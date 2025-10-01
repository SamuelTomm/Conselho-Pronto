@extends('layouts.dashboard')

@section('title', 'Nova Nota')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Nova Nota</h1>
                    <p class="text-slate-600">Cadastre uma nova nota no sistema</p>
                </div>
                <a href="{{ route('notas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    <span>Voltar</span>
                </a>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-xl border-0">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <h2 class="text-slate-800 text-xl font-semibold">Informações da Nota</h2>
                        <p class="text-slate-600">Preencha os dados da nota</p>
                    </div>
                    
                    <form method="POST" action="{{ route('notas.store') }}" class="p-6">
                        @csrf
                        
                        <!-- Dados da Nota -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="clipboard-list" class="h-5 w-5 mr-2 text-blue-600"></i>
                                Dados da Nota
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Aluno -->
                                <div>
                                    <label for="aluno_id" class="block text-sm font-medium text-slate-700 mb-2">Aluno *</label>
                                    <select id="aluno_id" 
                                            name="aluno_id" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('aluno_id') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione o aluno</option>
                                        <option value="1" {{ old('aluno_id') == '1' ? 'selected' : '' }}>João Silva - 3º Ano A</option>
                                        <option value="2" {{ old('aluno_id') == '2' ? 'selected' : '' }}>Maria Santos - 3º Ano A</option>
                                        <option value="3" {{ old('aluno_id') == '3' ? 'selected' : '' }}>Pedro Costa - 2º Ano B</option>
                                        <option value="4" {{ old('aluno_id') == '4' ? 'selected' : '' }}>Ana Lima - 2º Ano B</option>
                                        <option value="5" {{ old('aluno_id') == '5' ? 'selected' : '' }}>Carlos Ferreira - 1º Ano C</option>
                                    </select>
                                    @error('aluno_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Disciplina -->
                                <div>
                                    <label for="disciplina_id" class="block text-sm font-medium text-slate-700 mb-2">Disciplina *</label>
                                    <select id="disciplina_id" 
                                            name="disciplina_id" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('disciplina_id') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione a disciplina</option>
                                        <option value="1" {{ old('disciplina_id') == '1' ? 'selected' : '' }}>Matemática III</option>
                                        <option value="2" {{ old('disciplina_id') == '2' ? 'selected' : '' }}>Física II</option>
                                        <option value="3" {{ old('disciplina_id') == '3' ? 'selected' : '' }}>Programação I</option>
                                        <option value="4" {{ old('disciplina_id') == '4' ? 'selected' : '' }}>História Contemporânea</option>
                                        <option value="5" {{ old('disciplina_id') == '5' ? 'selected' : '' }}>Design Gráfico Digital</option>
                                    </select>
                                    @error('disciplina_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Turma -->
                                <div>
                                    <label for="turma_id" class="block text-sm font-medium text-slate-700 mb-2">Turma *</label>
                                    <select id="turma_id" 
                                            name="turma_id" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('turma_id') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione a turma</option>
                                        <option value="1" {{ old('turma_id') == '1' ? 'selected' : '' }}>3º Ano A</option>
                                        <option value="2" {{ old('turma_id') == '2' ? 'selected' : '' }}>2º Ano B</option>
                                        <option value="3" {{ old('turma_id') == '3' ? 'selected' : '' }}>1º Ano C</option>
                                        <option value="4" {{ old('turma_id') == '4' ? 'selected' : '' }}>1º Técnico em Informática</option>
                                        <option value="5" {{ old('turma_id') == '5' ? 'selected' : '' }}>2º Técnico em Design</option>
                                    </select>
                                    @error('turma_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Professor -->
                                <div>
                                    <label for="professor_id" class="block text-sm font-medium text-slate-700 mb-2">Professor *</label>
                                    <select id="professor_id" 
                                            name="professor_id" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('professor_id') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione o professor</option>
                                        <option value="1" {{ old('professor_id') == '1' ? 'selected' : '' }}>Maria Silva</option>
                                        <option value="2" {{ old('professor_id') == '2' ? 'selected' : '' }}>João Santos</option>
                                        <option value="3" {{ old('professor_id') == '3' ? 'selected' : '' }}>Ana Costa</option>
                                        <option value="4" {{ old('professor_id') == '4' ? 'selected' : '' }}>Carlos Lima</option>
                                        <option value="5" {{ old('professor_id') == '5' ? 'selected' : '' }}>Lucia Ferreira</option>
                                    </select>
                                    @error('professor_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Notas -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="award" class="h-5 w-5 mr-2 text-green-600"></i>
                                Notas
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Nota 1 -->
                                <div>
                                    <label for="nota1" class="block text-sm font-medium text-slate-700 mb-2">Nota 1 *</label>
                                    <input type="number" 
                                           id="nota1" 
                                           name="nota1" 
                                           value="{{ old('nota1') }}"
                                           min="0"
                                           max="10"
                                           step="0.1"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('nota1') border-red-500 @enderror"
                                           placeholder="0.0"
                                           required>
                                    @error('nota1')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nota 2 -->
                                <div>
                                    <label for="nota2" class="block text-sm font-medium text-slate-700 mb-2">Nota 2 *</label>
                                    <input type="number" 
                                           id="nota2" 
                                           name="nota2" 
                                           value="{{ old('nota2') }}"
                                           min="0"
                                           max="10"
                                           step="0.1"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('nota2') border-red-500 @enderror"
                                           placeholder="0.0"
                                           required>
                                    @error('nota2')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nota 3 -->
                                <div>
                                    <label for="nota3" class="block text-sm font-medium text-slate-700 mb-2">Nota 3 *</label>
                                    <input type="number" 
                                           id="nota3" 
                                           name="nota3" 
                                           value="{{ old('nota3') }}"
                                           min="0"
                                           max="10"
                                           step="0.1"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('nota3') border-red-500 @enderror"
                                           placeholder="0.0"
                                           required>
                                    @error('nota3')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informações Adicionais -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="info" class="h-5 w-5 mr-2 text-purple-600"></i>
                                Informações Adicionais
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Período -->
                                <div>
                                    <label for="periodo" class="block text-sm font-medium text-slate-700 mb-2">Período *</label>
                                    <select id="periodo" 
                                            name="periodo" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('periodo') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione o período</option>
                                        <option value="2024/1" {{ old('periodo') == '2024/1' ? 'selected' : '' }}>2024/1</option>
                                        <option value="2024/2" {{ old('periodo') == '2024/2' ? 'selected' : '' }}>2024/2</option>
                                        <option value="2025/1" {{ old('periodo') == '2025/1' ? 'selected' : '' }}>2025/1</option>
                                    </select>
                                    @error('periodo')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Data da Avaliação -->
                                <div>
                                    <label for="data_avaliacao" class="block text-sm font-medium text-slate-700 mb-2">Data da Avaliação *</label>
                                    <input type="date" 
                                           id="data_avaliacao" 
                                           name="data_avaliacao" 
                                           value="{{ old('data_avaliacao', date('Y-m-d')) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('data_avaliacao') border-red-500 @enderror"
                                           required>
                                    @error('data_avaliacao')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Tipo de Avaliação -->
                                <div>
                                    <label for="tipo_avaliacao" class="block text-sm font-medium text-slate-700 mb-2">Tipo de Avaliação *</label>
                                    <select id="tipo_avaliacao" 
                                            name="tipo_avaliacao" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('tipo_avaliacao') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione o tipo</option>
                                        <option value="Prova" {{ old('tipo_avaliacao') == 'Prova' ? 'selected' : '' }}>Prova</option>
                                        <option value="Trabalho" {{ old('tipo_avaliacao') == 'Trabalho' ? 'selected' : '' }}>Trabalho</option>
                                        <option value="Apresentação" {{ old('tipo_avaliacao') == 'Apresentação' ? 'selected' : '' }}>Apresentação</option>
                                        <option value="Projeto" {{ old('tipo_avaliacao') == 'Projeto' ? 'selected' : '' }}>Projeto</option>
                                        <option value="Participação" {{ old('tipo_avaliacao') == 'Participação' ? 'selected' : '' }}>Participação</option>
                                    </select>
                                    @error('tipo_avaliacao')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Peso -->
                                <div>
                                    <label for="peso" class="block text-sm font-medium text-slate-700 mb-2">Peso *</label>
                                    <input type="number" 
                                           id="peso" 
                                           name="peso" 
                                           value="{{ old('peso', 1) }}"
                                           min="1"
                                           max="5"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('peso') border-red-500 @enderror"
                                           required>
                                    @error('peso')
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
                                          placeholder="Observações sobre a avaliação...">{{ old('observacoes') }}</textarea>
                                @error('observacoes')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('notas.index') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center space-x-2">
                                <i data-lucide="save" class="h-4 w-4"></i>
                                <span>Salvar Nota</span>
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
