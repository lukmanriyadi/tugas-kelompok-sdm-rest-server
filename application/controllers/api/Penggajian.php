<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Penggajian extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penggajian_model', 'penggajian');
    }

    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $penggajian = $this->penggajian->getPenggajian();
        } else {
            $penggajian = $this->penggajian->getPenggajian($id);
        }

        if ($penggajian) {
            $this->response([
                'status' => TRUE,
                'message' => 'Success Get Data',
                'data' => $penggajian
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data Not Found',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_post()
    {
        $data = [
            'id_pembayaran' => $this->post('id_pembayaran'),
            'id_pegawai' => $this->post('id_pegawai'),
            'periode_bulan' => $this->post('periode_bulan'),
            'periode_tahun' => $this->post('periode_tahun'),
            'tgl_pembayaran' => $this->post('tgl_pembayaran'),
            'gaji_pokok' => $this->post('gaji_pokok'),
            'gaji_total' => $this->post('gaji_total'),
            'tunjangan' => $this->post('tunjangan'),
            'potongan' => $this->post('potongan'),
            'status' => $this->post('status'),
        ];

        if ($this->penggajian->createPenggajian($data) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'new Data penggajian Created',
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to create data penggajian',
            ], REST_Controller::HTTP_BAD_REQUEST);
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

            $penggajian = $this->penggajian->getPerPeriode($bulan, $tahun);

            if ($penggajian) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Success Get Data',
                    'data' => $penggajian
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
            $penggajian = $this->penggajian->getPerPegawai($id_pegawai);

            if ($penggajian) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Success Get Data',
                    'data' => $penggajian
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
