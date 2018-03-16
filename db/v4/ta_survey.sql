-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2018 at 05:58 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_survey_master`
--
CREATE DATABASE IF NOT EXISTS `ta_survey_master` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ta_survey_master`;

-- --------------------------------------------------------

--
-- Table structure for table `baris`
--

CREATE TABLE `baris` (
  `id_baris` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `isi_baris` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `cover` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `id_kategori`, `id_user`, `judul`, `deskripsi`, `cover`, `created`) VALUES
(1, 1, 2, 'Lorem ipsum dolor sit amet.', '&lt;p&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget placerat magna, vitae accumsan eros. In sodales, lacus non dignissim ultrices, nunc velit imperdiet elit, non posuere dui neque ut lorem. Vivamus id erat sit amet sapien vestibulum pharetra. Aenean lorem leo, porta in tempor vitae, varius vel augue. Nam nisl ligula, condimentum vitae magna non, dictum pulvinar leo. Mauris et turpis ac elit vulputate pharetra quis vel nunc. Sed facilisis at ipsum at mollis. Maecenas sagittis suscipit ex in pellentesque. Nam lorem enim, posuere in tempus ut, dignissim non lectus. Mauris tempus ante lectus, eu viverra erat consectetur vitae. Vivamus condimentum metus eu magna luctus, ut imperdiet dolor commodo. Nullam ac risus odio.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;ol&gt;&lt;li&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;Mauris viverra facilisis ante vitae malesuada. Vivamus nibh justo, auctor eu consequat at, dignissim sit amet mi. Morbi ac lectus sagittis, varius velit id, lobortis velit. Fusce eu turpis in lectus rutrum porta eu suscipit augue. Duis vitae iaculis sem. Nulla eu urna sem. Duis rhoncus in mi vitae semper. Suspendisse elementum ac urna a aliquet.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;Mauris viverra facilisis ante vitae malesuada. Vivamus nibh justo, auctor eu consequat at, dignissim sit amet mi. Morbi ac lectus sagittis, varius velit id, lobortis velit. Fusce eu turpis in lectus rutrum porta eu suscipit augue. Duis vitae iaculis sem. Nulla eu urna sem. Duis rhoncus in mi vitae semper. Suspendisse elementum ac urna a aliquet.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;Mauris viverra facilisis ante vitae malesuada. Vivamus nibh justo, auctor eu consequat at, dignissim sit amet mi. Morbi ac lectus sagittis, varius velit id, lobortis velit. Fusce eu turpis in lectus rutrum porta eu suscipit augue. Duis vitae iaculis sem. Nulla eu urna sem. Duis rhoncus in mi vitae semper. Suspendisse elementum ac urna a alique.&lt;/span&gt;&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;blockquote&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;Mauris viverra facilisis ante vitae malesuada. Vivamus nibh justo, auctor eu consequat at, dignissim sit amet mi. Morbi ac lectus sagittis, varius velit id, lobortis velit. Fusce eu turpis in lectus rutrum porta eu suscipit augue. Duis vitae iaculis sem. Nulla eu urna sem. Duis rhoncus in mi vitae semper. Suspendisse elementum ac urna a aliquet.&lt;/span&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/blockquote&gt;&lt;p&gt;&lt;/p&gt;', '2017-11-14 03.38.04 1 Update.jpg', '2018-02-16 09:42:22'),
(2, 2, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Test hehehe lalala&amp;nbsp;', 'W1.jpg', '2018-02-23 11:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_responden` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `isi_jawaban` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Olahraga'),
(2, 'Pendidikan'),
(3, 'Politik'),
(4, 'Sosial'),
(5, 'Pekerjaan'),
(6, 'Kompetisi'),
(7, 'Kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `kolom`
--

CREATE TABLE `kolom` (
  `id_kolom` int(11) NOT NULL,
  `id_baris` int(11) NOT NULL,
  `isi_kolom` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `id_survey` int(11) NOT NULL,
  `nomor_pertanyaan` int(11) NOT NULL,
  `pertanyaan` varchar(500) NOT NULL,
  `penjelasan` varchar(200) NOT NULL,
  `tipe_soal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pilihan`
--

CREATE TABLE `pilihan` (
  `id_pilihan` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `pilihan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `responden`
--

CREATE TABLE `responden` (
  `id_responden` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(300) NOT NULL,
  `nama_perusahaan` varchar(300) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `verivikasi_kode` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id_survey` int(11) NOT NULL,
  `nama_survey` varchar(300) NOT NULL,
  `deskripsi_survey` text NOT NULL,
  `target_responden` varchar(100) NOT NULL,
  `periode_survey` date NOT NULL,
  `periode_survey_akhir` date NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Alby Ariahari Putra', 'albyariahari@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'Firza', 'firzapanjul@gmail.com', '866ceb2c6d58b73f7c8e5fe2dbd5fb73', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baris`
--
ALTER TABLE `baris`
  ADD PRIMARY KEY (`id_baris`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD KEY `id_responden` (`id_responden`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kolom`
--
ALTER TABLE `kolom`
  ADD PRIMARY KEY (`id_kolom`),
  ADD KEY `id_baris` (`id_baris`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_survey` (`id_survey`);

--
-- Indexes for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD PRIMARY KEY (`id_pilihan`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`id_responden`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id_survey`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baris`
--
ALTER TABLE `baris`
  MODIFY `id_baris` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kolom`
--
ALTER TABLE `kolom`
  MODIFY `id_kolom` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pilihan`
--
ALTER TABLE `pilihan`
  MODIFY `id_pilihan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responden`
--
ALTER TABLE `responden`
  MODIFY `id_responden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id_survey` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baris`
--
ALTER TABLE `baris`
  ADD CONSTRAINT `baris_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`);

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `berita_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`),
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_responden`) REFERENCES `responden` (`id_responden`);

--
-- Constraints for table `kolom`
--
ALTER TABLE `kolom`
  ADD CONSTRAINT `kolom_ibfk_1` FOREIGN KEY (`id_baris`) REFERENCES `baris` (`id_baris`);

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_survey`) REFERENCES `survey` (`id_survey`);

--
-- Constraints for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD CONSTRAINT `pilihan_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
