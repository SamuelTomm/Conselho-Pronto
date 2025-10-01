@extends('layouts.dashboard')

@section('title', 'Visualizar Turma')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Visualizar Turma</h1>
                    <p class="text-slate-600">Informações detalhadas da turma: {{ $turma->nome }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('turmas.edit', $turma->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="edit" class="h-4 w-4"></i>
                        <span>Editar</span>
                    </a>
                    <a href="{{ route('turmas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                        <span>Voltar</span>
                    </a>
                </div>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-6xl mx-auto">
                <!-- Header da Turma -->
                <div class="bg-white rounded-lg shadow-xl border-0 mb-6">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <!-- Ícone da Turma -->
                                <div class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white">
                                    <i data-lucide="users" class="h-8 w-8"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-slate-800">{{ $turma->nome }}</h2>
                                    <p class="text-slate-600">Código: {{ $turma->codigo }}</p>
                                    <div class="flex items-center space-x-4 mt-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ \App\Models\Turma::getNivelColorAttribute() }}">
                                            {{ $turma->nivel }}
                                        </span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $turma->status == 'Ativa' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $turma->status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid de Informações -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Dados Básicos -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="users" class="h-5 w-5 mr-2 text-blue-600"></i>
                                Dados Básicos
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Nome da Turma</label>
                                    <p class="text-slate-800">{{ $turma->nome }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Código</label>
                                    <p class="text-slate-800">{{ $turma->codigo }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Nível</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ \App\Models\Turma::getNivelColorAttribute() }}">
                                        {{ $turma->nivel }}
                                    </span>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Ano Letivo</label>
                                    <p class="text-slate-800">{{ $turma->ano }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Período</label>
                                    <p class="text-slate-800">{{ $turma->periodo }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Sala</label>
                                    <p class="text-slate-800">{{ $turma->sala ?: 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $turma->status == 'Ativa' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $turma->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Responsável -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="user-check" class="h-5 w-5 mr-2 text-green-600"></i>
                                Responsável
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Conselheiro</label>
                                    <p class="text-slate-800">{{ $turma->conselheiro }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Cor do Badge</label>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-4 h-4 rounded-full bg-{{ $turma->cor }}-500"></div>
                                        <span class="text-slate-800 capitalize">{{ $turma->cor }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estatísticas -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-purple-50 to-violet-50 border-b border-purple-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="bar-chart-3" class="h-5 w-5 mr-2 text-purple-600"></i>
                                Estatísticas
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Número de Alunos</label>
                                    <p class="text-2xl font-bold text-slate-800">{{ $turma->alunos_count }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Número de Disciplinas</label>
                                    <p class="text-2xl font-bold text-slate-800">{{ $turma->disciplinas_count }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Data de Criação</label>
                                    <p class="text-slate-800">{{ $turma->created_at ? $turma->created_at->format('d/m/Y H:i') : 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Última Atualização</label>
                                    <p class="text-slate-800">{{ $turma->updated_at ? $turma->updated_at->format('d/m/Y H:i') : 'Não informado' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Descrição -->
                <div class="bg-white rounded-lg shadow-lg border-0 mt-6">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 border-b border-slate-100 p-4 rounded-t-lg">
                        <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                            <i data-lucide="file-text" class="h-5 w-5 mr-2 text-slate-600"></i>
                            Descrição da Turma
                        </h3>
                    </div>
                    <div class="p-6">
                        <div>
                            <p class="text-slate-800 leading-relaxed">{{ $turma->descricao ?: 'Nenhuma descrição registrada' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Ações Rápidas -->
                <div class="bg-white rounded-lg shadow-lg border-0 mt-6">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-4 rounded-t-lg">
                        <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                            <i data-lucide="zap" class="h-5 w-5 mr-2 text-blue-600"></i>
                            Ações Rápidas
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="#" 
                               class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200 group">
                                <div class="bg-blue-500 p-2 rounded-lg mr-3 group-hover:bg-blue-600 transition-colors">
                                    <i data-lucide="users" class="h-5 w-5 text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800">Ver Alunos</h4>
                                    <p class="text-sm text-slate-600">Alunos da turma</p>
                                </div>
                            </a>

                            <a href="#" 
                               class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-all duration-200 group">
                                <div class="bg-green-500 p-2 rounded-lg mr-3 group-hover:bg-green-600 transition-colors">
                                    <i data-lucide="book-open" class="h-5 w-5 text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800">Ver Disciplinas</h4>
                                    <p class="text-sm text-slate-600">Matérias da turma</p>
                                </div>
                            </a>

                            <a href="#" 
                               class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-all duration-200 group">
                                <div class="bg-purple-500 p-2 rounded-lg mr-3 group-hover:bg-purple-600 transition-colors">
                                    <i data-lucide="clipboard-list" class="h-5 w-5 text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800">Ver Notas</h4>
                                    <p class="text-sm text-slate-600">Notas da turma</p>
                                </div>
                            </a>
                        </div>
                    </div>
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
