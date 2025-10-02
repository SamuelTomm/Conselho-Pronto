@extends('layouts.dashboard')

@section('title', 'Perfil')
@section('page-title', 'Meu Perfil')
@section('page-description', 'Gerencie suas informações pessoais e configurações de conta')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header do Perfil -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg rounded-lg mb-6">
        <div class="bg-gradient-to-r from-blue-50 to-slate-50 border-b border-blue-100 p-6 rounded-t-lg">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-2xl">
                        {{ substr($user['name'], 0, 1) }}
                    </span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">{{ $user['name'] }}</h2>
                    <p class="text-slate-600">{{ $user['email'] }}</p>
                    <div class="flex items-center space-x-2 mt-1">
                        @php
                            $roleTitles = [
                                'admin' => 'Administrador',
                                'coordenador' => 'Coordenador',
                                'conselheiro' => 'Conselheiro',
                                'professor' => 'Professor'
                            ];
                            $roleTitle = $roleTitles[$user['role']] ?? 'Professor';
                            $roleColors = [
                                'admin' => 'bg-red-100 text-red-800',
                                'coordenador' => 'bg-purple-100 text-purple-800',
                                'conselheiro' => 'bg-blue-100 text-blue-800',
                                'professor' => 'bg-green-100 text-green-800'
                            ];
                            $roleColor = $roleColors[$user['role']] ?? 'bg-green-100 text-green-800';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $roleColor }}">
                            {{ $roleTitle }}
                        </span>
                        @if($user['active'])
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i data-lucide="check-circle" class="h-3 w-3 mr-1"></i>
                                Ativo
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulário de Edição -->
    <div class="bg-white/80 backdrop-blur-sm border-blue-100 shadow-lg rounded-lg">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100 p-6 rounded-t-lg">
            <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                <i data-lucide="edit-3" class="h-5 w-5 mr-2 text-green-600"></i>
                Editar Informações
            </h3>
            <p class="text-slate-600 text-sm">Atualize suas informações pessoais e configurações de segurança</p>
        </div>
        
        <form method="POST" action="{{ route('profile.update') }}" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Informações Básicas -->
            <div class="mb-8">
                <h4 class="text-md font-semibold text-slate-800 mb-4 flex items-center">
                    <i data-lucide="user" class="h-4 w-4 mr-2 text-blue-600"></i>
                    Informações Básicas
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                            Nome Completo <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user['name']) }}"
                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('name') border-red-300 @enderror"
                               required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user['email']) }}"
                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('email') border-red-300 @enderror"
                               required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Alteração de Senha -->
            <div class="mb-8">
                <h4 class="text-md font-semibold text-slate-800 mb-4 flex items-center">
                    <i data-lucide="lock" class="h-4 w-4 mr-2 text-orange-600"></i>
                    Alterar Senha
                </h4>
                <p class="text-sm text-slate-600 mb-4">Deixe em branco se não quiser alterar a senha</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-slate-700 mb-2">
                            Senha Atual
                        </label>
                        <input type="password" 
                               id="current_password" 
                               name="current_password"
                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('current_password') border-red-300 @enderror">
                        @error('current_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            Nova Senha
                        </label>
                        <input type="password" 
                               id="password" 
                               name="password"
                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400 @error('password') border-red-300 @enderror">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">
                            Confirmar Nova Senha
                        </label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                    </div>
                </div>
            </div>

            <!-- Informações da Conta -->
            <div class="mb-8">
                <h4 class="text-md font-semibold text-slate-800 mb-4 flex items-center">
                    <i data-lucide="info" class="h-4 w-4 mr-2 text-purple-600"></i>
                    Informações da Conta
                </h4>
                
                <div class="bg-slate-50 rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1">Função</label>
                            <p class="text-slate-800 font-medium">{{ $roleTitle }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1">Status</label>
                            <p class="text-slate-800 font-medium">
                                @if($user['active'])
                                    <span class="text-green-600">Ativo</span>
                                @else
                                    <span class="text-red-600">Inativo</span>
                                @endif
                            </p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1">Última Atualização</label>
                            <p class="text-slate-800 font-medium">{{ date('d/m/Y H:i', strtotime($user['updated_at'] ?? now())) }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1">Membro desde</label>
                            <p class="text-slate-800 font-medium">{{ date('d/m/Y', strtotime($user['created_at'] ?? now())) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="flex items-center justify-between pt-6 border-t border-slate-200">
                <a href="{{ route('dashboard') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200 flex items-center">
                    <i data-lucide="arrow-left" class="h-4 w-4 mr-2"></i>
                    Voltar ao Dashboard
                </a>
                
                <div class="flex items-center space-x-4">
                    <button type="button" 
                            onclick="resetForm()"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200 flex items-center">
                        <i data-lucide="refresh-cw" class="h-4 w-4 mr-2"></i>
                        Resetar
                    </button>
                    
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center shadow-md hover:shadow-lg">
                        <i data-lucide="save" class="h-4 w-4 mr-2"></i>
                        Salvar Alterações
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Initialize Lucide icons
lucide.createIcons();

// Função para resetar o formulário
function resetForm() {
    if (confirm('Tem certeza que deseja resetar o formulário? Todas as alterações não salvas serão perdidas.')) {
        document.querySelector('form').reset();
        // Restaurar valores originais
        document.getElementById('name').value = '{{ $user['name'] }}';
        document.getElementById('email').value = '{{ $user['email'] }}';
    }
}

// Validação em tempo real
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    
    function validatePassword() {
        if (password.value && passwordConfirmation.value) {
            if (password.value !== passwordConfirmation.value) {
                passwordConfirmation.setCustomValidity('As senhas não coincidem');
                passwordConfirmation.classList.add('border-red-300');
            } else {
                passwordConfirmation.setCustomValidity('');
                passwordConfirmation.classList.remove('border-red-300');
            }
        }
    }
    
    password.addEventListener('input', validatePassword);
    passwordConfirmation.addEventListener('input', validatePassword);
});
</script>
@endsection
