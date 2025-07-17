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
  CONSTRAINT `tb_banksoal_ibfk_1` FOREIGN KEY (`matapelajaran_id`) REFERENCES `tb_matapelajaran` (`id`),
  CONSTRAINT `tb_banksoal_ibfk_2` FOREIGN KEY (`pegawai_id`) REFERENCES `tb_pegawai` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table db_ujianonlineponpes.tb_jadwal_ujian
CREATE TABLE IF NOT EXISTS `tb_jadwal_ujian` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_ujianonlineponpes.tb_jawaban_ujian
CREATE TABLE IF NOT EXISTS `tb_jawaban_ujian` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_ujianonlineponpes.tb_kelas
CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_ujianonlineponpes.tb_matapelajaran
CREATE TABLE IF NOT EXISTS `tb_matapelajaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_matapelajaran` varchar(20) NOT NULL,
  `nama_matapelajaran` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_ujianonlineponpes.tb_presensi_ujian
CREATE TABLE IF NOT EXISTS `tb_presensi_ujian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jadwal_ujian_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `waktu_hadir` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_ujian_id` (`jadwal_ujian_id`),
  KEY `siswa_id` (`siswa_id`),
  CONSTRAINT `tb_presensi_ujian_ibfk_1` FOREIGN KEY (`jadwal_ujian_id`) REFERENCES `tb_jadwal_ujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_presensi_ujian_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_ujianonlineponpes.tb_ruangan
CREATE TABLE IF NOT EXISTS `tb_ruangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(100) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_ujianonlineponpes.tb_soal
CREATE TABLE IF NOT EXISTS `tb_soal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banksoal_id` int NOT NULL,
  `soal` text NOT NULL,
  `gambar_soal` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_ujianonlineponpes.tb_tahunakademik
CREATE TABLE IF NOT EXISTS `tb_tahunakademik` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` varchar(9) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
