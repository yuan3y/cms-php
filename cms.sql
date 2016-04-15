-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: 127.6.92.130:3306
-- Generation Time: Apr 12, 2016 at 05:13 PM
-- Server version: 5.5.45
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--
CREATE DATABASE IF NOT EXISTS `cms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cms`;

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

DROP TABLE IF EXISTS `agency`;
CREATE TABLE IF NOT EXISTS `agency` (
  `agency_name` varchar(100) NOT NULL,
  `agency_abbreviation` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`agency_abbreviation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`agency_name`, `agency_abbreviation`) VALUES
('National Environmental Agency', 'NEA'),
('Singapore Armed Forces', 'SAF'),
('Singapore Civil Defence Force', 'SCDF'),
('Singapore Police Force', 'SPF');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(100) NOT NULL AUTO_INCREMENT,
  `incident_id` int(100) NOT NULL,
  `feedback_agency` varchar(100) NOT NULL,
  `feedback_description` varchar(2000) DEFAULT '',
  `feedback_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `feedback_status` enum('PENDING','REVIEWED') DEFAULT 'PENDING',
  PRIMARY KEY (`feedback_id`),
  KEY `incident_id` (`incident_id`),
  KEY `feedback_agency_agency_abbreviation_fk` (`feedback_agency`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `incident_id`, `feedback_agency`, `feedback_description`, `feedback_timestamp`, `feedback_status`) VALUES
(1, 57, 'SCDF', 'Fire has been put out, all clear.', '2016-04-03 05:22:15', 'REVIEWED'),
(2, 50, 'SCDF', 'Blaze may need about 1 more hour to clear off.', '2016-03-20 05:53:26', 'REVIEWED'),
(3, 45, 'SCDF', 'Fire has escalated to the trees. Will take around 5 more hours.', '2016-03-13 05:30:27', 'REVIEWED'),
(4, 48, 'SCDF', 'Ambulance is now fetching victim to the nearest hospital. All clear.', '2016-03-16 09:53:41', 'REVIEWED'),
(5, 49, 'SCDF', 'Area has been contained. Specialists are working to clear contaminated zone. ETA 3 more hours.', '2016-03-17 05:49:34', 'REVIEWED'),
(6, 55, 'SCDF', 'Fire is under control. Students are apprehended. All clear.', '2016-03-30 11:52:31', 'REVIEWED'),
(7, 44, 'SCDF', 'Fire has been put out. No one was at home, therefore no casualties. All clear.', '2016-03-12 04:05:45', 'REVIEWED'),
(8, 46, 'SCDF', 'Fire has been put out. Culprit still at large. All clear.', '2016-03-14 10:12:28', 'REVIEWED'),
(9, 40, 'SCDF', 'Victim is now on the way to the nearest hospital. Incident resolved.', '2016-03-07 01:40:48', 'REVIEWED'),
(10, 42, 'SCDF', 'Victim is on the way to the nearest hospital, all clear.', '2016-03-10 10:39:14', 'REVIEWED'),
(11, 54, 'SCDF', 'Ambulance dispatched already; victim is on her way to the nearest hospital. Resolved.', '2016-03-27 23:15:39', 'REVIEWED'),
(12, 58, 'SCDF', 'Ambulance is currently fetching victim to the nearest hospital. Resolved.', '2016-04-05 13:56:32', 'REVIEWED'),
(13, 47, 'SCDF', 'Blaze is spreading to other units. We might need an hour more. All civilians have been evacuated already.', '2016-03-15 03:49:31', 'REVIEWED'),
(14, 51, 'SCDF', 'Ambulance already dispatched. Victim is on the way to the nearest hospital. Resolved.', '2016-03-22 10:27:38', 'REVIEWED'),
(15, 50, 'SCDF', 'Blaze has been taken care off. Resolved.', '2016-03-20 06:37:26', 'REVIEWED'),
(16, 45, 'SCDF', 'Entire area has been quenched by efforts and the rain. All clear.', '2016-03-13 09:45:27', 'REVIEWED'),
(17, 49, 'SCDF', 'Air quality in the vicinity has been returned to normal. All clear.', '2016-03-17 09:03:34', 'REVIEWED'),
(18, 47, 'SCDF', 'Fire has been put out. No casualties as previously mentioned. All clear.', '2016-03-15 04:32:31', 'REVIEWED'),
(19, 52, 'SPF', 'Truck is currently being towed. All clear.', '2016-03-24 06:46:44', 'REVIEWED'),
(20, 39, 'SPF', 'Both the car and truck are being towed now. All clear.', '2016-03-06 05:05:24', 'REVIEWED'),
(21, 41, 'SPF', 'Heavy traffic jam. ETA 1 hour.', '2016-03-09 07:59:22', 'REVIEWED'),
(22, 41, 'SPF', 'Truck unaffected; taxi is currently being towed away. Resolved.', '2016-03-09 09:05:22', 'REVIEWED'),
(23, 56, 'SPF', 'Car is being towed away now. Resolved.', '2016-04-02 04:03:37', 'REVIEWED'),
(24, 43, 'SAF', 'Subjects have been apprehended. Resolved.', '2016-03-10 18:30:23', 'REVIEWED'),
(25, 53, 'SAF', 'Crowds are still gathering. We are requesting for more personnel on the area.', '2016-03-25 16:52:13', 'REVIEWED'),
(26, 53, 'SAF', 'Riots are throwing objects at the police. We are calling in Special Forces', '2016-03-25 17:37:13', 'REVIEWED'),
(27, 53, 'SAF', 'Tear gas deployed. Crowds still do not seem to be dispersing', '2016-03-25 18:52:13', 'REVIEWED'),
(28, 53, 'SAF', 'More tear gas canisters have been deployed. Crowd seems to be affected', '2016-03-25 19:37:13', 'REVIEWED'),
(29, 53, 'SAF', 'Crowds are dispersing slowly; rioters are being apprehended. ETA 1 hour.', '2016-03-25 19:55:13', 'REVIEWED'),
(30, 53, 'SAF', 'Crowds have dispersed. Subjects have been apprehended. All clear.', '2016-03-25 20:38:13', 'REVIEWED'),
(33, 60, 'SCDF', 'False alarm; resident was experimenting with dry ice. Resolved.', '2016-04-07 03:57:44', 'REVIEWED'),
(34, 62, 'SCDF', 'Ambulance is fetching the victim to nearest hospital at the moment, resolved.', '2016-04-09 00:53:19', 'REVIEWED'),
(35, 63, 'SCDF', 'Victim is on the way via ambulance now. Resolved.', '2016-04-10 15:56:20', 'REVIEWED'),
(37, 59, 'SCDF', 'Small blaze has been put out easily. All clear.', '2016-04-06 11:35:53', 'REVIEWED'),
(38, 64, 'SCDF', 'Blaze spreading into forested area. Weather extremely dry as well. We would need around 9 more hours to isolate the spreading area.', '2016-04-11 05:45:27', 'REVIEWED'),
(39, 64, 'SCDF', 'The blaze is under control. We would need around 3 more hours.', '2016-04-11 10:02:25', 'REVIEWED'),
(40, 64, 'SCDF', 'Fire has been put out. All clear.', '2016-04-11 11:55:27', 'REVIEWED'),
(43, 65, 'SPF', 'Truck is being towed away. Resolved.', '2016-04-11 06:04:47', 'REVIEWED'),
(44, 61, 'SPF', 'Taxi is being towed away.', '2016-04-08 10:49:51', 'REVIEWED'),
(51, 76, 'SCDF', 'Forest fire has been cleared.', '2016-04-10 10:42:11', 'REVIEWED'),
(53, 82, 'SCDF', 'Air quality is very low. We are sending for reinforcements.', '2016-04-12 04:23:37', 'REVIEWED'),
(54, 86, 'SCDF', 'Fire spreading at an extremely fast rate. We may take a few hours.', '2016-04-12 04:23:59', 'REVIEWED'),
(56, 88, 'SCDF', 'Fire has been resolved', '2016-04-12 10:40:02', 'REVIEWED');

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

DROP TABLE IF EXISTS `incident`;
CREATE TABLE IF NOT EXISTS `incident` (
  `incident_id` int(100) NOT NULL AUTO_INCREMENT,
  `incident_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `incident_type` varchar(100) NOT NULL,
  `incident_address` varchar(2000) NOT NULL,
  `incident_longitude` varchar(20) NOT NULL,
  `incident_latitude` varchar(20) NOT NULL,
  `incident_contactName` varchar(100) NOT NULL,
  `incident_contactNo` varchar(20) NOT NULL,
  `incident_description` varchar(2000) NOT NULL,
  `incident_status` varchar(20) DEFAULT 'initiated',
  `agency` varchar(100) DEFAULT NULL,
  `operator` int(100) NOT NULL,
  PRIMARY KEY (`incident_id`),
  KEY `incident_agency_agency_id_fk` (`agency`),
  KEY `incident_user_user_id_fk` (`operator`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`incident_id`, `incident_timestamp`, `incident_type`, `incident_address`, `incident_longitude`, `incident_latitude`, `incident_contactName`, `incident_contactNo`, `incident_description`, `incident_status`, `agency`, `operator`) VALUES
(39, '2016-03-06 04:34:24', 'Traffic Accident', 'Choa Chu Kang North 5, Singapore 680517', '103.74656010000001', 'Some Body', '8123 4567', 'Truck collided with Taxi. Requires towing', 'CLOSED', 'SPF', 1),
(40, '2016-03-07 01:35:48', 'Traffic Accident', 'PIE, Singapore', '103.81575739999994', 'Some Body', '8123 4567', 'Motorcycle collision with barricade. Requesting ambulance.', 'CLOSED', 'SCDF', 1),
(41, '2016-03-09 07:56:22', 'Traffic Accident', 'PIE, Singapore', '103.81575739999994', 'Some Body', '8123 4567', 'Taxi collided against the back of a truck. Towing required', 'CLOSED', 'SPF', 1),
(42, '2016-03-10 10:35:14', 'Traffic Accident', 'AYE, Singapore', '103.7460916', 'Some Body', '8123 4567', 'Car swerved into divider. Needs ambulance', 'CLOSED', 'SCDF', 1),
(43, '2016-03-10 17:13:23', 'Riot', 'Singapore', '103.84967849999998', 'Some Body', '8123 4567', 'Illegal gathering. Requesting riot control from SAF', 'CLOSED', 'SAF', 1),
(44, '2016-03-12 02:14:45', 'Fire', 'Bukit Batok West Ave 3, Singapore 659165', '103.74288449999995', 'Some Body', '8123 4567', 'Kitchen blaze at #11-96. Requesting firemen.', 'CLOSED', 'SCDF', 1),
(45, '2016-03-13 05:15:27', 'Fire', 'Bukit Batok West Ave 6, Singapore 650185', '103.7446569', 'Some Body', '8123 4567', 'Bushfire from dry weather. Requesting firemen.', 'CLOSED', 'SCDF', 1),
(46, '2016-03-14 09:47:28', 'Fire', '11 Pasir Ris Drive 2, Singapore 518458', '103.96439099999998', 'Some Body', '8123 4567', 'Fire at playground. Firemen needed.', 'CLOSED', 'SCDF', 8),
(47, '2016-03-15 03:21:31', 'Fire', '11 Marsiling Dr, Singapore 730011', '103.77596360000007', 'Some Body', '8123 4567', 'Kitchen blaze at #03-128. Firemen needed.', 'CLOSED', 'SCDF', 8),
(48, '2016-03-16 09:47:41', 'Traffic Accident', '161 Woodlands Street 13, Block 161, Singapore 730161', '103.7736281', 'Some Body', '8123 4567', 'Motorcycle skidded and crashed. Ambulance needed.', 'CLOSED', 'SCDF', 8),
(49, '2016-03-17 05:18:34', 'Gas Leak', '171 Ang Mo Kio Ave 4, Block 171, Singapore 560171', '103.83564750000005', 'Some Body', '8123 4567', 'Stove left on, pungent gas emanating. Send specialists.', 'CLOSED', 'SCDF', 8),
(50, '2016-03-20 05:39:26', 'Fire', '398 Yishun Ring Rd, Singapore 760398', '103.84655999999995', 'Some Body', '8123 4567', 'Incense joss sticks created fire; spreaded to grass. Send firemen.', 'CLOSED', 'SCDF', 8),
(51, '2016-03-22 10:21:38', 'Traffic Accident', 'MCE, Singapore', '103.86844199999996', 'Some Body', '8123 4567', 'Car crashed into divider. Send ambulance', 'CLOSED', 'SCDF', 8),
(52, '2016-03-24 06:12:44', 'Traffic Accident', 'KJE, Singapore', '103.73739929999999', 'Some Body', '8123 4567', 'Truck broke down. Requesting towing services.', 'CLOSED', 'SPF', 8),
(53, '2016-03-25 16:24:13', 'Riot', 'Lor 24A Geylang, Singapore 398537', '103.88405130000001', 'Some Body', '8123 4567', 'Illegal gathering of more than 35 people. Riot control necessary.', 'CLOSED', 'SAF', 8),
(54, '2016-03-27 23:09:39', 'Traffic Accident', '50 Choa Chu Kang North 5, Singapore 689621', '103.75100180000004', 'Some Body', '8123 4567', 'Student knocked down by car. Send ambulance immediately.', 'CLOSED', 'SCDF', 8),
(55, '2016-03-30 11:16:31', 'Fire', '659401, 30 Bukit Batok Street 32, Singapore', '103.74922879999997', 'Some Body', '8123 4567', 'Fire started by students, growing large towards trees. Send firemen immediately.', 'CLOSED', 'SCDF', 8),
(56, '2016-04-02 03:41:37', 'Traffic Accident', '26 Nanyang Ave, Block 41, Singapore 639812', '103.68470980000006', 'Some Body', '8123 4567', 'Car knocked into another car at roundabout. Requesting towing.', 'CLOSED', 'SPF', 8),
(57, '2016-04-03 04:46:15', 'Fire', '21 Lien Ying Chow Dr, Block 32, Singapore 637296', '103.68684789999998', 'Some Body', '8123 4567', 'Student left stove on, fire in Hall 6 Block 3', 'CLOSED', 'SCDF', 8),
(58, '2016-04-05 13:50:32', 'Traffic Accident', '413A Fernvale Link, Singapore 791413', '103.87884099999997', 'Some Body', '8123 4567', 'Person flung out of car, requesting ambulance immediately.', 'CLOSED', 'SAF', 10),
(59, '2016-04-06 11:19:53', 'Fire', '343 Ang Mo Kio Ave 3, Block 343, Singapore 560343', '103.84908799999994', 'Some Body', '81234567\n', 'Small blaze at the void deck. Send firemen immediately.', 'CLOSED', 'SCDF', 10),
(60, '2016-04-07 03:45:44', 'Fire', '900 Serangoon Rd, Singapore 328260', '103.86194', '1.3195800', 'SomE boDy', '8123 4567', 'Smoke emanating from #05-126, send firemen', 'CLOSED', 'SCDF', 13),
(61, '2016-04-08 10:07:51', 'Traffic Accident', 'Toa Payoh South Flyover, Singapore', '103.84605620000002', 'Some Body', '8123 4567', 'Vehicle breakdown in the left lane. Towing required', 'CLOSED', 'SPF', 13),
(62, '2016-04-09 00:48:19', 'Traffic Accident', '13 Farrer Park Rd, Block 13, Singapore 210013', '103.85140200000001', 'Some Body', '8123 4567', 'Hit and run on a young civilian male. Send ambulance.', 'CLOSED', 'SCDF', 13),
(63, '2016-04-10 15:44:20', 'Traffic Accident', '34 Upper Cross St, Block 34, Singapore 050034', '103.84241880000002', 'Some Body', '8123 4567', 'Driver collided into lamppost. Send ambulance.', 'REJECTED', 'SCDF', 13),
(64, '2016-04-11 05:34:27', 'Fire', 'Mandai Lake Rd, Singapore', '103.78453569999999', 'Some Body', '8123 4567', 'Dry weather causing bushfire at forested area. Send firemen.', 'REJECTED', 'SCDF', 13),
(65, '2016-04-11 05:44:47', 'Traffic Accident', 'Street Number 32, Singapore', '103.95501300000001', 'Some Body', '8123 4567', 'Truck knocked into back of taxi. Towing required.', 'CLOSED', 'NEA', 13),
(74, '2016-04-07 08:45:00', 'Fire', '78 Circuit Rd, Singapore 370078', '103.885268', '1.327882', 'John', '8123 4567', 'Smoke emanating from #06-357. Send firemen', 'APPROVED', 'NEA', 12),
(75, '2016-04-07 09:00:00', 'Traffic Accident', '16 Eunos Cres, Singapore 400016', '103.90405759999999', 'Some Body', '8123 4567', 'Motorcycle collided into the tree. Send ambulance immediately.', 'APPROVED', 'SPF', 12),
(76, '2016-04-10 10:45:00', 'Fire', 'Bukit Batok Street 34, Singapore', '103.74998759999994', 'Some Body', '8123 4567', 'Fire at forested area', 'CLOSED', 'SCDF', 1),
(77, '2016-04-10 11:00:00', 'Fire', 'Mandai Lake Rd, Singapore', '103.76367959999993', 'Some Body', '8123 4567', 'Fire at the void deck', 'CLOSED', 'SCDF', 10),
(79, '2016-04-10 11:21:00', 'Traffic Accident', '13 Farrer Park Rd, Block 13, Singapore 210013', '103.76367959999993', 'Some Body', '123654576', 'Car knocked into divider, towing required', 'CLOSED', 'SPF', 8),
(80, '2016-04-10 11:26:00', 'Traffic Accident', 'Bukit Panjang, Singapore', '103.77194980000002', 'Some Body', '8123 4567', 'Fire fire', 'REJECTED', NULL, 8),
(81, '2016-04-12 03:46:00', 'Gas Leak', '289 Tampines Street 22, Singapore 520289', '103.95504900000003', 'Some Body', '8123 4567', 'Pungent scent in air reported by neighbours. Send specialists immediately.', 'APPROVED', 'SCDF', 8),
(82, '2016-04-12 07:30:00', 'Gas Leak', 'Moonbeam Walk, Singapore', '103.78176600000006', 'Some Body', '8123 4567', 'Caller reported that she forgot to turn off the stove. Send specialists immediately.', 'APPROVED', 'SCDF', 8),
(83, '2016-04-11 18:00:00', 'Riot', '48 Serangoon Rd, Singapore 217959', '103.85181560000001', 'Some Body', '8123 4567', 'Mass illegal gathering, send riot control', 'APPROVED', 'SAF', 8),
(84, '2016-04-11 19:00:00', 'Riot', '133 New Bridge Rd, #B2-18, Singapore 059413', '103.84469790000003', 'Some Body', '8123 4567', 'Over 30 drunk workers creating a public nuisance. Send riot control', 'APPROVED', 'SAF', 8),
(85, '2016-04-12 03:53:00', 'Traffic Accident', '867 Yishun Street 81, Singapore 760867', '103.83761500000003', 'Some Body', '8123 4567', 'Van knocked into back of truck, please send for towers.', 'APPROVED', 'SPF', 1),
(86, '2016-04-12 03:55:00', 'Fire', 'Singapore, Singapore', '103.83632009999997', 'Some Body', '8123 4567', 'Fire at forested area, send firemen immediately', 'CLOSED', 'SCDF', 8),
(88, '2016-04-12 10:36:00', 'Fire', 'Bukit Batok, Singapore', '103.76367959999993', 'Some Body', '8123 4567', 'Fire at forested area', 'CLOSED', 'SCDF', 8);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `user_id`, `timestamp`, `message`) VALUES
(1, 1, '2016-03-12 18:00:21', 'test log'),
(2, 1, '2016-03-12 18:00:21', 'test log 2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_description` varchar(2000) NOT NULL,
  `user_role` enum('operator','manager','agency') NOT NULL,
  `user_number` varchar(15) DEFAULT NULL,
  `agency` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `agency` (`agency`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_password`, `user_name`, `user_description`, `user_role`, `user_number`, `agency`) VALUES
(1, 'operator1@cms.com', 'password', 'Somebody','Somebody''s Operator account', 'operator', '+6581234567', NULL),
(2, 'NEA@cms.com', 'password', 'NEA', 'National Environment Agency', 'agency', '+6581234567', 'NEA'),
(3, 'manager1@cms.com', 'password', 'Somebody','Somebody''s Manager account', 'manager', '+6581234567', NULL),
(5, 'SCDF@cms.com', 'password', 'SCDF', 'Singapore Civil Defence Force', 'agency', '+6581234567', 'SCDF'),
(6, 'SAF@cms.com', 'password', 'SAF', 'Singapore Armed Forces', 'agency', '+6581234567', 'SAF'),
(7, 'SPF@cms.com', 'password', 'SPF', 'Singapore Police Force', 'agency', '+6581234567', 'SPF'),
(8, 'operator2@cms.com', 'password', 'Somebody','Somebody''s Operator account', 'operator', '+6581234567', NULL),
(9, 'manager2@cms.com', 'password', 'Somebody','Somebody''s Manager account', 'manager', '+6581234567', NULL),
(10, 'operator3@cms.com', 'password', 'Somebody','Somebody''s Operator account', 'operator', '+6581234567', NULL),
(11, 'manager3@cms.com', 'password', 'Somebody','Somebody''s Manager account', 'manager', '+6581234567', NULL),
(12, 'operator4@cms.com', 'password', 'Somebody','Somebody''s Operator account', 'operator', '+6581234567', NULL),
(13, 'operator5@cms.com', 'password', 'Somebody','Somebody''s Operator account', 'operator', '+6581234567', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_agency_agency_abbreviation_fk` FOREIGN KEY (`feedback_agency`) REFERENCES `agency` (`agency_abbreviation`),
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incident` (`incident_id`);

--
-- Constraints for table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `incident_agency_agency_abbreviation_fk` FOREIGN KEY (`agency`) REFERENCES `agency` (`agency_abbreviation`),
  ADD CONSTRAINT `incident_user_user_id_fk` FOREIGN KEY (`operator`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`agency`) REFERENCES `agency` (`agency_abbreviation`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
