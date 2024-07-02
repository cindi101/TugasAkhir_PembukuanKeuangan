<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


class Barang extends BaseController
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

    public function index()
    {
        $db = db_connect();
        $builder = $db->table('view_total_barang');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = view_total_barang.id_kategori_barang');
        $builder->join('tb_jenis_barang', 'tb_jenis_barang.id_jenis_barang = view_total_barang.id_jenis_barang');
        $builder->join('tb_satuan_barang', 'tb_satuan_barang.id_satuan_barang = view_total_barang.id_satuan_barang');
        $barang = $builder->get();


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

        $kodeBarang = $query_kode_barang->getRow()->kode_barang;
        $urutan = (int) substr($kodeBarang, 4, 4);
        $urutan++;
        $huruf = "BRG";
        $kodeBarang = $huruf . sprintf("%04s", $urutan);

        $data = array(
            'halaman' => 'data/barang/index',
            'script' => 'data/barang/script',
            'link' => 'barang',
            'barang' => $barang,
            'jenis_barang' => $jenis_barang,
            'kategori_barang' => $kategori_barang,
            'kodebarang' => $kodeBarang,
            'satuan_barang' => $satuan_barang
        );
        return view('templates/content', $data);
    }

    public function view($page = 'home')
    {
        // ...
    }

    public function simpan()
    {
        $kode_barang = $this->request->getPost('kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $id_kategori_barang = $this->request->getPost('id_kategori_barang');
        $id_jenis_barang = $this->request->getPost('id_jenis_barang');
        $id_satuan_barang = $this->request->getPost('id_satuan_barang');
        $harga_jual = $this->request->getPost('harga_jual');

        // upload foto
        $foto = $this->request->getFile('foto');
        if ($foto->getError() == 4) {
            $nama_foto = 'default.png';
        } else {
            if ($foto->getMimeType() != 'image/jpeg' && $foto->getMimeType() != 'image/png' && $foto->getMimeType() != 'image/jpg') {
                $return = array(
                    'status' => 'gagal',
                    'msg' => '<div class="alert alert-danger">Data gagal disimpan, Hanya menerima file berformat JPG, JPEG, dan PNG</div>'
                );
                echo json_encode($return);
                exit();
            }
            $nama_foto = $foto->getRandomName();
            $foto->move('upload', $nama_foto);
        }

        $data = array(
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang,
            'id_kategori_barang' => $id_kategori_barang,
            'id_jenis_barang' => $id_jenis_barang,
            'id_satuan_barang' => $id_satuan_barang,
            'harga_jual' => $harga_jual,
            'foto' => $nama_foto
        );

        $db = db_connect();
        $builder = $db->table('tb_barang');
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
        $id_barang = $this->request->getPost('id_barang');

        $db = db_connect();
        $builder = $db->table('tb_barang');
        $builder->where(array('id_barang' => $id_barang));
        $cek = $builder->get();

        echo json_encode($cek->getRow());
    }

    public function update()
    {
        $id_barang = $this->request->getPost('id_barang');
        $kode_barang = $this->request->getPost('kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $id_kategori_barang = $this->request->getPost('id_kategori_barang');
        $id_jenis_barang = $this->request->getPost('id_jenis_barang');
        $id_satuan_barang = $this->request->getPost('id_satuan_barang');
        $harga_jual = $this->request->getPost('harga_jual');

        $data = array(
            'nama_barang' => $nama_barang,
            'id_kategori_barang' => $id_kategori_barang,
            'id_jenis_barang' => $id_jenis_barang,
            'id_satuan_barang' => $id_satuan_barang,
            'harga_jual' => $harga_jual,
        );

        // upload foto
        $foto = $this->request->getFile('foto');
        if ($foto->getError() == 4) {
            $nama_foto = 'default.png';
        } else {
            if ($foto->getMimeType() != 'image/jpeg' && $foto->getMimeType() != 'image/png' && $foto->getMimeType() != 'image/jpg') {
                $return = array(
                    'status' => 'gagal',
                    'msg' => '<div class="alert alert-danger">Data gagal disimpan, Hanya menerima file berformat JPG, JPEG, dan PNG</div>'
                );
                echo json_encode($return);
                exit();
            }
            $nama_foto = $foto->getRandomName();
            $foto->move('upload', $nama_foto);
            $data['foto'] = $nama_foto;
        }

        $db = db_connect();
        $builder = $db->table('tb_barang');
        $builder->where(array('id_barang' => $id_barang));
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
        $id_barang = $this->request->getPost('id_barang');

        $db = db_connect();
        $builder = $db->table('tb_barang');
        $builder->where(array('id_barang' => $id_barang));
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
