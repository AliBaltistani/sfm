-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2023 at 05:12 PM
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
-- Database: `schoolfeesys`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `c_name` varchar(255) DEFAULT NULL,
  `c_description` text DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `c_name`, `c_description`, `grade_id`, `delete_status`) VALUES
(12, 'English', 'English for Nursery class', 13, 0),
(13, 'Urdu', 'Urdu For Nursery', 13, 0),
(14, 'English ', 'English for Prep Class', 14, 0),
(15, 'Urdu', 'Urdu for Prep Class', 14, 0),
(16, 'Mathmatics', 'Subject Math for Prep Class', 14, 0),
(17, 'Urdu', '', 19, 0),
(18, 'Biology', '', 19, 0),
(19, 'Science', '', 19, 0);

-- --------------------------------------------------------

--
-- Table structure for table `enroll_course`
--

CREATE TABLE `enroll_course` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `dos` datetime NOT NULL DEFAULT current_timestamp(),
  `remark` text DEFAULT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll_course`
--

INSERT INTO `enroll_course` (`id`, `student_id`, `class_id`, `course_id`, `dos`, `remark`, `delete_status`) VALUES
(36, 52, 19, 17, '2023-10-22 12:35:29', NULL, 0),
(37, 52, 19, 18, '2023-10-22 12:35:29', NULL, 0),
(38, 52, 19, 19, '2023-10-22 12:35:29', NULL, 0),
(39, 52, 19, 17, '2023-10-22 16:12:33', NULL, 0),
(40, 52, 19, 18, '2023-10-22 16:12:33', NULL, 0),
(41, 52, 19, 17, '2023-10-22 16:13:22', NULL, 0),
(42, 52, 19, 18, '2023-10-22 16:13:22', NULL, 0),
(43, 53, 19, 17, '2023-10-22 19:35:53', NULL, 0),
(44, 53, 19, 18, '2023-10-22 19:35:53', NULL, 0),
(45, 53, 19, 19, '2023-10-22 19:35:53', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fees_details`
--

