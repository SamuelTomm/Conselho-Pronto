<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Sistema',
                'email' => 'admin@ivoti.edu.br',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'turmas_ids' => null,
                'disciplinas_ids' => null,
                'active' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maria Silva - Coordenadora',
                'email' => 'maria.silva@ivoti.edu.br',
                'password' => Hash::make('123456'),
                'role' => 'coordenador',
                'turmas_ids' => null,
                'disciplinas_ids' => null,
                'active' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'João Santos - Conselheiro',
                'email' => 'joao.santos@ivoti.edu.br',
                'password' => Hash::make('123456'),
                'role' => 'conselheiro',
                'turmas_ids' => null,
                'disciplinas_ids' => null,
                'active' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana Costa - Professora',
                'email' => 'ana.costa@ivoti.edu.br',
                'password' => Hash::make('123456'),
                'role' => 'professor',
                'turmas_ids' => json_encode([1, 2, 3]), // Turmas 3A2024, 2B2024, 1C2024
                'disciplinas_ids' => json_encode([1, 2, 3]), // Matemática, Física, Programação
                'active' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carlos Lima - Professor',
                'email' => 'carlos.lima@ivoti.edu.br',
                'password' => Hash::make('123456'),
                'role' => 'professor',
                'turmas_ids' => json_encode([4, 5]), // Turmas técnicas
                'disciplinas_ids' => json_encode([3, 4, 5]), // Programação, Design, História
                'active' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
