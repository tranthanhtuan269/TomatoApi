-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 14, 2018 lúc 05:45 PM
-- Phiên bản máy phục vụ: 5.7.24-0ubuntu0.16.04.1
-- Phiên bản PHP: 7.1.20-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tomatoApi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `expiration_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `service_id`, `value`, `expiration_date`, `created_at`, `updated_at`) VALUES
(1, 'HSP-00001', 1, 10, '2018-11-19 17:00:00', '2018-11-13 02:25:14', '2018-11-13 02:44:56'),
(2, 'HSP-00002', 1, 10, '2018-11-19 17:00:00', '2018-11-13 02:26:15', '2018-11-13 02:46:36'),
(3, 'HSP-00003', 0, 10, '2018-11-26 17:00:00', '2018-11-13 02:29:13', '2018-11-13 02:46:28'),
(5, 'HSP-00005', 1, 10, '2018-11-19 17:00:00', '2018-11-13 02:43:02', '2018-11-13 02:46:20'),
(6, 'HSP-00006', 0, 20, '2018-11-19 17:00:00', '2018-11-13 02:46:54', '2018-11-13 02:47:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `daily_report`
--

CREATE TABLE `daily_report` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `rewards` int(11) NOT NULL DEFAULT '0',
  `promotional` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `daily_report`
--

INSERT INTO `daily_report` (`id`, `name`, `total`, `rewards`, `promotional`, `created_at`, `updated_at`) VALUES
(1, '2018-11-14', 335000, 0, 7000, '2018-11-14 02:19:05', '2018-11-14 03:01:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Đồ bộ'),
(2, 'Áo'),
(3, 'Quần'),
(4, 'Váy'),
(5, 'Chăn'),
(6, 'Phụ kiện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2018_08_23_014733_create_groups_table', 1),
(9, '2018_09_09_024128_create_services', 1),
(10, '2018_09_09_024152_create_package', 1),
(11, '2018_09_09_024229_create_orders', 1),
(12, '2018_09_09_025200_create_job_user', 1),
(13, '2018_09_09_025200_create_order_package', 2),
(14, '2018_10_13_072147_create_news_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monthly_report`
--

CREATE TABLE `monthly_report` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `rewards` int(11) NOT NULL DEFAULT '0',
  `promotional` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `monthly_report`
--

