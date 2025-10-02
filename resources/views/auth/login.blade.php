<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conselho Pronto - Login</title>
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
        
        /* Ajustes para zoom 75% */
        .zoom-75 {
            transform: scale(0.75);
            transform-origin: top left;
            width: 133.33%; /* Compensar o scale */
            height: 133.33%;
        }
        
        .container-75 {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50">
    <div class="container-75">
        <div class="zoom-75 min-h-screen flex flex-col lg:flex-row">
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
                    <!-- Quadrado branco com logo -->
                    <div class="bg-white bg-opacity-20 rounded-2xl px-0.5 py-4 mb-6 backdrop-blur-sm border border-white border-opacity-30 flex items-center justify-center h-64">
                        <img src="{{ asset('images/Logo_IEI.jpg') }}" alt="Logo Instituto Ivoti" class="w-full h-full object-contain rounded-2xl">
                    </div>
                    <h1 class="text-4xl font-bold mb-2">Conselho Pronto</h1>
                    <p class="text-lg text-blue-100 leading-relaxed">
                        Sistema completo de gestão educacional para acompanhamento acadêmico e conselhos de classe
                    </p>
                </div>
                
                <!-- Ícones com descrições -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold">Gestão de Disciplinas</h3>
                            <p class="text-sm text-blue-100">Controle completo das disciplinas e conteúdos</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold">Controle de Turmas</h3>
                            <p class="text-sm text-blue-100">Gerenciamento eficiente de turmas e alunos</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold">Acompanhamento</h3>
                            <p class="text-sm text-blue-100">Monitoramento detalhado do progresso acadêmico</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Seção Direita - Formulário de Login -->
        <div class="lg:w-1/2 flex items-center justify-center px-8 py-12 lg:py-24">
            <div class="w-full max-w-md">
                <!-- Card de Login -->
                <div class="bg-white rounded-2xl shadow-xl p-8 card-hover">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Acesse sua Conta</h2>
                        <p class="text-gray-600">Entre com suas credenciais para continuar</p>
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
                    
                    <!-- Formulário de Login -->
                    <form method="POST" action="{{ route('login.post') }}" id="loginForm">
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
                        
                        <!-- Campo Senha -->
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Senha
                            </label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-blue focus:border-transparent transition duration-200 @error('password') border-red-500 @enderror"
                                placeholder="Digite sua senha"
                                required
                            >
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Link Esqueci Senha -->
                        <div class="text-right mb-6">
                            <a href="{{ route('forgot-password') }}" class="text-sm text-primary-blue hover:text-blue-700 transition duration-200">
                                Esqueceu sua senha?
                            </a>
                        </div>
                        
                        <!-- Botão de Login -->
                        <button 
                            type="submit" 
                            id="loginButton"
                            class="w-full bg-gradient-to-r from-primary-blue to-primary-slate text-white py-3 px-4 rounded-lg font-semibold hover:from-blue-700 hover:to-slate-700 focus:outline-none focus:ring-2 focus:ring-primary-blue focus:ring-offset-2 transition duration-200 flex items-center justify-center"
                        >
                            <span id="loginText">Entrar</span>
                            <div id="loginSpinner" class="loading-spinner ml-2 hidden"></div>
                        </button>
                    </form>
                    
                    <!-- Botão Criar Nova Conta -->
                    <div class="mt-6 text-center">
                        <button class="w-full border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-semibold hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-blue focus:ring-offset-2 transition duration-200">
                            Criar Nova Conta
                        </button>
                    </div>
                    
                    <!-- Links de Termos -->
                    <div class="mt-8 text-center text-xs text-gray-500">
                        <p>
                            Ao continuar, você concorda com nossos 
                            <a href="#" class="text-primary-blue hover:underline">Termos de Uso</a> 
                            e 
                            <a href="#" class="text-primary-blue hover:underline">Política de Privacidade</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    
    <script>
        // Loading state no formulário
        document.getElementById('loginForm').addEventListener('submit', function() {
            const button = document.getElementById('loginButton');
            const text = document.getElementById('loginText');
            const spinner = document.getElementById('loginSpinner');
            
            button.disabled = true;
            text.textContent = 'Entrando...';
            spinner.classList.remove('hidden');
        });
        
        // Validação em tempo real
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        
        emailInput.addEventListener('input', function() {
            if (this.value.includes('@ivoti.edu.br')) {
                this.classList.remove('border-red-500');
                this.classList.add('border-green-500');
            } else {
                this.classList.remove('border-green-500');
                this.classList.add('border-red-500');
            }
        });
        
        passwordInput.addEventListener('input', function() {
            if (this.value.length >= 6) {
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
