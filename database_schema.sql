-- =====================================================
-- SCRIPT DE CRIAÇÃO DO BANCO DE DADOS - CONSELHO PRONTO
-- Sistema de Gestão Educacional
-- =====================================================

-- Configurações iniciais
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- =====================================================
-- 1. TABELAS DE SISTEMA (Laravel)
-- =====================================================

-- Tabela de usuários do sistema
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','coordenador','conselheiro','professor') NOT NULL DEFAULT 'professor',
  `turmas_ids` json DEFAULT NULL COMMENT 'IDs das turmas como array',
  `disciplinas_ids` json DEFAULT NULL COMMENT 'IDs das disciplinas como array',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de tokens de reset de senha
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de sessões
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 2. TABELAS DE CACHE E JOBS (Laravel)
-- =====================================================

-- Tabela de cache
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de cache de locks
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de jobs
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de falhas de jobs
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 3. TABELAS PRINCIPAIS DO SISTEMA
-- =====================================================

-- Tabela de cursos
CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `tipo` enum('Básico','Itinerário','Técnico') NOT NULL DEFAULT 'Básico',
  `cor` varchar(255) NOT NULL DEFAULT 'blue' COMMENT 'blue, green, purple, orange, pink, emerald',
  `alunos_count` int(11) NOT NULL DEFAULT 0,
  `disciplinas_count` int(11) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cursos_codigo_unique` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de turmas
CREATE TABLE `turmas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `nivel` enum('Fundamental','Ensino Médio','Técnico') NOT NULL DEFAULT 'Ensino Médio',
  `ano` int(11) NOT NULL,
  `periodo` enum('Matutino','Vespertino','Noturno','Integral') NOT NULL DEFAULT 'Matutino',
  `conselheiro` varchar(255) DEFAULT NULL,
  `sala` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `cor` varchar(255) NOT NULL DEFAULT 'blue' COMMENT 'blue, green, purple, orange, pink, emerald',
  `alunos_count` int(11) NOT NULL DEFAULT 0,
  `disciplinas_count` int(11) NOT NULL DEFAULT 0,
  `status` enum('Ativa','Inativa') NOT NULL DEFAULT 'Ativa',
  `curso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `turmas_codigo_unique` (`codigo`),
  KEY `turmas_curso_id_foreign` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de professores
CREATE TABLE `professores` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','coordenador','conselheiro','professor') NOT NULL DEFAULT 'professor',
  `especialidade` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `data_admissao` date DEFAULT NULL,
  `turmas_ids` json DEFAULT NULL COMMENT 'IDs das turmas como array',
  `disciplinas_ids` json DEFAULT NULL COMMENT 'IDs das disciplinas como array',
  `observacoes` text DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `professores_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de alunos
