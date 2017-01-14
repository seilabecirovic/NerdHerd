-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2017 at 04:49 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nerdherd`
--
CREATE DATABASE IF NOT EXISTS `nerdherd` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci;
USE `nerdherd`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `reviID` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `quality` int(11) NOT NULL,
  `text` text COLLATE utf8_slovenian_ci,
  `xmlid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `text` text COLLATE utf8_slovenian_ci NOT NULL,
  `xmlid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `text`, `xmlid`) VALUES
(1, 'Someone', 'something.etwas@hotmail.com', 'Great website!!!!! I like it very much. You are doing good work.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `text` longtext COLLATE utf8_slovenian_ci NOT NULL,
  `picture1` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `picture2` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `picture3` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `xmlid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `email`, `title`, `text`, `picture1`, `picture2`, `picture3`, `xmlid`) VALUES
(1, 'Anonymous', 'something.etwas@hotmail.com', 'Westworld', '“Westworld” is television’s next big game-changer, a great, multilayered tapestry of action and unexpected analysis made hypnotic by creators Jonathan Nolan and Lisa Joy and a cast that includes Anthony Hopkins, Jeffrey Wright, James Marsden, Ed Harris, Thandie Newton and Evan Rachel Wood. It isn’t just great television, it’s vivid, thought-provoking television that entertains even as it examines the darker side of entertainment.\r\n“Westworld” is television’s next big game-changer, a great, multilayered tapestry of action and unexpected analysis made hypnotic by creators Jonathan Nolan and Lisa Joy and a cast that includes Anthony Hopkins, Jeffrey Wright, James Marsden, Ed Harris, Thandie Newton and Evan Rachel Wood. It isn’t just great television, it’s vivid, thought-provoking television that entertains even as it examines the darker side of entertainment.', 'uploads/ZZ53B761E4-1.jpg', 'uploads/evan-rachel-wood-2560x1440-westworld-hd-4k-2519-1.jpg', 'uploads/hLVjGxw-1.png', 174);

-- --------------------------------------------------------

--
-- Table structure for table `uncomments`
--

CREATE TABLE `uncomments` (
  `id` int(11) NOT NULL,
  `revID` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `quality` int(11) NOT NULL,
  `text` text COLLATE utf8_slovenian_ci,
  `xmlid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unconfirmedreviews`
--

CREATE TABLE `unconfirmedreviews` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `text` longtext COLLATE utf8_slovenian_ci NOT NULL,
  `picture1` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `picture2` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `picture3` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `xmlid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `button` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `button`) VALUES
(1, 'admin', '1a1dc91c907325c69271ddf0c944bc72', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviID` (`reviID`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uncomments`
--
ALTER TABLE `uncomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revID` (`revID`);

--
-- Indexes for table `unconfirmedreviews`
--
ALTER TABLE `unconfirmedreviews`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `uncomments`
--
ALTER TABLE `uncomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `unconfirmedreviews`
--
ALTER TABLE `unconfirmedreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`reviID`) REFERENCES `reviews` (`id`);

--
-- Constraints for table `uncomments`
--
ALTER TABLE `uncomments`
  ADD CONSTRAINT `uncomments_ibfk_1` FOREIGN KEY (`revID`) REFERENCES `reviews` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
