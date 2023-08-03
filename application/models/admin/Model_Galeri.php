<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Galeri extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function tambahdata($data){
        $this->db->insert('galeri_kegiatan', $data);
    }

    public function listFoto(){
        $this->db->where('type', "foto");
        $this->db->order_by('id', "DESC");
        return $this->db->get('galeri_kegiatan');
    }

    public function listVideo(){
        $this->db->where('type', "video");
        $this->db->order_by('id', "DESC");
        return $this->db->get('galeri_kegiatan');
    }

    public function ListData($id){
        $this->db->where('id', $id);
        return $this->db->get('galeri_kegiatan');
    }

    public function EditData($id, $data){
        $this->db->where('id', $id);
        $this->db->update('galeri_kegiatan', $data);
    }

    public function getFoto($id){
        $res = $this->ListData($id);
        foreach ($res->result() as $x):
            return $x->file;
        endforeach;
    }

    public function Hapus($id){
        $this->db->where('id', $id);
        $this->db->delete('galeri_kegiatan');
    }

    // Revisi

    public function getDataGaleri(){
        return $this->db->get('galeri');
    }

    public function tambahkegiatan($data){
        $this->db->insert('galeri', $data);
    }

    public function getDetail($id){
        $this->db->where('id_galeri', $id);
        return $this->db->get('galeri_kegiatan');
    }

    public function getNamaKegiatan($id){
        $this->db->where('id_galeri', $id);
        $res = $this->db->get('galeri');
        foreach ($res->result() as $x){
            return $x->judul_kegiatan;        
        }
    }

    public function getDetailByid($id){
        $this->db->where('id', $id);
        return $this->db->get('galeri_kegiatan');
    }

    public function getGaleriByid($id){
        $this->db->where('id_galeri', $id);
        return $this->db->get('galeri');

    }

    public function editGaleriKegiatan($id, $data){
        $this->db->where('id_galeri', $id);
        $this->db->update('galeri', $data);
    }

    public function hapuskegiatan($id){
        $this->db->where('id_galeri', $id);
        $this->db->delete('galeri');
    }
}
?>