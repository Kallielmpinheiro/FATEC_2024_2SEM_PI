-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/06/2024 às 07:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdclinicapi`
--
CREATE DATABASE IF NOT EXISTS `bdclinicapi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdclinicapi`;

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_medicacao` (IN `cpf_paciente` VARCHAR(20))   BEGIN



 SELECT 
        p.idPaciente, 
        p.nome, 
        m.nomeMedicamento AS 'Medicamento',
        m.tipo, 
        e.descricao, 
        pr.data_prescricao, 
        pr.dosagem,
        pr.instrucao,
        me.nome AS 'Doutor(a)',
        me.NumCRM
    FROM 
        paciente p
    LEFT JOIN 
       efeitoscolaterais e ON p.idPaciente = e.id_paciente
    LEFT JOIN 
        prescricao pr ON p.idPaciente = pr.id_paciente
    LEFT JOIN 
        medicamentosconsulta m ON pr.id_medicamentosconsulta = m.idMedicamento
   INNER JOIN
   		medico me ON me.id = p.medico_id
    WHERE
        p.cpf = cpf_paciente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prescrever_medicacao` (IN `cpf_paciente` VARCHAR(20), IN `id_medicamentosconsulta` INT, IN `dosagem` VARCHAR(90), IN `instrucao` VARCHAR(255), IN `duracao` INT, IN `CRM` INT)   BEGIN
DECLARE paciente_id INT;
DECLARE medico_id INT;

-- Consultar o ID do paciente com base no CPF fornecido
SELECT idPaciente INTO paciente_id FROM paciente WHERE cpf = cpf_paciente;
SELECT id INTO medico_id FROM medico WHERE CRM = NumCRM;

-- Verificar se o paciente existe
IF paciente_id IS NULL AND medico_id IS NULL THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Paciente não encontrado';
ELSE
    -- Inserir a prescrição na tabela de prescrições
    INSERT INTO prescricao (id_paciente, id_medicamentosconsulta, duracao, dosagem, instrucao, medico_id)
    VALUES (paciente_id, id_medicamentosconsulta, duracao, dosagem, instrucao, medico_id);

END IF;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `efeitoscolaterais`
--

CREATE TABLE `efeitoscolaterais` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_descricao` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_paciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `efeitoscolaterais`
--

