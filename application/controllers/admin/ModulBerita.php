<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ModulBerita extends CI_Controller{

    public function __construct(){
        parent :: __construct();
        $this->load->model('admin/Model_Alumni');
        $this->load->model('admin/Model_Berita');
        $this->load->model('user/Model_user');
        $this->load->model('admin/Model_Donasi');
        $this->load->model('admin/Model_Setting');
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

    public function kategori(){

        $this->session->set_flashdata('location', "Kategori Berita");

        $data = array(
            'data' => $this->Model_Berita->getKategoriberita()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/modulberita/kategoriberita.php', $data, TRUE)
        );

        $this->load->view('admin/modulberita/modulberita.php', $content, FALSE);

    }

    public function editkategori(){

        $this->session->set_flashdata('location', "Kategori Berita");

        $id_kategori = $this->uri->segment(4);

        if(empty($id_kategori)){
            
            redirect(base_url('admin/ModulBerita/kategori'));
        
        }else{

            $data = array(
                'data' => $this->Model_Berita->getKategoriberita_byid($id_kategori)->result()
            );
    
            $content = array(
                'content' => $this->load->view('admin/modulberita/editkategoriberita.php', $data, TRUE)
            );
    
            $this->load->view('admin/modulberita/modulberita.php', $content, FALSE);

        }

    }

    public function editkategori_action(){
        $data = array(
            'nama_kategoriberita' => $this->input->post('nama_kategoriberita')
        );

        $this->Model_Berita->updateKategoriberita($this->input->post('id_kategoriberita'), $data);
        echo json_encode('Data Berhasil diedit');
    }

    public function tambahkategori(){
        $this->session->set_flashdata('location', "Kategori Berita");

        $data = array(

        );

        $content = array(
            'content' => $this->load->view('admin/modulberita/tambahkategoriberita.php', $data, TRUE)
        );

        $this->load->view('admin/modulberita/modulberita.php', $content, FALSE);
    }

    public function tambahkategori_action(){

        $data = array(
            'nama_kategoriberita' => $this->input->post('nama_kategoriberita')
        );

        if ($this->Model_Berita->cek_kategoriberita($this->input->post('nama_kategoriberita'))->num_rows() != 0){

            echo json_encode('Kategori '.$this->input->post('nama_kategoriberita'). 'Sudah Ada !');

        }else{

            $this->Model_Berita->tambah_kategoriberita($data);

            echo json_encode('Kategori berita berhasil disimpan');

        }

    }

    public function hapuskategori($id_kategori){
        $this->Model_Berita-> hapus_kategoriberita($id_kategori);
        redirect(base_url('admin/ModulBerita/kategori'));
    }

    public function berita(){
        $this->session->set_flashdata('location', "ListBerita");

        $data = array(

        );

        $content = array(
            'content' => $this->load->view('admin/modulberita/databerita.php', $data, TRUE)
        );

        $this->load->view('admin/modulberita/modulberita.php', $content, FALSE);

    }

    public function tambahberita(){

        $this->session->set_flashdata('location', "TambahBerita");

        $data = array(
            'list_kategoriberita' => $this->Model_user->listkategoriberita()->result() 
        );

        $content = array(
            'content' => $this->load->view('admin/modulberita/tambahberita.php', $data, TRUE)
        );

        $this->load->view('admin/modulberita/modulberita.php', $content, FALSE);

    }

    public function tambahberita_action(){
        
        $config = array(
            'upload_path' => 'assets/berita/',
            'allowed_types' => 'png|jpg|jpeg|jpg'
        );

        $this->load->library('upload', $config);
        $this->load->initialize($config);

        if($this->upload->do_upload('myFile')){
            $data = array(
                'gambar_berita' => $this->upload->data('file_name'),
                'judul_berita' => $this->input->post('judul_berita'),
                'isi_berita' => $this->input->post('isi_berita'),
                'status_berita' => $this->input->post('status_berita'),
                'tanggal_posting' => date('Y-m-d H:i:s'),
                'total_dilihat' => 0,
                'id_kategoriberita' => $this->input->post('id_kategoriberita')
            );

            $this->Model_Berita->tambahberita($data);
            echo json_encode("Berita yang anda buat berhasil disimpan.");

        }else{

            echo json_encode("ekstensi gambar salah");

        }

    }

    //berita admin
    public function listberita(){

        $list = $this->Model_Berita->getlistberita();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x){

            $originalDate = $x->tanggal_posting;
            $newDate = date("d F Y", strtotime($originalDate));

            $no++;
            $row = array();
            $row[] = substr($x->judul_berita, 0, 40)."...";
            $row[] = $x->nama_kategoriberita;
            $row[] = $newDate;
            if($x->status_berita == 'Y'){
                $row[] = "<i style='color:green'>Published</i>";
            }else{
                $row[] = "<i style='color:red'>Unpublished</i>";
            }

            $row[] = $x->total_dilihat." kali";
            
            $row[] = '<center><a href="'.base_url('admin/ModulBerita/editberita/'.$x->id_berita).'" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a target="_BLANK" href="'.base_url('main/beritadmin/'.$x->id_berita).'" ><span class="badge bg-success"><i class="fas fa-eye"></i></span></a> <a href="'.base_url('admin/ModulBerita/hapusberita/'.$x->id_berita).'" onclick="'."return confirm('yakin mau menghapus berita ini ?')".'"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center>';
            

            $data[] = $row;

        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_Berita->count_all_berita(),
            'recordsFiltered' => $this->Model_Berita->count_filtered_berita(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);

    }
    
    public function editberita(){

        $this->session->set_flashdata("location", "ListBerita");
        $id_berita = $this->uri->segment(4);

        if(empty($id_berita) || $this->Model_Berita->getBeritabyid($id_berita)->num_rows() == 0){

            redirect(base_url('admin/ModulBerita/berita'));

        }else{

            $data = array(
                'berita' => $this->Model_Berita->getBeritabyid($id_berita)->result(),
                'list_kategoriberita' => $this->Model_user->listkategoriberita()->result()
            );

            $content = array(
                'content' => $this->load->view('admin/modulberita/editberita.php', $data, TRUE)
            );

            $this->load->view('admin/modulberita/modulberita.php', $content, FALSE);

        }

    }

    public function editberita_action(){

        $id_berita = $this->input->post('id_berita');

        if(!empty($_FILES['myFile']['name'])){

            $config = array(
                'upload_path' => 'assets/berita/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if($this->upload->do_upload('myFile')){

                @unlink('assets/berita/'.$this->Model_Berita->getgambarberita_old($id_berita));
                $data = array(
                    'gambar_berita' => $this->upload->data('file_name')
                );

                $this->Model_Berita->editberita($id_berita, $data);

            }else{


            }

        }

        $data = array(
            'judul_berita' => $this->input->post('judul_berita'),
            'isi_berita' => $this->input->post('isi_berita'),
            'id_kategoriberita' => $this->input->post('id_kategoriberita'),
            'status_berita' => $this->input->post('status_berita')
        );

        $this->Model_Berita->editberita($id_berita, $data);

        echo json_encode("Berita telah diperbarui");

    }

    public function hapusberita($id_berita){
        @unlink('assets/berita/'.$this->Model_Berita->getgambarberita_old($id_berita));
        $this->Model_Berita->hapusberita($id_berita);
        redirect(base_url('admin/ModulBerita/berita'));
    }

    public function hapuskontribusiberita($id_berita){
        @unlink('assets/berita/'.$this->Model_Berita->getgambarberita_oldAlumni($id_berita));
        $this->Model_Berita->hapusberita_alumni($id_berita);
        redirect(base_url('admin/ModulBerita/kontribusi'));
    }

    public function kontribusi(){

        $this->session->set_flashdata('location', "KontribusiBerita");

        $data = array(

        );

        $content = array(
            'content' => $this->load->view('admin/modulberita/kontribusiberita.php', $data, TRUE)
        );

        $this->load->view('admin/modulberita/modulberita.php', $content, FALSE);

    }

    public function listkontribusiberita(){

        $list = $this->Model_Berita->getlistkontribusiberita();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x){

            $originalDate = $x->tanggal_posting;
            $newDate = date("d F Y", strtotime($originalDate));

            $no++;
            $row = array();
            $row[] = '<a href="'.base_url('admin/modulalumni/listberita/'.$x->nisn).'" style="color:black;">'.$x->nama_alumni.'</a>';
            $row[] = substr($x->judul_berita, 0, 40)."...";
            $row[] = $newDate;
            if($x->status_berita == 'Y'){
                $row[] = "<i style='color:green'>Published</i>";
            }else{
                $row[] = "<i style='color:red'>Unpublished</i>";
            }

            $row[] = $x->total_dilihat." kali";
            
            $row[] = '<center><a href="'.base_url('admin/ModulAlumni/editberita/'.$x->nisn.'/'.$x->id_berita).'" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a target="_BLANK" href="'.base_url('main/bacaberita/'.$x->id_berita).'" ><span class="badge bg-success"><i class="fas fa-eye"></i></span></a> <a href="'.base_url('admin/ModulBerita/hapuskontribusiberita/'.$x->id_berita).'" onclick="'."return confirm('yakin mau menghapus berita ini ?')".'"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center>';
            

            $data[] = $row;

        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_Berita->count_all_kontribusiberita(),
            'recordsFiltered' => $this->Model_Berita->count_filtered_kontribusiberita(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);

    }

    //export berita
    public function exportberita(){
        $data = array(
            'alumni' => $this->Model_Berita->getBeritaAlumni(),
            'admin' => $this->Model_Berita->getBeritaAdmin()
        );

        $this->load->view('admin/export/berita.php', $data, FALSE);
    }
}
?>