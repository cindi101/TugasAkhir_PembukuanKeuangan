<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Pembukuan Keuangan | Cetak Dokumen</title>

    <style>
        .cards {
            max-width: 1100px;
            margin: 0 auto;
            text-align: center;
            padding: 30px;
        }

        .cards h2.header {
            font-size: 40px;
            margin: 0 0 0px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>

<body>
    <div class="cards">
        <h2 class="header">ASA Cipto Roso</h2>
        <p>Jalan Pagar ALam, Gg. PU (Kawasan Sentra Industri Keripik) Kota Bandar Lampung</p>
        <hr />
        <h5 style="text-transform: uppercase; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Laporan Pemasukan Per Tanggal : <?= $dari ?> <?php echo @$sampai != '' ? ' s.d ' . @$sampai : '' ?></h5>
        <table border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 5px; text-align:center">
            <thead>
                <tr bgcolor=silver align=center>
                    <td width="5%">No</td>
                    <td width="25%">Tanggal</td>
                    <td width="20%">Jumlah Bayar</td>
                    <td width="20%">Uang Bayar</td>
                    <td width="20%">Kembalian</td>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1;
                $jumlah_harus_bayar = 0;
                $uang_yang_bayar = 0;
                $kembalian = 0;
                foreach ($laporan->getResult() as $key => $value) {
                    $jumlah_harus_bayar += $value->jumlah_harus_bayar;
                    $uang_yang_bayar += $value->uang_yang_bayar;
                    $kembalian += $value->kembalian; ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->tanggal_transaksi ?></td>
                        <td style="text-align: right;">Rp. <?= number_format($value->jumlah_harus_bayar, 0, ',', '.') ?></td>
                        <td style="text-align: right;">Rp. <?= number_format($value->uang_yang_bayar, 0, ',', '.') ?></td>
                        <td style="text-align: right;">Rp. <?= number_format($value->kembalian, 0, ',', '.') ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: right; padding-right: 10px;">Keseluruhan</td>
                    <td colspan="1" style="text-align: right;">Rp. <?= number_format($jumlah_harus_bayar, 0, ',', '.') ?></td>
                    <td colspan="1" style="text-align: right;">Rp. <?= number_format($uang_yang_bayar, 0, ',', '.') ?></td>
                    <td colspan="1" style="text-align: right;">Rp. <?= number_format($kembalian, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>

        <p style="text-align: right;">Total Data : <?= $total ?> Pemasukan</p>
    </div>
</body>

</html>