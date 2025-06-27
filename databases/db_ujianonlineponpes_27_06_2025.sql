-- Adminer 4.8.1 MySQL 8.0.27 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `tb_banksoal`;
CREATE TABLE `tb_banksoal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(255) NOT NULL,
  `matapelajaran_id` int NOT NULL,
  `pegawai_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `matapelajaran_id` (`matapelajaran_id`),
  KEY `pegawai_id` (`pegawai_id`),
  CONSTRAINT `tb_banksoal_ibfk_1` FOREIGN KEY (`matapelajaran_id`) REFERENCES `tb_matapelajaran` (`id`),
  CONSTRAINT `tb_banksoal_ibfk_2` FOREIGN KEY (`pegawai_id`) REFERENCES `tb_pegawai` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_banksoal` (`id`, `keterangan`, `matapelajaran_id`, `pegawai_id`, `created_at`, `updated_at`) VALUES
(1,	'KUIS - MTK MP001 VII',	1,	1,	'2025-06-27 04:29:55',	'2025-06-27 04:29:55');

DROP TABLE IF EXISTS `tb_gurumatapelajaran`;
CREATE TABLE `tb_gurumatapelajaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pegawai_id` int NOT NULL,
  `matapelajaran_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pegawai_id` (`pegawai_id`),
  KEY `matapelajaran_id` (`matapelajaran_id`),
  CONSTRAINT `tb_gurumatapelajaran_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `tb_pegawai` (`id`),
  CONSTRAINT `tb_gurumatapelajaran_ibfk_2` FOREIGN KEY (`matapelajaran_id`) REFERENCES `tb_matapelajaran` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_gurumatapelajaran` (`id`, `pegawai_id`, `matapelajaran_id`) VALUES
(1,	4,	1);

DROP TABLE IF EXISTS `tb_jadwal_ujian`;
CREATE TABLE `tb_jadwal_ujian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `matapelajaran_id` int NOT NULL,
  `kelasrombel_id` int NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `lama_ujian` int NOT NULL COMMENT 'dalam menit',
  `jenis_ujian` varchar(50) NOT NULL,
  `banksoal_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_jadwal_ujian` (`id`, `matapelajaran_id`, `kelasrombel_id`, `tanggal_ujian`, `jam_mulai`, `jam_selesai`, `lama_ujian`, `jenis_ujian`, `banksoal_id`) VALUES
(1,	1,	1,	'2025-06-27',	'13:30:00',	'14:00:00',	30,	'Kuis',	NULL);

DROP TABLE IF EXISTS `tb_jawaban_ujian`;
CREATE TABLE `tb_jawaban_ujian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jadwal_ujian_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `status` enum('belum','sedang','selesai') NOT NULL DEFAULT 'belum',
  `nilai_akhir` float DEFAULT NULL,
  `jawaban` text,
  PRIMARY KEY (`id`),
  KEY `jadwal_ujian_id` (`jadwal_ujian_id`),
  KEY `siswa_id` (`siswa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tb_kelas`;
CREATE TABLE `tb_kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_kelas` (`id`, `nama_kelas`, `keterangan`) VALUES
(1,	'VII A',	'-'),
(2,	'VII B',	'-'),
(3,	'VIII A',	'-'),
(4,	'VIII B',	'-'),
(5,	'IX A',	'-'),
(6,	'IX B',	'-');

DROP TABLE IF EXISTS `tb_kelasrombel`;
CREATE TABLE `tb_kelasrombel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kelas_id` int NOT NULL,
  `tahunakademik_id` int NOT NULL,
  `walikelas_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_kelasrombel_kelas` (`kelas_id`),
  KEY `fk_kelasrombel_tahunakademik` (`tahunakademik_id`),
  KEY `fk_kelasrombel_pegawai` (`walikelas_id`),
  CONSTRAINT `fk_kelasrombel_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `tb_kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kelasrombel_pegawai` FOREIGN KEY (`walikelas_id`) REFERENCES `tb_pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kelasrombel_tahunakademik` FOREIGN KEY (`tahunakademik_id`) REFERENCES `tb_tahunakademik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tb_kelasrombel` (`id`, `kelas_id`, `tahunakademik_id`, `walikelas_id`, `created_at`, `updated_at`) VALUES
(1,	2,	1,	4,	'2025-06-27 04:27:57',	'2025-06-27 04:27:57');

DROP TABLE IF EXISTS `tb_kelassiswa`;
CREATE TABLE `tb_kelassiswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `siswa_id` int NOT NULL,
  `kelasrombel_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siswa_id` (`siswa_id`),
  KEY `kelasrombel_id` (`kelasrombel_id`) USING BTREE,
  CONSTRAINT `tb_kelassiswa_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`),
  CONSTRAINT `tb_kelassiswa_ibfk_2` FOREIGN KEY (`kelasrombel_id`) REFERENCES `tb_kelas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_kelassiswa` (`id`, `siswa_id`, `kelasrombel_id`) VALUES
(1,	1,	1),
(2,	2,	1);

DROP TABLE IF EXISTS `tb_matapelajaran`;
CREATE TABLE `tb_matapelajaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_matapelajaran` varchar(20) NOT NULL,
  `nama_matapelajaran` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_matapelajaran` (`id`, `kode_matapelajaran`, `nama_matapelajaran`, `keterangan`) VALUES
