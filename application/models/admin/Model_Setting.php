<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Setting extends CI_Model{
    public function __construct(){
        parent :: __construct();
        $this->load->database();
    }

    public function getProfil(){
        return $this->db->get('admin');
    }

    public function editadmin($data){
        $this->db->update('admin', $data);
    }

    public function getWebsite(){
        return $this->db->get('setting');
    }

    public function editwebsite($data){
        $this->db->update('setting', $data);
    }

}
?>