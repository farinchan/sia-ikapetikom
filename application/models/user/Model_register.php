<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_register extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_tahunlulus(){
        return $this->db->get('tahun_lulus');
    }

    public function input_alumni_baru($data){
        $this->db->insert('alumni', $data);
    }

    public function validation_before_register($nisn, $email){
        $this->db->where('nisn', $nisn);
        return $this->db->get('alumni');
    }

    public function validation_nisn($nisn){
        $this->db->where('nisn', $nisn);
        return $this->db->get('alumni');
    }

    public function view_nisn_email_password(){
        return $this->db->get('alumni');
    }

    public function validation_akun($nisn){
        return $this->db->query("SELECT *FROM alumni WHERE status_akun = 'Y' AND nisn= '$nisn'");
    }

}
?>