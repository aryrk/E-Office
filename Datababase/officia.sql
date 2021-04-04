-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2021 at 05:05 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16340083_officia`
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
('Officia', 'Admin_officia', '12345', 'L', 'officiacentre@gmail.com', '083435545545', 'pwpw', 'Jl holis', '06:00:00', '10:00:00', '15:00:00', '00:00:00', '12:00:25', '2021-04-04');

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
('12345', 'pw', 'Debug', 'Officia', 'debug@gmail.com', 'OB', 18, 5, 2004, 'L', '081547272729', 'Jl holis', '12345Officia1617512641.png', 2, 'Pizza', '12:02:01', '2021-04-04');

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
  `Deadline` date NOT NULL,
  `Judul` mediumtext NOT NULL,
  `Isi_Tugas` longtext NOT NULL,
  `Tujuan` varchar(255) NOT NULL,
  `colom_active` tinyint(1) NOT NULL,
  `is_pub` tinyint(1) NOT NULL,
  `Submitted_On_Hours` time NOT NULL,
  `Submitted_On_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
