<?php

class Pegawai_model extends CI_Model
{
    public function getPegawai($id = null)
    {
        if ($id === null) {
            $this->db->select(
                'pegawai.id_pegawai,
                pegawai.nama_depan,
                pegawai.nama_belakang,
                divisi.nama_divisi,
                jabatan.nama_jabatan,
                pegawai.TTL,
                pegawai.jenis_kelamin,
                pegawai.kontak,
                pegawai.alamat,
                pegawai.gaji'
            );
            $this->db->from('pegawai');
            $this->db->join('divisi', 'pegawai.id_divisi = divisi.id_divisi');
            $this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            $this->db->select(
                'pegawai.id_pegawai,
                pegawai.nama_depan,
                pegawai.nama_belakang,
                divisi.nama_divisi,
                jabatan.nama_jabatan,
                pegawai.TTL,
                pegawai.jenis_kelamin,
                pegawai.kontak,
                pegawai.alamat,
                pegawai.gaji'
            );
            $this->db->from('pegawai');
            $this->db->join('divisi', 'pegawai.id_divisi = divisi.id_divisi');
            $this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
            $this->db->where('pegawai.id_pegawai', $id);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    public function getPegawaiPerDivisi($divisi)
    {
        $this->db->select(
            'pegawai.id_pegawai,
            pegawai.nama_depan,
            pegawai.nama_belakang,
            divisi.nama_divisi,
            jabatan.nama_jabatan,
            pegawai.TTL,
            pegawai.jenis_kelamin,
            pegawai.kontak,
            pegawai.alamat,
            pegawai.gaji'
        );
        $this->db->from('pegawai');
        $this->db->join('divisi', 'pegawai.id_divisi = divisi.id_divisi');
        $this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
        $this->db->where('divisi.nama_divisi', $divisi);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deletePegawai($id)
    {
        $this->db->delete('pegawai', ['id_pegawai' => $id]);
        return $this->db->affected_rows();
    }

    public function createPegawai($data)
    {
        $this->db->insert('pegawai', $data);
        return $this->db->affected_rows();
    }

    public function updatePegawai($data, $id)
    {
        $this->db->update('pegawai', $data, ['id_pegawai' => $id]);
        return $this->db->affected_rows();
    }
}
