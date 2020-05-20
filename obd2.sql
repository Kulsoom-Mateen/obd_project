-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2020 at 12:11 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obd2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('abc@gmail.com', 'abc'),
('xyz', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `data_batch`
--

CREATE TABLE `data_batch` (
  `batch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_batch`
--

INSERT INTO `data_batch` (`batch_id`, `user_id`, `time_stamp`) VALUES
(1, 3, '2020-03-04 15:30:05'),
(2, 3, '2020-03-04 15:38:32'),
(3, 3, '2020-03-06 10:09:11'),
(4, 3, '2020-03-06 10:59:17'),
(5, 1, '2020-03-07 12:42:13'),
(6, 2, '2020-03-08 07:23:32'),
(7, 2, '2020-03-08 22:13:00'),
(8, 2, '2020-03-09 02:06:11'),
(9, 1, '2020-03-09 06:34:00'),
(10, 1, '2020-03-09 15:23:00'),
(11, 4, '2020-03-09 09:30:00'),
(12, 4, '2020-03-09 22:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `data_bulk`
--

CREATE TABLE `data_bulk` (
  `bulk_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `trip_id` varchar(11) NOT NULL,
  `heading` int(11) NOT NULL,
  `altitude` int(11) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `speed` smallint(6) NOT NULL,
  `fuel_level` tinyint(4) NOT NULL,
  `coolant_temperature` float NOT NULL,
  `intake_manifold_abs_pressure` float NOT NULL,
  `intake_air_temperature` float NOT NULL,
  `mass_flow_rate` int(11) NOT NULL,
  `throttle_position` tinyint(4) NOT NULL,
  `engine_load` tinyint(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_bulk`
--

INSERT INTO `data_bulk` (`bulk_id`, `batch_id`, `trip_id`, `heading`, `altitude`, `lat`, `lng`, `speed`, `fuel_level`, `coolant_temperature`, `intake_manifold_abs_pressure`, `intake_air_temperature`, `mass_flow_rate`, `throttle_position`, `engine_load`, `timestamp`) VALUES
(52, 3, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 40, 55.1651, 111.64, 116.423, 100, 99, 113, '2020-03-28 05:24:54'),
(53, 3, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 38, 58.1397, 118.845, 117.088, 106, 106, 107, '2020-03-28 05:25:29'),
(54, 3, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 36, 93.1549, 115.715, 110.462, 103, 111, 115, '2020-03-28 05:25:41'),
(55, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 34, 96.8203, 112.119, 100.79, 103, 115, 109, '0000-00-00 00:00:00'),
(56, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 32, 119.778, 117.402, 107.147, 120, 115, 116, '0000-00-00 00:00:00'),
(57, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 30, 116.635, 112.69, 109.276, 114, 107, 107, '0000-00-00 00:00:00'),
(58, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 28, 113.957, 119.92, 108.386, 115, 114, 119, '0000-00-00 00:00:00'),
(59, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 27, 114.826, 116.36, 119.93, 105, 119, 119, '0000-00-00 00:00:00'),
(60, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 24, 102.767, 100.131, 118.307, 118, 109, 98, '0000-00-00 00:00:00'),
(61, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 22, 102.767, 100.501, 118.801, 112, 103, 114, '0000-00-00 00:00:00'),
(62, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 20, 92.5422, 88.4453, 114.961, 118, 109, 111, '0000-00-00 00:00:00'),
(63, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 18, 106.111, 118.84, 107.689, 118, 113, 112, '0000-00-00 00:00:00'),
(64, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 16, 114.103, 111.66, 110.37, 104, 115, 110, '0000-00-00 00:00:00'),
(65, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 14, 119.706, 114.343, 106.112, 95, 111, 119, '0000-00-00 00:00:00'),
(66, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 12, 111.567, 114.059, 107.304, 85, 116, 109, '0000-00-00 00:00:00'),
(67, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 10, 105.543, 111.993, 104.837, 118, 117, 106, '0000-00-00 00:00:00'),
(68, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 8, 106.731, 114.53, 101.901, 113, 98, 108, '0000-00-00 00:00:00'),
(69, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 6, 119.792, 111.28, 105.434, 103, 110, 110, '0000-00-00 00:00:00'),
(70, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 60, 106.156, 102.973, 103.764, 119, 105, 116, '0000-00-00 00:00:00'),
(71, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 58, 115.726, 115.095, 97.7918, 114, 115, 119, '0000-00-00 00:00:00'),
(72, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 56, 105.365, 111.02, 94.2924, 119, 116, 113, '0000-00-00 00:00:00'),
(73, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 54, 115.735, 109.38, 113.171, 114, 112, 118, '0000-00-00 00:00:00'),
(74, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 52, 118.206, 113.974, 111.26, 107, 119, 119, '0000-00-00 00:00:00'),
(75, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 50, 102.205, 109.97, 118.111, 119, 107, 106, '0000-00-00 00:00:00'),
(76, 4, '2020-03-06-', 0, 82, 24.9333, 67.1126, 4, 47, 117.59, 103.425, 117.269, 115, 117, 113, '0000-00-00 00:00:00'),
(77, 4, '06-03-2020', 0, 78, 23.2113, 66.2387, 5, 54, 60.3422, 114.317, 109.345, 105, 104, 115, '2020-03-28 05:25:54'),
(78, 4, '06-03-2020', 0, 78, 23.2113, 66.2387, 5, 52, 63.1242, 113.564, 108.234, 104, 106, 113, '2020-03-28 05:26:04'),
(79, 5, '08-04-2020', 0, 80, 24.1674, 65.1113, 3, 59, 59.7364, 116.214, 110.252, 107, 102, 117, '2020-03-07 10:25:33'),
(80, 5, '07-03-2020', 0, 81, 25.1313, 64.6532, 3, 58, 64.2621, 112.346, 111.324, 105, 101, 118, '2020-03-27 02:44:32'),
(81, 5, '07-03-2020', 0, 81, 22.3655, 65.7473, 3, 56, 57.3462, 115.452, 110.346, 106, 110, 113, '2020-03-07 11:12:43'),
(82, 5, '07-03-2020', 0, 81, 25.3435, 68.2575, 3, 53, 64.2687, 112.532, 117.297, 107, 109, 117, '2020-03-07 11:25:12'),
(83, 6, '08-03-2020', 0, 83, 26.4322, 63.1467, 6, 64, 61.3422, 112.317, 110.349, 111, 104, 118, '2020-03-27 03:48:15'),
(84, 6, '08-03-2020', 0, 83, 27.2113, 64.2387, 4, 62, 60.1276, 111.584, 111.368, 107, 102, 120, '2020-03-27 03:48:34'),
(85, 7, '088-03-2020', 0, 85, 20.2134, 59.2387, 6, 60, 63.3422, 111.313, 103.341, 101, 108, 114, '2020-03-27 03:49:47'),
(86, 7, '08-03-2020', 0, 85, 21.7613, 60.2333, 6, 58, 67.2521, 112.422, 102.414, 105, 110, 120, '2020-03-27 03:50:44'),
(87, 8, '08-03-2020', 0, 83, 20.2143, 63.2313, 5, 34, 65.3417, 112.311, 107.309, 101, 109, 120, '2020-03-08 21:32:47'),
(88, 8, '08-03-2020', 0, 83, 20.2187, 64.2387, 7, 30, 67.1287, 114.56, 108.003, 104, 105, 114, '2020-03-26 22:17:00'),
(89, 11, '09-03-2020', 0, 85, 24.6532, 67.4296, 6, 59, 69.2521, 117.419, 106.258, 109, 101, 120, '2020-03-09 13:08:00'),
(90, 11, '09-03-2020', 0, 85, 24.5113, 66.9887, 7, 55, 70.3581, 118.242, 103.636, 106, 114, 122, '2020-03-09 19:22:34'),
(91, 9, '09-03-2020', 0, 76, 22.6982, 63.5829, 3, 80, 40, 111.491, 119.345, 110, 100, 111, '2020-03-09 05:28:00'),
(92, 9, '09-03-2020', 0, 76, 23.4525, 64.2514, 5, 75, 45, 112.414, 120.009, 108, 99, 107, '2020-03-09 05:49:18'),
(93, 10, '09-03-2020', 0, 74, 24.8793, 68.3758, 7, 30, 62.4931, 115.385, 110.578, 110, 105, 110, '2020-03-09 12:35:07'),
(94, 10, '09-03-2020', 0, 74, 24.8759, 69.2852, 8, 26, 62.4864, 114.274, 108.529, 113, 118, 108, '2020-03-09 13:30:40'),
(95, 12, '09-03-2020', 0, 82, 21.5215, 63.2358, 5, 76, 63.3422, 111.387, 119.345, 109, 111, 115, '2020-03-09 17:35:00'),
(96, 12, '09-03-2020', 0, 82, 22.4948, 65.3819, 8, 73, 62.4682, 110.478, 120.397, 110, 117, 109, '2020-03-09 19:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `vehicle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `vehicle`) VALUES
(1, 'itshamzakhalidhk@gmail.com', '$2y$10$i8omYklwqTw/hKaypMn4lOJitdR65350a.tBbtHNMX5.90dgyR87', 'Hamza Khalid', 'Honda'),
(2, 'anasali@gmail.com', '$2y$10$J5CkvamU7pHI0oiDzGIq1uK/UOMlrbp3UxidNn2wBrCQJWk/UmvhK', 'Anas Ali Shah', 'Toyota'),
(3, 'munibafaisal@gmail.com', '$2y$10$jy6g4jd9ECuXL4Ub2lQtx.KeklixjPQNfjye5Ot0uMN2k5bajLgy.', 'Muniba Faisal', 'Suzuki'),
(4, 'kulsoommateen07@gmail.com', 'abc', 'Kulsoom Mateen', 'Honda'),
(5, 'ali@email.com', '28912hkjafiuweru!@#efkj', 'Ali Khan', 'Suzuki'),
(6, 'ahmed@hotmail.com', 'kjaf@#%$$#fsd98345$##%^&*&', 'Ahmed Shah', 'Nissan'),
(7, 'monis@gmail.com', 'ekl$#%FDlk346456e%^%4', 'Monis Ali ', 'Toyota'),
(9, 'bilalali@gmail.com', 'asf36%^&@#*&(*(dsf&*(e', 'Bilal Khan', 'Toyota'),
(10, 'fatima@gmail.com', 'df#$%67845EFDfg345$67#$^$%', 'Fatima Ali', 'Suzuki'),
(11, 'aliya235@hotmail.com', 'fg#$%68@#%#4Fd%^7hfa', 'Aliya Khan', 'Honda'),
(12, 'usmanhamid@yahoo.com', 'd#$%567HGf8234hjkfdg$%6', 'Usman Hamid', 'Nissan'),
(13, 'nimrahtariq@gmail,com', 'fw#$%987fljk4395$&kjh8i435^%$6', 'Nimrah Tariq', 'Toyota'),
(14, 'bushraali@gmail.com', 'sdfhk346590856&%^&3%^#w', 'Bushra Ali', 'Toyota'),
(15, 'hamna@gmail.com', 'wdf$%^3446dsfg$%^46', 'Hamna Khan', 'Suzuki'),
(16, 'yasirahmed@gmail.com', 'asf36%^&@#*&(*(dsf&*(e', 'Yasir Ahmed', 'Toyota'),
(17, 'imran@gmail.com', 'ekl$#%FDlk346456e%^%4', 'Imran Ali', 'Toyota'),
(18, 'minal@gmail.com', 'asf36%^&@#*&(*(dsf&*(e', 'Minal', 'Toyota'),
(19, 'hifsakhan@gmail.com', 'asfkk5&$^789ufsdlk547^&%7', 'Hifsa Khan', 'Nissan'),
(20, 'majidkhan@gmail.com', 'sdjf$%^48yuskj54^%$75', 'Majid Khan', 'Toyota'),
(21, 'alishba@gmail.com', 'safhkjuy489456%&65', 'Alishba', 'Nissan'),
(22, 'amna@yahoo.com', 'afhkk346$5798r%$&%^*A', 'Amna', 'Toyota'),
(23, 'asmakhan@yahoo.com', 'asfD45ijfdklgj56%$&56', 'Asma Khan', 'Nissan'),
(24, 'zaraali@gmail.com', 'asf%^48u9guoo346$%', 'Zara Ali', 'Honda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_batch`
--
ALTER TABLE `data_batch`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `data_bulk`
--
ALTER TABLE `data_bulk`
  ADD PRIMARY KEY (`bulk_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_batch`
--
ALTER TABLE `data_batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `data_bulk`
--
ALTER TABLE `data_bulk`
  MODIFY `bulk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_batch`
--
ALTER TABLE `data_batch`
  ADD CONSTRAINT `data_batch_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `data_bulk`
--
ALTER TABLE `data_bulk`
  ADD CONSTRAINT `data_bulk_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `data_batch` (`batch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
