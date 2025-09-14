# 🐳 Docker, Git & WSL2 - Guia de Comandos

Este guia contém os comandos essenciais para trabalhar com Git, Docker, Laravel Sail e WSL2 no seu projeto **Conselho-Pronto**.

## 📋 Índice
- [Git - Comandos Essenciais](#git---comandos-essenciais)
- [Laravel Sail - Comandos Básicos](#laravel-sail---comandos-básicos)
- [Docker - Comandos Essenciais](#docker---comandos-essenciais)
- [WSL2 - Comandos Úteis](#wsl2---comandos-úteis)
- [Troubleshooting](#troubleshooting)
- [Dicas Importantes](#dicas-importantes)

---

## 🔧 Git - Comandos Essenciais

### Configuração Inicial

```bash
# Configurar usuário e email
git config --global user.name "Seu Nome"
git config --global user.email "seu.email@exemplo.com"

# Verificar configurações
git config --list
git config user.name
git config user.email

# Configurar editor padrão
git config --global core.editor "code --wait"  # VS Code
git config --global core.editor "nano"         # Nano
```

### Comandos Básicos

```bash
# Inicializar repositório
git init

# Verificar status
git status

# Adicionar arquivos
git add .                    # Adicionar todos os arquivos
git add arquivo.php          # Adicionar arquivo específico
git add src/                 # Adicionar pasta específica
git add -A                   # Adicionar todos (incluindo removidos)

# Fazer commit
git commit -m "Mensagem do commit"
git commit -am "Mensagem"    # Adicionar e commitar em uma linha

# Ver histórico
git log
git log --oneline           # Histórico resumido
git log --graph             # Histórico com gráfico
git log --oneline --graph   # Combinado

# Ver diferenças
git diff                    # Diferenças não commitadas
git diff --staged           # Diferenças no stage
git diff HEAD~1             # Diferenças com commit anterior
```

### Branches (Ramificações)

```bash
# Listar branches
git branch                  # Branches locais
git branch -a              # Todas as branches (local + remoto)
git branch -r              # Apenas branches remotas

# Criar e trocar de branch
git checkout -b nova-branch
git switch -c nova-branch   # Comando mais moderno

# Trocar de branch
git checkout master
git switch master           # Comando mais moderno

# Deletar branch
git branch -d nome-branch   # Deletar branch local
git branch -D nome-branch   # Forçar deleção
git push origin --delete nome-branch  # Deletar branch remota

# Renomear branch atual
git branch -m novo-nome
```

### Repositório Remoto

```bash
# Adicionar repositório remoto
git remote add origin https://github.com/usuario/repositorio.git

# Ver repositórios remotos
git remote -v

# Fazer push
git push origin master
git push -u origin master   # Definir upstream na primeira vez
git push origin nome-branch # Push de branch específica

# Fazer pull
git pull origin master
git pull                    # Pull do branch atual

# Fazer fetch (baixar sem mesclar)
git fetch origin
git fetch --all            # Baixar de todos os remotos

# Clonar repositório
git clone https://github.com/usuario/repositorio.git
git clone -b nome-branch https://github.com/usuario/repositorio.git
```

### Merge e Rebase

```bash
# Fazer merge
git merge nome-branch       # Merge de branch para atual
git merge --no-ff nome-branch  # Merge sem fast-forward

# Fazer rebase
git rebase master           # Rebase atual branch com master
git rebase -i HEAD~3        # Rebase interativo dos últimos 3 commits

# Resolver conflitos
git status                  # Ver arquivos com conflito
# Editar arquivos com conflito
git add arquivo-resolvido.php
git commit                  # Finalizar merge/rebase
```

### Stash (Guardar temporariamente)

```bash
# Guardar mudanças temporariamente
git stash
git stash push -m "Mensagem do stash"

# Ver stashes
git stash list

# Aplicar stash
git stash apply             # Aplicar sem remover do stash
git stash pop              # Aplicar e remover do stash
git stash apply stash@{0}  # Aplicar stash específico

# Deletar stash
git stash drop             # Deletar último stash
git stash drop stash@{0}   # Deletar stash específico
git stash clear            # Deletar todos os stashes
```

### Desfazer Mudanças

```bash
# Desfazer mudanças não commitadas
git checkout -- arquivo.php
git restore arquivo.php     # Comando mais moderno

# Desfazer stage (unstage)
git reset HEAD arquivo.php
git restore --staged arquivo.php  # Comando mais moderno

# Desfazer último commit (mantendo mudanças)
git reset --soft HEAD~1

# Desfazer último commit (removendo mudanças)
git reset --hard HEAD~1

# Desfazer para commit específico
git reset --hard abc1234

# Reverter commit (criar novo commit que desfaz)
git revert abc1234
```

### Comandos Avançados

```bash
# Ver quem fez o quê
git blame arquivo.php

# Buscar no histórico
git log --grep="palavra-chave"
git log -S "código"         # Buscar por mudanças no código

# Ver arquivos de um commit
git show --name-only abc1234

# Ver mudanças de um commit
git show abc1234

# Limpar arquivos não rastreados
git clean -f                # Remover arquivos
git clean -fd               # Remover arquivos e diretórios
git clean -n                # Simular (dry run)

# Reflog (histórico de comandos)
git reflog
git reset --hard HEAD@{2}   # Voltar para estado específico
```

### Comandos para o Projeto Laravel

```bash
# Workflow típico de desenvolvimento
git checkout -b feature/nova-funcionalidade
# Fazer mudanças...
git add .
git commit -m "feat: adiciona nova funcionalidade"
git push origin feature/nova-funcionalidade

# Merge para master
git checkout master
git pull origin master
git merge feature/nova-funcionalidade
git push origin master

# Deletar branch local após merge
git branch -d feature/nova-funcionalidade
```

### Aliases Úteis para Git

Adicione ao seu `~/.gitconfig`:

```bash
[alias]
    st = status
    co = checkout
    br = branch
    ci = commit
    unstage = reset HEAD --
    last = log -1 HEAD
    visual = !gitk
    lg = log --oneline --graph --decorate --all
    undo = reset HEAD~1
    amend = commit --amend
    wip = commit -am "WIP"
    unwip = reset HEAD~1
```

### Comandos de Limpeza

```bash
# Limpar branches locais que foram deletadas no remoto
git remote prune origin

# Limpar referências órfãs
git gc --prune=now

# Ver tamanho do repositório
git count-objects -vH
```

---

## 🚀 Laravel Sail - Comandos Básicos

### Iniciar e Parar Serviços

```bash
# Iniciar todos os containers (modo interativo)
./vendor/bin/sail up

# Iniciar em background (detached mode)
./vendor/bin/sail up -d

# Parar todos os containers
./vendor/bin/sail down

# Parar e remover volumes (CUIDADO: apaga dados do banco)
./vendor/bin/sail down -v

# Reiniciar containers
./vendor/bin/sail restart

# Parar containers específicos
./vendor/bin/sail stop

# Iniciar containers parados
./vendor/bin/sail start
```

### Comandos de Desenvolvimento

```bash
# Executar comandos Artisan
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan tinker
./vendor/bin/sail artisan queue:work

# Instalar dependências
./vendor/bin/sail composer install
./vendor/bin/sail composer update

# Executar testes
./vendor/bin/sail test
./vendor/bin/sail test --filter=FeatureTest

# Acessar shell do container
./vendor/bin/sail shell

# Executar comandos específicos no container
./vendor/bin/sail exec laravel.test php artisan migrate
./vendor/bin/sail exec mysql mysql -u sail -p
```

### Comandos de Build e Rebuild

```bash
# Rebuild containers (quando Dockerfile mudou)
./vendor/bin/sail build

# Rebuild sem cache
./vendor/bin/sail build --no-cache

# Rebuild e iniciar
./vendor/bin/sail up --build
```

---

## 🐳 Docker - Comandos Essenciais

### Gerenciamento de Containers

```bash
# Listar containers rodando
docker ps

# Listar todos os containers (incluindo parados)
docker ps -a

# Parar container específico
docker stop <container_id>

# Iniciar container parado
docker start <container_id>

# Remover container
docker rm <container_id>

# Remover todos os containers parados
docker container prune

# Ver logs de um container
docker logs <container_id>
docker logs -f <container_id>  # seguir logs em tempo real
```

### Gerenciamento de Imagens

```bash
# Listar imagens
docker images

# Remover imagem
docker rmi <image_id>

# Remover imagens não utilizadas
docker image prune

# Remover tudo (containers, imagens, volumes, networks)
docker system prune -a
```

### Gerenciamento de Volumes

```bash
# Listar volumes
docker volume ls

# Remover volume específico
docker volume rm <volume_name>

# Remover volumes não utilizados
docker volume prune
```

### Gerenciamento de Networks

```bash
# Listar networks
docker network ls

# Remover network
docker network rm <network_name>

# Remover networks não utilizadas
docker network prune
```

### Comandos de Monitoramento

```bash
# Ver uso de recursos
docker stats

# Ver processos em container
docker top <container_id>

# Inspecionar container
docker inspect <container_id>

# Ver logs de todos os containers
docker-compose logs
```

---

## 🐧 WSL2 - Comandos Úteis

### Gerenciamento do WSL

```bash
# Listar distribuições instaladas
wsl --list --verbose

# Parar WSL2
wsl --shutdown

# Reiniciar WSL2
wsl --shutdown && wsl

# Parar distribuição específica
wsl --terminate Ubuntu

# Definir distribuição padrão
wsl --set-default Ubuntu

# Exportar distribuição (backup)
wsl --export Ubuntu C:\backup\ubuntu.tar

# Importar distribuição
wsl --import Ubuntu C:\WSL\Ubuntu C:\backup\ubuntu.tar
```

### Comandos do Sistema

```bash
# Atualizar sistema
sudo apt update && sudo apt upgrade -y

# Instalar Docker no WSL2
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker $USER

# Verificar versão do Docker
docker --version
docker-compose --version

# Verificar espaço em disco
df -h

# Limpar cache do apt
sudo apt clean
sudo apt autoremove
```

### Comandos de Rede

```bash
# Ver IP do WSL2
hostname -I

# Testar conectividade
ping google.com

# Ver interfaces de rede
ip addr show

# Ver rotas
ip route show
```

---

## 🔧 Troubleshooting

### Problemas Comuns

```bash
# Container não inicia
docker logs <container_id>

# Problema de permissão
sudo chown -R $USER:$USER .

# Limpar cache do Docker
docker system prune -a

# Rebuild completo
./vendor/bin/sail down -v
./vendor/bin/sail up --build

# Verificar portas em uso
sudo netstat -tulpn | grep :80
sudo netstat -tulpn | grep :3306

# Matar processo na porta
sudo kill -9 $(sudo lsof -t -i:80)
```

### Comandos de Diagnóstico

```bash
# Verificar status do Docker
sudo systemctl status docker

# Verificar logs do Docker
sudo journalctl -u docker.service

# Verificar espaço em disco
docker system df

# Verificar configuração do WSL2
wsl --status
```

---

## 💡 Dicas Importantes

### Performance WSL2

```bash
# Configurar .wslconfig no Windows (C:\Users\SeuUsuario\.wslconfig)
[wsl2]
memory=8GB
processors=4
swap=2GB
localhostForwarding=true
```

### Aliases Úteis

Adicione ao seu `~/.bashrc` ou `~/.zshrc`:

```bash
# Aliases para Docker
alias dps='docker ps'
alias dpsa='docker ps -a'
alias di='docker images'
alias dcu='docker-compose up'
alias dcd='docker-compose down'
alias dcb='docker-compose build'

# Aliases para Sail
alias sail='./vendor/bin/sail'
alias sartisan='./vendor/bin/sail artisan'
alias scomposer='./vendor/bin/sail composer'
alias stest='./vendor/bin/sail test'

# Aliases para Git
alias gs='git status'
alias ga='git add'
alias gc='git commit'
alias gp='git push'
alias gl='git log --oneline --graph'
alias gd='git diff'
alias gb='git branch'
alias gco='git checkout'
```

### Comandos de Backup

```bash
# Backup do banco de dados
./vendor/bin/sail exec mysql mysqldump -u sail -p --all-databases > backup.sql

# Backup dos volumes
docker run --rm -v conselho-pronto_sail-mysql-data:/data -v $(pwd):/backup alpine tar czf /backup/mysql-backup.tar.gz -C /data .
```

### Comandos de Desenvolvimento

```bash
# Ver logs em tempo real
./vendor/bin/sail logs -f

# Executar comandos específicos
./vendor/bin/sail exec laravel.test php artisan migrate:fresh --seed

# Acessar banco de dados
./vendor/bin/sail exec mysql mysql -u sail -p

# Verificar status dos serviços
./vendor/bin/sail ps
```

---

## 📚 Recursos Adicionais

- [Documentação oficial do Laravel Sail](https://laravel.com/docs/sail)
- [Documentação oficial do Docker](https://docs.docker.com/)
- [Guia WSL2 da Microsoft](https://docs.microsoft.com/en-us/windows/wsl/)
- [Docker Compose Reference](https://docs.docker.com/compose/compose-file/)

---

**💡 Dica:** Sempre use `./vendor/bin/sail` em vez de `sail` diretamente para garantir que está usando a versão correta do Laravel Sail do seu projeto.
