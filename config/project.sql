-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 05:19 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `project_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `proj_id` varchar(20) NOT NULL,
  `proj_edl` enum('ปวช.3','ปวส.2','ปริญญาตรี') NOT NULL,
  `proj_name` varchar(100) NOT NULL,
  `teacher_name` varchar(50) NOT NULL,
  `year` varchar(5) NOT NULL,
  `type` enum('วิจัย/ศึกษาค้นคว้า','ผลิตภัณฑ์/สิ่งใหม่','เชิงสำรวจ','เชิงทดลอง') NOT NULL,
  `img` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `tea_id` int(11) NOT NULL,
  `tea_name` varchar(30) NOT NULL,
  `tea_lastname` varchar(30) NOT NULL,
  `tea_dept` varchar(100) NOT NULL DEFAULT 'เทคโนโลยีสารสนเทศ',
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(13) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `img` text NOT NULL,
  `role` enum('admin','user','super') NOT NULL DEFAULT 'user',
  `edl` enum('ปวส.2','ปวช.3','ปริญญาตรี') DEFAULT NULL,
  `dept` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `password`, `img`, `role`, `edl`, `dept`) VALUES
('admin', 'ธนภัทรasd', 'กองเงิน', '$2y$10$THGUoK/NGng3wP7F0k/WFOeIQQepSsq/ZsoHRDu5P6sJo8TbFvfWu', 'uploads/65ad24db5d9b6_1705845979.jpg', 'super', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_fk` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`proj_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`tea_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
