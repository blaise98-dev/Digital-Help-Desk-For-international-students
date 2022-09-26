-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2022 at 10:49 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online-admission`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(4) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'assistant', '123'),
(3, 'cashier', '123');

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `ID` int(3) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `sex` varchar(15) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fathername` varchar(200) NOT NULL,
  `mothername` varchar(200) NOT NULL,
  `lga` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `passport_number` varchar(20) NOT NULL,
  `grade_score` int(3) NOT NULL,
  `faculty` varchar(30) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `proficiency_test` varchar(30) NOT NULL,
  `ssce` varchar(200) NOT NULL,
  `status` varchar(44) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `date_admission` varchar(22) NOT NULL,
  `applicationID` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`ID`, `fullname`, `sex`, `phone`, `email`, `password`, `fathername`, `mothername`, `lga`, `state`, `passport_number`, `grade_score`, `faculty`, `dept`, `proficiency_test`, `ssce`, `status`, `photo`, `date_admission`, `applicationID`) VALUES
(31, 'OUNG-VANG Moise II Bonheur', 'Male', '0784319074', 'oungvang11@gmail.com', '123456789', '', '', 'Tchad', ' Ndjamena', 'R0426715', 79, 'Information Technology', 'Software engineering', 'TOEFL', 'upload/Result-Report-card-software.jpeg', '1', 'upload/Result-Report-card-software.jpeg', '2022-08-25', '202215493'),
(32, 'Blaise NINDENKIMANA', 'Male', '0783530924', 'bnindenkimana2@gmail.com', '12345', '', '', '', 'Rwanda', 'pser4e', 78, 'Engineering', 'Software engineering', 'TOEFLjh', 'upload/Result-Report-card-software.png', '1', 'upload/default.jpg', '2022-09-16', '202210419');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Single'),
(2, 'Single-Family Home'),
(3, 'Multi-Family Home'),
(4, '2-story house');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL DEFAULT '../upload/',
  `file_name` varchar(255) NOT NULL,
  `reason` varchar(80) NOT NULL,
  `document_owner` varchar(255) NOT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `file_path`, `file_name`, `reason`, `document_owner`, `uploaded_on`) VALUES
(1, '../upload/', '202215493_visaDoc_20210226_124551.jpg', 'visa', '202215493', '2022-09-08 19:04:14'),
(3, '../upload/', '202215493_20210226_124551.jpg', 'application', '202215493', '2022-09-08 19:04:07'),
(4, '../upload/', '202215493_20210226_124559.jpg', 'application', '202215493', '2022-09-08 19:04:03'),
(11, '../upload/', '202215493_visaDoc_CCATS_PROPOSAL.pdf', 'visa', '202215493', '2022-09-14 16:19:01'),
(14, '../upload/', '202215493_visaDoc_Gant chart.pdf', 'application', '202215493', '2022-09-14 16:57:05'),
(15, '../upload/', '202215493_auca2jpg.jpg', 'application', '202215493', '2022-09-14 17:02:53'),
(16, '../upload/', '202215493_avatar-01.jpg', 'application', '202215493', '2022-09-14 17:02:53'),
(17, '../upload/', '202215493_visaDoc_Afinal marks of year3 cs.JPG', 'visa', '202215493', '2022-09-14 17:10:38'),
(18, '../upload/', '202215493_visaDoc_Ethical hacking certificate.pdf', 'visa', '202215493', '2022-09-14 17:10:39'),
(19, '../upload/', '202215493_visaDoc_motivation-letter-for-internship.pdf', 'visa', '202215493', '2022-09-14 18:38:24'),
(20, '../upload/', '202215493_visaDoc_Motivation-Letter-for-job-application-3.pdf', 'visa', '202215493', '2022-09-14 18:38:24'),
(21, '../upload/', '202215493_visaDoc_Motivation-Letter-for-Scholarship-01-1-724x1024.pdf', 'visa', '202215493', '2022-09-14 18:38:24'),
(22, '../upload/', '202210419_visaDoc_Ethical hacking certificate.pdf', 'visa', '202210419', '2022-09-16 19:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(30) NOT NULL,
  `house_no` varchar(50) NOT NULL,
  `category_id` int(30) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `house_no`, `category_id`, `description`, `price`) VALUES
