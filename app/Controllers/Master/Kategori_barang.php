<?php
namespace App\Controllers\Master;
use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Kategori_barang extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $session = session();
        if(session('level') != 'admin gudang'){
            echo '<script>alert("Mohon maaf anda tidak diizinkan mengakses halaman ini");</script>';
            echo '<script>window.location.href = "'.base_url().'";</script>';
            exit();
        }
    }

    public function index()
    {
        $db = db_connect();
        $builder = $db->table('tb_kategori_barang');        
        $kategori_barang = $builder->get();

        $data = array(
            'halaman'=>'setting/kategori_barang/index',
            'script'=>'setting/kategori_barang/script',
            'link' => 'kategori_barang',
            'kategori_barang' => $kategori_barang
        );
        return view('templates/content', $data);
    }

    public function view($page = 'home')
    {
        // ...
    }

    public function simpan(){
        $nama_kategori_barang = $this->request->getPost('nama_kategori_barang');
        $data = array(
            'nama_kategori_barang' => $nama_kategori_barang
        );
        $db = db_connect();
        $builder = $db->table('tb_kategori_barang'); 
        $save = $builder->insert($data);
        if($save){
            $return = array(
                'status' => 'sukses',
                'msg' => '<div class="alert alert-success">Data berhasil disimpan</div>'
            );
            echo json_encode($return);
            exit();
        }else{
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Data gagal disimpan</div>'
            );
            echo json_encode($return);
            exit();
        }      
    }

    public function update(){
        $nama_kategori_barang = $this->request->getPost('nama_kategori_barang');
        $id_kategori_barang = $this->request->getPost('id_kategori_barang');
        $data = array(
            'nama_kategori_barang' => $nama_kategori_barang
        );
        $db = db_connect();
        $builder = $db->table('tb_kategori_barang'); 
        $builder->where(array('id_kategori_barang' => $id_kategori_barang));
        $save = $builder->update($data);
        if($save){
            $return = array(
                'status' => 'sukses',
                'msg' => '<div class="alert alert-success">Data berhasil disimpan</div>'
            );
            echo json_encode($return);
            exit();
        }else{
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Data gagal disimpan</div>'
            );
            echo json_encode($return);
            exit();
        }      
    }

    public function hapus(){
        $id_kategori_barang = $this->request->getPost('id_kategori_barang');
       
        $db = db_connect();
        $builder = $db->table('tb_kategori_barang'); 
        $builder->where(array('id_kategori_barang' => $id_kategori_barang));
        $save = $builder->delete();
        if($save){
            $return = array(
                'status' => 'sukses',
                'msg' => '<div class="alert alert-success">Data berhasil dihapus</div>'
            );
            echo json_encode($return);
            exit();
        }else{
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Data gagal dihapus</div>'
            );
            echo json_encode($return);
            exit();
        }      
    }
}