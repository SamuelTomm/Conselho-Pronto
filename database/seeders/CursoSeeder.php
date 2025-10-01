<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoSeeder extends Seeder
{
    public function run()
    {
        $cursos = [
            [
                'codigo' => 'BASICO',
                'nome' => 'Formação Básica',
                'descricao' => 'Disciplinas básicas obrigatórias para todos os alunos do Ensino Médio',
                'tipo' => 'Básico',
                'cor' => 'blue',
                'alunos_count' => 450,
                'disciplinas_count' => 8,
                'ativo' => true
            ],
            [
                'codigo' => 'EXATAS',
                'nome' => 'Itinerário de Exatas',
                'descricao' => 'Aprofundamento em Matemática, Física, Química e áreas correlatas',
                'tipo' => 'Itinerário',
                'cor' => 'green',
                'alunos_count' => 120,
                'disciplinas_count' => 6,
                'ativo' => true
            ],
            [
                'codigo' => 'HUMANAS',
                'nome' => 'Itinerário de Humanas',
                'descricao' => 'Aprofundamento em História, Geografia, Filosofia e Sociologia',
                'tipo' => 'Itinerário',
                'cor' => 'purple',
                'alunos_count' => 95,
                'disciplinas_count' => 5,
                'ativo' => true
            ],
            [
                'codigo' => 'TEC_TI',
                'nome' => 'Técnico em Informática',
                'descricao' => 'Curso técnico em Tecnologia da Informação com foco em programação e desenvolvimento',
                'tipo' => 'Técnico',
                'cor' => 'orange',
                'alunos_count' => 85,
                'disciplinas_count' => 12,
                'ativo' => true
            ],
            [
                'codigo' => 'TEC_ADM',
                'nome' => 'Técnico em Administração',
                'descricao' => 'Curso técnico em Administração com foco em gestão empresarial',
                'tipo' => 'Técnico',
                'cor' => 'pink',
                'alunos_count' => 70,
                'disciplinas_count' => 10,
                'ativo' => true
            ],
            [
                'codigo' => 'BIOLOGICAS',
                'nome' => 'Itinerário de Biológicas',
                'descricao' => 'Aprofundamento em Biologia, Química e áreas da saúde',
                'tipo' => 'Itinerário',
                'cor' => 'emerald',
                'alunos_count' => 110,
                'disciplinas_count' => 7,
                'ativo' => true
            ],
            [
                'codigo' => 'TEC_ELETRO',
                'nome' => 'Técnico em Eletrotécnica',
                'descricao' => 'Curso técnico em Eletrotécnica com foco em instalações elétricas',
                'tipo' => 'Técnico',
                'cor' => 'blue',
                'alunos_count' => 45,
                'disciplinas_count' => 14,
                'ativo' => true
            ],
            [
                'codigo' => 'LINGUAGENS',
                'nome' => 'Itinerário de Linguagens',
                'descricao' => 'Aprofundamento em Língua Portuguesa, Literatura e Artes',
                'tipo' => 'Itinerário',
                'cor' => 'purple',
                'alunos_count' => 80,
                'disciplinas_count' => 6,
                'ativo' => true
            ]
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
        }
    }
}
