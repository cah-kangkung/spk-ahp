-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2021 at 06:12 AM
-- Server version: 10.4.14-MariaDB
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
(1, 1, 6, 0.0909104),
(2, 1, 7, 0.0452155),
(3, 1, 8, 0.561074),
(4, 1, 9, 0.3028),
(5, 3, 6, 0.0374355),
(6, 3, 7, 0.221359),
(7, 3, 8, 0.519846),
(8, 3, 9, 0.221359),
(9, 4, 6, 0.0357143),
(10, 4, 7, 0.321429),
(11, 4, 8, 0.321429),
(12, 4, 9, 0.321429);

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
(1, 1, 6, '60'),
(2, 3, 6, 'F'),
(3, 4, 6, 'F'),
(4, 1, 7, '40'),
(5, 3, 7, 'B'),
(6, 4, 7, 'A'),
(7, 1, 8, '100'),
(8, 3, 8, 'A'),
(9, 4, 8, 'A'),
(10, 1, 9, '85'),
(11, 3, 9, 'B'),
(12, 4, 9, 'A');

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
(6, 'AHMAD RIFAI ARIF', '111', '01', 'AKL', 'Laki-Laki', 'asoy', '090909', 1),
(7, 'udin', '0025126583', '9751', 'AKL', 'Laki-Laki', 'uhuy', '123', 1),
(8, 'ADITYA DWI KURNIA', '0016078513', '9756', 'AKL', 'Laki-Laki', 'cuy', '456', 1),
(9, 'Haekal Uchiha', '31710000', '33201000', 'OTKP', 'Laki-Laki', 'Jalan jalan ke kebon teh cakep', '08121212121212', 1);

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
(7, 'guru', 'guru', 2);

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
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
