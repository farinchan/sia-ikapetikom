<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Donasi extends CI_Model{

    public function __construct(){
        parent :: __construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->database();
    }


    public function getKategoridonasi(){
        return $this->db->get('kategori_donasi');
    }
    
    public function getKategoridonasiByid($id){
        $this->db->where('id_kategoridonasi', $id);
        return $this->db->get('kategori_donasi');
    }

    public function editkategoridonasi($id, $data){
        $this->db->where('id_kategoridonasi', $id);
        $this->db->update('kategori_donasi', $data);
    }

    public function tambahkategoridonasi($data){
        $this->db->insert('kategori_donasi', $data);
    }

    public function ceknamakateori($nama){
        $this->db->where('nama_kategoridonasi', $nama);
        return $this->db->get('kategori_donasi');
    }

    public function hapuskategoridonasi($id){
        $this->db->where('id_kategoridonasi', $id);
        $this->db->delete('kategori_donasi');
    }

    public function tambahdonasi($data){
        $this->db->insert('donasi', $data);
    }

    public function get_listdonasi_query(){
        $coloumn_order = array('judul_donasi', 'nama_kategoridonasi', 'donasi_dibuka', 'donasi_ditutup', 'target_dana', null);
        $coloumn_search = array('judul_donasi', 'nama_kategoridonasi', 'donasi_dibuka', 'donasi_ditutup', 'target_dana');
        $order = array('id_donasi'=>'DESC');

        $this->db->select('*');
        $this->db->from('kategori_donasi');
        $this->db->join('donasi', 'kategori_donasi.id_kategoridonasi = donasi.id_kategoridonasi');

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

    public function getlistdonasi(){

        $this->get_listdonasi_query();
        if($_POST['length'] != -1){

            $this->db->limit($_POST['length'], $_POST['start']);

        }

        return $this->db->get()->result();

    }

    public function count_filtered_donasi(){

        $this->get_listdonasi_query();
        return $this->db->get()->num_rows();

    }

    public function count_all_donasi(){

        $this->db->select('*');
        $this->db->from('kategori_donasi');
        $this->db->join('donasi', 'kategori_donasi.id_kategoridonasi = donasi.id_kategoridonasi');
        $this->db->order_by('id_donasi', "DESC");
        return $this->db->count_all_results();

    }
    
    public function getDonasiByid($id){
        $this->db->where('id_donasi', $id);
        return $this->db->get('donasi');
    }

    public function editDonasi($id, $data){
        $this->db->where('id_donasi', $id);
        $this->db->update('donasi',$data);
    }

    public function getGambarDonasiOld($id){
        $data = $this->getDonasiByid($id)->result();
        foreach ($data as $x){
            return $x->gambar_donasi;
        }
    }

    public function hapusdonasi($id){
        $this->db->where('id_donasi', $id);
        $this->db->delete('donasi');
    }

    public function get_listkontribusi_query(){
        $coloumn_order = array('judul_donasi', null, null, null, 'target_dana', null);
        $coloumn_search = array('judul_donasi');
        $order = array('id_donasi'=>'DESC');

        $this->db->from('view_list_donasi');

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

    public function getlistkontribusi(){

        $this->get_listkontribusi_query();
        if($_POST['length'] != -1){

            $this->db->limit($_POST['length'], $_POST['start']);

        }

        return $this->db->get()->result();

    }

    public function count_filtered_kontribusi(){

        $this->get_listkontribusi_query();
        return $this->db->get()->num_rows();

    }

    public function count_all_kontribusi(){

        return $this->db->get('view_list_donasi')->num_rows();

    }

    public function getTerverifikasi($id){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('transaksi_donasi', 'alumni.nisn = transaksi_donasi.nisn');
        $this->db->where('id_donasi', $id);
        $this->db->where('status_pembayaran', "Y");
        return $this->db->get();
    }   

    public function getBelumTerverifikasi($id){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('transaksi_donasi', 'alumni.nisn = transaksi_donasi.nisn');
        $this->db->where('id_donasi', $id);
        $this->db->where('status_pembayaran', "N");
        return $this->db->get();
    }

    public function getTidakTerverifikasi($id){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('transaksi_donasi', 'alumni.nisn = transaksi_donasi.nisn');
        $this->db->where('id_donasi', $id);
        $this->db->where('status_pembayaran', "T");
        return $this->db->get();
    }
    
    public function getnamadonasi($id){
        $this->db->where('id_donasi', $id);
        $data = $this->db->get('donasi');
        foreach ($data->result() as $x){
            return $x->judul_donasi;
        }
    }

    public function getTransaksi($id_transaksi){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('transaksi_donasi', 'transaksi_donasi.nisn=alumni.nisn');
        $this->db->join('tipe_pembayaran', 'tipe_pembayaran.id_tipepembayaran=transaksi_donasi.id_tipepembayaran');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get();
    }

    public function updateTransaksi($id_transaksi, $data){
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('transaksi_donasi', $data);
    }

    public function HapusTransaksi($id){
        $this->db->where('id_transaksi', $id);
        $this->db->delete('transaksi_donasi');
    }

    public function getBuktiTransfer($id){
        $this->db->where('id_transaksi', $id);
        $data = $this->db->get('transaksi_donasi');
        foreach ($data->result() as $x){
            return $x->bukti_transfer;
        }
    }

    public function donasi_diproses(){
        $this->db->where('status_pembayaran', "N");
        return $this->db->get('transaksi_donasi')->num_rows();
    }

    public function donasi_sukses($nisn){
        $this->db->select('*');
        $this->db->from('kategori_donasi');
        $this->db->join('donasi', 'donasi.id_kategoridonasi=kategori_donasi.id_kategoridonasi');
        $this->db->join('transaksi_donasi', 'donasi.id_donasi= transaksi_donasi.id_donasi');
        $this->db->where('nisn', $nisn);
        $this->db->where('status_pembayaran', "Y");
        return $this->db->get()->num_rows() + $this->donasi_proses($nisn);
    }

    public function donasi_proses($nisn){
        $this->db->select('*');
        $this->db->from('kategori_donasi');
        $this->db->join('donasi', 'donasi.id_kategoridonasi=kategori_donasi.id_kategoridonasi');
        $this->db->join('transaksi_donasi', 'donasi.id_donasi= transaksi_donasi.id_donasi');
        $this->db->where('nisn', $nisn);
        $this->db->where('status_pembayaran', "N");
        return $this->db->get()->num_rows();
    }

    public function donasi_gagal($nisn){
        $this->db->select('*');
        $this->db->from('kategori_donasi');
        $this->db->join('donasi', 'donasi.id_kategoridonasi=kategori_donasi.id_kategoridonasi');
        $this->db->join('transaksi_donasi', 'donasi.id_donasi= transaksi_donasi.id_donasi');
        $this->db->where('nisn', $nisn);
        $this->db->where('status_pembayaran', "T");
        return $this->db->get()->num_rows();
    }

    public function getDonasiAlumni($nisn){
        $this->db->select('*');
        $this->db->from('kategori_donasi');
        $this->db->join('donasi', 'donasi.id_kategoridonasi=kategori_donasi.id_kategoridonasi');
        $this->db->join('transaksi_donasi', 'donasi.id_donasi= transaksi_donasi.id_donasi');
        $this->db->where('nisn', $nisn);
        return $this->db->get();
    }

    public function get_listdonasiselesai_query(){
        $coloumn_order = array('judul_donasi', null, null, null, 'target_dana', 'donasi_terkumpul', null);
        $coloumn_search = array('judul_donasi');
        $order = array('id_donasi'=>'DESC');

        $this->db->from('view_list_donasi');
        $this->db->where("donasi_ditutup <", date('Y-m-d'));

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

    public function getlistdonasiselesai(){

        $this->get_listdonasiselesai_query();
        if($_POST['length'] != -1){

            $this->db->limit($_POST['length'], $_POST['start']);

        }

        return $this->db->get()->result();

    }

    public function count_filtered_donasiselesai(){

        $this->get_listdonasiselesai_query();
        return $this->db->get()->num_rows();

    }

    public function count_all_donasiselesai(){

        $this->db->where("donasi_ditutup <", date('Y-m-d'));
        return $this->db->get('view_list_donasi')->num_rows();

    }

    public function totalDonatur($id){
        $this->db->where('id_donasi', $id);
        return $this->db->get('transaksi_donasi')->num_rows();
    }

    public function totalDanaTerkumpul($id){
        $data = $this->db->query("SELECT SUM(total_donasi) AS dana_terkumpul, id_donasi FROM transaksi_donasi WHERE id_donasi = '$id' AND status_pembayaran = 'Y' GROUP BY id_donasi");
        foreach ($data->result() as $x){
            return $x->dana_terkumpul;
        }
    }

    public function viewdoadonatur_total($id){
        $this->db->where('id_donasi', $id);
        $this->db->where('status_pembayaran','Y');
        $this->db->where_not_in('doa_donatur', "kosong");
        $this->db->order_by('tanggal_bayar',"DESC");
        return $this->db->get('view_doa_donatur');
    }

    public function listrekening(){
        return $this->db->get('tipe_pembayaran');
    }

    public function listrekeningByid($id){
        $this->db->where('id_tipepembayaran', $id);
        return $this->db->get('tipe_pembayaran');
    }

    public function tambahrekening($data){
        $this->db->insert('tipe_pembayaran', $data);
    }

    public function editrekening($id, $data){
        $this->db->where('id_tipepembayaran', $id);
        $this->db->update('tipe_pembayaran', $data);
    }

    public function hapusrekening($id){
        $this->db->where('id_tipepembayaran', $id);
        $this->db->delete('tipe_pembayaran');
    }

    public function getDonasi(){
        $this->db->select('*');
        $this->db->from('donasi');
        $this->db->join('kategori_donasi', 'donasi.id_kategoridonasi = kategori_donasi.id_kategoridonasi');
        return $this->db->get()->result();
    }

    public function getDonasiSelesai(){
        $this->db->select('*');
        $this->db->from('view_list_donasi');
        $this->db->where("donasi_ditutup <", date('Y-m-d'));
        return $this->db->get()->result();
    }
}
?>