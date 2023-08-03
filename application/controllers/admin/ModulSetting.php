<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ModulSetting extends CI_Controller{

    public function __construct(){
        parent :: __construct();
        $this->load->model('admin/Model_Alumni');
        $this->load->model('admin/Model_Berita');
        $this->load->model('admin/Model_Donasi');
        $this->load->model('admin/Model_Setting');

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

    public function profil(){

        $this->session->set_flashdata('location', "Profil");

        $data = array(
            'data' => $this->Model_Setting->getProfil()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/setting/profil.php', $data, TRUE)
        );

        $this->load->view('admin/setting/setting.php', $content, FALSE);

    }

    public function updateprofilAction(){

        $config = array(
            'upload_path' => 'assets/admin/profil/',
            'allowed_types' => 'png|jpg|jpeg|JPG'
        );

        $this->load->library('upload', $config);
        $this->load->initialize($config);

        $password = $this->input->post('password');

        if(!empty($password)){

            $data = array(
                'password' => password_hash($password, PASSWORD_DEFAULT)
            );
            
            $this->Model_Setting->editadmin($data);

        }

        if(!empty($_FILES['myFile']['name'])){

            if($this->upload->do_upload('myFile')){

                $data = array(
                    'gambar' => $this->upload->data('file_name')
                );

                $this->Model_Setting->editadmin($data);

            }else{

                echo json_encode('Ekstensi Gambar Salah');

            }

        }

        $data = array(
            'nama_admin' => $this->input->post('nama_admin'),
            'email_admin' => $this->input->post('email_admin'),
            'username' => $this->input->post('username')
        );

        $this->Model_Setting->editadmin($data);

        echo json_encode('Data Profil Berhasil Diperbaruhi');

    }

    public function website(){

        $this->session->set_flashdata('location', "Website");

        $data = array(
            'data' => $this->Model_Setting->getWebsite()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/setting/website.php', $data, TRUE)
        );

        $this->load->view('admin/setting/setting.php', $content, FALSE);

    }

    public function editwebsite(){

        if(!empty($_FILES['myFile']['name'])){

            $config = array(
                'upload_path' => 'assets/img/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if($this->upload->do_upload('myFile')){

                $data = array(
                    'logo' => $this->upload->data('file_name')
                );

                $this->Model_Setting->editwebsite($data);

            }

        }

        $data = array(
            'nama_website' => $this->input->post('nama_website'),
            'email' => $this->input->post('email'),
            'no_wa' => $this->input->post('no_wa'),
            'facebook' => $this->input->post('facebook'),
            'instagram' => $this->input->post('instagram'),
            'footer' => $this->input->post('footer'),
            'syarat' => $this->input->post('syarat'),
            'tentang' => $this->input->post('tentang')
        );

        $this->Model_Setting->editwebsite($data);

        echo json_encode('Edit Berhasil');

    }

    public function landingpage(){

        $this->session->set_flashdata('location', "LandingPage");

        $data = array(
            'data' => $this->Model_Setting->getWebsite()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/setting/landingpage.php', $data, TRUE)
        );

        $this->load->view('admin/setting/setting.php', $content, FALSE);

    }

    public function editbanner1(){

        if(!empty($_FILES['myFile']['name'])){

            $config = array(
                'upload_path' => 'assets/img/banner/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if($this->upload->do_upload('myFile')){

                $data = array(
                    'lp_1' => $this->upload->data('file_name')
                );

                $this->Model_Setting->editwebsite($data);

            }

        }

        $data = array(
            'sup_1' => $this->input->post('sup_1'),
        );

        $this->Model_Setting->editwebsite($data);

        echo json_encode('Edit Berhasil');

    }

    public function editbanner2(){

        if(!empty($_FILES['myFile']['name'])){

            $config = array(
                'upload_path' => 'assets/img/banner/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if($this->upload->do_upload('myFile')){

                $data = array(
                    'lp_2' => $this->upload->data('file_name')
                );

                $this->Model_Setting->editwebsite($data);

            }

        }

        $data = array(
            'sup_2' => $this->input->post('sup_2'),
        );

        $this->Model_Setting->editwebsite($data);

        echo json_encode('Edit Berhasil');

    }

    public function editbanner3(){

        if(!empty($_FILES['myFile']['name'])){

            $config = array(
                'upload_path' => 'assets/img/banner/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if($this->upload->do_upload('myFile')){

                $data = array(
                    'lp_3' => $this->upload->data('file_name')
                );

                $this->Model_Setting->editwebsite($data);

            }

        }

        $data = array(
            'sup_3' => $this->input->post('sup_3'),
        );

        $this->Model_Setting->editwebsite($data);

        echo json_encode('Edit Berhasil');

    }

}
?>