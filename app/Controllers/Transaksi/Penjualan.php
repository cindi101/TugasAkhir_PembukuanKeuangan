<?php

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;

use CodeIgniter\Database\Exceptions\DatabaseException;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


class Penjualan extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $session = session();
        if (session('level') != 'admin toko') {
            echo '<script>alert("Mohon maaf anda tidak diizinkan mengakses halaman ini");</script>';
            echo '<script>window.location.href = "' . base_url() . '";</script>';
            exit();
        }
    }

    public function index()
    {

        // $detail_tansaksi ='';
        if (empty(session('kode_transaksi'))) {
            $kode_transaksi = intCodeRandom();
            $session = session()->set(array('kode_transaksi' => 'trx-' . $kode_transaksi . date('YmdHis')));
        } else {
            $db = db_connect();
            $builder = $db->table('tb_detail_transaksi');
            $builder->select('tb_detail_transaksi.*, tb_barang.kode_barang');
            $builder->join('tb_transaksi', 'tb_transaksi.id_transaksi=tb_detail_transaksi.id_transaksi');
            $builder->join('tb_barang', 'tb_barang.id_barang=tb_detail_transaksi.id_barang');
            $builder->where(array('tb_transaksi.kode_transaksi' => session('kode_transaksi')));
            $detail_tansaksi = @$builder->get();
            // var_dump($db->getLastQuery());exit();    

        }

        $db = db_connect();
        $builder = $db->table('tb_penjualan');
        $penjualan = $builder->get();

        $data = array(
            'halaman' => 'transaksi/penjualan/index',
            'script' => 'transaksi/penjualan/script',
            'link' => 'penjualan',
            'penjualan' => $penjualan,
            'detail_transaksi' => @$detail_tansaksi ?? ''
        );
        return view('templates/content', $data);
    }

    public function getbarang()
    {
        $searchTerm = $this->request->getPost('searchTerm') ?? '';
        // Fetch users
        $db = db_connect();
        $builder = $db->table('tb_barang');
        $builder->like('nama_barang', $searchTerm);
        $builder->orlike('kode_barang', $searchTerm);
        $barang = $builder->get();

        $data = array();
        $i = 0;
        foreach ($barang->getResult() as $r) {
            $data[$i]['id'] = $r->id_barang;
            $data[$i]['text'] = $r->kode_barang . '-' . $r->nama_barang;

            $i++;
        }

        echo json_encode($data);
    }

    public function simpan()
    {
        $kode_transaksi = $this->request->getPost('kode_transaksi');
        $status_transaksi = 'draft';
        $id_barang = $this->request->getPost('id_barang');
        $jumlah_barang = $this->request->getPost('jumlah');

        $db = db_connect();

        // $this->db = \Config\Database::connect(); //Load database connection 
        // $this->db->transBegin();
        $builder = $db->table('tb_barang');
        $builder->where('id_barang', $id_barang);
        $barang = $builder->get();

        $nama_barang = $barang->getRow()->nama_barang;
        $harga_barang = $barang->getRow()->harga_jual;

        $total_bayar = $harga_barang * $jumlah_barang;

        $db = db_connect();
        $builder = $db->table('view_total_barang');
        $builder->where('id_barang', $id_barang);
        $cek_stok = $builder->get();

        $total_stok = $cek_stok->getRow()->total_stok;
        $stok_terpakai = $cek_stok->getRow()->stok_terpakai;

        $stok_tersedia = $total_stok - $stok_terpakai;

        if ($stok_tersedia <= 0) {
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Stok Habis</div>'
            );
            echo json_encode($return);
            exit();
        }

        if ($jumlah_barang > $stok_tersedia) {
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Stok tidak cukup</div>'
            );
            echo json_encode($return);
            exit();
        }

        $db = db_connect();
        $builder = $db->table('tb_transaksi');
        $builder->where('kode_transaksi', $kode_transaksi);
        $cek_transaksi = $builder->get();
        if ($cek_transaksi->getNumRows() == 0) {
            $data_transaksi = array(
                'kode_transaksi' => $kode_transaksi,
                'status_transaksi' => $status_transaksi,
                'tanggal_transaksi' => date('Y-m-d H:i:s'),
                'id_user' => session('id_user')
            );
            $builder = $db->table('tb_transaksi');
            $save = $builder->insert($data_transaksi);

            $id_transaksi = $db->insertID();
        } else {
            $id_transaksi = $cek_transaksi->getRow()->id_transaksi;
        }

        $data_detail_transaksi = array(
            'id_transaksi' => $id_transaksi,
            'id_barang' => $id_barang,
            'nama_barang' => $nama_barang,
            'jumlah_barang' => $jumlah_barang,
            'harga_barang' => $harga_barang,
            'total_bayar' => $total_bayar,
        );
        $db = db_connect();
        $builder = $db->table('tb_detail_transaksi');
        $save = $builder->insert($data_detail_transaksi);

        if (!$save) {
            // $db->transRollback();
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Data gagal disimpan</div>'
            );
            echo json_encode($return);
            exit();
        } else {
            // $this->db->transCommit();
            $return = array(
                'status' => 'sukses',
                'msg' => '<div class="alert alert-success">Data berhasil disimpan</div>'
            );
            echo json_encode($return);
            exit();
        }
    }

    public function hapus()
    {
        $id_detail_transaksi = $this->request->getPost('id_detail_transaksi');

        $db = db_connect();
        $builder = $db->table('tb_detail_transaksi');
        $builder->where(array('id_detail_transaksi' => $id_detail_transaksi));
        $save = $builder->delete();
        if ($save) {
            $return = array(
                'status' => 'sukses',
                'msg' => '<div class="alert alert-success">Data berhasil dihapus</div>'
            );
            echo json_encode($return);
            exit();
        } else {
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Data gagal dihapus</div>'
            );
            echo json_encode($return);
            exit();
        }
    }

    public function checkout()
    {
        $kode_transaksi = $this->request->getPost('kode_transaksi');
        $jumlah_harus_bayar = $this->request->getPost('jumlah_harus_bayar');
        $uang_yang_bayar = $this->request->getPost('uang_yang_bayar');
        $kembalian = $this->request->getPost('kembalian');

        if ($uang_yang_bayar == '') {
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Uang yang dibayarkan belum di input</div>'
            );
            echo json_encode($return);
            exit();
        }

        $status_transaksi = 'sukses';

        $data = array(
            'jumlah_harus_bayar' => $jumlah_harus_bayar,
            'uang_yang_bayar' => $uang_yang_bayar,
            'kembalian' => $kembalian,
            'status_transaksi' => 'sukses'
        );
        $db = db_connect();
        $builder = $db->table('tb_transaksi');
        $builder->where(array('kode_transaksi' => $kode_transaksi));
        $save = $builder->update($data);
        if ($save) {
            $session = session();
            $session->remove('kode_transaksi');
            unset($_SESSION['kode_transaksi']);

            if (empty(session('kode_transaksi'))) {
                $kode_transaksi = intCodeRandom();
                $session = session()->set(array('kode_transaksi' => 'trx-' . $kode_transaksi . date('YmdHis')));
            }
            $return = array(
                'status' => 'sukses',
                'msg' => '<div class="alert alert-success">Data berhasil dichekout</div>'
            );
            echo json_encode($return);
            exit();
        } else {
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Data gagal dichekout</div>'
            );
            echo json_encode($return);
            exit();
        }
    }
}
