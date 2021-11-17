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
DROP DATABASE IF EXISTS sherlock;
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
  `keyword` varchar(50)
);

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `name` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  crimescene_id INT NOT NULL,
  FOREIGN KEY (crimescene_id) REFERENCES crime_scene(id)
);

--
-- Structure de la table `crime_scene_hashtag`
--

CREATE TABLE `crime_scene_hashtag` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  crimescene_id INT NOT NULL,
  FOREIGN KEY (crimescene_id) REFERENCES crime_scene(id),
  hashtag_id INT NOT NULL,
  FOREIGN KEY (hashtag_id) REFERENCES hashtag(id)
);

INSERT INTO crime_scene 
    (
    name,
    title,
    adress,
    description,
    date,
    victim) 
    VALUES 
    (
    "Watson",
    "Le mysthère de la chambre rouge",
    "3 Lauriston Gardens Londres",
    "C’était le cadavre d’un homme d’environ quarante-trois ans, de taille moyenne, avec des cheveux noirs et une barbe de trois jours. L’agonie avait dû être douloureuse ! Son visage rigide conservait une expression d’horreur.",
    "2021-01-01",
    "le cadavre d’Enoch J. Drebber"),
    (
    "Sherlock Holmes",
    "L’Aventure du pied du diable",
    "un cottage des Cornouailles",
    "Le 16 mars au matin, les Tregennis ont été retrouvés par leur cuisinière, Mme Porter, dans la même position que la veille au soir, avec une expression d’intense effroi sur le visage ; Brenda était morte, et ses deux frères étaient devenus fous. Rien ne semble expliquer cette situation aussi extraordinaire que tragique.",
    "1897-03-16",
    "Owen Tregennis - George Tregennis - Brenda Tregennis"),
    (
    "L’inspecteur Lestrade",
    "Le Mystère du Val Boscombe",
    "un cottage des Cornouailles",
    "En 1888, Sherlock Holmes et Watson sont dépêchés au Val Boscombe afin d’enquêter sur la mort de Charles McCarthy. L’inspecteur Lestrade, de Scotland Yard, à étudié la scène de crime, Mr McCarthy à été retrouvé mort le crane fracassé sous un piano tombé du deuxième étage de son manoir.",
    "1888-10-19",
    "Charles McCarthy"),
    (
    "Justine Poirot",
    "Les Cinq Pépins d’orange",
    "Appartement 4, main street, Londres",
    "Un jour, Elias Openshaw reçut par la poste une lettre contenant cinq pépins d’orange. Il sut immédiatement que le destin s’approchait de lui. Son corps fut retrouvé dans sa baignoire il s’était visiblement noyé dans 60 cm d’eau. Un véritable mysthère...",
    "1901-04-01",
    "Elias Openshaw");
  
