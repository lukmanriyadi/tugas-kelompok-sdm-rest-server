<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Divisi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Divisi_model', 'divisi');
    }

    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $divisi = $this->divisi->getDivisi();
        } else {
            $divisi = $this->divisi->getDivisi($id);
        }

        if ($divisi) {
            $this->response([
                'status' => TRUE,
                'message' => 'Success Get Data',
                'data' => $divisi
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
            if ($this->divisi->deleteDivisi($id) > 0) {
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
            'nama_divisi' => $this->post('nama_divisi'),
        ];

        if ($this->divisi->createDivisi($data) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'new Data Divisi Created',
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to create data Divisi',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama_divisi' => $this->put('nama_divisi'),
        ];

        if ($this->divisi->updateDivisi($data, $id) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'Data divisi updated',
                'id' => $id,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to update data divisi',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
