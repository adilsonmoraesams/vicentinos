
-- Tabela TipoConta
DROP TABLE TipoConta;
CREATE TABLE TipoConta (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    descricao TEXT,
    pagar TEXT,
    receber TEXT
);


-- Conta
DROP TABLE Conta;
CREATE TABLE Conta (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    idTipoConta INTEGER,
    descricao text,
    valor DECIMAL,
    situacao TEXT,
    dataVencimento DATETIME,
    dataPagamento DATETIME,
    dataFechamento DATETIME,
    comprovante TEXT
);



-- Conferencia
DROP TABLE Conferencia;
CREATE TABLE  Conferencia (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nome TEXT,
    codigo TEXT,
    dataAgregacao DATETIME
);


-- Integrante
DROP TABLE Integrante;

CREATE TABLE Integrante (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nome TEXT,
    telefone TEXT,
    dataNascimento DATE,
    situacao TEXT,
    dataIniciacao DATE
)
