-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2021 at 01:13 PM
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
-- Database: `whatsupdoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(6) UNSIGNED NOT NULL,
  `hospital_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone_number` int(11) UNSIGNED NOT NULL,
  `password` varchar(12) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone_number` int(11) UNSIGNED NOT NULL,
  `password` varchar(12) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `name`, `phone_number`, `password`, `gender`, `city`, `created_at`) VALUES
(2, 'Shahir', 3070251725, 'jsdknsdjnfld', 'male', 'lahore', '2021-11-18 16:57:28'),
(3, 'adnan', 90078601, 'jhsjfdhbw', 'other', 'islamabad', '2021-11-18 18:37:25'),
(4, '', 0, '', '', '', '2021-11-28 12:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_review`
--

CREATE TABLE `doctor_review` (
  `review_id` int(6) UNSIGNED NOT NULL,
  `patient_id` int(6) UNSIGNED NOT NULL,
  `doctor_id` int(6) UNSIGNED NOT NULL,
  `rating` int(1) UNSIGNED NOT NULL,
  `feedback` varchar(140) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_review`
--

INSERT INTO `doctor_review` (`review_id`, `patient_id`, `doctor_id`, `rating`, `feedback`, `created_at`) VALUES
(1, 2, 2, 5, 'grabbed my balls', '2021-11-28 12:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hospital_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone_number` int(11) UNSIGNED NOT NULL,
  `city` varchar(15) NOT NULL,
  `latitude` decimal(8,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hospital_id`, `name`, `phone_number`, `city`, `latitude`, `longitude`, `created_at`) VALUES
(1, 'Aga Khan', 4294967295, 'karachi', '32.171372', '34.288424', '2021-11-18 18:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_review`
--

CREATE TABLE `hospital_review` (
  `review_id` int(6) UNSIGNED NOT NULL,
  `hospital_id` int(6) UNSIGNED NOT NULL,
  `patient_id` int(6) UNSIGNED NOT NULL,
  `rating` int(1) UNSIGNED NOT NULL,
  `feedback` varchar(140) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `history_id` int(6) UNSIGNED NOT NULL,
  `patient_id` int(6) UNSIGNED NOT NULL,
  `type` varchar(10) NOT NULL,
  `details` varchar(140) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`history_id`, `patient_id`, `type`, `details`, `created_at`) VALUES
(1, 2, 'diagnosis', 'khara nai ho raha tha, boys nai cream kara di', '2021-11-28 11:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(6) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone_number` int(11) UNSIGNED NOT NULL,
  `password` varchar(12) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `city` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `first_name`, `last_name`, `phone_number`, `password`, `gender`, `date_of_birth`, `city`, `created_at`) VALUES
(1, 'Shahir', 'Shamim', 3070251725, '69696969', 'male', '1999-02-16', 'Karachi', '2021-11-17 17:25:49'),
(2, 'Laibah', 'Iqbal', 3059119585, '69696969', 'female', '2000-09-06', 'Lahore', '2021-11-17 17:28:30'),
(3, 'first_name', 'last_name', 1, 'password', 'shemale', '2021-11-17', 'Guggu Nanak', '2021-11-18 12:39:54'),
(4, 'sndjs', 'jsdnksj', 3067891234, 't@l!@!HZNr1W', 'male', '2007-03-04', 'lahore', '2021-11-18 16:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(6) UNSIGNED NOT NULL,
  `patient_id` int(6) UNSIGNED NOT NULL,
  `doctor_id` int(6) UNSIGNED NOT NULL,
  `type` varchar(10) NOT NULL,
  `details` varchar(140) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `slot`
--

CREATE TABLE `slot` (
  `slot_id` int(6) UNSIGNED NOT NULL,
  `timing` time NOT NULL,
  `date` date NOT NULL,
  `slot_status` varchar(10) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `doctor_id` int(6) UNSIGNED NOT NULL,
  `hospital_id` int(6) UNSIGNED NOT NULL,
  `patient_id` int(6) UNSIGNED NOT NULL,
  `appointment_status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `specialization_id` int(6) UNSIGNED NOT NULL,
  `doctor_id` int(6) UNSIGNED NOT NULL,
  `hospital_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `specialization_institute` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `doctor_review`
--
ALTER TABLE `doctor_review`
  ADD PRIMARY KEY (`review_id`,`patient_id`,`doctor_id`) USING BTREE,
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hospital_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `hospital_review`
--
ALTER TABLE `hospital_review`
  ADD PRIMARY KEY (`review_id`,`patient_id`,`hospital_id`) USING BTREE,
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`history_id`,`patient_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`,`patient_id`,`doctor_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `slot`
--
ALTER TABLE `slot`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `hospital_id` (`hospital_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`specialization_id`,`doctor_id`,`hospital_id`) USING BTREE,
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor_review`
--
ALTER TABLE `doctor_review`
  MODIFY `review_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hospital_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hospital_review`
--
ALTER TABLE `hospital_review`
  MODIFY `review_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `history_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slot`
--
ALTER TABLE `slot`
  MODIFY `slot_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `specialization_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`);

--
-- Constraints for table `doctor_review`
--
ALTER TABLE `doctor_review`
  ADD CONSTRAINT `doctor_review_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `doctor_review_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `hospital_review`
--
ALTER TABLE `hospital_review`
  ADD CONSTRAINT `hospital_review_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `hospital_review_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`);

--
-- Constraints for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `medical_history_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `slot`
--
ALTER TABLE `slot`
  ADD CONSTRAINT `slot_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `slot_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`),
  ADD CONSTRAINT `slot_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `specialization`
--
ALTER TABLE `specialization`
  ADD CONSTRAINT `specialization_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `specialization_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
