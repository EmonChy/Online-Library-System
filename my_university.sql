-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2019 at 05:06 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_university`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `d_code` varchar(50) NOT NULL,
  `d_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `d_code`, `d_name`, `status`) VALUES
(1, 'CSE', 'Computer Science & Engineering', 1),
(2, 'EEE', 'Electric & Electronical Engineering', 1),
(3, 'ELL', 'English', 1),
(4, 'Pharm', 'Pharmacy', 1),
(5, 'BBA', 'Business Administration', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `sec_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `sec_name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `sem_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `sem_name`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd'),
(4, '4th'),
(5, '5th'),
(6, '6th'),
(7, '7th'),
(8, '8th');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `ses_duration` varchar(30) NOT NULL,
  `t_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `ses_duration`, `t_name`) VALUES
(1, '2010-2011', 'Autumn'),
(2, '2010-2011', 'Spring'),
(3, '2011-2012', 'Autumn'),
(4, '2012-2013', 'Spring'),
(5, '2015-2016', 'Autumn');

-- --------------------------------------------------------

--
-- Table structure for table `students_new`
--

CREATE TABLE `students_new` (
  `id` int(11) NOT NULL,
  `u_id` varchar(100) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `u_mob` varchar(11) NOT NULL,
  `u_pin` varchar(11) NOT NULL,
  `u_amount` int(11) NOT NULL,
  `u_dept` int(11) NOT NULL,
  `u_session` int(11) NOT NULL,
  `c_key` int(11) NOT NULL COMMENT 'dep_id+session_id',
  `u_sem` int(11) NOT NULL,
  `u_section` int(11) NOT NULL,
  `u_reg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students_new`
--

INSERT INTO `students_new` (`id`, `u_id`, `u_name`, `password`, `u_email`, `image`, `u_mob`, `u_pin`, `u_amount`, `u_dept`, `u_session`, `c_key`, `u_sem`, `u_section`, `u_reg`) VALUES
(2, 'C151040', 'arjun ikka  jan', '12345', 'anikl@gmail.com', 'kh001.jpg', '01812045670', '5674', 342, 4, 3, 43, 4, 2, '11/11/2018'),
(9, 'C151035', 'emon', '22446688', 'emonchy35@gmail.com', 'abc.jpg', '01812045678', '2341', 1223, 3, 4, 34, 5, 2, '14/11/2018');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_new`
--
ALTER TABLE `students_new`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `c_key` (`c_key`),
  ADD UNIQUE KEY `u_id` (`u_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `students_new`
--
ALTER TABLE `students_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
