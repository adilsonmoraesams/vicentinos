

TRUNCATE TABLE Conferencia;
INSERT INTO Conferencia ( nome, codigo, dataAgregacao) VALUES ('SÃO PEDRO PESCADOR', '000.000', '2000-08-20');


-- Tipo Conta
TRUNCATE TABLE TipoConta;
INSERT INTO TipoConta (descricao , Pagar , Receber) VALUES 
('Coleta', 'N','S'),
('Doação', 'N','S'),
('Evento', 'N','S'),
('Compra Remédio', 'S','N'),
('Compra Alimento', 'S','N'),
('Décima', 'S','N');

-- Integrante
TRUNCATE TABLE Integrante;






