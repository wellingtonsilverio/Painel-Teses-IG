-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Jul-2015 às 01:27
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
-- Database: `dbigeografia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `RA` int(11) NOT NULL,
  `nome` varchar(160) NOT NULL,
  `curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--



-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(11) NOT NULL,
  `nome` varchar(160) NOT NULL,
  `instituto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso`
--



-- --------------------------------------------------------

--
-- Estrutura da tabela `defesa`
--

CREATE TABLE IF NOT EXISTS `defesa` (
  `id` int(11) NOT NULL,
  `nivel` varchar(160) NOT NULL,
  `aluno` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `local` varchar(160) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `defesa`
--



-- --------------------------------------------------------

--
-- Estrutura da tabela `defesa_professor`
--

CREATE TABLE IF NOT EXISTS `defesa_professor` (
  `id` int(11) NOT NULL,
  `defesa` int(11) NOT NULL,
  `membro_da_banca` int(11) NOT NULL,
  `orientador` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `defesa_professor`
--



-- --------------------------------------------------------

--
-- Estrutura da tabela `faculdade`
--

CREATE TABLE IF NOT EXISTS `faculdade` (
  `id` int(11) NOT NULL,
  `siglas` varchar(10) NOT NULL,
  `nome` varchar(160) NOT NULL,
  `rua` varchar(160) NOT NULL,
  `bairro` varchar(160) NOT NULL,
  `cidade` varchar(160) NOT NULL,
  `estado` varchar(160) NOT NULL,
  `pais` varchar(160) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `faculdade`
--



-- --------------------------------------------------------

--
-- Estrutura da tabela `instituto`
--

CREATE TABLE IF NOT EXISTS `instituto` (
  `id` int(11) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `nome` varchar(160) NOT NULL,
  `departamento` varchar(160) DEFAULT NULL,
  `faculdade` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `instituto`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL,
  `quem` int(11) NOT NULL,
  `oque` varchar(160) NOT NULL,
  `onde` varchar(160) NOT NULL,
  `quando` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `membro_da_banca`
--

CREATE TABLE IF NOT EXISTS `membro_da_banca` (
  `id` int(11) NOT NULL,
  `titulo` varchar(160) DEFAULT NULL,
  `nome` varchar(160) NOT NULL,
  `cpf` varchar(160) DEFAULT NULL,
  `rg` varchar(160) DEFAULT NULL,
  `data_nacimento` varchar(160) DEFAULT NULL,
  `telefone` varchar(160) DEFAULT NULL,
  `endereco` varchar(160) DEFAULT NULL,
  `email` varchar(160) DEFAULT NULL,
  `formacao_academica` varchar(160) DEFAULT NULL,
  `instituicao_IES` varchar(160) DEFAULT NULL COMMENT 'aonde se formou',
  `ano` int(4) DEFAULT NULL,
  `instituicao_origem` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `membro_da_banca`
--



-- --------------------------------------------------------

--
-- Estrutura da tabela `secretaria`
--

CREATE TABLE IF NOT EXISTS `secretaria` (
  `id` int(11) NOT NULL,
  `nome` varchar(160) NOT NULL,
  `institulo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `secretaria`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(160) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `permissao` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`RA`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defesa`
--
ALTER TABLE `defesa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defesa_professor`
--
ALTER TABLE `defesa_professor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculdade`
--
ALTER TABLE `faculdade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instituto`
--
ALTER TABLE `instituto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membro_da_banca`
--
ALTER TABLE `membro_da_banca`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `secretaria`
--
ALTER TABLE `secretaria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `defesa`
--
ALTER TABLE `defesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `defesa_professor`
--
ALTER TABLE `defesa_professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `faculdade`
--
ALTER TABLE `faculdade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `instituto`
--
ALTER TABLE `instituto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `membro_da_banca`
--
ALTER TABLE `membro_da_banca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `secretaria`
--
ALTER TABLE `secretaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;--
