-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-08-29 10:51:23
-- 服务器版本： 5.7.16
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lianghuabi`
--

-- --------------------------------------------------------

--
-- 表的结构 `account_btc`
--

CREATE TABLE `account_btc` (
  `id` int(5) NOT NULL,
  `account` varchar(255) NOT NULL,
  `is_use` int(1) DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `account_btc`
--

INSERT INTO `account_btc` (`id`, `account`, `is_use`, `create_time`) VALUES
(1, '12zAfoMbs7vP5r38jBmW4pAT77dEE8yMnG', 1, '2017-08-28 08:57:23');

-- --------------------------------------------------------

--
-- 表的结构 `account_eth`
--

CREATE TABLE `account_eth` (
  `id` int(5) NOT NULL,
  `account` varchar(255) DEFAULT NULL,
  `is_use` int(1) DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `account_eth`
--

INSERT INTO `account_eth` (`id`, `account`, `is_use`, `create_time`) VALUES
(1, '0x9592bEb8246D8a683B24C1638d42265FE9807169', 1, '2017-08-28 08:57:10');

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `id` int(5) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `type` int(1) DEFAULT NULL COMMENT '文章类型（0：认责申明 1：其他文章）',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `type`, `create_time`) VALUES
(1, '认责申明', '认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明认责申明', 0, '2017-08-23 14:24:09');

-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

CREATE TABLE `banner` (
  `id` int(5) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `blog`
--

CREATE TABLE `blog` (
  `id` int(5) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `desc` text COMMENT '描述',
  `pic` varchar(255) DEFAULT NULL,
  `content` text,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `blog`
--

INSERT INTO `blog` (`id`, `title`, `desc`, `pic`, `content`, `create_time`) VALUES
(1, '博客标题1', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '/uploads/imgs/news-img.png', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '2017-08-24 02:44:15'),
(2, '博客标题2', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '/uploads/imgs/news-img.png', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '2017-08-24 02:44:15'),
(3, '博客标题3', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '/uploads/imgs/news-img.png', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '2017-08-24 02:44:15'),
(4, '博客标题4', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '/uploads/imgs/news-img.png', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '2017-08-24 02:44:15'),
(5, '博客标题5', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '/uploads/imgs/news-img.png', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '2017-08-24 02:44:15'),
(6, '博客标题6', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '/uploads/imgs/news-img.png', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '2017-08-24 02:44:15'),
(7, '博客标题7', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '/uploads/imgs/news-img.png', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '2017-08-24 02:44:15'),
(8, '博客标题8', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '/uploads/imgs/news-img.png', '全球数字代币量化和电子交易专业级生态链ICO即将启动', '2017-08-24 02:44:15');

-- --------------------------------------------------------

--
-- 表的结构 `currency`
--

CREATE TABLE `currency` (
  `id` int(5) NOT NULL,
  `currency_name` varchar(255) DEFAULT NULL COMMENT '币种名称',
  `currency_rate` varchar(255) DEFAULT NULL COMMENT '兑率',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `currency`
--

INSERT INTO `currency` (`id`, `currency_name`, `currency_rate`, `create_time`) VALUES
(1, 'ETT', '0.98', '2017-08-23 08:44:28');

-- --------------------------------------------------------

--
-- 表的结构 `feedback`
--

CREATE TABLE `feedback` (
  `id` int(5) NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `internet` varchar(255) DEFAULT NULL,
  `content` text,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `feedback`
--

INSERT INTO `feedback` (`id`, `nickname`, `email`, `internet`, `content`, `create_time`) VALUES
(1, '123', '213', '213', '213', '2017-08-28 09:24:34'),
(2, '洪文扬', '792528966@qq.com', 'asddas', '这是一个全新的网站', '2017-08-28 09:29:23'),
(3, '2312', '12', '2121', '3', '2017-08-28 10:46:51');

-- --------------------------------------------------------

--
-- 表的结构 `funding`
--

CREATE TABLE `funding` (
  `id` int(5) NOT NULL,
  `btc_count` varchar(255) DEFAULT NULL COMMENT '目标比特币',
  `eth_count` varchar(255) DEFAULT NULL COMMENT '目标以太币',
  `time` varchar(45) DEFAULT NULL COMMENT '截止倒计时',
  `is_show` int(1) DEFAULT NULL COMMENT '是否显示（0：是 1：否）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `mail`
--

CREATE TABLE `mail` (
  `id` int(5) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `type` int(5) DEFAULT NULL COMMENT '邮件类型（0：注册 1：忘记密码）',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `token_extime` varchar(255) DEFAULT NULL COMMENT '邮件过期时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `mail`
--

INSERT INTO `mail` (`id`, `url`, `type`, `create_time`, `token_extime`) VALUES
(10, '/api/checkMail/51eb40e5857eedc69423de1692e430e21c57ecec', NULL, '2017-08-23 07:20:43', NULL),
(11, '/api/checkMail/user2ma9993e364706816aba3e25717850c26c9cd0d89d383', NULL, '2017-08-23 07:38:37', NULL),
(12, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d3233', NULL, '2017-08-23 07:59:41', NULL),
(13, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d6684', NULL, '2017-08-23 11:54:33', '1503489273'),
(14, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d9335', NULL, '2017-08-23 11:56:21', '1353140442900'),
(15, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d64960a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-23 12:04:54', '1353140904600'),
(16, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d85161a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 1, '2017-08-23 12:19:46', '1353141707400'),
(17, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d70661a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 1, '2017-08-23 12:23:14', '1353141894600'),
(18, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d78761a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 1, '2017-08-23 12:23:36', '1353141914400'),
(19, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d93661a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 1, '2017-08-23 12:23:56', '1353141932400'),
(20, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d43361a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 1, '2017-08-23 12:27:52', '1353142144800'),
(21, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d46161a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 1, '2017-08-23 12:28:03', '1353142154700'),
(22, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d42861a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 1, '2017-08-23 12:28:45', '1353142192500'),
(23, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d52061a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 1, '2017-08-23 12:29:24', '1353142227600'),
(24, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d76361a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 1, '2017-08-23 12:29:32', '1353142234800'),
(25, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d25061a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 1, '2017-08-23 12:29:48', '1353142249200'),
(26, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d71990a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 04:17:35', '1353504469500'),
(27, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d655100a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 04:17:57', '1353504489300'),
(28, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d328110a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 04:37:22', '1353505537800'),
(29, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d465110a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:39:17', '1353515361300'),
(30, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d526110a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:41:06', '1353515459400'),
(31, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d984110a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:42:06', '1353515513400'),
(32, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d339110a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:42:19', '1353515525100'),
(33, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d857110a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:49:51', '1353515931900'),
(34, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d337110a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:50:40', '1353515976000'),
(35, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d956110a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:52:18', '1353516064200'),
(36, '/api/checkMail/11a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:55:46', '1353516251400'),
(37, '/api/checkMail/11#a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:56:34', '1353516294600'),
(38, '/api/checkMail/11!a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:56:58', '1353516316200'),
(39, '/api/checkMail/11@a8f9b8ca936ae0604181778c18bf90e7d6fb5a49', 0, '2017-08-28 07:57:12', '1353516328800'),
(40, '/api/checkMail/11@a8f9b8ca936ae0604181778c18bf90e7d6fb5a490', 0, '2017-08-28 08:02:44', '1353516627600'),
(41, '/api/checkMail/11@a8f9b8ca936ae0604181778c18bf90e7d6fb5a490', 0, '2017-08-28 08:13:29', '1353517208100'),
(42, '/api/checkMail/a9993e364706816aba3e25717850c26c9cd0d89d87413038bd521bc0833fdc87deb3c49daff91f83e989ef', 0, '2017-08-28 16:33:21', '1353544200900');

-- --------------------------------------------------------

--
-- 表的结构 `media`
--

CREATE TABLE `media` (
  `id` int(5) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `media`
--

INSERT INTO `media` (`id`, `pic`, `url`, `create_time`) VALUES
(1, '/uploads/imgs/media-img.png', NULL, '2017-08-24 02:52:30'),
(2, '/uploads/imgs/media-img.png', NULL, '2017-08-24 02:52:30');

-- --------------------------------------------------------

--
-- 表的结构 `platform`
--

CREATE TABLE `platform` (
  `id` int(5) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `platform`
--

INSERT INTO `platform` (`id`, `url`, `create_time`) VALUES
(1, '/uploads/imgs/platform-item-1.png', '2017-08-24 02:40:20'),
(2, '/uploads/imgs/platform-item-1.png', '2017-08-24 02:40:20'),
(3, '/uploads/imgs/platform-item-1.png', '2017-08-24 02:40:20'),
(4, '/uploads/imgs/platform-item-1.png', '2017-08-24 02:40:20'),
(5, '/uploads/imgs/platform-item-1.png', '2017-08-24 02:40:20'),
(6, '/uploads/imgs/platform-item-1.png', '2017-08-24 02:40:20');

-- --------------------------------------------------------

--
-- 表的结构 `team`
--

CREATE TABLE `team` (
  `id` int(5) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ename` varchar(255) DEFAULT NULL COMMENT '英文称呼',
  `headPic` varchar(255) DEFAULT NULL,
  `content` text COMMENT '简介',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `team`
