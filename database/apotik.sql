-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 01. April 2013 jam 17:20
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `id_administrator`, `judul_berita`, `isi_berita`, `tanggal_posting`) VALUES
(1, 1, 'Pusing', 'penyakit yang biasanya kebanyakan orang menghiraukan ternyata bisa berdampak buruk juga bila terlalu dibiarkan.', '2013-03-29 19:35:27'),
(2, 1, 'Mual', 'mual ...', '2013-03-29 19:48:57');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `kode_dokter`, `username`, `nama`, `email`, `password`) VALUES
(1, 'DTR0001', 'dokter', 'DOKTER 1', 'dokter@apotikuin.com', '9d2878abdd504d16fe6262f17c80dae5cec34440');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_pasien`
--

CREATE TABLE IF NOT EXISTS `history_pasien` (
  `id_history` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `kode_history` varchar(25) NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL,
  `deskripsi_penyakit` text NOT NULL,
  `obat` text NOT NULL,
  `tanggal_periksa` date NOT NULL,
  PRIMARY KEY (`id_history`),
  UNIQUE KEY `kode_history` (`kode_history`),
  KEY `id_pasien` (`id_pasien`),
  KEY `id_dokter` (`id_dokter`),
  KEY `id_pasien_2` (`id_pasien`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `history_pasien`
--

INSERT INTO `history_pasien` (`id_history`, `id_pasien`, `id_dokter`, `kode_history`, `nama_penyakit`, `deskripsi_penyakit`, `obat`, `tanggal_periksa`) VALUES
(1, 1, 1, 'HSTAPKUIN00011', 'Demam', 'Kurang tidur, kurang makan', '<p>+ obat1(3/hari setelah makan)<br>\r\n+ obat2(2/hari setelah makan)<br>\r\n+ obat3(2/hari setelah makan)<br></p>', '2013-03-29');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `kode_pasien`, `username`, `nama`, `jk`, `alamat`) VALUES
(1, 'APKUIN0001', 'mfuadadib', 'M Fuad Adib', 'l', 'rt\\rw 001\\001 ds.renged, kec. kresek, kab. tangerang');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`id_administrator`) REFERENCES `administrator` (`id_administrator`);

--
-- Ketidakleluasaan untuk tabel `history_pasien`
--
ALTER TABLE `history_pasien`
  ADD CONSTRAINT `history_pasien_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `history_pasien_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`);
