-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Nov 2025 pada 06.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_teluknangka`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'desa-teluknangka-web-admin', 'administrator123#$%', 'Administrator Desa Teluk Nangka');

-- --------------------------------------------------------

--
-- Struktur dari tabel `apbdes_rincian`
--

CREATE TABLE `apbdes_rincian` (
  `id` int(11) NOT NULL,
  `kode_akun` varchar(10) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `anggaran_rp` bigint(20) NOT NULL,
  `tipe` enum('PENDAPATAN','BELANJA') NOT NULL,
  `is_total` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `apbdes_rincian`
--

INSERT INTO `apbdes_rincian` (`id`, `kode_akun`, `uraian`, `anggaran_rp`, `tipe`, `is_total`) VALUES
(1, '1', 'PENDAPATAN', 1745870000, 'PENDAPATAN', 1),
(2, '1.1', 'APBD Kabupaten/Kota', 952679000, 'PENDAPATAN', 0),
(3, '1.2', 'Alokasi Dana Desa (ADD)', 793191000, 'PENDAPATAN', 0),
(4, '2', 'BELANJA', 1590289500, 'BELANJA', 1),
(5, '2.1', 'Belanja Publik/Pembangunan', 698772500, 'BELANJA', 0),
(6, '2.2', 'Belanja Aparatur/Pegawai', 891517000, 'BELANJA', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penduduk`
--

