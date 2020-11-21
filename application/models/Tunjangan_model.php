<?php

class Tunjangan_model extends CI_Model
{
    public function getTunjangan($id = null)
    {
        if ($id === null) {
            return $this->db->get('tunjangan')->result_array();
        } else {
            return $this->db->get_where('tunjangan', ['id_tunjangan' => $id])->result_array();
        }
    }
}
