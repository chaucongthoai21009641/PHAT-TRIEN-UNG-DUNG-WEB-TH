-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2024 at 09:08 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tmdt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `congty`
--

CREATE TABLE `congty` (
  `idcty` int(11) NOT NULL auto_increment,
  `tencty` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `diachi` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `dienthoai` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `fax` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`idcty`),
  UNIQUE KEY `tencty` (`tencty`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `congty`
--

INSERT INTO `congty` (`idcty`, `tencty`, `diachi`, `dienthoai`, `fax`) VALUES
(1, 'Apple', 'USA', '', ''),
(2, 'Samsung', 'Korea', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dathang`
--

CREATE TABLE `dathang` (
  `iddh` int(10) unsigned NOT NULL auto_increment,
  `idkh` int(11) NOT NULL,
  `id_nhanvien` int(11) NOT NULL,
  `ngaydathang` date NOT NULL,
  `trangthai` int(11) NOT NULL,
  PRIMARY KEY  (`iddh`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dathang`
--

INSERT INTO `dathang` (`iddh`, `idkh`, `id_nhanvien`, `ngaydathang`, `trangthai`) VALUES
(2, 1, 0, '2024-06-10', 0),
(3, 1, 0, '2024-06-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dathang_chitiet`
--

CREATE TABLE `dathang_chitiet` (
  `iddh` int(10) NOT NULL,
  `idsp` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` float NOT NULL,
  `giamgia` float NOT NULL,
  UNIQUE KEY `khongtrung` (`iddh`,`idsp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dathang_chitiet`
--

INSERT INTO `dathang_chitiet` (`iddh`, `idsp`, `soluong`, `dongia`, `giamgia`) VALUES
(2, 1, 5, 20, 10),
(3, 2, 5, 30, 15);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `iduser` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(100) collate utf8_unicode_ci NOT NULL,
  `password` varchar(100) collate utf8_unicode_ci NOT NULL,
  `hodem` varchar(50) collate utf8_unicode_ci NOT NULL,
  `ten` varchar(20) collate utf8_unicode_ci NOT NULL,
  `diachi` varchar(100) collate utf8_unicode_ci NOT NULL,
  `diachinhanhang` varchar(100) collate utf8_unicode_ci NOT NULL,
  `dienthoai` varchar(20) collate utf8_unicode_ci NOT NULL,
  `phanquyen` int(11) NOT NULL,
  PRIMARY KEY  (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`iduser`, `username`, `password`, `hodem`, `ten`, `diachi`, `diachinhanhang`, `dienthoai`, `phanquyen`) VALUES
(1, 'khachhang@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Khách hàng', 'Công Thoại', '', '', '', 0),
(2, 'khachhang2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Khách hàng 2', 'Châu Công Thoại', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `idsp` int(10) unsigned NOT NULL auto_increment,
  `tensp` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `gia` float NOT NULL,
  `mota` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `hinh` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `giamgia` float NOT NULL,
  `idcty` int(11) NOT NULL,
  PRIMARY KEY  (`idsp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`idsp`, `tensp`, `gia`, `mota`, `hinh`, `giamgia`, `idcty`) VALUES
(1, 'IPhone 15 promax', 20, 'Iphone cho sinh viên', 'ip15prm.jpg', 10, 1),
(2, 'Samsung Galaxy S22 ', 30, 'Samsung dành cho sinh viên, không dành cho giảng viên', 'ss s22.jpg', 15, 2),
(6, 'SamSung A21s', 350, 'Hàng cũ 99%', '1712409607_ss a21s.webp', 125, 2),
(7, 'Iphone 13 promax', 1000, 'Hàng chưa bốc tem', '1712409751_ip 13prm.jpg', 800, 1),
(8, 'Iphone X', 100, 'Hàng like new', '1712892009_ip x.jpg', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `iduser` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hodem` varchar(30) NOT NULL,
  `ten` varchar(20) NOT NULL,
  `phanquyen` int(11) NOT NULL,
  `landangnhapcuoi` datetime NOT NULL,
  PRIMARY KEY  (`iduser`),
  UNIQUE KEY `username` (`username`),
  KEY `password` (`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`iduser`, `username`, `password`, `hodem`, `ten`, `phanquyen`, `landangnhapcuoi`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'chaucong', 'thoai', 1, '2024-04-11 22:01:58');
