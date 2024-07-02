-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tb_barang`;
CREATE TABLE `tb_barang` (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_jenis_barang` int NOT NULL,
  `id_kategori_barang` int NOT NULL,
  `harga_jual` int NOT NULL,
  `id_satuan_barang` int NOT NULL,
  `foto` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `tb_barang` (`id_barang`, `kode_barang`, `nama_barang`, `id_jenis_barang`, `id_kategori_barang`, `harga_jual`, `id_satuan_barang`, `foto`) VALUES
(3,	'BRG0001',	'Keripik Pisang Cokelat Panjang',	1,	1,	15000,	1,	'1711686643_361a6a2b0e5ed94f0a93.jpg'),
(4,	'BRG0002',	'Keripik Pisang Cokelat Gerigi',	1,	1,	15000,	1,	'1711686678_a3fe55a664927d30b07d.jpg'),
(5,	'BRG0003',	'Keripik Pisang Keju Panjang',	1,	1,	15000,	1,	'1711686724_29a7d816d73f98492dbc.jpg'),
(6,	'BRG0004',	'Keripik Pisang Keju Gerigi',	1,	1,	15000,	1,	'1711686759_bb2ed44511804a686e19.jpg'),
(7,	'BRG0005',	'Keripik Pisang Strawberry',	1,	1,	15000,	1,	'1711686812_f5402f1f080002179e0c.jpg'),
(8,	'BRG0006',	'Keripik Pisang Moka',	1,	1,	15000,	1,	'1711687217_724750b24fccbdaa1a96.jpg'),
(9,	'BRG0007',	'Keripik Pisang Durian',	1,	1,	15000,	1,	'1711687283_abc5bc42adddba3ac2c5.jpg'),
(10,	'BRG0008',	'Keripik Pisang Jagung Bakar',	1,	1,	15000,	1,	'1711687392_dd6bce2aefefa59ecffc.jpg'),
(11,	'BRG0009',	'Keripik Singkong',	1,	1,	15000,	1,	'1711687469_8ce47b2bc5e4b835bae5.jpg'),
(12,	'BRG0010',	'Keripik Nangka',	1,	1,	15000,	1,	'1711687650_b39bc024f36a0f03e123.webp'),
(13,	'BRG0011',	'Kopi Cap Jempol',	2,	2,	15000,	1,	'1711687903_01655257e2a260cc5d13.jpg'),
(14,	'BRG0012',	'Kopi 49 Lanang',	2,	2,	45000,	1,	'1711687974_c1d7e1b800e06cc3528d.jpg'),
(15,	'BRG0013',	'Kopi 49 Robusta',	2,	2,	30000,	1,	'1711688088_ea99a3f9127c4886582b.jpg'),
(16,	'BRG0014',	'Kemplang AN',	3,	2,	15000,	1,	'1711688158_853fd1a3c6f284c35c74.jpg'),
(17,	'BRG0015',	'Kemplang Sela',	3,	2,	20000,	1,	'1711688475_ac2d74ec2de2b3124d4c.jpg'),
(18,	'BRG0016',	'Kemplang Timy',	3,	2,	20000,	1,	'1711688775_1a76bcfdb4d68d28379e.jpg'),
(19,	'BRG0017',	'Ante',	1,	2,	15000,	1,	'1711689038_5a30424c8243c629747b.jpg'),
(20,	'BRG0018',	'Keripik Kulit Ikan',	1,	2,	20000,	1,	'1711978276_74d4f4a5f52ef73de192.jpg'),
(21,	'BRG0019',	'Keripik Talas',	1,	1,	15000,	1,	'1714709623_5cd5cd2ddb505ebe12a0.jpg');

DROP TABLE IF EXISTS `tb_detail_transaksi`;
CREATE TABLE `tb_detail_transaksi` (
  `id_detail_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `id_barang` int NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `jumlah_barang` int NOT NULL,
  `harga_barang` int NOT NULL,
  `total_bayar` int NOT NULL,
  PRIMARY KEY (`id_detail_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `tb_detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_barang`, `nama_barang`, `jumlah_barang`, `harga_barang`, `total_bayar`) VALUES
(1,	1,	1,	'Keripik Pisang',	10,	25000,	250000),
(2,	1,	2,	'Keriping Singkong',	5,	45000,	225000),
(3,	2,	2,	'Keriping Singkong',	5,	45000,	225000),
(4,	3,	4,	'Keripik Pisang Cokelat Gerigi',	8,	15000,	120000),
(5,	4,	6,	'Keripik Pisang Keju Gerigi',	1,	15000,	15000),
(8,	5,	11,	'Keripik Singkong',	2,	15000,	30000),
(9,	5,	3,	'Keripik Pisang Cokelat Panjang',	1,	15000,	15000),
(10,	5,	20,	'Keripik Kulit Ikan',	1,	20000,	20000),
(14,	7,	21,	'Keripik Talas',	10,	15000,	150000),
(15,	8,	7,	'Keripik Pisang Strawberry',	15,	15000,	225000);

