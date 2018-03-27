-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2018 at 01:46 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_survey`
--
CREATE DATABASE IF NOT EXISTS `ta_survey` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ta_survey`;

-- --------------------------------------------------------

--
-- Table structure for table `baris`
--

DROP TABLE IF EXISTS `baris`;
CREATE TABLE `baris` (
  `id_baris` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `isi_baris` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `baris`
--

INSERT INTO `baris` (`id_baris`, `id_pertanyaan`, `isi_baris`) VALUES
(1, 5, 'Baris 1'),
(2, 5, 'Baris 2');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

DROP TABLE IF EXISTS `berita`;
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

DROP TABLE IF EXISTS `jawaban`;
CREATE TABLE `jawaban` (
  `id_responden` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `isi_jawaban` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
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

DROP TABLE IF EXISTS `kolom`;
CREATE TABLE `kolom` (
  `id_kolom` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `isi_kolom` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kolom`
--

INSERT INTO `kolom` (`id_kolom`, `id_pertanyaan`, `isi_kolom`) VALUES
(1, 5, 'Kolom 1'),
(2, 5, 'Kolom 2'),
(3, 5, 'Kolom 3'),
(4, 5, 'Kolom 4'),
(5, 5, 'Kolom 5');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

DROP TABLE IF EXISTS `pertanyaan`;
CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `id_survey` int(11) NOT NULL,
  `nomor_pertanyaan` int(11) NOT NULL,
  `pertanyaan` varchar(500) NOT NULL,
  `penjelasan` varchar(200) NOT NULL,
  `tipe_soal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `id_survey`, `nomor_pertanyaan`, `pertanyaan`, `penjelasan`, `tipe_soal`) VALUES
(1, 2, 1, 'Soal 1', 'Penjelasan 1', 'SingleTextBox'),
(2, 2, 2, 'Soal 2', 'Penjelasan 2', 'CommentBox'),
(3, 2, 3, 'Soal 3', 'Penjelasan 3', 'MultipleChoice'),
(4, 2, 4, 'Soal 4', 'Penjelasan 4', 'MultipleAnswer'),
(5, 2, 5, 'Soal 5', 'Penjelasan 5', 'Matrix');

-- --------------------------------------------------------

--
-- Table structure for table `pilihan`
--

DROP TABLE IF EXISTS `pilihan`;
CREATE TABLE `pilihan` (
  `id_pilihan` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `pilihan` varchar(500) NOT NULL,
  `is_lainnya` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pilihan`
--

INSERT INTO `pilihan` (`id_pilihan`, `id_pertanyaan`, `pilihan`, `is_lainnya`) VALUES
(1, 3, 'Pilihan 1', 0),
(2, 3, 'Pilihan 2', 0),
(3, 3, 'Lainnya', 1),
(4, 4, 'Pilihan 1', 0),
(5, 4, 'Pilihan 2', 0),
(6, 4, 'Lainnya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `responden`
--

DROP TABLE IF EXISTS `responden`;
CREATE TABLE `responden` (
  `id_responden` int(11) NOT NULL,
  `jabatan` varchar(300) NOT NULL,
  `nama_perusahaan` varchar(300) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responden`
--

INSERT INTO `responden` (`id_responden`, `jabatan`, `nama_perusahaan`, `id_user`) VALUES
(27, 'sf', 'sdf', 3);

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
CREATE TABLE `survey` (
  `id_survey` int(11) NOT NULL,
  `nama_survey` varchar(300) NOT NULL,
  `deskripsi_survey` text NOT NULL,
  `target_responden` varchar(100) NOT NULL,
  `periode_survey` date NOT NULL,
  `periode_survey_akhir` date NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id_survey`, `nama_survey`, `deskripsi_survey`, `target_responden`, `periode_survey`, `periode_survey_akhir`, `created`) VALUES
(2, 'Survey 2', 'ini deskripsi', 'Programmer Java', '2018-03-08', '2018-03-09', '2018-03-18 13:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_telepon` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `verifikasi_kode` varchar(100) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '2',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `nomor_telepon`, `email`, `password`, `verifikasi_kode`, `role`, `status`) VALUES
(1, 'Alby Ariahari Putra', '', 'albyariahari@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '', 1, 0),
(2, 'Firza', '', 'firzapanjul@gmail.com', '866ceb2c6d58b73f7c8e5fe2dbd5fb73', '', 1, 0),
(3, 'ALDO', '0823472374', 'al.chris.fer@gmail.com', 'b104ab9a0e58c861b9628208b3fecd58', '', 0, 0),
(4, 'sony', '081247142', 'sony@gmail.com', '33561003f44d374c719506bef4faeba4', '', 1, 0),
(5, 'Triand', '0878455454', 'triand12@gmail.com', 'c3571a85500dd71b4b20430c9ae69e20', '', 0, 0),
(6, 'Tes', '0231123', 'tes@s.com', '96e79218965eb72c92a549dd5a330112', '', 0, 0),
(7, 'ASd', '087845545423', 's@gmail.com', '96e79218965eb72c92a549dd5a330112', '', 0, 0),
(8, 'Triand', '08231231', 'sasd@gmail.com', '96e79218965eb72c92a549dd5a330112', '', 0, 0);

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
  ADD KEY `id_baris` (`id_pertanyaan`);

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
  ADD PRIMARY KEY (`id_responden`),
  ADD UNIQUE KEY `id_user_2` (`id_user`),
  ADD KEY `id_user` (`id_user`);

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
  MODIFY `id_baris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id_kolom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pilihan`
--
ALTER TABLE `pilihan`
  MODIFY `id_pilihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `responden`
--
ALTER TABLE `responden`
  MODIFY `id_responden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id_survey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `baris`
--
ALTER TABLE `baris`
  ADD CONSTRAINT `baris_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`);

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
  ADD CONSTRAINT `kolom_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`);

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

--
-- Constraints for table `responden`
--
ALTER TABLE `responden`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
