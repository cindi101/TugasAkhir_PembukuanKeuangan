<!-- Content-->
<section class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <!-- Basic Examples-->
            <div class="card mt-4" id="contentToPrint">
                <div class="card-header">
                    <h6 class="card-title">Laporan Pengeluaran <?= TanggalIndo($tanggal) ?></h6>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-success" onclick="fnExcelReport('tabel_laporan');">Excel</button>
                    <a class="btn btn-sm btn-danger" href="<?= base_url('laporan/pertanggal/cetakpdf/' . $tanggal . '/0') ?>">PDF</a>
                    <div>
                        <table class="table table-striped mt-3" id="tabel_laporan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pengeluaran</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($laporan->getResult() as $r) { ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= TanggalIndo($r->tanggal_pengeluaran) ?></td>
                                        <td><?= $r->nama_pengeluaran ?></td>
                                        <td>Rp. <?= number_format($r->biaya_pengeluaran, 0, ',', '.') ?></td>

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