-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2019 at 04:40 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vesti`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `comment` text NOT NULL,
  `articleid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `username`, `created`, `comment`, `articleid`) VALUES
(121, 'filip95', '2019-08-04 04:37:38', 'hfhffh', 16),
(122, 'admin', '2019-08-04 04:37:59', 'vxxvx', 16);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `category` varchar(64) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `category`, `created`) VALUES
(14, 'Naslov 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor vestibulum dolor sed rutrum. Vivamus malesuada diam at vehicula sagittis. Aliquam urna erat, lacinia quis mi nec, interdum rutrum metus. Vestibulum aliquam arcu a lorem vulputate, quis fermentum ante ultrices. Donec vestibulum metus vitae dolor laoreet, non rhoncus ligula porta. Nunc nec sollicitudin tellus. Sed elementum semper neque, sed laoreet massa vulputate non. Integer hendrerit vel lacus sit amet suscipit. Vivamus purus neque, feugiat a lectus porta, finibus ultrices massa. Maecenas hendrerit lacus a velit varius, at semper dui varius. Sed vehicula non mauris suscipit ullamcorper. ', 'Politika', '2019-08-08 14:29:05'),
(15, 'Naslov 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor vestibulum dolor sed rutrum. Vivamus malesuada diam at vehicula sagittis. Aliquam urna erat, lacinia quis mi nec, interdum rutrum metus. Vestibulum aliquam arcu a lorem vulputate, quis fermentum ante ultrices. Donec vestibulum metus vitae dolor laoreet, non rhoncus ligula porta. Nunc nec sollicitudin tellus. Sed elementum semper neque, sed laoreet massa vulputate non. Integer hendrerit vel lacus sit amet suscipit. Vivamus purus neque, feugiat a lectus porta, finibus ultrices massa. Maecenas hendrerit lacus a velit varius, at semper dui varius. Sed vehicula non mauris suscipit ullamcorper. ', 'Kultura', '2019-08-08 14:29:12'),
(16, 'Naslov 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor vestibulum dolor sed rutrum. Vivamus malesuada diam at vehicula sagittis. Aliquam urna erat, lacinia quis mi nec, interdum rutrum metus. Vestibulum aliquam arcu a lorem vulputate, quis fermentum ante ultrices. Donec vestibulum metus vitae dolor laoreet, non rhoncus ligula porta. Nunc nec sollicitudin tellus. Sed elementum semper neque, sed laoreet massa vulputate non. Integer hendrerit vel lacus sit amet suscipit. Vivamus purus neque, feugiat a lectus porta, finibus ultrices massa. Maecenas hendrerit lacus a velit varius, at semper dui varius. Sed vehicula non mauris suscipit ullamcorper. ', 'Sport', '2019-08-08 14:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `hashpassword` varchar(512) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `hashpassword`, `created`) VALUES
(15, 'admin', 'nikolicfilip1995@gmail.com', '$2y$10$nAUeTLipVS0wA2JSPf2PxuQTR3rSvvCprF.j7byqlHYtCcUrt7pea', '2019-08-06 18:07:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
