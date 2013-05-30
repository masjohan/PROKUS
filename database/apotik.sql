-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 29. Mei 2013 jam 15:04
-- Versi Server: 5.5.8
-- Versi PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apotik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `id_administrator` int(11) NOT NULL AUTO_INCREMENT,
  `kode_administrator` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_administrator`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `kode_administrator` (`kode_administrator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `administrator`
--

INSERT INTO `administrator` (`id_administrator`, `kode_administrator`, `username`, `nama`, `email`, `password`) VALUES
(1, 'ADM0001', 'administrator', 'TELLER 1', 'administrator@apotikuin.com', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `id_administrator` int(11) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `isi_berita` text NOT NULL,
  `tanggal_posting` datetime NOT NULL,
  PRIMARY KEY (`id_berita`),
  KEY `id_administrator` (`id_administrator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `id_administrator`, `judul_berita`, `isi_berita`, `tanggal_posting`) VALUES
(1, 1, 'Pusing', 'penyakit yang biasanya kebanyakan orang menghiraukan ternyata bisa berdampak buruk juga bila terlalu dibiarkan.', '2013-04-02 17:33:24'),
(2, 1, 'Mual', 'mual ...', '2013-03-29 19:48:57'),
(3, 1, 'berita baru', 'isi berita baru', '2013-04-02 17:34:21'),
(4, 1, 'baru', 'baru baru baru', '2013-04-02 17:34:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diagnosis`
--

CREATE TABLE IF NOT EXISTS `diagnosis` (
  `id_diagnosis` int(11) NOT NULL AUTO_INCREMENT,
  `id_periksa` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `diagnosis` text NOT NULL,
  PRIMARY KEY (`id_diagnosis`),
  KEY `id_periksa` (`id_periksa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `diagnosis`
--

INSERT INTO `diagnosis` (`id_diagnosis`, `id_periksa`, `id_dokter`, `tanggal`, `diagnosis`) VALUES
(1, 1, 1, '2013-05-29', 'demam'),
(2, 2, 1, '2013-05-29', 'masuk angin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE IF NOT EXISTS `dokter` (
  `id_dokter` int(11) NOT NULL AUTO_INCREMENT,
  `kode_dokter` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_dokter`),
  UNIQUE KEY `kode_dokter` (`kode_dokter`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `kode_dokter`, `username`, `nama`, `email`, `password`) VALUES
(1, 'DTR0001', 'dokter', 'M Fuad Adib', 'dokter@apotikuin.com', '9d2878abdd504d16fe6262f17c80dae5cec34440'),
(2, 'DTR0002', 'mfuadadib', 'M Fuad Adib', 'mfuadadib@yahoo.com', '395382a3791259594a6f506e4b3c2d8c4ad01b3d');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE IF NOT EXISTS `pasien` (
  `id_pasien` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pasien` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pasien`),
  UNIQUE KEY `kode_pasien` (`kode_pasien`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `kode_pasien`, `username`, `nama`, `jk`, `alamat`) VALUES
(1, 'APKUIN0001', 'mfuadadib', 'M Fuad Adib', 'l', 'rt\\rw 001\\001 ds.renged, kec. kresek, kab. tangerang'),
(2, 'APKUIN0002', 'mfuadadib1', 'M Fuad Adib', 'l', 'Ds. Renged Kec Kresek Kab Tangerang Prop. Banten'),
(3, 'APKUIN0003', 'zaed', 'Zaed', 'l', 'Ds. Renged Kec Kresek Kab Tangerang Prop. Banten'),
(4, 'APKUIN0004', 'ebiettle', 'Fuad Adib', 'l', 'ds. renged');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksa`
--

CREATE TABLE IF NOT EXISTS `periksa` (
  `id_periksa` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasien` int(11) NOT NULL,
  `tanggal_periksa` date NOT NULL,
  `keluhan` text NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_periksa`),
  KEY `id_pasien` (`id_pasien`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `periksa`
--

INSERT INTO `periksa` (`id_periksa`, `id_pasien`, `tanggal_periksa`, `keluhan`, `status`) VALUES
(1, 1, '2013-05-29', 'pusing, badan panas,', 'sudah'),
(2, 4, '2013-05-29', 'pusing', 'sudah'),
(3, 1, '2013-05-29', 'mual-mual', 'belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE IF NOT EXISTS `resep` (
  `id_resep` int(11) NOT NULL AUTO_INCREMENT,
  `id_diagnosis` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `aturan_pakai` varchar(50) NOT NULL,
  PRIMARY KEY (`id_resep`),
  KEY `id_diagnosis` (`id_diagnosis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`id_resep`, `id_diagnosis`, `nama_obat`, `aturan_pakai`) VALUES
(1, 1, 'Bodrek', 'ab');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`id_administrator`) REFERENCES `administrator` (`id_administrator`);
