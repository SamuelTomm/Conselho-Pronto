<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Professor - Conselho Pronto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <img src="{{ asset('images/Logo_IEI.jpg') }}" alt="Logo IEI" class="h-8 w-auto mr-3">
                        <h1 class="text-xl font-semibold text-gray-900">Conselho Pronto - Professor</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Bem-vindo, Professor!</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200">
                                Sair
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Minhas Turmas</h2>
                        <p class="text-gray-600 mb-6">Você está logado como <strong>Professor</strong>.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-blue-50 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-blue-900 mb-2">Turma A - Matemática</h3>
                                <p class="text-blue-700">30 alunos • 2º ano do Ensino Médio</p>
                            </div>
                            
                            <div class="bg-green-50 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-green-900 mb-2">Turma B - Física</h3>
                                <p class="text-green-700">28 alunos • 3º ano do Ensino Médio</p>
                            </div>
                            
                            <div class="bg-purple-50 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-purple-900 mb-2">Turma C - Química</h3>
                                <p class="text-purple-700">32 alunos • 1º ano do Ensino Médio</p>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">
                                ← Voltar para o Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

