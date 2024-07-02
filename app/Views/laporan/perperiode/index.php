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
                    <form action="<?= base_url() ?>laporan/perperiode/pengeluaran" method="POST">
                        <div class="form-group">
                            <label for="">Dari</label>
                            <input type="date" name="dari_pengeluaran" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Sampai</label>
                            <input type="date" name="sampai_pengeluaran" class="form-control" required>
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
                    <form action="<?= base_url() ?>laporan/perperiode/pemasukan" method="POST">
                        <div class="form-group">
                            <label for="">Dari</label>
                            <input type="date" name="dari_pemasukan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Sampai</label>
                            <input type="date" name="sampai_pemasukan" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                    </form>
                </div>
            </div>
            <!-- / Basic Examples-->

        </div>


    </div>