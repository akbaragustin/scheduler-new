-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2017 at 06:26 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1232138_schedule`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_admin`
--

CREATE TABLE `menu_admin` (
  `id_menu` int(10) NOT NULL,
  `level_menu` smallint(6) NOT NULL,
  `parent_menu` int(10) NOT NULL,
  `posisition_menu` tinyint(4) NOT NULL,
  `url_menu` varchar(100) NOT NULL,
  `name_menu` varchar(100) NOT NULL,
  `icon_menu` varchar(50) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `creator` varchar(100) DEFAULT NULL,
  `edited` timestamp NULL DEFAULT NULL,
  `editor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_admin`
--

INSERT INTO `menu_admin` (`id_menu`, `level_menu`, `parent_menu`, `posisition_menu`, `url_menu`, `name_menu`, `icon_menu`, `created`, `creator`, `edited`, `editor`) VALUES
(268, 0, 0, 0, '/', 'Config', 'book', '2017-08-17 16:19:15', NULL, NULL, NULL),
(269, 0, 268, 0, 'admin/config/menu', 'Menu', 'menu', '2017-08-17 16:20:12', NULL, NULL, NULL),
(270, 0, 268, 0, 'admin/config/role', 'Role', 'dehaze', '2017-08-17 16:21:49', NULL, NULL, NULL),
(271, 0, 0, 0, '/', 'Forms', 'border_color', '2017-08-17 16:24:04', NULL, NULL, NULL),
(272, 0, 285, 0, 'admin/users', 'Users', 'account_box', '2017-08-17 16:28:54', NULL, NULL, NULL),
(273, 0, 285, 0, 'admin/ruangan', 'Ruangan', 'home', '2017-08-17 16:29:40', NULL, NULL, NULL),
(274, 0, 285, 0, 'admin/jabatan', 'Jabatan', 'assignment_turned_in', '2017-08-17 16:30:46', NULL, NULL, NULL),
(277, 0, 271, 0, 'admin/kapus', 'Agenda Kapus', 'description', '2017-08-21 14:39:57', NULL, NULL, NULL),
(278, 0, 271, 0, 'admin/eselon', 'Agenda Struktural', 'assignment_returned', '2017-08-21 14:41:34', NULL, NULL, NULL),
(280, 0, 285, 0, 'admin/unit_kerja', 'Unit Kerja', 'group_work', '2017-09-01 05:38:40', NULL, NULL, NULL),
(281, 0, 285, 0, 'admin/users_eselon', 'Pejabat Struktural', 'assignment_ind', '2017-09-02 17:48:35', NULL, NULL, NULL),
(282, 0, 271, 0, 'admin/rapat', 'Agenda Internal', 'assignment', '2017-09-03 18:04:51', NULL, NULL, NULL),
(284, 0, 271, 0, 'admin/booking_internal', 'Agenda Booking Internal', 'book', '2017-09-03 19:08:26', NULL, NULL, NULL),
(285, 0, 0, 0, '/', 'Master', 'dashboard', '2017-10-19 18:55:33', NULL, NULL, NULL),
(286, 0, 285, 0, 'admin/master_pic', 'Master PIC', 'account_box', '2017-11-14 05:54:27', NULL, NULL, NULL),
(287, 0, 0, 0, '/', 'Menu', 'class', '2017-11-20 20:06:45', NULL, NULL, NULL),
(288, 0, 287, 0, 'admin/config/menu', 'Menu', 'toc', '2017-11-20 20:08:34', NULL, NULL, NULL),
(289, 0, 287, 0, 'admin/config/role', 'Role', 'reorder', '2017-11-20 20:09:35', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `kd_role` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`kd_role`, `id_jabatan`, `id_menu`) VALUES
(4312, 11, 268),
(4313, 11, 269),
(4314, 11, 270),
(4315, 11, 271),
(4316, 11, 277),
(4317, 11, 278),
(4318, 11, 282),
(4319, 11, 284),
(4320, 11, 285),
(4321, 11, 272),
(4322, 11, 273),
(4323, 11, 274),
(4324, 11, 280),
(4325, 11, 281),
(4326, 11, 286),
(4327, 11, 287),
(4328, 11, 288),
(4329, 11, 289),
(4345, 13, 268),
(4346, 13, 271),
(4347, 13, 277),
(4348, 13, 278),
(4349, 13, 282),
(4350, 13, 284),
(4351, 13, 285),
(4352, 13, 272),
(4353, 13, 273),
(4354, 13, 280),
(4355, 13, 281),
(4356, 13, 286),
(4362, 17, 268),
(4363, 17, 271),
(4364, 17, 278),
(4365, 17, 284),
(4366, 17, 285),
(4367, 17, 286);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_admin`
--
ALTER TABLE `menu_admin`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`kd_role`),
  ADD KEY `id_group` (`id_jabatan`),
  ADD KEY `user_grp` (`id_jabatan`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_menu_2` (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_admin`
--
ALTER TABLE `menu_admin`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;
--
-- AUTO_INCREMENT for table `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `kd_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4368;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
