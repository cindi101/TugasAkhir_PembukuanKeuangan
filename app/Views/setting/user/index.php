<!-- Breadcrumbs-->
<!-- <div class="bg-white border-bottom py-3 mb-5">
    <div
        class="container-fluid d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
        <nav class="mb-0" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="./index.html">Setting</a></li>
                <li class="breadcrumb-item active" aria-current="page">Jenis Barang</li>
            </ol>
        </nav> -->
        <!-- <div class="d-flex justify-content-end align-items-center mt-3 mt-md-0">
            <a class="btn btn-sm btn-primary" href="#"><i class="ri-add-circle-line align-bottom"></i> New Project</a>
            <a class="btn btn-sm btn-primary-faded ms-2" href="#"><i class="ri-settings-3-line align-bottom"></i> Settings</a>
            <a class="btn btn-sm btn-secondary-faded ms-2 text-body" href="#"><i class="ri-question-line align-bottom"></i> Help</a>
          </div> -->
    <!-- </div> -->
<!-- </div>  -->
<!-- / Breadcrumbs-->

<!-- Content-->
<section class="container-fluid">

    <!-- Page Title-->
    <!-- <h2 class="fs-4 mb-2">Badge</h2>
            <p class="text-muted mb-4">Small count and labeling component.</p> -->
    <!-- / Page Title-->

    <div class="row">
        <div class="col-12">

            <!-- Basic Examples-->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title">Satuan Barang<button class="btn btn-success btn-sm pull-right btn-tambah"> <i
                                class="fa fa-plus"></i> Tambah</button></h6>

                    <!-- <p class="text-muted m-0 small">Koneksi Database</p> -->
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($user->getResult() as $r){?>
                            <tr>
                                <td><?=$no++?>.</td>
                                <td><?=$r->username?></td>
                                <td><?=$r->nama_lengkap?></td>
                                <td><?=$r->level?></td>
                                <td>
                                    <button class="btn btn-info btn-sm btn-edit" data-id="<?=$r->id_user?>" data-nama="<?=$r->nama_lengkap?>" data-username="<?=$r->username?>" data-level="<?=$r->level?>"> <i class="fa fa-pencil"></i> Edit</button>
                                    <button class="btn btn-danger btn-sm btn-hapus" data-id="<?=$r->id_user?>"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                            <?php }?>
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
                    <label for="">Username:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Nama Lengkap:</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Konfirmasi Password:</label>
                    <input type="password" name="konfirmasi_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Level:</label>
                    <select name="level" id="" class="form-control" required>
                        <option value="">--pilih--</option>
                        <option value="admin gudang">admin gudang</option>
                        <option value="admin toko">admin toko</option>
                    </select>
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
                    <label for="">Username:</label>
                    <input type="text" id="id_user" name="id_user" class="d-none">
                    <input type="text" name="username" id="username" disabled class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Nama Lengkap:</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Password:</label>
                    <input type="password" name="password" class="form-control">
                    <small>*isi hanya jika ingin mengubah password</small>
                </div>
                <div class="form-group">
                    <label for="">Konfirmasi Password:</label>
                    <input type="password" name="konfirmasi_password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Level:</label>
                    <select name="level" id="level" class="form-control" required>
                        <option value="">--pilih--</option>
                        <option value="admin gudang">admin gudang</option>
                        <option value="admin toko">admin toko</option>
                    </select>
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
                    <label for="">Nama satuan Barang:</label>
                    <input type="text" name="id_satuan_barang" id="id_satuan_barang_hapus" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary" >Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>