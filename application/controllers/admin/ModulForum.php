<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ModulForum extends CI_Controller{
    public function __construct(){
        parent :: __construct();
        $this->load->model('admin/Model_Alumni');
        $this->load->model('admin/Model_Berita');
        $this->load->model('admin/Model_Forum');
        $this->load->model('user/Model_user');
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

    public function kategori(){

        $this->session->set_flashdata('location', "Kategori Topik");

        $data = array(
            'data' => $this->Model_Forum->getKategoriTopik()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/modulforum/kategoritopik', $data, TRUE)
        );

        $this->load->view('admin/modulforum/modulforum.php', $content, FALSE);

    }

    public function tambahkategori(){
        $this->session->set_flashdata('location', "Kategori Topik");

        $data = array(
            
        );

        $content = array(
            'content' => $this->load->view('admin/modulforum/tambahkategoritopik', $data, TRUE)
        );

        $this->load->view('admin/modulforum/modulforum.php', $content, FALSE);
    }

    public function tambahkategori_action(){

        if($this->Model_Forum->getKategoriTopikByNama($this->input->post('nama_kategoritopik'))->num_rows() == 0){

            $data = array(
                'nama_kategoritopik' => $this->input->post('nama_kategoritopik')
            );
    
            $this->Model_Forum->tambahkategoriTopik($data);

            echo json_encode('Kategori '.$this->input->post('nama_kategoritopik').' Berhasil Disimpan');

        }else{

            echo json_encode('Kategori '.$this->input->post('nama_kategoritopik').' Sudah Ada');

        }

    }

    public function hapuskategori($id){
        $this->Model_Forum->hapuskategoriTopik($id);
        redirect(base_url('admin/ModulForum/kategori'));
    }

    public function editkategori($id){
        $this->session->set_flashdata('location', "Kategori Topik");

        $id = $this->uri->segment(4);

        if(empty($id) || $this->Model_Forum->getKategoriTopikById($id)->num_rows() == 0){

            redirect(base_url('admin/ModulForum/kategori'));

        }else{

            $data = array(

                'data' => $this->Model_Forum->getKategoriTopikById($id)->result()

            );

            $content = array(

                'content' => $this->load->view('admin/modulforum/editkategoritopik.php', $data, TRUE)

            );

            $this->load->view('admin/modulforum/modulforum.php', $content, FALSE);

        }
    }

    public function editkategori_action(){

        $id = $this->input->post('id_kategoritopik');
        $data = array(
            'nama_kategoritopik' => $this->input->post('nama_kategoritopik')
        );

        $this->Model_Forum->updatekategoriTopik($id, $data);
        echo json_encode('Kategori Berhasil diperbaruhi');
    }

    public function data(){

        $this->session->set_flashdata('location', "Data Topik");

        $data = array(

        );

        $content = array(
            'content' => $this->load->view('admin/modulforum/kontribusitopik.php', $data, TRUE)
        );

        $this->load->view('admin/modulforum/modulforum.php', $content, FALSE);

    }

    public function listtopik(){

        $list = $this->Model_Forum->getlisttopik();
        $data = array();

        foreach ($list as $x){

            $originalDate = $x->tanggal;
            $newDate = date("d F Y", strtotime($originalDate));

            $row = array();
            $row[] = $x->nama_alumni;
            $row[] = substr($x->judul_topik, 0, 28)."...";
            $row[] = $newDate;
            if($x->status_topik == 'Y'){
                $row[] = "<i style='color:green'>Published</i>";
            }else{
                $row[] = "<i style='color:red'>Unpublished</i>";
            }
            $row[] = $x->total_dilihat;
            $row[] = '<center><a href="'.base_url('admin/ModulAlumni/edittopik/'.$x->nisn.'/'.$x->id_topik).'" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a href="'.base_url('main/bacatopik/'.$x->id_topik).'" target="__BLANK"><span class="badge bg-success"><i class="fas fa-eye"></i></span></a> <a href="'.base_url('admin/ModulForum/detail/'.$x->id_topik).'"><span class="badge bg-info"><i class="fas fa-comments"></i></span></a></center>';
            $data[] = $row;

        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_Forum->count_all_topik(),
            'recordsFiltered' => $this->Model_Forum->count_filtered_topik(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);

    }

    public function detail(){

        $this->session->set_flashdata('location', "Data Topik");

        $id_topik = $this->uri->segment(4);
        if(empty($id_topik)){

            redirect(base_url('admin/ModulForum/data'));

        }else{

            $data = array(
                'nama_topik' => $this->Model_Forum->getNamaTopik($id_topik),
                'nama_alumni' => $this->Model_Forum->getNamaAlumni($id_topik),
                'tgl_topik_dibuat' => $this->Model_Forum->getTanggalCreatedTopik($id_topik),
                'total_diskusi' => $this->Model_Forum->Totaldiskusi($id_topik),
                'detail_topik' => $this->Model_Forum->DetailTopik($id_topik)->result(),
                'foto_alumni' => $this->Model_Forum->getFotoAlumni($id_topik)
            );

            $content = array(
                'content' => $this->load->view('admin/modulforum/detaildiskusi.php', $data, TRUE)
            );

            $this->load->view('admin/modulforum/modulforum.php', $content, FALSE);

        }

    }

    public function getDetaildiskusi($rowno = 0){
        $rowpage = 15;

        if($rowno != 0){
            $rowno = ($rowno - 1) * $rowpage;
        }

        $id_topik = $this->input->get('id_topik');

        $allcount = $this->Model_Forum->countAllDiskusi($id_topik);
        $list = $this->Model_Forum->getListDiskusi($rowpage, $rowno, $id_topik);

        $config['base_url'] = base_url().'admin/modulforum/getDetaildiskusi';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowpage;
 
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end mt-5">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
 
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $list;
        $data['row'] = $rowno;
 
        echo json_encode($data);
    }

    public function hapusdiskusi($id, $id_topik){

        if($this->Model_Forum->GetFileDiskusi($id) != "kosong"){

            @unlink('assets/user/topik/'.$this->Model_Forum->GetFileDiskusi($id));
        }

        $this->Model_Forum->DeleteDiskusi($id);
        redirect(base_url('admin/ModulForum/detail/'.$id_topik));
    }

    //export topik
    public function exportTopik(){

        $data = array(
            'data' => $this->Model_Forum->getTopik()
        );

        $this->load->view('admin/export/topik.php', $data, FALSE);

    }
}
?>