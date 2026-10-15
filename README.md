# ⚽ Site do Campeonato de Futebol (Bololô)

Site desenvolvido em **PHP** com **MySQL** para gerenciar um campeonato de futebol fictício. Reúne uma parte **institucional** (quem somos, o que fazemos, propósito e regras), uma parte de **gerenciamento** (cadastrar, listar, atualizar e deletar times e jogadores, com área de login) e as **consultas** do campeonato (artilharia e tabela de jogos).

---

## 📑 Sumário

- [Funcionalidades](#-funcionalidades)
- [Tecnologias](#-tecnologias)
- [Estrutura de pastas](#-estrutura-de-pastas)
- [Fluxo de navegação](#-fluxo-de-navegação)
- [Requisitos](#-requisitos)
- [Banco de dados](#-banco-de-dados)
- [Como executar localmente](#-como-executar-localmente)
- [Como usar](#-como-usar)
- [Boas práticas e segurança](#-boas-práticas-e-segurança)
- [Próximos passos](#-próximos-passos)
- [Autor](#-autor)

---

## 📌 Funcionalidades

**Páginas institucionais (página inicial)**
- **Quem Somos** – apresentação do campeonato
- **O que Fazemos** – atividades e serviços
- **Nosso Propósito** – missão e valores
- **Regras do Campeonato** – regulamento

**Gerenciamento (CRUD)**
- **Cadastrar time** – nome do time, nome e CPF do técnico, data de nascimento e telefone
- **Cadastrar jogador** – time, nome, CPF, data de nascimento, telefone, nome e telefone do responsável
- **Listar** times e jogadores (com filtro por time)
- **Atualizar** time e jogador
- **Deletar** time e jogador

**Acesso**
- **Login** de usuários, cadastro de usuário e logout

**Consultas**
- **Artilharia** (`artilharia.php`) – ranking dos maiores goleadores
- **Tabela** (`tabela.php`) – tabela de jogos e classificação

---

## 🛠️ Tecnologias

- PHP
- MySQL 
- HTML5 e CSS3

---

## 🗂️ Estrutura de pastas

```
/campeonato
├── app/                          # Operações de CRUD (jogador e time)
│   ├── create_jogador.php        # Cadastra um jogador
│   ├── create_time.php           # Cadastra um time
│   ├── deletar_jogador.php       # Exclui um jogador
│   ├── deletar_time.php          # Exclui um time
│   ├── select_jogador.php        # Lista todos os jogadores
│   ├── select_time.php           # Lista todos os times
│   ├── select_where_jogador.php  # Busca jogador(es) com filtro (ex.: por time)
│   ├── select_where_time.php     # Busca time(s) com filtro
│   ├── update_jogador.php        # Atualiza dados de um jogador
│   └── update_time.php           # Atualiza dados de um time
├── database/
│   └── conect.php                # Conexão com o banco de dados
├── login/                        # Autenticação de usuários
│   ├── cadastrar.php             # Cadastro de usuário
│   ├── index.php                 # Tela/entrada do login
│   ├── logout.php                # Encerra a sessão
│   └── verifica_user.php         # Valida usuário e senha
├── style/
│   └── style.css                 # Estilos do site
├── artilharia.php                # Ranking de artilheiros
├── tabela.php                    # Tabela de jogos / classificação
├── login.php                     # Página de login
├── index.php                     # Página inicial (quem somos, o que fazemos, propósito, regras)
└── README.md                     # Documentação do projeto
```

| Pasta / arquivo | Função |
|-----------------|--------|
| `app/` | Toda a lógica de **CRUD**: `create` (cadastrar), `select` (listar), `select_where` (listar com filtro), `update` (atualizar) e `deletar` (excluir), separados para **time** e **jogador**. |
| `database/` | Conexão com o banco, incluída pelos demais arquivos com `require`/`include`. |
| `login/` | Controle de acesso: cadastro de usuário, verificação de credenciais e logout. |
| `style/` | Folhas de estilo (CSS). |
| `artilharia.php` | Exibe os jogadores ordenados por número de gols. |
| `tabela.php` | Exibe a tabela de jogos e a classificação dos times. |
| `index.php` | Porta de entrada do site. |

---

## 🧭 Fluxo de navegação

```
index.php ──► login.php ──► menu principal (header.php)
                              ├──► Cadastrar time ──► Cadastrar jogador
                              ├──► Lista de times e jogadores
                              ├──► Artilharia  (artilharia.php)
                              ├──► Tabela      (tabela.php)
                              ├──► Atualizar time / jogador
                              └──► Deletar time / jogador
```

Todas as telas seguem o padrão **header → conteúdo → footer**, reaproveitando o cabeçalho (logo e menu) e o rodapé do site.

---

## 🧰 Requisitos

- **PHP 8.0+** (funciona também em 7.4+) com a extensão `mysqli` habilitada
- **MySQL / MariaDB**
- Navegador web atualizado
- Para o banco hospedado no servidor: acesso via **MobaXterm** (SSH)
- Opcional: **XAMPP**, **WAMP** ou **Laragon** para rodar o PHP localmente

---

## 🗄️ Banco de dados

O banco de dados do projeto fica hospedado em um servidor acessado pelo **MobaXterm**, com um usuário próprio:

| Item | Valor |
|------|-------|
| Usuário | `campeonato` |
| Banco de dados | `campeonato` |
| Senha | `campeonato` |

### 1. Criar as tabelas

Conecte no MySQL e execute o script abaixo:

```bash
mysql -u campeonato -p campeonato
```

```sql
CREATE TABLE times (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tecnico VARCHAR(100) NOT NULL,
    cpf_tecnico VARCHAR(14) NOT NULL,
    data_nascimento DATE NOT NULL,
    telefone VARCHAR(20)
);

CREATE TABLE jogadores (
    id SERIAL PRIMARY KEY,
    time_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    data_nascimento DATE NOT NULL,
    telefone VARCHAR(20),
    nome_responsavel VARCHAR(100),
    telefone_responsavel VARCHAR(20),
    gols INT DEFAULT 0,
    FOREIGN KEY (time_id) REFERENCES times(id)
);

CREATE TABLE jogos (
    id SERIAL PRIMARY KEY,
    time_casa_id INT NOT NULL,
    time_fora_id INT NOT NULL,
    gols_casa INT DEFAULT 0,
    gols_fora INT DEFAULT 0,
    data_jogo DATE NOT NULL,
    FOREIGN KEY (time_casa_id) REFERENCES times(id),
    FOREIGN KEY (time_fora_id) REFERENCES times(id)
);
```

> ℹ️ O login (`login/`) também precisa de uma tabela de usuários. Crie-a conforme os campos usados em `login/cadastrar.php` e `login/verifica_user.php`.

### 2. Configurar a conexão

Edite o arquivo `database/conect.php` com as credenciais:

```php
<?php
$host    = "localhost";     // se o banco estiver em outro servidor, use o IP/host dele
$dbname = "campeonato";
$pass   = "campeonato";
$user   = "campeonato";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
```

---

## 🚀 Como executar localmente

### 1. Baixar o projeto

Copie a pasta do projeto para o seu computador (ou clone o repositório):

```bash
git clone <url-do-repositorio> campeonato
cd campeonato
```

### 2. Preparar o banco

Siga a seção [Banco de dados](#-banco-de-dados): crie as tabelas e confira as credenciais em `database/conect.php`.

### 3. Iniciar o servidor

**Opção A — Servidor embutido do PHP**

Na pasta do projeto:

```bash
php -S localhost:8000
```

Acesse: `http://localhost:8000`

**Opção B — XAMPP / WAMP / Laragon**

1. Copie a pasta `campeonato` para o diretório do servidor:
   - XAMPP (Windows): `C:\xampp\htdocs\campeonato`
   - XAMPP (Linux): `/opt/lampp/htdocs/campeonato`
   - WAMP: `C:\wamp64\www\campeonato`
2. Inicie o **Apache** (e o **MySQL**, se o banco for local) no painel.
3. Acesse: `http://localhost/campeonato`

### 4. Acessar o site

1. Abra a página inicial (`index.php`).
2. Crie um usuário em `login/cadastrar.php` (se ainda não existir) e faça login.
3. Use o menu para cadastrar e consultar times e jogadores.

---

## 🧑‍💻 Como usar

1. Leia as informações do campeonato na **página inicial**.
2. Faça **login** para acessar a área de gerenciamento.
3. Em **Cadastrar time**, preencha os dados do time e do técnico.
4. Em seguida, use **Cadastrar jogador** para adicionar os atletas ao time.
5. Consulte a **lista de times e jogadores**; use os filtros para ver os jogadores de um time específico.
6. Acompanhe o campeonato em **Artilharia** e **Tabela**.
7. Use **Atualizar** e **Deletar** para manter os dados corretos.
8. Ao terminar, clique em **Sair** (logout).

### Botões dos formulários

| Botão | Ação |
|-------|------|
| **Limpar** | Apaga os campos preenchidos |
| **Enviar** | Salva o cadastro |
| **Voltar** | Retorna para a tela anterior |

---

## 🔒 Boas práticas e segurança

- **Não suba senhas reais para repositórios públicos.** As credenciais deste README (`campeonato`/`campeonato`) servem apenas para ambiente de estudo; em produção use uma senha forte e variáveis de ambiente.
- Use **prepared statements** (`mysqli` ou PDO) para evitar SQL Injection.
- Guarde senhas de usuários com `password_hash()` e valide com `password_verify()`.
- Valide **CPF** e demais campos no servidor, não só no navegador.
- Escape as saídas com `htmlspecialchars()` para evitar XSS.
- Proteja as páginas de gerenciamento verificando a sessão do usuário (`session_start()`) antes de executar qualquer ação.
- Os dados de jogadores menores de idade e de seus responsáveis são sensíveis: trate-os com cuidado, mesmo em um projeto fictício.

---

## 🛣️ Próximos passos

- [ ] Cadastro de partidas e resultados
- [ ] Cálculo automático da classificação (pontos, vitórias, saldo de gols)
- [ ] Registro de gols por jogador para alimentar a artilharia
- [ ] Níveis de acesso (administrador e visitante)
- [ ] Layout responsivo para celular

---

## 👤 Autor

Desenvolvido por **[Seu Nome]**.