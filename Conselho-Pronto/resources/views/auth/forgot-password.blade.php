<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci Minha Senha - Conselho Pronto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#2563eb',
                        'primary-slate': '#475569',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #2563eb 0%, #475569 100%);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-animation:nth-child(2) {
            animation-delay: -2s;
        }
        
        .floating-animation:nth-child(3) {
            animation-delay: -4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .loading-spinner {
            border: 2px solid #f3f4f6;
            border-top: 2px solid #2563eb;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Seção Esquerda - Branding -->
        <div class="lg:w-1/2 gradient-bg relative overflow-hidden flex flex-col justify-center items-center px-8 py-12 lg:py-24">
            <!-- Elementos decorativos -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-white bg-opacity-10 rounded-full floating-animation"></div>
            <div class="absolute top-32 right-16 w-16 h-16 bg-white bg-opacity-10 rounded-full floating-animation"></div>
            <div class="absolute bottom-20 left-20 w-12 h-12 bg-white bg-opacity-10 rounded-full floating-animation"></div>
            <div class="absolute bottom-32 right-10 w-8 h-8 bg-white bg-opacity-10 rounded-full floating-animation"></div>
            
            <!-- Conteúdo principal -->
            <div class="relative z-10 text-center text-white max-w-md">
                <!-- Logo -->
                <div class="mb-8">
                    <img src="{{ asset('images/Logo_IEI.jpg') }}" alt="Logo IEI" class="mx-auto h-20 w-auto mb-4">
                    <h1 class="text-4xl font-bold mb-2">Conselho Pronto</h1>
                    <p class="text-lg text-blue-100 leading-relaxed">
                        Recupere o acesso à sua conta de forma segura e rápida
                    </p>
                </div>
                
                <!-- Ícone de segurança -->
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
                
                <div class="text-center">
                    <h3 class="text-xl font-semibold mb-2">Recuperação Segura</h3>
                    <p class="text-blue-100">
                        Digite seu email institucional para receber as instruções de recuperação de senha
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Seção Direita - Formulário de Recuperação -->
        <div class="lg:w-1/2 flex items-center justify-center px-8 py-12 lg:py-24">
            <div class="w-full max-w-md">
                <!-- Card de Recuperação -->
                <div class="bg-white rounded-2xl shadow-xl p-8 card-hover">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Esqueci Minha Senha</h2>
                        <p class="text-gray-600">Digite seu email para receber instruções de recuperação</p>
                    </div>
                    
                    <!-- Mensagens de erro/sucesso -->
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-sm text-red-800">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div class="text-sm text-green-800">{{ session('success') }}</div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Formulário de Recuperação -->
                    <form method="POST" action="{{ route('forgot-password.post') }}" id="forgotPasswordForm">
                        @csrf
                        
                        <!-- Campo Email -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Institucional
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-blue focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
                                placeholder="seu.email@ivoti.edu.br"
                                required
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Botão de Envio -->
                        <button 
                            type="submit" 
                            id="submitButton"
                            class="w-full bg-gradient-to-r from-primary-blue to-primary-slate text-white py-3 px-4 rounded-lg font-semibold hover:from-blue-700 hover:to-slate-700 focus:outline-none focus:ring-2 focus:ring-primary-blue focus:ring-offset-2 transition duration-200 flex items-center justify-center mb-6"
                        >
                            <span id="submitText">Enviar Instruções</span>
                            <div id="submitSpinner" class="loading-spinner ml-2 hidden"></div>
                        </button>
                    </form>
                    
                    <!-- Link de Volta -->
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-primary-blue hover:text-blue-700 transition duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Voltar para o Login
                        </a>
                    </div>
                    
                    <!-- Informações adicionais -->
                    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">Informações Importantes:</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• Apenas emails institucionais (@ivoti.edu.br) são aceitos</li>
                                    <li>• Verifique sua caixa de spam se não receber o email</li>
                                    <li>• O link de recuperação expira em 24 horas</li>
                                    <li>• Entre em contato com o suporte se necessário</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Loading state no formulário
        document.getElementById('forgotPasswordForm').addEventListener('submit', function() {
            const button = document.getElementById('submitButton');
            const text = document.getElementById('submitText');
            const spinner = document.getElementById('submitSpinner');
            
            button.disabled = true;
            text.textContent = 'Enviando...';
            spinner.classList.remove('hidden');
        });
        
        // Validação em tempo real
        const emailInput = document.getElementById('email');
        
        emailInput.addEventListener('input', function() {
            if (this.value.includes('@ivoti.edu.br')) {
                this.classList.remove('border-red-500');
                this.classList.add('border-green-500');
            } else {
                this.classList.remove('border-green-500');
                this.classList.add('border-red-500');
            }
        });
    </script>
</body>
</html>
