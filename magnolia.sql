-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2017 at 12:19 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magnolia`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `full_name`, `email`, `password`) VALUES
(9, 'Alam', 'acastillo@questdiagnostics.com', 'test'),
(10, 'Kyle Korver', 'kyle.korver@questdiagnostics.com', 'pass'),
(11, 'john doe', 'john.doe@questdiagnostics.com', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `web_request`
--

CREATE TABLE `web_request` (
  `id` int(11) NOT NULL,
  `request_number` int(11) NOT NULL,
  `priority` int(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL,
  `publish_date` date NOT NULL,
  `client_phone` varchar(255) NOT NULL,
  `has_asset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_request`
--

INSERT INTO `web_request` (`id`, `request_number`, `priority`, `client`, `status`, `description`, `publish_date`, `client_phone`, `has_asset`) VALUES
(61, 773, 1, 'John Doe', 1, 'Description of this.', '2017-02-28', '7319420551', 0),
(62, 788, 2, 'Kyle Korver', 1, 'Test', '2017-03-09', '9410241122', 0),
(63, 791, 2, 'Will Carter', 1, 'test', '2017-02-27', '8329122211', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_request`
--
ALTER TABLE `web_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `web_request`
--
ALTER TABLE `web_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
