<?php

class Divisi_model extends CI_Model
{
    public function getDivisi($id = null)
    {
        if ($id === null) {
            return $this->db->get('divisi')->result_array();
        } else {
            return $this->db->get_where('divisi', ['id_divisi' => $id])->result_array();
        }
    }


    public function deleteDivisi($id)
    {
        $this->db->delete('divisi', ['id_divisi' => $id]);
        return $this->db->affected_rows();
    }

    public function createDivisi($data)
    {
        $this->db->insert('divisi', $data);
        return $this->db->affected_rows();
    }

    public function updateDivisi($data, $id)
    {
        $this->db->update('divisi', $data, ['id_divisi' => $id]);
        return $this->db->affected_rows();
    }
}
