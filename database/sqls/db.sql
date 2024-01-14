-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-01-14 15:25:59
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `linelaravel`
--
CREATE DATABASE IF NOT EXISTS `linelaravel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `linelaravel`;

-- --------------------------------------------------------

--
-- テーブルの構造 `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
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
-- テーブルの構造 `genders`
--

DROP TABLE IF EXISTS `genders`;
CREATE TABLE `genders` (
  `id` int(1) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `genders`
--

INSERT INTO `genders` (`id`, `name`) VALUES
(1, '男性'),
(2, '女性');

-- --------------------------------------------------------

--
-- テーブルの構造 `liff_page_types`
--

DROP TABLE IF EXISTS `liff_page_types`;
CREATE TABLE `liff_page_types` (
  `id` int(2) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `liff_page_types`
--

INSERT INTO `liff_page_types` (`id`, `name`) VALUES
(1, 'ユーザー登録');

-- --------------------------------------------------------

--
-- テーブルの構造 `lines`
--

DROP TABLE IF EXISTS `lines`;
CREATE TABLE `lines` (
  `id` bigint(20) NOT NULL,
  `account_id` varchar(100) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `picture_url` varchar(200) DEFAULT NULL,
  `line_account_type_id` int(1) NOT NULL DEFAULT 0,
  `line_account_status_id` int(1) NOT NULL DEFAULT 0,
  `service_provider_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `notice_setting` tinyint(1) NOT NULL DEFAULT 1,
  `notice_user_setting` tinyint(1) NOT NULL DEFAULT 0,
  `line_of_user_notice` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `lines`
--

INSERT INTO `lines` (`id`, `account_id`, `display_name`, `picture_url`, `line_account_type_id`, `line_account_status_id`, `service_provider_id`, `user_id`, `notice_setting`, `notice_user_setting`, `line_of_user_notice`, `created_at`, `updated_at`) VALUES
(1, 'Ub04e5a8165a0f8bd9c14f1ff28b664ea', '南優毅', 'https://sprofile.line-scdn.net/0hxl9re16mJ0MUCwgJ9g1ZPGRbJCk3en5Ram87InUPe3EpM2UUb2Q6dXMMfnJ-aWhFPGo6IHELfyAYGFAlCl3bdxM7enIoO2YTOmVsog', 1, 1, NULL, NULL, 1, 0, 0, '2024-01-08 08:09:39', '2024-01-08 14:10:15');

-- --------------------------------------------------------

--
-- テーブルの構造 `line_account_statuses`
--

DROP TABLE IF EXISTS `line_account_statuses`;
CREATE TABLE `line_account_statuses` (
  `id` int(1) NOT NULL,
  `name` varchar(10) NOT NULL,
  `line_account_type_id` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `line_account_statuses`
--

INSERT INTO `line_account_statuses` (`id`, `name`, `line_account_type_id`) VALUES
(1, '友達', 1),
(2, 'ブロック', 1),
(3, '参加中', 2),
(4, '退出中', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `line_account_types`
--

DROP TABLE IF EXISTS `line_account_types`;
CREATE TABLE `line_account_types` (
  `id` int(1) NOT NULL,
  `name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `line_account_types`
--

INSERT INTO `line_account_types` (`id`, `name`) VALUES
(1, '１対１'),
(2, 'グループ');

-- --------------------------------------------------------

--
-- テーブルの構造 `line_messages`
--

DROP TABLE IF EXISTS `line_messages`;
CREATE TABLE `line_messages` (
  `id` bigint(20) NOT NULL,
  `line_message_type_id` int(2) NOT NULL DEFAULT 0,
  `message_id` varchar(100) NOT NULL,
  `quote_token` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `line_message_images`
--

DROP TABLE IF EXISTS `line_message_images`;
CREATE TABLE `line_message_images` (
  `id` bigint(20) NOT NULL,
  `line_message_id` bigint(20) NOT NULL,
  `content_provider_type` varchar(20) NOT NULL,
  `content_provider_original_content_url` varchar(1000) DEFAULT NULL,
  `content_provider_preview_image_url` varchar(1000) DEFAULT NULL,
  `image_set_id` varchar(1000) DEFAULT NULL,
  `image_set_index` int(3) DEFAULT NULL,
  `image_set_total` int(3) DEFAULT NULL,
  `file_path` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `line_message_texts`
--

DROP TABLE IF EXISTS `line_message_texts`;
CREATE TABLE `line_message_texts` (
  `id` bigint(20) NOT NULL,
  `line_message_id` bigint(20) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `line_message_types`
--

DROP TABLE IF EXISTS `line_message_types`;
CREATE TABLE `line_message_types` (
  `id` bigint(20) NOT NULL,
  `name` varchar(10) NOT NULL,
  `display_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `line_message_types`
--

INSERT INTO `line_message_types` (`id`, `name`, `display_name`) VALUES
(1, 'text', 'テキスト'),
(2, 'image', '画像');

-- --------------------------------------------------------

--
-- テーブルの構造 `line_notices`
--

DROP TABLE IF EXISTS `line_notices`;
CREATE TABLE `line_notices` (
  `id` bigint(20) NOT NULL,
  `notice_date_time` datetime NOT NULL,
  `line_notice_type_id` int(2) NOT NULL,
  `line_id` bigint(20) NOT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `line_message_id` bigint(20) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `line_notices`
--

INSERT INTO `line_notices` (`id`, `notice_date_time`, `line_notice_type_id`, `line_id`, `content`, `line_message_id`, `created_at`, `updated_at`) VALUES
(1, '2024-01-08 17:09:38', 3, 1, '公式LINEが友達に追加されました', 0, '2024-01-08 08:09:39', '2024-01-08 08:09:39'),
(2, '2024-01-08 17:10:55', 4, 1, '公式LINEがブロックされました', 0, '2024-01-08 08:10:56', '2024-01-08 08:10:56'),
(3, '2024-01-08 17:12:04', 3, 1, '公式LINEが友達に追加されました', 0, '2024-01-08 08:12:04', '2024-01-08 08:12:04'),
(4, '2024-01-08 23:10:09', 4, 1, '公式LINEがブロックされました', 0, '2024-01-08 14:10:09', '2024-01-08 14:10:09'),
(5, '2024-01-08 23:10:14', 3, 1, '公式LINEが友達に追加されました', 0, '2024-01-08 14:10:15', '2024-01-08 14:10:15');

-- --------------------------------------------------------

--
-- テーブルの構造 `line_notice_settings`
--

DROP TABLE IF EXISTS `line_notice_settings`;
CREATE TABLE `line_notice_settings` (
  `id` bigint(20) NOT NULL,
  `line_id` bigint(20) NOT NULL,
  `line_notice_type_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `line_notice_types`
--

DROP TABLE IF EXISTS `line_notice_types`;
CREATE TABLE `line_notice_types` (
  `id` int(2) NOT NULL,
  `type` varchar(20) NOT NULL,
  `origin` varchar(20) NOT NULL,
  `display_name` varchar(20) NOT NULL,
  `content` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `line_notice_types`
--

INSERT INTO `line_notice_types` (`id`, `type`, `origin`, `display_name`, `content`) VALUES
(1, 'message', 'webhook', 'メッセージ', 'メッセージを受信しました'),
(2, 'unsend', 'webhook', '送信取消', 'メッセージの送信が取りされました'),
(3, 'follow', 'webhook', '友達追加', '公式LINEが友達に追加されました'),
(4, 'unfollow', 'webhook', 'ブロック', '公式LINEがブロックされました'),
(5, 'join', 'webhook', 'グループ参加', '公式LINEがグループに参加しました'),
(6, 'leave', 'webhook', 'グループ退出', '公式LINEがグループから退出しました'),
(7, 'memberJoined', 'webhook', 'メンバー参加', 'グループにメンバーが参加しました'),
(8, 'memberLeft', 'webhook', 'メンバー退出', 'グループからメンバーが退出しました'),
(9, 'postback', 'webhook', 'ポストバック', 'ポストバック'),
(10, 'videoPlayComplete', 'webhook', '動画視聴完了', '動画視聴が完了しました');

-- --------------------------------------------------------

--
-- テーブルの構造 `line_notice_user_settings`
--

DROP TABLE IF EXISTS `line_notice_user_settings`;
CREATE TABLE `line_notice_user_settings` (
  `id` bigint(20) NOT NULL,
  `line_id` bigint(20) NOT NULL,
  `line_notice_type_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `line_of_user_notice_settings`
--

DROP TABLE IF EXISTS `line_of_user_notice_settings`;
CREATE TABLE `line_of_user_notice_settings` (
  `id` bigint(20) NOT NULL,
  `line_id` bigint(20) NOT NULL,
  `line_notice_type_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `line_of_user_notice_settings`
--

INSERT INTO `line_of_user_notice_settings` (`id`, `line_id`, `line_notice_type_id`) VALUES
(5, 570, 1),
(6, 570, 3),
(21, 566, 1),
(23, 681, 1),
(24, 681, 2),
(25, 943, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `line_send_messages`
--

DROP TABLE IF EXISTS `line_send_messages`;
CREATE TABLE `line_send_messages` (
  `id` bigint(20) NOT NULL,
  `send_date_time` datetime(3) NOT NULL DEFAULT current_timestamp(3) ON UPDATE current_timestamp(3),
  `line_send_message_origin_id` int(2) NOT NULL DEFAULT 0,
  `line_send_message_type_id` int(2) NOT NULL DEFAULT 0,
  `line_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `line_send_messages`
--

INSERT INTO `line_send_messages` (`id`, `send_date_time`, `line_send_message_origin_id`, `line_send_message_type_id`, `line_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2024-01-08 17:09:39.424', 1, 1, 1, 0, '2024-01-08 08:09:39', '2024-01-08 08:09:39'),
(2, '2024-01-08 17:12:04.465', 1, 1, 1, 0, '2024-01-08 08:12:04', '2024-01-08 08:12:04'),
(3, '2024-01-08 23:10:15.143', 1, 1, 1, 0, '2024-01-08 14:10:15', '2024-01-08 14:10:15');

-- --------------------------------------------------------

--
-- テーブルの構造 `line_send_message_origins`
--

DROP TABLE IF EXISTS `line_send_message_origins`;
CREATE TABLE `line_send_message_origins` (
  `id` int(2) NOT NULL,
  `name` varchar(10) NOT NULL,
  `display_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `line_send_message_origins`
--

INSERT INTO `line_send_message_origins` (`id`, `name`, `display_name`) VALUES
(1, 'reply', 'リプライメッセージ'),
(2, 'push', 'プッシュメッセージ');

-- --------------------------------------------------------

--
-- テーブルの構造 `line_send_message_texts`
--

DROP TABLE IF EXISTS `line_send_message_texts`;
CREATE TABLE `line_send_message_texts` (
  `id` bigint(20) NOT NULL,
  `line_send_message_id` bigint(20) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `line_send_message_texts`
--

INSERT INTO `line_send_message_texts` (`id`, `line_send_message_id`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 'はじめまして南優毅さん！\n友達追加ありがとうございます！', '2024-01-08 08:09:39', '2024-01-08 08:09:39'),
(2, 2, 'はじめまして南優毅さん！\n友達追加ありがとうございます！', '2024-01-08 08:12:04', '2024-01-08 08:12:04'),
(3, 3, 'はじめまして南優毅さん！\n友達追加ありがとうございます！\n下記のURLよりサービス提供者を設定してください\nhttps://liff.line.me/2001775635-q8poQ0Bv', '2024-01-08 14:10:15', '2024-01-08 14:10:15');

-- --------------------------------------------------------

--
-- テーブルの構造 `line_send_message_types`
--

DROP TABLE IF EXISTS `line_send_message_types`;
CREATE TABLE `line_send_message_types` (
  `id` int(2) NOT NULL,
  `name` varchar(15) NOT NULL,
  `display_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `line_send_message_types`
--

INSERT INTO `line_send_message_types` (`id`, `name`, `display_name`) VALUES
(1, 'text', 'テキスト');

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `line_talk_histories`
-- (実際のビューを参照するには下にあります)
--
DROP VIEW IF EXISTS `line_talk_histories`;
CREATE TABLE `line_talk_histories` (
`from_to` varchar(4)
,`line_id` bigint(20)
,`date_time` datetime(3)
,`sender` varchar(255)
,`type_id` int(11)
,`type_name` varchar(20)
,`line_message_id` bigint(20)
,`line_send_message_id` bigint(20)
);

-- --------------------------------------------------------

--
-- テーブルの構造 `line_users`
--

DROP TABLE IF EXISTS `line_users`;
CREATE TABLE `line_users` (
  `id` bigint(20) NOT NULL,
  `line_id` bigint(20) NOT NULL,
  `application_id` varchar(45) NOT NULL,
  `personality_id` int(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_kana` varchar(100) DEFAULT NULL,
  `mail` varchar(256) NOT NULL,
  `tel_number` varchar(13) DEFAULT NULL,
  `fax_number` varchar(13) DEFAULT NULL,
  `post` varchar(7) DEFAULT NULL,
  `prefecture_id` int(2) DEFAULT 0,
  `municipalitie` varchar(50) DEFAULT NULL,
  `house_number` varchar(20) DEFAULT NULL,
  `building` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `line_user_corporates`
--

DROP TABLE IF EXISTS `line_user_corporates`;
CREATE TABLE `line_user_corporates` (
  `id` bigint(20) NOT NULL,
  `line_user_id` bigint(20) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `department_name_kana` varchar(100) DEFAULT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `line_user_individuals`
--

DROP TABLE IF EXISTS `line_user_individuals`;
CREATE TABLE `line_user_individuals` (
  `id` bigint(20) NOT NULL,
  `line_user_id` bigint(20) NOT NULL,
  `gender_id` int(1) DEFAULT 0,
  `birth_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `personalities`
--

DROP TABLE IF EXISTS `personalities`;
CREATE TABLE `personalities` (
  `id` int(1) NOT NULL,
  `name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `personalities`
--

INSERT INTO `personalities` (`id`, `name`) VALUES
(1, '個人'),
(2, '法人');

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `prefectures`
--

DROP TABLE IF EXISTS `prefectures`;
CREATE TABLE `prefectures` (
  `id` int(2) NOT NULL,
  `name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `prefectures`
--

INSERT INTO `prefectures` (`id`, `name`) VALUES
(1, '北海道'),
(2, '青森県'),
(3, '岩手県'),
(4, '宮城県'),
(5, '秋田県'),
(6, '山形県'),
(7, '福島県'),
(8, '茨城県'),
(9, '栃木県'),
(10, '群馬県'),
(11, '埼玉県'),
(12, '千葉県'),
(13, '東京都'),
(14, '神奈川県'),
(15, '新潟県'),
(16, '富山県'),
(17, '石川県'),
(18, '福井県'),
(19, '山梨県'),
(20, '長野県'),
(21, '岐阜県'),
(22, '静岡県'),
(23, '愛知県'),
(24, '三重県'),
(25, '滋賀県'),
(26, '京都府'),
(27, '大阪府'),
(28, '兵庫県'),
(29, '奈良県'),
(30, '和歌山県'),
(31, '鳥取県'),
(32, '島根県'),
(33, '岡山県'),
(34, '広島県'),
(35, '山口県'),
(36, '徳島県'),
(37, '香川県'),
(38, '愛媛県'),
(39, '高知県'),
(40, '福岡県'),
(41, '佐賀県'),
(42, '長崎県'),
(43, '熊本県'),
(44, '大分県'),
(45, '宮崎県'),
(46, '鹿児島県'),
(47, '沖縄県');

-- --------------------------------------------------------

--
-- テーブルの構造 `service_providers`
--

DROP TABLE IF EXISTS `service_providers`;
CREATE TABLE `service_providers` (
  `id` bigint(20) NOT NULL,
  `provider_id` varchar(45) NOT NULL,
  `name` varchar(255) NOT NULL,
  `use_start_date_time` datetime NOT NULL,
  `use_end_date_time` datetime DEFAULT NULL,
  `use_stop` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `service_providers`
--

INSERT INTO `service_providers` (`id`, `provider_id`, `name`, `use_start_date_time`, `use_end_date_time`, `use_stop`, `created_at`, `updated_at`) VALUES
(1, 'test', 'A会社', '2024-01-11 00:00:00', NULL, 0, '2024-01-11 11:34:08', '2024-01-11 11:34:08'),
(2, 'tesb', 'B会社', '2024-01-13 00:00:00', NULL, 0, '2024-01-13 12:11:02', '2024-01-13 12:11:02'),
(3, 'testc', 'C会社', '2024-01-13 00:00:00', NULL, 0, '2024-01-13 12:12:15', '2024-01-13 12:12:15'),
(4, 'testd', 'D会社', '2024-01-13 00:00:00', NULL, 0, '2024-01-13 12:14:22', '2024-01-13 12:14:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `service_provider_id` varchar(45) DEFAULT NULL,
  `account_id` varchar(45) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `user_type_id` int(1) NOT NULL,
  `user_account_type_id` int(1) NOT NULL,
  `profile_image_file_path` varchar(1000) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `service_provider_id`, `account_id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `user_type_id`, `user_account_type_id`, `profile_image_file_path`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', '管理者', 'admin@gmail.com', NULL, '$2y$12$HtRLaY24VSCVUfJDTCPWjO2B6s5qbLNWHO/.zdBWiDZ6tU4YD3r7C', NULL, NULL, NULL, 1, 2, NULL, NULL, '2024-01-11 10:17:02', '2024-01-11 10:17:02'),
(2, '1', 'admin', '管理者', 'admin@ac.com', NULL, '$2y$12$l.vhqQi6WcGcqsc9Avz7S.N9bSlh4CFoOBtI48JOpiOwo0BhSp9p2', NULL, NULL, NULL, 2, 2, NULL, NULL, '2024-01-11 11:34:49', '2024-01-11 11:34:49'),
(12, NULL, 't-tarou', '田中　太郎', 't-tarou@gmail.com', NULL, '$2y$12$8J11k2SIjImhEkyUp609beA.cLjxNSulQz.IGZ5qKFExckVjSwHpS', NULL, NULL, NULL, 1, 1, 'storage/operator/user/12/profile/profile.png', NULL, '2024-01-13 04:49:20', '2024-01-13 04:49:23'),
(14, '1', 'j-satou', '佐藤　次郎', NULL, NULL, '$2y$12$OFotnnH1SJLHEGxnvp04e.3wqz3.dT5hdcNCd/y7O3qeDmOca2Udm', NULL, NULL, NULL, 2, 1, 'storage/service_provider/1/user/14/profile/profile.png', NULL, '2024-01-13 04:58:08', '2024-01-13 04:58:08'),
(15, '1', 'k-fukuoka', '福岡　健太', NULL, NULL, '$2y$12$oRl9zWd8oONtnsy54Ez08.x.tSA7rBMOzPIT61z.swfJWUOlymZei', NULL, NULL, NULL, 2, 1, NULL, NULL, '2024-01-13 05:00:30', '2024-01-13 05:00:30'),
(16, '1', 'm-hama', '浜　桃子', NULL, NULL, '$2y$12$YtgA8uUzf7SekujhbJapdO9y/R4VZ12WFso6jIQKWdx0sYLqAEvBC', NULL, NULL, NULL, 2, 1, 'storage/service_provider/1/user/16/profile/profile.png', NULL, '2024-01-13 05:02:41', '2024-01-13 05:02:41'),
(17, '1', 's-nishi', '西　新次郎', NULL, NULL, '$2y$12$KDswhcRuoTvXtlDmrckr2eqc/EgYxd3GfIdspMeXqmu6rfJ6G6r3q', NULL, NULL, NULL, 2, 1, 'storage/service_provider/1/user/17/profile/profile.png', NULL, '2024-01-13 05:03:37', '2024-01-13 06:08:46');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_account_types`
--

DROP TABLE IF EXISTS `user_account_types`;
CREATE TABLE `user_account_types` (
  `id` int(1) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `user_account_types`
--

INSERT INTO `user_account_types` (`id`, `name`) VALUES
(1, '一般'),
(2, '管理者');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types` (
  `id` int(1) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `user_types`
--

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, '運用者'),
(2, 'サービス提供者');

-- --------------------------------------------------------

--
-- ビュー用の構造 `line_talk_histories`
--
DROP TABLE IF EXISTS `line_talk_histories`;

DROP VIEW IF EXISTS `line_talk_histories`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `line_talk_histories`  AS SELECT `t`.`from_to` AS `from_to`, `t`.`line_id` AS `line_id`, `t`.`date_time` AS `date_time`, `t`.`sender` AS `sender`, `t`.`type_id` AS `type_id`, `t`.`type_name` AS `type_name`, `t`.`line_message_id` AS `line_message_id`, `t`.`line_send_message_id` AS `line_send_message_id` FROM (select 'to' AS `from_to`,`ln`.`line_id` AS `line_id`,`ln`.`notice_date_time` AS `date_time`,`l`.`display_name` AS `sender`,`ln`.`line_notice_type_id` AS `type_id`,`lnt`.`display_name` AS `type_name`,`ln`.`line_message_id` AS `line_message_id`,0 AS `line_send_message_id` from ((`line_notices` `ln` left join `lines` `l` on(`ln`.`line_id` = `l`.`id`)) left join `line_notice_types` `lnt` on(`ln`.`line_notice_type_id` = `lnt`.`id`)) union all select 'from' AS `from_to`,`lsm`.`line_id` AS `line_id`,`lsm`.`send_date_time` AS `date_time`,ifnull(`u`.`name`,'公式LINE') AS `sender`,`lsm`.`line_send_message_origin_id` AS `type_id`,`lsmo`.`display_name` AS `type_name`,0 AS `line_message_id`,`lsm`.`id` AS `line_send_message_id` from (((`line_send_messages` `lsm` left join `users` `u` on(`lsm`.`user_id` = `u`.`id`)) left join `lines` `l` on(`lsm`.`line_id` = `l`.`id`)) left join `line_send_message_origins` `lsmo` on(`lsm`.`line_send_message_origin_id` = `lsmo`.`id`))) AS `t` ORDER BY `t`.`line_id` ASC, `t`.`date_time` ASC ;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- テーブルのインデックス `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `liff_page_types`
--
ALTER TABLE `liff_page_types`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `lines`
--
ALTER TABLE `lines`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_account_statuses`
--
ALTER TABLE `line_account_statuses`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_account_types`
--
ALTER TABLE `line_account_types`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_messages`
--
ALTER TABLE `line_messages`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_message_images`
--
ALTER TABLE `line_message_images`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_message_texts`
--
ALTER TABLE `line_message_texts`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_message_types`
--
ALTER TABLE `line_message_types`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_notices`
--
ALTER TABLE `line_notices`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_notice_settings`
--
ALTER TABLE `line_notice_settings`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_notice_types`
--
ALTER TABLE `line_notice_types`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_notice_user_settings`
--
ALTER TABLE `line_notice_user_settings`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_of_user_notice_settings`
--
ALTER TABLE `line_of_user_notice_settings`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_send_messages`
--
ALTER TABLE `line_send_messages`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_send_message_origins`
--
ALTER TABLE `line_send_message_origins`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_send_message_texts`
--
ALTER TABLE `line_send_message_texts`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_send_message_types`
--
ALTER TABLE `line_send_message_types`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_users`
--
ALTER TABLE `line_users`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_user_corporates`
--
ALTER TABLE `line_user_corporates`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `line_user_individuals`
--
ALTER TABLE `line_user_individuals`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- テーブルのインデックス `personalities`
--
ALTER TABLE `personalities`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- テーブルのインデックス `prefectures`
--
ALTER TABLE `prefectures`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- テーブルのインデックス `user_account_types`
--
ALTER TABLE `user_account_types`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `lines`
--
ALTER TABLE `lines`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `line_messages`
--
ALTER TABLE `line_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `line_message_images`
--
ALTER TABLE `line_message_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `line_message_texts`
--
ALTER TABLE `line_message_texts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `line_notices`
--
ALTER TABLE `line_notices`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `line_notice_settings`
--
ALTER TABLE `line_notice_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `line_notice_user_settings`
--
ALTER TABLE `line_notice_user_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `line_of_user_notice_settings`
--
ALTER TABLE `line_of_user_notice_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- テーブルの AUTO_INCREMENT `line_send_messages`
--
ALTER TABLE `line_send_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `line_send_message_texts`
--
ALTER TABLE `line_send_message_texts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `line_users`
--
ALTER TABLE `line_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `line_user_corporates`
--
ALTER TABLE `line_user_corporates`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `line_user_individuals`
--
ALTER TABLE `line_user_individuals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
