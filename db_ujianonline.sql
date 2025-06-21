-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_ujianonlineponpes.tb_gurumatapelajaran
CREATE TABLE IF NOT EXISTS `tb_gurumatapelajaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pegawai_id` int NOT NULL,
  `matapelajaran_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pegawai_id` (`pegawai_id`),
  KEY `matapelajaran_id` (`matapelajaran_id`),
  CONSTRAINT `tb_gurumatapelajaran_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `tb_pegawai` (`id`),
  CONSTRAINT `tb_gurumatapelajaran_ibfk_2` FOREIGN KEY (`matapelajaran_id`) REFERENCES `tb_matapelajaran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_gurumatapelajaran: ~0 rows (approximately)
DELETE FROM `tb_gurumatapelajaran`;

-- Dumping structure for table db_ujianonlineponpes.tb_kelas
CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_kelas: ~0 rows (approximately)
DELETE FROM `tb_kelas`;
INSERT INTO `tb_kelas` (`id`, `nama_kelas`, `keterangan`) VALUES
	(1, 'VII A', '-'),
	(2, 'VII B', '-'),
	(3, 'VIII A', '-'),
	(4, 'VIII B', '-'),
	(5, 'IX A', '-'),
	(6, 'IX B', '-');

-- Dumping structure for table db_ujianonlineponpes.tb_kelasrombel
CREATE TABLE IF NOT EXISTS `tb_kelasrombel` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ujianonlineponpes.tb_kelasrombel: ~0 rows (approximately)
DELETE FROM `tb_kelasrombel`;
INSERT INTO `tb_kelasrombel` (`id`, `kelas_id`, `tahunakademik_id`, `walikelas_id`, `created_at`, `updated_at`) VALUES
	(2, 1, 1, 2, '2025-06-21 02:21:23', '2025-06-21 02:21:23');

-- Dumping structure for table db_ujianonlineponpes.tb_kelassiswa
CREATE TABLE IF NOT EXISTS `tb_kelassiswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `siswa_id` int NOT NULL,
  `kelasrombel_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siswa_id` (`siswa_id`),
  KEY `kelasrombel_id` (`kelasrombel_id`) USING BTREE,
  CONSTRAINT `tb_kelassiswa_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`),
  CONSTRAINT `tb_kelassiswa_ibfk_2` FOREIGN KEY (`kelasrombel_id`) REFERENCES `tb_kelas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_kelassiswa: ~0 rows (approximately)
DELETE FROM `tb_kelassiswa`;
INSERT INTO `tb_kelassiswa` (`id`, `siswa_id`, `kelasrombel_id`) VALUES
	(2, 3, 2),
	(3, 2, 2);

-- Dumping structure for table db_ujianonlineponpes.tb_matapelajaran
CREATE TABLE IF NOT EXISTS `tb_matapelajaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_matapelajaran` varchar(20) NOT NULL,
  `nama_matapelajaran` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_matapelajaran: ~0 rows (approximately)
DELETE FROM `tb_matapelajaran`;
INSERT INTO `tb_matapelajaran` (`id`, `kode_matapelajaran`, `nama_matapelajaran`, `keterangan`) VALUES
	(1, 'MP001-VII', 'Matematika', '-'),
	(2, 'MP001-VIII', 'Matematika', '-'),
	(3, 'MP002-VII', 'Kimia', '-'),
	(4, 'MP002-VIII', 'Kimia', '-');

-- Dumping structure for table db_ujianonlineponpes.tb_pegawai
CREATE TABLE IF NOT EXISTS `tb_pegawai` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_pegawai: ~2 rows (approximately)
DELETE FROM `tb_pegawai`;
INSERT INTO `tb_pegawai` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `no_telepon`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
	(2, 'Mollit aliquid fuga', 'Adipisci minim magni', '2000-06-04', 'L', 'Dolore dolore cumque', 'Consequatur iste mag', 'tysy@mailinator.com', '$2y$10$W7PSt.VCsOm4XmXu0AM2C.NH0t/ncUYhYKQDvZKtOTE/6DmjueaAK', 'guru', '2025-06-20 02:44:07', '2025-06-20 12:10:17'),
	(3, 'Rerum cumque ab sunt', 'Ad magna dolorem ab ', '1998-10-26', 'P', 'Nihil sint ut eiusmo', 'Ipsam aliquam quae f', 'jywuqod@mailinator.com', '$2y$10$c7vn9MYu5.5bhsEl5Bxsmuhvg/Z35Vgh8dg9c1AKTSsiyswpO7R5W', 'operator', '2025-06-20 06:33:09', '2025-06-20 06:33:09');

