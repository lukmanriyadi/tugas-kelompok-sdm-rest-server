<?php

class Penggajian_model extends CI_Model
{
    public function getPenggajian($id = null)
    {
        if ($id === null) {
            return $this->db->get('gaji')->result_array();
        } else {
            return $this->db->get_where('gaji', ['id_pembayaran' => $id])->result_array();
        }
    }
}
