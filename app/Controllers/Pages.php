<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Pages extends BaseController
{

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $session = session();
        if (session('logged_in') == false) {
            echo '<script>alert("Mohon maaf anda tidak diizinkan mengakses halaman ini");</script>';
            echo '<script>window.location.href = "' . base_url() . '";</script>';
            exit();
        }
    }

    public function index()
    {
        $db = db_connect();
        $builder = $db->table('tb_transaksi');
        $builder->selectSum('jumlah_harus_bayar');
        $q_trans = $builder->get();
        
        
        $builder = $db->table('tb_pengeluaran');
        $builder->selectSum('biaya_pengeluaran');
        $q_pengeluaran = $builder->get();

        $builder = $db->table('tb_barang');
        $q_barang = $builder->get();

        
        $data = array(
            'halaman' => 'home',
            'link' => 'home',
            'jumlah_barang' => $q_barang->getNumRows(),
            'jumlah_bayar' => $q_trans->getRow()->jumlah_harus_bayar,
            'jumlah_pengeluaran' => $q_pengeluaran->getRow()->biaya_pengeluaran
        );

        return view('templates/content', $data);
    }

    public function view($page = 'home')
    {
        // ...
    }

    public function proses_logout()
    {
        $session = session();
        $session->destroy();
        echo '<script>alert("berhasil logout, sedang dialihkan");</script>';
        echo '<script>window.location.href = "' . base_url() . 'login";</script>';
    }
}