CREATE TABLE `fees_details` (
  `id` int(11) NOT NULL,
  `stdid` int(11) NOT NULL DEFAULT 0,
  `grade_id` int(11) NOT NULL DEFAULT 0,
  `admissionfee` int(11) NOT NULL DEFAULT 0,
  `tutionfee` int(11) NOT NULL DEFAULT 0,
  `hostelfee` int(11) NOT NULL DEFAULT 0,
  `libraryfee` int(11) NOT NULL DEFAULT 0,
  `transportfee` int(11) NOT NULL DEFAULT 0,
  `otherfee` int(11) NOT NULL DEFAULT 0,
  `totalfee` int(11) NOT NULL DEFAULT 0,
  `dscount_percent` int(11) NOT NULL DEFAULT 0,
  `total_discount` int(11) NOT NULL DEFAULT 0,
  `advancefee` int(11) NOT NULL DEFAULT 0,
  `remainfees` int(11) NOT NULL DEFAULT 0,
  `delete_status` int(11) NOT NULL DEFAULT 0,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_details`
--

INSERT INTO `fees_details` (`id`, `stdid`, `grade_id`, `admissionfee`, `tutionfee`, `hostelfee`, `libraryfee`, `transportfee`, `otherfee`, `totalfee`, `dscount_percent`, `total_discount`, `advancefee`, `remainfees`, `delete_status`, `timestamp`) VALUES
(27, 52, 19, 1000, 1850, 0, 0, 3500, 150, 6500, 10, 5850, 2000, 3850, 0, '2023-10-22 00:00:00'),
(28, 52, 19, 0, 1800, 0, 150, 3000, 10, 4960, 0, 0, 0, 3960, 0, '2023-11-01 00:00:00'),
(29, 52, 19, 2000, 5000, 3500, 400, 3500, 150, 14550, 25, 10913, 0, 5813, 0, '2023-10-22 00:00:00'),
(30, 53, 19, 1000, 1800, 0, 0, 3000, 0, 5800, 10, 5220, 1000, 4220, 0, '2023-10-22 00:00:00'),
(31, 53, 19, 0, 1850, 0, 150, 3000, 0, 5000, 0, 0, 0, 3000, 0, '2023-11-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fees_transaction`
--

CREATE TABLE `fees_transaction` (
  `id` int(255) NOT NULL,
  `trans_id` int(11) NOT NULL DEFAULT 0,
  `stdid` int(11) NOT NULL DEFAULT 0,
  `grade` varchar(255) DEFAULT NULL,
  `paid` int(255) NOT NULL,
  `submitdate` datetime NOT NULL DEFAULT current_timestamp(),
  `transcation_remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fees_transaction`
--

INSERT INTO `fees_transaction` (`id`, `trans_id`, `stdid`, `grade`, `paid`, `submitdate`, `transcation_remark`) VALUES
(62, 27, 52, '19', 2000, '2023-10-22 15:17:29', 'Advance payment'),
(63, 28, 52, 'Class 5th', 1000, '2023-10-22 18:40:33', 'payment received'),
(64, 29, 52, 'Class 5th', 100, '2023-10-22 19:18:51', 'payment recevied'),
(65, 29, 52, 'Class 5th', 5000, '2023-10-22 19:19:12', 'payment received'),
(66, 30, 53, '19', 1000, '2023-10-22 19:38:06', 'Advance payment'),
(67, 31, 53, 'Class 5th', 1000, '2023-10-22 19:40:52', 'payment received '),
(70, 31, 53, 'Class 5th', 1000, '2023-10-22 19:42:15', 'payment received ');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `delete_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `grade`, `detail`, `delete_status`) VALUES
(13, 'Nursery', 'nursery Class', '0'),
(14, 'Prep Class', '2nd standard ', '0'),
(15, 'Class 1th', 'fisrt Class', '0'),
(16, 'Class 2nd', '', '0'),
(17, 'CLass 3rd', '', '0'),
(18, 'Class 4th', '', '0'),
(19, 'Class 5th', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `upassword` varchar(250) NOT NULL DEFAULT 'std123',
  `sname` varchar(255) NOT NULL,
  `srollno` varchar(255) NOT NULL DEFAULT '1',
  `father_name` varchar(255) DEFAULT NULL,
  `joindate` datetime NOT NULL,
  `about` text NOT NULL,
  `contact` varchar(255) NOT NULL,
  `fees` int(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `balance` int(255) NOT NULL,
  `delete_status` enum('0','1') NOT NULL DEFAULT '0',
  `subject` varchar(250) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `emailid`, `upassword`, `sname`, `srollno`, `father_name`, `joindate`, `about`, `contact`, `fees`, `grade`, `balance`, `delete_status`, `subject`, `image`) VALUES
(52, 'karamat@gmail.com', 'c51e6d1e1f41b5799bb6a382e9ae8909dd5e6f50', 'Karamat Hussain', '11', 'Muhammad Ibrahim', '2023-10-04 00:00:00', '', '03823742342', 10913, '19', 5813, '0', NULL, NULL),
(53, 'muhammadali@gmail.com', '756536566c0e4f39e236fd391bd86e682a43b5b5', 'Muhammad Ali', '01', 'Ghulam Abbas', '2023-10-04 00:00:00', 'new Student', '03823742342', 5000, '19', 3000, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `lastlogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `emailid`, `lastlogin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@gmail.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `id` int(11) NOT NULL,
  `stdid` int(11) NOT NULL DEFAULT 0,
  `uname` varchar(250) DEFAULT NULL,
  `uemail` varchar(250) DEFAULT NULL,
  `umessage` text DEFAULT NULL,
  `delete_status` int(11) DEFAULT 0,
  `timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`id`, `stdid`, `uname`, `uemail`, `umessage`, `delete_status`, `timestamp`) VALUES
(4, 52, 'Karamat Hussain', 'karamat@gmail.com', 'This is new message from user karamat', 0, '2023-10-22 14:05:10'),
(5, 53, 'Muhammad Ali', 'muhammadali@gmail.com', 'this is testing message form user m ali', 0, '2023-10-22 14:44:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enroll_course`
--
ALTER TABLE `enroll_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `fees_details`
--
ALTER TABLE `fees_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stdid` (`stdid`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `fees_transaction`
--
ALTER TABLE `fees_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stdid` (`stdid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `enroll_course`
--
ALTER TABLE `enroll_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `fees_details`
--
ALTER TABLE `fees_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `fees_transaction`
--
ALTER TABLE `fees_transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enroll_course`
--
ALTER TABLE `enroll_course`
  ADD CONSTRAINT `enroll_course_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `grade` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enroll_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enroll_course_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fees_details`
--
ALTER TABLE `fees_details`
  ADD CONSTRAINT `fees_details_ibfk_1` FOREIGN KEY (`stdid`) REFERENCES `student` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_details_ibfk_2` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id`) REFERENCES `fees_details` (`stdid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`id`) REFERENCES `enroll_course` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD CONSTRAINT `user_queries_ibfk_1` FOREIGN KEY (`stdid`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
