-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2025 at 08:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mymangalist`
--
CREATE DATABASE IF NOT EXISTS `mymangalist` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mymangalist`;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favorite_id`, `user_id`, `manga_id`, `created_at`, `updated_at`) VALUES
(23, 3, 6, '2025-09-27 07:49:07', '2025-09-27 07:49:07'),
(24, 6, 1, '2025-09-27 09:20:20', '2025-09-27 09:20:20'),
(25, 3, 1, '2025-10-02 14:55:27', '2025-10-02 14:55:27'),
(28, 3, 10, '2025-10-03 06:04:47', '2025-10-03 06:04:47'),
(30, 3, 3, '2025-10-03 06:04:55', '2025-10-03 06:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Comedy'),
(4, 'Drama'),
(5, 'Fantasy'),
(9, 'Horror'),
(6, 'Romance'),
(8, 'Sci-Fi'),
(7, 'Slice of Life'),
(10, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `manga`
--

CREATE TABLE `manga` (
  `manga_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(150) DEFAULT NULL,
  `publisher` varchar(150) DEFAULT NULL,
  `status` enum('Publishing','Completed') DEFAULT 'Publishing',
  `release_year` int(11) DEFAULT NULL,
  `type` enum('manga','manhwa') NOT NULL DEFAULT 'manga',
  `synopsis` text DEFAULT NULL,
  `cover_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manga`
--

