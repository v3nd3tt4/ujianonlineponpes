-- Add NIK field to tb_pegawai table
ALTER TABLE tb_pegawai ADD COLUMN nik VARCHAR(30) UNIQUE AFTER id;

-- Add photo field to tb_pegawai table
ALTER TABLE tb_pegawai
ADD COLUMN foto VARCHAR(255) DEFAULT 'default.jpg' AFTER no_telepon;

-- Add photo field to tb_siswa table
ALTER TABLE tb_siswa
ADD COLUMN foto VARCHAR(255) DEFAULT 'default.jpg' AFTER no_hp;

-- Create directory for profile photos if not exists
CREATE TABLE IF NOT EXISTS `tb_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default photo directory setting
INSERT INTO tb_settings (`key`, `value`) 
VALUES ('photo_profile_dir', 'assets/uploads/profile_photos/')
ON DUPLICATE KEY UPDATE `value` = 'assets/uploads/profile_photos/'; 