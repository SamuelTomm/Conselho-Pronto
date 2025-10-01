@extends('layouts.dashboard')

@section('title', 'Visualizar Disciplina')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Visualizar Disciplina</h1>
                    <p class="text-slate-600">Informações detalhadas da disciplina: {{ $disciplina->nome }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('disciplinas.edit', $disciplina->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="edit" class="h-4 w-4"></i>
                        <span>Editar</span>
                    </a>
                    <a href="{{ route('disciplinas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                        <span>Voltar</span>
                    </a>
                </div>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-6xl mx-auto">
                <!-- Header da Disciplina -->
                <div class="bg-white rounded-lg shadow-xl border-0 mb-6">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <!-- Ícone da Disciplina -->
                                <div class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white">
                                    <i data-lucide="book-open" class="h-8 w-8"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-slate-800">{{ $disciplina->nome }}</h2>
                                    <p class="text-slate-600">Código: {{ $disciplina->codigo }}</p>
                                    <div class="flex items-center space-x-4 mt-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ \App\Models\Disciplina::getCorClass($disciplina->cor) }}">
                                            {{ $disciplina->curso }}
                                        </span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $disciplina->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $disciplina->ativo ? 'Ativa' : 'Inativa' }}
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
                                <i data-lucide="book-open" class="h-5 w-5 mr-2 text-blue-600"></i>
                                Dados Básicos
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Nome da Disciplina</label>
                                    <p class="text-slate-800">{{ $disciplina->nome }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Código</label>
                                    <p class="text-slate-800">{{ $disciplina->codigo }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Curso</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ \App\Models\Disciplina::getCorClass($disciplina->cor) }}">
                                        {{ $disciplina->curso }}
                                    </span>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Período</label>
                                    <p class="text-slate-800">{{ $disciplina->periodo }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Carga Horária</label>
                                    <p class="text-slate-800">{{ $disciplina->carga_horaria }} horas</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $disciplina->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $disciplina->ativo ? 'Ativa' : 'Inativa' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estatísticas -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="bar-chart-3" class="h-5 w-5 mr-2 text-green-600"></i>
                                Estatísticas
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Número de Alunos</label>
                                    <p class="text-2xl font-bold text-slate-800">{{ $disciplina->total_alunos }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Carga Horária Total</label>
                                    <p class="text-2xl font-bold text-slate-800">{{ $disciplina->carga_horaria }}h</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Cor do Badge</label>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-4 h-4 rounded-full bg-{{ $disciplina->cor }}-500"></div>
                                        <span class="text-slate-800 capitalize">{{ $disciplina->cor }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Data de Criação</label>
                                    <p class="text-slate-800">{{ $disciplina->created_at ? $disciplina->created_at->format('d/m/Y H:i') : 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Última Atualização</label>
                                    <p class="text-slate-800">{{ $disciplina->updated_at ? $disciplina->updated_at->format('d/m/Y H:i') : 'Não informado' }}</p>
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
                                        <h4 class="font-medium text-slate-800">Ver Alunos</h4>
                                        <p class="text-xs text-slate-600">Alunos da disciplina</p>
                                    </div>
                                </a>

                                <a href="#" 
                                   class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-all duration-200 group">
                                    <div class="bg-green-500 p-2 rounded-lg mr-3 group-hover:bg-green-600 transition-colors">
                                        <i data-lucide="clipboard-list" class="h-4 w-4 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-slate-800">Ver Notas</h4>
                                        <p class="text-xs text-slate-600">Notas da disciplina</p>
                                    </div>
                                </a>

                                <a href="#" 
                                   class="flex items-center p-3 bg-orange-50 hover:bg-orange-100 rounded-lg transition-all duration-200 group">
                                    <div class="bg-orange-500 p-2 rounded-lg mr-3 group-hover:bg-orange-600 transition-colors">
                                        <i data-lucide="calendar" class="h-4 w-4 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-slate-800">Ver Frequência</h4>
                                        <p class="text-xs text-slate-600">Frequência dos alunos</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Descrição -->
                <div class="bg-white rounded-lg shadow-lg border-0 mt-6">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 border-b border-slate-100 p-4 rounded-t-lg">
                        <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                            <i data-lucide="file-text" class="h-5 w-5 mr-2 text-slate-600"></i>
                            Descrição da Disciplina
                        </h3>
                    </div>
                    <div class="p-6">
                        <div>
                            <p class="text-slate-800 leading-relaxed">{{ $disciplina->descricao }}</p>
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
