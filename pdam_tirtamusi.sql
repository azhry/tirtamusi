-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20 Mar 2018 pada 00.00
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdam_tirtamusi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alum`
--

CREATE TABLE IF NOT EXISTS `alum` (
  `id_alum` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `terpakai` int(11) NOT NULL DEFAULT '0',
  `tanggal` datetime NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alum`
--

INSERT INTO `alum` (`id_alum`, `jumlah`, `terpakai`, `tanggal`, `id_pegawai`) VALUES
(3, 449, 449, '2018-02-19 15:39:27', 5),
(4, 200, 120, '2018-02-21 14:32:19', 2),
(5, 100, 0, '2018-03-01 11:42:14', 2),
(6, 300, 0, '2018-03-11 15:42:27', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kualitas_air`
--

CREATE TABLE IF NOT EXISTS `kualitas_air` (
  `id_kualitas` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(20) NOT NULL,
  `turb` float NOT NULL,
  `ph` float NOT NULL,
  `dhl` float NOT NULL,
  `tds` float NOT NULL,
  `tss` float NOT NULL,
  `temp` float NOT NULL,
  `jenis` enum('Baku','Bersih') NOT NULL DEFAULT 'Baku'
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kualitas_air`
--

INSERT INTO `kualitas_air` (`id_kualitas`, `tanggal`, `jam`, `turb`, `ph`, `dhl`, `tds`, `tss`, `temp`, `jenis`) VALUES
(7, '2016-12-22', '00.00-08.00', 19.27, 5.92, 35, 17.5, 31.78, 28.1, 'Baku'),
(8, '2016-12-22', '08.00-16.00', 22.1, 6.02, 35.6, 17.5, 36.44, 28.7, 'Baku'),
(9, '2016-12-22', '16.00-24.00', 18.4, 6.05, 34.9, 17.2, 30.34, 28.9, 'Baku'),
(10, '2016-12-23', '00.00-08.00', 18.6, 5.96, 36, 18.2, 30.67, 28.6, 'Baku'),
(11, '2016-12-23', '08.00-16.00', 16.5, 5.9, 37.5, 18.75, 27.21, 29.5, 'Baku'),
(12, '2016-12-23', '16.00-24.00', 18.6, 6, 36.8, 18.4, 30.67, 29.5, 'Baku'),
(13, '2016-12-24', '00.00-08.00', 18.3, 6.02, 36.2, 18.1, 30.18, 28.5, 'Baku'),
(15, '2016-12-24', '08.00-16.00', 16.1, 6.15, 35.6, 17.8, 26.55, 29.5, 'Baku'),
(16, '2016-12-24', '16.00-24.00', 15.8, 6.4, 39.9, 19.8, 26.05, 29, 'Baku'),
(17, '2016-12-25', '00.00-08.00', 26.7, 6.01, 35.3, 17.6, 44.03, 28.1, 'Baku'),
(18, '2016-12-25', '08.00-16.00', 20.1, 6.02, 38.6, 18.3, 33.14, 29, 'Baku'),
(19, '2016-12-25', '16.00-24.00', 21.6, 5.81, 37.9, 18.9, 35.62, 28.5, 'Baku'),
(20, '2016-12-26', '00.00-08.00', 21.72, 6.15, 37.6, 18.8, 35.82, 28.1, 'Baku'),
(21, '2016-12-26', '08.00-16.00', 19.4, 6.02, 38.9, 19.4, 31.99, 29.1, 'Baku'),
(22, '2016-12-26', '16.00-24.00', 22.8, 6.2, 40.6, 20.3, 37.6, 28.1, 'Baku'),
(23, '2016-12-27', '00.00-08.00', 21.75, 6.2, 38.5, 19.2, 35.87, 28.5, 'Baku'),
(24, '2016-12-27', '08.00-16.00', 18.6, 6.02, 43.6, 21.8, 30.67, 29.1, 'Baku'),
(25, '2016-12-27', '16.00-24.00', 23.2, 6.2, 39.5, 19.5, 38.26, 28.6, 'Baku'),
(26, '2016-12-28', '00.00-08.00', 22.21, 5.8, 39.6, 19.8, 36.62, 28.1, 'Baku'),
(27, '2016-12-28', '08.00-16.00', 18.6, 6.2, 42.6, 21.3, 30.67, 29.1, 'Baku'),
(28, '2016-12-29', '00.00-08.00', 21.58, 5.92, 42.3, 21.3, 35.59, 28.6, 'Baku'),
(29, '2016-12-29', '08.00-16.00', 17.6, 6.28, 45.5, 22.8, 29.02, 29.5, 'Baku'),
(31, '2016-12-29', '16.00-24.00', 23.6, 6.41, 40.6, 20.3, 38.92, 28.7, 'Baku'),
(32, '2016-12-30', '00.00-08.00', 29.1, 6.2, 43.6, 21.8, 47.99, 28.7, 'Baku'),
(33, '2016-12-30', '08.00-16.00', 24.4, 6.2, 44.5, 22.2, 40.24, 28.9, 'Baku'),
(34, '2016-12-30', '16.00-24.00', 34.6, 6.2, 42.2, 21.1, 57.06, 28.4, 'Baku'),
(36, '2016-12-31', '00.00-08.00', 34.8, 6.4, 39.9, 20.1, 57.39, 28.6, 'Baku'),
(38, '2016-12-31', '08.00-16.00', 27.48, 6.24, 46.3, 23.1, 45.31, 29.5, 'Baku'),
(39, '2016-12-31', '16.00-24.00', 34.48, 6.08, 42.8, 21.4, 56.86, 28.1, 'Baku'),
(40, '2017-01-01', '00.00-08.00', 34.88, 6.1, 40.6, 20.3, 57.52, 28.4, 'Baku'),
(41, '2017-01-01', '08.00-16.00', 27.5, 6.2, 48.6, 24.3, 45.35, 29.1, 'Baku'),
(42, '2017-01-01', '16.00-24.00', 34.8, 6.08, 44.6, 22.3, 57.39, 28.1, 'Baku'),
(43, '2017-01-02', '00.00-08.00', 33.18, 6.2, 42.5, 21.3, 54.71, 28.6, 'Baku'),
(45, '2017-01-02', '08.00-16.00', 24.5, 6.25, 70.6, 35.6, 40.4, 29.5, 'Baku'),
(46, '2017-01-02', '16.00-24.00', 27.1, 6.28, 58.6, 42.6, 44.69, 29.1, 'Baku'),
(47, '2017-01-03', '00.00-08.00', 29.6, 6.22, 84.6, 42.3, 48.81, 28.5, 'Baku'),
(48, '2017-01-03', '08.00-16.00', 26.75, 6.2, 95.7, 27.8, 44.11, 29.6, 'Baku'),
(49, '2018-01-03', '16.00-24.00', 25.6, 6.33, 90.2, 45.3, 42.21, 28.7, 'Baku'),
(50, '2017-01-04', '00.00-08.00', 27.6, 6.28, 90.8, 45.2, 45.51, 28.5, 'Baku'),
(53, '2017-01-04', '08.00-16.00', 25.8, 6.4, 96.6, 48.3, 42.54, 28.9, 'Baku'),
(54, '2017-01-04', '16.00-24.00', 21.8, 6.35, 90.5, 45.2, 35.95, 29.1, 'Baku'),
(55, '2017-01-05', '00.00-08.00', 28.5, 6.3, 94.5, 47.2, 47, 28.6, 'Baku'),
(56, '2017-01-05', '08.00-16.00', 32.2, 6.4, 90.6, 45.3, 53.1, 29.5, 'Baku'),
(57, '2017-01-05', '16.00-24.00', 21.1, 6.12, 59.3, 29.5, 34.79, 29, 'Baku'),
(58, '2017-01-06', '00.00-08.00', 23.66, 6.42, 91.5, 56.6, 39.02, 28.5, 'Baku'),
(59, '2017-01-06', '08.00-16.00', 26.5, 6.22, 54.8, 27.4, 43.7, 29.2, 'Baku'),
(60, '2017-01-06', '16.00-24.00', 26.7, 5.87, 56.6, 28.1, 44.03, 29.4, 'Baku');

-- --------------------------------------------------------

--
-- Struktur dari tabel `parameter_uji`
--

CREATE TABLE IF NOT EXISTS `parameter_uji` (
  `id_parameter` int(11) NOT NULL,
  `dosis_alum` float NOT NULL,
  `turb` float NOT NULL,
  `ph` float NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `parameter_uji`
--

INSERT INTO `parameter_uji` (`id_parameter`, `dosis_alum`, `turb`, `ph`, `tanggal`) VALUES
(67, 40, 25.7, 6.05, '2017-01-09'),
(72, 41, 28.6, 5.86, '2017-01-10'),
(73, 39, 23.7, 5.8, '2017-01-11'),
(76, 39, 26.3, 6.28, '2017-01-12'),
(82, 41, 30.6, 6.1, '2017-01-13'),
(84, 41, 31.1, 6.1, '2017-01-14'),
(91, 39, 24.6, 6.4, '2017-01-16'),
(93, 40, 29.5, 6.45, '2017-01-17'),
(96, 39, 29.2, 6.41, '2017-01-18'),
(99, 39, 28.2, 6.45, '2017-01-19'),
(103, 39, 26.9, 6.6, '2017-01-20'),
(109, 38, 18.8, 6.5, '2017-01-21'),
(112, 38, 18.6, 6.4, '2017-01-23'),
(115, 39, 25.5, 6.4, '2017-01-24'),
(119, 39, 21.1, 6.6, '2017-01-25'),
(123, 42, 39.2, 5.8, '2017-01-26'),
(125, 42, 43.03, 5.86, '2017-01-27'),
(129, 42, 55.1, 5.91, '2017-01-28'),
(134, 40, 35.15, 5.6, '2017-01-29'),
(136, 40, 33.6, 6.02, '2017-01-30'),
(140, 41, 43.8, 5.9, '2017-01-31'),
(166, 43, 58.7, 5.8, '2017-02-09'),
(169, 44, 57.47, 5.6, '2017-02-10'),
(174, 43, 65.96, 5.6, '2017-02-12'),
(182, 44, 50.48, 5.8, '2017-02-14'),
(183, 42, 52.65, 5.65, '2017-02-15'),
(186, 43, 46.96, 5.76, '2017-02-16'),
(190, 42, 53.75, 5.7, '2017-02-17'),
(193, 44, 58.3, 5.82, '2017-02-18'),
(207, 42, 51.3, 5.83, '2017-02-19'),
(210, 41, 44.8, 5.6, '2017-02-20'),
(214, 41, 49.23, 5.78, '2017-02-21'),
(219, 42, 49.96, 5.84, '2017-02-22'),
(220, 41, 44.1, 5.8, '2017-02-23'),
(223, 42, 56.5, 5.82, '2017-02-24'),
(227, 41, 43.86, 5.7, '2017-02-25'),
(232, 41, 53.61, 5.7, '2017-02-26'),
(235, 41, 42.3, 5.61, '2017-02-27'),
(236, 41, 42.3, 5.61, '2017-02-28'),
(239, 42, 40.24, 5.79, '2018-03-01'),
(243, 41, 44.78, 5.7, '2017-03-02'),
(244, 41, 43.95, 5.8, '2017-03-02'),
(247, 40, 35.91, 5.8, '2017-03-03'),
(248, 41, 42.7, 5.79, '2017-03-04'),
(253, 41, 41.76, 5.7, '2017-03-05'),
(255, 42, 51.77, 5.7, '2017-03-06'),
(282, 43, 57.36, 5.9, '2017-03-15'),
(286, 43, 56.6, 5.72, '2017-03-16'),
(289, 42, 51.2, 5.84, '2017-03-17'),
(290, 41, 44.61, 5.92, '2017-03-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `jabatan` enum('Gudang','Lab','Asisten Manajer') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nip`, `password`, `nama`, `jenis_kelamin`, `jabatan`) VALUES
(1, '09031181419025', 'e59cd3ce33a68f536c19fedb82a7936f', 'agung ramadan', 'Laki-laki', 'Lab'),
(2, '09031181419041', '8b8d05c12ad84143b2a7d61c261f0b5a', 'ramadan', 'Laki-laki', 'Gudang'),
(3, '09031181419026', '2e292ab5316142aecae9f309c4f14712', 'Udin', 'Laki-laki', 'Asisten Manajer'),
(5, '09031181419027', 'ade086ca466d3e70f149ed077d052077', 'agung', 'Laki-laki', 'Gudang');

-- --------------------------------------------------------

--
-- Stand-in structure for view `rata_rata_revisi`
--
CREATE TABLE IF NOT EXISTS `rata_rata_revisi` (
`hari_ke` varchar(2)
,`turb` double
,`dosis_alum` double
);

-- --------------------------------------------------------

--
-- Struktur untuk view `rata_rata_revisi`
--
DROP TABLE IF EXISTS `rata_rata_revisi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rata_rata_revisi` AS select date_format(`parameter_uji`.`tanggal`,'%d') AS `hari_ke`,avg(`parameter_uji`.`turb`) AS `turb`,avg(`parameter_uji`.`dosis_alum`) AS `dosis_alum` from `parameter_uji` group by date_format(`parameter_uji`.`tanggal`,'%d') order by date_format(`parameter_uji`.`tanggal`,'%d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alum`
--
ALTER TABLE `alum`
  ADD PRIMARY KEY (`id_alum`);

--
-- Indexes for table `kualitas_air`
--
ALTER TABLE `kualitas_air`
  ADD PRIMARY KEY (`id_kualitas`);

--
-- Indexes for table `parameter_uji`
--
ALTER TABLE `parameter_uji`
  ADD PRIMARY KEY (`id_parameter`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alum`
--
ALTER TABLE `alum`
  MODIFY `id_alum` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kualitas_air`
--
ALTER TABLE `kualitas_air`
  MODIFY `id_kualitas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `parameter_uji`
--
ALTER TABLE `parameter_uji`
  MODIFY `id_parameter` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=291;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
