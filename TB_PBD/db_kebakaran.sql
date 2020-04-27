-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2020 at 03:21 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kebakaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_kecamatan`
--

CREATE TABLE `detail_kecamatan` (
  `id_kebakaran` varchar(5) NOT NULL,
  `id_kecamatan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_kerugian`
--

CREATE TABLE `detail_kerugian` (
  `id_kebakaran` varchar(5) NOT NULL,
  `id_kerugian` varchar(5) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_lokasi`
--

CREATE TABLE `detail_lokasi` (
  `id_kebakaran` varchar(5) NOT NULL,
  `id_lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kebakaran`
--

CREATE TABLE `kebakaran` (
  `id_kebakaran` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `id_penyebab` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` varchar(5) NOT NULL,
  `nama_kecamatan` varchar(30) NOT NULL,
  `geom` geometry NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kerugian`
--

CREATE TABLE `kerugian` (
  `id_kerugian` varchar(5) NOT NULL,
  `jenis_kerugian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kerugian`
--

INSERT INTO `kerugian` (`id_kerugian`, `jenis_kerugian`) VALUES
('KR01', 'Kerugian Materi'),
('KR02', 'Kendaraan');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_korban`
--

CREATE TABLE `kondisi_korban` (
  `id_kondisi` varchar(5) NOT NULL,
  `kondisi_korban` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kondisi_korban`
--

INSERT INTO `kondisi_korban` (`id_kondisi`, `kondisi_korban`) VALUES
('KD01', 'Luka Bakar'),
('KD02', 'Meninggal Dunia');

-- --------------------------------------------------------

--
-- Table structure for table `korban`
--

CREATE TABLE `korban` (
  `id_kebakaran` varchar(5) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `id_kondisi` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` varchar(255) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` varchar(5) NOT NULL,
  `jenis_mobil` varchar(30) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `jenis_mobil`, `keterangan`) VALUES
('M01', 'Mobil Pemadam Kebakaran', 'Mobil Pemadam Kebakaran'),
('M02', 'Mobil Rescue', 'Mobil Rescue');

-- --------------------------------------------------------

--
-- Table structure for table `penanganan`
--

CREATE TABLE `penanganan` (
  `id_kebakaran` varchar(5) NOT NULL,
  `id_mobil` varchar(5) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `nik` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `umur` varchar(5) NOT NULL,
  `pekerjaan` varchar(40) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`nik`, `nama`, `umur`, `pekerjaan`, `keterangan`) VALUES
('131415161718', 'Farhan Naufal Otra', '20', 'Pelajar', 'Test'),
('141516171819', 'Adit', '19', 'Pelajar', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `penyebab`
--

CREATE TABLE `penyebab` (
  `id_penyebab` varchar(5) NOT NULL,
  `penyebab` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyebab`
--

INSERT INTO `penyebab` (`id_penyebab`, `penyebab`) VALUES
('P01', 'Konsleting Listrik'),
('P02', 'Gas Bocor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_kecamatan`
--
ALTER TABLE `detail_kecamatan`
  ADD PRIMARY KEY (`id_kebakaran`,`id_kecamatan`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `detail_kerugian`
--
ALTER TABLE `detail_kerugian`
  ADD PRIMARY KEY (`id_kebakaran`,`id_kerugian`),
  ADD KEY `id_kerugian` (`id_kerugian`);

--
-- Indexes for table `detail_lokasi`
--
ALTER TABLE `detail_lokasi`
  ADD PRIMARY KEY (`id_kebakaran`,`id_lokasi`),
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- Indexes for table `kebakaran`
--
ALTER TABLE `kebakaran`
  ADD PRIMARY KEY (`id_kebakaran`),
  ADD KEY `id_penyebab` (`id_penyebab`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `kerugian`
--
ALTER TABLE `kerugian`
  ADD PRIMARY KEY (`id_kerugian`);

--
-- Indexes for table `kondisi_korban`
--
ALTER TABLE `kondisi_korban`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indexes for table `korban`
--
ALTER TABLE `korban`
  ADD PRIMARY KEY (`id_kebakaran`,`nik`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_kondisi` (`id_kondisi`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD PRIMARY KEY (`id_kebakaran`,`id_mobil`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `penyebab`
--
ALTER TABLE `penyebab`
  ADD PRIMARY KEY (`id_penyebab`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_kecamatan`
--
ALTER TABLE `detail_kecamatan`
  ADD CONSTRAINT `detail_kecamatan_ibfk_1` FOREIGN KEY (`id_kebakaran`) REFERENCES `kebakaran` (`id_kebakaran`),
  ADD CONSTRAINT `detail_kecamatan_ibfk_2` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`);

--
-- Constraints for table `detail_kerugian`
--
ALTER TABLE `detail_kerugian`
  ADD CONSTRAINT `detail_kerugian_ibfk_1` FOREIGN KEY (`id_kebakaran`) REFERENCES `kebakaran` (`id_kebakaran`),
  ADD CONSTRAINT `detail_kerugian_ibfk_2` FOREIGN KEY (`id_kerugian`) REFERENCES `kerugian` (`id_kerugian`),
  ADD CONSTRAINT `detail_kerugian_ibfk_3` FOREIGN KEY (`id_kebakaran`) REFERENCES `kebakaran` (`id_kebakaran`);

--
-- Constraints for table `detail_lokasi`
--
ALTER TABLE `detail_lokasi`
  ADD CONSTRAINT `detail_lokasi_ibfk_1` FOREIGN KEY (`id_kebakaran`) REFERENCES `kebakaran` (`id_kebakaran`),
  ADD CONSTRAINT `detail_lokasi_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`);

--
-- Constraints for table `kebakaran`
--
ALTER TABLE `kebakaran`
  ADD CONSTRAINT `kebakaran_ibfk_1` FOREIGN KEY (`id_penyebab`) REFERENCES `penyebab` (`id_penyebab`);

--
-- Constraints for table `korban`
--
ALTER TABLE `korban`
  ADD CONSTRAINT `korban_ibfk_1` FOREIGN KEY (`id_kebakaran`) REFERENCES `kebakaran` (`id_kebakaran`),
  ADD CONSTRAINT `korban_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `penduduk` (`nik`),
  ADD CONSTRAINT `korban_ibfk_3` FOREIGN KEY (`id_kondisi`) REFERENCES `kondisi_korban` (`id_kondisi`);

--
-- Constraints for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD CONSTRAINT `penanganan_ibfk_1` FOREIGN KEY (`id_kebakaran`) REFERENCES `kebakaran` (`id_kebakaran`),
  ADD CONSTRAINT `penanganan_ibfk_2` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
