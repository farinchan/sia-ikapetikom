<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Alumni extends CI_Model{

    public function __construct(){
        parent :: __construct();
        $this->load->database();
    }

    public function getTahunlulus(){

        return $this->db->get('view_totalalumni');
        
    }

    public function tambahtahunlulus($data){

        $this->db->insert('tahun_lulus', $data);

    }

    public function gettahunlulusbyvalue($tahunlulus){
        $this->db->where('tahun_lulus', $tahunlulus);
        return $this->db->get('tahun_lulus');
    }

    public function hapustahunlulus($tahunlulus){
        $this->db->where('tahun_lulus', $tahunlulus);
        $this->db->delete('tahun_lulus');
    }

    public function get_listalumni_query(){
        $coloumn_order = array('nisn', 'nama_alumni', 'tahun_lulus', 'status_alumni', 'detail_status', null);
        $coloumn_search = array('nisn', 'nama_alumni', 'tahun_lulus', 'status_alumni', 'detail_status');
        $order = array('nisn'=>'DESC');

        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->where('status_akun', "Y");

        $i = 0;

        foreach ($coloumn_search as $item){

            if($_POST['search']['value']){

                if($i == 0){

                    $this->db->like($item, $_POST['search']['value']);
                    $this->db->where('status_akun', "Y");

                }else{

                    $this->db->or_like($item, $_POST['search']['value']);
                    $this->db->where('status_akun', "Y");

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

    public function getlistalumni(){

        $this->get_listalumni_query();
        if($_POST['length'] != -1){

            $this->db->limit($_POST['length'], $_POST['start']);

        }

        return $this->db->get()->result();

    }

    public function count_filtered_alumni(){

        $this->get_listalumni_query();
        return $this->db->get()->num_rows();

    }

    public function count_all_alumni(){
        $this->db->where('status_akun', "Y");
        return $this->db->get('alumni')->num_rows();

    }

    public function getAlumni($nisn){
        $this->db->where('nisn', $nisn);
        return $this->db->get('alumni');
    }

    public function getnamaAlumni($nisn){
        $x = $this->getAlumni($nisn);
        foreach ($x->result() as $y){
            return $y->nama_alumni;
        }
    } 
    
    public function hapusAlumni($nisn){
        $this->db->where('nisn', $nisn);
        $this->db->delete('alumni');
    }

    public function getAlumniRes(){
        return $this->db->get('alumni')->result();
    }

    public function getAlumniAktif(){
        return $this->db->where('status_akun', "Y")->get("alumni");
    }

    public function totalberita_acc($nisn){
        $this->db->where('nisn', $nisn);
        $this->db->where('status_berita', "Y");
        return $this->db->get('berita')->num_rows();
    }

    public function totalberita_noacc($nisn){
        $this->db->where('nisn', $nisn);
        $this->db->where('status_berita', "N");
        return $this->db->get('berita')->num_rows();
    }

    public function totaltopik($nisn){
        $this->db->where('nisn', $nisn);
        return $this->db->get('topik')->num_rows();
    }

    public function getBeritaAlumni($nisn){
        $this->db->select('*');
        $this->db->from('kategori_berita');
        $this->db->join('berita', 'kategori_berita.id_kategoriberita = berita.id_kategoriberita');
        $this->db->where('nisn', $nisn);
        $this->db->order_by('id_berita', "DESC");
        return $this->db->get();
    }

    public function getBeritaDetail($idberita){
        $this->db->select('*');
        $this->db->from('kategori_berita');
        $this->db->join('berita', 'kategori_berita.id_kategoriberita = berita.id_kategoriberita');
        $this->db->where('id_berita', $idberita);
        return $this->db->get();
    }

    public function getJudulberita($idberita){
        $list = $this->getBeritaDetail($idberita);
        foreach ($list->result() as $x):
            return $x->judul_berita;
        endforeach;
    }

    public function getBeritaAlumniDetail($idberita){
        $this->db->select('*');
        $this->db->from('kategori_berita');
        $this->db->join('berita', 'kategori_berita.id_kategoriberita = berita.id_kategoriberita');
        $this->db->where('id_berita', $idberita);
        $this->db->order_by('id_berita', "DESC");
        return $this->db->get();
    }

    public function getlisttopikbyalumni($nisn){
        $this->db->select('*');
        $this->db->from('kategori_topik');
        $this->db->join('topik', 'kategori_topik.id_kategoritopik = topik.id_kategoritopik');
        $this->db->join('alumni','topik.nisn = alumni.nisn');
        $this->db->where('alumni.nisn', $nisn);
        $this->db->order_by('id_topik', "DESC");
        return $this->db->get();
    }

    public function cektopik_byid_nisn($idtopik){
        $this->db->where('id_topik', $idtopik);
        return $this->db->get('topik');
    }

    public function getNamaFileTopikOld($idtopik){
        $this->db->where('id_topik', $idtopik);
        $x = $this->db->get('topik')->result();
        foreach ($x as $y):
            return $y->lampiran_file;
        endforeach;
    }

    public function hapustopik($idtopik){
        $this->db->where('id_topik', $idtopik);
        $this->db->delete('topik');
    }

    public function get_listalumni_acc_query(){
        $coloumn_order = array('nisn', 'nama_alumni', 'tahun_lulus', 'status_alumni', 'detail_status', null);
        $coloumn_search = array('nisn', 'nama_alumni', 'tahun_lulus', 'status_alumni', 'detail_status');
        $order = array('nisn'=>'DESC');

        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->where('status_akun', "N");

        $i = 0;

        foreach ($coloumn_search as $item){

            if($_POST['search']['value']){

                if($i == 0){

                    $this->db->like($item, $_POST['search']['value']);
                    $this->db->where('status_akun', "N");

                }else{

                    $this->db->or_like($item, $_POST['search']['value']);
                    $this->db->where('status_akun', "N");

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

    public function getlistalumni_acc(){

        $this->get_listalumni_acc_query();
        if($_POST['length'] != -1){

            $this->db->limit($_POST['length'], $_POST['start']);

        }

        return $this->db->get()->result();

    }

    public function count_filtered_alumni_acc(){

        $this->get_listalumni_acc_query();
        return $this->db->get()->num_rows();

    }

    public function count_all_alumni_acc(){
        $this->db->where('status_akun', "N");
        return $this->db->get('alumni')->num_rows();

    }

    public function total_alumni_acc(){
        $this->db->where('status_akun', "N");
        return $this->db->get('alumni')->num_rows();
    }

    public function edittopik($idtopik, $data){
        $this->db->where('id_topik', $idtopik);
        $this->db->update('topik', $data);
    }
    
    
        //tambahan riwayat pekerjaan dan pendidikan
    
    public function tambahRiwayatPekerjaan($data){
        $this->db->insert('riwayat_pekerjaan', $data);
    }

    public function tambahRiwayatPendidikan($data){
        $this->db->insert('riwayat_pendidikan', $data);
    }

    public function getRiwayatPekerjaan($nisn){
        $this->db->where('nisn', $nisn);
        return $this->db->get('riwayat_pekerjaan');
    }

    public function getRiwayatPendidikan($nisn){
        $this->db->where('nisn', $nisn);
        return $this->db->get('riwayat_pendidikan');
    }

    public function hapusRiwayatPendidikanByid($id){
        $this->db->where('id_riwayat', $id);
        $this->db->delete('riwayat_pendidikan');
    }

    public function hapusRiwayatPekerjaanByid($id){
        $this->db->where('id_pekerjaan', $id);
        $this->db->delete('riwayat_pekerjaan');
    }

    public function hapusSemuaRiwayatPendidikan($nisn){
        $this->db->where('nisn', $nisn);
        $this->db->delete('riwayat_pendidikan');
    }

    public function hapusSemuaRiwayatPekerjaan($nisn){
        $this->db->where('nisn', $nisn);
        $this->db->delete('riwayat_pekerjaan');
    }
    
}
?>