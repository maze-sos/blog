-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2024 at 05:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `profile_pic`, `created_at`) VALUES
(1, 'Oni', 'oni@gmail.com', '$2y$10$qTA7WQ08PqYV.EgNr/gCUeukVLx/eG0U1tLg8z1NKzaXCqAsVVpLS', NULL, '2024-01-15 02:49:47'),
(2, 'Adesola', 'adesolaoni2001@gmail.com', '$2y$10$gUA841tqpCJW1FqalCu7WuiL0vEHv35WkTPJoqfuobXS9kMVeE3du', NULL, '2024-01-15 02:49:47'),
(3, 'Nife', 'Nife@gmail.com', '$2y$10$bkCRRNPABf3wo/bJym9grehRe2GrnodzfCcXklIY1JCwxAgdQLsdG', NULL, '2024-01-15 02:49:47'),
(4, 'Olu', 'olunife@gmail.com', '$2y$10$k.zgh5ONN0A6EkCC5O5YXO6RWNTikcMopfnqPZf.XZR05jCyB6Iry', 'uploads/65a2c40eafec4.jpg', '2024-01-15 02:49:47');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Test'),
(2, 'Next Test'),
(3, '3rd'),
(4, 'Lincoln');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `postpic` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `postpic`, `title`, `content`, `created_at`, `admin_id`, `category_id`) VALUES
(1, 'postuploads/65a5541316db9.jpg', 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit illo molestiae tenetur. Porro consectetur aut quas vitae aliquid dignissimos repellat, ipsum non nulla earum omnis! Laborum veniam cumque ratione illum!', '2024-01-14 14:02:50', 2, 2),
(2, 'postuploads/65a521b408112.jpeg', 'New Test', 'new new new new new new new new asdfhklenmd ehnknebkabvjab wbq jbcj beaw  jlwqa flbql qbl rf', '2024-01-14 14:15:01', 1, 1),
(4, 'postuploads/65a3f9229271a.jpg', 'Me Too', 'bwvcowvob 3bvpbwpib pihp eipv4wip iwep3wl mdkfnfkf eknekfndkm kendkdnkd kdndkdn', '2024-01-14 15:09:22', 1, 1),
(7, 'postuploads/65a446a64da49.png', 'Finally ', 'TOWS Analysis is a variant of the classic business tool, SWOT Analysis. Both TOWS and SWOT are having the same acronyms for Strengths, Weaknesses, Opportunities, and Threats, and in reverse order of the words.', '2024-01-14 20:40:06', 4, 2),
(8, 'postuploads/65a50c895d0af.png', 'Lincoln is Here Again', 'The main focus of Lincoln University and College is student-centered and student-directed.\r\nOur philosophy is that everyone has a claim to education to better their life, advance their career and reach their desired level of personal success.', '2024-01-15 10:44:25', 1, 4),
(9, 'postuploads/65a53fe2c2daa.jpg', 'Lincoln First Open Day', 'Lincoln will have their first open of this academic year on 20th of March, 2024; The Student will be Able to Showcase their Talents and Projects to Impress the Director.', '2024-01-15 14:23:30', 4, 4),
(10, 'postuploads/65a543906d2c1.jpg', 'Lincoln Tests', 'Lincoln will have their first test of this academic year on 28th of March, 2024; The Students will be sat in the ICT center of the School.', '2024-01-15 14:39:12', 2, 4),
(11, 'postuploads/65a54441b5fca.jpg', 'JAMB will come to Lincoln', 'Lincoln will host jamb candidates for this year\'s exam on 14th of April, 2024; The School got the Accreditation from Jamb and will now hope to increase their reputation in the city of Abuja', '2024-01-15 14:42:09', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_pic`, `create_at`, `password`) VALUES
(1, 'Ade', 'Ade@gmail.com', 'useruploads/65a3811374ebf.jpg', '2024-01-14 06:37:07', '$2y$10$jkCYl1C.adcJo9MU.9GsruLtSgf5WMYwXZ1bxfIkNFTSQTX7yeD8u'),
(2, 'Nike', 'Nike@gmail.com', 'useruploads/65a3817f13e8c.jpg', '2024-01-14 06:38:55', '$2y$10$uvwFyQR21zaroUl9UYx8k.uVnCbqcHZBb2SQ4u3V2Ib.XOdDmt8Yy'),
(3, 'Ore', 'Ore@gmail.com', 'useruploads/65a381b96d6c1.jpg', '2024-01-14 06:39:53', '$2y$10$ArycbrGtFVIKqS7YEvmkh.ZfUu.SXsGkhpIVRZZ1Etr5.WDvt296.'),
(4, 'Dami', 'Dami@gmail.com', 'useruploads/65a38210ae272.jpg', '2024-01-14 06:41:20', '$2y$10$hZ9KAhrEJHIwPe35cWq.T.XzptPs4h3p1veq/FjkgL81rvLpFCqza');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `visit_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `visit_time`) VALUES
(1, '::1', '2024-01-14 16:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `visit_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `ip_address`, `visit_time`) VALUES
(1, '::1', '2024-01-15 04:50:32'),
(2, '::1', '2024-01-15 04:50:32'),
(3, '::1', '2024-01-15 04:50:48'),
(4, '::1', '2024-01-15 04:50:48'),
(5, '::1', '2024-01-15 08:27:45'),
(6, '::1', '2024-01-15 08:27:47'),
(7, '::1', '2024-01-15 08:38:41'),
(8, '::1', '2024-01-15 08:38:42'),
(9, '::1', '2024-01-15 08:40:27'),
(10, '::1', '2024-01-15 08:40:27'),
(11, '::1', '2024-01-15 08:40:52'),
(12, '::1', '2024-01-15 08:40:52'),
(13, '::1', '2024-01-15 08:41:40'),
(14, '::1', '2024-01-15 08:41:40'),
(15, '::1', '2024-01-15 08:42:18'),
(16, '::1', '2024-01-15 08:42:18'),
(17, '::1', '2024-01-15 08:49:24'),
(18, '::1', '2024-01-15 08:49:24'),
(19, '::1', '2024-01-15 08:50:21'),
(20, '::1', '2024-01-15 08:50:21'),
(21, '::1', '2024-01-15 08:55:07'),
(22, '::1', '2024-01-15 08:55:07'),
(23, '::1', '2024-01-15 08:57:13'),
(24, '::1', '2024-01-15 08:57:13'),
(25, '::1', '2024-01-15 08:59:12'),
(26, '::1', '2024-01-15 08:59:12'),
(27, '::1', '2024-01-15 08:59:25'),
(28, '::1', '2024-01-15 08:59:26'),
(29, '::1', '2024-01-15 08:59:29'),
(30, '::1', '2024-01-15 08:59:29'),
(31, '::1', '2024-01-15 08:59:41'),
(32, '::1', '2024-01-15 08:59:41'),
(33, '::1', '2024-01-15 09:00:04'),
(34, '::1', '2024-01-15 09:00:05'),
(35, '::1', '2024-01-15 09:00:56'),
(36, '::1', '2024-01-15 09:00:56'),
(37, '::1', '2024-01-15 09:00:57'),
(38, '::1', '2024-01-15 09:00:57'),
(39, '::1', '2024-01-15 09:02:06'),
(40, '::1', '2024-01-15 09:02:06'),
(41, '::1', '2024-01-15 09:03:38'),
(42, '::1', '2024-01-15 09:03:38'),
(43, '::1', '2024-01-15 09:03:41'),
(44, '::1', '2024-01-15 09:03:41'),
(45, '::1', '2024-01-15 09:04:18'),
(46, '::1', '2024-01-15 09:04:18'),
(47, '::1', '2024-01-15 09:08:58'),
(48, '::1', '2024-01-15 09:08:59'),
(49, '::1', '2024-01-15 09:09:28'),
(50, '::1', '2024-01-15 09:09:28'),
(51, '::1', '2024-01-15 09:10:23'),
(52, '::1', '2024-01-15 09:10:23'),
(53, '::1', '2024-01-15 09:14:58'),
(54, '::1', '2024-01-15 09:14:59'),
(55, '::1', '2024-01-15 09:20:51'),
(56, '::1', '2024-01-15 09:21:00'),
(57, '::1', '2024-01-15 09:21:00'),
(58, '::1', '2024-01-15 09:21:43'),
(59, '::1', '2024-01-15 09:21:43'),
(60, '::1', '2024-01-15 09:22:10'),
(61, '::1', '2024-01-15 09:22:11'),
(62, '::1', '2024-01-15 09:46:50'),
(63, '::1', '2024-01-15 09:46:50'),
(64, '::1', '2024-01-15 09:47:20'),
(65, '::1', '2024-01-15 09:47:21'),
(66, '::1', '2024-01-15 10:27:40'),
(67, '::1', '2024-01-15 10:27:40'),
(68, '::1', '2024-01-15 10:27:45'),
(69, '::1', '2024-01-15 10:27:46'),
(70, '::1', '2024-01-15 10:28:25'),
(71, '::1', '2024-01-15 10:28:25'),
(72, '::1', '2024-01-15 10:28:41'),
(73, '::1', '2024-01-15 10:28:44'),
(74, '::1', '2024-01-15 10:28:44'),
(75, '::1', '2024-01-15 10:30:06'),
(76, '::1', '2024-01-15 10:30:07'),
(77, '::1', '2024-01-15 10:30:19'),
(78, '::1', '2024-01-15 10:30:19'),
(79, '::1', '2024-01-15 10:32:55'),
(80, '::1', '2024-01-15 10:32:55'),
(81, '::1', '2024-01-15 10:33:30'),
(82, '::1', '2024-01-15 10:33:31'),
(83, '::1', '2024-01-15 10:34:47'),
(84, '::1', '2024-01-15 10:34:47'),
(85, '::1', '2024-01-15 10:37:12'),
(86, '::1', '2024-01-15 10:37:12'),
(87, '::1', '2024-01-15 10:39:53'),
(88, '::1', '2024-01-15 10:39:54'),
(89, '::1', '2024-01-15 10:40:27'),
(90, '::1', '2024-01-15 10:40:27'),
(91, '::1', '2024-01-15 10:44:40'),
(92, '::1', '2024-01-15 10:44:41'),
(93, '::1', '2024-01-15 10:47:40'),
(94, '::1', '2024-01-15 10:47:40'),
(95, '::1', '2024-01-15 10:48:41'),
(96, '::1', '2024-01-15 10:48:41'),
(97, '::1', '2024-01-15 11:55:45'),
(98, '::1', '2024-01-15 11:55:46'),
(99, '::1', '2024-01-15 11:56:27'),
(100, '::1', '2024-01-15 11:56:27'),
(101, '::1', '2024-01-15 11:58:55'),
(102, '::1', '2024-01-15 11:58:55'),
(103, '::1', '2024-01-15 11:59:18'),
(104, '::1', '2024-01-15 11:59:18'),
(105, '::1', '2024-01-15 11:59:47'),
(106, '::1', '2024-01-15 11:59:47'),
(107, '::1', '2024-01-15 12:00:22'),
(108, '::1', '2024-01-15 12:00:22'),
(109, '::1', '2024-01-15 12:02:29'),
(110, '::1', '2024-01-15 12:02:29'),
(111, '::1', '2024-01-15 12:02:55'),
(112, '::1', '2024-01-15 12:02:56'),
(113, '::1', '2024-01-15 12:02:57'),
(114, '::1', '2024-01-15 12:02:57'),
(115, '::1', '2024-01-15 12:03:29'),
(116, '::1', '2024-01-15 12:03:29'),
(117, '::1', '2024-01-15 12:04:12'),
(118, '::1', '2024-01-15 12:04:12'),
(119, '::1', '2024-01-15 12:05:07'),
(120, '::1', '2024-01-15 12:05:08'),
(121, '::1', '2024-01-15 12:05:22'),
(122, '::1', '2024-01-15 12:05:23'),
(123, '::1', '2024-01-15 12:06:29'),
(124, '::1', '2024-01-15 12:06:30'),
(125, '::1', '2024-01-15 12:06:55'),
(126, '::1', '2024-01-15 12:06:55'),
(127, '::1', '2024-01-15 12:07:14'),
(128, '::1', '2024-01-15 12:07:14'),
(129, '::1', '2024-01-15 12:07:35'),
(130, '::1', '2024-01-15 12:07:35'),
(131, '::1', '2024-01-15 12:11:54'),
(132, '::1', '2024-01-15 12:11:54'),
(133, '::1', '2024-01-15 12:11:57'),
(134, '::1', '2024-01-15 12:11:57'),
(135, '::1', '2024-01-15 12:12:08'),
(136, '::1', '2024-01-15 12:12:08'),
(137, '::1', '2024-01-15 12:15:38'),
(138, '::1', '2024-01-15 12:15:38'),
(139, '::1', '2024-01-15 12:16:53'),
(140, '::1', '2024-01-15 12:16:53'),
(141, '::1', '2024-01-15 12:21:26'),
(142, '::1', '2024-01-15 12:21:26'),
(143, '::1', '2024-01-15 12:26:50'),
(144, '::1', '2024-01-15 12:26:50'),
(145, '::1', '2024-01-15 13:53:48'),
(146, '::1', '2024-01-15 13:53:48'),
(147, '::1', '2024-01-15 13:54:13'),
(148, '::1', '2024-01-15 13:54:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
