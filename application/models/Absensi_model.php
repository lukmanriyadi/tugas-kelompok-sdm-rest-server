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

    public function getPerPeriode($bulan, $tahun)
    {
        $this->db->select(
            'absensi.id_absen,
            pegawai.nama_depan,
            pegawai.nama_belakang,
            divisi.nama_divisi,
            jabatan.nama_jabatan,
            concat(absensi.periode_bulan, "-", absensi.periode_tahun) as periode,
            absensi.tanggal as tanggal_absen,
            absensi.status,
            absensi.keterangan'
        );
        $this->db->from('absensi');
        $this->db->join('pegawai', 'absensi.id_pegawai = pegawai.id_pegawai');
        $this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
        $this->db->join('divisi', 'pegawai.id_divisi = divisi.id_divisi');
        $this->db->where('absensi.periode_bulan', $bulan);
        $this->db->where('absensi.periode_tahun', $tahun);
        $query = $this->db->get();
        return $query->result_array();
    }
}
