<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class stok_barang extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $session = session();
        if (!session('logged_in')) {
            echo '<script>alert("Mohon maaf anda tidak diizinkan mengakses halaman ini");</script>';
            echo '<script>window.location.href = "' . base_url() . '";</script>';
            exit();
        }
    }

    public function index($kode_barang)
    {
        $db = db_connect();
        $builder = $db->table('tb_barang');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang');
        $builder->join('tb_jenis_barang', 'tb_jenis_barang.id_jenis_barang = tb_barang.id_jenis_barang');
        $builder->join('tb_satuan_barang', 'tb_satuan_barang.id_satuan_barang = tb_barang.id_satuan_barang');
        $builder->where(array('kode_barang' => $kode_barang));
        $barang = $builder->get();

        $db = db_connect();
        $builder = $db->table('tb_stok_barang');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_stok_barang.id_barang');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang');
        $builder->join('tb_jenis_barang', 'tb_jenis_barang.id_jenis_barang = tb_barang.id_jenis_barang');
        $builder->join('tb_satuan_barang', 'tb_satuan_barang.id_satuan_barang = tb_barang.id_satuan_barang');
        $builder->where(array('kode_barang' => $kode_barang));
        $stok_barang = $builder->get();
        // var_dump($db->getLastQuery());exit();

        $db = db_connect();
        $builder = $db->table('tb_jenis_barang');
        $jenis_barang = $builder->get();

        $db = db_connect();
        $builder = $db->table('tb_kategori_barang');
        $kategori_barang = $builder->get();

        $db = db_connect();
        $builder = $db->table('tb_satuan_barang');
        $satuan_barang = $builder->get();

        $db = db_connect();
        $builder = $db->table('tb_barang');
        $builder->selectMax('kode_barang');
        $query_kode_barang = $builder->get();

        $data = array(
            'halaman' => 'data/stok_barang/index',
            'script' => 'data/stok_barang/script',
            'link' => 'barang',
            'barang' => $barang,
            'jenis_barang' => $jenis_barang,
            'kategori_barang' => $kategori_barang,
            'satuan_barang' => $satuan_barang,
            'stok_barang' => $stok_barang
        );
        return view('templates/content', $data);
    }

    public function simpan()
    {
        $id_barang = $this->request->getPost('id_barang');
        $tanggal_masuk = $this->request->getPost('tanggal_masuk');
        $tanggal_produksi = $this->request->getPost('tanggal_produksi');
        $tanggal_expired = $this->request->getPost('tanggal_expired');
        $jumlah = $this->request->getPost('jumlah');
        $modal = $this->request->getPost('modal');
        $modal_total = $this->request->getPost('modal_total');

        $data = array(
            'id_barang' => $id_barang,
            'tanggal_masuk' => $tanggal_masuk,
            'tanggal_produksi' => $tanggal_produksi,
            'tanggal_expired' => $tanggal_expired,
            'jumlah' => $jumlah,
            'modal' => $modal,
            'modal_total' => $modal_total,
        );

        $db = db_connect();
        $builder = $db->table('tb_stok_barang');
        $save = $builder->insert($data);
        if ($save) {
            $return = array(
                'status' => 'sukses',
                'msg' => '<div class="alert alert-success">Data berhasil disimpan</div>'
            );
            echo json_encode($return);
            exit();
        } else {
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Data gagal disimpan</div>'
            );
            echo json_encode($return);
            exit();
        }
    }

    public function getdata()
    {
        $id_stok_barang = $this->request->getPost('id_stok_barang');

        $db = db_connect();
        $builder = $db->table('tb_stok_barang');
        $builder->where(array('id_stok_barang' => $id_stok_barang));
        $cek = $builder->get();

        echo json_encode($cek->getRow());
    }

    public function update()
    {
        $id_stok_barang = $this->request->getPost('id_stok_barang');
        $id_barang = $this->request->getPost('id_barang');
        $tanggal_masuk = $this->request->getPost('tanggal_masuk');
        $tanggal_produksi = $this->request->getPost('tanggal_produksi');
        $tanggal_expired = $this->request->getPost('tanggal_expired');
        $jumlah = $this->request->getPost('jumlah');
        $modal = $this->request->getPost('modal');
        $modal_total = $this->request->getPost('modal_total');

        $data = array(
            'tanggal_masuk' => $tanggal_masuk,
            'tanggal_produksi' => $tanggal_produksi,
            'tanggal_expired' => $tanggal_expired,
            'jumlah' => $jumlah,
            'modal' => $modal,
            'modal_total' => $modal_total,
        );

        $db = db_connect();
        $builder = $db->table('tb_stok_barang');
        $builder->where(array('id_stok_barang' => $id_stok_barang));
        $save = $builder->update($data);
        if ($save) {
            $return = array(
                'status' => 'sukses',
                'msg' => '<div class="alert alert-success">Data berhasil disimpan</div>'
            );
            echo json_encode($return);
            exit();
        } else {
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Data gagal disimpan</div>'
            );
            echo json_encode($return);
            exit();
        }
    }

    public function hapus()
    {
        $id_stok_barang = $this->request->getPost('id_stok_barang');

        $db = db_connect();
        $builder = $db->table('tb_stok_barang');
        $builder->where(array('id_stok_barang' => $id_stok_barang));
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
}
