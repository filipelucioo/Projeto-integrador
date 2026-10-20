# ⚽ Copa Bololô - Sistema Completo

Projeto Integrador em **PHP** e **PostgreSQL / MySQL** para gestão de campeonatos de futebol amador.

---

## 🚀 Funcionalidades
- **Gestão de Times e Jogadores (CRUD)**
- **Sistema de Registro de Partidas com atribuição individual de gols aos jogadores**
- **Tabela de Classificação Automática** (Pontos, Vitórias, Empates, Derrotas, Gols Pró/Contra, Saldo de Gols)
- **Histórico Completo de Partidas Realizadas**
- **Artilharia do Campeonato em Tempo Real**
- **Autenticação com Área Restrita Protegida**
- **Layout Responsivo e Moderno em CSS3**

---

## 🗄️ Configuração do Banco de Dados
1. Execute o script `database/schema.sql` no seu PostgreSQL ou MySQL.
2. O sistema cria as tabelas `usuarios`, `times`, `jogadores`, `jogos` e `jogo_gols`.

---

## 💻 Como Rodar
Inicie o servidor PHP na pasta do projeto:
```bash
php -S localhost:8000
```
Acesse `http://localhost:8000` no seu navegador.
