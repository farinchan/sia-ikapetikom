<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Notifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('admin/Model_Alumni');
        $this->load->library('email');

        if (!$this->session->userdata('username_session')) {

            redirect(base_url('admin/login'));

        }
    }

    public function index()
    {

        $this->email->from('info@ikapetikom.or.id', 'INFORMASI IKAPETIKOM');
        $this->email->to('fajririnaldichan@gmail.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');
        
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            echo 'Email sending failed.';
            echo $this->email->print_debugger();
        }

    }


}
?>