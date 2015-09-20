-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2015 at 12:33 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `parent` int(11) NOT NULL,
  `nama_kategori_seo` varchar(100) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama_kategori`, `link`, `parent`, `nama_kategori_seo`) VALUES
(2, '60x60', 'dpg/60x60', 0, '60x60'),
(62, '40x40', 'dpg/40x40', 1, '40x40'),
(67, 'cutting', 'dpg/sorentobrown', 1, 'cutting'),
(68, 'reject', 'dpg/reject', 0, 'reject');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(100) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `no_tlp` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(70) NOT NULL,
  `link` varchar(150) NOT NULL,
  `parent` int(11) NOT NULL,
  `menu_title_seo` varchar(150) NOT NULL,
  `menu_allowed` varchar(100) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `judul_seo` varchar(150) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_product` varchar(100) NOT NULL,
  `nama_product_seo` varchar(140) NOT NULL,
  `harga` int(11) NOT NULL,
  `picture` text NOT NULL,
  `kategori_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `nama_product`, `nama_product_seo`, `harga`, `picture`, `kategori_id`) VALUES
(1, 'sorento beige', 'sorento-beige', 100000, '', 2),
(3, 'artic white', 'artic-white', 50000, '', 67),
(4, 'spektrum white', 'spektrum-white', 12000, '', 62),
(7, 'honolulu grey', 'honolulu-grey', 10000, '', 2),
(11, 'spektrum grey', 'spektrum-grey', 13000, '', 62);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `transaksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=proses, 2=sudah dikirim',
  `no_resi` varchar(50) NOT NULL,
  PRIMARY KEY (`transaksi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `transaksi_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`transaksi_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_level` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=aktif, 2=tidak aktif',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
