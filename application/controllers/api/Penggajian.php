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
}
