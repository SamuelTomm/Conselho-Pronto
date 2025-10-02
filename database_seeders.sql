-- =====================================================
-- SCRIPT DE DADOS INICIAIS - CONSELHO PRONTO
-- Sistema de Gestão Educacional
-- =====================================================

-- =====================================================
-- 1. CURSOS
-- =====================================================

INSERT INTO `cursos` (`id`, `codigo`, `nome`, `descricao`, `tipo`, `cor`, `alunos_count`, `disciplinas_count`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'EM-001', 'Ensino Médio Regular', 'Curso de Ensino Médio Regular com disciplinas básicas', 'Básico', 'blue', 0, 0, 1, NOW(), NOW()),
(2, 'EM-002', 'Ensino Médio Técnico em Informática', 'Curso Técnico em Informática integrado ao Ensino Médio', 'Técnico', 'green', 0, 0, 1, NOW(), NOW()),
(3, 'EM-003', 'Ensino Médio Técnico em Mecânica', 'Curso Técnico em Mecânica integrado ao Ensino Médio', 'Técnico', 'orange', 0, 0, 1, NOW(), NOW()),
(4, 'EM-004', 'Ensino Médio Itinerário Formação Técnica', 'Itinerário de Formação Técnica e Profissional', 'Itinerário', 'purple', 0, 0, 1, NOW(), NOW());

-- =====================================================
-- 2. TURMAS
-- =====================================================

-- Turmas do Ensino Médio Regular
INSERT INTO `turmas` (`id`, `codigo`, `nome`, `nivel`, `ano`, `periodo`, `conselheiro`, `sala`, `descricao`, `cor`, `alunos_count`, `disciplinas_count`, `status`, `curso_id`, `created_at`, `updated_at`) VALUES
(1, '1A-2024', '1º Ano A', 'Ensino Médio', 2024, 'Matutino', 'Prof. Maria Silva', 'Sala 101', 'Turma do 1º Ano do Ensino Médio Regular', 'blue', 0, 0, 'Ativa', 1, NOW(), NOW()),
(2, '1B-2024', '1º Ano B', 'Ensino Médio', 2024, 'Matutino', 'Prof. João Santos', 'Sala 102', 'Turma do 1º Ano do Ensino Médio Regular', 'green', 0, 0, 'Ativa', 1, NOW(), NOW()),
(3, '2A-2024', '2º Ano A', 'Ensino Médio', 2024, 'Matutino', 'Prof. Ana Costa', 'Sala 201', 'Turma do 2º Ano do Ensino Médio Regular', 'purple', 0, 0, 'Ativa', 1, NOW(), NOW()),
(4, '2B-2024', '2º Ano B', 'Ensino Médio', 2024, 'Vespertino', 'Prof. Carlos Lima', 'Sala 202', 'Turma do 2º Ano do Ensino Médio Regular', 'orange', 0, 0, 'Ativa', 1, NOW(), NOW()),
(5, '3A-2024', '3º Ano A', 'Ensino Médio', 2024, 'Matutino', 'Prof. Lucia Oliveira', 'Sala 301', 'Turma do 3º Ano do Ensino Médio Regular', 'pink', 0, 0, 'Ativa', 1, NOW(), NOW());

-- Turmas do Técnico em Informática
INSERT INTO `turmas` (`id`, `codigo`, `nome`, `nivel`, `ano`, `periodo`, `conselheiro`, `sala`, `descricao`, `cor`, `alunos_count`, `disciplinas_count`, `status`, `curso_id`, `created_at`, `updated_at`) VALUES
(6, '1TI-2024', '1º Ano Técnico Informática', 'Técnico', 2024, 'Integral', 'Prof. Roberto Silva', 'Lab 101', 'Turma do 1º Ano do Técnico em Informática', 'green', 0, 0, 'Ativa', 2, NOW(), NOW()),
(7, '2TI-2024', '2º Ano Técnico Informática', 'Técnico', 2024, 'Integral', 'Prof. Patricia Alves', 'Lab 201', 'Turma do 2º Ano do Técnico em Informática', 'green', 0, 0, 'Ativa', 2, NOW(), NOW()),
(8, '3TI-2024', '3º Ano Técnico Informática', 'Técnico', 2024, 'Integral', 'Prof. Marcos Pereira', 'Lab 301', 'Turma do 3º Ano do Técnico em Informática', 'green', 0, 0, 'Ativa', 2, NOW(), NOW());

