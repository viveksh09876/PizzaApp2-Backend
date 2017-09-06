-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2017 at 11:29 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nkd`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `where_i_am` tinyint(2) NOT NULL,
  `over_18` tinyint(2) NOT NULL,
  `emergency` tinyint(2) NOT NULL,
  `condition` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `dob` date NOT NULL,
  `phn` varchar(12) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(256) NOT NULL,
  `notes` text,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `where_i_am`, `over_18`, `emergency`, `condition`, `first_name`, `last_name`, `dob`, `phn`, `phone`, `email`, `notes`, `created_at`) VALUES
(1, 2, 1, 1, 1, 1, 'Pushpendra', 'Rajput', '2015-07-16', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'Test', '0000-00-00 00:00:00'),
(2, 2, 1, 1, 1, 1, 'Pushpendra', 'Rajput', '1989-10-05', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'Test', '2017-03-26 13:05:06'),
(3, 2, 1, 1, 1, 1, 'Pushpendra', 'rajput', '2014-06-10', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'test', '2017-03-26 16:59:39'),
(4, 2, 1, 1, 1, 1, 'Pushpendra', 'rajput', '2014-06-10', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'test', '2017-03-26 17:00:12'),
(5, 2, 1, 1, 1, 1, 'Pushpendra', 'rajput', '2014-06-10', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'test', '2017-03-26 17:01:09'),
(6, 2, 1, 1, 1, 1, 'Pushpendra', 'rajput', '2014-06-10', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'test', '2017-03-26 17:03:13'),
(7, 2, 1, 1, 1, 1, 'Pushpendra', 'rajput', '2014-06-10', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'test', '2017-03-26 17:07:18'),
(8, 2, 1, 1, 1, 1, 'Pushpendra', 'rajput', '2014-06-10', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'test', '2017-03-26 17:08:36'),
(9, 2, 1, 1, 1, 1, 'Pushpendra', 'Rajput', '2014-06-18', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'Test', '2017-03-26 17:45:32'),
(10, 2, 1, 1, 1, 1, 'Pushpendra', 'Rajput', '2014-06-18', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'Test', '2017-03-26 17:46:01'),
(11, 2, 1, 1, 1, 1, 'Pushpendra', 'Rajput', '2014-06-18', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'Test', '2017-03-26 17:46:37'),
(12, 2, 1, 1, 1, 1, 'Pushpendra', 'Rajput', '2014-06-18', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'Test', '2017-03-26 17:47:30'),
(13, 2, 1, 1, 1, 1, 'Pushpendra', 'Rajput', '2014-06-18', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'Test', '2017-03-26 17:52:06'),
(14, 2, 1, 1, 1, 1, 'Pushpendra', 'Rajput', '2014-06-18', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'Test', '2017-03-26 17:52:46'),
(15, 2, 1, 1, 1, 1, 'Pushpendra', 'Rajput', '2014-06-18', '8888888888', '999999999', 'rajput.pushpendra61@gmail.com', 'Test', '2017-03-26 17:53:05'),
(16, 2, 1, 1, 1, 1, 'dfdfdsf', 'dfdfsfd', '2010-02-03', 'dsfds', '999999999', 'rajput.pushpendra61@gmail.com', 'dfd', '2017-03-26 17:54:11'),
(17, 2, 1, 1, 1, 1, 'dfdfdsf', 'dfdfsfd', '2010-02-03', 'dsfds', '999999999', 'rajput.pushpendra61@gmail.com', 'dfd', '2017-03-26 17:54:59'),
(18, 2, 1, 1, 1, 1, 'dfdfdsf', 'dfdfsfd', '2010-02-03', 'dsfds', '999999999', 'rajput.pushpendra61@gmail.com', 'dfd', '2017-06-30 17:55:41'),
(19, 2, 1, 1, 1, 1, 'Pushpendra', 'rajput', '1989-10-05', '8888888888', '8888888888', 'test@test.com', 'Test', '2017-05-04 04:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `availabilities`
--

CREATE TABLE IF NOT EXISTS `availabilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `availabilities`
--

