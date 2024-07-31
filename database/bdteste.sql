-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 15/04/2023 às 17:19
-- Versão do servidor: 5.7.40
-- Versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdteste`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `cpf`) VALUES
(85, 'abcdefg', 'bbbbbbb@hotmail.com', 'diretobanco', '70421753013'),
(79, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(77, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(75, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(72, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(73, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(69, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(70, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(71, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(64, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(65, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(66, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(68, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(62, 'abc', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(60, 'aaaaaaaaa', 'aaaaaaaaa@hotmail.com', 'inserindodiretamentopelobanco', '11111211111'),
(59, 'aaaaaaaaa', 'aaaaaaaaa@hotmail.com', 'inserindodiretamentopelobanco', '11111111111'),
(89, 'aaaaaaaaa', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(88, 'aaaaaaaaa', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(57, 'aaaaaa teste TESTE', 'teste.4343@hotmail.com', '473170eeZGFzZGbc40c17eFzZGFz33952ac0', '03521831019'),
(103, 'teste drive', 'teste.teste@hotmail.com', '473170eeMTbc40c17eIz33952ac0', '65036753054'),
(54, 'neymar', 'teste4343@hotmail.com', '473170eeZHNhbc40c17eZGFz33952ac0', '36000036078'),
(55, 'neymar', 'neymar.neymar@hotmail.com', '473170eeZHNhZGbc40c17eFkYXM=33952ac0', '91786894068'),
(87, 'aaaaaaaaa', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(90, 'aaaaaaaaa', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(91, 'aaaaaaaaa', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(92, 'aaaaaaaaa', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(93, 'aaaaaaaaa', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(94, 'aaaaaaaaa', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(95, 'aaaaaaaaa', 'bbbbbbb@hotmail.com', 'diretobanco', '11111111111'),
(96, 'neymar', 'arthur.arthur@hotmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', '59281849054');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
