-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 8 月 30 日 13:35
-- サーバのバージョン： 10.3.16-MariaDB
-- PHP のバージョン: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `employee`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `employee_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `kana_name` varchar(100) NOT NULL,
  `sex` int(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `data`
--

INSERT INTO `data` (`id`, `employee_id`, `name`, `kana_name`, `sex`, `created`, `updated`) VALUES
(23, 111111, '林美雨', 'はやしみう', 2, '2020-08-18 14:30:36', '2020-08-22 20:26:28'),
(24, 426452, '加藤重明', 'かとうしげあき', 1, '2020-08-19 22:00:08', '2020-08-20 14:39:18'),
(25, 624524, '木嶋宏', 'きじまひろし', 1, '2020-08-20 15:00:14', '2020-08-20 15:00:14'),
(26, 642322, '後藤真衣', 'ごとうまい', 2, '2020-08-20 15:37:53', '2020-08-20 15:43:30'),
(27, 531413, '木鍋浩一', 'きなべこういち', 0, '2020-08-20 15:40:01', '2020-08-20 15:40:01'),
(28, 951343, '高坂百合香', 'こうさかゆりか', 2, '2020-08-20 15:40:47', '2020-08-20 15:40:47'),
(29, 801343, '加藤良介', 'かとうりょうすけ', 1, '2020-08-20 15:41:26', '2020-08-20 15:41:26'),
(30, 123453, '三上優香', 'みかみゆうか', 2, '2020-08-20 15:42:09', '2020-08-20 15:42:09'),
(31, 435435, '拝島晃樹', 'はいじまこうき', 1, '2020-08-20 16:40:03', '2020-08-20 16:40:03'),
(32, 721318, '遠藤晴香', 'えんどうはるか', 2, '2020-08-20 16:41:06', '2020-08-20 16:41:06'),
(33, 921315, '安藤匠', 'あんどうたくみ', 1, '2020-08-20 16:42:41', '2020-08-22 21:04:24'),
(34, 534631, '井上章介', 'いのうえしょうすけ', 1, '2020-08-20 17:48:38', '2020-08-20 17:48:38'),
(35, 312132, '久保琢磨', 'くぼたくま', 1, '2020-08-22 21:13:57', '2020-08-22 21:13:57');

-- --------------------------------------------------------

--
-- テーブルの構造 `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `pwd` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `login`
--

INSERT INTO `login` (`id`, `username`, `email`, `pwd`) VALUES
(1, 'arata', 'arata.saito0608@gmail.com', '$2y$10$C6Jt9YmhkXDdCrekYJXDq.cLcr34U3jHUzvL.BxTmzsf99o0u4aWC'),
(2, 'takumi', 'takumi@example.com', '$2y$10$b.dZPdSJ9ha7J9JR6ZQBneBUqC7lXgF7YBRncWNHI9toujJSO72M2');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- テーブルのAUTO_INCREMENT `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
