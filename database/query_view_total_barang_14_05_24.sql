CREATE VIEW view_total_barang as
    select `tb_barang`.`id_barang` AS `id_barang`,
            `tb_barang`.`foto` AS `foto`,
            `tb_barang`.`kode_barang` AS `kode_barang`,
            `tb_barang`.`nama_barang` AS `nama_barang`,
            `tb_barang`.`id_jenis_barang` AS `id_jenis_barang`,
            `tb_barang`.`id_kategori_barang` AS `id_kategori_barang`,
            `tb_barang`.`harga_jual` AS `harga_jual`,
            `tb_barang`.`id_satuan_barang` AS `id_satuan_barang`,
                (select sum(`tb_stok_barang`.`jumlah`) from `tb_stok_barang` 
                    where (`tb_stok_barang`.`id_barang` = `tb_barang`.`id_barang`)) AS `total_stok`,
                (select sum(`tb_detail_transaksi`.`jumlah_barang`) from 
                    (`tb_detail_transaksi` join `tb_transaksi` on(
                        (`tb_transaksi`.`id_transaksi` = `tb_detail_transaksi`.`id_transaksi`)
                    )) where (
                            (`tb_transaksi`.`status_transaksi` = 'sukses') and 
                            (`tb_detail_transaksi`.`id_barang` = `tb_barang`.`id_barang`)
                    )) AS `stok_terpakai` from `tb_barang`;