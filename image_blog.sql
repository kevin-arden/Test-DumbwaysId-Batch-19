-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2020 at 03:31 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `image_blog`
--

CREATE TABLE `image_blog` (
  `id` int(6) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `file_image` varchar(100) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image_blog`
--

INSERT INTO `image_blog` (`id`, `title`, `content`, `file_image`, `user_id`) VALUES
(200001, 'benefit dari meditasi', 'Ketika Anda bermeditasi, Anda dapat menghilangkan informasi yang berlebihan yang menumpuk setiap hari dan menambah stres Anda', 'meditate.jpeg', 100001),
(200002, 'tips bodybuilding', 'Tidak ada yang salah dengan bersemangat ketika ingin berolahraga di gym. Yang salah adalah ketika Anda langsung mengangkat beban berat tanpa pemanasan terlebih dahulu.', 'fitness.jpeg', 100002),
(200003, 'Pola Makan Sehat untuk Penderi', 'Pertama, Anda perlu menghindari makanan dengan indeks glikemik tinggi, makanan tinggi lemak dan kalori, serta membatasi sumber karbohidrat sederhana.', 'diabetes.jpeg', 100003),
(200004, 'Pola Makan Sehat untuk Penderi', 'Tak hanya mengonsumsi makanan yang tepat untuk diabetes, mengontrol porsinya juga penting dalam menjaga kadar gula dalam darah.', 'diabetes2.jpeg', 100002);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image_blog`
--
ALTER TABLE `image_blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_blog`
--
ALTER TABLE `image_blog`
  ADD CONSTRAINT `image_blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
