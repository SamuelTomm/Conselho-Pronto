# 🚀 Executar Dados Iniciais - Conselho Pronto

## 📋 Instruções para Executar o Seed

### 1. **Executar o Script SQL**
```bash
# Conectar ao MySQL e executar o script
mysql -u root -p conselho_pronto < database_seeders.sql
```

### 2. **Ou via Laravel Tinker (Recomendado)**
```bash
# No terminal do Laravel
php artisan tinker

# Executar o script
DB::unprepared(file_get_contents('database_seeders.sql'));
```

### 3. **Verificar se os dados foram inseridos**
```bash
# Verificar cursos
php artisan tinker
>>> App\Models\Curso::count()
>>> App\Models\Curso::all()

# Verificar turmas
>>> App\Models\Turma::count()
>>> App\Models\Turma::with('curso')->get()

# Verificar disciplinas
>>> App\Models\Disciplina::count()
>>> App\Models\Disciplina::with('curso')->get()

# Verificar professores
>>> App\Models\Professor::count()
>>> App\Models\Professor::all()

# Verificar alunos
>>> App\Models\Aluno::count()
>>> App\Models\Aluno::all()
```

## 🎯 Dados Criados

### **Cursos (4)**
- Ensino Médio Regular
- Ensino Médio Técnico em Informática  
- Ensino Médio Técnico em Mecânica
- Ensino Médio Itinerário Formação Técnica

### **Turmas (11)**
- **Ensino Médio Regular**: 1º A, 1º B, 2º A, 2º B, 3º A
- **Técnico Informática**: 1º TI, 2º TI, 3º TI
- **Técnico Mecânica**: 1º TM, 2º TM, 3º TM

### **Disciplinas (27)**
- **Ensino Médio Regular**: 13 disciplinas (Matemática, Português, História, etc.)
- **Técnico Informática**: 7 disciplinas (Programação, Web, Banco de Dados, etc.)
- **Técnico Mecânica**: 7 disciplinas (Mecânica, Desenho Técnico, Usinagem, etc.)

### **Professores (15)**
- **Coordenadores**: 4 (1 por curso + 1 duplicado)
- **Professores**: 11
- **Especialidades**: Múltiplas por professor
- **Atribuições**: Turmas e disciplinas específicas

### **Alunos (14)**
- **Ensino Médio Regular**: 6 alunos
- **Técnico Informática**: 4 alunos  
- **Técnico Mecânica**: 4 alunos

## 🔐 Login de Teste

### **Administrador**
- **Email**: admin@escola.com
- **Senha**: password
- **Role**: admin

### **Professores (Exemplos)**
- **Email**: maria.silva@escola.com
- **Senha**: password
- **Role**: coordenador

- **Email**: joao.santos@escola.com
- **Senha**: password
- **Role**: professor

## 🧪 Testando o Sistema

### **1. Testar Select de Curso**
1. Acesse: `/dashboard/professores/create`
2. Selecione um curso
3. Observe as turmas e disciplinas carregarem automaticamente
4. Teste a seleção múltipla com tags

### **2. Testar Filtros Dinâmicos**
1. Selecione uma turma → deve desaparecer da lista
2. Selecione uma disciplina → deve desaparecer da lista
3. Remova uma tag → deve reaparecer na lista
4. Troque de curso → deve limpar seleções e recarregar

### **3. Testar Especialidades**
1. Selecione especialidades do dropdown
2. Observe as tags aparecerem
3. Teste a remoção com o X
4. Verifique que não permite duplicatas

## 📊 Relacionamentos Criados

### **Turma-Disciplina**
- Cada turma tem suas disciplinas específicas
- Ensino Médio: 13 disciplinas por turma
- Técnico: 7-8 disciplinas por turma

### **Professor-Turma**
- Professores atribuídos a turmas específicas
- Coordenadores em múltiplas turmas
- Professores especialistas em turmas específicas

### **Professor-Disciplina**
- Professores especialistas em disciplinas
- Múltiplas especialidades por professor
- Relacionamento many-to-many

## 🎉 Próximos Passos

1. **Testar o formulário de criação** com os dados reais
2. **Verificar a listagem** de professores
3. **Testar a edição** de professores existentes
4. **Criar novos professores** usando o sistema
5. **Testar filtros** e busca na listagem

## ⚠️ Observações

- **Senhas**: Todas as senhas são `password` (hash: `$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi`)
- **Emails**: Todos os emails são fictícios para teste
- **Telefones**: Todos os telefones são fictícios
- **Relacionamentos**: Todos os relacionamentos estão configurados corretamente

## 🔧 Troubleshooting

### **Erro de Foreign Key**
```sql
-- Desabilitar verificação de foreign key temporariamente
SET FOREIGN_KEY_CHECKS = 0;
-- Executar o script
-- Reabilitar verificação
SET FOREIGN_KEY_CHECKS = 1;
```

### **Erro de Duplicate Key**
```sql
-- Limpar tabelas antes de inserir
TRUNCATE TABLE professor_disciplina;
TRUNCATE TABLE professor_turma;
TRUNCATE TABLE turma_disciplina;
TRUNCATE TABLE alunos;
TRUNCATE TABLE professores;
TRUNCATE TABLE disciplinas;
TRUNCATE TABLE turmas;
TRUNCATE TABLE cursos;
```

### **Verificar Logs**
```bash
# Verificar logs do Laravel
tail -f storage/logs/laravel.log

# Verificar logs do MySQL
tail -f /var/log/mysql/error.log
```
