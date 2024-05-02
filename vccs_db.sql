-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 05:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `appointment_t` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `starting_time` datetime NOT NULL,
  `ending_time` datetime NOT NULL,
  `outlite_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand_t`
--

CREATE TABLE `brand_t` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brand_t`
--

INSERT INTO `brand_t` (`id`, `name`, `category_id`) VALUES
(1, 'Shell', 1),
(2, 'Zic', 1),
(3, 'Caltex', 1),
(5, 'Castrol', 1),
(6, 'Excel', 2),
(7, 'Guard', 2),
(8, 'Guard', 3),
(9, 'Excel', 3),
(10, 'Michelin', 4),
(11, 'Dunlop', 4),
(12, 'Yokohama', 4),
(13, 'Castrol', 5),
(14, 'Zic', 5),
(15, 'Zic', 6),
(16, 'Castrol', 6),
(17, 'Guard', 7),
(18, 'Wagner', 7);

-- --------------------------------------------------------

--
-- Table structure for table `category_t`
--

CREATE TABLE `category_t` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category_t`
--

INSERT INTO `category_t` (`id`, `name`) VALUES
(1, 'Engine Oil'),
(2, 'Air Filter'),
(3, 'Oil Filter'),
(4, 'Tyre'),
(5, 'Gear Oil'),
(6, 'ATF'),
(7, 'Break Oil');

-- --------------------------------------------------------

--
-- Table structure for table `companyvehicle_t`
--

CREATE TABLE `companyvehicle_t` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `companyvehicle_t`
--

INSERT INTO `companyvehicle_t` (`id`, `name`, `company_id`) VALUES
(1, 'CIVIC', 1),
(2, 'CITY', 1),
(3, 'Accord', 1),
(4, 'S Class', 5),
(5, 'Corolla', 2),
(6, 'Mehran', 3),
(7, 'V2', 4),
(8, 'CClass', 5),
(9, 'M Suv', 5),
(10, 'Corolla Xli', 2),
(11, 'Corolla Gli', 2),
(12, 'Corolla Altis', 2),
(13, 'EXi', 2),
(14, 'Cultus', 3),
(15, 'Calza', 3),
(16, 'V1', 4),
(17, 'Bolan', 3);

-- --------------------------------------------------------

--
-- Table structure for table `company_t`
--

CREATE TABLE `company_t` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `company_t`
--

INSERT INTO `company_t` (`id`, `name`) VALUES
(1, 'Honda'),
(2, 'Toyota'),
(3, 'Suzuki'),
(4, 'FAW'),
(5, 'Mercedes');

-- --------------------------------------------------------

--
-- Table structure for table `customer_t`
--

CREATE TABLE `customer_t` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer_t`
--

INSERT INTO `customer_t` (`id`, `name`, `email`, `password`, `phone`, `gender`, `address`, `status`) VALUES
(1, 'Muhammad Awais', 'awais123@gmail.com', 'Pass123', '03312099410', 'male', 'mohala reshamkhan,khaur city, Tehsel Pindigheb, Dist Attock', 'yes'),
(4, 'Ramish Ayaz ', 'ramish123@gmail.com', 'Pass123', '03484951435', 'Male', 'Wahcantt', 'yes'),
(6, 'Usman khan', 'usman123@gmail.com', 'Pass123', '03111061917', 'Male', 'Burhan', 'yes'),
(21, 'Sharjeel', 'shahbazbintahir@gmail.com', 'Pass12345', '03355613777', 'Male', 'Jullian', 'yes'),
(27, 'Faraz Tariq', 'asadtariq@hotmail.com', 'Abcd@1234', '03311233211', 'Male', 'Gher Khan Haripur', 'yes'),
(28, 'Hamza Naeem', 'gulahmed@yahoo.com', 'Abcd@1234', '03131131313', 'Male', 'WahCantt', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_t`
--

CREATE TABLE `feedback_t` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `sales_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedback_t`
--

INSERT INTO `feedback_t` (`id`, `content`, `sales_id`, `customer_id`) VALUES
(4, 'Good I like your services and like to visit again', 21, 4),
(5, 'Best Services.', 18, 1),
(6, 'Friendly Staff, i will go there again.', 17, 6),
(7, 'good services.', 17, 28);

-- --------------------------------------------------------

--
-- Table structure for table `outlite_t`
--

