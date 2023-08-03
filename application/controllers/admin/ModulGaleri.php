<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ModulGaleri extends CI_Controller{

    public function __construct(){
        parent :: __construct();
        $this->load->model('admin/Model_Alumni');
        $this->load->model('admin/Model_Berita');
        $this->load->model('admin/Model_Donasi');
        $this->load->model('admin/Model_Galeri');
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

    public function foto(){
        $this->session->set_flashdata('location', "Foto");

        $data = array(
            'data' => $this->Model_Galeri->listFoto()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/modulgaleri/listfoto.php', $data, TRUE)
        );

        $this->load->view('admin/modulgaleri/modulgaleri.php', $content, FALSE);

    }

    public function video(){
        $this->session->set_flashdata('location', "Video");

        $data = array(
            'data' => $this->Model_Galeri->listVideo()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/modulgaleri/listvideo.php', $data, TRUE)
        );

        $this->load->view('admin/modulgaleri/modulgaleri.php', $content, FALSE);

    }

    public function tambah(){
        $this->session->set_flashdata('location', "TambahGaleri");

        $data = array(

        );

        $content = array(
            'content' => $this->load->view('admin/modulgaleri/tambah.php', $data, TRUE)
        );

        $this->load->view('admin/modulgaleri/modulgaleri.php', $content, FALSE);

    }

    public function tambahgaleri_action(){

        $type = $this->input->post('type');

        if($type == "video"){

            $data = array(
                'type' => $type,
                'judul_kegiatan' => $this->input->post('judul_kegiatan'),
                'file' => $this->input->post('file')
            );

            $this->Model_Galeri->tambahdata($data);

            echo json_encode('Data Berhasil Ditambahkan');

        }else{

            $config = array(
                'upload_path' => 'assets/galeri/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if($this->upload->do_upload('myFile')){

                $data = array(
                    'type' => $type,
                    'judul_kegiatan' => $this->input->post('judul_kegiatan'),
                    'file' => $this->upload->data('file_name')
                );

                $this->Model_Galeri->tambahdata($data);

                echo json_encode('Data Berhasil Ditambahkan');
            
            }else{

                echo json_encode('Ekstensi Foto Salah');

            }

        }

    }

    public function edit(){
        $this->session->set_flashdata('location', "Foto");

        $id = $this->uri->segment(4);

        if(empty($id)){

            redirect(base_url('admin/ModulGaleri/foto'));

        }else{

            $data = array(
                'data' => $this->Model_Galeri->ListData($id)->result()
            );

            $content = array(
                'content' => $this->load->view('admin/modulgaleri/edit.php', $data, TRUE)
            );

            $this->load->view('admin/modulgaleri/modulgaleri_edit.php', $content, FALSE);

        }

    }

    public function edit_action(){

        $type = $this->input->post('type');
        $id = $this->input->post('id');

        if($type == "video"){

            $data = array(
                'type' => $type,
                'judul_kegiatan' => $this->input->post('judul_kegiatan'),
                'file' => $this->input->post('file')
            );

            $this->Model_Galeri->EditData($id, $data);

            echo json_encode('Data Berhasil Di-edit');

        }else{

            $config = array(
                'upload_path' => 'assets/galeri/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if(!empty($_FILES['myFile']['name'])){


                if($this->upload->do_upload('myFile')){

                    @unlink('assets/galeri/'.$this->Model_Galeri->getFoto($id));
    
                    $data = array(
                        'type' => $type,
                        'judul_kegiatan' => $this->input->post('judul_kegiatan'),
                        'file' => $this->upload->data('file_name')
                    );
    
                    $this->Model_Galeri->EditData($id, $data);
    
                    echo json_encode('Data Berhasil Di-edit');
                
                }else{
    
                    echo json_encode('Ekstensi Foto Salah');
    
                }


            }else{

                $data = array(
                    'type' => $type,
                    'judul_kegiatan' => $this->input->post('judul_kegiatan'),
                );

                $this->Model_Galeri->EditData($id, $data);
    
                echo json_encode('Data Berhasil Di-edit');

            }

        }

    }

    public function download($nama_file){
        ob_start();
        $file = base_url('assets/galeri/'.$nama_file);
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($file) . "\""); 
        readfile($file); 
        exit;
        ob_flush();
    }

    public function hapus_foto($id){
        @unlink('assets/galeri/'.$this->Model_Galeri->getFoto($id));
        $this->Model_Galeri->Hapus($id);
        redirect(base_url('admin/ModulGaleri/foto'));
    }

    public function hapus_video($id){
        $this->Model_Galeri->Hapus($id);
        redirect(base_url('admin/ModulGaleri/video'));
    }


    // Revisi 

    public function data(){

        $this->session->set_flashdata('location', "Galeri Kegiatan");

        $data = array(
            'data' => $this->Model_Galeri->getDataGaleri()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/galerikegiatan/data.php', $data, TRUE)
        );

        $this->load->view('admin/galerikegiatan/galerikegiatan.php', $content, FALSE);


    }

    public function tambahkegiatan(){

        $this->session->set_flashdata('location', "Galeri Kegiatan");

        $content = array(
            'content' => $this->load->view('admin/galerikegiatan/tambahkegiatan.php', null, TRUE)
        );

        $this->load->view('admin/galerikegiatan/galerikegiatan.php', $content, FALSE);

    }

    public function editkegiatan(){

        $this->session->set_flashdata('location', "Galeri Kegiatan");
        $id = $this->uri->segment(4);

        $data = array(
            'data' => $this->Model_Galeri->getGaleriByid($id)->result()
        );

        $content = array(
            'content' => $this->load->view('admin/galerikegiatan/editkegiatan.php', $data, TRUE)
        );

        $this->load->view('admin/galerikegiatan/galerikegiatan.php', $content, FALSE);

    }

    public function editkegiatan_action(){

        $data = array(
            'judul_kegiatan' => $this->input->post('judul_kegiatan')
        );

        $this->Model_Galeri->editGaleriKegiatan($this->input->post('id_galeri'), $data);

        echo json_encode('Data Berhasil diupdate');

    }

    public function tambahkegiatan_action(){

        $data = array(
            'judul_kegiatan' => $this->input->post('judul_kegiatan')
        );

        $this->Model_Galeri->tambahkegiatan($data);

        echo json_encode('Data Berhasil Ditambahkan');

    }

    public function hapuskegiatan($id){

        $this->Model_Galeri->hapuskegiatan($id);

        redirect(base_url('admin/ModulGaleri/data'));

    }

    public function detail(){

        $this->session->set_flashdata('location', "Galeri Kegiatan");

        $id_kegiatan = $this->uri->segment(4);

        if(empty($id_kegiatan)){

            redirect(base_url('admin/ModulGaleri/data'));

        }else{

            $data = array(
                'data' => $this->Model_Galeri->getDetail($id_kegiatan)->result(),
                'nama_kegiatan' => $this->Model_Galeri->getNamaKegiatan($id_kegiatan)
            );

            $content = array(
                'content' => $this->load->view('admin/galerikegiatan/detail.php', $data, TRUE)
            );
    
            $this->load->view('admin/galerikegiatan/galerikegiatan.php', $content, FALSE);

        }

    }

    public function tambahdetail(){

        $this->session->set_flashdata('location', "Galeri Kegiatan");

        $id_kegiatan = $this->uri->segment(4);

        if(empty($id_kegiatan)){

            redirect(base_url('admin/ModulGaleri/data'));

        }else{

            $data = array(
                'nama_kegiatan' => $this->Model_Galeri->getNamaKegiatan($id_kegiatan)
            );

            $content = array(
                'content' => $this->load->view('admin/galerikegiatan/detail_tambah.php', $data, TRUE)
            );
    
            $this->load->view('admin/galerikegiatan/galerikegiatan.php', $content, FALSE);

        }

    }

    public function tambahdetail_action(){

        $type = $this->input->post('type');

        if($type == "video"){

            $data = array(
                'type' => $type,
                'file' => $this->input->post('file'),
                'id_galeri' => $this->input->post('id_galeri')
            );

            $this->Model_Galeri->tambahdata($data);

            echo json_encode('Data Berhasil Ditambahkan');

        }else{

            $config = array(
                'upload_path' => 'assets/galeri/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if($this->upload->do_upload('myFile')){

                $data = array(
                    'type' => $type,
                    'file' => $this->upload->data('file_name'),
                    'id_galeri' => $this->input->post('id_galeri')
                );

                $this->Model_Galeri->tambahdata($data);

                echo json_encode('Data Berhasil Ditambahkan');
            
            }else{

                echo json_encode('Ekstensi Foto Salah');

            }

        }

    }

    public function hapus_fotodetail($idkegiatan, $id){
        @unlink('assets/galeri/'.$this->Model_Galeri->getFoto($id));
        $this->Model_Galeri->Hapus($id);
        redirect(base_url('admin/ModulGaleri/detail/'.$idkegiatan));
    }

    public function hapus_videodetail($idkegiatan, $id){
        $this->Model_Galeri->Hapus($id);
        redirect(base_url('admin/ModulGaleri/detail/'.$idkegiatan));
    }

    public function editdetail(){
        $this->session->set_flashdata('location', "Galeri Kegiatan");

        $id_kegiatan = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        
        if(empty($id_kegiatan)){

            redirect(base_url('admin/ModulGaleri/data'));

        }else{

            $data = array(
                'data' => $this->Model_Galeri->getDetailByid($id)->result(),
                'nama_kegiatan' => $this->Model_Galeri->getNamaKegiatan($id_kegiatan)
            );

            $content = array(
                'content' => $this->load->view('admin/galerikegiatan/detail_edit.php', $data, TRUE)
            );

            $this->load->view('admin/galerikegiatan/galerikegiatan_edit.php', $content, FALSE);

        }

    }

    public function editdetail_action(){

        $type = $this->input->post('type');
        $id = $this->input->post('id');

        if($type == "video"){

            $data = array(
                'type' => $type,
                'file' => $this->input->post('file')
            );

            $this->Model_Galeri->EditData($id, $data);

            echo json_encode('Data Berhasil Di-edit');

        }else{

            $config = array(
                'upload_path' => 'assets/galeri/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if(!empty($_FILES['myFile']['name'])){


                if($this->upload->do_upload('myFile')){

                    @unlink('assets/galeri/'.$this->Model_Galeri->getFoto($id));
    
                    $data = array(
                        'type' => $type,
                        'file' => $this->upload->data('file_name')
                    );
    
                    $this->Model_Galeri->EditData($id, $data);
    
                    echo json_encode('Data Berhasil Di-edit');
                
                }else{
    
                    echo json_encode('Ekstensi Foto Salah');
    
                }


            }else{

                $data = array(
                    'type' => $type                );

                $this->Model_Galeri->EditData($id, $data);
    
                echo json_encode('Data Berhasil Di-edit');

            }

        }

    }

}
?>