-- Turmas do Técnico em Mecânica
INSERT INTO `turmas` (`id`, `codigo`, `nome`, `nivel`, `ano`, `periodo`, `conselheiro`, `sala`, `descricao`, `cor`, `alunos_count`, `disciplinas_count`, `status`, `curso_id`, `created_at`, `updated_at`) VALUES
(9, '1TM-2024', '1º Ano Técnico Mecânica', 'Técnico', 2024, 'Noturno', 'Prof. Fernando Costa', 'Oficina 101', 'Turma do 1º Ano do Técnico em Mecânica', 'orange', 0, 0, 'Ativa', 3, NOW(), NOW()),
(10, '2TM-2024', '2º Ano Técnico Mecânica', 'Técnico', 2024, 'Noturno', 'Prof. Sandra Mendes', 'Oficina 201', 'Turma do 2º Ano do Técnico em Mecânica', 'orange', 0, 0, 'Ativa', 3, NOW(), NOW()),
(11, '3TM-2024', '3º Ano Técnico Mecânica', 'Técnico', 2024, 'Noturno', 'Prof. Antonio Rodrigues', 'Oficina 301', 'Turma do 3º Ano do Técnico em Mecânica', 'orange', 0, 0, 'Ativa', 3, NOW(), NOW());

-- =====================================================
-- 3. DISCIPLINAS
-- =====================================================

-- Disciplinas do Ensino Médio Regular
INSERT INTO `disciplinas` (`id`, `codigo`, `nome`, `curso_nome`, `carga_horaria`, `periodo`, `descricao`, `cor`, `total_alunos`, `ativo`, `curso_id`, `created_at`, `updated_at`) VALUES
(1, 'MAT-001', 'Matemática', 'Ensino Médio Regular', 120, 'Anual', 'Matemática do Ensino Médio', 'blue', 0, 1, 1, NOW(), NOW()),
(2, 'POR-001', 'Português', 'Ensino Médio Regular', 120, 'Anual', 'Língua Portuguesa do Ensino Médio', 'green', 0, 1, 1, NOW(), NOW()),
(3, 'HIS-001', 'História', 'Ensino Médio Regular', 80, 'Anual', 'História do Ensino Médio', 'purple', 0, 1, 1, NOW(), NOW()),
(4, 'GEO-001', 'Geografia', 'Ensino Médio Regular', 80, 'Anual', 'Geografia do Ensino Médio', 'orange', 0, 1, 1, NOW(), NOW()),
(5, 'FIS-001', 'Física', 'Ensino Médio Regular', 80, 'Anual', 'Física do Ensino Médio', 'pink', 0, 1, 1, NOW(), NOW()),
(6, 'QUI-001', 'Química', 'Ensino Médio Regular', 80, 'Anual', 'Química do Ensino Médio', 'emerald', 0, 1, 1, NOW(), NOW()),
(7, 'BIO-001', 'Biologia', 'Ensino Médio Regular', 80, 'Anual', 'Biologia do Ensino Médio', 'green', 0, 1, 1, NOW(), NOW()),
(8, 'EDF-001', 'Educação Física', 'Ensino Médio Regular', 40, 'Anual', 'Educação Física do Ensino Médio', 'blue', 0, 1, 1, NOW(), NOW()),
(9, 'ART-001', 'Arte', 'Ensino Médio Regular', 40, 'Anual', 'Arte do Ensino Médio', 'purple', 0, 1, 1, NOW(), NOW()),
(10, 'FIL-001', 'Filosofia', 'Ensino Médio Regular', 40, 'Anual', 'Filosofia do Ensino Médio', 'orange', 0, 1, 1, NOW(), NOW()),
(11, 'SOC-001', 'Sociologia', 'Ensino Médio Regular', 40, 'Anual', 'Sociologia do Ensino Médio', 'pink', 0, 1, 1, NOW(), NOW()),
(12, 'ING-001', 'Inglês', 'Ensino Médio Regular', 40, 'Anual', 'Língua Inglesa do Ensino Médio', 'emerald', 0, 1, 1, NOW(), NOW()),
(13, 'ESP-001', 'Espanhol', 'Ensino Médio Regular', 40, 'Anual', 'Língua Espanhola do Ensino Médio', 'green', 0, 1, 1, NOW(), NOW());

