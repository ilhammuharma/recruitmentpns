-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2016 at 10:49 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutppkpk`
--

CREATE TABLE `aboutppkpk` (
  `idTable` int(11) NOT NULL,
  `about` text COLLATE utf8_bin NOT NULL,
  `kepalaPPKPK` char(255) COLLATE utf8_bin NOT NULL,
  `adminPPKPK` char(255) COLLATE utf8_bin NOT NULL,
  `telephone1` char(30) COLLATE utf8_bin NOT NULL,
  `telephone2` char(20) COLLATE utf8_bin NOT NULL,
  `email1` char(50) COLLATE utf8_bin NOT NULL,
  `email2` char(50) COLLATE utf8_bin NOT NULL,
  `alamat` char(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `aboutppkpk`
--

INSERT INTO `aboutppkpk` (`idTable`, `about`, `kepalaPPKPK`, `adminPPKPK`, `telephone1`, `telephone2`, `email1`, `email2`, `alamat`) VALUES
(1, '&lt;p&gt;&lt;strong&gt;Pratama Nusantara Sakti&lt;/strong&gt; is a joint venture companies between 3 conglomerate groups in Indonesia (Djarum Group, Wings Group &amp;amp; CPP Group). We are moved in Cane plantation and Sugar Industry.&lt;/p&gt;\r\n\r\n&lt;p&gt;Pratama Nusantara sakti is the first Sugarcane company which is build in swampy area in Indonesia. We use two transport system which are waterway dan road. We manage the water to be use for logistic system and irigation. Our plantation area located in OKI, Sumatera Selatan.&lt;/p&gt;\r\n\r\n&lt;p&gt;Our vision is to become the first and the largest swamp or low land sugar company in Indonesia which become priority to realize &amp;ldquo;Swasembada Gula&amp;rdquo;. Peoples are very important in our business, so one of our Management Commitment is to build people lives. In our company, we treat you as one of our family member, as mentioned in our company values.&lt;/p&gt;\r\n', '', 'Tama Priambodo', '(021) 57941785', '', 'career@pns.co.id', 'hrd@pns.co.id', ' Setia Budi Selatan St. Kav 16-17, Kuningan Office Park, South Jakarta\r\nWisma Gawi Building, Postal Code 12920\r\nFloor 3th, Suite 303');

-- --------------------------------------------------------

--
-- Table structure for table `applylowongan`
--

CREATE TABLE `applylowongan` (
  `idTable` int(11) NOT NULL,
  `idLowongan` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `applylowongan`
--

INSERT INTO `applylowongan` (`idTable`, `idLowongan`, `idWorker`) VALUES
(7, 15, 6),
(9, 9, 6),
(10, 10, 6),
(11, 16, 1),
(12, 20, 1),
(13, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bidangusaha`
--

