<!-- Content-->
<section class="container-fluid">
    <div class="row">
        <div class="col-12">

            <!-- Basic Examples-->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title">Data Barang<button class="btn btn-success btn-sm pull-right btn-tambah"> <i class="fa fa-plus"></i> Tambah</button></h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
                                <th>Satuan</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Terpakai</th>
                                <th>Tersedia</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($barang->getResult() as $r) { ?>
                                <tr>
                                    <td><?= $no++ ?>.</td>
                                    <td><img src="<?= base_url() ?>upload/<?= $r->foto ?>" class="img-fluid img-thumbnail" /></td>
                                    <td><?= $r->kode_barang ?></td>
                                    <td><?= $r->nama_barang ?></td>
                                    <td><?= $r->nama_kategori_barang ?></td>
                                    <td><?= $r->nama_jenis_barang ?></td>
                                    <td><?= $r->nama_satuan_barang ?></td>
                                    <td>Rp. <?= number_format($r->harga_jual, 0, ',', '.') ?> </td>
                                    <td><?= $r->total_stok !== NULL ? $r->total_stok : 0 ?> </td>
                                    <td><?= $r->stok_terpakai !== NULL ? $r->stok_terpakai : 0 ?> </td>
                                    <td><?= $r->total_stok - $r->stok_terpakai ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>data/stok_barang/index/<?= $r->kode_barang ?>" class="btn btn-warning btn-sm"> <i class="fa fa-eye"></i> Stok</a>
                                        <button class="btn btn-info btn-sm btn-edit" data-id="<?= $r->id_barang ?>"> <i class="fa fa-pencil"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm btn-hapus" data-id="<?= $r->id_barang ?>"><i class="fa fa-trash"></i> Hapus</button>
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
                        <div class="success_message2"></div>
                        <div class="form-group">
                            <label for="">Kode Barang:</label>
                            <input type="text" name="kode_barang" class="form-control" value="<?= $kodebarang ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Barang:</label>
                            <input type="text" name="nama_barang" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Barang:</label>
                            <select name="id_jenis_barang" class="form-control" required>
                                <option value="">--pilih--</option>
                                <?php foreach ($jenis_barang->getResult() as $r_jenis_barang) { ?>
                                    <option value="<?= $r_jenis_barang->id_jenis_barang ?>"><?= $r_jenis_barang->nama_jenis_barang ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori Barang:</label>
                            <select name="id_kategori_barang" class="form-control" required>
                                <option value="">--pilih--</option>
                                <?php foreach ($kategori_barang->getResult() as $r_kategori_barang) { ?>
                                    <option value="<?= $r_kategori_barang->id_kategori_barang ?>"><?= $r_kategori_barang->nama_kategori_barang ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Satuan Barang:</label>
                            <select name="id_satuan_barang" class="form-control" required>
                                <option value="">--pilih--</option>
                                <?php foreach ($satuan_barang->getResult() as $r_satuan_barang) { ?>
                                    <option value="<?= $r_satuan_barang->id_satuan_barang ?>"><?= $r_satuan_barang->nama_satuan_barang ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Harga Jual:</label>
                            <input type="number" min="1" step="1" oninput="validity.valid||(value='');" name="harga_jual" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Foto Barang</label>
                            <input type="file" name="foto" id="foto" class="form-control" required>
                        </div>

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
                        <div class="success_message2"></div>
                        <div class="form-group">
                            <label for="">Kode Barang:</label>
                            <input type="hidden" name="id_barang" id="id_barang" required>
                            <input type="text" name="kode_barang" id="kode_barang" class="form-control" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Barang:</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Barang:</label>
                            <select name="id_jenis_barang" id="id_jenis_barang" class="form-control" required>
                                <option value="">--pilih--</option>
                                <?php foreach ($jenis_barang->getResult() as $r_jenis_barang) { ?>
                                    <option value="<?= $r_jenis_barang->id_jenis_barang ?>"><?= $r_jenis_barang->nama_jenis_barang ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori Barang:</label>
                            <select name="id_kategori_barang" id="id_kategori_barang" class="form-control" required>
                                <option value="">--pilih--</option>
                                <?php foreach ($kategori_barang->getResult() as $r_kategori_barang) { ?>
                                    <option value="<?= $r_kategori_barang->id_kategori_barang ?>"><?= $r_kategori_barang->nama_kategori_barang ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Satuan Barang:</label>
                            <select name="id_satuan_barang" id="id_satuan_barang" class="form-control" required>
                                <option value="">--pilih--</option>
                                <?php foreach ($satuan_barang->getResult() as $r_satuan_barang) { ?>
                                    <option value="<?= $r_satuan_barang->id_satuan_barang ?>"><?= $r_satuan_barang->nama_satuan_barang ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Harga Jual:</label>
                            <input type="number" min="1" step="1" oninput="validity.valid||(value='');" name="harga_jual" id="harga_jual" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Foto Barang</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                        </div>
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
                            <input type="text" name="id_barang" id="id_barang_hapus" class="form-control">
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