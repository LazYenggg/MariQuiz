-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2025 at 12:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uk_ganjil_2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `nama_fakultas` varchar(100) DEFAULT NULL,
  `id_user_pimpinan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`, `id_user_pimpinan`) VALUES
(1, 'Fakultas Teknik dan Teknologi Kemaritiman', 2),
(2, 'Fakultas Ilmu Sosial dan Ilmu Politik', 3),
(3, 'Fakultas Ilmu Kelautan dan Perikanan', 4),
(4, 'Fakultas Ekonomi dan Bisnis Maritim', 5),
(5, 'Fakultas Keguruan dan Ilmu Pendidikan', 6),
(6, 'Program Pascasarjana', 7),
(7, 'Fakultas Kedokteran', 8);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `id_pertanyaan` int(11) DEFAULT NULL,
  `id_pilihan_jawaban_pertanyaan` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `nim`, `id_pertanyaan`, `id_pilihan_jawaban_pertanyaan`, `id_periode`) VALUES
(1, '2301020096', 101, 1, 100),
(2, '2301020096', 102, 5, 100),
(3, '2301020030', 201, 8, 200),
(4, '2301020030', 202, 10, 200);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  `id_fakultas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `id_fakultas`) VALUES
(11, 'Jurusan Teknik Elektro dan Informatika', 1),
(12, 'Jurusan Teknik Industri Maritim', 1),
(13, 'Jurusan Teknik Sipil dan Arsitektur', 1),
(21, 'Jurusan Ilmu Sosial Politik', 2),
(31, 'Jurusan Kelautan Perikanan', 3),
(41, 'Jurusan Ekonomi Bisnis', 4),
(51, 'Jurusan Pendidikan', 5),
(71, 'Jurusan Kedokteran', 7);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mahasiswa`, `id_user`, `id_prodi`) VALUES
('2301020004', 'Ahmad Zidane', 27, 1),
('2301020013', 'Aurel', 25, 1),
('2301020023', 'Sabriyah', 26, 1),
('2301020030', 'Mhs Teknik Elektro', 28, 2),
('2301020035', 'Fajri Hasan', 23, 1),
('2301020038', 'Rizky Sudaryo', 19, 1),
('2301020059', 'Muhamad Radit', 24, 1),
('2301020063', 'Rodiyan Ramadhan', 22, 1),
('2301020096', 'Farrel Razan Aryaputra', 18, 1),
('2301020115', 'Akbar Nurrahman', 20, 1),
('2301020116', 'Tito Pamungkas Wardana', 21, 1),
('2301030030', 'Mhs Perkapalan', 29, 4),
('2304010030', 'Mhs Akuntansi', 30, 8);

-- --------------------------------------------------------

--
-- Table structure for table `periode_kuisioner`
--

