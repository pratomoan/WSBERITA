-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2021 at 04:44 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qnamhs`
--
CREATE DATABASE IF NOT EXISTS `qnamhs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `qnamhs`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `nip` int(10) NOT NULL,
  `password` char(62) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nip`, `password`, `nama`) VALUES
(1111110, '$2y$10$nTB8ehrvhy1ZwsvroVF.8eP7epOtdj3Af2orW4WZsFV/XVYooaCCi', 'Meliana'),
(1111115, '$2y$10$ajT6CflcQzKbP/URjiU0euZ33HGPJIQLnB7qtCZUfXNBjQ1zSxBB.', 'Sulaeman');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(3) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `tanggal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `deskripsi`, `link`, `tanggal`) VALUES
(31, 'Fakultas Psikologi Maranatha Bantu Postulan Kenali Diri di Kon...', '<p class=\"excerpt\">\n                                                            Fakultas Psikologi Universitas Kristen Maranatha kembali melaksanakan pengabdian kepada masyarakat (PKM) yang dilaksanakan di Kongregasi Hati Kudus...                                                        </p><br/><br/><span style=\"font-size:12px; color: gray;\">(Feed generated with <a href=\"https://fetchrss.com\" target=\"_blank\">FetchRSS</a>)</span>', 'http://news.maranatha.edu/fakultas-psikologi-maranatha-bantu-postulan-kenali-diri-di-kongregasi-hati-kudus-yesus-dan-maria/', 'Wed, 06 Oct 2021 15:33:06 +0000'),
(32, 'MEBC 2021: Menjadi True Entrepreneur di Masa Krisis', '<p class=\"excerpt\">\n                                                            Fakultas Bisnis (FB) Universitas Kristen Maranatha menggelar kegiatan tahunan Maranatha Economics and Business Conference (MEBC) pada tanggal...                                                        </p><br/><br/><span style=\"font-size:12px; color: gray;\">(Feed generated with <a href=\"https://fetchrss.com\" target=\"_blank\">FetchRSS</a>)</span>', 'http://news.maranatha.edu/mebc-2021-menjadi-true-entrepreneur-di-masa-krisis/', 'Wed, 06 Oct 2021 15:33:06 +0000'),
(33, 'Fakultas Bisnis Maranatha Ajak GKBP Bandung Memahami Tanggung ...', '<p class=\"excerpt\">\n                                                            Fakultas Bisnis Universitas Kristen Maranatha mengadakan pengedukasian perpajakan pada Gereja Batak Karo Protestan (GKBP), Bandung, pada 12...                                                        </p><br/><br/><span style=\"font-size:12px; color: gray;\">(Feed generated with <a href=\"https://fetchrss.com\" target=\"_blank\">FetchRSS</a>)</span>', 'http://news.maranatha.edu/fakultas-bisnis-maranatha-ajak-gkbp-bandung-memahami-tanggung-jawab-dan-perhitungan-pajak/', 'Wed, 06 Oct 2021 15:33:06 +0000'),
(34, 'Pelatihan Pembuatan Strap Mask dan Clay bagi Siswa SMPK 4 BPK ...', '<p class=\"excerpt\">\n                                                            Di tengah-tengah kondisi Pandemi Covid-19 yang tidak kunjung mereda, Fakultas Seni Rupa dan Desain (FSRD) Universitas Kristen...                                                        </p><br/><br/><span style=\"font-size:12px; color: gray;\">(Feed generated with <a href=\"https://fetchrss.com\" target=\"_blank\">FetchRSS</a>)</span>', 'http://news.maranatha.edu/pelatihan-pembuatan-strap-mask-dan-clay-bagi-siswa-smpk-4-bpk-penabur-guntur-oleh-fsrd-maranatha/', 'Wed, 06 Oct 2021 15:33:06 +0000'),
(35, 'RSGM Maranatha Melantik Direktur Baru: Siap Lanjutkan Proses P...', '<p class=\"excerpt\">\n                                                            Rumah Sakit Gigi dan Mulut (RSGM) Maranatha baru saja melantik drg. Grace Monica, M.K.M. sebagai Direktur RSGM...                                                        </p><br/><br/><span style=\"font-size:12px; color: gray;\">(Feed generated with <a href=\"https://fetchrss.com\" target=\"_blank\">FetchRSS</a>)</span>', 'http://news.maranatha.edu/rsgm-maranatha-melantik-direktur-baru-siap-lanjutkan-proses-penetapan-rumah-sakit-pendidikan-bagi-fkg-maranatha/', 'Wed, 06 Oct 2021 15:33:06 +0000');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(2) NOT NULL,
  `category` varchar(16) NOT NULL,
  `category_by` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `category_by`) VALUES
(7, 'TA', 'Meliana'),
(11, 'STA/TA', 'Meliana');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(2) NOT NULL,
  `submitted_by` varchar(16) NOT NULL,
  `answered_by` varchar(16) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `is_answered` int(2) NOT NULL,
  `category_id` int(3) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_jawab` date DEFAULT NULL,
  `is_published` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `submitted_by`, `answered_by`, `question`, `answer`, `is_answered`, `category_id`, `email`, `nama`, `tanggal_masuk`, `tanggal_jawab`, `is_published`) VALUES
(7, '1572049', 'Meliana', 'Bu, untuk yang Form KP History itu untuk syarat sidang sta harus sudah ada di minggu depan atau bisa sampai saat nanti pengajuan?', 'Bisa sampai nanti pengajuan sidang STA tapi diharapkan sudah mulai minta ke dosen pembimbing kpnya. Berikut link file history KPTA ya Sarah https://drive.google.com/file/d/1DU2SFp7EcJFgi-tx-_d0ocPNertdqOh3/view?usp=sharing untuk permohonan tanda tangan menggunakan docusign (Panduan dapat dilihat pada link berikut : https://drive.google.com/file/d/1YJnJR5cm7ZdFoh4Ov1_e78KrwAcO8YSs/view?usp=sharing) Untuk form bimbingan sta menggunakan file berikut https://drive.google.com/drive/folders/1tOrWUr76qqUDOFw4bMco42pYT-mMyebj', 1, 7, '1572049@maranatha.ac.id', 'Sarah Ula Lutfiah', '2021-08-16', '2021-09-14', 1),
(14, '1672019', 'Meliana', 'Selamat siang bu meli, ingin bertanya untuk email prodi apa ya ko? Terimakasih.', 'Selamat siang Dino, untuk email prodi adalah if@it.maranatha.edu', 1, 7, '1672019@maranatha.ac.id', 'Dino', '2021-09-11', '2021-09-14', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
