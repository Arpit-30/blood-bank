-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2025 at 06:30 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blood_donation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'shaharpit2004@gmail.com', 'Arpit@30');

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE IF NOT EXISTS `blood_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `blood_requests`
--


-- --------------------------------------------------------

--
-- Table structure for table `blood_stock`
--

CREATE TABLE IF NOT EXISTS `blood_stock` (
  `id` int(11) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_stock`
--

INSERT INTO `blood_stock` (`id`, `blood_group`, `quantity`) VALUES
(0, 'B+ve', 12);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE IF NOT EXISTS `contactus` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `phone`, `message`, `submission_date`) VALUES
(1, 'arpit', 'arpitshah@gmail.com', '90992784561', 'sdfg', '2024-10-10 15:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `donate_blood`
--

CREATE TABLE IF NOT EXISTS `donate_blood` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `blood_type` varchar(3) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `age` int(5) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `donate_blood`
--

INSERT INTO `donate_blood` (`id`, `name`, `email`, `blood_type`, `phone`, `age`, `gender`) VALUES
(8, 'patel rai', 'arpit30@gmail.com', 'AB-', '987201347', 20, 'Male'),
(7, 'arpit shah', 'shaharpit@gmail.com', 'B+v', '987201347', 18, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `donations_history`
--

CREATE TABLE IF NOT EXISTS `donations_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `location` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `donations_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `emergency_requests`
--

CREATE TABLE IF NOT EXISTS `emergency_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `blood_type` varchar(5) NOT NULL,
  `location` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `urgency` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `emergency_requests`
--

INSERT INTO `emergency_requests` (`id`, `name`, `blood_type`, `location`, `phone`, `message`, `urgency`, `created_at`, `status`) VALUES
(1, 'arpit', 'B-ve', 'qwertyuio', '90992784561', 'ssssssssssssssssss', 'High', '2024-10-12 19:18:39', NULL),
(2, 'arpit shah', 'A-ve', 'surat', '30324578023', 'xyz', 'High', '2024-10-24 13:38:21', NULL),
(3, 'yug kansara', 'A+ve', 'navsari', '12345678900', 'nothing ', 'High', '2025-01-10 10:42:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `need_blood`
--

CREATE TABLE IF NOT EXISTS `need_blood` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `blood_type` varchar(5) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `need_blood`
--

INSERT INTO `need_blood` (`id`, `name`, `blood_type`, `phone`, `email`, `location`, `request_time`, `status`, `quantity`) VALUES
(1, 'arpit', 'A+', '90992784561', 'arpitshah@gmail.com', 'qwertyuio', '2024-10-13 15:31:08', 'Fulfilled', 0),
(2, 'arpit', 'A+', '1234567890', 'arpit30@gmail.com', 'navsari', '2024-10-15 13:30:20', 'Fulfilled', 1),
(3, 'keyur', 'AB-', '5755424579', 'yug12@gmail.com', 'pardi railway station,killa-pardi', '2024-10-18 10:53:27', 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwords` varchar(50) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `bloodgroup` varchar(5) NOT NULL,
  `last_donation` date NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstname`, `lastname`, `email`, `passwords`, `phonenumber`, `bloodgroup`, `last_donation`, `id`) VALUES
('arpit', 'shah', 'arpit30@gmail.com', 'Arpit', '1234567890', 'A+ve', '2024-10-08', 1);
