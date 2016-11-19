-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 29, 2016 at 02:37 AM
-- Server version: 5.5.28
-- PHP Version: 5.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `video`
--
CREATE DATABASE IF NOT EXISTS `video` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `video`;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) NOT NULL UNIQUE KEY,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id` int(25) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL UNIQUE KEY,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE IF NOT EXISTS `sub_menu` (
`id` int(25) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL UNIQUE KEY,
  `menu_id` int(25) NOT NULL,
  `created` datetime NOT NULL,
  FOREIGN KEY (`menu_id`) REFERENCES `menu`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `download_list`
--

CREATE TABLE IF NOT EXISTS `download_list` (
  `path` varchar(255) NOT NULL UNIQUE KEY PRIMARY KEY,
  `filename` varchar(255) NOT NULL UNIQUE KEY,
  `board` varchar(255) NOT NULL,
  `created` datetime NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `downloaded`
--

CREATE TABLE IF NOT EXISTS `downloaded` (
  `filename`  varchar(255) NOT NULL UNIQUE KEY,
  `created` datetime NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Crate user
--

CREATE USER 'chris'@'localhost' IDENTIFIED BY 'chris-video';
GRANT ALL PRIVILEGES ON *.* TO 'chris'@'localhost' WITH GRANT OPTION;
CREATE USER 'chris'@'%' IDENTIFIED BY 'chris-video';
GRANT ALL PRIVILEGES ON *.* TO 'chris'@'%' WITH GRANT OPTION;