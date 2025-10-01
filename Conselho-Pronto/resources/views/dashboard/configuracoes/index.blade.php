@extends('layouts.dashboard')

@section('title', 'Configurações')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex">
    <div class="flex-1 w-full">
        <div class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Configurações</h1>
                    <p class="text-slate-600">Conselho Pronto - Sistema de Gestão Educacional</p>
                </div>
            </div>
        </div>

        <main class="p-6">
            <div class="max-w-6xl mx-auto">
                <!-- Configurações Gerais -->
                <div class="bg-white rounded-lg shadow-xl border-0 mb-6">
                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
                        <h2 class="text-slate-800 text-xl font-semibold">Configurações Gerais</h2>
                        <p class="text-slate-600">Configure as principais funcionalidades do sistema</p>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Configurações da Escola -->
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                    <i data-lucide="school" class="h-5 w-5 mr-2 text-blue-600"></i>
                                    Informações da Escola
                                </h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Nome da Escola</label>
                                        <input type="text" 
                                               value="Instituto Ivoti"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">CNPJ</label>
                                        <input type="text" 
                                               value="12.345.678/0001-90"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Endereço</label>
                                        <textarea rows="3" 
                                                  class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">Rua das Flores, 123 - Centro - Ivoti/RS</textarea>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Telefone</label>
                                            <input type="text" 
                                                   value="(51) 3563-1234"
                                                   class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                                            <input type="email" 
                                                   value="contato@ivoti.edu.br"
                                                   class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Configurações do Sistema -->
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                    <i data-lucide="settings" class="h-5 w-5 mr-2 text-green-600"></i>
                                    Configurações do Sistema
                                </h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Ano Letivo Atual</label>
                                        <select class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                            <option value="2024" selected>2024</option>
                                            <option value="2025">2025</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Período Atual</label>
                                        <select class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                            <option value="2024/1" selected>2024/1</option>
                                            <option value="2024/2">2024/2</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Fuso Horário</label>
                                        <select class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                            <option value="America/Sao_Paulo" selected>America/Sao_Paulo (UTC-3)</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Idioma</label>
                                        <select class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                            <option value="pt-BR" selected>Português (Brasil)</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Configurações de Notas -->
                <div class="bg-white rounded-lg shadow-xl border-0 mb-6">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100 p-6 rounded-t-lg">
                        <h2 class="text-slate-800 text-xl font-semibold">Configurações de Notas</h2>
                        <p class="text-slate-600">Configure o sistema de avaliação e notas</p>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Sistema de Notas -->
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                    <i data-lucide="award" class="h-5 w-5 mr-2 text-green-600"></i>
                                    Sistema de Notas
                                </h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Escala de Notas</label>
                                        <select class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                            <option value="0-10" selected>0 a 10</option>
                                            <option value="0-100">0 a 100</option>
                                            <option value="A-F">A a F</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Nota Mínima para Aprovação</label>
                                        <input type="number" 
                                               value="6.0"
                                               min="0"
                                               max="10"
                                               step="0.1"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Número de Avaliações</label>
                                        <input type="number" 
                                               value="3"
                                               min="1"
                                               max="10"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               id="recuperacao" 
                                               checked
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="recuperacao" class="ml-2 text-sm font-medium text-slate-700">
                                            Permitir recuperação
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Configurações de Frequência -->
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                    <i data-lucide="calendar" class="h-5 w-5 mr-2 text-purple-600"></i>
                                    Configurações de Frequência
                                </h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Carga Horária Mínima (%)</label>
                                        <input type="number" 
                                               value="75"
                                               min="0"
                                               max="100"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Dias Letivos por Semana</label>
                                        <input type="number" 
                                               value="5"
                                               min="1"
                                               max="7"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Horas por Dia</label>
                                        <input type="number" 
                                               value="6"
                                               min="1"
                                               max="12"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               id="frequencia_obrigatoria" 
                                               checked
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="frequencia_obrigatoria" class="ml-2 text-sm font-medium text-slate-700">
                                            Frequência obrigatória
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Configurações de Backup -->
                <div class="bg-white rounded-lg shadow-xl border-0 mb-6">
                    <div class="bg-gradient-to-r from-orange-50 to-amber-50 border-b border-orange-100 p-6 rounded-t-lg">
                        <h2 class="text-slate-800 text-xl font-semibold">Backup e Segurança</h2>
                        <p class="text-slate-600">Configure backups automáticos e políticas de segurança</p>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Backup Automático -->
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                    <i data-lucide="database" class="h-5 w-5 mr-2 text-orange-600"></i>
                                    Backup Automático
                                </h3>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               id="backup_automatico" 
                                               checked
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="backup_automatico" class="ml-2 text-sm font-medium text-slate-700">
                                            Ativar backup automático
                                        </label>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Frequência do Backup</label>
                                        <select class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                            <option value="daily" selected>Diário</option>
                                            <option value="weekly">Semanal</option>
                                            <option value="monthly">Mensal</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Horário do Backup</label>
                                        <input type="time" 
                                               value="02:00"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Retenção (dias)</label>
                                        <input type="number" 
                                               value="30"
                                               min="1"
                                               max="365"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                </div>
                            </div>

                            <!-- Segurança -->
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                    <i data-lucide="shield" class="h-5 w-5 mr-2 text-red-600"></i>
                                    Segurança
                                </h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Tempo de Sessão (minutos)</label>
                                        <input type="number" 
                                               value="120"
                                               min="15"
                                               max="480"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Tentativas de Login</label>
                                        <input type="number" 
                                               value="3"
                                               min="1"
                                               max="10"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Bloqueio por Tentativas (minutos)</label>
                                        <input type="number" 
                                               value="15"
                                               min="5"
                                               max="60"
                                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               id="log_atividades" 
                                               checked
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="log_atividades" class="ml-2 text-sm font-medium text-slate-700">
                                            Registrar atividades dos usuários
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex items-center justify-end space-x-4">
                    <button class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        Cancelar
                    </button>
                    <button class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="save" class="h-4 w-4"></i>
                        <span>Salvar Configurações</span>
                    </button>
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