DROP TABLE IF EXISTS `tb_jenis_barang`;
CREATE TABLE `tb_jenis_barang` (
  `id_jenis_barang` int NOT NULL AUTO_INCREMENT,
  `nama_jenis_barang` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_jenis_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `tb_jenis_barang` (`id_jenis_barang`, `nama_jenis_barang`) VALUES
(1,	'Keripik'),
(2,	'Kopi'),
(3,	'Kemplang'),
(4,	'Kelanting'),
(5,	'Kerupuk');

DROP TABLE IF EXISTS `tb_kategori_barang`;
CREATE TABLE `tb_kategori_barang` (
  `id_kategori_barang` int NOT NULL AUTO_INCREMENT,
  `nama_kategori_barang` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kategori_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `tb_kategori_barang` (`id_kategori_barang`, `nama_kategori_barang`) VALUES
(1,	'Produksi Sendiri'),
(2,	'Titipan');

DROP TABLE IF EXISTS `tb_pemasukan`;
CREATE TABLE `tb_pemasukan` (
  `id_pemasukan` int NOT NULL AUTO_INCREMENT,
  `tanggal_pemasukan` date NOT NULL,
  `biaya_pemasukan` int NOT NULL,
  `modal_pemasukan` int NOT NULL,
  PRIMARY KEY (`id_pemasukan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `tb_pengeluaran`;
CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int NOT NULL AUTO_INCREMENT,
  `tanggal_pengeluaran` date NOT NULL,
  `biaya_pengeluaran` int NOT NULL,
  `nama_pengeluaran` text COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_pengeluaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `tanggal_pengeluaran`, `biaya_pengeluaran`, `nama_pengeluaran`) VALUES
(3,	'2024-04-01',	10000,	'Es jeruk'),
(4,	'2024-04-01',	52000,	'Token listrik');

DROP TABLE IF EXISTS `tb_penjualan`;
CREATE TABLE `tb_penjualan` (
  `id_penjualan` int NOT NULL AUTO_INCREMENT,
  `kode_penjualan` int NOT NULL,
  `id_barang` int NOT NULL,
  `id_user` int NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `harga_penjualan` int NOT NULL,
  `jumlah_penjualan` int NOT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `tb_satuan_barang`;
CREATE TABLE `tb_satuan_barang` (
  `id_satuan_barang` int NOT NULL AUTO_INCREMENT,
  `nama_satuan_barang` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_satuan_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `tb_satuan_barang` (`id_satuan_barang`, `nama_satuan_barang`) VALUES
(1,	'Pcs'),
(2,	'Kg'),
(3,	'Liter'),
(4,	'Karung'),
(5,	'Sisir'),
(6,	'Bungkus');

DROP TABLE IF EXISTS `tb_stok_barang`;
CREATE TABLE `tb_stok_barang` (
  `id_stok_barang` int NOT NULL AUTO_INCREMENT,
  `id_barang` int NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `tanggal_expired` date NOT NULL,
  `jumlah` int NOT NULL,
  `modal` int NOT NULL,
  `modal_total` int NOT NULL,
  PRIMARY KEY (`id_stok_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `tb_stok_barang` (`id_stok_barang`, `id_barang`, `tanggal_masuk`, `tanggal_produksi`, `tanggal_expired`, `jumlah`, `modal`, `modal_total`) VALUES
(1,	1,	'2023-05-21',	'2023-05-01',	'2023-05-31',	30,	17500,	525000),
(2,	1,	'2023-05-21',	'2023-05-05',	'2023-05-31',	150,	17500,	2625000),
(3,	2,	'2023-05-21',	'2023-05-21',	'2023-06-30',	150,	35000,	5250000),
(4,	3,	'2024-04-01',	'2024-04-01',	'2024-06-01',	56,	10000,	560000),
(5,	4,	'2024-04-01',	'2024-04-01',	'2024-06-01',	92,	10000,	920000),
(6,	5,	'2024-03-25',	'2024-03-25',	'2024-05-25',	50,	10000,	500000),
(7,	6,	'2024-03-25',	'2024-03-25',	'2024-05-25',	25,	10000,	250000),
(8,	7,	'2024-03-25',	'2024-03-25',	'2024-05-25',	15,	10000,	150000),
(9,	8,	'2024-03-25',	'2024-03-25',	'2024-05-25',	15,	10000,	150000),
(10,	9,	'2024-03-25',	'2024-03-25',	'2024-05-25',	15,	10000,	150000),
(11,	10,	'2024-03-25',	'2024-03-25',	'2024-05-25',	15,	10000,	150000),
(12,	11,	'2024-02-19',	'2024-02-18',	'2024-05-18',	20,	12500,	250000),
(13,	12,	'2024-02-21',	'2024-02-20',	'2024-05-20',	50,	15000,	750000),
(14,	20,	'2024-02-20',	'2024-02-15',	'2024-07-15',	30,	15000,	450000),
(15,	21,	'2024-05-03',	'2024-05-01',	'2024-05-10',	15,	8000,	120000),
(16,	4,	'2024-05-03',	'2024-05-04',	'2024-05-17',	50,	10000,	500000),
(17,	6,	'2024-05-03',	'2024-05-10',	'2024-05-24',	50,	10000,	500000);

DROP TABLE IF EXISTS `tb_transaksi`;
CREATE TABLE `tb_transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status_transaksi` enum('draft','sukses') COLLATE utf8mb3_unicode_ci NOT NULL,
  `jumlah_harus_bayar` int NOT NULL,
  `uang_yang_bayar` int NOT NULL,
  `kembalian` int NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `kode_transaksi`, `status_transaksi`, `jumlah_harus_bayar`, `uang_yang_bayar`, `kembalian`, `tanggal_transaksi`) VALUES
(1,	2,	'trx-5090865420230521082353',	'sukses',	475000,	500000,	25000,	'2023-05-21 08:26:52'),
(2,	2,	'trx-8786302220230612144219',	'sukses',	225000,	250000,	25000,	'2023-06-12 14:42:45'),
(3,	2,	'trx-4215775220240401125857',	'sukses',	120000,	120000,	0,	'2024-04-01 13:33:23'),
(4,	2,	'trx-1732726920240401133339',	'sukses',	15000,	15000,	0,	'2024-04-01 13:34:02'),
(5,	2,	'trx-1377542020240401133412',	'sukses',	65000,	100000,	35000,	'2024-04-01 13:45:09'),
(6,	2,	'trx-8846494720240401134743',	'draft',	0,	0,	0,	'2024-04-01 13:52:17'),
(7,	2,	'trx-6571766220240503042259',	'sukses',	150000,	100000,	-50000,	'2024-05-03 04:23:33'),
(8,	2,	'trx-4251706020240503042401',	'sukses',	225000,	300000,	75000,	'2024-05-03 04:31:52');

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `level` enum('admin gudang','admin toko') COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_lengkap`, `level`) VALUES
(1,	'admingudang',	'$2y$10$P4qSkuE5eTveEQ8J59QWxOtZ5G077Se275NBf/Ki988cwB2mqrSDi',	'Admin Gudang',	'admin gudang'),
(2,	'admintoko',	'$2y$10$z9K49f64CyE86xocS2ecKOGhvGHqXkWjo1XSUqbCmYzUD8KFFOXDS',	'Admin Toko',	'admin toko');

DROP VIEW IF EXISTS `view_total_barang`;
CREATE TABLE `view_total_barang` (`id_barang` int, `foto` varchar(255), `kode_barang` varchar(255), `nama_barang` varchar(255), `id_jenis_barang` int, `id_kategori_barang` int, `harga_jual` int, `id_satuan_barang` int, `total_stok` decimal(32,0), `stok_terpakai` decimal(32,0));


DROP TABLE IF EXISTS `view_total_barang`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_total_barang` AS select `tb_barang`.`id_barang` AS `id_barang`,`tb_barang`.`foto` AS `foto`,`tb_barang`.`kode_barang` AS `kode_barang`,`tb_barang`.`nama_barang` AS `nama_barang`,`tb_barang`.`id_jenis_barang` AS `id_jenis_barang`,`tb_barang`.`id_kategori_barang` AS `id_kategori_barang`,`tb_barang`.`harga_jual` AS `harga_jual`,`tb_barang`.`id_satuan_barang` AS `id_satuan_barang`,(select sum(`tb_stok_barang`.`jumlah`) from `tb_stok_barang` where (`tb_stok_barang`.`id_barang` = `tb_barang`.`id_barang`)) AS `total_stok`,(select sum(`tb_detail_transaksi`.`jumlah_barang`) from (`tb_detail_transaksi` join `tb_transaksi` on((`tb_transaksi`.`id_transaksi` = `tb_detail_transaksi`.`id_transaksi`))) where ((`tb_transaksi`.`status_transaksi` = 'sukses') and (`tb_detail_transaksi`.`id_barang` = `tb_barang`.`id_barang`))) AS `stok_terpakai` from `tb_barang`;

-- 2024-05-14 03:50:09