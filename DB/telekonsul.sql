-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2020 at 07:41 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telekonsul`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `send_to` varchar(255) NOT NULL,
  `send_by` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `send_to`, `send_by`, `message`, `time`, `status`) VALUES
(1, 'RGS00008', 'RGS00001', 'test', '2020-12-22 10:59:53', 0),
(2, 'RGS00007', 'RGS00001', 'cek', '2020-12-22 11:00:25', 0),
(3, 'KONS0001', 'RGS00001', 'WA', '2020-12-26 08:43:37', 0),
(4, 'KONS0004', 'RGS00001', 'WA2314', '2020-12-26 17:01:36', 0),
(5, 'RGS00001', 'RGS00008', 'uyy', '2020-12-27 04:40:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_type` enum('no','yes','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `no_praktek` varchar(255) NOT NULL,
  `jadwal_praktek` time NOT NULL,
  `kd_poli` varchar(255) NOT NULL,
  `kd_regist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`no_praktek`, `jadwal_praktek`, `kd_poli`, `kd_regist`) VALUES
('SK00121', '10:30:00', '', 'RGS00008'),
('Sknnwuu', '00:00:00', '', 'RGS00007');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluhan`
--

CREATE TABLE `tb_keluhan` (
  `no_rm` varchar(255) NOT NULL,
  `tgl_kunjungan` date NOT NULL,
  `no_praktek` varchar(255) DEFAULT NULL,
  `jenis_kasus` varchar(255) NOT NULL,
  `keluhan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `kd_pasien` varchar(255) NOT NULL,
  `buktikeluhan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keluhan`
--

INSERT INTO `tb_keluhan` (`no_rm`, `tgl_kunjungan`, `no_praktek`, `jenis_kasus`, `keluhan`, `harga`, `status`, `kd_pasien`, `buktikeluhan`) VALUES
('KONS0001', '2020-12-02', 'SK00121', 'aaa', 'aa', 10000, 3, 'PSN0001', 'default.jpeg'),
('KONS0002', '2020-12-01', '', 'aa', 'aa', 10000, 1, 'PSN0001', 'default.jpeg'),
('KONS0004', '2020-12-16', 'SK00121', 'asas', 'asas', 10000, 3, 'PSN0001', 'default.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_konsul`
--

CREATE TABLE `tb_konsul` (
  `kd_konsul` varchar(255) NOT NULL,
  `no_rm` varchar(255) NOT NULL,
  `kd_resep` varchar(255) DEFAULT NULL,
  `harga_kirim` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_konsul`
--

INSERT INTO `tb_konsul` (`kd_konsul`, `no_rm`, `kd_resep`, `harga_kirim`, `grand_total`, `status`) VALUES
('KONS0001', 'KONS0002', '', 0, 0, 0),
('KONS0002', 'KONS0001', 'RES0002', 0, 0, 0),
('KONS0003', 'KONS0004', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `kd_pasien` varchar(255) NOT NULL,
  `kd_regist` varchar(255) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `umur` varchar(10) NOT NULL,
  `keterbatasan` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `warga_negara` varchar(255) NOT NULL,
  `status_perkawinan` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `no_nik` varchar(16) NOT NULL,
  `alamat_pasien` varchar(255) NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `hub_pasien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`kd_pasien`, `kd_regist`, `nama_pasien`, `tempat_lahir`, `tgl_lahir`, `umur`, `keterbatasan`, `jenis_kelamin`, `warga_negara`, `status_perkawinan`, `pendidikan`, `agama`, `pekerjaan`, `no_nik`, `alamat_pasien`, `no_tlp`, `nama_ayah`, `nama_ibu`, `foto`, `hub_pasien`) VALUES
('PSN0001', '', 'Brl', 'Smp', '2020-12-01', '22', 'GILA', 'Laki-Laki', 'WNA', 'KAWIN', 'STM', 'Islam Katanya', 'Begal', '34555123123', 'Smp', '0897878787887', 'Dr. Azz', 'Gatau', 'default.jpg', 'Orang Dalam');

-- --------------------------------------------------------

--
-- Table structure for table `tb_poli`
--

CREATE TABLE `tb_poli` (
  `kd_poli` varchar(255) NOT NULL,
  `klinik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_poli`
--

INSERT INTO `tb_poli` (`kd_poli`, `klinik`) VALUES
('POL0001', 'Poli Umum'),
('POL0002', 'Poli Dalam');

-- --------------------------------------------------------

--
-- Table structure for table `tb_registrasi`
--

CREATE TABLE `tb_registrasi` (
  `kd_regist` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `kd_role` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_registrasi`
--

INSERT INTO `tb_registrasi` (`kd_regist`, `name`, `email`, `image`, `password`, `kd_role`, `is_active`, `date_created`, `alamat`, `no_hp`, `tgl_lahir`, `tempat_lahir`) VALUES
('RGS00001', 'HamAdm', 'admin@gmail.com', 'picture-201221-e832699b80.jpg', '202cb962ac59075b964b07152d234b70', 1, 1, '2020-12-10 11:36:34', 'BWI', '89693556052', '2020-12-10', 'Banyuwangi'),
('RGS00003', 'User', 'user@gmail.com', 'default.jpeg', '202cb962ac59075b964b07152d234b70', 3, 1, '2020-12-10 11:36:34', 'Jember', '896956789', '1999-07-21', 'Rumah Sakit'),
('RGS00007', 'Birril x Azz', 'hammerpmc021@gmail.com', 'default.jpeg', '202cb962ac59075b964b07152d234b70', 2, 1, '2020-12-17 02:22:40', '', '', '0000-00-00', ''),
('RGS00008', 'Dr.Ham', 'dokter@gmail.com', 'picture-201221-1f41b0d861.jpg', '202cb962ac59075b964b07152d234b70', 2, 1, '2020-12-17 02:32:05', 'bwi', '08989841713', '2020-12-23', 'BWI');

-- --------------------------------------------------------

--
-- Table structure for table `tb_resep`
--

CREATE TABLE `tb_resep` (
  `kd_resep` varchar(255) NOT NULL,
  `resep` varchar(255) NOT NULL,
  `harga_resep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_resep`
--

INSERT INTO `tb_resep` (`kd_resep`, `resep`, `harga_resep`) VALUES
('RES0002', 'beli diapotek', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `kd_role` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`kd_role`, `role`) VALUES
(1, 'admin'),
(2, 'dokter'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `kd_role` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `kd_role`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(6, 1, 3),
(7, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 2, 'Change Password', 'user/changepass', 'fas fa-fw fa-key', 1),
(9, 2, 'Barang', 'barang', 'fas fa-fw fa-folder', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `v_num` int(4) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id_token`, `email`, `token`, `v_num`, `date_created`) VALUES
(1, 'Birril', '15fc5b9d597cbe', 82, '0000-00-00 00:00:00'),
(10, 'mubifaz12@gmail.com', '15fc5d16e85b5f', 70, '2020-12-01 12:15:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `send_by` (`send_by`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`no_praktek`);

--
-- Indexes for table `tb_keluhan`
--
ALTER TABLE `tb_keluhan`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indexes for table `tb_konsul`
--
ALTER TABLE `tb_konsul`
  ADD PRIMARY KEY (`kd_konsul`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`kd_pasien`);

--
-- Indexes for table `tb_poli`
--
ALTER TABLE `tb_poli`
  ADD PRIMARY KEY (`kd_poli`);

--
-- Indexes for table `tb_registrasi`
--
ALTER TABLE `tb_registrasi`
  ADD PRIMARY KEY (`kd_regist`);

--
-- Indexes for table `tb_resep`
--
ALTER TABLE `tb_resep`
  ADD PRIMARY KEY (`kd_resep`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`kd_role`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `kd_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`send_by`) REFERENCES `tb_registrasi` (`kd_regist`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
