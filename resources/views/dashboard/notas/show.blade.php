@extends('layouts.dashboard')

@section('title', 'Visualizar Nota')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Visualizar Nota</h1>
                    <p class="text-slate-600">Informações detalhadas da nota</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('notas.edit', $nota->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="edit" class="h-4 w-4"></i>
                        <span>Editar</span>
                    </a>
                    <a href="{{ route('notas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                        <span>Voltar</span>
                    </a>
                </div>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-6xl mx-auto">
                <!-- Header da Nota -->
                <div class="bg-white rounded-lg shadow-xl border-0 mb-6">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <!-- Ícone da Nota -->
                                <div class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white">
                                    <i data-lucide="clipboard-list" class="h-8 w-8"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-slate-800">Nota do Aluno</h2>
                                    <p class="text-slate-600">Disciplina: {{ $nota->disciplina ?? 'Matemática III' }}</p>
                                    <div class="flex items-center space-x-4 mt-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $nota->tipo_avaliacao ?? 'Prova' }}
                                        </span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $nota->periodo ?? '2024/1' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid de Informações -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Dados da Nota -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="clipboard-list" class="h-5 w-5 mr-2 text-blue-600"></i>
                                Dados da Nota
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Aluno</label>
                                    <p class="text-slate-800">{{ $nota->aluno ?? 'João Silva' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Disciplina</label>
                                    <p class="text-slate-800">{{ $nota->disciplina ?? 'Matemática III' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Turma</label>
                                    <p class="text-slate-800">{{ $nota->turma ?? '3º Ano A' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Professor</label>
                                    <p class="text-slate-800">{{ $nota->professor ?? 'Maria Silva' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Período</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $nota->periodo ?? '2024/1' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notas -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="award" class="h-5 w-5 mr-2 text-green-600"></i>
                                Notas
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Nota 1</label>
                                    <p class="text-2xl font-bold text-slate-800">{{ $nota->nota1 ?? '8.5' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Nota 2</label>
                                    <p class="text-2xl font-bold text-slate-800">{{ $nota->nota2 ?? '7.2' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Nota 3</label>
                                    <p class="text-2xl font-bold text-slate-800">{{ $nota->nota3 ?? '9.1' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Média</label>
                                    <p class="text-2xl font-bold text-green-600">{{ $nota->media ?? '8.3' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informações Adicionais -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-purple-50 to-violet-50 border-b border-purple-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="info" class="h-5 w-5 mr-2 text-purple-600"></i>
                                Informações
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Tipo de Avaliação</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $nota->tipo_avaliacao ?? 'Prova' }}
                                    </span>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Data da Avaliação</label>
                                    <p class="text-slate-800">{{ $nota->data_avaliacao ?? '15/06/2024' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Peso</label>
                                    <p class="text-slate-800">{{ $nota->peso ?? '1' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Aprovado
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Observações -->
                @if($nota->observacoes)
                <div class="bg-white rounded-lg shadow-lg border-0 mt-6">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 border-b border-slate-100 p-4 rounded-t-lg">
                        <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                            <i data-lucide="file-text" class="h-5 w-5 mr-2 text-slate-600"></i>
                            Observações
                        </h3>
                    </div>
                    <div class="p-6">
                        <div>
                            <p class="text-slate-800 leading-relaxed">{{ $nota->observacoes }}</p>
                        </div>
                    </div>
                </div>
                @endif

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
                                    <h4 class="font-medium text-slate-800">Ver Aluno</h4>
                                    <p class="text-sm text-slate-600">Perfil do aluno</p>
                                </div>
                            </a>

                            <a href="#" 
                               class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-all duration-200 group">
                                <div class="bg-green-500 p-2 rounded-lg mr-3 group-hover:bg-green-600 transition-colors">
                                    <i data-lucide="book-open" class="h-5 w-5 text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800">Ver Disciplina</h4>
                                    <p class="text-sm text-slate-600">Detalhes da disciplina</p>
                                </div>
                            </a>

                            <a href="#" 
                               class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-all duration-200 group">
                                <div class="bg-purple-500 p-2 rounded-lg mr-3 group-hover:bg-purple-600 transition-colors">
                                    <i data-lucide="download" class="h-5 w-5 text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800">Exportar</h4>
                                    <p class="text-sm text-slate-600">Exportar nota</p>
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
