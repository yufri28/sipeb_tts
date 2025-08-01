-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jul 2025 pada 10.08
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

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `jumlah`, `tanggal`, `kondisi_terkini_id`, `batch_id`, `kategori`) VALUES
(36, 1, '2025-07-27', 32, 'aaec2906-1ce6-41ec-87c1-87ec6a4176f5', 'pinjaman');

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
(28, 1, 32, 'aaec2906-1ce6-41ec-87c1-87ec6a4176f5');

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
  `nama_klasifikasi` varchar(255) NOT NULL,
  `keterangan_tambahan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `klasifikasi`
--

INSERT INTO `klasifikasi` (`id_klasifikasi`, `nama_klasifikasi`, `keterangan_tambahan`) VALUES
(2, 'Bechue', ''),
(3, 'Toyota', ''),
(5, 'KLX', ''),
(6, 'Tidak Ada', ''),
(10, 'Izuzu', ''),
(11, 'Olimpic', ''),
(12, 'Duromatic', ''),
(13, 'Sanyo', ''),
(14, 'Sthill', ''),
(15, 'Frame', ''),
(16, 'Kaca', ''),
(17, 'Ina Tews', ''),
(18, 'Phantom', ''),
(19, 'Sony', ''),
(20, 'BenQ', ''),
(21, 'Canon', ''),
(22, 'OPPO', ''),
(23, 'Honda', ''),
(24, 'Icom', ''),
(25, 'Aluminium', ''),
(26, 'Besi', ''),
(27, 'Hock', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_terkini`
--

