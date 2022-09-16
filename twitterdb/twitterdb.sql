-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2022 at 10:42 AM
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
  `user_id` int(11) NOT NULL,
  `user_following` int(11) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`user_id`, `user_following`, `created_at`) VALUES
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
(6, 1, NULL),
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
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `text`, `created_at`, `user_id`) VALUES
(1, 'Hi this is a text from houssein', '2022-09-02', 1),
(2, 'Hi this is another text from Houssein', '2022-09-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tweets_likes`
--

CREATE TABLE `tweets_likes` (
  `id` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `tweets_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweets_likes`
--

INSERT INTO `tweets_likes` (`id`, `created_at`, `tweets_id`, `user_id`) VALUES
(1, NULL, 1, 1),
(2, NULL, 1, 10),
(3, NULL, 2, 4),
(4, NULL, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tweets_pictures`
--

CREATE TABLE `tweets_pictures` (
  `id` int(11) NOT NULL,
  `picture_url` varchar(255) DEFAULT NULL,
  `tweets_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweets_pictures`
--

INSERT INTO `tweets_pictures` (`id`, `picture_url`, `tweets_id`) VALUES
(1, 'NA', 1),
(2, 'Na', 1),
(3, 'NA', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_picture_url` varchar(255) DEFAULT NULL,
  `cover_picture_url` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `username`, `password`, `profile_picture_url`, `cover_picture_url`, `created_at`) VALUES
(1, 'houssein@gmail.com', 'Houssein', 'Droubi', '@houssein', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'NA', 'NA', '2022-09-01'),
(2, 'mouhamad@gmail.com', 'Mouhamad', 'Droubi', '@mouhamad', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'NA', 'NA', '2022-09-02'),
(3, 'ali@gmail.com', 'Ali', 'Droubi', '@ali', 'test', 'NA', 'Na', '2022-09-03'),
(4, 'nour@gmail.com', 'Nour', 'Doe', '@nour', 'test', 'Na', 'Na', '1899-12-31'),
(5, 'abbas@gmail.com', 'Abbas', 'Doe', '@Abbas', 'test', 'NA', 'NA', '2022-09-05'),
(6, 'samah@gmail.com', 'samah', 'Doe', '@samah', 'test', 'NA', 'NA', '2022-09-04'),
(7, 'joumana@gmail.com', 'Joumana', 'Doe', '@jumana', 'test', 'N', 'Na', '2022-09-06'),
(8, 'fatima@gmail.com', 'Fatima', 'Doe', '@Fatima', 'test', 'Na', 'Na', '2022-09-08'),
(9, 'amal@gmail.com', 'Amal', 'Doe', '@amal', 'test', 'NA', 'Na', '2022-09-09'),
(10, 'zaynab@gmail.com', 'Zaynab', 'Doe', '@zaynab', 'test', 'NA', 'NA', '2022-09-10'),
(18, 'mahdi@gmail.com', 'Mahdi', 'Doe', '@Mahdi', 'tests', 'users/18/profile/1663275600.png', 'users/18/cover/1663275600.png', '2022-09-15'),
(19, 'hassan@gmail.com', 'hassan', 'Doe', '@hassan', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'users/19/profile/1663189200.png', 'users/19/cover/1663189200.png', '2022-09-15');

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
  ADD PRIMARY KEY (`user_id`,`user_following`);

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
-- Indexes for table `tweets_pictures`
--
ALTER TABLE `tweets_pictures`
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
-- AUTO_INCREMENT for table `tweets_pictures`
--
ALTER TABLE `tweets_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
