<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class pelanggaran extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggaran_model', 'pelanggaran');
    }

    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $pelanggaran = $this->pelanggaran->getPelanggaran();
        } else {
            $pelanggaran = $this->pelanggaran->getPelanggaran($id);
        }

        if ($pelanggaran) {
            $this->response([
                'status' => TRUE,
                'message' => 'Success Get Data',
                'data' => $pelanggaran
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data Not Found',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
