-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2024 pada 05.57
-- Versi server: 5.6.16
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Site Administrator'),
(2, 'user', 'Regular User'),
(3, 'kepala_bps', 'add disposisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 3),
(2, 4),
(2, 5),
(3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 07:31:01', 1),
(2, '::1', 'farin', NULL, '2023-10-10 09:10:58', 0),
(3, '::1', 'farin', NULL, '2023-10-10 09:11:15', 0),
(4, '::1', 'farin', NULL, '2023-10-10 09:11:45', 0),
(5, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:25:51', 1),
(6, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:29:56', 1),
(7, '::1', 'farin', NULL, '2023-10-10 09:30:36', 0),
(8, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:30:48', 1),
(9, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:34:11', 1),
(10, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:35:11', 1),
(11, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:35:34', 1),
(12, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:35:52', 1),
(13, '::1', 'farin', NULL, '2023-10-10 09:40:06', 0),
(14, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:40:14', 1),
(15, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:43:40', 1),
(16, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:44:06', 1),
(17, '::1', 'farin', NULL, '2023-10-10 09:44:17', 0),
(18, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-10 09:44:41', 1),
(19, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-14 07:08:51', 1),
(20, '::1', 'nursaid@gmail.com', 2, '2023-10-14 08:05:04', 1),
(21, '::1', 'farin', NULL, '2023-10-14 08:18:57', 0),
(22, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-14 08:19:07', 1),
(23, '::1', 'nursaid@gmail.com', 2, '2023-10-14 08:19:22', 1),
(24, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-14 08:20:25', 1),
(25, '::1', 'nursaid@gmail.com', 2, '2023-10-14 08:48:45', 1),
(26, '::1', 'ratriku88@gmail.com', 3, '2023-10-14 08:52:32', 1),
(27, '::1', 'fatrisfaradila281@gmail.com', 1, '2023-10-14 08:52:57', 1),
(28, '::1', 'nursaid@gmail.com', 2, '2023-10-14 08:53:13', 1),
(29, '::1', 'ratriku88@gmail.com', 3, '2023-10-17 04:35:59', 1),
(30, '::1', 'ratriku88@gmail.com', 3, '2023-10-17 07:38:28', 1),
(31, '::1', 'ratriku88@gmail.com', 3, '2023-10-17 07:44:15', 1),
(32, '::1', 'ratriku88@gmail.com', 3, '2023-10-17 08:40:57', 1),
(33, '::1', 'ratriku88@gmail.com', 3, '2023-10-19 02:14:05', 1),
(34, '::1', 'Ratris', NULL, '2023-10-19 02:15:44', 0),
(35, '::1', 'ratriku88@gmail.com', 3, '2023-10-19 02:15:55', 1),
(36, '::1', 'ratriku88@gmail.com', 3, '2023-10-19 08:57:43', 1),
(37, '::1', 'ratriku88@gmail.com', 3, '2023-10-19 12:33:17', 1),
(38, '::1', 'ratriku88@gmail.com', 3, '2023-10-23 04:29:48', 1),
(39, '::1', 'ratriku88@gmail.com', 3, '2023-10-23 04:29:49', 1),
(40, '::1', 'ratriku88@gmail.com', 3, '2023-10-23 05:01:36', 1),
(41, '::1', 'ratriku88@gmail.com', 3, '2023-10-23 08:08:57', 1),
(42, '::1', 'ratriku88@gmail.com', 3, '2023-10-24 10:08:53', 1),
(43, '::1', 'ratriku88@gmail.com', 3, '2023-10-24 10:42:26', 1),
(44, '::1', 'ratriku88@gmail.com', 3, '2023-10-28 08:25:41', 1),
(45, '::1', 'ratriku88@gmail.com', 3, '2023-10-28 14:19:28', 1),
(46, '::1', 'user', NULL, '2023-10-29 07:48:05', 0),
(47, '::1', 'ratriku88@gmail.com', 3, '2023-10-29 07:48:18', 1),
(48, '::1', 'nursaid@gmail.com', 2, '2023-10-29 07:50:31', 1),
(49, '::1', 'caturbayu@gmail.com', 4, '2023-10-29 07:52:31', 1),
(50, '::1', 'ratriku88@gmail.com', 3, '2023-10-29 10:43:46', 1),
(51, '::1', 'nursaid@gmail.com', 5, '2023-10-29 10:51:10', 1),
(52, '::1', 'nursaid@gmail.com', 5, '2023-10-29 10:54:43', 1),
(53, '::1', 'caturbayu@gmail.com', 4, '2023-10-29 12:13:29', 1),
(54, '::1', 'nursaid@gmail.com', 5, '2023-10-29 13:18:33', 1),
(55, '::1', 'ratriku88@gmail.com', 3, '2023-10-29 14:25:07', 1),
(56, '::1', 'ratriku88@gmail.com', 3, '2023-10-29 17:18:35', 1),
(57, '::1', 'ratriku88@gmail.com', 3, '2023-10-30 02:27:43', 1),
(58, '::1', 'caturbayu@gmail.com', 4, '2023-10-30 02:28:59', 1),
(59, '::1', 'ratriku88@gmail.com', 3, '2023-10-30 02:55:01', 1),
(60, '::1', 'ratriku88@gmail.com', 3, '2023-10-30 03:16:41', 1),
(61, '::1', 'ratriku88@gmail.com', 3, '2023-10-30 04:27:29', 1),
(62, '::1', 'nursaid@gmail.com', 5, '2023-10-30 07:44:26', 1),
(63, '::1', 'ratriku88@gmail.com', 3, '2023-10-30 07:44:48', 1),
(64, '::1', 'ratriku88@gmail.com', 3, '2023-10-30 16:54:30', 1),
(65, '::1', 'ratriku88@gmail.com', 3, '2023-10-31 04:41:51', 1),
(66, '::1', 'ratriku88@gmail.com', 3, '2023-10-31 07:25:13', 1),
(67, '::1', 'ratriku88@gmail.com', 3, '2023-10-31 09:01:38', 1),
(68, '::1', 'ratriku88@gmail.com', 3, '2023-11-01 01:54:51', 1),
(69, '::1', 'ratriku88@gmail.com', 3, '2023-11-01 02:00:27', 1),
(70, '::1', 'ratriku88@gmail.com', 3, '2023-11-01 02:50:38', 1),
(71, '::1', 'caturbayu@gmail.com', 4, '2023-11-01 02:53:52', 1),
(72, '::1', 'ratriku88@gmail.com', 3, '2023-11-01 02:56:50', 1),
(73, '::1', 'ratriku88@gmail.com', 3, '2023-11-03 10:58:12', 1),
(74, '::1', 'ratriku88@gmail.com', 3, '2023-11-06 07:31:42', 1),
(75, '::1', 'caturbayu@gmail.com', 4, '2023-11-06 08:22:39', 1),
(76, '::1', 'user', NULL, '2023-11-06 14:16:30', 0),
(77, '::1', 'caturbayu@gmail.com', 4, '2023-11-06 14:16:33', 1),
(78, '::1', 'ratriku88@gmail.com', 3, '2023-11-06 15:25:58', 1),
(79, '::1', 'ratriku88@gmail.com', 3, '2023-11-07 01:12:38', 1),
(80, '::1', 'ratriku88@gmail.com', 3, '2023-11-07 02:54:24', 1),
(81, '::1', 'caturbayu@gmail.com', 4, '2023-11-07 03:23:26', 1),
(82, '::1', 'ratriku88@gmail.com', 3, '2023-11-07 03:35:43', 1),
(83, '::1', 'caturbayu@gmail.com', 4, '2023-11-07 03:40:19', 1),
(84, '::1', 'drs.rahyudin.sst@gmail.com', 6, '2023-11-07 04:39:04', 1),
(85, '::1', 'rahyudin@gmail.com', 7, '2023-11-07 04:48:55', 1),
(86, '::1', 'rahyudin@gmail.com', 7, '2023-11-07 04:58:48', 1),
(87, '::1', 'ratriku88@gmail.com', 3, '2023-11-07 06:57:14', 1),
(88, '::1', 'rahyudin@gmail.com', 7, '2023-11-07 06:59:16', 1),
(89, '::1', 'rahyudin@gmail.com', 7, '2023-11-07 07:26:57', 1),
(90, '::1', 'rahyudin@gmail.com', 7, '2023-11-07 07:59:07', 1),
(91, '::1', 'rahyudin@gmail.com', 7, '2023-11-07 08:02:22', 1),
(92, '::1', 'ratriku88@gmail.com', 3, '2023-11-07 08:03:05', 1),
(93, '::1', 'caturbayu@gmail.com', 4, '2023-11-07 08:09:22', 1),
(94, '::1', 'rahyudin@gmail.com', 7, '2023-11-08 08:14:32', 1),
(95, '::1', 'ratriku88@gmail.com', 3, '2023-11-10 05:20:32', 1),
(96, '::1', 'super', NULL, '2023-11-10 09:15:03', 0),
(97, '::1', 'rahyudin@gmail.com', 7, '2023-11-10 09:15:13', 1),
(98, '::1', 'caturbayu@gmail.com', 4, '2023-11-10 09:32:21', 1),
(99, '::1', 'rahyudin@gmail.com', 7, '2023-11-10 09:33:09', 1),
(100, '::1', 'ratriku88@gmail.com', 3, '2023-11-10 09:55:08', 1),
(101, '::1', 'ratriku88@gmail.com', 3, '2023-11-10 12:49:01', 1),
(102, '::1', 'rahyudin@gmail.com', 7, '2023-11-10 13:30:08', 1),
(103, '::1', 'ratriku88@gmail.com', 3, '2023-11-10 13:52:52', 1),
(104, '::1', 'ratriku88@gmail.com', 3, '2023-11-11 04:25:41', 1),
(105, '::1', 'Ratriwidi', NULL, '2023-11-11 09:40:32', 0),
(106, '::1', 'Ratri', NULL, '2023-11-11 09:41:33', 0),
(107, '::1', 'Ratri1', NULL, '2023-11-11 10:33:01', 0),
(108, '::1', 'ratriku88@gmail.com', 3, '2023-11-11 10:51:01', 1),
(109, '::1', 'ratriku88@gmail.com', 3, '2023-11-11 10:51:24', 1),
(110, '::1', 'ratriku88@gmail.com', 3, '2023-11-12 02:56:15', 1),
(111, '::1', 'ratriku88@gmail.com', 3, '2023-11-12 14:50:22', 1),
(112, '::1', 'caturbayu@gmail.com', 4, '2023-11-12 15:43:53', 1),
(113, '::1', 'rahyudin@gmail.com', 7, '2023-11-12 16:39:07', 1),
(114, '::1', 'rahyudin@gmail.com', 7, '2023-11-13 01:40:05', 1),
(115, '::1', 'rahyudin@gmail.com', 7, '2023-11-13 01:49:29', 1),
(116, '::1', 'rahyudin@gmail.com', 7, '2023-11-15 06:04:46', 1),
(117, '::1', 'ratriku88@gmail.com', 3, '2023-11-15 06:10:24', 1),
(118, '::1', 'ratriku88@gmail.com', 3, '2023-11-15 06:51:37', 1),
(119, '::1', 'caturbayu@gmail.com', 4, '2023-11-15 07:25:05', 1),
(120, '::1', 'ratriku88@gmail.com', 3, '2023-11-15 07:49:30', 1),
(121, '::1', 'ratriku88@gmail.com', 3, '2023-11-15 09:01:22', 1),
(122, '::1', 'nursaid@gmail.com', 5, '2023-11-15 09:39:26', 1),
(123, '::1', 'rahyudin@gmail.com', 7, '2023-11-15 09:40:29', 1),
(124, '::1', 'rahyudin@gmail.com', 7, '2023-11-15 12:00:02', 1),
(125, '::1', 'ratriku88@gmail.com', 3, '2023-11-15 12:12:24', 1),
(126, '::1', 'rahyudin@gmail.com', 7, '2023-11-15 12:26:56', 1),
(127, '::1', 'ratriku88@gmail.com', 3, '2023-11-15 12:28:37', 1),
(128, '::1', 'nursaid@gmail.com', 5, '2023-11-15 13:18:59', 1),
(129, '::1', 'nursaid@gmail.com', 5, '2023-11-15 13:19:00', 1),
(130, '::1', 'caturbayu@gmail.com', 4, '2023-11-15 13:28:54', 1),
(131, '::1', 'junmi@gmail.com', 9, '2023-11-15 13:31:00', 1),
(132, '::1', 'rahyudin@gmail.com', 7, '2023-11-15 13:36:29', 1),
(133, '::1', 'ratriku88@gmail.com', 3, '2023-11-16 09:40:52', 1),
(134, '::1', 'ratriku88@gmail.com', 3, '2023-11-22 08:14:58', 1),
(135, '::1', 'ratriku88@gmail.com', 3, '2023-11-23 13:50:34', 1),
(136, '::1', 'rahyudin@gmail.com', 7, '2023-11-23 13:50:56', 1),
(137, '::1', 'ratriku88@gmail.com', 3, '2023-11-25 04:15:38', 1),
(138, '::1', 'alifahrudin@gmail.com', 9, '2023-11-25 04:59:52', 1),
(139, '::1', 'ratriku88@gmail.com', 3, '2023-11-25 05:05:35', 1),
(140, '::1', 'ratriku88@gmail.com', 3, '2023-11-25 05:27:18', 1),
(141, '::1', 'rahyudin@gmail.com', 7, '2023-11-25 05:29:20', 1),
(142, '::1', 'ratriku88@gmail.com', 3, '2023-11-25 06:09:01', 1),
(143, '::1', 'diahtri@gmail.com', 17, '2023-11-25 06:10:16', 1),
(144, '::1', 'aviads@gmail.com', 12, '2023-11-25 06:12:11', 1),
(145, '::1', 'alifahrudin@gmail.com', 9, '2023-11-25 06:16:54', 1),
(146, '::1', 'ratriku88@gmail.com', 3, '2023-11-25 06:17:40', 1),
(147, '::1', 'ratriku88@gmail.com', 3, '2023-11-25 07:19:01', 1),
(148, '::1', 'rahyudin@gmail.com', 7, '2023-11-25 07:30:19', 1),
(149, '::1', 'ratriku88@gmail.com', 3, '2023-11-26 02:57:05', 1),
(150, '::1', 'rahyudin@gmail.com', 7, '2023-11-26 03:11:43', 1),
(151, '::1', 'ratriku88@gmail.com', 3, '2023-11-26 03:13:04', 1),
(152, '::1', 'ratriku88@gmail.com', 3, '2023-11-26 08:05:52', 1),
(153, '::1', 'ratriku88@gmail.com', 3, '2023-11-26 13:44:16', 1),
(154, '::1', 'ratriku88@gmail.com', 3, '2023-11-26 13:56:20', 1),
(155, '::1', 'ratriku88@gmail.com', 3, '2023-11-26 15:40:14', 1),
(156, '::1', 'ratriku88@gmail.com', 3, '2023-11-27 05:55:34', 1),
(157, '::1', 'ratriku88@gmail.com', 3, '2023-11-27 14:19:23', 1),
(158, '::1', 'asihm@gmail.com', 23, '2023-11-27 14:20:15', 1),
(159, '::1', 'ratriku88@gmail.com', 3, '2023-11-28 04:00:37', 1),
(160, '::1', 'ratriku88@gmail.com', 3, '2023-11-28 07:49:13', 1),
(161, '::1', 'ratriku88@gmail.com', 3, '2023-11-28 13:45:51', 1),
(162, '::1', 'rahyudin@gmail.com', 7, '2023-11-28 13:50:40', 1),
(163, '::1', 'caturbayu@gmail.com', 4, '2023-11-28 19:47:05', 1),
(164, '::1', 'admin', NULL, '2023-12-01 14:00:25', 0),
(165, '::1', 'caturbayu@gmail.com', 4, '2023-12-01 14:00:33', 1),
(166, '::1', 'admin', NULL, '2023-12-01 14:01:30', 0),
(167, '::1', 'ratriku88@gmail.com', 3, '2023-12-01 14:01:44', 1),
(168, '::1', 'Rahyudin', NULL, '2023-12-01 15:59:33', 0),
(169, '::1', 'rahyudin@gmail.com', 7, '2023-12-01 15:59:37', 1),
(170, '::1', 'caturbayu@gmail.com', 4, '2023-12-01 17:51:04', 1),
(171, '::1', 'ratriku88@gmail.com', 3, '2023-12-01 17:56:43', 1),
(172, '::1', 'caturbayu@gmail.com', 4, '2023-12-01 17:56:55', 1),
(173, '::1', 'rahyudin@gmail.com', 7, '2023-12-01 17:57:07', 1),
(174, '::1', 'bps', NULL, '2023-12-01 18:01:14', 0),
(175, '::1', 'caturbayu@gmail.com', 4, '2023-12-01 18:01:20', 1),
(176, '::1', 'rahyudin@gmail.com', 7, '2023-12-01 18:02:54', 1),
(177, '::1', 'caturbayu@gmail.com', 4, '2023-12-01 18:21:16', 1),
(178, '::1', 'ratriku88@gmail.com', 3, '2023-12-01 18:21:27', 1),
(179, '::1', 'ratriku88@gmail.com', 3, '2023-12-01 21:21:52', 1),
(180, '::1', 'caturbayu@gmail.com', 4, '2023-12-01 21:26:35', 1),
(181, '::1', 'ratriku88@gmail.com', 3, '2023-12-01 21:36:30', 1),
(182, '::1', 'ratriku88@gmail.com', 3, '2023-12-01 21:59:35', 1),
(183, '::1', 'Bayu', NULL, '2023-12-01 22:18:06', 0),
(184, '::1', 'caturbayu@gmail.com', 4, '2023-12-01 22:18:14', 1),
(185, '::1', 'ratriku88@gmail.com', 3, '2023-12-01 22:20:09', 1),
(186, '::1', 'ratriku88@gmail.com', 3, '2023-12-02 01:40:52', 1),
(187, '::1', 'caturbayu@gmail.com', 4, '2023-12-02 03:37:48', 1),
(188, '::1', 'caturbayu@gmail.com', 4, '2023-12-02 04:25:32', 1),
(189, '::1', 'caturbayu@gmail.com', 4, '2023-12-03 04:49:01', 1),
(190, '::1', 'rahyudin@gmail.com', 7, '2023-12-03 04:49:13', 1),
(191, '::1', 'ratriku88@gmail.com', 3, '2023-12-03 06:54:15', 1),
(192, '::1', 'caturbayu@gmail.com', 4, '2023-12-03 07:10:35', 1),
(193, '::1', 'ratriku88@gmail.com', 3, '2023-12-03 07:56:17', 1),
(194, '::1', 'ratriku88@gmail.com', 3, '2023-12-03 08:19:02', 1),
(195, '::1', 'caturbayu@gmail.com', 4, '2023-12-03 09:28:17', 1),
(196, '::1', 'asihm@gmail.com', 23, '2023-12-03 09:31:12', 1),
(197, '::1', 'rahyudin@gmail.com', 7, '2023-12-03 09:37:06', 1),
(198, '::1', 'rahyudin@gmail.com', 3, '2023-12-09 07:45:11', 1),
(199, '::1', 'ratriku88@gmail.com', 1, '2023-12-09 08:05:43', 1),
(200, '::1', 'rahyudin@gmail.com', 3, '2023-12-09 08:06:54', 1),
(201, '::1', 'rahyudin@gmail.com', 3, '2023-12-09 08:07:46', 1),
(202, '::1', 'ratriku88@gmail.com', 1, '2023-12-09 08:08:12', 1),
(203, '::1', 'ratriku88@gmail.com', 1, '2023-12-09 09:48:42', 1),
(204, '::1', 'ratriku88@gmail.com', 1, '2023-12-12 07:15:57', 1),
(205, '::1', 'DrsRahyudin', NULL, '2023-12-12 08:32:40', 0),
(206, '::1', 'ratriku88@gmail.com', 1, '2023-12-12 08:33:02', 1),
(207, '::1', 'ratriku88@gmail.com', 1, '2023-12-12 09:39:52', 1),
(208, '::1', 'ratriku88@gmail.com', 1, '2023-12-12 09:40:24', 1),
(209, '::1', 'Ratri', NULL, '2023-12-12 09:46:31', 0),
(210, '::1', 'Ratri', NULL, '2023-12-12 09:46:37', 0),
(211, '::1', 'ratriku88@gmail.com', 1, '2023-12-12 09:46:45', 1),
(212, '::1', 'ratriku88@gmail.com', 1, '2023-12-13 10:36:04', 1),
(213, '::1', 'rahyudin@gmail.com', 2, '2023-12-13 10:43:07', 1),
(214, '::1', 'ratriku88@gmail.com', 1, '2023-12-13 11:06:11', 1),
(215, '::1', 'ratriku88@gmail.com', 1, '2023-12-13 12:29:42', 1),
(216, '::1', 'ratriku88@gmail.com', 1, '2023-12-17 06:11:37', 1),
(217, '::1', 'ratriku88@gmail.com', 1, '2023-12-17 07:37:25', 1),
(218, '::1', 'bayu@gmail.com', 3, '2023-12-17 10:29:52', 1),
(219, '::1', 'rahyudin@gmail.com', 2, '2023-12-17 10:30:51', 1),
(220, '::1', 'ratriku88@gmail.com', 1, '2023-12-18 00:24:27', 1),
(221, '::1', 'ratriku88@gmail.com', 1, '2023-12-18 03:22:49', 1),
(222, '::1', 'Rahhyudin', NULL, '2023-12-18 04:38:52', 0),
(223, '::1', 'Rahhyudin', NULL, '2023-12-18 04:39:22', 0),
(224, '::1', 'Rahhyudin', NULL, '2023-12-18 04:39:30', 0),
(225, '::1', 'Rahhyudin', NULL, '2023-12-18 04:39:51', 0),
(226, '::1', 'Rahhyudin', NULL, '2023-12-18 04:40:15', 0),
(227, '::1', 'rahyudin@gmail.com', 2, '2023-12-18 04:40:53', 1),
(228, '::1', 'ratriku88@gmail.com', 1, '2023-12-18 06:34:00', 1),
(229, '::1', 'ratriku88@gmail.com', 1, '2023-12-18 07:33:10', 1),
(230, '::1', 'ratriku88@gmail.com', 1, '2023-12-18 07:42:09', 1),
(231, '::1', 'ratriku88@gmail.com', 1, '2023-12-18 12:29:15', 1),
(232, '::1', 'Bayu', NULL, '2023-12-18 13:17:51', 0),
(233, '::1', 'bayu@gmail.com', 3, '2023-12-18 13:18:10', 1),
(234, '::1', 'ratriku88@gmail.com', 1, '2023-12-18 13:19:36', 1),
(235, '::1', 'ratriku88@gmail.com', 1, '2023-12-19 05:38:21', 1),
(236, '::1', 'bayu@gmail.com', 3, '2023-12-19 05:47:11', 1),
(237, '::1', 'rahyudin@gmail.com', 2, '2023-12-19 06:57:47', 1),
(238, '::1', 'ratriku88@gmail.com', 1, '2023-12-19 08:10:30', 1),
(239, '::1', 'bayu@gmail.com', 3, '2023-12-19 09:30:08', 1),
(240, '::1', 'Rahyudin', NULL, '2023-12-19 09:38:31', 0),
(241, '::1', 'rahyudin@gmail.com', 2, '2023-12-19 09:38:48', 1),
(242, '::1', 'bayu@gmail.com', 3, '2023-12-19 09:39:32', 1),
(243, '::1', 'ratriku88@gmail.com', 1, '2023-12-19 14:13:12', 1),
(244, '::1', 'ratriku88@gmail.com', 1, '2023-12-19 14:53:35', 1),
(245, '::1', 'ratriku88@gmail.com', 1, '2023-12-20 01:23:24', 1),
(246, '::1', 'ratriku88@gmail.com', 1, '2023-12-20 01:24:16', 1),
(247, '::1', 'rahyudin@gmail.com', 2, '2023-12-20 03:45:29', 1),
(248, '::1', 'Ratri', NULL, '2023-12-22 14:47:44', 0),
(249, '::1', 'Ratrih', NULL, '2023-12-22 14:47:59', 0),
(250, '::1', 'Ratriy', NULL, '2023-12-22 14:57:55', 0),
(251, '::1', 'Ratri', NULL, '2023-12-22 14:59:19', 0),
(252, '::1', 'Ratriy', NULL, '2023-12-22 15:38:34', 0),
(253, '::1', 'Ratri', NULL, '2023-12-22 15:53:56', 0),
(254, '::1', '', 5, '2023-12-26 07:00:38', 1),
(255, '::1', '', 2, '2023-12-26 07:30:25', 1),
(256, '::1', '', 1, '2023-12-26 08:03:13', 1),
(257, '::1', '', 3, '2023-12-26 08:18:00', 1),
(258, '::1', '', 1, '2023-12-26 08:46:06', 1),
(259, '::1', '', 1, '2023-12-26 14:32:19', 1),
(260, '::1', '', 1, '2023-12-26 14:36:24', 1),
(261, '::1', '', 1, '2023-12-26 15:06:29', 1),
(262, '::1', '', 1, '2023-12-26 16:31:53', 1),
(263, '::1', '', 2, '2023-12-26 18:09:04', 1),
(264, '::1', '', 1, '2023-12-26 18:18:37', 1),
(265, '::1', '', 1, '2023-12-26 18:36:20', 1),
(266, '::1', '', 2, '2023-12-26 18:55:32', 1),
(267, '::1', '', 3, '2023-12-26 18:57:44', 1),
(268, '::1', '', 3, '2023-12-26 19:08:15', 1),
(269, '::1', '', 1, '2023-12-26 19:18:10', 1),
(270, '::1', '', 2, '2023-12-26 19:26:27', 1),
(271, '::1', '', 3, '2023-12-26 19:53:45', 1),
(272, '::1', '', 1, '2023-12-27 03:40:03', 1),
(273, '::1', '', 2, '2023-12-27 03:40:59', 1),
(274, '::1', '', 1, '2023-12-27 05:07:57', 1),
(275, '::1', '', 1, '2023-12-27 10:52:23', 1),
(276, '::1', '', 1, '2023-12-27 10:57:49', 1),
(277, '::1', '', 1, '2023-12-29 15:41:57', 1),
(278, '::1', '', 1, '2023-12-30 02:05:12', 1),
(279, '::1', '', 1, '2023-12-30 03:36:57', 1),
(280, '::1', '', 1, '2023-12-30 07:48:38', 1),
(281, '::1', '', 1, '2024-01-04 02:10:42', 1),
(282, '::1', '', 1, '2024-01-09 09:17:45', 1),
(283, '::1', 'Bayu', NULL, '2024-01-09 09:21:14', 0),
(284, '::1', '', 3, '2024-01-09 09:52:19', 1),
(285, '::1', 'Sodik', NULL, '2024-01-09 09:55:17', 0),
(286, '::1', '', 4, '2024-01-09 09:55:39', 1),
(287, '::1', '', 1, '2024-01-09 09:56:08', 1),
(288, '::1', 'Rahyudin', NULL, '2024-01-09 09:56:46', 0),
(289, '::1', 'Rahyudinn', NULL, '2024-01-09 09:57:05', 0),
(290, '::1', '', 2, '2024-01-09 09:57:20', 1),
(291, '::1', '', 4, '2024-01-09 09:58:36', 1),
(292, '::1', '', 1, '2024-01-09 12:36:10', 1),
(293, '::1', '', 1, '2024-01-10 04:03:42', 1),
(294, '::1', '', 1, '2024-01-10 12:33:47', 1),
(295, '::1', '', 1, '2024-01-10 13:47:15', 1),
(296, '::1', '', 2, '2024-01-10 14:38:35', 1),
(297, '::1', '', 2, '2024-01-10 14:38:36', 1),
(298, '::1', '', 3, '2024-01-10 14:46:36', 1),
(299, '::1', 'Ratri', NULL, '2024-01-10 15:59:16', 0),
(300, '::1', '', 1, '2024-01-10 15:59:38', 1),
(301, '::1', '', 1, '2024-01-15 08:00:46', 1),
(302, '::1', '', 1, '2024-01-16 04:55:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-users', 'Manage All Users'),
(2, 'manage-profile', 'Manage user\'s profile'),
(3, 'Manage disposisi', 'Kelola disposisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(5, 'Fungsional Pranata Keuangan APBN Terampil'),
(6, 'Fungsional Pelaksana'),
(7, 'Statistisi Ahli Muda'),
(8, 'Statistisi Ahli Pertama'),
(9, 'Statistisi Penyelia'),
(10, 'Statistisi Mahir'),
(11, 'Pranata Komputer Ahli Muda'),
(12, 'Pelaksana'),
(14, 'Kepala BPS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1696829311, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `pengajuan_id` int(7) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pengaju` varchar(30) NOT NULL,
  `perihal` text NOT NULL,
  `detail_perihal` text NOT NULL,
  `alamat` text NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status_pengajuan` text NOT NULL,
  `status_akhir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`pengajuan_id`, `id_user`, `nama_pengaju`, `perihal`, `detail_perihal`, `alamat`, `tgl_surat`, `tgl_pengajuan`, `tgl_selesai`, `status_pengajuan`, `status_akhir`) VALUES
(1, 3, 'Bayu', 'Validasi REGSOSEK Tahun 2022', 'Untuk Bapak/ibu RT, Tempat aula BPS Kota Pekalongan, Pukul 10 pagi - selesai, wajib membawa daftar nama warga', 'Kelurahan Podosugih Kota Pekalongan                                 ', '2023-07-12', '2023-12-26', '0000-00-00 00:00:00', 'belum diproses', ''),
(2, 3, 'Bayu', 'Antar Dokumen Regsosek Tahun 2022', 'Semua dokumen telah di validasi dan terverifikasi', 'BPS Provinsi Jawa Tengah                                    ', '2023-08-15', '2023-12-26', '0000-00-00 00:00:00', 'belum diproses', ''),
(3, 4, 'Sodik', 'Pengajuan', 'surat', 'Pekalongan', '2009-06-21', '2024-01-09', '0000-00-00 00:00:00', 'belum diproses', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `no_berkas` int(7) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_surat` date NOT NULL,
  `perihal` text NOT NULL,
  `no_petunjuk` date NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `scan_surat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`no_berkas`, `alamat`, `tgl_surat`, `perihal`, `no_petunjuk`, `no_surat`, `scan_surat`) VALUES
(1, 'BPS Provinsi Jawa Tengah', '2023-03-08', 'Perbaikan Presensi', '2023-12-26', '044', 'http://localhost:8080/uploads044_Perbaikan%20Presensi.pdf'),
(2, 'BKN', '2023-03-09', 'Antar dokumen KGB ST Diah', '2023-12-26', '045', 'http://localhost:8080/uploads045_Antar%20dokumen%20KGB%20ST%20Diah.pdf'),
(3, 'pekalongan', '2024-09-12', 'ioj', '2024-01-16', 'IX', 'http://localhost:8080/uploadsIX_ioj.pdf'),
(4, 'lkkjh', '2024-09-12', 'uihiuhi', '2024-01-16', 'iih', 'http://localhost:8080/uploads/20240912_iih_uihiuhi.pdf'),
(5, 'aaaa', '2009-09-12', 'ccc', '2024-01-16', 'bbb', 'http://localhost:8080/uploads/20090912_bbb_ccc.pdf'),
(6, 'mmm', '0000-00-00', 'oooo', '2024-01-16', 'llll', '20030912_llll_oooo.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `no_berkas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_surat` date DEFAULT NULL,
  `no_surat` varchar(50) NOT NULL,
  `perihal` text NOT NULL,
  `no_petunjuk` date NOT NULL,
  `scan_surat` varchar(100) NOT NULL,
  `status_awal` text NOT NULL,
  `catatan` text NOT NULL,
  `id_jabatan` int(7) NOT NULL,
  `id` int(11) NOT NULL,
  `tgl_diterima_pegawai` date NOT NULL,
  `kepada` varchar(25) NOT NULL,
  `tgl_lambat` date NOT NULL,
  `status_akhir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`no_berkas`, `alamat`, `tgl_surat`, `no_surat`, `perihal`, `no_petunjuk`, `scan_surat`, `status_awal`, `catatan`, `id_jabatan`, `id`, `tgl_diterima_pegawai`, `kepada`, `tgl_lambat`, `status_akhir`) VALUES
(1, 'SMK Veteran', '2023-04-05', '103', 'Permohonan Prakerin', '2023-12-26', '103_Permohonan Prakerin.pdf', 'Sudah Disposisi', 'belum', 7, 3, '0000-00-00', '', '0000-00-00', ''),
(2, 'BPS Provinsi Jawa Tengah', '2023-04-06', '565', 'Pengantar PAK an Gancar Ariadi dan TA Suharto', '2023-12-26', '565_Pengantar PAK an Gancar Ariadi dan TA Suharto.pdf', 'Sudah Disposisi', 'belum', 7, 3, '0000-00-00', '', '0000-00-00', ''),
(3, 'BPS Provinsi Jawa Tengah', '2023-04-06', '765', 'Undangan Evaluasi SUSENAS Maret 2023 Seruti Triwulan I 2023', '2023-12-26', '765_Undangan Evaluasi SUSENAS Maret 2023 Seruti Triwulan I 2023.pdf', 'Sudah Disposisi', 'belum', 9, 4, '0000-00-00', '', '0000-00-00', ''),
(4, 'BPS Kabupaten Batang', '2023-12-30', '45', 'Rapat Triwulan ', '2024-01-10', '45_Rapat Triwulan .png', 'Belum Disposisi', 'belum', 0, 0, '0000-00-00', '', '0000-00-00', ''),
(5, 'jihgfd', '2024-01-11', ';,lmkjhgqcfghj', 'dxcftvgybhuj', '2024-01-16', ';,lmkjhgqcfghj_dxcftvgybhuj.pdf', 'Belum Disposisi', 'belum', 0, 0, '0000-00-00', '', '0000-00-00', ''),
(6, 'o', '2001-09-12', 'vii', 'vg', '2024-01-16', 'vii_vg.pdf', 'Belum Disposisi', 'belum', 0, 0, '0000-00-00', '', '0000-00-00', ''),
(7, 'Pekalongan', '2024-09-12', 'ix', 'Kelompok', '2024-01-16', '20240912_ix_Kelompok.pdf', 'Belum Disposisi', 'belum', 0, 0, '0000-00-00', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `foto`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`, `id_jabatan`) VALUES
(1, 'Ratri ', 'UserFoto_Ratri .png', '$2y$10$o3lh4.pTXp96zIsQ49HlB.lx2SOiXwgjuT1j3Ex16d2VdX3HNMnDK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-10-14 08:52:22', '2023-10-14 08:52:22', NULL, NULL),
(2, 'Rahyudin', 'default.jpg', '$2y$10$yKoK8SgSpxfegc1Q7Ou7le0owMv6tAwgL3CN/t4A9hWYcvduAqj4a', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-12-13 10:37:22', '2023-12-13 10:37:22', NULL, 14),
(3, 'Bayu', 'default.jpg', '$2y$10$uwosnu1MKOGRi7fzFfxW.OAq8N44Rx27WllKiKyYQKzBvAyP55bVi', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-12-17 10:17:25', '2023-12-17 10:17:25', NULL, 7),
(4, 'Sodik', 'default.jpg', '$2y$10$lRZdFnmjgKP0gWUetSCz6eRiXBGPQpM0k514C9KvUT84IX4cpCU4e', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-12-18 03:36:46', '2023-12-19 14:48:20', NULL, 9),
(5, 'Herutami', 'default.jpg', '$2y$10$l.tDbTl.9kerXCfkWzkecO2AlsH.BcOH4A4QrExAOmocMj0Notbn.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-12-26 04:12:42', '2023-12-26 04:12:42', NULL, 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`pengajuan_id`),
  ADD KEY `id_pegawai` (`id_user`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`no_berkas`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`no_berkas`),
  ADD KEY `pegawai` (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `pengajuan_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `no_berkas` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `no_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