CREATE TABLE `outlite_t` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lng` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `outlite_t`
--

INSERT INTO `outlite_t` (`id`, `name`, `address`, `lat`, `lng`) VALUES
(1, 'VCCS WahCantt', 'Aslam Market', '33.76473686017024', '72.76786759525694'),
(3, 'VCCS Khaur', 'Near POL cricket ground kahur city, Tehsel Pindigheb, District Attock', '33.264308211951686', '72.46522851058454'),
(5, 'VCCS Isalmabad', 'G7 , Islamabad , Pakistan', '33.70441717174858', '73.07158553851411'),
(6, 'VCCS Burhan', 'Near markazi jamia Masjid Burhan', '33.80927614215232', '72.5913396952099');

-- --------------------------------------------------------

--
-- Table structure for table `product_sales`
--

CREATE TABLE `product_sales` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `price_per_unit` float NOT NULL,
  `quantity` float NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_sales`
--

INSERT INTO `product_sales` (`id`, `name`, `unit`, `price_per_unit`, `quantity`, `sales_id`, `product_id`) VALUES
(21, 'Zic Moter Oil', 'liter', 79.5, 8.5, 16, NULL),
(22, 'Zic Moter Oil', 'liter', 79.5, 2, 17, NULL),
(23, 'HX3', 'liter', 45.5, 10, 16, NULL),
(24, 'HX3', 'liter', 45.5, 6, 18, NULL),
(25, 'Zic Moter Oil', 'liter', 79.5, 10, 18, NULL),
(26, 'Zic Moter Oil', 'liter', 79.5, 20, 19, NULL),
(27, 'Zic Moter Oil', 'liter', 79.5, 14, 20, NULL),
(28, 'Zic Moter Oil', 'liter', 79.5, 10, 21, NULL),
(29, 'shellX7', 'liter', 400, 1, 30, 2),
(30, 'HX3', 'Liter', 500, 3.5, 31, 3),
(31, 'Primacy 3', 'piece', 8000, 8, 32, 39),
(32, 'Break Fluid', 'liter', 400, 1, 33, 52),
(33, 'HX5', 'Liter', 600, 2, 34, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_t`
--

CREATE TABLE `product_t` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` float NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price_per_unit` float NOT NULL,
  `brand_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `outlite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_t`
--

INSERT INTO `product_t` (`id`, `name`, `quantity`, `unit`, `price_per_unit`, `brand_id`, `service_id`, `outlite_id`) VALUES
(2, 'shellX7', 9, 'liter', 400, 1, 10, 3),
(3, 'HX3', 6.5, 'Liter', 500, 1, 10, 3),
(4, 'HX5', 10, 'Liter', 600, 1, 10, 3),
(5, 'HX7', 15, 'Liter', 700, 1, 10, 3),
(6, 'X3', 20, 'Liter', 450, 2, 10, 3),
(7, 'X5', 20, 'Liter', 650, 2, 10, 3),
(8, 'X7', 20, 'Liter', 750, 2, 10, 3),
(9, 'CXT', 20, 'Liter', 570, 3, 10, 3),
(10, 'CXT Formula', 20, 'Liter', 850, 3, 10, 3),
(11, 'GTX', 20, 'Liter', 550, 5, 10, 3),
(12, 'EA 400', 20, 'piece', 80, 6, 16, 3),
(13, 'EA 401', 20, 'piece', 100, 6, 16, 3),
(14, 'EA 402', 20, 'piece', 100, 6, 16, 3),
(15, 'EA 405', 20, 'piece', 150, 6, 16, 3),
(16, 'EA 167', 20, 'piece', 300, 6, 16, 3),
(17, 'EA 168', 20, 'piece', 400, 6, 16, 3),
(18, 'GA 2000', 20, 'piece', 400, 7, 16, 3),
(19, 'GA 201', 20, 'piece', 500, 7, 16, 3),
(20, 'GA 202', 20, 'piece', 550, 7, 16, 3),
(21, 'GA 203', 20, 'piece', 580, 7, 16, 3),
(22, 'EO 421', 20, 'piece', 100, 9, 17, 3),
(23, 'EO 422', 20, 'piece', 120, 9, 17, 3),
(24, 'EO 101', 20, 'piece', 120, 9, 17, 3),
(25, 'EO 102', 20, 'piece', 150, 9, 17, 3),
(26, 'GO 151', 20, 'piece', 200, 8, 17, 3),
(27, 'GO 152', 20, 'piece', 220, 8, 17, 3),
(28, 'GO 158', 20, 'piece', 150, 8, 17, 3),
(29, 'GO 199', 20, 'piece', 200, 8, 17, 3),
(36, 'Eco', 20, 'piece', 4500, 11, 5, 3),
(39, 'Primacy 3', 12, 'piece', 8000, 10, 5, 3),
(40, 'Geolander', 20, 'piece', 6000, 12, 5, 3),
(41, 'ES 32', 20, 'piece', 6500, 12, 5, 3),
(42, 'A drive', 20, 'piece', 7000, 12, 5, 3),
(43, 'GL 4', 20, 'liter', 500, 13, 13, 3),
(44, 'Syntrans', 20, 'liter', 1000, 13, 13, 3),
(45, 'GFF', 20, 'liter', 950, 14, 13, 3),
(46, 'CVTF', 20, 'liter', 1000, 14, 13, 3),
(47, 'XP III', 20, 'liter', 750, 15, 15, 3),
(48, 'Dextron VI', 20, 'liter', 1100, 15, 15, 3),
(49, 'Dex iii', 20, 'liter', 550, 16, 15, 3),
(50, 'aw 1', 20, 'liter', 600, 16, 15, 3),
(52, 'Break Fluid', 19, 'liter', 400, 17, 14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `role_t`
--

CREATE TABLE `role_t` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role_t`
--

INSERT INTO `role_t` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `sales_t`
--

CREATE TABLE `sales_t` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `amountPaid` float NOT NULL DEFAULT 0,
  `customer_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `outlite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales_t`
--

INSERT INTO `sales_t` (`id`, `customer_name`, `date`, `amountPaid`, `customer_id`, `vehicle_id`, `outlite_id`) VALUES
(16, '', '2019-06-24 17:38:05', 1130.75, 4, NULL, 1),
(17, 'Ali khan', '2019-06-24 17:53:48', 0, NULL, NULL, 1),
(18, '', '2019-06-24 18:52:10', 1068, 4, NULL, 1),
(19, 'sanaullah', '2019-06-26 17:19:40', 0, NULL, NULL, 1),
(20, 'Ali khan', '2019-06-26 17:22:41', 1113, NULL, NULL, 1),
(21, '', '2019-06-26 23:54:46', 795, 4, NULL, 1),
(30, '', '2019-07-14 20:15:49', 400, 1, 11, 3),
(31, '', '2019-07-15 14:54:13', 1750, 1, 11, 3),
(32, '', '2019-07-15 14:57:15', 64000, 21, 14, 3),
(33, 'Sabiha', '2019-07-15 15:05:23', 400, NULL, NULL, 3),
(34, '', '2019-07-15 17:33:00', 1200, 1, 11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `service_t`
--

CREATE TABLE `service_t` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `outlite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service_t`
--

INSERT INTO `service_t` (`id`, `name`, `outlite_id`) VALUES
(4, 'Tyre Service', 1),
(5, 'Tyre Service', 3),
(6, 'Engine Oil Service', 1),
(10, 'Engine Oil Service', 3),
(11, 'Car Wash Service', 3),
(13, 'Gear Oil Service', 3),
(14, 'Break Oil Service', 3),
(15, 'ATF Service', 3),
(16, 'Air Filter Service', 3),
(17, 'Oil Filter Service', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_t`
--

CREATE TABLE `user_t` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_t`
--

INSERT INTO `user_t` (`id`, `name`, `email`, `password`, `role_id`) VALUES
(1, 'Muhammad Awais', 'admin.vccs@gmail.com', 'Pass123', 1),
(3, 'M Awais', 'manager.khaur@gmail.com', 'Pass123', 2),
(5, 'Ramish ', 'ramish.isl@gmail.com', 'Pass123', 2),
(6, 'Usman', 'usman.burhan@gmail.com', 'Pass123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_t`
--

CREATE TABLE `vehicle_t` (
  `id` int(11) NOT NULL,
  `identity_number` varchar(20) NOT NULL,
  `model` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vehicle_t`
--

INSERT INTO `vehicle_t` (`id`, `identity_number`, `model`, `vehicle_id`, `customer_id`) VALUES
(11, 'U-1', 2016, 1, 1),
(13, 'ICT-900', 2019, 2, 1),
(14, 'ICT-500', 2019, 1, 21),
(15, 'ICT-666', 2019, 3, 21),
(16, 'RS-123', 2019, 3, 1),
(17, 'RS-124', 2019, 6, 27),
(18, 'ES-111', 2019, 7, 27),
(19, 'AL-009', 1950, 8, 27),
(20, 'GL-008', 1940, 5, 27);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_t`
--
ALTER TABLE `appointment_t`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `outlite_id` (`outlite_id`);

--
-- Indexes for table `brand_t`
--
ALTER TABLE `brand_t`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category_t`
--
ALTER TABLE `category_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companyvehicle_t`
--
ALTER TABLE `companyvehicle_t`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `company_t`
--
ALTER TABLE `company_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_t`
--
ALTER TABLE `customer_t`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `feedback_t`
--
ALTER TABLE `feedback_t`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `outlite_t`
--
ALTER TABLE `outlite_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_t`
--
ALTER TABLE `product_t`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `outlite_id` (`outlite_id`);

--
-- Indexes for table `role_t`
--
ALTER TABLE `role_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_t`
--
ALTER TABLE `sales_t`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outlite_id` (`outlite_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `service_t`
--
ALTER TABLE `service_t`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outlite_id` (`outlite_id`);

--
-- Indexes for table `user_t`
--
ALTER TABLE `user_t`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `vehicle_t`
--
ALTER TABLE `vehicle_t`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identity_number` (`identity_number`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_t`
--
ALTER TABLE `appointment_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand_t`
--
ALTER TABLE `brand_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category_t`
--
ALTER TABLE `category_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `companyvehicle_t`
--
ALTER TABLE `companyvehicle_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `company_t`
--
ALTER TABLE `company_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_t`
--
ALTER TABLE `customer_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `feedback_t`
--
ALTER TABLE `feedback_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `outlite_t`
--
ALTER TABLE `outlite_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_t`
--
ALTER TABLE `product_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `role_t`
--
ALTER TABLE `role_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_t`
--
ALTER TABLE `sales_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `service_t`
--
ALTER TABLE `service_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_t`
--
ALTER TABLE `user_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicle_t`
--
ALTER TABLE `vehicle_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_t`
--
ALTER TABLE `appointment_t`
  ADD CONSTRAINT `appointment_t_ibfk_1` FOREIGN KEY (`outlite_id`) REFERENCES `outlite_t` (`id`),
  ADD CONSTRAINT `appointment_t_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer_t` (`id`);

--
-- Constraints for table `brand_t`
--
ALTER TABLE `brand_t`
  ADD CONSTRAINT `brand_t_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_t` (`id`);

--
-- Constraints for table `companyvehicle_t`
--
ALTER TABLE `companyvehicle_t`
  ADD CONSTRAINT `companyvehicle_t_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_t` (`id`);

--
-- Constraints for table `feedback_t`
--
ALTER TABLE `feedback_t`
  ADD CONSTRAINT `feedback_t_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_t` (`id`),
  ADD CONSTRAINT `feedback_t_ibfk_2` FOREIGN KEY (`sales_id`) REFERENCES `sales_t` (`id`);

--
-- Constraints for table `outlite_t`
--
ALTER TABLE `outlite_t`
  ADD CONSTRAINT `outlite_t_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user_t` (`id`);

--
-- Constraints for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD CONSTRAINT `product_sales_ibfk_2` FOREIGN KEY (`sales_id`) REFERENCES `sales_t` (`id`),
  ADD CONSTRAINT `product_sales_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product_t` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_t`
--
ALTER TABLE `product_t`
  ADD CONSTRAINT `product_t_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service_t` (`id`),
  ADD CONSTRAINT `product_t_ibfk_2` FOREIGN KEY (`outlite_id`) REFERENCES `outlite_t` (`id`),
  ADD CONSTRAINT `product_t_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brand_t` (`id`);

--
-- Constraints for table `sales_t`
--
ALTER TABLE `sales_t`
  ADD CONSTRAINT `sales_t_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer_t` (`id`),
  ADD CONSTRAINT `sales_t_ibfk_3` FOREIGN KEY (`outlite_id`) REFERENCES `outlite_t` (`id`),
  ADD CONSTRAINT `sales_t_ibfk_4` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle_t` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `service_t`
--
ALTER TABLE `service_t`
  ADD CONSTRAINT `service_t_ibfk_1` FOREIGN KEY (`outlite_id`) REFERENCES `outlite_t` (`id`);

--
-- Constraints for table `user_t`
--
ALTER TABLE `user_t`
  ADD CONSTRAINT `user_t_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role_t` (`id`);

--
-- Constraints for table `vehicle_t`
--
ALTER TABLE `vehicle_t`
  ADD CONSTRAINT `vehicle_t_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_t` (`id`),
  ADD CONSTRAINT `vehicle_t_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `companyvehicle_t` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
