
-- PREENCHIMENTO DA TABELA OPERADORAS



-- PREENCHIMENTO DA TABELA CONTAS. NECESSÁRIO TABELA OPERADORAS PREENCHIDA PRA SABER O OPERADORA_ID

--TABELA OPERADORAS
INSERT INTO `operadoras` 
(`id`, `operadora`, `observacao`) 
VALUES
(1, 'Vivo', NULL);

--TABELA CONTAS
INSERT INTO `contas` 
(`id`, `conta`, `operadora_id`) 
VALUES
(1, '032148975', 1),
(3, '028954441', 1);

--TABELA PLANOS
INSERT INTO `planos` 
(`id`, `plano`, `observacao`) 
VALUES
(1, 'Smart Vivo 0,5GB', NULL),
(2, 'Smart Vivo 2GB', NULL),
(3, 'Smart Vivo','')

--TABELA GESTORES
INSERT INTO `gestores` 
(`id`,`gestor`, `observacao`) 
VALUES
(1, 'Vitor', NULL),
(2, 'José', NULL),
(3, 'Joao', NULL);

--TABELA SETORES
INSERT INTO `setores`
(`id`, `setor`, `observacao`) 
VALUES
(1, 'TI', NULL),
(2, 'Administrativo', NULL),
(3, 'Vendas', NULL);

--TABELA SUBSETORES
INSERT INTO `subsetores` 
(`id`, `subsetor`, `observacao`)
VALUES
(1, 'Suporte', NULL),
(2, 'Financeiro', NULL);

--SEGUIR ESSE PADRÃO
--TABELA TIPOS DE LINHAS
INSERT INTO `tipos_linhas`
(`id`,`tipo`) 
VALUES
(1, 'Dados'),
(2, 'Voz'),
(3, 'Voz + Dados');

--TABELA STATUS
-- CASO QUISER, INSERIR NOVOS STATUS, COMO 'BLOQUEADA'
INSERT INTO `status` 
(`id`,`status`, `observacao`) 
VALUES
(1, 'Ativa', NULL),
(2, 'Cancelada', NULL);

--TABELA INVENTARIOS
-- ATENÇÃO: PRIMEIRO CAMPO A SER PREENCHIDO É '', OU SEJA, VAZIO.
INSERT INTO `inventarios` (`id`,`linha`,`nome_usuario`,`data_registro`,`matricula`,`funcao`,`chip`,`observacao`, `conta_id`, `setor_id`, `subsetor_id`, `gestor_id`, `plano_id`, `status_id`, `tipo_linha_id`, `updated_at`) 
VALUES
('', '31992556644', 'Ronaldo Silva', '2020-02-22', 'MG 47855512', 'Coordenador', '89554444777711114444', 'Teste OK!', 1, 2, 2, 2, 2, 1, 3, NULL),