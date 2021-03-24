-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 07:27 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `officia`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `NIK` varchar(255) NOT NULL,
  `Nama` char(255) NOT NULL,
  `Nama_Perusahaan` varchar(255) NOT NULL,
  `Tanggal` date NOT NULL,
  `Jam_masuk` time NOT NULL,
  `stat_1` char(1) NOT NULL,
  `Jam_pulang` time NOT NULL,
  `stat_2` char(1) NOT NULL,
  `Terlambat` time NOT NULL,
  `Status` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`NIK`, `Nama`, `Nama_Perusahaan`, `Tanggal`, `Jam_masuk`, `stat_1`, `Jam_pulang`, `stat_2`, `Terlambat`, `Status`) VALUES
('12345', 'Debug', 'Officia', '2021-03-23', '09:22:27', 'S', '00:00:00', 'B', '00:00:00', 'Absen Terlalu Pagi');

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` varchar(255) NOT NULL,
  `Nama` char(255) NOT NULL,
  `NIK` varchar(255) NOT NULL,
  `Nama_Perusahaan` varchar(255) NOT NULL,
  `Jenis_Cuti` varchar(255) NOT NULL,
  `Dari` date DEFAULT NULL,
  `Sampai` date DEFAULT NULL,
  `Keterangan` longtext DEFAULT NULL,
  `Status` varchar(255) NOT NULL,
  `Submitted_On_Hours` time DEFAULT NULL,
  `Submitted_On_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `Nama`, `NIK`, `Nama_Perusahaan`, `Jenis_Cuti`, `Dari`, `Sampai`, `Keterangan`, `Status`, `Submitted_On_Hours`, `Submitted_On_Date`) VALUES
