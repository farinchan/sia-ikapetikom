<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller{
    public function __construct(){
        parent :: __construct();

        $this->load->model('admin/Model_Alumni');
        $this->load->model('admin/Model_Berita');
        $this->load->model('admin/Model_Donasi');
        $this->load->model('admin/Model_Setting');
        $this->load->model('admin/Model_Dashboard');

        if(!$this->session->userdata('username_session')){
            
            redirect(base_url('admin/login'));

        }

        $data = array(
            'total_alumni_acc' => $this->Model_Alumni->total_alumni_acc(),
            'beritabelumacc' => $this->Model_Berita->beritabelumacc(),
            'donasiproses' => $this->Model_Donasi->donasi_diproses(),
            'profil' => $this->Model_Setting->getProfil()->result()

        );

        $this->load->view('admin/partisi/sidebar.php', $data, TRUE);
    }

    public function index(){
        $this->session->set_flashdata('location', "Dashboard");

        $data = array(
            'totalalumni' => $this->Model_Dashboard->getAlumni()->num_rows(),
            'totalberita' => $this->Model_Dashboard->getBerita()->num_rows(),
            'totaltopik' => $this->Model_Dashboard->getTopik()->num_rows(),
            'totaldonasi' => $this->Model_Dashboard->getDonasi()->num_rows(),
            'transaksi' => $this->Model_Dashboard->getTransaksi()->result()
        );

        $this->load->view('admin/dashboard/content.php', $data, TRUE);
        $this->load->view('admin/dashboard/dashboard.php', $data, FALSE);

    }

    public function loglogin(){

        $list = $this->Model_Dashboard->getloglogin();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x){

            $no++;
            $row = array();
            $row[] = "<a style='color:black;' href='".base_url('admin/modulalumni/lihat/'.$x->nisn)."'>".$x->nama_alumni."</a>";
            $row[] = $x->tahun_lulus;
            $row[] = $x->tanggal;
            
            $data[] = $row;

        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_Dashboard->count_all_loglogin(),
            'recordsFiltered' => $this->Model_Dashboard->count_filtered_loglogin(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);

    }


}
?>