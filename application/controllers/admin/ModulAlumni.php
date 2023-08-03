<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ModulAlumni extends CI_Controller{
    public function __construct(){
        parent :: __construct();
        $this->load->model('admin/Model_Alumni');
        $this->load->model('user/Model_wilayah');
        $this->load->model('user/Model_register');
        $this->load->model('user/Model_user');
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

    public function index(){
        $this->session->set_flashdata('location', "Tahun Lulus");

        $data = array(
            'tahun_lulus' => $this->Model_Alumni->getTahunlulus()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/modulalumni/tahunlulus.php', $data, TRUE)
        );

        $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);

    }

    public function tambahtahunlulus(){
        $this->session->set_flashdata('location', "Tambah Tahun Lulus");

        $data = array(
            
        );

        $content = array(
            'content' => $this->load->view('admin/modulalumni/tambahtahun.php', $data, TRUE)
        );

        $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);
    }

    public function tambahtahun_action(){

        $data = array(
            'tahun_lulus' => $this->input->post('tahun_lulus')
        );

        if ($this->Model_Alumni->gettahunlulusbyvalue( $this->input->post('tahun_lulus'))->num_rows() == 0){

            $this->Model_Alumni->tambahtahunlulus($data);
            echo json_encode('Tambah Data Berhasil');
        
        }else{

            echo json_encode('Tahun '.$this->input->post('tahun_lulus').' Sudah Dipakai');

        }

    }

    public function hapustahunlulus($tahunlulus){
        $this->Model_Alumni->hapustahunlulus($tahunlulus);
        redirect(base_url('admin/ModulAlumni'));
    }

    public function data(){

        $this->session->set_flashdata('location', "Data Alumni");

        $data = array(
            
        );

        $content = array(
            'content' => $this->load->view('admin/modulalumni/listalumni.php', $data, TRUE)
        );

        $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);

    }

    public function listalumni(){
     
        $list = $this->Model_Alumni->getlistalumni();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x){

            $no++;
            $row = array();
            $row[] = $x->nisn;
            $row[] = $x->nama_alumni;
            $row[] = $x->tahun_lulus;
            if($x->status_alumni == "pelajar"){
                $row[] = "Pelajar";
            }else{
                $row[] = "Bekerja";
            }
            $row[] = $x->detail_status;
            $row[] = '<center><a href="'.base_url('admin/ModulAlumni/lihat/'.$x->nisn).'"><span class="badge badge-primary">Lihat</span></a></center>';
            
            $data[] = $row;

        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_Alumni->count_all_alumni(),
            'recordsFiltered' => $this->Model_Alumni->count_filtered_alumni(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);
        
    }

    public function lihat(){

        $this->session->set_flashdata('location', "Lihat Alumni");

        $nisn = $this->uri->segment(4);

        if(empty($nisn) || $this->Model_Alumni->getAlumni($nisn)->num_rows() == 0){

            redirect(base_url('admin/ModulAlumni/data'));

        }else{

            $data = array(
                'data_profil' => $this->Model_Alumni->getAlumni($nisn)->result(),
                'nama_alumni' => $this->Model_Alumni->getnamaAlumni($nisn),
                'provinsi' => $this->Model_wilayah->get_provinsi()->result(),
                'tahunlulus' => $this->Model_register->get_tahunlulus()->result(),
                'kota' => $this->Model_user->getKota($nisn),
                'last_login' => $this->Model_user->lastlogin($nisn),
                'berita_acc' => $this->Model_Alumni->totalberita_acc($nisn),
                'berita_noacc' => $this->Model_Alumni->totalberita_noacc($nisn),
                'tot_topik' => $this->Model_Alumni->totaltopik($nisn),
                'donasi_acc' => $this->Model_Donasi->donasi_sukses($nisn),
                'donasi_gagal' => $this->Model_Donasi->donasi_gagal($nisn),
                
                //tambahan riwayat pekerjaan dan pendidikan
                'riwayatpekerjaan' => $this->Model_Alumni->getRiwayatPekerjaan($nisn)->result(),
                'riwayatpendidikan' => $this->Model_Alumni->getRiwayatPendidikan($nisn)->result()

            );

            $content = array(
                'content' => $this->load->view('admin/modulalumni/lihatalumni.php', $data, TRUE)
            );

            $this->load->view('admin/modulalumni/partisi_menu.php', $data, TRUE);
            $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);

        }

    }

    public function updateprofilalumni_action(){

        if(!empty($this->input->post('password'))){

            $data = array(
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );

            $this->Model_user->updateprofil($this->input->post('nisn'), $data);

        }

        $data = array(
            'nisn' => $this->input->post('nisn'),
            'nama_alumni' => $this->input->post('nama_alumni'),
            'tahun_lulus' => $this->input->post('tahun_lulus'),
            'status_alumni' => $this->input->post('status_alumni'),
            'detail_status' => $this->input->post('detail_status'),
            'no_wa' => $this->input->post('no_wa'),
            'alamat_provinsi' => $this->input->post('provinsi'),
            'alamat_kabupaten' => $this->input->post('kabupaten'),
            'alamat_kecamatan' => $this->input->post('kecamatan'),
            'detail_alamat' => $this->input->post('detail_alamat'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'email' => $this->input->post('email'),
            'status_akun'=> $this->input->post('status_akun'),
            
            //tambahan riwayat pekerjaan dan pendidikan
            'facebook' => $this->input->post('facebook'),
            'instagram' => $this->input->post('instagram'),
            'twitter' => $this->input->post('twitter')
        );

        $this->Model_user->updateprofil($this->input->post('nisn'), $data);


        //tambahan riwayat pekerjaan dan pendidikan
        $this->Model_Alumni->hapusSemuaRiwayatPendidikan($this->input->post('nisn'));
        $this->Model_Alumni->hapusSemuaRiwayatPekerjaan($this->input->post('nisn'));

        //tambahan riwayat pekerjaan dan pendidikan
        $this->riwayatpekerjaan($this->input->post('nisn'));
        $this->riwayatpendidikan($this->input->post('nisn'));

        echo json_encode('Data berhasil di update');

    }

    public function updatefotoprofil_alumni(){
        $config = array(
            'upload_path' => 'assets/user/img/',
            'allowed_types' => 'png|jpg|jpeg|JPG'
        );

        $this->load->library('upload', $config);
        $this->load->initialize($config);

        if($this->upload->do_upload('myFile')){
            $data = array(
                'foto_alumni' => $this->upload->data('file_name')
            );

            @unlink('assets/user/img/'.$this->Model_user->getfotoprofil_old($this->input->post('nisn')));

            $this->Model_user->updateprofil($this->input->post('nisn'), $data);
            echo json_encode('Foto Profil berhasil diperbaharui');
        }else{

            echo json_encode('ekstensi gambar salah');

        }

    }

    public function hapusalumni(){
        @unlink('assets/user/img/'.$this->Model_user->getfotoprofil_old($this->input->post('nisn')));
        $this->Model_Alumni->hapusAlumni($this->input->post('nisn'));
        echo json_encode('Akun Berhasil Dihapus');
    }

    public function tambahalumni(){

        $this->session->set_flashdata('location', "Tambah Alumni");

        $data = array(
            'provinsi' => $this->Model_wilayah->get_provinsi()->result(),
            'tahunlulus' => $this->Model_register->get_tahunlulus()->result(),
        );

        $content = array(
            'content' => $this->load->view('admin/modulalumni/tambahalumni.php', $data, TRUE)
        );

        $this->load->view('admin/modulalumni/partisi_menu.php', $data, TRUE);
        $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);

    }

    public function tambahalumni_action(){

        $config = array(
            'upload_path' => 'assets/user/img/',
            'allowed_types' => 'png|jpg|jpeg'
        );

        $this->load->library('upload', $config);
        $this->load->initialize($config);

        if( $this->Model_register->validation_before_register($this->input->post('nisn'), $this->input->post('email'))->num_rows() != 0){

            echo json_encode("NISN atau email sudah digunakan");

        }else if($this->upload->do_upload('myFile')){
            $data = array(
                'nisn' => $this->input->post('nisn'),
                'nama_alumni' => $this->input->post('nama_alumni'),
                'tahun_lulus' => $this->input->post('tahun_lulus'),
                'status_alumni' => $this->input->post('status_alumni'),
                'detail_status' => $this->input->post('detail_status'),
                'no_wa' => $this->input->post('no_wa'),
                'alamat_provinsi' => $this->input->post('provinsi'),
                'alamat_kabupaten' => $this->input->post('kabupaten'),
                'alamat_kecamatan' => $this->input->post('kecamatan'),
                'detail_alamat' => $this->input->post('detail_alamat'),
                'foto_alumni' => $this->upload->data('file_name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'waktu_join' => date('Y-m-d H:i:s'),
                'status_akun' => $this->input->post('status_akun'),
                
                'facebook' => $this->input->post('facebook'),
                'instagram' => $this->input->post('instagram'),
                'twitter' => $this->input->post('twitter')
            );

            $this->Model_register->input_alumni_baru($data);
            $this->Model_user->insertloglogin($this->input->post('nisn'));

            //tambahan riwayat pendidikan dan pekerjaan
            $this->riwayatpekerjaan($this->input->post('nisn'));
            $this->riwayatpendidikan($this->input->post('nisn'));

            echo json_encode("Data berhasil disimpan");
        
        }else{

            echo json_encode("Ekstensi gambar anda salah");

        }

    }

    public function listberita(){

        $this->session->set_flashdata('location', "Lihat Alumni");

        $nisn = $this->uri->segment(4);

        if(empty($nisn) || $this->Model_Alumni->getAlumni($nisn)->num_rows() == 0){

            redirect(base_url('admin/MoodulAlumni'));

        }

        $data = array(
            'data_profil' => $this->Model_Alumni->getAlumni($nisn)->result(),
            'nama_alumni' => $this->Model_Alumni->getnamaAlumni($nisn),
            'last_login' => $this->Model_user->lastlogin($nisn),
            'berita_acc' => $this->Model_Alumni->totalberita_acc($nisn),
            'berita_noacc' => $this->Model_Alumni->totalberita_noacc($nisn),
            'tot_topik' => $this->Model_Alumni->totaltopik($nisn),
            'berita' => $this->Model_Alumni->getBeritaAlumni($nisn)->result(),
            'donasi_acc' => $this->Model_Donasi->donasi_sukses($nisn),
            'donasi_gagal' => $this->Model_Donasi->donasi_gagal($nisn)

        );

        $content = array(
            'content' => $this->load->view('admin/modulalumni/kontribusiberita.php', $data, TRUE)
        );

        $this->load->view('admin/modulalumni/partisi_menu.php', $data, TRUE);
        $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);

    }

    public function editberita(){

        $this->session->set_flashdata('location', "Lihat Alumni");

        $nisn = $this->uri->segment(4);
        $id_berita = $this->uri->segment(5);

        if(empty($nisn) || $this->Model_Alumni->getAlumni($nisn)->num_rows() == 0 || empty($id_berita)){

            redirect(base_url('admin/ModulAlumni'));

        }else{

            $data = array(
                'data_profil' => $this->Model_Alumni->getAlumni($nisn)->result(),
                'nama_alumni' => $this->Model_Alumni->getnamaAlumni($nisn),
                'last_login' => $this->Model_user->lastlogin($nisn),
                'berita_acc' => $this->Model_Alumni->totalberita_acc($nisn),
                'berita_noacc' => $this->Model_Alumni->totalberita_noacc($nisn),
                'tot_topik' => $this->Model_Alumni->totaltopik($nisn),
                'berita' => $this->Model_Alumni->getBeritaDetail($id_berita)->result(),
                'judul_berita' => $this->Model_Alumni->getJudulberita($id_berita),
                'list_kategoriberita' => $this->Model_user->listkategoriberita()->result(),
                'donasi_acc' => $this->Model_Donasi->donasi_sukses($nisn),
                'donasi_gagal' => $this->Model_Donasi->donasi_gagal($nisn)
    
            );
    
            $content = array(
                'content' => $this->load->view('admin/modulalumni/editberita.php', $data, TRUE)
            );
    
            $this->load->view('admin/modulalumni/partisi_menu.php', $data, TRUE);
            $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);

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

                @unlink('assets/berita/'.$this->Model_user->getgambarberita_old($id_berita));
                $data = array(
                    'gambar_berita' => $this->upload->data('file_name')
                );

                $this->Model_user->editberita($id_berita, $data);

            }else{


            }

        }

        $data = array(
            'judul_berita' => $this->input->post('judul_berita'),
            'isi_berita' => $this->input->post('isi_berita'),
            'id_kategoriberita' => $this->input->post('id_kategoriberita'),
            'status_berita' => $this->input->post('status_berita')
        );

        $this->Model_user->editberita($id_berita, $data);

        echo json_encode("Berita telah diperbarui");

    }

    public function hapusberita($id_berita, $nisn){
        @unlink('assets/berita/'.$this->Model_user->getgambarberita_old($id_berita));
        $this->Model_user->hapusberita($id_berita);
        redirect(base_url('admin/ModulAlumni/listberita/'.$nisn));
    }

    public function listtopik(){

        $this->session->set_flashdata('location', "Lihat Alumni");
        $nisn = $this->uri->segment(4);

        if(empty($nisn) ||  $this->Model_Alumni->getAlumni($nisn)->num_rows() == 0){

            redirect(base_url('admin/ModulAlumni/data'));

        }else{

            $data = array(
                'data_profil' => $this->Model_Alumni->getAlumni($nisn)->result(),
                'nama_alumni' => $this->Model_Alumni->getnamaAlumni($nisn),
                'last_login' => $this->Model_user->lastlogin($nisn),
                'berita_acc' => $this->Model_Alumni->totalberita_acc($nisn),
                'berita_noacc' => $this->Model_Alumni->totalberita_noacc($nisn),
                'tot_topik' => $this->Model_Alumni->totaltopik($nisn),
                'topik' => $this->Model_Alumni->getlisttopikbyalumni($nisn)->result(),
                'donasi_acc' => $this->Model_Donasi->donasi_sukses($nisn),
                'donasi_gagal' => $this->Model_Donasi->donasi_gagal($nisn)
            );
    
            $content = array(
                'content' => $this->load->view('admin/modulalumni/listtopik.php', $data, TRUE)
            );
            
            $this->load->view('admin/modulalumni/partisi_menu.php', $data, TRUE);
            $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);

        }

    }

    public function edittopik(){

        $this->session->set_flashdata('location', "Lihat Alumni");
        $nisn = $this->uri->segment(4);
        $id_topik = $this->uri->segment(5);

        if(empty($nisn) || empty($id_topik) || $this->Model_Alumni->cektopik_byid_nisn($id_topik)->num_rows() == 0){

            redirect(base_url('admin/ModulAlumni/data'));

        }else{

            $data = array(
                'data_profil' => $this->Model_Alumni->getAlumni($nisn)->result(),
                'nama_alumni' => $this->Model_Alumni->getnamaAlumni($nisn),
                'last_login' => $this->Model_user->lastlogin($nisn),
                'berita_acc' => $this->Model_Alumni->totalberita_acc($nisn),
                'berita_noacc' => $this->Model_Alumni->totalberita_noacc($nisn),
                'tot_topik' => $this->Model_Alumni->totaltopik($nisn),
                'data'=> $this->Model_Alumni->cektopik_byid_nisn($id_topik)->result(),
                'list_kategori' => $this->Model_Alumni->getlisttopikbyalumni($nisn)->result(),
                'donasi_acc' => $this->Model_Donasi->donasi_sukses($nisn),
                'donasi_gagal' => $this->Model_Donasi->donasi_gagal($nisn)
            );

            $content = array(
                'content' => $this->load->view('admin/modulalumni/edittopik.php', $data, TRUE)
            );

            $this->load->view('admin/modulalumni/partisi_menu.php', $data, TRUE);
            $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);

        }

    }

    public function alumniedittopik_action(){

        $idtopik = $this->input->post('id_topik');

        if(!empty($_FILES['myFile']['name'])){
            
            $config = array(
                'upload_path' => 'assets/user/topik/',
                'allowed_types' => 'png|jpg|jpeg|rar|zip|pdf|pptx|docx|xlsx|xls|doc|txt|PNG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if($this->upload->do_upload('myFile')){

                $data = array(
                    'lampiran_file' => $this->upload->data('file_name')
                );

                if ($this->Model_Alumni->getNamaFileTopikOld($idtopik) != "kosong"){

                    @unlink('assets/user/topik/'.$this->Model_Alumni->getNamaFileTopikOld($idtopik));
        
                }

                $this->Model_Alumni->edittopik($idtopik, $data);

            }

        }

        $data = array(
            'id_kategoritopik' => $this->input->post('kategori_topik'),
            'judul_topik' => $this->input->post('judul_topik'),
            'hak_akses' => $this->input->post('hak_akses'),
            'isi_topik' => $this->input->post('isi_topik'),
            'status_topik' => $this->input->post('status_topik')
        );

        $this->Model_Alumni->edittopik($idtopik, $data);
        echo json_encode("Data berhasil diperbaruhi");

    }

    public function hapustopik($idtopik, $nisn){

        if ($this->Model_Alumni->getNamaFileTopikOld($idtopik) != "kosong"){

            @unlink('assets/user/topik/'.$this->Model_Alumni->getNamaFileTopikOld($idtopik));

        }

        $this->Model_Alumni->hapustopik($idtopik);
        redirect(base_url('admin/ModulAlumni/listtopik/'.$nisn));

    }

    public function acc(){

        $this->session->set_flashdata('location', "Acc Alumni");

        $data = array(
            
        );

        $content = array(
            'content' => $this->load->view('admin/modulalumni/acc.php', $data, TRUE)
        );

        $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);

    }

    public function listalumni_acc(){

        $list = $this->Model_Alumni->getlistalumni_acc();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x){

            $originalDate = $x->waktu_join;
            $newDate = date("d F Y", strtotime($originalDate));

            $no++;
            $row = array();
            $row[] = $x->nisn;
            $row[] = $x->nama_alumni;
            $row[] = $x->tahun_lulus;
            if($x->status_alumni == "pelajar"){
                $row[] = "Pelajar";
            }else{
                $row[] = "Bekerja";
            }
            $row[] = $x->detail_status;
            $row[] = $newDate;
            $row[] = '<center><a onclick="'."return confirm('Yakin Mau Aktikan Akun Ini ?')".'" href="'.base_url('admin/ModulAlumni/aktifasiakun/'.$x->nisn).'"><span class="badge bg-primary"><i class="fas fa-user-check"></i></span></a> <a href="'.base_url('admin/ModulAlumni/lihat/'.$x->nisn).'"><span class="badge bg-success"><i class="fas fa-eye"></i></span></a> <a onclick="'."return confirm('Yakin Mau Hapus Akun Ini ?')".'" href="'.base_url('admin/ModulAlumni/hapusalumni_acc/'.$x->nisn).'"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center>';
            
            $data[] = $row;

        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_Alumni->count_all_alumni_acc(),
            'recordsFiltered' => $this->Model_Alumni->count_filtered_alumni_acc(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);

    }

    public function aktifasiakun($nisn){
        $data = array(
            'status_akun'=> "Y"
        );

        $this->Model_user->updateprofil($nisn, $data);
        redirect(base_url('admin/ModulAlumni/lihat/'.$nisn));
    }

    public function hapusalumni_acc($nisn){
        @unlink('assets/user/img/'.$this->Model_user->getfotoprofil_old($nisn));
        $this->Model_Alumni->hapusAlumni($nisn);
        redirect(base_url('admin/ModulAlumni/acc'));
    }

    public function listdonasi(){
        $nisn = $this->uri->segment(4);

        if(empty($nisn)){

            redirect(base_url('admin/ModulAlumni'));

        }else{

            $data = array(

                'donasi' => $this->Model_Donasi->getDonasiAlumni($nisn)->result(),
                'data_profil' => $this->Model_Alumni->getAlumni($nisn)->result(),
                'nama_alumni' => $this->Model_Alumni->getnamaAlumni($nisn),
                'last_login' => $this->Model_user->lastlogin($nisn),
                'berita_acc' => $this->Model_Alumni->totalberita_acc($nisn),
                'berita_noacc' => $this->Model_Alumni->totalberita_noacc($nisn),
                'tot_topik' => $this->Model_Alumni->totaltopik($nisn),
                'donasi_acc' => $this->Model_Donasi->donasi_sukses($nisn),
                'donasi_gagal' => $this->Model_Donasi->donasi_gagal($nisn)

            );

            $content = array(
                'content' => $this->load->view('admin/modulalumni/listdonasi.php', $data, TRUE)
            );

            $this->load->view('admin/modulalumni/partisi_menu.php', $data, TRUE);
            $this->load->view('admin/modulalumni/modulalumni.php', $content, FALSE);

        }
    }


    //import data alumni
    public function importalumni(){

        require_once(APPPATH.'libraries/Excel/vendor/autoload.php');

        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if(isset($_FILES['excel']['name']) && in_array($_FILES['excel']['type'], $file_mimes)) {
 
            $arr_file = explode('.', $_FILES['excel']['name']);
            $extension = end($arr_file);
         
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
         
            $spreadsheet = $reader->load($_FILES['excel']['tmp_name']);
             
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            
            for($i = 1;$i < count($sheetData);$i++){
                
                $data = array(

                    'nisn' => $sheetData[$i]['1'],
                    'nama_alumni' => $sheetData[$i]['2'],
                    'tahun_lulus' => $sheetData[$i]['3'],
                    'status_alumni' => $sheetData[$i]['4'],
                    'detail_status' => $sheetData[$i]['5'],
                    'no_wa' => $sheetData[$i]['6'],
                    'detail_alamat' => $sheetData[$i]['7'],
                    'email' => $sheetData[$i]['8'],
                    'password' => password_hash($sheetData[$i]['9'], PASSWORD_DEFAULT),
                    'waktu_join' => date('Y-m-d H:i:s'),
                    'status_akun' => 'Y'

                );

                $this->Model_register->input_alumni_baru($data);
                $this->Model_user->insertloglogin($sheetData[$i]['1']);

            }

            echo json_encode('Berhasil Import Data');

        }else{

            echo json_encode('Ekstensi File Salah (harus .xlsx)');

        }

    }

    //export alumni
    public function exportalumni(){

        $data = array(
            'data' => $this->Model_Alumni->getAlumniRes()
        );

        $this->load->view('admin/export/alumni', $data, false);

    }
    
    
    //tambahan riwayat pekerjaan dan pendidikan

    public function riwayatpendidikan($nisn){

        if(!empty($_POST['pen_lembaga'])){

            $i=0;

            foreach ($_POST['pen_lembaga'] as $x){
    
                $data = array(
                    'tahun_mulai' => $_POST['pen_tahun_mulai'][$i],
                    'tahun_lulus' => $_POST['pen_tahun_selesai'][$i],
                    'lembaga' => $x,
                    'nisn' => $nisn
                );
    
                $this->Model_Alumni->tambahRiwayatPendidikan($data);
    
                $i++;
                
            }

        }

    }

    public function riwayatpekerjaan($nisn){

        if(!empty($_POST['pek_lembaga'])){

            $i = 0;

            foreach ($_POST['pek_lembaga'] as $x){
    
                $data = array(
                    'dari_tahun' => $_POST['pek_tahun_mulai'][$i],
                    'sampai_tahun' => $_POST['pek_tahun_selesai'][$i],
                    'lembaga' => $x,
                    'bidang_kerja' => $_POST['pek_bidangkerja'][$i],
                    'nisn' => $nisn
                );
    
                $i++;
    
                $this->Model_Alumni->tambahRiwayatPekerjaan($data);
    
            }

        }

    }

    public function hapusRiwayatPekerjaanByid(){
        $this->Model_Alumni->hapusRiwayatPekerjaanByid($_POST['id']);
    }

    public function hapusRiwayatPendidikanByid(){
        $this->Model_Alumni->hapusRiwayatPendidikanByid($_POST['id']);
    }
}
?>