CREATE TABLE `kondisi_terkini` (
  `id_kondisi_terkini` int(11) NOT NULL,
  `kondisi_logpal_id` int(11) NOT NULL,
  `stok_id` varchar(255) NOT NULL,
  `stok_masuk` int(11) NOT NULL,
  `stok_terkini` int(11) NOT NULL,
  `foto_kondisi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kondisi_terkini`
--

INSERT INTO `kondisi_terkini` (`id_kondisi_terkini`, `kondisi_logpal_id`, `stok_id`, `stok_masuk`, `stok_terkini`, `foto_kondisi`) VALUES
(28, 2, 'fc341a14-125b-4714-822c-04555e298ccb', 1, 1, NULL),
(29, 3, 'fc341a14-125b-4714-822c-04555e298ccb', 0, 0, NULL),
(30, 4, 'fc341a14-125b-4714-822c-04555e298ccb', 0, 0, NULL),
(31, 5, 'fc341a14-125b-4714-822c-04555e298ccb', 1, 1, NULL),
(32, 2, '59421d2e-47e9-4e7e-b949-913eee29c43f', 2, 2, NULL),
(33, 3, '59421d2e-47e9-4e7e-b949-913eee29c43f', 0, 0, NULL),
(34, 4, '59421d2e-47e9-4e7e-b949-913eee29c43f', 0, 0, NULL),
(35, 5, '59421d2e-47e9-4e7e-b949-913eee29c43f', 1, 1, NULL),
(36, 2, '987112e1-ba7a-4259-9373-c9f5a85f715a', 3, 3, NULL),
(37, 3, '987112e1-ba7a-4259-9373-c9f5a85f715a', 0, 0, NULL),
(38, 4, '987112e1-ba7a-4259-9373-c9f5a85f715a', 0, 0, NULL),
(39, 5, '987112e1-ba7a-4259-9373-c9f5a85f715a', 1, 1, NULL),
(40, 2, '9bd7a627-d3c6-4088-b1f3-24dd5fe43ec2', 2, 2, '9c8cb05b16f96e5ed1083d8abc2b9472.png'),
(41, 3, '9bd7a627-d3c6-4088-b1f3-24dd5fe43ec2', 0, 0, NULL),
(42, 4, '9bd7a627-d3c6-4088-b1f3-24dd5fe43ec2', 0, 0, NULL),
(43, 5, '9bd7a627-d3c6-4088-b1f3-24dd5fe43ec2', 2, 2, NULL),
(44, 2, '387f058d-3bba-4ac7-8545-4da14205942f', 0, 0, NULL),
(45, 3, '387f058d-3bba-4ac7-8545-4da14205942f', 0, 0, NULL),
(46, 4, '387f058d-3bba-4ac7-8545-4da14205942f', 0, 0, NULL),
(47, 5, '387f058d-3bba-4ac7-8545-4da14205942f', 1, 1, NULL),
(48, 2, '6b8a3c4f-9d2f-47a5-b72b-fc7d4a4768aa', 5, 5, NULL),
(49, 3, '6b8a3c4f-9d2f-47a5-b72b-fc7d4a4768aa', 0, 0, NULL),
(50, 4, '6b8a3c4f-9d2f-47a5-b72b-fc7d4a4768aa', 0, 0, NULL),
(51, 5, '6b8a3c4f-9d2f-47a5-b72b-fc7d4a4768aa', 4, 4, NULL),
(52, 2, '4da9e8ef-006e-4758-85ee-b206fafb9e59', 2, 2, NULL),
(53, 3, '4da9e8ef-006e-4758-85ee-b206fafb9e59', 0, 0, NULL),
(54, 4, '4da9e8ef-006e-4758-85ee-b206fafb9e59', 0, 0, NULL),
(55, 5, '4da9e8ef-006e-4758-85ee-b206fafb9e59', 0, 0, NULL),
(56, 2, '86d0e9ea-f45b-49e0-94a5-138b8cdc9495', 1, 1, NULL),
(57, 3, '86d0e9ea-f45b-49e0-94a5-138b8cdc9495', 0, 0, NULL),
(58, 4, '86d0e9ea-f45b-49e0-94a5-138b8cdc9495', 0, 0, NULL),
(59, 5, '86d0e9ea-f45b-49e0-94a5-138b8cdc9495', 1, 1, NULL),
(60, 2, '3b4ff30d-047b-4802-a0d8-a7575c529099', 8, 8, NULL),
(61, 3, '3b4ff30d-047b-4802-a0d8-a7575c529099', 0, 0, NULL),
(62, 4, '3b4ff30d-047b-4802-a0d8-a7575c529099', 0, 0, NULL),
(63, 5, '3b4ff30d-047b-4802-a0d8-a7575c529099', 12, 12, NULL),
(64, 2, '5cf260ec-f312-4621-be03-c7e3aec94dc1', 0, 0, NULL),
(65, 3, '5cf260ec-f312-4621-be03-c7e3aec94dc1', 0, 0, NULL),
(66, 4, '5cf260ec-f312-4621-be03-c7e3aec94dc1', 0, 0, NULL),
(67, 5, '5cf260ec-f312-4621-be03-c7e3aec94dc1', 1, 1, NULL),
(68, 2, 'd54ff15b-57e3-4d7e-9be7-d9c33bf54d18', 1, 1, NULL),
(69, 3, 'd54ff15b-57e3-4d7e-9be7-d9c33bf54d18', 0, 0, NULL),
(70, 4, 'd54ff15b-57e3-4d7e-9be7-d9c33bf54d18', 0, 0, NULL),
(71, 5, 'd54ff15b-57e3-4d7e-9be7-d9c33bf54d18', 0, 0, NULL),
(72, 2, '0bc04788-755b-4b53-9d00-dc22b1379468', 1, 1, NULL),
(73, 3, '0bc04788-755b-4b53-9d00-dc22b1379468', 0, 0, NULL),
(74, 4, '0bc04788-755b-4b53-9d00-dc22b1379468', 0, 0, NULL),
(75, 5, '0bc04788-755b-4b53-9d00-dc22b1379468', 0, 0, NULL),
(76, 2, '5be37b3d-926c-418a-8bbd-8f9e70e09a30', 94, 94, NULL),
(77, 3, '5be37b3d-926c-418a-8bbd-8f9e70e09a30', 0, 0, NULL),
(78, 4, '5be37b3d-926c-418a-8bbd-8f9e70e09a30', 0, 0, NULL),
(79, 5, '5be37b3d-926c-418a-8bbd-8f9e70e09a30', 0, 0, NULL),
(80, 2, 'fdcd89bc-7599-40ab-9550-1ffdb6e092eb', 3, 3, NULL),
(81, 3, 'fdcd89bc-7599-40ab-9550-1ffdb6e092eb', 0, 0, NULL),
(82, 4, 'fdcd89bc-7599-40ab-9550-1ffdb6e092eb', 0, 0, NULL),
(83, 5, 'fdcd89bc-7599-40ab-9550-1ffdb6e092eb', 0, 0, NULL),
(84, 2, '2ef1f289-a683-480c-8b2a-3d7778433755', 17, 17, '37540d5c59e9f0d580a8b7016f9f4cb4.png'),
(85, 3, '2ef1f289-a683-480c-8b2a-3d7778433755', 0, 0, NULL),
(86, 4, '2ef1f289-a683-480c-8b2a-3d7778433755', 0, 0, NULL),
(87, 5, '2ef1f289-a683-480c-8b2a-3d7778433755', 0, 0, NULL),
(88, 2, '6c0bc13c-fd64-44c1-a3ee-e7bc46dc2b53', 10, 10, NULL),
(89, 3, '6c0bc13c-fd64-44c1-a3ee-e7bc46dc2b53', 0, 0, NULL),
(90, 4, '6c0bc13c-fd64-44c1-a3ee-e7bc46dc2b53', 0, 0, NULL),
(91, 5, '6c0bc13c-fd64-44c1-a3ee-e7bc46dc2b53', 0, 0, NULL),
(92, 2, 'b2e7f92f-f0b5-4116-9927-a3b705e0809b', 3, 3, NULL),
(93, 3, 'b2e7f92f-f0b5-4116-9927-a3b705e0809b', 0, 0, NULL),
(94, 4, 'b2e7f92f-f0b5-4116-9927-a3b705e0809b', 0, 0, NULL),
(95, 5, 'b2e7f92f-f0b5-4116-9927-a3b705e0809b', 0, 0, NULL),
(96, 2, '03697386-4d4d-4e15-9b04-ceca03e6d4bf', 4, 4, NULL),
(97, 3, '03697386-4d4d-4e15-9b04-ceca03e6d4bf', 0, 0, NULL),
(98, 4, '03697386-4d4d-4e15-9b04-ceca03e6d4bf', 0, 0, NULL),
(99, 5, '03697386-4d4d-4e15-9b04-ceca03e6d4bf', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_jenis_barang`
--

CREATE TABLE `master_jenis_barang` (
  `id_jenisbarang` int(11) NOT NULL,
  `nama_jenisbarang` varchar(255) NOT NULL,
  `keterangan_tambahan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_jenis_barang`
--

INSERT INTO `master_jenis_barang` (`id_jenisbarang`, `nama_jenisbarang`, `keterangan_tambahan`) VALUES
(21, 'Whell Loader/Becue', ''),
(22, 'Mobil Logpal', ''),
(23, 'Mobil Pick Up', ''),
(24, 'Motor KLX Trail', ''),
(25, 'Mobil Dapur Umum', ''),
(26, 'Mobil Tengki Air', ''),
(27, 'Mobil Resqiu', ''),
(28, 'GPS', ''),
(29, 'Mesin Gergaji Sthill', ''),
(30, 'Mesin Pompa Air', ''),
(31, 'Mesin Sensor', ''),
(32, 'Felbet/Steel Frame', ''),
(33, 'Warning Reseiver System (WRS)', ''),
(34, 'Unitemuptible Power Supply (UPC) CE 600', ''),
(35, 'Peralatan Studio (Drone)', ''),
(36, 'Handycam Sony', ''),
(37, 'Infocus/BenQ/MS.504', ''),
(38, 'Camera Digital/Lensa', ''),
(39, 'Telp Mobile', ''),
(40, 'Mesin Potong rumput', ''),
(41, 'Tenda Posko', ''),
(42, 'Tenda Regu', ''),
(43, 'Tenda Keluarga', ''),
(44, 'Tenda Pleton', ''),
(45, 'Tenda Pengungsian', ''),
(46, 'Genset 5 KVA', ''),
(47, 'Genset Honda GX390', ''),
(48, 'Perahu Karet Lipat', ''),
(49, 'Alas Tenda/Matras', ''),
(50, 'Handy Talky', ''),
(51, 'Water Tretmen Portable', ''),
(52, 'Pelampung', ''),
(53, 'Pusdalops', ''),
(54, 'Tenda Asmara', ''),
(55, 'Jenset', ''),
(56, 'Sensor Kayu', ''),
(57, 'Velbet', ''),
(58, 'Doma Buaya 5 Ton', ''),
(59, 'Lampu Air', ''),
(60, 'Tikar', ''),
(61, 'Kompor Hock 22 Sumbu', ''),
(62, 'Jerigen Semprot', ''),
(63, 'Kantong Mayat', '');

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
(4, 'Paket'),
(5, 'Pcs'),
(6, 'Pak');

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
(3, 'APBD'),
(5, 'CSR');

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
  `status_diterima` enum('verifikasi','tunggu','terima','tolak') NOT NULL DEFAULT 'verifikasi',
  `status_peminjaman` enum('belum','selesai') NOT NULL DEFAULT 'belum',
  `pesan` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `nama_pihak_pertama` varchar(255) DEFAULT NULL,
  `jabatan_pihak_pertama` varchar(255) DEFAULT NULL,
  `kepala_pelaksana` varchar(255) DEFAULT NULL,
  `jabatan_pelaksana` varchar(255) DEFAULT NULL,
  `nip_pelaksana` varchar(20) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `tanggal_pengajuan`, `tanggal_pinjam`, `tanggal_kembali`, `nama_penanggungjawab`, `no_hp`, `alamat`, `keperluan`, `batch_id`, `status_diterima`, `status_peminjaman`, `pesan`, `user_id`, `nama_pihak_pertama`, `jabatan_pihak_pertama`, `kepala_pelaksana`, `jabatan_pelaksana`, `nip_pelaksana`, `foto_ktp`) VALUES
(22, '2025-07-27', '2025-07-27', '2025-07-28', 'Aliando', '081287747170', 'Test Alamat', 'Test Keperluan', 'aaec2906-1ce6-41ec-87c1-87ec6a4176f5', 'terima', 'selesai', 'Silahkan ditindaklanjuti', 6, 'Aliando, S.Si', 'Staf Sekertariat', 'Drs. Yerry O. Nakamnanu, M.Si', 'Kepala BPBD', '929292929292', '4786643bfafa8937cd930646fdb023b1.png');

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
('03697386-4d4d-4e15-9b04-ceca03e6d4bf', 63, 6, 3, 2, 4, '2022', NULL, '2022-07-17', 'sudah'),
('0bc04788-755b-4b53-9d00-dc22b1379468', 58, 6, 2, 2, 1, '2022', NULL, '2022-07-16', 'sudah'),
('2ef1f289-a683-480c-8b2a-3d7778433755', 61, 27, 2, 2, 17, '2021', NULL, '2021-05-09', 'sudah'),
('387f058d-3bba-4ac7-8545-4da14205942f', 41, 6, 2, 2, 1, '2019', NULL, '2022-07-08', 'sudah'),
('3b4ff30d-047b-4802-a0d8-a7575c529099', 57, 6, 2, 2, 20, '2022', NULL, '2022-07-16', 'sudah'),
('4da9e8ef-006e-4758-85ee-b206fafb9e59', 48, 6, 2, 2, 2, '2021', NULL, '2021-07-18', 'sudah'),
('59421d2e-47e9-4e7e-b949-913eee29c43f', 42, 6, 2, 2, 3, '2019', NULL, '2022-07-08', 'sudah'),
('5be37b3d-926c-418a-8bbd-8f9e70e09a30', 59, 6, 5, 2, 94, '2021', NULL, '2021-07-23', 'sudah'),
('5cf260ec-f312-4621-be03-c7e3aec94dc1', 51, 25, 2, 2, 1, '2023', NULL, '2023-07-07', 'sudah'),
('6b8a3c4f-9d2f-47a5-b72b-fc7d4a4768aa', 46, 23, 2, 2, 9, '2021', NULL, '2021-07-11', 'sudah'),
('6c0bc13c-fd64-44c1-a3ee-e7bc46dc2b53', 60, 6, 3, 2, 10, '2021', NULL, '2021-05-08', 'sudah'),
('86d0e9ea-f45b-49e0-94a5-138b8cdc9495', 56, 14, 2, 2, 2, '2021', NULL, '2021-07-12', 'sudah'),
('987112e1-ba7a-4259-9373-c9f5a85f715a', 54, 6, 2, 2, 4, '2019', NULL, '2022-07-08', 'sudah'),
('9bd7a627-d3c6-4088-b1f3-24dd5fe43ec2', 43, 6, 2, 2, 5, '2019', NULL, '2022-07-09', 'sudah'),
('b2e7f92f-f0b5-4116-9927-a3b705e0809b', 62, 6, 2, 2, 3, '2021', NULL, '2021-04-28', 'sudah'),
('d54ff15b-57e3-4d7e-9be7-d9c33bf54d18', 40, 14, 2, 2, 1, '2022', NULL, '2022-07-17', 'sudah'),
('fc341a14-125b-4714-822c-04555e298ccb', 44, 6, 2, 2, 2, '2021', NULL, '2022-07-27', 'sudah'),
('fdcd89bc-7599-40ab-9550-1ffdb6e092eb', 60, 6, 6, 2, 3, '2021', NULL, '2021-07-04', 'sudah');

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
(2, 'Yufridon Chrisma Luttu', 'admin', '$2y$10$SpqykyMxWvAn6LusbNpp9..6L1GdAciaZui2sXLp8uoEX9HfbVgh.', 'admin', 'aktif'),
(6, 'Yupi Lu', 'pengguna', '$2y$10$F09rzA3EuF4zTpYwLT4/0.ysU5BYPjGiwffvNHpJEhFWRudtNShKy', 'pengguna', 'aktif'),
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
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `barang_pinjam`
--
ALTER TABLE `barang_pinjam`
  MODIFY `id_barang_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `kondisi_terkini`
--
ALTER TABLE `kondisi_terkini`
  MODIFY `id_kondisi_terkini` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT untuk tabel `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  MODIFY `id_jenisbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `master_sumber`
--
ALTER TABLE `master_sumber`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
