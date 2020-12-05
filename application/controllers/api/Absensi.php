<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Absensi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Absensi_model', 'absensi');
    }

    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $absensi = $this->absensi->getAbsensi();
        } else {
            $absensi = $this->absensi->getAbsensi($id);
        }

        if ($absensi) {
            $this->response([
                'status' => TRUE,
                'message' => 'Success Get Data',
                'data' => $absensi
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data Not Found',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function perPeriode_get()
    {
        $bulan = $this->get('bulan');
        $tahun = $this->get('tahun');

        if ($bulan === null || $tahun === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'Provide parameter',
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $bulan = strtolower($bulan);
            $tahun = strtolower($tahun);

            $absensi = $this->absensi->getPerPeriode($bulan, $tahun);

            if ($absensi) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Success Get Data',
                    'data' => $absensi
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Data Not Found',
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function perPegawai_get()
    {
        $id_pegawai = $this->get('id');

        if ($id_pegawai === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'Provide parameter',
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $absensi = $this->absensi->getPerPegawai($id_pegawai);

            if ($absensi) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Success Get Data',
                    'data' => $absensi
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Data Not Found',
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}
