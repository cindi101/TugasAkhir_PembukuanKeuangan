<!-- Content-->
<section class="container-fluid">

    <div class="row">
        <div class="col-12">

            <!-- Basic Examples-->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title">
                        Data Barang
                        <a href="<?= base_url('data/barang') ?>" class="btn btn-warning btn-sm pull-right">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Kode Barang</td>
                            <td>: <?= $barang->getRow()->kode_barang ?></td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td>: <?= $barang->getRow()->nama_barang ?></td>
                        </tr>
                        <tr>
                            <td>Kategori Barang</td>
                            <td>: <?= $barang->getRow()->nama_kategori_barang ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Barang</td>
                            <td>: <?= $barang->getRow()->nama_jenis_barang ?></td>
                        </tr>
                        <tr>
                            <td>Satuan Barang</td>
                            <td>: <?= $barang->getRow()->nama_satuan_barang ?></td>
                        </tr>
                        <tr>
                            <td>Harga Jual</td>
                            <td>: Rp. <?= number_format($barang->getRow()->harga_jual, 0, ',', '.') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- / Basic Examples-->

        </div>


    </div>

    <div class="row">
        <div class="col-12">

            <!-- Basic Examples-->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title">
                        Stok Barang
                        <button class="btn btn-success btn-sm pull-right btn-tambah">
                            <i class="fa fa-plus"></i> Tambah
                        </button>
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Produksi</th>
                                <th>Tanggal Expired</th>
                                <th>Jumlah</th>
                                <th>Modal</th>
                                <th>Modal Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($stok_barang->getResult() as $r) { ?>
                                <tr>
                                    <td><?= $no++ ?>.</td>
                                    <td><?= TanggalIndo($r->tanggal_masuk) ?></td>
                                    <td><?= TanggalIndo($r->tanggal_produksi) ?></td>
                                    <td><?= TanggalIndo($r->tanggal_expired) ?></td>
                                    <td><?= $r->jumlah ?> <?= $barang->getRow()->nama_satuan_barang ?></td>
                                    <td>Rp. <?= number_format($r->modal, 0, ',', '.') ?></td>
                                    <td>Rp. <?= number_format($r->modal_total, 0, ',', '.') ?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm btn-edit" data-id="<?= $r->id_stok_barang ?>"> <i class="fa fa-pencil"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm btn-hapus" data-id="<?= $r->id_stok_barang ?>"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- / Basic Examples-->

        </div>


    </div>

    <div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-tambah" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Kode Barang:</label>
                            <input type="hidden" name="id_barang" class="form-control" value="<?= $barang->getRow()->id_barang ?>" required readonly>
                            <input type="text" name="kode_barang" class="form-control" value="<?= $barang->getRow()->kode_barang ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Barang:</label>
                            <input type="text" name="nama_barang" value="<?= $barang->getRow()->nama_barang ?>" class="form-control" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Masuk:</label>
                            <input type="date" name="tanggal_masuk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Produksi:</label>
                            <input type="date" name="tanggal_produksi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Expired:</label>
                            <input type="date" name="tanggal_expired" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah dalam (<?= $barang->getRow()->nama_satuan_barang ?>):</label>
                            <input type="number" name="jumlah" class="form-control jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="">Modal per (<?= $barang->getRow()->nama_satuan_barang ?>):</label>
                            <input type="number" name="modal" class="form-control modal2" required>
                        </div>
                        <div class="form-group">
                            <label for="">Modal Total:</label>
                            <input type="number" name="modal_total" class="form-control modal_total2" required>
                        </div>
                        <div class="success_message2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit" method="POST">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Kode Barang:</label>
                            <input type="hidden" name="id_stok_barang" id="id_stok_barang" class="form-control" required readonly>
                            <input type="hidden" name="id_barang" class="form-control" value="<?= $barang->getRow()->id_barang ?>" required readonly>
                            <input type="text" name="kode_barang" class="form-control" value="<?= $barang->getRow()->kode_barang ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Barang:</label>
                            <input type="text" name="nama_barang" value="<?= $barang->getRow()->nama_barang ?>" class="form-control" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Masuk:</label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Produksi:</label>
                            <input type="date" name="tanggal_produksi" id="tanggal_produksi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Expired:</label>
                            <input type="date" name="tanggal_expired" id="tanggal_expired" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah dalam (<?= $barang->getRow()->nama_satuan_barang ?>):</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control jumlah1" required>
                        </div>
                        <div class="form-group">
                            <label for="">Modal per (<?= $barang->getRow()->nama_satuan_barang ?>):</label>
                            <input type="number" name="modal" id="modal1" class="form-control modal1" required>
                        </div>
                        <div class="form-group">
                            <label for="">Modal Total:</label>
                            <input type="number" name="modal_total" id="modal_total" class="form-control modal_total" required>
                        </div>
                        <div class="success_message2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
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
                            <input type="text" name="id_stok_barang" id="id_stok_barang_hapus" class="form-control">
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