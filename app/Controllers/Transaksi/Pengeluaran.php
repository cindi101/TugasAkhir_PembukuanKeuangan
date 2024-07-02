<?php
namespace App\Controllers\Transaksi;
use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Pengeluaran extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $session = session();
        if(session('level') != 'admin toko'){
            echo '<script>alert("Mohon maaf anda tidak diizinkan mengakses halaman ini");</script>';
            echo '<script>window.location.href = "'.base_url().'";</script>';
            exit();
        }
    }
    
    public function index()
    {
        $db = db_connect();
        $builder = $db->table('tb_pengeluaran');        
        $pengeluaran = $builder->get();

        $data = array(
            'halaman'=>'transaksi/pengeluaran/index',
            'script'=>'transaksi/pengeluaran/script',
            'link' => 'pengeluaran',
            'pengeluaran' => $pengeluaran
        );
        return view('templates/content', $data);
    }

    public function simpan(){
        $tanggal_pengeluaran = $this->request->getPost('tanggal_pengeluaran');
        $nama_pengeluaran = $this->request->getPost('nama_pengeluaran');
        $biaya_pengeluaran = $this->request->getPost('biaya_pengeluaran');
        $data = array(
            'tanggal_pengeluaran' => $tanggal_pengeluaran,
            'nama_pengeluaran' => $nama_pengeluaran,
            'biaya_pengeluaran' => $biaya_pengeluaran
        );
        $db = db_connect();
        $builder = $db->table('tb_pengeluaran'); 
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
        $id_pengeluaran = $this->request->getPost('id_pengeluaran');
        $tanggal_pengeluaran = $this->request->getPost('tanggal_pengeluaran');
        $nama_pengeluaran = $this->request->getPost('nama_pengeluaran');
        $biaya_pengeluaran = $this->request->getPost('biaya_pengeluaran');
        $data = array(
            'tanggal_pengeluaran' => $tanggal_pengeluaran,
            'nama_pengeluaran' => $nama_pengeluaran,
            'biaya_pengeluaran' => $biaya_pengeluaran
        );
        $db = db_connect();
        $builder = $db->table('tb_pengeluaran'); 
        $builder->where(array('id_pengeluaran' => $id_pengeluaran));
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
        $id_pengeluaran = $this->request->getPost('id_pengeluaran');
       
        $db = db_connect();
        $builder = $db->table('tb_pengeluaran'); 
        $builder->where(array('id_pengeluaran' => $id_pengeluaran));
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