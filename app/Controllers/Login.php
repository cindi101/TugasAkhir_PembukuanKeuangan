<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Login extends BaseController
{

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $session = session();
        if (session('level') == true) {
            echo '<script>alert("Mohon maaf anda tidak diizinkan mengakses halaman ini");</script>';
            echo '<script>window.location.href = "' . base_url('pages') . '";</script>';
            exit();
        }
    }

    public function index()
    {
        $data = array('halaman' => 'home', 'link' => 'home');
        return view('login', $data);
    }

    public function view($page = 'home')
    {
    }

    public function proses()
    {

        $session = session();

        $username = $this->request->getPost('username') ?? '';
        $password = $this->request->getPost('password') ?? '';

        $db = db_connect();
        $builder = $db->table('tb_user');
        $builder->where('username', $username);
        $query = $builder->get();

        if ($query->getNumRows() != 0) {
            $cek = password_verify($password, $query->getRow()->password);
            if ($cek) {
                $newdata = [
                    'id_user' => $query->getRow()->id_user,
                    'username'  => $username,
                    'nama'     => $query->getRow()->nama_lengkap,
                    'logged_in' => true,
                    'level'     => $query->getRow()->level
                ];
                $session->set($newdata);
                echo '<script>alert("berhasil login, sedang dialihkan");</script>';
                echo '<script>window.location.href = "' . base_url() . 'pages";</script>';
            } else {
                echo '<script>alert("Password salah");</script>';
                echo '<script>history.back();</script>';
            }
        } else {
            echo '<script>alert("Username tidak ditemukan");</script>';
            echo '<script>history.back();</script>';
        }
    }
}
