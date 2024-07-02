<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';
    protected $allowedFields = ['id_transaksi', 'id_user', 'kode_transaksi', 'status_transaksi', 'jumlah_harus_bayar', 'uang_yang_bayar', 'kembalian', 'tanggal_transaksi'];
}