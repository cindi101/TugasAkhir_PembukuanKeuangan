<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Dompdf\Dompdf;

class Perperiode extends BaseController
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
        $data = array(
            'halaman' => 'laporan/perperiode/index',
            'script' => 'laporan/perperiode/script',
            'link' => 'perperiode',
        );
        return view('templates/content', $data);
    }

    public function pengeluaran()
    {
        $dari = $this->request->getPost('dari_pengeluaran');
        $sampai = $this->request->getPost('sampai_pengeluaran');

        $db = db_connect();
        $builder = $db->table('tb_pengeluaran');
        $builder->where(array('tanggal_pengeluaran >=' => $dari, 'tanggal_pengeluaran <=' => $sampai));
        $laporan = $builder->get();

        $data = array(
            'halaman' => 'laporan/perperiode/pengeluaran',
            'script' => 'laporan/perperiode/script',
            'link' => 'perperiode',
            'dari' => $dari,
            'sampai' => $sampai,
            'laporan' => $laporan
        );
        return view('templates/content', $data);
    }

    public function pemasukan()
    {
        $dari = $this->request->getPost('dari_pemasukan');
        $sampai = $this->request->getPost('sampai_pemasukan');

        $db = db_connect();
        $builder = $db->table('tb_transaksi');
        $builder->where(array('DATE(tanggal_transaksi) >=' => $dari, 'DATE(tanggal_transaksi) <=' => $sampai));
        $laporan = $builder->get();

        $data = array(
            'halaman' => 'laporan/perperiode/pemasukan',
            'script' => 'laporan/perperiode/script',
            'link' => 'perperiode',
            'dari' => $dari,
            'sampai' => $sampai,
            'laporan' => $laporan
        );
        return view('templates/content', $data);
    }

    public function cetakpdf($dari = NULL, $sampai = null, $tipe = null)
    {
        $db = db_connect();
        // pengeluaran
        if ($tipe == '0') {
            $builder = $db->table('tb_pengeluaran');
            $builder->where(array('DATE(tanggal_pengeluaran) >=' => $dari, 'DATE(tanggal_pengeluaran) <=' => $sampai));
            $laporan = $builder->get();
        } else if ($tipe == '1') { //pemasukan
            $builder = $db->table('tb_transaksi');
            $builder->where(array('DATE(tanggal_transaksi) >=' => $dari, 'DATE(tanggal_transaksi) <=' => $sampai));
            $laporan = $builder->get();
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            exit();
        }


        if ($laporan->getNumRows() == 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            exit();
        }

        $data = [
            'laporan' => $laporan,
            'total' => $laporan->getNumRows(),
            'dari' => $dari,
            'sampai' => $sampai,
        ];

        // pengeluaran
        if ($tipe == '0') {
            $filename = "pengeluaran_periode_$dari" . "_$sampai";
        } else {
            $filename = "pemasukan_periode_$dari" . "_$sampai";
        }

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // pengeluaran
        if ($tipe == '0') {
            // load HTML content
            $dompdf->loadHtml(view('pdf/index_pengeluaran', $data));
        } else if ($tipe == '1') { //pemasukan
            $dompdf->loadHtml(view('pdf/index_pemasukan', $data));
        }

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}
