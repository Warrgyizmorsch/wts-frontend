-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2025 at 08:09 AM
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
-- Database: `wts`
--

-- --------------------------------------------------------

--
-- Table structure for table `buckets`
--

CREATE TABLE `buckets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bucket_color` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buckets`
--

INSERT INTO `buckets` (`id`, `name`, `bucket_color`, `parent_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'New', 'bg-primary', NULL, 0, '2025-08-27 06:07:34', '2025-08-27 06:07:34'),
(2, 'Yet to Call', 'bg-warning', 1, 0, '2025-08-27 06:07:34', '2025-08-27 06:07:34'),
(3, 'Not Connected', 'bg-danger', NULL, 0, '2025-08-27 06:07:34', '2025-08-27 06:07:34'),
(4, 'Call not answering', 'bg-info', 3, 0, '2025-08-27 06:07:34', '2025-08-27 06:07:34'),
(5, 'Switched Off', 'bg-danger', 3, 0, '2025-08-27 06:07:34', '2025-08-27 06:07:34'),
(6, 'Call back', 'bg-warning', 3, 0, '2025-08-27 06:07:34', '2025-08-27 06:07:34'),
(7, 'Out of network/service', 'bg-secondary', 3, 0, '2025-08-27 06:07:34', '2025-08-27 06:07:34'),
(8, 'Follow Up', 'bg-success', NULL, 0, '2025-08-27 06:07:34', '2025-08-27 06:07:34'),
(9, 'Documents awaited', 'bg-dark', 8, 0, '2025-08-27 06:07:34', '2025-08-27 06:07:34'),
(10, 'Documents received', 'bg-success', 8, 0, '2025-08-27 06:07:34', '2025-08-27 06:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_user@exmple.com|127.0.0.1', 'i:1;', 1755692015),
('laravel_cache_user@exmple.com|127.0.0.1:timer', 'i:1755692015;', 1755692015),
('laravel_cache_user@exmples.com|127.0.0.1', 'i:1;', 1755692028),
('laravel_cache_user@exmples.com|127.0.0.1:timer', 'i:1755692028;', 1755692028);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lead_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lead_bucket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lead_status` varchar(255) DEFAULT NULL,
  `lead_owner` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `campaign_name` varchar(255) DEFAULT NULL,
  `adset_name` varchar(255) DEFAULT NULL,
  `ad_name` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `whats_your_preferred_intake` varchar(255) DEFAULT NULL,
  `highest_completed` varchar(255) DEFAULT NULL,
  `any_academic_gap` tinyint(1) DEFAULT NULL,
  `budget` varchar(255) DEFAULT NULL,
  `applying_country_for_a_visa` varchar(255) DEFAULT NULL,
  `what_course_are_you_planning_to_study` varchar(255) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `route_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `icon`, `parent_id`, `route_id`, `sort_order`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'fas fa-home', NULL, 1, 1, 0, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(2, 'Management', 'fas fa-cogs', NULL, NULL, 2, 0, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(3, 'Roles', 'fas fa-user-shield', 2, 13, 1, 0, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(4, 'Routes', 'fas fa-route', 2, 2, 2, 0, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(5, 'Menus', 'fas fa-bars', 2, 18, 3, 0, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(6, 'Users', 'fas fa-users', NULL, NULL, 3, 0, '2025-08-18 03:35:53', '2025-08-20 22:51:22'),
(7, 'Add User', 'fas fa-user-plus', 6, 7, 1, 0, '2025-08-18 03:35:53', '2025-08-20 00:11:23'),
(8, 'List Users', 'fas fa-list', 6, 8, 2, 0, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(9, 'Permissions', 'fas fa-lock', NULL, NULL, 4, 0, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(10, 'Role Permissions', 'fas fa-user-shield', 9, 23, 1, 0, '2025-08-20 00:44:05', '2025-08-20 01:34:51'),
(11, 'User Overrides', 'fas fa-user-cog', 9, 25, 2, 0, '2025-08-20 00:45:00', '2025-08-23 00:57:42'),
(12, 'Leads', 'fas fa-list', NULL, NULL, 5, 0, '2025-08-26 04:13:32', '2025-08-26 04:13:54'),
(13, 'All Leads', 'fas fa-bars', 12, 27, 1, 0, '2025-08-26 04:15:21', '2025-08-26 04:46:04'),
(14, 'Bucket', 'fas fa-sliders-h', 12, 34, 2, 0, '2025-08-26 04:16:07', '2025-08-26 04:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_16_055311_create_roles_and_permissions_tables', 1),
(5, '2025_08_16_083559_add_is_allowed_to_user_and_role_permissions_table', 1),
(6, '2025_08_19_045519_add_contact_fields_to_users_table', 2),
(9, '2025_08_22_050625_add_menu_id_to_routes_table', 3),
(10, '2025_08_23_050350_create_buckets_table', 4),
(11, '2025_08_23_052759_create_leads_table', 4),
(12, '2025_08_25_095127_add_bucket_color_to_buckets_table', 4),
(13, '2025_08_25_121359_add_city_to_users_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 0, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(2, 'User', 0, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(3, 'Executive', 0, '2025-08-26 04:43:59', '2025-08-26 04:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `route_id`, `menu_id`, `is_allowed`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(2, 1, NULL, 2, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(3, 1, 13, 3, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(4, 1, 2, 4, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(5, 1, 18, 5, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(6, 1, NULL, 6, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(7, 1, 7, 7, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(8, 1, 8, 8, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(9, 1, NULL, 9, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(10, 1, 23, 10, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(11, 1, 25, 11, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(12, 1, NULL, 12, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(13, 1, NULL, 13, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(14, 1, NULL, 14, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(15, 1, 3, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(16, 1, 4, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(17, 1, 5, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(18, 1, 6, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(19, 1, 9, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(20, 1, 10, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(21, 1, 11, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(22, 1, 12, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(23, 1, 14, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(24, 1, 15, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(25, 1, 16, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(26, 1, 17, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(27, 1, 19, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(28, 1, 20, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(29, 1, 21, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(30, 1, 22, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(31, 1, 24, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(32, 1, 26, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(33, 1, 27, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(34, 1, 28, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(35, 1, 29, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(36, 1, 30, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(37, 1, 31, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(38, 1, 32, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(39, 1, 33, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(40, 1, 34, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(41, 1, 35, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(42, 1, 36, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(43, 1, 37, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(44, 1, 38, NULL, 1, '2025-08-26 04:42:35', '2025-08-26 04:42:35'),
(45, 3, 1, 1, 1, '2025-08-26 04:45:18', '2025-08-26 04:45:18'),
(46, 2, 1, 1, 1, '2025-08-26 23:38:37', '2025-08-26 23:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `route_name` varchar(150) NOT NULL,
  `method` varchar(10) NOT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `route_name`, `method`, `menu_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard', 'GET', 1, 0, '2025-08-18 03:35:53', '2025-08-22 05:02:31'),
(2, 'Route List', 'routes.index', 'GET', 4, 0, '2025-08-19 06:13:57', '2025-08-22 00:40:27'),
(3, 'Store Route', 'routes.store', 'POST', 4, 0, '2025-08-19 06:13:57', '2025-08-22 00:28:46'),
(4, 'Edit Route', 'routes.edit', 'GET', 4, 0, '2025-08-19 06:13:57', '2025-08-22 00:39:15'),
(5, 'Update Route', 'routes.update', 'PUT', 4, 0, '2025-08-19 06:13:57', '2025-08-22 00:39:35'),
(6, 'Delete Route', 'routes.destroy', 'DELETE', 4, 0, '2025-08-19 06:13:57', '2025-08-22 00:39:55'),
(7, 'Add User', 'users.create', 'GET', 6, 0, '2025-08-19 07:17:03', '2025-08-22 05:02:56'),
(8, 'Users List', 'users.index', 'GET', 6, 0, '2025-08-19 07:17:03', '2025-08-22 05:03:10'),
(9, 'Store User', 'users.store', 'POST', 6, 0, '2025-08-19 07:17:03', '2025-08-22 05:03:25'),
(10, 'Edit User', 'users.edit', 'GET', 6, 0, '2025-08-19 07:17:03', '2025-08-22 05:03:37'),
(11, 'Destroy User', 'users.destroy', 'DELETE', 6, 0, '2025-08-19 07:17:03', '2025-08-22 05:03:58'),
(12, 'Update User', 'users.update', 'PUT', 6, 0, '2025-08-19 07:17:03', '2025-08-22 05:04:23'),
(13, 'Roles List', 'roles.index', 'GET', 3, 0, '2025-08-19 07:50:13', '2025-08-26 04:32:20'),
(14, 'Store Role', 'roles.store', 'POST', 3, 0, '2025-08-19 07:50:13', '2025-08-26 04:32:37'),
(15, 'Edit Role', 'roles.edit', 'GET', 3, 0, '2025-08-19 07:50:13', '2025-08-26 04:32:55'),
(16, 'Update Role', 'roles.update', 'PUT', 3, 0, '2025-08-19 07:50:13', '2025-08-26 04:33:12'),
(17, 'Delete Role', 'roles.destroy', 'DELETE', 3, 0, '2025-08-19 07:50:13', '2025-08-26 04:33:27'),
(18, 'Menu List', 'menus.index', 'GET', 5, 0, '2025-08-19 04:12:57', '2025-08-26 04:33:48'),
(19, 'Add Menu', 'menus.store', 'POST', 5, 0, '2025-08-19 05:41:27', '2025-08-26 04:33:56'),
(20, 'Edit Menu', 'menus.edit', 'GET', 5, 0, '2025-08-19 06:02:27', '2025-08-26 04:34:05'),
(21, 'Update Menu', 'menus.update', 'PUT', 5, 0, '2025-08-19 06:03:14', '2025-08-26 04:35:06'),
(22, 'Delete Menu', 'menus.destroy', 'DELETE', 5, 0, '2025-08-19 06:05:13', '2025-08-26 04:35:18'),
(23, 'Role Permission List', 'role-permissions.index', 'GET', 10, 0, '2025-08-20 01:34:28', '2025-08-26 04:35:38'),
(24, 'Update Role Permission', 'role-permissions.update', 'POST', 10, 0, '2025-08-20 04:23:43', '2025-08-26 04:35:50'),
(25, 'User Permission List', 'user-permissions.index', 'GET', 11, 0, '2025-08-23 00:56:26', '2025-08-26 04:36:03'),
(26, 'Update User Permission', 'user-permissions.update', 'POST', 11, 0, '2025-08-23 00:57:23', '2025-08-26 04:36:13'),
(27, 'Lead List', 'lead.index', 'GET', 13, 0, '2025-08-26 04:20:17', '2025-08-26 04:20:35'),
(28, 'Add Lead', 'lead.create', 'GET', 13, 0, '2025-08-26 04:22:34', '2025-08-26 04:23:40'),
(29, 'Store Lead', 'lead.store', 'POST', 13, 0, '2025-08-26 04:24:09', '2025-08-26 04:24:09'),
(30, 'Edit Lead', 'lead.edit', 'GET', 13, 0, '2025-08-26 04:24:36', '2025-08-26 04:24:36'),
(31, 'Update Lead', 'lead.update', 'PUT', 13, 0, '2025-08-26 04:25:33', '2025-08-26 04:25:33'),
(32, 'Update Bucket', 'lead.updateBucket', 'PUT', 13, 0, '2025-08-26 04:27:05', '2025-08-26 04:27:05'),
(33, 'Update Status', 'lead.updateStatus', 'PUT', 13, 0, '2025-08-26 04:28:04', '2025-08-26 04:28:04'),
(34, 'Bucket List', 'bucket.index', 'GET', 14, 0, '2025-08-26 04:29:05', '2025-08-26 04:29:05'),
(35, 'Store Bucket', 'bucket.store', 'POST', 14, 0, '2025-08-26 04:29:35', '2025-08-26 04:29:35'),
(36, 'Edit Bucket', 'bucket.edit', 'GET', 14, 0, '2025-08-26 04:30:03', '2025-08-26 04:30:03'),
(37, 'Update Bucket', 'bucket.update', 'PUT', 14, 0, '2025-08-26 04:30:33', '2025-08-26 04:30:33'),
(38, 'Delete Bucket', 'bucket.destroy', 'DELETE', 14, 0, '2025-08-26 04:31:10', '2025-08-26 04:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_code` varchar(5) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `country_code`, `city`, `contact_no`, `image`, `email_verified_at`, `password`, `is_deleted`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, NULL, NULL, NULL, NULL, '$2y$12$p8Wsq41MjkpGcsQirFSXnOIVHLc35zrBc.x.kl3gP23XPlpU5FG7e', 0, 1, NULL, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(2, 'Normal User', 'user@example.com', NULL, NULL, NULL, NULL, NULL, '$2y$12$2MGdKO8a13fyw389kAkbs.AXugOKzsD4gz2vumGZgXB.xiDRgXbYC', 0, 2, NULL, '2025-08-18 03:35:53', '2025-08-18 03:35:53'),
(3, 'Executive User', 'test@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$12$F/gE59wp1Y/mFKX0wafqYOBoU8Z177W8TmLYqroJTKW88S5uDkyja', 0, 3, NULL, '2025-08-26 02:55:07', '2025-08-26 02:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buckets`
--
ALTER TABLE `buckets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buckets_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`),
  ADD KEY `menus_route_id_foreign` (`route_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`),
  ADD KEY `role_permissions_route_id_foreign` (`route_id`),
  ADD KEY `role_permissions_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `routes_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_permissions_user_id_foreign` (`user_id`),
  ADD KEY `user_permissions_route_id_foreign` (`route_id`),
  ADD KEY `user_permissions_menu_id_foreign` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buckets`
--
ALTER TABLE `buckets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buckets`
--
ALTER TABLE `buckets`
  ADD CONSTRAINT `buckets_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `buckets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menus_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `routes_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD CONSTRAINT `user_permissions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_permissions_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