-- Dumping structure for table db_ujianonlineponpes.tb_ruangan
CREATE TABLE IF NOT EXISTS `tb_ruangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_ruangan: ~0 rows (approximately)
DELETE FROM `tb_ruangan`;
INSERT INTO `tb_ruangan` (`id`, `nama_ruangan`, `keterangan`) VALUES
	(1, 'Soekarno', '-'),
	(2, 'Hatta', '-');

-- Dumping structure for table db_ujianonlineponpes.tb_siswa
CREATE TABLE IF NOT EXISTS `tb_siswa` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_siswa: ~0 rows (approximately)
DELETE FROM `tb_siswa`;
INSERT INTO `tb_siswa` (`id`, `nama`, `nis`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `email`, `password`, `no_hp`, `nama_ibu`, `nama_ayah`, `pekerjaan_ibu`, `pekerjaan_ayah`, `tahun_masuk`) VALUES
	(2, 'Ut sit iusto proiden edit', '1011111', 'Consectetur consect', '2005-06-07', 'P', 'Quia voluptas non ap', 'bavi@mailinator.com', '$2y$10$vrHi4FRAzbzy/89F4W10Ie6opp9BJhfWIRTo9PwQbwSBtthWKfjXK', 'Voluptate earum quis', 'Dolore ullam in quo ', 'Non commodo ea sint', 'Laboriosam numquam ', 'Porro cupiditate vol', '2025'),
	(3, 'Sunt nisi ut possimu edit', '1011112', 'Ipsum officia eum d', '1971-05-06', 'L', 'Ex est laboriosam q', 'vevedu@mailinator.com', '$2y$10$r6VYdUGV58fLfVy8GXVeWu0szuRgc8j4HOJK3zuL2OwZJcQH4SHjq', 'Dolorem maiores beat', 'Elit aut blanditiis', 'In laboriosam et si', 'Totam tempora cumque', 'Accusamus corrupti ', '2025'),
	(4, 'Labore at dolorem re', 'Amet hic incidunt ', 'Aut irure illo conse', '1971-09-08', 'P', 'Iure non qui molliti', 'qixovomuf@mailinator.com', '$2y$10$btP.Yk3NepE5o4rJIhZawOB/JQPH8XPgDsikbPMKBww5kHXkVr.uq', 'Irure aperiam dolore', 'Similique ducimus e', 'Vel perferendis nece', 'Rerum officiis earum', 'Est et accusamus si', '2024');

-- Dumping structure for table db_ujianonlineponpes.tb_tahunakademik
CREATE TABLE IF NOT EXISTS `tb_tahunakademik` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` varchar(9) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_tahunakademik: ~1 rows (approximately)
DELETE FROM `tb_tahunakademik`;
INSERT INTO `tb_tahunakademik` (`id`, `tahun`, `semester`, `status`) VALUES
	(1, '2025/2026', 'Ganjil', 'Aktif'),
	(2, '2026/2027', '', 'Aktif');

-- Dumping structure for table db_ujianonlineponpes.tb_banksoal
CREATE TABLE IF NOT EXISTS `tb_banksoal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(255) NOT NULL,
  `matapelajaran_id` int NOT NULL,
  `pegawai_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `matapelajaran_id` (`matapelajaran_id`),
  KEY `pegawai_id` (`pegawai_id`),
  CONSTRAINT `tb_banksoal_ibfk_1` FOREIGN KEY (`matapelajaran_id`) REFERENCES `tb_matapelajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_banksoal_ibfk_2` FOREIGN KEY (`pegawai_id`) REFERENCES `tb_pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_banksoal: ~0 rows (approximately)
DELETE FROM `tb_banksoal`;

-- Dumping structure for table db_ujianonlineponpes.tb_soal
CREATE TABLE IF NOT EXISTS `tb_soal` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_soal: ~0 rows (approximately)
DELETE FROM `tb_soal`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
