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
}
