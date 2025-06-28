-- SQL untuk menambahkan field gambar_soal ke tabel tb_soal
-- Jalankan query ini di database yang sudah ada

ALTER TABLE `tb_soal` 
ADD COLUMN `gambar_soal` varchar(255) DEFAULT NULL 
AFTER `soal`;

-- Query untuk mengecek struktur tabel setelah penambahan field
DESCRIBE `tb_soal`; 