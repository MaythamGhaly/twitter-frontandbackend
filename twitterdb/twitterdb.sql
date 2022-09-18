-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2022 at 10:08 PM
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
  `user_id` int(11) NOT NULL,
  `user_blocking` int(11) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blockers`
--

INSERT INTO `blockers` (`user_id`, `user_blocking`, `created_at`) VALUES
(1, 18, NULL),
(8, 3, NULL),
(9, 10, NULL),
(10, 3, NULL),
(19, 1, NULL),
(19, 2, NULL);

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
(1, 3, NULL),
(2, 3, '2022-09-16'),
(2, 10, NULL),
(2, 21, NULL),
(3, 2, NULL),
(3, 4, NULL),
(3, 5, NULL),
(4, 7, NULL),
(4, 10, NULL),
(5, 1, NULL),
(5, 8, NULL),
(6, 1, NULL),
(7, 3, NULL),
(8, 2, NULL),
(8, 9, NULL),
(9, 2, NULL),
(18, 19, '2022-09-18'),
(19, 18, '2022-09-18');

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
(2, 'Hi this is another text from Houssein', '2022-09-15', 1),
(4, 'Hi this is number 2 Hi this is number 2 Hi this is number 2Hi this is number 2 Hi this is number 2 Hi this is number 2 Hi this is number 2', '2022-09-18', 2),
(5, 'hello this is number 4', '2022-09-17', 4),
(6, 'Hi I\'m 21', NULL, 21),
(7, 'hi this is number 7 from user 21', NULL, 21),
(10, 'test from user 2 test from user 2 test from user 2 test from user 2 test from user 2 test from user 2 test from user 2 test from user 2 test from user 2 test from user 2 test from user 2 test from user 2 ', '2022-10-11', 2),
(11, 'This is text from user 2', '2022-10-11', 2),
(12, 'asdsadsadas', '2022-09-18', 2),
(13, 'asdsadsadas', '2022-09-18', 2),
(14, 'hello this is first text', '2022-09-18', 2),
(15, 'asdasdasd', '2022-09-18', 2),
(16, 'hello this is a tweet with image', '2022-09-18', 2),
(17, 'This is second test with image plus reload', '2022-09-18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tweets_likes`
--

CREATE TABLE `tweets_likes` (
  `created_at` date DEFAULT NULL,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweets_likes`
--

INSERT INTO `tweets_likes` (`created_at`, `tweet_id`, `user_id`) VALUES
(NULL, 1, 1),
(NULL, 1, 10),
(NULL, 3, 3),
(NULL, 3, 4),
('2022-09-18', 4, 2),
(NULL, 4, 4),
('2022-09-18', 10, 2),
('2022-09-18', 11, 2),
('2022-09-18', 11, 3);

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
(3, 'users/2/tweets/4/imag1.jpg', 2),
(4, 'users/2/tweets/4/imag1.jpg', 4),
(5, 'users/2/tweets/4/imag2.jpg', 4),
(7, 'users/21/tweets/.png', 6),
(8, 'users/21/tweets/1663420189.png', 6),
(9, 'users/21/tweets/1663420195.png', 6),
(10, 'users/2/tweets/4/imag1.jpg', 6),
(11, 'users/2/tweets/4/imag1.jpg', 6),
(12, 'users/21/tweets/6/1663420166.png', 6),
(13, 'users/21/tweets/7/1663420178.png', 7),
(14, 'users/21/tweets/7/1663420198.png', 7),
(15, 'users/22/tweets/8/1663420190.png', 8),
(16, 'users/19/tweets/8/1663420157.png', 8),
(17, 'users/19/tweets/9/1663420164.png', 9),
(18, 'users/19/tweets/9/1663420169.png', 9),
(19, 'users/2/tweets/10/imag1.jpg', 10),
(20, 'users/2/tweets/10/imag2.jpg', 10),
(21, 'users/2/tweets/10/imag3.jpg', 10),
(22, 'users/2/tweets/10/imag4.jpg', 10),
(23, 'users/2/tweets/16/1663524558.png', 16),
(24, 'users/2/tweets/17/1663524582.png', 17);

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
(1, 'houssein@gmail.com', 'Houssein', 'Droubi', '@houssein', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'NA', 'NA', '2022-09-01'),
(2, 'mouhamad@gmail.com', 'Mouhamad', 'Droubie', 'mouhamad@gmail.com1', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'users/2/profile/1663448400.png', 'users/2/cover/1663448400.png', '2022-01-02'),
(3, 'ali@gmail.com', 'Ali', 'Droubi', '@alie', 'test', 'users/3/profile/profile.png', 'NA\n', '2022-09-03'),
(4, 'nour@gmail.com', 'Nour', 'Doe', '@nour', 'test', 'NA', 'NA', '1899-12-31'),
(5, 'abbas@gmail.com', 'Abbas', 'Doe', '@Abbas', 'test', 'NA', 'NA', '2022-09-05'),
(6, 'samah@gmail.com', 'samah', 'Doe', '@samah', 'test', 'NA', 'NA', '2022-09-04'),
(7, 'joumana@gmail.com', 'Joumana', 'Doe', '@jumana', 'test', 'NA', 'NA\n', '2022-09-06'),
(8, 'fatima@gmail.com', 'Fatima', 'Doe', '@Fatima', 'test', 'NA', 'NA', '2022-09-08'),
(9, 'amal@gmail.com', 'Amal', 'Doe', '@amal', 'test', 'NA', 'NA', '2022-09-09'),
(10, 'zaynab@gmail.com', 'Zaynab', 'Doe', '@zaynab', 'test', 'NA', 'NA', '2022-09-10'),
(18, 'mahdi@gmail.com', 'Mahdi', 'Doe', '@Mahdi', 'tests', 'NA', 'users/18/cover/1663275600.png', '2022-09-15'),
(19, 'hassan@gmail.com', 'hassan', 'Doe', '@hassan', 'NA', 'NA', 'NA', '2022-09-15'),
(21, 'new@gmail.com', 'new', 'new', '@new', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', 'users/20/profile/1663362000.png', 'users/20/cover/1663362000.png', '2022-09-17'),
(61, 'sadadsasd@sdsd', 'saddsa', 'saddsa', '123adssad', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'users/61/profile/1663448400.png', 'users/61/cover/1663448400.png', '2022-09-18'),
(62, 'dsasda@', 'saddsa', 'sdads', 'adsasad', 'fc1f09ab08ebdd072ea6da53a5691abcc18c9163b1be1f0921a5adb50e3f5077', 'users/62/profile/1663448400.png', 'users/62/cover/1663448400.png', '2022-09-18'),
(63, 'sadsad@', 'asd', 'ads', 'dassda', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'users/63/profile/1663448400.png', 'users/63/cover/1663448400.png', '2022-09-18'),
(64, 'dsadas@', 'sad', 'dassda', 'dsasadads', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'users/64/profile/1663448400.png', 'users/64/cover/1663448400.png', '2022-09-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blockers`
--
ALTER TABLE `blockers`
  ADD PRIMARY KEY (`user_id`,`user_blocking`);

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
  ADD PRIMARY KEY (`tweet_id`,`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tweets_pictures`
--
ALTER TABLE `tweets_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
