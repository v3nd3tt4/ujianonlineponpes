CREATE TABLE `tb_jadwal_ujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matapelajaran_id` int(11) NOT NULL,
  `kelasrombel_id` int(11) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `lama_ujian` int(11) NOT NULL COMMENT 'dalam menit',
  `jenis_ujian` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 