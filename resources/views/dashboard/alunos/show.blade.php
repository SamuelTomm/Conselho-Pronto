@extends('layouts.dashboard')

@section('title', 'Visualizar Aluno')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Visualizar Aluno</h1>
                    <p class="text-slate-600">Informações detalhadas do aluno: {{ $aluno->nome }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('alunos.edit', $aluno->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="edit" class="h-4 w-4"></i>
                        <span>Editar</span>
                    </a>
                    <a href="{{ route('alunos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                        <span>Voltar</span>
                    </a>
                </div>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-6xl mx-auto">
                <!-- Header do Aluno -->
                <div class="bg-white rounded-lg shadow-xl border-0 mb-6">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <div class="flex items-center space-x-4">
                            <!-- Avatar do Aluno -->
                            <div class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-xl">
                                {{ \App\Models\Aluno::getInitials($aluno->nome) }}
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-slate-800">{{ $aluno->nome }}</h2>
                                <p class="text-slate-600">Matrícula: {{ $aluno->matricula }}</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ \App\Models\Aluno::getStatusColor($aluno->status) }}">
                                        {{ $aluno->status }}
                                    </span>
                                    <span class="text-sm text-slate-500">{{ $aluno->turma }} - {{ $aluno->curso }}</span>
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
                                    <p class="text-slate-800">{{ $aluno->nome }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Matrícula</label>
                                    <p class="text-slate-800">{{ $aluno->matricula }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Email</label>
                                    <p class="text-slate-800">{{ $aluno->email ?: 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Telefone</label>
                                    <p class="text-slate-800">{{ $aluno->telefone ?: 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Data de Nascimento</label>
                                    <p class="text-slate-800">{{ $aluno->data_nascimento ? $aluno->data_nascimento->format('d/m/Y') : 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ \App\Models\Aluno::getStatusColor($aluno->status) }}">
                                        {{ $aluno->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dados Acadêmicos -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="graduation-cap" class="h-5 w-5 mr-2 text-green-600"></i>
                                Dados Acadêmicos
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Turma</label>
                                    <p class="text-slate-800">{{ $aluno->turma }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Curso</label>
                                    <p class="text-slate-800">{{ $aluno->curso }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Período de Matrícula</label>
                                    <p class="text-slate-800">{{ $aluno->created_at ? $aluno->created_at->format('d/m/Y') : 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Última Atualização</label>
                                    <p class="text-slate-800">{{ $aluno->updated_at ? $aluno->updated_at->format('d/m/Y H:i') : 'Não informado' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dados do Responsável -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-purple-50 to-violet-50 border-b border-purple-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="users" class="h-5 w-5 mr-2 text-purple-600"></i>
                                Responsável
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Nome do Responsável</label>
                                    <p class="text-slate-800">{{ $aluno->responsavel ?: 'Não informado' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-500">Telefone do Responsável</label>
                                    <p class="text-slate-800">{{ $aluno->telefone_responsavel ?: 'Não informado' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informações Adicionais -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    <!-- Endereço -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-orange-50 to-amber-50 border-b border-orange-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="map-pin" class="h-5 w-5 mr-2 text-orange-600"></i>
                                Endereço
                            </h3>
                        </div>
                        <div class="p-6">
                            <div>
                                <label class="text-sm font-medium text-slate-500">Endereço Completo</label>
                                <p class="text-slate-800 mt-1">{{ $aluno->endereco ?: 'Não informado' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Observações -->
                    <div class="bg-white rounded-lg shadow-lg border-0">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-50 border-b border-slate-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="file-text" class="h-5 w-5 mr-2 text-slate-600"></i>
                                Observações
                            </h3>
                        </div>
                        <div class="p-6">
                            <div>
                                <label class="text-sm font-medium text-slate-500">Observações</label>
                                <p class="text-slate-800 mt-1">{{ $aluno->observacoes ?: 'Nenhuma observação registrada' }}</p>
                            </div>
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
                            <a href="{{ route('alunos.edit', $aluno->id) }}" 
                               class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200 group">
                                <div class="bg-blue-500 p-2 rounded-lg mr-3 group-hover:bg-blue-600 transition-colors">
                                    <i data-lucide="edit" class="h-5 w-5 text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800">Editar Aluno</h4>
                                    <p class="text-sm text-slate-600">Modificar informações</p>
                                </div>
                            </a>

                            <a href="#" 
                               class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-all duration-200 group">
                                <div class="bg-green-500 p-2 rounded-lg mr-3 group-hover:bg-green-600 transition-colors">
                                    <i data-lucide="clipboard-list" class="h-5 w-5 text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800">Ver Notas</h4>
                                    <p class="text-sm text-slate-600">Histórico acadêmico</p>
                                </div>
                            </a>

                            <a href="#" 
                               class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-all duration-200 group">
                                <div class="bg-purple-500 p-2 rounded-lg mr-3 group-hover:bg-purple-600 transition-colors">
                                    <i data-lucide="calendar" class="h-5 w-5 text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800">Frequência</p>
                                    <p class="text-sm text-slate-600">Controle de presença</p>
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
