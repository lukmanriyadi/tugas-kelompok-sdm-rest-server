<?php

class Pelanggaran_model extends CI_Model
{
    public function getPelanggaran($id = null)
    {
        if ($id === null) {
            return $this->db->get('pelanggran')->result_array();
        } else {
            return $this->db->get_where('pelanggaran', ['id_pelanggaran' => $id])->result_array();
        }
    }
}
