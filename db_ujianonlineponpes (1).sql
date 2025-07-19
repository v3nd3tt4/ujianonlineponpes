-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 19, 2025 at 04:13 PM
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
-- Database: `db_ujianonlineponpes`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('101f123e561dc7e5273f7ed63b6747c0c219d728', '::1', 1752933221, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323933333232313b69645f757365727c733a313a2231223b6e616d617c733a353a2241646d696e223b72756c657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('1600eeb06f6240cd8746f4b038d2e8f4af013b60', '::1', 1752921514, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323932313531343b69645f757365727c733a313a2234223b6e616d617c733a343a2247757275223b72756c657c733a343a2267757275223b6c6f676765645f696e7c623a313b),
('212f6fe56d99ef1546fc63077f1bb70973801d1b', '::1', 1752922817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323932323831373b69645f757365727c733a313a2234223b6e616d617c733a343a2247757275223b72756c657c733a343a2267757275223b6c6f676765645f696e7c623a313b),
('284b5aaf1fbb8e52d49122da0fcf6ec4a15b3b11', '::1', 1752923123, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323932333132333b69645f757365727c733a313a2234223b6e616d617c733a343a2247757275223b72756c657c733a343a2267757275223b6c6f676765645f696e7c623a313b),
('45c376e3c7f09c81d471369a808be283a3a24b69', '::1', 1752923928, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323932333932383b69645f757365727c733a313a2234223b6e616d617c733a343a2247757275223b72756c657c733a343a2267757275223b6c6f676765645f696e7c623a313b737563636573737c733a33323a22446174612070726f66696c20626572686173696c206469706572626172756921223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('736c6708b9dd6d7505e11320fb1951ee7362aa34', '::1', 1752923586, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323932333538363b69645f757365727c733a313a2234223b6e616d617c733a343a2247757275223b72756c657c733a343a2267757275223b6c6f676765645f696e7c623a313b),
('758cf43af0101f35565b6e1168d6ab64314ab4f1', '::1', 1752918239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323931383233393b6572726f727c733a33333a22456d61696c2c2070617373776f72642c206174617520726f6c652073616c616821223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('b12f88b2af7f8c9d776e56be4ea5cef9b9fad260', '::1', 1752932803, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323933323830333b69645f757365727c733a313a2231223b6e616d617c733a353a2241646d696e223b72756c657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('c6456c9d3ab56265868e114f8d8585f8d144d3c7', '::1', 1752934248, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323933343234383b69645f757365727c733a313a2232223b6e616d617c733a31343a224b6570616c612053656b6f6c6168223b72756c657c733a31343a226b6570616c612073656b6f6c6168223b6c6f676765645f696e7c623a313b),
('c67472d086f18caa65cd0066f911d446f4994fda', '::1', 1752933626, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323933333632363b69645f757365727c733a313a2231223b6e616d617c733a353a2241646d696e223b72756c657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('d369b55b5352b38cf1c9623829b5c8e06dd61643', '::1', 1752932286, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323933323238363b69645f757365727c733a313a2232223b6e616d617c733a343a2244696168223b72756c657c733a353a227369737761223b6c6f676765645f696e7c623a313b6e69737c733a393a22313233313233313233223b),
('ef5837528b6c762334a392b69427243eaba3f737', '::1', 1752924635, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323932343633353b69645f757365727c733a313a2231223b6e616d617c733a353a22416e676769223b72756c657c733a353a227369737761223b6c6f676765645f696e7c623a313b6e69737c733a363a22313233343536223b),
('ef80af5f6db72ee123c007c6a83174e7266a428b', '::1', 1752924999, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323932343939393b69645f757365727c733a313a2231223b6e616d617c733a353a22416e676769223b72756c657c733a353a227369737761223b6c6f676765645f696e7c623a313b6e69737c733a363a22313233343536223b),
('f16acb3b6ccebb8b178fa73570580ce421c2c5c5', '::1', 1752934248, 0x5f5f63695f6c6173745f726567656e65726174657c693a313735323933343234383b69645f757365727c733a313a2232223b6e616d617c733a31343a224b6570616c612053656b6f6c6168223b72756c657c733a31343a226b6570616c612073656b6f6c6168223b6c6f676765645f696e7c623a313b);

-- --------------------------------------------------------

--
-- Table structure for table `tb_banksoal`
--

CREATE TABLE `tb_banksoal` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `matapelajaran_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_banksoal`
--

INSERT INTO `tb_banksoal` (`id`, `keterangan`, `matapelajaran_id`, `pegawai_id`, `created_at`, `updated_at`) VALUES
(1, 'KUIS - MTK MP001 VII', 1, 1, '2025-06-27 04:29:55', '2025-06-27 04:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_gurumatapelajaran`
--

CREATE TABLE `tb_gurumatapelajaran` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `matapelajaran_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_gurumatapelajaran`
--

INSERT INTO `tb_gurumatapelajaran` (`id`, `pegawai_id`, `matapelajaran_id`) VALUES
(1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_ujian`
--

CREATE TABLE `tb_jadwal_ujian` (
  `id` int(11) NOT NULL,
  `matapelajaran_id` int(11) NOT NULL,
  `kelasrombel_id` int(11) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `lama_ujian` int(11) NOT NULL COMMENT 'dalam menit',
  `jenis_ujian` varchar(50) NOT NULL,
  `banksoal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_jadwal_ujian`
--

INSERT INTO `tb_jadwal_ujian` (`id`, `matapelajaran_id`, `kelasrombel_id`, `tanggal_ujian`, `jam_mulai`, `jam_selesai`, `lama_ujian`, `jenis_ujian`, `banksoal_id`) VALUES
(1, 1, 1, '2025-06-27', '13:30:00', '14:00:00', 30, 'Kuis', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban_ujian`
--

CREATE TABLE `tb_jawaban_ujian` (
  `id` int(11) NOT NULL,
  `jadwal_ujian_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `status` enum('belum','sedang','selesai') NOT NULL DEFAULT 'belum',
  `nilai_akhir` float DEFAULT NULL,
  `jawaban` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id`, `nama_kelas`, `keterangan`) VALUES
(1, 'VII A', '-'),
(2, 'VII B', '-'),
(3, 'VIII A', '-'),
(4, 'VIII B', '-'),
(5, 'IX A', '-'),
(6, 'IX B', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelasrombel`
--

CREATE TABLE `tb_kelasrombel` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tahunakademik_id` int(11) NOT NULL,
  `walikelas_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kelasrombel`
--

INSERT INTO `tb_kelasrombel` (`id`, `kelas_id`, `tahunakademik_id`, `walikelas_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 4, '2025-06-27 04:27:57', '2025-06-27 04:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelassiswa`
--

CREATE TABLE `tb_kelassiswa` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `kelasrombel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kelassiswa`
--

INSERT INTO `tb_kelassiswa` (`id`, `siswa_id`, `kelasrombel_id`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_matapelajaran`
--

CREATE TABLE `tb_matapelajaran` (
  `id` int(11) NOT NULL,
  `kode_matapelajaran` varchar(20) NOT NULL,
  `nama_matapelajaran` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_matapelajaran`
--

INSERT INTO `tb_matapelajaran` (`id`, `kode_matapelajaran`, `nama_matapelajaran`, `keterangan`) VALUES
(1, 'MP001-VII', 'Matematika', '-'),
(2, 'MP001-VIII', 'Matematika', '-'),
(3, 'MP002-VII', 'Kimia', '-'),
(4, 'MP002-VIII', 'Kimia', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id` int(11) NOT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'default.jpg',
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','operator','guru','kepala sekolah') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `no_telepon`, `foto`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'Bandar Lampung', '2025-06-25', 'L', '-', '0', 'default.jpg', 'admin@mail.com', '$2y$10$r0pZbKup.H8dsl04boCcCeGW5QsTaoUZFT98XSNJuPthlQR7tqSI.', 'admin', '2025-06-24 01:25:28', '2025-06-27 15:13:06'),
(2, NULL, 'Kepala Sekolah', '-', '2000-06-04', 'L', '-', '0', 'default.jpg', 'kepsek@mail.com', '$2y$10$fUxDpXjIzbjR.JQ2noL0Hepw95ENUe/aUJd.ayZmgKVGPkBMoGIhG', 'kepala sekolah', '2025-06-20 02:44:07', '2025-06-27 04:11:44'),
(3, NULL, 'Operator', '-', '1998-10-26', 'L', '-', '0', 'default.jpg', 'operator@mail.com', '$2y$10$IGkfI/qGUunBeorfvIwLou2gYxY9cjxeWA47RLMlpFjuMwH5KV6lG', 'operator', '2025-06-20 06:33:09', '2025-06-27 04:11:50'),
(4, NULL, 'Guru', '-', '2025-06-27', 'P', '-hhh', '0', 'profile_4_1752924144.jpg', 'guru@mail.com', '$2y$10$W2cstmP1DaSKWBi9Tu.CNuRQ.ZuihBGdHppUSU6Xdv.4RXUzo4AyS', 'guru', '2025-06-27 04:11:36', '2025-07-19 10:22:24'),
(5, 'Et laboris incididunt sed temp', 'Anim explicabo Sed ', 'Voluptas sed aliquip', '2001-08-08', 'P', 'Ex optio libero atq', 'Et soluta elit aut ', 'default.jpg', 'hycigyx@mailinator.com', '$2y$10$jAgpddg8kwECiUND/IyMKuGOV3j9DjDjL7dKuy2Nex7nvyBslmJsi', 'guru', '2025-07-19 13:46:49', '2025-07-19 13:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `tb_presensi_ujian`
--

CREATE TABLE `tb_presensi_ujian` (
  `id` int(11) NOT NULL,
  `jadwal_ujian_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `waktu_hadir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruangan`
--

CREATE TABLE `tb_ruangan` (
  `id` int(11) NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_ruangan`
--

INSERT INTO `tb_ruangan` (`id`, `nama_ruangan`, `keterangan`) VALUES
(1, 'Lantai 1 - Gedung A', '-'),
(2, 'Lantai 1 - Gedung B', '-'),
(3, 'Lantai 1 - Gedung C', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'default.jpg',
  `nama_ibu` varchar(100) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `tahun_masuk` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id`, `nama`, `nis`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `email`, `password`, `no_hp`, `foto`, `nama_ibu`, `nama_ayah`, `pekerjaan_ibu`, `pekerjaan_ayah`, `tahun_masuk`) VALUES
(1, 'Anggi', '123456', '-', '2025-06-27', 'P', '-', 'anggi@mail.com', '$2y$10$eM08LLxL8nhoHyNlVqb2gejekbXYiSyzKVJZjfHfiHIxIodisYsLe', '0', 'profile_siswa_1_1752924648.jpg', '-', '-', '-', '-', '2022'),
(2, 'Diah', '123123123', '-', '2025-06-27', 'P', '-', 'diah@mail.com', '$2y$10$jgyq3zcDxgMIg580jTzNCuNq0Q7r6dSOvd1ZfQtlVqfjBQQeKMH1e', '0', 'default.jpg', '-', '-', '-', '-', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE `tb_soal` (
  `id` int(11) NOT NULL,
  `banksoal_id` int(11) NOT NULL,
  `soal` text NOT NULL,
  `gambar_soal` varchar(255) DEFAULT NULL,
  `pilihan_a` text NOT NULL,
  `pilihan_b` text NOT NULL,
  `pilihan_c` text NOT NULL,
  `pilihan_d` text NOT NULL,
  `kunci_jawaban` enum('A','B','C','D') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahunakademik`
--

CREATE TABLE `tb_tahunakademik` (
  `id` int(11) NOT NULL,
  `tahun` varchar(9) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_tahunakademik`
--

INSERT INTO `tb_tahunakademik` (`id`, `tahun`, `semester`, `status`) VALUES
(1, '2025/2026', 'Ganjil', 'Aktif'),
(2, '2026/2027', 'Genap', 'Nonaktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `tb_banksoal`
--
ALTER TABLE `tb_banksoal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matapelajaran_id` (`matapelajaran_id`),
  ADD KEY `pegawai_id` (`pegawai_id`);

--
-- Indexes for table `tb_gurumatapelajaran`
--
ALTER TABLE `tb_gurumatapelajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_id` (`pegawai_id`),
  ADD KEY `matapelajaran_id` (`matapelajaran_id`);

--
-- Indexes for table `tb_jadwal_ujian`
--
ALTER TABLE `tb_jadwal_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matapelajaran_id` (`matapelajaran_id`),
  ADD KEY `kelasrombel_id` (`kelasrombel_id`),
  ADD KEY `banksoal_id` (`banksoal_id`);

--
-- Indexes for table `tb_jawaban_ujian`
--
ALTER TABLE `tb_jawaban_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_ujian_id` (`jadwal_ujian_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelasrombel`
--
ALTER TABLE `tb_kelasrombel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kelasrombel_kelas` (`kelas_id`),
  ADD KEY `fk_kelasrombel_tahunakademik` (`tahunakademik_id`),
  ADD KEY `fk_kelasrombel_pegawai` (`walikelas_id`);

--
-- Indexes for table `tb_kelassiswa`
--
ALTER TABLE `tb_kelassiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `kelasrombel_id` (`kelasrombel_id`);

--
-- Indexes for table `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `tb_presensi_ujian`
--
ALTER TABLE `tb_presensi_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_ujian_id` (`jadwal_ujian_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banksoal_id` (`banksoal_id`);

--
-- Indexes for table `tb_tahunakademik`
--
ALTER TABLE `tb_tahunakademik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_banksoal`
--
ALTER TABLE `tb_banksoal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_gurumatapelajaran`
--
ALTER TABLE `tb_gurumatapelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jadwal_ujian`
--
ALTER TABLE `tb_jadwal_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jawaban_ujian`
--
ALTER TABLE `tb_jawaban_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_kelasrombel`
--
ALTER TABLE `tb_kelasrombel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kelassiswa`
--
ALTER TABLE `tb_kelassiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_presensi_ujian`
--
ALTER TABLE `tb_presensi_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tahunakademik`
--
ALTER TABLE `tb_tahunakademik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_banksoal`
--
ALTER TABLE `tb_banksoal`
  ADD CONSTRAINT `tb_banksoal_ibfk_1` FOREIGN KEY (`matapelajaran_id`) REFERENCES `tb_matapelajaran` (`id`),
  ADD CONSTRAINT `tb_banksoal_ibfk_2` FOREIGN KEY (`pegawai_id`) REFERENCES `tb_pegawai` (`id`);

--
-- Constraints for table `tb_gurumatapelajaran`
--
ALTER TABLE `tb_gurumatapelajaran`
  ADD CONSTRAINT `tb_gurumatapelajaran_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `tb_pegawai` (`id`),
  ADD CONSTRAINT `tb_gurumatapelajaran_ibfk_2` FOREIGN KEY (`matapelajaran_id`) REFERENCES `tb_matapelajaran` (`id`);

--
-- Constraints for table `tb_jadwal_ujian`
--
ALTER TABLE `tb_jadwal_ujian`
  ADD CONSTRAINT `tb_jadwal_ujian_ibfk_1` FOREIGN KEY (`matapelajaran_id`) REFERENCES `tb_matapelajaran` (`id`),
  ADD CONSTRAINT `tb_jadwal_ujian_ibfk_2` FOREIGN KEY (`kelasrombel_id`) REFERENCES `tb_kelasrombel` (`id`),
  ADD CONSTRAINT `tb_jadwal_ujian_ibfk_3` FOREIGN KEY (`banksoal_id`) REFERENCES `tb_banksoal` (`id`);

--
-- Constraints for table `tb_jawaban_ujian`
--
ALTER TABLE `tb_jawaban_ujian`
  ADD CONSTRAINT `tb_jawaban_ujian_ibfk_1` FOREIGN KEY (`jadwal_ujian_id`) REFERENCES `tb_jadwal_ujian` (`id`),
  ADD CONSTRAINT `tb_jawaban_ujian_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`);

--
-- Constraints for table `tb_kelasrombel`
--
ALTER TABLE `tb_kelasrombel`
  ADD CONSTRAINT `fk_kelasrombel_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `tb_kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kelasrombel_pegawai` FOREIGN KEY (`walikelas_id`) REFERENCES `tb_pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kelasrombel_tahunakademik` FOREIGN KEY (`tahunakademik_id`) REFERENCES `tb_tahunakademik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kelassiswa`
--
ALTER TABLE `tb_kelassiswa`
  ADD CONSTRAINT `tb_kelassiswa_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`),
  ADD CONSTRAINT `tb_kelassiswa_ibfk_2` FOREIGN KEY (`kelasrombel_id`) REFERENCES `tb_kelasrombel` (`id`);

--
-- Constraints for table `tb_presensi_ujian`
--
ALTER TABLE `tb_presensi_ujian`
  ADD CONSTRAINT `tb_presensi_ujian_ibfk_1` FOREIGN KEY (`jadwal_ujian_id`) REFERENCES `tb_jadwal_ujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_presensi_ujian_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD CONSTRAINT `tb_soal_ibfk_1` FOREIGN KEY (`banksoal_id`) REFERENCES `tb_banksoal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