-- Disciplinas do Técnico em Informática
INSERT INTO `disciplinas` (`id`, `codigo`, `nome`, `curso_nome`, `carga_horaria`, `periodo`, `descricao`, `cor`, `total_alunos`, `ativo`, `curso_id`, `created_at`, `updated_at`) VALUES
(14, 'INF-001', 'Informática Básica', 'Ensino Médio Técnico em Informática', 80, 'Anual', 'Fundamentos de Informática', 'blue', 0, 1, 2, NOW(), NOW()),
(15, 'PRO-001', 'Programação I', 'Ensino Médio Técnico em Informática', 120, 'Anual', 'Lógica de Programação', 'green', 0, 1, 2, NOW(), NOW()),
(16, 'PRO-002', 'Programação II', 'Ensino Médio Técnico em Informática', 120, 'Anual', 'Programação Orientada a Objetos', 'purple', 0, 1, 2, NOW(), NOW()),
(17, 'WEB-001', 'Desenvolvimento Web', 'Ensino Médio Técnico em Informática', 100, 'Anual', 'Desenvolvimento de Aplicações Web', 'orange', 0, 1, 2, NOW(), NOW()),
(18, 'BAN-001', 'Banco de Dados', 'Ensino Médio Técnico em Informática', 80, 'Anual', 'Fundamentos de Banco de Dados', 'pink', 0, 1, 2, NOW(), NOW()),
(19, 'RED-001', 'Redes de Computadores', 'Ensino Médio Técnico em Informática', 80, 'Anual', 'Fundamentos de Redes', 'emerald', 0, 1, 2, NOW(), NOW()),
(20, 'SIS-001', 'Sistemas Operacionais', 'Ensino Médio Técnico em Informática', 60, 'Anual', 'Fundamentos de Sistemas Operacionais', 'blue', 0, 1, 2, NOW(), NOW());

-- Disciplinas do Técnico em Mecânica
INSERT INTO `disciplinas` (`id`, `codigo`, `nome`, `curso_nome`, `carga_horaria`, `periodo`, `descricao`, `cor`, `total_alunos`, `ativo`, `curso_id`, `created_at`, `updated_at`) VALUES
(21, 'MEC-001', 'Mecânica Básica', 'Ensino Médio Técnico em Mecânica', 100, 'Anual', 'Fundamentos de Mecânica', 'orange', 0, 1, 3, NOW(), NOW()),
(22, 'DES-001', 'Desenho Técnico', 'Ensino Médio Técnico em Mecânica', 80, 'Anual', 'Desenho Técnico Mecânico', 'blue', 0, 1, 3, NOW(), NOW()),
(23, 'MAT-002', 'Matemática Aplicada', 'Ensino Médio Técnico em Mecânica', 100, 'Anual', 'Matemática Aplicada à Mecânica', 'green', 0, 1, 3, NOW(), NOW()),
(24, 'FIS-002', 'Física Aplicada', 'Ensino Médio Técnico em Mecânica', 80, 'Anual', 'Física Aplicada à Mecânica', 'purple', 0, 1, 3, NOW(), NOW()),
(25, 'MET-001', 'Metrologia', 'Ensino Médio Técnico em Mecânica', 60, 'Anual', 'Fundamentos de Metrologia', 'pink', 0, 1, 3, NOW(), NOW()),
(26, 'USI-001', 'Usinagem', 'Ensino Médio Técnico em Mecânica', 120, 'Anual', 'Técnicas de Usinagem', 'emerald', 0, 1, 3, NOW(), NOW()),
(27, 'MAN-001', 'Manutenção Industrial', 'Ensino Médio Técnico em Mecânica', 80, 'Anual', 'Fundamentos de Manutenção', 'orange', 0, 1, 3, NOW(), NOW());

-- =====================================================
-- 4. PROFESSORES
-- =====================================================

