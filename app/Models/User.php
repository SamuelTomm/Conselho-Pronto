<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'turmas_ids',
        'disciplinas_ids',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'turmas_ids' => 'array',
            'disciplinas_ids' => 'array',
            'active' => 'boolean',
        ];
    }

    // Constantes para roles
    const ROLE_ADMIN = 'admin';
    const ROLE_COORDENADOR = 'coordenador';
    const ROLE_CONSELHEIRO = 'conselheiro';
    const ROLE_PROFESSOR = 'professor';

    // Métodos de permissão
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isAdmin()
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    public function isCoordenador()
    {
        return $this->hasRole(self::ROLE_COORDENADOR);
    }

    public function isConselheiro()
    {
        return $this->hasRole(self::ROLE_CONSELHEIRO);
    }

    public function isProfessor()
    {
        return $this->hasRole(self::ROLE_PROFESSOR);
    }

    // Métodos de permissão específicas
    public function canViewAllTurmas()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_COORDENADOR, self::ROLE_CONSELHEIRO]);
    }

    public function canViewAllAlunos()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_COORDENADOR, self::ROLE_CONSELHEIRO]);
    }

    public function canViewAllDisciplinas()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_COORDENADOR, self::ROLE_CONSELHEIRO]);
    }

    public function canManageProfessores()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_COORDENADOR]);
    }

    public function canCreateTurmas()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_COORDENADOR]);
    }

    public function canCreateAlunos()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_COORDENADOR]);
    }

    public function canCreateDisciplinas()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_COORDENADOR]);
    }

    public function canCreateCursos()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_COORDENADOR]);
    }

    public function canEditNotas()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_COORDENADOR, self::ROLE_CONSELHEIRO, self::ROLE_PROFESSOR]);
    }

    public function canViewNotas()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_COORDENADOR, self::ROLE_CONSELHEIRO, self::ROLE_PROFESSOR]);
    }

    // Métodos para obter turmas e disciplinas do professor
    public function getTurmas()
    {
        if ($this->isProfessor()) {
            return $this->turmas_ids ?? [];
        }
        return []; // Para outros roles, será tratado nos controllers
    }

    public function getDisciplinas()
    {
        if ($this->isProfessor()) {
            return $this->disciplinas_ids ?? [];
        }
        return []; // Para outros roles, será tratado nos controllers
    }

    // Método para obter dados mockados de usuários
    public static function getMockUsers()
    {
        return [
            [
                'id' => 1,
                'name' => 'Admin Sistema',
                'email' => 'admin@ivoti.edu.br',
                'role' => self::ROLE_ADMIN,
                'turmas_ids' => [],
                'disciplinas_ids' => [],
                'active' => true
            ],
            [
                'id' => 2,
                'name' => 'Maria Silva - Coordenadora',
                'email' => 'maria.silva@ivoti.edu.br',
                'role' => self::ROLE_COORDENADOR,
                'turmas_ids' => [],
                'disciplinas_ids' => [],
                'active' => true
            ],
            [
                'id' => 3,
                'name' => 'João Santos - Conselheiro',
                'email' => 'joao.santos@ivoti.edu.br',
                'role' => self::ROLE_CONSELHEIRO,
                'turmas_ids' => [],
                'disciplinas_ids' => [],
                'active' => true
            ],
            [
                'id' => 4,
                'name' => 'Ana Costa - Professora',
                'email' => 'ana.costa@ivoti.edu.br',
                'role' => self::ROLE_PROFESSOR,
                'turmas_ids' => [1, 2, 3], // Turmas 3A2024, 2B2024, 1C2024
                'disciplinas_ids' => [1, 2, 3], // Matemática, Física, Programação
                'active' => true
            ],
            [
                'id' => 5,
                'name' => 'Carlos Lima - Professor',
                'email' => 'carlos.lima@ivoti.edu.br',
                'role' => self::ROLE_PROFESSOR,
                'turmas_ids' => [4, 5], // Turmas técnicas
                'disciplinas_ids' => [3, 4, 5], // Programação, Design, História
                'active' => true
            ]
        ];
    }
}
