-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2024 at 02:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infosys`
--
CREATE DATABASE IF NOT EXISTS `infosys` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `infosys`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

DROP TABLE IF EXISTS `tbl_courses`;
CREATE TABLE `tbl_courses` (
  `id` int(255) NOT NULL,
  `course_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`id`, `course_name`) VALUES
(1, 'BSIT'),
(2, 'BSCS'),
(3, 'BSML'),
(4, 'BSBM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

DROP TABLE IF EXISTS `tbl_students`;
CREATE TABLE `tbl_students` (
  `id` int(254) NOT NULL,
  `user_id` int(254) NOT NULL,
  `student_number` varchar(12) NOT NULL,
  `student_firstname` varchar(25) NOT NULL,
  `student_mi` char(2) NOT NULL,
  `student_lastname` varchar(25) NOT NULL,
  `student_email` varchar(25) NOT NULL,
  `student_status` int(1) DEFAULT 0,
  `course_id` int(254) NOT NULL,
  `enrolled_at` timestamp NULL DEFAULT current_timestamp(),
  `accepted_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`id`, `user_id`, `student_number`, `student_firstname`, `student_mi`, `student_lastname`, `student_email`, `student_status`, `course_id`, `enrolled_at`, `accepted_at`, `deleted_at`) VALUES
(6, 13, '12345678910', 'First', 'T', 'Last', 'test@gmail.com', 1, 1, '2024-02-10 11:31:47', NULL, NULL),
(7, 16, '09876543210', 'Second Test', 'S', 'Second Last', 'test2@gmail.com', 0, 2, '2024-02-10 13:10:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_type` int(1) DEFAULT 0,
  `password` varchar(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `user_email`, `user_type`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'angelo', 'admin@gmail.com', 1, 'd033e22ae348aeb5660fc2140aec35850c4da997', '2024-02-10 06:49:44', '2024-02-10 09:51:04', NULL),
(13, 'First Test Last Test', 'test@gmail.com', 0, '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-02-10 11:31:47', '2024-02-10 11:31:47', NULL),
(16, 'Second Test Second Last', 'test2@gmail.com', 0, 'd033e22ae348aeb5660fc2140aec35850c4da997', '2024-02-10 13:10:53', '2024-02-10 13:15:56', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_user_id_index` (`user_id`),
  ADD KEY `student_course_id_index` (`course_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD CONSTRAINT `tbl_students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_students_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `tbl_courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
