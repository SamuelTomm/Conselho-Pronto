<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Permissões de visualização
            [
                'name' => 'view_all_turmas',
                'display_name' => 'Visualizar Todas as Turmas',
                'description' => 'Pode visualizar todas as turmas do sistema',
                'module' => 'turmas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_own_turmas',
                'display_name' => 'Visualizar Próprias Turmas',
                'description' => 'Pode visualizar apenas suas turmas',
                'module' => 'turmas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_all_alunos',
                'display_name' => 'Visualizar Todos os Alunos',
                'description' => 'Pode visualizar todos os alunos do sistema',
                'module' => 'alunos',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_own_alunos',
                'display_name' => 'Visualizar Próprios Alunos',
                'description' => 'Pode visualizar apenas alunos das suas turmas',
                'module' => 'alunos',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_all_disciplinas',
                'display_name' => 'Visualizar Todas as Disciplinas',
                'description' => 'Pode visualizar todas as disciplinas do sistema',
                'module' => 'disciplinas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_own_disciplinas',
                'display_name' => 'Visualizar Próprias Disciplinas',
                'description' => 'Pode visualizar apenas suas disciplinas',
                'module' => 'disciplinas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_all_cursos',
                'display_name' => 'Visualizar Todos os Cursos',
                'description' => 'Pode visualizar todos os cursos do sistema',
                'module' => 'cursos',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_ciclos',
                'display_name' => 'Visualizar Ciclos',
                'description' => 'Pode visualizar os ciclos letivos',
                'module' => 'ciclos',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_notas',
                'display_name' => 'Visualizar Notas',
                'description' => 'Pode visualizar as notas dos alunos',
                'module' => 'notas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_relatorios',
                'display_name' => 'Visualizar Relatórios',
                'description' => 'Pode visualizar relatórios do sistema',
                'module' => 'relatorios',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Permissões de criação
            [
                'name' => 'create_turmas',
                'display_name' => 'Criar Turmas',
                'description' => 'Pode criar novas turmas',
                'module' => 'turmas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'create_alunos',
                'display_name' => 'Criar Alunos',
                'description' => 'Pode criar novos alunos',
                'module' => 'alunos',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'create_disciplinas',
                'display_name' => 'Criar Disciplinas',
                'description' => 'Pode criar novas disciplinas',
                'module' => 'disciplinas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'create_cursos',
                'display_name' => 'Criar Cursos',
                'description' => 'Pode criar novos cursos',
                'module' => 'cursos',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Permissões de edição
            [
                'name' => 'edit_notas',
                'display_name' => 'Editar Notas',
                'description' => 'Pode editar as notas dos alunos',
                'module' => 'notas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'add_notas',
                'display_name' => 'Adicionar Notas',
                'description' => 'Pode adicionar novas notas',
                'module' => 'notas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Permissões de gerenciamento
            [
                'name' => 'manage_professores',
                'display_name' => 'Gerenciar Professores',
                'description' => 'Pode gerenciar professores do sistema',
                'module' => 'professores',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