CREATE TABLE `data_penduduk` (
  `id` int(11) NOT NULL,
  `uraian_statistik` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `periode_tahun` year(4) NOT NULL,
  `tanggal_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_penduduk`
--

INSERT INTO `data_penduduk` (`id`, `uraian_statistik`, `jumlah`, `satuan`, `periode_tahun`, `tanggal_update`) VALUES
(1, 'Jumlah Penduduk', 3371, 'Jiwa', '2025', '2025-10-28'),
(2, 'Jumlah Laki-laki', 1699, 'Jiwa', '2025', '2025-10-28'),
(3, 'Jumlah Perempuan', 1672, 'Jiwa', '2025', '2025-10-28'),
(4, 'Jumlah Kepala Keluarga', 1024, 'KK', '2025', '2025-10-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_wilayah`
--

CREATE TABLE `data_wilayah` (
  `id` int(11) NOT NULL,
  `tipe_info` enum('BATAS','LUAS') NOT NULL,
  `uraian_wilayah` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_wilayah`
--

INSERT INTO `data_wilayah` (`id`, `tipe_info`, `uraian_wilayah`, `nilai`, `urutan`) VALUES
(1, 'BATAS', 'Sebelah Utara', 'Kampung Baru', 1),
(2, 'BATAS', 'Sebelah Selatan', 'Kubu', 2),
(3, 'BATAS', 'Sebelah Barat', 'Olak-olak Kubu', 3),
(4, 'BATAS', 'Sebelah Timur', 'Terentang', 4),
(5, 'LUAS', 'Luas Wilayah', '2.350 Ha', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri_desa`
--

CREATE TABLE `galeri_desa` (
  `id` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `layout_style` varchar(50) DEFAULT 'setengah'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri_desa`
--

INSERT INTO `galeri_desa` (`id`, `judul`, `tanggal`, `deskripsi`, `gambar`, `dibuat_pada`, `layout_style`) VALUES
(1, 'Penyerahan Mahasiswa KKM UPGRI 2025', '2025-07-23', NULL, 'penyerahan.jpg', '2025-10-28 05:04:00', 'setengah'),
(2, 'Penyerahan Mahasiswa KKM UPGRI 2025', '2025-07-23', NULL, 'kepdes.jpg', '2025-10-28 05:04:00', 'setengah'),
(3, 'Senam Bersama Ibu - Ibu PKK', '2025-07-26', NULL, 'senamibupkk.jpg', '2025-10-28 05:04:00', 'setengah'),
(4, 'Kegiatan Bersih Gereja bersama Mahasiswa KKM UPGRI', '2025-07-26', NULL, 'bersihgereja.jpg', '2025-10-28 05:04:00', 'setengah'),
(5, 'Sosialisasi Pembuatan Kompos blok di Desa Teluk Nangka', '2025-08-02', NULL, 'nanam.jpg', '2025-10-28 05:04:00', 'setengah'),
(6, 'Pesta Panen Raya Desa Teluk Nangka 2025', '2025-08-11', '\"Momen kebersamaan dalam rangkaian bakti sosial dan penanaman pohon yang dihadiri para pejabat daerah serta tokoh masyarakat. Kegiatan ini menjadi bagian dari perayaan HUT Pemda Buburaya, Kodam XII Tanjungpura, Lantamal XII, Adiaksa, Bhayangkara, dan Bakti TNI AU, sebagai wujud sinergi untuk kelestarian lingkungan dan kemajuan desa.\"', 'pestapanen1.jpg', '2025-10-28 05:04:00', 'setengah'),
(7, 'Pesta Panen Raya Desa Teluk Nangka 2025 - Lanjutan', '2025-08-11', NULL, 'pestapanen2.jpg', '2025-10-28 05:04:00', 'setengah'),
(8, 'Pesta Panen Raya Desa Teluk Nangka 2025 - Lanjutan', '2025-08-11', NULL, 'pestapanen3.jpg', '2025-10-28 05:04:00', 'setengah'),
(9, 'Kegiatan Desa Teluk Nangka', '2025-08-11', NULL, '4.jpg', '2025-10-28 05:04:00', 'setengah'),
(10, 'Kegiatan Desa Teluk Nangka', '2025-08-11', NULL, '5.jpg', '2025-10-28 05:04:00', 'setengah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `halaman`
--

CREATE TABLE `halaman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kutipan` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tgl_isi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `halaman`
--

INSERT INTO `halaman` (`id`, `judul`, `kutipan`, `isi`, `tgl_isi`) VALUES
(5, 'Tarot 1', 'namun aku bingung', 'kalian masih disini&nbsp;', '2025-10-22 07:50:25'),
(6, 'Tetap sehat, Tetap semangat', 'Belajar Programming #Dirumah Aja', '<p>Jadilah Gen Z yang membawa perubahan bagi dunia. Selalu menjadi inspirasi bagi orang lain dan buatlah aksi yang nyata.<img src=\"../gambar/bd4c9ab730f5513206b999ec0d90d1fb.jpg\" style=\"width: 735.995px;\"></p>', '2025-10-22 07:48:54'),
(7, 'halo', 'kamu', '<p>kita satuuu</p>', '2025-10-22 07:57:10'),
(8, 'minji', 'mouse', '<p>welcom</p>', '2025-10-22 07:12:32'),
(9, 'mpp', 'sego 78878', '<p>sudo</p>', '2025-10-24 03:59:28'),
(10, 'Tentang Kamu', 'namun aku bingung', '<p>gergerwger</p>', '2025-10-30 05:39:08'),
(11, 'minji', '\"daun\"', '<p>mmmm</p>', '2025-10-30 05:49:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepala_desa`
--

CREATE TABLE `kepala_desa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_asal` varchar(100) DEFAULT NULL,
  `periode` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `program_utama` text DEFAULT NULL,
  `tambahan` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kepala_desa`
--

INSERT INTO `kepala_desa` (`id`, `nama`, `tempat_asal`, `periode`, `foto`, `deskripsi`, `program_utama`, `tambahan`, `dibuat_pada`) VALUES
(1, 'Pardi, S.Pd', 'Teluk Nangka', '2021- 2029', 'kades.png', 'Salah satu fokus utama pemerintahan Desa Teluk Nangka di bawah kepemimpinan Pardi S.Pd adalah upaya pencegahan stunting. Program ini dijalankan secara aktif dengan melibatkan partisipasi masyarakat.', '<ul>\r\n        <li>Pemerintah desa secara rutin membagikan susu untuk ibu hamil dan menyusui.</li>\r\n        <li>Program ini melibatkan kerja sama dengan posyandu, bidan desa, dan pos kesehatan lainnya.</li>\r\n    </ul>', 'Melalui Sekretaris Desa, Niqi Zulkarnaen, M.Sos, Kepala Desa Pardi S.Pd menyatakan bahwa kesehatan ibu dan anak merupakan prioritas utama dan program ini akan terus ditingkatkan.', '2025-10-28 05:05:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `misi`
--

CREATE TABLE `misi` (
  `id_misi` int(11) NOT NULL,
  `id_butir` int(11) NOT NULL,
  `butir_misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `misi`
--

INSERT INTO `misi` (`id_misi`, `id_butir`, `butir_misi`) VALUES
(1, 1, 'Meningkatkan tata kelola pemerintahan yang baik (Good and Clean Governance) berdasarkan demokratisasi, transparansi, penegakan hukum, berkeadilan, kesetaraan gender dan mengutamakan pelayanan kepada masyarakat.'),
(2, 2, 'Meningkatkan pembangunan, pemeliharaan, serta pengelolaan sarana dan prasarana desa berbasis kemampuan lokal desa yang bernuansa religius tanpa diskriminasi.'),
(3, 3, 'Meningkatkan kualitas dan akses pelayanan sosial dasar, berdasarkan kesetaraan gender dan keberpihakan pada kaum marjinal menuju kualitas hidup masyarakat yang lebih baik.'),
(4, 4, 'Meningkatkan pembangunan, pemeliharaan, serta pengelolaan sarana dan prasarana usaha ekonomi desa.'),
(5, 5, 'Meningkatkan pembangunan, pemeliharaan, serta pengelolaan sarana dan prasarana lingkungan hidup desa menuju masyarakat yang siap dan tanggap terhadap bencana.'),
(6, 6, 'Meningkatkan kualitas dan peran kelembagaan desa berbasis partisipasi masyarakat untuk mendukung pembangunan desa.'),
(7, 7, 'Meningkatkan pembangunan sarana dan prasarana tempat ibadah.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perangkat_desa`
--

CREATE TABLE `perangkat_desa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `jabatan` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT 'default.png',
  `urutan` int(11) DEFAULT 0,
  `kategori` enum('Kepala Desa','Sekretariat','Kaur','Kasi','Staf','Kadus') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perangkat_desa`
--

INSERT INTO `perangkat_desa` (`id`, `nama`, `nip`, `jabatan`, `foto`, `urutan`, `kategori`, `created_at`) VALUES
(1, 'PARDI, S.Pd', NULL, 'Kepala Desa', 'kades.png', 1, 'Kepala Desa', '2025-10-28 05:10:11'),
(2, 'NIQI ZULKARNAIN, S.Sos', NULL, 'Sekretaris Desa', 'niqi.png', 2, 'Sekretariat', '2025-10-28 05:10:11'),
(3, 'YOGY TRY PRAYOGO', NULL, 'Kaur Umum', 'yogy.png', 3, 'Kaur', '2025-10-28 05:10:11'),
(4, 'EKA WIDIASTUTI, SE', NULL, 'Kaur Keuangan', 'eka.png', 4, 'Kaur', '2025-10-28 05:10:11'),
(5, 'ANDREAS RISWANTO', NULL, 'Kaur Perencanaan', 'andreas.png', 5, 'Kaur', '2025-10-28 05:10:11'),
(6, 'PARDI', NULL, 'Kasi Pemerintahan', 'pardi.png', 6, 'Kasi', '2025-10-28 05:10:11'),
(7, 'ROBITO', NULL, 'Kasi Pelayanan', 'robito.png', 7, 'Kasi', '2025-10-28 05:10:11'),
(8, 'SITI AMINAH', NULL, 'Kasi Kesejahteraan', 'siti.png', 8, 'Kasi', '2025-10-28 05:10:11'),
(9, 'SELLY ANGGRAINI', NULL, 'Staf Kasi & Kaur', 'selly.png', 9, 'Staf', '2025-10-28 05:10:11'),
(10, 'HERIANTO', NULL, 'Kadus Sidodadi', 'heri.png', 10, 'Kadus', '2025-10-28 05:10:11'),
(11, 'GILANG LENGKORO', NULL, 'Kadus Wanareja', 'gilang.png', 11, 'Kadus', '2025-10-28 05:10:11'),
(12, 'FIJANAT ALIADIN', NULL, 'Kadus Mulya Asri', 'fijanat.png', 12, 'Kadus', '2025-10-28 05:10:11'),
(13, 'JOS SUDARSO', NULL, 'Kadus Sida Mulya', 'jos.png', 13, 'Kadus', '2025-10-28 05:10:11'),
(14, 'ERVAN NURPRIANTO', NULL, 'Kadus Suka Mulya', 'kadussukamulya.png', 14, 'Kadus', '2025-10-28 05:10:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visi`
--

CREATE TABLE `visi` (
  `id_visi` int(11) NOT NULL,
  `id_butir` varchar(11) NOT NULL,
  `butir_visi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `visi`
--

INSERT INTO `visi` (`id_visi`, `id_butir`, `butir_visi`) VALUES
(1, 'a) ', 'Desa yang Mandiri mengandung pengertian bahwa Desa Teluk Nangka mampu mewujudkan kehidupan yang sejajar dan sederajat dengan masyarakat desa lain yang lebih maju dengan pemenuhan sarana dan prasarana dasar masyarakat mengandalkan pada kemampuan dan kekuatan sendiri yang berbasis pada keunggulan lokal dengan pemanfaatan sumber daya yang dimiliki.'),
(2, 'b)', 'Berkarakter mengandung pengertian bahwa Desa Teluk Nangka berorientasi pada proses untuk mencapai keberhasilan dalam membangun kehidupan bermasyarakat dan pelaksanaan pembangunan yang menyeluruh.'),
(3, 'c)', 'Berbudaya mengandung pengertian bahwa Desa Teluk Nangka dalam kehidupan bermasyarakat menjunjung norma-norma, tata aturan, dan adat istiadat yang berbudi pekerti luhur.'),
(4, 'd)', 'Sehat mengandung pengertian bahwa Desa Teluk Nangka memiliki ketangguhan jiwa dan raga yang sehat dan kuat.'),
(5, 'e)', 'Cerdas memiliki makna bahwa masyarakat Desa Teluk Nangka mampu beradaptasi dengan perkembangan zaman, menguasai ilmu pengetahuan dan teknologi (IPTEK) serta mampu memanfaatkannya secara cepat dan tepat, guna mengatasi setiap permasalahan pembangunan pada khususnya dan permasalahan kehidupan pada umumnya.'),
(6, 'f)', 'Sejahtera mengandung arti bahwa mengupayakan agar tercapai ketercukupan kebutuhan masyarakat secara lahir dan batin (sandang, pangan, papan, agama, pendidikan, kesehatan, rasa aman dan tentram).'),
(7, 'g)', 'Religius mengandung arti bahwa masyarakat Desa Teluk Nangka memiliki ketaatan dan keyakinan kepada Tuhan Yang Maha Esa, serta mengaplikasikan nilai-nilai kebaikan dalam kehidupan bermasyarakat.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `apbdes_rincian`
--
ALTER TABLE `apbdes_rincian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_penduduk`
--
ALTER TABLE `data_penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_wilayah`
--
ALTER TABLE `data_wilayah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri_desa`
--
ALTER TABLE `galeri_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `halaman`
--
ALTER TABLE `halaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kepala_desa`
--
ALTER TABLE `kepala_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `misi`
--
ALTER TABLE `misi`
  ADD PRIMARY KEY (`id_misi`);

--
-- Indeks untuk tabel `perangkat_desa`
--
ALTER TABLE `perangkat_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `visi`
--
ALTER TABLE `visi`
  ADD PRIMARY KEY (`id_visi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `apbdes_rincian`
--
ALTER TABLE `apbdes_rincian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_penduduk`
--
ALTER TABLE `data_penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_wilayah`
--
ALTER TABLE `data_wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `galeri_desa`
--
ALTER TABLE `galeri_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `halaman`
--
ALTER TABLE `halaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kepala_desa`
--
ALTER TABLE `kepala_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `misi`
--
ALTER TABLE `misi`
  MODIFY `id_misi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `perangkat_desa`
--
ALTER TABLE `perangkat_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `visi`
--
ALTER TABLE `visi`
  MODIFY `id_visi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
