-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2023 at 11:42 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cruds_oke`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `username`, `password`) VALUES
(1, 'Admin User', 'admin', '2138cb5b0302e84382dd9b3677576b24'),
(2, 'ahmes', 'ahmes', 'a3896ee9a014514f8869ae23dd69ff5c'),
(3, 'Ikbal Saputra', 'ikbalBBM', '419f629b347d17cce8b7e98ed593df4c'),
(4, 'Inoru Akhmad', 'inoru', '2301e371d9a042d9ccd68e38d1374c75');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` varchar(11) NOT NULL,
  `phone` bigint NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `sex`, `phone`, `email`, `image`) VALUES
(1, 'Egin Putri', 'female', 9432398705, 'mbakEgin@gmail.com', 'avatar.png'),
(2, 'Safira', 'female', 9077685504, 'safira77@gmail.com', 'avatar.png'),
(3, 'John Doe', 'male', 9988775544, 'john@gmail.com', 'avatar.png'),
(52, 'Rajendriya Ahmes', 'male', 182388977, 'ikiahmes@gmail.com', 'WelcomeLinux.png'),
(54, 'sensasi delight', 'male', 82245669155, 'zainadam@gmail.com', 'boruto_karma.jpg'),
(55, 'aji sekar', 'male', 10923901, 'aji@gmail.com', 'ruangRapat.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
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
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
