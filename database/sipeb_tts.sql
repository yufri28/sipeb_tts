-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Feb 2025 pada 04.48
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipeb_tts`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kondisi_terkini_id` int(11) NOT NULL,
  `batch_id` varchar(255) NOT NULL,
  `kategori` enum('bantuan','pinjaman') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_pinjam`
--

CREATE TABLE `barang_pinjam` (
  `id_barang_pinjam` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi_terkini_id` int(11) NOT NULL,
  `batch_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_pinjam`
--

INSERT INTO `barang_pinjam` (`id_barang_pinjam`, `jumlah`, `kondisi_terkini_id`, `batch_id`) VALUES
(12, 1, 4, 'b9603978-2374-4b67-b322-1595f8022af7'),
(13, 1, 16, 'b9603978-2374-4b67-b322-1595f8022af7'),
(21, 1, 4, '7d54503f-8ed4-465b-9705-491d3169b2a6'),
(22, 1, 16, '7d54503f-8ed4-465b-9705-491d3169b2a6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ba_serah_terima`
--

CREATE TABLE `ba_serah_terima` (
  `id_serah_terima` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pihak_pertama` varchar(255) NOT NULL,
  `jabatan_pihak_pertama` varchar(255) NOT NULL,
  `nama_pihak_kedua` varchar(255) NOT NULL,
  `alamat_pihak_kedua` varchar(255) NOT NULL,
  `nama_desa` varchar(255) NOT NULL,
  `nama_kades` varchar(255) NOT NULL,
  `kepala_pelaksana` varchar(255) NOT NULL,
  `jabatan_pelaksana` varchar(255) NOT NULL,
  `nip_pelaksana` varchar(255) NOT NULL,
  `batch_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bencana`
--

CREATE TABLE `bencana` (
  `id_bencana` int(11) NOT NULL,
  `jenis_bencana_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` text NOT NULL,
  `bukti_lap_pusdolops` varchar(255) NOT NULL,
  `sk_tanggap_darurat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasifikasi`
--

CREATE TABLE `klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `nama_klasifikasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `klasifikasi`
--

INSERT INTO `klasifikasi` (`id_klasifikasi`, `nama_klasifikasi`) VALUES
(2, 'Bechue'),
(3, 'Toyota'),
(4, 'Vixion'),
(5, 'KLX'),
(6, 'Tidak Ada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_terkini`
--

CREATE TABLE `kondisi_terkini` (
  `id_kondisi_terkini` int(11) NOT NULL,
  `kondisi_logpal_id` int(11) NOT NULL,
  `stok_id` varchar(255) NOT NULL,
  `stok_masuk` int(11) NOT NULL,
  `stok_terkini` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kondisi_terkini`
--

INSERT INTO `kondisi_terkini` (`id_kondisi_terkini`, `kondisi_logpal_id`, `stok_id`, `stok_masuk`, `stok_terkini`) VALUES
(4, 2, '5a787994-ac46-4f1e-b70e-9bd2fbdff4f7', 6, 7),
(5, 3, '5a787994-ac46-4f1e-b70e-9bd2fbdff4f7', 0, 0),
(6, 4, '5a787994-ac46-4f1e-b70e-9bd2fbdff4f7', 0, 0),
(7, 5, '5a787994-ac46-4f1e-b70e-9bd2fbdff4f7', 0, 0),
(16, 2, 'e0897740-2001-4e3a-861b-043e10447605', 6, 7),
(17, 3, 'e0897740-2001-4e3a-861b-043e10447605', 1, 1),
(18, 4, 'e0897740-2001-4e3a-861b-043e10447605', 0, 0),
(19, 5, 'e0897740-2001-4e3a-861b-043e10447605', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_jenis_barang`
--

CREATE TABLE `master_jenis_barang` (
  `id_jenisbarang` int(11) NOT NULL,
  `nama_jenisbarang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_jenis_barang`
--

INSERT INTO `master_jenis_barang` (`id_jenisbarang`, `nama_jenisbarang`) VALUES
(2, 'Tenda  Posko'),
(3, 'Whell Loader/Becue'),
(4, 'PickUp/Hilux');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_jenis_bencana`
--

CREATE TABLE `master_jenis_bencana` (
  `id_jenis_bencana` int(11) NOT NULL,
  `nama_bencana` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_jenis_bencana`
--

INSERT INTO `master_jenis_bencana` (`id_jenis_bencana`, `nama_bencana`) VALUES
(3, 'Seroja'),
(4, 'Rossby');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kondisi`
--

CREATE TABLE `master_kondisi` (
  `id_kondisi` int(11) NOT NULL,
  `nama_kondisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_kondisi`
--

INSERT INTO `master_kondisi` (`id_kondisi`, `nama_kondisi`) VALUES
(2, 'Baik'),
(3, 'Rusak Ringan'),
(4, 'Rusak Sedang'),
(5, 'Rusak Berat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_satuan`
--

CREATE TABLE `master_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_satuan`
--

INSERT INTO `master_satuan` (`id_satuan`, `nama_satuan`) VALUES
(2, 'Unit'),
(3, 'Lbr'),
(4, 'Paket');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_sumber`
--

CREATE TABLE `master_sumber` (
  `id_sumber` int(11) NOT NULL,
  `nama_sumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_sumber`
--

INSERT INTO `master_sumber` (`id_sumber`, `nama_sumber`) VALUES
(2, 'Hibah BNPB'),
(3, 'Pembelian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `nama_penanggungjawab` varchar(255) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `keperluan` text NOT NULL,
  `batch_id` varchar(255) NOT NULL,
  `status_diterima` enum('tunggu','terima','tolak') NOT NULL DEFAULT 'tunggu',
  `status_peminjaman` enum('belum','selesai') NOT NULL DEFAULT 'belum',
  `pesan` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `nama_pihak_pertama` varchar(255) DEFAULT NULL,
  `jabatan_pihak_pertama` varchar(255) DEFAULT NULL,
  `kepala_pelaksana` varchar(255) DEFAULT NULL,
  `jabatan_pelaksana` varchar(255) DEFAULT NULL,
  `nip_pelaksana` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `tanggal_pengajuan`, `tanggal_pinjam`, `tanggal_kembali`, `nama_penanggungjawab`, `no_hp`, `alamat`, `keperluan`, `batch_id`, `status_diterima`, `status_peminjaman`, `pesan`, `user_id`, `nama_pihak_pertama`, `jabatan_pihak_pertama`, `kepala_pelaksana`, `jabatan_pelaksana`, `nip_pelaksana`) VALUES
(10, '2025-02-25', '2025-02-26', '2025-03-08', 'Aliando', '081293829312', '-', '-', 'b9603978-2374-4b67-b322-1595f8022af7', 'tolak', 'belum', NULL, 6, NULL, NULL, NULL, NULL, NULL),
(16, '2025-02-27', '2025-02-27', '2025-02-27', 'Aliando', '081293829343', '-', '-', '7d54503f-8ed4-465b-9705-491d3169b2a6', 'terima', 'selesai', 'Silahakan proses lebih lanjut', 1, 'Aliando Kaur, S.Si', 'Staf Sekertariat', 'Drs. Yerry O. Nakamnanu, M.Si', 'Kepala BPBD', '929292929292');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `id_stok` varchar(255) NOT NULL,
  `jenis_barang_id` int(11) NOT NULL,
  `klasifikasi_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `sumber_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tahun` varchar(9) NOT NULL,
  `keterangan_tambahan` text DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `masuk_stok` enum('belum','sudah') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`id_stok`, `jenis_barang_id`, `klasifikasi_id`, `satuan_id`, `sumber_id`, `jumlah`, `tahun`, `keterangan_tambahan`, `tanggal_masuk`, `masuk_stok`) VALUES
('5a787994-ac46-4f1e-b70e-9bd2fbdff4f7', 2, 2, 2, 2, 6, '2021-2022', NULL, '2025-02-12', 'sudah'),
('e0897740-2001-4e3a-861b-043e10447605', 4, 3, 2, 2, 7, '2021-2022', '-', '2025-02-17', 'sudah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('administrator','admin','pengguna','kepala_dinas') NOT NULL DEFAULT 'pengguna',
  `aktifitas` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `name`, `username`, `password`, `role`, `aktifitas`) VALUES
(1, 'administrator', 'administrator', '$2y$10$.vqr54xh6CnqUeBclwNfOey6/XhbL5mBSx4gDueRUDyVo0e42IiF2', 'administrator', 'aktif'),
(2, 'Yufridon Chrisma Luttu', 'pengguna', '$2y$10$VppfBRbsAuB2y9bXo8MWw.occdfHpLBa5GV6Jnh9Q/VgmjUAtHx0q', 'admin', 'aktif'),
(6, 'Yupi Lu', 'inibeta', '$2y$10$5.Do.Yjyj/MNOI5TO2Yea.7nHLQGf4LfhQVMsQ5rojxp6ir3FTPum', 'pengguna', 'aktif'),
(7, 'Kepala Dinas', 'kepala', '$2y$10$6NBqNN6E2WaGm8XmYTf1DOle/COb7lXycJoZUSWPADTkl9ngu3l7K', 'kepala_dinas', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_barang_keluar` (`id_barang_keluar`),
  ADD KEY `kondisi_terkini_id` (`kondisi_terkini_id`);

--
-- Indeks untuk tabel `barang_pinjam`
--
ALTER TABLE `barang_pinjam`
  ADD PRIMARY KEY (`id_barang_pinjam`),
  ADD KEY `kondisi_terkini_id` (`kondisi_terkini_id`);

--
-- Indeks untuk tabel `ba_serah_terima`
--
ALTER TABLE `ba_serah_terima`
  ADD PRIMARY KEY (`id_serah_terima`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indeks untuk tabel `bencana`
--
ALTER TABLE `bencana`
  ADD PRIMARY KEY (`id_bencana`),
  ADD KEY `jenis_bencana_id` (`jenis_bencana_id`);

--
-- Indeks untuk tabel `klasifikasi`
--
ALTER TABLE `klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indeks untuk tabel `kondisi_terkini`
--
ALTER TABLE `kondisi_terkini`
  ADD PRIMARY KEY (`id_kondisi_terkini`),
  ADD KEY `kondisi_logpal_id` (`kondisi_logpal_id`),
  ADD KEY `stok_id` (`stok_id`);

--
-- Indeks untuk tabel `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  ADD PRIMARY KEY (`id_jenisbarang`);

--
-- Indeks untuk tabel `master_jenis_bencana`
--
ALTER TABLE `master_jenis_bencana`
  ADD PRIMARY KEY (`id_jenis_bencana`);

--
-- Indeks untuk tabel `master_kondisi`
--
ALTER TABLE `master_kondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indeks untuk tabel `master_satuan`
--
ALTER TABLE `master_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `master_sumber`
--
ALTER TABLE `master_sumber`
  ADD PRIMARY KEY (`id_sumber`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_stok` (`id_stok`),
  ADD KEY `jenis_barang_id` (`jenis_barang_id`),
  ADD KEY `klasifikasi_id` (`klasifikasi_id`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `sumber_id` (`sumber_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `barang_pinjam`
--
ALTER TABLE `barang_pinjam`
  MODIFY `id_barang_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `ba_serah_terima`
--
ALTER TABLE `ba_serah_terima`
  MODIFY `id_serah_terima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `bencana`
--
ALTER TABLE `bencana`
  MODIFY `id_bencana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `klasifikasi`
--
ALTER TABLE `klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kondisi_terkini`
--
ALTER TABLE `kondisi_terkini`
  MODIFY `id_kondisi_terkini` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  MODIFY `id_jenisbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `master_jenis_bencana`
--
ALTER TABLE `master_jenis_bencana`
  MODIFY `id_jenis_bencana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `master_kondisi`
--
ALTER TABLE `master_kondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `master_satuan`
--
ALTER TABLE `master_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `master_sumber`
--
ALTER TABLE `master_sumber`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`kondisi_terkini_id`) REFERENCES `kondisi_terkini` (`id_kondisi_terkini`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_pinjam`
--
ALTER TABLE `barang_pinjam`
  ADD CONSTRAINT `barang_pinjam_ibfk_1` FOREIGN KEY (`kondisi_terkini_id`) REFERENCES `kondisi_terkini` (`id_kondisi_terkini`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bencana`
--
ALTER TABLE `bencana`
  ADD CONSTRAINT `bencana_ibfk_1` FOREIGN KEY (`jenis_bencana_id`) REFERENCES `master_jenis_bencana` (`id_jenis_bencana`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kondisi_terkini`
--
ALTER TABLE `kondisi_terkini`
  ADD CONSTRAINT `kondisi_terkini_ibfk_2` FOREIGN KEY (`kondisi_logpal_id`) REFERENCES `master_kondisi` (`id_kondisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kondisi_terkini_ibfk_3` FOREIGN KEY (`stok_id`) REFERENCES `stok` (`id_stok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`jenis_barang_id`) REFERENCES `master_jenis_barang` (`id_jenisbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_ibfk_3` FOREIGN KEY (`klasifikasi_id`) REFERENCES `klasifikasi` (`id_klasifikasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_ibfk_4` FOREIGN KEY (`satuan_id`) REFERENCES `master_satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_ibfk_6` FOREIGN KEY (`sumber_id`) REFERENCES `master_sumber` (`id_sumber`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