('Debug1616316664', 'Debug', '12345', 'Officia', 'Cuti Tahunan', '2021-03-22', '2021-03-30', 'tes', 'Diterima', '15:51:04', '2021-03-21'),
('Debug1616321740', 'Debug', '12345', 'Officia', 'Cuti Sakit', '2021-03-23', '2021-03-24', 'sakit uhuk', 'Ditolak', '17:15:40', '2021-03-21'),
('Debug1616321757', 'Debug', '12345', 'Officia', 'Cuti Bersama', '2021-03-22', '2021-03-30', 'cuti bersama ganja', 'Ditolak', '17:15:57', '2021-03-21'),
('Debug1616402225', 'Debug', '12345', 'Officia', 'Cuti Tahunan', '2021-03-23', '2021-03-23', 'halo', 'unknown', '15:37:05', '2021-03-22'),
('Debug1616564284', 'Debug', '12345', 'Officia', 'Cuti Tahunan', '2021-03-25', '2021-03-26', 'cuti tes', 'unknown', '12:38:04', '2021-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `data_perusahaan`
--

CREATE TABLE `data_perusahaan` (
  `Nama_Perusahaan` varchar(255) NOT NULL,
  `Nama_Admin` char(255) NOT NULL,
  `NIK_Admin` varchar(255) NOT NULL,
  `Jenis_Kelamin` char(1) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `No_Telp` varchar(12) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Alamat_Perusahaan` longtext NOT NULL,
  `Absen_datang_min` time NOT NULL,
  `Absen_datang_max` time NOT NULL,
  `Absen_pulang_min` time NOT NULL,
  `Absen_pulang_max` time NOT NULL,
  `Submitted_On_Hours` time NOT NULL,
  `Submitted_On_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_perusahaan`
--

INSERT INTO `data_perusahaan` (`Nama_Perusahaan`, `Nama_Admin`, `NIK_Admin`, `Jenis_Kelamin`, `Email`, `No_Telp`, `Password`, `Alamat_Perusahaan`, `Absen_datang_min`, `Absen_datang_max`, `Absen_pulang_min`, `Absen_pulang_max`, `Submitted_On_Hours`, `Submitted_On_Date`) VALUES
('CDI', 'Aryo', '111', 'L', 'aryo@gmail.com', '081547272729', '111', 'jl holis', '06:00:00', '10:00:00', '15:00:00', '00:00:00', '16:47:47', '2021-03-22'),
('Officia', 'Admin_officia', '12345', '', 'adminof@gmail.com', '8461891', 'pwpw', 'jl kijang', '10:00:00', '12:00:00', '15:00:00', '00:00:00', '00:00:00', '0000-00-00'),
('Debug_mode', 'Developer', '999', '', 'somewhat@gmail.com', '0', 'pw', 'blah', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `NIK` varchar(255) NOT NULL,
  `Password` varchar(8) NOT NULL,
  `Nama` char(255) NOT NULL,
  `Nama_Perusahaan` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Jabatan` varchar(255) NOT NULL,
  `Tanggal_Lahir` int(2) NOT NULL,
  `Bulan_Lahir` int(2) NOT NULL,
  `Tahun_Lahir` int(4) NOT NULL,
  `Jenis_Kelamin` char(1) NOT NULL,
  `No_Telp` varchar(12) NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `pp_name` varchar(255) NOT NULL,
  `Pertanyaan` int(2) NOT NULL,
  `Jawaban` varchar(255) NOT NULL,
  `Submitted_On_Hours` time NOT NULL,
  `Submitted_On_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`NIK`, `Password`, `Nama`, `Nama_Perusahaan`, `Email`, `Jabatan`, `Tanggal_Lahir`, `Bulan_Lahir`, `Tahun_Lahir`, `Jenis_Kelamin`, `No_Telp`, `Alamat`, `pp_name`, `Pertanyaan`, `Jawaban`, `Submitted_On_Hours`, `Submitted_On_Date`) VALUES
('12345', 'pw', 'Debug', 'Officia', 'opicia@gmail.com', 'OB', 12, 5, 2004, 'L', '847151810', 'Jl kapung', 'default.png', 0, '', '00:00:00', '0000-00-00'),
('69', 'pw', 'Dev', 'Debug_mode', 'blah@gmail.com', 'developer', 1, 1, 1, '1', '0', 'blu', 'default.png', 0, '', '00:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` varchar(255) NOT NULL,
  `Nama_Perusahaan` varchar(255) NOT NULL,
  `Nama_Admin` char(255) NOT NULL,
  `NIK_Admin` varchar(255) NOT NULL,
  `Tanggal` date NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Isi_Pengumuman` longtext NOT NULL,
  `Tujuan` varchar(255) NOT NULL,
  `Submitted_On_Hours` time NOT NULL,
  `Submitted_On_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `Nama_Perusahaan`, `Nama_Admin`, `NIK_Admin`, `Tanggal`, `Judul`, `Isi_Pengumuman`, `Tujuan`, `Submitted_On_Hours`, `Submitted_On_Date`) VALUES
('Officia123', 'Officia', 'Admin_Officia', '12345', '2021-03-24', 'tes', 'isi', 'Seluruh Karyawan', '16:01:30', '2021-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` varchar(255) NOT NULL,
  `Nama_Perusahaan` varchar(255) NOT NULL,
  `Nama_Admin` char(255) NOT NULL,
  `NIK_Admin` varchar(255) NOT NULL,
  `Tanggal` date NOT NULL,
  `Judul` mediumtext NOT NULL,
  `Isi_Tugas` longtext NOT NULL,
  `Tujuan` varchar(255) NOT NULL,
  `Submitted_On_Hours` time NOT NULL,
  `Submitted_On_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `Nama_Perusahaan`, `Nama_Admin`, `NIK_Admin`, `Tanggal`, `Judul`, `Isi_Tugas`, `Tujuan`, `Submitted_On_Hours`, `Submitted_On_Date`) VALUES
('Officia1616555653', 'Officia', 'Admin_officia', '12345', '2021-03-24', 'seluruh', '1', 'Seluruh Karyawan', '10:14:13', '2021-03-24'),
('Officia1616555662', 'Officia', 'Admin_officia', '12345', '2021-03-24', 'ob', '2', 'OB', '10:14:22', '2021-03-24'),
('Officia1616555669', 'Officia', 'Admin_officia', '12345', '2021-03-24', 'pri', '3', '12345', '10:14:29', '2021-03-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_perusahaan`
--
ALTER TABLE `data_perusahaan`
  ADD PRIMARY KEY (`NIK_Admin`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`NIK`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
