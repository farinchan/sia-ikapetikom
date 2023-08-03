<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Dashboard extends CI_Model{

    public function __construct(){
        parent :: __construct();
        $this->load->database();
    }

    public function getAlumni(){
        $this->db->where('status_akun', "Y");
        return $this->db->get('alumni');
    }

    public function getBerita(){
        $this->db->where('status_berita', "Y");
        return $this->db->get('berita');
    }

    public function getTopik(){
        $this->db->where('status_topik', "Y");
        return $this->db->get('topik');
    }

    public function getDonasi(){
        return $this->db->get('donasi');
    }

    public function get_loglogin_query(){
        $coloumn_order = array('nama', 'tahun_lulus', 'tanggal');
        $coloumn_search = array('nama', 'tahun_lulus', 'tanggal');
        $order = array('tanggal'=>'DESC');

        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('log_login', 'alumni.nisn = log_login.nisn');
        $this->db->where('status_akun', "Y");

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

    public function getloglogin(){

        $this->get_loglogin_query();
        if($_POST['length'] != -1){

            $this->db->limit($_POST['length'], $_POST['start']);

        }

        return $this->db->get()->result();

    }

    public function count_filtered_loglogin(){

        $this->get_loglogin_query();
        return $this->db->get()->num_rows();

    }

    public function count_all_loglogin(){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('log_login', 'alumni.nisn = log_login.nisn');
        $this->db->where('status_akun', "Y");
        return $this->db->get()->num_rows();

    }

    public function getTransaksi(){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('transaksi_donasi', 'transaksi_donasi.nisn = alumni.nisn');
        $this->db->join('donasi', 'donasi.id_donasi = transaksi_donasi.id_donasi');
        $this->db->where('status_pembayaran', "Y");
        $this->db->or_where('status_pembayaran', "N");
        $this->db->limit(7);
        return $this->db->get();
    }

    public function getGaleri($rowpage, $rowno){
        $this->db->select('*');
        $this->db->from('galeri');
        // $this->db->join('galeri_kegiatan', 'galeri.id_galeri = galeri_kegiatan.id_galeri');
        $this->db->limit($rowpage, $rowno);
        return $this->db->get()->result_array();

    }

    public function TotGaleri(){

        return $this->db->get('galeri')->num_rows();
    }

    //tambahan
    public function getGaleriKegiatan($rowpage, $rowno){
        $this->db->limit($rowpage, $rowno);
        return $this->db->get('galeri');
    }

    public function getGaleriKegiatanById($id){
        $this->db->where('id_galeri', $id);
        $res = $this->db->get('galeri');
        foreach ($res->result() as $x):
            return $x->judul_kegiatan;
        endforeach;
    }

    public function getDetailGaleri($id){
        $this->db->where('id_galeri', $id);
        return $this->db->get('galeri_kegiatan');
    }

    // tambahan 04 - 06 - 2021

    public function getGambarLimit1($id){
        $this->db->where('id_galeri', $id);
        $this->db->where('type', "foto");
        $res = $this->db->get('galeri_kegiatan');
        foreach($res->result() as $x):
            return $x->file;
        endforeach;

    }


    

}
?>