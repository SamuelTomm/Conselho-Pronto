# 🎓 Conselho Pronto - Sistema de Login

Sistema de autenticação moderno e responsivo para o Instituto Ivoti, desenvolvido em Laravel com Tailwind CSS.

## 🚀 Funcionalidades Implementadas

### ✅ Design e Layout
- **Layout Responsivo**: Dividido em duas seções (50% cada)
- **Seção Esquerda**: Fundo com gradiente azul/slate + branding do IEI
- **Seção Direita**: Formulário de login em card branco com sombra
- **Elementos Decorativos**: Círculos flutuantes com animações
- **Logo Personalizado**: Logo SVG do Instituto Ivoti

### ✅ Sistema de Autenticação
- **3 Tipos de Usuário**:
  - **Admin**: `admin@ivoti.edu.br` / `123456` → `/dashboard`
  - **Professor**: `professor@ivoti.edu.br` / `123456` → `/dashboard/professor-turmas`
  - **Coordenador**: `coordenador@ivoti.edu.br` / `123456` → `/dashboard/conselho-classe`

### ✅ Validações e Segurança
- Validação de email obrigatório e formato válido
- Validação de senha obrigatória (mínimo 6 caracteres)
- Mensagens de erro para credenciais inválidas
- Validação de email institucional (@ivoti.edu.br)
- Middleware de autenticação por sessão

### ✅ Interface Moderna
- **Cores Principais**: Azul (#2563eb) e Slate (#475569)
- **Gradientes**: from-blue-600 to-slate-600
- **Animações**: Loading states, hover effects, floating elements
- **Responsividade**: Mobile-first design
- **Acessibilidade**: Focus states, contraste adequado

### ✅ Páginas Implementadas
1. **Login** (`/`) - Tela principal de autenticação
2. **Esqueci Senha** (`/forgot-password`) - Recuperação de senha
3. **Dashboards** - Páginas específicas para cada tipo de usuário

## 🛠️ Estrutura de Arquivos

```
resources/views/auth/
├── login.blade.php              # Tela de login principal
└── forgot-password.blade.php    # Tela de recuperação de senha

resources/views/dashboard/
├── admin.blade.php              # Dashboard administrativo
├── professor.blade.php          # Dashboard do professor
└── coordenador.blade.php        # Dashboard do coordenador

app/Http/Controllers/Auth/
└── LoginController.php          # Controller de autenticação

app/Http/Middleware/
└── AuthSessionMiddleware.php    # Middleware de sessão

public/images/
└── Logo_IEI.jpg                 # Logo do Instituto Ivoti

resources/css/
└── auth.css                     # Estilos personalizados
```

## 🎨 Recursos Visuais

### Seção Esquerda (Branding)
- Logo do IEI centralizado
- Título "Conselho Pronto" em fonte bold
- Descrição do sistema
- 3 ícones com descrições:
  - 📚 Gestão de Disciplinas
  - 👥 Controle de Turmas
  - 📊 Acompanhamento
- Elementos decorativos flutuantes

### Seção Direita (Formulário)
- Card com sombra e bordas arredondadas
- Título "Acesse sua Conta"
- Box com credenciais de teste
- Formulário com validação em tempo real
- Link "Esqueceu sua senha?"
- Botão de login com loading state
- Botão "Criar Nova Conta"
- Links para Termos de Uso e Política de Privacidade

## 🔧 Como Usar

### 1. Instalação
```bash
cd /home/fritz/laravel/Conselho-Pronto
composer install
npm install
```

### 2. Executar o Servidor
```bash
php artisan serve
```

### 3. Acessar o Sistema
- Abra o navegador em `http://localhost:8000`
- Use as credenciais de teste fornecidas
- Teste os diferentes tipos de usuário

### 4. Credenciais de Teste
```
Admin: admin@ivoti.edu.br / 123456
Professor: professor@ivoti.edu.br / 123456
Coordenador: coordenador@ivoti.edu.br / 123456
```

## 📱 Responsividade

- **Desktop**: Layout lado a lado (50% + 50%)
- **Tablet**: Layout adaptado com ajustes de espaçamento
- **Mobile**: Layout empilhado verticalmente

## 🎯 Funcionalidades Especiais

- **Loading States**: Spinner personalizado durante autenticação
- **Validação em Tempo Real**: Feedback visual nos campos
- **Animações Suaves**: Transições e efeitos hover
- **Mensagens de Feedback**: Alertas claros para sucesso/erro
- **Design Profissional**: Interface moderna e limpa

## 🔒 Segurança

- Validação de email institucional obrigatória
- Middleware de autenticação por sessão
- Proteção CSRF em todos os formulários
- Validação de dados no servidor e cliente

## 🚀 Próximos Passos

1. Integrar com banco de dados real
2. Implementar sistema de recuperação de senha por email
3. Adicionar funcionalidades específicas de cada dashboard
4. Implementar sistema de permissões mais robusto
5. Adicionar testes automatizados

---

**Desenvolvido com ❤️ para o Instituto Ivoti**

