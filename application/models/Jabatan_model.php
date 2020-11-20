<?php

class Divisi_model extends CI_Model
{
    public function getJabatan($id = null)
    {
        if ($id === null) {
            return $this->db->get('jabatan')->result_array();
        } else {
            return $this->db->get_where('jabatan', ['id_jabatan' => $id])->result_array();
        }
    }


    public function deleteJabatan($id)
    {
        $this->db->delete('jabatan', ['id_jabatan' => $id]);
        return $this->db->affected_rows();
    }

    public function createJabatan($data)
    {
        $this->db->insert('jabatan', $data);
        return $this->db->affected_rows();
    }

    public function updateJabatan($data, $id)
    {
        $this->db->update('jabatan', $data, ['id_jabatan' => $id]);
        return $this->db->affected_rows();
    }
}
