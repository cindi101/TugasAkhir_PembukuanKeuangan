<?php
namespace App\Controllers\Master;
use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class User extends BaseController
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
        $builder = $db->table('tb_user');        
        $user = $builder->get();

        $data = array(
            'halaman'=>'setting/user/index',
            'script'=>'setting/user/script',
            'link' => 'user',
            'user' => $user
        );
        return view('templates/content', $data);
    }

    public function view($page = 'home')
    {
        // ...
    }

    public function simpan(){
        $username = trim(strtolower($this->request->getPost('username')));
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $password = $this->request->getPost('password');
        $konfirmasi_password = $this->request->getPost('konfirmasi_password');
        $level = $this->request->getPost('level');

        if($konfirmasi_password != $password){
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Password tidak cocok</div>'
            );
            echo json_encode($return);
            exit();
        }

        $db = db_connect();
        $builder = $db->table('tb_user');
        $builder->where(array('username' => $username));
        $cek = $builder->get();
        if($cek->getNumRows() > 0){
            $return = array(
                'status' => 'gagal',
                'msg' => '<div class="alert alert-danger">Username sudah ada yang menggunakan</div></div>'
            );
            echo json_encode($return);
            exit();
        }

        $data = array(
            'username' => $username,
            'nama_lengkap' => $nama_lengkap,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level' => $level,
        );
        $db = db_connect();
        $builder = $db->table('tb_user'); 
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
        $username = trim(strtolower($this->request->getPost('username')));
        $id_user = trim(strtolower($this->request->getPost('id_user')));
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $password = $this->request->getPost('password');
        $konfirmasi_password = $this->request->getPost('konfirmasi_password');
        $level = $this->request->getPost('level');

        if($password != ''){
            if($konfirmasi_password != $password){
                $return = array(
                    'status' => 'gagal',
                    'msg' => '<div class="alert alert-danger">Password tidak cocok</div>'
                );
                echo json_encode($return);
                exit();
            }else{
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
        }        

        $data['nama_lengkap'] = $nama_lengkap;
        $data['level'] = $level;
        
        $db = db_connect();
        $builder = $db->table('tb_user'); 
        $builder->where(array('id_user' => $id_user));
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
        $id_user = $this->request->getPost('id_user');
       
        $db = db_connect();
        $builder = $db->table('tb_user'); 
        $builder->where(array('id_user' => $id_user));
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