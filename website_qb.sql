-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th6 07, 2025 lúc 04:37 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `website_qb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `answer_text` text NOT NULL,
  `is_correct` tinyint(4) NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `answers`
--

INSERT INTO `answers` (`id`, `answer_text`, `is_correct`, `question_id`, `created_at`, `updated_at`) VALUES
(5, 'Hà Nội', 0, 2, '2025-03-28 10:24:51', '2025-03-28 10:24:51'),
(6, 'Hưng Yên', 1, 2, '2025-03-28 10:24:51', '2025-03-31 05:01:03'),
(7, 'Hải Phòng', 0, 2, '2025-03-28 10:24:51', '2025-03-31 05:01:03'),
(8, 'Hải Dương', 0, 2, '2025-03-28 10:24:51', '2025-03-28 10:24:51'),
(9, 'It\'s me', 1, 3, '2025-03-28 19:58:16', '2025-03-31 05:05:24'),
(10, 'It\'s you', 0, 3, '2025-03-28 19:58:16', '2025-03-31 05:04:37'),
(11, 'Huong', 0, 3, '2025-03-28 19:58:16', '2025-03-31 05:05:24'),
(12, 'Van', 0, 3, '2025-03-28 19:58:16', '2025-03-31 05:04:37'),
(13, '1 pm', 0, 4, '2025-03-31 03:35:39', '2025-03-31 03:35:39'),
(14, '2 pm', 0, 4, '2025-03-31 03:35:39', '2025-03-31 03:35:39'),
(15, '3 pm', 1, 4, '2025-03-31 03:35:39', '2025-03-31 05:09:16'),
(16, '8 am', 0, 4, '2025-03-31 03:35:39', '2025-03-31 03:35:39'),
(21, 'hgfvnhg', 1, 6, '2025-04-08 01:45:17', '2025-04-08 02:04:17'),
(22, 'lkj.,j.lk', 1, 6, '2025-04-08 01:45:17', '2025-04-08 02:03:58'),
(23, 'tdetredte', 0, 6, '2025-04-08 01:45:17', '2025-04-08 02:03:58'),
(24, 'ẻwsrw54', 0, 6, '2025-04-08 01:45:17', '2025-04-08 01:45:17'),
(25, 'jhgjmyuj', 0, 7, '2025-04-08 01:45:35', '2025-04-08 01:45:35'),
(26, 'dtfdrhngtrfny', 0, 7, '2025-04-08 01:45:35', '2025-04-08 01:45:35'),
(27, 'tuỵtt7', 0, 7, '2025-04-08 01:45:35', '2025-04-08 02:05:17'),
(28, 'ADWQQ', 1, 7, '2025-04-08 01:45:35', '2025-04-08 02:05:17'),
(29, '2', 1, 8, '2025-04-13 05:30:57', '2025-04-13 05:30:57'),
(30, '7', 0, 8, '2025-04-13 05:30:57', '2025-04-13 05:30:57'),
(31, '9', 0, 8, '2025-04-13 05:30:57', '2025-04-13 05:30:57'),
(32, '8', 0, 8, '2025-04-13 05:30:57', '2025-04-13 05:30:57'),
(33, '10', 1, 9, '2025-04-13 05:44:56', '2025-04-13 05:44:56'),
(34, '9', 0, 9, '2025-04-13 05:44:56', '2025-04-13 05:44:56'),
(35, '8', 0, 9, '2025-04-13 05:44:56', '2025-04-13 05:44:56'),
(36, '7', 0, 9, '2025-04-13 05:44:56', '2025-04-13 05:44:56'),
(37, '10', 0, 10, '2025-05-21 13:57:04', '2025-05-21 13:57:04'),
(38, '9', 0, 10, '2025-05-21 13:57:04', '2025-05-21 13:57:04'),
(39, '8', 0, 10, '2025-05-21 13:57:04', '2025-05-21 13:57:04'),
(40, '15', 1, 10, '2025-05-21 13:57:04', '2025-05-21 13:57:04'),
(41, '10', 0, 11, '2025-05-21 16:29:04', '2025-05-21 16:29:04'),
(42, '20', 1, 11, '2025-05-21 16:29:04', '2025-05-21 16:29:04'),
(43, '30', 0, 11, '2025-05-21 16:29:04', '2025-05-21 16:29:04'),
(44, '1', 0, 11, '2025-05-21 16:29:04', '2025-05-21 16:29:04'),
(45, '121', 1, 12, '2025-05-21 16:29:51', '2025-05-21 16:29:51'),
(46, '11', 0, 12, '2025-05-21 16:29:51', '2025-05-21 16:29:51'),
(47, '12', 0, 12, '2025-05-21 16:29:51', '2025-05-21 16:29:51'),
(48, '10', 0, 12, '2025-05-21 16:29:51', '2025-05-21 16:29:51'),
(49, '1', 0, 13, '2025-05-21 21:05:32', '2025-05-21 21:05:32'),
(50, '2', 1, 13, '2025-05-21 21:05:32', '2025-05-21 21:05:32'),
(51, '3', 0, 13, '2025-05-21 21:05:32', '2025-05-21 21:05:32'),
(52, '4', 0, 13, '2025-05-21 21:05:32', '2025-05-21 21:05:32'),
(53, '5', 1, 14, '2025-05-21 21:05:58', '2025-05-21 21:05:58'),
(54, '7', 0, 14, '2025-05-21 21:05:58', '2025-05-21 21:05:58'),
(55, '8', 0, 14, '2025-05-21 21:05:58', '2025-05-21 21:05:58'),
(56, '9', 0, 14, '2025-05-21 21:05:58', '2025-05-21 21:05:58'),
(57, '10', 0, 15, '2025-05-21 21:06:39', '2025-05-21 21:06:39'),
(58, '11', 0, 15, '2025-05-21 21:06:39', '2025-05-21 21:06:39'),
(59, '19', 0, 15, '2025-05-21 21:06:39', '2025-05-21 21:06:39'),
(60, '18', 1, 15, '2025-05-21 21:06:39', '2025-05-21 21:06:39'),
(61, '2a', 1, 16, '2025-05-21 21:07:20', '2025-05-21 21:07:20'),
(62, '3a', 0, 16, '2025-05-21 21:07:20', '2025-05-21 21:07:20'),
(63, '4a', 0, 16, '2025-05-21 21:07:20', '2025-05-21 21:07:20'),
(64, '5a', 0, 16, '2025-05-21 21:07:20', '2025-05-21 21:07:20'),
(65, 'ab', 1, 17, '2025-05-21 21:07:53', '2025-05-21 21:07:53'),
(66, 'ad', 0, 17, '2025-05-21 21:07:53', '2025-05-21 21:07:53'),
(67, 'aa', 0, 17, '2025-05-21 21:07:53', '2025-05-21 21:07:53'),
(68, 'ae', 0, 17, '2025-05-21 21:07:53', '2025-05-21 21:07:53'),
(69, '90', 1, 18, '2025-05-21 21:08:42', '2025-05-21 21:08:42'),
(70, '10', 0, 18, '2025-05-21 21:08:42', '2025-05-21 21:08:42'),
(71, '30', 0, 18, '2025-05-21 21:08:42', '2025-05-21 21:08:42'),
(72, '20', 0, 18, '2025-05-21 21:08:42', '2025-05-21 21:08:42'),
(73, '3', 0, 19, '2025-05-21 21:09:20', '2025-05-21 21:09:20'),
(74, '1', 0, 19, '2025-05-21 21:09:20', '2025-05-21 21:09:20'),
(75, '10', 1, 19, '2025-05-21 21:09:20', '2025-05-21 21:09:20'),
(76, '12', 0, 19, '2025-05-21 21:09:20', '2025-05-21 21:09:20'),
(77, '10 am', 1, 20, '2025-05-22 20:05:47', '2025-05-22 20:05:47'),
(78, '11 am', 0, 20, '2025-05-22 20:05:47', '2025-05-22 20:05:47'),
(79, '7 am', 0, 20, '2025-05-22 20:05:47', '2025-05-22 20:05:47'),
(80, '6 am', 0, 20, '2025-05-22 20:05:47', '2025-05-22 20:05:47'),
(81, '16', 1, 21, '2025-05-22 20:06:23', '2025-05-22 20:06:23'),
(82, '12', 0, 21, '2025-05-22 20:06:23', '2025-05-22 20:06:23'),
(83, '11', 0, 21, '2025-05-22 20:06:23', '2025-05-22 20:06:23'),
(84, '18', 0, 21, '2025-05-22 20:06:23', '2025-05-22 20:06:23'),
(85, 'I\'m cooking', 0, 22, '2025-05-22 20:07:57', '2025-05-22 20:07:57'),
(86, 'I\'m reading', 0, 22, '2025-05-22 20:07:57', '2025-05-22 20:07:57'),
(87, 'I\'m watching TV show', 1, 22, '2025-05-22 20:07:57', '2025-05-22 20:07:57'),
(88, 'I\'m hungry', 0, 22, '2025-05-22 20:07:57', '2025-05-22 20:07:57'),
(89, 'My name is My', 1, 23, '2025-05-22 20:08:37', '2025-05-22 20:08:37'),
(90, 'May', 0, 23, '2025-05-22 20:08:37', '2025-05-22 20:08:37'),
(91, 'Huong', 0, 23, '2025-05-22 20:08:37', '2025-05-22 20:08:37'),
(92, 'Ly', 0, 23, '2025-05-22 20:08:37', '2025-05-22 20:08:37'),
(93, 'Because I hurt my legs', 1, 24, '2025-05-22 20:10:54', '2025-05-22 20:10:54'),
(94, 'Because I don\'t want to go', 0, 24, '2025-05-22 20:10:54', '2025-05-22 20:10:54'),
(95, 'Because I\'m hungry', 0, 24, '2025-05-22 20:10:54', '2025-05-22 20:10:54'),
(96, 'Me too', 0, 24, '2025-05-22 20:10:54', '2025-05-22 20:10:54'),
(97, 'work', 1, 25, '2025-05-22 20:15:03', '2025-05-22 20:15:03'),
(98, 'works', 0, 25, '2025-05-22 20:15:03', '2025-05-22 20:15:03'),
(99, 'working', 0, 25, '2025-05-22 20:15:03', '2025-05-22 20:15:03'),
(100, 'workes', 0, 25, '2025-05-22 20:15:03', '2025-05-22 20:15:03'),
(101, 'lives', 1, 26, '2025-05-22 20:16:15', '2025-05-22 20:16:15'),
(102, 'living', 0, 26, '2025-05-22 20:16:15', '2025-05-22 20:16:15'),
(103, 'live', 0, 26, '2025-05-22 20:16:15', '2025-05-22 20:16:15'),
(104, 'lying', 0, 26, '2025-05-22 20:16:15', '2025-05-22 20:16:15'),
(105, 'feed', 1, 27, '2025-05-22 20:18:36', '2025-05-22 20:18:36'),
(106, 'feeds', 0, 27, '2025-05-22 20:18:36', '2025-05-22 20:18:36'),
(107, 'feedes', 0, 27, '2025-05-22 20:18:36', '2025-05-22 20:18:36'),
(108, 'feeding', 0, 27, '2025-05-22 20:18:36', '2025-05-22 20:18:36'),
(109, 'earn', 0, 28, '2025-05-22 20:20:33', '2025-05-22 20:20:33'),
(110, 'earns', 1, 28, '2025-05-22 20:20:33', '2025-05-22 20:20:33'),
(111, 'earning', 0, 28, '2025-05-22 20:20:33', '2025-05-22 20:20:33'),
(112, 'earnes', 0, 28, '2025-05-22 20:20:33', '2025-05-22 20:20:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-05-03 00:04:39', '2025-05-03 00:04:39'),
(2, 4, '2025-06-05 19:07:54', '2025-06-05 19:07:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_details`
--

