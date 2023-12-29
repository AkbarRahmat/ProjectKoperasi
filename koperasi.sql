-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 22, 2023 at 07:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

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
  `ID_Anggota` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `NIK` varchar(20) DEFAULT NULL,
  `Gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `No_Telepon` varchar(15) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Create_By` varchar(50) DEFAULT NULL,
  `Create_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif',
  `Role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`ID_Anggota`, `Nama`, `Alamat`, `Tanggal_Lahir`, `NIK`, `Gender`, `No_Telepon`, `Email`, `Username`, `Password`, `Create_By`, `Create_Date`, `Status`, `Role`) VALUES
(15, 'Putri Pratiwi', 'purwasari', '2023-11-06', '3603155005990014', 'Perempuan', '098098909890', 'putrap4869@gmail.com', 'putri', '9900', NULL, '2023-11-30 13:45:02', 'Aktif', 'admin'),
(16, 'putra', 'purwasari', '2023-11-07', '360315500599031113', 'Laki-laki', '121233333331212', 'putrap200405@gmail.com', 'putra', 'popo', NULL, '2023-11-30 14:05:41', 'Aktif', 'user'),
(17, 'fajar', 'Telagasari', '2023-11-29', '32151721333321232', 'Laki-laki', '0899997767656', 'fajar27@gmail.com', 'Fajar', '1234', NULL, '2023-12-03 12:41:11', 'Aktif', 'user'),
(19, 'akbar', 'cikampek', '2023-11-30', '0809090989213', 'Laki-laki', '93973721983791', 'akbar11@gmail.com', 'akbar', '00pp', NULL, '2023-12-12 11:42:56', 'Aktif', 'user');

--
-- Triggers `anggota`
--
DELIMITER $$
CREATE TRIGGER `Anggota_After_Insert` AFTER INSERT ON `anggota` FOR EACH ROW INSERT INTO Anggota_History (ID_Anggota, Nama, Alamat, Tanggal_Lahir, NIK, Gender, No_Telepon, Username, Password, Create_By, Create_Date, Status, Action)
VALUES (NEW.ID_Anggota, NEW.Nama, NEW.Alamat, NEW.Tanggal_Lahir, NEW.NIK, NEW.Gender, NEW.No_Telepon, NEW.Username, NEW.Password, NEW.Create_By, NEW.Create_Date, NEW.Status, 'INSERT')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `anggota_history`
--

