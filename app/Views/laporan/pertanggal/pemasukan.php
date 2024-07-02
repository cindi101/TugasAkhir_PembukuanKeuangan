<!-- Content-->
<section class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <!-- Basic Examples-->
            <div class="card mt-4" id="contentToPrint">
                <div class="card-header">
                    <h6 class="card-title">Laporan Transaksi <?= TanggalIndo($tanggal) ?></h6>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-success" onclick="fnExcelReport('tabel_laporan');">Excel</button>
                    <a class="btn btn-sm btn-danger" href="<?= base_url('laporan/pertanggal/cetakpdf/' . $tanggal . '/1') ?>">PDF</a>
                    <div>
                        <table class="table table-striped mt-3" id="tabel_laporan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Uang Bayar</th>
                                    <th>Kembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($laporan->getResult() as $r) { ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $r->kode_transaksi ?></td>
                                        <td><?= TanggalIndo($r->tanggal_transaksi) ?></td>
                                        <td>Rp. <?= number_format($r->jumlah_harus_bayar, 0, ',', '.') ?></td>
                                        <td>Rp. <?= number_format($r->uang_yang_bayar, 0, ',', '.') ?></td>
                                        <td>Rp. <?= number_format($r->kembalian, 0, ',', '.') ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- / Basic Examples-->
        </div>
    </div>