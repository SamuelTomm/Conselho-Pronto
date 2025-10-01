<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Conselho Pronto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue': {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        },
                        'slate': {
                            50: '#f8fafc',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
        .card-hover:hover {
            transform: scale(1.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>
</head>
<body>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 flex">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-blue-900 to-slate-800 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl">
            <!-- Header da Sidebar -->
            <div class="flex items-center justify-between h-16 px-6 border-b border-blue-800/30">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-2 rounded-xl shadow-lg">
                        <i data-lucide="school" class="h-6 w-6 text-white"></i>
                    </div>
                    <div>
                        <span class="text-white font-bold text-lg">Conselho Pronto</span>
                        <p class="text-blue-200 text-xs">Sistema de Gestão</p>
                    </div>
                </div>
            </div>

            <!-- Menu de Navegação -->
            <nav class="mt-8 px-4">
                <ul class="space-y-2">
                    @php
                        $userRole = session('user_data.role', 'professor');
                    @endphp
                    
                    <!-- Início -->
                    <li>
                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg transform scale-105' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white hover:transform hover:scale-105' }} rounded-lg transition-all duration-200">
                            <i data-lucide="home" class="h-5 w-5 mr-3"></i>
                            <span class="{{ request()->routeIs('dashboard') ? 'font-medium' : '' }}">Início</span>
                        </a>
                    </li>
                    
                    <!-- Ciclos - Apenas Admin, Coordenador e Conselheiro -->
                    @if(in_array($userRole, ['admin', 'coordenador', 'conselheiro']))
                    <li>
                        <a href="{{ route('ciclos.index') }}" 
                           class="flex items-center px-4 py-3 {{ request()->routeIs('ciclos.*') ? 'text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg transform scale-105' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white hover:transform hover:scale-105' }} rounded-lg transition-all duration-200">
                            <i data-lucide="circle" class="h-5 w-5 mr-3"></i>
                            <span class="{{ request()->routeIs('ciclos.*') ? 'font-medium' : '' }}">Ciclos</span>
                        </a>
                    </li>
                    @endif
                    
                    <!-- Cursos - Apenas Admin, Coordenador e Conselheiro -->
                    @if(in_array($userRole, ['admin', 'coordenador', 'conselheiro']))
                    <li>
                        <a href="{{ route('cursos.index') }}" 
                           class="flex items-center px-4 py-3 {{ request()->routeIs('cursos.*') ? 'text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg transform scale-105' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white hover:transform hover:scale-105' }} rounded-lg transition-all duration-200">
                            <i data-lucide="file-text" class="h-5 w-5 mr-3"></i>
                            <span class="{{ request()->routeIs('cursos.*') ? 'font-medium' : '' }}">Cursos</span>
                        </a>
                    </li>
                    @endif
                    
                    <!-- Alunos - Todos podem ver, mas com permissões diferentes -->
                    <li>
                        <a href="{{ route('alunos.index') }}" 
                           class="flex items-center px-4 py-3 {{ request()->routeIs('alunos.*') ? 'text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg transform scale-105' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white hover:transform hover:scale-105' }} rounded-lg transition-all duration-200">
                            <i data-lucide="users" class="h-5 w-5 mr-3"></i>
                            <span class="{{ request()->routeIs('alunos.*') ? 'font-medium' : '' }}">Alunos</span>
                        </a>
                    </li>
                    
                    <!-- Disciplinas - Todos podem ver, mas com permissões diferentes -->
                    <li>
                        <a href="{{ route('disciplinas.index') }}" 
                           class="flex items-center px-4 py-3 {{ request()->routeIs('disciplinas.*') ? 'text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg transform scale-105' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white hover:transform hover:scale-105' }} rounded-lg transition-all duration-200">
                            <i data-lucide="book-open" class="h-5 w-5 mr-3"></i>
                            <span class="{{ request()->routeIs('disciplinas.*') ? 'font-medium' : '' }}">Disciplinas</span>
                        </a>
                    </li>
                    
                    <!-- Turmas - Todos podem ver, mas com permissões diferentes -->
                    <li>
                        <a href="{{ route('turmas.index') }}" 
                           class="flex items-center px-4 py-3 {{ request()->routeIs('turmas.*') ? 'text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg transform scale-105' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white hover:transform hover:scale-105' }} rounded-lg transition-all duration-200">
                            <i data-lucide="send" class="h-5 w-5 mr-3"></i>
                            <span class="{{ request()->routeIs('turmas.*') ? 'font-medium' : '' }}">Turmas</span>
                        </a>
                    </li>
                    
                    <!-- Professores - Apenas Admin e Coordenador -->
                    @if(in_array($userRole, ['admin', 'coordenador']))
                    <li>
                        <a href="{{ route('professores.index') }}" 
                           class="flex items-center px-4 py-3 {{ request()->routeIs('professores.*') ? 'text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg transform scale-105' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white hover:transform hover:scale-105' }} rounded-lg transition-all duration-200">
                            <i data-lucide="user-check" class="h-5 w-5 mr-3"></i>
                            <span class="{{ request()->routeIs('professores.*') ? 'font-medium' : '' }}">Professores</span>
                        </a>
                    </li>
                    @endif
                    
                    <!-- Minhas Turmas - Apenas para Professores -->
                    @if($userRole === 'professor')
                    <li>
                        <a href="{{ route('professor.turmas') }}" 
                           class="flex items-center px-4 py-3 {{ request()->routeIs('professor.turmas') ? 'text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg transform scale-105' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white hover:transform hover:scale-105' }} rounded-lg transition-all duration-200">
                            <i data-lucide="graduation-cap" class="h-5 w-5 mr-3"></i>
                            <span class="{{ request()->routeIs('professor.turmas') ? 'font-medium' : '' }}">Minhas Turmas</span>
                        </a>
                    </li>
                    @endif
                    
                    <!-- Minhas Disciplinas - Apenas para Professores -->
                    @if($userRole === 'professor')
                    <li>
                        <a href="{{ route('professor.disciplinas') }}" 
                           class="flex items-center px-4 py-3 {{ request()->routeIs('professor.disciplinas') ? 'text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg transform scale-105' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white hover:transform hover:scale-105' }} rounded-lg transition-all duration-200">
                            <i data-lucide="book" class="h-5 w-5 mr-3"></i>
                            <span class="{{ request()->routeIs('professor.disciplinas') ? 'font-medium' : '' }}">Minhas Disciplinas</span>
                        </a>
                    </li>
                    @endif
                    
                    <!-- Notas - Todos que podem editar notas -->
                    @if(in_array($userRole, ['admin', 'coordenador', 'conselheiro', 'professor']))
                    <li>
                        <a href="{{ route('notas.index') }}" 
                           class="flex items-center px-4 py-3 {{ request()->routeIs('notas.*') ? 'text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg transform scale-105' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white hover:transform hover:scale-105' }} rounded-lg transition-all duration-200">
                            <i data-lucide="clipboard-list" class="h-5 w-5 mr-3"></i>
                            <span class="{{ request()->routeIs('notas.*') ? 'font-medium' : '' }}">Notas</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 w-full">
            <!-- Header -->
            <header class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-30">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            @php
                                $userRole = session('user_data.role', 'professor');
                                $userName = session('user_data.name', 'Usuário');
                                $roleTitles = [
                                    'admin' => 'Administrador',
                                    'coordenador' => 'Coordenador',
                                    'conselheiro' => 'Conselheiro',
                                    'professor' => 'Professor'
                                ];
                                $roleTitle = $roleTitles[$userRole] ?? 'Professor';
                            @endphp
                            
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                                @if(request()->routeIs('ciclos.*'))
                                    Anos Letivos
                                @elseif(request()->routeIs('cursos.*'))
                                    Cursos
                                @elseif(request()->routeIs('alunos.*'))
                                    Alunos
                                @elseif(request()->routeIs('disciplinas.*'))
                                    Disciplinas
                                @elseif(request()->routeIs('turmas.*'))
                                    Turmas
                                @elseif(request()->routeIs('professores.*'))
                                    Professores
                                @elseif(request()->routeIs('professor.turmas'))
                                    Minhas Turmas
                                @elseif(request()->routeIs('professor.disciplinas'))
                                    Minhas Disciplinas
                                @elseif(request()->routeIs('notas.*'))
                                    Notas
                                @else
                                    Dashboard
                                @endif
                            </h1>
                            <p class="text-sm text-slate-600 font-medium">
                                @if(request()->routeIs('ciclos.*'))
                                    Gerencie os anos letivos do sistema
                                @elseif(request()->routeIs('cursos.*'))
                                    Gerencie os cursos disponíveis
                                @elseif(request()->routeIs('alunos.*'))
                                    @if($userRole === 'professor')
                                        Visualize os alunos das suas turmas
                                    @else
                                        Gerencie os alunos cadastrados
                                    @endif
                                @elseif(request()->routeIs('disciplinas.*'))
                                    @if($userRole === 'professor')
                                        Visualize as suas disciplinas
                                    @else
                                        Gerencie as disciplinas do sistema
                                    @endif
                                @elseif(request()->routeIs('turmas.*'))
                                    @if($userRole === 'professor')
                                        Visualize as suas turmas
                                    @else
                                        Gerencie as turmas do sistema
                                    @endif
                                @elseif(request()->routeIs('professores.*'))
                                    Gerencie os professores cadastrados
                                @elseif(request()->routeIs('professor.turmas'))
                                    Visualize e gerencie suas turmas
                                @elseif(request()->routeIs('professor.disciplinas'))
                                    Visualize e gerencie suas disciplinas
                                @elseif(request()->routeIs('notas.*'))
                                    Gerencie as notas dos alunos
                                @else
                                    Conselho Pronto - Sistema de Gestão Educacional
                                @endif
                            </p>
                            <p class="text-xs text-slate-500 mt-1">
                                Logado como: <span class="font-medium">{{ $userName }}</span> - {{ $roleTitle }}
                            </p>
                        </div>
                        
                        <!-- Dropdown do usuário -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" 
                                    class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium text-sm">
                                        {{ substr(session('user_data.name', 'U'), 0, 1) }}
                                    </span>
                                </div>
                                <div class="hidden md:block text-left">
                                    <div class="text-gray-700 font-medium text-sm">
                                        {{ session('user_data.name', 'Usuário') }}
                                    </div>
                                    <div class="text-gray-500 text-xs">
                                        {{ $roleTitle }}
                                    </div>
                                </div>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Perfil</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Configurações</a>
                                <hr class="my-1">
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        Sair
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main Content Area -->
            <main class="p-6">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <i data-lucide="check-circle" class="w-5 h-5 text-green-400 mr-2"></i>
                            <div class="text-sm text-green-800">{{ session('success') }}</div>
                        </div>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-400 mr-2"></i>
                            <div class="text-sm text-red-800">{{ session('error') }}</div>
                        </div>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Sidebar hover functionality
        document.addEventListener('mousemove', (e) => {
            const sidebar = document.getElementById('sidebar');
            if (e.clientX <= 20) {
                sidebar.classList.remove('-translate-x-full');
            } else if (e.clientX > 280) {
                sidebar.classList.add('-translate-x-full');
            }
        });
        
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>