CREATE TABLE `periode_kuisioner` (
  `id_periode` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status_periode` enum('aktif','tidak aktif') DEFAULT 'tidak aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode_kuisioner`
--

INSERT INTO `periode_kuisioner` (`id_periode`, `keterangan`, `status_periode`) VALUES
(100, 'Evaluasi Akademik TI - Ganjil 2025', 'aktif'),
(200, 'Survey Fasilitas Teknik Elektro - 2025', 'aktif'),
(201, 'Uji Coba Sistem 2026', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `pertanyaan` text DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `pertanyaan`, `id_prodi`) VALUES
(101, 'Apakah dosen TI menjelaskan materi dengan baik?', 1),
(102, 'Apakah modul praktikum Web relevan?', 1),
(201, 'Bagaimana kondisi alat ukur di Lab Elektro?', 2),
(202, 'Apakah mata kuliah Arus Kuat mudah dipahami?', 2),
(203, 'Test pertanyaan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_periode_kuisioner`
--

CREATE TABLE `pertanyaan_periode_kuisioner` (
  `id_pertanyaan_periode_kuisioner` int(11) NOT NULL,
  `id_periode_kuisioner` int(11) DEFAULT NULL,
  `id_pertanyaan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pertanyaan_periode_kuisioner`
--

INSERT INTO `pertanyaan_periode_kuisioner` (`id_pertanyaan_periode_kuisioner`, `id_periode_kuisioner`, `id_pertanyaan`) VALUES
(1, 100, 101),
(2, 100, 102),
(3, 200, 201),
(4, 200, 202),
(5, 201, 203);

-- --------------------------------------------------------

--
-- Table structure for table `pilihan_jawaban_pertanyaan`
--

CREATE TABLE `pilihan_jawaban_pertanyaan` (
  `id_pilihan_jawaban` int(11) NOT NULL,
  `deskripsi_pilihan` varchar(255) DEFAULT NULL,
  `id_pertanyaan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pilihan_jawaban_pertanyaan`
--

INSERT INTO `pilihan_jawaban_pertanyaan` (`id_pilihan_jawaban`, `deskripsi_pilihan`, `id_pertanyaan`) VALUES
(1, 'Sangat Baik', 101),
(2, 'Baik', 101),
(3, 'Cukup', 101),
(4, 'Kurang', 101),
(5, 'Relevan', 102),
(6, 'Kurang', 102),
(7, 'Bagus', 201),
(8, 'Rusak', 201),
(9, 'Mudah', 202),
(10, 'Sulit', 202),
(11, '1', 203),
(12, '2', 203);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(100) DEFAULT NULL,
  `id_user_kaprodi` int(11) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`, `id_user_kaprodi`, `id_jurusan`) VALUES
(1, 'Teknik Informatika', 9, 11),
(2, 'Teknik Elektro', 10, 11),
(3, 'Teknik Industri', 11, 12),
(4, 'Teknik Perkapalan', 12, 12),
(5, 'Kimia', 13, 12),
(6, 'Teknik Sipil', 14, 13),
(7, 'Perencanaan Wilayah dan Kota', 15, 13),
(8, 'Akuntansi', 16, 41),
(9, 'Kedokteran', 17, 71);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','kaprodi','mahasiswa','pimpinan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `role`) VALUES
(1, 'Master Administrator', 'admin', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'admin'),
(2, 'Martaleli Bettiza, S.Si, M.Sc', '19800105', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'pimpinan'),
(3, 'Dr. Sayed Fauzan Riyadi, S.Sos, IMAS', '19800101', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'pimpinan'),
(4, 'Dr. Donny Apdillah, M.Si', '19800102', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'pimpinan'),
(5, 'Dr. Myrna Sofia, M.Si', '19800103', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'pimpinan'),
(6, 'Ahada Wahyusari, S.Pd, M.Pd', '19800104', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'pimpinan'),
(7, 'Dr. Rumzi Samin, M.Si', '19800106', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'pimpinan'),
(8, 'Dr. Hj. Nevrita', '19800107', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'pimpinan'),
(9, 'Kaprodi Informatika', '200101', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'kaprodi'),
(10, 'Kaprodi Elektro', '200102', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'kaprodi'),
(11, 'Kaprodi Industri', '200103', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'kaprodi'),
(12, 'Kaprodi Perkapalan', '200104', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'kaprodi'),
(13, 'Kaprodi Kimia', '200105', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'kaprodi'),
(14, 'Kaprodi Sipil', '200106', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'kaprodi'),
(15, 'Kaprodi PWK', '200107', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'kaprodi'),
(16, 'Kaprodi Akuntansi', '200201', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'kaprodi'),
(17, 'Kaprodi Kedokteran', '200301', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'kaprodi'),
(18, 'Farrel Razan Aryaputra', '2301020096', '$2y$12$MFmPTqojZfOqshZw6f838u5KH.s9VSaCnqyxD2abfOoitu8qOAcUG', 'mahasiswa'),
(19, 'Rizky Sudaryo', '2301020038', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(20, 'Akbar Nurrahman', '2301020115', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(21, 'Tito Pamungkas Wardana', '2301020116', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(22, 'Rodiyan Ramadhan', '2301020063', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(23, 'Fajri Hasan', '2301020035', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(24, 'Muhamad Radit', '2301020059', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(25, 'Aurel', '2301020013', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(26, 'Sabriyah', '2301020023', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(27, 'Ahmad Zidane', '2301020004', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(28, 'Mhs Teknik Elektro', '2301020030', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(29, 'Mhs Perkapalan', '2301030030', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa'),
(30, 'Mhs Akuntansi', '2304010030', '$2y$12$6Cwa92TfIe3anI7F5za8Mex0Etbw8sKkwlxQdFE0hA81c.VqEBrwS', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`),
  ADD KEY `id_user_pimpinan` (`id_user_pimpinan`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`),
  ADD KEY `id_pilihan_jawaban_pertanyaan` (`id_pilihan_jawaban_pertanyaan`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `periode_kuisioner`
--
ALTER TABLE `periode_kuisioner`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `pertanyaan_periode_kuisioner`
--
ALTER TABLE `pertanyaan_periode_kuisioner`
  ADD PRIMARY KEY (`id_pertanyaan_periode_kuisioner`),
  ADD KEY `id_periode_kuisioner` (`id_periode_kuisioner`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `pilihan_jawaban_pertanyaan`
--
ALTER TABLE `pilihan_jawaban_pertanyaan`
  ADD PRIMARY KEY (`id_pilihan_jawaban`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_user_kaprodi` (`id_user_kaprodi`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `periode_kuisioner`
--
ALTER TABLE `periode_kuisioner`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `pertanyaan_periode_kuisioner`
--
ALTER TABLE `pertanyaan_periode_kuisioner`
  MODIFY `id_pertanyaan_periode_kuisioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pilihan_jawaban_pertanyaan`
--
ALTER TABLE `pilihan_jawaban_pertanyaan`
  MODIFY `id_pilihan_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD CONSTRAINT `fakultas_ibfk_1` FOREIGN KEY (`id_user_pimpinan`) REFERENCES `user` (`id_user`) ON DELETE SET NULL;

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_3` FOREIGN KEY (`id_pilihan_jawaban_pertanyaan`) REFERENCES `pilihan_jawaban_pertanyaan` (`id_pilihan_jawaban`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_4` FOREIGN KEY (`id_periode`) REFERENCES `periode_kuisioner` (`id_periode`) ON DELETE CASCADE;

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE SET NULL;

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE;

--
-- Constraints for table `pertanyaan_periode_kuisioner`
--
ALTER TABLE `pertanyaan_periode_kuisioner`
  ADD CONSTRAINT `pertanyaan_periode_kuisioner_ibfk_1` FOREIGN KEY (`id_periode_kuisioner`) REFERENCES `periode_kuisioner` (`id_periode`) ON DELETE CASCADE,
  ADD CONSTRAINT `pertanyaan_periode_kuisioner_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE;

--
-- Constraints for table `pilihan_jawaban_pertanyaan`
--
ALTER TABLE `pilihan_jawaban_pertanyaan`
  ADD CONSTRAINT `pilihan_jawaban_pertanyaan_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE;

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`id_user_kaprodi`) REFERENCES `user` (`id_user`) ON DELETE SET NULL,
  ADD CONSTRAINT `prodi_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
