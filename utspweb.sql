-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2024 pada 01.04
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utspweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kat` int(10) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kat`, `kategori`) VALUES
(1, 'Kamera'),
(2, 'Smartphone'),
(3, 'Play Station'),
(4, 'Laptop'),
(7, 'Elektronik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(255) NOT NULL,
  `id_brg` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `id_brg`, `nama`, `tgl`, `isi`) VALUES
(1, 1, 'Anas', '0000-00-00', 'Kamera Mantap'),
(8, 1, 'A', '0000-00-00', 'asda'),
(98, 21, 'Reyhan', '0000-00-00', 'Apikk Pol Jos');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga_sewa` int(11) DEFAULT NULL,
  `gambar_produk` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) NOT NULL,
  `pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `harga_sewa`, `gambar_produk`, `kategori`, `pemilik`) VALUES
(1, 'DSLR CANON EOS 90D', '32.5MP APS-C CMOS Sensor DIGIC 8 Image Processor UHD 4K30p & Full HD 120p Video Recording 3? 1.04m-Dot Vari-Angle Touchscreen LCD 45-Point All Cross-Type AF System Dual Pixel CMOS AF with 5481 AF Points Up to 10-fps Shooting, ISO 100-25600 Built-In Wi-Fi and Bluetooth EOS iTR AF, Electronic Shutter Function 220,000-Pixel AE Metering Sensor', 250000, '718-DSLR CANON EOS 90D.jpg', 'Kamera', ''),
(8, 'Kamera', 'Kamera Apik', 520000, '96-1.jpg', 'Kamera', ''),
(9, 'DSLR CANON EOS 700D', 'APS-C Digital SLR, 18.0 Megapixel, Full HD, 3.0\" Vari-Angle Touchscreen LCD, SD/SDHC/SDXC Card Slot, Multi Shot Noise Reduction, DIGIC 5, Include EF-S 18-55mm f/3.5-5.6 IS STM Lens', 125000, '442-DSLR CANON EOS 700D.jpg', 'Kamera', ''),
(10, 'DSLR CANON EOS 800D', '- 24.2 megapixels - APS-C CMOS Sensor. - ISO 100 - 25600 (expands to 51200) - Digic 7 Image Processor - Autofocus System; Dual Pixel CMOS AF 45-Point - 3.0? 1.04m-Dot Vari-Angle Touchscreen - Optical (pentamirror) viewfinder. - 6.0 fps continuous shooting. - 1920 x 1080 video resolution. - Built-in Wifi , with NFC dan Bluetooth - Lensa : 18-55 IS STM', 150000, '345-DSLR CANON EOS 800D.jpg', 'Kamera', ''),
(15, 'PlayStation 2', 'PlayStation 2 Seru', 50000, '797-PS2-Versions.jpg', 'Play Station', 'user'),
(21, 'PlayStation 3', 'PlayStation 3 Apik', 100000, '328-1920px-Sony-PlayStation-3-CECHA01-wController-L.jpg', 'Play Station', 'user'),
(24, 'iPad Pro 4th', 'iPad Pro 4th Generation 12.9-inch', 125000, '181-644-iPad Pro 11.jpg', 'Smartphone', ''),
(26, 'PlayStation 4', 'PlayStation 4 Apik', 250000, '672-3518e54a-3834-49f6-a12b-fe1dcba1e5e6.jpg', 'Play Station', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'admin', '123', 'admin'),
(2, 'User', 'user', '123', 'user'),
(5, 'pas', 'pis', 'pus', 'user'),
(7, 'Reyhan', '123', '123', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `web`
--

CREATE TABLE `web` (
  `id` int(10) NOT NULL,
  `namaweb` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `web`
--

INSERT INTO `web` (`id`, `namaweb`, `logo`, `deskripsi`) VALUES
(1, 'SEWAON', '792-logo.png', 'Portal Sewa Menyewa Barang Elektronik Online\r\n<br>\r\nSewa Menyewa ?\r\n<br>\r\nSEWAON SAJA');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `web`
--
ALTER TABLE `web`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `web`
--
ALTER TABLE `web`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
