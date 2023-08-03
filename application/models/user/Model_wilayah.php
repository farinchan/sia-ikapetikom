<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_wilayah extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_provinsi(){
        return $this->db->query("SELECT kode,nama FROM wilayah_2020 WHERE CHAR_LENGTH(kode)=2 ORDER BY nama");
    }

    public function get_kabupaten_kecamatan($n, $id, $m){
        return $this->db->query("SELECT kode,nama FROM wilayah_2020 WHERE LEFT(kode,'$n')='$id' AND CHAR_LENGTH(kode)=$m ORDER BY nama");
    }

}
?>