-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 11:53 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `BillingID` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `OID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`BillingID`, `Address`, `OID`) VALUES
(11, 'Syambhu ko badar', 4),
(12, 'Pharping', 5),
(13, 'Sundhara', 6),
(14, 'Sundhara', 7),
(15, 'Sundhara', 1);

-- --------------------------------------------------------

--
-- Table structure for table `final_order`
--

CREATE TABLE `final_order` (
  `FOID` int(11) NOT NULL,
  `OID` int(11) DEFAULT NULL,
  `BillingID` int(11) DEFAULT NULL,
  `ShippingID` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `final_order`
--

INSERT INTO `final_order` (`FOID`, `OID`, `BillingID`, `ShippingID`, `email`) VALUES
(11, 4, 11, 0, 'hemantdongol@gmail.com'),
(12, 5, 12, 12, 'mhrznp8@gmail.com'),
(13, 6, 13, 13, 'hemantdongol@gmail.com'),
(14, 7, 14, 2, 'mhrznp8@gmail.com'),
(15, 1, 15, 3, 'mhrnp8@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_product`
--

CREATE TABLE `ordered_product` (
  `ODID` int(11) NOT NULL,
  `OID` int(11) NOT NULL,
  `PID` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `ordered_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordered_product`
--

INSERT INTO `ordered_product` (`ODID`, `OID`, `PID`, `Quantity`, `Price`, `ordered_date`) VALUES
(20, 4, 5, 1, '60000', '2023-08-10 14:43:46'),
(21, 4, 4, 3, '260000', '2023-08-10 14:43:46'),
(22, 5, 16, 5, '60000', '2023-08-10 14:44:23'),
(23, 5, 11, 4, '75999', '2023-08-10 14:44:23'),
(24, 6, 3, 1, '160000', '2023-08-10 14:57:47'),
(25, 7, 11, 1, '75999', '2023-08-10 14:59:03'),
(26, 1, 3, 1, '160000', '2023-08-10 15:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Image` text DEFAULT NULL,
  `Description` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`PID`, `Name`, `Price`, `Image`, `Description`) VALUES
(2, 'Iphone 12', '200000', 'news_images/apple_12.png', 'The iPhone 12 use Apple\'s six-core A14 Bionic processor, which contains a next-generation neural engine. They both have three internal storage options: 64, 128, and 256 GB.[a] Both also carry an IP68 water and dust resistance rating along with dirt and grime, and is water-resistant up to six meters (20 feet) for 30 minutes.'),
(3, 'OnePlus 10 Pro', '160000', 'news_images/one_plus.png', 'The OnePlus 10 Pro\'s 6.7\" QHD+ 120 Hz Fluid AMOLED display incorporates stunning LTPO 2.0 technology and exacting color accuracy. Complemented by higher power efficiency, the refresh rate dynamically scales from 1 Hz to 120 Hz with second-generation LTPO calibration.'),
(4, 'Samsung S23 Ultra', '260000', 'news_images/samsung_s23.png', 'It is a 200MP flagship sensor specifically made for the S23 Ultra with a 1/1.3” sensor with 0.6µm pixels. This puts it between the HP1 and HP3, which have 1/1.22” and 1/1.4” sensor sizes, respectively. The new sensor takes 12.5MP photos by default with 16:1 pixel binning. Likewise, it will enable 8K recording at 30fps in contrast to 24fps on previous generations.'),
(5, 'Vivo v27', '60000', 'news_images/vivo_v27.png', 'Vivo V27 is an excellent phone with an impressive design, vibrant display, reliable cameras, and satisfactory performance. The handset features a 120Hz AMOLED display and a 50MP triple-camera setup. The phone runs the latest Android 13 OS and offers 66W fast charging support. However, it lacks microSD card support. If you are particularly looking for the smartphone with good display, excellent cameras, and long-lasting battery life.'),
(8, 'Iphone 14 pro max', '250000', 'news_images/iphone14.png', 'The iPhone 14 Pro Max feature a Super Retina XDR OLED display with a typical maximum brightness of 1,000 nits. However, it can go all the way up to 1,600 nits while watching HDR videos, and 2,000 nits outdoors. The display has a refresh rate of 120 Hz and utilizes LTPO technology.'),
(9, 'One Plus 11', '129999', 'news_images/oneplus_11.jpg', 'The OnePlus 11 comes with 6.7-inch AMOLED display with 120Hz refresh rate and Qualcomm Snapdragon 8 Gen 2 processor. Specs also include 5000mAh battery with 80W charging speed and Triple camera setup on the back with 50MP main sensor.'),
(10, 'MI 10', '32000', 'news_images/mi10.png', 'The Xiaomi Mi 10 has an utterly beautiful and premium-looking design that will draw your eyes to it. The internal hardware includes the latest and most powerful of Qualcomm\'s mobile platforms, the Snapdragon 865.'),
(11, 'Asus Rog 3', '75999', 'news_images/asusrog.jpg', 'GAME CHANGER. ROG Phone 3 is the most powerful gaming phone to use the latest Qualcomm ® Snapdragon ™ 865 Plus 5G Mobile Platform with advanced 5G 1 mobile communications capabilities. Built to satisfy even the most hardcore gamer, it has an amazing new 144 Hz / 1 ms display that leaves the competition standing.'),
(16, 'Oppo Reno 8', '60000', 'news_images/Oppo_reno.jpg', 'Oppo Reno8 Android smartphone. Announced Jul 2022. Features 6.4″ display ... 6.4\" 1080x2400 pixels; 50MP 2160p; 8/12GB RAM Dimensity 1300; 4500mAh Li-Po.\r\n\r\nBest out of budget phone.'),
(17, 'Oppo Reno 10 pro', '51775', 'news_images/reno_10.png', 'Oppo Reno 10 Pro is the company\'s latest premium smartphone in the Reno 10 series. The new smartphone under Rs. 40,000 features a glass-back design, a curved 120Hz AMOLED display and a 4600mAh battery. It also has a triple-camera setup on the back with a 32-megapixel telephoto lens and a 50-megapixel primary camera.');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shippingId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `OID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shippingId`, `address`, `OID`) VALUES
(1, 'Thamel', 6),
(2, 'Sundhara', 7),
(3, 'Sundhara', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`BillingID`),
  ADD KEY `OID` (`OID`);

--
-- Indexes for table `final_order`
--
ALTER TABLE `final_order`
  ADD PRIMARY KEY (`FOID`),
  ADD UNIQUE KEY `OID` (`OID`),
  ADD KEY `BillingID` (`BillingID`),
  ADD KEY `ShippingID` (`ShippingID`);

--
-- Indexes for table `ordered_product`
--
ALTER TABLE `ordered_product`
  ADD PRIMARY KEY (`ODID`),
  ADD KEY `PID` (`PID`),
  ADD KEY `OID` (`OID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shippingId`),
  ADD KEY `OID` (`OID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `BillingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `final_order`
--
ALTER TABLE `final_order`
  MODIFY `FOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ordered_product`
--
ALTER TABLE `ordered_product`
  MODIFY `ODID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shippingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
