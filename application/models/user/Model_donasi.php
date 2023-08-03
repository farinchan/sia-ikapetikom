<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_donasi extends CI_Model{

    public function __construct(){
        parent :: __construct();
        $this->load->database();
    }

    public function getKategoridonasi(){
        return $this->db->get('view_kategori_donasi');
    }

    public function listdonasi($rowpage, $rowno){
        $this->db->limit($rowpage, $rowno);
        $this->db->order_by('id_donasi', "DESC");
        return $this->db->get('view_list_donasi')->result_array();

    }

    public function usercountalldonasiadmin(){
        return $this->db->get('view_list_donasi')->num_rows();
    }

    public function danaterbesar(){
        return $this->db->get('view_list_donasidana_terbesar');
    }

    public function listdonasikategori($rowpage, $rowno, $kategori){
        $this->db->where('id_kategoridonasi', $kategori);
        $this->db->limit($rowpage, $rowno);
        return $this->db->get('view_list_donasi')->result();
    }

    public function usercountalldonasikategori($kategori){
        $this->db->where('id_kategoridonasi', $kategori);
        return $this->db->get('view_list_donasi')->num_rows();
    }

    public function getNamaKategori($id){
        $this->db->where('id_kategoridonasi', $id);
        $data = $this->db->get('kategori_donasi');
        foreach ($data->result() as $x){
            return $x->nama_kategoridonasi;
        }
    }

    public function getDonasiByid($id){
        $this->db->select('*');
        $this->db->from('kategori_donasi');
        $this->db->join('donasi', 'donasi.id_kategoridonasi = kategori_donasi.id_kategoridonasi');
        $this->db->where('id_donasi',$id);
        return $this->db->get();
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

    public function counterdonasi($id){
        $this->db->where('id_donasi',$id);
        $data = $this->db->get('donasi');
        foreach ($data->result() as $x){
            $count = $x->total_dilihat;
        }

        $data = array(
            'total_dilihat' => $count + 1
        );

        $this->db->where('id_donasi', $id);
        $this->db->update('donasi', $data);
    }

    public function getTipePembayaran(){
        return $this->db->get('tipe_pembayaran');
    }

    public function tambahdonasi($data){
        $this->db->insert('transaksi_donasi',$data);
    }

    public function viewdoadonatur($rowpage, $rowno, $id){
        $this->db->where('id_donasi', $id);
        $this->db->where('status_pembayaran','Y');
        $this->db->where_not_in('doa_donatur', "kosong");
        $this->db->limit($rowpage, $rowno);
        $this->db->order_by('tanggal_bayar',"DESC");
        return $this->db->get('view_doa_donatur')->result();
    }

    public function viewdoadonatur_total($id){
        $this->db->where('id_donasi', $id);
        $this->db->where('status_pembayaran','Y');
        $this->db->where_not_in('doa_donatur', "kosong");
        $this->db->order_by('tanggal_bayar',"DESC");
        return $this->db->get('view_doa_donatur');
    }

    public function viewperbandingandonasi($id){
        return $this->db->query("SELECT SUM(total_donasi) AS total_donasi, tahun_lulus, id_donasi FROM transaksi_donasi RIGHT JOIN alumni ON alumni.`nisn` = transaksi_donasi.`nisn` WHERE status_pembayaran = 'Y' AND id_donasi = '$id' GROUP BY tahun_lulus");
    }

    public function getDonasiByNisn(){
        $this->db->select('*');
        $this->db->from('donasi');
        $this->db->join('transaksi_donasi', 'donasi.id_donasi=transaksi_donasi.id_donasi');
        $this->db->where('nisn', $_SESSION['nisn_session']);
        return $this->db->get();
    }

    public function getDonasiByNisnSuccess(){
        $this->db->select('*');
        $this->db->from('donasi');
        $this->db->join('transaksi_donasi', 'donasi.id_donasi=transaksi_donasi.id_donasi');
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('status_pembayaran','Y');
        return $this->db->get();
    }

    public function getDonasiByNisnProcess(){
        $this->db->select('*');
        $this->db->from('donasi');
        $this->db->join('transaksi_donasi', 'donasi.id_donasi=transaksi_donasi.id_donasi');
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('status_pembayaran','N');
        return $this->db->get();
    }

    public function getDonasiByNisnGagal(){
        $this->db->select('*');
        $this->db->from('donasi');
        $this->db->join('transaksi_donasi', 'donasi.id_donasi=transaksi_donasi.id_donasi');
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('status_pembayaran','T');
        return $this->db->get();
    }

    public function getdetailDonasi($id){
        $this->db->select('*');
        $this->db->from('donasi');
        $this->db->join('transaksi_donasi', 'donasi.id_donasi=transaksi_donasi.id_donasi');
        $this->db->where('nisn', $_SESSION['nisn_session']);
        $this->db->where('id_transaksi', $id);
        return $this->db->get();
    }

    public function getDonasiByNisnSearch($nisn){
        $this->db->select('*');
        $this->db->from('donasi');
        $this->db->join('transaksi_donasi', 'donasi.id_donasi=transaksi_donasi.id_donasi');
        $this->db->where('nisn', $nisn);
        return $this->db->get();
    }

    public function listdonasiNew($limit){
        $this->db->limit($limit);
        $this->db->order_by('id_donasi', "DESC");
        return $this->db->get('view_list_donasi');

    }

}
?>