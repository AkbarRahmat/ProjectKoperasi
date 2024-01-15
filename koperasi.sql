-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 08, 2024 at 02:41 AM
-- Server version: 10.11.6-MariaDB-1:10.11.6+maria~ubu2204
-- PHP Version: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `ID_Anggota` bigint(255) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `NIK` varchar(20) DEFAULT NULL,
  `Gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `No_Telepon` varchar(15) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Create_By` varchar(50) DEFAULT NULL,
  `Create_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('Aktif','Non-Aktif') DEFAULT 'Aktif',
  `Role` enum('admin','user') NOT NULL DEFAULT 'user',
  `Status_Deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`ID_Anggota`, `Nama`, `Alamat`, `Tanggal_Lahir`, `NIK`, `Gender`, `No_Telepon`, `Email`, `Username`, `Password`, `Create_By`, `Create_Date`, `Status`, `Role`, `Status_Deleted`) VALUES
(16, 'putra pamungkas', 'purwasari', '2023-11-07', '360315500599031', 'Laki-laki', '121233333331', 'putrap200405@gmail.com', 'putra', 'popo', NULL, '2023-11-30 14:05:41', 'Aktif', 'user', 1),
(17, 'fajar maulana sikumbang', 'Telagasari', '2023-11-29', '32151721333321232', 'Laki-laki', '0899997767656', 'fajar27@gmail.com', 'fajar', '1234', NULL, '2023-12-03 12:41:11', 'Aktif', 'user', 0),
(19, 'akbar rahmat', 'cikampek', '2023-11-30', '0809090989213', 'Laki-laki', '93973721983791', 'akbar11@gmail.com', 'akbar', '00pp', NULL, '2023-12-12 11:42:56', 'Aktif', 'user', 0),
(20, 'putri lestri', 'purwasari', '2023-11-06', '3603155005990014', 'Perempuan', '098098909890', 'putrap4869@gmail.com', 'putri', '9900', NULL, '2023-11-30 13:45:02', 'Aktif', 'admin', 0),
(21, 'namasan', 'alamatsan', '2023-11-02', '8765678765678', 'Laki-laki', '0876789878987', 'emailsan@gmail.com', 'namasan', 'okm', NULL, '2024-01-06 01:52:01', 'Aktif', 'user', 0),
(22, 'Nurhadi', 'cikarang barat', '2023-09-08', '987656787678', 'Perempuan', '0989987654567', 'email3@gmail.com', 'nama3', 'wsx', NULL, '2024-01-06 01:52:40', 'Aktif', 'user', 0),
(23, 'Fahri', 'Telagasari', '2001-12-11', '3252323423400770', 'Laki-laki', '083432423342', 'fahriri@gmail.com', 'Fahri', 'lolo', NULL, '2024-01-06 18:15:08', 'Aktif', 'user', 0),
(26, 'Asep', 'Cikampek', '2000-01-01', '32657156721', 'Laki-laki', '081231211', 'sepp@gmail.com', 'Asep', 'POPOLKUPA', NULL, '2024-01-06 18:19:17', 'Aktif', 'user', 0),
(27, 'ucup', 'purwakarta ', '2024-01-07', '329886737223323', 'Laki-laki', '08562717717', 'ucupp@gmail.com', 'ucupp', '123', NULL, '2024-01-06 23:58:10', 'Aktif', 'user', 0),
(28, 'Ahmad yuda ', 'Kota baru', '2024-01-07', '455677778', 'Laki-laki', '678866655', 'gggghhhh@gmail.com', 'gggjjhhhh', 'tffggghhhhh', NULL, '2024-01-07 03:19:34', 'Aktif', 'user', 0),
(29, 'Aida', 'purwasari', '2001-02-21', '09876567891323', 'Perempuan', '0987654323456', 'gua@gmail.com', 'Aida', 'mnbv', NULL, '2024-01-07 10:05:34', 'Aktif', 'user', 0),
(30, 'Wildan maulana', 'Kota baru', '1986-01-07', '53926748398', 'Laki-laki', '0899999999999', 'gsjja@dj.com', 'Wildan', 'wodjkk', NULL, '2024-01-07 12:18:30', 'Aktif', 'user', 0),
(31, 'Rizal', 'Cimahi', '1986-01-07', '53926748398', 'Laki-laki', '0899999999999', 'gsjja@dj.com', 'Rijal', 'wodjkk', NULL, '2024-01-07 12:18:42', 'Aktif', 'user', 0),
(32, 'widia', 'jatirasa', '2006-07-16', '321517610703', 'Perempuan', '08129510603', 'widia16@gmail.cok', 'widia16', '123456', NULL, '2024-01-07 16:19:07', 'Aktif', 'user', 0),
(33, 'fahri', 'Karawang', '1964-01-09', '32252730948447', 'Laki-laki', '082772726', 'fahri9@gmail.com', 'fahri9', '1234', NULL, '2024-01-07 16:21:01', 'Aktif', 'user', 0),
(34, 'Raden Mahendra Ananda Soemadisoeria', 'Jl. Gumuruh No.90 A', '2003-08-10', '3273121008030002', 'Laki-laki', '081806690453', 'mahendra.as0326@gmail.com', 'mahendra', 'mahen100803', NULL, '2024-01-07 16:36:45', 'Aktif', 'user', 0),
(35, 'Resa Septiani ', 'Karawang barat', '2004-05-27', '3212311241231', 'Perempuan', '085773342148', 'resasepti004@gmail.com', 'resaa_s', 'septiani4%', NULL, '2024-01-07 19:49:20', 'Aktif', 'user', 0);

