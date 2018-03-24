-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2014 at 12:53 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `account_ple`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `billId` int(10) NOT NULL AUTO_INCREMENT,
  `vol` int(5) NOT NULL,
  `no` int(5) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `dateCreate` date NOT NULL,
  `billNumber` varchar(4) NOT NULL,
  PRIMARY KEY (`billId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`billId`, `vol`, `no`, `companyName`, `dateCreate`, `billNumber`) VALUES
(1, 1, 1, 'chainsoft', '2014-08-26', '0001');

-- --------------------------------------------------------

--
-- Table structure for table `billdetail`
--

DROP TABLE IF EXISTS `billdetail`;
CREATE TABLE IF NOT EXISTS `billdetail` (
  `billDetailId` int(10) NOT NULL AUTO_INCREMENT,
  `no` int(11) NOT NULL,
  `date` date NOT NULL,
  `baht` int(11) NOT NULL,
  `satang` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `billId` int(10) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  PRIMARY KEY (`billDetailId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `billdetail`
--

INSERT INTO `billdetail` (`billDetailId`, `no`, `date`, `baht`, `satang`, `remark`, `billId`, `price`) VALUES
(1, 16043, '2014-08-26', 120, 50, 'test', 1, 100.00),
(3, 1, '2014-08-28', 1, 1, '1', 1, 0.00);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
