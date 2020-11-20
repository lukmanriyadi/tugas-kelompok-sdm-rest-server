<?php

class Absensi_model extends CI_Model
{
    public function getAbsensi($id = null)
    {
        if ($id === null) {
            return $this->db->get('absensi')->result_array();
        } else {
            return $this->db->get_where('absensi', ['id_absen' => $id])->result_array();
        }
    }
}
