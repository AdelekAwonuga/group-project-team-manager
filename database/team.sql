-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2020 at 11:14 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `swap_group` varchar(2) NOT NULL,
  `message` mediumtext NOT NULL,
  `action` int(11) NOT NULL,
  `sent_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `student_id`, `group_id`, `swap_group`, `message`, `action`, `sent_date`) VALUES
(1, 19003, 5, 'B', 'Congratulation Your Request has been proccessed to swap to group B', 1, '2020-04-26'),
(2, 19001, 5, 'B', 'We cant swap your group thanks', 0, '2020-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(5) NOT NULL,
  `no_in_group` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `no_in_group`) VALUES
(5, 'A', 2),
(6, 'B', 3);

-- --------------------------------------------------------

--
-- Table structure for table `group_file_requirement`
--

CREATE TABLE `group_file_requirement` (
  `r_id` int(11) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  `group_id` int(11) NOT NULL,
  `date_sent` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_file_requirement`
--

INSERT INTO `group_file_requirement` (`r_id`, `file_name`, `group_id`, `date_sent`) VALUES
(1, '354656.docx', 5, '2020-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `helps`
--

CREATE TABLE `helps` (
  `helps_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `helps`
--

INSERT INTO `helps` (`helps_id`, `student_id`, `message`, `date`) VALUES
(1, 19001, '	  my account is giving me problem sometime when login', '2020-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `help_reply`
--

CREATE TABLE `help_reply` (
  `reply_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help_reply`
--

INSERT INTO `help_reply` (`reply_id`, `student_id`, `message`, `date`) VALUES
(1, 19001, 'Your complain has been received we fix your problem and give you feedback.Thanks', '2020-04-26'),
(2, 19001, 'Your complain has been fix', '2020-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `member_comment`
--

CREATE TABLE `member_comment` (
  `c_id` int(11) NOT NULL,
  `s_student_id` int(11) NOT NULL,
  `r_student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `s_comment` mediumtext NOT NULL,
  `date_of_comment` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `processed_group_student`
--

CREATE TABLE `processed_group_student` (
  `p_id` int(11) NOT NULL,
  `student_id` int(5) NOT NULL,
  `group_id` int(5) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `processed_group_student`
--

INSERT INTO `processed_group_student` (`p_id`, `student_id`, `group_id`, `date`) VALUES
(10, 19001, 5, '2020-04-25'),
(11, 19003, 6, '2020-04-25'),
(12, 19005, 6, '2020-04-25'),
(13, 19004, 6, '2020-04-25'),
(14, 19002, 6, '2020-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `grouped` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `name`, `email`, `password`, `status`, `grouped`) VALUES
(1, 19001, 'bala aliyu', 'bala@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1),
(2, 19002, 'Gabril Mathew', 'mathewgb@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1),
(3, 19003, 'Chiama Emeka', 'cemeka@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1),
(4, 19004, 'Jabir Bala', 'jbala@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1),
(5, 19005, 'johson david', 'djson@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `swap_request`
--

CREATE TABLE `swap_request` (
  `request_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `swap_group` varchar(2) NOT NULL,
  `swap_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `swap_request`
--

INSERT INTO `swap_request` (`request_id`, `student_id`, `group_id`, `swap_group`, `swap_date`) VALUES
(2, 19001, 5, 'B', '2020-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `uploads_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `file_name` varchar(20) NOT NULL,
  `dates_upload` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`uploads_id`, `student_id`, `group_id`, `file_name`, `dates_upload`) VALUES
(1, 19001, 5, '623925.jpg', '2020-04-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_file_requirement`
--
ALTER TABLE `group_file_requirement`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `helps`
--
ALTER TABLE `helps`
  ADD PRIMARY KEY (`helps_id`);

--
-- Indexes for table `help_reply`
--
ALTER TABLE `help_reply`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `member_comment`
--
ALTER TABLE `member_comment`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `processed_group_student`
--
ALTER TABLE `processed_group_student`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `swap_request`
--
ALTER TABLE `swap_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`uploads_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_file_requirement`
--
ALTER TABLE `group_file_requirement`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `helps`
--
ALTER TABLE `helps`
  MODIFY `helps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `help_reply`
--
ALTER TABLE `help_reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `member_comment`
--
ALTER TABLE `member_comment`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `processed_group_student`
--
ALTER TABLE `processed_group_student`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `swap_request`
--
ALTER TABLE `swap_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `uploads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
