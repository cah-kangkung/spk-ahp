-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2021 at 02:43 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_ahp_fix`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot_alternatif`
--

CREATE TABLE `bobot_alternatif` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai_bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bobot_alternatif`
--

INSERT INTO `bobot_alternatif` (`id`, `id_kriteria`, `id_siswa`, `nilai_bobot`) VALUES
(1, 1, 11, 0.504144),
(2, 1, 12, 0.259936),
(3, 1, 13, 0.037765),
(4, 1, 14, 0.198155),
(5, 3, 11, 0.375),
(6, 3, 12, 0.125),
(7, 3, 13, 0.125),
(8, 3, 14, 0.375),
(9, 4, 11, 0.388927),
(10, 4, 12, 0.388927),
(11, 4, 13, 0.0686945),
(12, 4, 14, 0.153452);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(128) NOT NULL,
  `kode_kriteria` varchar(8) NOT NULL,
  `jenis_nilai` enum('angka','huruf') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `kode_kriteria`, `jenis_nilai`) VALUES
(1, 'Nilai Akademik', 'K001', 'angka'),
(3, 'Nilai Sikap', 'K002', 'huruf'),
(4, 'Nilai Keaktifan', 'K003', 'huruf');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id`, `nilai`) VALUES
(1, 1),
(2, 2),
(3, 4),
(4, 0.5),
(5, 1),
(6, 5),
(7, 0.25),
(8, 0.2),
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_siswa`
--

CREATE TABLE `nilai_siswa` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_siswa`
--

INSERT INTO `nilai_siswa` (`id`, `id_kriteria`, `id_siswa`, `nilai`) VALUES
(16, 1, 11, '90'),
(17, 3, 11, 'A'),
(18, 4, 11, 'A'),
(19, 1, 12, '85'),
(20, 3, 12, 'B'),
(21, 4, 12, 'A'),
(22, 1, 13, '65'),
(23, 3, 13, 'B'),
(24, 4, 13, 'C'),
(25, 1, 14, '80'),
(26, 3, 14, 'A'),
(27, 4, 14, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(128) NOT NULL,
  `nisn` varchar(128) NOT NULL,
  `nis` varchar(128) NOT NULL,
  `jurusan` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status_nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `nisn`, `nis`, `jurusan`, `jenis_kelamin`, `alamat`, `no_telepon`, `status_nilai`) VALUES
(11, 'ADELLA AZANTHY', '0040059744', '9929', 'OTKP', 'Perempuan', 'Apus Kota Bambu Selatan Kec. Palmerah', '081932691210', 1),
(12, 'ADINDA PERMATA TASYA', '0033633593', '9930', 'OTKP', 'Perempuan', 'Jl. Apus II Gg. Kiapang Kota Bambu Selatan Kec. Palmerah', '08989613308', 1),
(13, 'ADITYA DWI KURNIA', '0025892845', '9932', 'OTKP', 'Laki-Laki', 'JL. DURI MAS BARAT NO. 22 DURI KEPA Kec. Kebon Jeruk', '0895362932503', 1),
(14, 'adil', '123', '123', 'AKL', 'Laki-Laki', 'ciledug', '12345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 1),
(7, 'guru', 'guru', 2),
(9, 'siswa', 'siswa', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot_alternatif`
--
ALTER TABLE `bobot_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kriteriabobot` (`id_kriteria`),
  ADD KEY `fk_siswabobot` (`id_siswa`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kriteria` (`id_kriteria`),
  ADD KEY `fk_siswa` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot_alternatif`
--
ALTER TABLE `bobot_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_alternatif`
--
ALTER TABLE `bobot_alternatif`
  ADD CONSTRAINT `fk_kriteriabobot` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_siswabobot` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  ADD CONSTRAINT `fk_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  ADD CONSTRAINT `fk_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
