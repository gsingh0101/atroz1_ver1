-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2015 at 07:35 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cust_details`
--

CREATE TABLE IF NOT EXISTS `cust_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `mob` int(11) DEFAULT NULL,
  `yob` int(11) DEFAULT NULL,
  `hob` int(11) DEFAULT NULL,
  `minob` int(11) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dob` (`dob`,`mob`,`yob`,`hob`,`minob`,`city`),
  KEY `website` (`website`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `cust_details`
--

INSERT INTO `cust_details` (`id`, `email`, `firstname`, `middlename`, `lastname`, `password`, `dob`, `mob`, `yob`, `hob`, `minob`, `place`, `city`, `country`, `website`, `site`, `service`, `phone`) VALUES
(1, NULL, 'aa', '', '', NULL, '04/21/2015', NULL, NULL, 11, 13, NULL, 'Noida', 'Antartica', NULL, NULL, NULL, NULL),
(2, NULL, 'first2', 'mname2', 'lname2', NULL, '04', 21, 2015, 11, 13, NULL, 'Ghaziabad', 'Aruba', NULL, NULL, NULL, NULL),
(7, NULL, 'first2', 'mname2', 'lname2', NULL, '04', 21, 2015, 12, 13, NULL, 'Ghaziabad', 'Aruba', NULL, NULL, NULL, NULL),
(39, NULL, 'first2', 'mname2', 'lname2', NULL, '04', 21, 2015, 11, 11, NULL, 'Noida', '-1', NULL, NULL, NULL, NULL),
(40, NULL, 'awqe', 'ewsd', 'wqes', NULL, '04', 1, 2015, 1, 2, NULL, 'Ghaziabad', 'American Samoa', NULL, NULL, NULL, NULL),
(42, NULL, 'awqe', 'ewsd', 'wqes', NULL, '04', 1, 2015, 1, 2, NULL, 'Chandigarh', '-1', NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