(2, '12', 1, 'Folions shdhdhdjh', 28985500),
(6, '123', 3, 'Presidential houses', 6700),
(8, '123', 1, 'ilii', 6700);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(30) NOT NULL,
  `payfor` varchar(200) NOT NULL,
  `month` varchar(200) NOT NULL,
  `amount` float NOT NULL,
  `transaction_code` int(11) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `academic_year` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `applicationID` int(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `tenant_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payfor`, `month`, `amount`, `transaction_code`, `phone`, `academic_year`, `status`, `applicationID`, `date_created`, `tenant_id`) VALUES
(4, 'registration', '', 2300, 0, '', '2022-2023', 'paid', 202215493, '2022-09-16 07:32:26', 23),
(5, 'registration', '', 2300, 0, '', '2022-2023', 'paid', 0, '2022-09-16 07:32:43', 23),
(6, 'accomodation', '', 1500, 0, '', '2002', 'paid', 202215493, '2022-09-16 08:01:04', 0),
(7, 'accomodation', '', 123, 757686995, '', '2012-2022', 'paid', 202215493, '2022-09-16 08:20:05', 0),
(8, 'accomodation', '', 123, 24, '0783530924', '2012-2022', 'paid', 202215493, '2022-09-16 08:42:10', 0),
(9, 'accomodation', '', 123, 85, '0725172665', '2012-2022', 'paid', 202215493, '2022-09-16 08:58:12', 0),
(10, 'accomodation', '', 123, 27, '0725172665', '2012-2022', 'paid', 202215493, '2022-09-16 09:05:39', 0),
(11, 'registration', '2022-09', 23000, 0, '0725172665', '2021-2022', 'paid', 202215493, '2022-09-16 09:09:53', 0),
(12, 'accomodation', '2022-03', 2, 0, '0783530924', '2021-2022', 'paid', 202215493, '2022-09-16 09:22:44', 0),
(13, 'registration', '2022-07', 2, 2147483647, '0783530924', '2021-2022', 'paid', 202215493, '2022-09-16 09:28:46', 0),
(14, 'registration', '2022-06', 123, 1684726, '0783530924', '2012-2022', 'paid', 202215493, '2022-09-16 09:31:51', 0),
(15, 'accomodation', '2022-06', 2000, 354, '0784319074', '2021-2022', 'paid', 202215493, '2022-09-16 13:53:38', 0),
(16, 'registration', '2022-09', 123, 88, '0783530924', '2021-2022', 'paid', 202210419, '2022-09-16 21:40:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` int(30) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `house_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 0= inactive',
  `date_in` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `firstname`, `lastname`, `email`, `contact`, `house_id`, `status`, `date_in`) VALUES
(5, 'MOISE II', 'OUNG-VANG Bonheur', 'ouvang11@gmail.com', '0784319074', 6, 1, '2022-08-25'),
(7, 'Blaise', 'NINDENKIMANA', 'bnindenkimana2@gmail.com', '0783530924', 4, 1, '2022-09-13'),
(8, 'Blaise', 'NINDENKIMANA', 'bnindenkimana2@gmail.com', '0783530924', 3, 1, '2022-08-29'),
(9, 'Blaise', 'NINDENKIMANA', 'bnindenkimana2@gmail.com', '0783530924', 0, 1, '2022-09-21'),
(10, 'Blaise', 'NINDENKIMANA', 'bnindenkimana2@gmail.com', '1234', 2, 1, '2022-09-13'),
(11, 'Blaise', 'NINDENKIMANA', 'bnindenkimana2@gmail.com', '0783530924', 8, 1, '2022-09-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_owner` (`document_owner`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
