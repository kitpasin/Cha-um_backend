-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 10:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cha-um`
--

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `sub_cate_id` int(11) NOT NULL DEFAULT 17,
  `title` varchar(255) NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `freetag` text DEFAULT NULL,
  `h1` varchar(255) DEFAULT NULL,
  `h2` varchar(255) DEFAULT NULL,
  `short_url` text DEFAULT NULL,
  `thumbnail_title` varchar(255) DEFAULT NULL,
  `thumbnail_link` varchar(255) DEFAULT NULL,
  `thumbnail_size` varchar(255) DEFAULT NULL,
  `thumbnail_alt` varchar(255) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `iframe` text DEFAULT NULL,
  `category` text NOT NULL,
  `tags` text DEFAULT NULL,
  `redirect` text DEFAULT NULL,
  `link_facebook` text DEFAULT NULL,
  `link_twitter` text DEFAULT NULL,
  `link_instagram` text DEFAULT NULL,
  `link_youtube` text DEFAULT NULL,
  `link_line` text DEFAULT NULL,
  `date_begin_display` datetime DEFAULT NULL,
  `date_end_display` datetime DEFAULT NULL,
  `status_display` tinyint(1) NOT NULL DEFAULT 0,
  `pin` tinyint(1) NOT NULL DEFAULT 0,
  `defaults` tinyint(1) NOT NULL DEFAULT 0,
  `post_view` int(11) NOT NULL DEFAULT 0,
  `priority` int(11) NOT NULL DEFAULT 1,
  `meta_tag` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `allow_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ถ้าเป็น true ลบได้เฉพาะ SuperAdmin',
  `is_maincontent` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ถ้าเป็น false = dynamic content',
  `last_update_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designs`
--

INSERT INTO `designs` (`id`, `language`, `slug`, `sub_cate_id`, `title`, `keyword`, `description`, `address`, `size`, `status`, `freetag`, `h1`, `h2`, `short_url`, `thumbnail_title`, `thumbnail_link`, `thumbnail_size`, `thumbnail_alt`, `topic`, `content`, `iframe`, `category`, `tags`, `redirect`, `link_facebook`, `link_twitter`, `link_instagram`, `link_youtube`, `link_line`, `date_begin_display`, `date_end_display`, `status_display`, `pin`, `defaults`, `post_view`, `priority`, `meta_tag`, `meta_title`, `meta_description`, `allow_delete`, `is_maincontent`, `last_update_by`, `created_at`, `updated_at`) VALUES
(1, 'th', '', 17, 'งานเชียงรายดอกไม้งาม', '', 'งานเชียงรายดอกไม้งาม', 'จังหวัดเชียงราย', '7500 sqf internal | 3500 sqf external.', 'เสร็จสมบูรณ์', '', NULL, NULL, NULL, '', 'images/design-1.png', NULL, NULL, NULL, 'Sited within the valley of the eastern-most seaside town of Wategos Beach, Larus Marinus is a multigenerational family retreat that perches lightly on the steeply contoured site, overlooking the Pacific Ocean. Responding to the client’s brief, the project is part of a multigenerational arrangement in which a mother and her daughter’s family sought to establish a new mode of living with the flexibility of two dwellings.', '', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`,`language`) USING BTREE,
  ADD UNIQUE KEY `designs_language_slug_unique` (`language`,`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
