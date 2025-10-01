<?php

namespace App\Helpers;

class PermissionHelper
{
    /**
     * Obter dados do usuário da sessão
     */
    public static function getCurrentUser()
    {
        return session('user_data');
    }

    /**
     * Verificar se o usuário atual tem um role específico
     */
    public static function hasRole($role)
    {
        $user = self::getCurrentUser();
        return $user['role'] ?? 'professor' === $role;
    }

    /**
     * Verificar se é admin
     */
    public static function isAdmin()
    {
        return self::hasRole('admin');
    }

    /**
     * Verificar se é coordenador
     */
    public static function isCoordenador()
    {
        return self::hasRole('coordenador');
    }

    /**
     * Verificar se é conselheiro
     */
    public static function isConselheiro()
    {
        return self::hasRole('conselheiro');
    }

    /**
     * Verificar se é professor
     */
    public static function isProfessor()
    {
        return self::hasRole('professor');
    }

    /**
     * Verificar se pode ver todas as turmas
     */
    public static function canViewAllTurmas()
    {
        $user = self::getCurrentUser();
        $role = $user['role'] ?? 'professor';
        
        return in_array($role, ['admin', 'coordenador', 'conselheiro']);
    }

    /**
     * Verificar se pode ver todos os alunos
     */
    public static function canViewAllAlunos()
    {
        $user = self::getCurrentUser();
        $role = $user['role'] ?? 'professor';
        
        return in_array($role, ['admin', 'coordenador', 'conselheiro']);
    }

    /**
     * Verificar se pode ver todas as disciplinas
     */
    public static function canViewAllDisciplinas()
    {
        $user = self::getCurrentUser();
        $role = $user['role'] ?? 'professor';
        
        return in_array($role, ['admin', 'coordenador', 'conselheiro']);
    }

    /**
     * Verificar se pode gerenciar professores
     */
    public static function canManageProfessores()
    {
        $user = self::getCurrentUser();
        $role = $user['role'] ?? 'professor';
        
        return in_array($role, ['admin', 'coordenador']);
    }

    /**
     * Verificar se pode criar turmas
     */
    public static function canCreateTurmas()
    {
        $user = self::getCurrentUser();
        $role = $user['role'] ?? 'professor';
        
        return in_array($role, ['admin', 'coordenador']);
    }

    /**
     * Verificar se pode criar alunos
     */
    public static function canCreateAlunos()
    {
        $user = self::getCurrentUser();
        $role = $user['role'] ?? 'professor';
        
        return in_array($role, ['admin', 'coordenador']);
    }

    /**
     * Verificar se pode criar disciplinas
     */
    public static function canCreateDisciplinas()
    {
        $user = self::getCurrentUser();
        $role = $user['role'] ?? 'professor';
        
        return in_array($role, ['admin', 'coordenador']);
    }

    /**
     * Verificar se pode criar cursos
     */
    public static function canCreateCursos()
    {
        $user = self::getCurrentUser();
        $role = $user['role'] ?? 'professor';
        
        return in_array($role, ['admin', 'coordenador']);
    }

    /**
     * Verificar se pode editar notas
     */
    public static function canEditNotas()
    {
        $user = self::getCurrentUser();
        $role = $user['role'] ?? 'professor';
        
        return in_array($role, ['admin', 'coordenador', 'conselheiro', 'professor']);
    }

    /**
     * Verificar se pode ver notas
     */
    public static function canViewNotas()
    {
        $user = self::getCurrentUser();
        $role = $user['role'] ?? 'professor';
        
        return in_array($role, ['admin', 'coordenador', 'conselheiro', 'professor']);
    }

    /**
     * Obter turmas do professor
     */
    public static function getProfessorTurmas()
    {
        $user = self::getCurrentUser();
        
        if (self::isProfessor()) {
            return $user['turmas_ids'] ?? [];
        }
        
        return [];
    }

    /**
     * Obter disciplinas do professor
     */
    public static function getProfessorDisciplinas()
    {
        $user = self::getCurrentUser();
        
        if (self::isProfessor()) {
            return $user['disciplinas_ids'] ?? [];
        }
        
        return [];
    }

    /**
     * Obter nome do usuário atual
     */
    public static function getCurrentUserName()
    {
        $user = self::getCurrentUser();
        return $user['name'] ?? 'Usuário';
    }

    /**
     * Obter role do usuário atual
     */
    public static function getCurrentUserRole()
    {
        $user = self::getCurrentUser();
        return $user['role'] ?? 'professor';
    }

    /**
     * Obter título do role
     */
    public static function getRoleTitle($role = null)
    {
        $role = $role ?? self::getCurrentUserRole();
        
        $titles = [
            'admin' => 'Administrador',
            'coordenador' => 'Coordenador',
            'conselheiro' => 'Conselheiro',
            'professor' => 'Professor'
        ];
        
        return $titles[$role] ?? 'Professor';
    }
}
