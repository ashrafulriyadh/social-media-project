-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 10:14 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_author` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `post_id`, `user_id`, `comment`, `comment_author`, `date`) VALUES
(1, 8, 1, 'nice', 'riyadh', '2020-02-22 16:47:17'),
(2, 8, 1, 'add me plz', 'riyadh', '2020-02-22 16:50:29'),
(3, 1, 1, 'hi', 'Ashraful', '2020-02-25 14:38:22'),
(4, 1, 1, 'hi', 'Ashraful', '2020-02-25 14:38:27'),
(5, 17, 1, 'ok sir', 'Ashraful Riyadh', '2020-04-15 11:29:29'),
(6, 17, 1, 'ok sir', 'Ashraful Riyadh', '2020-04-15 11:29:32'),
(7, 17, 1, 'thik ase', 'Ashraful Riyadh', '2020-04-15 11:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `msg_sub` text NOT NULL,
  `msg_topic` text NOT NULL,
  `reply` text NOT NULL,
  `status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender`, `receiver`, `msg_sub`, `msg_topic`, `reply`, `status`, `msg_date`) VALUES
(1, '1', '3', 'how r u', 'have u eaten rice??', 'yeah', 'read', '2020-03-04 16:38:30'),
(2, '1', '3', 'hi', '', 'no_reply', 'read', '2020-05-12 15:58:00'),
(3, '1', '3', 'hi', 'hellooo im riyadh', 'no_reply', 'read', '2020-05-12 15:58:00'),
(4, '3', '1', 'test', 'testing', 'ok', 'read', '2020-03-05 14:28:35'),
(5, '1', '3', '2nd', 'this is my second msg', 'good', 'read', '2020-03-16 07:48:19'),
(6, '1', '3', 'tsting', 'kemon acho\r\n', 'valo', 'read', '2020-03-16 07:48:15'),
(7, '3', '1', 'huh', 'ahena msg', 'aise', 'read', '2020-03-16 07:48:40'),
(8, '1', '3', 'kire', 'kemon asos', 'valo asi', 'read', '2020-03-16 07:47:59'),
(9, '1', '3', 'hi rupa', 'kemon aco', 'vala', 'read', '2020-05-12 15:57:54'),
(10, '6', '1', '', 'hi', 'hello', 'read', '2020-05-13 16:20:01'),
(11, '1', '6', 'hi rupa', 'how r u', 'no_reply', 'read', '2020-05-13 16:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `topic_id`, `post_title`, `post_content`, `post_date`) VALUES
(2, 1, 0, 'hi', '', '2020-02-18 15:44:41'),
(3, 1, 0, 'hi', 'ki khbr', '2020-02-19 15:29:53'),
(4, 3, 0, 'hello', 'im new here add me', '2020-02-19 15:32:14'),
(5, 3, 0, 'testing', 'test post', '2020-02-19 15:32:33'),
(6, 3, 0, 'hey guys how r u', 'add me im blocked', '2020-02-19 15:32:47'),
(9, 1, 1, 'CORONA UPDATE', 'We recommend people to stay home and safe', '2020-03-23 14:19:46'),
(17, 1, 4, 'CORONA UPDATE', '1209 people of Bangladesh affected already. 50 people dead . Please stay home', '2020-04-15 11:01:54'),
(18, 1, 1, 'CORONA UPDATE', 'please stay at home. Be safe . Stay social distance to prevent Covid-19. If you need any food or somethingthen call 999. Be safe and stay safe', '2020-04-15 11:08:58'),
(19, 6, 3, 'Hi,', 'well done.....', '2020-05-13 16:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_name`) VALUES
(1, 'Notice'),
(2, 'Education'),
(3, 'Fun'),
(4, 'Important'),
(5, 'Discussion');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_department` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_birthday` text NOT NULL,
  `user_image` text NOT NULL,
  `user_reg_date` text NOT NULL,
  `user_last_login` text NOT NULL,
  `status` text NOT NULL,
  `ver_code` int(100) NOT NULL,
  `posts` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_department`, `user_gender`, `user_birthday`, `user_image`, `user_reg_date`, `user_last_login`, `status`, `ver_code`, `posts`) VALUES
(1, 'Ashraful Riyadh', '123456789', 'riyadh@gmail.com', 'IT', 'Male', '02-12-1997', 'dbz.jpg', '3243', '23423', 'verified', 0, 'yes'),
(2, 'Riad', '123456789', 'mdashrafulislamriyadh@gmail.com', 'IT', 'Male', '1996-12-02', 'default.jpg', '2020-02-15 19:06:14', '', 'verified', 767202410, 'no'),
(3, 'rupa', '123456789', 'rupa@gmail.com', 'CSE', 'Female', '1999-09-06', 'default.jpg', '2020-02-15 20:24:43', '', 'verified', 936776631, 'yes'),
(4, 'Ashraful Islam', '123456789', 'ashraful@gmail.com', 'IT', 'Male', '1996-12-02', 'default.jpg', '2020-03-16 15:21:20', '', 'unverified', 634447443, 'no'),
(5, 'Ashraful Islam', '123456789', 'ashrafulislam@gmail.com', 'IT', 'Male', '1996-12-02', 'default.jpg', '2020-03-16 15:23:03', '', 'verified', 1679131207, 'no'),
(6, 'Jannatul ferdouse', 'jannat12345', 'jannat@gmail.com', 'CSE', '1', '1999-09-06', 'default.jpg', '2020-05-13 22:09:10', '', 'verified', 196829239, 'yes'),
(7, 'LANIN', 'riyadh12345', 'lanin@gmail.com', 'EEE', 'Male', '1995-12-04', 'default.jpg', '2020-05-13 22:27:24', '', 'unverified', 1690069430, 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
