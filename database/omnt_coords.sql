-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2017 at 01:29 AM
-- Server version: 10.0.29-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `omnt`
--

-- --------------------------------------------------------

--
-- Table structure for table `omnt_coords`
--
/* System info */
CREATE TABLE `omnt_systems` (
  `id` int(9) AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(99) NOT NULL,
  `region` varchar(99) NULL,
  `galaxy` varchar(99) NOT NULL,
  `x` text NOT NULL,
  `y` text NOT NULL,
  `z` text NOT NULL,
  `w` text NOT NULL,
  `color` varchar(99) NULL,
  `distance` int(9) NULL,
  `planets` int(9) NULL,
  `moons` int(9) NULL,
  `lifeform` varchar(99) NULL,
  `economy` varchar(99) NULL,
  `wealth` varchar(99) NULL,
  `conflict` varchar(99) NULL,
  `discovered` varchar(99) NOT NULL,
  `alliance` varchar(99) NULL,
  `mode` varchar(99) NULL,
  `platform` varchar(99) NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/* Coords are alwayst star system */
CREATE TABLE `omnt_coords` (
  `coord_id` int(9) AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(999) NOT NULL,
  `x` text NOT NULL,
  `y` text NOT NULL,
  `z` text NOT NULL,
  `w` text NOT NULL,
  `class` varchar(99) NULL,
  `system` varchar(99) NOT NULL,
  `region` varchar(99) NOT NULL,
  `galaxy` varchar(99) NOT NULL,
  `platform` varchar(99) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `omnt_coords`
--
