<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jabatan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jabatan_model', 'jabatan');
    }

    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $jabatan = $this->jabatan->getJabatan();
        } else {
            $jabatan = $this->jabatan->getJabatan($id);
        }

        if ($jabatan) {
            $this->response([
                'status' => TRUE,
                'message' => 'Success Get Data',
                'data' => $jabatan
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data Not Found',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'Provide an ID !',
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->jabatan->deleteJabatan($id) > 0) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Data Deleted',
                    'id' => $id
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'ID Not Found !',
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nama_jabatan' => $this->post('nama_divisi'),
            'min_gaji' => $this->post('min_gaji'),
            'maks_gaji' => $this->post('maks_gaji'),
        ];

        if ($this->jabatan->createJabatan($data) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'new Data Jabatan Created',
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to create data Jabatan',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama_divisi' => $this->put('nama_divisi'),
            'min_gaji' => $this->put('min_gaji'),
            'maks_gaji' => $this->put('maks_gaji'),
        ];

        if ($this->divisi->updateJabatan($data, $id) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'Data jabatan updated',
                'id' => $id,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to update data jabatan',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
