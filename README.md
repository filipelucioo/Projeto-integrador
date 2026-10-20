# ⚽ Copa Bololô - Sistema Completo

Projeto Integrador desenvolvido em **PHP** e **PostgreSQL / MySQL** para gestão de campeonatos de futebol amador.

---

## 🛠️ Tecnologias Utilizadas
- **PHP 7.4+ / 8.x** (PDO)
- **PostgreSQL / MySQL**
- **HTML5, CSS3 Moderno (CSS Variables & Flexbox/Grid)**

---

## 📁 Estrutura de Pastas
```
/
├── app/                          # Operações CRUD
│   ├── create_jogador.php        # Cadastrar Jogador
│   ├── create_time.php           # Cadastrar Time
│   ├── deletar_jogador.php       # Excluir Jogador
│   ├── deletar_time.php          # Excluir Time
│   ├── select_jogador.php        # Listar Jogadores
│   ├── select_time.php           # Listar Times
│   ├── select_where_jogador.php  # Consultar Jogador por ID
│   ├── select_where_time.php     # Consultar Time por ID
│   ├── update_jogador.php        # Atualizar Jogador
│   └── update_time.php           # Atualizar Time
├── database/
│   ├── conect.php                # Conexão PDO segura
│   └── schema.sql                # Script de criação de tabelas
├── includes/
│   ├── footer.php                # Rodapé comum
│   ├── functions.php             # Funções do sistema
│   └── header.php                # Cabeçalho e Navegação Dinâmica
├── login/                        # Autenticação
│   ├── cadastrar.php             # Registrar Usuário
│   ├── login.php                 # Tela de Login
│   ├── logout.php                # Encerrar Sessão
│   └── verifica_user.php         # Middleware de Proteção
├── style/
│   └── style.css                 # Estilização do Sistema
├── artilharia.php                # Ranking de Artilheiros
├── tabela.php                    # Tabela e Classificação
├── index.php                     # Página Inicial
└── README.md                     # Documentação
```

---

## 🚀 Como Executar

1. Importe o arquivo `database/schema.sql` no seu PostgreSQL ou MySQL.
2. Inicie o servidor PHP embutido na pasta raiz do projeto:
   ```bash
   php -S localhost:8000
   ```
3. Acesse `http://localhost:8000` no seu navegador.
