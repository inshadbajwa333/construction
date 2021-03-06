-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 12:51 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `constructionsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `c_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`c_id`, `type`, `name`, `email`, `message`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Painting', 'Inshad check', 'admin@gmail.com', 'sa', 0, '2021-11-09 11:29:28', '2021-11-09 11:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `login_reg`
--

CREATE TABLE `login_reg` (
  `users_id` int(11) NOT NULL,
  `users_username` varchar(30) NOT NULL,
  `users_email` varchar(30) NOT NULL,
  `users_phone` varchar(20) NOT NULL,
  `users_bio` longtext NOT NULL,
  `users_img` varchar(255) NOT NULL,
  `users_status` int(11) NOT NULL,
  `password` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_reg`
--

INSERT INTO `login_reg` (`users_id`, `users_username`, `users_email`, `users_phone`, `users_bio`, `users_img`, `users_status`, `password`, `created_at`, `status`) VALUES
(1, 'admin', 'admin@admin.com', '03005216426', '', '', 0, '123456', '2021-11-02 19:49:25', 'true'),
(2, 'edubaivi', 'inshad@onlytourism.com', '12', '12qw', 'philippines.png', 0, '12', '2021-11-04 12:44:19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `w_id` int(11) NOT NULL,
  `uId` int(11) NOT NULL,
  `w_before` varchar(255) NOT NULL,
  `w_after` varchar(255) NOT NULL,
  `w_before_explain` longtext NOT NULL,
  `w_after_explain` longtext NOT NULL,
  `w_cat` varchar(255) NOT NULL,
  `w_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`w_id`, `uId`, `w_before`, `w_after`, `w_before_explain`, `w_after_explain`, `w_cat`, `w_status`, `created_at`, `updated_at`) VALUES
(1, 2, 'a:2:{i:0;s:29:\"united-arab-emirates_(1)1.png\";i:1;s:12:\"nigeria1.png\";}', 'a:2:{i:0;s:16:\"philippines1.png\";i:1;s:11:\"images1.png\";}', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'const', 0, '2021-11-04 11:53:10', '2021-11-08 07:26:16'),
(2, 2, 'a:2:{i:0;s:29:\"united-arab-emirates_(1)1.png\";i:1;s:12:\"nigeria1.png\";}', 'a:2:{i:0;s:16:\"philippines1.png\";i:1;s:11:\"images1.png\";}', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'painting', 0, '2021-11-04 11:53:10', '2021-11-08 07:27:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `login_reg`
--
ALTER TABLE `login_reg`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`w_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_reg`
--
ALTER TABLE `login_reg`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
