<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_pekerjaan extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_riwayat_pekerjaan($nisn)
    {
        return $this->db->get_where('riwayat_pekerjaan', ['nisn' => $nisn]);
    }
    public function check_if_exist($nisn)
    {
        // return $this->db->get_where('pekerjaan', ['nisn' => $nisn])->num_rows();
        $this->db->where('nisn', $nisn);
        $this->db->limit(1);
        $query = $this->db->get('pekerjaan');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function get_data_pekerjaan($nisn)
    {
        $data = $this->db->get_where('pekerjaan', ['nisn' => $nisn], 1)->result()[0];
        $arr = [];
        $arr = [
            'id_pekerjaan' => $data->id_pekerjaan == null ? '-' : $data->id_pekerjaan,
            'nisn' => $data->nisn == null ? '-' : $data->nisn,
            'tempat_kerja' => $data->tempat_kerja == null ? '-' : $data->tempat_kerja,
            'lama_menganggur' => $data->lama_menganggur == null ? '-' : $data->lama_menganggur,
            'sumber_informasi_pekerjaan' => $data->sumber_informasi_pekerjaan == null ? '-' : $data->sumber_informasi_pekerjaan,
            'kapan_mulai_mencari' => $data->kapan_mulai_mencari == null ? '-' : $data->kapan_mulai_mencari,
            'cara_dapat' => $data->cara_dapat == null ? '-' : $data->cara_dapat,
            'gaji_pekerjaan_pertama' => $data->gaji_pekerjaan_pertama == null ? '-' : $data->gaji_pekerjaan_pertama,
            'lama_bekerja_saat_ini' => $data->lama_bekerja_saat_ini == null ? '-' : $data->lama_bekerja_saat_ini,
            'bidang_pekerjaan' => $data->bidang_pekerjaan == null ? '-' : $data->bidang_pekerjaan,
            'deskripsi_bidang_pekerjaan' => $data->deskripsi_bidang_pekerjaan == null ? '-' : $data->deskripsi_bidang_pekerjaan,
            'sesuai' => $data->sesuai == null ? '-' : $data->sesuai,
            'gaji_pertama_bekerja' => $data->gaji_pertama_bekerja == null ? '-' : $data->gaji_pertama_bekerja,
            'gaji_sekarang_bekerja' => $data->gaji_sekarang_bekerja == null ? '-' : $data->gaji_sekarang_bekerja,
            'gaji_harapan' => $data->gaji_harapan == null ? '-' : $data->gaji_harapan,
            'permasalahan_pekerjaan' => $data->permasalahan_pekerjaan == null ? '-' : $data->permasalahan_pekerjaan,
        ];
        return $arr;
    }
    public function update_trace_pekerjaan($nisn, $data)
    {
        // return $this->db->get_where('pekerjaan', ['nisn' => $nisn])->result_array()[0];
        $this->db->where('nisn', $nisn);
        return $this->db->update('pekerjaan', $data);
        
    }
    public function insert_trace_pekerjaan($data)
    {
        // return $this->db->get_where('pekerjaan', ['nisn' => $nisn])->result_array()[0];
        return $this->db->insert('pekerjaan', $data);
        // return ($this->db->affected_rows() != 1) ? false : true;
    }
}
