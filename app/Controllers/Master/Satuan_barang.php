<?php
namespace App\Controllers\Master;
use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Satuan_barang extends BaseController
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
        $builder = $db->table('tb_satuan_barang');        
        $satuan_barang = $builder->get();

        $data = array(
            'halaman'=>'setting/satuan_barang/index',
            'script'=>'setting/satuan_barang/script',
            'link' => 'satuan_barang',
            'satuan_barang' => $satuan_barang
        );
        return view('templates/content', $data);
    }

    public function view($page = 'home')
    {
        // ...
    }

    public function simpan(){
        $nama_satuan_barang = $this->request->getPost('nama_satuan_barang');
        $data = array(
            'nama_satuan_barang' => $nama_satuan_barang
        );
        $db = db_connect();
        $builder = $db->table('tb_satuan_barang'); 
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
        $nama_satuan_barang = $this->request->getPost('nama_satuan_barang');
        $id_satuan_barang = $this->request->getPost('id_satuan_barang');
        $data = array(
            'nama_satuan_barang' => $nama_satuan_barang
        );
        $db = db_connect();
        $builder = $db->table('tb_satuan_barang'); 
        $builder->where(array('id_satuan_barang' => $id_satuan_barang));
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
        $id_satuan_barang = $this->request->getPost('id_satuan_barang');
       
        $db = db_connect();
        $builder = $db->table('tb_satuan_barang'); 
        $builder->where(array('id_satuan_barang' => $id_satuan_barang));
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