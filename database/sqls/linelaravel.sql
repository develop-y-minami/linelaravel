-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-12-03 15:57:22
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
-- テーブルの構造 `line_notices`
--

DROP TABLE IF EXISTS `line_notices`;
CREATE TABLE `line_notices` (
  `id` bigint(20) NOT NULL COMMENT 'LINE通知ID',
  `notice_datetime` datetime NOT NULL COMMENT 'LINE通知日時',
  `event_code_id` bigint DEFAULT 0 COMMENT 'イベント種別',
  `content` varchar(1000) DEFAULT NULL COMMENT 'イベント内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `line_notices`
--
ALTER TABLE `line_notices`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `line_notices`
--
ALTER TABLE `line_notices`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'LINE通知ID';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
