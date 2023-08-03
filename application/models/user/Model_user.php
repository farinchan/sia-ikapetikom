<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_user extends CI_Model{
    public function __construct(){
        parent :: __construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
    }

    // log login

    public function insertloglogin($nisn){
        $this->deleteloglogin($nisn);
        $data = array(
            'nisn' => $nisn,
            'tanggal' => date('Y-m-d H:i:s')
        );

        $this->db->insert('log_login', $data);
    }

    public function deleteloglogin($nisn){
        $this->db->where('nisn', $nisn);
        $this->db->delete('log_login');
    }

    //get nama alumni 

    public function getnamaalumni($nisn){
        $this->db->where('nisn', $nisn);
        $res = $this->db->get('alumni')->result();
        foreach ($res as $x):
            return $x->nama_alumni;
        endforeach;
    }

    //get terakhir kali alumni login

    public function lastlogin($nisn){
        $this->db->where('nisn', $nisn);
        $res = $this->db->get('log_login');
        foreach ($res->result() as $x):
            $lastlogin = strtotime($x->tanggal);
        endforeach;

        $this->db->where('nisn', $nisn);
        $thn = $this->db->get('alumni');
        foreach ($thn->result() as $y):
            $tahun_lulus = $y->tahun_lulus;
            $foto_alumni = $y->foto_alumni;
        endforeach;
        

        $timenow = strtotime(date('Y-m-d H:i:s'));
        $diff = abs($timenow - $lastlogin);

        $years = floor($diff / (365*60*60*24)); 
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

        return array(
            'hari' => $days,
            'jam' => $hours,
            'menit' => $minutes,
            'tahun_lulus' => $tahun_lulus,
            'foto_alumni' => $foto_alumni
        );

    }

    public function getDataAlumni($nisn){
        $this->db->where('nisn', $nisn);
        return $this->db->get('alumni');
    }

    public function getKota($nisn){
        $res = $this->getDataAlumni($nisn);

        foreach ($res->result() as $x){
            $kode_provinsi = $x->alamat_provinsi;
            $kode_kabupaten = $x->alamat_kabupaten;
            $kode_kecamatan = $x->alamat_kecamatan;        
        }

        return array(
            'alamat_provinsi' => $this->getNamakota($kode_provinsi),
            'alamat_kabupaten' => $this->getNamakota($kode_kabupaten),
            'alamat_kecamatan' => $this->getNamakota($kode_kecamatan)
        );

    }

    public function getNamakota($kode){
        $this->db->where('kode', $kode);
        $res = $this->db->get('wilayah_2020');

        foreach ($res->result() as $x){
            return $x->nama;
        }
    }

    public function updateprofil($nisn, $data){
        $this->db->where('nisn', $nisn);
        $this->db->update('alumni', $data);
    }

    public function getfotoprofil_old($nisn){
        $this->db->where('nisn', $nisn);
        $res = $this->db->get('alumni');

        foreach ($res->result() as $x):
            return $x->foto_alumni;
        endforeach;
    }

    //berita
    public function listkategoriberita(){
        return $this->db->get('kategori_berita');
    }

    public function insertberita($data){
        $this->db->insert('berita', $data);
    }

    public function getlistberitaalumni_published(){
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('status_berita', "Y");
        return $this->db->get('berita');
    }

    public function getlistberitaalumni_unpublished(){
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('status_berita', "N");
        return $this->db->get('berita');
    }

    //listberita
    public function get_listberita_query(){
        $coloumn_order = array('judul_berita', 'nama_kategoriberita', 'tanggal_posting', 'status_berita', 'total_dilihat', null);
        $coloumn_search = array('judul_berita', 'nama_kategoriberita');
        $order = array('id_berita'=>'DESC');

        $this->db->select('*');
        $this->db->from('kategori_berita');
        $this->db->join('berita', 'kategori_berita.id_kategoriberita = berita.id_kategoriberita');
        $this->db->where('nisn', $_SESSION['nisn_session']);

        $i = 0;

        foreach ($coloumn_search as $item){

            if($_POST['search']['value']){

                if($i == 0){

                    $this->db->like($item, $_POST['search']['value']);
                    $this->db->where('nisn', $_SESSION['nisn_session']);


                }else{

                    $this->db->or_like($item, $_POST['search']['value']);
                    $this->db->where('nisn', $_SESSION['nisn_session']);

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
        $this->db->join('berita', 'kategori_berita.id_kategoriberita = berita.id_kategoriberita');
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->order_by('id_berita', "DESC");
        return $this->db->count_all_results();

    }

    public function hapusberita($id){
        $this->db->where('id_berita', $id);
        $this->db->delete('berita');
    }

    public function getgambarberita_old($id){
        $this->db->where('id_berita', $id);
        $res = $this->db->get('berita')->result();
        foreach ($res as $x):
            return $x->gambar_berita;
        endforeach;
    }

    public function cekberita($id){
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('id_berita', $id);
        return $this->db->get('berita');
    }

    public function editberita($id, $data){
        $this->db->where('id_berita', $id);
        $this->db->update('berita', $data);
    }

    public function totalberita_alumni(){
        $this->db->where('nisn', $_SESSION['nisn_session']);
        return $this->db->get('berita');
    }

    //list alumni
    public function get_listalumni_query(){
        $coloumn_order = array('nama_alumni', 'tahun_lulus', 'status_alumni', 'detail_status', null);
        $coloumn_search = array('nama_alumni', 'tahun_lulus', 'status_alumni', 'detail_status');
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

    public function filteralumni($nama_alumni, $tahun_lulus){

        // return $this->db->query("SELECT *FROM alumni WHERE alamat_provinsi = '$provinsi' AND alamat_kabupaten = '$kabupaten' AND alamat_kecamatan = '$kecamatan' AND tahun_lulus = '$tahun_lulus' AND nama_alumni LIKE '%$nama_alumni%'");
        return $this->db->query("SELECT *FROM alumni WHERE tahun_lulus = '$tahun_lulus' AND nama_alumni LIKE '%$nama_alumni%'");

    }

    public function get_alumni_by_nisn($nisn){
        $this->db->where('nisn', $nisn);
        return $this->db->get('alumni');
    }

    public function totalberita_lihatalumni($nisn){
        $this->db->where('nisn', $nisn);
        return $this->db->get('berita');
    }

    //pesan 
    public function tambahpesan($data){
        $this->db->insert('pesan_alumni', $data);
    }

    public function listpesan($nisn){
        $this->db->where('nisn_tujuan', $nisn);
        $this->db->where('nisn_pengirim', $_SESSION['nisn_session']);
        $this->db->or_where('nisn_tujuan', $_SESSION['nisn_session']);
        $this->db->where('nisn_pengirim', $nisn);
        $this->db->order_by('id_pesan', 'DESC');
        return $this->db->get('pesan_alumni');
    }

    public function listpesanbelumdibaca($nisn){
        $this->db->where('nisn_tujuan', $_SESSION['nisn_session']);
        $this->db->where('nisn_pengirim', $nisn);
        $this->db->where('terbaca_tujuan', "N");
        $this->db->order_by('id_pesan', 'DESC');
        return $this->db->get('pesan_alumni');
    }


    public function getnisnpengirimpesan(){

        return $this->db->query("SELECT DISTINCT nisn_pengirim FROM pesan_alumni WHERE nisn_tujuan = '$_SESSION[nisn_session]'");

    }

    public function getnisntujuanpesan(){

        return $this->db->query("SELECT DISTINCT nisn_tujuan FROM pesan_alumni WHERE nisn_pengirim = '$_SESSION[nisn_session]'");

    }

    public function get_nama_nisn_pengirimpesan(){

        $data = $this->getnisnpengirimpesan();
        foreach ($data->result() as $x){

            $this->db->where('nisn', $x->nisn_pengirim);
            $query = $this->db->get('alumni')->result();

            foreach ($query as $y){

                $result[] = array( 'nama_alumni'=>$y->nama_alumni, 'nisn'=>$y->nisn, 'not_watch'=>$this->listpesanbelumdibaca($y->nisn)->num_rows());
                

            }
            
        }

        if(empty($result)){

            return null;

        }else{

            return $result;

        }

    }

    public function get_nama_nisn_tujuanpesan(){

        $data = $this->getnisntujuanpesan();
        foreach ($data->result() as $x){

            $this->db->where('nisn', $x->nisn_tujuan);
            $query = $this->db->get('alumni')->result();

            foreach ($query as $y){

                $result[] = array( 'nama_alumni'=> $y->nama_alumni, 'nisn'=>$y->nisn, 'not_watch'=>$this->listpesanbelumdibaca($y->nisn)->num_rows());
            }
            
        }

        if(empty($result)){

            return null;

        }else{

            return $result;

        }


    }

    public function pesandibaca($nisn){
        $data = array('terbaca_tujuan'=>"Y");
        $this->db->where('nisn_tujuan', $_SESSION['nisn_session']);
        $this->db->where('nisn_pengirim', $nisn);
        $this->db->update('pesan_alumni', $data);
    }

    public function pesanbelumterbaca(){
        $this->db->where('nisn_tujuan', $_SESSION['nisn_session']);
        $this->db->where('terbaca_tujuan', "N");
        return $this->db->get('pesan_alumni');
    }

    //topik
    
    public function getlistkategoritopik(){
        return $this->db->get('kategori_topik');
    }

    public function inserttopik($data){
        $this->db->insert('topik', $data);
    }

    public function totaltopikdibuat(){
        $this->db->where('nisn', $_SESSION['nisn_session']);
        return $this->db->get('topik');
    }

    public function getlisttopikbyalumni(){
        $this->db->select('*');
        $this->db->from('kategori_topik');
        $this->db->join('topik', 'kategori_topik.id_kategoritopik = topik.id_kategoritopik');
        $this->db->join('alumni','topik.nisn = alumni.nisn');
        $this->db->where('alumni.nisn', $_SESSION['nisn_session']);
        $this->db->order_by('id_topik', "DESC");
        return $this->db->get();
    }

    public function getlisttopikbyalumni_published(){
        $this->db->where('status_topik', 'Y');
        $this->db->where('nisn', $_SESSION['nisn_session']);
        return $this->db->get('topik');
    }

    public function getlisttopikbyalumni_unpublished(){
        $this->db->where('status_topik', 'N');
        $this->db->where('nisn', $_SESSION['nisn_session']);
        return $this->db->get('topik');
    }

    public function cektopik_byid_nisn($idtopik){
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('id_topik', $idtopik);
        return $this->db->get('topik');
    }

    public function edittopik($idtopik, $data){
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('id_topik', $idtopik);
        $this->db->update('topik', $data);
    }

    public function getNamaFileTopikOld($idtopik){
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('id_topik', $idtopik);
        $x = $this->db->get('topik')->result();
        foreach ($x as $y):
            return $y->lampiran_file;
        endforeach;
    }

    public function hapustopik($idtopik){
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('id_topik', $idtopik);
        $this->db->delete('topik');
    }

    public function jumlahtopik_angkatan(){
        return $this->db->get('view_totaltopik_angkatan');
    }

    public function topikpopulerlimit6(){
        return $this->db->get('view_topikpopuler');
    }

    //list topik
    
    public function listtopik($rowpage, $rowno){
        $this->db->limit($rowpage, $rowno);
        $this->db->order_by('id_topik', "DESC");
        return $this->db->get('view_listtopik')->result_array();
    }

    public function countlisttopik(){
        return $this->db->count_all('view_listtopik');
    }

    public function isitopik($idtopik){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('topik', 'alumni.nisn = topik.nisn');
        $this->db->where('id_topik', $idtopik);
        return $this->db->get();
    }

    public function gettahunlulusbynisn(){
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $x = $this->db->get('alumni');
        foreach ($x->result() as $y):
            return $y->tahun_lulus;
        endforeach;
    }

    public function totalkomentar($idtopik){
        $this->db->where('id_topik', $idtopik);
        return $this->db->get('diskusi');
    }

    public function getdiskusi($idtopik){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('diskusi', 'diskusi.nisn = alumni.nisn');
        $this->db->where('id_topik', $idtopik);
        $this->db->order_by('id_diskusi', "DESC");
        return $this->db->get();
    }

    public function tambahdiskusi($data){
        $this->db->insert('diskusi', $data);
    }

    public function countertopik($idtopik){
        $this->db->where('id_topik', $idtopik);
        $x = $this->db->get('topik')->result();
        foreach ($x as $y){
            $last_view = $y->total_dilihat;
        }

        $data = array(
            'total_dilihat' => $last_view + 1
        );

        $this->db->where('id_topik', $idtopik);
        $this->db->update('topik', $data);

    }

    //list berita user

    public function userlistkategoriberita(){
        return $this->db->get('view_kategori_berita');
    }

    public function userberitapopuler(){
        $this->db->where('status_berita', 'y');
        $this->db->order_by('total_dilihat', "DESC");
        $this->db->limit(6);
        return $this->db->get('berita');
    }

    public function userlistberita($rowpage, $rowno){
        $this->db->where('status_berita', 'y');
        $this->db->limit($rowpage, $rowno);
        $this->db->order_by('id_berita', "DESC");
        return $this->db->get('berita')->result_array();
    }

    public function usercountallberita(){
        $this->db->where('status_berita', 'y');
        return $this->db->count_all('berita');
    }

    public function getBeritabyid($idberita){
        $this->db->select('*');
        $this->db->from('kategori_berita');
        $this->db->join('berita', 'kategori_berita.id_kategoriberita=berita.id_kategoriberita');
        $this->db->join('alumni', 'alumni.nisn=berita.nisn');
        $this->db->where('id_berita', $idberita);
        return $this->db->get();
    }

    public function counterberita($idberita){
        $this->db->where('id_berita', $idberita);
        $x = $this->db->get('berita');
        foreach ($x->result() as $y):
            $last_view = $y->total_dilihat;
        endforeach;

        $data = array(
            'total_dilihat' => $last_view + 1
        );

        $this->db->where('id_berita', $idberita);
        $this->db->update('berita', $data);

    }

    //get berita by kategori
    public function userlistberitabykategori($rowpage, $rowno, $idkategori){
        $this->db->where('id_kategoriberita', $idkategori);
        $this->db->where('status_berita', 'y');
        $this->db->limit($rowpage, $rowno);
        $this->db->order_by('id_berita', "DESC");
        return $this->db->get('berita')->result();
    }

    public function usercountberitabykategori($idkategori){
        $this->db->where('id_kategoriberita', $idkategori);
        $this->db->where('status_berita', 'y');
        return $this->db->get('berita')->num_rows();
    }

    public function getnamakategoriberita($idkategori){
        $this->db->where('id_kategoriberita', $idkategori);
        $x = $this->db->get('kategori_berita');
        foreach ($x->result() as $y) {
            return $y->nama_kategoriberita;
        }
    }

    public function userlistberitabysearch($rowpage, $rowno, $search){
        $this->db->where('status_berita', 'y');
        $this->db->like('judul_berita', $search);
        $this->db->limit($rowpage, $rowno);
        $this->db->order_by('id_berita', "DESC");
        return $this->db->get('berita')->result();
    }

    public function usercountberitabysearch($search){
        $this->db->where('status_berita', 'y');
        $this->db->like('judul_berita', $search);
        return $this->db->get('berita')->num_rows();
    }

    public function getviewtotalalumni(){
        return $this->db->get('view_totalalumni');
    }

    public function userberitalandingpage(){
        $this->db->order_by('id_berita', "DESC");
        $this->db->limit(4);
        return $this->db->get('berita');
    }

    // beritadmin
    public function getberitadmin(){
        $this->db->where('status_berita', 'y');
        return $this->db->get('berita_admin');
    }

    public function getberitadminbyid($id){
        $this->db->select('*');
        $this->db->from('kategori_berita');
        $this->db->join('berita_admin', 'kategori_berita.id_kategoriberita=berita_admin.id_kategoriberita');
        $this->db->where('id_berita', $id);
        return $this->db->get();
    }

    public function counterberitadmin($idberita){
        $this->db->where('id_berita', $idberita);
        $x = $this->db->get('berita_admin');
        foreach ($x->result() as $y):
            $last_view = $y->total_dilihat;
        endforeach;

        $data = array(
            'total_dilihat' => $last_view + 1
        );

        $this->db->where('id_berita', $idberita);
        $this->db->update('berita_admin', $data);

    }

    public function userlistberitaadmin($rowpage, $rowno){
        $this->db->where('status_berita', 'y');
        $this->db->limit($rowpage, $rowno);
        $this->db->order_by('id_berita', "DESC");
        return $this->db->get('berita_admin')->result_array();
    }

    public function usercountallberitaadmin(){
        $this->db->where('status_berita', 'y');
        return $this->db->count_all('berita_admin');
    }

    public function tambahsubscribe($data){
        $this->db->insert('email', $data);
    }

}
?>