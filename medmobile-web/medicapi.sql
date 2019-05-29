-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2019 at 06:54 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `symptom_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  `diagnosis_result` varchar(9) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `pat_id`, `symptom_id`, `issue_id`, `diagnosis_result`, `date_created`) VALUES
(1, 1, 10, 1, 'valid', '2019-05-25 16:44:59'),
(2, 1, 10, 5, 'invalid', '2019-05-25 16:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `yob` year(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` char(7) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `yob`, `name`, `gender`, `date_created`, `email`) VALUES
(1, 1990, 'Ola Adeniyi', 'male', '2019-05-25 10:36:50', 'niyi@hotmail.com'),
(2, 2008, 'Mike Abdnul', 'male', '2019-05-25 10:54:18', 'mkad123@yahoo.com'),
(3, 1990, 'Ojobo Mike', 'male', '2019-05-25 15:19:57', 'ojobo@yahoo.com'),
(4, 1996, 'Ojobo Ene', 'female', '2019-05-25 15:20:13', 'enejobo@yahoo.com'),
(5, 1999, 'Mallam Ene', 'female', '2019-05-25 15:20:40', 'enemallo@yahoo.com'),
(6, 2005, 'Suratu Mikolo', 'female', '2019-05-25 15:21:05', 'suslaso@gmail.com'),
(7, 1978, 'Burun Nasilui', 'female', '2019-05-25 15:21:38', 'bsuili@ymail.com'),
(8, 1974, 'Burun Mako', 'male', '2019-05-25 15:22:04', 'nakobiu@ymail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
