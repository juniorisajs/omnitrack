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

/* Pilot info */
/* One player / one ship / one freighter */
CREATE TABLE `omnt_pilots` (
  `pilot_id` int(9) AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(999) NOT NULL,
  `pilot_type` text NOT NULL,
  `ship_name` varchar(999) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/* Location info */
/* One player is in a system at a defined date */
CREATE TABLE `omnt_locations` (
  `loc_id` int(9) AUTO_INCREMENT PRIMARY KEY,
  `system_id` int(9) NOT NULL,
  `ship_id` int(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/* Join table */
/* system_id is foreign key from coords table */
/* ship_id is foreign key from pilots table */

/* Tags */
/* Tags a system or a player */
/* Civs, Anomaly, Black Hole, Base ... */
CREATE TABLE `omnt_tags` (
  `tag_id` int(9) AUTO_INCREMENT PRIMARY KEY,
  `type` varchar(99) NOT NULL,
  `object_id` int(9) NOT NULL,
  `label` varchar(99) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/* Join table */
/* type is system or pilot */
/* object_id is the foreign key from systems or pilots (according to type) */
/* label is the tag */

--
-- Dumping data for table `omnt_coords`
--

INSERT INTO `omnt_coords` (`username`, `coord_type`, `x`, `y`, `z`, `w`, `star_class`, `system_name`, `region_name`, `galaxy_name`, `platform`) VALUES
('omnt', 'Pilgrim', '064A', '0082', '01B6', '009A', 'O6p', 'Pilgrim Star', 'Ocopadica', 'Euclid', 'PC'),
('omnt', 'Pilgrim', '07FF', '007F', '07FF', '0000', '', 'Center', '.', '.', 'PC/PS4');
