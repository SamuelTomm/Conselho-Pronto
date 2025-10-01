<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // Verificar se o usuário está autenticado
        if (!session('authenticated')) {
            return redirect('/')->with('error', 'Você precisa fazer login para acessar esta página.');
        }

        // Obter dados do usuário da sessão
        $userData = session('user_data');
        
        if (!$userData) {
            return redirect('/')->with('error', 'Dados do usuário não encontrados.');
        }

        // Verificar permissão baseada no role
        $userRole = $userData['role'] ?? 'professor';
        
        // Admin tem acesso a tudo
        if ($userRole === 'admin') {
            return $next($request);
        }

        // Verificar permissões específicas
        $hasPermission = $this->checkPermission($userRole, $permission);
        
        if (!$hasPermission) {
            return redirect()->route('dashboard')
                ->with('error', 'Você não tem permissão para acessar esta funcionalidade.');
        }

        return $next($request);
    }

    /**
     * Verificar se o role tem a permissão necessária
     */
    private function checkPermission($role, $permission)
    {
        $permissions = [
            'admin' => ['*'], // Admin tem todas as permissões
            'coordenador' => [
                'view_all_turmas',
                'view_all_alunos', 
                'view_all_disciplinas',
                'view_all_cursos',
                'manage_professores',
                'view_notas',
                'edit_notas',
                'view_relatorios',
                'create_turmas',
                'create_alunos',
                'create_disciplinas',
                'create_cursos'
            ],
            'conselheiro' => [
                'view_all_turmas',
                'view_all_alunos',
                'view_all_disciplinas', 
                'view_notas',
                'view_relatorios'
            ],
            'professor' => [
                'view_own_turmas',
                'view_own_disciplinas',
                'view_own_alunos',
                'edit_notas',
                'add_notas'
            ]
        ];

        $rolePermissions = $permissions[$role] ?? [];
        
        // Verificar se tem a permissão específica ou se é admin
        return in_array('*', $rolePermissions) || in_array($permission, $rolePermissions);
    }
}