CREATE TABLE `anggota_history` (
  `ID_History` int(11) NOT NULL,
  `ID_Anggota` int(11) DEFAULT NULL,
  `Nama` varchar(255) NOT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `NIK` varchar(20) DEFAULT NULL,
  `Gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `No_Telepon` varchar(15) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
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
(1, 1, 'nama 1', 'karawang', '2023-11-01', '21221212221112', 'Laki-laki', '090800000088', '', 'testing', '123', NULL, '2023-11-27 06:10:43', 'Tidak Aktif', '2023-11-27 06:10:43', 'INSERT', 'admin'),
(2, 2, 'Putri Pratiwi', 'test', '0000-00-00', '3603155005990014', 'Laki-laki', '098098909890', '', 'test', '1234', NULL, '2023-11-30 12:20:03', 'Aktif', '2023-11-30 12:20:03', 'INSERT', 'admin'),
(3, 3, 'Putri Pratiwi', 'test', '0000-00-00', '3603155005990014', 'Laki-laki', '098098909890', '', 'test', '1234', NULL, '2023-11-30 12:36:10', 'Aktif', '2023-11-30 12:36:10', 'INSERT', 'admin'),
(4, 4, 'Putri Pratiwi', 'test', '0000-00-00', '3603155005990014', 'Laki-laki', '098098909890', '', 'test', '1234', NULL, '2023-11-30 12:36:40', 'Aktif', '2023-11-30 12:36:40', 'INSERT', 'admin'),
(5, 5, 'Putri Pratiwi', 'test', '0000-00-00', '3603155005990014', 'Laki-laki', '098098909890', '', 'test', '1234', NULL, '2023-11-30 12:36:42', 'Aktif', '2023-11-30 12:36:42', 'INSERT', 'admin'),
(6, 6, 'test', 'qwq', '2023-11-07', '3603155005990123', 'Laki-laki', '098098112233', '', 'qqew', '12321', NULL, '2023-11-30 12:37:44', 'Aktif', '2023-11-30 12:37:44', 'INSERT', 'admin'),
(7, 7, 'test', 'qwq', '2023-11-07', '3603155005990123', 'Laki-laki', '098098112233', '', 'qqew', '12321', NULL, '2023-11-30 12:38:18', 'Aktif', '2023-11-30 12:38:18', 'INSERT', 'admin'),
(8, 8, 'test', 'qwq', '2023-11-07', '3603155005990123', 'Laki-laki', '098098112233', '', 'qqew', '12321', NULL, '2023-11-30 12:38:20', 'Aktif', '2023-11-30 12:38:20', 'INSERT', 'admin'),
(9, 9, 'Putri Pratiwi', 'purwasari', '2023-11-01', '3603155005990014', 'Laki-laki', '098098909890', '', 'putri', '1234321', NULL, '2023-11-30 12:39:53', 'Aktif', '2023-11-30 12:39:53', 'INSERT', 'admin'),
(10, 10, 'itbah', 'Telagasari', '2006-04-09', '321517490406007', 'Perempuan', '085156364201', '', 'itbah@ubpkarawang.ac.id', '123456', NULL, '2023-11-30 12:44:26', 'Aktif', '2023-11-30 12:44:26', 'INSERT', 'admin'),
(11, 11, 'lol', 'purwasari', '2023-11-18', '1331234323333', 'Perempuan', '121233333331212', '', 'kol', '12334441', NULL, '2023-11-30 12:52:10', 'Aktif', '2023-11-30 12:52:10', 'INSERT', 'admin'),
(12, 12, 'lol', 'purwasari', '2023-11-18', '1331234323333', 'Perempuan', '121233333331212', '', 'kol', '6666666', NULL, '2023-11-30 13:01:04', 'Aktif', '2023-11-30 13:01:04', 'INSERT', 'admin'),
(13, 13, 'lol', 'purwasari', '2023-11-18', '1331234323333', 'Perempuan', '121233333331212', '', 'kol', '6666666', NULL, '2023-11-30 13:02:18', 'Aktif', '2023-11-30 13:02:18', 'INSERT', 'admin'),
(14, 14, 'e', 'test (edit)', '2023-11-15', '360315500599031113', 'Laki-laki', '121233333331212', '', 'testqw', 'qweqweqw', NULL, '2023-11-30 13:02:46', 'Aktif', '2023-11-30 13:02:46', 'INSERT', 'admin'),
(15, 15, 'Putri Pratiwi', 'purwasari', '2023-11-06', '3603155005990014', 'Laki-laki', '098098909890', '', 'putri', '9900', NULL, '2023-11-30 13:45:02', 'Aktif', '2023-11-30 13:45:02', 'INSERT', 'admin'),
(16, 16, 'putra', 'purwasari', '2023-11-07', '360315500599031113', 'Laki-laki', '121233333331212', '', 'putra', 'popo', NULL, '2023-11-30 14:05:41', 'Aktif', '2023-11-30 14:05:41', 'INSERT', 'admin'),
(17, 17, 'fajar', 'Telagasari', '2023-11-29', '32151721333321232', 'Laki-laki', '0899997767656', '', 'Fajar', '1234', NULL, '2023-12-03 12:41:11', 'Aktif', '2023-12-03 12:41:11', 'INSERT', 'admin'),
(19, 19, 'akbar', 'cikampek', '2023-11-30', '0809090989213', 'Laki-laki', '93973721983791', '', 'akbar', '00pp', NULL, '2023-12-12 11:42:56', 'Aktif', '2023-12-12 11:42:56', 'INSERT', 'admin'),
(20, 20, 'dio brando', 'egypt', '1898-01-07', '2211223232', 'Laki-laki', '08997975454', '', 'Dio', 'STAND', NULL, '2023-12-13 03:24:42', 'Aktif', '2023-12-13 03:24:42', 'INSERT', 'admin'),
(21, 21, 'jojo', 'japan', '2023-11-30', '6767867788976', 'Laki-laki', '8978897897878', '', 'jojo', 'opop', NULL, '2023-12-13 04:06:58', 'Aktif', '2023-12-13 04:06:58', 'INSERT', 'admin'),
(22, 22, 'Akbar Menolak Mendua Jr', 'UBP', '0685-01-01', '3123532523', 'Laki-laki', '0888111444', '', 'akbarkece', 'akbarkeceabis', NULL, '2023-12-13 04:15:15', 'Aktif', '2023-12-13 04:15:15', 'INSERT', 'admin'),
(23, 23, 'test', 'pppppp', '2023-12-04', '12343234312', 'Laki-laki', '666666666', '', 'testing', 'test', NULL, '2023-12-13 07:00:20', 'Aktif', '2023-12-13 07:00:20', 'INSERT', 'admin'),
(24, 24, 'kon', 'kon', '2023-12-11', '445454654565', 'Laki-laki', '090008008080', '', 'kon', '0000', NULL, '2023-12-13 07:01:32', 'Aktif', '2023-12-13 07:01:32', 'INSERT', 'admin');

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
(24, 39, '2023-12-18', 99999999.99);

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
(24, 39, '2023-12-18', 99999999.99);

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `ID_Pinjaman` int(11) NOT NULL,
  `ID_Anggota` int(11) DEFAULT NULL,
  `Jumlah_Pinjaman` decimal(10,2) NOT NULL,
  `Tanggal_Pinjaman` date DEFAULT NULL,
  `Status` enum('Diajukan','Disetujui','Ditolak','Dibayar') DEFAULT 'Diajukan',
  `Nama_Anggota` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`ID_Pinjaman`, `ID_Anggota`, `Jumlah_Pinjaman`, `Tanggal_Pinjaman`, `Status`, `Nama_Anggota`) VALUES
(39, 17, 10000000.00, '2023-12-18', 'Dibayar', 'fajar'),
(40, 17, 10000000.00, '2023-12-18', 'Diajukan', 'fajar');

--
-- Triggers `pinjaman`
--
DELIMITER $$
CREATE TRIGGER `Pinjaman_After_Insert` AFTER INSERT ON `pinjaman` FOR EACH ROW INSERT INTO Pinjaman_History (ID_Pinjaman, ID_Anggota, Jumlah_Pinjaman, Tanggal_Pinjaman, Status, Action)
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
  `ID_Anggota` int(11) DEFAULT NULL,
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
(1, 1, 16, 1200000.00, '2023-12-02', 'Diajukan', '2023-12-02 04:18:45', 'INSERT'),
(2, 2, 15, 10000000.00, '2023-12-02', 'Diajukan', '2023-12-02 13:44:29', 'INSERT'),
(3, 3, 15, 10000000.00, '2023-12-02', '', '2023-12-02 13:51:46', 'INSERT'),
(4, 4, 17, 10000000.00, '2023-12-03', '', '2023-12-03 13:20:51', 'INSERT'),
(5, 5, 17, 10000000.00, '2023-12-03', '', '2023-12-03 13:21:14', 'INSERT'),
(6, 6, 15, 10000000.00, '2023-12-07', '', '2023-12-07 12:22:49', 'INSERT'),
(7, 7, 15, 10000000.00, '2023-12-07', '', '2023-12-07 12:23:53', 'INSERT'),
(8, 8, 16, 10000000.00, '2023-12-07', '', '2023-12-07 12:41:00', 'INSERT'),
(9, 9, 17, 10000000.00, '2023-12-09', '', '2023-12-09 02:39:23', 'INSERT'),
(11, 11, 16, 10000000.00, '2023-12-09', 'Diajukan', '2023-12-09 02:55:25', 'INSERT'),
(12, 12, 17, 10000000.00, '2023-12-09', '', '2023-12-09 02:56:13', 'INSERT'),
(13, 13, 15, 10000000.00, '2023-12-09', '', '2023-12-09 03:24:32', 'INSERT'),
(14, 14, 19, 10000000.00, '2023-12-12', '', '2023-12-12 11:43:13', 'INSERT'),
(15, 15, 17, 10000000.00, '2023-12-12', '', '2023-12-12 12:26:52', 'INSERT'),
(16, 16, 17, 10000000.00, '2023-12-12', '', '2023-12-12 13:25:55', 'INSERT'),
(17, 17, 19, 10000000.00, '2023-12-12', '', '2023-12-12 14:40:36', 'INSERT'),
(18, 18, 19, 10000000.00, '2023-12-12', 'Diajukan', '2023-12-12 14:46:45', 'INSERT'),
(19, 19, 19, 10000000.00, '2023-12-12', 'Diajukan', '2023-12-12 14:50:53', 'INSERT'),
(20, 20, 19, 10000000.00, '2023-12-12', 'Diajukan', '2023-12-12 14:53:17', 'INSERT'),
(21, 21, 20, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 03:40:52', 'INSERT'),
(22, 22, 16, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 03:45:32', 'INSERT'),
(23, 23, 17, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 03:46:11', 'INSERT'),
(24, 24, 20, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 04:05:49', 'INSERT'),
(25, 25, 21, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 04:07:13', 'INSERT'),
(26, 26, 22, 99999999.99, '2023-12-13', 'Diajukan', '2023-12-13 04:16:06', 'INSERT'),
(27, 27, 20, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 06:26:47', 'INSERT'),
(28, 28, 20, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 06:46:59', 'INSERT'),
(29, 29, 20, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 06:51:23', 'INSERT'),
(30, 30, 23, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 07:00:42', 'INSERT'),
(31, 31, 24, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 07:01:52', 'INSERT'),
(32, 32, 23, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 07:03:45', 'INSERT'),
(33, 33, 17, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 10:47:52', 'INSERT'),
(34, 34, 17, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 10:58:07', 'INSERT'),
(35, 35, 17, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 11:31:55', 'INSERT'),
(36, 36, 17, 10000000.00, '2023-12-13', 'Diajukan', '2023-12-13 11:32:01', 'INSERT'),
(37, 37, 17, 10000000.00, '2023-12-15', 'Diajukan', '2023-12-15 03:47:03', 'INSERT'),
(38, 38, 17, 10000000.00, '2023-12-18', 'Diajukan', '2023-12-18 10:19:39', 'INSERT'),
(39, 39, 17, 10000000.00, '2023-12-18', 'Diajukan', '2023-12-18 10:33:07', 'INSERT'),
(40, 40, 17, 10000000.00, '2023-12-18', 'Diajukan', '2023-12-18 10:34:22', 'INSERT');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `ID_Simpanan` int(11) NOT NULL,
  `ID_Anggota` int(11) DEFAULT NULL,
  `Jumlah_Simpanan` decimal(10,2) NOT NULL,
  `Tanggal_Simpanan` date DEFAULT NULL,
  `Nama_Anggota` varchar(255) DEFAULT NULL,
  `Jenis_Simpanan` enum('Pokok','Sukarela','Wajib') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`ID_Simpanan`, `ID_Anggota`, `Jumlah_Simpanan`, `Tanggal_Simpanan`, `Nama_Anggota`, `Jenis_Simpanan`) VALUES
(11, 17, 10000000.00, '2023-12-16', 'fajar', NULL),
(12, 17, 10000000.00, '2023-12-16', 'fajar', NULL);

--
-- Triggers `simpanan`
--
DELIMITER $$
CREATE TRIGGER `Simpanan_After_Insert` AFTER INSERT ON `simpanan` FOR EACH ROW INSERT INTO Simpanan_History (ID_Simpanan, ID_Anggota, Jumlah_Simpanan, Tanggal_Simpanan, Action)
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
  `ID_Anggota` int(11) DEFAULT NULL,
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
(1, 1, 16, 1000000.00, '2023-12-09', '2023-12-09 08:44:02', 'INSERT', NULL),
(2, 2, 17, 10000000.00, '2023-12-09', '2023-12-09 08:48:08', 'INSERT', NULL),
(3, 3, 17, 10000000.00, '2023-12-09', '2023-12-09 08:51:55', 'INSERT', NULL),
(4, 4, 16, 10000000.00, '2023-12-12', '2023-12-12 10:13:00', 'INSERT', NULL),
(5, 5, 17, 10000000.00, '2023-12-12', '2023-12-12 10:13:16', 'INSERT', NULL),
(6, 6, 19, 10000000.00, '2023-12-12', '2023-12-12 11:43:24', 'INSERT', NULL),
(7, 7, 20, 10000000.00, '2023-12-13', '2023-12-13 03:25:54', 'INSERT', NULL),
(8, 8, 20, 10000000.00, '2023-12-13', '2023-12-13 03:31:30', 'INSERT', NULL),
(9, 9, 17, 10000000.00, '2023-12-13', '2023-12-13 11:33:28', 'INSERT', NULL),
(10, 10, 17, 10000000.00, '2023-12-13', '2023-12-13 11:33:38', 'INSERT', NULL),
(11, 11, 17, 10000000.00, '2023-12-16', '2023-12-16 11:55:32', 'INSERT', NULL),
(12, 12, 17, 10000000.00, '2023-12-16', '2023-12-16 11:55:42', 'INSERT', NULL);

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
  MODIFY `ID_Anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `anggota_history`
--
ALTER TABLE `anggota_history`
  MODIFY `ID_History` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pembayaran_pinjaman`
--
ALTER TABLE `pembayaran_pinjaman`
  MODIFY `ID_Pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pembayaran_pinjaman_history`
--
ALTER TABLE `pembayaran_pinjaman_history`
  MODIFY `ID_Pembayaran_History` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `ID_Pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pinjaman_history`
--
ALTER TABLE `pinjaman_history`
  MODIFY `ID_History` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `ID_Simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `simpanan_history`
--
ALTER TABLE `simpanan_history`
  MODIFY `ID_History` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
