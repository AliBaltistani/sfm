-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 02:19 AM
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
(19, 42, 19, 17, '2023-09-29 09:13:08', NULL, 0),
(20, 42, 19, 18, '2023-09-29 09:13:08', NULL, 0),
(21, 42, 19, 19, '2023-09-29 09:13:08', NULL, 0),
(22, 43, 19, 17, '2023-09-30 12:26:10', NULL, 0),
(23, 43, 19, 18, '2023-09-30 12:26:10', NULL, 0),
(24, 43, 19, 19, '2023-09-30 12:26:10', NULL, 1),
(28, 49, 19, 17, '2023-10-02 08:38:41', NULL, 0),
(29, 49, 19, 19, '2023-10-02 08:38:41', NULL, 0),
(30, 49, 19, 18, '2023-10-02 08:38:41', NULL, 1),
(31, 50, 13, 12, '2023-10-10 23:28:10', NULL, 0),
(32, 50, 13, 13, '2023-10-10 23:28:10', NULL, 0),
(33, 51, 19, 17, '2023-10-10 23:31:33', NULL, 0),
(34, 51, 19, 18, '2023-10-10 23:31:33', NULL, 0),
(35, 51, 19, 19, '2023-10-10 23:31:33', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fees_details`
--

CREATE TABLE `fees_details` (
  `id` int(11) NOT NULL,
  `stdid` int(11) NOT NULL DEFAULT 0,
  `grade_id` int(11) DEFAULT NULL,
  `admissionfee` int(11) NOT NULL DEFAULT 0,
  `tutionfee` int(11) NOT NULL DEFAULT 0,
  `hostelfee` int(11) NOT NULL DEFAULT 0,
  `libraryfee` int(11) NOT NULL DEFAULT 0,
  `transportfee` int(11) NOT NULL DEFAULT 0,
  `otherfee` int(11) NOT NULL DEFAULT 0,
  `totalfee` int(11) NOT NULL DEFAULT 0,
  `advancefee` int(11) NOT NULL DEFAULT 0,
  `remainfees` int(11) NOT NULL DEFAULT 0,
  `delete_status` int(11) NOT NULL DEFAULT 0,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_details`
--

INSERT INTO `fees_details` (`id`, `stdid`, `grade_id`, `admissionfee`, `tutionfee`, `hostelfee`, `libraryfee`, `transportfee`, `otherfee`, `totalfee`, `advancefee`, `remainfees`, `delete_status`, `timestamp`) VALUES
(20, 42, 19, 1000, 1800, 4000, 100, 3000, 0, 9900, 0, 9000, 0, '2023-09-29 00:00:00'),
(21, 43, 19, 5000, 2000, 2000, 200, 2000, 200, 11400, 0, 10900, 0, '2023-09-01 00:00:00'),
(22, 43, 19, 0, 6000, 5000, 0, 0, 0, 11000, 0, 11000, 0, '2023-10-01 00:00:00'),
(24, 49, 19, 1000, 3000, 0, 2000, 2000, 0, 8000, 0, 7700, 0, '2023-10-02 00:00:00'),
(25, 49, 19, 0, 3000, 0, 2000, 2000, 0, 7000, 0, 7000, 0, '2023-11-02 00:00:00'),
(26, 51, 19, 1000, 20000, 0, 0, 0, 0, 21000, 0, 15000, 0, '2023-10-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fees_transaction`
--

CREATE TABLE `fees_transaction` (
  `id` int(255) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `stdid` varchar(255) NOT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `paid` int(255) NOT NULL,
  `submitdate` datetime NOT NULL DEFAULT current_timestamp(),
  `transcation_remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fees_transaction`
--

INSERT INTO `fees_transaction` (`id`, `trans_id`, `stdid`, `grade`, `paid`, `submitdate`, `transcation_remark`) VALUES
(55, 20, '42', 'Class 5th', 900, '2023-09-29 09:18:03', 'Initial Payment received'),
(56, 21, '43', 'Class 5th', 500, '2023-09-30 12:29:44', '500 received'),
(57, 24, '49', 'Class 5th', 300, '2023-10-02 08:41:33', '300 Payment received'),
(58, 26, '51', 'Class 5th', 1000, '2023-10-11 03:41:19', 'payment received '),
(59, 26, '51', 'Class 5th', 1500, '2023-10-11 03:41:35', 'payment received'),
(60, 26, '51', 'Class 5th', 3000, '2023-10-11 03:41:48', 'received'),
(61, 26, '51', 'Class 5th', 500, '2023-10-11 03:42:01', 'received');

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

INSERT INTO `student` (`id`, `emailid`, `upassword`, `sname`, `joindate`, `about`, `contact`, `fees`, `grade`, `balance`, `delete_status`, `subject`, `image`) VALUES
(42, 'sajidali@gmail.com', '5807ce7e9cb25bacaf6ee26cf806245704d3544b', 'Sajid Ali', '2023-09-01 00:00:00', 'New Student', '03488092160', 9900, '19', 9000, '0', NULL, NULL),
(43, 'demouser1@gmail.com', '1b5e54fe88b68bc480860406e0fc688edde58fcd', 'Demo User1', '2023-09-01 00:00:00', 'New Student', '03481234888', 11000, '19', 11000, '0', NULL, NULL),
(49, 'mali123@gmail.com', '5cf64593ce4aeacd56dbb5f5ec4db1fb30c6541a', 'M Ali', '2023-10-01 00:00:00', 'New Enroll ', '03495823432', 7000, '19', 7000, '0', NULL, 'images/my-pic.jpg'),
(50, 'mhdali@gmail.com', '11327ddc6c6fce12cebf73b9e89b6ecdcdfc95ee', 'M Ali', '2023-10-01 00:00:00', 'new student enroll', '0382342324', 0, '13', 0, '1', NULL, NULL),
(51, 'shakoorali@gmail.com', '28d09525e39fe33e30f641e9c3df1542f4907466', 'Shakoor Ali', '2023-10-02 00:00:00', 'new student  ', '028423424', 21000, '19', 15000, '0', NULL, 'images/WhatsApp Image 2023-09-21 at 22.21.07.jpg');

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
  `stdid` int(11) DEFAULT NULL,
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
(1, 0, 'mu ali', 'ads@mfil.com', 'megsar dfsadfsa', 0, '2023-10-10 23:44:27'),
(2, 51, 'newer', 'muhammadalid15@gmail.com', 'sfhhdfhadf', 0, '2023-10-10 23:46:35');

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
  ADD KEY `stdid` (`stdid`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `fees_details`
--
ALTER TABLE `fees_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `fees_transaction`
--
ALTER TABLE `fees_transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `fees_details_ibfk_1` FOREIGN KEY (`stdid`) REFERENCES `student` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
