-- phpMyAdmin SQL Dump
-- version 4.4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2016 at 07:58 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ideaing-staging`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `enable_threads` tinyint(1) NOT NULL DEFAULT '0',
  `thread_count` int(11) NOT NULL DEFAULT '0',
  `post_count` int(11) NOT NULL DEFAULT '0',
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `category_id`, `title`, `description`, `weight`, `enable_threads`, `thread_count`, `post_count`, `private`, `created_at`, `updated_at`) VALUES
(1, 0, 'SMART HOME', '', 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'SMART TRAVEL', '', 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'SMART BODY', '', 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'SMART ENTERTAINMENT', '', 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'TVOS', '', 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 'SIRIs', '', 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 'Apple TV', '', 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(10) unsigned NOT NULL,
  `thread_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(10) unsigned DEFAULT NULL,
  `sequence` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forum_posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_threads`
--

CREATE TABLE IF NOT EXISTS `forum_threads` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `pinned` tinyint(1) DEFAULT '0',
  `locked` tinyint(1) DEFAULT '0',
  `reply_count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forum_threads`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_threads_read`
--

CREATE TABLE IF NOT EXISTS `forum_threads_read` (
  `id` int(11) NOT NULL,
  `thread_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forum_threads_read`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_threads`
--
ALTER TABLE `forum_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_threads_read`
--
ALTER TABLE `forum_threads_read`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `forum_threads`
--
ALTER TABLE `forum_threads`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `forum_threads_read`
--
ALTER TABLE `forum_threads_read`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
