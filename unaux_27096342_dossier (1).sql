-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql210.byetcluster.com
-- Tempo de geração: 12/11/2020 às 14:02
-- Versão do servidor: 5.6.48-88.0
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `unaux_27096342_dossier`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `arq_id` int(11) NOT NULL,
  `arq_nome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arq_arquivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arq_dono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arq_caminho` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chaves`
--

CREATE TABLE `chaves` (
  `Id_chave` int(11) NOT NULL,
  `num_chave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dono_chave` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `chaves`
--

INSERT INTO `chaves` (`Id_chave`, `num_chave`, `dono_chave`) VALUES
(3123, 'XatjCzkheq', 'darla@darla'),
(3124, 'm6xgsunbGo', NULL),
(3125, 'vsdcNgzqr+', NULL),
(3126, 'yrVduORntN', NULL),
(3127, 'lupeYdx2wo', NULL),
(3128, 'hiVlpGTsuj', NULL),
(3129, 'R_u@nzwsmY', NULL),
(3130, 'rUwivXyJho', NULL),
(3131, 'KsehUmxyiq', NULL),
(3132, '_pnlisjeqD', NULL),
(3133, 'vUjfrlizQB', NULL),
(3134, 'NjmzrHhats', NULL),
(3135, 'vpkSPreTyl', NULL),
(3136, 'gmjZWqy=xb', NULL),
(3137, 'EdzcoKmgbw', NULL),
(3138, 'veiytRrwJH', NULL),
(3139, 'bsiCn_Yxwf', NULL),
(3140, 'zldUrw-tvI', NULL),
(3141, 'onmgJzaBte', NULL),
(3142, 'PtKOdsynrb', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `compartilhados`
--

CREATE TABLE `compartilhados` (
  `id_comp` int(11) NOT NULL,
  `arq_comp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_comp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arq_caminho` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arq_dono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `editavel` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `id_usuario_lista`
--

CREATE TABLE `id_usuario_lista` (
  `id_usu_lista` int(11) NOT NULL,
  `lista_usu_lista` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_usu_lista` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista`
--

CREATE TABLE `lista` (
  `id_lista` int(11) NOT NULL,
  `nome_lista` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dono_lista` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `lista`
--

INSERT INTO `lista` (`id_lista`, `nome_lista`, `dono_lista`) VALUES
(11, 'Teste', 'danielximenes65@gmail.com'),
(10, 'Teste', 'danielximenes65@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Tbl_pastas`
--

CREATE TABLE `Tbl_pastas` (
  `id_pasta` int(11) NOT NULL,
  `nome_pasta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dono_pasta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `local_pasta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Tbl_usuario`
--

CREATE TABLE `Tbl_usuario` (
  `Id_usuario` int(11) NOT NULL,
  `Nome_usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sobrenome_usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email_usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Senha_usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pasta_usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Chave_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Tipo_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `Tbl_usuario`
--

INSERT INTO `Tbl_usuario` (`Id_usuario`, `Nome_usuario`, `Sobrenome_usuario`, `Email_usuario`, `Senha_usuario`, `Pasta_usuario`, `Chave_usuario`, `Tipo_usuario`) VALUES
(23, 'felipe', 'admin', 'felipe@admin', '202cb962ac59075b964b07152d234b70', 'arquivos/felipe@admin', '222222222222222222223', 'admin'),
(63, 'Darla', 'Torres', 'darla@darla', '202cb962ac59075b964b07152d234b70', 'arquivos/darla@darla', 'XatjCzkheq', 'admin');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`arq_id`);

--
-- Índices de tabela `chaves`
--
ALTER TABLE `chaves`
  ADD PRIMARY KEY (`Id_chave`);

--
-- Índices de tabela `compartilhados`
--
ALTER TABLE `compartilhados`
  ADD PRIMARY KEY (`id_comp`);

--
-- Índices de tabela `id_usuario_lista`
--
ALTER TABLE `id_usuario_lista`
  ADD PRIMARY KEY (`id_usu_lista`);

--
-- Índices de tabela `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`id_lista`);

--
-- Índices de tabela `Tbl_pastas`
--
ALTER TABLE `Tbl_pastas`
  ADD PRIMARY KEY (`id_pasta`);

--
-- Índices de tabela `Tbl_usuario`
--
ALTER TABLE `Tbl_usuario`
  ADD PRIMARY KEY (`Id_usuario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `arq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `chaves`
--
ALTER TABLE `chaves`
  MODIFY `Id_chave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3143;

--
-- AUTO_INCREMENT de tabela `compartilhados`
--
ALTER TABLE `compartilhados`
  MODIFY `id_comp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de tabela `id_usuario_lista`
--
ALTER TABLE `id_usuario_lista`
  MODIFY `id_usu_lista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `lista`
--
ALTER TABLE `lista`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `Tbl_pastas`
--
ALTER TABLE `Tbl_pastas`
  MODIFY `id_pasta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de tabela `Tbl_usuario`
--
ALTER TABLE `Tbl_usuario`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
