<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter IDs dos roles
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        $coordenadorRoleId = DB::table('roles')->where('name', 'coordenador')->value('id');
        $conselheiroRoleId = DB::table('roles')->where('name', 'conselheiro')->value('id');
        $professorRoleId = DB::table('roles')->where('name', 'professor')->value('id');

        // Obter IDs das permissões
        $permissions = DB::table('permissions')->pluck('id', 'name');

        $rolePermissions = [
            // Admin - todas as permissões
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['view_all_turmas']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['view_all_alunos']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['view_all_disciplinas']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['view_all_cursos']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['view_ciclos']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['view_notas']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['view_relatorios']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['create_turmas']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['create_alunos']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['create_disciplinas']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['create_cursos']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['edit_notas']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['add_notas']],
            ['role_id' => $adminRoleId, 'permission_id' => $permissions['manage_professores']],

            // Coordenador
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['view_all_turmas']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['view_all_alunos']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['view_all_disciplinas']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['view_all_cursos']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['view_ciclos']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['view_notas']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['view_relatorios']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['create_turmas']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['create_alunos']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['create_disciplinas']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['create_cursos']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['edit_notas']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['add_notas']],
            ['role_id' => $coordenadorRoleId, 'permission_id' => $permissions['manage_professores']],

            // Conselheiro
            ['role_id' => $conselheiroRoleId, 'permission_id' => $permissions['view_all_turmas']],
            ['role_id' => $conselheiroRoleId, 'permission_id' => $permissions['view_all_alunos']],
            ['role_id' => $conselheiroRoleId, 'permission_id' => $permissions['view_all_disciplinas']],
            ['role_id' => $conselheiroRoleId, 'permission_id' => $permissions['view_all_cursos']],
            ['role_id' => $conselheiroRoleId, 'permission_id' => $permissions['view_ciclos']],
            ['role_id' => $conselheiroRoleId, 'permission_id' => $permissions['view_notas']],
            ['role_id' => $conselheiroRoleId, 'permission_id' => $permissions['view_relatorios']],

            // Professor
            ['role_id' => $professorRoleId, 'permission_id' => $permissions['view_own_turmas']],
            ['role_id' => $professorRoleId, 'permission_id' => $permissions['view_own_alunos']],
            ['role_id' => $professorRoleId, 'permission_id' => $permissions['view_own_disciplinas']],
            ['role_id' => $professorRoleId, 'permission_id' => $permissions['view_notas']],
            ['role_id' => $professorRoleId, 'permission_id' => $permissions['edit_notas']],
            ['role_id' => $professorRoleId, 'permission_id' => $permissions['add_notas']],
        ];

        // Adicionar timestamps
        $rolePermissions = array_map(function($item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            return $item;
        }, $rolePermissions);

        DB::table('role_permission')->insert($rolePermissions);
    }
}
