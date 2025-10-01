<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'permissions'
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    // Relacionamentos
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Constantes para roles
    const ADMIN = 'admin';
    const COORDENADOR = 'coordenador';
    const CONSELHEIRO = 'conselheiro';
    const PROFESSOR = 'professor';

    // Método para verificar se o role tem uma permissão específica
    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions ?? []);
    }

    // Método estático para obter roles disponíveis
    public static function getAvailableRoles()
    {
        return [
            self::ADMIN => [
                'name' => 'Administrador',
                'description' => 'Acesso total ao sistema',
                'permissions' => ['*'] // Todas as permissões
            ],
            self::COORDENADOR => [
                'name' => 'Coordenador',
                'description' => 'Acesso a todas as turmas e alunos, pode gerenciar professores',
                'permissions' => [
                    'view_all_turmas',
                    'view_all_alunos',
                    'view_all_disciplinas',
                    'view_all_cursos',
                    'manage_professores',
                    'view_notas',
                    'edit_notas',
                    'view_relatorios'
                ]
            ],
            self::CONSELHEIRO => [
                'name' => 'Conselheiro',
                'description' => 'Acesso a todas as turmas e alunos para conselhos de classe',
                'permissions' => [
                    'view_all_turmas',
                    'view_all_alunos',
                    'view_all_disciplinas',
                    'view_notas',
                    'view_relatorios'
                ]
            ],
            self::PROFESSOR => [
                'name' => 'Professor',
                'description' => 'Acesso apenas às suas turmas e disciplinas',
                'permissions' => [
                    'view_own_turmas',
                    'view_own_disciplinas',
                    'view_own_alunos',
                    'edit_notas',
                    'add_notas'
                ]
            ]
        ];
    }

    // Método para obter dados mockados de roles
    public static function getMockRoles()
    {
        return [
            [
                'id' => 1,
                'name' => 'Administrador',
                'slug' => 'admin',
                'description' => 'Acesso total ao sistema',
                'permissions' => ['*']
            ],
            [
                'id' => 2,
                'name' => 'Coordenador',
                'slug' => 'coordenador',
                'description' => 'Acesso a todas as turmas e alunos, pode gerenciar professores',
                'permissions' => [
                    'view_all_turmas',
                    'view_all_alunos',
                    'view_all_disciplinas',
                    'view_all_cursos',
                    'manage_professores',
                    'view_notas',
                    'edit_notas',
                    'view_relatorios'
                ]
            ],
            [
                'id' => 3,
                'name' => 'Conselheiro',
                'slug' => 'conselheiro',
                'description' => 'Acesso a todas as turmas e alunos para conselhos de classe',
                'permissions' => [
                    'view_all_turmas',
                    'view_all_alunos',
                    'view_all_disciplinas',
                    'view_notas',
                    'view_relatorios'
                ]
            ],
            [
                'id' => 4,
                'name' => 'Professor',
                'slug' => 'professor',
                'description' => 'Acesso apenas às suas turmas e disciplinas',
                'permissions' => [
                    'view_own_turmas',
                    'view_own_disciplinas',
                    'view_own_alunos',
                    'edit_notas',
                    'add_notas'
                ]
            ]
        ];
    }
}