--
-- Triggers `anggota`
--
DELIMITER $$
CREATE TRIGGER `Anggota_After_Insert` AFTER INSERT ON `anggota` FOR EACH ROW INSERT INTO anggota_history (ID_Anggota, Nama, Alamat, Tanggal_Lahir, NIK, Gender, No_Telepon, Username, Password, Create_By, Create_Date, Status, Action)
VALUES (NEW.ID_Anggota, NEW.Nama, NEW.Alamat, NEW.Tanggal_Lahir, NEW.NIK, NEW.Gender, NEW.No_Telepon, NEW.Username, NEW.Password, NEW.Create_By, NEW.Create_Date, NEW.Status, 'INSERT')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `anggota_history`
--

CREATE TABLE `anggota_history` (
  `ID_History` int(11) NOT NULL,
  `ID_Anggota` bigint(255) DEFAULT NULL,
  `Nama` varchar(255) NOT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `NIK` varchar(20) DEFAULT NULL,
  `Gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `No_Telepon` varchar(15) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Create_By` varchar(50) DEFAULT NULL,
  `Create_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif',
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Action` varchar(50) DEFAULT NULL,
  `Role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota_history`
--

INSERT INTO `anggota_history` (`ID_History`, `ID_Anggota`, `Nama`, `Alamat`, `Tanggal_Lahir`, `NIK`, `Gender`, `No_Telepon`, `Email`, `Username`, `Password`, `Create_By`, `Create_Date`, `Status`, `Timestamp`, `Action`, `Role`) VALUES
(25, 0, 'test', 'test', '2024-01-05', '3603155005990013', 'Laki-laki', '098098112230', '', 'test', '', NULL, '2024-01-05 10:02:17', 'Aktif', '2024-01-05 10:02:17', 'INSERT', 'admin'),
(26, 21, 'namasan', 'alamatsan', '2023-11-02', '8765678765678', 'Laki-laki', '0876789878987', '', 'namasan', 'okm', NULL, '2024-01-06 01:52:01', 'Aktif', '2024-01-06 01:52:01', 'INSERT', 'admin'),
(27, 22, 'nama3', 'alamt3', '2023-09-08', '987656787678', 'Perempuan', '0989987654567', '', 'nama3', 'wsx', NULL, '2024-01-06 01:52:40', 'Aktif', '2024-01-06 01:52:40', 'INSERT', 'admin'),
(28, 23, 'Fahri', 'Telagasari', '2001-12-11', '3252323423400770', 'Laki-laki', '083432423342', NULL, 'Fahri', 'lolo', NULL, '2024-01-06 18:15:08', 'Aktif', '2024-01-06 18:15:08', 'INSERT', 'admin'),
(29, 26, 'Asep', 'Cikampek', '2000-01-01', '32657156721', 'Laki-laki', '081231211', NULL, 'Asep', 'POPOLKUPA', NULL, '2024-01-06 18:19:17', 'Aktif', '2024-01-06 18:19:17', 'INSERT', 'admin'),
(30, 27, 'ucupp', 'ppp', '2024-01-07', '12', 'Laki-laki', '12', NULL, 'ucupp', '123', NULL, '2024-01-06 23:58:10', 'Aktif', '2024-01-06 23:58:10', 'INSERT', 'admin'),
(31, 28, 'ffffff', 'ffffyyy', '2024-01-07', '455677778', 'Perempuan', '678866655', NULL, 'gggjjhhhh', 'tffggghhhhh', NULL, '2024-01-07 03:19:34', 'Aktif', '2024-01-07 03:19:34', 'INSERT', 'admin'),
(32, 29, 'gua', 'purwasari', '2001-02-21', '09876567891323', 'Perempuan', '0987654323456', NULL, 'gua', 'mnbv', NULL, '2024-01-07 10:05:34', 'Aktif', '2024-01-07 10:05:34', 'INSERT', 'admin'),
(33, 30, 'Bogel', 'DC Cakung', '1986-01-07', '53926748398', 'Laki-laki', '0899999999999', NULL, 'Wodj', 'wodjkk', NULL, '2024-01-07 12:18:30', 'Aktif', '2024-01-07 12:18:30', 'INSERT', 'admin'),
(34, 31, 'Bogel', 'DC Cakung', '1986-01-07', '53926748398', 'Laki-laki', '0899999999999', NULL, 'Wodj', 'wodjkk', NULL, '2024-01-07 12:18:42', 'Aktif', '2024-01-07 12:18:42', 'INSERT', 'admin'),
(35, 32, 'widia', 'jatirasa', '2006-07-16', '321517610703', 'Perempuan', '08129510603', NULL, 'widia16', '123456', NULL, '2024-01-07 16:19:07', 'Aktif', '2024-01-07 16:19:07', 'INSERT', 'admin'),
(36, 33, 'fahri', 'Karawang', '1964-01-09', '32252730948447', 'Laki-laki', '082772726', NULL, 'fahri9', '1234', NULL, '2024-01-07 16:21:01', 'Aktif', '2024-01-07 16:21:01', 'INSERT', 'admin'),
(37, 34, 'Raden Mahendra Ananda Soemadisoeria', 'Jl. Gumuruh No.90 A', '2003-08-10', '3273121008030002', 'Laki-laki', '081806690453', NULL, 'mahendra', 'mahen100803', NULL, '2024-01-07 16:36:45', 'Aktif', '2024-01-07 16:36:45', 'INSERT', 'admin'),
(38, 35, 'Resa Septiani ', '', '2004-05-27', '', 'Perempuan', '085773342148', NULL, 'resaa_s', 'septiani4%', NULL, '2024-01-07 19:49:20', 'Aktif', '2024-01-07 19:49:20', 'INSERT', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_pinjaman`
--

CREATE TABLE `pembayaran_pinjaman` (
  `ID_Pembayaran` int(11) NOT NULL,
  `ID_Pinjaman` int(11) DEFAULT NULL,
  `Tanggal_Pembayaran` date DEFAULT NULL,
  `Nominal_Pembayaran` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran_pinjaman`
--

INSERT INTO `pembayaran_pinjaman` (`ID_Pembayaran`, `ID_Pinjaman`, `Tanggal_Pembayaran`, `Nominal_Pembayaran`) VALUES
(26, 74, '2024-01-06', 20000.00),
(27, 76, '2024-01-07', 100000.00),
(28, 77, '2024-01-07', 100000.00),
(29, 80, '2024-01-07', 20000.00),
(30, 81, '2024-01-07', 50000.00);

--
-- Triggers `pembayaran_pinjaman`
--
DELIMITER $$
CREATE TRIGGER `update_loan_status` AFTER INSERT ON `pembayaran_pinjaman` FOR EACH ROW BEGIN
    DECLARE total_paid DECIMAL(10, 2);
    DECLARE loan_amount DECIMAL(10, 2);
    
    SELECT SUM(Nominal_Pembayaran) INTO total_paid
    FROM pembayaran_pinjaman
    WHERE ID_Pinjaman = NEW.ID_Pinjaman;
    
    SELECT Jumlah_Pinjaman INTO loan_amount
    FROM pinjaman
    WHERE ID_Pinjaman = NEW.ID_Pinjaman;
    
    IF total_paid >= loan_amount THEN
        UPDATE pinjaman
        SET Status = 'Dibayar'
        WHERE ID_Pinjaman = NEW.ID_Pinjaman;
    END IF;
    
    INSERT INTO pembayaran_pinjaman_history (ID_Pinjaman, Tanggal_Pembayaran, Nominal_Pembayaran)
    VALUES (NEW.ID_Pinjaman, NEW.Tanggal_Pembayaran, NEW.Nominal_Pembayaran);
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_pinjaman_history`
--

CREATE TABLE `pembayaran_pinjaman_history` (
  `ID_Pembayaran_History` int(11) NOT NULL,
  `ID_Pinjaman` int(11) DEFAULT NULL,
  `Tanggal_Pembayaran` date DEFAULT NULL,
  `Nominal_Pembayaran` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran_pinjaman_history`
--

INSERT INTO `pembayaran_pinjaman_history` (`ID_Pembayaran_History`, `ID_Pinjaman`, `Tanggal_Pembayaran`, `Nominal_Pembayaran`) VALUES
(26, 74, '2024-01-06', 20000.00),
(27, 76, '2024-01-07', 100000.00),
(28, 77, '2024-01-07', 100000.00),
(29, 80, '2024-01-07', 20000.00),
(30, 81, '2024-01-07', 50000.00);

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `ID_Pinjaman` int(11) NOT NULL,
  `ID_Anggota` bigint(255) DEFAULT NULL,
  `Jumlah_Pinjaman` decimal(10,2) NOT NULL,
  `Tanggal_Pinjaman` date DEFAULT NULL,
  `Status` enum('Diajukan','Disetujui','Ditolak','Dibayar') DEFAULT 'Diajukan',
  `Nama_Anggota` varchar(255) DEFAULT NULL,
  `Status_Deleted` tinyint(1) NOT NULL DEFAULT 0,
  `Jatuh_Tempo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`ID_Pinjaman`, `ID_Anggota`, `Jumlah_Pinjaman`, `Tanggal_Pinjaman`, `Status`, `Nama_Anggota`, `Status_Deleted`, `Jatuh_Tempo`) VALUES
(74, 19, 20000.00, '2024-01-07', 'Dibayar', 'akbar rahmat', 1, '0000-00-00'),
(75, 19, 20000.00, '2024-01-07', 'Disetujui', 'akbar rahmat', 1, '0000-00-00'),
(76, 29, 100000.00, '2024-01-07', 'Dibayar', 'gua', 0, '0000-00-00'),
(77, 29, 100000.00, '2024-01-07', 'Dibayar', 'gua', 0, '0000-00-00'),
(78, 17, 10000.00, '2024-01-07', 'Disetujui', 'fajar maulana sikumbang', 0, '0000-00-00'),
(79, 19, 20000.00, '2024-01-07', 'Disetujui', 'akbar rahmat', 1, '0000-00-00'),
(80, 19, 20000.00, '2024-01-08', 'Dibayar', 'akbar rahmat', 0, '2024-02-08'),
(81, 19, 50000.00, '2024-01-08', 'Dibayar', 'akbar rahmat', 0, '2024-02-08');

--
-- Triggers `pinjaman`
--
DELIMITER $$
CREATE TRIGGER `Pinjaman_After_Insert` AFTER INSERT ON `pinjaman` FOR EACH ROW INSERT INTO pinjaman_history (ID_Pinjaman, ID_Anggota, Jumlah_Pinjaman, Tanggal_Pinjaman, Status, Action)
VALUES (NEW.ID_Pinjaman, NEW.ID_Anggota, NEW.Jumlah_Pinjaman, NEW.Tanggal_Pinjaman, NEW.Status, 'INSERT')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman_history`
--

CREATE TABLE `pinjaman_history` (
  `ID_History` int(11) NOT NULL,
  `ID_Pinjaman` int(11) DEFAULT NULL,
  `ID_Anggota` bigint(255) DEFAULT NULL,
  `Jumlah_Pinjaman` decimal(10,2) NOT NULL,
  `Tanggal_Pinjaman` date DEFAULT NULL,
  `Status` enum('Diajukan','Disetujui','Ditolak','Dibayar') DEFAULT 'Diajukan',
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Action` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pinjaman_history`
--

INSERT INTO `pinjaman_history` (`ID_History`, `ID_Pinjaman`, `ID_Anggota`, `Jumlah_Pinjaman`, `Tanggal_Pinjaman`, `Status`, `Timestamp`, `Action`) VALUES
(67, 71, 17, 50000.00, '2023-12-30', 'Diajukan', '2023-12-29 18:48:55', 'INSERT'),
(68, 72, 17, 100000.00, '2023-12-31', 'Diajukan', '2023-12-31 00:51:54', 'INSERT'),
(69, 73, 19, 100000.00, '2024-01-03', 'Diajukan', '2024-01-02 19:06:14', 'INSERT'),
(70, 74, 19, 20000.00, '2024-01-07', 'Diajukan', '2024-01-06 19:09:50', 'INSERT'),
(71, 75, 19, 20000.00, '2024-01-07', 'Diajukan', '2024-01-06 22:04:46', 'INSERT'),
(72, 76, 29, 100000.00, '2024-01-07', 'Diajukan', '2024-01-07 10:06:28', 'INSERT'),
(73, 77, 29, 100000.00, '2024-01-07', 'Diajukan', '2024-01-07 10:10:10', 'INSERT'),
(74, 78, 17, 10000.00, '2024-01-07', 'Diajukan', '2024-01-07 11:10:58', 'INSERT'),
(75, 79, 19, 20000.00, '2024-01-07', 'Diajukan', '2024-01-07 13:13:11', 'INSERT'),
(76, 80, 19, 20000.00, '2024-01-08', 'Diajukan', '2024-01-07 23:22:21', 'INSERT'),
(77, 81, 19, 50000.00, '2024-01-08', 'Diajukan', '2024-01-07 23:46:58', 'INSERT');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `ID_Simpanan` int(11) NOT NULL,
  `ID_Anggota` bigint(255) DEFAULT NULL,
  `Jumlah_Simpanan` decimal(10,2) NOT NULL,
  `Tanggal_Simpanan` date DEFAULT NULL,
  `Nama_Anggota` varchar(255) DEFAULT NULL,
  `Jenis_Simpanan` enum('Pokok','Sukarela','Wajib') DEFAULT NULL,
  `Status_Deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`ID_Simpanan`, `ID_Anggota`, `Jumlah_Simpanan`, `Tanggal_Simpanan`, `Nama_Anggota`, `Jenis_Simpanan`, `Status_Deleted`) VALUES
(33, 17, 75000.00, '2023-12-30', 'fajar', 'Wajib', 0),
(34, 17, 75000.00, '2023-12-30', 'fajar', 'Wajib', 0),
(55, 17, 20000.00, '2023-12-30', 'fajar', 'Wajib', 1),
(56, 17, 20000.00, '2023-12-30', 'fajar', 'Wajib', 1),
(57, 17, 20000.00, '2023-12-30', 'fajar', 'Wajib', 0),
(58, 17, 20000.00, '2023-12-30', 'fajar', 'Wajib', 0),
(59, 17, 20000.00, '2023-12-30', 'fajar', 'Wajib', 0),
(60, 17, 20000.00, '2023-12-30', 'fajar', 'Wajib', 1),
(63, 17, 75000.00, '2023-12-30', 'fajar', 'Wajib', 1),
(64, 19, 75000.00, '2024-01-03', 'akbar rahmat', 'Wajib', 1),
(65, 19, 75000.00, '2024-01-03', 'akbar rahmat', 'Wajib', 1),
(66, 29, 100000.00, '2024-01-07', 'gua', 'Sukarela', 0),
(67, 19, 75000.00, '2024-01-07', 'akbar rahmat', 'Wajib', 0);

--
-- Triggers `simpanan`
--
DELIMITER $$
CREATE TRIGGER `Simpanan_After_Insert` AFTER INSERT ON `simpanan` FOR EACH ROW INSERT INTO simpanan_history (ID_Simpanan, ID_Anggota, Jumlah_Simpanan, Tanggal_Simpanan, Action)
VALUES (NEW.ID_Simpanan, NEW.ID_Anggota, NEW.Jumlah_Simpanan, NEW.Tanggal_Simpanan, 'INSERT')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `simpanan_history`
--

CREATE TABLE `simpanan_history` (
  `ID_History` int(11) NOT NULL,
  `ID_Simpanan` int(11) DEFAULT NULL,
  `ID_Anggota` bigint(255) DEFAULT NULL,
  `Jumlah_Simpanan` decimal(10,2) NOT NULL,
  `Tanggal_Simpanan` date DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Action` varchar(50) DEFAULT NULL,
  `Jenis_Simpanan` enum('Pokok','Sukarela','Wajib') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simpanan_history`
--

INSERT INTO `simpanan_history` (`ID_History`, `ID_Simpanan`, `ID_Anggota`, `Jumlah_Simpanan`, `Tanggal_Simpanan`, `Timestamp`, `Action`, `Jenis_Simpanan`) VALUES
(33, 33, 17, 75000.00, '2023-12-30', '2023-12-29 18:48:23', 'INSERT', NULL),
(34, 34, 17, 75000.00, '2023-12-30', '2023-12-29 18:48:23', 'INSERT', NULL),
(35, 35, 17, 20000.00, '2023-12-30', '2023-12-29 19:13:18', 'INSERT', NULL),
(36, 36, 17, 20000.00, '2023-12-30', '2023-12-29 19:13:18', 'INSERT', NULL),
(37, 37, 17, 20000.00, '2023-12-30', '2023-12-29 19:19:02', 'INSERT', NULL),
(38, 38, 17, 20000.00, '2023-12-30', '2023-12-29 19:19:03', 'INSERT', NULL),
(39, 39, 17, 20000.00, '2023-12-30', '2023-12-29 20:35:05', 'INSERT', NULL),
(40, 40, 17, 20000.00, '2023-12-30', '2023-12-29 20:35:29', 'INSERT', NULL),
(41, 41, 17, 20000.00, '2023-12-30', '2023-12-29 20:52:02', 'INSERT', NULL),
(42, 42, 17, 20000.00, '2023-12-30', '2023-12-29 20:53:28', 'INSERT', NULL),
(43, 43, 17, 20000.00, '2023-12-30', '2023-12-29 20:54:44', 'INSERT', NULL),
(44, 44, 17, 20000.00, '2023-12-30', '2023-12-29 21:39:25', 'INSERT', NULL),
(45, 45, 17, 75000.00, '2023-12-30', '2023-12-29 21:57:24', 'INSERT', NULL),
(46, 46, 17, 75000.00, '2023-12-30', '2023-12-29 21:59:30', 'INSERT', NULL),
(47, 47, 17, 75000.00, '2023-12-30', '2023-12-29 22:00:35', 'INSERT', NULL),
(48, 48, 17, 75000.00, '2023-12-30', '2023-12-30 07:04:39', 'INSERT', NULL),
(49, 49, 17, 75000.00, '2023-12-30', '2023-12-30 07:05:34', 'INSERT', NULL),
(50, 50, 17, 20000.00, '2023-12-30', '2023-12-30 07:05:53', 'INSERT', NULL),
(51, 51, 17, 20000.00, '2023-12-30', '2023-12-30 07:06:41', 'INSERT', NULL),
(52, 52, 17, 20000.00, '2023-12-30', '2023-12-30 07:08:46', 'INSERT', NULL),
(53, 53, 17, 20000.00, '2023-12-30', '2023-12-30 07:09:10', 'INSERT', NULL),
(54, 54, 17, 20000.00, '2023-12-30', '2023-12-30 07:09:53', 'INSERT', NULL),
(55, 55, 17, 20000.00, '2023-12-30', '2023-12-30 07:26:48', 'INSERT', NULL),
(56, 56, 17, 20000.00, '2023-12-30', '2023-12-30 07:30:32', 'INSERT', NULL),
(57, 57, 17, 20000.00, '2023-12-30', '2023-12-30 14:07:20', 'INSERT', NULL),
(58, 58, 17, 20000.00, '2023-12-30', '2023-12-30 14:11:41', 'INSERT', NULL),
(59, 59, 17, 20000.00, '2023-12-30', '2023-12-30 14:14:08', 'INSERT', NULL),
(60, 60, 17, 20000.00, '2023-12-30', '2023-12-30 14:14:59', 'INSERT', NULL),
(61, 61, 17, 0.00, '0000-00-00', '2023-12-30 14:18:15', 'INSERT', NULL),
(62, 62, 17, 0.00, '0000-00-00', '2023-12-30 14:19:11', 'INSERT', NULL),
(63, 63, 17, 75000.00, '2023-12-30', '2023-12-30 14:21:48', 'INSERT', NULL),
(64, 64, 19, 75000.00, '2024-01-03', '2024-01-02 18:04:04', 'INSERT', NULL),
(65, 65, 19, 75000.00, '2024-01-03', '2024-01-02 18:04:39', 'INSERT', NULL),
(66, 66, 29, 75000.00, '2024-01-07', '2024-01-07 10:06:13', 'INSERT', NULL),
(67, 67, 19, 75000.00, '2024-01-07', '2024-01-07 13:12:03', 'INSERT', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`ID_Anggota`);

--
-- Indexes for table `anggota_history`
--
ALTER TABLE `anggota_history`
  ADD PRIMARY KEY (`ID_History`);

--
-- Indexes for table `pembayaran_pinjaman`
--
ALTER TABLE `pembayaran_pinjaman`
  ADD PRIMARY KEY (`ID_Pembayaran`),
  ADD KEY `ID_Pinjaman` (`ID_Pinjaman`);

--
-- Indexes for table `pembayaran_pinjaman_history`
--
ALTER TABLE `pembayaran_pinjaman_history`
  ADD PRIMARY KEY (`ID_Pembayaran_History`),
  ADD KEY `ID_Pinjaman` (`ID_Pinjaman`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`ID_Pinjaman`),
  ADD KEY `pinjaman_ibfk_2` (`ID_Anggota`);

--
-- Indexes for table `pinjaman_history`
--
ALTER TABLE `pinjaman_history`
  ADD PRIMARY KEY (`ID_History`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`ID_Simpanan`),
  ADD KEY `simpanan_ibfk_2` (`ID_Anggota`);

--
-- Indexes for table `simpanan_history`
--
ALTER TABLE `simpanan_history`
  ADD PRIMARY KEY (`ID_History`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `ID_Anggota` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `anggota_history`
--
ALTER TABLE `anggota_history`
  MODIFY `ID_History` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pembayaran_pinjaman`
--
ALTER TABLE `pembayaran_pinjaman`
  MODIFY `ID_Pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pembayaran_pinjaman_history`
--
ALTER TABLE `pembayaran_pinjaman_history`
  MODIFY `ID_Pembayaran_History` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `ID_Pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `pinjaman_history`
--
ALTER TABLE `pinjaman_history`
  MODIFY `ID_History` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `ID_Simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `simpanan_history`
--
ALTER TABLE `simpanan_history`
  MODIFY `ID_History` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran_pinjaman`
--
ALTER TABLE `pembayaran_pinjaman`
  ADD CONSTRAINT `pembayaran_pinjaman_ibfk_1` FOREIGN KEY (`ID_Pinjaman`) REFERENCES `pinjaman` (`ID_Pinjaman`);

--
-- Constraints for table `pembayaran_pinjaman_history`
--
ALTER TABLE `pembayaran_pinjaman_history`
  ADD CONSTRAINT `pembayaran_pinjaman_history_ibfk_1` FOREIGN KEY (`ID_Pinjaman`) REFERENCES `pinjaman` (`ID_Pinjaman`) ON DELETE CASCADE;

--
-- Constraints for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `pinjaman_ibfk_1` FOREIGN KEY (`ID_Anggota`) REFERENCES `anggota` (`ID_Anggota`),
  ADD CONSTRAINT `pinjaman_ibfk_2` FOREIGN KEY (`ID_Anggota`) REFERENCES `anggota` (`ID_Anggota`);

--
-- Constraints for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD CONSTRAINT `simpanan_ibfk_1` FOREIGN KEY (`ID_Anggota`) REFERENCES `anggota` (`ID_Anggota`),
  ADD CONSTRAINT `simpanan_ibfk_2` FOREIGN KEY (`ID_Anggota`) REFERENCES `anggota` (`ID_Anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
