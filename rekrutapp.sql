-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 08:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekrutapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `nama_departemen` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `nama_departemen`, `created_at`) VALUES
(1, 'ART Therapist', '2025-06-25 06:53:38'),
(2, 'Aftercare', '2025-06-25 06:53:38'),
(3, 'Auditing', '2025-06-25 06:53:38'),
(4, 'Creative', '2025-06-25 06:53:38'),
(5, 'Customer Service', '2025-06-25 06:53:38'),
(6, 'Finance & Accounting', '2025-06-25 06:53:38'),
(7, 'Hairstylist', '2025-06-25 06:53:38'),
(8, 'Human Resource', '2025-06-25 06:53:38'),
(9, 'IT & CCTV', '2025-06-25 06:53:38'),
(10, 'Logistic', '2025-06-25 06:53:38'),
(11, 'Operational', '2025-06-25 06:53:38'),
(12, 'Others', '2025-06-25 06:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `pelamar_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `departemen_id` int(11) DEFAULT NULL,
  `level_jabatan_id` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `gaji` decimal(12,2) DEFAULT NULL,
  `status_penempatan` enum('HEAD OFFICE','STORE BM','STORE SULAM') DEFAULT NULL,
  `status_karyawan` enum('AKTIF','RESIGN','TERMINATED') DEFAULT 'AKTIF',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `pelamar_id`, `training_id`, `nama_lengkap`, `no_hp`, `email`, `departemen_id`, `level_jabatan_id`, `tanggal_masuk`, `gaji`, `status_penempatan`, `status_karyawan`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Bagas Aria Sativa', '081284275655', 'bagasativa@gmail.com', 9, 3, '2025-06-25', NULL, 'STORE BM', 'AKTIF', '2025-06-25 06:56:28', '2025-06-25 09:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `level_jabatan`
--

CREATE TABLE `level_jabatan` (
  `id` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level_jabatan`
--

INSERT INTO `level_jabatan` (`id`, `nama_level`, `created_at`) VALUES
(1, 'Head/Supervisor', '2025-06-25 06:53:38'),
(2, 'Operator', '2025-06-25 06:53:38'),
(3, 'Admin', '2025-06-25 06:53:38'),
(4, 'Non-Staff', '2025-06-25 06:53:38'),
(5, 'Others', '2025-06-25 06:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE `pelamar` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `departemen_id` int(11) DEFAULT NULL,
  `level_jabatan_id` int(11) DEFAULT NULL,
  `sumber_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT 5,
  `tanggal_apply` date DEFAULT NULL,
  `tanggal_interview` date DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`id`, `nama_lengkap`, `no_hp`, `email`, `tanggal_lahir`, `alamat`, `departemen_id`, `level_jabatan_id`, `sumber_id`, `status_id`, `tanggal_apply`, `tanggal_interview`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', '08123456789', 'john@email.com', '1995-01-15', 'Jakarta', 1, 2, 1, 9, '2024-01-15', NULL, NULL, '2025-06-25 06:53:38', '2025-06-25 17:46:06'),
(2, 'Jane Smith', '08198765432', 'jane@email.com', '1992-05-20', 'Bandung', 2, 1, 2, 6, '2024-01-20', NULL, NULL, '2025-06-25 06:53:38', '2025-06-25 06:53:38'),
(3, 'Mike Johnson', '08111222333', 'mike@email.com', '1990-12-10', 'Surabaya', 3, 3, 3, 7, '2024-01-25', NULL, NULL, '2025-06-25 06:53:38', '2025-06-25 06:53:38'),
(4, 'Bagas Aria Sativa', '081284275655', 'bagasativa@gmail.com', '1993-12-08', 'Jl. Pelabuhan Ratu Raya No.3 Blok 5A, RT.005/RW.009, Sepanjang Jaya, Rawa Lumbu\r\nNo. 3', 9, 3, 3, 10, '2025-06-25', '2025-06-26', 'TES', '2025-06-25 06:55:17', '2025-06-25 17:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `nama_status` varchar(50) NOT NULL,
  `warna` varchar(20) DEFAULT 'secondary',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `nama_status`, `warna`, `created_at`) VALUES
(1, 'CONFIRMED', 'success', '2025-06-25 06:53:38'),
(2, 'RESIGN', 'danger', '2025-06-25 06:53:38'),
(3, 'FAILED', 'danger', '2025-06-25 06:53:38'),
(4, 'NO FEEDBACK', 'secondary', '2025-06-25 06:53:38'),
(5, 'INTERVIEW', 'info', '2025-06-25 06:53:38'),
(6, 'TRAINING BM', 'warning', '2025-06-25 06:53:38'),
(7, 'TRAINING SULAM', 'warning', '2025-06-25 06:53:38'),
(8, 'TRAINING HO', 'warning', '2025-06-25 06:53:38'),
(9, 'HEAD OFFICE', 'primary', '2025-06-25 06:53:38'),
(10, 'STORE BM', 'primary', '2025-06-25 06:53:38'),
(11, 'STORE SULAM', 'primary', '2025-06-25 06:53:38'),
(12, 'PHK', 'danger', '2025-06-25 16:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `sumber`
--

CREATE TABLE `sumber` (
  `id` int(11) NOT NULL,
  `nama_sumber` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sumber`
--

INSERT INTO `sumber` (`id`, `nama_sumber`, `created_at`) VALUES
(1, 'Glints', '2025-06-25 06:53:38'),
(2, 'Instagram', '2025-06-25 06:53:38'),
(3, 'Jobstreet', '2025-06-25 06:53:38'),
(4, 'KitaLulus', '2025-06-25 06:53:38'),
(5, 'Kupu', '2025-06-25 06:53:38'),
(6, 'LinkedIn', '2025-06-25 06:53:38'),
(7, 'OLX', '2025-06-25 06:53:38'),
(8, 'Pintarnya', '2025-06-25 06:53:38'),
(9, 'Others', '2025-06-25 06:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `id` int(11) NOT NULL,
  `nama_trainer` varchar(100) NOT NULL,
  `departemen_id` int(11) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`id`, `nama_trainer`, `departemen_id`, `no_hp`, `email`, `created_at`) VALUES
(1, 'Trainer BM 1', 1, NULL, NULL, '2025-06-25 06:53:38'),
(2, 'Trainer Sulam 1', 2, NULL, NULL, '2025-06-25 06:53:38'),
(3, 'Trainer HO 1', 3, NULL, NULL, '2025-06-25 06:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `pelamar_id` int(11) NOT NULL,
  `jenis_training` enum('BM','SULAM','HO') NOT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `durasi_hari` int(11) DEFAULT 14,
  `nilai` decimal(5,2) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('ONGOING','COMPLETED','FAILED') DEFAULT 'ONGOING',
  `emergency_name` varchar(100) DEFAULT NULL,
  `emergency_phone` varchar(20) DEFAULT NULL,
  `emergency_relation` enum('Orang Tua','Saudara Kandung','Kerabat/Teman','Others') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `pelamar_id`, `jenis_training`, `trainer_id`, `tanggal_mulai`, `tanggal_selesai`, `durasi_hari`, `nilai`, `catatan`, `status`, `emergency_name`, `emergency_phone`, `emergency_relation`, `created_at`, `updated_at`) VALUES
(1, 4, 'BM', 1, '2025-06-27', '2025-07-11', 14, NULL, NULL, 'COMPLETED', 'Yuli', '08129212939', 'Orang Tua', '2025-06-25 06:56:03', '2025-06-25 06:56:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelamar_id` (`pelamar_id`),
  ADD KEY `training_id` (`training_id`),
  ADD KEY `departemen_id` (`departemen_id`),
  ADD KEY `level_jabatan_id` (`level_jabatan_id`);

--
-- Indexes for table `level_jabatan`
--
ALTER TABLE `level_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departemen_id` (`departemen_id`),
  ADD KEY `level_jabatan_id` (`level_jabatan_id`),
  ADD KEY `sumber_id` (`sumber_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sumber`
--
ALTER TABLE `sumber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departemen_id` (`departemen_id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelamar_id` (`pelamar_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `level_jabatan`
--
ALTER TABLE `level_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelamar`
--
ALTER TABLE `pelamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sumber`
--
ALTER TABLE `sumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`id`),
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`),
  ADD CONSTRAINT `karyawan_ibfk_3` FOREIGN KEY (`departemen_id`) REFERENCES `departemen` (`id`),
  ADD CONSTRAINT `karyawan_ibfk_4` FOREIGN KEY (`level_jabatan_id`) REFERENCES `level_jabatan` (`id`);

--
-- Constraints for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD CONSTRAINT `pelamar_ibfk_1` FOREIGN KEY (`departemen_id`) REFERENCES `departemen` (`id`),
  ADD CONSTRAINT `pelamar_ibfk_2` FOREIGN KEY (`level_jabatan_id`) REFERENCES `level_jabatan` (`id`),
  ADD CONSTRAINT `pelamar_ibfk_3` FOREIGN KEY (`sumber_id`) REFERENCES `sumber` (`id`),
  ADD CONSTRAINT `pelamar_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `trainer`
--
ALTER TABLE `trainer`
  ADD CONSTRAINT `trainer_ibfk_1` FOREIGN KEY (`departemen_id`) REFERENCES `departemen` (`id`);

--
-- Constraints for table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `training_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `training_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
