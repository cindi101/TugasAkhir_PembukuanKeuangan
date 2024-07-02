<!-- Content-->
<section class="container-fluid">

    <div class="row">
        <div class="col-md-6 col-sm-12">

            <!-- Basic Examples-->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title">Laporan Pengeluaran</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url() ?>laporan/pertanggal/pengeluaran" method="POST">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal_pengeluaran" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                    </form>
                </div>
            </div>
            <!-- / Basic Examples-->

        </div>

        <div class="col-md-6 col-sm-12">

            <!-- Basic Examples-->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title">Laporan Pemasukan</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url() ?>laporan/pertanggal/pemasukan" method="POST">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal_pemasukan" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                    </form>
                </div>
            </div>
            <!-- / Basic Examples-->

        </div>


    </div>