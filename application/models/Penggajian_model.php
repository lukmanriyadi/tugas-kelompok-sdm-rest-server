<?php

class Penggajian_model extends CI_Model
{
    public function getPenggajian($id = null)
    {
        if ($id === null) {
            $this->db->select(
                'gaji.id_pembayaran,
                pegawai.nama_depan,
                pegawai.nama_belakang,
                divisi.nama_divisi,
                jabatan.nama_jabatan,
                concat(gaji.periode_bulan, "-", gaji.periode_tahun) as periode,
                gaji.tgl_pembayaran,
                gaji.gaji_pokok,
                gaji.tunjangan,
                gaji.potongan,
                gaji.gaji_total'
            );
            $this->db->from('gaji');
            $this->db->join('pegawai', 'gaji.id_pegawai = pegawai.id_pegawai');
            $this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
            $this->db->join('divisi', 'pegawai.id_divisi = divisi.id_divisi');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            $this->db->select(
                'gaji.id_pembayaran,
                pegawai.nama_depan,
                pegawai.nama_belakang,
                divisi.nama_divisi,
                jabatan.nama_jabatan,
                concat(gaji.periode_bulan, "-", gaji.periode_tahun) as periode,
                gaji.tgl_pembayaran,
                gaji.gaji_pokok,
                gaji.tunjangan,
                gaji.potongan,
                gaji.gaji_total'
            );
            $this->db->from('gaji');
            $this->db->join('pegawai', 'gaji.id_pegawai = pegawai.id_pegawai');
            $this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
            $this->db->join('divisi', 'pegawai.id_divisi = divisi.id_divisi');
            $this->db->where('id_pembayaran', $id);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function getPerPeriode($bulan, $tahun)
    {
        $this->db->select(
            'gaji.id_pembayaran,
            pegawai.nama_depan,
            pegawai.nama_belakang,
            divisi.nama_divisi,
            jabatan.nama_jabatan,
            concat(gaji.periode_bulan, "-", gaji.periode_tahun) as periode,
            gaji.tgl_pembayaran,
            gaji.gaji_pokok,
            gaji.tunjangan,
            gaji.potongan,
            gaji.gaji_total'
        );
        $this->db->from('gaji');
        $this->db->join('pegawai', 'gaji.id_pegawai = pegawai.id_pegawai');
        $this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
        $this->db->join('divisi', 'pegawai.id_divisi = divisi.id_divisi');
        $this->db->where('periode_bulan', $bulan);
        $this->db->where('periode_tahun', $tahun);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPerPegawai($id)
    {
        $this->db->select(
            'gaji.id_pembayaran,
            pegawai.nama_depan,
            pegawai.nama_belakang,
            divisi.nama_divisi,
            jabatan.nama_jabatan,
            concat(gaji.periode_bulan, "-", gaji.periode_tahun) as periode,
            gaji.tgl_pembayaran,
            gaji.gaji_pokok,
            gaji.tunjangan,
            gaji.potongan,
            gaji.gaji_total'
        );
        $this->db->from('gaji');
        $this->db->join('pegawai', 'gaji.id_pegawai = pegawai.id_pegawai');
        $this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
        $this->db->join('divisi', 'pegawai.id_divisi = divisi.id_divisi');
        $this->db->where('pegawai.id_pegawai', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
