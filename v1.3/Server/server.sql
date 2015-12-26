-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 26, 2015 at 01:09 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `SysInfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `e_ram` text NOT NULL,
  `e_cpu` text NOT NULL,
  `e_gpu` text NOT NULL,
  `e_bse` text NOT NULL,
  `e_nic` text NOT NULL,
  `e_hdd` text NOT NULL,
  `e_usr` text NOT NULL,
  `e_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Timestamp should be 10 long but 11 just for future proofing.';

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;