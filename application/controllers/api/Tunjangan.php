<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Tunjangan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tunjangan_model', 'tunjangan');
    }

    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $tunjangan = $this->tunjangan->getTunjangan();
        } else {
            $tunjangan = $this->tunjangan->getTunjangan($id);
        }

        if ($tunjangan) {
            $this->response([
                'status' => TRUE,
                'message' => 'Success Get Data',
                'data' => $tunjangan
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data Not Found',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
