SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `bdclinicapi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdclinicapi`;

DELIMITER $$
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

CREATE TABLE `efeitoscolaterais` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_descricao` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_paciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `funcionarios` (
  `idFuncionario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `idade` int(3) NOT NULL,
  `sexo` char(1) NOT NULL,
  `dataContratacao` date NOT NULL,
  `dataSaida` date DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `funcionarios` (`idFuncionario`, `nome`, `idade`, `sexo`, `dataContratacao`, `dataSaida`, `cpf`, `senha`) VALUES
(1, 'Alice Santos', 30, 'F', '2022-01-15', NULL, '12345678901', '$2y$10$W5Gw5FhMElpCfIoJj.TUl.KCx2BT/NOPAvZ8q4IPGvqoaP44ppoXi'),
(2, 'Bruno Oliveira', 45, 'M', '2020-05-20', '2023-05-20', '23456789012', '$2y$10$W5Gw5FhMElpCfIoJj.TUl.KCx2BT/NOPAvZ8q4IPGvqoaP44ppoXi'),
(3, 'Carla Ferreira', 28, 'F', '2021-09-01', NULL, '34567890123', '$2y$10$W5Gw5FhMElpCfIoJj.TUl.KCx2BT/NOPAvZ8q4IPGvqoaP44ppoXi');

CREATE TABLE `medicamentosconsulta` (
  `idMedicamento` int(11) NOT NULL,
  `nomeMedicamento` varchar(255) NOT NULL,
  `fabricante` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `uso` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `medico` (
  `id` int(11) NOT NULL,
  `NumCRM` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `especialidade` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `medico` (`id`, `NumCRM`, `nome`, `data_nascimento`, `cpf`, `especialidade`, `telefone`, `senha`) VALUES
(1, 101, 'Dr. João', '1970-01-01', '123.456.789-00', 'Cardiologia', '1234-5678', '$2y$10$W5Gw5FhMElpCfIoJj.TUl.KCx2BT/NOPAvZ8q4IPGvqoaP44ppoXi');

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
  `medico_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `paciente` (`idPaciente`, `nome`, `sobrenome`, `cpf`, `cep`, `estado`, `rua`, `cidade`, `numero`, `PlanoSaude`, `tipoPessoa`, `senha`, `medico_id`) VALUES
(10, 'Carlos', 'Andrade', '789', '13604172', 'SP', 'Rua Melânia Baraldi Maróstica', 'Araras', '215', 'unimed', 'pessoa', '$2y$10$W5Gw5FhMElpCfIoJj.TUl.KCx2BT/NOPAvZ8q4IPGvqoaP44ppoXi', 1);

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


ALTER TABLE `efeitoscolaterais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`idFuncionario`),
  ADD UNIQUE KEY `cpf` (`cpf`);

ALTER TABLE `medicamentosconsulta`
  ADD PRIMARY KEY (`idMedicamento`);

ALTER TABLE `medico`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idPaciente`),
  ADD KEY `medico_id` (`medico_id`);

ALTER TABLE `prescricao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medicamentosconsulta` (`id_medicamentosconsulta`),
  ADD KEY `medico_id` (`medico_id`);


ALTER TABLE `efeitoscolaterais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `funcionarios`
  MODIFY `idFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `medicamentosconsulta`
  MODIFY `idMedicamento` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `paciente`
  MODIFY `idPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `prescricao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `efeitoscolaterais`
  ADD CONSTRAINT `efeitoscolaterais_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`idPaciente`) ON DELETE CASCADE;

ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`medico_id`) REFERENCES `medico` (`id`) ON DELETE CASCADE;

ALTER TABLE `prescricao`
  ADD CONSTRAINT `prescricao_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`idPaciente`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescricao_ibfk_2` FOREIGN KEY (`id_medicamentosconsulta`) REFERENCES `medicamentosconsulta` (`idMedicamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescricao_ibfk_3` FOREIGN KEY (`medico_id`) REFERENCES `medico` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
