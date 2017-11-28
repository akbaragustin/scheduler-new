-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2017 at 12:51 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schedule`
--

-- --------------------------------------------------------

--
-- Table structure for table `invite_jabatan`
--

CREATE TABLE `invite_jabatan` (
  `id_invite_jabatan` int(11) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_rapat` int(11) DEFAULT NULL,
  `status_id_rapat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invite_jabatan`
--

INSERT INTO `invite_jabatan` (`id_invite_jabatan`, `id_jabatan`, `id_rapat`, `status_id_rapat`) VALUES
(427, 18, 212, NULL),
(429, 15, 213, NULL),
(430, 15, 214, NULL),
(431, 18, 215, NULL),
(432, 14, 216, NULL),
(464, 18, 243, NULL),
(465, 18, 244, NULL),
(466, 18, 240, NULL),
(467, 18, 245, NULL),
(477, 15, 246, NULL),
(478, 15, 253, 246),
(479, 15, 254, 246),
(488, 15, 258, NULL),
(489, 18, 258, NULL),
(490, 15, 259, NULL),
(491, 18, 259, NULL),
(500, 15, 260, NULL),
(501, 18, 260, NULL),
(565, 14, 296, NULL),
(566, 14, 297, 296),
(567, 14, 298, 296),
(568, 18, 299, NULL),
(569, 18, 300, 299),
(570, 18, 301, 299),
(571, 15, 292, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invite_name`
--

CREATE TABLE `invite_name` (
  `id_invite_name` int(11) NOT NULL,
  `id_rapat` int(11) DEFAULT NULL,
  `disposisi_rapat` varchar(50) DEFAULT NULL,
  `status_jabatan` char(2) DEFAULT NULL,
  `status_id_rapat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `name_jabatan` varchar(15) DEFAULT NULL,
  `label_color` varchar(50) DEFAULT NULL,
  `status_jabatan` int(11) DEFAULT NULL,
  `creator` varchar(50) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `editor` varchar(50) DEFAULT NULL,
  `edited` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `name_jabatan`, `label_color`, `status_jabatan`, `creator`, `created`, `editor`, `edited`) VALUES