INSERT INTO `efeitoscolaterais` (`id`, `descricao`, `data_descricao`, `id_paciente`) VALUES
(1, 'Estou morrendo', '2024-06-17 04:53:02', 10),
(2, 'dor de barriga', '2024-06-17 05:21:40', 30);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `idFuncionario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `idade` int(3) NOT NULL,
  `sexo` char(1) NOT NULL,
  `dataContratacao` date NOT NULL,
  `dataSaida` date DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`idFuncionario`, `nome`, `idade`, `sexo`, `dataContratacao`, `dataSaida`, `cpf`, `senha`, `status`) VALUES
(1, 'Alice Santos', 30, 'F', '2022-01-15', NULL, '12345678901', '$2y$10$W5Gw5FhMElpCfIoJj.TUl.KCx2BT/NOPAvZ8q4IPGvqoaP44ppoXi', 'ativo'),
(2, 'Bruno Oliveira', 45, 'M', '2020-05-20', '2023-05-20', '23456789012', '$2y$10$W5Gw5FhMElpCfIoJj.TUl.KCx2BT/NOPAvZ8q4IPGvqoaP44ppoXi', 'ativo'),
(3, 'Carla Ferreira', 28, 'F', '2021-09-01', NULL, '34567890123', '$2y$10$W5Gw5FhMElpCfIoJj.TUl.KCx2BT/NOPAvZ8q4IPGvqoaP44ppoXi', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `medicamentosconsulta`
--

CREATE TABLE `medicamentosconsulta` (
  `idMedicamento` int(11) NOT NULL,
  `nomeMedicamento` varchar(255) NOT NULL,
  `fabricante` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `uso` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `medico`
--

CREATE TABLE `medico` (
  `id` int(11) NOT NULL,
  `NumCRM` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `especialidade` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `medico`
--

INSERT INTO `medico` (`id`, `NumCRM`, `nome`, `data_nascimento`, `cpf`, `especialidade`, `telefone`, `senha`, `status`) VALUES
(1, 101, 'Dr. João', '1970-01-01', '123.456.789-00', 'Cardiologia', '1234-5678', '$2y$10$W5Gw5FhMElpCfIoJj.TUl.KCx2BT/NOPAvZ8q4IPGvqoaP44ppoXi', 'ativo'),
(2, 11378, 'Dr.Carla', '1970-01-01', '12356790777', 'Ortopedista', '1234-6666', '$2y$10$W5Gw5FhMElpCfIoJj.TUl.KCx2BT/NOPAvZ8q4IPGvqoaP44ppoXi', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE `paciente` (
  `idPaciente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `PlanoSaude` varchar(255) DEFAULT NULL,
  `tipoPessoa` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `medico_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `paciente`
--

INSERT INTO `paciente` (`idPaciente`, `nome`, `sobrenome`, `cpf`, `cep`, `estado`, `rua`, `cidade`, `numero`, `PlanoSaude`, `tipoPessoa`, `senha`, `medico_id`, `status`) VALUES
(10, 'Carlos', 'Andrade', '2374569876', '13604172', 'SP', 'Rua Melânia Baraldi Maróstica', 'Araras', '215', 'unimed', 'pessoa', '$2y$10$Q7LU5JhlZ4Dztm/Td5bmTuWkgjduzYz0LhfWLxcu6ERjWCZbFeta6', 1, 'ativo'),
(25, 'Pedro', 'Flavio', '123567459', '13604192', 'SP', 'Rua Armelindo Baghin', 'Araras', '187', 'unimed', 'pessoa', '$2y$10$E3ThvdwRaw9aI1XaXrgE6O6Wj4OVnJi...tDEaL6sGHL6uZkkPSeC', 1, 'inativo'),
(26, 'Lilia', 'Silva', '444', '13604192', 'SP', 'Rua Armelindo Baghin', 'Araras', '187', 'goldencross', 'pessoa', '$2y$10$Tm6KBK8kworyaENO7ObAXeowZ09bLS2qlkGWOTyDXaIo1JS/nr3py', 1, 'ativo'),
(27, 'Mariana', 'Pereira', '567', '13604192', 'SP', 'Rua Armelindo Baghin', 'Araras', '187', 'unimed', 'pessoa', '$2y$10$SoTrMjumiBrvcQkQ2nspq.d8NCD/rVlfEwY0sZEDwep/bZSlY6tfy', 1, 'inativo'),
(28, 'Andressa', 'Pinto', '700', '13604192', 'SP', 'Rua Armelindo Baghin', 'Araras', '187', 'unimed', 'pessoa', '$2y$10$J9dV1f85JkjyYC.SM.AvxefNIO5.M0FbKCNdWOenuOg3uz9BYYJ/a', 1, 'ativo'),
(29, 'Ruan', 'Junior', '701', '13604192', 'SP', 'Rua Melânia Baraldi Maróstica', 'Araras', '215', 'unimed', 'pessoa', '$2y$10$clFEq/oHWMt92xU9Op6UOeK0pz85n1k8XXrB4X6yF0oIDnb2NKJF.', 1, 'ativo'),
(30, 'Pereira Junior', 'MIRANDA', '8953335671', '13604172', 'SP', 'Rua Melânia Baraldi Maróstica', 'Araras', '215', 'unimed', 'pessoa', '$2y$10$hoh/q3LKHeNZgBHijAlgRO2uQafK7HCRSZHijFfgNRor8PV/iM0Iy', 2, 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `prescricao`
--

CREATE TABLE `prescricao` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medicamentosconsulta` int(11) NOT NULL,
  `data_prescricao` timestamp NOT NULL DEFAULT current_timestamp(),
  `duracao` int(11) NOT NULL,
  `dosagem` varchar(50) NOT NULL,
  `instrucao` varchar(255) DEFAULT NULL,
  `medico_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `efeitoscolaterais`
--
ALTER TABLE `efeitoscolaterais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`idFuncionario`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `medicamentosconsulta`
--
ALTER TABLE `medicamentosconsulta`
  ADD PRIMARY KEY (`idMedicamento`);

--
-- Índices de tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idPaciente`),
  ADD KEY `medico_id` (`medico_id`);

--
-- Índices de tabela `prescricao`
--
ALTER TABLE `prescricao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medicamentosconsulta` (`id_medicamentosconsulta`),
  ADD KEY `medico_id` (`medico_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `efeitoscolaterais`
--
ALTER TABLE `efeitoscolaterais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `idFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `medicamentosconsulta`
--
ALTER TABLE `medicamentosconsulta`
  MODIFY `idMedicamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `prescricao`
--
ALTER TABLE `prescricao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `efeitoscolaterais`
--
ALTER TABLE `efeitoscolaterais`
  ADD CONSTRAINT `efeitoscolaterais_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`idPaciente`) ON DELETE CASCADE;

--
-- Restrições para tabelas `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`medico_id`) REFERENCES `medico` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
