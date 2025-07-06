CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('mahasiswa','asisten') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `praktikum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `modul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `praktikum_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text,
  `file_materi` varchar(255),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`praktikum_id`) REFERENCES `praktikum`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `praktikum_mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(11),
  `praktikum_id` int(11),
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`mahasiswa_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`praktikum_id`) REFERENCES `praktikum`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(11),
  `praktikum_id` int(11),
  `modul_id` int(11),
  `file_laporan` varchar(255),
  `nilai` int(11),
  `feedback` text,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`mahasiswa_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`praktikum_id`) REFERENCES `praktikum`(`id`),
  FOREIGN KEY (`modul_id`) REFERENCES `modul`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;