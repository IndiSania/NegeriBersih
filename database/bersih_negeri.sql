CREATE DATABASE IF NOT EXISTS bersih_negeri CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bersih_negeri;
CREATE TABLE users(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120) NOT NULL,email VARCHAR(160) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,role ENUM('masyarakat','petugas','admin') NOT NULL DEFAULT 'masyarakat',
 is_active TINYINT(1) NOT NULL DEFAULT 1,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE reports(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,user_id INT UNSIGNED NOT NULL,title VARCHAR(160) NOT NULL,
 description TEXT NOT NULL,area VARCHAR(220) NOT NULL,waste_type ENUM('Organik','Anorganik','B3 Rumah Tangga','Campuran') NOT NULL DEFAULT 'Campuran',
 photo_url VARCHAR(500) NULL,latitude DECIMAL(10,7) NULL,longitude DECIMAL(10,7) NULL,
 status ENUM('Menunggu','Diverifikasi','Ditangani','Selesai','Ditolak') NOT NULL DEFAULT 'Menunggu',
 staff_note TEXT NULL,handled_by INT UNSIGNED NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT fk_report_user FOREIGN KEY(user_id) REFERENCES users(id),
 CONSTRAINT fk_report_staff FOREIGN KEY(handled_by) REFERENCES users(id) ON DELETE SET NULL,
 INDEX idx_report_status(status),INDEX idx_report_area(area)
) ENGINE=InnoDB;
CREATE TABLE recycling_points(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(160) NOT NULL,type VARCHAR(100) NOT NULL,
 address VARCHAR(250) NOT NULL,latitude DECIMAL(10,7) NULL,longitude DECIMAL(10,7) NULL,
 hours VARCHAR(120) NULL,is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;
CREATE TABLE collection_schedules(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,area VARCHAR(180) NOT NULL,day_name ENUM('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
 start_time TIME NOT NULL,waste_type VARCHAR(100) NOT NULL,service_type VARCHAR(100) NOT NULL DEFAULT 'Pengangkutan rutin',
 notes VARCHAR(250) NULL,is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;
INSERT INTO users(name,email,password,role) VALUES
('Administrator BersihNegeri','admin@bersihnegeri.id','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.','admin'),
('Petugas Lingkungan','petugas@bersihnegeri.id','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.','petugas'),
('Warga Contoh','warga@bersihnegeri.id','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.','masyarakat');
INSERT INTO recycling_points(name,type,address,latitude,longitude,hours) VALUES
('Bank Sampah Sejahtera','Bank Sampah','Contoh lokasi, Jepara, Jawa Tengah',-6.5900,110.6680,'Senin-Sabtu, 08.00-15.00'),
('Rumah Daur Ulang Mandiri','Pusat Daur Ulang','Contoh lokasi, Kudus, Jawa Tengah',-6.8040,110.8400,'Senin-Jumat, 09.00-16.00'),
('Bank Sampah Hijau Lestari','Bank Sampah','Contoh lokasi, Semarang, Jawa Tengah',-6.9900,110.4200,'Senin-Sabtu, 08.00-14.00');
INSERT INTO collection_schedules(area,day_name,start_time,waste_type,service_type,notes) VALUES
('Contoh Area Bangsri','Senin','07:00:00','Sampah campuran','Pengangkutan rutin','Contoh jadwal untuk demonstrasi.'),
('Contoh Area Mlonggo','Rabu','07:30:00','Sampah rumah tangga','Pengangkutan rutin','Pastikan sampah terpilah dan terikat.'),
('Contoh Area Jepara Kota','Jumat','08:00:00','Sampah anorganik','Pengumpulan terpilah','Contoh jadwal untuk demonstrasi.');
INSERT INTO reports(user_id,title,description,area,waste_type,status,staff_note) VALUES
(3,'Tumpukan sampah di pinggir jalan','Terlihat beberapa kantong sampah menumpuk di dekat saluran air. Mohon dilakukan pengecekan.','Contoh Jalan Raya Bangsri, Jepara','Campuran','Diverifikasi','Contoh data. Petugas dijadwalkan melakukan pengecekan.'),
(3,'Sampah plastik di area fasilitas umum','Sampah plastik dan kemasan terlihat di sekitar fasilitas umum.','Contoh area taman lingkungan, Jepara','Anorganik','Menunggu',NULL);
