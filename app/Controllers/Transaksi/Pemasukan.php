<?php

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Pemasukan extends BaseController
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
        $db = db_connect();
        $builder = $db->table('tb_pemasukan');
        $pemasukan = $builder->get();

        $data = array(
            'halaman' => 'transaksi/pemasukan/index',
            'script' => 'transaksi/pemasukan/script',
            'link' => 'pemasukan',
            'pemasukan' => $pemasukan
        );
        return view('templates/content', $data);
    }

    public function simpan()
    {
        $tanggal_pemasukan = $this->request->getPost('tanggal_pemasukan');
        $modal_pemasukan = $this->request->getPost('modal_pemasukan');
        $biaya_pemasukan = $this->request->getPost('biaya_pemasukan');
        $data = array(
            'tanggal_pemasukan' => $tanggal_pemasukan,
            'modal_pemasukan' => $modal_pemasukan,
            'biaya_pemasukan' => $biaya_pemasukan
        );
        $db = db_connect();
        $builder = $db->table('tb_pemasukan');
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

    public function update()
    {
        $id_pemasukan = $this->request->getPost('id_pemasukan');
        $tanggal_pemasukan = $this->request->getPost('tanggal_pemasukan');
        $modal_pemasukan = $this->request->getPost('modal_pemasukan');
        $biaya_pemasukan = $this->request->getPost('biaya_pemasukan');
        $data = array(
            'tanggal_pemasukan' => $tanggal_pemasukan,
            'modal_pemasukan' => $modal_pemasukan,
            'biaya_pemasukan' => $biaya_pemasukan
        );
        $db = db_connect();
        $builder = $db->table('tb_pemasukan');
        $builder->where(array('id_pemasukan' => $id_pemasukan));
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
        $id_pemasukan = $this->request->getPost('id_pemasukan');

        $db = db_connect();
        $builder = $db->table('tb_pemasukan');
        $builder->where(array('id_pemasukan' => $id_pemasukan));
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
