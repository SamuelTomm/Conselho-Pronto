@extends('layouts.dashboard')

@section('title', 'Visualizar Professor')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Visualizar Professor</h1>
                    <p class="text-slate-600">Informações detalhadas do professor: {{ $professor->name }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('professores.edit', $professor->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="edit" class="h-4 w-4"></i>
                        <span>Editar</span>
                    </a>
                    <a href="{{ route('professores.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                        <span>Voltar</span>
                    </a>
                </div>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-6xl mx-auto">
                <!-- Header do Professor -->
                <div class="bg-white rounded-lg shadow-xl border-0 mb-6">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <!-- Avatar do Professor -->
                                <div class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-xl">
                                    {{ substr($professor->name, 0, 2) }}
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-slate-800">{{ $professor->name }}</h2>
                                    <p class="text-slate-600">{{ $professor->email }}</p>
                                    <div class="flex items-center space-x-4 mt-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                            @if($professor->role == 'professor') bg-blue-100 text-blue-800
                                            @elseif($professor->role == 'coordenador') bg-purple-100 text-purple-800
                                            @else bg-orange-100 text-orange-800
                                            @endif">
                                            {{ ucfirst($professor->role) }}
                                        </span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ ($professor->ativo ?? true) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ($professor->ativo ?? true) ? 'Ativo' : 'Inativo' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid de Informações -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Dados Pessoais -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="user" class="h-5 w-5 mr-2 text-blue-600"></i>
                                Dados Pessoais
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Nome Completo</label>
                                    <p class="text-slate-800">{{ $professor->name }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Email</label>
                                    <p class="text-slate-800">{{ $professor->email }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Telefone</label>
                                    <p class="text-slate-800">{{ $professor->telefone ?? 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Data de Admissão</label>
                                    <p class="text-slate-800">{{ $professor->data_admissao ?? 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ ($professor->ativo ?? true) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ($professor->ativo ?? true) ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dados Profissionais -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="briefcase" class="h-5 w-5 mr-2 text-green-600"></i>
                                Dados Profissionais
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Função</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($professor->role == 'professor') bg-blue-100 text-blue-800
                                        @elseif($professor->role == 'coordenador') bg-purple-100 text-purple-800
                                        @else bg-orange-100 text-orange-800
                                        @endif">
                                        {{ ucfirst($professor->role) }}
                                    </span>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Especialidade</label>
                                    <p class="text-slate-800">{{ $professor->especialidade ?? 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Data de Criação</label>
                                    <p class="text-slate-800">{{ $professor->created_at ? $professor->created_at->format('d/m/Y H:i') : 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Última Atualização</label>
                                    <p class="text-slate-800">{{ $professor->updated_at ? $professor->updated_at->format('d/m/Y H:i') : 'Não informado' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ações Rápidas -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-purple-50 to-violet-50 border-b border-purple-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="zap" class="h-5 w-5 mr-2 text-purple-600"></i>
                                Ações Rápidas
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <a href="#" 
                                   class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200 group">
                                    <div class="bg-blue-500 p-2 rounded-lg mr-3 group-hover:bg-blue-600 transition-colors">
                                        <i data-lucide="users" class="h-4 w-4 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-slate-800">Ver Turmas</h4>
                                        <p class="text-xs text-slate-600">Turmas do professor</p>
                                    </div>
                                </a>

                                <a href="#" 
                                   class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-all duration-200 group">
                                    <div class="bg-green-500 p-2 rounded-lg mr-3 group-hover:bg-green-600 transition-colors">
                                        <i data-lucide="book-open" class="h-4 w-4 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-slate-800">Ver Disciplinas</h4>
                                        <p class="text-xs text-slate-600">Disciplinas do professor</p>
                                    </div>
                                </a>

                                <a href="#" 
                                   class="flex items-center p-3 bg-orange-50 hover:bg-orange-100 rounded-lg transition-all duration-200 group">
                                    <div class="bg-orange-500 p-2 rounded-lg mr-3 group-hover:bg-orange-600 transition-colors">
                                        <i data-lucide="clipboard-list" class="h-4 w-4 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-slate-800">Ver Alunos</h4>
                                        <p class="text-xs text-slate-600">Alunos do professor</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Atribuições -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    <!-- Turmas -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="users" class="h-5 w-5 mr-2 text-blue-600"></i>
                                Turmas
                            </h3>
                        </div>
                        <div class="p-6">
                            <div>
                                <p class="text-slate-800">{{ $professor->turmas ?? 'Nenhuma turma atribuída' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Disciplinas -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="book-open" class="h-5 w-5 mr-2 text-green-600"></i>
                                Disciplinas
                            </h3>
                        </div>
                        <div class="p-6">
                            <div>
                                <p class="text-slate-800">{{ $professor->disciplinas ?? 'Nenhuma disciplina atribuída' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Observações -->
                @if($professor->observacoes)
                <div class="bg-white rounded-lg shadow-lg border-0 mt-6">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 border-b border-slate-100 p-4 rounded-t-lg">
                        <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                            <i data-lucide="file-text" class="h-5 w-5 mr-2 text-slate-600"></i>
                            Observações
                        </h3>
                    </div>
                    <div class="p-6">
                        <div>
                            <p class="text-slate-800 leading-relaxed">{{ $professor->observacoes }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </main>
    </div>
</div>

<script>
// Initialize Lucide icons
lucide.createIcons();
</script>
@endsection
