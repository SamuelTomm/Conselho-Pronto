<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrador',
                'description' => 'Acesso total ao sistema',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'coordenador',
                'display_name' => 'Coordenador',
                'description' => 'Pode gerenciar professores e visualizar todos os dados',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'conselheiro',
                'display_name' => 'Conselheiro',
                'description' => 'Pode visualizar todos os dados e notas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'professor',
                'display_name' => 'Professor',
                'description' => 'Pode visualizar apenas suas turmas e disciplinas',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