(1,	'MP001-VII',	'Matematika',	'-'),
(2,	'MP001-VIII',	'Matematika',	'-'),
(3,	'MP002-VII',	'Kimia',	'-'),
(4,	'MP002-VIII',	'Kimia',	'-');

DROP TABLE IF EXISTS `tb_pegawai`;
CREATE TABLE `tb_pegawai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','operator','guru','kepala sekolah') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_pegawai` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `no_telepon`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'Bandar Lampung',	'2025-06-25',	'L',	'-',	'0',	'admin@mail.com',	'$2y$10$r0pZbKup.H8dsl04boCcCeGW5QsTaoUZFT98XSNJuPthlQR7tqSI.',	'admin',	'2025-06-24 01:25:28',	'2025-06-27 04:11:57'),
(2,	'Kepala Sekolah',	'-',	'2000-06-04',	'L',	'-',	'0',	'kepsek@mail.com',	'$2y$10$fUxDpXjIzbjR.JQ2noL0Hepw95ENUe/aUJd.ayZmgKVGPkBMoGIhG',	'kepala sekolah',	'2025-06-20 02:44:07',	'2025-06-27 04:11:44'),
(3,	'Operator',	'-',	'1998-10-26',	'L',	'-',	'0',	'operator@mail.com',	'$2y$10$IGkfI/qGUunBeorfvIwLou2gYxY9cjxeWA47RLMlpFjuMwH5KV6lG',	'operator',	'2025-06-20 06:33:09',	'2025-06-27 04:11:50'),
(4,	'Guru',	'-',	'2025-06-27',	'L',	'-',	'0',	'guru@mail.com',	'$2y$10$W2cstmP1DaSKWBi9Tu.CNuRQ.ZuihBGdHppUSU6Xdv.4RXUzo4AyS',	'guru',	'2025-06-27 04:11:36',	'2025-06-27 04:12:07');

DROP TABLE IF EXISTS `tb_presensi_ujian`;
CREATE TABLE `tb_presensi_ujian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jadwal_ujian_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `waktu_hadir` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_ujian_id` (`jadwal_ujian_id`),
  KEY `siswa_id` (`siswa_id`),
  CONSTRAINT `tb_presensi_ujian_ibfk_1` FOREIGN KEY (`jadwal_ujian_id`) REFERENCES `tb_jadwal_ujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_presensi_ujian_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tb_ruangan`;
CREATE TABLE `tb_ruangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_ruangan` (`id`, `nama_ruangan`, `keterangan`) VALUES
(1,	'Lantai 1 - Gedung A',	'-'),
(2,	'Lantai 1 - Gedung B',	'-'),
(3,	'Lantai 1 - Gedung C',	NULL);

DROP TABLE IF EXISTS `tb_siswa`;
CREATE TABLE `tb_siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `tahun_masuk` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_siswa` (`id`, `nama`, `nis`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `email`, `password`, `no_hp`, `nama_ibu`, `nama_ayah`, `pekerjaan_ibu`, `pekerjaan_ayah`, `tahun_masuk`) VALUES
(1,	'Anggi',	'123456',	'-',	'2025-06-27',	'P',	'-',	'anggi@mail.com',	'$2y$10$eM08LLxL8nhoHyNlVqb2gejekbXYiSyzKVJZjfHfiHIxIodisYsLe',	'0',	'-',	'-',	'-',	'-',	'2022'),
(2,	'Diah',	'123123123',	'-',	'2025-06-27',	'P',	'-',	'diah@mail.com',	'$2y$10$jgyq3zcDxgMIg580jTzNCuNq0Q7r6dSOvd1ZfQtlVqfjBQQeKMH1e',	'0',	'-',	'-',	'-',	'-',	'2023');

DROP TABLE IF EXISTS `tb_soal`;
CREATE TABLE `tb_soal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banksoal_id` int NOT NULL,
  `soal` text NOT NULL,
  `pilihan_a` text NOT NULL,
  `pilihan_b` text NOT NULL,
  `pilihan_c` text NOT NULL,
  `pilihan_d` text NOT NULL,
  `kunci_jawaban` enum('A','B','C','D') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `banksoal_id` (`banksoal_id`),
  CONSTRAINT `tb_soal_ibfk_1` FOREIGN KEY (`banksoal_id`) REFERENCES `tb_banksoal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `tb_tahunakademik`;
CREATE TABLE `tb_tahunakademik` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` varchar(9) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_tahunakademik` (`id`, `tahun`, `semester`, `status`) VALUES
(1,	'2025/2026',	'Ganjil',	'Aktif'),
(2,	'2026/2027',	'',	'Nonaktif');

-- 2025-06-27 04:36:07
