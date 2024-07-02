<!-- Footer -->
<footer class="  footer">
  <p class="small text-muted m-0">© Copyright 2023 By Dina Cindi Pangestu. All Rights Reserved</p>
  <p class="small text-muted m-0">Template Created by <a href="https://www.pixelrocket.store/">Pixel Rocket.</a></p>
</footer>


<!-- Sidebar Menu Overlay-->
<div class="menu-overlay-bg"></div>
<!-- / Sidebar Menu Overlay-->

</section>
<!-- / Content-->

<?php
$db = db_connect();
$builder = $db->table('view_total_barang');
$builder->where(array('(total_stok - stok_terpakai) <= ' => 5));
// $builder = $db->query("select kode_barang, nama_barang, total_stok, stok_terpakai, (total_stok - stok_terpakai) as stok_sisa from view_total_barang where (total_stok - stok_terpakai) <= 50");        
$sisa = $builder->get();

$builder = $db->table('tb_barang');
$builder->join('tb_stok_barang', 'tb_stok_barang.id_barang = tb_barang.id_barang', 'left');
$builder->where(array('tb_stok_barang.tanggal_expired >=' => date('Y-m-d')));
$builder->where(array('tb_stok_barang.tanggal_expired <=' => date('Y-m-d', strtotime('+6 day'))));
// $builder = $db->query("select kode_barang, nama_barang, total_stok, stok_terpakai, (total_stok - stok_terpakai) as stok_sisa from view_total_barang where (total_stok - stok_terpakai) <= 50");        
$exp = $builder->get();
?>

<?php if ($sisa->getNumRows() > 0) { ?>
  <div class="modal fade" id="modal-pengingat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pengingat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger">Tabel ini menampilkan data barang yang stok nya akan segera habis dan atau akan kedaluarsa</div>
          <?php if ($sisa->getNumRows() > 0) { ?>
            <div class="alert alert-warning">Data barang yang stok nya akan segera habis</div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Total Stok</th>
                  <th>Stok Terpakai</th>
                  <th>Stok Sisa</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($sisa->getResult() as $r_sisa) { ?>
                  <tr>
                    <td><?= $r_sisa->kode_barang ?></td>
                    <td><?= $r_sisa->nama_barang ?></td>
                    <td><?= $r_sisa->total_stok ?></td>
                    <td><?= $r_sisa->stok_terpakai ?></td>
                    <td><?= $r_sisa->total_stok - $r_sisa->stok_terpakai ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          <?php } ?>
          <br>
          <?php if ($exp->getNumRows() > 0) { ?>
            <div class="alert alert-warning">Data barang yang akan kedaluarsa</div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Tanggal Kedaluarsa (Expired)</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($exp->getResult() as $r_exp) { ?>
                  <tr>
                    <td><?= $r_exp->kode_barang ?></td>
                    <td><?= $r_exp->nama_barang ?></td>
                    <td><?= $r_exp->tanggal_expired ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

</main>
<!-- /Page Content -->

<!-- Theme JS -->
<!-- Vendor JS -->
<script src="<?= base_url() ?>/assets/apollo_template/assets/js/vendor.bundle.js"></script>

<!-- Theme JS -->
<script src="<?= base_url() ?>/assets/apollo_template/assets/js/theme.bundle.js"></script>

<?php
if (!empty($script)) {
  echo view($script);
} ?>

<?php if ($sisa->getNumRows() > 0 || $exp->getNumRows() > 0) { ?>
  <script>
    $(document).ready(function() {
      $('#modal-pengingat').modal('show');
    });
  </script>
<?php } ?>
</body>

</html>