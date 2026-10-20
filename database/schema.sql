-- Script do Banco de Dados para Copa Bololô (PostgreSQL)

CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS times (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tecnico VARCHAR(100) NOT NULL,
    cpf_tecnico VARCHAR(14) NOT NULL,
    data_nascimento DATE NOT NULL,
    telefone VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS jogadores (
    id SERIAL PRIMARY KEY,
    time_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    data_nascimento DATE NOT NULL,
    telefone VARCHAR(20),
    nome_responsavel VARCHAR(100),
    telefone_responsavel VARCHAR(20),
    gols INT DEFAULT 0,
    FOREIGN KEY (time_id) REFERENCES times(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS jogos (
    id SERIAL PRIMARY KEY,
    time_casa_id INT NOT NULL,
    time_fora_id INT NOT NULL,
    gols_casa INT DEFAULT 0,
    gols_fora INT DEFAULT 0,
    data_jogo DATE NOT NULL,
    FOREIGN KEY (time_casa_id) REFERENCES times(id),
    FOREIGN KEY (time_fora_id) REFERENCES times(id)
);

-- gols de cada jogador em cada jogo (usada na tabela e no histórico)
CREATE TABLE IF NOT EXISTS jogo_gols (
    id SERIAL PRIMARY KEY,
    jogo_id INT NOT NULL,
    jogador_id INT NOT NULL,
    quantidade INT NOT NULL,
    FOREIGN KEY (jogo_id) REFERENCES jogos(id) ON DELETE CASCADE,
    FOREIGN KEY (jogador_id) REFERENCES jogadores(id)
);
