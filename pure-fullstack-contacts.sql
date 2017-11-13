-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2017 at 10:26 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pure-fullstack-contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `first_name`, `last_name`, `address`) VALUES
(1, 'Fernando', 'Miranda', 'Rua da Esperança, 16'),
(2, 'Patricia', 'Oliveira Alves', 'Rua da Esperança, 16'),
(3, 'Breno', 'Oliveira Alves Miranda', 'Rua da Esperança, 16'),
(4, 'Sara', 'Oliveira Alves Miranda', 'Rua da Esperança, 16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;