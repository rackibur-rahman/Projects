-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2017 at 12:52 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mess_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_member`
--

CREATE TABLE `add_member` (
  `month` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_member`
--

INSERT INTO `add_member` (`month`, `name`, `phone`, `email`) VALUES
('May', 'sohag', '656', 'sdfh'),
('May', 'zihad', '54564', 'sdfj');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `name` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`name`, `date`, `cost`) VALUES
('sohag', '2017-05-02', 400);

-- --------------------------------------------------------

--
-- Table structure for table `hrent`
--

CREATE TABLE `hrent` (
  `house_rent` int(11) NOT NULL,
  `eletro_bill` int(11) NOT NULL,
  `net_bill` int(11) NOT NULL,
  `gas_bill` int(11) NOT NULL,
  `others` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrent`
--

INSERT INTO `hrent` (`house_rent`, `eletro_bill`, `net_bill`, `gas_bill`, `others`) VALUES
(10000, 1400, 1000, 800, 200);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`name`, `username`, `password`, `email`) VALUES
('rocky', 'rk', '007', 'rk@gmail.com'),
('sohag', 'sohag', '211', 'sohag@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `name` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `breakfast` int(11) NOT NULL,
  `lunch` int(11) NOT NULL,
  `dinner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`name`, `date`, `breakfast`, `lunch`, `dinner`) VALUES
('sohag', '2017-05-07', 3, 4, 7),
('zihad', '2017-05-04', 3, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `name` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`name`, `date`, `balance`) VALUES
('sohag', '2017-05-07', 520),
('zihad', '2017-05-08', 1010);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_member`
--
ALTER TABLE `add_member`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
