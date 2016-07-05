-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 04, 2016 at 09:25 PM
-- Server version: 5.5.48-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vandroiy_sifsc2012`
--

-- --------------------------------------------------------

--
-- Table structure for table `Administrador`
--

DROP TABLE IF EXISTS `Administrador`;
CREATE TABLE IF NOT EXISTS `Administrador` (
  `usuario` varchar(15) NOT NULL,
  `senha` varchar(70) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `endereco` text,
  `email` varchar(30) NOT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Arte`
--

DROP TABLE IF EXISTS `Arte`;
CREATE TABLE IF NOT EXISTS `Arte` (
  `codigo_arte` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_secao` int(11) NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  `titulo` varchar(400) DEFAULT NULL,
  `tipo_obra` varchar(40) DEFAULT NULL,
  `tipo_apresentacao` varchar(40) NOT NULL,
  `descricao` varchar(450) DEFAULT NULL,
  `altura` varchar(6) DEFAULT NULL,
  `largura` varchar(6) DEFAULT NULL,
  `profundidade` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`codigo_arte`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Autor`
--

DROP TABLE IF EXISTS `Autor`;
CREATE TABLE IF NOT EXISTS `Autor` (
  `codigo_autor` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_resumo` int(11) NOT NULL COMMENT 'Codigo para recuperar o resumo deste autor!',
  `nome` varchar(205) DEFAULT NULL,
  `instituicao` varchar(205) NOT NULL,
  `ordem` int(11) NOT NULL COMMENT 'Ordem em que o autor entra na lista de autores',
  PRIMARY KEY (`codigo_autor`),
  UNIQUE KEY `resumo_ordem` (`codigo_resumo`,`ordem`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Avaliacao`
--

DROP TABLE IF EXISTS `Avaliacao`;
CREATE TABLE IF NOT EXISTS `Avaliacao` (
  `codigo_avaliador` int(11) NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  `secao` char(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`codigo_avaliador`,`codigo_evento`,`secao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Avaliador`
--

DROP TABLE IF EXISTS `Avaliador`;
CREATE TABLE IF NOT EXISTS `Avaliador` (
  `codigo_avaliador` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `nome` varchar(205) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(70) NOT NULL,
  `lingua` int(1) DEFAULT '1',
  `nivel` varchar(30) DEFAULT NULL,
  `grupo` varchar(30) DEFAULT NULL,
  `area1` varchar(50) NOT NULL,
  `area2` varchar(50) NOT NULL,
  `subarea` varchar(60) NOT NULL,
  PRIMARY KEY (`codigo_avaliador`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Avalia_Poster`
--

DROP TABLE IF EXISTS `Avalia_Poster`;
CREATE TABLE IF NOT EXISTS `Avalia_Poster` (
  `codigo_pessoa` int(11) NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  `codigo_avaliador1` int(11) NOT NULL DEFAULT '0',
  `codigo_avaliador2` int(11) NOT NULL DEFAULT '0',
  `codigo_poster` varchar(10) NOT NULL,
  `secao` int(2) NOT NULL,
  PRIMARY KEY (`codigo_pessoa`,`codigo_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Avalia_Resumo`
--

DROP TABLE IF EXISTS `Avalia_Resumo`;
CREATE TABLE IF NOT EXISTS `Avalia_Resumo` (
  `codigo_pessoa` int(11) NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  `codigo_avaliador1` int(11) NOT NULL DEFAULT '0',
  `codigo_avaliador2` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo_pessoa`,`codigo_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Backup_Resumo`
--

DROP TABLE IF EXISTS `Backup_Resumo`;
CREATE TABLE IF NOT EXISTS `Backup_Resumo` (
  `codigo_backup` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_resumo` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lingua` int(1) DEFAULT '0',
  `codigo_evento` int(11) NOT NULL,
  `codigo_pessoa` int(11) NOT NULL,
  `tempo` int(3) NOT NULL DEFAULT '0' COMMENT 'Tempo em que o projeto é desenvolvido',
  `ingles` varchar(1) DEFAULT NULL,
  `titulo` varchar(205) NOT NULL,
  `texto` text,
  `kw1` varchar(55) DEFAULT NULL,
  `kw2` varchar(55) DEFAULT NULL,
  `kw3` varchar(55) DEFAULT NULL,
  `tipo_ref1` int(11) DEFAULT NULL,
  `autor1` varchar(205) DEFAULT NULL,
  `titulo1` varchar(205) DEFAULT NULL,
  `info1` text,
  `tipo_ref2` int(11) DEFAULT NULL,
  `autor2` varchar(205) DEFAULT NULL,
  `titulo2` varchar(205) DEFAULT NULL,
  `info2` text,
  `tipo_ref3` int(11) DEFAULT NULL,
  `autor3` varchar(205) DEFAULT NULL,
  `titulo3` varchar(205) DEFAULT NULL,
  `info3` text,
  `email` varchar(100) DEFAULT NULL,
  `autor_principal` int(11) NOT NULL,
  `titulo_html` varchar(500) DEFAULT NULL,
  `autores` text,
  PRIMARY KEY (`codigo_backup`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Calendar`
--

DROP TABLE IF EXISTS `Calendar`;
CREATE TABLE IF NOT EXISTS `Calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_evento` int(11) NOT NULL,
  `aux` int(11) NOT NULL,
  `autor` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `instituicao` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `chamada` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `titulo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `resumo` text COLLATE latin1_general_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `color` varchar(8) COLLATE latin1_general_ci NOT NULL DEFAULT '2',
  `local` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `codigo_barra`
--

DROP TABLE IF EXISTS `codigo_barra`;
CREATE TABLE IF NOT EXISTS `codigo_barra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_evento` int(11) NOT NULL,
  `codigo_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table `Deferimento`
--

DROP TABLE IF EXISTS `Deferimento`;
CREATE TABLE IF NOT EXISTS `Deferimento` (
  `codigo_evento` int(11) NOT NULL,
  `codigo_pessoa` int(11) NOT NULL,
  `codigo_resumo` int(11) NOT NULL DEFAULT '0',
  `codigo_arte` int(11) NOT NULL DEFAULT '0',
  `comentario` text COLLATE latin1_general_ci,
  `adm_usuario` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `adm_tipo` int(1) NOT NULL,
  `desconta_ponto` int(1) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`codigo_evento`,`codigo_pessoa`,`codigo_resumo`,`codigo_arte`,`data`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Evento`
--

DROP TABLE IF EXISTS `Evento`;
CREATE TABLE IF NOT EXISTS `Evento` (
  `codigo_evento` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `data_inicio` varchar(10) NOT NULL,
  `data_fim` varchar(10) NOT NULL,
  `descricao` text NOT NULL,
  `aberto` char(1) NOT NULL,
  `inscricao_aberta` int(11) NOT NULL DEFAULT '0',
  `minicurso_aberto` int(1) NOT NULL DEFAULT '1',
  `submissao_aberta` int(1) NOT NULL DEFAULT '0',
  `resubmissao_aberta` int(1) NOT NULL DEFAULT '0',
  `pesquisa_aberta` int(1) NOT NULL DEFAULT '0',
  `premio_aberto` int(1) NOT NULL DEFAULT '0',
  `avaliacao_aberta` int(1) NOT NULL DEFAULT '0',
  `website` varchar(50) NOT NULL,
  `tag_email` varchar(100) NOT NULL DEFAULT 'SIFSC',
  `assinatura_email` varchar(300) NOT NULL DEFAULT 'Att, comissão organizadora da SIFSC',
  `certificados_disponiveis` int(11) NOT NULL DEFAULT '0',
  `threshold_participacao` float NOT NULL DEFAULT '0',
  `threshold_minicurso` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo_evento`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Inscricao`
--

DROP TABLE IF EXISTS `Inscricao`;
CREATE TABLE IF NOT EXISTS `Inscricao` (
  `codigo_pessoa` int(11) NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  `codigo_resumo` int(11) NOT NULL DEFAULT '0',
  `codigo_resumo_ingles` int(11) NOT NULL DEFAULT '0',
  `codigo_arte` int(11) NOT NULL DEFAULT '0',
  `codigo_secao` int(11) NOT NULL DEFAULT '0',
  `instituicao` varchar(205) DEFAULT NULL,
  `nivel` varchar(65) DEFAULT NULL,
  `curso` varchar(105) DEFAULT NULL,
  `grupo` varchar(60) DEFAULT NULL,
  `subarea` varchar(60) NOT NULL,
  `orientador` varchar(200) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `codigo_barra` varchar(25) DEFAULT NULL,
  `modalidade` varchar(5) NOT NULL DEFAULT '00000',
  `premio` varchar(3) DEFAULT NULL,
  `requer_auxilio` char(1) DEFAULT NULL,
  `codigo_financiadora` int(11) DEFAULT NULL,
  `situacao_deferimento` varchar(10) DEFAULT NULL,
  `situacao_resumo` varchar(10) DEFAULT NULL,
  `situacao_arte` varchar(10) DEFAULT NULL,
  `dia_avaliacao` varchar(3) DEFAULT NULL,
  `nota_final` decimal(6,6) DEFAULT NULL,
  PRIMARY KEY (`codigo_pessoa`,`codigo_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Kits`
--

DROP TABLE IF EXISTS `Kits`;
CREATE TABLE IF NOT EXISTS `Kits` (
  `codigo_pessoa` int(11) NOT NULL,
  `nome` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  `email` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `camiseta` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `tipo_camiseta` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `entrega` int(1) NOT NULL,
  PRIMARY KEY (`codigo_pessoa`,`email`,`codigo_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Log`
--

DROP TABLE IF EXISTS `Log`;
CREATE TABLE IF NOT EXISTS `Log` (
  `codigo_log` int(11) NOT NULL AUTO_INCREMENT,
  `adm_usuario` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  `operacao` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `detalhes` text COLLATE latin1_general_ci NOT NULL,
  `horario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`codigo_log`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Minicurso`
--

DROP TABLE IF EXISTS `Minicurso`;
CREATE TABLE IF NOT EXISTS `Minicurso` (
  `codigo_minicurso` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_evento` int(11) NOT NULL,
  `titulo` varchar(205) DEFAULT NULL,
  `vagas` int(4) DEFAULT NULL,
  `inscritos` int(4) DEFAULT '0',
  `descricao` text,
  `tipo` varchar(20) DEFAULT NULL,
  `responsavel` varchar(205) DEFAULT NULL,
  PRIMARY KEY (`codigo_minicurso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Nota_Resumo`
--

DROP TABLE IF EXISTS `Nota_Resumo`;
CREATE TABLE IF NOT EXISTS `Nota_Resumo` (
  `codigo_pessoa` int(11) NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  `codigo_avaliador` int(11) NOT NULL DEFAULT '0',
  `Q1` decimal(3,1) DEFAULT NULL,
  `Q2` decimal(3,1) DEFAULT NULL,
  `Q3` decimal(3,1) DEFAULT NULL,
  `Q4` decimal(3,1) DEFAULT NULL,
  `Q5` decimal(3,1) DEFAULT NULL,
  `situacao` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo_pessoa`,`codigo_evento`,`codigo_avaliador`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Nota_Resumo_Back`
--

DROP TABLE IF EXISTS `Nota_Resumo_Back`;
CREATE TABLE IF NOT EXISTS `Nota_Resumo_Back` (
  `codigo_pessoa` int(11) NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  `codigo_avaliador` int(11) NOT NULL DEFAULT '0',
  `Q1` decimal(3,1) DEFAULT NULL,
  `Q2` decimal(3,1) DEFAULT NULL,
  `Q3` decimal(3,1) DEFAULT NULL,
  `Q4` decimal(3,1) DEFAULT NULL,
  `Q5` decimal(3,1) DEFAULT NULL,
  `situacao` int(1) NOT NULL DEFAULT '0',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codigo_pessoa`,`codigo_evento`,`codigo_avaliador`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Noticia`
--

DROP TABLE IF EXISTS `Noticia`;
CREATE TABLE IF NOT EXISTS `Noticia` (
  `codigo_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(205) NOT NULL,
  `conteudo` text NOT NULL,
  `autor` varchar(205) NOT NULL,
  `data` date NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  PRIMARY KEY (`codigo_noticia`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipaMinicurso`
--

DROP TABLE IF EXISTS `ParticipaMinicurso`;
CREATE TABLE IF NOT EXISTS `ParticipaMinicurso` (
  `codigo_minicurso` int(11) NOT NULL,
  `codigo_pessoa` int(11) NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  PRIMARY KEY (`codigo_pessoa`,`codigo_evento`,`codigo_minicurso`),
  KEY `codigo_minicurso` (`codigo_minicurso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipanteFrequencia`
--

DROP TABLE IF EXISTS `ParticipanteFrequencia`;
CREATE TABLE IF NOT EXISTS `ParticipanteFrequencia` (
  `codigo_pessoa` int(11) NOT NULL DEFAULT '0',
  `codigo_evento` int(11) NOT NULL,
  `frequencia_palestras` float NOT NULL,
  `frequencia_minicurso` float NOT NULL,
  `frequencia_arte` float NOT NULL DEFAULT '0',
  `frequencia_workshop` float NOT NULL DEFAULT '0',
  `frequencia_oral` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo_pessoa`,`codigo_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipaPremiacao`
--

DROP TABLE IF EXISTS `ParticipaPremiacao`;
CREATE TABLE IF NOT EXISTS `ParticipaPremiacao` (
  `codigo_pessoa` int(11) NOT NULL,
  `codigo_evento` int(11) NOT NULL,
  `dia` int(2) DEFAULT NULL,
  `hora` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codigo_pessoa`,`codigo_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `PesquisaOpiniao`
--

DROP TABLE IF EXISTS `PesquisaOpiniao`;
CREATE TABLE IF NOT EXISTS `PesquisaOpiniao` (
  `codigo_opiniao` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_evento` int(11) NOT NULL,
  `codigo_pessoa` int(11) NOT NULL DEFAULT '0',
  `codigo_avaliador` int(11) NOT NULL DEFAULT '0',
  `Q1_nota` int(2) NOT NULL DEFAULT '0',
  `Q1_comentario` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `Q2_nota` int(2) NOT NULL DEFAULT '0',
  `Q2_comentario` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `Q3_nota` int(2) NOT NULL DEFAULT '0',
  `Q3_comentario` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `Q4_nota` int(2) NOT NULL DEFAULT '0',
  `Q4_comentario` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `Q5_nota` int(2) NOT NULL DEFAULT '0',
  `Q5_comentario` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `Q6_nota` int(2) NOT NULL DEFAULT '0',
  `Q6_comentario` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `Q7_nota` int(2) NOT NULL DEFAULT '0',
  `Q7_comentario` varchar(1000) COLLATE latin1_general_ci DEFAULT NULL,
  `Q8_nota` int(2) NOT NULL DEFAULT '0' COMMENT 'InnEvent',
  `Q8_comentario` varchar(1000) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'InnEvent',
  `codigo_minicurso` int(11) NOT NULL,
  `minicurso_nota` int(2) NOT NULL,
  `minicurso_comment` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`codigo_opiniao`,`codigo_evento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Pessoa`
--

DROP TABLE IF EXISTS `Pessoa`;
CREATE TABLE IF NOT EXISTS `Pessoa` (
  `codigo_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(205) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `email` varchar(105) NOT NULL,
  `senha` varchar(70) NOT NULL,
  `nusp` varchar(10) DEFAULT NULL,
  `endereco` text,
  `rg` varchar(12) DEFAULT NULL,
  `rg_data` varchar(10) DEFAULT NULL,
  `rg_expedidor` varchar(10) DEFAULT NULL,
  `estrangeiro` char(1) DEFAULT NULL,
  `passaporte` varchar(30) DEFAULT NULL,
  `passaporte_validade` varchar(10) DEFAULT NULL,
  `passaporte_data` varchar(10) DEFAULT NULL,
  `passaporte_expedidor` varchar(20) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `agencia_fomento` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codigo_pessoa`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Resumo`
--

DROP TABLE IF EXISTS `Resumo`;
CREATE TABLE IF NOT EXISTS `Resumo` (
  `codigo_resumo` int(11) NOT NULL AUTO_INCREMENT,
  `lingua` int(1) DEFAULT '0',
  `codigo_evento` int(11) NOT NULL,
  `codigo_pessoa` int(11) NOT NULL,
  `tempo` int(3) NOT NULL DEFAULT '0' COMMENT 'Tempo em que o projeto é desenvolvido',
  `ingles` varchar(1) DEFAULT NULL,
  `titulo` varchar(205) NOT NULL,
  `texto` text,
  `kw1` varchar(55) DEFAULT NULL,
  `kw2` varchar(55) DEFAULT NULL,
  `kw3` varchar(55) DEFAULT NULL,
  `tipo_ref1` int(11) DEFAULT NULL,
  `autor1` varchar(205) DEFAULT NULL,
  `titulo1` varchar(205) DEFAULT NULL,
  `info1` text,
  `tipo_ref2` int(11) DEFAULT NULL,
  `autor2` varchar(205) DEFAULT NULL,
  `titulo2` varchar(205) DEFAULT NULL,
  `info2` text,
  `tipo_ref3` int(11) DEFAULT NULL,
  `autor3` varchar(205) DEFAULT NULL,
  `titulo3` varchar(205) DEFAULT NULL,
  `info3` text,
  `email` varchar(100) DEFAULT NULL,
  `autor_principal` int(11) NOT NULL,
  `titulo_html` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`codigo_resumo`),
  UNIQUE KEY `evento_pessoa_ingles` (`codigo_evento`,`codigo_pessoa`,`ingles`),
  KEY `codigo_secao` (`lingua`),
  KEY `autor_principal` (`autor_principal`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SendoModificado`
--

DROP TABLE IF EXISTS `SendoModificado`;
CREATE TABLE IF NOT EXISTS `SendoModificado` (
  `codigo_pessoa` int(11) NOT NULL,
  `adm_usuario` varchar(70) COLLATE latin1_general_ci NOT NULL,
  `horario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `codigo_resumo` (`codigo_pessoa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
