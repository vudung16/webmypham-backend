-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 05, 2021 lúc 01:32 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webmp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cosmetics_brand`
--

CREATE TABLE `cosmetics_brand` (
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cosmetics_brand`
--

INSERT INTO `cosmetics_brand` (`brand_id`, `brand_name`, `created_at`, `updated_at`) VALUES
(1, 'cocoon', '2021-04-24 00:12:52', '2021-04-24 00:12:52'),
(2, 'vacosi', '2021-04-24 00:12:58', '2021-04-24 00:12:58'),
(3, 'Biodema', '2021-04-24 00:13:04', '2021-04-24 00:13:04'),
(4, 'vichy', '2021-04-24 00:13:10', '2021-04-24 00:13:10'),
(5, 'avene', '2021-04-24 00:13:16', '2021-04-24 00:13:16'),
(6, 'playboy', '2021-04-24 00:13:23', '2021-04-24 00:13:23'),
(7, 'Mạnh Dũng', '2021-05-04 18:39:24', '2021-05-04 18:39:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cosmetics_category`
--

CREATE TABLE `cosmetics_category` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cosmetics_category`
--

INSERT INTO `cosmetics_category` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Trang điểm', '2021-04-24 00:12:10', '2021-04-28 09:48:27'),
(2, 'Chăm sóc da', '2021-04-24 00:12:16', '2021-04-24 00:12:16'),
(3, 'Chăm sóc tóc', '2021-04-24 00:12:21', '2021-04-24 00:12:21'),
(4, 'Phụ kiện', '2021-04-24 00:12:28', '2021-04-24 00:12:28'),
(5, 'Nước hoa', '2021-04-24 00:12:34', '2021-04-24 00:12:34'),
(6, 'Chăm sóc toàn thân', '2021-04-24 00:12:40', '2021-04-24 00:12:40'),
(11, 'Làm đẹp', '2021-05-04 09:16:46', '2021-05-04 09:16:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cosmetics_order`
--

CREATE TABLE `cosmetics_order` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_time` date DEFAULT NULL,
  `order_total_money` double DEFAULT NULL,
  `profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cosmetics_order`
--

INSERT INTO `cosmetics_order` (`order_id`, `user_id`, `order_time`, `order_total_money`, `profile_id`, `action`, `created_at`, `updated_at`) VALUES
(35, 3, '2021-05-02', 460000, 2, 2, '2021-05-01 10:03:25', '2021-05-02 06:29:22'),
(37, 1, '2021-05-02', 340000, 1, 2, '2021-05-02 06:31:27', '2021-05-02 07:11:13'),
(38, 3, '2021-05-02', 130000, 2, 2, '2021-05-02 06:32:55', '2021-05-02 07:07:41'),
(39, 1, '2021-05-02', 20000, 1, 2, '2021-05-02 06:35:49', '2021-05-02 08:39:05'),
(40, 1, '2021-05-03', 200000, 1, 2, '2021-05-02 07:00:51', '2021-05-03 09:33:31'),
(41, 1, '2021-05-03', 130000, 1, 2, '2021-05-03 09:35:29', '2021-05-03 09:48:45'),
(42, 1, '2021-05-03', 300000, 1, 2, '2021-05-03 09:49:44', '2021-05-04 02:22:01'),
(43, 1, '2021-05-03', 30000, 1, 2, '2021-05-03 09:51:20', '2021-05-04 02:22:08'),
(45, 3, NULL, NULL, 2, NULL, '2021-05-03 21:19:17', '2021-05-03 21:19:17'),
(47, 1, NULL, NULL, 1, NULL, '2021-05-05 03:52:44', '2021-05-05 03:52:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cosmetics_order_detail`
--

CREATE TABLE `cosmetics_order_detail` (
  `order_detail_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `detail_amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cosmetics_order_detail`
--

INSERT INTO `cosmetics_order_detail` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `detail_amount`, `created_at`, `updated_at`) VALUES
(150, 35, 1, 4, 320000, '2021-05-01 19:33:25', '2021-05-01 21:28:11'),
(155, 35, 2, 1, 30000, '2021-05-01 21:38:36', '2021-05-01 21:38:36'),
(161, 35, 3, 1, 100000, '2021-05-02 01:40:31', '2021-05-02 01:40:31'),
(170, 35, 4, 1, 10000, '2021-05-02 01:59:28', '2021-05-02 01:59:28'),
(171, 37, 1, 2, 200000, '2021-05-02 06:31:27', '2021-05-02 06:31:27'),
(172, 37, 2, 1, 30000, '2021-05-02 06:31:29', '2021-05-02 06:31:29'),
(173, 37, 3, 1, 100000, '2021-05-02 06:31:31', '2021-05-02 06:31:31'),
(174, 37, 4, 1, 10000, '2021-05-02 06:31:37', '2021-05-02 06:31:37'),
(176, 38, 3, 1, 100000, '2021-05-02 06:34:44', '2021-05-02 06:34:44'),
(177, 38, 2, 1, 30000, '2021-05-02 06:35:01', '2021-05-02 06:35:01'),
(179, 39, 4, 2, 20000, '2021-05-02 06:36:15', '2021-05-02 06:36:15'),
(202, 40, 1, 2, 160000, '2021-05-03 07:01:40', '2021-05-03 07:01:40'),
(203, 40, 2, 1, 30000, '2021-05-03 07:01:46', '2021-05-03 07:01:46'),
(204, 40, 4, 1, 10000, '2021-05-03 07:01:54', '2021-05-03 07:01:54'),
(205, 41, 4, 2, 20000, '2021-05-03 09:35:29', '2021-05-03 09:35:29'),
(206, 41, 1, 1, 80000, '2021-05-03 09:35:44', '2021-05-03 09:35:44'),
(207, 41, 2, 1, 30000, '2021-05-03 09:35:53', '2021-05-03 09:35:53'),
(209, 42, 3, 3, 300000, '2021-05-03 09:50:25', '2021-05-03 09:50:33'),
(210, 43, 4, 3, 30000, '2021-05-03 09:51:20', '2021-05-03 09:51:23'),
(235, 47, 6, 2, 2000002, '2021-05-05 04:27:00', '2021-05-05 04:29:41'),
(236, 47, 4, 1, 20000, '2021-05-05 04:29:35', '2021-05-05 04:29:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cosmetics_product`
--

CREATE TABLE `cosmetics_product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double NOT NULL,
  `product_discount` int(11) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cosmetics_product`
--

INSERT INTO `cosmetics_product` (`product_id`, `product_name`, `product_description`, `product_image`, `product_price`, `product_discount`, `category_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 'Bột uống đẹp da The Collagen Shiseido 126g – Mẫu 2020', '<p>aaaaaaaaaaaaa</p>', 'banner-chuong-trinh-dinh-cu-Chau-Au-Cyprus-3_1920x650_1619248621.jpg', 100000, 80000, 1, 1, '2021-04-24 00:17:01', '2021-05-04 20:05:53'),
(2, 'Kem Chống Nắng Innisfree Intensive Long-Lasting', 'bbbbbbbbbbbb', 'abc_1619248657.jpg', 50000, 30000, 2, 3, '2021-04-24 00:17:37', '2021-04-24 00:17:37'),
(3, 'Thuốc nhuộm tóc màu đen', 'ccccccccccccc', '3169-13dc-4d1f-8cf9-74526f2cb115_1619248697.jpg', 200000, 100000, 4, 6, '2021-04-24 00:18:17', '2021-04-24 00:18:17'),
(4, 'Thuốc nhuộm tóc màu trắng', '<p>aaaaaaaaaaaa</p>', '173400742_460638591874969_4862181734524333373_n_1620126373.jpg', 20000, NULL, 6, 5, '2021-04-27 00:49:10', '2021-05-04 04:06:13'),
(5, 'Thuốc kích thích mọc tóc mạnh dũng 200g', '<p>- T&oacute;c bao mọc nhanh</p>\n\n<p>- Kh&ocirc;ng h&oacute;a chất độc hạii</p>', '177477867_167044531882917_8303938402316297695_n_1620126681.jpg', 40000, NULL, 3, 4, '2021-05-04 04:11:21', '2021-05-04 20:16:24'),
(6, 'Kem chống nắng toàn thân ban đêm Mạnh Dũng 200g', '<p>- Thương hiệu Mạnh Dũng uy t&iacute;n lu&ocirc;nnn</p>', '843_Webp.net-compress-image-16_1620185044.jpg', 1000001, NULL, 2, 7, '2021-05-04 20:24:04', '2021-05-04 20:24:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cosmetics_product_image`
--

CREATE TABLE `cosmetics_product_image` (
  `product_image_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cosmetics_product_image`
--

INSERT INTO `cosmetics_product_image` (`product_image_id`, `product_id`, `product_image_name`, `created_at`, `updated_at`) VALUES
(1, 1, '173400742_460638591874969_4862181734524333373_n_1619248721.jpg', '2021-04-24 00:18:41', '2021-04-24 00:18:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cosmetics_profile`
--

CREATE TABLE `cosmetics_profile` (
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cosmetics_profile`
--

INSERT INTO `cosmetics_profile` (`profile_id`, `user_id`, `customer_name`, `customer_address`, `customer_phone`, `created_at`, `updated_at`) VALUES
(1, 1, 'Vũ Mạnh Dũng', 'Hà Nội', '0386132297', '2021-04-24 00:10:39', '2021-04-24 00:10:39'),
(2, 3, 'Vũ Mạnh Dũng', 'hà nội', '22222222222222', '2021-04-26 02:26:06', '2021-04-26 02:26:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cosmetics_rate`
--

CREATE TABLE `cosmetics_rate` (
  `rate_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rate_scores` int(11) NOT NULL,
  `rate_comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cosmetics_rate`
--

INSERT INTO `cosmetics_rate` (`rate_id`, `user_id`, `product_id`, `rate_scores`, `rate_comment`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 3, 'abvvv', '2021-04-27 02:25:45', '2021-04-27 02:25:45'),
(3, 1, 1, 5, 'Sản phẩm dùng rất tốt', '2021-04-27 02:49:22', '2021-04-27 02:49:22'),
(4, 1, 2, 4, 'rất tốt', '2021-04-27 02:55:09', '2021-04-27 02:55:09'),
(5, 1, 4, 5, 'sản phẩm tuyệt vời', '2021-05-05 01:50:17', '2021-05-05 01:50:17'),
(6, 1, 5, 2, 'rất tệ', '2021-05-05 02:40:57', '2021-05-05 02:40:57'),
(7, 1, 6, 4, 'sản phẩm chấp nhận được', '2021-05-05 02:42:26', '2021-05-05 02:42:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cosmetics_slide`
--

CREATE TABLE `cosmetics_slide` (
  `slide_id` bigint(20) UNSIGNED NOT NULL,
  `slide_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cosmetics_slide`
--

INSERT INTO `cosmetics_slide` (`slide_id`, `slide_image`, `slide_status`, `created_at`, `updated_at`) VALUES
(1, 'banner-chuong-trinh-dinh-cu-Chau-Au-Cyprus-3_1920x650_1619248280.jpg', 1, '2021-04-24 00:11:20', '2021-04-24 00:11:20'),
(2, '3169-13dc-4d1f-8cf9-74526f2cb115_1619248296.jpg', 1, '2021-04-24 00:11:36', '2021-04-24 00:11:36'),
(4, 'abc_1619248317.jpg', 1, '2021-04-24 00:11:57', '2021-04-24 00:11:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cosmetics_wishlist`
--

CREATE TABLE `cosmetics_wishlist` (
  `wishlist_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cosmetics_wishlist`
--

INSERT INTO `cosmetics_wishlist` (`wishlist_id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(259, 1, 6, 2, '2021-05-05 04:27:00', '2021-05-05 04:29:41'),
(260, 1, 4, 1, '2021-05-05 04:29:35', '2021-05-05 04:29:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(63, '2014_10_12_000000_create_users_table', 1),
(64, '2014_10_12_100000_create_password_resets_table', 1),
(65, '2019_08_19_000000_create_failed_jobs_table', 1),
(66, '2021_01_16_094307_create_cosmetics_brand_table', 1),
(67, '2021_01_16_094406_create_cosmetics_category_table', 1),
(68, '2021_01_16_094436_create_cosmetics_order_table', 1),
(69, '2021_01_16_094510_create_cosmetics_order_detail_table', 1),
(70, '2021_01_16_094536_create_cosmetics_product_table', 1),
(71, '2021_01_16_094551_create_cosmetics_product_image_table', 1),
(72, '2021_01_16_094608_create_cosmetics_profile_table', 1),
(73, '2021_01_16_094620_create_cosmetics_rate_table', 1),
(74, '2021_01_16_094630_create_cosmetics_slide_table', 1),
(76, '2021_01_16_094652_create_cosmetics_wishlist_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Dungshinichi99@gmail.com', 1, NULL, '$2y$10$a7yPqrDD8SJYzZHyYqdRHuFJOXeHJexAuQzt034dZDzeAzZKYwdGy', NULL, '2021-04-24 00:10:29', '2021-04-24 00:10:29'),
(3, 'dũng', 'manhdung090399@gmail.com', 2, NULL, '$2y$10$Yv0ZCVoME0teR5jQiyRbWONag13v2MntqzEozSFgU7ZFQKEYAHkX6', NULL, '2021-04-26 02:25:52', '2021-04-26 02:25:52');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cosmetics_brand`
--
ALTER TABLE `cosmetics_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `cosmetics_category`
--
ALTER TABLE `cosmetics_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `cosmetics_order`
--
ALTER TABLE `cosmetics_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `cosmetics_order_detail`
--
ALTER TABLE `cosmetics_order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Chỉ mục cho bảng `cosmetics_product`
--
ALTER TABLE `cosmetics_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `cosmetics_product_image`
--
ALTER TABLE `cosmetics_product_image`
  ADD PRIMARY KEY (`product_image_id`);

--
-- Chỉ mục cho bảng `cosmetics_profile`
--
ALTER TABLE `cosmetics_profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Chỉ mục cho bảng `cosmetics_rate`
--
ALTER TABLE `cosmetics_rate`
  ADD PRIMARY KEY (`rate_id`);

--
-- Chỉ mục cho bảng `cosmetics_slide`
--
ALTER TABLE `cosmetics_slide`
  ADD PRIMARY KEY (`slide_id`);

--
-- Chỉ mục cho bảng `cosmetics_wishlist`
--
ALTER TABLE `cosmetics_wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cosmetics_brand`
--
ALTER TABLE `cosmetics_brand`
  MODIFY `brand_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `cosmetics_category`
--
ALTER TABLE `cosmetics_category`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `cosmetics_order`
--
ALTER TABLE `cosmetics_order`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `cosmetics_order_detail`
--
ALTER TABLE `cosmetics_order_detail`
  MODIFY `order_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT cho bảng `cosmetics_product`
--
ALTER TABLE `cosmetics_product`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `cosmetics_product_image`
--
ALTER TABLE `cosmetics_product_image`
  MODIFY `product_image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cosmetics_profile`
--
ALTER TABLE `cosmetics_profile`
  MODIFY `profile_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `cosmetics_rate`
--
ALTER TABLE `cosmetics_rate`
  MODIFY `rate_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `cosmetics_slide`
--
ALTER TABLE `cosmetics_slide`
  MODIFY `slide_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `cosmetics_wishlist`
--
ALTER TABLE `cosmetics_wishlist`
  MODIFY `wishlist_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
