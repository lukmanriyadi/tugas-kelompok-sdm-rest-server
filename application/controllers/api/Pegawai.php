<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pegawai extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model', 'pegawai');
    }
    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $pegawai = $this->pegawai->getPegawai();
        } else {
            $pegawai = $this->pegawai->getPegawai($id);
        }

        if ($pegawai) {
            $this->response([
                'status' => TRUE,
                'message' => 'Success Get Data',
                'data' => $pegawai
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
            if ($this->pegawai->deletePegawai($id) > 0) {
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
            'id_divisi' => $this->post('id_divisi'),
            'id_jabatan' => $this->post('id_jabatan'),
            'nama_depan' => $this->post('nama_depan'),
            'nama_belakang' => $this->post('nama_belakang'),
            'TTL' => $this->post('TTL'),
            'jenis_kelamin' => $this->post('jenis_kelamin'),
            'kontak' => $this->post('kontak'),
            'alamat' => $this->post('alamat'),
            'gaji' => $this->post('gaji'),
        ];

        if ($this->pegawai->createPegawai($data) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'new Data pegawai Created',
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to create data pegawai',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'id_divisi' => $this->put('id_divisi'),
            'id_jabatan' => $this->put('id_jabatan'),
            'nama_depan' => $this->put('nama_depan'),
            'nama_belakang' => $this->put('nama_belakang'),
            'TTL' => $this->put('TTL'),
            'jenis_kelamin' => $this->put('jenis_kelamin'),
            'kontak' => $this->put('kontak'),
            'alamat' => $this->put('alamat'),
            'gaji' => $this->put('gaji'),
        ];

        if ($this->pegawai->updatePegawai($data, $id) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'Data pegawai updated',
                'id' => $id,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to update data pegawai',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