INSERT INTO `availabilities` (`id`, `user_id`, `start`, `end`) VALUES
(1, 2, '2017-02-03 12:00:00', '2017-02-03 14:00:00'),
(2, 3, '2017-02-03 12:00:00', '2017-02-03 14:00:00'),
(3, 2, '2017-02-01 23:01:00', '2017-02-01 23:30:00'),
(4, 2, '2017-03-26 10:00:00', '2017-03-26 19:00:00'),
(5, 1, '2017-03-26 09:00:00', '2017-03-26 19:00:00'),
(6, 2, '2017-04-30 08:00:00', '2017-04-30 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE IF NOT EXISTS `conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(256) NOT NULL,
  `condition` varchar(256) NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL DEFAULT 'Publish',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`id`, `slug`, `condition`, `status`) VALUES
(1, 'allergies', 'Allergies', 'Publish'),
(2, 'headaches', 'Headaches', 'Publish'),
(3, 'mental-health ', 'Mental health', 'Publish'),
(4, 'sleep-problems', 'Sleep problems', 'Publish'),
(5, 'breathing-problems', 'Breathing problems', 'Publish'),
(6, 'ear-problems', 'Ear problems', 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `contact_informations`
--

CREATE TABLE IF NOT EXISTS `contact_informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `fax` varchar(256) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `zipcode` varchar(256) DEFAULT NULL,
  `city` varchar(256) DEFAULT NULL,
  `state` varchar(256) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contact_informations`
--

INSERT INTO `contact_informations` (`id`, `user_id`, `email`, `contact`, `fax`, `address`, `zipcode`, `city`, `state`, `country_id`, `updated_at`) VALUES
(1, 2, 'rajput.pushpendra62@gmail.com', 9999999999, '0112345432', 'E-318, new ashok nagar', '110096', 'Delhi', 'UP', 110, '2017-03-26 11:07:59'),
(2, 3, 'rajput.pushpendra65@gmail.com', 9999999999, '0112345432', 'E-318, new ashok nagar', '110096', 'Delhi', 'UP', 110, '2016-06-03 20:34:58'),
(3, 1, 'rajput.pushpendra65@gmail.com', 9999999999, '0112345432', 'E-318, new ashok nagar', '110096', 'Delhi', 'UP', 110, '2016-06-03 20:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_sub_title` varchar(255) DEFAULT NULL,
  `page_content` text,
  `status` enum('Publish','Draft','Trash') NOT NULL DEFAULT 'Publish',
  `page_added_date` datetime DEFAULT NULL,
  `page_modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`page_id`, `page_title`, `page_slug`, `page_sub_title`, `page_content`, `status`, `page_added_date`, `page_modified_date`) VALUES
(19, 'Patient Care', 'patient-care', 'Try', '<p>Please mouse over and click on any of the above icons to access our healthcare information and services.You can also download our Patient Care application by clicking on the app icons.</p>\n\n<p>You will be able to use the mobile application to access our healthcare information, book a GP consultation or appointment and use any of our GP admin services to manage your prescriptions or request sick notes, vaccination or any letter from the GP.</p>', 'Publish', '2013-04-19 13:53:16', '2014-01-29 12:18:28'),
(20, 'About Patient Care', 'about-patient-care', '', '<p><img alt="" src="/doctor/img/frontend/i.png" />Donec ipsum diam, pretium no mollis dapibus risus. Nullam dolor nibh retro pulvinar at interdum eget, suscipit id felis tincidunt risus.</p>\r\n\r\n<p><img alt="" src="/doctor/img/frontend/cunsult.png" />Donec ipsum diam, pretium no mollis dapibus risus. Nullam dolor nibh retro pulvinar at interdum eget, suscipit id felis tincidunt risus.</p>\r\n\r\n<p><img alt="" src="/doctor/img/frontend/services.png" />Donec ipsum diam, pretium no mollis dapibus risus. Nullam dolor nibh retro pulvinar at interdum eget, suscipit id felis tincidunt risus.</p>\r\n\r\n<p><img alt="" src="/doctor/img/frontend/pharmacy.png" />Donec ipsum diam, pretium no mollis dapibus risus. Nullam dolor nibh retro pulvinar at interdum eget, suscipit id felis tincidunt risus.</p>\r\n\r\n<p><img alt="" src="/doctor/img/frontend/mental.png" />Donec ipsum diam, pretium no mollis dapibus risus. Nullam dolor nibh retro pulvinar at interdum eget, suscipit id felis tincidunt risus.</p>\r\n\r\n<p><img alt="" src="/doctor/img/frontend/socialcare.png" />Donec ipsum diam, pretium no mollis dapibus risus. Nullam dolor nibh retro pulvinar at interdum eget, suscipit id felis tincidunt risus.</p>\r\n', 'Publish', '2013-04-24 18:29:58', '2017-03-29 23:09:40'),
(21, 'NHS 111 Service', 'nhs_111_service', '', '<p>111 is the NHS non-emergency number. It&rsquo;s fast, easy and free. Call 111 and speak to a highly trained advisor, supported by healthcare professionals. They will ask you a series of questions to assess your symptoms and immediately direct you to the best medical care for you.</p>\n\n<p>NHS 111 is available 24 hours a day, 365 days a year. Calls are free from landlines and mobile phones.</p>\n\n<h3>When to use it</h3>\n\n<p>You should use the NHS 111 service if you urgently need medical help or advice but it&#39;s not a life-threatening situation.</p>\n\n<p>Call 111 if:</p>\n\n<ul>\n	<li>you need medical help fast but it&#39;s not a 999 emergency</li>\n	<li>you think you need to go to A&amp;E or need another NHS urgent care service</li>\n	<li>you don&#39;t know who to call or you don&#39;t have a GP to call</li>\n	<li>you need health information or reassurance about what to do next</li>\n</ul>\n\n<p>For less urgent health needs, contact your GP or local pharmacist in the usual way.</p>\n\n<p>If a health professional has given you a specific phone number to call when you are concerned about your condition, continue to use that number.</p>\n\n<p>For immediate, life-threatening emergencies, continue to call 999.</p>\n\n<h3>How does it work?</h3>\n\n<p>The NHS 111 service is staffed by a team of fully trained advisers, supported by experienced nurses and paramedics. They will ask you questions to assess your symptoms, then give you the healthcare advice you need or direct you straightaway to the local service that can help you best. That could be A&amp;E, an out-of-hours doctor, an urgent care centre or a walk-in centre, a community nurse, an emergency dentist or a late-opening chemist.</p>\n\n<p>Where possible, the NHS 111 team will book you an appointment or transfer you directly to the people you need to speak to.</p>\n\n<p>If NHS 111 advisers think you need an ambulance, they will immediately arrange for one to be sent to you.</p>\n\n<p>Calls to 111 are recorded. All calls and the records created are maintained securely, and will only be shared with others directly involved with your care.</p>\n', 'Publish', '2014-01-06 09:13:32', '2017-04-01 17:48:47'),
(22, 'Local Health Information', 'local_health_information', '', '<p>Deinde disputat, quod cuiusque generis animantium statui deceat extremum. Nam ditigi et carum esse iucundum est propterea, quia tutiorem vitam et voluptatem pleniorem efficit.Videamus igitur sententias eorum, tum ad verba redeamus. Omnes enim iucundum motum, quo sensus hilaretur. Tu enim ista lenius, hic Stoicorum more nos vexat.Venit enim mihi Platonis in mentem, quem accepimus primum hic disputare sotitum.</p>\r\n', 'Publish', '2017-03-27 20:08:58', '2017-03-27 21:01:52'),
(23, 'Our Patient Care portal helps our patients to find the right type of care and information to improve their health well being.', 'our_patient_care_portal_helps_our_patients_to_find_the_right_type_of_care_and_information_to_improve_their_health_well_being.', '', '', 'Publish', '2017-03-27 20:41:08', '2017-03-29 23:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=267 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `country_code`) VALUES
(1, 'Andorra', 'AD'),
(2, 'United Arab Emirates', 'AE'),
(3, 'Afghanistan', 'AF'),
(4, 'Antigua and Barbuda', 'AG'),
(5, 'Anguilla', 'AI'),
(6, 'Albania', 'AL'),
(7, 'Armenia', 'AM'),
(8, 'Netherlands Antilles', 'AN'),
(9, 'Angola', 'AO'),
(10, 'Antarctica', 'AQ'),
(11, 'Argentina', 'AR'),
(12, 'American Samoa', 'AS'),
(13, 'Austria', 'AT'),
(14, 'Australia', 'AU'),
(15, 'Aruba', 'AW'),
(16, 'Aland Islands', 'AX'),
(17, 'Azerbaijan', 'AZ'),
(18, 'Bosnia and Herzegovina', 'BA'),
(19, 'Barbados', 'BB'),
(20, 'Bangladesh', 'BD'),
(21, 'Belgium', 'BE'),
(22, 'Burkina Faso', 'BF'),
(23, 'Bulgaria', 'BG'),
(24, 'Bahrain', 'BH'),
(25, 'Burundi', 'BI'),
(26, 'Benin', 'BJ'),
(27, 'Saint Barthelemy', 'BL'),
(28, 'Bermuda', 'BM'),
(29, 'Brunei', 'BN'),
(30, 'Bolivia', 'BO'),
(31, 'British Antarctic Territory', 'BQ'),
(32, 'Brazil', 'BR'),
(33, 'Bahamas', 'BS'),
(34, 'Bhutan', 'BT'),
(35, 'Bouvet Island', 'BV'),
(36, 'Botswana', 'BW'),
(37, 'Belarus', 'BY'),
(38, 'Belize', 'BZ'),
(39, 'Canada', 'CA'),
(40, 'Cocos [Keeling] Islands', 'CC'),
(41, 'Congo - Kinshasa', 'CD'),
(42, 'Central African Republic', 'CF'),
(43, 'Congo - Brazzaville', 'CG'),
(44, 'Switzerland', 'CH'),
(45, 'Cote dIvoire', 'CI'),
(46, 'Cook Islands', 'CK'),
(47, 'Chile', 'CL'),
(48, 'Cameroon', 'CM'),
(49, 'China', 'CN'),
(50, 'Colombia', 'CO'),
(51, 'Costa Rica', 'CR'),
(52, 'Serbia and Montenegro', 'CS'),
(53, 'Canton and Enderbury Islands', 'CT'),
(54, 'Cuba', 'CU'),
(55, 'Cape Verde', 'CV'),
(56, 'Christmas Island', 'CX'),
(57, 'Cyprus', 'CY'),
(58, 'Czech Republic', 'CZ'),
(59, 'East Germany', 'DD'),
(60, 'Germany', 'DE'),
(61, 'Djibouti', 'DJ'),
(62, 'Denmark', 'DK'),
(63, 'Dominica', 'DM'),
(64, 'Dominican Republic', 'DO'),
(65, 'Algeria', 'DZ'),
(66, 'Ecuador', 'EC'),
(67, 'Estonia', 'EE'),
(68, 'Egypt', 'EG'),
(69, 'Western Sahara', 'EH'),
(70, 'Eritrea', 'ER'),
(71, 'Spain', 'ES'),
(72, 'Ethiopia', 'ET'),
(73, 'Finland', 'FI'),
(74, 'Fiji', 'FJ'),
(75, 'Falkland Islands', 'FK'),
(76, 'Micronesia', 'FM'),
(77, 'Faroe Islands', 'FO'),
(78, 'French Southern and Antarctic Territories', 'FQ'),
(79, 'France', 'FR'),
(80, 'Metropolitan France', 'FX'),
(81, 'Gabon', 'GA'),
(82, 'United Kingdom', 'GB'),
(83, 'Grenada', 'GD'),
(84, 'Georgia', 'GE'),
(85, 'French Guiana', 'GF'),
(86, 'Guernsey', 'GG'),
(87, 'Ghana', 'GH'),
(88, 'Gibraltar', 'GI'),
(89, 'Greenland', 'GL'),
(90, 'Gambia', 'GM'),
(91, 'Guinea', 'GN'),
(92, 'Guadeloupe', 'GP'),
(93, 'Equatorial Guinea', 'GQ'),
(94, 'Greece', 'GR'),
(95, 'South Georgia and the South Sandwich Islands', 'GS'),
(96, 'Guatemala', 'GT'),
(97, 'Guam', 'GU'),
(98, 'Guinea-Bissau', 'GW'),
(99, 'Guyana', 'GY'),
(100, 'Hong Kong SAR China', 'HK'),
(101, 'Heard Island and McDonald Islands', 'HM'),
(102, 'Honduras', 'HN'),
(103, 'Croatia', 'HR'),
(104, 'Haiti', 'HT'),
(105, 'Hungary', 'HU'),
(106, 'Indonesia', 'ID'),
(107, 'Ireland', 'IE'),
(108, 'Israel', 'IL'),
(109, 'Isle of Man', 'IM'),
(110, 'India', 'IN'),
(111, 'British Indian Ocean Territory', 'IO'),
(112, 'Iraq', 'IQ'),
(113, 'Iran', 'IR'),
(114, 'Iceland', 'IS'),
(115, 'Italy', 'IT'),
(116, 'Jersey', 'JE'),
(117, 'Jamaica', 'JM'),
(118, 'Jordan', 'JO'),
(119, 'Japan', 'JP'),
(120, 'Johnston Island', 'JT'),
(121, 'Kenya', 'KE'),
(122, 'Kyrgyzstan', 'KG'),
(123, 'Cambodia', 'KH'),
(124, 'Kiribati', 'KI'),
(125, 'Comoros', 'KM'),
(126, 'Saint Kitts and Nevis', 'KN'),
(127, 'North Korea', 'KP'),
(128, 'South Korea', 'KR'),
(129, 'Kuwait', 'KW'),
(130, 'Cayman Islands', 'KY'),
(131, 'Kazakhstan', 'KZ'),
(132, 'Laos', 'LA'),
(133, 'Lebanon', 'LB'),
(134, 'Saint Lucia', 'LC'),
(135, 'Liechtenstein', 'LI'),
(136, 'Sri Lanka', 'LK'),
(137, 'Liberia', 'LR'),
(138, 'Lesotho', 'LS'),
(139, 'Lithuania', 'LT'),
(140, 'Luxembourg', 'LU'),
(141, 'Latvia', 'LV'),
(142, 'Libya', 'LY'),
(143, 'Morocco', 'MA'),
(144, 'Monaco', 'MC'),
(145, 'Moldova', 'MD'),
(146, 'Montenegro', 'ME'),
(147, 'Saint Martin', 'MF'),
(148, 'Madagascar', 'MG'),
(149, 'Marshall Islands', 'MH'),
(150, 'Midway Islands', 'MI'),
(151, 'Macedonia', 'MK'),
(152, 'Mali', 'ML'),
(153, 'Myanmar [Burma]', 'MM'),
(154, 'Mongolia', 'MN'),
(155, 'Macau SAR China', 'MO'),
(156, 'Northern Mariana Islands', 'MP'),
(157, 'Martinique', 'MQ'),
(158, 'Mauritania', 'MR'),
(159, 'Montserrat', 'MS'),
(160, 'Malta', 'MT'),
(161, 'Mauritius', 'MU'),
(162, 'Maldives', 'MV'),
(163, 'Malawi', 'MW'),
(164, 'Mexico', 'MX'),
(165, 'Malaysia', 'MY'),
(166, 'Mozambique', 'MZ'),
(167, 'Namibia', 'NA'),
(168, 'New Caledonia', 'NC'),
(169, 'Niger', 'NE'),
(170, 'Norfolk Island', 'NF'),
(171, 'Nigeria', 'NG'),
(172, 'Nicaragua', 'NI'),
(173, 'Netherlands', 'NL'),
(174, 'Norway', 'NO'),
(175, 'Nepal', 'NP'),
(176, 'Dronning Maud Land', 'NQ'),
(177, 'Nauru', 'NR'),
(178, 'Neutral Zone', 'NT'),
(179, 'Niue', 'NU'),
(180, 'New Zealand', 'NZ'),
(181, 'Oman', 'OM'),
(182, 'Panama', 'PA'),
(183, 'Pacific Islands Trust Territory', 'PC'),
(184, 'Peru', 'PE'),
(185, 'French Polynesia', 'PF'),
(186, 'Papua New Guinea', 'PG'),
(187, 'Philippines', 'PH'),
(188, 'Pakistan', 'PK'),
(189, 'Poland', 'PL'),
(190, 'Saint Pierre and Miquelon', 'PM'),
(191, 'Pitcairn Islands', 'PN'),
(192, 'Puerto Rico', 'PR'),
(193, 'Palestinian Territories', 'PS'),
(194, 'Portugal', 'PT'),
(195, 'U.S. Miscellaneous Pacific Islands', 'PU'),
(196, 'Palau', 'PW'),
(197, 'Paraguay', 'PY'),
(198, 'Panama Canal Zone', 'PZ'),
(199, 'Qatar', 'QA'),
(200, 'Reunion', 'RE'),
(201, 'Romania', 'RO'),
(202, 'Serbia', 'RS'),
(203, 'Russia', 'RU'),
(204, 'Rwanda', 'RW'),
(205, 'Saudi Arabia', 'SA'),
(206, 'Solomon Islands', 'SB'),
(207, 'Seychelles', 'SC'),
(208, 'Sudan', 'SD'),
(209, 'Sweden', 'SE'),
(210, 'Singapore', 'SG'),
(211, 'Saint Helena', 'SH'),
(212, 'Slovenia', 'SI'),
(213, 'Svalbard and Jan Mayen', 'SJ'),
(214, 'Slovakia', 'SK'),
(215, 'Sierra Leone', 'SL'),
(216, 'San Marino', 'SM'),
(217, 'Senegal', 'SN'),
(218, 'Somalia', 'SO'),
(219, 'Suriname', 'SR'),
(220, 'Sao Tome and Principe', 'ST'),
(221, 'Union of Soviet Socialist Republics', 'SU'),
(222, 'El Salvador', 'SV'),
(223, 'Syria', 'SY'),
(224, 'Swaziland', 'SZ'),
(225, 'Turks and Caicos Islands', 'TC'),
(226, 'Chad', 'TD'),
(227, 'French Southern Territories', 'TF'),
(228, 'Togo', 'TG'),
(229, 'Thailand', 'TH'),
(230, 'Tajikistan', 'TJ'),
(231, 'Tokelau', 'TK'),
(232, 'Timor-Leste', 'TL'),
(233, 'Turkmenistan', 'TM'),
(234, 'Tunisia', 'TN'),
(235, 'Tonga', 'TO'),
(236, 'Turkey', 'TR'),
(237, 'Trinidad and Tobago', 'TT'),
(238, 'Tuvalu', 'TV'),
(239, 'Taiwan', 'TW'),
(240, 'Tanzania', 'TZ'),
(241, 'Ukraine', 'UA'),
(242, 'Uganda', 'UG'),
(243, 'U.S. Minor Outlying Islands', 'UM'),
(244, 'United States', 'US'),
(245, 'Uruguay', 'UY'),
(246, 'Uzbekistan', 'UZ'),
(247, 'Vatican City', 'VA'),
(248, 'Saint Vincent and the Grenadines', 'VC'),
(249, 'North Vietnam', 'VD'),
(250, 'Venezuela', 'VE'),
(251, 'British Virgin Islands', 'VG'),
(252, 'U.S. Virgin Islands', 'VI'),
(253, 'Vietnam', 'VN'),
(254, 'Vanuatu', 'VU'),
(255, 'Wallis and Futuna', 'WF'),
(256, 'Wake Island', 'WK'),
(257, 'Samoa', 'WS'),
(258, 'People''s Democratic Republic of Yemen', 'YD'),
(259, 'Yemen', 'YE'),
(260, 'Mayotte', 'YT'),
(261, 'South Africa', 'ZA'),
(262, 'Zambia', 'ZM'),
(263, 'Zimbabwe', 'ZW'),
(264, 'Unknown or Invalid Region', 'ZZ'),
(265, 'West Indies', 'AI'),
(266, 'England', 'UK');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(255) DEFAULT NULL,
  `template_key` varchar(255) NOT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `email_subject` varchar(500) DEFAULT NULL,
  `email_body` text NOT NULL,
  `template_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `template_added_date` datetime DEFAULT NULL,
  `template_modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`template_id`, `template_name`, `template_key`, `from_name`, `from_email`, `email_subject`, `email_body`, `template_status`, `template_added_date`, `template_modified_date`) VALUES
(1, 'forgot_password_email', 'forgot_password_email', 'Pksingh', 'pappu.singh@i-webservices.com', 'Forgot password', '<p>Dear {name}, Your password has been reset and new password is: {password}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Thanks,</p>\r\n\r\n<p>Patient CareTeam</p>\r\n', 'Active', '2013-04-23 17:18:19', '2016-05-26 20:51:54'),
(2, 'Appointment Booking', 'appointment_booking', 'Pushpendra Rajput', 'rajput.pushpendra61@gmail.com', 'Appointment Confirmed', '<p>Dear {name}, Your booking has been confirmed.</p>\r\n\r\n<p>your details mentioned below :</p>\r\n\r\n<p>Name : {name},</p>\r\n\r\n<p>Date of birth : {dob},</p>\r\n\r\n<p>Personal Helth Number : {phn},</p>\r\n\r\n<p>Phone : {phone},</p>\r\n\r\n<p>Email : {email}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Thanks,</p>\r\n\r\n<p>Patient CareTeam</p>\r\n', 'Active', '2017-02-23 22:17:31', NULL),
(3, 'Practitioner Booking Notification', 'practitioner_booking_notification', 'Pushpendra Rajput', 'rajput.pushpendra61@gmail.com', 'Practitioner Booking Notification', '<p>Hi {practitioner_name},</p>\r\n\r\n<p>You got a booking, details mentioned below :</p>\r\n\r\n<p>Name : {name},</p>\r\n\r\n<p>Date of birth : {dob},</p>\r\n\r\n<p>Personal Helth Number : {phn},</p>\r\n\r\n<p>Phone : {phone},</p>\r\n\r\n<p>Email : {email}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Thanks,</p>\r\n\r\n<p>Patient CareTeam</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Active', '2017-03-26 17:22:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `service_title` varchar(256) DEFAULT NULL,
  `short_description` text,
  `details_description` text,
  `image` varchar(256) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `user_id`, `service_title`, `short_description`, `details_description`, `image`, `status`) VALUES
(1, 2, 'Title title', '<p>short Description</p>\r\n', '<p>details</p>\r\n', '1464810331.png', 'Inactive'),
(2, 1, 'Primary Health Care', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '1464810331.png', 'Active'),
(3, 1, 'Pediatric Clinic', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '1490377196.png', 'Active'),
(4, 1, 'Outpatient Surgery', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '1490378625.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_title` varchar(256) NOT NULL,
  `slide_link` varchar(256) DEFAULT NULL,
  `slide_description` text,
  `image` varchar(256) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `slide_title`, `slide_link`, `slide_description`, `image`, `status`) VALUES
(1, 'Test', 'http://www.demo.com', '<p>Test new</p>\r\n', '1495572489.jpg', 'Inactive'),
(3, 'Slide Title', 'http://www.demo.com', '<p>Test slide description</p>\r\n', '1495572589.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `sub_conditions`
--

CREATE TABLE IF NOT EXISTS `sub_conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `condition_id` int(11) NOT NULL,
  `slug` varchar(256) NOT NULL,
  `condition` varchar(256) NOT NULL,
  `introduction` text,
  `symptoms` text,
  `causes` text,
  `diagnosis` text,
  `treatment` text,
  `complications` text,
  `prevention` text,
  `lisa_story` text,
  `video_guide` text,
  `pharmacist_help` text,
  `status` enum('Publish','Unpublish') NOT NULL DEFAULT 'Publish',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sub_conditions`
--

INSERT INTO `sub_conditions` (`id`, `condition_id`, `slug`, `condition`, `introduction`, `symptoms`, `causes`, `diagnosis`, `treatment`, `complications`, `prevention`, `lisa_story`, `video_guide`, `pharmacist_help`, `status`) VALUES
(1, 1, 'hay-fever', 'Hay fever', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish'),
(2, 1, 'hives', 'Hives', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish'),
(3, 1, 'urticaria', 'Urticaria', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish'),
(4, 2, 'head-injury', 'Head injury', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish'),
(5, 2, 'headache', 'Headache', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish'),
(6, 2, 'migraine', 'Migraine', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish'),
(7, 3, 'anxiety', 'Anxiety', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish'),
(9, 6, 'test_bre', 'test bre', '<p>intro</p>\r\n', NULL, '<p>cause</p>\r\n', '<p>dia</p>\r\n', '<p>tre</p>\r\n', NULL, NULL, NULL, '<p>vg</p>\r\n', '<p>pg</p>\r\n', 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE IF NOT EXISTS `team_members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `short_description` text,
  `details_description` text,
  `image` varchar(256) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`member_id`, `user_id`, `name`, `short_description`, `details_description`, `image`, `status`) VALUES
(1, 2, 'Kapil Rai', '<p>short description</p>\r\n', '<p>details description</p>\r\n', '1464894644.JPG', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `published_by` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `added_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL DEFAULT 'Publish',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `published_by`, `comment`, `added_date`, `modified_date`, `status`) VALUES
(1, 'Pushpendra Rajput', '<p>There&#39;s lots of people in this world who spend so much time watching their health that they haven&#39;t the time to enjoy it.</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Publish'),
(3, 'Josh Billings', '<p>There&#39;s lots of people in this world who spend so much time watching their health that they haven&#39;t the time to enjoy it.</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Publish'),
(4, 'Narendra Dhakad', '<p>There&#39;s lots of people in this world who spend so much time watching their health that they haven&#39;t the time to enjoy it.</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `profile_pic` text,
  `user_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `user_role_id` int(11) NOT NULL DEFAULT '4',
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(500) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `user_short_description` text,
  `user_description` text,
  `user_added_date` datetime DEFAULT NULL,
  `user_modified_date` datetime DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `profile_pic`, `user_status`, `user_role_id`, `address`, `phone`, `city`, `state`, `country_id`, `zip_code`, `user_short_description`, `user_description`, `user_added_date`, `user_modified_date`, `last_login_date`, `last_login_ip`) VALUES
(1, 'admin@admin.com', 'f5ed4d4f776c0dc3f4dd72dc8e6e88794c11248f', 'Pushpendra', 'Rajput', '1485194939.png', 'Active', 1, 'new ashok nagar', '8130606975', 'noida', 'up', 110, '110091', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut volutpat rutrum eros sit amet sollicitudin.</p>', 'Diagnose and treat acute, episodic, or chronic illness, independently or as part of a healthcare team. May focus on health promotion and disease prevention. May order, perform, or interpret diagnostic tests such as lab work and x rays. May prescribe medication. Must be registered nurses who have specialized graduate education.', '2016-05-23 14:00:38', '2016-09-28 21:53:45', '2017-05-23 22:23:09', '::1'),
(2, 'subadmin@subadmin.com', 'f5ed4d4f776c0dc3f4dd72dc8e6e88794c11248f', 'Pushpendra', 'Rajput', '1464983428.png', 'Active', 2, 'Saket nagar', '8130606975', 'Gwalior', 'MP', 110, '474003', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut volutpat rutrum eros sit amet sollicitudin.</p>', 'Diagnose and treat acute, episodic, or chronic illness, independently or as part of a healthcare team. May focus on health promotion and disease prevention. May order, perform, or interpret diagnostic tests such as lab work and x rays. May prescribe medication. Must be registered nurses who have specialized graduate education.', '2013-04-24 18:39:23', '2016-05-31 22:38:08', '2017-05-04 03:57:20', '::1'),
(3, 'author@author.com', 'ee7a3105d05807ef12cda91e54048dbdc7a8b65f', 'Author', 'Author', NULL, 'Active', 3, 'noida', '99900411445', 'noida', '1', 1, '11092', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut volutpat rutrum eros sit amet sollicitudin.</p>', 'Diagnose and treat acute, episodic, or chronic illness, independently or as part of a healthcare team. May focus on health promotion and disease prevention. May order, perform, or interpret diagnostic tests such as lab work and x rays. May prescribe medication. Must be registered nurses who have specialized graduate education.', '2013-04-24 18:39:23', '2014-01-16 13:45:50', NULL, NULL),
(4, 'adc@gmail.com', 'f5ed4d4f776c0dc3f4dd72dc8e6e88794c11248f', 'Pushpendra', 'Rajput', NULL, 'Active', 3, '0', '', '', '', NULL, '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut volutpat rutrum eros sit amet sollicitudin.</p>', '', '2016-05-26 19:39:48', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(255) NOT NULL,
  `user_role_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `user_role_description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_role_name`, `user_role_status`, `user_role_description`) VALUES
(1, 'Admin', 'Active', 'Super Admin'),
(2, 'Practitioner', 'Active', 'Sub Admin'),
(3, 'Customer', 'Active', 'users');

-- --------------------------------------------------------

--
-- Table structure for table `user_skills`
--

CREATE TABLE IF NOT EXISTS `user_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sub_condition_ids` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_skills`
--

INSERT INTO `user_skills` (`id`, `user_id`, `sub_condition_ids`) VALUES
(1, 2, '1,2'),
(2, 1, '4,3'),
(3, 3, '1,3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