CREATE TABLE `bidangusaha` (
  `idUsaha` int(11) NOT NULL,
  `namaBidangUsaha` char(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bidangusaha`
--

INSERT INTO `bidangusaha` (`idUsaha`, `namaBidangUsaha`) VALUES
(1, 'Akunting/Perpajakan'),
(2, 'Advertising / Marketing / Promotion / PR'),
(3, 'Aerospace / Aviation / Airline'),
(4, 'Agricultural / Plantation / Poultry / Fisheries'),
(5, 'Apparel'),
(6, 'Architectural Services / Interior Designing'),
(7, 'Arts / Design / Fashion'),
(8, 'Automobile / Automotive Ancillary / Vehicle'),
(9, 'Banking / Financial Services'),
(10, 'BioTechnology / Pharmaceutical / Clinical research'),
(11, 'Call Center / IT-Enabled Services / BPO'),
(12, 'Chemical / Fertilizers / Pesticides'),
(13, 'Computer / Information Technology (Hardware)'),
(14, 'Computer / Information Technology (Software)'),
(15, 'Construction / Building / Engineering'),
(16, 'Consulting (Business & Management)'),
(17, 'Consulting (IT, Science, Engineering & Technical)'),
(18, 'Consumer Products / FMCG'),
(19, 'Education'),
(20, 'Electrical & Electronics'),
(21, 'Entertainment / Media'),
(22, 'Environment / Health / Safety'),
(23, 'Exhibitions / Event management / MICE'),
(24, 'Food & Beverage / Catering / Restaurant'),
(25, 'Gems / Jewellery'),
(26, 'General & Wholesale Trading'),
(27, 'Government / Defence'),
(28, 'Grooming / Beauty / Fitness'),
(29, 'Healthcare / Medical'),
(30, 'Heavy Industrial / Machinery / Equipment'),
(31, 'Hotel / Hospitality'),
(32, 'Human Resources Management / Consulting'),
(33, 'Insurance'),
(34, 'Journalism'),
(35, 'Law / Legal'),
(36, 'Library / Museum'),
(37, 'Manufacturing / Production'),
(38, 'Marine / Aquaculture'),
(39, 'Mining'),
(40, 'Non-Profit Organisation / Social Services / NGO'),
(41, 'Oil / Gas / Petroleum'),
(42, 'Polymer / Plastic / Rubber / Tyres'),
(43, 'Printing / Publishing'),
(44, 'Property / Real Estate'),
(45, 'R&D'),
(46, 'Repair & Maintenance Services'),
(47, 'Retail / Merchandise'),
(48, 'Sains dan Teknologi'),
(49, 'Security / Law Enforcement'),
(50, 'Semiconductor/Wafer Fabrication'),
(51, 'Olahraga'),
(52, 'Stockbroking / Securities'),
(53, 'Telekomunikasi'),
(54, 'Tekstil/Garmen'),
(55, 'Tembakau'),
(56, 'Transportasi / Logistik'),
(57, 'Travel / Tourism'),
(58, 'Utilities / Power'),
(59, 'Kayu/Serat/Kertas'),
(60, 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `event_calendar`
--

CREATE TABLE `event_calendar` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `event_calendar`
--

INSERT INTO `event_calendar` (`id`, `event_date`, `title`, `description`) VALUES
(6, '2016-08-02', 'Job Fair', '&lt;p&gt;Job Fair&lt;/p&gt;\r\n'),
(9, '2016-08-01', 'Peresmian Website Perusahaan', '&lt;p&gt;Peresmian Website Perusahaan&lt;/p&gt;\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `fptk`
--

CREATE TABLE `fptk` (
  `idFptk` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `namaPemohon` varchar(100) NOT NULL,
  `nikPemohon` varchar(6) NOT NULL,
  `posisiPemohon` int(11) NOT NULL,
  `departemenPemohon` int(11) NOT NULL,
  `divisiPosisi` int(11) NOT NULL,
  `departemenPosisi` int(11) NOT NULL,
  `jabatanPosisi` int(11) NOT NULL,
  `levelPosisi` int(11) NOT NULL,
  `lokasiPosisi` int(11) NOT NULL,
  `jumlahPosisi` int(11) NOT NULL,
  `tujuanPosisi` char(20) DEFAULT NULL,
  `penggantiPosisi` char(50) NOT NULL,
  `mppPosisi` char(20) DEFAULT NULL,
  `keteranganPosisi` char(100) NOT NULL,
  `tanggalPosisi` date NOT NULL,
  `jobdesPosisi` char(20) DEFAULT NULL,
  `statusPosisi` char(20) DEFAULT NULL,
  `jumlahlKualifikasi` int(11) NOT NULL,
  `jumlahpKualifikasi` int(11) NOT NULL,
  `usiaKualifikasi` int(11) NOT NULL,
  `pendidikanKualifikasi` int(11) NOT NULL,
  `jurusanKualifikasi` int(11) NOT NULL,
  `pengalamanKualifikasi` int(11) NOT NULL,
  `lainlainKualifikasi` char(100) NOT NULL,
  `tglditerimaBulanan` date NOT NULL,
  `picBulanan` char(50) NOT NULL,
  `tglclosingBulanan` date NOT NULL,
  `pemenuhanBulanan` varchar(20) NOT NULL,
  `karyawanBulanan` char(50) NOT NULL,
  `tglmasukBulanan` date NOT NULL,
  `sbrinternalBulanan` char(50) NOT NULL,
  `sbreksternalBulanan` int(11) NOT NULL,
  `laineksternalBulanan` varchar(50) NOT NULL,
  `tglditerimaHarian` date NOT NULL,
  `tglclosingHarian` date NOT NULL,
  `pemenuhanHarian` varchar(20) NOT NULL,
  `nomorFptk` varchar(30) NOT NULL,
  `namaManager` varchar(30) DEFAULT NULL,
  `tanggalManager` date DEFAULT NULL,
  `namaHrdSuperintendent` varchar(30) DEFAULT NULL,
  `tanggalHrdSuperintendent` date DEFAULT NULL,
  `namaGeneralManager` varchar(30) DEFAULT NULL,
  `tanggalGeneralManager` date DEFAULT NULL,
  `namaHrdManager` varchar(30) DEFAULT NULL,
  `tanggalHrdManager` date DEFAULT NULL,
  `namaDirektur` varchar(30) DEFAULT NULL,
  `tanggalDirektur` date DEFAULT NULL,
  `rejectFPTK` varchar(30) DEFAULT NULL,
  `tanggalReject` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fptk`
--

INSERT INTO `fptk` (`idFptk`, `idWorker`, `namaPemohon`, `nikPemohon`, `posisiPemohon`, `departemenPemohon`, `divisiPosisi`, `departemenPosisi`, `jabatanPosisi`, `levelPosisi`, `lokasiPosisi`, `jumlahPosisi`, `tujuanPosisi`, `penggantiPosisi`, `mppPosisi`, `keteranganPosisi`, `tanggalPosisi`, `jobdesPosisi`, `statusPosisi`, `jumlahlKualifikasi`, `jumlahpKualifikasi`, `usiaKualifikasi`, `pendidikanKualifikasi`, `jurusanKualifikasi`, `pengalamanKualifikasi`, `lainlainKualifikasi`, `tglditerimaBulanan`, `picBulanan`, `tglclosingBulanan`, `pemenuhanBulanan`, `karyawanBulanan`, `tglmasukBulanan`, `sbrinternalBulanan`, `sbreksternalBulanan`, `laineksternalBulanan`, `tglditerimaHarian`, `tglclosingHarian`, `pemenuhanHarian`, `nomorFptk`, `namaManager`, `tanggalManager`, `namaHrdSuperintendent`, `tanggalHrdSuperintendent`, `namaGeneralManager`, `tanggalGeneralManager`, `namaHrdManager`, `tanggalHrdManager`, `namaDirektur`, `tanggalDirektur`, `rejectFPTK`, `tanggalReject`) VALUES
(1, 5, 'FPTK 1', '123456', 68, 2, 2, 2, 69, 6, 11, 2, 'Rekrut Baru', '', 'Tidak', '', '2016-08-15', 'Ada', 'Bulanan', 1, 1, 30, 5, 1, 1, '', '2016-09-30', 'Asdas', '0000-00-00', '3 bulan', 'Asdas', '0000-00-00', 'Asdas', 1, '', '0000-00-00', '0000-00-00', '3 bulan', '0001/HRD-HO/VIII/2016', 'manager', '2016-09-07', 'hrdsuperintendent', '2016-09-14', 'generalmanager', '2016-09-14', 'hrdmanager', '2016-09-14', '', '0000-00-00', '', '0000-00-00'),
(2, 5, 'FPTK 2', '123456', 68, 2, 2, 2, 69, 6, 11, 2, 'Rekrut Baru', '', 'Iya', '', '2016-08-15', 'Ada', 'Bulanan', 1, 1, 30, 5, 1, 1, '', '2016-09-30', 'Asdas', '0000-00-00', '3 bulan', 'Asdas', '0000-00-00', 'Asdas', 1, '', '0000-00-00', '0000-00-00', '3 bulan', '0002/HRD-HO/VIII/2016', 'manager', '2016-09-07', 'hrdsuperintendent', '2016-09-07', 'generalmanager', '2016-09-07', 'hrdmanager', '2016-09-14', 'Auto Approved', '2016-09-14', '', '0000-00-00'),
(3, 5, 'FPTK 3', '123456', 68, 2, 2, 2, 69, 6, 11, 2, 'Rekrut Baru', '', 'Iya', '', '2016-08-15', 'Ada', 'Bulanan', 1, 1, 30, 5, 1, 1, '', '2016-09-30', 'Asdas', '0000-00-00', '3 bulan', 'Asdas', '0000-00-00', 'Asdas', 1, '', '0000-00-00', '0000-00-00', '3 bulan', '0003/HRD-HO/VIII/2016', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(4, 5, 'FPTK 4', '123456', 68, 2, 2, 2, 69, 6, 11, 2, 'Rekrut Baru', '', 'Iya', '', '2016-08-15', 'Ada', 'Bulanan', 1, 1, 30, 5, 1, 1, '', '2016-09-30', 'Asdas', '0000-00-00', '3 bulan', 'Asdas', '0000-00-00', 'Asdas', 1, '', '0000-00-00', '0000-00-00', '3 bulan', '0004/HRD-HO/VIII/2016', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `hubungandarurat`
--

CREATE TABLE `hubungandarurat` (
  `idHubunganDarurat` int(11) NOT NULL,
  `gradeHubunganDarurat` int(11) NOT NULL,
  `namaHubunganDarurat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hubungandarurat`
--

INSERT INTO `hubungandarurat` (`idHubunganDarurat`, `gradeHubunganDarurat`, `namaHubunganDarurat`) VALUES
(1, 1, 'Keluarga'),
(2, 2, 'Sahabat'),
(3, 3, 'Teman'),
(4, 4, 'Lain-Lain');

-- --------------------------------------------------------

--
-- Table structure for table `hubungankeluarga`
--

CREATE TABLE `hubungankeluarga` (
  `idHubungan` int(11) NOT NULL,
  `gradeHubungan` int(11) NOT NULL,
  `namaHubungan` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hubungankeluarga`
--

INSERT INTO `hubungankeluarga` (`idHubungan`, `gradeHubungan`, `namaHubungan`) VALUES
(1, 1, 'Suami/Istri'),
(2, 2, 'Anak'),
(3, 3, 'Ayah'),
(4, 4, 'Ibu'),
(5, 5, 'Saudara');

-- --------------------------------------------------------

--
-- Table structure for table `jenispekerjaan`
--

CREATE TABLE `jenispekerjaan` (
  `idJenisPekerjaan` int(11) NOT NULL,
  `namaJenisPekerjaan` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenispekerjaan`
--

INSERT INTO `jenispekerjaan` (`idJenisPekerjaan`, `namaJenisPekerjaan`) VALUES
(1, 'Accounting/Pembukuan'),
(2, 'Engineering'),
(3, 'Finance'),
(4, 'General Affair/Umum'),
(5, 'Human Resources Management/Personalia'),
(6, 'Information Technology/EDP'),
(7, 'Legal'),
(8, 'Marketing/Sales'),
(9, 'Operational (Kebun/Agronomi)'),
(10, 'Others'),
(11, 'Production'),
(12, 'Production Planning & Control'),
(13, 'Purchasing'),
(14, 'Quality Assurance/Quality Control'),
(15, 'Service/Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `kategoridepartemen`
--

CREATE TABLE `kategoridepartemen` (
  `idDepartemen` int(11) NOT NULL,
  `namaDepartemen` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoridepartemen`
--

INSERT INTO `kategoridepartemen` (`idDepartemen`, `namaDepartemen`) VALUES
(1, 'BD & Strategic Office'),
(2, 'Business Support'),
(3, 'Civil & Engineering'),
(4, 'Community Development'),
(5, 'Finance & Accounting'),
(6, 'Harvesting'),
(7, 'HRD'),
(8, 'Legal'),
(9, 'Medical'),
(10, 'Operation'),
(11, 'Planning, QA and WM'),
(12, 'Plantation'),
(13, 'Plantation (Divisi 1)'),
(14, 'R & D');

-- --------------------------------------------------------

--
-- Table structure for table `kategoridivisi`
--

CREATE TABLE `kategoridivisi` (
  `idDivisi` int(11) NOT NULL,
  `namaDivisi` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoridivisi`
--

INSERT INTO `kategoridivisi` (`idDivisi`, `namaDivisi`) VALUES
(1, 'Business Development'),
(2, 'Business Support'),
(3, 'Operation');

-- --------------------------------------------------------

--
-- Table structure for table `kategorikerja`
--

CREATE TABLE `kategorikerja` (
  `idKategori` int(11) NOT NULL,
  `namaKategori` char(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kategorikerja`
--

INSERT INTO `kategorikerja` (`idKategori`, `namaKategori`) VALUES
(1, 'Accounting Officer'),
(2, 'Accounting Superintendent'),
(3, 'Admin Koperasi'),
(4, 'Admin Staff'),
(5, 'Admin Timbang'),
(6, 'Agronomy Laboratorium Staff'),
(7, 'Agronomy Laboratorium Supervisor'),
(8, 'Agronomy Superintendent'),
(9, 'Asisten Apoteker'),
(10, 'Business & Development Strategic Office Manager'),
(11, 'Budget Officer'),
(12, 'Business Development Specialist'),
(13, 'Business Monitoring Specialist'),
(14, 'Business Support Director'),
(15, 'Business Support Manager'),
(16, 'Canal Construction Staff'),
(17, 'Canal Construction Supervisor'),
(18, 'Canal Maintenance Staff'),
(19, 'Canal Maintenance Supervisor'),
(20, 'Canal Monitoring Officer'),
(21, 'Chemical and Fertilizer Staff'),
(22, 'Chemical and Fertilizer Supervisor'),
(23, 'Civil & Engineering Manager'),
(24, 'Civil and Infrastructure Staff'),
(25, 'Civil and Infrastructure Superintendent'),
(26, 'Civil and Infrastructure Supervisor'),
(27, 'Community Development Manager'),
(28, 'Community Development Staff'),
(29, 'Community Development Superintendent'),
(30, 'Community Development Supervisor'),
(31, 'Compensation and Benefit Superintendent'),
(32, 'Continous Improvement and Procedure Specialist'),
(33, 'Distribution Staff'),
(34, 'Distribution Supervisor'),
(35, 'Doctor'),
(36, 'Driver'),
(37, 'Electrician Mechanic'),
(38, 'Electricity Mechanic (Central)'),
(39, 'Finance Accounting Manager'),
(40, 'Fabrication Mechanic'),
(41, 'Fabrication Mechanic (Central)'),
(42, 'Fabrication Workshop Supervisor (Central)'),
(43, 'Finance Officer'),
(44, 'Finance Staff'),
(45, 'Geographic Information System (GIS) Staff'),
(46, 'Geographic Information System (GIS) Supervisor'),
(47, 'General Service & Transport Supervisor'),
(48, 'General Service Staff'),
(49, 'General Service Supervisor'),
(50, 'Harvesting Manager'),
(51, 'Harvesting Superintendent'),
(52, 'Heavy Equipment Mechanic'),
(53, 'Heavy Equipment Mechanic (Central)'),
(54, 'Heavy Equipment Operator Bulldozer'),
(55, 'Heavy Equipment Operator Excavator'),
(56, 'Heavy Equipment Operator Traktor'),
(57, 'Heavy Equipment Workshop Supervisor (Central)'),
(58, 'Higiene Perusahaan & Kesehatan Kerja'),
(59, 'HR Operation Staff'),
(60, 'HR Operation Superintendent'),
(61, 'HR Operation Supervisor'),
(62, 'HRD Manager'),
(63, 'HSE Staff'),
(64, 'HSE Superintendent'),
(65, 'HSE Supervisor'),
(66, 'Internship'),
(67, 'IT Programmer'),
(68, 'IT Superintendent'),
(69, 'IT Technical Support'),
(70, 'Kepala Koperasi'),
(71, 'Legal Manager'),
(72, 'Legal Officer'),
(73, 'Legal Superintendent'),
(74, 'Lidik/Riksa Staff'),
(75, 'Logistic and Admin Supervisor'),
(76, 'Logistic and Warehouse Staff'),
(77, 'Logistic and Warehouse Supervisor'),
(78, 'Logistic Staff'),
(79, 'LP & LC Staff'),
(80, 'LP & LC Superintendent'),
(81, 'LP & LC Supervisor'),
(82, 'Maintenance Staff'),
(83, 'Maintenance Superintendent'),
(84, 'Maintenance Supervisor'),
(85, 'Mantri'),
(86, 'Manual Harvesting Staff'),
(87, 'Manual Harvesting Supervisor'),
(88, 'Mechanica Electrical Staff'),
(89, 'Mechanical Electrician Supervisor'),
(90, 'Mechanization Harvesting Staff'),
(91, 'Mechanization Harvesting Supervisor'),
(92, 'Medical Manager'),
(93, 'OD Specialist'),
(94, 'Office Boy & Messanger'),
(95, 'Operation Director'),
(96, 'Operational Staff'),
(97, 'Operational Supervisor'),
(98, 'Payroll Officer'),
(99, 'Pest and Disease Staff'),
(100, 'Pest and Disease Supervisor'),
(101, 'Planning Superintendent'),
(102, 'Planning, QA and Water Management Manager'),
(103, 'Plantation General Manager'),
(104, 'Plantation Manager (Divisi 1)'),
(105, 'Planting Staff'),
(106, 'Planting Superintendent'),
(107, 'Planting Supervisor'),
(108, 'President Director'),
(109, 'Procurement & Purchasing Superintendent'),
(110, 'Procurement Officer'),
(111, 'Protection Laboratorium Staff'),
(112, 'Protection Laboratorium Supervisor'),
(113, 'Protection Superintendent'),
(114, 'Provost Officer'),
(115, 'Purchasing Officer'),
(116, 'Purchasing Regional Officer'),
(117, 'QA Staff'),
(118, 'QA Supervisor'),
(119, 'R & D Manager'),
(120, 'Security Superintendent'),
(121, 'Sekertaris GM'),
(122, 'Senior Mantri'),
(123, 'Surveyor & Inventory Staff'),
(124, 'Surveyor & Inventory Supervisor'),
(125, 'Talent Acquisition and Monitoring Officer'),
(126, 'Talent Acquisition and Monitoring Superintendent'),
(127, 'Tata Usaha - Asset Management'),
(128, 'Tata Usaha Superintendent'),
(129, 'Tata Usaha Supervisor'),
(130, 'Tax Superintendent'),
(131, 'Training and Development Officer'),
(132, 'Training and Development Superintendent'),
(133, 'Transport Harvesting Staff'),
(134, 'Transport Harvesting Supervisor'),
(135, 'Transport Staff'),
(136, 'Varieties Staff'),
(137, 'Varieties Supervisor'),
(138, 'Vehicle Mechanic'),
(139, 'Vehicle Mechanic (Central)'),
(140, 'Water and Environment Staff'),
(141, 'Water and Environment Supervisor'),
(142, 'Water Management Superintendent'),
(143, 'Workshop and Engineering Superintendent'),
(144, 'Workshop and Engineering Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `kategorilevel`
--

CREATE TABLE `kategorilevel` (
  `idLevel` int(11) NOT NULL,
  `namaLevel` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategorilevel`
--

INSERT INTO `kategorilevel` (`idLevel`, `namaLevel`) VALUES
(1, 'Director'),
(2, 'Manager'),
(3, 'Non Staff'),
(4, 'Officer/Supervisor'),
(5, 'Operator'),
(6, 'Staff'),
(7, 'Superintendent/Specialist');

-- --------------------------------------------------------

--
-- Table structure for table `keluargabesar`
--

CREATE TABLE `keluargabesar` (
  `idBesar` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `hubunganBesar` int(11) NOT NULL,
  `namaBesar` char(30) NOT NULL,
  `genderBesar` char(1) NOT NULL,
  `tempatLahirBesar` char(30) NOT NULL,
  `birthdayBesar` date NOT NULL,
  `pendidikanBesar` int(11) NOT NULL,
  `pekerjaanBesar` char(30) NOT NULL,
  `perusahaanBesar` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluargabesar`
--

INSERT INTO `keluargabesar` (`idBesar`, `idWorker`, `hubunganBesar`, `namaBesar`, `genderBesar`, `tempatLahirBesar`, `birthdayBesar`, `pendidikanBesar`, `pekerjaanBesar`, `perusahaanBesar`) VALUES
(1, 1, 3, 'Nonsparta', 'L', 'Padang', '0000-00-00', 3, 'Wiraswasta', 'Toko Sejahtera'),
(2, 1, 4, 'Pitranita', 'W', 'Padang', '0000-00-00', 3, 'Mengurus Rumah Tangga', ''),
(3, 1, 5, 'Ihsan Firjatullah', 'L', 'Jakarta', '0000-00-00', 3, 'Pelajar', 'SMKN 14 Jakarta'),
(4, 1, 5, 'Ikhwannudin Alamsyah', 'L', 'Jakarta', '0000-00-00', 2, 'Pelajar', 'MTsN 9 Jakarta'),
(6, 1, 5, 'Shabrina Shafwa Ramadhani', 'W', 'Jakarta', '0000-00-00', 1, 'Pelajar', 'SDN Tanah Tinggi 09');

-- --------------------------------------------------------

--
-- Table structure for table `keluargadarurat`
--

CREATE TABLE `keluargadarurat` (
  `idDarurat` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `hubunganDarurat` int(11) NOT NULL,
  `namaDarurat` char(30) NOT NULL,
  `genderDarurat` char(1) NOT NULL,
  `alamatDarurat` varchar(100) NOT NULL,
  `pekerjaanDarurat` char(30) NOT NULL,
  `perusahaanDarurat` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluargadarurat`
--

INSERT INTO `keluargadarurat` (`idDarurat`, `idWorker`, `hubunganDarurat`, `namaDarurat`, `genderDarurat`, `alamatDarurat`, `pekerjaanDarurat`, `perusahaanDarurat`) VALUES
(1, 1, 1, 'Asmanita', 'W', 'Kramat Sentiong', 'Mengurus Rumah Tangga', '');

-- --------------------------------------------------------

--
-- Table structure for table `keluargainti`
--

CREATE TABLE `keluargainti` (
  `idInti` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `hubunganInti` int(11) NOT NULL,
  `namaInti` char(30) NOT NULL,
  `genderInti` char(1) NOT NULL,
  `tempatLahirInti` char(30) NOT NULL,
  `birthdayInti` date NOT NULL,
  `pendidikanInti` int(11) NOT NULL,
  `pekerjaanInti` char(30) NOT NULL,
  `perusahaanInti` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluargainti`
--

INSERT INTO `keluargainti` (`idInti`, `idWorker`, `hubunganInti`, `namaInti`, `genderInti`, `tempatLahirInti`, `birthdayInti`, `pendidikanInti`, `pekerjaanInti`, `perusahaanInti`) VALUES
(4, 1, 2, 'Ihsan Firjatullah', 'L', 'Jakarta', '0000-00-00', 3, 'Pelajar', 'SMKN 14 Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `lingkungankerja`
--

CREATE TABLE `lingkungankerja` (
  `idLingkunganKerja` int(11) NOT NULL,
  `namaLingkunganKerja` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lingkungankerja`
--

INSERT INTO `lingkungankerja` (`idLingkunganKerja`, `namaLingkunganKerja`) VALUES
(1, 'Bengkel'),
(2, 'Kantor'),
(3, 'Kebun'),
(4, 'Laboratorium'),
(5, 'Lapangan'),
(6, 'Pabrik');

-- --------------------------------------------------------

--
-- Table structure for table `loginadmin`
--

CREATE TABLE `loginadmin` (
  `idLogin` int(2) NOT NULL,
  `email` char(30) COLLATE utf8_bin NOT NULL,
  `username` char(20) COLLATE utf8_bin NOT NULL,
  `password` char(32) COLLATE utf8_bin NOT NULL,
  `resetCode` char(32) COLLATE utf8_bin NOT NULL,
  `validUntil` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `loginadmin`
--

INSERT INTO `loginadmin` (`idLogin`, `email`, `username`, `password`, `resetCode`, `validUntil`) VALUES
(1, 'ilham.muharma@gmail.com', 'admin', 'b8f1d8164fabcec4fd0a36d77880d6ff', '', '2016-08-22 08:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `loginhrd`
--

CREATE TABLE `loginhrd` (
  `idLogin` int(5) NOT NULL,
  `email` char(50) COLLATE utf8_bin NOT NULL,
  `username` char(20) COLLATE utf8_bin NOT NULL,
  `password` char(32) COLLATE utf8_bin NOT NULL,
  `resetCode` char(32) COLLATE utf8_bin NOT NULL,
  `validUntil` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `loginhrd`
--

INSERT INTO `loginhrd` (`idLogin`, `email`, `username`, `password`, `resetCode`, `validUntil`, `active`) VALUES
(1, 'ilham.muharma@gmail.com', 'hrd', 'b8f1d8164fabcec4fd0a36d77880d6ff', '', '2014-10-31 13:06:58', 1),
(4, 'me@andibaskoro.com', 'hrd2', '9d2e45f0c0fbd1ec1d3fe312dc6d9da1', '', '2014-11-02 10:15:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loginuser`
--

CREATE TABLE `loginuser` (
  `idLogin` int(9) NOT NULL,
  `email` char(50) COLLATE utf8_bin NOT NULL,
  `username` char(20) COLLATE utf8_bin NOT NULL,
  `password` char(32) COLLATE utf8_bin NOT NULL,
  `resetCode` char(32) COLLATE utf8_bin NOT NULL,
  `validUntil` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `level` int(2) NOT NULL DEFAULT '2',
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `loginuser`
--

INSERT INTO `loginuser` (`idLogin`, `email`, `username`, `password`, `resetCode`, `validUntil`, `active`, `level`, `permission`) VALUES
(1, 'ilham.muharma@gmail.com', 'worker', 'b8f1d8164fabcec4fd0a36d77880d6ff', 'f3d4e537af797683627fc169cbc21085', '2016-08-25 04:34:59', 1, 2, 2),
(2, 'ilham.muharma@gmail.com', 'admin', 'b8f1d8164fabcec4fd0a36d77880d6ff', '', '2016-08-25 04:36:24', 1, 1, 3),
(5, 'superintendent@gmail.com', 'superintendent', 'ea31653adc10ca5a41d471eddd7a06f6', '', '2016-08-12 02:52:47', 1, 3, 0),
(6, 'ikhwannudin.alamsyah@gmail.com', 'worker2', 'b8f1d8164fabcec4fd0a36d77880d6ff', '', '2016-08-12 02:53:02', 1, 2, 0),
(7, 'manager@gmail.com', 'manager', 'ea31653adc10ca5a41d471eddd7a06f6', '', '2016-08-12 02:52:47', 1, 3, 0),
(8, 'hrdsuperintendent@gmail.com', 'hrdsuperintendent', 'ea31653adc10ca5a41d471eddd7a06f6', '', '2016-08-12 02:52:47', 1, 3, 0),
(9, 'generalmanager@gmail.com', 'generalmanager', 'ea31653adc10ca5a41d471eddd7a06f6', '', '2016-08-12 02:52:47', 1, 3, 0),
(10, 'hrdmanager@gmail.com', 'hrdmanager', 'ea31653adc10ca5a41d471eddd7a06f6', '', '2016-08-12 02:52:47', 1, 3, 0),
(11, 'direktur@gmail.com', 'direktur', 'ea31653adc10ca5a41d471eddd7a06f6', '', '2016-08-12 02:52:47', 1, 3, 0),
(12, 'alvino.gillang@gmail.com', 'alvinogillang', 'b8f1d8164fabcec4fd0a36d77880d6ff', '296ba5c2bad055164c8aa6f129e7fe66', '2016-08-22 05:45:24', 1, 3, 0),
(13, 'ihsan.firjatullah@gmail.com', 'ihsanfirjatullah', 'd30df75adb2bf1a3cbe329e74ec3676b', 'bb2e9398f8ea80d1f2daff1bde06107a', '2016-08-22 08:30:19', 1, 0, 0),
(17, 'shabrina.sr@gmail.com', 'shabrinashafwa', 'd8ad7d9981969c1a34a9cf6c25e84c90', 'bc0844d33c5e51469891b3b8e41bd0b8', '2016-08-22 08:41:07', 1, 2, 0),
(22, 'asdas9@gmail.com', 'asdas9', 'b8f1d8164fabcec4fd0a36d77880d6ff', '6128b0035a04ea7209e918c963ae69c2', '2016-09-30 12:00:09', 1, 3, 0),
(23, 'asdas10@gmail.com', 'asdas10', 'b8f1d8164fabcec4fd0a36d77880d6ff', 'a71572182ea85574f04b714ff01ff237', '2016-09-30 12:03:05', 1, 2, 0),
(24, 'jessica.wongso@gmail.com', 'jessicawongso', 'b8f1d8164fabcec4fd0a36d77880d6ff', '3755558a60e970bbcf47531a77ccddb3', '2016-10-05 10:13:12', 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pendidikanworker`
--

CREATE TABLE `pendidikanworker` (
  `idPendidikan` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `namaInstansi` char(50) COLLATE utf8_bin NOT NULL,
  `lokasiInstansi` int(11) NOT NULL,
  `kualifikasiPendidikan` int(11) NOT NULL,
  `jurusanPendidikan` int(11) NOT NULL,
  `nilai` int(11) NOT NULL DEFAULT '0',
  `tahunLulus` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pendidikanworker`
--

INSERT INTO `pendidikanworker` (`idPendidikan`, `idWorker`, `namaInstansi`, `lokasiInstansi`, `kualifikasiPendidikan`, `jurusanPendidikan`, `nilai`, `tahunLulus`) VALUES
(11, 1, 'Universitas Indonesia', 11, 5, 19, 3, 2017),
(12, 1, 'SMPN 216', 11, 2, 71, 9, 2010),
(13, 1, 'SMAN 21', 11, 3, 64, 8, 2013),
(18, 1, 'Universitas Indonesia', 11, 6, 11, 4, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `pengalamanworker`
--

CREATE TABLE `pengalamanworker` (
  `idPengalaman` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `namaPerusahaan` char(100) COLLATE utf8_bin NOT NULL,
  `bidangUsaha` int(11) NOT NULL,
  `posisi` char(50) COLLATE utf8_bin NOT NULL,
  `lokasi` int(11) NOT NULL,
  `awalKerja` date NOT NULL,
  `akhirKerja` date NOT NULL,
  `gaji` double NOT NULL DEFAULT '0',
  `grossNett` int(11) NOT NULL,
  `jumlahBawahan` varchar(11) COLLATE utf8_bin NOT NULL,
  `deskripsi` varchar(500) COLLATE utf8_bin NOT NULL,
  `namaAtasan` char(50) COLLATE utf8_bin NOT NULL,
  `telpAtasan` char(15) COLLATE utf8_bin NOT NULL,
  `jabatanAtasan` char(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pengalamanworker`
--

INSERT INTO `pengalamanworker` (`idPengalaman`, `idWorker`, `namaPerusahaan`, `bidangUsaha`, `posisi`, `lokasi`, `awalKerja`, `akhirKerja`, `gaji`, `grossNett`, `jumlahBawahan`, `deskripsi`, `namaAtasan`, `telpAtasan`, `jabatanAtasan`) VALUES
(7, 1, 'Kantor Humas UI', 19, 'Brand Ambassador', 11, '2014-01-06', '0000-00-00', 3000000, 0, '0', 'Masih bekerja', 'Rini Febriani', '085311308346', 'Kepala Divisi Promosi'),
(23, 1, 'PT Pratama Nusantara Sakti', 4, 'IT Programmer', 11, '2016-06-06', '0000-00-00', 3000000, 0, '0', 'Masih bekerja.', 'Tama Priambodo', '085311308346', 'IT Superintendent'),
(24, 1, 'Kantor Humas UI', 19, 'Brand Ambassador', 11, '2012-01-06', '0000-00-00', 3000000, 0, '0', 'Masih bekerja', 'Rini Febriani', '085311308346', 'Kepala Divisi Promosi');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `idPermission` int(11) NOT NULL,
  `namaPermission` varchar(100) NOT NULL,
  `linkPermission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`idPermission`, `namaPermission`, `linkPermission`) VALUES
(1, 'Create FPTK', 'worker/fptk.php'),
(2, 'Approval', 'worker/approvalFptk.php?id=1'),
(3, 'Verifikasi 1', 'worker/approvalFptk.php?id=2'),
(4, 'Verifikasi 2', 'worker/approvalFptk.php?id=3'),
(5, 'Approval HRD Manager', 'worker/approvalFptk.php?id=4'),
(6, 'Approval Direktur', 'worker/approvalFptk.php?id=5'),
(7, 'Progress FPTK', 'worker/listFptk.php');

-- --------------------------------------------------------

--
-- Table structure for table `postinglowongan`
--

CREATE TABLE `postinglowongan` (
  `idLowongan` int(11) NOT NULL,
  `namaPosisi` varchar(100) COLLATE utf8_bin NOT NULL,
  `kodePosisi` char(10) COLLATE utf8_bin NOT NULL,
  `kategoriPosisi` int(3) NOT NULL,
  `pendidikanMinimal` int(2) NOT NULL,
  `ipkNilai` float NOT NULL DEFAULT '0',
  `umurMaksimal` int(2) NOT NULL DEFAULT '0',
  `lokasiPenempatan` int(3) NOT NULL,
  `gajiDitawarkan` double NOT NULL DEFAULT '0',
  `tanggalPosting` date NOT NULL,
  `batasAkhir` date DEFAULT NULL,
  `deskripsiKerja` text COLLATE utf8_bin,
  `kualifikasiLain` text COLLATE utf8_bin NOT NULL,
  `idHrd` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `postinglowongan`
--

INSERT INTO `postinglowongan` (`idLowongan`, `namaPosisi`, `kodePosisi`, `kategoriPosisi`, `pendidikanMinimal`, `ipkNilai`, `umurMaksimal`, `lokasiPenempatan`, `gajiDitawarkan`, `tanggalPosting`, `batasAkhir`, `deskripsiKerja`, `kualifikasiLain`, `idHrd`) VALUES
(5, 'EDP', '', 5, 3, 3, 20, 6, 0, '2014-11-10', '2014-12-27', '', '', 4),
(9, 'Programmer', 'PRG', 43, 3, 3, 30, 11, 15000000, '2014-11-12', '2014-11-30', NULL, '&lt;ul&gt;\r\n	&lt;li&gt;Bisa membaca&lt;/li&gt;\r\n	&lt;li&gt;Tidak buta warna&lt;/li&gt;\r\n	&lt;li&gt;Belum menikah&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', 4),
(10, 'IT Staff', '', 43, 3, 2.8, 26, 16, 0, '2014-11-12', '2014-11-29', '', '&lt;ul&gt;\r\n	&lt;li&gt;&lt;strong&gt;Pria &amp;amp; Wanita usia maksimal 26 tahun&lt;/strong&gt;&lt;/li&gt;\r\n	&lt;li&gt;S1-Teknik Informatika/Sistem Informasi&lt;/li&gt;\r\n	&lt;li&gt;IPK minimal 2.80 dari skala 4.00&lt;/li&gt;\r\n	&lt;li&gt;Fresh Graduate ataupun berpengalaman&lt;/li&gt;\r\n	&lt;li&gt;Bersedia di tempatkan di Karawang&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Kirim lamaran ke email clara@advics-min.co.id (maksimal 14 November 2014) berisi :&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Riwayat hidup (CV)&amp;amp; Surat lamaran&lt;/li&gt;\r\n	&lt;li&gt;Fotocopy/Scan KTP&lt;/li&gt;\r\n	&lt;li&gt;Fotocopy Ijazah/Surat Keterangan Lulus &amp;amp;Transkrip Nilai Akademik/Sementara&lt;/li&gt;\r\n	&lt;li&gt;Pas Foto terbaru ukuran 3x4 berwarna 1 lembar &amp;nbsp;&amp;nbsp;&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', 1),
(12, 'Programmer', 'PRG', 43, 3, 3, 30, 11, 15000000, '2014-11-12', '2014-11-30', NULL, '&lt;ul&gt;\r\n	&lt;li&gt;Bisa membaca&lt;/li&gt;\r\n	&lt;li&gt;Tidak buta warna&lt;/li&gt;\r\n	&lt;li&gt;Belum menikah&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', 4),
(15, 'Accounting', 'ACC', 1, 3, 3, 25, 14, 0, '2014-11-10', '2014-11-29', '&lt;blockquote&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;br /&gt;\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;br /&gt;\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;br /&gt;\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;br /&gt;\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;br /&gt;\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n&lt;/blockquote&gt;\r\n', '&lt;p&gt;&lt;strong&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;br /&gt;\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;br /&gt;\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;br /&gt;\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;br /&gt;\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;br /&gt;\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/strong&gt;&lt;/p&gt;\r\n', 1),
(16, 'Management Trainee', 'MT', 54, 3, 3.2, 25, 34, 3000000, '2014-11-21', '2014-12-25', NULL, '&lt;p&gt;Management Trainee Indonesia&lt;/p&gt;\r\n', 4),
(20, 'IT Programmer', 'IT', 67, 5, 3.3, 30, 11, 6000000, '2016-07-29', '2016-09-01', NULL, '&lt;p&gt;Jod Description&lt;/p&gt;\r\n\r\n&lt;p&gt;1. Maintenance server&lt;/p&gt;\r\n\r\n&lt;p&gt;2. Mampu menguasai bahasa pemrograman PHP, Javascript, HTML, Java, C, dan C++&lt;/p&gt;\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `referensieksternal`
--

CREATE TABLE `referensieksternal` (
  `idRefeksternal` int(11) NOT NULL,
  `namaRefeksternal` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referensieksternal`
--

INSERT INTO `referensieksternal` (`idRefeksternal`, `namaRefeksternal`) VALUES
(1, 'JobStreet'),
(2, 'LinkedIn'),
(3, 'OLX'),
(4, 'Website Perusahaan'),
(5, 'StudentJob'),
(6, 'Lain-Lain');

-- --------------------------------------------------------

--
-- Table structure for table `rolepermission`
--

CREATE TABLE `rolepermission` (
  `idRole` int(11) NOT NULL,
  `idLogin` int(11) NOT NULL,
  `idPermission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolepermission`
--

INSERT INTO `rolepermission` (`idRole`, `idLogin`, `idPermission`) VALUES
(42, 11, 6),
(43, 11, 7),
(44, 9, 4),
(45, 9, 7),
(46, 10, 5),
(47, 10, 7),
(52, 5, 1),
(53, 5, 7),
(60, 7, 2),
(61, 7, 7),
(62, 8, 3),
(63, 8, 7),
(64, 12, 1),
(65, 12, 7);

-- --------------------------------------------------------

--
-- Table structure for table `skillbahasaworker`
--

CREATE TABLE `skillbahasaworker` (
  `idTable` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `idBahasa` int(11) NOT NULL,
  `tingkatLisan` int(11) NOT NULL,
  `tingkatMenulis` int(11) NOT NULL,
  `tingkatMembaca` int(11) NOT NULL,
  `keteranganBahasa` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `skillbahasaworker`
--

INSERT INTO `skillbahasaworker` (`idTable`, `idWorker`, `idBahasa`, `tingkatLisan`, `tingkatMenulis`, `tingkatMembaca`, `keteranganBahasa`) VALUES
(4, 5, 4, 1, 1, 0, ''),
(5, 1, 1, 3, 1, 0, ''),
(7, 1, 2, 2, 2, 0, ''),
(8, 1, 7, 1, 1, 0, ''),
(9, 1, 1, 3, 3, 0, ''),
(10, 1, 1, 3, 3, 0, ''),
(11, 1, 1, 3, 3, 3, ''),
(12, 1, 2, 2, 2, 2, 'TOEFL (570) dan IELTS (6.0)'),
(13, 1, 7, 1, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `skillmengemudiworker`
--

CREATE TABLE `skillmengemudiworker` (
  `idTableM` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `idMengemudi` int(11) NOT NULL,
  `keahlianMengemudi` int(11) NOT NULL,
  `noSim` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skillmengemudiworker`
--

INSERT INTO `skillmengemudiworker` (`idTableM`, `idWorker`, `idMengemudi`, `keahlianMengemudi`, `noSim`) VALUES
(1, 1, 1, 3, '0011223344556'),
(3, 1, 2, 2, '1122334455667');

-- --------------------------------------------------------

--
-- Table structure for table `skilltrainingworker`
--

CREATE TABLE `skilltrainingworker` (
  `idTraining` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `namaTraining` char(50) NOT NULL,
  `penyelenggaraTraining` char(50) NOT NULL,
  `tahunTraining` int(4) NOT NULL,
  `keteranganTraining` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skilltrainingworker`
--

INSERT INTO `skilltrainingworker` (`idTraining`, `idWorker`, `namaTraining`, `penyelenggaraTraining`, `tahunTraining`, `keteranganTraining`) VALUES
(21, 1, 'IOT', 'DTE FTUI', 2016, 2),
(22, 1, 'Big Data', 'DTE FTUI', 2014, 1),
(30, 1, 'NDN', 'DTE FTUI', 2015, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skillworker`
--

CREATE TABLE `skillworker` (
  `idSkill` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `namaSkill` char(30) COLLATE utf8_bin NOT NULL,
  `tingkatSkill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `skillworker`
--

INSERT INTO `skillworker` (`idSkill`, `idWorker`, `namaSkill`, `tingkatSkill`) VALUES
(3, 5, 'MySQL', 1),
(4, 6, 'PHP', 1),
(5, 1, 'Java', 2),
(6, 1, 'Javascript', 1),
(7, 1, 'HTML', 3),
(8, 1, 'PHP', 2),
(9, 1, 'C', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sosialkenalan`
--

CREATE TABLE `sosialkenalan` (
  `idKenalan` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `namaKenalan` varchar(50) NOT NULL,
  `perusahaanKenalan` varchar(50) NOT NULL,
  `jabatanKenalan` varchar(50) NOT NULL,
  `noTelpKenalan` char(15) NOT NULL,
  `hubunganKenalan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sosialkenalan`
--

INSERT INTO `sosialkenalan` (`idKenalan`, `idWorker`, `namaKenalan`, `perusahaanKenalan`, `jabatanKenalan`, `noTelpKenalan`, `hubunganKenalan`) VALUES
(1, 1, 'Donny Putra', 'PT Pratama Nusantara Sakti', 'HRD', '085311308346', 'Keluarga');

-- --------------------------------------------------------

--
-- Table structure for table `sosialorganisasi`
--

CREATE TABLE `sosialorganisasi` (
  `idOrganisasi` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `namaOrganisasi` varchar(50) NOT NULL,
  `bidangOrganisasi` varchar(50) NOT NULL,
  `lokasiOrganisasi` varchar(50) NOT NULL,
  `jabatanOrganisasi` varchar(50) NOT NULL,
  `tahunOrganisasi` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sosialorganisasi`
--

INSERT INTO `sosialorganisasi` (`idOrganisasi`, `idWorker`, `namaOrganisasi`, `bidangOrganisasi`, `lokasiOrganisasi`, `jabatanOrganisasi`, `tahunOrganisasi`) VALUES
(1, 1, 'IEEE SBUI 2016', 'International Electrical & Electronic Engineering', 'Kampus Universitas Indonesia, Depok', 'Vice Dircetor of Educational Affairs Department', 2016);

-- --------------------------------------------------------

--
-- Table structure for table `sosialpsikotest`
--

CREATE TABLE `sosialpsikotest` (
  `idPsikotest` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `waktuPsikotest` int(4) NOT NULL,
  `penyelenggaraPsikotest` varchar(50) NOT NULL,
  `tempatPsikotest` varchar(50) NOT NULL,
  `tujuanPsikotest` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sosialpsikotest`
--

INSERT INTO `sosialpsikotest` (`idPsikotest`, `idWorker`, `waktuPsikotest`, `penyelenggaraPsikotest`, `tempatPsikotest`, `tujuanPsikotest`) VALUES
(1, 1, 2012, 'SMAN 21 Jakarta', 'SMAN 21 Jakarta, Jakarta Timur', 'Penjurusan Perguruan Tinggi');

-- --------------------------------------------------------

--
-- Table structure for table `sosialreferensi`
--

CREATE TABLE `sosialreferensi` (
  `idReferensi` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `namaReferensi` varchar(50) NOT NULL,
  `perusahaanReferensi` varchar(50) NOT NULL,
  `jabatanReferensi` varchar(50) NOT NULL,
  `noTelpReferensi` char(15) NOT NULL,
  `hubunganReferensi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sosialreferensi`
--

INSERT INTO `sosialreferensi` (`idReferensi`, `idWorker`, `namaReferensi`, `perusahaanReferensi`, `jabatanReferensi`, `noTelpReferensi`, `hubunganReferensi`) VALUES
(1, 1, 'Tama Priambodo', 'PT Pratama Nusantara Sakti', 'Supervisor IT', '85311308346', 'Atasan');

-- --------------------------------------------------------

--
-- Table structure for table `stopword`
--

CREATE TABLE `stopword` (
  `idStopWord` int(11) NOT NULL,
  `stopWord` char(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `stopword`
--

INSERT INTO `stopword` (`idStopWord`, `stopWord`) VALUES
(1, 'pusat'),
(3, 'karir'),
(4, 'dan'),
(5, 'pengembangan'),
(6, 'kewirausahaan'),
(8, 'toggle'),
(9, 'navigation'),
(10, 'ppkpk'),
(11, 'home'),
(12, 'about'),
(13, 'us'),
(14, 'press'),
(15, 'room'),
(16, 'this'),
(17, 'is'),
(18, 'a'),
(19, 'simple'),
(20, 'hero'),
(21, 'unit'),
(22, 'jumbotron'),
(23, 'style'),
(24, 'component'),
(25, 'for'),
(26, 'calling'),
(27, 'extra'),
(28, 'attention'),
(29, 'to'),
(30, 'featured'),
(31, 'content'),
(32, 'or'),
(34, 'learn'),
(35, 'more'),
(36, 'not'),
(37, 'valid'),
(38, 'worker'),
(39, 'panel'),
(40, 'pelamar'),
(41, 'login'),
(42, 'registrasi'),
(43, 'lupa'),
(44, 'password'),
(45, 'perusahaan'),
(46, 'utility'),
(47, 'advance'),
(48, 'search'),
(49, 'laquo'),
(50, 'november'),
(51, '2014'),
(52, 'raquo'),
(53, 's'),
(54, 'm'),
(55, 't'),
(56, 'w'),
(57, 'f'),
(89, 'show'),
(90, 'all'),
(91, 'events'),
(92, 'kepala'),
(93, 'dra'),
(97, 'msi'),
(99, 'ibu'),
(101, 'jl'),
(102, 'dr'),
(103, 'wahidin'),
(104, 'sudirohusodo'),
(105, 'no'),
(107, '55224'),
(108, 'phone'),
(109, '0274'),
(110, '563929'),
(111, 'ext'),
(112, '117'),
(113, 'hunting'),
(114, 'email'),
(115, 'career'),
(116, 'ac'),
(117, 'id'),
(119, 'tugas'),
(120, 'akhir'),
(125, '4015'),
(126, 'fakultas'),
(129, 'program'),
(130, 'studi'),
(137, 'dropdown'),
(138, 'alert'),
(139, 'var'),
(140, 'val'),
(141, 'pagination'),
(142, 'twbspagination'),
(143, 'totalpages'),
(144, 'pages'),
(145, 'visiblepages'),
(146, 'onpageclick'),
(147, 'function'),
(148, 'event'),
(149, 'page'),
(150, 'listlowongan'),
(151, 'load'),
(152, 'ajax'),
(153, 'get_page'),
(154, 'php'),
(155, 'showalllowongan'),
(156, 'get_page_all'),
(157, 'article'),
(158, 'showallarticle'),
(159, 'get_all_article'),
(160, 'showallevent'),
(161, 'get_all_event'),
(162, 'silakan'),
(163, 'adalah'),
(164, 'adanya'),
(165, 'adapun'),
(166, 'agak'),
(167, 'agaknya'),
(168, 'agar'),
(169, 'akan'),
(170, 'akankah'),
(171, 'akhir'),
(172, 'akhiri'),
(173, 'akhirnya'),
(174, 'aku'),
(175, 'akulah'),
(176, 'amat'),
(177, 'amatlah'),
(178, 'anda'),
(179, 'andalah'),
(180, 'antar'),
(181, 'antara'),
(182, 'antaranya'),
(183, 'apa'),
(184, 'apaan'),
(185, 'apabila'),
(186, 'apakah'),
(187, 'apalagi'),
(188, 'apatah'),
(189, 'artinya'),
(190, 'asal'),
(191, 'asalkan'),
(192, 'atas'),
(193, 'atau'),
(194, 'ataukah'),
(195, 'ataupun'),
(196, 'awal'),
(197, 'awalnya'),
(198, 'bagai'),
(199, 'bagaikan'),
(200, 'bagaimana'),
(201, 'bagaimanakah'),
(202, 'bagaimanapun'),
(203, 'bagi'),
(204, 'bagian'),
(205, 'bahkan'),
(206, 'bahwa'),
(207, 'bahwasanya'),
(208, 'baik'),
(209, 'bakal'),
(210, 'bakalan'),
(211, 'balik'),
(212, 'banyak'),
(213, 'bapak'),
(214, 'baru'),
(215, 'bawah'),
(216, 'beberapa'),
(217, 'begini'),
(218, 'beginian'),
(219, 'beginikah'),
(220, 'beginilah'),
(221, 'begitu'),
(222, 'begitukah'),
(223, 'begitulah'),
(224, 'begitupun'),
(225, 'bekerja'),
(226, 'belakang'),
(227, 'belakangan'),
(228, 'belum'),
(229, 'belumlah'),
(230, 'benar'),
(231, 'benarkah'),
(232, 'benarlah'),
(233, 'berada'),
(234, 'berakhir'),
(235, 'berakhirlah'),
(236, 'berakhirnya'),
(237, 'berapa'),
(238, 'berapakah'),
(239, 'berapalah'),
(240, 'berapapun'),
(241, 'berarti'),
(242, 'berawal'),
(243, 'berbagai'),
(244, 'berdatangan'),
(245, 'beri'),
(246, 'berikan'),
(247, 'berikut'),
(248, 'berikutnya'),
(249, 'berjumlah'),
(250, 'berkali-kali'),
(251, 'berkata'),
(252, 'berkehendak'),
(253, 'berkeinginan'),
(254, 'berkenaan'),
(255, 'berlainan'),
(256, 'berlalu'),
(257, 'berlangsung'),
(258, 'berlebihan'),
(259, 'bermacam'),
(260, 'bermacam-macam'),
(261, 'bermaksud'),
(262, 'bermula'),
(263, 'bersama'),
(264, 'bersama-sama'),
(265, 'bersiap'),
(266, 'bersiap-siap'),
(267, 'bertanya'),
(268, 'bertanya-tanya'),
(269, 'berturut'),
(270, 'berturut-turut'),
(271, 'bertutur'),
(272, 'berujar'),
(273, 'berupa'),
(274, 'besar'),
(275, 'betul'),
(276, 'betulkah'),
(277, 'biasa'),
(278, 'biasanya'),
(279, 'bila'),
(280, 'bilakah'),
(281, 'bisa'),
(282, 'bisakah'),
(283, 'boleh'),
(284, 'bolehkah'),
(285, 'bolehlah'),
(286, 'buat'),
(287, 'bukan'),
(288, 'bukankah'),
(289, 'bukanlah'),
(290, 'bukannya'),
(291, 'bulan'),
(292, 'bung'),
(293, 'cara'),
(294, 'caranya'),
(295, 'cukup'),
(296, 'cukupkah'),
(297, 'cukuplah'),
(298, 'cuma'),
(299, 'dahulu'),
(300, 'dalam'),
(301, 'dan'),
(302, 'dapat'),
(303, 'dari'),
(304, 'daripada'),
(305, 'datang'),
(306, 'dekat'),
(307, 'demi'),
(308, 'demikian'),
(309, 'demikianlah'),
(310, 'dengan'),
(311, 'depan'),
(312, 'di'),
(313, 'dia'),
(314, 'diakhiri'),
(315, 'diakhirinya'),
(316, 'dialah'),
(317, 'diantara'),
(318, 'diantaranya'),
(319, 'diberi'),
(320, 'diberikan'),
(321, 'diberikannya'),
(322, 'dibuat'),
(323, 'dibuatnya'),
(324, 'didapat'),
(325, 'didatangkan'),
(326, 'digunakan'),
(327, 'diibaratkan'),
(328, 'diibaratkannya'),
(329, 'diingat'),
(330, 'diingatkan'),
(331, 'diinginkan'),
(332, 'dijawab'),
(333, 'dijelaskan'),
(334, 'dijelaskannya'),
(335, 'dikarenakan'),
(336, 'dikatakan'),
(337, 'dikatakannya'),
(338, 'dikerjakan'),
(339, 'diketahui'),
(340, 'diketahuinya'),
(341, 'dikira'),
(342, 'dilakukan'),
(343, 'dilalui'),
(344, 'dilihat'),
(345, 'dimaksud'),
(346, 'dimaksudkan'),
(347, 'dimaksudkannya'),
(348, 'dimaksudnya'),
(349, 'diminta'),
(350, 'dimintai'),
(351, 'dimisalkan'),
(352, 'dimulai'),
(353, 'dimulailah'),
(354, 'dimulainya'),
(355, 'dimungkinkan'),
(356, 'dini'),
(357, 'dipastikan'),
(358, 'diperbuat'),
(359, 'diperbuatnya'),
(360, 'dipergunakan'),
(361, 'diperkirakan'),
(362, 'diperlihatkan'),
(363, 'diperlukan'),
(364, 'diperlukannya'),
(365, 'dipersoalkan'),
(366, 'dipertanyakan'),
(367, 'dipunyai'),
(368, 'diri'),
(369, 'dirinya'),
(370, 'disampaikan'),
(371, 'disebut'),
(372, 'disebutkan'),
(373, 'disebutkannya'),
(374, 'disini'),
(375, 'disinilah'),
(376, 'ditambahkan'),
(377, 'ditandaskan'),
(378, 'ditanya'),
(379, 'ditanyai'),
(380, 'ditanyakan'),
(381, 'ditegaskan'),
(382, 'ditujukan'),
(383, 'ditunjuk'),
(384, 'ditunjuki'),
(385, 'ditunjukkan'),
(386, 'ditunjukkannya'),
(387, 'ditunjuknya'),
(388, 'dituturkan'),
(389, 'dituturkannya'),
(390, 'diucapkan'),
(391, 'diucapkannya'),
(392, 'diungkapkan'),
(393, 'dong'),
(394, 'dua'),
(395, 'dulu'),
(396, 'empat'),
(397, 'enggak'),
(398, 'enggaknya'),
(399, 'entah'),
(400, 'entahlah'),
(401, 'guna'),
(402, 'gunakan'),
(403, 'hal'),
(404, 'hampir'),
(405, 'hanya'),
(406, 'hanyalah'),
(407, 'hari'),
(408, 'harus'),
(409, 'haruslah'),
(410, 'harusnya'),
(411, 'hendak'),
(412, 'hendaklah'),
(413, 'hendaknya'),
(414, 'hingga'),
(415, 'ia'),
(416, 'ialah'),
(417, 'ibarat'),
(418, 'ibaratkan'),
(419, 'ibaratnya'),
(420, 'ibu'),
(421, 'ikut'),
(422, 'ingat'),
(423, 'ingat-ingat'),
(424, 'ingin'),
(425, 'inginkah'),
(426, 'inginkan'),
(427, 'ini'),
(428, 'inikah'),
(429, 'inilah'),
(430, 'itu'),
(431, 'itukah'),
(432, 'itulah'),
(433, 'jadi'),
(434, 'jadilah'),
(435, 'jadinya'),
(436, 'jangan'),
(437, 'jangankan'),
(438, 'janganlah'),
(439, 'jauh'),
(440, 'jawab'),
(441, 'jawaban'),
(442, 'jawabnya'),
(443, 'jelas'),
(444, 'jelaskan'),
(445, 'jelaslah'),
(446, 'jelasnya'),
(447, 'jika'),
(448, 'jikalau'),
(449, 'juga'),
(450, 'jumlah'),
(451, 'jumlahnya'),
(452, 'justru'),
(453, 'kala'),
(454, 'kalau'),
(455, 'kalaulah'),
(456, 'kalaupun'),
(457, 'kalian'),
(458, 'kami'),
(459, 'kamilah'),
(460, 'kamu'),
(461, 'kamulah'),
(462, 'kan'),
(463, 'kapan'),
(464, 'kapankah'),
(465, 'kapanpun'),
(466, 'karena'),
(467, 'karenanya'),
(468, 'kasus'),
(469, 'kata'),
(470, 'katakan'),
(471, 'katakanlah'),
(472, 'katanya'),
(473, 'ke'),
(474, 'keadaan'),
(475, 'kebetulan'),
(476, 'kecil'),
(477, 'kedua'),
(478, 'keduanya'),
(479, 'keinginan'),
(480, 'kelamaan'),
(481, 'kelihatan'),
(482, 'kelihatannya'),
(483, 'kelima'),
(484, 'keluar'),
(485, 'kembali'),
(486, 'kemudian'),
(487, 'kemungkinan'),
(488, 'kemungkinannya'),
(489, 'kenapa'),
(490, 'kepada'),
(491, 'kepadanya'),
(492, 'kesampaian'),
(493, 'keseluruhan'),
(494, 'keseluruhannya'),
(495, 'keterlaluan'),
(496, 'ketika'),
(497, 'khususnya'),
(498, 'kini'),
(499, 'kinilah'),
(500, 'kira'),
(501, 'kira-kira'),
(502, 'kiranya'),
(503, 'kita'),
(504, 'kitalah'),
(505, 'kok'),
(506, 'kurang'),
(507, 'lagi'),
(508, 'lagian'),
(509, 'lah'),
(510, 'lain'),
(511, 'lainnya'),
(512, 'lalu'),
(513, 'lama'),
(514, 'lamanya'),
(515, 'lanjut'),
(516, 'lanjutnya'),
(517, 'lebih'),
(518, 'lewat'),
(519, 'lima'),
(520, 'luar'),
(521, 'macam'),
(522, 'maka'),
(523, 'makanya'),
(524, 'makin'),
(525, 'malah'),
(526, 'malahan'),
(527, 'mampu'),
(528, 'mampukah'),
(529, 'mana'),
(530, 'manakala'),
(531, 'manalagi'),
(532, 'masa'),
(533, 'masalah'),
(534, 'masalahnya'),
(535, 'masih'),
(536, 'masihkah'),
(537, 'masing'),
(538, 'masing-masing'),
(539, 'mau'),
(540, 'maupun'),
(541, 'melainkan'),
(542, 'melakukan'),
(543, 'melalui'),
(544, 'melihat'),
(545, 'melihatnya'),
(546, 'memang'),
(547, 'memastikan'),
(548, 'memberi'),
(549, 'memberikan'),
(550, 'membuat'),
(551, 'memerlukan'),
(552, 'memihak'),
(553, 'meminta'),
(554, 'memintakan'),
(555, 'memisalkan'),
(556, 'memperbuat'),
(557, 'mempergunakan'),
(558, 'memperkirakan'),
(559, 'memperlihatkan'),
(560, 'mempersiapkan'),
(561, 'mempersoalkan'),
(562, 'mempertanyakan'),
(563, 'mempunyai'),
(564, 'memulai'),
(565, 'memungkinkan'),
(566, 'menaiki'),
(567, 'menambahkan'),
(568, 'menandaskan'),
(569, 'menanti'),
(570, 'menanti-nanti'),
(571, 'menantikan'),
(572, 'menanya'),
(573, 'menanyai'),
(574, 'menanyakan'),
(575, 'mendapat'),
(576, 'mendapatkan'),
(577, 'mendatang'),
(578, 'mendatangi'),
(579, 'mendatangkan'),
(580, 'menegaskan'),
(581, 'mengakhiri'),
(582, 'mengapa'),
(583, 'mengatakan'),
(584, 'mengatakannya'),
(585, 'mengenai'),
(586, 'mengerjakan'),
(587, 'mengetahui'),
(588, 'menggunakan'),
(589, 'menghendaki'),
(590, 'mengibaratkan'),
(591, 'mengibaratkannya'),
(592, 'mengingat'),
(593, 'mengingatkan'),
(594, 'menginginkan'),
(595, 'mengira'),
(596, 'mengucapkan'),
(597, 'mengucapkannya'),
(598, 'mengungkapkan'),
(599, 'menjadi'),
(600, 'menjawab'),
(601, 'menjelaskan'),
(602, 'menuju'),
(603, 'menunjuk'),
(604, 'menunjuki'),
(605, 'menunjukkan'),
(606, 'menunjuknya'),
(607, 'menurut'),
(608, 'menuturkan'),
(609, 'menyampaikan'),
(610, 'menyangkut'),
(611, 'menyatakan'),
(612, 'menyebutkan'),
(613, 'menyeluruh'),
(614, 'menyiapkan'),
(615, 'merasa'),
(616, 'mereka'),
(617, 'merekalah'),
(618, 'merupakan'),
(619, 'meski'),
(620, 'meskipun'),
(621, 'meyakini'),
(622, 'meyakinkan'),
(623, 'minta'),
(624, 'mirip'),
(625, 'misal'),
(626, 'misalkan'),
(627, 'misalnya'),
(628, 'mula'),
(629, 'mulai'),
(630, 'mulailah'),
(631, 'mulanya'),
(632, 'mungkin'),
(633, 'mungkinkah'),
(634, 'nah'),
(635, 'naik'),
(636, 'namun'),
(637, 'nanti'),
(638, 'nantinya'),
(639, 'nyaris'),
(640, 'nyatanya'),
(641, 'oleh'),
(642, 'olehnya'),
(643, 'pada'),
(644, 'padahal'),
(645, 'padanya'),
(646, 'pak'),
(647, 'paling'),
(648, 'panjang'),
(649, 'pantas'),
(650, 'para'),
(651, 'pasti'),
(652, 'pastilah'),
(653, 'penting'),
(654, 'pentingnya'),
(655, 'per'),
(656, 'percuma'),
(657, 'perlu'),
(658, 'perlukah'),
(659, 'perlunya'),
(660, 'pernah'),
(661, 'persoalan'),
(662, 'pertama'),
(663, 'pertama-tama'),
(664, 'pertanyaan'),
(665, 'pertanyakan'),
(666, 'pihak'),
(667, 'pihaknya'),
(668, 'pukul'),
(669, 'pula'),
(670, 'pun'),
(671, 'punya'),
(672, 'rasa'),
(673, 'rasanya'),
(674, 'rata'),
(675, 'rupanya'),
(676, 'saat'),
(677, 'saatnya'),
(678, 'saja'),
(679, 'sajalah'),
(680, 'saling'),
(681, 'sama'),
(682, 'sama-sama'),
(683, 'sambil'),
(684, 'sampai'),
(685, 'sampai-sampai'),
(686, 'sampaikan'),
(687, 'sana'),
(688, 'sangat'),
(689, 'sangatlah'),
(690, 'satu'),
(691, 'saya'),
(692, 'sayalah'),
(693, 'se'),
(694, 'sebab'),
(695, 'sebabnya'),
(696, 'sebagai'),
(697, 'sebagaimana'),
(698, 'sebagainya'),
(699, 'sebagian'),
(700, 'sebaik'),
(701, 'sebaik-baiknya'),
(702, 'sebaiknya'),
(703, 'sebaliknya'),
(704, 'sebanyak'),
(705, 'sebegini'),
(706, 'sebegitu'),
(707, 'sebelum'),
(708, 'sebelumnya'),
(709, 'sebenarnya'),
(710, 'seberapa'),
(711, 'sebesar'),
(712, 'sebetulnya'),
(713, 'sebisanya'),
(714, 'sebuah'),
(715, 'sebut'),
(716, 'sebutlah'),
(717, 'sebutnya'),
(718, 'secara'),
(719, 'secukupnya'),
(720, 'sedang'),
(721, 'sedangkan'),
(722, 'sedemikian'),
(723, 'sedikit'),
(724, 'sedikitnya'),
(725, 'seenaknya'),
(726, 'segala'),
(727, 'segalanya'),
(728, 'segera'),
(729, 'seharusnya'),
(730, 'sehingga'),
(731, 'seingat'),
(732, 'sejak'),
(733, 'sejauh'),
(734, 'sejenak'),
(735, 'sejumlah'),
(736, 'sekadar'),
(737, 'sekadarnya'),
(738, 'sekali'),
(739, 'sekali-kali'),
(740, 'sekalian'),
(741, 'sekaligus'),
(742, 'sekalipun'),
(743, 'sekarang'),
(744, 'sekarang'),
(745, 'sekecil'),
(746, 'seketika'),
(747, 'sekiranya'),
(748, 'sekitar'),
(749, 'sekitarnya'),
(750, 'sekurang-kurangnya'),
(751, 'sekurangnya'),
(752, 'sela'),
(753, 'selain'),
(754, 'selaku'),
(755, 'selalu'),
(756, 'selama'),
(757, 'selama-lamanya'),
(758, 'selamanya'),
(759, 'selanjutnya'),
(760, 'seluruh'),
(761, 'seluruhnya'),
(762, 'semacam'),
(763, 'semakin'),
(764, 'semampu'),
(765, 'semampunya'),
(766, 'semasa'),
(767, 'semasih'),
(768, 'semata'),
(769, 'semata-mata'),
(770, 'semaunya'),
(771, 'sementara'),
(772, 'semisal'),
(773, 'semisalnya'),
(774, 'sempat'),
(775, 'semua'),
(776, 'semuanya'),
(777, 'semula'),
(778, 'sendiri'),
(779, 'sendirian'),
(780, 'sendirinya'),
(781, 'seolah'),
(782, 'seolah-olah'),
(783, 'seorang'),
(784, 'sepanjang'),
(785, 'sepantasnya'),
(786, 'sepantasnyalah'),
(787, 'seperlunya'),
(788, 'seperti'),
(789, 'sepertinya'),
(790, 'sepihak'),
(791, 'sering'),
(792, 'seringnya'),
(793, 'serta'),
(794, 'serupa'),
(795, 'sesaat'),
(796, 'sesama'),
(797, 'sesampai'),
(798, 'sesegera'),
(799, 'sesekali'),
(800, 'seseorang'),
(801, 'sesuatu'),
(802, 'sesuatunya'),
(803, 'sesudah'),
(804, 'sesudahnya'),
(805, 'setelah'),
(806, 'setempat'),
(807, 'setengah'),
(808, 'seterusnya'),
(809, 'setiap'),
(810, 'setiba'),
(811, 'setibanya'),
(812, 'setidak-tidaknya'),
(813, 'setidaknya'),
(814, 'setinggi'),
(815, 'seusai'),
(816, 'sewaktu'),
(817, 'siap'),
(818, 'siapa'),
(819, 'siapakah'),
(820, 'siapapun'),
(821, 'sini'),
(822, 'sinilah'),
(823, 'soal'),
(824, 'soalnya'),
(825, 'suatu'),
(826, 'sudah'),
(827, 'sudahkah'),
(828, 'sudahlah'),
(829, 'supaya'),
(830, 'tadi'),
(831, 'tadinya'),
(832, 'tahu'),
(833, 'tahun'),
(834, 'tak'),
(835, 'tambah'),
(836, 'tambahnya'),
(837, 'tampak'),
(838, 'tampaknya'),
(839, 'tandas'),
(840, 'tandasnya'),
(841, 'tanpa'),
(842, 'tanya'),
(843, 'tanyakan'),
(844, 'tanyanya'),
(845, 'tapi'),
(846, 'tegas'),
(847, 'tegasnya'),
(848, 'telah'),
(849, 'tempat'),
(850, 'tengah'),
(851, 'tentang'),
(852, 'tentu'),
(853, 'tentulah'),
(854, 'tentunya'),
(855, 'tepat'),
(856, 'terakhir'),
(857, 'terasa'),
(858, 'terbanyak'),
(859, 'terdahulu'),
(860, 'terdapat'),
(861, 'terdiri'),
(862, 'terhadap'),
(863, 'terhadapnya'),
(864, 'teringat'),
(865, 'teringat-ingat'),
(866, 'terjadi'),
(867, 'terjadilah'),
(868, 'terjadinya'),
(869, 'terkira'),
(870, 'terlalu'),
(871, 'terlebih'),
(872, 'terlihat'),
(873, 'termasuk'),
(874, 'ternyata'),
(875, 'tersampaikan'),
(876, 'tersebut'),
(877, 'tersebutlah'),
(878, 'tertentu'),
(879, 'tertuju'),
(880, 'terus'),
(881, 'terutama'),
(882, 'tetap'),
(883, 'tetapi'),
(884, 'tiap'),
(885, 'tiba'),
(886, 'tiba-tiba'),
(887, 'tidak'),
(888, 'tidakkah'),
(889, 'tidaklah'),
(890, 'tiga'),
(891, 'tinggi'),
(892, 'toh'),
(893, 'tunjuk'),
(894, 'turut'),
(895, 'tutur'),
(896, 'tuturnya'),
(897, 'ucap'),
(898, 'ucapnya'),
(899, 'ujar'),
(900, 'ujarnya'),
(901, 'umum'),
(902, 'umumnya'),
(903, 'ungkap'),
(904, 'ungkapnya'),
(905, 'untuk'),
(906, 'usah'),
(907, 'usai'),
(908, 'waduh'),
(909, 'wah'),
(910, 'wahai'),
(911, 'waktu'),
(912, 'waktunya'),
(913, 'walau'),
(914, 'walaupun'),
(915, 'wong'),
(916, 'yaitu'),
(917, 'yakin'),
(918, 'yakni'),
(919, 'yang'),
(920, 'ada');

-- --------------------------------------------------------

--
-- Table structure for table `tablearticle`
--

CREATE TABLE `tablearticle` (
  `idArticle` int(11) NOT NULL,
  `judulArticle` varchar(255) COLLATE utf8_bin NOT NULL,
  `isiArticle` text COLLATE utf8_bin NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tablearticle`
--

INSERT INTO `tablearticle` (`idArticle`, `judulArticle`, `isiArticle`, `tanggal`) VALUES
(11, 'Tebu', '&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://www.produknaturalnusantara.com/wp-content/uploads/2013/07/panduan-cara-budidaya-tanaman-tebu-gula-natural-nusantara-distributor-resmi-pupuk-organik-nasa-pocnasa-hormonik-supernasa-pentana-pestona-power-nutrition-bvr-glio-metilat-plus-npk-urea-greenstar.jpg&quot; style=&quot;height:427px; margin-top:35px; width:640px&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Tebu&lt;/strong&gt; (&lt;a href=&quot;https://id.wikipedia.org/wiki/Bahasa_Inggris&quot;&gt;bahasa Inggris&lt;/a&gt;: &lt;em&gt;sugar cane&lt;/em&gt;) adalah tanaman yang ditanam untuk bahan baku &lt;a href=&quot;https://id.wikipedia.org/wiki/Gula&quot;&gt;gula&lt;/a&gt; dan &lt;a href=&quot;https://id.wikipedia.org/wiki/Mononatrium_glutamat&quot;&gt;vetsin&lt;/a&gt;. Tanaman ini hanya dapat tumbuh di daerah beriklim tropis. Tanaman ini termasuk jenis rumput-rumputan. Umur tanaman sejak ditanam sampai bisa dipanen mencapai kurang lebih 1 tahun. Di Indonesia tebu banyak dibudidayakan di pulau &lt;a href=&quot;https://id.wikipedia.org/wiki/Jawa&quot;&gt;Jawa&lt;/a&gt; dan &lt;a href=&quot;https://id.wikipedia.org/wiki/Sumatra&quot;&gt;Sumatra&lt;/a&gt;.&lt;/p&gt;\r\n\r\n&lt;p&gt;Untuk pembuatan gula, batang tebu yang sudah dipanen diperas dengan mesin pemeras (mesin &lt;em&gt;press&lt;/em&gt;) di pabrik gula. Sesudah itu, &lt;a href=&quot;https://id.wikipedia.org/wiki/Nira&quot;&gt;nira&lt;/a&gt; atau air perasan tebu tersebut disaring, dimasak, dan diputihkan sehingga menjadi gula pasir yang kita kenal. Dari proses pembuatan tebu tersebut akan dihasilkan gula 5%, ampas tebu 90% dan sisanya berupa tetes (molasse) dan air.&lt;/p&gt;\r\n', '2014-11-19 10:37:58'),
(13, 'Kebutuhan Gula Industri Diperkirakan Defisit 5%', '&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD//gA+Q1JFQVRPUjogZ2QtanBlZyB2MS4wICh1c2luZyBJSkcgSlBFRyB2OTApLCBkZWZhdWx0IHF1YWxpdHkK/9sAQwAIBgYHBgUIBwcHCQkICgwUDQwLCwwZEhMPFB0aHx4dGhwcICQuJyAiLCMcHCg3KSwwMTQ0NB8nOT04MjwuMzQy/9sAQwEJCQkMCwwYDQ0YMiEcITIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIy/8AAEQgBfAJiAwEiAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwABAgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/aAAwDAQACEQMRAD8A9/ooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKK+ffEGvWEPiTV7eWZVdb+XIyOzn/AAqKPXLE7iLhOWHUjpj607Ecx9D0V8+S6lauZ9k6uX6fkf8A61SG7gdpdsinKcfMOeTRZBznv9FeDNMjRnDrjywDyKrwsPtm/P8AyyH8hRZdw5z6BorwmI4EWOfkPamp/wAsf900+UOY94orwiEg+Vg9zj8jU0jZjj+rYo5Q5z3GivDUzvwP+eh/nUjcpB7MRSsHOe3UV4UoIKcdZDVySC609BvRo5piSinqAT19qGhqVz2mivILGU2KmKa6MhL5yTnBPb6VqJDp9yNzwRnP8ScH9KRR6XRXm50qwkJEcjxk/wC2ao3eg3uz/Qr2L/tpHn9RQGh6tRXlVqY9IiFvdttaQ7meTox9j0qVo9Jkn8tnEM7DIKtgt+HQ0Dsz1CivMlspoVzbXokXsGH9RxSraSzSgyoqsP4ozgmgR6ZRXloj1C0n3rBvwcB425OfUd/xrRg1eZfllUE91J2nNOwO6PQaK4t7XTLsrcyRBpGGW2NgE/QVVbRNNZiU3pn/AGjwafKTzHfUV59/wjensoKyyqwHUNkfkahfw2TuEd2pO3aNyUcocx6PRXmR8OXmWIeHHAzvPI/KpovD6tJtnulGWBwvHTtmjlC56PRXnNz4cuPOLWpRo+SAzc9Kz30m/t4xutnICnO35sflRyhc9WoryHJVzuGCEGQev5UtxkySDHRlo5Q5j12ivII13zIFySJCQB9DWjDpU8saO5EabSMEcnNHKHMenUV52t9aaZESCi+rnGaurrXmwCSFgQR94HOaVkNO529FeeyahLL95unWs2e7aRgsDNI4YcIN2frikWotnqlFeeSZayERM0RYHJJINOtDb6bGPLUM4/iY7jj05oE0eg0V53eaiHB3xJsbggKKzNGiuvPn/fBtNX7gY5bPYD2oBI9XorzeSWOF5DFCqlzkkcsfrWfeaodPSORow3zfN8wH6UXRcablsesUV5W+pDVv3NkzSyHgnP3R34rQtdPi0+ALu3zHknqF9hRdEuDWjPRKK86kUcFg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/df/AF6ZL4O8wbVvtq9x5Ocn/vquooobbHyo4z/hX8Oc/bFz/wBe4/8AiqP+Ffxf8/wP/bD/AOyrs6KQziz8PICCDejn/pj/APZUwfDmBH8yPUHR+xEf/wBlXb0UDTa2OEf4fXjBlGvAA9P9E5H/AI/VIfCjECxf21xu3OfsnLf+P16RRTuTY4VfhunKvqrvHjATycAfk1TP8OrOSFI2uQQg+XMR4/8AHq7Sii41ocVbfDq0tyCLoEg5/wBTj/2atAeDrUdJF/GP/wCvXS0Uhtt7nO/8IjbY+/H/AN+v/r1Qvvh1pd+yvNt3oQVcIQVI6EEGuxooEYEXhgIzNJeGRj3MeP60xfCojn8yO9ZRnlSmQf1roqKrmYuVHOv4YkJOy/2j08nP/s1Nbwnuzm8Xn0h/+vXSUUrsLI5J/A6M24X5Uj0i/wDsqsW/hR4NwOoBwexh/wDsq6Wii7CyOfuPDtxMgRdRWNB0Cwf/AGVUm8GTsT/xN2/78f8A2VdbRSeo7WOQ/wCEIkI51Zj/ANsf/sqYfAZI/wCQo3/fn/7KuyopWQHHHwK5A/4mp4/6Yf8A2VNPgOQ9dXP/AH4/+yrs6KLDuzim8ASMMf2ucf8AXv8A/ZVVk+Gjyu2/Wm8sjG0W+MH1zvrv6KaVgued2PwnsrRSJL4Ttn7zQYP/AKFWjL8PLOSAx/aFGRgExZx/49XZ0UCTscLF8NbaNwzXoYj/AKYY/wDZqsn4fWZP+vH/AH7P/wAVXY0UFOTe5wN38MLeeJlh1SW3Y9GjQ8f+PVSs/hXf2km7/hK5XHobT/7OvS6KCTi28DXny7NcAwMHNpnP/j9KPA91j5tbJPtbYH/oVdnRTuxWRxn/AAg94Dxrn/kt/wDZ1Vn+HV1OxL6+fp9l/wDs672ilca0OJh8AzIm19YzgYG23x+fzGq7/DVpJZHbWnJddp/0ft/31XfUU07A1c4eD4cx28QjXVZSo/6Zf/XqX/hX0R4bUZCP+uf/ANeuzopXFZHHr4AtVGDchh6NF/8AZU7/AIQKzHSWP/vz/wDXrrqKd2FkQ2lutpZwWynKxRrGCBjgDFTUUUhhRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQB//Z&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;JAKARTA. &lt;a href=&quot;http://www.kontan.co.id/tag/kementerian-perindustrian&quot;&gt;Kementerian Perindustrian&lt;/a&gt; akan memantau kekurangan gula bagi industri. Tindakan ini dilakukan untuk mengetahui kebutuhan &lt;a href=&quot;http://www.kontan.co.id/tag/impor-gula-1&quot;&gt;impor gula&lt;/a&gt; mentah (&lt;em&gt;raw sugar&lt;/em&gt;) yang sebelumnya direncanakan pada kuartal IV-2016.&lt;/p&gt;\r\n\r\n&lt;p&gt;Direktur Jenderal Industri Agro Panggah Susanto Kemperin memprediksi, kekurangan untuk industri makanan dan minuman nasional sekitar 5%. &amp;quot;Kelangkaan ini mengkhawatirkan, karena harga gula bisa jadi sangat tinggi,&amp;quot; ujar Panggah di Gedung &lt;a href=&quot;http://www.kontan.co.id/tag/kementerian-perindustrian&quot;&gt;Kementerian Perindustrian&lt;/a&gt;, Selasa (19/7).&lt;/p&gt;\r\n\r\n&lt;p&gt;Meski demikian, ia menyebut, pemenuhan kekurangan itu sebaiknya tidak terburu-buru dilakukan meski sejumlah pihak mendesak pemenuhannya dipercepat menjadi kuartal III-2016. &amp;quot;Masih ada waktu. Kami akan lakukan survei dahulu bersama Gabungan Pengusahan Makanan dan Minuman Indonesia (GAPMMI),&amp;quot; kata Panggah.&lt;/p&gt;\r\n\r\n&lt;p&gt;Selain soal kebutuhan gula, pemilihan negara pengimpor gula perlu dipertimbangkan. Kondisinya, saat ini, Thailand sedang mengalami kesulitan produksi gula akibat La Nina dan musim hujan. &amp;quot;Harganya jadi lebih mahal. Sehingga sekarang mau tidak mau harus ambil dari Brasil,&amp;quot; tuturnya.&lt;/p&gt;\r\n\r\n&lt;p&gt;Jika memilih mengimpor dari Brazil, perlu diwaspadai soal keterlambatan yang mungkit terjadi akibat jaraknya yang lebih jauh dibandingkan Thailand. &amp;quot;Dari segi jarak, kalau dari Thailand butuh waktu semingu, kalau dari Brasil bisa 40 hari,&amp;quot; jelasnya.&lt;/p&gt;\r\n', '2016-07-29 02:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `tablebahasa`
--

CREATE TABLE `tablebahasa` (
  `idBahasa` int(11) NOT NULL,
  `namaBahasa` char(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tablebahasa`
--

INSERT INTO `tablebahasa` (`idBahasa`, `namaBahasa`) VALUES
(1, 'Indonesia'),
(2, 'Inggris'),
(3, 'Jerman'),
(4, 'Arab'),
(5, 'Spanyol'),
(6, 'Jepang'),
(7, 'Mandarin'),
(8, 'Rusia'),
(9, 'Perancis'),
(10, 'Portugis');

-- --------------------------------------------------------

--
-- Table structure for table `tablejurusan`
--

CREATE TABLE `tablejurusan` (
  `idJurusan` int(11) NOT NULL,
  `namaJurusan` char(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tablejurusan`
--

INSERT INTO `tablejurusan` (`idJurusan`, `namaJurusan`) VALUES
(1, 'Advertising/Media'),
(2, 'Agriculture/Aquaculture/Forestry'),
(3, 'Airline Operation/Airport Management'),
(4, 'Architecture'),
(5, 'Art/Design/Creative Multimedia'),
(6, 'Biology'),
(7, 'BioTechnology'),
(8, 'Business Studies/Administration/Management'),
(9, 'Chemistry'),
(10, 'Commerce'),
(11, 'Computer Science/Information Technology'),
(12, 'Dentistry'),
(13, 'Economics'),
(14, 'Education/Teaching/Training'),
(15, 'Engineering (Aviation/Aeronautics/Astronautics)'),
(16, 'Engineering (Bioengineering/Biomedical)'),
(17, 'Engineering (Chemical)'),
(18, 'Engineering (Civil)'),
(19, 'Engineering (Computer/Telecommunication)'),
(20, 'Engineering (Electrical/Electronic)'),
(21, 'Engineering (Environmental/Health/Safety)'),
(22, 'Engineering (Industrial)'),
(23, 'Engineering (Marine)'),
(24, 'Engineering (Material Science)'),
(25, 'Engineering (Mechanical)'),
(26, 'Engineering (Mechatronic/Electromechanical)'),
(27, 'Engineering (Metal Fabrication/Tool &amp; Die/Weld'),
(28, 'Engineering (Mining/Mineral)'),
(29, 'Engineering (Others)'),
(30, 'Engineering (Petroleum/Oil/Gas)'),
(31, 'Finance/Accountancy/Banking'),
(32, 'Food & Beverage Services Management'),
(33, 'Food Technology/Nutrition/Dietetics'),
(34, 'Geographical Science'),
(35, 'Geology/Geophysics'),
(36, 'History'),
(37, 'Hospitality/Tourism/Hotel Management'),
(38, 'Human Resource Management'),
(39, 'Humanities/Liberal Arts'),
(40, 'Journalism'),
(41, 'Law'),
(42, 'Library Management'),
(43, 'Linguistics/Languages'),
(44, 'Logistic/Transportation'),
(45, 'Maritime Studies'),
(46, 'Marketing'),
(47, 'Mass Communications'),
(48, 'Mathematics'),
(49, 'Medical Science'),
(50, 'Medicine'),
(51, 'Music/Performing Arts Studies'),
(52, 'Nursing'),
(53, 'Optometry'),
(54, 'Personal Services'),
(55, 'Pharmacy/Pharmacology'),
(56, 'Philosophy'),
(57, 'Physical Therapy/Physiotherapy'),
(58, 'Physics'),
(59, 'Political Science'),
(60, 'Property Development/Real Estate Management'),
(61, 'Protective Services & Management'),
(62, 'Psychology'),
(63, 'Quantity Survey'),
(64, 'Science Technology'),
(65, 'Secretarial'),
(66, 'Social Science/Sociology'),
(67, 'Sports Science Management'),
(68, 'Textile/Fashion Design'),
(69, 'Urban Studies/Town Planning'),
(70, 'Veterinary'),
(71, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `tablemengemudi`
--

CREATE TABLE `tablemengemudi` (
  `idMengemudi` int(11) NOT NULL,
  `namaMengemudi` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tablemengemudi`
--

INSERT INTO `tablemengemudi` (`idMengemudi`, `namaMengemudi`) VALUES
(1, 'Motor'),
(2, 'Mobil');

-- --------------------------------------------------------

--
-- Table structure for table `tableprovinsi`
--

CREATE TABLE `tableprovinsi` (
  `idProvinsi` int(3) NOT NULL,
  `namaProvinsi` char(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tableprovinsi`
--

INSERT INTO `tableprovinsi` (`idProvinsi`, `namaProvinsi`) VALUES
(1, 'Aceh'),
(2, 'Sumatera Utara'),
(3, 'Sumatera Barat'),
(4, 'Riau'),
(5, 'Jambi'),
(6, 'Sumatera Selatan'),
(7, 'Bengkulu'),
(8, 'Lampung'),
(9, 'Kepulauan Bangka Belitung'),
(10, 'Kepulauan Riau'),
(11, 'Daerah Khusus Ibukota Jakarta'),
(12, 'Jawa Barat'),
(13, 'Jawa Tengah'),
(14, 'Daerah Istimewa Yogyakarta'),
(15, 'Jawa Timur'),
(16, 'Banten'),
(17, 'Bali'),
(18, 'Nusa Tenggara Barat'),
(19, 'Nusa Tenggara Timur'),
(20, 'Kalimantan Barat'),
(21, 'Kalimantan Tengah'),
(22, 'Kalimantan Selatan'),
(23, 'Kalimantan Timur'),
(24, 'Sulawesi Utara'),
(25, 'Sulawesi Tengah'),
(26, 'Sulawesi Selatan'),
(27, 'Sulawesi Tenggara'),
(28, 'Gorontalo'),
(29, 'Sulawesi Barat'),
(30, 'Maluku'),
(31, 'Maluku Utara'),
(32, 'Papua Barat'),
(33, 'Papua'),
(34, 'Seluruh Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `tablesearchfptk`
--

CREATE TABLE `tablesearchfptk` (
  `idTable` int(11) NOT NULL,
  `idFptk` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tablesearchlowongan`
--

CREATE TABLE `tablesearchlowongan` (
  `idTable` int(11) NOT NULL,
  `idLowongan` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tablesearchlowongan`
--

INSERT INTO `tablesearchlowongan` (`idTable`, `idLowongan`, `url`, `content`) VALUES
(4, 5, 'http://localhost/skripsi/show/post.php?id=5', ' information  edp  pt  kempong  nasional  kategori  architecture  tanggal  posting  nov  batas  dec  deskripsi  umum  minimal  pendidikan  sarjana  s1  usia  maksimal  tahun  kerja  sumatera  selatan  gaji  yang  ditawarkan  kualifikasi  lain  ambar  kusuma  astuti  sekretaris  wiwid  yogyakarta  staff  yosafat  andi  baskoro  ruliawan  teknologi  informasi  teknik  informatika  universitas  kristen  duta  wacana '),
(7, 9, 'http://localhost/skripsi/show/post.php?id=9', ' information  programmer  prg  pt  indonesia  raya  kategori  technology  tanggal  posting  nov  batas  deskripsi  umum  minimal  pendidikan  sarjana  s1  usia  maksimal  tahun  kerja  daerah  khusus  ibukota  jakarta  gaji  yang  ditawarkan  15000000  kualifikasi  lain  bisa  membaca  tidak  buta  warna  belum  menikah  ambar  kusuma  astuti  sekretaris  wiwid  yogyakarta  staff  yosafat  andi  baskoro  ruliawan  teknologi  informasi  teknik  informatika  universitas  kristen  duta  wacana '),
(8, 16, 'http://localhost/skripsi/show/post.php?id=16', ' information  management  trainee  mt  pt  indonesia  raya  kategori  tanggal  posting  nov  batas  dec  deskripsi  minimal  pendidikan  sarjana  s1  usia  maksimal  kerja  gaji  ditawarkan  3000000  kualifikasi  register  apply  times  close  lowongan  batal  ambar  kusuma  astuti  sekretaris  wiwid  yogyakarta  staff  yosafat  andi  baskoro  ruliawan  teknologi  informasi  teknik  informatika  universitas  kristen  duta  wacana '),
(12, 20, 'http://localhost/skripsi/show/post.php?id=20', 'it programmer it pt pratama nusantara sakti it programmer tanggal posting: 29 jul 2016 batas akhir: 01 sep 2016 minimal pendidikan: sarjana (s1) usia maksimal: 30 penempatan kerja: daerah khusus ibukota jakarta gaji yang ditawarkan: 6000000 jod description    1. maintenance server    2. mampu menguasai bahasa pemrograman php, javascript, html, java, c, dan c++    ');

-- --------------------------------------------------------

--
-- Table structure for table `tablesearchworker`
--

CREATE TABLE `tablesearchworker` (
  `idTable` int(11) NOT NULL,
  `idWorker` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tablesearchworker`
--

INSERT INTO `tablesearchworker` (`idTable`, `idWorker`, `url`, `content`) VALUES
(1, 5, 'http://localhost/skripsi/show/worker.php?id=5', 'superintendent   notice:  undefined index: alamat in c:xampphtdocsskripsidataworker.php on line 8  0 tahun 1 bulan wanita   superintendent@gmail.com   warning:  mysql_fetch_array() expects parameter 1 to be resource, boolean given in c:xampphtdocsskripsidataworker.php on line 70  mysql(pemula) gaji yang diharapkan 0 prioritas 1:  prioritas 2:  prioritas 3:  cari pekerjaan di bidang:  '),
(2, 1, 'http://localhost/skripsi/show/worker.php?id=1', 'ilham muharma   notice:  undefined index: alamat in c:xampphtdocsskripsidataworker.php on line 8  21 tahun 2 bulan pria +6285311308346 +6285212303192 ilham.muharma@gmail.com 2020 universitas indonesia computer science/information technology ipk/nilai 4 daerah khusus ibukota jakarta 2017 universitas indonesia engineering (computer/telecommunication) ipk/nilai 3 daerah khusus ibukota jakarta 2013 sman 21 science technology ipk/nilai 8 daerah khusus ibukota jakarta 2010 smpn 216 others ipk/nilai 9 daerah khusus ibukota jakarta bekerja selama 0 tahun 2 bulan it programmer agricultural / plantation / poultry / fisheries pt pratama nusantara sakti daerah khusus ibukota jakarta masih bekerja. bekerja selama 2 tahun 7 bulan brand ambassador education kantor humas ui daerah khusus ibukota jakarta masih bekerja bekerja selama 4 tahun 7 bulan brand ambassador education kantor humas ui daerah khusus ibukota jakarta masih bekerja   warning:  mysql_fetch_array() expects parameter 1 to be resource, boolean given in c:xampphtdocsskripsidataworker.php on line 70  java(menengah) javascript(pemula) html(mahir) php(menengah) c(menengah) gaji yang diharapkan 7000000 prioritas 1: daerah khusus ibukota jakarta prioritas 2: sumatera selatan prioritas 3: daerah khusus ibukota jakarta cari pekerjaan di bidang: it programmer bersedia ditempatkan di seluruh wilayah indonesia  '),
(3, 6, 'http://localhost/skripsi/show/worker.php?id=6', ' information  bernadeta  ditia  kristiani  jalan  prawirotaman  tahun  bulan  6285643693842  llfyr  cymraeg  gmail  com  pendidikan  2012  universitas  sanata  dharma  sarjana  s1  advertising  media  ipk  nilai  daerah  istimewa  yogyakarta  pengalaman  kerja  kemampuan  skill  berbahasa  bahasa  pasif  aktif  lain  php  pemula  minat  gaji  yang  diharapkan  rp  8000000  00  prioritas  riau  khusus  ibukota  jakarta  lampung  bersedia  ditempatkan  dimana  saja  bidang  pekerjaan  diminati  engineering  building  civil  construction  qs  ambar  kusuma  astuti  sekretaris  wiwid  staff  yosafat  andi  baskoro  ruliawan  teknologi  informasi  teknik  informatika  kristen  duta  wacana ');

-- --------------------------------------------------------

--
-- Table structure for table `tableslider`
--

CREATE TABLE `tableslider` (
  `idTable` int(11) NOT NULL,
  `namaSlider` char(50) COLLATE utf8_bin NOT NULL,
  `pathSlider` varchar(255) COLLATE utf8_bin NOT NULL,
  `active` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tableslider`
--

INSERT INTO `tableslider` (`idTable`, `namaSlider`, `pathSlider`, `active`) VALUES
(1, 'Jenggota', 'http://localhost/skripsi/upload/slider/banner.gif', 1),
(2, 'Jenggota Oblongata', 'http://localhost/skripsi/upload/slider/test.png', 0),
(3, 'Andi Baskoro', 'http://localhost/skripsi/upload/slider/test.png', 0),
(4, 'Grepolis', 'http://localhost/skripsi/upload/slider/test.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tablestatusrekrut`
--

CREATE TABLE `tablestatusrekrut` (
  `idTable` int(11) NOT NULL,
  `namaStatus` varchar(20) NOT NULL,
  `orderStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tablestatusrekrut`
--

INSERT INTO `tablestatusrekrut` (`idTable`, `namaStatus`, `orderStatus`) VALUES
(1, 'Sourcing', 1),
(2, 'Sortlist', 2),
(3, 'Interview HR', 3),
(4, 'Psikotest', 4),
(5, 'Interview User', 5),
(6, 'Negotiating Salary', 6),
(7, 'Medical Check Up', 7),
(8, 'Join', 8),
(9, 'Reject', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tingkatkeahlian`
--

CREATE TABLE `tingkatkeahlian` (
  `idKeahlian` int(11) NOT NULL,
  `gradeKeahlian` int(11) NOT NULL,
  `tingkatKeahlian` char(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tingkatkeahlian`
--

INSERT INTO `tingkatkeahlian` (`idKeahlian`, `gradeKeahlian`, `tingkatKeahlian`) VALUES
(1, 1, 'Pemula'),
(2, 2, 'Menengah'),
(3, 3, 'Mahir');

-- --------------------------------------------------------

--
-- Table structure for table `tingkatkettraining`
--

CREATE TABLE `tingkatkettraining` (
  `idKetTraining` int(11) NOT NULL,
  `gradeKetTraining` int(11) NOT NULL,
  `tingkatKetTraining` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tingkatkettraining`
--

INSERT INTO `tingkatkettraining` (`idKetTraining`, `gradeKetTraining`, `tingkatKetTraining`) VALUES
(1, 1, 'Sertifikat'),
(2, 2, 'Tidak Setifikat');

-- --------------------------------------------------------

--
-- Table structure for table `tingkatpendidikan`
--

CREATE TABLE `tingkatpendidikan` (
  `idTingkat` int(11) NOT NULL,
  `gradePendidikan` int(3) NOT NULL,
  `namaPendidikan` char(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tingkatpendidikan`
--

INSERT INTO `tingkatpendidikan` (`idTingkat`, `gradePendidikan`, `namaPendidikan`) VALUES
(1, 3, 'SMA'),
(2, 4, 'Diploma'),
(3, 5, 'Sarjana (S1)'),
(4, 6, 'Master (S2)'),
(5, 7, 'Doktoral (S3)'),
(6, 1, 'SD'),
(7, 2, 'SMP');

-- --------------------------------------------------------

--
-- Table structure for table `userhrd`
--

CREATE TABLE `userhrd` (
  `idHrd` int(9) NOT NULL,
  `idLogin` int(9) NOT NULL,
  `namaPerusahaan` char(100) COLLATE utf8_bin NOT NULL,
  `deskripsiPerusahaan` varchar(1000) COLLATE utf8_bin NOT NULL,
  `emailPerusahaan` char(50) COLLATE utf8_bin NOT NULL,
  `alamatPerusahaan` char(255) COLLATE utf8_bin NOT NULL,
  `teleponPerusahaan` char(15) COLLATE utf8_bin NOT NULL,
  `faxPerusahaan` char(15) COLLATE utf8_bin NOT NULL,
  `urlWebsite` char(100) COLLATE utf8_bin NOT NULL,
  `jenisIndustri` int(11) NOT NULL,
  `jumlahPegawai` int(11) DEFAULT '0',
  `namaPenanggung1` char(100) COLLATE utf8_bin NOT NULL,
  `jabatanPenanggung1` char(30) COLLATE utf8_bin NOT NULL,
  `telpPenanggung1` char(15) COLLATE utf8_bin NOT NULL,
  `namaPenanggung2` char(100) COLLATE utf8_bin DEFAULT NULL,
  `jabatanPenanggung2` char(30) COLLATE utf8_bin DEFAULT NULL,
  `telpPenanggung2` char(15) COLLATE utf8_bin DEFAULT NULL,
  `pathLogo` char(255) COLLATE utf8_bin NOT NULL DEFAULT 'http://localhost/upload/company_logo.png',
  `smallLogo` char(255) COLLATE utf8_bin NOT NULL DEFAULT 'http://localhost/skripsi/upload/small_default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `userhrd`
--

INSERT INTO `userhrd` (`idHrd`, `idLogin`, `namaPerusahaan`, `deskripsiPerusahaan`, `emailPerusahaan`, `alamatPerusahaan`, `teleponPerusahaan`, `faxPerusahaan`, `urlWebsite`, `jenisIndustri`, `jumlahPegawai`, `namaPenanggung1`, `jabatanPenanggung1`, `telpPenanggung1`, `namaPenanggung2`, `jabatanPenanggung2`, `telpPenanggung2`, `pathLogo`, `smallLogo`) VALUES
(1, 1, 'PT Pratama Nusantara Sakti', 'Pratama Nusantara Sakti is a joint venture companies between 3 conglomerate groups in Indonesia (Djarum Group, Wings Group & CPP Group). We are moved in Cane plantation and Sugar Industry.\r\n\r\nPratama Nusantara sakti is the first Sugarcane company which is build in swampy area in Indonesia. We use two transport system which are waterway dan road. We manage the water to be use for logistic system and irigation. Our plantation area located in OKI, Sumatera Selatan.\r\n\r\nOur vision is to become the first and the largest swamp or low land sugar company in Indonesia which become priority to realize Swasembada Gula. Peoples are very important in our business, so one of our Management Commitment is to build people lives. In our company, we treat you as one of our family member, as mentioned in our company values.', 'career@pns.co.id', 'Setia Budi Selatan St. Kav 16-17, Kuningan Office Park, South Jakarta\r\nWisma Gawi Building, Postal Code 12920\r\nFloor 3th, Suite 303', '+62157941785', '+62157941785', 'career.pns.co.id', 19, 11, 'Tama Priambodo', 'IT Superintendent', '+62157941785', 'Donny Putra', 'HRD', '+62157941785', 'http://localhost/skripsi/upload/hrd/pns.png', 'http://localhost/skripsi/upload/hrd/resize_pns.png');

-- --------------------------------------------------------

--
-- Table structure for table `userworker`
--

CREATE TABLE `userworker` (
  `idWorker` int(9) NOT NULL,
  `idLogin` int(9) NOT NULL,
  `namaUser` char(50) COLLATE utf8_bin NOT NULL,
  `gender` char(1) COLLATE utf8_bin NOT NULL,
  `golonganDarah` char(2) COLLATE utf8_bin NOT NULL,
  `tempatLahir` char(30) COLLATE utf8_bin NOT NULL,
  `birthday` date NOT NULL,
  `agama` char(20) COLLATE utf8_bin NOT NULL,
  `statusNikah` varchar(20) COLLATE utf8_bin NOT NULL,
  `noKtp` varchar(16) COLLATE utf8_bin NOT NULL,
  `kewarganegaraan` char(3) COLLATE utf8_bin NOT NULL,
  `noNpwp` varchar(15) COLLATE utf8_bin NOT NULL,
  `emailUser` char(50) COLLATE utf8_bin NOT NULL,
  `alamatKtp` char(100) COLLATE utf8_bin NOT NULL,
  `alamatSekarang` char(100) COLLATE utf8_bin NOT NULL,
  `noPonsel` char(15) COLLATE utf8_bin NOT NULL,
  `otherPonsel` char(15) COLLATE utf8_bin NOT NULL,
  `citaCita` varchar(200) COLLATE utf8_bin NOT NULL,
  `motivasiBekerja` varchar(200) COLLATE utf8_bin NOT NULL,
  `alasanBekerja` varchar(200) COLLATE utf8_bin NOT NULL,
  `minimalGaji` double NOT NULL DEFAULT '0',
  `negosiasiGaji` varchar(10) COLLATE utf8_bin NOT NULL,
  `tunjanganFasilitas` varchar(200) COLLATE utf8_bin NOT NULL,
  `waktuBekerja` date NOT NULL,
  `cariKerja` int(11) NOT NULL,
  `jenisPekerjaanDisukai1` int(11) NOT NULL,
  `jenisPekerjaanDisukai2` int(11) NOT NULL,
  `jenisPekerjaanDisukai3` int(11) NOT NULL,
  `jenisPekerjaanDisukai4` int(11) NOT NULL,
  `jenisPekerjaanDisukai5` int(11) NOT NULL,
  `lingKerDisukai1` int(11) NOT NULL,
  `lingKerDisukai2` int(11) NOT NULL,
  `lingKerDisukai3` int(11) NOT NULL,
  `lingKerDisukai4` int(11) NOT NULL,
  `lingKerDisukai5` int(11) NOT NULL,
  `lingKerDisukai6` int(11) NOT NULL,
  `lokasiKerja1` int(11) NOT NULL,
  `lokasiKerja2` int(11) NOT NULL,
  `lokasiKerja3` int(11) NOT NULL,
  `bersedia` tinyint(4) NOT NULL DEFAULT '0',
  `dinasLuarKota` varchar(10) COLLATE utf8_bin NOT NULL,
  `penempatanOki` varchar(10) COLLATE utf8_bin NOT NULL,
  `tipeOrang` varchar(200) COLLATE utf8_bin NOT NULL,
  `menghadapiMasalah` varchar(200) COLLATE utf8_bin NOT NULL,
  `kondisiSulit` varchar(200) COLLATE utf8_bin NOT NULL,
  `pathFoto` char(100) COLLATE utf8_bin NOT NULL DEFAULT 'http://localhost/skripsi/upload/default.gif',
  `statusRekrut` int(11) NOT NULL,
  `sumberData_internal` varchar(50) COLLATE utf8_bin NOT NULL,
  `sumberData_eksternal` int(11) NOT NULL,
  `nomorFptk` varchar(30) COLLATE utf8_bin NOT NULL,
  `pic` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `userworker`
--

INSERT INTO `userworker` (`idWorker`, `idLogin`, `namaUser`, `gender`, `golonganDarah`, `tempatLahir`, `birthday`, `agama`, `statusNikah`, `noKtp`, `kewarganegaraan`, `noNpwp`, `emailUser`, `alamatKtp`, `alamatSekarang`, `noPonsel`, `otherPonsel`, `citaCita`, `motivasiBekerja`, `alasanBekerja`, `minimalGaji`, `negosiasiGaji`, `tunjanganFasilitas`, `waktuBekerja`, `cariKerja`, `jenisPekerjaanDisukai1`, `jenisPekerjaanDisukai2`, `jenisPekerjaanDisukai3`, `jenisPekerjaanDisukai4`, `jenisPekerjaanDisukai5`, `lingKerDisukai1`, `lingKerDisukai2`, `lingKerDisukai3`, `lingKerDisukai4`, `lingKerDisukai5`, `lingKerDisukai6`, `lokasiKerja1`, `lokasiKerja2`, `lokasiKerja3`, `bersedia`, `dinasLuarKota`, `penempatanOki`, `tipeOrang`, `menghadapiMasalah`, `kondisiSulit`, `pathFoto`, `statusRekrut`, `sumberData_internal`, `sumberData_eksternal`, `nomorFptk`, `pic`) VALUES
(1, 1, 'Ilham Muharma', 'L', 'O', 'Jakarta', '1995-06-03', 'Islam', 'Belum Menikah', '0000111122223333', 'WNI', '000111222333444', 'ilham.muharma@gmail.com', 'Johar Baru', 'Tanah Tinggi', '+6285311308346', '+6285212303192', 'asdas', 'asdas', 'asdas', 7000000, 'Negotiable', 'asdas', '2016-01-01', 67, 6, 4, 14, 2, 15, 2, 6, 5, 4, 3, 1, 11, 6, 11, 1, 'Bersedia', 'Tidak', 'asdas', 'asdas', 'asdas', 'http://localhost/skripsi/upload/worker/pns.png', 4, 'asdas', 2, '0001/HRD-HO/VIII/2016', ''),
(5, 5, 'Superintendent', '', '', '', '2016-08-12', '', '', '', '', '', 'superintendent@gmail.com', '', '', '', '', '', '', '', 0, '', '', '2016-08-12', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'http://localhost/skripsi/upload/default.gif', 0, '', 0, '', ''),
(6, 6, 'Ikhwannudin Alamsyah', 'L', '', '', '2002-11-12', '', '', '0', '', '0', 'ikhwannudin.alamsyah@gmail.com', 'Senen', '', '+6285643693842', '+62', '', '', '', 8000000, '', '', '0000-00-00', 27, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 11, 8, 1, '', '', '', '', '', 'http://localhost/skripsi/upload/default.gif', 2, '', 0, '0002/HRD-HO/VIII/2016', 'admin'),
(7, 7, 'Manager', '', '', '', '2016-08-12', '', '', '', '', '', 'manager@gmail.com', '', '', '', '', '', '', '', 0, '', '', '2016-08-12', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'http://localhost/skripsi/upload/default.gif', 0, '', 0, '', ''),
(8, 8, 'HRD Superintendent', '', '', '', '2016-08-12', '', '', '', '', '', 'hrdsuperintendent@gmail.com', '', '', '', '', '', '', '', 0, '', '', '2016-08-12', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'http://localhost/skripsi/upload/default.gif', 0, '', 0, '', ''),
(9, 9, 'General Manager', '', '', '', '2016-08-12', '', '', '', '', '', 'generalmanager@gmail.com', '', '', '', '', '', '', '', 0, '', '', '2016-08-12', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'http://localhost/skripsi/upload/default.gif', 0, '', 0, '', ''),
(10, 10, 'HRD Manager', '', '', '', '2016-08-12', '', '', '', '', '', 'hrdmanager@gmail.com', '', '', '', '', '', '', '', 0, '', '', '2016-08-12', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'http://localhost/skripsi/upload/default.gif', 0, '', 0, '', ''),
(15, 17, 'Shabrina Shafwa Ramadhani', '', '', '', '0000-00-00', '', '', '', '', '', 'shabrina.sr@gmail.com', '', '', '', '', '', '', '', 0, '', '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'http://localhost/skripsi/upload/default.gif', 2, '', 0, '0003/HRD-HO/VIII/2016', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutppkpk`
--
ALTER TABLE `aboutppkpk`
  ADD PRIMARY KEY (`idTable`);

--
-- Indexes for table `applylowongan`
--
ALTER TABLE `applylowongan`
  ADD PRIMARY KEY (`idTable`),
  ADD KEY `idLowongan` (`idLowongan`);

--
-- Indexes for table `bidangusaha`
--
ALTER TABLE `bidangusaha`
  ADD PRIMARY KEY (`idUsaha`);

--
-- Indexes for table `event_calendar`
--
ALTER TABLE `event_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fptk`
--
ALTER TABLE `fptk`
  ADD PRIMARY KEY (`idFptk`);

--
-- Indexes for table `hubungandarurat`
--
ALTER TABLE `hubungandarurat`
  ADD PRIMARY KEY (`idHubunganDarurat`);

--
-- Indexes for table `hubungankeluarga`
--
ALTER TABLE `hubungankeluarga`
  ADD PRIMARY KEY (`idHubungan`);

--
-- Indexes for table `jenispekerjaan`
--
ALTER TABLE `jenispekerjaan`
  ADD PRIMARY KEY (`idJenisPekerjaan`);

--
-- Indexes for table `kategoridepartemen`
--
ALTER TABLE `kategoridepartemen`
  ADD PRIMARY KEY (`idDepartemen`);

--
-- Indexes for table `kategoridivisi`
--
ALTER TABLE `kategoridivisi`
  ADD PRIMARY KEY (`idDivisi`);

--
-- Indexes for table `kategorikerja`
--
ALTER TABLE `kategorikerja`
  ADD PRIMARY KEY (`idKategori`);

--
-- Indexes for table `kategorilevel`
--
ALTER TABLE `kategorilevel`
  ADD PRIMARY KEY (`idLevel`);

--
-- Indexes for table `keluargabesar`
--
ALTER TABLE `keluargabesar`
  ADD PRIMARY KEY (`idBesar`);

--
-- Indexes for table `keluargadarurat`
--
ALTER TABLE `keluargadarurat`
  ADD PRIMARY KEY (`idDarurat`);

--
-- Indexes for table `keluargainti`
--
ALTER TABLE `keluargainti`
  ADD PRIMARY KEY (`idInti`);

--
-- Indexes for table `lingkungankerja`
--
ALTER TABLE `lingkungankerja`
  ADD PRIMARY KEY (`idLingkunganKerja`);

--
-- Indexes for table `loginadmin`
--
ALTER TABLE `loginadmin`
  ADD PRIMARY KEY (`idLogin`);

--
-- Indexes for table `loginhrd`
--
ALTER TABLE `loginhrd`
  ADD PRIMARY KEY (`idLogin`),
  ADD UNIQUE KEY `idLogin` (`idLogin`),
  ADD KEY `email` (`email`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `loginuser`
--
ALTER TABLE `loginuser`
  ADD PRIMARY KEY (`idLogin`),
  ADD UNIQUE KEY `idLogin` (`idLogin`),
  ADD KEY `email` (`email`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `pendidikanworker`
--
ALTER TABLE `pendidikanworker`
  ADD PRIMARY KEY (`idPendidikan`);

--
-- Indexes for table `pengalamanworker`
--
ALTER TABLE `pengalamanworker`
  ADD PRIMARY KEY (`idPengalaman`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`idPermission`);

--
-- Indexes for table `postinglowongan`
--
ALTER TABLE `postinglowongan`
  ADD PRIMARY KEY (`idLowongan`),
  ADD KEY `namaPosisi` (`namaPosisi`);

--
-- Indexes for table `referensieksternal`
--
ALTER TABLE `referensieksternal`
  ADD PRIMARY KEY (`idRefeksternal`);

--
-- Indexes for table `rolepermission`
--
ALTER TABLE `rolepermission`
  ADD PRIMARY KEY (`idRole`),
  ADD KEY `idLogin` (`idLogin`) USING BTREE,
  ADD KEY `idMenu` (`idPermission`) USING BTREE;

--
-- Indexes for table `skillbahasaworker`
--
ALTER TABLE `skillbahasaworker`
  ADD PRIMARY KEY (`idTable`);

--
-- Indexes for table `skillmengemudiworker`
--
ALTER TABLE `skillmengemudiworker`
  ADD PRIMARY KEY (`idTableM`);

--
-- Indexes for table `skilltrainingworker`
--
ALTER TABLE `skilltrainingworker`
  ADD PRIMARY KEY (`idTraining`);

--
-- Indexes for table `skillworker`
--
ALTER TABLE `skillworker`
  ADD PRIMARY KEY (`idSkill`);

--
-- Indexes for table `sosialkenalan`
--
ALTER TABLE `sosialkenalan`
  ADD PRIMARY KEY (`idKenalan`);

--
-- Indexes for table `sosialorganisasi`
--
ALTER TABLE `sosialorganisasi`
  ADD PRIMARY KEY (`idOrganisasi`);

--
-- Indexes for table `sosialpsikotest`
--
ALTER TABLE `sosialpsikotest`
  ADD PRIMARY KEY (`idPsikotest`);

--
-- Indexes for table `sosialreferensi`
--
ALTER TABLE `sosialreferensi`
  ADD PRIMARY KEY (`idReferensi`);

--
-- Indexes for table `stopword`
--
ALTER TABLE `stopword`
  ADD PRIMARY KEY (`idStopWord`);

--
-- Indexes for table `tablearticle`
--
ALTER TABLE `tablearticle`
  ADD PRIMARY KEY (`idArticle`);

--
-- Indexes for table `tablebahasa`
--
ALTER TABLE `tablebahasa`
  ADD PRIMARY KEY (`idBahasa`);

--
-- Indexes for table `tablejurusan`
--
ALTER TABLE `tablejurusan`
  ADD PRIMARY KEY (`idJurusan`);

--
-- Indexes for table `tablemengemudi`
--
ALTER TABLE `tablemengemudi`
  ADD PRIMARY KEY (`idMengemudi`);

--
-- Indexes for table `tableprovinsi`
--
ALTER TABLE `tableprovinsi`
  ADD PRIMARY KEY (`idProvinsi`);

--
-- Indexes for table `tablesearchfptk`
--
ALTER TABLE `tablesearchfptk`
  ADD PRIMARY KEY (`idTable`),
  ADD UNIQUE KEY `idFptk_2` (`idFptk`) USING BTREE,
  ADD KEY `idFptk` (`idFptk`) USING BTREE;
ALTER TABLE `tablesearchfptk` ADD FULLTEXT KEY `content` (`content`);

--
-- Indexes for table `tablesearchlowongan`
--
ALTER TABLE `tablesearchlowongan`
  ADD PRIMARY KEY (`idTable`),
  ADD UNIQUE KEY `idLowongan_2` (`idLowongan`),
  ADD KEY `idLowongan` (`idLowongan`);
ALTER TABLE `tablesearchlowongan` ADD FULLTEXT KEY `content` (`content`);

--
-- Indexes for table `tablesearchworker`
--
ALTER TABLE `tablesearchworker`
  ADD PRIMARY KEY (`idTable`);
ALTER TABLE `tablesearchworker` ADD FULLTEXT KEY `content` (`content`);

--
-- Indexes for table `tableslider`
--
ALTER TABLE `tableslider`
  ADD PRIMARY KEY (`idTable`);

--
-- Indexes for table `tablestatusrekrut`
--
ALTER TABLE `tablestatusrekrut`
  ADD PRIMARY KEY (`idTable`);

--
-- Indexes for table `tingkatkeahlian`
--
ALTER TABLE `tingkatkeahlian`
  ADD PRIMARY KEY (`idKeahlian`);

--
-- Indexes for table `tingkatkettraining`
--
ALTER TABLE `tingkatkettraining`
  ADD PRIMARY KEY (`idKetTraining`);

--
-- Indexes for table `tingkatpendidikan`
--
ALTER TABLE `tingkatpendidikan`
  ADD PRIMARY KEY (`idTingkat`);

--
-- Indexes for table `userhrd`
--
ALTER TABLE `userhrd`
  ADD PRIMARY KEY (`idHrd`),
  ADD KEY `namaPerusahaan` (`namaPerusahaan`,`emailPerusahaan`),
  ADD KEY `emailPerusahaan` (`emailPerusahaan`);

--
-- Indexes for table `userworker`
--
ALTER TABLE `userworker`
  ADD PRIMARY KEY (`idWorker`),
  ADD KEY `namaUser` (`namaUser`,`emailUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutppkpk`
--
ALTER TABLE `aboutppkpk`
  MODIFY `idTable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `applylowongan`
--
ALTER TABLE `applylowongan`
  MODIFY `idTable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `bidangusaha`
--
ALTER TABLE `bidangusaha`
  MODIFY `idUsaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `event_calendar`
--
ALTER TABLE `event_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `fptk`
--
ALTER TABLE `fptk`
  MODIFY `idFptk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hubungandarurat`
--
ALTER TABLE `hubungandarurat`
  MODIFY `idHubunganDarurat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hubungankeluarga`
--
ALTER TABLE `hubungankeluarga`
  MODIFY `idHubungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jenispekerjaan`
--
ALTER TABLE `jenispekerjaan`
  MODIFY `idJenisPekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `kategoridepartemen`
--
ALTER TABLE `kategoridepartemen`
  MODIFY `idDepartemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `kategoridivisi`
--
ALTER TABLE `kategoridivisi`
  MODIFY `idDivisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategorikerja`
--
ALTER TABLE `kategorikerja`
  MODIFY `idKategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `kategorilevel`
--
ALTER TABLE `kategorilevel`
  MODIFY `idLevel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `keluargabesar`
--
ALTER TABLE `keluargabesar`
  MODIFY `idBesar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `keluargadarurat`
--
ALTER TABLE `keluargadarurat`
  MODIFY `idDarurat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `keluargainti`
--
ALTER TABLE `keluargainti`
  MODIFY `idInti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lingkungankerja`
--
ALTER TABLE `lingkungankerja`
  MODIFY `idLingkunganKerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `loginadmin`
--
ALTER TABLE `loginadmin`
  MODIFY `idLogin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `loginhrd`
--
ALTER TABLE `loginhrd`
  MODIFY `idLogin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `loginuser`
--
ALTER TABLE `loginuser`
  MODIFY `idLogin` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pendidikanworker`
--
ALTER TABLE `pendidikanworker`
  MODIFY `idPendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `pengalamanworker`
--
ALTER TABLE `pengalamanworker`
  MODIFY `idPengalaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `idPermission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `postinglowongan`
--
ALTER TABLE `postinglowongan`
  MODIFY `idLowongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `referensieksternal`
--
ALTER TABLE `referensieksternal`
  MODIFY `idRefeksternal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rolepermission`
--
ALTER TABLE `rolepermission`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `skillbahasaworker`
--
ALTER TABLE `skillbahasaworker`
  MODIFY `idTable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `skillmengemudiworker`
--
ALTER TABLE `skillmengemudiworker`
  MODIFY `idTableM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `skilltrainingworker`
--
ALTER TABLE `skilltrainingworker`
  MODIFY `idTraining` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `skillworker`
--
ALTER TABLE `skillworker`
  MODIFY `idSkill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sosialkenalan`
--
ALTER TABLE `sosialkenalan`
  MODIFY `idKenalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sosialorganisasi`
--
ALTER TABLE `sosialorganisasi`
  MODIFY `idOrganisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sosialpsikotest`
--
ALTER TABLE `sosialpsikotest`
  MODIFY `idPsikotest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sosialreferensi`
--
ALTER TABLE `sosialreferensi`
  MODIFY `idReferensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stopword`
--
ALTER TABLE `stopword`
  MODIFY `idStopWord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=921;
--
-- AUTO_INCREMENT for table `tablearticle`
--
ALTER TABLE `tablearticle`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tablebahasa`
--
ALTER TABLE `tablebahasa`
  MODIFY `idBahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tablejurusan`
--
ALTER TABLE `tablejurusan`
  MODIFY `idJurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `tablemengemudi`
--
ALTER TABLE `tablemengemudi`
  MODIFY `idMengemudi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tableprovinsi`
--
ALTER TABLE `tableprovinsi`
  MODIFY `idProvinsi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tablesearchfptk`
--
ALTER TABLE `tablesearchfptk`
  MODIFY `idTable` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tablesearchlowongan`
--
ALTER TABLE `tablesearchlowongan`
  MODIFY `idTable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tablesearchworker`
--
ALTER TABLE `tablesearchworker`
  MODIFY `idTable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tableslider`
--
ALTER TABLE `tableslider`
  MODIFY `idTable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tablestatusrekrut`
--
ALTER TABLE `tablestatusrekrut`
  MODIFY `idTable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tingkatkeahlian`
--
ALTER TABLE `tingkatkeahlian`
  MODIFY `idKeahlian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tingkatkettraining`
--
ALTER TABLE `tingkatkettraining`
  MODIFY `idKetTraining` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tingkatpendidikan`
--
ALTER TABLE `tingkatpendidikan`
  MODIFY `idTingkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `userhrd`
--
ALTER TABLE `userhrd`
  MODIFY `idHrd` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `userworker`
--
ALTER TABLE `userworker`
  MODIFY `idWorker` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
