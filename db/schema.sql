CREATE DATABASE IF NOT EXISTS `db_latihan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_latihan`;

-- --------------------------------------------------------
-- Struktur tabel `experiences`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `experiences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(150) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data untuk tabel `experiences`
INSERT INTO `experiences` (`id`, `position`, `company_name`, `location`, `description`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'Surveyor Icon+', 'PT. Gerbang Sinergi Prima', 'Jakarta', 'Survei jalur kabel fiber optik, menentukan titik optimal ODC/ODP, menghitung BoQ, dan menyusun Laporan Hasil Survei (LHS) menggunakan Google Earth/GIS.', '2016-01-01', '2017-01-02', '2026-08-02 07:50:11', '2026-08-02 17:22:51'),
(2, 'Helpdesk Assurance', 'PT. Telkom Akses', 'Jakarta', 'Memantau performa jaringan menggunakan NMS, mengelola Trouble Ticket sesuai SLA, dan melakukan koordinasi eskalasi intensif dengan tim Tier 2/3.', '2018-01-02', '2020-01-02', '2026-08-02 09:54:21', '2026-08-02 09:54:21'),
(3, 'Team Leader Assurance FTTH', 'PT. Telkom Akses', 'Jakarta', 'Memimpin dan mengawasi tim teknis di lapangan, memastikan hasil pekerjaan memenuhi standar teknis, menyelesaikan kendala ROW, serta mengelola material dan tenaga kerja secara efisien.', '2020-01-03', '2024-01-03', '2026-08-02 17:24:56', '2026-08-02 17:24:56'),
(5, 'Project Controller', 'PT. Telkom Akses', 'Jakarta', 'Pengawasan seluruh proses proyek agar sesuai jadwal yang ditetapkan mulai dari survei dan akuisisi lokasi, negosiasi perizinan dengan pihak pemerintah setempat, implementasi, uji terima, hingga penyelesaian administrasi untuk proses penagihan kepada klien.', '2024-01-04', NULL, '2026-08-03 17:10:47', '2026-08-03 17:10:47')
ON DUPLICATE KEY UPDATE `id`=`id`;

-- --------------------------------------------------------
-- Struktur tabel `portfolios`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `portfolios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data untuk tabel `portfolios`
INSERT INTO `portfolios` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(13, 'FTTH Network Deployment', 'Placeholder for large-scale fiber optic infrastructure projects managed under PT. Telkom Akses.', 'portfolio_1785568761.jpg', '2026-08-01 07:19:21', '2026-08-01 07:19:21'),
(15, 'Network Assurance System', 'Implementation of SLA-based troubleshooting protocols and preventive maintenance for regional nodes.', 'portfolio_1785650050.jpg', '2026-08-02 05:54:10', '2026-08-02 05:54:10'),
(16, 'GIS & Site Surveying', 'Detailed route mapping and Bill of Quantity preparation for underground and aerial cabling projects.', 'portfolio_1785650152.jpeg', '2026-08-02 05:55:52', '2026-08-02 05:55:52')
ON DUPLICATE KEY UPDATE `id`=`id`;

-- --------------------------------------------------------
-- Struktur tabel `users`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_logout` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data untuk tabel `users`
INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `last_logout`, `remember_token`, `last_login`) VALUES
(1, 'admin', 'coba@gmail.co.id', '$2y$10$1tRGo3N6UdzPpggZ8GCAhu2zgND6AF02QFlYlph7fja79R5UVLLYq', '2026-07-24 09:44:57', '2026-08-03 17:40:14', NULL, '2026-08-03 17:09:31')
ON DUPLICATE KEY UPDATE `id`=`id`;