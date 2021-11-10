-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `simple-mvc`
--

-- --------------------------------------------------------

--
-- Création de la BDD "sherlock"
--

CREATE DATABASE sherlock; 

--
-- Selection de la BDD "sherlock"
--

USE sherlock; 

--
-- Structure de la table `crime_scene`
--

CREATE TABLE `crime_scene` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `name` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `adress` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `victim` varchar(150) NOT NULL 
);

--
-- Structure de la table `hashtag`
--

CREATE TABLE `hashtag` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `keynumber` varchar(50),
  `keyword` varchar(50)
);

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `name` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL
);

ALTER TABLE comment ADD crimescene_id INT;

ALTER TABLE comment ADD FOREIGN KEY (crimescene_id) REFERENCES crime_scene(id);
