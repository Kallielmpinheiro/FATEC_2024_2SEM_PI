-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para bdclinicapi
CREATE DATABASE IF NOT EXISTS `bdclinicapi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bdclinicapi`;

-- Copiando estrutura para procedure bdclinicapi.consultar_medicacao
DELIMITER //
CREATE PROCEDURE `consultar_medicacao`(IN cpf VARCHAR(15))
BEGIN
    SELECT 
        p.idPaciente, 
        p.nome, 
        m.nomeMedicamento AS 'Medicamento',
        m.tipo, 
        e.descricao, 
        pr.data_prescricao, 
        pr.dosagem
    FROM 
        paciente p
    LEFT JOIN 
        efeitoscolaterais e ON p.idPaciente = e.pacienteID AND p.cpf = cpf
    INNER JOIN 
        prescricao pr ON p.idPaciente = pr.id_paciente
    INNER JOIN 
        medicamentosconsulta m ON pr.id_medicamentosconsulta = m.idMedicamento
    WHERE
        p.cpf = cpf;
END//
DELIMITER ;

-- Copiando estrutura para tabela bdclinicapi.efeitoscolaterais
CREATE TABLE IF NOT EXISTS `efeitoscolaterais` (
  `idEfeitosColaterais` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text NOT NULL,
  `pacienteID` int(11) NOT NULL,
  PRIMARY KEY (`idEfeitosColaterais`),
  KEY `pacienteID` (`pacienteID`),
  CONSTRAINT `efeitoscolaterais_ibfk_1` FOREIGN KEY (`pacienteID`) REFERENCES `paciente` (`idPaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bdclinicapi.efeitoscolaterais: ~10 rows (aproximadamente)
INSERT INTO `efeitoscolaterais` (`idEfeitosColaterais`, `descricao`, `pacienteID`) VALUES
	(1, 'Dor de cabeça leve', 7),
	(2, 'Náusea', 3),
	(3, 'Sonolência', 2),
	(4, 'Tontura', 2),
	(5, 'Dor muscular', 3),
	(6, 'Insônia', 9),
	(7, 'Irritação na pele', 2),
	(8, 'Dor abdominal', 4),
	(9, 'Perda de apetite', 2),
	(10, 'Boca seca', 7);

-- Copiando estrutura para tabela bdclinicapi.imagem
CREATE TABLE IF NOT EXISTS `imagem` (
  `idImg` int(11) NOT NULL AUTO_INCREMENT,
  `caminhoArquivo` varchar(255) NOT NULL,
  `pacienteID` int(11) DEFAULT NULL,
  `medicoID` int(20) DEFAULT NULL,
  PRIMARY KEY (`idImg`),
  KEY `pacienteID` (`pacienteID`),
  KEY `medicoID` (`medicoID`),
  CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`pacienteID`) REFERENCES `paciente` (`idPaciente`),
  CONSTRAINT `imagem_ibfk_2` FOREIGN KEY (`medicoID`) REFERENCES `medico` (`numCRM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bdclinicapi.imagem: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela bdclinicapi.medicamentosconsulta
CREATE TABLE IF NOT EXISTS `medicamentosconsulta` (
  `idMedicamento` int(11) NOT NULL AUTO_INCREMENT,
  `nomeMedicamento` varchar(255) NOT NULL,
  `fabricante` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `uso` text NOT NULL,
  PRIMARY KEY (`idMedicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bdclinicapi.medicamentosconsulta: ~182 rows (aproximadamente)
INSERT INTO `medicamentosconsulta` (`idMedicamento`, `nomeMedicamento`, `fabricante`, `tipo`, `uso`) VALUES
	(1, 'Dipirona', 'Genérico', 'Analgésico', 'Dor de cabeça, febre, dor muscular'),
	(2, 'Paracetamol', 'Genérico', 'Analgésico', 'Dor de cabeça, febre'),
	(3, 'Ibuprofeno', 'Genérico', 'Anti-inflamatório', 'Dor muscular, inflamação'),
	(4, 'Omeprazol', 'Genérico', 'Inibidor de bomba de prótons', 'Refluxo ácido, úlcera péptica'),
	(5, 'Amoxicilina', 'Genérico', 'Antibiótico', 'Infecções bacterianas, sinusite'),
	(6, 'Dexametasona', 'Genérico', 'Corticosteroide', 'Inflamações, alergias'),
	(7, 'Cloridrato de Ciprofloxacino', 'Genérico', 'Antibiótico', 'Infecções bacterianas, cistite'),
	(8, 'Dipirona Sódica + Cafeína', 'Genérico', 'Analgésico', 'Dor de cabeça, enxaqueca'),
	(9, 'Cetoprofeno', 'Genérico', 'Anti-inflamatório', 'Dor muscular, inflamação'),
	(10, 'Cloridrato de Tramadol', 'Genérico', 'Analgésico opioide', 'Dor moderada a severa'),
	(11, 'Ranitidina', 'Genérico', 'Antagonista dos receptores H2', 'Úlcera péptica, refluxo ácido'),
	(12, 'Azitromicina', 'Genérico', 'Antibiótico', 'Infecções respiratórias, sinusite'),
	(13, 'Dipirona Sódica', 'Genérico', 'Analgésico', 'Dor de cabeça, febre'),
	(14, 'Prednisona', 'Genérico', 'Corticosteroide', 'Inflamações, alergias'),
	(15, 'Cefalexina', 'Genérico', 'Antibiótico', 'Infecções bacterianas, infecções de pele'),
	(16, 'Metformina', 'Genérico', 'Hipoglicemiante', 'Diabetes tipo 2'),
	(17, 'Sinvastatina', 'Genérico', 'Estatina', 'Colesterol alto, prevenção de doenças cardiovasculares'),
	(18, 'Losartana Potássica', 'Genérico', 'Bloqueador do receptor de angiotensina II', 'Hipertensão arterial, insuficiência cardíaca'),
	(19, 'Hidroclorotiazida', 'Genérico', 'Diurético', 'Hipertensão arterial, edema'),
	(20, 'Loratadina', 'Genérico', 'Antialérgico', 'Rinite alérgica, urticária'),
	(21, 'Enalapril', 'Genérico', 'Inibidor da enzima conversora de angiotensina (IECA)', 'Hipertensão arterial, insuficiência cardíaca'),
	(22, 'Diclofenaco Sódico', 'Genérico', 'Anti-inflamatório não esteroide (AINE)', 'Dor muscular, inflamação'),
	(23, 'Metronidazol', 'Genérico', 'Antibiótico', 'Infecções bacterianas, infecções parasitárias'),
	(24, 'Nimesulida', 'Genérico', 'Anti-inflamatório não esteroide (AINE)', 'Dor leve a moderada, inflamação'),
	(25, 'Cloridrato de Sertralina', 'Genérico', 'Inibidor seletivo da recaptação de serotonina (ISRS)', 'Depressão, transtorno obsessivo-compulsivo (TOC)'),
	(26, 'Levotiroxina Sódica', 'Genérico', 'Hormônio da tireoide', 'Hipotireoidismo'),
	(27, 'Dextrometorfano', 'Genérico', 'Antitussígeno', 'Tosse seca'),
	(28, 'Lansoprazol', 'Genérico', 'Inibidor de bomba de prótons', 'Refluxo ácido, úlcera péptica'),
	(29, 'Ceftriaxona', 'Genérico', 'Antibiótico', 'Infecções bacterianas graves, meningite'),
	(30, 'Fluconazol', 'Genérico', 'Antifúngico', 'Infecções fúngicas, candidíase'),
	(31, 'Bromoprida', 'Genérico', 'Antiemético', 'Náuseas, vômitos'),
	(32, 'Sulfato de Salbutamol', 'Genérico', 'Broncodilatador', 'Asma, doença pulmonar obstrutiva crônica (DPOC)'),
	(33, 'Olanzapina', 'Genérico', 'Antipsicótico', 'Esquizofrenia, transtorno bipolar'),
	(34, 'Pantoprazol', 'Genérico', 'Inibidor de bomba de prótons', 'Refluxo ácido, úlcera péptica'),
	(35, 'Amitriptilina', 'Genérico', 'Antidepressivo tricíclico', 'Depressão, dor crônica'),
	(36, 'Ciprofloxacino', 'Genérico', 'Antibiótico', 'Infecções bacterianas, cistite'),
	(37, 'Cloridrato de Sibutramina', 'Genérico', 'Inibidor de recaptação de serotonina e noradrenalina (IRSN)', 'Obesidade'),
	(38, 'Diclofenaco Potássico', 'Genérico', 'Anti-inflamatório não esteroide (AINE)', 'Dor muscular, inflamação'),
	(39, 'Budesonida', 'Genérico', 'Corticosteroide', 'Asma, doença pulmonar obstrutiva crônica (DPOC)'),
	(40, 'Carbonato de Lítio', 'Genérico', 'Estabilizador de humor', 'Transtorno bipolar'),
	(41, 'Cloridrato de Ciclobenzaprina', 'Genérico', 'Relaxante muscular', 'Espasmos musculares, dor lombar'),
	(42, 'Candesartana Cilexetila', 'Genérico', 'Bloqueador do receptor de angiotensina II', 'Hipertensão arterial, insuficiência cardíaca'),
	(43, 'Escitalopram', 'Genérico', 'Inibidor seletivo da recaptação de serotonina (ISRS)', 'Depressão, transtorno de ansiedade generalizada (TAG)'),
	(44, 'Rosuvastatina Cálcica', 'Genérico', 'Estatina', 'Colesterol alto, prevenção de doenças cardiovasculares'),
	(45, 'Sulfato de Neomicina', 'Genérico', 'Antibiótico', 'Infecções bacterianas, queimaduras'),
	(46, 'Risperidona', 'Genérico', 'Antipsicótico', 'Esquizofrenia, transtorno bipolar'),
	(47, 'Cloridrato de Cetirizina', 'Genérico', 'Antialérgico', 'Rinite alérgica, urticária'),
	(48, 'Cloridrato de Paroxetina', 'Genérico', 'Inibidor seletivo da recaptação de serotonina (ISRS)', 'Depressão, transtorno de ansiedade'),
	(49, 'Valsartana', 'Genérico', 'Bloqueador do receptor de angiotensina II', 'Hipertensão arterial, insuficiência cardíaca'),
	(50, 'Cefuroxima Axetila', 'Genérico', 'Antibiótico', 'Infecções bacterianas, sinusite'),
	(51, 'Fexofenadina', 'Genérico', 'Antialérgico', 'Rinite alérgica, urticária'),
	(52, 'Nifedipino', 'Genérico', 'Bloqueador dos canais de cálcio', 'Hipertensão arterial, angina'),
	(53, 'Metronidazol + Nistatina', 'Genérico', 'Antibiótico e antifúngico', 'Infecções bacterianas e fúngicas, vaginite'),
	(54, 'Cetotifeno', 'Genérico', 'Antialérgico', 'Asma, rinite alérgica'),
	(55, 'Drospirenona + Etinilestradiol', 'Genérico', 'Anticoncepcional oral combinado', 'Contracepção'),
	(56, 'Sulfametoxazol + Trimetoprima', 'Genérico', 'Antibiótico', 'Infecções bacterianas, infecções do trato urinário'),
	(57, 'Atenolol', 'Genérico', 'Bloqueador beta-adrenérgico', 'Hipertensão arterial, angina'),
	(58, 'Amoxicilina + Clavulanato de Potássio', 'Genérico', 'Antibiótico', 'Infecções bacterianas, sinusite'),
	(59, 'Rivotril', 'Genérico', 'Benzodiazepínico', 'Ansiedade, epilepsia'),
	(60, 'Clobetasol', 'Genérico', 'Corticosteroide', 'Dermatite, psoríase'),
	(61, 'Cloridrato de Metadona', 'Genérico', 'Analgésico opioide', 'Dor moderada a severa, terapia de substituição de opioides'),
	(62, 'Fluoxetina', 'Genérico', 'Inibidor seletivo da recaptação de serotonina (ISRS)', 'Depressão, transtorno obsessivo-compulsivo (TOC)'),
	(63, 'Sinvastatina + Ezetimiba', 'Genérico', 'Estatina + inibidor da absorção do colesterol', 'Colesterol alto'),
	(64, 'Levoletiracetam', 'Genérico', 'Anticonvulsivante', 'Epilepsia'),
	(65, 'Doxiciclina', 'Genérico', 'Antibiótico', 'Infecções bacterianas, acne'),
	(66, 'Telmisartana', 'Genérico', 'Bloqueador do receptor de angiotensina II', 'Hipertensão arterial, insuficiência cardíaca'),
	(67, 'Furosemida', 'Genérico', 'Diurético de alça', 'Hipertensão arterial, edema'),
	(68, 'Cloridrato de Fluoxetina', 'Genérico', 'Inibidor seletivo da recaptação de serotonina (ISRS)', 'Depressão, transtorno obsessivo-compulsivo (TOC)'),
	(69, 'Loperamida', 'Genérico', 'Antidiarreico', 'Diarreia'),
	(70, 'Cetoprofeno', 'Genérico', 'Anti-inflamatório não esteroide (AINE)', 'Dor muscular, inflamação'),
	(71, 'Nimesulida + Cetoprofeno', 'Genérico', 'Anti-inflamatório não esteroide (AINE)', 'Dor muscular, inflamação'),
	(72, 'Sinvastatina + Atorvastatina', 'Genérico', 'Estatina', 'Colesterol alto'),
	(73, 'Cloridrato de Betaxolol', 'Genérico', 'Bloqueador beta-adrenérgico', 'Glaucoma, hipertensão arterial'),
	(74, 'Cloridrato de Bupropiona', 'Genérico', 'Antidepressivo atípico', 'Depressão, cessação do tabagismo'),
	(75, 'Hidroxicloroquina', 'Genérico', 'Agente antimalárico', 'Malária, artrite reumatoide'),
	(76, 'Cetoprofeno + Cloridrato de Ciclobenzaprina', 'Genérico', 'Anti-inflamatório + relaxante muscular', 'Dor muscular, inflamação'),
	(77, 'Clonazepam', 'Genérico', 'Benzodiazepínico', 'Ansiedade, distúrbios do sono'),
	(78, 'Cloridrato de Tansulosina', 'Genérico', 'Bloqueador alfa-adrenérgico', 'Hiperplasia prostática benigna'),
	(79, 'Cloridrato de Fluoxetina + Cloridrato de Bupropiona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina + antidepressivo atípico', 'Depressão, transtorno depressivo maior'),
	(80, 'Sinvastatina + Rosuvastatina', 'Genérico', 'Estatina', 'Colesterol alto'),
	(81, 'Cloridrato de Metformina', 'Genérico', 'Hipoglicemiante', 'Diabetes tipo 2'),
	(82, 'Cloridrato de Fexofenadina', 'Genérico', 'Antialérgico', 'Rinite alérgica, urticária'),
	(83, 'Miconazol', 'Genérico', 'Antifúngico', 'Infecções fúngicas, candidíase'),
	(84, 'Difosfato de Cloroquina', 'Genérico', 'Agente antimalárico', 'Malária, artrite reumatoide'),
	(85, 'Cloridrato de Metoclopramida', 'Genérico', 'Antiemético', 'Náuseas, vômitos'),
	(86, 'Cloridrato de Nortriptilina', 'Genérico', 'Antidepressivo tricíclico', 'Depressão, dor crônica'),
	(87, 'Paracetamol + Cafeína', 'Genérico', 'Analgésico', 'Dor de cabeça, febre'),
	(88, 'Cloridrato de Tiamina', 'Genérico', 'Vitamina B1', 'Deficiência de tiamina'),
	(89, 'Cloridrato de Donepezila', 'Genérico', 'Inibidor da acetilcolinesterase', 'Doença de Alzheimer, demência'),
	(90, 'Cloridrato de Metadona + Cloridrato de Ciclobenzaprina', 'Genérico', 'Analgésico opioide + relaxante muscular', 'Dor moderada a severa, espasmos musculares'),
	(91, 'Cloridrato de Ciclobenzaprina + Diclofenaco Sódico', 'Genérico', 'Relaxante muscular + anti-inflamatório não esteroide (AINE)', 'Espasmos musculares, inflamação'),
	(92, 'Carbonato de Cálcio + Colecalciferol', 'Genérico', 'Suplemento de cálcio e vitamina D', 'Deficiência de cálcio, prevenção de osteoporose'),
	(93, 'Cloridrato de Amiodarona', 'Genérico', 'Antiarrítmico', 'Arritmias cardíacas, fibrilação atrial'),
	(94, 'Cloridrato de Loperamida', 'Genérico', 'Antidiarreico', 'Diarreia'),
	(95, 'Cloridrato de Ranitidina', 'Genérico', 'Antagonista dos receptores H2', 'Úlcera péptica, refluxo ácido'),
	(96, 'Cloridrato de Hidroxizina', 'Genérico', 'Antialérgico', 'Urticária, dermatite'),
	(97, 'Cloridrato de Ciclobenzaprina + Paracetamol', 'Genérico', 'Relaxante muscular + analgésico', 'Espasmos musculares, dor'),
	(98, 'Levocetirizina', 'Genérico', 'Antialérgico', 'Rinite alérgica, urticária'),
	(99, 'Cloridrato de Bupropiona + Naltrexona', 'Genérico', 'Antidepressivo atípico + antagonista dos receptores opioides', 'Obesidade, cessação do tabagismo'),
	(100, 'Carbonato de Lítio + Cloreto de Potássio', 'Genérico', 'Estabilizador de humor + suplemento de potássio', 'Transtorno bipolar, deficiência de potássio'),
	(101, 'Cloridrato de Amitriptilina + Cloridrato de Amitriptilina + Cloridrato de Clorpromazina', 'Genérico', 'Analgésico opioide + antidepressivo tricíclico + neuroléptico', 'Dor neuropática, depressão resistente ao tratamento'),
	(102, 'Cloridrato de Metadona + Naloxona', 'Genérico', 'Analgésico opioide + antagonista dos receptores opioides', 'Dor moderada a severa, terapia de substituição de opioides'),
	(103, 'Cloridrato de Benazepril', 'Genérico', 'Inibidor da enzima conversora de angiotensina (IECA)', 'Hipertensão arterial, insuficiência cardíaca'),
	(104, 'Cloridrato de Ondansetrona', 'Genérico', 'Antiemético', 'Náuseas, vômitos'),
	(105, 'Cloridrato de Tramadol + Paracetamol', 'Genérico', 'Analgésico opioide + analgésico', 'Dor moderada a severa'),
	(106, 'Sinvastatina + Losartana Potássica', 'Genérico', 'Estatina + bloqueador do receptor de angiotensina II', 'Colesterol alto, hipertensão arterial'),
	(107, 'Cloridrato de Lidocaína', 'Genérico', 'Anestésico local', 'Anestesia tópica, procedimentos médicos'),
	(108, 'Cloridrato de Venlafaxina', 'Genérico', 'Inibidor seletivo da recaptação de serotonina e noradrenalina (IRSN)', 'Depressão, transtorno de ansiedade generalizada (TAG)'),
	(109, 'Brometo de Otilônio', 'Genérico', 'Antiespasmódico', 'Síndrome do intestino irritável, cólicas abdominais'),
	(110, 'Cloridrato de Doxiciclina', 'Genérico', 'Antibiótico', 'Infecções bacterianas, acne'),
	(111, 'Cloridrato de Desloratadina', 'Genérico', 'Antialérgico', 'Rinite alérgica, urticária'),
	(112, 'Cloridrato de Dicloridrato de Cetotifeno', 'Genérico', 'Antialérgico', 'Asma, rinite alérgica'),
	(113, 'Sulfato de Neomicina + Bacitracina', 'Genérico', 'Antibiótico tópico', 'Feridas, infecções cutâneas'),
	(114, 'Cloridrato de Labetalol', 'Genérico', 'Bloqueador alfa e beta-adrenérgico', 'Hipertensão arterial, emergência hipertensiva'),
	(115, 'Cloridrato de Duloxetina', 'Genérico', 'Inibidor seletivo da recaptação de serotonina e noradrenalina (IRSN)', 'Depressão, transtorno de ansiedade generalizada (TAG)'),
	(116, 'Cloridrato de Donepezila + Cloridrato de Memantina', 'Genérico', 'Inibidor da acetilcolinesterase + antagonista do receptor NMDA', 'Doença de Alzheimer, demência'),
	(117, 'Cloridrato de Meclizina', 'Genérico', 'Anti-histamínico', 'Náuseas, vertigem'),
	(118, 'Brometo de Ipratrópio', 'Genérico', 'Broncodilatador', 'Doença pulmonar obstrutiva crônica (DPOC), bronquite'),
	(119, 'Cloridrato de Dapagliflozina', 'Genérico', 'Inibidor do cotransportador de sódio-glicose 2 (SGLT2)', 'Diabetes tipo 2'),
	(120, 'Cloridrato de Topiramato', 'Genérico', 'Anticonvulsivante', 'Epilepsia, enxaqueca'),
	(121, 'Cloridrato de Fluoxetina + Cloridrato de Bupropiona + Naltrexona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina + antidepressivo atípico + antagonista dos receptores opioides', 'Obesidade, depressão'),
	(122, 'Cloridrato de Venlafaxina + Cloridrato de Bupropiona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina e noradrenalina (IRSN) + antidepressivo atípico', 'Depressão, transtorno de ansiedade generalizada (TAG)'),
	(123, 'Cloridrato de Betametasona', 'Genérico', 'Corticosteroide', 'Inflamações, alergias'),
	(124, 'Sulfato de Condroitina + Sulfato de Glucosamina', 'Genérico', 'Suplemento para saúde das articulações', 'Osteoartrite, dores articulares'),
	(125, 'Cloridrato de Tansulosina + Dutasterida', 'Genérico', 'Bloqueador alfa-adrenérgico + inibidor da 5-alfa-redutase', 'Hiperplasia prostática benigna'),
	(126, 'Cloridrato de Memantina', 'Genérico', 'Antagonista do receptor NMDA', 'Doença de Alzheimer, demência'),
	(127, 'Cloridrato de Sertralina + Cloridrato de Bupropiona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina + antidepressivo atípico', 'Depressão, transtorno de ansiedade generalizada (TAG)'),
	(128, 'Cloridrato de Dapagliflozina + Cloridrato de Metformina', 'Genérico', 'Inibidor do cotransportador de sódio-glicose 2 (SGLT2) + hipoglicemiante', 'Diabetes tipo 2'),
	(129, 'Cloridrato de Sotalol', 'Genérico', 'Bloqueador beta-adrenérgico', 'Arritmias cardíacas, taquicardia'),
	(130, 'Cloridrato de Metoclopramida + Dimeticona', 'Genérico', 'Antiêmético + antiflatulento', 'Náuseas, flatulência'),
	(131, 'Cloridrato de Benzonatato', 'Genérico', 'Antitussígeno', 'Tosse'),
	(132, 'Cloridrato de Mebeverina', 'Genérico', 'Antiespasmódico', 'Síndrome do intestino irritável, cólicas abdominais'),
	(133, 'Cloridrato de Duloxetina + Cloridrato de Bupropiona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina e noradrenalina (IRSN) + antidepressivo atípico', 'Depressão, transtorno de ansiedade generalizada (TAG)'),
	(134, 'Cloridrato de Terbinafina', 'Genérico', 'Antifúngico', 'Infecções fúngicas, pé de atleta'),
	(135, 'Cloridrato de Metformina + Cloridrato de Saxagliptina', 'Genérico', 'Hipoglicemiante', 'Diabetes tipo 2'),
	(136, 'Cloridrato de Pramipexol', 'Genérico', 'Agonista dopaminérgico', 'Doença de Parkinson, síndrome das pernas inquietas'),
	(137, 'Carbonato de Cálcio + Vitamina D3', 'Genérico', 'Suplemento de cálcio e vitamina D', 'Deficiência de cálcio, prevenção de osteoporose'),
	(138, 'Cloridrato de Hidroxizina + Cloridrato de Ranitidina', 'Genérico', 'Antialérgico + antagonista dos receptores H2', 'Urticária, refluxo ácido'),
	(139, 'Cloridrato de Metilfenidato', 'Genérico', 'Estimulante do sistema nervoso central', 'Transtorno do déficit de atenção e hiperatividade (TDAH)'),
	(140, 'Cloridrato de Metoclopramida + Dimeticona + Hioscina', 'Genérico', 'Antiêmético + antiflatulento + antiespasmódico', 'Náuseas, flatulência, cólicas abdominais'),
	(141, 'Cloridrato de Venlafaxina + Cloridrato de Bupropiona + Naltrexona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina e noradrenalina (IRSN) + antidepressivo atípico + antagonista dos receptores opioides', 'Depressão, transtorno de ansiedade generalizada (TAG), obesidade'),
	(142, 'Cloridrato de Amiodarona + Sinvastatina', 'Genérico', 'Antiarrítmico + estatina', 'Arritmias cardíacas, colesterol alto'),
	(143, 'Cloridrato de Fexofenadina + Cloridrato de Pseudoefedrina', 'Genérico', 'Antialérgico + descongestionante', 'Rinite alérgica, congestão nasal'),
	(144, 'Cloridrato de Sertralina + Cloridrato de Bupropiona + Naltrexona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina + antidepressivo atípico + antagonista dos receptores opioides', 'Depressão, transtorno de ansiedade generalizada (TAG), obesidade'),
	(145, 'Cloridrato de Pramipexol + Cloridrato de Carbidopa + Levodopa', 'Genérico', 'Agonista dopaminérgico + inibidor da descarboxilase da dopa + precursor da dopamina', 'Doença de Parkinson'),
	(146, 'Cloridrato de Trazodona', 'Genérico', 'Antidepressivo', 'Depressão, transtorno de ansiedade'),
	(147, 'Cloridrato de Metformina + Vildagliptina', 'Genérico', 'Hipoglicemiante', 'Diabetes tipo 2'),
	(148, 'Cloridrato de Amitriptilina + Cloridrato de Clorpromazina + Cloridrato de Levomepromazina', 'Genérico', 'Antidepressivo tricíclico + neuroléptico fenotiazínico', 'Depressão, esquizofrenia'),
	(149, 'Cloridrato de Mirtazapina', 'Genérico', 'Antidepressivo', 'Depressão, transtorno de ansiedade'),
	(150, 'Cloridrato de Tolterodina', 'Genérico', 'Antimuscarínico', 'Bexiga hiperativa, incontinência urinária'),
	(151, 'Cloridrato de Venlafaxina + Cloridrato de Bupropiona + Naltrexona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina e noradrenalina (IRSN) + antidepressivo atípico + antagonista dos receptores opioides', 'Depressão, transtorno de ansiedade generalizada (TAG), obesidade'),
	(152, 'Cloridrato de Tansulosina + Dutasterida', 'Genérico', 'Bloqueador alfa-adrenérgico + inibidor da 5-alfa-redutase', 'Hiperplasia prostática benigna'),
	(153, 'Cloridrato de Trazodona + Cloridrato de Nortriptilina', 'Genérico', 'Antidepressivo + antidepressivo tricíclico', 'Depressão, transtorno de ansiedade'),
	(154, 'Cloridrato de Terazosina', 'Genérico', 'Bloqueador alfa-adrenérgico', 'Hipertensão arterial, hiperplasia prostática benigna'),
	(155, 'Cloridrato de Mirtazapina + Cloridrato de Venlafaxina', 'Genérico', 'Antidepressivo + inibidor seletivo da recaptação de serotonina e noradrenalina (IRSN)', 'Depressão, transtorno de ansiedade'),
	(156, 'Cloridrato de Ranolazina', 'Genérico', 'Inibidor da corrente de sódio tardia', 'Angina'),
	(157, 'Cloridrato de Budesonida + Formoterol', 'Genérico', 'Corticosteroide + agonista beta-2 adrenérgico', 'Asma, doença pulmonar obstrutiva crônica (DPOC)'),
	(158, 'Cloridrato de Sildenafila', 'Genérico', 'Inibidor da fosfodiesterase tipo 5 (PDE5)', 'Disfunção erétil'),
	(159, 'Cloridrato de Sertralina + Cloridrato de Bupropiona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina + antidepressivo atípico', 'Depressão, transtorno de ansiedade generalizada (TAG)'),
	(160, 'Cloridrato de Tansulosina + Finasterida', 'Genérico', 'Bloqueador alfa-adrenérgico + inibidor da 5-alfa-redutase', 'Hiperplasia prostática benigna'),
	(161, 'Cloridrato de Sildenafila + Tadalafila', 'Genérico', 'Inibidor da fosfodiesterase tipo 5 (PDE5)', 'Disfunção erétil'),
	(162, 'Cloridrato de Ranitidina + Oxetacaina', 'Genérico', 'Antagonista dos receptores H2 + anestésico local', 'Úlcera péptica, dor abdominal'),
	(163, 'Cloridrato de Tansulosina + Dutasterida + Sulfato de Alfa Tocoferol', 'Genérico', 'Bloqueador alfa-adrenérgico + inibidor da 5-alfa-redutase + vitamina E', 'Hiperplasia prostática benigna'),
	(164, 'Cloridrato de Ranitidina + Simeticona', 'Genérico', 'Antagonista dos receptores H2 + antiflatulento', 'Úlcera péptica, flatulência'),
	(165, 'Cloridrato de Metoclopramida + Dimeticona + Trimebutina', 'Genérico', 'Antiêmético + antiflatulento + antiespasmódico', 'Náuseas, flatulência, cólicas abdominais'),
	(166, 'Cloridrato de Sertralina + Cloridrato de Bupropiona + Naltrexona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina + antidepressivo atípico + antagonista dos receptores opioides', 'Depressão, transtorno de ansiedade generalizada (TAG), obesidade'),
	(167, 'Cloridrato de Tamsulosina + Dutasterida', 'Genérico', 'Bloqueador alfa-adrenérgico + inibidor da 5-alfa-redutase', 'Hiperplasia prostática benigna'),
	(168, 'Cloridrato de Ranitidina + Lidocaína', 'Genérico', 'Antagonista dos receptores H2 + anestésico local', 'Úlcera péptica, dor abdominal'),
	(169, 'Cloridrato de Nortriptilina + Cloridrato de Amitriptilina', 'Genérico', 'Antidepressivo tricíclico', 'Depressão, dor crônica'),
	(170, 'Cloridrato de Prazosina', 'Genérico', 'Bloqueador alfa-adrenérgico', 'Hipertensão arterial, hiperplasia prostática benigna'),
	(171, 'Cloridrato de Sildenafila + Dapoxetina', 'Genérico', 'Inibidor da fosfodiesterase tipo 5 (PDE5) + inibidor seletivo da recaptação de serotonina (ISRS)', 'Disfunção erétil, ejaculação precoce'),
	(172, 'Cloridrato de Sertralina + Cloridrato de Bupropiona + Naltrexona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina + antidepressivo atípico + antagonista dos receptores opioides', 'Depressão, transtorno de ansiedade generalizada (TAG), obesidade'),
	(173, 'Cloridrato de Sertralina + Cloridrato de Bupropiona', 'Genérico', 'Inibidor seletivo da recaptação de serotonina + antidepressivo atípico', 'Depressão, transtorno de ansiedade generalizada (TAG)'),
	(174, 'Cloridrato de Ranitidina + Dimeticona', 'Genérico', 'Antagonista dos receptores H2 + antiflatulento', 'Úlcera péptica, flatulência'),
	(175, 'Cloridrato de Sildenafil + Dapoxetine', 'Genérico', 'Inibidor da fosfodiesterase tipo 5 (PDE5) + inibidor seletivo da recaptação de serotonina (ISRS)', 'Disfunção erétil, ejaculação precoce'),
	(176, 'Cloridrato de Sildenafil + Tadalafil', 'Genérico', 'Inibidor da fosfodiesterase tipo 5 (PDE5)', 'Disfunção erétil'),
	(177, 'Cloridrato de Ranitidina + Dimeticona + Omeprazol', 'Genérico', 'Antagonista dos receptores H2 + antiflatulento + inibidor de bomba de prótons', 'Úlcera péptica, flatulência, refluxo ácido'),
	(178, 'Cloridrato de Tansulosina + Dutasterida + Sulfato de Alfa Tocoferol', 'Genérico', 'Bloqueador alfa-adrenérgico + inibidor da 5-alfa-redutase + vitamina E', 'Hiperplasia prostática benigna'),
	(179, 'Cloridrato de Omeprazol + Bicarbonato de Sódio', 'Genérico', 'Inibidor de bomba de prótons + antiácido', 'Refluxo ácido, úlcera péptica'),
	(180, 'Cloridrato de Terbinafina + Cloridrato de Ciclopirox', 'Genérico', 'Antifúngico tópico', 'Micose, onicomicose'),
	(181, 'Cloridrato de Terazosina + Finasterida', 'Genérico', 'Bloqueador alfa-adrenérgico + inibidor da 5-alfa-redutase', 'Hipertensão arterial, hiperplasia prostática benigna'),
	(182, 'dipirona ab1', 'Marcelin', 'Analgésico', 'dor');

-- Copiando estrutura para tabela bdclinicapi.medico
CREATE TABLE IF NOT EXISTS `medico` (
  `numCRM` int(20) NOT NULL,
  `nomeCompleto` varchar(150) NOT NULL,
  `dataNascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `especialidade` varchar(255) NOT NULL,
  `telefone` varchar(24) NOT NULL,
  PRIMARY KEY (`numCRM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bdclinicapi.medico: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela bdclinicapi.paciente
CREATE TABLE IF NOT EXISTS `paciente` (
  `idPaciente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cep` varchar(14) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `rua` varchar(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `numero` int(5) NOT NULL,
  `planoSaude` varchar(50) NOT NULL,
  `tipoPessoa` varchar(20) NOT NULL,
  PRIMARY KEY (`idPaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bdclinicapi.paciente: ~10 rows (aproximadamente)
INSERT INTO `paciente` (`idPaciente`, `nome`, `sobrenome`, `cpf`, `cep`, `estado`, `rua`, `cidade`, `numero`, `planoSaude`, `tipoPessoa`) VALUES
	(1, 'João', 'Silva', '123.456.789-00', '12345-678', 'São Paulo', 'Rua das Flores', 'São Paulo', 123, 'Bradesco Saúde', 'Física'),
	(2, 'Maria', 'Santos', '987.654.321-00', '54321-876', 'Rio de Janeiro', 'Avenida das Palmeiras', 'Rio de Janeiro', 456, 'Unimed', 'Física'),
	(3, 'José', 'Oliveira', '456.789.123-00', '98765-432', 'Minas Gerais', 'Rua dos Pinheiros', 'Belo Horizonte', 789, 'Amil', 'Física'),
	(4, 'Ana', 'Costa', '654.321.987-00', '87654-321', 'Bahia', 'Avenida dos Girassóis', 'Salvador', 987, 'SulAmérica', 'Física'),
	(5, 'Pedro', 'Pereira', '321.654.987-00', '76543-210', 'Santa Catarina', 'Rua das Margaridas', 'Florianópolis', 654, 'Golden Cross', 'Física'),
	(6, 'Mariana', 'Rodrigues', '789.123.456-00', '23456-789', 'Paraná', 'Avenida dos Lírios', 'Curitiba', 321, 'Hapvida', 'Física'),
	(7, 'Carlos', 'Martins', '234.567.891-00', '65432-109', 'Rio Grande do Sul', 'Rua das Violetas', 'Porto Alegre', 876, 'Unimed', 'Física'),
	(8, 'Amanda', 'Fernandes', '890.123.456-00', '87654-321', 'Ceará', 'Avenida das Orquídeas', 'Fortaleza', 543, 'Amil', 'Física'),
	(9, 'Luiz', 'Gomes', '567.890.123-00', '34567-890', 'Pernambuco', 'Rua dos Cravos', 'Recife', 210, 'SulAmérica', 'Física'),
	(10, 'Fernanda', 'Almeida', '012.345.678-00', '98765-432', 'Goiás', 'Avenida das Tulipas', 'Goiânia', 789, 'Bradesco Saúde', 'Física');

-- Copiando estrutura para procedure bdclinicapi.prescrever_medicacao
DELIMITER //
CREATE PROCEDURE `prescrever_medicacao`(
    IN cpf_paciente VARCHAR(13),
    IN id_medicacao INT,
    IN dosagem VARCHAR(50),
    IN data_prescricao DATE
)
BEGIN 
    DECLARE paciente_id INT;
    
    -- Consultar o ID do paciente com base no CPF fornecido
    SELECT id_paciente INTO paciente_id FROM Pacientes WHERE cpf = cpf_paciente;
    
    -- Verificar se o paciente existe
    IF paciente_id IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Paciente não encontrado';
    ELSE
        -- Inserir a prescrição na tabela de prescrições
        INSERT INTO Prescricoes (id_paciente, id_medicacao, dosagem, data_prescricao)
        VALUES (paciente_id, id_medicacao, dosagem, data_prescricao);
        
        SELECT 'Prescrição realizada com sucesso' AS mensagem;
    END IF;
END//
DELIMITER ;

-- Copiando estrutura para tabela bdclinicapi.prescricao
CREATE TABLE IF NOT EXISTS `prescricao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `id_medicamentosconsulta` int(11) NOT NULL,
  `data_prescricao` timestamp NOT NULL DEFAULT current_timestamp(),
  `duracao` int(11) NOT NULL,
  `dosagem` varchar(50) NOT NULL,
  `instrucao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_medicamentosconsulta` (`id_medicamentosconsulta`),
  CONSTRAINT `prescricao_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`idPaciente`),
  CONSTRAINT `prescricao_ibfk_2` FOREIGN KEY (`id_medicamentosconsulta`) REFERENCES `medicamentosconsulta` (`idMedicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bdclinicapi.prescricao: ~10 rows (aproximadamente)
INSERT INTO `prescricao` (`id`, `id_paciente`, `id_medicamentosconsulta`, `data_prescricao`, `duracao`, `dosagem`, `instrucao`) VALUES
	(1, 2, 5, '2024-05-13 15:28:53', 10, '2 comprimidos ao dia', 'Tomar de 8 em 8 horas'),
	(2, 1, 4, '2024-05-13 15:28:53', 5, '1 comprimido ao dia', 'Tomar pela manhã'),
	(3, 3, 1, '2024-05-13 15:28:53', 15, '1 comprimido antes de dormir', 'Tomar com água'),
	(4, 4, 2, '2024-05-13 15:28:53', 7, '1 comprimido duas vezes ao dia', 'Tomar com alimentos'),
	(5, 5, 3, '2024-05-13 15:28:53', 30, '1 comprimido ao dia', 'Tomar com um copo d\'água'),
	(6, 6, 6, '2024-05-13 15:28:53', 3, '2 comprimidos ao dia', 'Tomar após as refeições'),
	(7, 7, 7, '2024-05-13 15:28:53', 20, '1 comprimido ao dia', 'Tomar antes do café da manhã'),
	(8, 8, 8, '2024-05-13 15:28:53', 7, '1 comprimido ao dia', 'Tomar com um copo de leite'),
	(9, 9, 10, '2024-05-13 15:28:53', 14, '1 comprimido antes de dormir', 'Tomar com alimentos'),
	(10, 10, 9, '2024-05-13 15:28:53', 10, '1 comprimido ao dia', 'Tomar com um copo d\'água');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
