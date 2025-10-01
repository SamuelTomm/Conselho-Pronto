@extends('layouts.dashboard')

@section('title', 'Notas - Conselho Pronto')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-sm border-b border-blue-100 sticky top-0 z-40">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Notas</h1>
                    <p class="text-slate-600">Conselho Pronto - Sistema de Gestão Educacional</p>
                </div>
                <div class="flex items-center space-x-4">
                    @php
                        $userRole = session('user_data.role', 'professor');
                    @endphp
                    
                    @if(in_array($userRole, ['admin', 'coordenador']))
                    <button class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="plus" class="h-4 w-4"></i>
                        <span>Nova Nota</span>
                    </button>
                    @endif
                    
                    @if($userRole === 'professor')
                    <span class="text-sm text-slate-500">
                        <i data-lucide="info" class="h-4 w-4 inline mr-1"></i>
                        Gerencie as notas dos seus alunos
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <main class="p-6">
        <!-- Filtros -->
        <div class="bg-white rounded-lg shadow-lg border-0 mb-6 p-6">
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Filtros</h3>
            <form method="GET" class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-600">Turma:</label>
                    <select name="turma" class="border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                        <option value="">Todas as Turmas</option>
                        <option value="3º A" {{ $turmaId === '3º A' ? 'selected' : '' }}>3º A</option>
                        <option value="2º B" {{ $turmaId === '2º B' ? 'selected' : '' }}>2º B</option>
                        <option value="3º C" {{ $turmaId === '3º C' ? 'selected' : '' }}>3º C</option>
                        <option value="1º A" {{ $turmaId === '1º A' ? 'selected' : '' }}>1º A</option>
                    </select>
                </div>
                
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-600">Disciplina:</label>
                    <select name="disciplina" class="border border-blue-200 rounded-md px-3 py-1 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                        <option value="">Todas as Disciplinas</option>
                        <option value="Matemática III" {{ $disciplinaId === 'Matemática III' ? 'selected' : '' }}>Matemática III</option>
                        <option value="Física II" {{ $disciplinaId === 'Física II' ? 'selected' : '' }}>Física II</option>
                        <option value="Programação I" {{ $disciplinaId === 'Programação I' ? 'selected' : '' }}>Programação I</option>
                        <option value="Design Gráfico" {{ $disciplinaId === 'Design Gráfico' ? 'selected' : '' }}>Design Gráfico</option>
                    </select>
                </div>
                
                <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700 transition-colors">
                    <i data-lucide="search" class="h-4 w-4 inline mr-1"></i>
                    Filtrar
                </button>
                
                <a href="{{ route('notas.index') }}" class="bg-gray-500 text-white px-4 py-1 rounded-md hover:bg-gray-600 transition-colors">
                    <i data-lucide="x" class="h-4 w-4 inline mr-1"></i>
                    Limpar
                </a>
            </form>
        </div>

        <!-- Tabela de Notas -->
        <div class="bg-white rounded-lg shadow-lg border-0">
            <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6">
                <h2 class="text-slate-800 text-xl font-semibold">Notas dos Alunos</h2>
                <p class="text-slate-600">Visualize e gerencie as notas dos alunos</p>
            </div>
            
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-blue-100/50">
                                <th class="text-blue-900 font-semibold px-4 py-3 text-left">Aluno</th>
                                <th class="text-blue-900 font-semibold px-4 py-3 text-left">Turma</th>
                                <th class="text-blue-900 font-semibold px-4 py-3 text-left">Disciplina</th>
                                <th class="text-blue-900 font-semibold px-4 py-3 text-center">Bimestre</th>
                                <th class="text-blue-900 font-semibold px-4 py-3 text-center">Nota 1</th>
                                <th class="text-blue-900 font-semibold px-4 py-3 text-center">Nota 2</th>
                                <th class="text-blue-900 font-semibold px-4 py-3 text-center">Nota 3</th>
                                <th class="text-blue-900 font-semibold px-4 py-3 text-center">Média</th>
                                <th class="text-blue-900 font-semibold px-4 py-3 text-center">Faltas</th>
                                <th class="text-blue-900 font-semibold px-4 py-3 text-center">Status</th>
                                <th class="text-blue-900 font-semibold px-4 py-3 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notasData as $nota)
                            <tr class="hover:bg-blue-50/50 transition-colors">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-slate-800">{{ $nota['aluno_nome'] }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $nota['turma'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-slate-700">{{ $nota['disciplina'] }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $nota['bimestre'] }}º
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center font-medium">{{ $nota['nota1'] }}</td>
                                <td class="px-4 py-3 text-center font-medium">{{ $nota['nota2'] }}</td>
                                <td class="px-4 py-3 text-center font-medium">{{ $nota['nota3'] }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="font-bold text-lg {{ $nota['media'] >= 7 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ number_format($nota['media'], 1) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $nota['faltas'] <= 2 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $nota['faltas'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $nota['status'] === 'Aprovado' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $nota['status'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-1">
                                        <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition-colors">
                                            <i data-lucide="edit" class="h-3 w-3"></i>
                                        </button>
                                        <button class="bg-green-600 text-white px-2 py-1 rounded text-xs hover:bg-green-700 transition-colors">
                                            <i data-lucide="eye" class="h-3 w-3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="px-4 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center space-y-2">
                                        <i data-lucide="clipboard-list" class="h-12 w-12 text-gray-300"></i>
                                        <p>Nenhuma nota encontrada</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
