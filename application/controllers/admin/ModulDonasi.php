<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModulDonasi extends CI_Controller{

    public function __construct(){
        parent :: __construct();
        $this->load->model('admin/Model_Alumni');
        $this->load->model('admin/Model_Berita');
        $this->load->model('admin/Model_Donasi');
        $this->load->model('admin/Model_Setting');
        date_default_timezone_set('Asia/Jakarta');

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
        
        $this->session->set_flashdata('location', "Kategori Donasi");

        $data = array(
            'data' => $this->Model_Donasi->getKategoridonasi()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/moduldonasi/kategoridonasi.php', $data, TRUE)
        );

        $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

        
    }

    public function editkategori(){

        $this->session->set_flashdata('location', "Kategori Donasi");

        $id_kategori = $this->uri->segment(4);

        if(empty($id_kategori)){

            redirect(base_url('admin/ModulDonasi/kategori'));

        }else{

            $data = array(
                'data' =>$this->Model_Donasi->getKategoridonasiByid($id_kategori)->result()
            );

            $content = array(
                'content' => $this->load->view('admin/moduldonasi/editkategoridonasi.php', $data, TRUE)
            );

            $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);


        }

    }

    public function editkategori_action(){
        $id_kategori = $this->input->post('id_kategoridonasi');
        $data = array(
            'nama_kategoridonasi' => $this->input->post('nama_kategoridonasi')
        );

        $this->Model_Donasi->editkategoridonasi($id_kategori, $data);
        echo json_encode('Update Kategori Berhasil');
    }

    public function tambahkategori(){

        $this->session->set_flashdata('location', "Kategori Donasi");

        $data = array(

        );

        $content = array(
            'content' => $this->load->view('admin/moduldonasi/tambahkategoridonasi', $data, TRUE)
        );

        $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);
    }

    public function tambahkategori_action(){

        if($this->Model_Donasi->ceknamakateori($this->input->post('nama_kategoridonasi'))->num_rows() != 0){

            echo json_encode('Kategori '.$this->input->post('nama_kategoridonasi').' Sudah Ada');

        }else{

            $data = array(
                'nama_kategoridonasi' => $this->input->post('nama_kategoridonasi')
            );

            $this->Model_Donasi->tambahkategoridonasi($data);

            echo json_encode('Kategori '.$this->input->post('nama_kategoridonasi').' berhasil ditambahkan');

        }

    }

    public function hapuskategori($id){
        $this->Model_Donasi->hapuskategoridonasi($id);
        redirect(base_url('admin/ModulDonasi/kategori'));
    }

    public function tambahdonasi(){

        $this->session->set_flashdata('location', "Tambah Donasi");

        $data = array(
            'list_kategoridonasi' => $this->Model_Donasi->getKategoridonasi()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/moduldonasi/tambahdonasi.php', $data, TRUE)
        );

        $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

    }

    public function tambahdonasi_action(){

        $config = array(
            'upload_path' => 'assets/donasi/img/',
            'allowed_types' => 'png|jpg|jpeg|jpg'
        );

        $this->load->library('upload', $config);
        $this->load->initialize($config);

        if($this->upload->do_upload('myFile')){
            $data = array(
                'judul_donasi' => $this->input->post('judul_donasi'),
                'id_kategoridonasi' => $this->input->post('id_kategoridonasi'),
                'tanggal_donasidibuat' => date('Y-m-d H:i:s'),
                'gambar_donasi' => $this->upload->data('file_name'),
                'donasi_dibuka' => $this->input->post('donasi_dibuka'),
                'donasi_ditutup' => $this->input->post('donasi_ditutup'),
                'target_dana' => str_replace(',', '', $this->input->post('target_dana')) ,
                'detail_program' => $this->input->post('detail_program'),
                'status_import' => 'N',
                'total_dilihat' => 0
            );

            $this->Model_Donasi->tambahdonasi($data);
            echo json_encode("Data Donasi Berhasil Disimpan.");

        }else{

            echo json_encode("Ekstensi gambar salah");

        }

    }

    public function listdonasi(){

        $list = $this->Model_Donasi->getlistdonasi();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x){

            $opened_donasi = $x->donasi_dibuka;
            $close_donasi = $x->donasi_ditutup;

            $no++;
            $row = array();
            $row[] = substr($x->judul_donasi, 0, 40)."...";
            $row[] = $x->nama_kategoridonasi;
            $row[] = date("d F Y", strtotime($opened_donasi))." / ".date("d F Y", strtotime($close_donasi));
            $row[] = $x->total_dilihat." kali";
            $row[] = "Rp. ".number_format($x->target_dana, 2, ',', '.');
            
            $row[] = '<center><a href="'.base_url('admin/ModulDonasi/editdata/'.$x->id_donasi).'" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a href="'.base_url('main/detaildonasi/'.$x->id_donasi).'" target="_BLANK"><span class="badge bg-success"><i class="fas fa-eye"></i></span></a> <a href="'.base_url('admin/ModulDonasi/hapusdonasi/'.$x->id_donasi).'" onclick="'."return confirm('yakin mau menghapus donasi ini ?')".'"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center>';
        
            $data[] = $row;

        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_Donasi->count_all_donasi(),
            'recordsFiltered' => $this->Model_Donasi->count_filtered_donasi(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);

    }

    public function data(){

        $this->session->set_flashdata('location', "Data Donasi");

        $data = array(

        );

        $content = array(
            'content' => $this->load->view('admin/moduldonasi/datadonasi.php', $data, TRUE)
        );

        $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

    }

    public function editdata(){

        $id = $this->uri->segment(4);

        if(empty($id) || $this->Model_Donasi->getDonasiByid($id)->num_rows() == 0){

            redirect(base_url('admin/ModulDonasi/data'));

        }else{

            $data = array(
                'data' => $this->Model_Donasi->getDonasiByid($id)->result(),
                'list_kategoridonasi' => $this->Model_Donasi->getKategoridonasi()->result()
            );
    
            $content = array(
                'content' => $this->load->view('admin/moduldonasi/editdonasi.php', $data, TRUE)
            );
    
            $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

        }

    }

    public function editdata_action(){

        $id = $this->input->post('id_donasi');

        if(!empty($_FILES['myFile']['name'])){

            $config = array(
                'upload_path' => 'assets/donasi/img/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );
    
            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if($this->upload->do_upload('myFile')){

                @unlink('assets/donasi/img/'.$this->Model_Donasi->getGambarDonasiOld($id));
                $data = array(
                    'gambar_donasi' => $this->upload->data('file_name')
                );

                $this->Model_Donasi->editDonasi($id, $data);

            }else{


            }

        }

        $data = array(
            'judul_donasi' => $this->input->post('judul_donasi'),
            'id_kategoridonasi' => $this->input->post('id_kategoridonasi'),
            'donasi_dibuka' => $this->input->post('donasi_dibuka'),
            'donasi_ditutup' => $this->input->post('donasi_ditutup'),
            'target_dana' => str_replace(',', '', $this->input->post('target_dana')) ,
            'detail_program' => $this->input->post('detail_program'),
        );

        $this->Model_Donasi->editDonasi($id, $data);

        echo json_encode("Data telah diperbarui");

    }

    public function hapusdonasi($id){
        @unlink('assets/donasi/img/'.$this->Model_Donasi->getGambarDonasiOld($id));
        $this->Model_Donasi->hapusdonasi($id);
        redirect(base_url('admin/ModulDonasi/data'));
    }

    public function kontribusi(){

        $this->session->set_flashdata('location', "Kontribusi Donasi");

        $data = array(
    
        );

        $content = array(
            'content' => $this->load->view('admin/moduldonasi/kontribusi.php', $data, TRUE)
        );

        $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

    }

    public function listkontribusi(){

        $list = $this->Model_Donasi->getlistkontribusi();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x){

            $date1 = new DateTime(date('Y-m-d', strtotime($x->donasi_ditutup)));
            $date2 = new DateTime();

            $no++;
            $row = array();
            $row[] = substr($x->judul_donasi, 0, 30)."...";
            if($date1 < $date2){
                $row[] = "Donasi Ditutup";
            }else{
                $row[] = $date1->diff($date2)->days." Hari lagi";
            }
            $row[] = $this->Model_Donasi->getTerverifikasi($x->id_donasi)->num_rows()." data";
            $row[] = $this->Model_Donasi->getBelumTerverifikasi($x->id_donasi)->num_rows()." data";
            $row[] = $this->Model_Donasi->getTidakTerverifikasi($x->id_donasi)->num_rows()." data";
            $row[] = "Rp. ".number_format($x->donasi_terkumpul, 2, ',', '.');
            
            $row[] = '<center><a href="'.base_url('admin/ModulDonasi/success/'.$x->id_donasi).'" ><span class="badge bg-primary"><i class="fas fa-user-check"></i></span></a> <a href="'.base_url('admin/ModulDonasi/process/'.$x->id_donasi).'" ><span class="badge bg-success"><i class="fas fa-user-tag"></i></span></a> <a href="'.base_url('admin/ModulDonasi/hidden/'.$x->id_donasi).'"><span class="badge bg-danger"><i class="fas fa-user-times"></i></span></a></center>';
        
            $data[] = $row;

        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_Donasi->count_all_kontribusi(),
            'recordsFiltered' => $this->Model_Donasi->count_filtered_kontribusi(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);

    }

    public function success(){
        $this->session->set_flashdata('location', "Kontribusi Donasi");

        $id = $this->uri->segment(4);

        if(empty($id)){

            redirect(base_url('admin/ModulDonasi/kontribusi'));

        }else{

            $data = array(
                'data' => $this->Model_Donasi->getTerverifikasi($id)->result(),
                'namadonasi' => $this->Model_Donasi->getnamadonasi($id)
            );

            $content = array(
                'content' => $this->load->view('admin/moduldonasi/data_acc.php', $data, TRUE)
            );

            $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

        }

    }

    public function process(){

        $this->session->set_flashdata('location', "Kontribusi Donasi");

        $id = $this->uri->segment(4);

        if(empty($id)){

            redirect(base_url('admin/moduldonasi/kontribusi'));

        }else{

            $data = array(
                'data' => $this->Model_Donasi->getBelumTerverifikasi($id)->result(),
                'namadonasi' => $this->Model_Donasi->getnamadonasi($id)
            );

            $content = array(
                'content' => $this->load->view('admin/moduldonasi/data_need.php', $data, TRUE)
            );

            $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

        }

    }

    public function hidden(){

        $this->session->set_flashdata('location', "Kontribusi Donasi");

        $id = $this->uri->segment(4);

        if(empty($id)){

            redirect(base_url('admin/ModulDonasi/kontribusi'));

        }else{

            $data = array(
                'data' => $this->Model_Donasi->getTidakTerverifikasi($id)->result(),
                'namadonasi' => $this->Model_Donasi->getnamadonasi($id)
            );

            $content = array(
                'content' => $this->load->view('admin/moduldonasi/data_hide.php', $data, TRUE)
            );

            $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

        }

    }

    public function detail(){

        $this->session->set_flashdata('location', "Kontribusi Donasi");

        $id_transaksi = $this->uri->segment(5);
        $id_donasi = $this->uri->segment(4);

        if(empty($id_transaksi) || empty($id_donasi)){

            redirect(base_url('admin/ModulDonasi/kontribusi'));

        }else{

            $data = array(
                'data' => $this->Model_Donasi->getTransaksi($id_transaksi)->result(),
                'namadonasi' => $this->Model_Donasi->getnamadonasi($id_donasi)
            );

            $content = array(
                'content' => $this->load->view('admin/moduldonasi/showdonasi.php', $data, TRUE)
            );

            $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

        }

    }

    public function perbaruhistatus(){

        $data = array(
            'status_pembayaran' => $this->input->post('status_pembayaran')
        );

        $this->Model_Donasi->updateTransaksi($this->input->post('id_transaksi'), $data);

        echo json_encode('Status Transaksi Diperbaruhi');
    }

    public function hapustransaksi($id_transaksi){
        @unlink('assets/donasi/file/'.$this->Model_Donasi->getBuktiTransfer($id_transaksi));
        $this->Model_Donasi->HapusTransaksi($id_transaksi);
        redirect(base_url('admin/ModulDonasi/kontribusi'));
    }

    public function donasiselesai(){

        $this->session->set_flashdata('location', "Donasi Selesai");

        $data = array(

        );

        $content = array(
            'content' => $this->load->view('admin/moduldonasi/donasiselesai.php', $data, TRUE)
        );  

        $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

    }

    public function listdonasiselesai(){

        $list = $this->Model_Donasi->getlistdonasiselesai();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x){

            $date1 = new DateTime(date('Y-m-d', strtotime($x->donasi_ditutup)));
            $date2 = new DateTime();

            $no++;
            $row = array();
            $row[] = substr($x->judul_donasi, 0, 30)."...";
            $row[] = $this->Model_Donasi->getTerverifikasi($x->id_donasi)->num_rows()." data";
            $row[] = $this->Model_Donasi->getBelumTerverifikasi($x->id_donasi)->num_rows()." data";
            $row[] = $this->Model_Donasi->getTidakTerverifikasi($x->id_donasi)->num_rows()." data";
            $row[] = "Rp. ".number_format($x->target_dana, 2, ',', '.');
            $row[] = "Rp. ".number_format($x->donasi_terkumpul, 2, ',', '.');
            
            $row[] = '<center><a target="_BLANK" href="'.base_url('admin/ModulDonasi/exportPdf/'.$x->id_donasi).'" ><span class="badge bg-info">Pdf</span></a>  <a target="_BLANK" href="'.base_url('admin/ModulDonasi/exportDonatur/'.$x->id_donasi).'" ><span class="badge bg-secondary">Excle</span></a></center>';
        
            $data[] = $row;

        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_Donasi->count_all_donasiselesai(),
            'recordsFiltered' => $this->Model_Donasi->count_filtered_donasiselesai(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);

    }

    public function exportPdf(){
        $id_donasi = $this->uri->segment(4);

        $this->load->library('TCPDF-main/tcpdf.php');

        if(empty($id_donasi)){

            redirect(base_url('admin/ModulDonasi/donasiselesai'));

        }else{

            $data = array(
                'judul_donasi' => $this->Model_Donasi->getnamadonasi($id_donasi),
                'datadonasi' => $this->Model_Donasi->getDonasiByid($id_donasi)->result(),
                'totaldonatur' => $this->Model_Donasi->totalDonatur($id_donasi),
                'totaldanaterkumpul' => $this->Model_Donasi->totalDanaTerkumpul($id_donasi),
                'donatur' => $this->Model_Donasi->viewdoadonatur_total($id_donasi)->result(),
            );

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('Laporan Donasi');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
            $pdf->setFooterData(array(0,64,0), array(0,64,128));

            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            $pdf->setFontSubsetting(true);

            $pdf->SetFont('dejavusans', '', 14, '', true);

            $pdf->AddPage();

            $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

            foreach($data['datadonasi'] as $x) {

                $html = '<center><h3 style="margin-bottom:20px;">'.$data['judul_donasi'].'</h3></center>';
                $html .= '<font size="12" face="Courier New" >';
                $html .= '<p>'.$x->detail_program.'</p>';
                $html .= '<table border ="1" cellpadding="15" style="width:100%;">';
                $html .= '<tbody>';
    
                $html .= '<tr scope="row">
                        <td>Donasi Dibuka</td>
                        <td> ' .$x->donasi_dibuka. '</td>
                        </tr>';
                $html .= '<tr scope="row">
                        <td>Donasi Dibuka</td>
                        <td> ' .$x->donasi_ditutup. '</td>
                        </tr>';
                $html .= '<tr scope="row">
                        <td>Target Dana</td>
                        <td> Rp. ' . number_format($x->target_dana, 2, ',', '.'). '</td>
                        </tr>';
                $html .= '<tr scope="row">
                        <td>Total Donatur</td>
                        <td> ' . $data['totaldonatur']. ' Donatur </td>
                        </tr>';
                $html .= '<tr scope="row">
                        <td>Dana Terkumpul</td>
                        <td> Rp. ' . number_format($data['totaldanaterkumpul'], 2, ',', '.'). '</td>
                        </tr>';

                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '</font>';

            }

            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->AddPage();
            $htmls = '<font size="11" face="Courier New">';
            $htmls .= '<center><b>Data Donatur</b></center><br><br>';
            $htmls .= '<table class="table" border ="1" cellpadding="5" style="width:100%;">
                <tr>
                <th style="width: 10%">No</th>
                <th>Tanggal Donasi</th>
                <th style="width: 40%">Nama Donatur</th>
                <th>Nominal</th>
                </tr>
            <tbody>';
            $i = 1;
            foreach ($data['donatur'] as $x){
                $originalDate = $x->tanggal_bayar;
                $newDate = date("d F Y", strtotime($originalDate)); 
                $htmls .= '<tr>
                            <td scope="row">'.$i++.'</td>
                            <td>'.$newDate.'</td>
                            <td>'.$x->nama_alumni.'</td>
                            <td>Rp. '.number_format($x->total_donasi, 2, ',', '.').'</td>
                        </tr>';
            }

            $htmls .= '</tbody></table>';
            $html .= '</font>';
            $pdf->writeHTMLCell(0, 0, '', '', $htmls, 0, 1, 0, true, '', true);

            $pdf->Output('Lapran Donasi.pdf', 'I');


        }

    }

    public function rekening(){

        $this->session->set_flashdata('location', "Rekening");

        $data = array(
            'data' => $this->Model_Donasi->listrekening()->result()
        );

        $content = array(
            'content' => $this->load->view('admin/moduldonasi/rekening.php', $data, TRUE)
        );

        $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

    }

    public function tambahrekening(){

        $this->session->set_flashdata('location', "Rekening");

        $data = array(
            
        );

        $content = array(
            'content' => $this->load->view('admin/moduldonasi/tambahrekening.php', $data, TRUE)
        );

        $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);

    }

    public function tambahrekening_action(){

        $data = array(
            'nama_tipepembayaran' => $this->input->post('nama_tipepembayaran'),
            'rekening' => $this->input->post('rekening'),
            'atas_nama'=>$this->input->post('atas_nama')
        );

        $this->Model_Donasi->tambahrekening($data);

        echo json_encode('Rekening Baru Berhasil Ditambahkan');

    }

    public function editrekening(){

        $id = $this->uri->segment(4);

        if(empty($id)){

            redirect(base_url('admin/ModulDonasi/rekening'));

        }else{
            $data = array(
                'data' => $this->Model_Donasi->listrekeningByid($id)->result()
            );

            $content = array(
                'content' => $this->load->view('admin/moduldonasi/editrekening.php', $data, TRUE)
            );

            $this->load->view('admin/moduldonasi/moduldonasi.php', $content, FALSE);
        }

    }

    public function editrekening_action(){

        $data = array(
            'nama_tipepembayaran' => $this->input->post('nama_tipepembayaran'),
            'rekening' => $this->input->post('rekening'),
            'atas_nama'=>$this->input->post('atas_nama')
        );

        $this->Model_Donasi->editrekening($this->input->post('id_tipepembayaran'),$data);

        echo json_encode('Rekening Berhasil Diedit');

    }

    public function hapusrekening($id){

        $this->Model_Donasi->hapusrekening($id);

        redirect(base_url('admin/ModulDonasi/rekening'));

    }

    //export data donasi
    public function exportDonasi(){

        $data = array(
            'data' => $this->Model_Donasi->getDonasi()
        );

        $this->load->view('admin/export/donasi.php', $data, FALSE);

    }

    public function exportDonasiSelesai(){

        $data = array(
            'data' => $this->Model_Donasi->getDonasiSelesai()
        );

        $this->load->view('admin/export/donasiselesai.php', $data, FALSE);

    }

    public function exportDonatur($id_donasi){

        $data = array(
            'donatur' => $this->Model_Donasi->viewdoadonatur_total($id_donasi)->result(),
            'judul_donasi' => $this->Model_Donasi->getnamadonasi($id_donasi),
            'totaldanaterkumpul' => $this->Model_Donasi->totalDanaTerkumpul($id_donasi),
        );

        $this->load->view('admin/export/donatur.php', $data, FALSE);

    }

}
?>