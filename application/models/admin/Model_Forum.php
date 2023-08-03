<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Forum extends CI_Model{
    public function __construct(){
        parent :: __construct();
        $this->load->database();
    }

    public function getKategoriTopik(){
        return $this->db->get('kategori_topik');
    }

    public function tambahkategoriTopik($data){
        $this->db->insert('kategori_topik', $data);
    }

    public function getKategoriTopikByNama($str){
        $this->db->where('nama_kategoritopik', $str);
        return $this->db->get('kategori_topik');
    }

    public function hapuskategoriTopik($id){
        $this->db->where('id_kategoritopik', $id);
        $this->db->delete('kategori_topik');
    }

    public function getKategoriTopikById($id){
        $this->db->where('id_kategoritopik', $id);
        return $this->db->get('kategori_topik');
    }

    public function updatekategoriTopik($id, $data){
        $this->db->where('id_kategoritopik', $id);
        $this->db->update('kategori_topik', $data);
    }

    public function get_listtopik_query(){
        $coloumn_order = array('nama_alumni', 'judul_topik', 'tanggal', 'total_dilihat', null);
        $coloumn_search = array('nama_alumni', 'judul_topik', 'tanggal');
        $order = array('id_topik'=>'DESC');

        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('topik', 'topik.nisn = alumni.nisn');

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

    public function getlisttopik(){

        $this->get_listtopik_query();
        if($_POST['length'] != -1){

            $this->db->limit($_POST['length'], $_POST['start']);

        }

        return $this->db->get()->result();

    }

    public function count_filtered_topik(){

        $this->get_listtopik_query();
        return $this->db->get()->num_rows();

    }

    public function count_all_topik(){

        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('topik', 'topik.nisn = alumni.nisn');
        $this->db->order_by('id_topik', "DESC");
        return $this->db->count_all_results();

    }

    public function getNamaTopik($id){
        $this->db->where('id_topik', $id);
        $data = $this->db->get('topik');
        foreach ($data->result() as $x):
            return $x->judul_topik;
        endforeach;
    }

    public function getNamaAlumni($id){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('topik', 'topik.nisn = alumni.nisn');
        $this->db->where('id_topik', $id);
        $data = $this->db->get();
        foreach ($data->result() as $x):
            return $x->nama_alumni;
        endforeach;
    }

    public function getTanggalCreatedTopik($id){
        $this->db->where('id_topik', $id);
        $data = $this->db->get('topik');
        foreach ($data->result() as $x):
            $y = $x->tanggal;
        endforeach;

        $originalDate = $y;
        $newDate = date("d F Y", strtotime($originalDate));

        return $newDate;
    }

    public function Totaldiskusi($id){
        $this->db->where('id_topik', $id);
        return $this->db->get('diskusi')->num_rows();
    }

    public function DetailTopik($id){
        $this->db->where('id_topik', $id);
        return $this->db->get('topik');
    }

    public function GetFileDiskusi($id){
        $this->db->where('id_diskusi', $id);
        $data = $this->db->get('diskusi');
        foreach ($data->result() as $x):
            return $x->lampiran_file;
        endforeach;
    }

    public function DeleteDiskusi($id){
        $this->db->where('id_diskusi', $id);
        $this->db->delete('diskusi');
    }

    public function getFotoAlumni($id){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('topik', 'topik.nisn = alumni.nisn');
        $this->db->where('id_topik', $id);
        $data = $this->db->get();
        foreach ($data->result() as $x):
            return $x->foto_alumni;
        endforeach;
    }
    

    public function getListDiskusi($rowpage, $rowno, $id){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('diskusi', 'diskusi.nisn = alumni.nisn');
        $this->db->where('id_topik', $id);
        $this->db->limit($rowpage, $rowno);
        return $this->db->get()->result_array();
    }

    public function countAllDiskusi($id){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('diskusi', 'diskusi.nisn = alumni.nisn');
        $this->db->where('id_topik', $id);
        return $this->db->count_all_results();
    }

    public function getTopik(){
        $this->db->select('*');
        $this->db->from('alumni');
        $this->db->join('topik', 'topik.nisn = alumni.nisn');
        $this->db->order_by('id_topik',"DESC");
        return $this->db->get()->result();
    }
}
?>