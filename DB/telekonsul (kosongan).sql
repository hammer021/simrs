-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2020 at 11:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL COMMENT '0 = belom dibaca, 1= sudah dibaca'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `no_praktek` varchar(255) NOT NULL,
  `kd_regist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter_poli`
--

CREATE TABLE `tb_dokter_poli` (
  `kd_dok_pol` int(11) NOT NULL,
  `no_praktek` varchar(255) NOT NULL,
  `kd_poli` varchar(255) NOT NULL,
  `startwaktu` time NOT NULL,
  `endwaktu` time NOT NULL,
  `senin` int(1) NOT NULL,
  `selasa` int(1) NOT NULL,
  `rabu` int(1) NOT NULL,
  `kamis` int(1) NOT NULL,
  `jumat` int(1) NOT NULL,
  `sabtu` int(1) NOT NULL,
  `minggu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluhan`
--

CREATE TABLE `tb_keluhan` (
  `no_rm` varchar(255) NOT NULL,
  `tgl_kunjungan` date NOT NULL,
  `kd_dok_pol` int(11) DEFAULT NULL,
  `jenis_kasus` varchar(255) NOT NULL,
  `keluhan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `kd_pasien` varchar(255) NOT NULL,
  `buktikeluhan` varchar(255) DEFAULT NULL,
  `jadwal_konsul` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_konsul`
--

CREATE TABLE `tb_konsul` (
  `kd_konsul` varchar(255) NOT NULL,
  `no_rm` varchar(255) NOT NULL,
  `kd_resep` varchar(255) DEFAULT NULL,
  `harga_kirim` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `status_kons` int(1) NOT NULL,
  `buktikonsul` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_poli`
--

CREATE TABLE `tb_poli` (
  `kd_poli` varchar(255) NOT NULL,
  `klinik` varchar(255) NOT NULL,
  `harga_poli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_poli`
--

INSERT INTO `tb_poli` (`kd_poli`, `klinik`, `harga_poli`) VALUES
('POL0001', 'Poli Umum', 0),
('POL0002', 'Poli Dalam', 0);

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
('RGS00000', 'SuperAdmin', 'superadmin@gmail.com', 'default.jpeg', '202cb962ac59075b964b07152d234b70', 0, 1, '2020-12-10 11:36:34', 'BWI', '89693556052', '2020-12-10', 'Banyuwangi'),
('RGS00001', 'Admin', 'admin@gmail.com', 'default.jpeg', '202cb962ac59075b964b07152d234b70', 1, 1, '2020-12-10 11:36:34', 'BWI', '89693556052', '2020-12-10', 'Banyuwangi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_resep`
--

CREATE TABLE `tb_resep` (
  `kd_resep` varchar(255) NOT NULL,
  `resep` varchar(255) NOT NULL,
  `harga_resep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(0, 'superadmin'),
(1, 'admin'),
(2, 'dokter'),
(3, 'user');

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
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `send_by` (`send_by`);

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`no_praktek`);

--
-- Indexes for table `tb_dokter_poli`
--
ALTER TABLE `tb_dokter_poli`
  ADD PRIMARY KEY (`kd_dok_pol`);

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
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_dokter_poli`
--
ALTER TABLE `tb_dokter_poli`
  MODIFY `kd_dok_pol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `kd_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
