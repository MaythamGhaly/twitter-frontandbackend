-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2022 at 07:58 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitterdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `blockers`
--

CREATE TABLE `blockers` (
  `users_id` int(11) NOT NULL,
  `user_blocking` int(11) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blockers`
--

INSERT INTO `blockers` (`users_id`, `user_blocking`, `created_at`) VALUES
(8, 3, NULL),
(10, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `users_id` int(11) NOT NULL,
  `user_following` int(11) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`users_id`, `user_following`, `created_at`) VALUES
(1, 2, NULL),
(1, 3, NULL),
(1, 5, NULL),
(2, 1, NULL),
(2, 6, NULL),
(2, 10, NULL),
(3, 1, NULL),
(3, 2, NULL),
(3, 4, NULL),
(3, 5, NULL),
(4, 7, NULL),
(4, 10, NULL),
(5, 1, NULL),
(5, 8, NULL),
(6, 2, NULL),
(7, 4, NULL),
(8, 2, NULL),
(8, 9, NULL),
(9, 2, NULL),
(9, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `text` varchar(280) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `text`, `created_at`, `users_id`) VALUES
(1, 'Hi this is a text from houssein', NULL, 1),
(2, 'Hi this is a text from Mouhamad', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tweets_likes`
--

CREATE TABLE `tweets_likes` (
  `id` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `tweets_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweets_likes`
--

INSERT INTO `tweets_likes` (`id`, `created_at`, `tweets_id`, `users_id`) VALUES
(1, NULL, 1, 1),
(2, NULL, 1, 10),
(3, NULL, 2, 4),
(4, NULL, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tweets_pictues`
--

CREATE TABLE `tweets_pictues` (
  `id` int(11) NOT NULL,
  `picture_url` varchar(255) DEFAULT NULL,
  `tweets_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweets_pictues`
--

INSERT INTO `tweets_pictues` (`id`, `picture_url`, `tweets_id`) VALUES
(1, 'NA', 1),
(2, 'Na', 2),
(3, 'NA', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `profile_picture_url` varchar(255) DEFAULT NULL,
  `cover_picture_url` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `profile_picture_url`, `cover_picture_url`, `created_at`) VALUES
(1, 'Houssein', 'Droubi', '@houssein', 'test', 'NA', 'NA', '2022-09-01'),
(2, 'Mouhamad', 'Droubi', '@mouhamad', 'test', 'NA', 'NA', '2022-09-02'),
(3, 'Ali', 'Droubi', '@ali', 'test', 'NA', 'Na', '2022-09-03'),
(4, 'Nour', 'Doe', '@nour', 'test', 'Na', 'Na', '1899-12-31'),
(5, 'Abbas', 'Doe', '@Abbas', 'test', 'NA', 'NA', '2022-09-05'),
(6, 'samah', 'Doe', '@samah', 'test', 'NA', 'NA', '2022-09-04'),
(7, 'Joumana', 'Doe', '@jumana', 'test', 'N', 'Na', '2022-09-06'),
(8, 'Fatima', 'Doe', '@Fatima', 'test', 'Na', 'Na', '2022-09-08'),
(9, 'Amal', 'Doe', '@amal', 'test', 'NA', 'Na', '2022-09-09'),
(10, 'Zaynab', 'Doe', '@zaynab', 'test', 'NA', 'NA', '2022-09-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blockers`
--
ALTER TABLE `blockers`
  ADD PRIMARY KEY (`users_id`,`user_blocking`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`users_id`,`user_following`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweets_likes`
--
ALTER TABLE `tweets_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweets_pictues`
--
ALTER TABLE `tweets_pictues`
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
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tweets_likes`
--
ALTER TABLE `tweets_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tweets_pictues`
--
ALTER TABLE `tweets_pictues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
