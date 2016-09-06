-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2016 at 09:02 PM
-- Server version: 5.6.28-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `areadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
`id` int(10) unsigned NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('new','published','closed','deleted') COLLATE utf8_unicode_ci DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `district_id`, `name`, `nameEn`, `nameKg`, `description`, `descriptionEn`, `descriptionKg`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Бишкек', '', '', '', '', '', 'new', '2016-04-05 04:49:22', '2016-04-05 04:49:22'),
(2, 1, 'Кант', 'Kant', '', '', '', '', 'new', '2016-05-31 07:35:52', '2016-05-31 07:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('new','published','closed','deleted') COLLATE utf8_unicode_ci DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`, `nameEn`, `nameKg`, `description`, `descriptionEn`, `descriptionKg`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Чуйская', '', '', '', '', '', 'new', '2016-04-05 04:49:11', '2016-04-05 04:49:11'),
(2, 'Джалал-Абадская', '', '', '', '', '', 'new', '2016-04-05 04:55:08', '2016-04-05 04:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `flats`
--

CREATE TABLE IF NOT EXISTS `flats` (
`id` int(10) unsigned NOT NULL,
  `flatType` enum('flat','hotel','mansion','pension') COLLATE utf8_unicode_ci DEFAULT 'flat',
  `parent` int(10) unsigned DEFAULT NULL,
  `priceHourKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priceHourRu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priceHourEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priceNightKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priceNightRu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priceNightEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price24Kg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price24Ru` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price24En` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priceMonthKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priceMonthRu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priceMonthEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `crosses` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apartment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `homenumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zoom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `skype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room` int(11) NOT NULL,
  `bed` int(11) NOT NULL,
  `floor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `msquare` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wifi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flag` enum('mainpage','special','normal') COLLATE utf8_unicode_ci DEFAULT 'normal',
  `attachment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) DEFAULT '0',
  `status` enum('new','published','closed','deleted') COLLATE utf8_unicode_ci DEFAULT 'new',
  `owner_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `flats`
--

INSERT INTO `flats` (`id`, `flatType`, `parent`, `priceHourKg`, `priceHourRu`, `priceHourEn`, `priceNightKg`, `priceNightRu`, `priceNightEn`, `price24Kg`, `price24Ru`, `price24En`, `priceMonthKg`, `priceMonthRu`, `priceMonthEn`, `district_id`, `city_id`, `region_id`, `street`, `crosses`, `apartment`, `homenumber`, `latitude`, `longitude`, `zoom`, `phone`, `phone2`, `phone3`, `email`, `skype`, `room`, `bed`, `floor`, `msquare`, `wifi`, `name`, `nameEn`, `nameKg`, `description`, `descriptionEn`, `descriptionKg`, `flag`, `attachment`, `url`, `published`, `status`, `owner_id`, `created_at`, `updated_at`) VALUES
(1, 'hotel', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 1, 'Токтогула', 'Ибраимова', '15', '5', '42.85710824644026', '74.58743892235108', '15', '0700381838', '252252525', '2552252525', 'marajapovabakan@mail.ru', '555', 0, 0, '', '', '', 'Короткое название заказа1', '', '', '', '', '', 'special', 'images/hotel/11459831822.jpg', 'http://area.dev/images/hotel/11459831822.jpg', 0, 'new', NULL, '2016-04-05 04:50:22', '2016-04-07 17:47:17'),
(3, 'hotel', 1, '500 сом', '', '', '800 сом', '', '', '1200 сом', '', '', '2132', '', '', 1, 1, 1, 'Токтогула', 'Ибраимова', '15', '6', '42.855988812852246', '74.60679374260255', '16', '0700381838', '252252525', '2552252525', 'marajapovabakan@mail.ru', '555', 1, 2, '5/9', '52 кв.м', '1', 'hotelNumber1', '', '', '', '', '', 'normal', 'images/hotel/31459831948.jpg', 'http://area.dev/images/hotel/31459831948.jpg', 0, 'new', NULL, '2016-04-05 04:52:28', '2016-04-05 14:23:24'),
(4, 'hotel', 1, '500 сом', '', '', '800 сом', '', '', '1200 сом', '', '', '2132', '', '', 1, 1, 1, 'Токтогула', 'Ибраимова', '15', '5', '42.85194610119633', '74.56799827141114', '16', '0700381838', '252252525', '2552252525', 'marajapovabakan@mail.ru', '555', 1, 2, '5/9', '52 кв.м', '1', 'hotelNumber2', '', '', '', '', '', 'normal', 'images/hotel/41459832168.jpg', 'http://area.dev/images/hotel/41459832168.jpg', 0, 'new', NULL, '2016-04-05 04:56:08', '2016-04-05 04:56:08'),
(5, 'mansion', NULL, '500 сом', '', '', '800 сом', '', '', '1200 сом', '', '', '2132', '', '', 1, 1, 1, 'Токтогула', 'Ибраимова', '15', '5', '42.85708989468298', '74.59954104942628', '16', '0700381838', '252252525', '2552252525', 'example@example.ru', 'skype', 1, 2, '5/9', '52 кв.м', '1', 'mansion1', '', '', 'description', '', '', 'special', 'images/mansion/51460008270.jpg', 'http://area.dev/images/mansion/51460008270.jpg', 0, 'new', NULL, '2016-04-07 05:51:10', '2016-04-07 19:00:07'),
(6, 'pension', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 1, 'Токтогула', 'Ибраимова', '15', '5', '42.85848653686618', '74.56834159416505', '17', '0700381838', '252252525', '2552252525', 'example@example.ru', 'skype', 0, 0, '', '', '', 'Pension 1', '', '', '', '', '', 'normal', 'images/pension/61460010492.jpg', 'http://area.dev/images/pension/61460010492.jpg', 0, 'new', NULL, '2016-04-07 06:28:11', '2016-04-07 06:28:12'),
(7, 'pension', 6, '500 сом', '', '', '800 сом', '', '', '1200 сом', '', '', '2132', '', '', 1, 1, 1, 'Токтогула', 'Ибраимова', '12', '51', '42.86446663482661', '74.56911407036134', '16', '0700381838', '252252525', '2552252525', 'example@example.ru', 'skype', 2, 2, '5/9', '52 кв.м', '1', 'Pension 1', '', '', '', '', '', 'normal', 'images/pension/71460010581.jpg', 'http://area.dev/images/pension/71460010581.jpg', 0, 'new', NULL, '2016-04-07 06:29:41', '2016-04-07 06:29:41'),
(8, 'pension', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 1, 'Токтогула', 'Ибраимова', '15', '5', '', '', '', '0558210429', '', '', '', '', 0, 0, '', '', '', 'Пансионат2.1', '', '', '', '', '', 'special', 'images/pension/81460014012.jpg', 'http://area.dev/images/pension/81460014012.jpg', 0, 'new', NULL, '2016-04-07 07:26:52', '2016-04-07 17:52:12'),
(9, 'pension', 6, '550 сом', '', '', '800 сом', '', '', '1200 сом', '', '', '15000 сом', '', '', 1, 0, 0, 'Чуй', 'Ибраимова', '15', '6', '', '', '', '0700381855', '252252525', '2552252525', 'example@example.ru', 'skype1', 1, 2, '5/9', '52 кв.м', '1', 'Pension Number 3.1', '', '', '', '', '', 'normal', 'images/pension/91460022476.jpg', 'http://area.dev/images/pension/91460022476.jpg', 0, 'new', NULL, '2016-04-07 09:47:56', '2016-04-07 10:25:33'),
(10, 'pension', 8, '500 сом', '', '', '12312', '', '', '1200 сом', '', '', '15000 сом', '', '', 1, 0, 0, 'Токтогула', 'Ибраимова', '15', '56', '42.86446663482661', '74.56911407036134', '16', '0558210488', '+99655882211', '+996555888222', 'example@example.ru', 'skype', 1, 2, '5/9', '52 кв.м', '1', 'Пансионат 1.3', '', '', '', '', '', 'normal', 'images/pension/101460025165.jpg', 'http://area.dev/images/pension/101460025165.jpg', 0, 'new', NULL, '2016-04-07 10:32:45', '2016-04-07 11:50:02'),
(11, 'hotel', 1, '500 сом', '', '', '800 сом', '', '', '1200 сом', '', '', '15000 сом', '', '', 1, 0, 0, 'Чуй', 'Ибраимова', '15', '6', '42.849384531460394', '74.63256440681764', '17', '0700381840', '252252525', '2552252525', 'example@example.ru', 'skype', 1, 2, '5/9', '52 кв.м', '1', 'hotelNumber 3', '', '', '', '', '', 'normal', 'images/hotel/111460027261.jpg', 'http://area.dev/images/hotel/111460027261.jpg', 0, 'new', NULL, '2016-04-07 11:07:41', '2016-04-07 11:50:17'),
(12, 'flat', NULL, '500 сом', '', '', '800 сом', '', '', '1200 сом', '', '', '15000 сом', '', '', 1, 1, 1, 'Токтогула', 'Ибраимова', '15', '6', '42.8589407166488', '74.60681520027467', '15', '0550123123', '+99655882211', '+996555888222', 'example@example.ru', 'skype', 1, 2, '5/9', '52 кв.м', '1', 'Flat 1', '', '', 'Район Нацбанка\r\n\r\n8этаж(лифт не работает!!!)\r\n\r\nНовая квартира, новая мебель, вся бытовая техника, быстрый интернет(WI-FI), телевидение(155каналов), посуда, чистые полотенца, чистое постельное белье, тапочки и т.д.\r\n\r\nцена: 1500сом/сутки\r\n\r\nрасчетное врем', '', '', 'special', 'images/flat/121460029954.jpg', 'http://area.dev/images/flat/121460029954.jpg', 0, 'new', NULL, '2016-04-07 11:52:33', '2016-04-07 17:42:21'),
(13, 'flat', NULL, '500 сом', '', '', '800 сом', '', '', '1200 сом', '', '', '15000 сом', '', '', 1, 2, 2, 'Токтогула', 'Ибраимова', '15', '33', '42.86899081187226', '74.59297500175782', '15', '0558210420', '252252525', '2552252525', '', '', 1, 2, '2', '22', '1', 'Короткое название заказа1 ', '', '', 'ывафывафывавы', '', '', 'normal', '', '', 0, 'deleted', NULL, '2016-05-31 07:58:58', '2016-05-31 07:59:58'),
(14, 'flat', NULL, '500 сом', '', '', '800 сом', '', '', '1200 сом', '', '', '15000 сом', '', '', 1, 0, 0, 'Токтогула', 'Ибраимова', '15', '33', '42.86899081187226', '74.59297500175782', '15', '0558210420', '252252525', '2552252525', '', '', 1, 2, '2', '22', '1', 'Grant Apartment 2', '', '', 'ывафывафывавы', '', '', 'special', 'images/flat/141464681594.jpg', 'http://area.dev/images/flat/141464681594.jpg', 0, 'new', NULL, '2016-05-31 07:59:54', '2016-05-31 08:32:07'),
(15, 'flat', NULL, '500 сом', '', '', '800 сом', '', '', '1200 сом', '', '', '15000 сом', '', '', 1, 2, 2, 'Токтогула', 'Гоголя', '11', '6', '42.86795284819403', '74.58778224510499', '15', '0700381838', '+99655882211', '+996555888222', 'example@example.ru', '', 1, 2, '3', '33', '1', 'Grant Apartment', '', '', 'test', '', '', 'normal', 'images/flat/151464683454.jpg', 'http://area.dev/images/flat/151464683454.jpg', 0, 'new', NULL, '2016-05-31 08:30:53', '2016-05-31 08:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `flat_inventory_tie`
--

CREATE TABLE IF NOT EXISTS `flat_inventory_tie` (
`id` int(10) unsigned NOT NULL,
  `flat_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `flat_inventory_tie`
--

INSERT INTO `flat_inventory_tie` (`id`, `flat_id`, `inventory_id`, `created_at`, `updated_at`) VALUES
(2, 4, 1, '2016-04-05 04:56:08', '2016-04-05 04:56:08'),
(4, 3, 1, '2016-04-05 14:23:24', '2016-04-05 14:23:24'),
(5, 5, 1, '2016-04-07 05:51:10', '2016-04-07 05:51:10'),
(6, 7, 1, '2016-04-07 06:29:41', '2016-04-07 06:29:41'),
(8, 9, 1, '2016-04-07 10:25:33', '2016-04-07 10:25:33'),
(11, 10, 1, '2016-04-07 10:52:14', '2016-04-07 10:52:14'),
(13, 11, 1, '2016-04-07 11:14:36', '2016-04-07 11:14:36'),
(14, 12, 1, '2016-04-07 11:52:34', '2016-04-07 11:52:34'),
(15, 13, 1, '2016-05-31 07:58:58', '2016-05-31 07:58:58'),
(17, 15, 1, '2016-05-31 08:30:53', '2016-05-31 08:30:53'),
(18, 14, 1, '2016-05-31 08:31:29', '2016-05-31 08:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
`id` int(10) unsigned NOT NULL,
  `flat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `flat_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-04-05 04:50:22', '2016-04-05 04:50:22'),
(2, 3, '2016-04-05 04:52:28', '2016-04-05 04:52:28'),
(3, 4, '2016-04-05 04:56:08', '2016-04-05 04:56:08'),
(4, 5, '2016-04-07 05:51:10', '2016-04-07 05:51:10'),
(5, 6, '2016-04-07 06:28:12', '2016-04-07 06:28:12'),
(6, 7, '2016-04-07 06:29:41', '2016-04-07 06:29:41'),
(7, 8, '2016-04-07 07:26:52', '2016-04-07 07:26:52'),
(8, 9, '2016-04-07 09:47:56', '2016-04-07 09:47:56'),
(9, 10, '2016-04-07 10:32:45', '2016-04-07 10:32:45'),
(10, 11, '2016-04-07 11:07:41', '2016-04-07 11:07:41'),
(11, 12, '2016-04-07 11:52:34', '2016-04-07 11:52:34'),
(12, 14, '2016-05-31 07:59:54', '2016-05-31 07:59:54'),
(13, 15, '2016-05-31 08:30:54', '2016-05-31 08:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
`id` int(10) unsigned NOT NULL,
  `order` int(11) NOT NULL,
  `status` enum('new','published','closed','deleted') COLLATE utf8_unicode_ci DEFAULT 'new',
  `published` tinyint(1) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `order`, `status`, `published`, `name`, `nameEn`, `nameKg`, `description`, `descriptionEn`, `descriptionKg`, `url`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 0, 'new', 0, 'Холодильник', '', '', '', '', '', 'http://area.dev/images/inventories/11459831783.png', 'images/inventories/11459831783.png', '2016-04-05 04:49:43', '2016-04-05 04:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
`id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nameRu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` smallint(5) unsigned DEFAULT '0',
  `newtab` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_09_20_102025_create_menu_table', 1),
('2016_03_27_175245_create_table_flats', 1),
('2016_03_27_180855_create_table_district', 1),
('2016_03_27_181130_create_table_cities', 1),
('2016_04_01_213656_create_table_regions', 1),
('2016_04_03_152553_create_table_inventory', 1),
('2016_04_03_192803_create_table_gallery', 1),
('2016_04_03_193115_create_table_photos', 1),
('2016_04_03_193710_create_table_flat_inventory_tie', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
`id` int(10) unsigned NOT NULL,
  `flat_id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `attachment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `flat_id`, `gallery_id`, `attachment`, `url`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'images/photos/11459831822.jpg', 'http://area.dev/images/photos/11459831822.jpg', '', '2016-04-05 04:50:22', '2016-04-05 04:50:22'),
(2, 3, 2, 'images/photos/21459831949.jpg', 'http://area.dev/images/photos/21459831949.jpg', '', '2016-04-05 04:52:29', '2016-04-05 04:52:29'),
(3, 3, 2, 'images/photos/31459831949.jpg', 'http://area.dev/images/photos/31459831949.jpg', '', '2016-04-05 04:52:29', '2016-04-05 04:52:29'),
(4, 4, 3, 'images/photos/41459832168.jpg', 'http://area.dev/images/photos/41459832168.jpg', '', '2016-04-05 04:56:08', '2016-04-05 04:56:08'),
(5, 4, 3, 'images/photos/51459832168.jpg', 'http://area.dev/images/photos/51459832168.jpg', '', '2016-04-05 04:56:08', '2016-04-05 04:56:08'),
(6, 5, 4, 'images/photos/61460008270.jpg', 'http://area.dev/images/photos/61460008270.jpg', '', '2016-04-07 05:51:10', '2016-04-07 05:51:10'),
(7, 5, 4, 'images/photos/71460008270.jpg', 'http://area.dev/images/photos/71460008270.jpg', '', '2016-04-07 05:51:10', '2016-04-07 05:51:11'),
(8, 6, 5, 'images/photos/81460010492.jpg', 'http://area.dev/images/photos/81460010492.jpg', '', '2016-04-07 06:28:12', '2016-04-07 06:28:12'),
(9, 7, 6, 'images/photos/91460010581.jpg', 'http://area.dev/images/photos/91460010581.jpg', '', '2016-04-07 06:29:41', '2016-04-07 06:29:41'),
(10, 7, 6, 'images/photos/101460010581.jpg', 'http://area.dev/images/photos/101460010581.jpg', '', '2016-04-07 06:29:41', '2016-04-07 06:29:41'),
(11, 8, 7, 'images/photos/111460014012.jpg', 'http://area.dev/images/photos/111460014012.jpg', '', '2016-04-07 07:26:52', '2016-04-07 07:26:53'),
(12, 9, 8, 'images/photos/121460022476.jpg', 'http://area.dev/images/photos/121460022476.jpg', '', '2016-04-07 09:47:56', '2016-04-07 09:47:56'),
(13, 9, 8, 'images/photos/131460022476.jpg', 'http://area.dev/images/photos/131460022476.jpg', '', '2016-04-07 09:47:56', '2016-04-07 09:47:56'),
(14, 10, 9, 'images/photos/141460025165.jpg', 'http://area.dev/images/photos/141460025165.jpg', '', '2016-04-07 10:32:45', '2016-04-07 10:32:45'),
(15, 10, 9, 'images/photos/151460025165.jpg', 'http://area.dev/images/photos/151460025165.jpg', '', '2016-04-07 10:32:45', '2016-04-07 10:32:45'),
(16, 11, 10, 'images/photos/161460027261.jpg', 'http://area.dev/images/photos/161460027261.jpg', '', '2016-04-07 11:07:41', '2016-04-07 11:07:42'),
(17, 11, 10, 'images/photos/171460027262.jpg', 'http://area.dev/images/photos/171460027262.jpg', '', '2016-04-07 11:07:42', '2016-04-07 11:07:42'),
(18, 12, 11, 'images/photos/181460029954.jpg', 'http://area.dev/images/photos/181460029954.jpg', '', '2016-04-07 11:52:34', '2016-04-07 11:52:34'),
(19, 12, 11, 'images/photos/191460029954.jpg', 'http://area.dev/images/photos/191460029954.jpg', '', '2016-04-07 11:52:34', '2016-04-07 11:52:34'),
(20, 12, 11, 'images/photos/201460029954.jpg', 'http://area.dev/images/photos/201460029954.jpg', '', '2016-04-07 11:52:34', '2016-04-07 11:52:34'),
(21, 14, 12, 'images/photos/211464681594.jpg', 'http://area.dev/images/photos/211464681594.jpg', '', '2016-05-31 07:59:54', '2016-05-31 07:59:54'),
(22, 14, 12, 'images/photos/221464681594.jpg', 'http://area.dev/images/photos/221464681594.jpg', '', '2016-05-31 07:59:54', '2016-05-31 07:59:54'),
(23, 14, 12, 'images/photos/231464681594.jpg', 'http://area.dev/images/photos/231464681594.jpg', '', '2016-05-31 07:59:54', '2016-05-31 07:59:54'),
(24, 14, 12, 'images/photos/241464681594.jpg', 'http://area.dev/images/photos/241464681594.jpg', '', '2016-05-31 07:59:54', '2016-05-31 07:59:54'),
(25, 15, 13, 'images/photos/251464683454.jpg', 'http://area.dev/images/photos/251464683454.jpg', '', '2016-05-31 08:30:54', '2016-05-31 08:30:54'),
(26, 15, 13, 'images/photos/261464683454.jpg', 'http://area.dev/images/photos/261464683454.jpg', '', '2016-05-31 08:30:54', '2016-05-31 08:30:54'),
(27, 15, 13, 'images/photos/271464683454.jpg', 'http://area.dev/images/photos/271464683454.jpg', '', '2016-05-31 08:30:54', '2016-05-31 08:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
`id` int(10) unsigned NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionEn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionKg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('new','published','closed','deleted') COLLATE utf8_unicode_ci DEFAULT 'new',
  `published` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `city_id`, `district_id`, `name`, `nameEn`, `nameKg`, `description`, `descriptionEn`, `descriptionKg`, `status`, `published`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '3 микро район', '', '', '', '', '', 'new', 0, '2016-04-05 04:49:30', '2016-04-05 04:49:30'),
(2, 2, 1, 'Центр', '', '', '', '', '', 'new', 0, '2016-05-31 07:38:10', '2016-05-31 07:38:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password2` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('manager','admin') COLLATE utf8_unicode_ci DEFAULT 'manager',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `phone2`, `phone3`, `adres`, `status`, `password`, `password2`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Cngz Bg', 'nurchin@gmail.com', '0550123456', '', '', '', '', '$2y$10$HNoSaNuM8IByyifz1K9ZUOPOo8Yvs8pxEYYUX8uiVBGYhh62q3K..', '4297f44b13955235245b2497399d7a93', 'admin', NULL, '2016-04-05 04:48:59', '2016-04-05 04:48:59'),
(2, 'Abakan', 'abakano21@gmail.com', '0558210420', '', '', '', '', '$2y$10$huVXb/JA6CUe0x71cOLSO.OJ3UiRCfNtPLdNVNC/HLe.W23a1Gq0a', '4297f44b13955235245b2497399d7a93', 'admin', NULL, '2016-04-05 04:48:59', '2016-04-05 04:48:59'),
(3, 'Aibek', 'aibek@gmail.com', '0700381838', '', '', '', '', '$2y$10$.tfc4SZjdOuYKGMxqd.FbuAZJdak3MYODz14gS0iQsBH5wUGeAnfu', '4297f44b13955235245b2497399d7a93', 'admin', NULL, '2016-04-05 04:49:00', '2016-04-05 04:49:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flats`
--
ALTER TABLE `flats`
 ADD PRIMARY KEY (`id`), ADD KEY `flats_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `flat_inventory_tie`
--
ALTER TABLE `flat_inventory_tie`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
 ADD PRIMARY KEY (`id`), ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `flats`
--
ALTER TABLE `flats`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `flat_inventory_tie`
--
ALTER TABLE `flat_inventory_tie`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `flats`
--
ALTER TABLE `flats`
ADD CONSTRAINT `flats_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