-- Professores do Ensino Médio Regular
INSERT INTO `professores` (`id`, `name`, `email`, `password`, `role`, `especialidade`, `telefone`, `data_admissao`, `turmas_ids`, `disciplinas_ids`, `observacoes`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'Maria Silva Santos', 'maria.silva@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'coordenador', 'Matemática, Física', '(11) 99999-0001', '2020-01-15', '[1, 2]', '[1, 5]', 'Coordenadora de Matemática e Física', 1, NOW(), NOW()),
(2, 'João Santos Oliveira', 'joao.santos@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Português, Literatura', '(11) 99999-0002', '2020-02-01', '[1, 3]', '[2]', 'Professor de Português com especialização em Literatura', 1, NOW(), NOW()),
(3, 'Ana Costa Lima', 'ana.costa@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'História, Geografia', '(11) 99999-0003', '2020-03-01', '[3, 4]', '[3, 4]', 'Professora de Humanas', 1, NOW(), NOW()),
(4, 'Carlos Lima Pereira', 'carlos.lima@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Química, Biologia', '(11) 99999-0004', '2020-04-01', '[2, 4]', '[6, 7]', 'Professor de Ciências da Natureza', 1, NOW(), NOW()),
(5, 'Lucia Oliveira Mendes', 'lucia.oliveira@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Educação Física', '(11) 99999-0005', '2020-05-01', '[1, 2, 3, 4, 5]', '[8]', 'Professora de Educação Física', 1, NOW(), NOW()),
(6, 'Roberto Silva Alves', 'roberto.silva@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Arte, Filosofia', '(11) 99999-0006', '2020-06-01', '[5]', '[9, 10]', 'Professor de Arte e Filosofia', 1, NOW(), NOW()),
(7, 'Patricia Alves Costa', 'patricia.alves@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Sociologia, Inglês', '(11) 99999-0007', '2020-07-01', '[5]', '[11, 12]', 'Professora de Sociologia e Inglês', 1, NOW(), NOW()),
(8, 'Marcos Pereira Rodrigues', 'marcos.pereira@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Espanhol', '(11) 99999-0008', '2020-08-01', '[1, 2, 3, 4, 5]', '[13]', 'Professor de Espanhol', 1, NOW(), NOW());

-- Professores do Técnico em Informática
INSERT INTO `professores` (`id`, `name`, `email`, `password`, `role`, `especialidade`, `telefone`, `data_admissao`, `turmas_ids`, `disciplinas_ids`, `observacoes`, `ativo`, `created_at`, `updated_at`) VALUES
(9, 'Fernando Costa Silva', 'fernando.costa@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'coordenador', 'Informática, Programação', '(11) 99999-0009', '2020-09-01', '[6, 7, 8]', '[14, 15, 16]', 'Coordenador do Curso Técnico em Informática', 1, NOW(), NOW()),
(10, 'Sandra Mendes Alves', 'sandra.mendes@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Desenvolvimento Web, Banco de Dados', '(11) 99999-0010', '2020-10-01', '[6, 7]', '[17, 18]', 'Professora de Desenvolvimento Web', 1, NOW(), NOW()),
(11, 'Antonio Rodrigues Lima', 'antonio.rodrigues@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Redes, Sistemas Operacionais', '(11) 99999-0011', '2020-11-01', '[7, 8]', '[19, 20]', 'Professor de Redes e Sistemas', 1, NOW(), NOW());

-- Professores do Técnico em Mecânica
INSERT INTO `professores` (`id`, `name`, `email`, `password`, `role`, `especialidade`, `telefone`, `data_admissao`, `turmas_ids`, `disciplinas_ids`, `observacoes`, `ativo`, `created_at`, `updated_at`) VALUES
(12, 'Fernando Costa Silva', 'fernando.costa.mec@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'coordenador', 'Mecânica, Desenho Técnico', '(11) 99999-0012', '2020-12-01', '[9, 10, 11]', '[21, 22]', 'Coordenador do Curso Técnico em Mecânica', 1, NOW(), NOW()),
(13, 'Sandra Mendes Alves', 'sandra.mendes.mec@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Matemática Aplicada, Física Aplicada', '(11) 99999-0013', '2021-01-01', '[9, 10]', '[23, 24]', 'Professora de Matemática e Física Aplicada', 1, NOW(), NOW()),
(14, 'Antonio Rodrigues Lima', 'antonio.rodrigues.mec@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Metrologia, Usinagem', '(11) 99999-0014', '2021-02-01', '[10, 11]', '[25, 26]', 'Professor de Metrologia e Usinagem', 1, NOW(), NOW()),
(15, 'Patricia Alves Costa', 'patricia.alves.mec@escola.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Manutenção Industrial', '(11) 99999-0015', '2021-03-01', '[11]', '[27]', 'Professora de Manutenção Industrial', 1, NOW(), NOW());

-- =====================================================
-- 5. ADMINISTRADOR DO SISTEMA
-- =====================================================

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `turmas_ids`, `disciplinas_ids`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador Sistema', 'admin@escola.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, NULL, 1, NULL, NOW(), NOW());

-- =====================================================
-- 6. ATUALIZAR CONTADORES
-- =====================================================

-- Atualizar contadores de cursos
UPDATE `cursos` SET 
    `alunos_count` = (SELECT COUNT(*) FROM `turmas` WHERE `curso_id` = `cursos`.`id`),
    `disciplinas_count` = (SELECT COUNT(*) FROM `disciplinas` WHERE `curso_id` = `cursos`.`id`)
WHERE `id` IN (1, 2, 3, 4);

-- Atualizar contadores de turmas
UPDATE `turmas` SET 
    `alunos_count` = 0,
    `disciplinas_count` = (SELECT COUNT(*) FROM `disciplinas` WHERE `curso_id` = `turmas`.`curso_id`)
WHERE `id` IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);

-- Atualizar contadores de disciplinas
UPDATE `disciplinas` SET 
    `total_alunos` = 0
WHERE `id` IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27);

-- =====================================================
-- 7. RELACIONAMENTOS TURMA-DISCIPLINA
-- =====================================================

-- Relacionamentos para Ensino Médio Regular
INSERT INTO `turma_disciplina` (`turma_id`, `disciplina_id`) VALUES
-- 1º Ano A
(1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (1, 7), (1, 8), (1, 9), (1, 10), (1, 11), (1, 12), (1, 13),
-- 1º Ano B
(2, 1), (2, 2), (2, 3), (2, 4), (2, 5), (2, 6), (2, 7), (2, 8), (2, 9), (2, 10), (2, 11), (2, 12), (2, 13),
-- 2º Ano A
(3, 1), (3, 2), (3, 3), (3, 4), (3, 5), (3, 6), (3, 7), (3, 8), (3, 9), (3, 10), (3, 11), (3, 12), (3, 13),
-- 2º Ano B
(4, 1), (4, 2), (4, 3), (4, 4), (4, 5), (4, 6), (4, 7), (4, 8), (4, 9), (4, 10), (4, 11), (4, 12), (4, 13),
-- 3º Ano A
(5, 1), (5, 2), (5, 3), (5, 4), (5, 5), (5, 6), (5, 7), (5, 8), (5, 9), (5, 10), (5, 11), (5, 12), (5, 13);

-- Relacionamentos para Técnico em Informática
INSERT INTO `turma_disciplina` (`turma_id`, `disciplina_id`) VALUES
-- 1º Ano Técnico Informática
(6, 1), (6, 2), (6, 3), (6, 4), (6, 5), (6, 6), (6, 7), (6, 8), (6, 9), (6, 10), (6, 11), (6, 12), (6, 13), (6, 14), (6, 15),
-- 2º Ano Técnico Informática
(7, 1), (7, 2), (7, 3), (7, 4), (7, 5), (7, 6), (7, 7), (7, 8), (7, 9), (7, 10), (7, 11), (7, 12), (7, 13), (7, 15), (7, 16), (7, 17), (7, 18),
-- 3º Ano Técnico Informática
(8, 1), (8, 2), (8, 3), (8, 4), (8, 5), (8, 6), (8, 7), (8, 8), (8, 9), (8, 10), (8, 11), (8, 12), (8, 13), (8, 16), (8, 17), (8, 18), (8, 19), (8, 20);

-- Relacionamentos para Técnico em Mecânica
INSERT INTO `turma_disciplina` (`turma_id`, `disciplina_id`) VALUES
-- 1º Ano Técnico Mecânica
(9, 1), (9, 2), (9, 3), (9, 4), (9, 5), (9, 6), (9, 7), (9, 8), (9, 9), (9, 10), (9, 11), (9, 12), (9, 13), (9, 21), (9, 22), (9, 23), (9, 24),
-- 2º Ano Técnico Mecânica
(10, 1), (10, 2), (10, 3), (10, 4), (10, 5), (10, 6), (10, 7), (10, 8), (10, 9), (10, 10), (10, 11), (10, 12), (10, 13), (10, 22), (10, 23), (10, 24), (10, 25), (10, 26),
-- 3º Ano Técnico Mecânica
(11, 1), (11, 2), (11, 3), (11, 4), (11, 5), (11, 6), (11, 7), (11, 8), (11, 9), (11, 10), (11, 11), (11, 12), (11, 13), (11, 25), (11, 26), (11, 27);

-- =====================================================
-- 8. RELACIONAMENTOS PROFESSOR-TURMA
-- =====================================================

-- Professores do Ensino Médio Regular
INSERT INTO `professor_turma` (`professor_id`, `turma_id`) VALUES
(1, 1), (1, 2), -- Maria Silva (Matemática/Física)
(2, 1), (2, 3), -- João Santos (Português)
(3, 3), (3, 4), -- Ana Costa (História/Geografia)
(4, 2), (4, 4), -- Carlos Lima (Química/Biologia)
(5, 1), (5, 2), (5, 3), (5, 4), (5, 5), -- Lucia Oliveira (Educação Física)
(6, 5), -- Roberto Silva (Arte/Filosofia)
(7, 5), -- Patricia Alves (Sociologia/Inglês)
(8, 1), (8, 2), (8, 3), (8, 4), (8, 5); -- Marcos Pereira (Espanhol)

-- Professores do Técnico em Informática
INSERT INTO `professor_turma` (`professor_id`, `turma_id`) VALUES
(9, 6), (9, 7), (9, 8), -- Fernando Costa (Coordenador Informática)
(10, 6), (10, 7), -- Sandra Mendes (Desenvolvimento Web)
(11, 7), (11, 8); -- Antonio Rodrigues (Redes/Sistemas)

-- Professores do Técnico em Mecânica
INSERT INTO `professor_turma` (`professor_id`, `turma_id`) VALUES
(12, 9), (12, 10), (12, 11), -- Fernando Costa (Coordenador Mecânica)
(13, 9), (13, 10), -- Sandra Mendes (Matemática/Física Aplicada)
(14, 10), (14, 11), -- Antonio Rodrigues (Metrologia/Usinagem)
(15, 11); -- Patricia Alves (Manutenção Industrial)

-- =====================================================
-- 9. RELACIONAMENTOS PROFESSOR-DISCIPLINA
-- =====================================================

-- Professores do Ensino Médio Regular
INSERT INTO `professor_disciplina` (`professor_id`, `disciplina_id`) VALUES
(1, 1), (1, 5), -- Maria Silva (Matemática/Física)
(2, 2), -- João Santos (Português)
(3, 3), (3, 4), -- Ana Costa (História/Geografia)
(4, 6), (4, 7), -- Carlos Lima (Química/Biologia)
(5, 8), -- Lucia Oliveira (Educação Física)
(6, 9), (6, 10), -- Roberto Silva (Arte/Filosofia)
(7, 11), (7, 12), -- Patricia Alves (Sociologia/Inglês)
(8, 13); -- Marcos Pereira (Espanhol)

-- Professores do Técnico em Informática
INSERT INTO `professor_disciplina` (`professor_id`, `disciplina_id`) VALUES
(9, 14), (9, 15), (9, 16), -- Fernando Costa (Informática/Programação)
(10, 17), (10, 18), -- Sandra Mendes (Desenvolvimento Web/Banco de Dados)
(11, 19), (11, 20); -- Antonio Rodrigues (Redes/Sistemas Operacionais)

-- Professores do Técnico em Mecânica
INSERT INTO `professor_disciplina` (`professor_id`, `disciplina_id`) VALUES
(12, 21), (12, 22), -- Fernando Costa (Mecânica/Desenho Técnico)
(13, 23), (13, 24), -- Sandra Mendes (Matemática/Física Aplicada)
(14, 25), (14, 26), -- Antonio Rodrigues (Metrologia/Usinagem)
(15, 27); -- Patricia Alves (Manutenção Industrial)

-- =====================================================
-- 10. DADOS DE EXEMPLO PARA TESTE
-- =====================================================

-- Inserir alguns alunos de exemplo
INSERT INTO `alunos` (`id`, `matricula`, `nome`, `email`, `telefone`, `data_nascimento`, `turma_nome`, `status`, `observacoes`, `created_at`, `updated_at`) VALUES
(1, '2024001', 'João Silva Santos', 'joao.silva@aluno.com', '(11) 99999-1001', '2008-03-15', '1º Ano A', 'Ativo', 'Aluno dedicado', NOW(), NOW()),
(2, '2024002', 'Maria Oliveira Costa', 'maria.oliveira@aluno.com', '(11) 99999-1002', '2008-07-22', '1º Ano A', 'Ativo', 'Boa aluna', NOW(), NOW()),
(3, '2024003', 'Pedro Alves Lima', 'pedro.alves@aluno.com', '(11) 99999-1003', '2008-11-10', '1º Ano B', 'Ativo', 'Interessado em exatas', NOW(), NOW()),
(4, '2024004', 'Ana Costa Mendes', 'ana.costa@aluno.com', '(11) 99999-1004', '2007-05-18', '2º Ano A', 'Ativo', 'Líder de turma', NOW(), NOW()),
(5, '2024005', 'Carlos Lima Pereira', 'carlos.lima@aluno.com', '(11) 99999-1005', '2007-09-30', '2º Ano B', 'Ativo', 'Bom em humanas', NOW(), NOW()),
(6, '2024006', 'Lucia Santos Rodrigues', 'lucia.santos@aluno.com', '(11) 99999-1006', '2006-12-05', '3º Ano A', 'Ativo', 'Preparando para vestibular', NOW(), NOW()),
(7, '2024007', 'Roberto Alves Silva', 'roberto.alves@aluno.com', '(11) 99999-1007', '2008-01-20', '1º Ano Técnico Informática', 'Ativo', 'Interessado em programação', NOW(), NOW()),
(8, '2024008', 'Patricia Costa Lima', 'patricia.costa@aluno.com', '(11) 99999-1008', '2008-04-12', '1º Ano Técnico Informática', 'Ativo', 'Boa em lógica', NOW(), NOW()),
(9, '2024009', 'Marcos Pereira Alves', 'marcos.pereira@aluno.com', '(11) 99999-1009', '2007-08-25', '2º Ano Técnico Informática', 'Ativo', 'Focado em desenvolvimento web', NOW(), NOW()),
(10, '2024010', 'Fernanda Silva Costa', 'fernanda.silva@aluno.com', '(11) 99999-1010', '2007-10-15', '3º Ano Técnico Informática', 'Ativo', 'Preparando para estágio', NOW(), NOW()),
(11, '2024011', 'Antonio Lima Santos', 'antonio.lima@aluno.com', '(11) 99999-1011', '2008-02-28', '1º Ano Técnico Mecânica', 'Ativo', 'Interessado em mecânica', NOW(), NOW()),
(12, '2024012', 'Sandra Alves Pereira', 'sandra.alves@aluno.com', '(11) 99999-1012', '2008-06-14', '1º Ano Técnico Mecânica', 'Ativo', 'Boa em matemática', NOW(), NOW()),
(13, '2024013', 'Fernando Costa Silva', 'fernando.costa@aluno.com', '(11) 99999-1013', '2007-11-08', '2º Ano Técnico Mecânica', 'Ativo', 'Focado em usinagem', NOW(), NOW()),
(14, '2024014', 'Patricia Mendes Lima', 'patricia.mendes@aluno.com', '(11) 99999-1014', '2007-03-22', '3º Ano Técnico Mecânica', 'Ativo', 'Preparando para estágio', NOW(), NOW());

-- =====================================================
-- FIM DO SCRIPT DE DADOS INICIAIS
-- =====================================================
