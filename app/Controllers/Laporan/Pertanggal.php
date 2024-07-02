<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Dompdf\Dompdf;


class Pertanggal extends BaseController
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
            'halaman' => 'laporan/pertanggal/index',
            'script' => 'laporan/pertanggal/script',
            'link' => 'pertanggal',
        );
        return view('templates/content', $data);
    }

    public function pengeluaran()
    {
        $tanggal = $this->request->getPost('tanggal_pengeluaran');

        $db = db_connect();
        $builder = $db->table('tb_pengeluaran');
        $builder->where(array('tanggal_pengeluaran' => $tanggal));
        $laporan = $builder->get();

        $data = array(
            'halaman' => 'laporan/pertanggal/pengeluaran',
            'script' => 'laporan/pertanggal/script',
            'link' => 'pertanggal',
            'tanggal' => $tanggal,
            'laporan' => $laporan
        );
        return view('templates/content', $data);
    }

    public function cetakpdf($tanggal = NULL, $tipe = null)
    {
        $db = db_connect();
        // pengeluaran
        if ($tipe == '0') {
            $builder = $db->table('tb_pengeluaran');
            $builder->where(array('DATE(tanggal_pengeluaran)' => $tanggal));
            $laporan = $builder->get();
        } else if ($tipe == '1') { //pemasukan
            $builder = $db->table('tb_transaksi');
            $builder->where(array('DATE(tanggal_transaksi)' => $tanggal));
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
            'dari' => $tanggal,
        ];

        // pengeluaran
        if ($tipe == '0') {
            $filename = "pengeluaran_pertanggal_$tanggal";
        } else {
            $filename = "pemasukan_pertanggal_$tanggal";
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

    public function pemasukan()
    {
        $tanggal = $this->request->getPost('tanggal_pemasukan');

        $db = db_connect();
        $builder = $db->table('tb_transaksi');
        $builder->where(array('DATE(tanggal_transaksi)' => $tanggal));
        $laporan = $builder->get();

        $data = array(
            'halaman' => 'laporan/pertanggal/pemasukan',
            'script' => 'laporan/pertanggal/script',
            'link' => 'pertanggal',
            'tanggal' => $tanggal,
            'laporan' => $laporan
        );
        return view('templates/content', $data);
    }
}