INSERT INTO `manga` (`manga_id`, `title`, `author`, `publisher`, `status`, `release_year`, `type`, `synopsis`, `cover_img`, `created_at`, `updated_at`) VALUES
(1, 'Naruto', 'Masashi Kishimoto', 'Shueisha', 'Completed', 1999, 'manga', NULL, NULL, '2025-09-25 19:59:54', '2025-09-25 19:59:54'),
(2, 'One Piece', 'Eiichiro Oda', 'Shueisha', 'Publishing', 1997, 'manga', NULL, NULL, '2025-09-25 19:59:54', '2025-09-25 19:59:54'),
(3, 'Attack on Titan', 'Hajime Isayama', 'Kodansha', 'Completed', 2009, 'manga', NULL, NULL, '2025-09-25 19:59:54', '2025-10-02 13:48:29'),
(4, 'ฟหกฟห', 'กฟหก', 'ฟหกฟหก', 'Completed', 1999, 'manga', NULL, 'uploads/manga/a2ZZHRaje07E2b2DEmhWvJXCkWo5upAoPhPVQ2Zc.png', '2025-09-25 20:54:04', '2025-09-25 21:03:12'),
(6, 'ssssssssssssssssss', 'ssss', 'ssssss', 'Completed', 2020, 'manga', NULL, 'uploads/manga/F6zo4LywJZtkIteYTDGjmKRl3PYuZjwVTZO89ejh.png', '2025-09-26 04:26:01', '2025-09-26 04:26:01'),
(7, '1234', '1234', '1234', 'Publishing', 2025, 'manga', NULL, 'uploads/manga/ulHJpA8NxOvKEYWRzpt8F7eOSYedCiZ4xeaZj13W.png', '2025-09-27 06:54:47', '2025-10-02 09:15:57'),
(10, 'asd', 'asdasd', 'asdasd', 'Publishing', 2025, 'manhwa', 'adsfasdfasdasd', 'uploads/manga/6aPk8ViMnOlJ6GNWBMn5wuZRdxpMju4QCnpfcfwk.png', '2025-09-29 16:11:05', '2025-10-03 06:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `manga_genre`
--

CREATE TABLE `manga_genre` (
  `manga_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manga_genre`
--

INSERT INTO `manga_genre` (`manga_id`, `genre_id`) VALUES
(3, 1),
(7, 1),
(10, 1),
(10, 2),
(10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `manga_visits`
--

CREATE TABLE `manga_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manga_id` int(11) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manga_visits`
--

INSERT INTO `manga_visits` (`id`, `manga_id`, `ip_address`, `url`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 20:50:36', '2025-09-26 20:50:36'),
(2, 4, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 20:53:18', '2025-09-26 20:53:18'),
(3, 4, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 21:59:18', '2025-09-26 21:59:18'),
(4, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:05:20', '2025-09-27 05:05:20'),
(5, 3, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:05:31', '2025-09-27 05:05:31'),
(6, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:05:42', '2025-09-27 05:05:42'),
(7, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:22:54', '2025-09-27 06:22:54'),
(8, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:25:24', '2025-09-27 06:25:24'),
(9, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:26:11', '2025-09-27 06:26:11'),
(10, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:26:16', '2025-09-27 06:26:16'),
(11, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:27:12', '2025-09-27 06:27:12'),
(12, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:27:28', '2025-09-27 06:27:28'),
(13, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:27:33', '2025-09-27 06:27:33'),
(14, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:32:28', '2025-09-27 06:32:28'),
(15, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:33:24', '2025-09-27 06:33:24'),
(16, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:35:53', '2025-09-27 06:35:53'),
(17, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:35:59', '2025-09-27 06:35:59'),
(18, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:36:13', '2025-09-27 06:36:13'),
(19, 3, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:36:19', '2025-09-27 06:36:19'),
(20, 7, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:24:28', '2025-09-27 07:24:28'),
(21, 7, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:49:04', '2025-09-27 07:49:04'),
(22, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:49:06', '2025-09-27 07:49:06'),
(23, 2, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:49:10', '2025-09-27 07:49:10'),
(24, 1, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:49:12', '2025-09-27 07:49:12'),
(25, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:10:45', '2025-09-27 08:10:45'),
(26, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:10:56', '2025-09-27 08:10:56'),
(27, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:26:15', '2025-09-27 08:26:15'),
(28, 7, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:27:24', '2025-09-27 08:27:24'),
(29, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:27:27', '2025-09-27 08:27:27'),
(30, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:27:31', '2025-09-27 08:27:31'),
(31, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:27:42', '2025-09-27 08:27:42'),
(32, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:27:47', '2025-09-27 08:27:47'),
(33, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:28:03', '2025-09-27 08:28:03'),
(34, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:28:10', '2025-09-27 08:28:10'),
(35, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:53:22', '2025-09-27 08:53:22'),
(36, 7, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:57:19', '2025-09-27 08:57:19'),
(37, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:57:22', '2025-09-27 08:57:22'),
(38, 3, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:57:25', '2025-09-27 08:57:25'),
(39, 2, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:57:27', '2025-09-27 08:57:27'),
(40, 4, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:57:30', '2025-09-27 08:57:30'),
(41, 1, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:57:34', '2025-09-27 08:57:34'),
(42, 2, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:57:37', '2025-09-27 08:57:37'),
(43, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:57:40', '2025-09-27 08:57:40'),
(44, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:00:29', '2025-09-27 09:00:29'),
(45, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:02:08', '2025-09-27 09:02:08'),
(46, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:02:17', '2025-09-27 09:02:17'),
(47, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:02:20', '2025-09-27 09:02:20'),
(48, 6, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:04:19', '2025-09-27 09:04:19'),
(49, 7, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:08:39', '2025-09-27 09:08:39'),
(50, 1, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:20:18', '2025-09-27 09:20:18'),
(51, 1, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:21:13', '2025-09-27 09:21:13'),
(52, 1, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:23:24', '2025-09-27 09:23:24'),
(53, 1, '127.0.0.1', 'http://127.0.0.1:8000/manga/detail/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:23:30', '2025-09-27 09:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 10),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `manga_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(2, 3, 4, 5, 'asdasdaaa', '2025-09-26 08:58:41', '2025-09-27 07:43:06'),
(4, 3, 6, 4, 'aaaaaaaaa', '2025-09-27 08:27:42', '2025-09-27 08:27:42'),
(5, 6, 6, 1, '2222222', '2025-09-27 08:28:10', '2025-09-27 09:00:29'),
(6, 6, 1, 1, 'aaaa', '2025-09-27 09:23:30', '2025-09-27 09:23:30'),
(8, 3, 3, 1, NULL, '2025-10-02 13:42:37', '2025-10-02 13:42:37'),
(9, 3, 3, 5, NULL, '2025-10-02 13:42:59', '2025-10-02 13:42:59'),
(10, 3, 1, 5, NULL, '2025-10-02 13:43:18', '2025-10-02 13:43:18'),
(11, 3, 4, 4, NULL, '2025-10-02 14:41:22', '2025-10-02 14:41:22'),
(12, 3, 1, 5, NULL, '2025-10-02 14:55:23', '2025-10-02 14:55:23'),
(13, 3, 4, 5, 'a', '2025-10-03 05:19:30', '2025-10-03 05:19:30'),
(16, 7, 10, 5, 'ฟหกฟหก', '2025-10-03 05:33:51', '2025-10-03 05:33:51'),
(18, 3, 7, 4, 'ฟหกฟหก', '2025-10-03 06:02:53', '2025-10-03 06:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `site_visits`
--

CREATE TABLE `site_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_visits`
--

INSERT INTO `site_visits` (`id`, `ip_address`, `url`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 21:00:44', '2025-09-26 21:00:44'),
(2, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 21:03:11', '2025-09-26 21:03:11'),
(3, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 21:04:12', '2025-09-26 21:04:12'),
(4, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 21:04:15', '2025-09-26 21:04:15'),
(5, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 21:10:44', '2025-09-26 21:10:44'),
(6, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 21:11:16', '2025-09-26 21:11:16'),
(7, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 21:11:16', '2025-09-26 21:11:16'),
(8, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-26 21:11:22', '2025-09-26 21:11:22'),
(9, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 04:44:18', '2025-09-27 04:44:18'),
(10, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:05:16', '2025-09-27 05:05:16'),
(11, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:05:18', '2025-09-27 05:05:18'),
(12, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:05:27', '2025-09-27 05:05:27'),
(13, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:05:28', '2025-09-27 05:05:28'),
(14, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:05:41', '2025-09-27 05:05:41'),
(15, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:06:23', '2025-09-27 05:06:23'),
(16, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:19:57', '2025-09-27 05:19:57'),
(17, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:21:18', '2025-09-27 05:21:18'),
(18, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:30:11', '2025-09-27 05:30:11'),
(19, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:32:56', '2025-09-27 05:32:56'),
(20, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:33:25', '2025-09-27 05:33:25'),
(21, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:36:12', '2025-09-27 05:36:12'),
(22, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:36:13', '2025-09-27 05:36:13'),
(23, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:42:04', '2025-09-27 05:42:04'),
(24, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:42:06', '2025-09-27 05:42:06'),
(25, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:42:07', '2025-09-27 05:42:07'),
(26, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:42:07', '2025-09-27 05:42:07'),
(27, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:54:07', '2025-09-27 05:54:07'),
(28, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:56:04', '2025-09-27 05:56:04'),
(29, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 05:59:19', '2025-09-27 05:59:19'),
(30, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:25:22', '2025-09-27 06:25:22'),
(31, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:27:11', '2025-09-27 06:27:11'),
(32, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:27:27', '2025-09-27 06:27:27'),
(33, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:27:32', '2025-09-27 06:27:32'),
(34, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:32:26', '2025-09-27 06:32:26'),
(35, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:33:27', '2025-09-27 06:33:27'),
(36, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:33:28', '2025-09-27 06:33:28'),
(37, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:35:50', '2025-09-27 06:35:50'),
(38, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:35:56', '2025-09-27 06:35:56'),
(39, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:36:18', '2025-09-27 06:36:18'),
(40, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:42:52', '2025-09-27 06:42:52'),
(41, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 06:43:05', '2025-09-27 06:43:05'),
(42, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:23:42', '2025-09-27 07:23:42'),
(43, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:23:48', '2025-09-27 07:23:48'),
(44, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:24:26', '2025-09-27 07:24:26'),
(45, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:24:38', '2025-09-27 07:24:38'),
(46, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:25:16', '2025-09-27 07:25:16'),
(47, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:27:55', '2025-09-27 07:27:55'),
(48, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:32:50', '2025-09-27 07:32:50'),
(49, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:49:01', '2025-09-27 07:49:01'),
(50, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:49:27', '2025-09-27 07:49:27'),
(51, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:50:47', '2025-09-27 07:50:47'),
(52, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:50:53', '2025-09-27 07:50:53'),
(53, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:51:07', '2025-09-27 07:51:07'),
(54, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:51:12', '2025-09-27 07:51:12'),
(55, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 07:51:31', '2025-09-27 07:51:31'),
(56, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:10:04', '2025-09-27 08:10:04'),
(57, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:27:23', '2025-09-27 08:27:23'),
(58, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:27:45', '2025-09-27 08:27:45'),
(59, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:28:00', '2025-09-27 08:28:00'),
(60, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:30:54', '2025-09-27 08:30:54'),
(61, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:30:55', '2025-09-27 08:30:55'),
(62, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:30:55', '2025-09-27 08:30:55'),
(63, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:30:58', '2025-09-27 08:30:58'),
(64, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 08:57:16', '2025-09-27 08:57:16'),
(65, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:04:26', '2025-09-27 09:04:26'),
(66, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:04:35', '2025-09-27 09:04:35'),
(67, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:08:05', '2025-09-27 09:08:05'),
(68, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:08:13', '2025-09-27 09:08:13'),
(69, '127.0.0.1', 'http://127.0.0.1:8000/mangalist?author=Hiromu%20Arakawa', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:08:18', '2025-09-27 09:08:18'),
(70, '127.0.0.1', 'http://127.0.0.1:8000/mangalist?author=Eiichiro%20Oda', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:08:22', '2025-09-27 09:08:22'),
(71, '127.0.0.1', 'http://127.0.0.1:8000/mangalist?author=&genres%5B0%5D=Romancew', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:08:29', '2025-09-27 09:08:29'),
(72, '127.0.0.1', 'http://127.0.0.1:8000/mangalist', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:08:31', '2025-09-27 09:08:31'),
(73, '127.0.0.1', 'http://127.0.0.1:8000/mangalist?author=&genres%5B0%5D=Shonen', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:08:35', '2025-09-27 09:08:35'),
(74, '127.0.0.1', 'http://127.0.0.1:8000/mangalist?author=&genres%5B0%5D=Seinen', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:08:44', '2025-09-27 09:08:44'),
(75, '127.0.0.1', 'http://127.0.0.1:8000/mangalist?author=&genres%5B0%5D=Romancew', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:08:46', '2025-09-27 09:08:46'),
(76, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=Na', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:15:35', '2025-09-27 09:15:35'),
(77, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:37:59', '2025-09-27 09:37:59'),
(78, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:52:24', '2025-09-27 09:52:24'),
(79, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:52:47', '2025-09-27 09:52:47'),
(80, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:52:54', '2025-09-27 09:52:54'),
(81, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 09:53:00', '2025-09-27 09:53:00'),
(82, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 10:45:19', '2025-09-27 10:45:19'),
(83, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 10:45:22', '2025-09-27 10:45:22'),
(84, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 10:48:11', '2025-09-27 10:48:11'),
(85, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 10:48:14', '2025-09-27 10:48:14'),
(86, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 10:53:36', '2025-09-27 10:53:36'),
(87, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 15:03:40', '2025-09-27 15:03:40'),
(88, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 19:56:24', '2025-09-27 19:56:24'),
(89, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 20:13:19', '2025-09-27 20:13:19'),
(90, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 20:32:03', '2025-09-27 20:32:03'),
(91, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 20:39:35', '2025-09-27 20:39:35'),
(92, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=Demon', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 21:08:40', '2025-09-27 21:08:40'),
(93, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 21:08:42', '2025-09-27 21:08:42'),
(94, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 21:08:50', '2025-09-27 21:08:50'),
(95, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 21:08:53', '2025-09-27 21:08:53'),
(96, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 21:20:44', '2025-09-27 21:20:44'),
(97, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 21:20:45', '2025-09-27 21:20:45'),
(98, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-27 21:31:36', '2025-09-27 21:31:36'),
(99, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 05:41:45', '2025-09-28 05:41:45'),
(100, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 05:42:34', '2025-09-28 05:42:34'),
(101, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 05:42:34', '2025-09-28 05:42:34'),
(102, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 05:42:37', '2025-09-28 05:42:37'),
(103, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:03:40', '2025-09-28 06:03:40'),
(104, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:03:42', '2025-09-28 06:03:42'),
(105, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:21:19', '2025-09-28 06:21:19'),
(106, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:21:23', '2025-09-28 06:21:23'),
(107, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:22:31', '2025-09-28 06:22:31'),
(108, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:24:24', '2025-09-28 06:24:24'),
(109, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:24:52', '2025-09-28 06:24:52'),
(110, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:24:53', '2025-09-28 06:24:53'),
(111, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:24:54', '2025-09-28 06:24:54'),
(112, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=Naruto', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:25:08', '2025-09-28 06:25:08'),
(113, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:26:21', '2025-09-28 06:26:21'),
(114, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:31:11', '2025-09-28 06:31:11'),
(115, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:31:18', '2025-09-28 06:31:18'),
(116, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:31:22', '2025-09-28 06:31:22'),
(117, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:31:22', '2025-09-28 06:31:22'),
(118, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:31:27', '2025-09-28 06:31:27'),
(119, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:31:28', '2025-09-28 06:31:28'),
(120, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:33:49', '2025-09-28 06:33:49'),
(121, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:33:53', '2025-09-28 06:33:53'),
(122, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:34:00', '2025-09-28 06:34:00'),
(123, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:34:03', '2025-09-28 06:34:03'),
(124, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:34:31', '2025-09-28 06:34:31'),
(125, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:35:30', '2025-09-28 06:35:30'),
(126, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:35:42', '2025-09-28 06:35:42'),
(127, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:42:22', '2025-09-28 06:42:22'),
(128, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:43:52', '2025-09-28 06:43:52'),
(129, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:45:27', '2025-09-28 06:45:27'),
(130, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:48:01', '2025-09-28 06:48:01'),
(131, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:48:21', '2025-09-28 06:48:21'),
(132, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 06:48:21', '2025-09-28 06:48:21'),
(133, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 07:12:02', '2025-09-28 07:12:02'),
(134, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 19:21:53', '2025-09-28 19:21:53'),
(135, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 19:22:47', '2025-09-28 19:22:47'),
(136, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 19:23:08', '2025-09-28 19:23:08'),
(137, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 19:23:29', '2025-09-28 19:23:29'),
(138, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 19:23:35', '2025-09-28 19:23:35'),
(139, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 19:23:41', '2025-09-28 19:23:41'),
(140, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 19:30:05', '2025-09-28 19:30:05'),
(141, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 19:30:13', '2025-09-28 19:30:13'),
(142, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:04:01', '2025-09-28 20:04:01'),
(143, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:04:04', '2025-09-28 20:04:04'),
(144, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:04:08', '2025-09-28 20:04:08'),
(145, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:04:17', '2025-09-28 20:04:17'),
(146, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:05:17', '2025-09-28 20:05:17'),
(147, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:05:42', '2025-09-28 20:05:42'),
(148, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:05:46', '2025-09-28 20:05:46'),
(149, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:05:56', '2025-09-28 20:05:56'),
(150, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:01', '2025-09-28 20:06:01'),
(151, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:04', '2025-09-28 20:06:04'),
(152, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:12', '2025-09-28 20:06:12'),
(153, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:16', '2025-09-28 20:06:16'),
(154, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:21', '2025-09-28 20:06:21'),
(155, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:26', '2025-09-28 20:06:26'),
(156, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:30', '2025-09-28 20:06:30'),
(157, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:35', '2025-09-28 20:06:35'),
(158, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:37', '2025-09-28 20:06:37'),
(159, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:42', '2025-09-28 20:06:42'),
(160, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:06:48', '2025-09-28 20:06:48'),
(161, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:11:42', '2025-09-28 20:11:42'),
(162, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:12:26', '2025-09-28 20:12:26'),
(163, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:15:28', '2025-09-28 20:15:28'),
(164, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:15:39', '2025-09-28 20:15:39'),
(165, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:15:52', '2025-09-28 20:15:52'),
(166, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:16:02', '2025-09-28 20:16:02'),
(167, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:17:14', '2025-09-28 20:17:14'),
(168, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-28 20:17:29', '2025-09-28 20:17:29'),
(169, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 03:56:26', '2025-09-29 03:56:26'),
(170, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 03:56:28', '2025-09-29 03:56:28'),
(171, '127.0.0.1', 'http://127.0.0.1:8000', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 03:58:47', '2025-09-29 03:58:47'),
(172, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=ss', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-01 14:34:01', '2025-10-01 14:34:01'),
(173, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=Nartuto', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-03 06:08:32', '2025-10-03 06:08:32'),
(174, '127.0.0.1', 'http://127.0.0.1:8000/manga/search?keyword=Naruto', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-03 06:08:39', '2025-10-03 06:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `status` enum('active','inactive') DEFAULT 'active',
  `profile_img` varchar(255) DEFAULT NULL,
  `join_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `email`, `password`, `role`, `status`, `profile_img`, `join_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'supershinn11', 'Teshin Bubpha', 'xvblackprince@gmail.com', '$2y$12$/HFtsdnzeLqpRRAZPJH6yOOzNMV1XGoRW4KKuswVF49k7PvdIAiV2', 'admin', 'active', NULL, '2025-09-26 06:43:00', NULL, '2025-09-26 06:43:00', '2025-09-28 06:34:26'),
(6, 'user1', 'user1', 'user@gmail.com', '$2y$12$lfISVf0qAEd./pNpc3h6GO5/qqEoYIcnyEmf0DXrkAw8eeZxBKpse', 'user', 'active', 'profiles/D2OKVGpXU7q5ohZgc5t0FQG2msek84qYTlwVNPfd.png', '2025-09-27 07:51:07', NULL, '2025-09-27 07:51:07', '2025-09-27 09:30:53'),
(7, 'shin', '', 'xvblackprince11@gmail.com', '$2y$12$QOCeicF0/ePcKAVNfilu6.oWPWsg9Jd7eJInX/5iG3RiNe1FDGVpG', 'user', 'active', NULL, '2025-10-03 05:12:54', NULL, '2025-10-03 05:12:54', '2025-10-03 05:37:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD UNIQUE KEY `unique_user_manga` (`user_id`,`manga_id`),
  ADD KEY `manga_id` (`manga_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`manga_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `manga_genre`
--
ALTER TABLE `manga_genre`
  ADD PRIMARY KEY (`manga_id`,`genre_id`),
  ADD KEY `fk_mg_genre` (`genre_id`);

--
-- Indexes for table `manga_visits`
--
ALTER TABLE `manga_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_manga_visits_manga` (`manga_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `manga_id` (`manga_id`);

--
-- Indexes for table `site_visits`
--
ALTER TABLE `site_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `manga`
--
ALTER TABLE `manga`
  MODIFY `manga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `manga_visits`
--
ALTER TABLE `manga_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `site_visits`
--
ALTER TABLE `site_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`manga_id`) ON DELETE CASCADE;

--
-- Constraints for table `manga_genre`
--
ALTER TABLE `manga_genre`
  ADD CONSTRAINT `fk_mg_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_mg_manga` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`manga_id`) ON DELETE CASCADE;

--
-- Constraints for table `manga_visits`
--
ALTER TABLE `manga_visits`
  ADD CONSTRAINT `fk_manga_visits_manga` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`manga_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`manga_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
