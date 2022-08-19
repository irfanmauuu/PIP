-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 25 Jul 2022 pada 16.26
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PIP`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
('K001', 'Premium'),
('K002', 'Medium'),
('K003', 'Produk Samping');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `biaya_pengiriman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `no_hp`, `biaya_pengiriman`) VALUES
('P001', 'Azzahra', 'Lamaran, Karawang                                                  \r\n                                              ', '085741235678', 20000),
('P002', 'Aini', 'Tanjungpura                                                  \r\n                                              ', '081345638790', 30000),
('P003', 'Hasbi', 'Karawang Green Village                                                  \r\n                                              ', '085265431234', 40000),
('P004', 'Adi', 'Rawamerta                                                  \r\n                                              ', '0857', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` varchar(6) NOT NULL,
  `id_produk` varchar(30) NOT NULL,
  `id_stok` varchar(10) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `id_penjualan` varchar(5) NOT NULL,
  `tipe_sj` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_produk`, `id_stok`, `id_pelanggan`, `id_penjualan`, `tipe_sj`, `tgl`, `jumlah`, `keterangan`) VALUES
('PP001', 'PK001', '98', 'P003', 'TP001', 'LOCCO', '2022-07-19', 2, 'kemasan rusak'),
('PP002', 'PK005', '104', 'P001', 'TP005', '', '2022-07-22', 1, 'kualitas beras kurang baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `username` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `akses` varchar(20) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`username`, `nama`, `password`, `akses`, `status`) VALUES
('admin', 'Kosim', 'YWRtaW4=', 'Admin', 'aktif'),
('Indah', 'Indah', 'SU5kYWg=', '', 'belum aktif'),
('manager', 'guntoro', 'bWFuYWdlcg==', 'Manager', 'aktif'),
('staff', 'Susi', 'c3RhZmY=', 'Staff Produksi', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(20) NOT NULL,
  `id_transaksi` varchar(5) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `no_do` varchar(30) NOT NULL,
  `id_produk` varchar(5) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `id_stok` int(4) NOT NULL,
  `no_so` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `kg` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `tipe_sj` varchar(20) NOT NULL,
  `status` varchar(11) NOT NULL,
  `pembayaran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_transaksi`, `id_pelanggan`, `no_do`, `id_produk`, `kategori`, `id_stok`, `no_so`, `qty`, `kg`, `tgl`, `tipe_sj`, `status`, `pembayaran`) VALUES
('TP004', 'TR001', 'P002', '', 'PK002', 'Premium', 99, 'SO-04954', 200, 5, '2022-07-19', '', 'lunas', 'Tunai'),
('TP005', 'TR001', 'P001', 'DORM-220000002', 'PK005', 'Premium', 104, 'SO-04954', 99, 5, '2022-07-22', '', 'lunas', 'Tunai'),
('TP006', 'TR001', 'P004', '', 'PK004', 'Premium', 103, 'SO-04959', 400, 5, '2022-07-25', 'LOCCO', 'lunas', 'Tunai'),
('TP007', 'TR001', 'P004', '', 'PK006', 'Produk Samping', 108, 'SO-04954', 3, 30, '2022-07-25', 'LOCCO', 'lunas', 'Tunai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(9) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `satuan_kg` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_beras` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `satuan_kg`, `kategori`, `harga`, `total_beras`) VALUES
('PK002', 'Mommy', 5, 'Premium', 11000, 0),
('PK003', 'Tugu Padi', 5, 'Premium', 12000, 0),
('PK004', 'Mommy', 5, 'Premium', 10000, 0),
('PK005', 'SIP A', 5, 'Premium', 11000, 0),
('PK006', 'menir', 30, 'Produk Samping', 7000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_produk`
--

CREATE TABLE `stok_produk` (
  `id_stok` int(11) NOT NULL,
  `id_produk` varchar(9) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `tgl_produksi` date NOT NULL,
  `stok_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok_produk`
--

INSERT INTO `stok_produk` (`id_stok`, `id_produk`, `kategori`, `tgl_produksi`, `stok_produk`) VALUES
(99, 'PK002', 'Premium', '2022-07-17', 400),
(100, 'PK002', 'Premium', '2022-07-19', 600),
(102, 'PK004', 'Premium', '2022-07-22', 1),
(103, 'PK004', 'Premium', '2022-04-15', 0),
(104, 'PK005', 'Premium', '2022-07-20', 500),
(105, 'PK005', 'Premium', '2022-07-21', 200),
(106, 'PK002', 'Premium', '2022-07-21', 200),
(107, 'PK002', 'Premium', '2022-07-22', 300),
(108, 'PK006', 'Produk Samping', '2022-07-22', 30),
(109, 'PK002', 'Premium', '2022-07-24', 600);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_produk_2` (`id_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `stok_produk`
--
ALTER TABLE `stok_produk`
  ADD PRIMARY KEY (`id_stok`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `stok_produk`
--
ALTER TABLE `stok_produk`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