CREATE TABLE `cart_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_details`
--

INSERT INTO `cart_details` (`id`, `cart_id`, `course_id`, `created_at`, `updated_at`) VALUES
(8, 1, 3, '2025-06-04 02:04:27', '2025-06-04 02:04:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chapters`
--

CREATE TABLE `chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_number` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chapters`
--

INSERT INTO `chapters` (`id`, `course_id`, `title`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chương 1', 1, '2025-05-21 05:02:20', '2025-05-21 05:02:20'),
(2, 1, 'Chương 2', 2, '2025-05-21 05:02:53', '2025-05-21 05:02:53'),
(3, 1, 'Chương 3', 3, '2025-05-21 05:06:23', '2025-05-21 05:06:23'),
(4, 3, 'Chương 1', 1, '2025-05-21 05:06:43', '2025-05-21 05:06:43'),
(5, 3, 'Chương 2', 2, '2025-05-21 11:01:50', '2025-05-21 11:01:50'),
(6, 3, 'Chương 3', 3, '2025-05-22 05:58:27', '2025-05-22 05:58:27'),
(7, 4, 'Chương 1', 1, '2025-05-22 07:30:16', '2025-05-22 07:30:16'),
(8, 4, 'Chương 2', 2, '2025-05-22 07:30:30', '2025-05-22 07:30:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `courses`
--

INSERT INTO `courses` (`id`, `name`, `slug`, `description`, `price`, `image`, `is_featured`, `subject_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 'Hóa học 6', 'hoa-hoc-6', '<p><strong>Chi tiết kh&oacute;a học H&oacute;a học 6:</strong></p>\r\n\r\n<p>&nbsp;- Giới thiệu kiến thức cơ bản về h&oacute;a học: Học sinh sẽ được học về c&aacute;c kh&aacute;i niệm cơ bản như nguy&ecirc;n tử, ph&acirc;n tử, sự biến đổi của chất, phản ứng h&oacute;a học v&agrave; c&aacute;c chất thường gặp trong tự nhi&ecirc;n.</p>\r\n\r\n<p>&nbsp;- Kh&aacute;m ph&aacute; qua th&iacute; nghiệm: Kh&oacute;a học kết hợp l&yacute; thuyết v&agrave; thực h&agrave;nh, gi&uacute;p học sinh thực hiện c&aacute;c th&iacute; nghiệm đơn giản để hiểu r&otilde; hơn về c&aacute;c hiện tượng h&oacute;a học.</p>\r\n\r\n<p>&nbsp;- Ph&aacute;t triển tư duy khoa học: Kh&oacute;a học r&egrave;n luyện kỹ năng ph&acirc;n t&iacute;ch, quan s&aacute;t v&agrave; tư duy logic cho học sinh.</p>\r\n\r\n<p><strong>Đối tượng:</strong>&nbsp;Học sinh lớp 6 mới bắt đầu tiếp cận m&ocirc;n H&oacute;a học v&agrave; muốn hiểu về c&aacute;c kiến thức cơ bản trong lĩnh vực n&agrave;y.</p>', 1000000.00, 'uploads/course/1742802619.png', 1, 5, 3, '2025-03-23 03:47:00', '2025-05-30 03:22:25'),
(3, 'Hóa học 7', 'hoa-hoc-7', '<p><strong>Chi tiết kh&oacute;a học:</strong></p>\r\n\r\n<p>&nbsp;- Giới thiệu về nguy&ecirc;n tố v&agrave; hợp chất: Kh&oacute;a học gi&uacute;p học sinh hiểu về c&aacute;c nguy&ecirc;n tố h&oacute;a học, sự kết hợp giữa c&aacute;c nguy&ecirc;n tố để tạo ra hợp chất, v&agrave; c&aacute;c t&iacute;nh chất của ch&uacute;ng.</p>\r\n\r\n<p>&nbsp;- Phản ứng h&oacute;a học: Học sinh sẽ học về c&aacute;c loại phản ứng h&oacute;a học cơ bản như phản ứng oxi h&oacute;a, phản ứng trao đổi, v&agrave; c&aacute;c phương ph&aacute;p nhận diện phản ứng.</p>\r\n\r\n<p>&nbsp;- Ứng dụng thực tế: Kh&oacute;a học li&ecirc;n kết l&yacute; thuyết với c&aacute;c ứng dụng trong đời sống h&agrave;ng ng&agrave;y, gi&uacute;p học sinh thấy được tầm quan trọng của H&oacute;a học trong thực tiễn.</p>\r\n\r\n<p><strong>Đối tượng:</strong>&nbsp;Học sinh lớp 7, những em muốn học kiến thức cơ bản về h&oacute;a học v&agrave; hiểu r&otilde; hơn về c&aacute;c phản ứng h&oacute;a học, nguy&ecirc;n tố, hợp chất trong thế giới xung quanh.</p>', 2000000.00, 'uploads/course/1742978131.png', 1, 5, 4, '2025-03-26 01:35:31', '2025-05-30 03:23:09'),
(4, 'Tiếng Anh 11', 'tieng-anh-11', '<p><strong>Chi tiết kh&oacute;a học:</strong></p>\r\n\r\n<p>&nbsp;- Giới thiệu về nguy&ecirc;n tố v&agrave; hợp chất: Kh&oacute;a học gi&uacute;p học sinh hiểu về c&aacute;c nguy&ecirc;n tố h&oacute;a học, sự kết hợp giữa c&aacute;c nguy&ecirc;n tố để tạo ra hợp chất, v&agrave; c&aacute;c t&iacute;nh chất của ch&uacute;ng.</p>\r\n\r\n<p>&nbsp;- Phản ứng h&oacute;a học: Học sinh sẽ học về c&aacute;c loại phản ứng h&oacute;a học cơ bản như phản ứng oxi h&oacute;a, phản ứng trao đổi, v&agrave; c&aacute;c phương ph&aacute;p nhận diện phản ứng.</p>\r\n\r\n<p>&nbsp;- Ứng dụng thực tế: Kh&oacute;a học li&ecirc;n kết l&yacute; thuyết với c&aacute;c ứng dụng trong đời sống h&agrave;ng ng&agrave;y, gi&uacute;p học sinh thấy được tầm quan trọng của H&oacute;a học trong thực tiễn.</p>\r\n\r\n<p><strong>Đối tượng:</strong>&nbsp;Học sinh lớp 7, những em muốn học kiến thức cơ bản về h&oacute;a học v&agrave; hiểu r&otilde; hơn về c&aacute;c phản ứng h&oacute;a học, nguy&ecirc;n tố, hợp chất trong thế giới xung quanh.</p>', 1500000.00, 'uploads/course/1744550139.png', 1, 4, 4, '2025-04-13 06:15:39', '2025-05-30 03:23:35'),
(5, 'Tiếng Anh 12', 'tieng-anh-12', '<p>Đ&acirc;y l&agrave; kh&oacute;a học Tiếng Anh lớp 12</p>', 1000000.00, 'uploads/course/1748599932.png', 0, 4, 6, '2025-05-30 03:12:12', '2025-05-30 03:12:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `course_id`, `payment_id`, `time`) VALUES
(2, 2, 4, 1, '2025-05-05 09:50:28'),
(3, 2, 1, 1, '2025-05-05 09:50:28'),
(12, 4, 1, 14, '2025-06-07 14:19:06'),
(13, 4, 4, 14, '2025-06-07 14:19:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_sample` tinyint(4) NOT NULL,
  `order_number` bigint(20) UNSIGNED NOT NULL,
  `pass_score` double(8,2) DEFAULT NULL,
  `max_attempts` tinyint(4) NOT NULL,
  `time` smallint(6) NOT NULL,
  `question_count` int(11) NOT NULL,
  `easy_count` int(11) NOT NULL,
  `hard_count` int(11) NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `exams`
--

INSERT INTO `exams` (`id`, `name`, `description`, `is_sample`, `order_number`, `pass_score`, `max_attempts`, `time`, `question_count`, `easy_count`, `hard_count`, `chapter_id`, `created_at`, `updated_at`) VALUES
(1, 'Bài thi 1', '<p>Đ&acirc;y l&agrave; b&agrave;i thi 1</p>', 0, 1, 5.00, 3, 10, 5, 3, 2, 1, '2025-03-24 21:29:31', '2025-05-21 23:08:20'),
(4, 'Bài thi 2', '<p>Đ&acirc;y l&agrave; b&agrave;i thi số 2</p>', 0, 2, 5.00, 3, 60, 6, 4, 2, 1, '2025-03-31 05:30:24', '2025-05-21 23:09:28'),
(5, 'Bài thi 3', '<p>Đ&acirc;y l&agrave; b&agrave;i thi thử</p>', 1, 3, 5.00, 2, 60, 5, 0, 0, 2, '2025-04-13 05:30:21', '2025-04-13 05:30:21'),
(6, 'Bài thi 4', '<p>B&agrave;i thi 4</p>', 0, 4, 5.00, 2, 20, 6, 4, 2, 2, '2025-05-21 21:20:44', '2025-05-21 21:20:44'),
(7, 'Bài thi 1', '<p>Đ&acirc;y l&agrave; b&agrave;i thi 1</p>', 0, 1, 5.00, 3, 20, 6, 3, 3, 7, '2025-06-02 20:24:15', '2025-06-02 20:24:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `rating` float NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `student_id`, `course_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3.9, 'Khóa học rất bổ ích. Bài giảng rõ ràng, giải thích chi tiết và có các bài test sau các bài học rất tiện cho việc hệ thống kiến thức !', '2025-05-16 19:09:05', '2025-05-28 01:20:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `infors`
--

CREATE TABLE `infors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone1` varchar(12) DEFAULT NULL,
  `phone2` varchar(12) DEFAULT NULL,
  `fb` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address1` varchar(200) DEFAULT NULL,
  `address2` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `infors`
--

INSERT INTO `infors` (`id`, `phone1`, `phone2`, `fb`, `logo`, `email`, `address1`, `address2`, `content`, `created_at`, `updated_at`) VALUES
(1, '0838 240 571', '0836 957 852', 'https://www.facebook.com/people/H%C6%B0%C6%A1ng-Sen-Vi%E1%BB%87t-Edu/61573132709227/?locale=vi_VN', 'uploads/infors/1749265387.png', 'huongsenvietedu@gmail.com', 'Số 51 Quang Trung, Hoàng Văn Thụ, Hồng Bàng, Hải Phòng', 'Số 16 Lê Đại Hành, Hồng Bàng, Hải Phòng', '<p><strong>C&ocirc;ng ty TNHH Gi&aacute;o dục Hương Sen Việt</strong> (tiền th&acirc;n l&agrave; Trung t&acirc;m ngoại ngữ Hương Sen Việt) l&agrave; một trung t&acirc;m bồi dưỡng kiến thức được th&agrave;nh lập v&agrave;o đầu năm 2025 với sứ mệnh x&acirc;y dựng một m&ocirc; h&igrave;nh gi&aacute;o dục to&agrave;n diện, gi&uacute;p học sinh kh&ocirc;ng chỉ học giỏi, thi đỗ, m&agrave; c&ograve;n ph&aacute;t triển nh&acirc;n c&aacute;ch, tr&iacute; tuệ v&agrave; bản lĩnh, sẵn s&agrave;ng chinh phục mọi thử th&aacute;ch trong tương lai.</p>\r\n\r\n<p>Với phương ch&acirc;m <strong>&quot;Học giỏi - Thi đỗ - Sống tốt&quot;</strong>, Hương Sen Việt kh&ocirc;ng chỉ tập trung v&agrave;o việc n&acirc;ng cao kiến thức học thuật m&agrave; c&ograve;n đặc biệt ch&uacute; trọng đến việc r&egrave;n luyện kỹ năng sống, ph&aacute;t triển tư duy v&agrave; đạo đức cho học sinh. Chương tr&igrave;nh giảng dạy tại trung t&acirc;m được thiết kế theo triết l&yacute; gi&aacute;o dục T&acirc;m - Nh&acirc;n - Tr&iacute;, gi&uacute;p học vi&ecirc;n kh&ocirc;ng chỉ c&oacute; nền tảng kiến thức vững chắc m&agrave; c&ograve;n c&oacute; đạo đức tốt, tr&aacute;ch nhiệm với bản th&acirc;n v&agrave; x&atilde; hội.</p>\r\n\r\n<p>Hương Sen Việt hướng đến m&ocirc; h&igrave;nh gi&aacute;o dục linh hoạt, kết hợp giảng dạy trực tiếp (offline) v&agrave; trực tuyến (online), gi&uacute;p học vi&ecirc;n tr&ecirc;n khắp cả nước c&oacute; thể tiếp cận kiến thức một c&aacute;ch thuận tiện, hiệu quả. Kh&ocirc;ng chỉ dừng lại ở việc bồi dưỡng kiến thức theo chương tr&igrave;nh phổ th&ocirc;ng, trung t&acirc;m c&ograve;n cung cấp c&aacute;c kh&oacute;a học kỹ năng, định hướng học tập v&agrave; ph&aacute;t triển tư duy, gi&uacute;p học sinh c&oacute; sự chuẩn bị to&agrave;n diện cho tương lai.</p>\r\n\r\n<p>Với đội ngũ gi&aacute;o vi&ecirc;n gi&agrave;u kinh nghiệm, t&acirc;m huyết c&ugrave;ng hệ thống học liệu được đầu tư b&agrave;i bản, Hương Sen Việt cam kết mang đến một m&ocirc;i trường học tập chất lượng, gi&uacute;p mỗi học vi&ecirc;n kh&ocirc;ng chỉ đạt được th&agrave;nh t&iacute;ch cao trong học tập m&agrave; c&ograve;n trưởng th&agrave;nh với tư duy t&iacute;ch cực, tự tin v&agrave; bản lĩnh vững v&agrave;ng.</p>', NULL, '2025-06-06 20:24:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `order_number` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `file_id` varchar(100) DEFAULT NULL,
  `percent` int(11) NOT NULL,
  `is_sample` tinyint(4) NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lessons`
--

INSERT INTO `lessons` (`id`, `name`, `order_number`, `description`, `file_id`, `percent`, `is_sample`, `chapter_id`, `course_id`, `created_at`, `updated_at`) VALUES
(26, 'Bài 1: Hóa học là gì? Vai trò của hóa học trong cuộc sống.', 1, '<p>B&agrave;i 1</p>', 'kDQm3RWI1cQ', 2, 1, 1, 1, '2025-06-06 23:14:18', '2025-06-06 23:16:26'),
(27, 'Bài 2: Các chất hóa học tự nhiên', 2, '<p>B&agrave;i 2</p>', 'n3v_ROjAjoY', 20, 0, 1, 1, '2025-06-06 23:15:02', '2025-06-06 23:15:02'),
(28, 'Bài 3: Các chất trong tự nhiên', 3, '<p>B&agrave;i 3</p>', '-ovwAxMgDTg', 2, 0, 2, 1, '2025-06-06 23:15:46', '2025-06-06 23:15:46'),
(29, 'Bài 1: Các thì cơ bản trong Tiếng anh', 1, '<p>B&agrave;i 1</p>', 'yf3KSQFBQck', 20, 1, 7, 4, '2025-06-06 23:18:00', '2025-06-06 23:18:00'),
(30, 'Bài 2: Câu bị động', 2, '<p>B&agrave;i 2</p>', 'SIRcEoeARV8', 20, 0, 7, 4, '2025-06-06 23:20:01', '2025-06-06 23:20:01'),
(31, 'Bài 3: Câu gián tiếp', 3, '<p>B&agrave;i 3</p>', '3MNO0BjJC6w', 20, 0, 8, 4, '2025-06-06 23:23:19', '2025-06-06 23:23:19'),
(32, 'Bài 1: Hệ thống lại kiến thức quan trọng', 1, '<p>B&agrave;i 1</p>', 'Y04QPf3frIY', 20, 1, 4, 3, '2025-06-06 23:25:03', '2025-06-06 23:25:03'),
(33, 'Bài 2: Các chất hóa học tự nhiên', 2, '<p>B&agrave;i 2</p>', 'IzkIoiuLoEg', 20, 0, 4, 3, '2025-06-06 23:25:54', '2025-06-06 23:27:26'),
(34, 'Bài 3: Nguyên tố và hợp chất', 3, '<p>B&agrave;i 3</p>', 'cQ8qwuhbJVc', 20, 0, 5, 3, '2025-06-06 23:26:45', '2025-06-06 23:28:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lesson_progress`
--

CREATE TABLE `lesson_progress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lesson_progress`
--

INSERT INTO `lesson_progress` (`id`, `student_id`, `lesson_id`, `completed_at`, `created_at`, `updated_at`) VALUES
(20, 2, 26, '2025-06-07 06:16:50', '2025-06-06 23:16:50', '2025-06-06 23:16:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2025_03_20_171229_create_subjects_table', 2),
(10, '2025_03_21_021348_create_courses_table', 3),
(11, '2025_03_24_075614_create_lessons_table', 4),
(12, '2025_03_25_022827_create_exams_table', 5),
(14, '2025_03_26_004831_create_sliders_table', 6),
(15, '2025_03_28_145107_create_questions_table', 7),
(16, '2025_03_28_145810_create_answers_table', 8),
(17, '2025_03_28_191830_create_posts_table', 9),
(18, '2025_03_29_104253_create_infors_table', 10),
(20, '2025_04_08_004649_create_roles_table', 11),
(21, '2014_10_12_000000_create_users_table', 12),
(22, '2014_10_12_100000_create_password_reset_tokens_table', 13),
(23, '2025_04_26_021808_create_students_table', 14),
(24, '2025_05_03_053254_create_carts_table', 15),
(25, '2025_05_03_053725_create_cart_details_table', 15),
(26, '2025_05_03_193637_create_payments_table', 16),
(27, '2025_05_04_125239_create_enrollments_table', 16),
(28, '2025_05_06_135350_create_lesson_progress_table', 17),
(29, '2025_05_12_031553_create_student_exams_table', 18),
(30, '2025_05_12_173242_create_student_answers_table', 19),
(31, '2025_05_16_203631_create_feedbacks_table', 20),
(32, '2025_05_17_053430_create_student_temp_answers_table', 21),
(33, '2025_05_21_103830_create_chapters_table', 22),
(34, '2025_05_21_225300_create_student_exam_question_table', 23),
(35, '2025_05_22_105936_create_student_reset_tokens_table', 24);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`, `updated_at`) VALUES
('daothibinh2k3@gmail.com', 'Is5PQE6uO4AteL6QnE23ZTCnqNPo2GRdHfIK1CZq2z6lMMmUk3', '2025-06-01 10:49:50', '2025-06-01 10:58:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `money` decimal(15,2) DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `vnp_response_code` varchar(255) DEFAULT NULL,
  `code_vnpay` varchar(255) DEFAULT NULL COMMENT 'Mã giao dịch vnpay',
  `code_bank` varchar(255) DEFAULT NULL COMMENT 'Mã ngân hàng',
  `time` datetime DEFAULT NULL COMMENT 'Thời gian giao dịch',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `student_id`, `money`, `note`, `vnp_response_code`, `code_vnpay`, `code_bank`, `time`, `created_at`, `updated_at`) VALUES
(1, 2, 2500000.00, 'Thanh toán đơn hàng test', '00', '14938574', 'NCB', '2025-05-05 09:50:00', NULL, NULL),
(14, 4, 2500000.00, 'Thanh toán đơn hàng test', '00', '15006090', 'NCB', '2025-06-07 21:19:00', '2025-06-07 07:19:06', '2025-06-07 07:19:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES
(3, '<h2 style=\"text-align:center\"><strong>B&iacute; Quyết Gi&uacute;p Trẻ Hứng Th&uacute; Với Việc Học Tập</strong></h2>', '<p>Trong thời đại c&ocirc;ng nghệ ph&aacute;t triển như hiện nay, việc thu h&uacute;t sự ch&uacute; &yacute; v&agrave; tạo hứng th&uacute; học tập cho trẻ trở th&agrave;nh một th&aacute;ch thức lớn đối với phụ huynh v&agrave; gi&aacute;o vi&ecirc;n. Trẻ em dễ bị ph&acirc;n t&acirc;m bởi c&aacute;c thiết bị điện tử, tr&ograve; chơi giải tr&iacute;, v&agrave; những hoạt động kh&aacute;c ngo&agrave;i việc học. Tuy nhi&ecirc;n, với những b&iacute; quyết đ&uacute;ng đắn, bạn ho&agrave;n to&agrave;n c&oacute; thể gi&uacute;p trẻ y&ecirc;u th&iacute;ch việc học v&agrave; ph&aacute;t triển tư duy một c&aacute;ch tự nhi&ecirc;n. Dưới đ&acirc;y l&agrave; những phương ph&aacute;p hiệu quả để gi&uacute;p trẻ hứng th&uacute; với việc học tập.</p>\r\n\r\n<h5><strong>Tạo M&ocirc;i Trường Học Tập Th&acirc;n Thiện V&agrave; S&aacute;ng Tạo</strong></h5>\r\n\r\n<p>M&ocirc;i trường học tập đ&oacute;ng vai tr&ograve; quan trọng trong việc h&igrave;nh th&agrave;nh th&oacute;i quen v&agrave; th&aacute;i độ học tập của trẻ. Một kh&ocirc;ng gian học tập gọn g&agrave;ng, đầy đủ &aacute;nh s&aacute;ng v&agrave; được trang tr&iacute; sinh động sẽ k&iacute;ch th&iacute;ch trẻ muốn ngồi v&agrave;o b&agrave;n học. Bạn c&oacute; thể:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Thiết kế g&oacute;c học tập ri&ecirc;ng:</strong>&nbsp;Tạo một g&oacute;c học tập y&ecirc;n tĩnh, thoải m&aacute;i với đầy đủ dụng cụ học tập cần thiết.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Trang tr&iacute; bằng h&igrave;nh ảnh v&agrave; m&agrave;u sắc:</strong>&nbsp;Sử dụng h&igrave;nh ảnh, bản đồ, hoặc poster li&ecirc;n quan đến kiến thức để k&iacute;ch th&iacute;ch tr&iacute; t&ograve; m&ograve; của trẻ.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Sắp xếp thời gian học hợp l&yacute;:</strong>&nbsp;Đảm bảo trẻ c&oacute; thời gian học tập v&agrave; nghỉ ngơi c&acirc;n bằng để tr&aacute;nh cảm gi&aacute;c nh&agrave;m ch&aacute;n.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1:8000/uploads/ckeditor/bvs10_1747184096.jpg\" style=\"height:600px; width:900px\" /></p>\r\n\r\n<h5><strong>&Aacute;p Dụng Phương Ph&aacute;p Học Tập Tương T&aacute;c</strong></h5>\r\n\r\n<p>Trẻ em thường học tốt hơn khi được tham gia v&agrave;o c&aacute;c hoạt động thực h&agrave;nh v&agrave; tương t&aacute;c. Thay v&igrave; chỉ đọc s&aacute;ch hoặc nghe giảng, h&atilde;y &aacute;p dụng c&aacute;c phương ph&aacute;p học tập s&aacute;ng tạo như:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Học qua tr&ograve; chơi:</strong>&nbsp;Sử dụng c&aacute;c tr&ograve; chơi gi&aacute;o dục để gi&uacute;p trẻ tiếp thu kiến thức một c&aacute;ch tự nhi&ecirc;n. V&iacute; dụ, tr&ograve; chơi đố vui, giải đố to&aacute;n học, hoặc c&aacute;c ứng dụng học tập trực tuyến.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Thực h&agrave;nh th&iacute; nghiệm:</strong>&nbsp;Đối với c&aacute;c m&ocirc;n khoa học, h&atilde;y cho trẻ tham gia v&agrave;o c&aacute;c th&iacute; nghiệm đơn giản để kh&aacute;m ph&aacute; kiến thức.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Học nh&oacute;m:</strong>&nbsp;Khuyến kh&iacute;ch trẻ học c&ugrave;ng bạn b&egrave; để tạo sự hứng th&uacute; v&agrave; cạnh tranh l&agrave;nh mạnh.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h5><strong>Kết Hợp C&ocirc;ng Nghệ V&agrave;o Việc Học</strong></h5>\r\n\r\n<p>C&ocirc;ng nghệ l&agrave; c&ocirc;ng cụ hữu &iacute;ch để thu h&uacute;t sự ch&uacute; &yacute; của trẻ. Tuy nhi&ecirc;n, cần sử dụng một c&aacute;ch hợp l&yacute; để tr&aacute;nh lạm dụng. Một số c&aacute;ch kết hợp c&ocirc;ng nghệ v&agrave;o việc học bao gồm:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Sử dụng ứng dụng học tập:</strong>&nbsp;C&aacute;c ứng dụng như Khan Academy, Duolingo, hoặc Quizlet gi&uacute;p trẻ học tập một c&aacute;ch sinh động v&agrave; hiệu quả.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Học qua video gi&aacute;o dục:</strong>&nbsp;YouTube v&agrave; c&aacute;c nền tảng kh&aacute;c cung cấp nhiều video gi&aacute;o dục th&uacute; vị về c&aacute;c chủ đề kh&aacute;c nhau.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Tham gia lớp học trực tuyến:</strong>&nbsp;C&aacute;c kh&oacute;a học trực tuyến gi&uacute;p trẻ tiếp cận kiến thức mới một c&aacute;ch linh hoạt.</p>\r\n	</li>\r\n</ul>', 'uploads/posts/1747183567.jpg', 1, '2025-04-02 01:29:32', '2025-06-06 20:53:13'),
(6, '<h2 style=\"text-align:center\"><strong>Kh&oacute;a học trực tuyến TOEIC SPEAKING &amp; WRITING ch&iacute;nh thức l&ecirc;n kệ tại Hương Sen Việt</strong></h2>', '<p><strong>GIỚI THIỆU VỀ B&Agrave;I THI TOEIC SPEAKING &amp; WRITING</strong></p>\r\n\r\n<p>TOEIC Speaking and Writing l&agrave; b&agrave;i thi đ&aacute;nh gi&aacute; khả năng sử dụng kỹ năng N&oacute;i v&agrave; Viết tiếng Anh trong m&ocirc;i trường l&agrave;m việc quốc tế bao gồm:</p>\r\n\r\n<ul>\r\n	<li>Kỹ năng N&oacute;i: Đ&oacute;ng vai tr&ograve; quan trọng khi thuyết tr&igrave;nh, đối thoại trực tiếp, trao đổi qua điện thoại, trao đổi trực tuyến, hay khi tham gia c&aacute;c cuộc họp, hội nghị trực tuyến. Phần thi bao gồm 11 c&acirc;u hỏi được thực hiện trong thời gian 20 ph&uacute;t.</li>\r\n	<li>Kỹ năng Viết: Rất cần thiết để c&oacute; thể trao đổi th&ocirc;ng tin qua email một c&aacute;ch r&otilde; r&agrave;ng v&agrave; thuyết phục, cũng như trao đổi th&ocirc;ng tin qua c&aacute;c h&igrave;nh thức văn bản kh&aacute;c trong c&ocirc;ng việc.&nbsp; Phần thi bao gồm 8 c&acirc;u hỏi được thực hiện trong thời gian 60 ph&uacute;t.</li>\r\n</ul>\r\n\r\n<p>Tầm quan trọng của b&agrave;i thi TOEIC Speaking &amp; Writing</p>\r\n\r\n<p>Tại Việt Nam, c&ugrave;ng với b&agrave;i thi TOEIC Listening &amp; Reading th&igrave; b&agrave;i thi TOEIC Speaking &amp; Writing l&agrave; một c&ocirc;ng cụ hữu &iacute;ch để:</p>\r\n\r\n<ul>\r\n	<li>Miễn thi m&ocirc;n ngoại ngữ trong x&eacute;t c&ocirc;ng nhận tốt nghiệp THPT theo Th&ocirc;ng tư số 02/2024/TT-BGDĐT</li>\r\n	<li>Đ&aacute;nh gi&aacute; tr&igrave;nh độ tiếng Anh của sinh vi&ecirc;n, l&agrave;m chuẩn đầu ra x&eacute;t tốt nghiệp c&aacute;c trường Đại học, Cao đẳng</li>\r\n	<li>Tuyển dụng, đ&aacute;nh gi&aacute; ứng vi&ecirc;n v&agrave; ph&aacute;t triển c&aacute;c c&aacute; nh&acirc;n c&oacute; khả năng giao tiếp hiệu quả với đồng nghiệp v&agrave; kh&aacute;ch h&agrave;ng ở c&aacute;c quốc gia kh&aacute;c nhau.</li>\r\n</ul>\r\n\r\n<p><strong>TỔNG QUAN KH&Oacute;A HỌC</strong></p>\r\n\r\n<p>Kh&oacute;a học&nbsp;<strong>TOEIC Speaking &amp; Writing Compact Live</strong>&nbsp;l&agrave; chương tr&igrave;nh luyện thi TOEIC trực tuyến 2 kỹ năng N&oacute;i v&agrave; Viết. Đồng h&agrave;nh c&ugrave;ng đội ngũ gi&aacute;o vi&ecirc;n v&agrave; cố vấn học tập tại lớp học, học vi&ecirc;n sẽ được hệ thống kiến thức to&agrave;n diện cũng như thực h&agrave;nh đa dạng loại b&agrave;i tập, được chấm chữa tỉ mỉ chi tiết để r&egrave;n luyện kỹ năng l&agrave;m b&agrave;i theo từng phần.&nbsp;</p>\r\n\r\n<p>Chương tr&igrave;nh t&iacute;ch hợp c&ocirc;ng nghệ hiện đại c&ugrave;ng hệ thống học liệu đa dạng bổ trợ sau từng buổi, nội dung ph&aacute;t triển theo s&aacute;t cấu tr&uacute;c đề thi thật gi&uacute;p c&aacute;c bạn học vi&ecirc;n ph&aacute;t huy năng lực &ocirc;n tập để tối đa h&oacute;a điểm số cho b&agrave;i thi TOEIC Speaking &amp; Writing.</p>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1:8000/uploads/ckeditor/hoc1_1744612383.png\" style=\"height:506px; width:900px\" /></p>\r\n\r\n<p>Sau kh&oacute;a học n&agrave;y, học vi&ecirc;n sẽ c&oacute; thể dễ d&agrave;ng đạt mục ti&ecirc;u điểm số b&agrave;i thi TOEIC Speaking &amp; Writing như mong muốn nhờ việc th&agrave;nh thạo c&aacute;c kỹ năng:</p>\r\n\r\n<ul>\r\n	<li>Hiểu về c&aacute;c Tasks của b&agrave;i thi cũng như thực hiện đ&uacute;ng theo y&ecirc;u cầu của từng Task.</li>\r\n	<li>Sử dụng c&aacute;c c&acirc;u văn để tr&igrave;nh b&agrave;y quan điểm hay phản hồi y&ecirc;u cầu, giao tiếp</li>\r\n	<li>Tư duy chiến thuật l&agrave;m b&agrave;i để đảm bảo chinh phục mục ti&ecirc;u điểm số, cũng như biết c&aacute;ch tận dụng tối ưu thời gian l&agrave;m b&agrave;i thi.</li>\r\n	<li>Nắm bắt ở mức độ cơ bản c&aacute;c kỹ năng cần c&oacute; để l&agrave;m b&agrave;i thi n&oacute;i v&agrave; viết hiệu quả, bao gồm: Ph&aacute;t &acirc;m &amp; Trọng &acirc;m; Ngữ ph&aacute;p; Từ vựng; Nhận diện v&agrave; m&ocirc; tả tranh; Tổ chức &yacute;; Nghe hiểu &amp; li&ecirc;n kết th&ocirc;ng tin,...</li>\r\n</ul>', 'uploads/posts/1744633327.jpg', 1, '2025-04-13 23:34:07', '2025-06-06 20:53:23'),
(7, '<h2 style=\"text-align:center\"><strong>Tặng miễn ph&iacute; bộ từ vựng TOEIC th&ocirc;ng dụng chủ đề Manufacturing</strong></h2>', '<p>Giới thiệu bộ từ vựng MANUFACTURING:</p>\r\n\r\n<p><img alt=\"\" src=\"https://han01.vstorage.vngcloud.vn/v1/AUTH_6831ce3c90cd4f47a8ca18d6545cddf9/public/Default/Media/Images/347cc196-cf8b-4b4c-a80e-64bb2c77c47f/default_image_347cc196-cf8b-4b4c-a80e-64bb2c77c47f_screenshot_84_1692086732826.png\" style=\"height:300px; width:427px\" /></p>\r\n\r\n<p>Từ vựng chủ đề Manufaturing l&agrave; một trong những bộ từ vựng được nhiều sĩ tử &ocirc;n thi TOEIC quan t&acirc;m v&igrave; chủ đề n&agrave;y kh&ocirc;ng chỉ thường xuy&ecirc;n xuất hiện trong b&agrave;i thi TOEIC m&agrave; c&ograve;n trong giao tiếp h&agrave;ng ng&agrave;y.&nbsp;</p>\r\n\r\n<p>Nhận thấy tầm quan trọng của bộ từ vựng đối với c&aacute;c sĩ tử, IIG Việt Nam đ&atilde; d&agrave;nh rất nhi&ecirc;u t&acirc;m huyết tổng hợp 50 từ vựng thuộc chủ đề n&agrave;y k&egrave;m theo hướng dẫn ph&aacute;t &acirc;m, giải nghĩa v&agrave; hỉnh ảnh minh họa cho từng từ.</p>\r\n\r\n<p>Ngo&agrave;i ra, ch&uacute;ng m&igrave;nh cũng bổ sung th&ecirc;m c&aacute;c dạng b&agrave;i tập bổ trợ hay những th&ocirc;ng tin hữu &iacute;ch li&ecirc;n quan đến từ vựng để c&aacute;c bạn c&oacute; thể &ocirc;n luyện hiệu quả cũng như dễ d&agrave;ng &aacute;p dụng trong giao tiếp h&agrave;ng ng&agrave;y.</p>\r\n\r\n<p><strong>Nhắc nhỏ:</strong></p>\r\n\r\n<p>Ngo&agrave;i bộ từ vựng chủ đề Manufacturing c&ograve;n c&oacute; những bộ t&agrave;i liệu chất lượng kh&aacute;c đang đ&oacute;n chờ c&aacute;c bạn sở hữu. Ch&uacute;ng m&igrave;nh sẽ li&ecirc;n tục cập nhật th&ocirc;ng b&aacute;o tr&ecirc;n&nbsp;<strong>website</strong>&nbsp;n&ecirc;n c&aacute;c bạn h&atilde;y nhanh tay đăng k&yacute; t&agrave;i khoản v&agrave; thường xuy&ecirc;n theo d&otilde;i nh&eacute;!&nbsp;</p>\r\n\r\n<p>Hy vọng với bộ tự vựng n&agrave;y sẽ gi&uacute;p c&aacute;c bạn dễ d&agrave;ng hơn trong việc chinh phục&nbsp;<strong>b&agrave;i thi TOEIC</strong>&nbsp;cũng như ứng dụng trong c&ocirc;ng việc v&agrave; cu&ocirc;c sống.&nbsp;</p>\r\n\r\n<p>Tr&acirc;n trọng!&nbsp;</p>', 'uploads/posts/1744612803.jpg', 1, '2025-04-13 23:40:03', '2025-06-06 20:50:54'),
(8, '<h1 style=\"text-align:center\">KH&Oacute;A H&Egrave; MỘT NG&Agrave;Y - VUI M&Ecirc; SAY - ĐĂNG K&Yacute; NGAY!</h1>', '<p>ND</p>', 'uploads/posts/1748942666.jpeg', 1, '2025-06-03 02:24:26', '2025-06-06 20:53:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_text` text NOT NULL,
  `question_type` enum('single','multiple') NOT NULL,
  `difficulty` varchar(10) NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `question_type`, `difficulty`, `chapter_id`, `created_at`, `updated_at`) VALUES
(2, '<p>Đ&acirc;y l&agrave; th&agrave;nh phố n&agrave;o?</p>', 'single', 'easy', 1, '2025-03-28 10:24:51', '2025-03-28 10:24:51'),
(3, '<p>Who is this?</p>', 'single', 'easy', 1, '2025-03-28 19:58:16', '2025-03-31 05:04:37'),
(4, '<p>What time is it?</p>', 'single', 'easy', 1, '2025-03-31 03:35:39', '2025-03-31 03:35:39'),
(6, '<p>vnhgvmgmg</p>', 'multiple', 'easy', 1, '2025-04-08 01:45:17', '2025-04-08 02:04:16'),
(7, '<p>gfcgbfyjf</p>', 'single', 'hard', 1, '2025-04-08 01:45:35', '2025-04-08 02:05:17'),
(8, '<p>1+1=?</p>', 'single', 'hard', 1, '2025-04-13 05:30:57', '2025-04-13 05:30:57'),
(9, '<p>5+5=?</p>', 'single', 'hard', 1, '2025-04-13 05:44:56', '2025-04-13 05:44:56'),
(10, '<p>7+8=?</p>', 'single', 'hard', 1, '2025-05-21 13:57:04', '2025-05-21 13:57:04'),
(11, '<p>10+10=?</p>', 'single', 'easy', 1, '2025-05-21 16:29:04', '2025-05-21 16:29:04'),
(12, '<p>11*11=?</p>', 'single', 'hard', 1, '2025-05-21 16:29:51', '2025-05-21 16:29:51'),
(13, '<p>1+1=?</p>', 'single', 'easy', 2, '2025-05-21 21:05:32', '2025-05-21 21:05:32'),
(14, '<p>2+3=?</p>', 'single', 'easy', 2, '2025-05-21 21:05:58', '2025-05-21 21:05:58'),
(15, '<p>9+9=?</p>', 'single', 'easy', 2, '2025-05-21 21:06:39', '2025-05-21 21:06:39'),
(16, '<p>a+a=?</p>', 'single', 'hard', 2, '2025-05-21 21:07:20', '2025-05-21 21:07:20'),
(17, '<p>a+b=?</p>', 'single', 'hard', 2, '2025-05-21 21:07:53', '2025-05-21 21:07:53'),
(18, '<p>100-10=?</p>', 'single', 'hard', 2, '2025-05-21 21:08:42', '2025-05-21 21:08:42'),
(19, '<p>15-5=?</p>', 'single', 'easy', 2, '2025-05-21 21:09:20', '2025-05-21 21:09:20'),
(20, '<p>What time is it?</p>', 'single', 'hard', 7, '2025-05-22 20:05:47', '2025-05-22 20:05:47'),
(21, '<p>7+9=?</p>', 'single', 'easy', 7, '2025-05-22 20:06:23', '2025-05-22 20:06:23'),
(22, '<p>What are you doing?</p>', 'single', 'hard', 7, '2025-05-22 20:07:57', '2025-05-22 20:07:57'),
(23, '<p>What&#39;s your name</p>', 'single', 'easy', 7, '2025-05-22 20:08:37', '2025-05-22 20:08:37'),
(24, '<p>Why don&#39;t you go?</p>', 'single', 'easy', 7, '2025-05-22 20:10:54', '2025-05-22 20:10:54'),
(25, '<p>I &mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash; at a bank.</p>', 'single', 'easy', 7, '2025-05-22 20:15:03', '2025-05-22 20:15:03'),
(26, '<p>She &mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&ndash; with her parents.</p>', 'single', 'hard', 7, '2025-05-22 20:16:15', '2025-05-22 20:16:15'),
(27, '<p>Cows &mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&ndash; on grass.</p>', 'single', 'hard', 7, '2025-05-22 20:18:36', '2025-05-22 20:18:36'),
(28, '<p>He &mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;- a handsome salary.</p>', 'single', 'easy', 7, '2025-05-22 20:20:33', '2025-05-22 20:20:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', NULL, NULL),
(2, 'manager', 'Quản lý', NULL, NULL),
(3, 'teacher', 'Giáo viên', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `order_number` tinyint(4) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `description`, `order_number`, `image`, `created_at`, `updated_at`) VALUES
(1, '<h1>Học để toả s&aacute;ng - Sống để toả s&aacute;ng</h1>\r\n\r\n<p>Ph&aacute;t triển kỹ năng v&agrave; mở ra cơ hội mới</p>', 2, 'uploads/sliders/1743263431.jpeg', '2025-03-25 18:26:24', '2025-04-14 05:42:21'),
(3, '<h1>Hương Sen Việt Education</h1>\r\n\r\n<p>Chắp c&aacute;nh tri thức - Vươn tới th&agrave;nh c&ocirc;ng</p>', 1, 'uploads/sliders/1743263449.png', '2025-03-26 02:13:59', '2025-04-14 05:40:14'),
(4, '<h1>V&igrave; sao n&ecirc;n chọn ch&uacute;ng t&ocirc;i</h1>\r\n\r\n<p>Phương ch&acirc;m gi&aacute;o dục to&agrave;n diện &quot;T&acirc;m - Nh&acirc;n - Tr&iacute;&quot;</p>', 3, 'uploads/sliders/1743263463.jpeg', '2025-03-26 02:15:10', '2025-04-14 05:42:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phone`, `password`, `address`, `gender`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Đào Thị Bình', 'daothibinh2k3@gmail.com', '0999999998', '$2y$12$vN8yscyTcuJQA7Md.TpFguKRyvjKN8wcsJu0kAw53EAgEwEbGKjR2', 'Hòa Bình', 0, '2025-04-28 17:00:00', NULL, '2025-04-28 18:38:36', '2025-05-22 05:09:47'),
(4, 'Nguyễn Vân Anh', 'binh92472@st.vimaru.edu.vn', '0987988173', '$2y$12$XYhYFUbEjgay0bC7tTtSVuX8S/Tg8CrL6YhOpdOZ/dj5sg9Sh6ME2', 'Bắc Ninh', 0, '2025-06-05 17:00:00', NULL, '2025-06-05 18:44:44', '2025-06-05 18:45:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_answers`
--

CREATE TABLE `student_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_answers`
--

INSERT INTO `student_answers` (`id`, `student_exam_id`, `question_id`, `answer_id`, `created_at`, `updated_at`) VALUES
(35, 19, 3, 9, '2025-05-21 23:55:10', '2025-05-21 23:55:10'),
(36, 19, 6, 24, '2025-05-21 23:55:10', '2025-05-21 23:55:10'),
(37, 19, 10, 40, '2025-05-21 23:55:10', '2025-05-21 23:55:10'),
(38, 19, 11, 42, '2025-05-21 23:55:10', '2025-05-21 23:55:10'),
(39, 19, 12, 45, '2025-05-21 23:55:10', '2025-05-21 23:55:10'),
(40, 20, 10, 40, '2025-05-22 00:12:08', '2025-05-22 00:12:08'),
(41, 20, 2, 6, '2025-05-22 00:12:08', '2025-05-22 00:12:08'),
(42, 20, 6, 22, '2025-05-22 00:12:08', '2025-05-22 00:12:08'),
(43, 20, 8, 29, '2025-05-22 00:12:08', '2025-05-22 00:12:08'),
(44, 21, 2, 6, '2025-05-22 20:02:53', '2025-05-22 20:02:53'),
(45, 21, 3, 11, '2025-05-22 20:02:53', '2025-05-22 20:02:53'),
(46, 21, 6, 21, '2025-05-22 20:02:53', '2025-05-22 20:02:53'),
(47, 21, 6, 22, '2025-05-22 20:02:53', '2025-05-22 20:02:53'),
(48, 21, 7, 28, '2025-05-22 20:02:53', '2025-05-22 20:02:53'),
(49, 21, 9, 33, '2025-05-22 20:02:53', '2025-05-22 20:02:53'),
(50, 21, 11, 42, '2025-05-22 20:02:53', '2025-05-22 20:02:53'),
(51, 22, 21, 81, '2025-06-02 20:26:25', '2025-06-02 20:26:25'),
(52, 22, 22, 86, '2025-06-02 20:26:25', '2025-06-02 20:26:25'),
(53, 22, 24, 94, '2025-06-02 20:26:25', '2025-06-02 20:26:25'),
(54, 22, 26, 101, '2025-06-02 20:26:25', '2025-06-02 20:26:25'),
(55, 22, 27, 105, '2025-06-02 20:26:25', '2025-06-02 20:26:25'),
(56, 22, 28, 110, '2025-06-02 20:26:25', '2025-06-02 20:26:25'),
(57, 23, 3, 10, '2025-06-06 02:30:23', '2025-06-06 02:30:23'),
(58, 23, 6, 23, '2025-06-06 02:30:23', '2025-06-06 02:30:23'),
(59, 23, 6, 24, '2025-06-06 02:30:23', '2025-06-06 02:30:23'),
(60, 23, 7, 28, '2025-06-06 02:30:23', '2025-06-06 02:30:23'),
(61, 23, 9, 33, '2025-06-06 02:30:23', '2025-06-06 02:30:23'),
(62, 23, 11, 42, '2025-06-06 02:30:23', '2025-06-06 02:30:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_exams`
--

CREATE TABLE `student_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `score` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_exams`
--

INSERT INTO `student_exams` (`id`, `student_id`, `exam_id`, `start_time`, `end_time`, `submitted_at`, `status`, `score`, `created_at`, `updated_at`) VALUES
(19, 2, 1, '2025-05-22 06:54:18', '2025-05-22 06:56:18', '2025-05-22 06:55:10', 'done', 8.00, '2025-05-21 23:54:18', '2025-05-21 23:55:10'),
(20, 2, 1, '2025-05-22 07:09:38', '2025-05-22 07:11:38', '2025-05-22 07:12:08', 'done', 6.00, '2025-05-22 00:09:38', '2025-05-22 00:12:08'),
(21, 2, 4, '2025-05-23 03:01:25', '2025-05-23 04:01:25', '2025-05-23 03:02:53', 'done', 8.33, '2025-05-22 20:01:25', '2025-05-22 20:02:53'),
(22, 2, 7, '2025-06-03 03:25:43', '2025-06-03 03:45:43', '2025-06-03 03:26:25', 'done', 6.67, '2025-06-02 20:25:43', '2025-06-02 20:26:25'),
(23, 2, 1, '2025-06-06 09:28:19', '2025-06-06 09:38:19', '2025-06-06 09:30:23', 'done', 6.00, '2025-06-06 02:28:19', '2025-06-06 02:30:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_exam_question`
--

CREATE TABLE `student_exam_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_exam_question`
--

INSERT INTO `student_exam_question` (`id`, `student_exam_id`, `question_id`, `created_at`, `updated_at`) VALUES
(17, 19, 12, '2025-05-21 23:54:18', '2025-05-21 23:54:18'),
(18, 19, 3, '2025-05-21 23:54:18', '2025-05-21 23:54:18'),
(19, 19, 11, '2025-05-21 23:54:18', '2025-05-21 23:54:18'),
(20, 19, 6, '2025-05-21 23:54:18', '2025-05-21 23:54:18'),
(21, 19, 10, '2025-05-21 23:54:18', '2025-05-21 23:54:18'),
(22, 20, 3, '2025-05-22 00:09:38', '2025-05-22 00:09:38'),
(23, 20, 10, '2025-05-22 00:09:38', '2025-05-22 00:09:38'),
(24, 20, 2, '2025-05-22 00:09:38', '2025-05-22 00:09:38'),
(25, 20, 8, '2025-05-22 00:09:38', '2025-05-22 00:09:38'),
(26, 20, 6, '2025-05-22 00:09:38', '2025-05-22 00:09:38'),
(27, 21, 7, '2025-05-22 20:01:25', '2025-05-22 20:01:25'),
(28, 21, 9, '2025-05-22 20:01:25', '2025-05-22 20:01:25'),
(29, 21, 6, '2025-05-22 20:01:25', '2025-05-22 20:01:25'),
(30, 21, 2, '2025-05-22 20:01:25', '2025-05-22 20:01:25'),
(31, 21, 3, '2025-05-22 20:01:25', '2025-05-22 20:01:25'),
(32, 21, 11, '2025-05-22 20:01:25', '2025-05-22 20:01:25'),
(33, 22, 27, '2025-06-02 20:25:43', '2025-06-02 20:25:43'),
(34, 22, 21, '2025-06-02 20:25:43', '2025-06-02 20:25:43'),
(35, 22, 26, '2025-06-02 20:25:43', '2025-06-02 20:25:43'),
(36, 22, 22, '2025-06-02 20:25:43', '2025-06-02 20:25:43'),
(37, 22, 28, '2025-06-02 20:25:43', '2025-06-02 20:25:43'),
(38, 22, 24, '2025-06-02 20:25:43', '2025-06-02 20:25:43'),
(39, 23, 3, '2025-06-06 02:28:19', '2025-06-06 02:28:19'),
(40, 23, 6, '2025-06-06 02:28:19', '2025-06-06 02:28:19'),
(41, 23, 7, '2025-06-06 02:28:19', '2025-06-06 02:28:19'),
(42, 23, 11, '2025-06-06 02:28:19', '2025-06-06 02:28:19'),
(43, 23, 9, '2025-06-06 02:28:19', '2025-06-06 02:28:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_reset_tokens`
--

CREATE TABLE `student_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_reset_tokens`
--

INSERT INTO `student_reset_tokens` (`email`, `token`, `created_at`, `updated_at`) VALUES
('daothibinh2k3@gmail.com', 'bdIeubWFE81Kuy0KL4SAojCQdAscoeMqu8e80432NyVG5MiGqj', '2025-05-22 05:08:20', '2025-05-22 05:09:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_temp_answers`
--

CREATE TABLE `student_temp_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`answer_ids`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_temp_answers`
--

INSERT INTO `student_temp_answers` (`id`, `student_exam_id`, `question_id`, `answer_ids`, `created_at`, `updated_at`) VALUES
(11, 19, 3, '[\"9\"]', '2025-05-21 23:55:00', '2025-05-21 23:55:00'),
(12, 19, 6, '[\"24\"]', '2025-05-21 23:55:00', '2025-05-21 23:55:00'),
(13, 19, 10, '[\"40\"]', '2025-05-21 23:55:00', '2025-05-21 23:55:00'),
(14, 19, 11, '[\"42\"]', '2025-05-21 23:55:00', '2025-05-21 23:55:00'),
(15, 19, 12, '[\"45\"]', '2025-05-21 23:55:00', '2025-05-21 23:55:00'),
(20, 21, 7, '[\"28\"]', '2025-05-22 20:01:40', '2025-05-22 20:01:40'),
(21, 21, 6, '[\"21\",\"22\"]', '2025-05-22 20:02:06', '2025-05-22 20:02:52'),
(22, 21, 9, '[\"33\"]', '2025-05-22 20:02:06', '2025-05-22 20:02:06'),
(23, 21, 2, '[\"6\"]', '2025-05-22 20:02:20', '2025-05-22 20:02:35'),
(24, 21, 3, '[\"11\"]', '2025-05-22 20:02:25', '2025-05-22 20:02:25'),
(25, 21, 11, '[\"42\"]', '2025-05-22 20:02:25', '2025-05-22 20:02:25'),
(26, 22, 27, '[\"105\"]', '2025-06-02 20:25:53', '2025-06-02 20:25:53'),
(27, 22, 21, '[\"81\"]', '2025-06-02 20:25:58', '2025-06-02 20:25:58'),
(28, 22, 26, '[\"101\"]', '2025-06-02 20:26:08', '2025-06-02 20:26:08'),
(29, 22, 22, '[\"86\"]', '2025-06-02 20:26:13', '2025-06-02 20:26:13'),
(30, 22, 28, '[\"110\"]', '2025-06-02 20:26:18', '2025-06-02 20:26:18'),
(31, 22, 24, '[\"94\"]', '2025-06-02 20:26:23', '2025-06-02 20:26:23'),
(32, 23, 3, '[\"10\"]', '2025-06-06 02:28:25', '2025-06-06 02:28:30'),
(33, 23, 6, '[\"23\",\"24\"]', '2025-06-06 02:28:30', '2025-06-06 02:28:35'),
(34, 23, 7, '[\"28\"]', '2025-06-06 02:30:15', '2025-06-06 02:30:15'),
(35, 23, 11, '[\"42\"]', '2025-06-06 02:30:15', '2025-06-06 02:30:15'),
(36, 23, 9, '[\"33\"]', '2025-06-06 02:30:20', '2025-06-06 02:30:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `slug`, `description`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Toán', 'toan', 'Đây là môn Toán', 'uploads/subject/1744590731.png', '2025-03-20 20:27:45', '2025-05-30 03:34:56'),
(4, 'Tiếng Anh', 'tieng-anh', 'Đây là môn Tiếng Anh', 'uploads/subject/1744590752.png', '2025-03-20 20:27:52', '2025-05-30 03:35:10'),
(5, 'Hóa Học', 'hoa-hoc', 'Đây là môn Hóa Học', 'uploads/subject/1744590783.png', '2025-03-20 22:30:35', '2025-05-30 03:36:02'),
(6, 'Sinh Học', 'sinh-hoc', 'Đây là môn Sinh Học', 'uploads/subject/1744590807.png', '2025-03-21 01:52:45', '2025-05-30 03:36:11'),
(7, 'Vật Lí', 'vat-li', 'Đây là môn Vật Lí', 'uploads/subject/1744590819.png', '2025-03-21 02:50:58', '2025-05-30 03:36:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'daothibinh2k3@gmail.com', '0999999999', NULL, '$2y$12$DgE./0yDilWb.y5UZNe7y.reTRtu.OMi794/IJtCWSWS9XxO5NLpa', 1, NULL, NULL, '2025-06-01 10:59:22'),
(3, 'Nguyễn Vân Anh', 'anh2000@gmail.com', '0989888888', NULL, '$2y$12$uwp.SopFIp3wAcM.bNfxt.97GRnHVU.18GuDFqbfeg23PFcNWHSjq', 3, NULL, '2025-04-12 01:16:10', '2025-04-14 05:00:45'),
(4, 'Nguyễn Thị Hiền', 'hien@gmail.com', '0989888889', NULL, '$2y$12$zDErtEA0y0OmkPcbb.67iubNhx7b7r4jqDfyrxDubGSSzYAmt0d8S', 3, NULL, '2025-04-12 19:01:32', '2025-04-12 19:01:32'),
(6, 'Nguyễn Nhung', 'nhung@gmail.com', '0987987999', NULL, '$2y$12$6763TbUH3BmefdgXz2cOduqmEnI0EFAU8pyqVGDI0KTEu2OrBONXW', 3, NULL, '2025-04-14 05:28:07', '2025-04-14 05:28:07'),
(7, 'Nguyễn Thị Mai', 'mai@gmail.com', '0989789999', NULL, '$2y$12$na35bOP3pco4dJrMB24CyeOV40pUJi3NMASyTdEyOuTWNT77S0zta', 2, NULL, '2025-06-01 11:27:07', '2025-06-01 11:27:07'),
(8, 'Nguyễn Thị Linh', 'linh@gmail.com', '0178978999', NULL, '$2y$12$nWoaDkPco.QiF4b/VXFtyO6vDuA36KKCA0kCkwOp0uRyc7R1bNNYO', 3, NULL, '2025-06-04 17:44:28', '2025-06-04 17:44:28');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_student_id_foreign` (`student_id`);

--
-- Chỉ mục cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_details_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_details_course_id_foreign` (`course_id`);

--
-- Chỉ mục cho bảng `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapters_course_id_foreign` (`course_id`);

--
-- Chỉ mục cho bảng `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `courses_subject_id_foreign` (`subject_id`),
  ADD KEY `courses_teacher_id_foreign` (`teacher_id`);

--
-- Chỉ mục cho bảng `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_student_id_foreign` (`student_id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`),
  ADD KEY `enrollments_payment_id_foreign` (`payment_id`);

--
-- Chỉ mục cho bảng `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_chapter_id_foreign` (`chapter_id`);

--
-- Chỉ mục cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedbacks_student_id_foreign` (`student_id`),
  ADD KEY `feedbacks_course_id_foreign` (`course_id`);

--
-- Chỉ mục cho bảng `infors`
--
ALTER TABLE `infors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`),
  ADD KEY `lessons_chapter_id_foreign` (`chapter_id`);

--
-- Chỉ mục cho bảng `lesson_progress`
--
ALTER TABLE `lesson_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_progress_student_id_foreign` (`student_id`),
  ADD KEY `lesson_progress_lesson_id_foreign` (`lesson_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_student_id_foreign` (`student_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_chapter_id_foreign` (`chapter_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `students_phone_unique` (`phone`);

--
-- Chỉ mục cho bảng `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_answers_question_id_foreign` (`question_id`),
  ADD KEY `student_answers_answer_id_foreign` (`answer_id`),
  ADD KEY `student_answers_student_exam_id_foreign` (`student_exam_id`);

--
-- Chỉ mục cho bảng `student_exams`
--
ALTER TABLE `student_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_exams_student_id_foreign` (`student_id`),
  ADD KEY `student_exams_exam_id_foreign` (`exam_id`);

--
-- Chỉ mục cho bảng `student_exam_question`
--
ALTER TABLE `student_exam_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_exam_question_student_exam_id_foreign` (`student_exam_id`),
  ADD KEY `student_exam_question_question_id_foreign` (`question_id`);

--
-- Chỉ mục cho bảng `student_reset_tokens`
--
ALTER TABLE `student_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `student_temp_answers`
--
ALTER TABLE `student_temp_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_temp_answers_student_exam_id_question_id_unique` (`student_exam_id`,`question_id`),
  ADD KEY `student_temp_answers_question_id_foreign` (`question_id`);

--
-- Chỉ mục cho bảng `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_name_unique` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `infors`
--
ALTER TABLE `infors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `lesson_progress`
--
ALTER TABLE `lesson_progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `student_exams`
--
ALTER TABLE `student_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `student_exam_question`
--
ALTER TABLE `student_exam_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `student_temp_answers`
--
ALTER TABLE `student_temp_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Các ràng buộc cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_details_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Các ràng buộc cho bảng `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `courses_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `enrollments_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `enrollments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Các ràng buộc cho bảng `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `feedbacks_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Các ràng buộc cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Các ràng buộc cho bảng `lesson_progress`
--
ALTER TABLE `lesson_progress`
  ADD CONSTRAINT `lesson_progress_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_progress_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Các ràng buộc cho bảng `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `student_answers`
--
ALTER TABLE `student_answers`
  ADD CONSTRAINT `student_answers_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_answers_student_exam_id_foreign` FOREIGN KEY (`student_exam_id`) REFERENCES `student_exams` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `student_exams`
--
ALTER TABLE `student_exams`
  ADD CONSTRAINT `student_exams_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`),
  ADD CONSTRAINT `student_exams_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Các ràng buộc cho bảng `student_exam_question`
--
ALTER TABLE `student_exam_question`
  ADD CONSTRAINT `student_exam_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_exam_question_student_exam_id_foreign` FOREIGN KEY (`student_exam_id`) REFERENCES `student_exams` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `student_temp_answers`
--
ALTER TABLE `student_temp_answers`
  ADD CONSTRAINT `student_temp_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_temp_answers_student_exam_id_foreign` FOREIGN KEY (`student_exam_id`) REFERENCES `student_exams` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
