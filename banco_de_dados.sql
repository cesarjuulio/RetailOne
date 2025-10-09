-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 07, 2019 at 11:41 AM
-- Server version: 5.7.27-0ubuntu0.19.04.1
-- PHP Version: 7.2.19-0ubuntu0.19.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retailone`
--
CREATE DATABASE IF NOT EXISTS `retailone` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `retailone`;

-- --------------------------------------------------------

--
-- Table structure for table `artigos`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
    `matricula` int(11) NOT NULL PRIMARY KEY,
    `nome` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `telefone` VARCHAR(15) COLLATE utf8mb4_unicode_ci NOT NULL,
    `senha` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `tipo_usuario` ENUM('administrador','padrao') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'padrao'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `produto`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(150) NOT NULL,
    `descricao` TEXT,
    `fornecedor` VARCHAR(100),
    `marca` VARCHAR(50),
    `categoria` VARCHAR(50),
    `preco_compra` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `preco_venda` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `estoque` INT(11) NOT NULL DEFAULT 0,
    `estoque_minimo` INT(11) NOT NULL DEFAULT 0,
    `unidade_medida` VARCHAR(20) DEFAULT 'un',
    `ncm` VARCHAR(20),
    `validade` DATE,
    `data_cadastro` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