(11, 'Super Admin', 'label-default', 1, '1', '2017-08-13', '1', '2017-11-14 22:10:32'),
(13, 'Admin', 'label-primary', 1, '1', '2017-08-13', '1', '2017-08-20 15:18:56'),
(17, 'User', NULL, 2, '1', '2017-09-01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pic`
--

CREATE TABLE `master_pic` (
  `id_master_pic` int(11) NOT NULL,
  `name_master_pic` varchar(50) DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pic`
--

INSERT INTO `master_pic` (`id_master_pic`, `name_master_pic`, `creator`, `created`, `editor`, `edited`) VALUES
(2, 'Fransiscus', 1, '2017-11-14 07:06:57', NULL, NULL),
(3, 'Putri', 1, '2017-11-14 07:07:09', NULL, NULL),
(4, 'Dwiyan', 1, '2017-11-14 07:07:21', NULL, NULL),
(5, 'Junjun', 1, '2017-11-14 07:08:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_unit_kerja`
--

CREATE TABLE `master_unit_kerja` (
  `id_unit_kerja` int(11) NOT NULL,
  `name_unit_kerja` varchar(70) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` varchar(50) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_unit_kerja`
--

INSERT INTO `master_unit_kerja` (`id_unit_kerja`, `name_unit_kerja`, `created`, `creator`, `edited`, `editor`) VALUES
(4, 'Kepala Pusat LitBang Perumahan dan Pemukiman', '2017-11-14 07:23:45', '1', NULL, NULL),
(5, 'Bagian Keuangan dan Umum', '2017-11-14 07:24:08', '1', NULL, NULL),
(6, 'Bidang Sumber Daya Kelitbangan', '2017-11-14 07:24:42', '1', NULL, NULL),
(7, 'Bidang Standardisasi dan Kerjasama', '2017-11-14 07:26:42', '1', NULL, NULL),
(8, 'Bidang Program dan Evaluasi', '2017-11-14 07:26:53', '1', NULL, NULL),
(9, 'Balai Litbang Air Minum Dan Penyehatan Lingkungan', '2017-11-14 07:27:05', '1', NULL, NULL),
(10, 'Balai  Litbang Bahan Dan Struktur', '2017-11-14 07:27:21', '1', NULL, NULL),
(11, 'Balai Litbang Tata Bangunan Dan Lingkungan', '2017-11-14 07:27:36', '1', NULL, NULL),
(12, 'Balai Litbang Sains Bangunan', '2017-11-14 07:28:26', '1', NULL, NULL),
(13, 'Balai Litbang Perumahan Wilayan I Medan', '2017-11-14 07:28:33', '1', NULL, NULL),
(14, 'Balai Litbang Perumahan Wilayan II Denpasar', '2017-11-14 07:29:01', '1', NULL, NULL),
(16, 'Balai Litbang Perumahan Wilayan III Makasar', '2017-11-14 07:35:25', '1', NULL, NULL);

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
(4368, 17, 271),
(4369, 17, 278),
(4370, 17, 284),
(4371, 17, 285),
(4372, 17, 286);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `name_ruangan` varchar(50) DEFAULT NULL,
  `max_ruangan` int(10) DEFAULT NULL,
  `creator` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `editor` varchar(50) DEFAULT NULL,
  `edited` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `name_ruangan`, `max_ruangan`, `creator`, `created`, `editor`, `edited`) VALUES
(1, 'r.10', 45, '1', '2017-08-20 07:25:52', NULL, NULL),
(2, 'r.11', 10, NULL, NULL, NULL, NULL),
(3, 'R.12', 30, '1', '2017-09-13 07:05:25', NULL, NULL),
(4, 'R.101', 25, '1', '2017-11-14 07:43:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` int(11) NOT NULL,
  `id_rapat` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_jabatan` char(2) DEFAULT NULL,
  `status_id_rapat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `id_rapat`, `id_user`, `status_jabatan`, `status_id_rapat`) VALUES
(268, 212, 13, '3', NULL),
(270, 213, 16, '1', NULL),
(271, 214, 16, '1', NULL),
(339, 292, 12, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_rapat`
--

CREATE TABLE `t_rapat` (
  `id_rapat` int(11) NOT NULL,
  `start_tgl_rapat` datetime DEFAULT NULL,
  `end_tgl_rapat` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_ruangan` int(11) DEFAULT NULL,
  `agenda_rapat` varchar(200) DEFAULT NULL,
  `pj_rapat` varchar(50) DEFAULT NULL,
  `status_ruangan_rapat` enum('external','internal') DEFAULT NULL,
  `tempat_rapat` varchar(100) DEFAULT NULL,
  `status_active_rapat` char(2) NOT NULL,
  `creator` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `status_id_rapat` int(11) DEFAULT NULL,
  `phari` int(11) DEFAULT NULL,
  `status_pelaksana` varchar(20) DEFAULT NULL,
  `PIC` varchar(50) DEFAULT NULL,
  `status_fasilitator` varchar(50) DEFAULT NULL,
  `fasilitator` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_rapat`
--

INSERT INTO `t_rapat` (`id_rapat`, `start_tgl_rapat`, `end_tgl_rapat`, `id_ruangan`, `agenda_rapat`, `pj_rapat`, `status_ruangan_rapat`, `tempat_rapat`, `status_active_rapat`, `creator`, `created`, `editor`, `edited`, `status_id_rapat`, `phari`, `status_pelaksana`, `PIC`, `status_fasilitator`, `fasilitator`) VALUES
(116, '2017-10-12 11:55:00', '2017-10-12 16:55:00', 1, 'Rapat Kapus', 'KUDA', 'internal', NULL, '1', NULL, NULL, NULL, NULL, NULL, 2, 'terstruktur', NULL, NULL, NULL),
(119, '2017-10-12 12:05:00', '2017-10-12 12:05:00', 2, 'adsdas', 'asdnasd', 'internal', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 'non_terstruktur', NULL, NULL, NULL),
(142, '2017-10-15 14:10:00', '2017-10-15 15:10:00', 1, 'naha sih', 'akbar', 'internal', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 'terstruktur', NULL, NULL, NULL),
(212, '2017-11-14 13:00:00', '2017-11-28 11:08:50', 4, 'Rapat rutin Evaluasi Kegiatan Bulanan', 'Bagian Keuangan dan Umum', 'internal', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, 'unitkerja', 'Fransiscus', NULL, NULL),
(213, '2017-11-14 08:00:00', '2017-11-15 15:00:00', NULL, 'Penyiapan dokumen lelang', 'Bidang Program dan Evaluasi', 'external', 'Novotel Bandung', '1', NULL, NULL, NULL, NULL, NULL, NULL, 'unitkerja', NULL, NULL, NULL),
(214, '2017-11-15 08:00:00', '2017-11-16 15:00:00', NULL, 'Penyiapan dokumen lelang', 'Bidang Program dan Evaluasi', 'external', 'Novotel Bandung', '1', NULL, NULL, NULL, NULL, 213, NULL, 'unitkerja', NULL, NULL, NULL),
(215, '2017-11-19 00:00:00', '2017-11-28 10:59:43', 3, 'sadasd', 'ddd', 'internal', NULL, '1', 18, '2017-11-19 16:13:41', NULL, NULL, NULL, NULL, 'nonunitkerja', 'Fransiscus', 'nonunitkerjaFasilitator', 'ddd'),
(216, '2017-11-19 23:00:00', '2017-11-19 23:00:00', 1, 'agenda kapus', 'Kepala Pusat LitBang Perumahan dan Pemukiman', 'internal', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 'unitkerja', 'Putri', 'unitkerjaFasilitator', 'Bidang Sumber Daya Kelitbangan'),
(244, '2017-11-22 22:00:00', '2017-11-22 23:00:00', 2, 'cek save', 'Kepala Pusat LitBang Perumahan dan Pemukiman', 'internal', NULL, '1', NULL, NULL, NULL, NULL, 243, NULL, 'unitkerja', 'Fransiscus', NULL, NULL),
(245, '2017-11-21 22:00:00', '2017-11-21 23:00:00', 2, 'cek update', 'Kepala Pusat LitBang Perumahan dan Pemukiman', 'internal', NULL, '1', NULL, NULL, NULL, NULL, 240, NULL, 'unitkerja', 'Fransiscus', NULL, NULL),
(292, '2017-11-21 00:00:00', '2017-11-22 18:31:13', 2, 'sdasdnn', 'Kepala Pusat LitBang Perumahan dan Pemukiman', 'internal', NULL, '1', NULL, NULL, NULL, NULL, NULL, 3, 'unitkerja', 'Putri', 'unitkerjaFasilitator', 'Bagian Keuangan dan Umum'),
(296, '2017-11-21 00:00:00', '2017-11-21 01:00:00', 3, 'asdns', 'Kepala Pusat LitBang Perumahan dan Pemukiman', 'internal', NULL, '1', NULL, NULL, NULL, NULL, NULL, 2, 'unitkerja', 'Fransiscus', 'unitkerjaFasilitator', 'Kepala Pusat LitBang Perumahan dan Pemukiman'),
(297, '2017-11-22 00:00:00', '2017-11-22 01:00:00', 3, 'asdns', 'Kepala Pusat LitBang Perumahan dan Pemukiman', 'internal', NULL, '1', NULL, NULL, NULL, NULL, 296, NULL, 'unitkerja', 'Fransiscus', 'unitkerjaFasilitator', 'Kepala Pusat LitBang Perumahan dan Pemukiman'),
(298, '2017-11-23 00:00:00', '2017-11-23 01:00:00', 3, 'asdns', 'Kepala Pusat LitBang Perumahan dan Pemukiman', 'internal', NULL, '1', NULL, NULL, NULL, NULL, 296, NULL, 'unitkerja', 'Fransiscus', 'unitkerjaFasilitator', 'Kepala Pusat LitBang Perumahan dan Pemukiman'),
(299, '2017-11-21 00:00:00', '2017-11-21 01:00:00', 1, 'sjdk', 'Bagian Keuangan dan Umum', 'internal', NULL, '1', NULL, NULL, NULL, NULL, NULL, 2, 'unitkerja', 'Putri', 'unitkerjaFasilitator', 'Bagian Keuangan dan Umum'),
(300, '2017-11-22 00:00:00', '2017-11-22 01:00:00', 1, 'sjdk', 'Bagian Keuangan dan Umum', 'internal', NULL, '1', NULL, NULL, NULL, NULL, 299, NULL, 'unitkerja', 'Putri', 'unitkerjaFasilitator', 'Bagian Keuangan dan Umum'),
(301, '2017-11-23 00:00:00', '2017-11-23 01:00:00', 1, 'sjdk', 'Bagian Keuangan dan Umum', 'internal', NULL, '1', NULL, NULL, NULL, NULL, 299, NULL, 'unitkerja', 'Putri', 'unitkerjaFasilitator', 'Bagian Keuangan dan Umum');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL COMMENT 'jabatan ',
  `password` varchar(200) DEFAULT NULL,
  `remember_token` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_unit_kerja` int(11) DEFAULT NULL,
  `name_pic` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `id_jabatan`, `password`, `remember_token`, `email`, `id_unit_kerja`, `name_pic`) VALUES
(11, 'dwiyan_admin', 13, '3fc0a7acf087f549ac2b266baf94b8b1', 'byx9qE8mZ86dFZvUwQeWgozEcjtNWUkYGCeRpTSL', 'dwiyan@email.idn', NULL, NULL),
(12, NULL, NULL, NULL, NULL, NULL, 4, 'Prof(R). DR.Ir. Arief Sabaruddin, CES'),
(13, NULL, NULL, NULL, NULL, NULL, 5, 'Ir. Riana Suwardi, M.Si'),
(14, NULL, NULL, NULL, NULL, NULL, 7, 'Ir. Lutfi Faisal'),
(15, NULL, NULL, NULL, NULL, NULL, 6, 'DRS. Aris Prihandono, M.Sc'),
(16, NULL, NULL, NULL, NULL, NULL, 8, 'Prof(R).DR.Ing. Andreas Wibowo, ST, MT'),
(18, 'admin', 11, 'e69dc2c09e8da6259422d987ccbe95b5', 'J4awxQ1b1YLEX8jkEu3s2cFRQxxJTQXq4Idci0aQ', 'admin@gmail.com', NULL, NULL),
(19, 'akbar2', 13, 'e69dc2c09e8da6259422d987ccbe95b5', 'hHVKtlOSwMVWXwGyEZxZcrYREn1ABpXiSAnMXYQu', 'akbar@gmail.com', NULL, NULL),
(20, 'akbar1', 17, 'e69dc2c09e8da6259422d987ccbe95b5', 'hHVKtlOSwMVWXwGyEZxZcrYREn1ABpXiSAnMXYQu', 'akbaragustin@yahoo.com', NULL, NULL),
(21, 'akbar', 17, 'e69dc2c09e8da6259422d987ccbe95b5', 'nJskK8vooMxOXgUWztOuf5iAaasOoinznm0ogQid', 'akbaragustin@yahoo.com', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invite_jabatan`
--
ALTER TABLE `invite_jabatan`
  ADD PRIMARY KEY (`id_invite_jabatan`);

--
-- Indexes for table `invite_name`
--
ALTER TABLE `invite_name`
  ADD PRIMARY KEY (`id_invite_name`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `master_pic`
--
ALTER TABLE `master_pic`
  ADD PRIMARY KEY (`id_master_pic`);

--
-- Indexes for table `master_unit_kerja`
--
ALTER TABLE `master_unit_kerja`
  ADD PRIMARY KEY (`id_unit_kerja`);

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
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_rapat` (`id_rapat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_rapat`
--
ALTER TABLE `t_rapat`
  ADD PRIMARY KEY (`id_rapat`),
  ADD KEY `id_ruangan` (`id_ruangan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_unit_kerja` (`id_unit_kerja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invite_jabatan`
--
ALTER TABLE `invite_jabatan`
  MODIFY `id_invite_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=590;

--
-- AUTO_INCREMENT for table `invite_name`
--
ALTER TABLE `invite_name`
  MODIFY `id_invite_name` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `master_pic`
--
ALTER TABLE `master_pic`
  MODIFY `id_master_pic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_unit_kerja`
--
ALTER TABLE `master_unit_kerja`
  MODIFY `id_unit_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu_admin`
--
ALTER TABLE `menu_admin`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT for table `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `kd_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4373;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;

--
-- AUTO_INCREMENT for table `t_rapat`
--
ALTER TABLE `t_rapat`
  MODIFY `id_rapat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `id_rapat` FOREIGN KEY (`id_rapat`) REFERENCES `t_rapat` (`id_rapat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_rapat`
--
ALTER TABLE `t_rapat`
  ADD CONSTRAINT `id_ruangan` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `id_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `id_unit_kerja` FOREIGN KEY (`id_unit_kerja`) REFERENCES `master_unit_kerja` (`id_unit_kerja`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
