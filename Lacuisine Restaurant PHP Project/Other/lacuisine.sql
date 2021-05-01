-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 14, 2020 at 05:29 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lacuisine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adm_id` int(222) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`adm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(6, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@gmail.com', '', '2018-04-09 07:36:18'),
(9, 'mak', '9e95f6d797987b7da0fb293a760fe57e', 'asifayub836@gmail.com', 'QX5ZMN', '2020-09-14 10:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `admin_codes`
--

DROP TABLE IF EXISTS `admin_codes`;
CREATE TABLE IF NOT EXISTS `admin_codes` (
  `id` int(222) NOT NULL AUTO_INCREMENT,
  `codes` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(1, 'QX5ZMN'),
(3, 'QMZR92');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `c_id` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`, `date`) VALUES
('1', 'Lacuisine Traditional', '2020-09-13 16:50:03'),
('2', 'Lacuisine Chinese', '2020-09-13 16:50:22'),
('3', 'Lacuisine Fast Food', '2020-09-13 16:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `CNIC` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  PRIMARY KEY (`CNIC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`CNIC`, `Name`, `Phone`, `Email`) VALUES
('1210157236327', 'Muhammad Asif Ayub', '5022021200', 'asifayub836@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CNIC` varchar(255) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`CNIC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `DID` varchar(255) NOT NULL,
  `OID` varchar(255) NOT NULL,
  `ATime` time NOT NULL,
  `DTime` time NOT NULL,
  PRIMARY KEY (`DID`),
  KEY `OID` (`OID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

DROP TABLE IF EXISTS `dishes`;
CREATE TABLE IF NOT EXISTS `dishes` (
  `D_ID` int(222) NOT NULL AUTO_INCREMENT,
  `RS_ID` int(222) NOT NULL,
  `FName` varchar(222) NOT NULL,
  `Description` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL,
  PRIMARY KEY (`D_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`D_ID`, `RS_ID`, `FName`, `Description`, `price`, `img`) VALUES
(1, 1, 'Bonefish', 'Three ounces of lightly seasoned fresh fish', '800.00', '5ad7582e2ec9c.jpg'),
(2, 1, 'Hard Rock Cafe', 'A mix of chopped lettuces, shredded cheese, chicken cubes', '500.00', '5ad7590d9702b.jpg'),
(3, 1, 'Uno Pizzeria & Grill', 'Kids can choose their pasta shape, type of sauce, favorite veggies (like broccoli or mushrooms)', '600.00', '5ad7597aa0479.jpg'),
(4, 2, 'Red Robins Chick on a Stick', 'Plain grilled chicken breast? Blah.', '1000.00', '5ad759e1546fc.jpg'),
(6, 3, 'Houlihans Mini Cheeseburger', 'Creekstone Farms, where no antibiotics or growth hormones are used', '700.00', '5ad75a5dbb329.jpg'),
(8, 3, 'Mutton Karahi', 'spicy mutton karahi with cheez and sausage', '1500.00', '5f5f7a9bf21ed.jpg'),
(9, 2, 'Chicken Biryani', 'spicy Chicken Biryani with grilled egg and sauces', '500.00', '5f5f8edd7060f.jpg'),
(10, 3, 'Chicken Spring Rolls', 'Chicken Pot Pie â€“ Roast chicken, baby carrots, spring peas topped with grandmaâ€™s flakey pie crust.', '600.00', '5f5fa387a7480.jpg'),
(11, 3, 'Fish Cracker', 'Fish crackers are deep fried crackers made from fish and spices that serve as flavouring, originated from Indonesia. ', '300.00', '5f5fa3d8bd489.jpg'),
(12, 3, 'Margarita Pizza', 'margherita pizza sauce is a made of fire roasted canned tomatoes, garlic, olive oil and salt.', '1200.00', '5f5fa465a8984.jpg'),
(13, 3, 'Chicken Fajita', 'Seasoned shredded chicken, peppers, onions, and cheese create a simple, flavorful pizza. ', '1500.00', '5f5fa51b44fad.jpg'),
(14, 2, 'Special Chicken Manchurian', 'Boneless chicken, spring onion, lemon, chili garlic sauce, corn', '440.00', '5f5fa5a0a7527.jpg'),
(15, 2, 'Bater Roast', 'Hung curd, green chili paste, parmesan cheese, fresh cream, cashew nut', '800.00', '5f5fa5f4d460c.jpg'),
(16, 2, 'Chicken Chowmian', 'Chow mein noodles, chicken breast, oyster sauce, soy sauce,', '700.00', '5f5fa65b536f3.jpg'),
(17, 1, 'Chicken Masala Rice', 'Boneless chicken thighs, coconut milk, basmati rice, tomato sauce,', '600.00', '5f5fa6a0c1943.jpg'),
(18, 1, 'Vegetable Rice', 'Basmati rice, green peas, french beans, garam masala powder, tomato', '500.00', '5f5fa6cc16171.jpg'),
(19, 1, 'Mutton bonless handi', 'Citric acid, cream, yogurt, masala, boneless mutton,Cinnamon, garlic, green chilli, coriander seeds, black pepper', '1600.00', '5f5fa723418f2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `OID` varchar(255) NOT NULL,
  `CNIC` varchar(255) NOT NULL,
  `Ostatus` varchar(255) NOT NULL,
  `ODate` date NOT NULL,
  `Token_No` varchar(255) NOT NULL,
  PRIMARY KEY (`OID`),
  KEY `CNIC` (`CNIC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `PID` varchar(255) NOT NULL,
  `OID` varchar(255) NOT NULL,
  `FPrice` varchar(255) NOT NULL,
  `DCharge` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`PID`),
  KEY `OID` (`OID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

DROP TABLE IF EXISTS `remark`;
CREATE TABLE IF NOT EXISTS `remark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(62, 32, 'in process', 'hi', '2018-04-18 17:35:52'),
(63, 32, 'closed', 'cc', '2018-04-18 17:36:46'),
(64, 32, 'in process', 'fff', '2018-04-18 18:01:37'),
(65, 32, 'closed', 'its delv', '2018-04-18 18:08:55'),
(66, 34, 'in process', 'on a way', '2018-04-18 18:56:32'),
(67, 35, 'closed', 'ok', '2018-04-18 18:59:08'),
(68, 37, 'in process', 'on the way!', '2018-04-18 19:50:06'),
(69, 37, 'rejected', 'if admin cancel for any reason this box is for remark only for buter perposes', '2018-04-18 19:51:19'),
(70, 37, 'closed', 'delivered success', '2018-04-18 19:51:50'),
(71, 39, 'in process', 'please wait for a while', '2020-09-10 19:13:24'),
(72, 41, 'closed', 'delivered', '2020-09-10 19:14:24'),
(73, 41, 'rejected', 'a', '2020-09-13 05:27:09'),
(74, 57, 'closed', 'Delivered', '2020-09-14 15:22:39'),
(75, 63, 'closed', 'warka dang', '2020-09-14 16:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `RS_ID` int(255) NOT NULL AUTO_INCREMENT,
  `c_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `o_hr` varchar(255) NOT NULL,
  `c_hr` varchar(255) NOT NULL,
  `o_days` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`RS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`RS_ID`, `c_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`) VALUES
(1, 1, 'Lacuisine Traditional', 'lacuisine1@gmail.com', '0966710282', 'www.lacuisine.com', '8am', '11pm', 'mon-sun', 'Circular Road Near Haqnawaz Park TMA Plaza Dera Ismail Khan', '5ad74b9dbc38a.jpg', '2020-09-13 17:05:02'),
(2, 2, 'Lacuisine Chinese', 'lacuisine2@gmail.com', '0966710711', 'www.lacuisine.com', '9am', '11:30pm', 'mon-fri', 'Circular Road Near GPO station Cantt gate 2 Dera Ismail Khan', '5ad74b2867be8.jpg', '2020-09-13 17:11:58'),
(3, 3, 'Lacuisine Fast Food', 'lacuisine3@gmail.com', '0966710713', 'www.lacuisine.com', '10am', '10pm', 'mon-sun', 'Shami Road Main cantt gate near state bank of pakistan Dera Ismail Khan', '5ad79fcf59e66.jpg', '2020-09-13 17:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `CNIC` varchar(255) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CNIC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`CNIC`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
('1210116647065', 'asad', 'Assad Ullah', 'Khan', 'assadullahkhan700@gmail.com', '03494983200', '818121b51acaf5c90408131dcd38d8e4', 'basti barkat abad himmat dera ismail khan', 1, '2020-09-14 16:53:45'),
('1210157236327', 'asif', 'Asif', 'Ayub', 'asifayub836@gmail.com', '03489155239', '818121b51acaf5c90408131dcd38d8e4', 'Shah Wali Ullah Hostel # 3 University of Engineering & Technology, Peshawar, Pakistan', 1, '2020-09-14 12:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

DROP TABLE IF EXISTS `users_orders`;
CREATE TABLE IF NOT EXISTS `users_orders` (
  `OID` int(222) NOT NULL AUTO_INCREMENT,
  `CNIC` varchar(222) NOT NULL,
  `FName` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`OID`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`OID`, `CNIC`, `FName`, `quantity`, `price`, `status`, `date`) VALUES
(59, '1210157236327', 'Bonefish', 1, '800.00', NULL, '2020-09-14 13:34:33'),
(60, '1210157236327', 'Hard Rock Cafe', 1, '500.00', NULL, '2020-09-14 13:34:33'),
(61, '1210157236327', 'Uno Pizzeria & Grill', 1, '600.00', NULL, '2020-09-14 13:34:33'),
(62, '1210157236327', 'Lyfe Kitchens Tofu Taco', 1, '900.00', NULL, '2020-09-14 13:34:33'),
(63, '1210116647065', 'Bonefish', 1, '800.00', 'closed', '2020-09-14 16:49:29');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`OID`) REFERENCES `orders` (`OID`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CNIC`) REFERENCES `customer` (`CNIC`) ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`OID`) REFERENCES `orders` (`OID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