INSERT INTO `monthly_report` (`id`, `name`, `total`, `rewards`, `promotional`, `created_at`, `updated_at`) VALUES
(1, '2018-11', 335000, 0, 7000, '2018-11-14 02:19:05', '2018-11-14 03:01:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `author`, `created_at`, `updated_at`) VALUES
(1, 'HSP ra mắt phiên bản 1.0 trên cả 2 hệ điều hành android và Ios.', 'Content', 'Author', '2018-10-13 01:44:09', '2018-10-13 01:44:09'),
(2, 'Tặng 1000 voucher cho 1000 khách hàng sử dụng dịch vụ đầu tiên', 'Content', 'Author', '2018-10-13 03:59:33', '2018-10-13 03:59:33'),
(3, 'Tặng 10.000 VND / mỗi giao dịch thành công từ tài khoản bạn bè được giới thiệu', '<p>Content</p>', 'Author', '2018-10-13 04:02:56', '2018-11-12 03:40:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('15dd58287e061c60bb8166cec4c83c08a4a0eab09837860b7b9a8bb927aa067533b48c44a8a760ca', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-27 20:41:35', '2018-09-27 20:41:35', '2018-10-05 03:41:36'),
('44b2856bec968c10bf6fb88fbd018df7d6d4fda3854cc3baaf22c7b5477433fb4e8a41431f265b0b', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-26 01:41:22', '2018-09-26 01:41:22', '2018-10-03 08:41:22'),
('4bb4096e9a3a759eddb2a1d7715e79ef0d32e8377a869efc2ae9efa9e8d3734bec7c36891b6cbce8', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-13 04:14:28', '2018-09-13 04:14:28', '2018-09-20 11:14:28'),
('6dfc818c3b7f1026c0494bfa70027d32918a68a8f5d4f6d86ee4fb1aa13a852545ec1f394f646fe6', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-26 00:16:33', '2018-09-26 00:16:33', '2018-10-03 07:16:33'),
('700029dfb0fe880a443029f956a54c5090249779b97069610f0a10d770edebabf104bc580a60b024', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-16 07:12:05', '2018-09-16 07:12:05', '2018-09-23 14:12:05'),
('80e42c130bab004bf28fbe71e2171941db7e42cbbad7ab72b5df871a738573b4ea97bece7b436172', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-26 00:47:50', '2018-09-26 00:47:50', '2018-10-03 07:47:50'),
('8d9e14545f7d4a925f296af0b5ee6a07fcf30ba258250f3ca79b7398c693a992f172b197bef714a5', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-27 21:07:24', '2018-09-27 21:07:24', '2018-10-05 04:07:24'),
('938d27918e221b902cc6ad0627a8219979502bed8a71731956ad10b9b29142c8b475dad9da79194f', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-27 21:09:39', '2018-09-27 21:09:39', '2018-10-05 04:09:39'),
('bddb8c89d47c768e3e36637eac34ac19345482ee63e9e897506cc6c3d16bf387c80ad720546deb88', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-26 00:07:10', '2018-09-26 00:07:10', '2018-10-03 07:07:10'),
('c179e10df2f35d067675f607aabb78de206c0a246ae50c974b49d53ade553cc198a2c7515e3c3729', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-27 20:48:37', '2018-09-27 20:48:37', '2018-10-05 03:48:37'),
('c33b640daca14144cc0ee3a45bb05d5e297959b33059fcda38b28e7f3c0199db488aed141c0058b6', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-27 20:51:07', '2018-09-27 20:51:07', '2018-10-05 03:51:07'),
('f2d198360553d8341198f465e26c4452f97164e88ce8acd7e7924a524ba65f64de689b2671009186', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-27 19:22:05', '2018-09-27 19:22:05', '2018-10-05 02:22:05'),
('f3506e4127392e66357c87f51c3e90b766a5b91fe539f7d88c0327333b9243073831eea2c02ace27', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-26 01:41:34', '2018-09-26 01:41:34', '2018-10-03 08:41:34'),
('f9e5bf72d3fd73e3992312d13ce822aaf9af79d08af5fb6b9986c387b1145405b8c208c6e35b18ad', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-27 23:50:42', '2018-09-27 23:50:42', '2018-10-05 06:50:42'),
('fddc26fc880d8e3d94fb973d1e8638b2e28d7706898f7e3785d2e69969d6c52190e6b50a70a321d6', 1, 1, 'Personal Access Token', '[]', 0, '2018-09-26 01:42:41', '2018-09-26 01:42:41', '2018-10-03 08:42:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'oZwbUwxK11XWagHQKpn6FTtMAXgb9YOih4opiXS3', 'http://localhost', 1, 0, 0, '2018-09-13 04:14:20', '2018-09-13 04:14:20'),
(2, NULL, 'Laravel Password Grant Client', 'Llh1U73OX9xLlQS89LMHlahxgv2j6QzN3ubXQFQ1', 'http://localhost', 0, 1, 0, '2018-09-13 04:14:20', '2018-09-13 04:14:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-09-13 04:14:20', '2018-09-13 04:14:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rewards` int(11) NOT NULL DEFAULT '0',
  `promotional` int(11) NOT NULL DEFAULT '0',
  `pay_type` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `list_packages` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `number_address`, `note`, `start_time`, `end_time`, `state`, `price`, `rewards`, `promotional`, `pay_type`, `username`, `email`, `promotion_code`, `list_packages`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '11a', NULL, '1541307633000', '1541271633000', 1, '70000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', 'HSP-00001', '[{"package_id":80,"number":2}]', NULL, '2018-11-03 10:47:44', '2018-11-04 20:20:54'),
(2, 7, '292 Tây Sơn, Ngã Tư Sở, Đống Đa, Hà Nội, Vietnam', '504', NULL, '1541408457000', '1541408457000', 1, '240000', 0, 0, 1, 'Nguyen Vu Kien', 'nvukien@gmail.com', NULL, '[{"number":3,"package_id":80},{"number":2,"package_id":86},{"number":1,"package_id":88}]', NULL, '2018-11-05 01:23:17', '2018-11-05 01:24:09'),
(3, 1, 'Tòa Nhà Tây Hà Tố Hữu, Hanoi, Hà Nội 100000, Việt Nam', '555', NULL, '1541415654000', '1541415654000', 1, '105000', 0, 0, 1, 'aa', 'aaa@aaa.com', NULL, '[{"package_id":80,"number":3}]', NULL, '2018-11-05 01:27:57', '2018-11-05 09:24:27'),
(4, 1, 'Tòa Nhà Tây Hà Tố Hữu, Hanoi, Hà Nội 100000, Việt Nam', '12', NULL, '1541415608000', '1541415608000', 1, '140000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', NULL, '[{"package_id":80,"number":2},{"package_id":84,"number":2}]', NULL, '2018-11-05 08:40:19', '2018-11-05 09:24:31'),
(5, 3, '1 Stockton St, San Francisco, CA  94108, Hiệp Chủng Quốc Hoa Kỳ', 'xxxxx', NULL, '1541420520000.0', '1541420520000.0', 1, '105000', 0, 0, 1, NULL, 'vvv@ggg.vbv', NULL, '[{"package_id":80, "number":3}]', NULL, '2018-11-05 09:23:15', '2018-11-05 09:24:29'),
(6, 12, '2 Đường Lê Đức Thọ, Mỹ Đình, Từ Liêm, Hà Nội, Việt Nam', '12', NULL, '1541422821000', '1541422821000', 1, '190000', 0, 0, 1, 'dinh xuân hải', 'haidx.hsp@gmail.com', NULL, '[{"package_id":81,"number":1},{"package_id":112,"number":1},{"package_id":116,"number":1},{"package_id":117,"number":1}]', NULL, '2018-11-05 10:32:43', '2018-11-06 04:03:22'),
(7, 7, '282 Tây Sơn, Trung Liệt, Đống Đa, Hà Nội, Vietnam', '504', NULL, '1541484043000', '1541484043000', 1, '70000', 0, 0, 1, 'Nguyễn Vũ Kiên', 'nvukien@gmail.com', NULL, '[{"number":2,"package_id":80}]', NULL, '2018-11-06 04:02:57', '2018-11-06 04:03:19'),
(8, 7, '292 Phố Tây Sơn, P. Ngã Tư Sở, Quận Đống Đa, Thành Phố Hà Nội, Vietnam', '504', NULL, '1541653920000.0', '1541653920000.0', 1, '178000', 0, 0, 1, NULL, 'nvukien@gmail.com', NULL, '[{"package_id":85, "number":1},{"package_id":84, "number":2},{"package_id":80, "number":2}]', NULL, '2018-11-08 02:13:39', '2018-11-08 02:14:34'),
(9, 19, 'P. Mỹ Đình, Quận Nam Từ Liêm, Thành Phố Hà Nội, Việt Nam', '2011 HD Mon', NULL, '1541826953000.0', '1541826953000.0', 1, '105000', 0, 0, 1, NULL, 'haidx@gmail.com', NULL, '[{"package_id":80, "number":3}]', NULL, '2018-11-08 02:18:11', '2018-11-08 04:51:21'),
(10, 19, 'P. Mỹ Đình, Quận Nam Từ Liêm, Thành Phố Hà Nội, Việt Nam', '33', NULL, '1541659140000.0', '1541659140000.0', 1, '500000', 0, 0, 1, NULL, 'haidx.hsp@gmail.com', NULL, '[{"package_id":158, "number":1},{"package_id":158, "number":1}]', NULL, '2018-11-08 03:40:38', '2018-11-08 04:51:20'),
(11, 19, 'P. Mỹ Đình, Quận Nam Từ Liêm, Thành Phố Hà Nội, Việt Nam', '22', NULL, '1541659380000.0', '1541659380000.0', 1, '45000', 0, 0, 1, NULL, 'haidx.hsp@gmail.com', NULL, '[{"package_id":247, "number":3}]', NULL, '2018-11-08 03:43:51', '2018-11-08 04:51:23'),
(12, 7, 'Phố Tây Sơn, P. Trung Liệt, Quận Đống Đa, Thành Phố Hà Nội, Vietnam', '504', NULL, '1541757060000.0', '1541757060000.0', 1, '105000', 0, 0, 1, NULL, 'nvukien@gmail.com', NULL, '[{"package_id":84, "number":1},{"package_id":80, "number":2}]', NULL, '2018-11-09 06:51:39', '2018-11-12 03:40:47'),
(13, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1102', NULL, '1541901635000', '1541901635000', 2, '265000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', 'coupon20-10', '[{"package_id":80,"number":2},{"package_id":81,"number":2},{"package_id":84,"number":1},{"package_id":116,"number":2}]', NULL, '2018-11-10 23:06:36', '2018-11-14 02:19:18'),
(14, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1103', NULL, '1541901604000', '1541901604000', 1, '140000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', 'coupon20-10', '[{"package_id":80,"number":2},{"package_id":84,"number":2}]', NULL, '2018-11-10 23:20:42', '2018-11-12 03:40:46'),
(15, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1116', NULL, '1541901616000', '1541901616000', 1, '200000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', NULL, '[{"package_id":233,"number":2}]', NULL, '2018-11-10 23:33:28', '2018-11-12 03:40:43'),
(16, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1102', NULL, '1541901656000', '1541901656000', 1, '105000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', NULL, '[{"package_id":80,"number":2},{"package_id":84,"number":1}]', NULL, '2018-11-10 23:43:07', '2018-11-12 03:40:39'),
(17, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1102', NULL, '1541901658000', '1541901658000', 1, '140000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', NULL, '[{"package_id":80,"number":2},{"package_id":84,"number":2}]', NULL, '2018-11-10 23:45:16', '2018-11-12 03:40:38'),
(18, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1103', NULL, '1541901641000', '1541901641000', 1, '105000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', NULL, '[{"package_id":80,"number":2},{"package_id":84,"number":1}]', NULL, '2018-11-10 23:47:50', '2018-11-12 03:40:40'),
(19, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1102', NULL, '1541901608000', '1541901608000', 1, '195000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', NULL, '[{"package_id":80,"number":2},{"package_id":84,"number":1},{"package_id":94,"number":1}]', NULL, '2018-11-10 23:49:20', '2018-11-12 03:40:45'),
(20, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1103', NULL, '1541905257000', '1541905257000', 1, '105000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', NULL, '[{"package_id":80,"number":2},{"package_id":84,"number":1}]', NULL, '2018-11-11 00:12:08', '2018-11-12 03:40:34'),
(21, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', 'h12', NULL, '1541905207000', '1541905207000', 1, '105000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', NULL, '[{"package_id":80,"number":2},{"package_id":84,"number":1}]', NULL, '2018-11-11 00:13:16', '2018-11-12 03:40:38'),
(22, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1102', NULL, '1541905211000', '1541905211000', 1, '140000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', NULL, '[{"package_id":80,"number":2},{"package_id":84,"number":2}]', NULL, '2018-11-11 00:25:20', '2018-11-12 03:40:37'),
(23, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1111', NULL, '1541905244000', '1541905244000', 1, '70000', 0, 0, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', NULL, '[{"package_id":80,"number":2}]', NULL, '2018-11-11 00:33:55', '2018-11-12 03:40:35'),
(24, 1, 'HH2 Bắc Hà, 19, 441 Vũ Hữu, Trung Văn, Thanh Xuân, Hà Nội, Vietnam', '1102', NULL, '1541905225000', '1541905225000', 2, '70000', 0, 7000, 1, 'Tran Thanh Tuan', 'tuantt@gmail.com', 'HSP-00001', '[{"package_id":80,"number":2}]', NULL, '2018-11-11 00:39:54', '2018-11-14 03:01:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_package`
--

CREATE TABLE `order_package` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_package`
--

INSERT INTO `order_package` (`order_id`, `package_id`, `number`) VALUES
(2, 80, 3),
(2, 86, 2),
(2, 88, 1),
(3, 80, 3),
(4, 80, 2),
(4, 84, 2),
(5, 80, 3),
(6, 81, 1),
(6, 112, 1),
(6, 116, 1),
(6, 117, 1),
(7, 80, 2),
(8, 85, 1),
(8, 84, 2),
(8, 80, 2),
(9, 80, 3),
(10, 158, 1),
(10, 158, 1),
(11, 247, 3),
(12, 84, 1),
(12, 80, 2),
(13, 80, 2),
(13, 81, 2),
(13, 84, 1),
(13, 116, 2),
(14, 80, 2),
(14, 84, 2),
(15, 233, 2),
(16, 80, 2),
(16, 84, 1),
(17, 80, 2),
(17, 84, 2),
(18, 80, 2),
(18, 84, 1),
(19, 80, 2),
(19, 84, 1),
(19, 94, 1),
(20, 80, 2),
(20, 84, 1),
(21, 80, 2),
(21, 84, 1),
(22, 80, 2),
(22, 84, 2),
(23, 80, 2),
(24, 80, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ja` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ko` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `packages`
--

INSERT INTO `packages` (`id`, `name`, `name_en`, `name_ja`, `name_ko`, `price`, `image`, `service_id`) VALUES
(1, 'Sooc', NULL, NULL, NULL, '35000', 'quansooc.jpg', 9),
(2, 'Sooc', NULL, NULL, NULL, '45000', 'quansooc.jpg', 14),
(3, 'Sơ mi/phụ kiện', NULL, NULL, NULL, '35000', 'aosomi.jpg', 8),
(4, 'Sơ mi/phụ kiện', NULL, NULL, NULL, '45000', 'aosomi.jpg', 13),
(5, 'Phông', NULL, NULL, NULL, '35000', 'aophong.jpg', 8),
(6, 'Phông', NULL, NULL, NULL, '45000', 'aophong.jpg', 13),
(7, 'Phông dài tay', NULL, NULL, NULL, '38000', 'aophongdaitay.jpg', 8),
(8, 'Phông dài tay', NULL, NULL, NULL, '48000', 'aophongdaitay.jpg', 13),
(9, 'Sơ mi', NULL, NULL, NULL, '35000', 'aosomi.jpg', 8),
(10, 'Sơ mi', NULL, NULL, NULL, '45000', 'aosomi.jpg', 13),
(11, 'Gi lê', NULL, NULL, NULL, '35000', 'aogile.jpg', 8),
(12, 'Gi lê', NULL, NULL, NULL, '45000', 'aogile.jpg', 13),
(13, 'Pyjama thường', NULL, NULL, NULL, '45000', 'pyjama.jpg', 7),
(14, 'Pyjama thường', NULL, NULL, NULL, '55000', 'pyjama.jpg', 12),
(15, 'Pyjama cao cấp', NULL, NULL, NULL, '95000', 'pyjama2.jpg', 12),
(16, 'Jeans', NULL, NULL, NULL, '45000', 'quanjean.jpg', 9),
(17, 'Jeans', NULL, NULL, NULL, '55000', 'quanjean.jpg', 14),
(18, 'Chân váy ngắn', NULL, NULL, NULL, '45000', 'chanvayngan.jpg', 10),
(19, 'Chân váy ngắn', NULL, NULL, NULL, '55000', 'chanvayngan.jpg', 15),
(20, 'Chân váy dài', NULL, NULL, NULL, '55000', 'chanvaydai.png', 10),
(21, 'Chân váy dài', NULL, NULL, NULL, '65000', 'chanvaydai.png', 15),
(22, 'Sơ mi nữ/phụ kiện', NULL, NULL, NULL, '45000', 'somiphukien.jpg', 8),
(23, 'Sơ mi nữ/phụ kiện', NULL, NULL, NULL, '55000', 'somiphukien.jpg', 13),
(24, 'Len hè mỏng', NULL, NULL, NULL, '55000', 'lenhemong.jpg', 8),
(25, 'Len hè mỏng', NULL, NULL, NULL, '65000', 'lenhemong.jpg', 13),
(26, 'Khoác', NULL, NULL, NULL, '65000', 'aokhoac.jpg', 8),
(27, 'Khoác', NULL, NULL, NULL, '75000', 'aokhoac.jpg', 13),
(28, 'Thể thao thường', NULL, NULL, NULL, '65000', 'thethaothuong.jpg', 7),
(29, 'Thể thao thường', NULL, NULL, NULL, '75000', 'thethaothuong.jpg', 12),
(30, 'Liền thân ngắn', NULL, NULL, NULL, '65000', 'lienthanngan.jpg', 10),
(31, 'Liền thân ngắn', NULL, NULL, NULL, '75000', 'lienthanngan.jpg', 15),
(32, 'Liền thân dài', NULL, NULL, NULL, '90000', 'lienthandai.png', 10),
(33, 'Liền thân dài', NULL, NULL, NULL, '100000', 'lienthandai.png', 15),
(34, 'Bộ công nhân', NULL, NULL, NULL, '65000', 'docongnhan.jpeg', 7),
(35, 'Bộ công nhân', NULL, NULL, NULL, '75000', 'docongnhan.jpeg', 12),
(36, 'Áo len dày', NULL, NULL, NULL, '75000', 'aolenday.jpg', 8),
(37, 'Áo len dày', NULL, NULL, NULL, '85000', 'aolenday.jpg', 13),
(38, 'Áo khoác ngắn', NULL, NULL, NULL, '75000', 'aokhoacngan.jpg', 8),
(39, 'Áo khoác ngắn', NULL, NULL, NULL, '85000', 'aokhoacngan.jpg', 13),
(40, 'Áo dài thường', NULL, NULL, NULL, '75000', 'aodaithuong.jpg', 8),
(41, 'Áo dài thường', NULL, NULL, NULL, '85000', 'aodaithuong.jpg', 13),
(42, 'Áo dài cao cấp', NULL, NULL, NULL, '120000', 'aodaicaocap.jpg', 13),
(43, 'Áo khoác dạ dài', NULL, NULL, NULL, '100000', 'aokhoacdadai.jpg', 8),
(44, 'Áo khoác dạ dài', NULL, NULL, NULL, '110000', 'aokhoacdadai.jpg', 13),
(45, 'Áo lông vũ dài', NULL, NULL, NULL, '200000', 'aophaolongvu.webp', 13),
(46, 'Áo lông vũ ngắn', NULL, NULL, NULL, '150000', 'aophaolongvu.webp', 13),
(47, 'Áo dạ', NULL, NULL, NULL, '95000', 'aodacaocap.jpg', 8),
(48, 'Áo dạ', NULL, NULL, NULL, '105000', 'aodacaocap.jpg', 13),
(49, 'Áo bông', NULL, NULL, NULL, '90000', 'aobong.jpg', 8),
(50, 'Áo bông', NULL, NULL, NULL, '100000', 'aobong.jpg', 13),
(51, 'Váy cưới dạ hội', NULL, NULL, NULL, '150000', 'vaycuoidahoi.jpg', 15),
(52, 'Hanbok (2 chiếc)', NULL, NULL, NULL, '85000', 'hanbok.jpg', 12),
(53, 'Hanbok (3 chiếc)', NULL, NULL, NULL, '95000', 'hanbok.jpg', 12),
(54, 'Áo da', NULL, NULL, NULL, '500000', 'aodacaocap2.jpg', 13),
(55, 'Cà vạt', NULL, NULL, NULL, '21000', 'cavat.jpg', 18),
(56, 'Khăn cổ nhỏ', NULL, NULL, NULL, '33000', 'khanquangconho.jpg', 18),
(57, 'Khăn cổ to', NULL, NULL, NULL, '43000', 'khanquangcoto.jpg', 18),
(58, 'Khoác 2 lớp ', NULL, NULL, NULL, '125000', 'aokhoac2lop.png', 13),
(59, 'Vest ( 2 chiếc)', NULL, NULL, NULL, '95000', 'vest_nam.jpg', 12),
(60, 'Vest ( 3 chiếc)', NULL, NULL, NULL, '125000', 'vest_nam.jpg', 12),
(61, 'Khăn tay', NULL, NULL, NULL, '10000', 'khanmuixoa.jpg', 17),
(62, 'Tất ', NULL, NULL, NULL, '10000', 'tat.jpg', 17),
(63, 'Quần lót', NULL, NULL, NULL, '10000', 'quanlot.jpg', 9),
(64, 'Găng tay', NULL, NULL, NULL, '20000', 'gangtay.jpg', 17),
(65, 'Áo lót', NULL, NULL, NULL, '20000', 'aolot.jpg', 8),
(66, 'Vỏ gối', NULL, NULL, NULL, '20000', 'vogoi.png', 11),
(67, 'Giầy thể thao', NULL, NULL, NULL, '75000', 'giaythethao.jpg', 17),
(68, 'Giầy thể thao', NULL, NULL, NULL, '80000', 'giaythethao.jpg', 18),
(69, 'Khăn tắm', NULL, NULL, NULL, '20000', 'khantam.jpg', 11),
(70, 'Chăn hè', NULL, NULL, NULL, '120000', 'chanhe.jpg', 11),
(71, 'Chăn len', NULL, NULL, NULL, '145000', 'chanlen.jpg', 11),
(72, 'Chăn đông', NULL, NULL, NULL, '155000', 'chandong.jpg', 11),
(73, 'Vỏ chăn', NULL, NULL, NULL, '75000', 'vochan.webp', 11),
(74, 'Ga giường to', NULL, NULL, NULL, '45000', 'gatraigiuong.jpg', 11),
(75, 'Ruột gối', NULL, NULL, NULL, '125000', 'ruotgoi.jpg', 11),
(76, 'Ruột gối', NULL, NULL, NULL, '135000', 'ruotgoi.jpg', 16),
(77, 'Rèm', NULL, NULL, NULL, '220000', 'remcaocap.jpg', 11),
(79, 'Sơ mi dài tay', NULL, NULL, NULL, '45000', '1540872359.png', 90),
(80, 'Áo sơ mi', NULL, NULL, NULL, '35000', '1540896496.png', 140),
(81, 'Quần sooc', NULL, NULL, NULL, '35,000', '1540955550.png', 141),
(82, 'Quần sooc', NULL, NULL, NULL, '45000', '1540955606.png', 149),
(83, 'Áo sơ mi', NULL, NULL, NULL, '45000', '1540955844.png', 148),
(84, 'Áo phông', NULL, NULL, NULL, '35000', '1540956191.png', 140),
(85, 'Áo phông dài tay', NULL, NULL, NULL, '38000', '1540957856.png', 140),
(86, 'Áo gile', NULL, NULL, NULL, '35000', '1540958019.png', 140),
(87, 'Áo len hè', NULL, NULL, NULL, '55000', '1540958129.png', 140),
(88, 'Áo khoác', NULL, NULL, NULL, '65000', '1540958178.png', 140),
(89, 'Áo len dày', NULL, NULL, NULL, '75000', '1540958236.png', 140),
(90, 'Áo khoác dạ ngắn', NULL, NULL, NULL, '75000', '1540958328.png', 140),
(91, 'Áo dài loại thường', NULL, NULL, NULL, '75000', '1540958498.png', 140),
(92, 'Áo khoác dạ dài', NULL, NULL, NULL, '100000', '1540958772.png', 140),
(93, 'Áo dạ', NULL, NULL, NULL, '95000', '1540958938.png', 140),
(94, 'Áo bông', NULL, NULL, NULL, '90000', '1540958996.png', 140),
(96, 'Áo phông', NULL, NULL, NULL, '45000', '1540959402.png', 148),
(97, 'Áo phông dài tay', NULL, NULL, NULL, '48000', '1540959454.png', 148),
(98, 'Áo gile', NULL, NULL, NULL, '45000', '1540959567.png', 148),
(99, 'Áo len hè', NULL, NULL, NULL, '65000', '1540959603.png', 148),
(100, 'Áo khoác', NULL, NULL, NULL, '75000', '1540959669.png', 148),
(101, 'Áo len dày', NULL, NULL, NULL, '85000', '1540959739.png', 148),
(102, 'Áo khoác dạ ngắn', NULL, NULL, NULL, '85000', '1540959827.png', 148),
(103, 'Áo dài loại thường', NULL, NULL, NULL, '85000', '1540959877.png', 148),
(104, 'Áo dài tơ tằm', NULL, NULL, NULL, '120000', '1540959913.png', 148),
(105, 'Áo khoác dạ dài', NULL, NULL, NULL, '110000', '1540959979.png', 148),
(106, 'Áo lông vũ dài', NULL, NULL, NULL, '200000', '1540960038.png', 148),
(107, 'Áo lông vũ ngắn', NULL, NULL, NULL, '150000', '1540960072.png', 148),
(108, 'Áo dạ', NULL, NULL, NULL, '105000', '1540960149.png', 148),
(109, 'Áo bông', NULL, NULL, NULL, '100000', '1540960216.png', 148),
(110, 'Áo da', NULL, NULL, NULL, '500000', '1540960268.png', 148),
(111, 'Áo khoác 2 lớp', NULL, NULL, NULL, '125000', '1540960308.png', 148),
(112, 'Quần âu (nam,nữ)', NULL, NULL, NULL, '45000', '1540960784.png', 141),
(113, 'Quần jeans (nam,nữ)', NULL, NULL, NULL, '45000', '1540960932.png', 141),
(114, 'Quần âu (nam,nữ)', NULL, NULL, NULL, '55000', '1540961024.png', 149),
(115, 'Quần jeans (nam,nữ)', NULL, NULL, NULL, '55000', '1540961055.png', 149),
(116, 'Bộ pyjama thường', NULL, NULL, NULL, '45000', '1540961375.png', 141),
(117, 'Bộ thể thao thường', NULL, NULL, NULL, '65000', '1540961463.png', 141),
(118, 'Bộ pyjama thường', NULL, NULL, NULL, '55000', '1540961579.png', 149),
(119, 'Bộ pyjama cao cấp', NULL, NULL, NULL, '95000', '1540961626.png', 149),
(120, 'Bộ thể thao thường', NULL, NULL, NULL, '75000', '1540961672.png', 149),
(121, 'Hanbok (2 chiếc)', NULL, NULL, NULL, '85000', '1540961761.png', 149),
(122, 'Hanbok (3 chiếc)', NULL, NULL, NULL, '95000', '1540961828.png', 149),
(123, 'Bộ Vest (2 chiếc)', NULL, NULL, NULL, '95000', '1540961908.png', 149),
(124, 'Bộ Vest (3 chiếc)', NULL, NULL, NULL, '125000', '1540961966.png', 149),
(125, 'Chân váy ngắn', NULL, NULL, NULL, '45000', '1540962284.png', 145),
(126, 'Chân váy dài', NULL, NULL, NULL, '55000', '1540962453.png', 145),
(127, 'Váy liền thân dài', NULL, NULL, NULL, '90000', '1540970124.png', 145),
(128, 'Váy liền thân ngắn', NULL, NULL, NULL, '65000', '1540970179.png', 145),
(129, 'Chân váy dài', NULL, NULL, NULL, '65000', '1540970777.png', 150),
(130, 'Chân váy ngắn', NULL, NULL, NULL, '55000', '1540970807.png', 150),
(131, 'Váy liền thân ngắn', NULL, NULL, NULL, '75000', '1540970854.png', 150),
(132, 'Váy liền thân dài', NULL, NULL, NULL, '100000', '1540970888.png', 150),
(133, 'Váy cưới, dạ hội', NULL, NULL, NULL, '150000', '1540970958.png', 150),
(134, 'Cà vạt', NULL, NULL, NULL, '21000', '1540971129.png', 151),
(135, 'Khăn quàng cổ loại nhỏ', NULL, NULL, NULL, '33000', '1540971245.png', 151),
(136, 'Khăn quàng cổ loại to', NULL, NULL, NULL, '43000', '1540971287.png', 151),
(137, 'Giầy thể thao', NULL, NULL, NULL, '80000', '1540971350.png', 151),
(138, 'Ruột gối', NULL, NULL, NULL, '135000', '1540971478.png', 152),
(139, 'Khăn tay', NULL, NULL, NULL, '10000', '1540971544.png', 146),
(140, 'Tất', NULL, NULL, NULL, '10000', '1540971589.png', 146),
(141, 'Quần lót', NULL, NULL, NULL, '10000', '1540971629.png', 146),
(142, 'Găng tay', NULL, NULL, NULL, '20000', '1540971671.png', 146),
(143, 'Áo lót', NULL, NULL, NULL, '20000', '1540971756.png', 146),
(144, 'Vỏ gối', NULL, NULL, NULL, '20000', '1540971806.png', 147),
(145, 'Giầy thể thao', NULL, NULL, NULL, '75000', '1540971856.png', 146),
(146, 'Khăn tắm', NULL, NULL, NULL, '20000', '1540971896.png', 147),
(147, 'Chăn hè', NULL, NULL, NULL, '120000', '1540971947.png', 147),
(148, 'Chăn len', NULL, NULL, NULL, '145000', '1540972003.png', 147),
(149, 'Chăn đông', NULL, NULL, NULL, '155000', '1540972040.png', 147),
(150, 'Vỏ chăn', NULL, NULL, NULL, '75000', '1540972203.png', 147),
(151, 'Ga giường to', NULL, NULL, NULL, '45000', '1540972297.png', 147),
(152, 'Ruột gối', NULL, NULL, NULL, '125000', '1540972339.png', 147),
(153, 'Rèm cửa', NULL, NULL, NULL, '220000', '1540972369.png', 147),
(154, 'Vệ sinh máy 9-12BTU (bộ)', NULL, NULL, NULL, '80000', '1541478644.png', 159),
(155, 'Vệ sinh máy 18-24BTU (bộ)', NULL, NULL, NULL, '100000', '1541478672.png', 159),
(156, 'Nạp gas R22 (Đơn giá/Psi)', NULL, NULL, NULL, '6000', '1541478870.png', 159),
(157, 'Nạp gas R410, R32 (Đơn giá/Psi)', NULL, NULL, NULL, '14000', '1541478928.png', 159),
(158, 'Điều hòa cục bộ', NULL, NULL, NULL, '250000', '1541479314.png', 162),
(159, 'Mặt lạnh ĐH Multi âm trần', NULL, NULL, NULL, '500000', '1541479225.png', 162),
(160, 'Mặt lạnh ĐH trung tâm', NULL, NULL, NULL, '350000', '1541479502.png', 162),
(161, 'Vệ sinh máy ĐH cục bộ', NULL, NULL, NULL, '200000', '1541478823.png', 159),
(162, 'Kiểm tra lỗi ĐH cục bộ', NULL, NULL, NULL, '80000', '1541478247.png', 160),
(163, 'Thay tụ ĐH cục bộ', NULL, NULL, NULL, '150000', '1541478336.png', 160),
(164, 'Hàn ống bị hở (Đơn giá/mối hàn)', NULL, NULL, NULL, '100000', '1541478391.png', 160),
(165, 'Kiểm tra lỗi ĐH Multi âm trần', NULL, NULL, NULL, '200000', '1541478450.png', 160),
(166, 'Kiểm tra lỗi ĐH trung tâm', NULL, NULL, NULL, '200000', '1541478524.png', 160),
(168, 'Ống máy 9BTU', NULL, NULL, NULL, '140000', '1541472740.png', 161),
(169, 'Ống máy 12BTU', NULL, NULL, NULL, '160000', '1541472811.png', 161),
(170, 'Ống máy 18-24BTU', NULL, NULL, NULL, '180000', '1541472875.png', 161),
(171, 'Ống Tủ Đứng 18BTU', NULL, NULL, NULL, '250000', '1541473030.png', 161),
(172, 'Dây điện máy 9-12BTU (ĐG/m)', NULL, NULL, NULL, '15000', '1541473878.png', 161),
(173, 'Dây điện máy 18-24BTU (ĐG/m)', NULL, NULL, NULL, '20000', '1541473920.png', 161),
(174, 'Dây điện máy 18BTU Đứng', NULL, NULL, NULL, '300000', '1541476603.png', 161),
(175, 'Ống thoát nước mềm (ĐG/m)', NULL, NULL, NULL, '8000', '1541476718.png', 161),
(176, 'Vải bọc ống bảo ôn (ĐG/m)', NULL, NULL, NULL, '10000', '1541476894.png', 161),
(177, 'Băng dính (ĐG/cuộn)', NULL, NULL, NULL, '10000', '1541476956.png', 161),
(178, 'Ốc bắt chân máy (ĐG/bộ)', NULL, NULL, NULL, '30000', '1541477052.png', 161),
(179, 'Tụ ĐH 25-35µ (ĐG/cái)', NULL, NULL, NULL, '380000', '1541478089.png', 161),
(180, 'Tụ ĐH 45-50µ (ĐG/cái)', NULL, NULL, NULL, '450000', '1541478122.png', 161),
(181, 'Attomat 15-30A (ĐG/cái)', NULL, NULL, NULL, '70000', '1541477679.png', 161),
(182, 'Giá đỡ cục nóng máy 9BTU', NULL, NULL, NULL, '90000', '1541477284.png', 161),
(183, 'Giá đỡ cục nóng máy 12BTU', NULL, NULL, NULL, '120000', '1541477297.png', 161),
(184, 'Giá đỡ cục nóng máy 18-24BTU', NULL, NULL, NULL, '200000', '1541477312.png', 161),
(185, 'Nạp gas R22 ĐH cục bộ (Đơn giá/Psi)', NULL, NULL, NULL, '150000', '1541479021.png', 159),
(186, 'Diện tích <= 100m2 (ĐG/m2)', NULL, NULL, NULL, '15000', '1540981177.png', 165),
(187, 'Diện tích <= 200m2 (ĐG/m2)', NULL, NULL, NULL, '10000', '1540981188.png', 165),
(188, 'Diện tích > 200m2 (ĐG/m2)', NULL, NULL, NULL, '8000', '1540981196.png', 165),
(192, 'Bộ Sofa loại lớn (ĐG/bộ)', NULL, NULL, NULL, '600000', '1540981658.png', 167),
(193, 'Bộ Sofa loại nhỏ (ĐG/bộ)', NULL, NULL, NULL, '400000', '1540981674.png', 167),
(194, 'Diện tích <= 5m2 (ĐG/tấm)', NULL, NULL, NULL, '600000', '1540981800.png', 169),
(195, 'Diện tích > 5m2 (ĐG/tấm)', NULL, NULL, NULL, '800000', '1540981811.png', 169),
(196, 'Diện tích <= 100m2 (ĐG/m2)', NULL, NULL, NULL, '10000', '1540979149.png', 173),
(197, 'Diện tích <= 300m2 (ĐG/m2)', NULL, NULL, NULL, '8000', '1540979175.png', 173),
(198, 'Diện tích > 300m2 (ĐG/m2)', NULL, NULL, NULL, '5000', '1540979248.png', 173),
(199, 'Diện tích <= 100m2 (ĐG/m2)', NULL, NULL, NULL, '10000', '1540979330.png', 170),
(200, 'Diện tích <= 300m2 (ĐG/m2)', NULL, NULL, NULL, '8000', '1540979370.png', 170),
(201, 'Diện tích > 300m2 (ĐG/m2)', NULL, NULL, NULL, '6000', '1540979398.png', 170),
(202, 'Nhà thấp tầng (ĐG/m2)', NULL, NULL, NULL, '10000', '1540979505.png', 171),
(203, 'Nhà cao tầng (ĐG/m2)', NULL, NULL, NULL, '15000', '1540979548.png', 171),
(204, 'Phủ bóng sàn gỗ (ĐG/m2)', NULL, NULL, NULL, '30000', '1540979644.png', 172),
(205, 'Đánh bóng sàn gỗ (ĐG/m2)', NULL, NULL, NULL, '50000', '1540979674.png', 172),
(206, 'Diện tích <= 5m2 (ĐG/tấm)', NULL, NULL, NULL, '600000', '1540980268.png', 178),
(207, 'Diện tích > 5m2 (ĐG/tấm)', NULL, NULL, NULL, '800000', '1540980296.png', 178),
(208, 'Bộ Sofa loại lớn (ĐG/bộ)', NULL, NULL, NULL, '600000', '1540980374.png', 176),
(209, 'Bộ Sofa loại nhỏ (ĐG/bộ)', NULL, NULL, NULL, '400000', '1540980398.png', 176),
(210, 'Ghế bàn ăn', NULL, NULL, NULL, '50000', '1540980462.png', 177),
(211, 'Diện tích <= 100m2 (ĐG/m2)', NULL, NULL, NULL, '10000', '1540980510.png', 179),
(212, 'Diện tích <= 300m2 (ĐG/m2)', NULL, NULL, NULL, '8000', '1540980538.png', 179),
(213, 'Diện tích > 300m2 (ĐG/m2)', NULL, NULL, NULL, '6000', '1540980564.png', 179),
(214, 'Nhà thấp tầng (ĐG/m2)', NULL, NULL, NULL, '10000', '1540980655.png', 180),
(215, 'Nhà cao tầng (ĐG/m2)', NULL, NULL, NULL, '15000', '1540980674.png', 180),
(216, 'Phủ bóng sàn gỗ (ĐG/m2)', NULL, NULL, NULL, '30000', '1540980736.png', 181),
(217, 'Đánh bóng sàn gỗ (ĐG/m2)', NULL, NULL, NULL, '50000', '1540980760.png', 181),
(218, 'Diện tích <= 100m2 (ĐG/m2)', NULL, NULL, NULL, '10000', '1540980807.png', 182),
(219, 'Diện tích <= 300m2 (ĐG/m2)', NULL, NULL, NULL, '8000', '1540980824.png', 182),
(220, 'Diện tích > 300m2 (ĐG/m2)', NULL, NULL, NULL, '5000', '1540980832.png', 182),
(221, 'Diện tích <= 50m2 (ĐG/m2)', NULL, NULL, NULL, '25000', '1540980906.png', 183),
(222, 'Diện tích <= 100m2 (ĐG/m2)', NULL, NULL, NULL, '20000', '1540980934.png', 183),
(223, 'Diện tích > 100m2 (ĐG/m2)', NULL, NULL, NULL, '15000', '1540980964.png', 183),
(224, 'Kiểm tra lỗi', NULL, NULL, NULL, '50000', '1540982329.png', 187),
(225, 'Hạng mục thi công dưới 3 tiếng', NULL, NULL, NULL, '150000', '1540982367.png', 188),
(226, 'Hạng mục thi công trên 3 tiếng', NULL, NULL, NULL, '300000', '1540982412.png', 189),
(227, 'Thuê giúp việc <= 3 tiếng (ĐG/giờ)', NULL, NULL, NULL, '100000', '1540982894.png', 190),
(228, 'Thuê giúp việc 3-5 tiếng (ĐG/giờ)', NULL, NULL, NULL, '80000', '1540982957.png', 191),
(229, 'Thuê giúp việc 5-8 tiếng', NULL, NULL, NULL, '70000', '1540982981.png', 192),
(233, 'Dưới 3 tiếng / ngày', NULL, NULL, NULL, '100000', '1541048252.png', 201),
(234, 'Từ 3 tiếng đến 5 tiếng / ngày', NULL, NULL, NULL, '80000', '1541048614.png', 201),
(235, 'Từ 5 tiếng đến 8 tiếng / ngày', NULL, NULL, NULL, '70000', '1541048781.png', 201),
(236, 'Dưới 3 tiếng / ngày', NULL, NULL, NULL, '100000', '1541049206.png', 202),
(237, 'Từ 3 tiếng đến 5 tiếng / ngày', NULL, NULL, NULL, '80000', '1541049240.png', 202),
(238, 'Từ 5 tiếng đến 8 tiếng / ngày', NULL, NULL, NULL, '70000', '1541049302.png', 202),
(239, '8am - 5pm / 1 người', NULL, NULL, NULL, '500000', '1541049598.png', 203),
(240, '8am - 5pm / 2 người', NULL, NULL, NULL, '900000', '1541049671.png', 203),
(241, '>= 4 ngày / tháng', NULL, NULL, NULL, '1800000', '1541049718.png', 203),
(242, '>= 8 ngày / tháng', NULL, NULL, NULL, '3400000', '1541050101.png', 203),
(243, '8am - 5pm / 1 người', NULL, NULL, NULL, '500000', '1541050292.png', 204),
(244, '8am - 5pm / 2 người', NULL, NULL, NULL, '900000', '1541050346.png', 204),
(245, 'Combo 4 người/ngày', NULL, NULL, NULL, '1800000', '1541475507.png', 204),
(246, '>=4 người/ngày (Đơn giá/người)', NULL, NULL, NULL, '450000', '1541050473.png', 204),
(247, '<=100 mét vuông', NULL, NULL, NULL, '15000', '1541052562.png', 206),
(248, '<=200 mét vuông', NULL, NULL, NULL, '10000', '1541052613.png', 206),
(249, '> 200 mét vuông', NULL, NULL, NULL, '8000', '1541052665.png', 206),
(250, '<=50 chiếc ghế', NULL, NULL, NULL, '20000', '1541053261.png', 207),
(251, '<=150 chiếc ghế', NULL, NULL, NULL, '15000', '1541053314.png', 207),
(252, '>150 chiếc ghế', NULL, NULL, NULL, '10000', '1541053357.png', 207),
(253, 'Bộ Sofa nhỏ', NULL, NULL, NULL, '400000', '1541055166.png', 208),
(254, 'Bộ Sofa lớn', NULL, NULL, NULL, '600000', '1541055222.png', 208),
(255, 'Ghế bàn ăn', NULL, NULL, NULL, '50000', '1541055391.png', 209),
(256, 'Thảm <= 5 mét vuông', NULL, NULL, NULL, '600000', '1541055972.png', 210),
(257, 'Thảm > 5 mét vuông', NULL, NULL, NULL, '800000', '1541056047.png', 210),
(258, '<= 50 mét vuông', NULL, NULL, NULL, '25000', '1541056649.png', 211),
(259, '<=100 mét vuông', NULL, NULL, NULL, '20000', '1541056717.png', 211),
(260, '>100 mét vuông', NULL, NULL, NULL, '15000', '1541056754.png', 211),
(261, '<= 50 mét vuông', NULL, NULL, NULL, '25000', '1541057732.png', 212),
(262, '<=100 mét vuông', NULL, NULL, NULL, '20000', '1541057785.png', 212),
(263, '>100 mét vuông', NULL, NULL, NULL, '15000', '1541057820.png', 212),
(264, '<= 50 mét vuông', NULL, NULL, NULL, '25000', '1541066201.png', 213),
(265, '<=100 mét vuông', NULL, NULL, NULL, '20000', '1541066234.png', 213),
(266, '>100 mét vuông', NULL, NULL, NULL, '15000', '1541066272.png', 213),
(267, '<=100 mét vuông', NULL, NULL, NULL, '10000', '1541066487.png', 214),
(268, '<=300 mét vuông', NULL, NULL, NULL, '8000', '1541066961.png', 214),
(269, '>300 mét vuông', NULL, NULL, NULL, '5000', '1541067034.png', 214),
(270, '<=100 mét vuông', NULL, NULL, NULL, '10000', '1541067252.png', 215),
(271, '<=300 mét vuông', NULL, NULL, NULL, '8000', '1541067285.png', 215),
(272, '>300 mét vuông', NULL, NULL, NULL, '6000', '1541067320.png', 215),
(273, 'Nhà thấp tầng', NULL, NULL, NULL, '10000', '1541067616.png', 216),
(274, 'Nhà cao tầng', NULL, NULL, NULL, '15000', '1541067743.png', 216),
(275, 'Phủ bóng sàn gỗ', NULL, NULL, NULL, '30000', '1541067911.png', 217),
(276, 'Đánh bóng sàn gỗ', NULL, NULL, NULL, '50000', '1541067984.png', 217);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `key` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `content_en` text COLLATE utf8_unicode_ci,
  `content_ja` text COLLATE utf8_unicode_ci,
  `content_ko` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `key`, `content`, `content_en`, `content_ja`, `content_ko`) VALUES
(1, 'whyUse', '<p>HSP cam kết mang lại các giá trị tuyệt vời nhất, nâng tầm chất lượng cuộc sống.</p><p>Với HSP, khách hàng sẽ được trải nghiệm dịch vụ với các tiêu chí hàng đầu:</p><ol><li>Chế độ bảo hành cam kết lâu dài</li><li>An tâm về lý lịch của nhân viên dịch vụ</li><li>Nhân viên dịch vụ chu đáo, tận tâm</li><li>Giá dịch vụ niêm yết rõ ràng</li><li>Nhanh chóng, tiện lợi</li></ol><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, NULL, NULL),
(2, 'bestPractices', '<p>Để trải nghiệm và được phục vụ tốt nhất, xin quý khách hàng vui lòng:</p><ol><li>Tải và sử dụng phiên bản mới nhất của ứng dụng</li><li>Đọc kỹ điều khoản sử dụng quy định đối với từng dịch vụ</li><li>Kiểm tra phần tin tức để nhận thông tin về mã khuyến mại</li><li>Chia sẻ mã giới thiệu của mình cho bạn bè để nhận tiền trực tiếp vào tài khoản</li><li>Trải nghiệm và phản hồi đến bộ phận hỗ trợ khi có vấn đề phát sinh hoặc cần hỗ trợ</li></ol><p>Chúng tôi luôn lắng nghe để phục vụ tốt hơn.</p><p>&nbsp;</p><p>&nbsp;</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, NULL, NULL),
(3, 'faqs', '<p>Hỏi / Đáp</p><p>&nbsp;</p><p>&nbsp;</p>', NULL, NULL, NULL),
(4, 'legal', '<p>Điều khoản sử dụng:</p><ol><li>Dịch vụ giặt là</li><li>Dịch vụ giúp việc nhà</li><li>Dịch vụ sửa chữa</li><li>Dịch vụ điều hòa</li></ol><p>&nbsp;</p>', NULL, NULL, NULL),
(5, 'about', '<p>HSP cam kết mang lại các giá trị tuyệt vời nhất, nâng tầm chất lượng cuộc sống.</p><p>Với HSP, khách hàng sẽ được trải nghiệm dịch vụ với các tiêu chí hàng đầu:</p><ol><li>Nhanh chóng, tiện lợi</li><li>Giá dịch vụ niêm yết rõ ràng</li><li>Nhân viên dịch vụ chu đáo, tận tâm</li><li>An tâm về lý lịch của nhân viên dịch vụ</li><li>Chế độ bảo hành cam kết lâu dài</li></ol><p>&nbsp;</p><p>&nbsp;</p>', NULL, NULL, NULL),
(6, 'contact', '<p>HSP cam kết mang lại các giá trị tuyệt vời nhất, nâng tầm chất lượng cuộc sống.</p><p>Với HSP, khách hàng sẽ được trải nghiệm dịch vụ với các tiêu chí hàng đầu:</p><ol><li>Nhanh chóng, tiện lợi</li><li>Giá dịch vụ niêm yết rõ ràng</li><li>Nhân viên dịch vụ chu đáo, tận tâm</li><li>An tâm về lý lịch của nhân viên dịch vụ</li><li>Chế độ bảo hành cam kết lâu dài</li></ol><p>&nbsp;</p>', NULL, NULL, NULL),
(7, 'coupon', 'coupon20-10', NULL, NULL, NULL),
(8, 'rewards', '<p>Nhập mã khuyến mại để hưởng 10% chiết khấu trên tổng hóa đơn dịch vụ. Còn chần chờ gì nữa, dùng HSP ngay thôi.</p><p>&nbsp;</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, NULL, NULL),
(9, 'invite', '<p><strong>"Chia sẻ ngay, nhận tiền mặt liền tay"</strong></p><p>Chia sẻ HSP đến người thân, bạn bè và nhắc họ nhập mã giới thiệu của bạn vào phần thông tin. Với mỗi giao dịch thực hiện thành công từ tài khoản được giới thiệu, bạn sẽ được cộng ngay 10.000 VNĐ vào tài khoản. Thỏa sức sử dụng dịch vụ, hoặc quy đổi tiền mặt khi đạt mức 500.000 VNĐ. Chúng tôi luôn cố gắng đem lại những giá trị tốt nhất cho bạn mỗi ngày.</p><p>&nbsp;</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, NULL, NULL),
(10, 'warranties', '<p>Sau khi nhân viên HSP thực hiện hoàn tất dịch vụ, xin phiền Quý khách chụp ảnh hóa đơn thực tế từ tính năng chụp hình trong giao diện "Việc đã đăng" để nhận được quyền lợi chăm sóc và bảo hành từ HSP Việt Nam (Bỏ qua nếu không phát sinh chi phí so với hóa đơn dịch vụ ban đầu). Xin chân thành cám ơn Quý khách đã sử dụng dịch vụ của chúng tôi.</p><p>&nbsp;</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, NULL, NULL),
(11, 'report', '<p>HSP cam kết mang lại các giá trị tuyệt vời nhất, nâng tầm chất lượng cuộc sống.</p><p>Với HSP, khách hàng sẽ được trải nghiệm dịch vụ với các tiêu chí hàng đầu:</p><ol><li>Nhanh chóng, tiện lợi</li><li>Giá dịch vụ niêm yết rõ ràng</li><li>Nhân viên dịch vụ chu đáo, tận tâm</li><li>An tâm về lý lịch của nhân viên dịch vụ</li><li>Chế độ bảo hành cam kết lâu dài</li></ol><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ja` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ko` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `index` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `icon`, `name`, `name_en`, `name_ja`, `name_ko`, `parent_id`, `index`, `active`) VALUES
(1, 'giatui.png', 'Giặt ủi', 'Washing', 'ランドリー', '세탁', 0, 0, 1),
(2, 'giupviecnha.png', 'Giúp việc nhà', '', '', '', 0, 0, 1),
(3, 'donvesinh.png', 'Vệ sinh công nghiệp', '', '', '', 0, 0, 1),
(4, 'dicho.png', 'Đi chợ thuê', '', '', '', 0, 0, 0),
(5, 'giatla.png', 'Áo', '', '', '', 5, 0, 1),
(33, 'dieuhoaIcon.png', 'Điều hòa', '', '', '', 0, 0, 1),
(34, 'suachuaIcon.png', 'Sửa chữa dân dụng', '', '', '', 0, 0, 0),
(35, 'vanchuyeIcon.png', 'Vận chuyển', '', '', '', 0, 0, 0),
(138, NULL, 'Giặt là', '', '', '', 1, 0, 1),
(139, NULL, 'Giặt khô', '', '', '', 1, 0, 1),
(140, NULL, 'Áo', '', '', '', 138, 0, 1),
(141, NULL, 'Quần-Đồ bộ', '', '', '', 138, 1, 1),
(145, NULL, 'Váy', '', '', '', 138, 2, 1),
(146, NULL, 'Phụ kiện', '', '', '', 138, 3, 1),
(147, NULL, 'Chăn ga', '', '', '', 138, 4, 1),
(148, NULL, 'Áo', '', '', '', 139, 5, 1),
(149, NULL, 'Quần-Đồ bộ', '', '', '', 139, 6, 1),
(150, NULL, 'Váy', '', '', '', 139, 7, 1),
(151, NULL, 'Phụ kiện', '', '', '', 139, 8, 1),
(152, NULL, 'Chăn ga', '', '', '', 139, 9, 1),
(154, NULL, 'Báo giá trọn gói', '', '', '', 33, 0, 0),
(155, NULL, 'Báo giá thực tế', '', '', '', 33, 0, 1),
(156, NULL, 'Bảo dưỡng', '', '', '', 154, 1, 1),
(157, NULL, 'Sửa chữa', '', '', '', 154, 2, 1),
(158, NULL, 'Vật tư', '', '', '', 154, 3, 1),
(159, NULL, 'Bảo dưỡng', '', '', '', 155, 5, 1),
(160, NULL, 'Sửa chữa', '', '', '', 155, 6, 1),
(161, NULL, 'Vật tư', '', '', '', 155, 7, 1),
(162, NULL, 'Lắp đặt', '', '', '', 155, 4, 1),
(163, NULL, 'Lắp đặt', '', '', '', 154, 0, 1),
(164, NULL, 'Văn phòng, tòa nhà', '', '', '', 3, 0, 1),
(174, NULL, 'Nhà dân dụng', '', '', '', 3, 0, 1),
(184, NULL, 'Sửa chữa', '', '', '', 34, 0, 1),
(186, NULL, 'Vật tư', '', '', '', 34, 0, 1),
(187, NULL, 'Kiểm tra lỗi', '', '', '', 184, 0, 1),
(188, NULL, 'Hạng mục thi công dưới 3 tiếng', '', '', '', 184, 1, 1),
(189, NULL, 'Hạng mục thi công trên 3 tiếng', '', '', '', 184, 2, 1),
(190, NULL, 'Thuê giúp việc <= 3 tiếng', '', '', '', 143, 0, 1),
(191, NULL, 'Thuê giúp việc 3-5 tiếng', '', '', '', 143, 1, 1),
(192, NULL, 'Thuê giúp việc 5-8 tiếng', '', '', '', 143, 2, 1),
(193, NULL, 'Gói cố định 1 buổi / tuần', '', '', '', 144, 3, 1),
(194, NULL, 'Gói cố định 3 buổi / tuần', '', '', '', 144, 4, 1),
(195, NULL, 'Gói cố định > 3 buổi / tuần', '', '', '', 144, 5, 1),
(196, NULL, 'Gói cố định 10 buổi / tháng', '', '', '', 153, 6, 1),
(197, NULL, 'Gói cố định > 10 buổi / tháng', '', '', '', 153, 7, 1),
(198, NULL, 'Giúp việc theo giờ', '', '', '', 2, 0, 1),
(199, NULL, 'Chọn gói combo', '', '', '', 2, 0, 1),
(201, NULL, 'Giúp việc gia đình', '', '', '', 198, 0, 1),
(202, NULL, 'Giúp việc văn phòng-Cty', '', '', '', 198, 1, 1),
(203, NULL, 'Giúp việc gia đình', '', '', '', 199, 2, 1),
(204, NULL, 'Giúp việc văn phòng-Cty', '', '', '', 199, 3, 1),
(205, NULL, 'Vệ sinh cơ bản', '', '', '', 3, 0, 1),
(206, NULL, 'Giặt thảm văn phòng', '', '', '', 164, 0, 1),
(207, NULL, 'Giặt ghế da+nỉ VP', '', '', '', 164, 2, 1),
(208, NULL, 'Giặt ghế sopha da+nỉ', '', '', '', 205, 11, 1),
(209, NULL, 'Giặt ghế bàn ăn', '', '', '', 174, 4, 1),
(210, NULL, 'Giặt thảm trang trí', '', '', '', 205, 5, 1),
(211, NULL, 'Vệ sinh bàn giao nhà mới', '', '', '', 164, 1, 1),
(212, NULL, 'Vệ sinh bàn giao nhà mới', '', '', '', 174, 3, 1),
(213, NULL, 'Vệ sinh bàn giao nhà mới', '', '', '', 205, 6, 1),
(214, NULL, 'Diệt côn trùng gây hại', '', '', '', 205, 7, 1),
(215, NULL, 'Đánh sàn nhà', '', '', '', 205, 8, 1),
(216, NULL, 'Làm sạch khung nhôm kính', '', '', '', 205, 9, 1),
(217, NULL, 'Phủ đánh bóng sàn gỗ', '', '', '', 205, 10, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'rewards', '0.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `presenter_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `display_name`, `avatar`, `email`, `phone`, `address`, `city_id`, `role_id`, `active`, `presenter_id`, `code`, `coin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tran Thanh Tuan', '', '1185335863_1541752831.jpeg', 'tuantt@gmail.com', '84973619398', '', 1, 2, 1, '84973619398', '84973619398', 0, NULL, '2018-10-29 09:31:53', '2018-11-09 08:40:31'),
(2, '', '', '', '', '14084066195', '', 1, 2, 1, '1', '14084066195', 0, NULL, '2018-10-30 16:13:19', '2018-10-30 16:13:19'),
(3, 'aaaaaa', '', '633860729_1541133367.jpeg', 'aaaa@bbb.cccc', '84902270785', '', 1, 2, 1, '1', '84902270785', 0, NULL, '2018-10-30 18:40:19', '2018-11-01 21:36:07'),
(4, 'trần ba', '', '2141080275_1540950565.jpeg', 'tranba@gmail.com', '84332829123', '', 1, 2, 1, '30x89316', '84332829123', 0, NULL, '2018-10-30 18:48:20', '2018-10-31 19:24:05'),
(5, 'jfufi', '', '', 'jfjdifig@gmail.com', '84362293209', '', 1, 2, 1, '1', '84362293209', 0, NULL, '2018-10-30 23:56:19', '2018-10-31 00:03:06'),
(6, 'Đinh Xuân Hải', '', '', 'dinhxuanhai1102@gmail.com', '84978598811', '', 1, 2, 1, '84973619398', '84978598811', 0, NULL, '2018-10-31 10:44:19', '2018-10-31 19:22:09'),
(7, 'Nguyen Vu Kien', '', '', 'nvukien@gmail.com', '84945013456', '', 1, 2, 1, '84963699652', '84945013456', 0, NULL, '2018-10-31 19:13:54', '2018-11-05 01:19:05'),
(8, '', '', '', '', '', '', 1, 2, 1, '1', '', 0, NULL, '2018-10-31 20:06:46', '2018-10-31 20:06:46'),
(9, '', '', '', '', '84396616967', '', 1, 2, 1, '1', '84396616967', 0, NULL, '2018-11-01 20:24:25', '2018-11-01 20:24:25'),
(10, '', '', '', '', '84978671974', '', 1, 2, 1, '1', '84978671974', 0, NULL, '2018-11-02 00:34:25', '2018-11-02 00:34:25'),
(11, '', '', '', '', '841662293209', '', 1, 2, 1, '1', '841662293209', 0, NULL, '2018-11-02 10:26:02', '2018-11-02 10:26:02'),
(12, 'dinh xuân hải', '', '', 'haidx.hsp@gmail.com', '84963699652', '', 1, 2, 1, '84978598811', '84963699652', 0, NULL, '2018-11-04 22:56:58', '2018-11-04 23:03:52'),
(13, '', '', '', '', '14084766514', '', 1, 2, 1, '1', '14084766514', 0, NULL, '2018-11-05 15:16:10', '2018-11-05 15:16:10'),
(14, '', '', '', '', '84352548283', '', 1, 2, 1, '1', '84352548283', 0, NULL, '2018-11-05 15:52:33', '2018-11-05 15:52:33'),
(15, '', '', '', '', '84902095833', '', 1, 2, 1, '1', '84902095833', 0, NULL, '2018-11-06 05:40:47', '2018-11-06 05:40:47'),
(16, '', '', '', '', '84949946663', '', 1, 2, 1, '1', '84949105777', 0, NULL, '2018-11-06 10:58:20', '2018-11-06 10:58:20'),
(17, '', '', '', '', '84962907140', '', 1, 2, 1, '1', '84962907140', 0, NULL, '2018-11-07 00:10:42', '2018-11-07 00:10:42'),
(18, '', '', '', '', '84983148686', '', 1, 2, 1, '1', '84983148686', 0, NULL, '2018-11-07 03:58:57', '2018-11-07 03:58:57'),
(19, '', '', '', '', '84936882102', '', 1, 2, 1, '1', '84936993213', 0, NULL, '2018-11-08 01:42:55', '2018-11-08 01:42:55'),
(20, '', '', '', '', '84977129154', '', 1, 2, 1, '1', '84977129154', 0, NULL, '2018-11-08 12:35:38', '2018-11-08 12:35:38'),
(21, '', '', '', '', '84934628591', '', 1, 2, 1, '1', '84934739702', 0, NULL, '2018-11-08 14:58:00', '2018-11-08 14:58:00'),
(22, '', '', '', '', '84943658805', '', 1, 2, 1, '1', '84943658805', 0, NULL, '2018-11-09 05:44:00', '2018-11-09 05:44:00'),
(23, 'Nguyễn Phi long', '', '', 'hungy61@gmail.com', '84398696981', '', 1, 2, 1, '1', '84398696981', 0, NULL, '2018-11-10 15:44:56', '2018-11-10 15:46:06'),
(25, '', '', '', '', '84794152099', '', 1, 2, 1, '1', '84794263210', 0, NULL, '2018-11-12 08:24:53', '2018-11-12 08:24:53'),
(26, '', '', '', '', '84393222964', '', 1, 2, 1, '1', '84393222964', 0, NULL, '2018-11-12 10:35:34', '2018-11-12 10:35:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `weekly_report`
--

CREATE TABLE `weekly_report` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `rewards` int(11) NOT NULL DEFAULT '0',
  `promotional` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `weekly_report`
--

INSERT INTO `weekly_report` (`id`, `name`, `total`, `rewards`, `promotional`, `created_at`, `updated_at`) VALUES
(1, '2018-46', 335000, 0, 7000, '2018-11-14 02:19:05', '2018-11-14 03:01:36');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `daily_report`
--
ALTER TABLE `daily_report`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `monthly_report`
--
ALTER TABLE `monthly_report`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Chỉ mục cho bảng `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Chỉ mục cho bảng `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Chỉ mục cho bảng `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Chỉ mục cho bảng `weekly_report`
--
ALTER TABLE `weekly_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `daily_report`
--
ALTER TABLE `daily_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT cho bảng `monthly_report`
--
ALTER TABLE `monthly_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT cho bảng `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;
--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;
--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT cho bảng `weekly_report`
--
ALTER TABLE `weekly_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
