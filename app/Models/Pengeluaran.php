<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengeluaran extends Model
{
    protected $table = 'tb_pengeluaran';
    protected $allowedFields = ['id_pengeluaran', 'nama_pengeluaran', 'biaya_pengeluaran', 'tanggal_pengeluaran'];
}