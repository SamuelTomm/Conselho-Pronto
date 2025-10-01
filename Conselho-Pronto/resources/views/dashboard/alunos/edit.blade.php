@extends('layouts.dashboard')

@section('title', 'Editar Aluno')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Editar Aluno</h1>
                    <p class="text-slate-600">Edite as informações do aluno: {{ $aluno->nome }}</p>
                </div>
                <a href="{{ route('alunos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    <span>Voltar</span>
                </a>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-xl border-0">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <h2 class="text-slate-800 text-xl font-semibold">Informações do Aluno</h2>
                        <p class="text-slate-600">Edite os dados do aluno</p>
                    </div>
                    
                    <form method="POST" action="{{ route('alunos.update', $aluno->id) }}" class="p-6">
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
                                    <label for="nome" class="block text-sm font-medium text-slate-700 mb-2">Nome Completo *</label>
                                    <input type="text" 
                                           id="nome" 
                                           name="nome" 
                                           value="{{ old('nome', $aluno->nome) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('nome') border-red-500 @enderror"
                                           required>
                                    @error('nome')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Matrícula -->
                                <div>
                                    <label for="matricula" class="block text-sm font-medium text-slate-700 mb-2">Matrícula *</label>
                                    <input type="text" 
                                           id="matricula" 
                                           name="matricula" 
                                           value="{{ old('matricula', $aluno->matricula) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('matricula') border-red-500 @enderror"
                                           required>
                                    @error('matricula')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $aluno->email) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Telefone -->
                                <div>
                                    <label for="telefone" class="block text-sm font-medium text-slate-700 mb-2">Telefone</label>
                                    <input type="text" 
                                           id="telefone" 
                                           name="telefone" 
                                           value="{{ old('telefone', $aluno->telefone) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('telefone') border-red-500 @enderror">
                                    @error('telefone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Data de Nascimento -->
                                <div>
                                    <label for="data_nascimento" class="block text-sm font-medium text-slate-700 mb-2">Data de Nascimento</label>
                                    <input type="date" 
                                           id="data_nascimento" 
                                           name="data_nascimento" 
                                           value="{{ old('data_nascimento', $aluno->data_nascimento ? $aluno->data_nascimento->format('Y-m-d') : '') }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('data_nascimento') border-red-500 @enderror">
                                    @error('data_nascimento')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-slate-700 mb-2">Status *</label>
                                    <select id="status" 
                                            name="status" 
                                            class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('status') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecione o status</option>
                                        <option value="Ativo" {{ old('status', $aluno->status) == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                        <option value="Inativo" {{ old('status', $aluno->status) == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                                        <option value="Transferido" {{ old('status', $aluno->status) == 'Transferido' ? 'selected' : '' }}>Transferido</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Dados Acadêmicos -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="graduation-cap" class="h-5 w-5 mr-2 text-green-600"></i>
                                Dados Acadêmicos
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Turma -->
                                <div>
                                    <label for="turma" class="block text-sm font-medium text-slate-700 mb-2">Turma *</label>
                                    <input type="text" 
                                           id="turma" 
                                           name="turma" 
                                           value="{{ old('turma', $aluno->turma) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('turma') border-red-500 @enderror"
                                           required>
                                    @error('turma')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Curso -->
                                <div>
                                    <label for="curso" class="block text-sm font-medium text-slate-700 mb-2">Curso *</label>
                                    <input type="text" 
                                           id="curso" 
                                           name="curso" 
                                           value="{{ old('curso', $aluno->curso) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('curso') border-red-500 @enderror"
                                           required>
                                    @error('curso')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Dados do Responsável -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="users" class="h-5 w-5 mr-2 text-purple-600"></i>
                                Dados do Responsável
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nome do Responsável -->
                                <div>
                                    <label for="responsavel" class="block text-sm font-medium text-slate-700 mb-2">Nome do Responsável</label>
                                    <input type="text" 
                                           id="responsavel" 
                                           name="responsavel" 
                                           value="{{ old('responsavel', $aluno->responsavel) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('responsavel') border-red-500 @enderror">
                                    @error('responsavel')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Telefone do Responsável -->
                                <div>
                                    <label for="telefone_responsavel" class="block text-sm font-medium text-slate-700 mb-2">Telefone do Responsável</label>
                                    <input type="text" 
                                           id="telefone_responsavel" 
                                           name="telefone_responsavel" 
                                           value="{{ old('telefone_responsavel', $aluno->telefone_responsavel) }}"
                                           class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('telefone_responsavel') border-red-500 @enderror">
                                    @error('telefone_responsavel')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Endereço e Observações -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <i data-lucide="map-pin" class="h-5 w-5 mr-2 text-orange-600"></i>
                                Informações Adicionais
                            </h3>
                            
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Endereço -->
                                <div>
                                    <label for="endereco" class="block text-sm font-medium text-slate-700 mb-2">Endereço</label>
                                    <textarea id="endereco" 
                                              name="endereco" 
                                              rows="3"
                                              class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('endereco') border-red-500 @enderror">{{ old('endereco', $aluno->endereco) }}</textarea>
                                    @error('endereco')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Observações -->
                                <div>
                                    <label for="observacoes" class="block text-sm font-medium text-slate-700 mb-2">Observações</label>
                                    <textarea id="observacoes" 
                                              name="observacoes" 
                                              rows="3"
                                              class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('observacoes') border-red-500 @enderror">{{ old('observacoes', $aluno->observacoes) }}</textarea>
                                    @error('observacoes')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('alunos.index') }}" 
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
