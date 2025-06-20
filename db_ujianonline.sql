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

-- Dumping structure for table db_ujianonlineponpes.tb_kelas
CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_kelas: ~0 rows (approximately)
DELETE FROM `tb_kelas`;
INSERT INTO `tb_kelas` (`id`, `nama_kelas`, `keterangan`) VALUES
	(1, 'Animi occaecat corp', 'Magnam nulla proiden');

-- Dumping structure for table db_ujianonlineponpes.tb_matapelajaran
CREATE TABLE IF NOT EXISTS `tb_matapelajaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_matapelajaran` varchar(20) NOT NULL,
  `nama_matapelajaran` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_matapelajaran: ~0 rows (approximately)
DELETE FROM `tb_matapelajaran`;
INSERT INTO `tb_matapelajaran` (`id`, `kode_matapelajaran`, `nama_matapelajaran`, `keterangan`) VALUES
	(1, 'Necessitatibus sit e', 'Consequatur Reprehe', 'Distinctio Anim mol');

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

-- Dumping data for table db_ujianonlineponpes.tb_pegawai: ~0 rows (approximately)
DELETE FROM `tb_pegawai`;
INSERT INTO `tb_pegawai` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `no_telepon`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
	(2, 'Mollit aliquid fuga', 'Adipisci minim magni', '2000-06-04', 'L', 'Dolore dolore cumque', 'Consequatur iste mag', 'tysy@mailinator.com', '$2y$10$W7PSt.VCsOm4XmXu0AM2C.NH0t/ncUYhYKQDvZKtOTE/6DmjueaAK', 'guru', '2025-06-20 02:44:07', '2025-06-20 02:44:07'),
	(3, 'Rerum cumque ab sunt', 'Ad magna dolorem ab ', '1998-10-26', 'P', 'Nihil sint ut eiusmo', 'Ipsam aliquam quae f', 'jywuqod@mailinator.com', '$2y$10$c7vn9MYu5.5bhsEl5Bxsmuhvg/Z35Vgh8dg9c1AKTSsiyswpO7R5W', 'operator', '2025-06-20 06:33:09', '2025-06-20 06:33:09');

-- Dumping structure for table db_ujianonlineponpes.tb_ruangan
CREATE TABLE IF NOT EXISTS `tb_ruangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_ruangan: ~0 rows (approximately)
DELETE FROM `tb_ruangan`;
INSERT INTO `tb_ruangan` (`id`, `nama_ruangan`, `keterangan`) VALUES
	(1, 'Est id labore perfer', 'Deleniti porro eos ');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis` (`nis`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_siswa: ~0 rows (approximately)
DELETE FROM `tb_siswa`;
INSERT INTO `tb_siswa` (`id`, `nama`, `nis`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `email`, `password`, `no_hp`, `nama_ibu`, `nama_ayah`, `pekerjaan_ibu`, `pekerjaan_ayah`) VALUES
	(1, 'Perferendis quibusda', 'Fugiat vel sit omni edit', 'Ut sint ipsum qui a', '2013-12-25', 'P', 'Nesciunt aut aperia', 'cyrufopa@mailinator.com', '$2y$10$9pAPYuc3fTANuHAN8YBgkehLXobJwTi0PiYRUmmzzaElg5WobMtc.', 'Ut quia culpa maxime', 'Sunt voluptatem qui ', 'Eiusmod laborum arch', 'Quaerat tempora haru', 'Et aliquip est sapie');

-- Dumping structure for table db_ujianonlineponpes.tb_tahunakademik
CREATE TABLE IF NOT EXISTS `tb_tahunakademik` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` varchar(9) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_ujianonlineponpes.tb_tahunakademik: ~1 rows (approximately)
DELETE FROM `tb_tahunakademik`;
INSERT INTO `tb_tahunakademik` (`id`, `tahun`, `semester`, `status`) VALUES
	(1, '2025', 'Ganjil', 'Aktif');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
