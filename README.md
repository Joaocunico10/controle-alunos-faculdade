# Controle de Alunos - Faculdade

Aplicação web para apoio ao controle acadêmico de uma faculdade. O projeto autentica usuários e mantém cursos e alunos; também possui a estrutura de gerenciamento de usuários, professores e disciplinas.

> Este README descreve a branch `main` como ela está. Cursos e alunos têm CRUD estruturado. Professores e disciplinas possuem controllers, rotas e telas, mas há inconsistências entre migrations, models e validação. Veja [Limitações conhecidas](#limitações-conhecidas) antes de usar esses módulos.

## Tecnologias

| Tecnologia | Uso identificado |
| --- | --- |
| PHP `^8.3` | Linguagem, conforme `composer.json`. |
| Laravel `^13.17` | Framework, Eloquent, migrations, rotas, validação e autenticação. |
| PostgreSQL | Conexão padrão em `.env.example` (`DB_CONNECTION=pgsql`). |
| Laravel Breeze `^2.4` | Fluxos e telas de autenticação em Blade. |
| Blade | Views em `resources/views`. |
| Vite `^8.0` | Build e servidor dos assets. |
| Tailwind CSS `^3.1` | Estilização das telas Breeze, cursos e alunos. |
| Alpine.js `^3.4` | Navegação responsiva. |
| Git | Repositório e branches remotas presentes. |

## Funcionalidades implementadas

### Autenticação e perfil

O Laravel Breeze fornece cadastro, login, logout, recuperação/redefinição de senha, confirmação de senha e fluxo de verificação de e-mail. Cadastro e login usam o middleware `guest`; perfil e fluxos protegidos usam `auth`.

No cadastro, o usuário informa nome, e-mail e senha confirmada. A role não é escolhida na interface: a migration atribui `professor` por padrão. O usuário autenticado pode editar dados, senha ou excluir a própria conta pelas telas padrão do Breeze.

### Usuários, roles e permissões

O enum `App\Enums\UserRole` contém `admin`, `coordenador` e `professor`. O model `User` converte a coluna `role` para esse enum. O alias de middleware `role` é registrado em `bootstrap/app.php`.

A rota `GET /usuarios` lista todos os usuários e exige `auth` e `role:admin`. Ela é apenas de consulta: não existe CRUD de usuários nessa tela.

### Cursos e alunos

Há CRUD de cursos e alunos, protegido por `auth`.

- Curso: nome, código único e duração em semestres. A listagem é paginada e exibe a quantidade de alunos.
- Aluno: nome, CPF único, e-mail único, matrícula única, data de nascimento e curso. A listagem é paginada e carrega o curso associado.
- `Store...` e `Update...` Form Requests validam obrigatoriedade, formato, unicidade e chaves estrangeiras, com mensagens em português.
- `AlunoPolicy` e `CursoPolicy` permitem listar/criar/editar ao usuário autenticado. A exclusão exige e-mail verificado.
- A exclusão de um curso remove os alunos vinculados por `cascadeOnDelete`.

### Professores e disciplinas

Existem models, controllers resource, views e Requests. O relacionamento previsto é: professor possui muitas disciplinas; disciplina pertence a professor. Contudo, essas rotas não recebem `auth` nem policies no estado atual.

`StoreProfessorRequest`, `UpdateProfessorRequest` e `UpdateDisciplinaRequest` possuem validações. Já `StoreDisciplinaRequest::authorize()` retorna `false`; por isso, `POST /disciplinas` responde 403 antes do controller. As migrations também não correspondem aos campos usados por esse código.

### Seeders e relacionamentos

- `CursoSeeder` cria cinco cursos nomeados e mais três aleatórios.
- `AlunoSeeder` cria de 3 a 6 alunos aleatórios por curso.
- `UserSeeder` declara contas de administrador, coordenador e professor.
- `DatabaseSeeder` executa `CursoSeeder`, `AlunoSeeder` e `UserSeeder`, além de criar `Test User`. Ele não chama `ProfessorSeeder` nem `DisciplinaSeeder`.
- `Curso hasMany Aluno`; `Aluno belongsTo Curso`.
- `Professor hasMany Disciplina`; `Disciplina belongsTo Professor`.

## Estrutura do projeto

| Caminho | Responsabilidade e exemplos |
| --- | --- |
| `app/Models` | Eloquent: `Aluno`, `Curso`, `Professor`, `Disciplina` e `User`. |
| `app/Http/Controllers` | Ações das telas; por exemplo, `AlunoController`, `CursoController` e `UserManagementController`. |
| `app/Http/Requests` | Regras de entrada, como `StoreAlunoRequest` e `UpdateCursoRequest`. |
| `app/Http/Middleware` | `RoleMiddleware`, para a verificação de role. |
| `app/Policies` | `AlunoPolicy` e `CursoPolicy`. |
| `app/Enums` | `UserRole.php`. |
| `database/migrations` | Estrutura de usuários, sessões, cache, filas, cursos, alunos, professores e disciplinas. |
| `database/seeders` | Dados de desenvolvimento: cursos, alunos, usuários, professores e disciplinas. |
| `resources/views` | Blade: autenticação, perfil, dashboard, cursos, alunos, professores, disciplinas e administração. |
| `routes` | `web.php` define a aplicação; `auth.php` define as rotas do Breeze. |
| `public` | Entrada HTTP em `index.php` e recursos públicos. |
| `composer.json` / `package.json` | Dependências e scripts PHP/JS. |

## Requisitos

- PHP 8.3 ou superior compatível com `^8.3`;
- Composer;
- Node.js e npm;
- PostgreSQL;
- Git;
- extensões PHP `pdo_pgsql` e `pgsql`, além das extensões usuais do Laravel: `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `fileinfo` e `bcmath`.

No PowerShell, confirme o driver PostgreSQL:

```powershell
php -m | Select-String 'pdo_pgsql|pgsql'
```

## Como baixar o projeto

O remoto configurado no repositório é:
`https://github.com/Joaocunico10/controle-alunos-faculdade.git`.

```bash
git clone https://github.com/Joaocunico10/controle-alunos-faculdade.git
cd controle-alunos-faculdade
```

Confira as branches e use a principal:

```bash
git branch -a
git switch main
git pull origin main
```

Para trocar para uma branch remota, por exemplo a de João:

```bash
git switch --track origin/Joao
```

## Configuração do ambiente

### Dependências PHP

```bash
composer install
```

O comando instala as versões registradas em `composer.lock`.

### Arquivo de ambiente

No PowerShell:

```powershell
Copy-Item .env.example .env
```

Em shell Unix:

```bash
cp .env.example .env
```

Edite o `.env`. Abaixo está o modelo presente em `.env.example`; ajuste usuário e senha para seu PostgreSQL:

```dotenv
APP_URL=http://localhost:8000
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=projeto_laravel
DB_USERNAME=postgres
DB_PASSWORD=
```

Gere a chave de criptografia e sessão:

```bash
php artisan key:generate
```

### Dependências JavaScript

```bash
npm install
```

Se o PowerShell bloquear o script `npm`, execute:

```powershell
npm.cmd install
```

## Banco de dados

Crie o banco cujo nome está em `DB_DATABASE`:

```bash
psql -U postgres -h 127.0.0.1 -p 5432 -c "CREATE DATABASE projeto_laravel;"
```

Depois de conferir o `.env`, crie ou atualize a estrutura:

```bash
php artisan migrate
```

Use `migrate` para aplicar somente migrations pendentes e preservar tabelas/dados existentes. Para os dados definidos no `DatabaseSeeder`:

```bash
php artisan db:seed
```

Em base de desenvolvimento/teste, recrie tudo com os seeders:

```bash
php artisan migrate:fresh --seed
```

> **Atenção:** `migrate:fresh --seed` apaga todas as tabelas e dados antes de recriá-los. Faça backup e não o use em banco com dados reais.

## Como iniciar o projeto

Em um terminal:

```bash
php artisan serve
```

O endereço usual é [http://127.0.0.1:8000](http://127.0.0.1:8000). Em outro terminal, mantenha o Vite em desenvolvimento:

```bash
npm run dev
```

Se necessário no PowerShell:

```powershell
npm.cmd run dev
```

Para compilar assets sem manter o Vite ativo, use `npm run build`.

## Usuários e dados de teste

`DatabaseSeeder` cria as contas abaixo. As três contas com role vêm de `UserSeeder`; `Test User` é criado diretamente pelo seeder principal.

| Nome | E-mail | Role | Senha definida no código |
| --- | --- | --- | --- |
| Test User | `test@example.com` | `professor` (padrão da migration) | `password` (factory) |
| Administrador | `admin@faculdade.com` | `admin` | `12345678` |
| Coordenador | `coordenador@faculdade.com` | `coordenador` | `12345678` |
| Professor | `professor@faculdade.com` | `professor` | `12345678` |

Essas senhas são apenas para ambiente local. As contas sem `email_verified_at` não podem excluir curso ou aluno, pois as policies exigem e-mail verificado. O `.env.example` usa `MAIL_MAILER=log`.

## Rotas principais

| Método | URI | Finalidade | Middleware/configuração |
| --- | --- | --- | --- |
| GET | `/` | Página inicial. | — |
| GET | `/dashboard` | Dashboard. | `auth`, `verified` |
| GET | `/usuarios` | Lista usuários. | `auth`, `role:admin` |
| GET/POST | `/register`, `/login` | Cadastro e autenticação. | `guest` |
| POST | `/logout` | Encerra sessão. | `auth` |
| GET/PATCH/DELETE | `/profile` | Perfil autenticado. | `auth` |
| Resource | `/cursos` | CRUD de cursos. | `auth` + policy |
| Resource | `/alunos` | CRUD de alunos. | `auth` + policy |
| Resource | `/professores` | CRUD de professores. | Sem middleware declarado |
| Resource | `/disciplinas` | CRUD de disciplinas. | Sem middleware; POST negado pelo Request atual |

Resources seguem os métodos REST do Laravel: GET para listagem/formulário/consulta, POST para criação, PUT/PATCH para atualização e DELETE para remoção.

## Fluxo de utilização

1. Configure PostgreSQL, `.env`, dependências e migrations.
2. Rode `php artisan serve` e `npm run dev` em terminais separados.
3. Entre em `/login` com uma conta de teste ou registre uma conta.
4. Cadastre um curso e, em seguida, um aluno associado.
5. Teste listagem, visualização e edição de cursos/alunos.
6. Entre como `admin@faculdade.com` e acesse `/usuarios` para testar a tela administrativa.
7. Teste exclusão de curso/aluno apenas com e-mail marcado como verificado.
8. Não considere professores/disciplinas prontos para cadastro até corrigir as limitações abaixo.

## Limitações conhecidas

Os pontos abaixo foram confirmados pela comparação de migrations, models, Requests, controllers e seeders.

- A migration de `professors` cria `nome`, `codigo`, `carga_horaria` e uma referência obrigatória para outro professor. Já model, formulários, controller e seeder usam `nome`, `email` e `titulacao`. Portanto, o schema não atende ao CRUD/seeder de professores.
- A migration de `disciplinas` cria apenas timestamps e `professor_id`; model, views, Request de atualização e seeder também usam `nome`, `codigo` e `carga_horaria`.
- `StoreDisciplinaRequest` não autoriza a requisição e não possui regras, portanto bloqueia o cadastro com HTTP 403.
- `DatabaseSeeder` não chama os seeders de professor ou disciplina.
- Professores e disciplinas estão fora do grupo `auth`.

## Solução de problemas

| Problema | Solução |
| --- | --- |
| `could not find driver` ou conexão recusada | Habilite `pdo_pgsql`/ `pgsql`, inicie o PostgreSQL e revise as variáveis `DB_*` no `.env`. |
| Banco inexistente | Crie o banco de mesmo nome que `DB_DATABASE`, depois execute `php artisan migrate`. |
| Chave da aplicação ausente | Execute `php artisan key:generate`. |
| Dependências ou classes ausentes | Execute `composer install`; para assets, `npm install`. |
| npm bloqueado no PowerShell | Use `npm.cmd install` e `npm.cmd run dev`. |
| Tabela inexistente | Confirme o banco selecionado e rode `php artisan migrate`. Consulte `php artisan migrate:status`. |
| Erro ao criar professor ou disciplina | Corrija primeiro as [limitações conhecidas](#limitações-conhecidas). |
| Problemas após atualização | Execute `git pull`, `composer install`, `npm install`, `php artisan migrate` e, se necessário, `php artisan optimize:clear`. |
| Duplicidade ao semear | Em base de teste, use `php artisan migrate:fresh --seed`. Cursos nomeados usam `firstOrCreate`, mas as factories criam registros adicionais. Além disso, o `UserSeeder` coloca e-mail e senha no critério de `updateOrCreate`; como a senha é armazenada com hash, uma nova execução pode não localizar a conta e tentar repetir seu e-mail único. |

## Git e branches

A branch principal atual é `main`. O histórico/remotos também identificam:

- `Joao`: roles e gerenciamento de usuários;
- `leo/alunos-cursos`: alunos e cursos;
- `luis`: professores, disciplinas e seeders.

Para atualizar a principal:

```bash
git switch main
git pull origin main
```

Para consultar branches locais e remotas:

```bash
git branch -a
```

Use `git status` antes de trocar de branch ou atualizar, para não sobrescrever alterações locais.

## Observações de segurança

- Não versione nem compartilhe o arquivo `.env`.
- Não use senhas reais ou de produção nos seeders.
- Faça backup antes de executar `migrate:fresh`.
- Confira o banco indicado no `.env` antes de migrations.
- Proteja as rotas de professores e disciplinas antes de disponibilizar o sistema em produção.
