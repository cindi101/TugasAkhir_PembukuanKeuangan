<!-- Content-->
<section class="container-fluid">

    <div class="row">
        <div class="col-12">

            <!-- Basic Examples-->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title">Penjualan</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <form id="form-tambah">
                            <div class="form-group">
                                <label for="">Kode Transaksi:</label>
                                <input type="text" name="kode_transaksi" value="<?= session('kode_transaksi') ?>" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Barang</label>
                                <select class="form-control w-100 select2" name="id_barang" placeholder="Masukan kode barang atau nama barang">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Barang</label>
                                <input type="number" min="1" step="1" oninput="validity.valid||(value='');" class="form-control" name="jumlah">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm  btn-tambah"> <i class="fa fa-plus"></i> Tambah
                                </button>
                            </div>
                            <div class="success_message2"></div>
                        </form>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Harga Jual</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($detail_transaksi != '') { ?>
                                <?php $no = 1;
                                $total_harga_untuk_bayar = 0;
                                foreach ($detail_transaksi->getResult() as $r) {
                                    $total_harga_untuk_bayar += $r->total_bayar;
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $r->kode_barang ?></td>
                                        <td><?= $r->nama_barang ?></td>
                                        <td><?= $r->jumlah_barang ?></td>
                                        <td>Rp. <?= number_format(@$r->harga_barang, 0, ',', '.') ?></td>
                                        <td>Rp. <?= number_format(@$r->total_bayar, 0, ',', '.') ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm btn-hapus" data-id="<?= @$r->id_detail_transaksi ?>">Hapus</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" align="right">Total Harga</td>
                                <td colspan="2">
                                    Rp. <?= number_format(@$total_harga_untuk_bayar, 0, ',', '.') ?>
                                    <input type="hidden" class="form-control" name="total_harga_untuk_bayar" id="total_harga_untuk_bayar" value="<?= @$total_harga_untuk_bayar ?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" align="right">Uang</td>
                                <td colspan="2">
                                    <input type="number" min="1" step="1" oninput="validity.valid||(value='');" class="form-control" name="uang" id="uang">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" align="right">Kembalian</td>
                                <td colspan="2">
                                    <div id="kembalian"></div>
                                    <input type="hidden" class="form-control" name="kembalian" id="kembalianval">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <button type="button" class="btn btn-warning btn-sm pull-right btn-checkout"> <i class="fa fa-arrow-right"></i> Checkout</button>
                </div>
            </div>
            <!-- / Basic Examples-->

        </div>


    </div>

    <div class="modal fade" id="modal-hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-hapus" method="POST">
                    <div class="modal-body">
                        <div class="success_message2"></div>
                        <p>Apakah anda yakin akan menghapus data ini?</p>
                        <div class="form-group d-none">
                            <label for="">Nama Jenis Barang:</label>
                            <input type="text" name="id_detail_transaksi" id="id_detail_transaksi_hapus" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-checkout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-checkout" method="POST">
                    <div class="modal-body">
                        <div class="success_message2"></div>
                        <input type="hidden" name="kode_transaksi" value="<?= session('kode_transaksi') ?>">
                        <input type="hidden" name="jumlah_harus_bayar" id="jumlah_harus_bayar2">
                        <input type="hidden" name="uang_yang_bayar" id="uang_yang_bayar2">
                        <input type="hidden" name="kembalian" id="kembalian2">
                        <p>Apakah anda yakin akan checkout data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>