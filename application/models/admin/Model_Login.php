<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Login extends CI_Model{

    public function __construct(){
        parent :: __construct();
        $this->load->database();
    }

    public function ValidationUsernamePassword($username, $password){
        $q = $this->db->get('admin');

        foreach ($q->result() as $y){

            if($y->username == $username && $y->password == password_verify($password, $y->password)){

                return true;

            }else{

                return false;

            }

        }
    }

}
?>