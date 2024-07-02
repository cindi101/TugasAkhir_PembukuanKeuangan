<?php
use App\Models\Pengeluaran;
use App\Models\Transaksi;
$transaksiModel = new Transaksi();
$transaksi = $transaksiModel->findAll();
// $transaksi = $transaksiModel->orderBy('id_transaksi', 'DESC')->limit(7)->findAll();

$pengeluaranModel = new Pengeluaran();
$pengeluaran = $pengeluaranModel->findAll();
// $pengeluaran = $pengeluaranModel->orderBy('id_pengeluaran', 'DESC')->limit(7)->findAll();
?>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css')?>">

<!-- Content-->
<section class="container-fluid">
  <div class="row">

    <div class="col-12">
      <!-- Basic Examples-->
      <div class="card mt-4">
        <div class="card-header">
          <h6 class="card-title">Home</h6>
        </div>
        <div class="card-body">
          <!-- Page Title-->
          <h2 class="fs-3 fw-bold mb-2">Selamat Datang di <b>ASA CIPTO ROSO</b> 👋</h2>
          <p class="text-muted mb-5">Aplikasi pembukuan yang digunakan untuk mencatat transaksi dan membuat pembukuan laporan keuangan.</p>
          <!-- / Page Title-->
        </div>
      </div>
    </div>

    <!-- Top Row Widgets-->
    <div class="row mt-2">

      <!-- BARANG -->
      <div class="card card-info col-md-12">
        <div class="card-header">
          <h3 class="card-title">Total Barang</h3>
        </div>
        <div class="card-body">
          <div class="chart">
            <b><?= $jumlah_barang ?></b>
          </div>
        </div>
      </div>

      <!-- PEMASUKAN -->
      <div class="card card-success col-md-6">
        <div class="card-header">
          <h3 class="card-title">Pemasukan</h3>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>
      
      <!-- PENGELUARAN -->
      <div class="card card-danger col-md-6">
        <div class="card-header">
          <h3 class="card-title">Pengeluaran</h3>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="lineChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>
      

    </div>
    <!-- / Basic Examples-->
  </div>
</section>
  
<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
<!-- Page specific script -->
<script>
  var transaksi = <?php echo json_encode($transaksi); ?>;
  var pengeluaran = <?php echo json_encode($pengeluaran); ?>;

  tanggal_transaksi = []
  jumlah_transaksi = []
  transaksi.forEach((item, index) => {

    const date = new Date(item.tanggal_transaksi)
    tanggal_transaksi.push(date.toDateString())
    jumlah_transaksi.push(item.jumlah_harus_bayar)
  });

  tanggal_pengeluaran = []
  jumlah_pengeluaran = []
  pengeluaran.forEach((item, index) => {

    const date = new Date(item.tanggal_pengeluaran)
    tanggal_pengeluaran.push(date.toDateString())
    jumlah_pengeluaran.push(item.biaya_pengeluaran)
  });

  console.log(tanggal_pengeluaran, jumlah_pengeluaran)

  $(function () {
    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartCanvas2 = $('#lineChart2').get(0).getContext('2d')
    // var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartOptions = {
        maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
    // var lineChartData = $.extend(true, {}, areaChartData)
    var lineChartData = {
        // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        labels  : tanggal_transaksi,
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          // data                : [28, 48, 40, 19, 86, 27, 90]
          data                : jumlah_transaksi
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          // data                : [65, 59, 80, 81, 56, 55, 40]
          data                : jumlah_transaksi

        },
      ]
    }
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChartData2 = {
        // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        labels  : tanggal_pengeluaran,
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          // data                : [28, 48, 40, 19, 86, 27, 90]
          data                : jumlah_pengeluaran
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          // data                : [65, 59, 80, 81, 56, 55, 40]
          data                : jumlah_pengeluaran

        },
      ]
    }
    lineChartData2.datasets[0].fill = false;
    lineChartData2.datasets[1].fill = false;
    // lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    var lineChart = new Chart(lineChartCanvas2, {
      type: 'line',
      data: lineChartData2,
      options: lineChartOptions
    })



  })
</script>