--

INSERT INTO `team` (`id`, `name`, `ename`, `headPic`, `content`, `create_time`) VALUES
(1, '联合创始人&CEO 马学韬 先生1', 'Co-Founder & CEO  Mr. Ma Xuetao', '/uploads/imgs/founder-avatar.png', '上海交通大学控制科学与工程硕士、学士。8年主流大型金融机构投资银行从业经历参与、主导多个大型国有金融机构和央企的改制上市与资本', '2017-08-24 02:42:24'),
(2, '联合创始人&CEO 马学韬 先生', 'Co-Founder & CEO  Mr. Ma Xuetao', '/uploads/imgs/founder-avatar.png', '上海交通大学控制科学与工程硕士、学士。8年主流大型金融机构投资银行从业经历参与、主导多个大型国有金融机构和央企的改制上市与资本', '2017-08-24 02:42:24');

-- --------------------------------------------------------

--
-- 表的结构 `technology`
--

CREATE TABLE `technology` (
  `id` int(5) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL COMMENT '描述',
  `content` text,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `technology`
--

INSERT INTO `technology` (`id`, `pic`, `title`, `desc`, `content`, `create_time`) VALUES
(1, NULL, '量化交易API及联通交易所的 低延迟服务器(co-location)', '对标上期技术, 中金技术1', NULL, '2017-08-24 03:34:03'),
(2, '', '量化交易API及联通交易所的 低延迟服务器(co-location)', '对标上期技术, 中金技术', NULL, '2017-08-24 03:34:03'),
(3, NULL, '量化交易API及联通交易所的 低延迟服务器(co-location)', '对标上期技术, 中金技术', NULL, '2017-08-24 03:34:03'),
(4, '', '量化交易API及联通交易所的 低延迟服务器(co-location)', '对标上期技术, 中金技术', NULL, '2017-08-24 03:34:03'),
(5, '', '量化交易API及联通交易所的 低延迟服务器(co-location)', '对标上期技术, 中金技术', NULL, '2017-08-24 03:34:03');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `user_unique_btc` varchar(255) DEFAULT '0' COMMENT '比特币账号',
  `user_unique_eth` varchar(255) DEFAULT NULL COMMENT '以太币唯一账号',
  `user_name` varchar(255) DEFAULT NULL COMMENT '会员名称',
  `user_mail` varchar(255) DEFAULT NULL COMMENT '会员邮箱',
  `user_pwd` varchar(255) DEFAULT NULL COMMENT '密码',
  `user_pic` varchar(255) DEFAULT NULL,
  `nickName` varchar(255) DEFAULT NULL COMMENT '昵称',
  `user_phone` varchar(255) DEFAULT NULL,
  `user_money` varchar(255) DEFAULT '0' COMMENT '账户余额',
  `user_locking` varchar(255) DEFAULT '0' COMMENT '锁定金额',
  `user_no` varchar(255) DEFAULT NULL COMMENT '身份证',
  `user_real_name` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `is_check_mail` int(5) DEFAULT '0' COMMENT '邮箱是否验证',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_time` varchar(255) DEFAULT NULL COMMENT '最后登录时间',
  `new_login_time` varchar(255) DEFAULT NULL COMMENT '最新登录时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `user_unique_btc`, `user_unique_eth`, `user_name`, `user_mail`, `user_pwd`, `user_pic`, `nickName`, `user_phone`, `user_money`, `user_locking`, `user_no`, `user_real_name`, `is_check_mail`, `create_time`, `last_login_time`, `new_login_time`) VALUES
(3, '12zAfoMbs7vP5r38jBmW4pAT77dEE8yMnG', '0x9592bEb8246D8a683B24C1638d42265FE9807169', 'hwy', '792528966@qq.com', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9', '/uploads/imgs/qjWcPRmXze48tR7oEut3DeBN7dVFjNHlZXG9Iaze.png', 'asdasd', NULL, '0', '0', NULL, NULL, 1, '2017-08-23 07:59:40', '1503477073', NULL),
(4, '0', NULL, 'hhhuseruser__user_', '792528966@qq.com', 'f6e1126cedebf23e1463aee73f9df08783640400', NULL, NULL, NULL, '0', '0', NULL, NULL, 0, '2017-08-23 11:54:32', NULL, NULL),
(5, '0', NULL, 'hh', '792528966@qq.com', 'f6e1126cedebf23e1463aee73f9df08783640400', NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '2017-08-23 11:56:21', NULL, NULL),
(6, '0', NULL, 'hh', '792528966@qq.com', 'f6e1126cedebf23e1463aee73f9df08783640400', NULL, NULL, NULL, '0', '0', NULL, NULL, 1, '2017-08-23 12:04:54', NULL, NULL),
(11, '12zAfoMbs7vP5r38jBmW4pAT77dEE8yMnG', '0x9592bEb8246D8a683B24C1638d42265FE9807169', 'hwy_demo', '792528966@qq.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, NULL, '13858126467', '0', '0', '320681199403097617', '洪文扬', 1, '2017-08-28 04:37:20', NULL, NULL),
(13, '0', NULL, 'maxuetao', 'maxuetao@gmail.com', 'b15d696970f8542e8ca95ddd41be7885f19c098b', NULL, NULL, NULL, '0', '0', NULL, NULL, 0, '2017-08-28 16:33:16', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `video`
--

CREATE TABLE `video` (
  `id` int(5) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `video`
--

INSERT INTO `video` (`id`, `url`, `create_time`) VALUES
(1, 'http://bytom.io/wp-content/themes/news/bytom-ui/img/bytom_b_3.mp4', '2017-08-24 02:18:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_btc`
--
ALTER TABLE `account_btc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_eth`
--
ALTER TABLE `account_eth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funding`
--
ALTER TABLE `funding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technology`
--
ALTER TABLE `technology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `account_btc`
--
ALTER TABLE `account_btc`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `account_eth`
--
ALTER TABLE `account_eth`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `funding`
--
ALTER TABLE `funding`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- 使用表AUTO_INCREMENT `media`
--
ALTER TABLE `media`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `platform`
--
ALTER TABLE `platform`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `team`
--
ALTER TABLE `team`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `technology`
--
ALTER TABLE `technology`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `video`
--
ALTER TABLE `video`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
