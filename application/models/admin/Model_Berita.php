<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Berita extends CI_Model{

    public function __construct(){
        parent :: __construct();
        $this->load->database();
    }

    public function getKategoriberita(){
        return $this->db->get('kategori_berita');
    }

    public function getKategoriberita_byid($idkategori){
        $this->db->where('id_kategoriberita', $idkategori);
        return $this->db->get('kategori_berita');
    }

    public function updateKategoriberita($idkategori, $data){
        $this->db->where('id_kategoriberita', $idkategori);
        $this->db->update('kategori_berita', $data);
    }

    public function tambah_kategoriberita($data){
        $this->db->insert('kategori_berita', $data);
    }

    public function cek_kategoriberita($nama){
        $this->db->where('nama_kategoriberita', $nama);
        return $this->db->get('kategori_berita');
    }

    public function hapus_kategoriberita($idkategori){
        $this->db->where('id_kategoriberita', $idkategori);
        $this->db->delete('kategori_berita');
    }

    public function tambahberita($data){
        $this->db->insert('berita_admin', $data);
    }

    public function get_listberita_query(){
        $coloumn_order = array('judul_berita', 'nama_kategoriberita', 'tanggal_posting', 'status_berita', 'total_dilihat', null);
        $coloumn_search = array('judul_berita', 'nama_kategoriberita');
        $order = array('id_berita'=>'DESC');

        $this->db->select('*');
        $this->db->from('kategori_berita');
        $this->db->join('berita_admin', 'kategori_berita.id_kategoriberita = berita_admin.id_kategoriberita');

        $i = 0;

        foreach ($coloumn_search as $item){

            if($_POST['search']['value']){

                if($i == 0){

                    $this->db->like($item, $_POST['search']['value']);

                }else{

                    $this->db->or_like($item, $_POST['search']['value']);

                }

                $i++;

            }

            if(isset($_POST['order'])){

                $this->db->order_by($coloumn_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

            }else if(isset($order)){

                $this->db->order_by(key($order), $order[key($order)]);

            }

        }

    }

    public function getlistberita(){

        $this->get_listberita_query();
        if($_POST['length'] != -1){

            $this->db->limit($_POST['length'], $_POST['start']);

        }

        return $this->db->get()->result();

    }

    public function count_filtered_berita(){

        $this->get_listberita_query();
        return $this->db->get()->num_rows();

    }

    public function count_all_berita(){

        $this->db->select('*');
        $this->db->from('kategori_berita');
        $this->db->join('berita_admin', 'kategori_berita.id_kategoriberita = berita_admin.id_kategoriberita');
        $this->db->order_by('id_berita', "DESC");
        return $this->db->count_all_results();

    }

    public function getBeritabyid($idberita){
        $this->db->where('id_berita', $idberita);
        return $this->db->get('berita_admin');
    }

    public function editberita($idberita, $data){
        $this->db->where('id_berita', $idberita);
        $this->db->update('berita_admin', $data);
    }

    public function hapusberita($id){
        $this->db->where('id_berita', $id);
        $this->db->delete('berita_admin');
    }

    public function hapusberita_alumni($id){
        $this->db->where('id_berita', $id);
        $this->db->delete('berita');
    }

    public function getgambarberita_old($id){
        $this->db->where('id_berita', $id);
        $res = $this->db->get('berita_admin')->result();
        foreach ($res as $x):
            return $x->gambar_berita;
        endforeach;
    }

    public function getgambarberita_oldAlumni($id){
        $this->db->where('id_berita', $id);
        $res = $this->db->get('berita')->result();
        foreach ($res as $x):
            return $x->gambar_berita;
        endforeach;
    }

    public function get_kontribusiberita_query(){
        $coloumn_order = array('nama_alumni', 'judul_berita', 'tanggal_posting', 'status_berita', 'total_dilihat', null);
        $coloumn_search = array('nama_alumni', 'judul_berita');
        $order = array('id_berita'=>'DESC');

        $this->db->select('*');
        $this->db->from('berita');
        $this->db->join('alumni', 'berita.nisn = alumni.nisn');

        $i = 0;

        foreach ($coloumn_search as $item){

            if($_POST['search']['value']){

                if($i == 0){

                    $this->db->like($item, $_POST['search']['value']);

                }else{

                    $this->db->or_like($item, $_POST['search']['value']);

                }

                $i++;

            }

            if(isset($_POST['order'])){

                $this->db->order_by($coloumn_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

            }else if(isset($order)){

                $this->db->order_by(key($order), $order[key($order)]);

            }

        }

    }

    public function getlistkontribusiberita(){

        $this->get_kontribusiberita_query();
        if($_POST['length'] != -1){

            $this->db->limit($_POST['length'], $_POST['start']);

        }

        return $this->db->get()->result();

    }

    public function count_filtered_kontribusiberita(){

        $this->get_kontribusiberita_query();
        return $this->db->get()->num_rows();

    }

    public function count_all_kontribusiberita(){

        $this->db->select('*');
        $this->db->from('berita');
        $this->db->join('alumni', 'berita.nisn = alumni.nisn');
        $this->db->order_by('id_berita', "DESC");
        return $this->db->count_all_results();

    }

    public function beritabelumacc(){
        $this->db->where('status_berita', "N");
        return $this->db->get('berita')->num_rows();
    }

    public function getBeritaAlumni(){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('berita', 'alumni.nisn=berita.nisn');
        $this->db->order_by('tanggal_posting', "DESC");
        return $this->db->get()->result();
    }

    public function getBeritaAdmin(){
        $this->db->order_by('tanggal_posting', "DESC");
        return $this->db->get('berita_admin')->result();
    }

}
?>