CREATE TABLE `alunos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `matricula` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `turma_nome` varchar(255) DEFAULT NULL COMMENT 'Nome da turma para relacionamento',
  `curso_nome` varchar(255) DEFAULT NULL COMMENT 'Nome do curso para relacionamento',
  `responsavel` varchar(255) DEFAULT NULL,
  `telefone_responsavel` varchar(255) DEFAULT NULL,
  `status` enum('Ativo','Inativo','Transferido') NOT NULL DEFAULT 'Ativo',
  `observacoes` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `turma_id` bigint(20) UNSIGNED DEFAULT NULL,
  `curso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alunos_matricula_unique` (`matricula`),
  UNIQUE KEY `alunos_email_unique` (`email`),
  KEY `alunos_turma_id_foreign` (`turma_id`),
  KEY `alunos_curso_id_foreign` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de disciplinas
CREATE TABLE `disciplinas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `curso_nome` varchar(255) DEFAULT NULL COMMENT 'Nome do curso para relacionamento',
  `carga_horaria` int(11) NOT NULL DEFAULT 0,
  `periodo` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `cor` varchar(255) NOT NULL DEFAULT 'blue' COMMENT 'blue, green, purple, orange, pink, emerald',
  `total_alunos` int(11) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `curso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `disciplinas_codigo_unique` (`codigo`),
  KEY `disciplinas_curso_id_foreign` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 4. TABELAS DE CICLOS E TRIMESTRES
-- =====================================================

-- Tabela de ciclos (anos letivos)
CREATE TABLE `ciclos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL COMMENT 'Ex: 2024, 2025',
  `descricao` varchar(255) DEFAULT NULL COMMENT 'Ex: Ano letivo de 2024',
  `data_inicio` date NOT NULL COMMENT 'Data de início do ano letivo',
  `data_fim` date NOT NULL COMMENT 'Data de fim do ano letivo',
  `ativo` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Se o ciclo está ativo',
  `observacoes` text DEFAULT NULL,
  `trimestre_ativo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ciclos_ano_unique` (`ano`),
  KEY `ciclos_trimestre_ativo_id_foreign` (`trimestre_ativo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de trimestres
CREATE TABLE `trimestres` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ciclo_id` bigint(20) UNSIGNED NOT NULL,
  `numero` int(11) NOT NULL COMMENT '1, 2, 3',
  `nome` varchar(255) NOT NULL COMMENT '1º Trimestre, 2º Trimestre, 3º Trimestre',
  `periodo` varchar(255) NOT NULL COMMENT 'Fevereiro a Abril, Maio a Julho, Agosto a Novembro',
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `observacoes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trimestres_ciclo_id_numero_unique` (`ciclo_id`,`numero`),
  KEY `trimestres_ciclo_id_foreign` (`ciclo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 5. TABELAS DE DADOS ACADÊMICOS
-- =====================================================

-- Tabela de notas
CREATE TABLE `notas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `aluno_id` bigint(20) UNSIGNED NOT NULL,
  `disciplina_id` bigint(20) UNSIGNED NOT NULL,
  `turma_id` bigint(20) UNSIGNED NOT NULL,
  `professor_id` bigint(20) UNSIGNED NOT NULL,
  `trimestre_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nota1` decimal(3,1) DEFAULT NULL,
  `nota2` decimal(3,1) DEFAULT NULL,
  `nota3` decimal(3,1) DEFAULT NULL,
  `media` decimal(3,1) DEFAULT NULL,
  `periodo` varchar(255) NOT NULL,
  `data_avaliacao` date NOT NULL,
  `tipo_avaliacao` varchar(255) NOT NULL,
  `peso` int(11) NOT NULL DEFAULT 1,
  `observacoes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notas_aluno_id_foreign` (`aluno_id`),
  KEY `notas_disciplina_id_foreign` (`disciplina_id`),
  KEY `notas_turma_id_foreign` (`turma_id`),
  KEY `notas_professor_id_foreign` (`professor_id`),
  KEY `notas_trimestre_id_foreign` (`trimestre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de frequências
CREATE TABLE `frequencias` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `aluno_id` bigint(20) UNSIGNED NOT NULL,
  `disciplina_id` bigint(20) UNSIGNED NOT NULL,
  `turma_id` bigint(20) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `presenca` tinyint(1) NOT NULL DEFAULT 1,
  `observacoes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `frequencias_aluno_id_foreign` (`aluno_id`),
  KEY `frequencias_disciplina_id_foreign` (`disciplina_id`),
  KEY `frequencias_turma_id_foreign` (`turma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de conselhos de classe
CREATE TABLE `conselho_classe` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `turma_id` bigint(20) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `status` enum('agendado','em_andamento','realizado','cancelado') NOT NULL DEFAULT 'agendado',
  `participantes` int(11) NOT NULL DEFAULT 0,
  `observacoes` text DEFAULT NULL,
  `ata` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conselho_classe_turma_id_foreign` (`turma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 6. TABELAS DE RELACIONAMENTO (PIVOT)
-- =====================================================

-- Tabela de relacionamento turma-disciplina
CREATE TABLE `turma_disciplina` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `turma_id` bigint(20) UNSIGNED NOT NULL,
  `disciplina_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `turma_disciplina_turma_id_disciplina_id_unique` (`turma_id`,`disciplina_id`),
  KEY `turma_disciplina_disciplina_id_foreign` (`disciplina_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de relacionamento professor-turma
CREATE TABLE `professor_turma` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `professor_id` bigint(20) UNSIGNED NOT NULL,
  `turma_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `professor_turma_professor_id_turma_id_unique` (`professor_id`,`turma_id`),
  KEY `professor_turma_turma_id_foreign` (`turma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de relacionamento professor-disciplina
CREATE TABLE `professor_disciplina` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `professor_id` bigint(20) UNSIGNED NOT NULL,
  `disciplina_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `professor_disciplina_professor_id_disciplina_id_unique` (`professor_id`,`disciplina_id`),
  KEY `professor_disciplina_disciplina_id_foreign` (`disciplina_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 7. TABELAS DE PERMISSÕES (OPCIONAL)
-- =====================================================

-- Tabela de roles
CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de permissões
CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de participantes de conselhos
CREATE TABLE `conselho_participantes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `conselho_id` bigint(20) UNSIGNED NOT NULL,
  `professor_id` bigint(20) UNSIGNED NOT NULL,
  `funcao` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conselho_participantes_conselho_id_foreign` (`conselho_id`),
  KEY `conselho_participantes_professor_id_foreign` (`professor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 8. CHAVES ESTRANGEIRAS (FOREIGN KEYS)
-- =====================================================

-- Foreign keys para turmas
ALTER TABLE `turmas`
  ADD CONSTRAINT `turmas_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE SET NULL;

-- Foreign keys para alunos
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `alunos_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE SET NULL;

-- Foreign keys para disciplinas
ALTER TABLE `disciplinas`
  ADD CONSTRAINT `disciplinas_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE SET NULL;

-- Foreign keys para ciclos e trimestres
ALTER TABLE `trimestres`
  ADD CONSTRAINT `trimestres_ciclo_id_foreign` FOREIGN KEY (`ciclo_id`) REFERENCES `ciclos` (`id`) ON DELETE CASCADE;

ALTER TABLE `ciclos`
  ADD CONSTRAINT `ciclos_trimestre_ativo_id_foreign` FOREIGN KEY (`trimestre_ativo_id`) REFERENCES `trimestres` (`id`) ON DELETE SET NULL;

-- Foreign keys para notas
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_aluno_id_foreign` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_disciplina_id_foreign` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_professor_id_foreign` FOREIGN KEY (`professor_id`) REFERENCES `professores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_trimestre_id_foreign` FOREIGN KEY (`trimestre_id`) REFERENCES `trimestres` (`id`) ON DELETE CASCADE;

-- Foreign keys para frequências
ALTER TABLE `frequencias`
  ADD CONSTRAINT `frequencias_aluno_id_foreign` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `frequencias_disciplina_id_foreign` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `frequencias_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`) ON DELETE CASCADE;

-- Foreign keys para conselhos
ALTER TABLE `conselho_classe`
  ADD CONSTRAINT `conselho_classe_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`) ON DELETE CASCADE;

-- Foreign keys para tabelas de relacionamento
ALTER TABLE `turma_disciplina`
  ADD CONSTRAINT `turma_disciplina_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `turma_disciplina_disciplina_id_foreign` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE;

ALTER TABLE `professor_turma`
  ADD CONSTRAINT `professor_turma_professor_id_foreign` FOREIGN KEY (`professor_id`) REFERENCES `professores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `professor_turma_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`) ON DELETE CASCADE;

ALTER TABLE `professor_disciplina`
  ADD CONSTRAINT `professor_disciplina_professor_id_foreign` FOREIGN KEY (`professor_id`) REFERENCES `professores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `professor_disciplina_disciplina_id_foreign` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE;

-- Foreign keys para participantes de conselhos
ALTER TABLE `conselho_participantes`
  ADD CONSTRAINT `conselho_participantes_conselho_id_foreign` FOREIGN KEY (`conselho_id`) REFERENCES `conselho_classe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conselho_participantes_professor_id_foreign` FOREIGN KEY (`professor_id`) REFERENCES `professores` (`id`) ON DELETE CASCADE;

-- =====================================================
-- 9. DADOS INICIAIS (SEEDERS)
-- =====================================================

-- Inserir usuário administrador padrão
INSERT INTO `users` (`name`, `email`, `password`, `role`, `active`, `created_at`, `updated_at`) VALUES
('Administrador', 'admin@conselhopronto.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1, NOW(), NOW());

-- Inserir roles básicas
INSERT INTO `roles` (`name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
('admin', 'Administrador', 'Acesso total ao sistema', NOW(), NOW()),
('coordenador', 'Coordenador', 'Acesso de coordenação pedagógica', NOW(), NOW()),
('conselheiro', 'Conselheiro', 'Acesso para conselhos de classe', NOW(), NOW()),
('professor', 'Professor', 'Acesso básico de professor', NOW(), NOW());

-- Inserir permissões básicas
INSERT INTO `permissions` (`name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
('view_dashboard', 'Visualizar Dashboard', 'Permissão para visualizar o dashboard', NOW(), NOW()),
('manage_alunos', 'Gerenciar Alunos', 'Permissão para gerenciar alunos', NOW(), NOW()),
('manage_professores', 'Gerenciar Professores', 'Permissão para gerenciar professores', NOW(), NOW()),
('manage_turmas', 'Gerenciar Turmas', 'Permissão para gerenciar turmas', NOW(), NOW()),
('manage_disciplinas', 'Gerenciar Disciplinas', 'Permissão para gerenciar disciplinas', NOW(), NOW()),
('manage_notas', 'Gerenciar Notas', 'Permissão para gerenciar notas', NOW(), NOW()),
('manage_conselhos', 'Gerenciar Conselhos', 'Permissão para gerenciar conselhos de classe', NOW(), NOW());

-- =====================================================
-- 10. FINALIZAÇÃO
-- =====================================================

COMMIT;

-- =====================================================
-- RESUMO DO BANCO DE DADOS CRIADO
-- =====================================================
-- 
-- TABELAS PRINCIPAIS:
-- - users: Usuários do sistema
-- - professores: Professores
-- - alunos: Alunos
-- - turmas: Turmas/Classes
-- - disciplinas: Disciplinas/Matérias
-- - cursos: Cursos oferecidos
-- - ciclos: Anos letivos
-- - trimestres: Trimestres dos anos letivos
-- - notas: Notas dos alunos
-- - frequencias: Controle de presença
-- - conselho_classe: Conselhos de classe
-- 
-- TABELAS DE RELACIONAMENTO:
-- - turma_disciplina: Relacionamento turma-disciplina
-- - professor_turma: Relacionamento professor-turma
-- - professor_disciplina: Relacionamento professor-disciplina
-- - conselho_participantes: Participantes dos conselhos
-- 
-- TABELAS DE SISTEMA:
-- - sessions: Sessões de usuário
-- - password_reset_tokens: Tokens de reset de senha
-- - cache: Cache do sistema
-- - jobs: Jobs em fila
-- - failed_jobs: Jobs que falharam
-- - roles: Papéis de usuário
-- - permissions: Permissões do sistema
-- 
-- =====================================================
