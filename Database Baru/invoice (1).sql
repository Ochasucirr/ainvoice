-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2023 pada 14.59
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `id_detailpenjualan` int(11) NOT NULL,
  `id_headerpenjualan` int(11) NOT NULL,
  `namabarang` varchar(100) NOT NULL,
  `jumlah` float NOT NULL,
  `harga` int(11) NOT NULL,
  `discountpersen` int(11) DEFAULT NULL,
  `discountnilai` int(11) DEFAULT NULL,
  `jumlahharga` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `id_user` int(20) DEFAULT NULL,
  `status_tmp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `headerpenjualan`
--

CREATE TABLE `headerpenjualan` (
  `id_headerpenjualan` int(11) NOT NULL,
  `tanggalimport` date DEFAULT NULL,
  `jenispenjualan` varchar(50) NOT NULL,
  `nomorpenjualan` varchar(100) NOT NULL,
  `nomorpo` varchar(100) DEFAULT NULL,
  `id_agen` int(11) NOT NULL,
  `tanggalpenjualan` date NOT NULL,
  `termsofpayment` int(11) DEFAULT NULL,
  `jumlahpenjualan` int(11) NOT NULL,
  `discountpersen` int(11) DEFAULT NULL,
  `discountnilai` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `import_dataagentmp`
--

CREATE TABLE `import_dataagentmp` (
  `id_import` int(11) NOT NULL,
  `nama_agen` varchar(100) DEFAULT NULL,
  `no_telephone` varchar(50) DEFAULT NULL,
  `alamat_agen` varchar(500) DEFAULT NULL,
  `tanggalgabung` date DEFAULT NULL,
  `tanggalimport` date DEFAULT NULL,
  `status_temporary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `import_datapenjualantmp`
--

CREATE TABLE `import_datapenjualantmp` (
  `id_import` int(11) NOT NULL,
  `tanggalimport` date NOT NULL,
  `tanggalorder` date DEFAULT NULL,
  `namaagen` varchar(100) DEFAULT NULL,
  `notelepon` varchar(50) NOT NULL,
  `alamatagen` varchar(500) NOT NULL,
  `namaproduk` varchar(50) DEFAULT NULL,
  `jumlahproduk` int(11) DEFAULT NULL,
  `hargaproduk` int(11) DEFAULT NULL,
  `status_temporary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Suci Rahma Rosa', 'default.jpg', '$2y$10$XKQVfniz5V50ElKYSiY7Qes2DQ8H26/8V6GcGLDChE5bo205G07XS', 2, 1, 1690343252),
(2, 'Ocha', 'default.jpg', '$2y$10$jDZEpp2WBtu/Qx2vJHMrle78iIwHDB5waty8..jAZIxK7HoGw22y2', 1, 1, 1690343677),
(4, 'Intan', 'caaa.jpeg', '$2y$10$ZMHvp6TOJeJ0/FwnWKobHem8A/mzCxOHvg5qjSfKKXQ/gTKHkIuYu', 3, 1, 1690735827),
(5, 'angga', 'default.jpg', '$2y$10$Ieh/HMY6Qx.z/xcPGkAbpOMhHHXgizBMOUwMhhI..f1BcIYjla0Jy', 1, 1, 1690965329);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(6, 1, 3),
(7, 1, 5),
(9, 1, 6),
(10, 3, 5),
(11, 3, 6),
(12, 1, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_dataagen`
--

CREATE TABLE `user_dataagen` (
  `id` int(11) NOT NULL,
  `tanggalgabung` date DEFAULT NULL,
  `tanggalimport` date DEFAULT NULL,
  `nama_agen` varchar(128) NOT NULL,
  `no_telephone` varchar(256) NOT NULL,
  `alamat_agen` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_datadivisi`
--

CREATE TABLE `user_datadivisi` (
  `id` int(11) NOT NULL,
  `judul_jobdesc` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `deskripsi` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_datadivisi`
--

INSERT INTO `user_datadivisi` (`id`, `judul_jobdesc`, `gambar`, `deskripsi`) VALUES
(1, 'Membuat Invoice', 'default.jpg', 'Membuat Invoice'),
(3, 'Membuat Invoice 4', '_DSC0552.JPG', 'Membuat Invoice 4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_dataedukasi`
--

CREATE TABLE `user_dataedukasi` (
  `id` int(11) NOT NULL,
  `istilah` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `keterangan` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_dataedukasi`
--

INSERT INTO `user_dataedukasi` (`id`, `istilah`, `gambar`, `keterangan`) VALUES
(2, 'Qty', 'intan1.jpg', 'Quantity');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin Sistem'),
(2, 'Procurement Manager'),
(3, 'Menu'),
(5, 'Procurement Staff'),
(7, 'Invoice');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin Sistem'),
(2, 'Procurement Manager'),
(3, 'Procurement Staff');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Monitor Performance', 'user', 'fa fa-fw fa-desktop', 1),
(3, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(4, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(6, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(7, 1, 'Data Pengguna', 'admin/datapengguna', 'fa fa-fw fa-user-plus', 1),
(8, 1, 'Data Divisi', 'admin/datadivisi', 'fa fa-fw fa-bookmark', 1),
(9, 2, 'Data Edukasi', 'user/dataedukasi', 'fas fa-fw fa-newspaper', 1),
(10, 2, 'Data Agen Baru', 'dataagen', 'fas fa-fw fa-plus', 1),
(11, 5, 'Edukasi', 'user2', 'fas fa-fw fa-laptop-code', 1),
(14, 7, 'Invoice', 'listpenjualan', 'fa fa-fw fa-file', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`id_detailpenjualan`);

--
-- Indeks untuk tabel `headerpenjualan`
--
ALTER TABLE `headerpenjualan`
  ADD PRIMARY KEY (`id_headerpenjualan`);

--
-- Indeks untuk tabel `import_dataagentmp`
--
ALTER TABLE `import_dataagentmp`
  ADD PRIMARY KEY (`id_import`);

--
-- Indeks untuk tabel `import_datapenjualantmp`
--
ALTER TABLE `import_datapenjualantmp`
  ADD PRIMARY KEY (`id_import`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_dataagen`
--
ALTER TABLE `user_dataagen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_datadivisi`
--
ALTER TABLE `user_datadivisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_dataedukasi`
--
ALTER TABLE `user_dataedukasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `import_dataagentmp`
--
ALTER TABLE `import_dataagentmp`
  MODIFY `id_import` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `import_datapenjualantmp`
--
ALTER TABLE `import_datapenjualantmp`
  MODIFY `id_import` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_dataagen`
--
ALTER TABLE `user_dataagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_datadivisi`
--
ALTER TABLE `user_datadivisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_dataedukasi`
--
ALTER TABLE `user_dataedukasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
