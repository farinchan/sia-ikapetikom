<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('user/Model_wilayah');
        $this->load->model('user/Model_register');
        $this->load->model('user/Model_user');
        $this->load->model('user/Model_donasi');
        $this->load->model('user/Model_pekerjaan');
        $this->load->model('admin/Model_Setting');
        $this->load->model('admin/Model_Dashboard');

        //tambahan riwayat pekerjaan dan pendidikan
        $this->load->model('admin/Model_Alumni');

        $data = array(
            'listberita' => $this->Model_user->userberitapopuler()->result(),
            'web' => $this->Model_Setting->getWebsite()->result()
        );

        $this->load->view('user/partisi/navbar.php', $data, TRUE);
        $this->load->view('user/partisi/head.php', $data, TRUE);
        $this->load->view('user/register/syarat_ketentuan.php', $data, TRUE);
    }

    //gis alumni
    public function gisAlumni()
    {


        if (isset($_SESSION['nisn_session'])) {

            $data = [
                "alumni" => $this->Model_Alumni->getAlumniAktif()->result(),
                "lulus" => $this->Model_register->get_tahunlulus()->result()
            ];

            $this->session->set_flashdata('location', "GisAlumni");
            $this->load->view('user/gis_alumni/map', $data, TRUE);
            $this->load->view('user/gis_alumni/gisalumni.php');
        } else {

            redirect(base_url('main/login'));
        }
    }

    public function gisAlumniGet()
    {
        if (isset($_SESSION['nisn_session'])) {

            header('Content-Type: application/json');

            $result = $this->Model_Alumni->getAlumniAktif()->result();
            $tahun_lulus = $this->Model_register->get_tahunlulus()->result();

            $filter = $this->input->get('filter');

            if ($filter == "true") {
                $response = new stdClass();
                foreach ($tahun_lulus as $tahun) {
                    $resultTemp = [];
                    foreach ($result as $row) {

                        if ($tahun->tahun_lulus == $row->tahun_lulus) {
                            $data = null;
                            $data['type'] = "Feature";
                            $data['id'] = $row->nisn;
                            $data['properties'] = [
                                "nia" => $row->nisn,
                                "nama_alumni" => $row->nama_alumni,
                                "tahun_lulus" => $row->tahun_lulus,
                                "status_alumni" => $row->status_alumni,
                                "detail_status" => $row->detail_status,
                                "no_wa" => $row->no_wa,
                                "detail_alamat" => $row->detail_alamat,
                                // 'alamat_provinsi' => $this->Model_user->getNamakota($row->alamat_provinsi),
                                // 'alamat_kabupaten' => $this->Model_user->getNamakota($row->alamat_kabupaten),
                                // 'alamat_kecamatan' => $this->Model_user->getNamakota($row->alamat_kecamatan),
                                "foto_alumni" => $row->foto_alumni == null ? "Belum diisi" : "$row->foto_alumni",
                                "facebook" => $row->facebook == null ? "Belum diisi" : "$row->facebook",
                                "twitter" => $row->twitter == null ? "Belum diisi" : "$row->twitter",
                                "instagram" => $row->instagram == null ? "Belum diisi" : "$row->instagram",
                                "icon" => base_url('assets/user/placeholder.png'),
                                "popUp" => "<table>
                                            <tr>
                                                <td colspan='3' ><center><img width='150' src=" . base_url() . "assets/user/img/" . $row->foto_alumni  . "></center></td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td> : </td>
                                                <td>" . $row->nama_alumni . "</td>
                                            </tr>
                                            <tr>
                                                <td>NIA</td>
                                                <td> : </td>
                                                <td>" . $row->nisn . "</td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Lulus</td>
                                                <td> : </td>
                                                <td>" . $row->tahun_lulus . "</td>
                                            </tr>
                                            <tr>
                                                <td><b>Alamat</b></td>
                                                <td> : </td>
                                                <td>" . $row->detail_alamat . "</td>
                                            </tr>
                                        </table>"
                            ];
                            $data['geometry'] = [
                                "type" => "Point",
                                "coordinates" => [$row->latitude, $row->longitude]
                            ];
                            $data['title'] =  $row->nama_alumni;
                            $data['loc'] = [$row->latitude, $row->longitude];

                            array_push($resultTemp, $data);
                        }
                    }
                    $tahunlulus = $tahun->tahun_lulus;
                    $response->$tahunlulus = $resultTemp;
                }

                echo json_encode($response, JSON_PRETTY_PRINT);
            } else {

                $response = [];

                foreach ($result as $row) {

                    $data = null;
                    $data['type'] = "Feature";
                    $data['id'] = $row->nisn;
                    $data['properties'] = [
                        "nia" => $row->nisn,
                        "nama_alumni" => $row->nama_alumni,
                        "tahun_lulus" => $row->tahun_lulus,
                        "status_alumni" => $row->status_alumni,
                        "detail_status" => $row->detail_status,
                        "no_wa" => $row->no_wa,
                        "detail_alamat" => $row->detail_alamat,
                        // 'alamat_provinsi' => $this->Model_user->getNamakota($row->alamat_provinsi),
                        // 'alamat_kabupaten' => $this->Model_user->getNamakota($row->alamat_kabupaten),
                        // 'alamat_kecamatan' => $this->Model_user->getNamakota($row->alamat_kecamatan),
                        "facebook" => $row->facebook == null ? "Belum diisi" : "$row->facebook",
                        "twitter" => $row->twitter == null ? "Belum diisi" : "$row->twitter",
                        "instagram" => $row->instagram == null ? "Belum diisi" : "$row->instagram",
                        "icon" => base_url('assets/user/placeholder.png'),
                        "popUp" => "Lokasi : " . $row->detail_alamat
                    ];
                    $data['geometry'] = [
                        "type" => "Point",
                        "coordinates" => [$row->latitude, $row->longitude]
                    ];
                    $data['title'] =  $row->nama_alumni;
                    $data['loc'] = [$row->latitude, $row->longitude];

                    array_push($response, $data);
                }
                echo json_encode($response, JSON_PRETTY_PRINT);
            }
        } else {
            redirect(base_url('main/login'));
        }
    }

    //tracer study (pekerjaan)
    public function pekerjaan()
    {
        if (isset($_SESSION['nisn_session'])) {

            $this->session->set_flashdata('location', "Pekerjaan");
            $data = array(
                'last_login' => $this->Model_user->lastlogin($_SESSION['nisn_session']),
                'data_profil' => $this->Model_user->getDataAlumni($_SESSION['nisn_session'])->result(),
                'pekerjaan_tersedia' => $this->Model_pekerjaan->check_if_exist($_SESSION['nisn_session']),
                'total_berita' => $this->Model_user->totalberita_alumni()->num_rows(),
                'pesan_belum_terbaca' => $this->Model_user->pesanbelumterbaca()->num_rows(),
                'totaltopik' => $this->Model_user->totaltopikdibuat()->num_rows(),
                'total_donasi' => $this->Model_donasi->getDonasiByNisn()->num_rows(),

                //tambahan riwayat pekerjaan dan pendidikan
                'riwayatpekerjaan' => $this->Model_Alumni->getRiwayatPekerjaan($_SESSION['nisn_session'])->result(),
                // 'riwayatpendidikan' => $this->Model_Alumni->getRiwayatPendidikan($_SESSION['nisn_session'])->result()
            );
            if ($this->Model_pekerjaan->check_if_exist($_SESSION['nisn_session'])) {
                # code...
                $data['pekerjaan'] = $this->Model_pekerjaan->get_data_pekerjaan($_SESSION['nisn_session']);
            }

            $content = array(
                'content' => $this->load->view('user/pekerjaan/view_pekerjaan.php', $data, TRUE)
            );

            $this->load->view('user/pekerjaan/foto_profil.php', $data, TRUE);
            $this->load->view('user/pekerjaan/pekerjaan.php', $content, FALSE);
        } else {

            redirect(base_url('main/login'));
        }
        // $this->load->view('user/tracer/tracer.php', $content, FALSE);
    }
    public function ubahpekerjaan_action()
    {
        // echo json_encode();
        if (isset($_SESSION['nisn_session'])) {
            // var_dump($this->Model_pekerjaan->get_data_pekerjaan('123'));
            $data = (object) $this->input->post();
            if ($this->Model_pekerjaan->check_if_exist($_SESSION['nisn_session'])) {
                // var_dump($this->Model_pekerjaan->update_trace_pekerjaan($_SESSION['nisn_session'], $data));
                if ($this->Model_pekerjaan->update_trace_pekerjaan($_SESSION['nisn_session'], $data)) {
                    # code...
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Succesfully Updated!');
                    window.location.href='" . base_url('main/pekerjaan') . "';
                    </script>");
                }
                # code...jika pekerjaan dengan nisn tertentu ada (update)
            } else {
                # code...jika pekerjaan dengan nisn tertentu tidak ada (create)
                if ($this->Model_pekerjaan->insert_trace_pekerjaan($data)) {
                    # code...
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Succesfully Added!');
                    window.location.href='" . base_url('main/pekerjaan') . "';
                    </script>");
                }
            }
        } else {
            redirect(base_url('main/login'));
        }
    }

    //Landing Page

    public function index()
    {
        $this->session->set_flashdata('location', 'Home');

        $allcount = $this->Model_Dashboard->TotGaleri();

        $config['base_url'] = base_url() . 'main/index/';
        $config['total_rows'] = $allcount;
        $config['per_page'] = 12;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end mt-5">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $data = array(
            'tahun_lulus' => $this->Model_user->getviewtotalalumni()->result(),
            'listberita' => $this->Model_user->userberitalandingpage()->result(),
            'listdonasi' => $this->Model_donasi->listdonasiNew(4)->result(),
            'web' => $this->Model_Setting->getWebsite()->result(),
            'galeri' => $this->Model_Dashboard->getGaleriKegiatan($config['per_page'], $data['page'])->result()
        );

        $content = array(
            'counter_alumni' => $this->load->view('user/dashboard/counter_alumni.php', $data, TRUE),
            'breadcrumb' => $this->load->view('user/dashboard/breadcrumb.php', $data, TRUE),
            'donasi_alumni' => $this->load->view('user/dashboard/donasi_alumni.php', $data, TRUE),
            'galeri_alumni' => $this->load->view('user/dashboard/galeri_alumni.php', $data, TRUE),
            'kegiatan_alumni' => $this->load->view('user/dashboard/kegiatan_alumni.php', $data, TRUE),

        );

        $this->load->view('user/dashboard/dashboard.php', $content, FALSE);
    }

    // Register Alumni

    public function register()
    {

        if (isset($_SESSION['nisn_session'])) {

            redirect(base_url('main/profil'));
        } else {

            $this->session->set_flashdata('location', 'Register');
            $data = array(
                'provinsi' => $this->Model_wilayah->get_provinsi()->result(),
                'tahunlulus' => $this->Model_register->get_tahunlulus()->result(),
            );

            $content = array(
                'content' => $this->load->view('user/register/content.php', $data, TRUE)
            );

            $this->load->view('user/register/register.php', $content, FALSE);
        }
    }

    public function registeralumni_action()
    {

        $config = array(
            'upload_path' => 'assets/user/img/',
            'allowed_types' => 'png|jpg|jpeg'
        );

        $this->load->library('upload', $config);
        $this->load->initialize($config);

        if ($this->Model_register->validation_before_register($this->input->post('nisn'), $this->input->post('email'))->num_rows() != 0) {

            echo json_encode("NISN atau email sudah digunakan");
        } else if ($this->upload->do_upload('myFile')) {
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
                'foto_alumni' => $this->upload->data('file_name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'waktu_join' => date('Y-m-d H:i:s'),
                'status_akun' => 'N'
            );

            $this->Model_register->input_alumni_baru($data);
            $this->Model_user->insertloglogin($this->input->post('nisn'));

            echo json_encode("Data berhasil disimpan, Silahkan hubungi Admin untuk mengaktifkan akun anda");
        } else {

            echo json_encode("Ekstensi gambar anda salah");
        }
    }

    public function get_data_wilayah()
    {

        $data = $this->input->post('data');
        $id = $this->input->post('id');

        $n = strlen($id);
        $m = ($n == 2 ? 5 : ($n == 5 ? 8 : 13));

        if ($data == "kabupaten") {

            $data = array('kabupaten' => $this->Model_wilayah->get_kabupaten_kecamatan($n, $id, $m)->result());
        } else if ($data == "kecamatan") {

            $data = array('kecamatan' => $this->Model_wilayah->get_kabupaten_kecamatan($n, $id, $m)->result());
        }

        echo json_encode($data);
    }


    // Login Alumni

    public function login()
    {

        if (isset($_SESSION['nisn_session'])) {

            redirect(base_url('main/profil'));
        } else {

            $data = array(
                'number_1' => rand(1, 10),
                'number_2' => rand(1, 10),
            );

            $this->session->set_flashdata('location', "Login");
            $this->load->view('user/login/content.php', $data, TRUE);
            $this->load->view('user/login/login.php');
        }
    }

    public function actionlogin()
    {
        $nisn = $this->input->post('nisn');
        $password = $this->input->post('password');
        $jawaban = $this->input->post('number_1') + $this->input->post('number_2');

        if ($this->input->post('captcha') == $jawaban) {

            if ($this->Model_register->validation_akun($nisn)->num_rows() > 0) {

                if ($this->Model_register->validation_nisn($nisn)->num_rows() > 0) {

                    foreach ($this->Model_register->view_nisn_email_password()->result() as $pass_check) {

                        if (password_verify($password, $pass_check->password)) {

                            $this->createsession($nisn);

                            redirect(base_url('main/profil'));
                        }
                    }

                    redirect(base_url('main/login/nisnfalse'));
                } else {

                    // return print_r($this->Model_register->validation_nisn($nisn)->num_rows());

                    redirect(base_url('main/login/nisnfalse'));
                }
            } else {

                redirect(base_url('main/login/aktifasi'));
            }
        } else {

            redirect(base_url('main/login/captchawrong'));
        }
    }

    public function createsession($nisn)
    {
        $data = array(
            'nisn_session' => $nisn,
            'nama_session' => $this->Model_user->getnamaalumni($nisn)
        );

        $this->session->set_userdata($data);
        $this->Model_user->insertloglogin($nisn);
    }

    public function unsetsession()
    {
        $data = array(
            $_SESSION['nisn_session'],
            $_SESSION['nama_session'],
        );

        $this->session->unset_userdata($data);
        session_destroy();
    }

    public function logoutsystem()
    {
        $this->unsetsession();
        redirect(base_url('main/login'));
    }

    // user profil

    public function profil()
    {

        if (isset($_SESSION['nisn_session'])) {

            $this->session->set_flashdata('location', "Dashboard Alumni");
            $data = array(
                'last_login' => $this->Model_user->lastlogin($_SESSION['nisn_session']),
                'data_profil' => $this->Model_user->getDataAlumni($_SESSION['nisn_session'])->result(),
                'kota' => $this->Model_user->getKota($_SESSION['nisn_session']),
                'total_berita' => $this->Model_user->totalberita_alumni()->num_rows(),
                'pesan_belum_terbaca' => $this->Model_user->pesanbelumterbaca()->num_rows(),
                'totaltopik' => $this->Model_user->totaltopikdibuat()->num_rows(),
                'total_donasi' => $this->Model_donasi->getDonasiByNisn()->num_rows(),

                //tambahan riwayat pekerjaan dan pendidikan
                'riwayatpekerjaan' => $this->Model_Alumni->getRiwayatPekerjaan($_SESSION['nisn_session'])->result(),
                'riwayatpendidikan' => $this->Model_Alumni->getRiwayatPendidikan($_SESSION['nisn_session'])->result()
            );

            $content = array(
                'content' => $this->load->view('user/alumni_dashboard/view_profil.php', $data, TRUE)
            );

            $this->load->view('user/alumni_dashboard/foto_profil.php', $data, TRUE);
            $this->load->view('user/alumni_dashboard/alumni_dashboard.php', $content, FALSE);
        } else {

            redirect(base_url('main/login'));
        }
    }

    public function updatefotoprofil()
    {
        $config = array(
            'upload_path' => 'assets/user/img/',
            'allowed_types' => 'png|jpg|jpeg|JPG'
        );

        $this->load->library('upload', $config);
        $this->load->initialize($config);

        if ($this->upload->do_upload('myFile')) {
            $data = array(
                'foto_alumni' => $this->upload->data('file_name')
            );

            @unlink('assets/user/img/' . $this->Model_user->getfotoprofil_old($_SESSION['nisn_session']));

            $this->Model_user->updateprofil($_SESSION['nisn_session'], $data);
            echo json_encode('Foto Profil berhasil diperbaharui');
        } else {

            echo json_encode("ekstensi gambar salah");
        }
    }

    public function editprofil()
    {

        if (isset($_SESSION['nisn_session'])) {

            $this->session->set_flashdata('location', "Edit Profil");
            $data = array(
                'provinsi' => $this->Model_wilayah->get_provinsi()->result(),
                'tahunlulus' => $this->Model_register->get_tahunlulus()->result(),
                'data_profil' => $this->Model_user->getDataAlumni($_SESSION['nisn_session'])->result(),
                'kota' => $this->Model_user->getKota($_SESSION['nisn_session']),

                //tambahan riwayat pekerjaan dan pendidikan
                'riwayatpekerjaan' => $this->Model_Alumni->getRiwayatPekerjaan($_SESSION['nisn_session'])->result(),
                'riwayatpendidikan' => $this->Model_Alumni->getRiwayatPendidikan($_SESSION['nisn_session'])->result()
            );

            $content = array(
                'content' => $this->load->view('user/alumni_dashboard/update_profil.php', $data, TRUE)
            );

            $this->load->view('user/alumni_dashboard/foto_profil.php', $data, TRUE);
            $this->load->view('user/alumni_dashboard/alumni_dashboard.php', $content, FALSE);
        } else {

            redirect(base_url('main/login'));
        }
    }

    public function updateprofil_action()
    {

        if (!empty($this->input->post('password'))) {

            $data = array(
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );

            $this->Model_user->updateprofil($_SESSION['nisn_session'], $data);
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
            'email' => $this->input->post('email'),

            //tambahan riwayat pekerjaan dan pendidikan
            'facebook' => $this->input->post('facebook'),
            'instagram' => $this->input->post('instagram'),
            'twitter' => $this->input->post('twitter')
        );

        $this->Model_user->updateprofil($_SESSION['nisn_session'], $data);

        //tambahan riwayat pekerjaan dan pendidikan
        $this->Model_Alumni->hapusSemuaRiwayatPendidikan($this->input->post('nisn'));
        $this->Model_Alumni->hapusSemuaRiwayatPekerjaan($this->input->post('nisn'));

        //tambahan riwayat pekerjaan dan pendidikan
        $this->riwayatpekerjaan($this->input->post('nisn'));
        $this->riwayatpendidikan($this->input->post('nisn'));

        echo json_encode("Data berhasil di update");
    }

    //tambahan riwayat pekerjaan dan pendidikan

    public function riwayatpendidikan($nisn)
    {

        if (!empty($_POST['pen_lembaga'])) {

            $i = 0;

            foreach ($_POST['pen_lembaga'] as $x) {

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

    public function riwayatpekerjaan($nisn)
    {

        if (!empty($_POST['pek_lembaga'])) {

            $i = 0;

            foreach ($_POST['pek_lembaga'] as $x) {

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


    public function berita()
    {

        if (isset($_SESSION['nisn_session'])) {

            $data = array(
                'totalberita_published' => $this->Model_user->getlistberitaalumni_published()->num_rows(),
                'totalberita_unpublished' => $this->Model_user->getlistberitaalumni_unpublished()->num_rows()
            );

            $content = array(
                'content' => $this->load->view('user/alumni_berita/list_berita.php', $data, TRUE)
            );

            $this->load->view('user/alumni_berita/alumni_berita.php', $content, FALSE);
        } else {

            redirect(base_url('main/login'));
        }
    }

    public function tambahberita()
    {

        if (isset($_SESSION['nisn_session'])) {

            $data = array(
                'list_kategoriberita' => $this->Model_user->listkategoriberita()->result()
            );

            $content = array(
                'content' => $this->load->view('user/alumni_berita/tambah_berita.php', $data, TRUE)
            );

            $this->load->view('user/alumni_berita/alumni_berita.php', $content, FALSE);
        } else {

            redirect(base_url('main/login'));
        }
    }

    public function tambahberita_action()
    {

        $config = array(
            'upload_path' => 'assets/berita/',
            'allowed_types' => 'png|jpg|jpeg|JPG'
        );

        $this->load->library('upload', $config);
        $this->load->initialize($config);

        if ($this->upload->do_upload('myFile')) {
            $data = array(
                'gambar_berita' => $this->upload->data('file_name'),
                'judul_berita' => $this->input->post('judul_berita'),
                'isi_berita' => $this->input->post('isi_berita'),
                'status_berita' => 'N',
                'tanggal_posting' => date('Y-m-d H:i:s'),
                'total_dilihat' => 0,
                'id_kategoriberita' => $this->input->post('id_kategoriberita'),
                'nisn' => $_SESSION['nisn_session']
            );

            $this->Model_user->insertberita($data);
            echo json_encode("Berita yang anda buat berhasil disimpan, silahkan hubungi admin untuk mempublish berita anda");
        } else {

            echo json_encode("ekstensi gambar salah");
        }
    }

    public function listberita()
    {

        $list = $this->Model_user->getlistberita();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x) {

            $originalDate = $x->tanggal_posting;
            $newDate = date("d F Y", strtotime($originalDate));

            $no++;
            $row = array();
            $row[] = $x->judul_berita;
            $row[] = $x->nama_kategoriberita;
            $row[] = $newDate;
            if ($x->status_berita == 'Y') {
                $row[] = "<i style='color:green'>Published</i>";
            } else {
                $row[] = "<i style='color:red'>Unpublished</i>";
            }

            $row[] = $x->total_dilihat . " kali";

            $row[] = '<center><a href="' . base_url('main/editberita/' . $x->id_berita) . '" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a href="' . base_url('main/bacaberita/' . $x->id_berita) . '" ><span class="badge bg-success"><i class="fas fa-eye"></i></span></a> <a href="' . base_url('main/hapusberita/' . $x->id_berita) . '" onclick="' . "return confirm('yakin mau menghapus berita ini ?')" . '"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center>';


            $data[] = $row;
        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_user->count_all_berita(),
            'recordsFiltered' => $this->Model_user->count_filtered_berita(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);
    }

    public function hapusberita($id_berita)
    {
        @unlink('assets/berita/' . $this->Model_user->getgambarberita_old($id_berita));
        $this->Model_user->hapusberita($id_berita);
        redirect(base_url('main/berita/dlt'));
    }

    public function editberita()
    {

        if (empty($this->uri->segment(3)) || $this->Model_user->cekberita($this->uri->segment(3))->num_rows() == 0) {

            redirect(base_url('main/berita'));
        } else {

            $id_berita = $this->uri->segment(3);

            $data = array(
                'list_kategoriberita' => $this->Model_user->listkategoriberita()->result(),
                'berita' => $this->Model_user->cekberita($id_berita)->result()
            );

            $content = array(
                'content' => $this->load->view('user/alumni_berita/view_editberita.php', $data, TRUE)
            );

            $this->load->view('user/alumni_berita/alumni_berita.php', $content, FALSE);
        }
    }

    public function editberita_action()
    {

        $id_berita = $this->input->post('id_berita');

        if (!empty($_FILES['myFile']['name'])) {

            $config = array(
                'upload_path' => 'assets/berita/',
                'allowed_types' => 'png|jpg|jpeg|JPG'
            );

            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if ($this->upload->do_upload('myFile')) {

                @unlink('assets/berita/' . $this->Model_user->getgambarberita_old($id_berita));
                $data = array(
                    'gambar_berita' => $this->upload->data('file_name')
                );

                $this->Model_user->editberita($id_berita, $data);
            } else {
            }
        }

        $data = array(
            'judul_berita' => $this->input->post('judul_berita'),
            'isi_berita' => $this->input->post('isi_berita'),
            'id_kategoriberita' => $this->input->post('id_kategoriberita')
        );

        $this->Model_user->editberita($id_berita, $data);

        echo json_encode("Berita telah diperbarui");
    }


    public function carialumni()
    {

        $this->session->set_flashdata('location', "Cari Alumni");

        $data = array(
            'provinsi' => $this->Model_wilayah->get_provinsi()->result(),
            'tahunlulus' => $this->Model_register->get_tahunlulus()->result(),
            'kategori_berita' => $this->Model_user->userlistkategoriberita()->result(),
            'total_berita_admin' => $this->Model_user->getberitadmin()->num_rows(),
            'kategori_donasi' => $this->Model_donasi->getKategoridonasi()->result(),
        );

        $content = array(
            'content' => $this->load->view('user/cari_alumni/content.php', $data, TRUE)
        );

        $this->load->view('user/cari_alumni/sidebar.php', $data, TRUE);
        $this->load->view('user/cari_alumni/cari_alumni.php', $content, FALSE);
    }

    public function listalumni()
    {

        $list = $this->Model_user->getlistalumni();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x) {

            $no++;
            $row = array();
            $row[] = $x->nama_alumni;
            $row[] = $x->tahun_lulus;
            if ($x->status_alumni == "pelajar") {
                $row[] = "Pelajar";
            } else {
                $row[] = "Bekerja";
            }
            $row[] = $x->detail_status;
            $row[] = '<center><a href="' . base_url('main/lihatprofil/' . $x->nisn) . '"><span class="badge bg-primary">Lihat</span></a></center>';

            $data[] = $row;
        }

        $output = array(

            'draw' => $_POST['draw'],
            'recordsTotal' => $this->Model_user->count_all_alumni(),
            'recordsFiltered' => $this->Model_user->count_filtered_alumni(),
            'data' => $data,
            'search' => $_POST['search']['value']

        );

        echo json_encode($output);
    }

    public function filteralumni()
    {

        // $provinsi = $this->input->post('provinsi');
        // $kabupaten = $this->input->post('kabupaten');
        // $kecamatan = $this->input->post('kecamatan');
        $nama_alumni = $this->input->post('nama_alumni');
        $tahun_lulus = $this->input->post('tahun_lulus');

        $data = array(
            'list_alumni' => $this->Model_user->filteralumni($nama_alumni, $tahun_lulus)->result()
        );

        echo json_encode($data);
    }

    public function lihatprofil()
    {
        $nisn = $this->uri->segment(3);
        $this->session->set_flashdata('location', "Cari Alumni");

        if (isset($_SESSION['nisn_session'])) {

            if ($_SESSION['nisn_session'] == $nisn) {

                redirect(base_url('main/profil'));
            }
        }

        if (empty($nisn) || $this->Model_user->get_alumni_by_nisn($nisn)->num_rows() == 0) {

            redirect(base_url('main/carialumni'));
        } else {

            $data = array(
                'data_profil' => $this->Model_user->get_alumni_by_nisn($nisn)->result(),
                'last_login' => $this->Model_user->lastlogin($nisn),
                'kota' => $this->Model_user->getKota($nisn),
                'total_berita' => $this->Model_user->totalberita_lihatalumni($nisn)->num_rows(),
                'totaldonasi' => $this->Model_donasi->getDonasiByNisnSearch($nisn)->num_rows(),

                //tambahan riwayat pekerjaan dan pendidikan
                'riwayatpekerjaan' => $this->Model_Alumni->getRiwayatPekerjaan($nisn)->result(),
                'riwayatpendidikan' => $this->Model_Alumni->getRiwayatPendidikan($nisn)->result()
            );

            $content = array(
                'content' => $this->load->view('user/cari_alumni/detail_profil.php', $data, TRUE)
            );

            $this->load->view('user/cari_alumni/foto_profil.php', $data, TRUE);
            $this->load->view('user/cari_alumni/lihat_alumni.php', $content, FALSE);
        }
    }

    public function pesan()
    {

        $this->session->set_flashdata('location', "Pesan");

        if (isset($_SESSION['nisn_session'])) {

            $data = array(
                'list_nisn_pengirim' => $this->Model_user->get_nama_nisn_pengirimpesan(),
                'list_nisn_tujuan' => $this->Model_user->get_nama_nisn_tujuanpesan()
            );

            $content = array(
                'content' => $this->load->view('user/alumni_pesan/home_pesan.php', $data, TRUE)
            );

            $this->load->view('user/alumni_pesan/alumni_pesan.php', $content, FALSE);
        } else {

            redirect(base_url('main/login'));
        }
    }

    public function kirimpesan()
    {

        $this->session->set_flashdata('location', "Pesan");
        $nisn = $this->uri->segment(3);

        if ($this->Model_user->get_alumni_by_nisn($nisn)->num_rows() == 0) {

            redirect(base_url('main/pesan'));
        }

        if (isset($_SESSION['nisn_session'])) {

            $this->Model_user->pesandibaca($nisn);

            $data = array(
                'data_penerima' => $this->Model_user->get_alumni_by_nisn($nisn)->result(),
                'last_login' => $this->Model_user->lastlogin($nisn),
                'list_pesan' => $this->Model_user->listpesan($nisn)->result(),
                'data_profil' => $this->Model_user->getDataAlumni($_SESSION['nisn_session'])->result(),
                'list_nisn_pengirim' => $this->Model_user->get_nama_nisn_pengirimpesan(),
                'list_nisn_tujuan' => $this->Model_user->get_nama_nisn_tujuanpesan()
            );

            $content = array(
                'content' => $this->load->view('user/alumni_pesan/load_pesan.php', $data, TRUE)
            );

            $this->load->view('user/alumni_pesan/list_percakapan.php', $data, TRUE);
            $this->load->view('user/alumni_pesan/alumni_pesan.php', $content, $data, FALSE);
        } else {

            redirect(base_url('main/login'));
        }
    }

    public function kirim_pesan_action()
    {

        if (!empty($_FILES['myFile']['name'])) {

            $config = array(
                'upload_path' => 'assets/user/pesan/',
                'allowed_types' => 'png|jpg|jpeg|rar|zip|pdf|pptx|docx|xlsx|xls|doc|txt|PNG'
            );

            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if ($this->upload->do_upload('myFile')) {

                $data = array(
                    'lampiran_file' => $this->upload->data('file_name'),
                    'nisn_tujuan' => $this->input->post('nisn_tujuan'),
                    'nisn_pengirim' => $_SESSION['nisn_session'],
                    'isi_pesan' => $this->input->post('isi_pesan'),
                    'terbaca_tujuan' => 'N',
                    'terbaca_pengirim' => 'Y',
                    'tanggal' => date('Y-m-d H:i:s')
                );

                $this->Model_user->tambahpesan($data);
            } else {

                echo "Ekstensi file salah";
            }
        } else {

            $data = array(
                'nisn_tujuan' => $this->input->post('nisn_tujuan'),
                'nisn_pengirim' => $_SESSION['nisn_session'],
                'isi_pesan' => $this->input->post('isi_pesan'),
                'terbaca_tujuan' => 'N',
                'terbaca_pengirim' => 'Y',
                'lampiran_file' => 'kosong',
                'tanggal' => date('Y-m-d H:i:s')
            );

            $this->Model_user->tambahpesan($data);
        }

        $pesan = array(
            'list_pesan' => $this->Model_user->listpesan($this->input->post('nisn_tujuan'))->result(),
            'data_profil' => $this->Model_user->getDataAlumni($_SESSION['nisn_session'])->result(),
            'data_penerima' => $this->Model_user->get_alumni_by_nisn($this->input->post('nisn_tujuan'))->result()
        );

        echo json_encode($pesan);
    }

    public function downloadfile()
    {
        ob_start();
        $nama_file = $_GET['data'];
        $file = base_url('assets/user/pesan/' . $nama_file);
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file) . "\"");
        readfile($file);
        exit;
        ob_flush();
    }

    //Topik

    public function buattopik()
    {

        $this->session->set_flashdata('location', "Buat Topik");

        if (isset($_SESSION['nisn_session'])) {

            $data = array(
                'list_kategori' => $this->Model_user->getlistkategoritopik()->result(),
                'jumlahtopik_angkatan' => $this->Model_user->jumlahtopik_angkatan()->result(),
                'list_topikpopuler' => $this->Model_user->topikpopulerlimit6()->result()
            );

            $content = array(
                'content' => $this->load->view('user/forum/buat_topik.php', $data, TRUE)
            );

            $this->load->view('user/forum/info_topik.php', $data, TRUE);
            $this->load->view('user/forum/forum.php', $content, FALSE);
        } else {

            redirect(base_url('main/login'));
        }
    }

    public function buattopik_action()
    {

        if (!empty($_FILES['myFile']['name'])) {

            $config = array(
                'upload_path' => 'assets/user/topik/',
                'allowed_types' => 'png|jpg|jpeg|rar|zip|pdf|pptx|docx|xlsx|xls|doc|txt|PNG'
            );

            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if ($this->upload->do_upload('myFile')) {

                $data = array(

                    'nisn' => $_SESSION['nisn_session'],
                    'id_kategoritopik' => $this->input->post('kategori_topik'),
                    'hak_akses' => $this->input->post('hak_akses'),
                    'judul_topik' => $this->input->post('judul_topik'),
                    'total_dilihat' => 0,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'lampiran_file' => $this->upload->data('file_name'),
                    'status_topik' => 'Y',
                    'isi_topik' => $this->input->post('isi_topik')

                );

                $this->Model_user->inserttopik($data);
            } else {
            }
        } else {

            $data = array(

                'nisn' => $_SESSION['nisn_session'],
                'id_kategoritopik' => $this->input->post('kategori_topik'),
                'hak_akses' => $this->input->post('hak_akses'),
                'judul_topik' => $this->input->post('judul_topik'),
                'total_dilihat' => 0,
                'tanggal' => date('Y-m-d H:i:s'),
                'lampiran_file' => 'kosong',
                'status_topik' => 'Y',
                'isi_topik' => $this->input->post('isi_topik')

            );

            $this->Model_user->inserttopik($data);
        }

        echo json_encode("Topik Berhasil diposting");
    }

    public function alumnilisttopik()
    {

        $this->session->set_flashdata('location', "Topik Anda");

        $data = array(
            'total_published' => $this->Model_user->getlisttopikbyalumni_published()->num_rows(),
            'total_unpublished' => $this->Model_user->getlisttopikbyalumni_unpublished()->num_rows(),
            'list_topik' => $this->Model_user->getlisttopikbyalumni()->result()
        );

        $content = array(
            'content' => $this->load->view('user/forum/alumni_topik.php', $data, TRUE)
        );

        $this->load->view('user/forum/forum.php', $content, FALSE);
    }

    public function alumniedittopik()
    {

        $id_topik = $this->uri->segment(3);
        $this->session->set_flashdata('location', "Edit Topik");

        if (isset($_SESSION['nisn_session']) || $this->Model_user->cektopik_byid_nisn($id_topik)->num_rows() != 0) {

            $data = array(
                'data' => $this->Model_user->cektopik_byid_nisn($id_topik)->result(),
                'list_kategori' => $this->Model_user->getlisttopikbyalumni()->result()

            );
            $content = array(
                'content' => $this->load->view('user/forum/edittopik.php', $data, TRUE)
            );

            $this->load->view('user/forum/forum.php', $content, FALSE);
        } else {

            redirect(base_url('main/alumnilisttopik'));
        }
    }

    public function downloadfiletopik()
    {
        ob_start();
        $nama_file = $_GET['data'];
        $file = base_url('assets/user/topik/' . $nama_file);

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file) . "\"");
        readfile($file);
        exit;
        ob_flush();
    }

    public function alumniedittopik_action()
    {

        $idtopik = $this->input->post('id_topik');

        if (!empty($_FILES['myFile']['name'])) {

            $config = array(
                'upload_path' => 'assets/user/topik/',
                'allowed_types' => 'png|jpg|jpeg|rar|zip|pdf|pptx|docx|xlsx|xls|doc|txt|PNG'
            );

            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if ($this->upload->do_upload('myFile')) {

                $data = array(
                    'lampiran_file' => $this->upload->data('file_name')
                );

                if ($this->Model_user->getNamaFileTopikOld($idtopik) != "kosong") {

                    @unlink('assets/user/topik/' . $this->Model_user->getNamaFileTopikOld($idtopik));
                }

                $this->Model_user->edittopik($idtopik, $data);
            }
        }

        $data = array(
            'id_kategoritopik' => $this->input->post('kategori_topik'),
            'judul_topik' => $this->input->post('judul_topik'),
            'hak_akses' => $this->input->post('hak_akses'),
            'isi_topik' => $this->input->post('isi_topik'),
            'status_topik' => $this->input->post('status_topik')
        );

        $this->Model_user->edittopik($idtopik, $data);
        echo json_encode("Data berhasil diperbaruhi");
    }

    public function hapustopik($idtopik)
    {

        if ($this->Model_user->getNamaFileTopikOld($idtopik) != "kosong") {

            @unlink('assets/user/topik/' . $this->Model_user->getNamaFileTopikOld($idtopik));
        }

        $this->Model_user->hapustopik($idtopik);
        redirect(base_url('main/alumnilisttopik'));
    }

    //diskusi

    public function diskusi()
    {

        $this->session->set_flashdata('location', "Diskusi");

        $data = array(
            'jumlahtopik_angkatan' => $this->Model_user->jumlahtopik_angkatan()->result(),
            'list_topikpopuler' => $this->Model_user->topikpopulerlimit6()->result()
        );
        $content = array(
            'content' => $this->load->view('user/forum/diskusi.php', $data, TRUE)
        );
        $this->load->view('user/forum/info_topik.php', $data, TRUE);
        $this->load->view('user/forum/forum.php', $content, FALSE);
    }

    public function listtopik($rowno = 0)
    {
        $rowpage = 10;

        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowpage;
        }

        $allcount = $this->Model_user->countlisttopik();
        $list = $this->Model_user->listtopik($rowpage, $rowno);

        $config['base_url'] = base_url() . 'main/listtopik';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowpage;

        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end mt-5">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $list;
        $data['row'] = $rowno;

        echo json_encode($data);
    }

    public function bacatopik()
    {

        $id_topik = $this->uri->segment(3);

        if (!empty($id_topik) && isset($_SESSION['nisn_session'])) {

            $this->Model_user->countertopik($id_topik);

            $data = array(
                'jumlahtopik_angkatan' => $this->Model_user->jumlahtopik_angkatan()->result(),
                'list_topikpopuler' => $this->Model_user->topikpopulerlimit6()->result(),
                'isitopik' => $this->Model_user->isitopik($id_topik)->result(),
                'tahunlulus_saya' => $this->Model_user->gettahunlulusbynisn(),
                'totalkomentar' => $this->Model_user->totalkomentar($id_topik)->num_rows(),
                'diskusi' => $this->Model_user->getdiskusi($id_topik)->result()
            );
            $content = array(
                'content' => $this->load->view('user/forum/detail_diskusi.php', $data, TRUE)
            );

            $this->load->view('user/forum/info_topik.php', $data, TRUE);
            $this->load->view('user/forum/forum.php', $content, FALSE);
        } else {

            redirect(base_url('main/diskusi'));
        }
    }

    public function tambahdiskusi()
    {

        $id_topik = $this->input->post('id_topik');

        if (!empty($_FILES['myFile']['name'])) {

            $config = array(
                'upload_path' => 'assets/user/topik/',
                'allowed_types' => 'png|jpg|jpeg|rar|zip|pdf|pptx|docx|xlsx|xls|doc|txt|PNG'
            );

            $this->load->library('upload', $config);
            $this->load->initialize($config);

            if ($this->upload->do_upload('myFile')) {

                $data = array(
                    'nisn' => $_SESSION['nisn_session'],
                    'id_topik' => $id_topik,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'lampiran_file' => $this->upload->data('file_name'),
                    'isi_diskusi' => $this->input->post('isi_diskusi')
                );
            }
        } else {

            $data = array(
                'nisn' => $_SESSION['nisn_session'],
                'id_topik' => $id_topik,
                'tanggal' => date('Y-m-d H:i:s'),
                'lampiran_file' => "kosong",
                'isi_diskusi' => $this->input->post('isi_diskusi')
            );
        }

        $this->Model_user->tambahdiskusi($data);

        $data = array(
            'totalkomentar' => $this->Model_user->totalkomentar($id_topik)->num_rows(),
            'diskusi' => $this->Model_user->getdiskusi($id_topik)->result()
        );

        echo json_encode($data);
    }

    //list berita view

    public function beritaalumni()
    {

        $this->session->set_flashdata('location', "Berita Alumni");

        $data = array(
            'kategori_berita' => $this->Model_user->userlistkategoriberita()->result(),
            'beritapopuler' => $this->Model_user->userberitapopuler()->result(),
            'total_berita_admin' => $this->Model_user->getberitadmin()->num_rows()
        );
        $content = array(
            'content' => $this->load->view('user/berita/listberita.php', $data, TRUE)
        );

        $this->load->view('user/berita/infoberita.php', $data, TRUE);
        $this->load->view('user/berita/berita.php', $content, FALSE);
    }

    public function listberitaalumni($rowno = 0)
    {
        $rowpage = 9;

        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowpage;
        }

        $allcount = $this->Model_user->usercountallberita();
        $list = $this->Model_user->userlistberita($rowpage, $rowno);

        $config['base_url'] = base_url() . 'main/listberitaalumni';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowpage;

        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end mt-5">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $list;
        $data['row'] = $rowno;

        echo json_encode($data);
    }

    public function bacaberita()
    {

        $id_berita = $this->uri->segment(3);

        if (!empty($this->uri->segment(3)) && $this->Model_user->getBeritabyid($id_berita)->num_rows() != 0) {

            $this->Model_user->counterberita($id_berita);

            $data = array(
                'kontenberita' => $this->Model_user->getBeritabyid($id_berita)->result(),
                'kategori_berita' => $this->Model_user->userlistkategoriberita()->result(),
                'beritapopuler' => $this->Model_user->userberitapopuler()->result(),
                'total_berita_admin' => $this->Model_user->getberitadmin()->num_rows(),

            );

            $content = array(
                'content' => $this->load->view('user/berita/bacaberita.php', $data, TRUE)
            );

            $this->load->view('user/berita/infobacaberita.php', $data, TRUE);
            $this->load->view('user/berita/berita.php', $content, FALSE);
        } else {

            redirect(base_url('main/beritaalumni'));
        }
    }

    public function beritakategori()
    {
        $idkategori = $this->uri->segment(3);

        $allcount = $this->Model_user->usercountberitabykategori($idkategori);
        $config['base_url'] = base_url() . 'main/beritakategori/' . $idkategori . '/';
        $config['total_rows'] = $allcount;
        $config['per_page'] = 9;
        $config['uri_segment'] = 4;

        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span>Next</li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data = array(
            'listberita' => $this->Model_user->userlistberitabykategori($config['per_page'], $data['page'], $idkategori),
            'kategori_berita' => $this->Model_user->userlistkategoriberita()->result(),
            'beritapopuler' => $this->Model_user->userberitapopuler()->result(),
            'namakategori' => $this->Model_user->getnamakategoriberita($idkategori),
            'total_berita_admin' => $this->Model_user->getberitadmin()->num_rows()
        );

        $content = array(
            'content' => $this->load->view('user/berita/listberitapage.php', $data, TRUE)
        );

        $this->load->view('user/berita/infoberita.php', $data, TRUE);
        $this->load->view('user/berita/berita.php', $content, FALSE);
    }

    public function beritacari()
    {

        if (isset($_GET['search']) || !empty($this->uri->segment(3))) {

            if (isset($_GET['search'])) {

                $search = $this->input->get('search');
            } else {

                $search = $this->uri->segment(3);
            }

            $allcount = $this->Model_user->usercountberitabysearch($search);
            $config['base_url'] = base_url() . 'main/beritacari/' . $search . '/';
            $config['total_rows'] = $allcount;
            $config['per_page'] = 9;
            $config['uri_segment'] = 4;

            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Prev';
            $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end">';
            $config['full_tag_close'] = '</ul></nav></div>';
            $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] = '</span></li>';
            $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close'] = '</span>Next</li>';
            $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close'] = '</span></li>';

            $this->pagination->initialize($config);
            $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data = array(
                'listberita' => $this->Model_user->userlistberitabysearch($config['per_page'], $data['page'], $search),
                'kategori_berita' => $this->Model_user->userlistkategoriberita()->result(),
                'beritapopuler' => $this->Model_user->userberitapopuler()->result(),
                'total_berita_admin' => $this->Model_user->getberitadmin()->num_rows()
            );

            $content = array(
                'content' => $this->load->view('user/berita/listberitasearch.php', $data, TRUE)
            );

            $this->load->view('user/berita/infoberita.php', $data, TRUE);
            $this->load->view('user/berita/berita.php', $content, FALSE);
        } else {

            redirect(base_url('main/beritaalumni'));
        }
    }

    public function beritaadmin()
    {
        $this->session->set_flashdata('location', "Berita Alumni");

        $data = array(
            'kategori_berita' => $this->Model_user->userlistkategoriberita()->result(),
            'beritapopuler' => $this->Model_user->userberitapopuler()->result(),
            'total_berita_admin' => $this->Model_user->getberitadmin()->num_rows()
        );

        $content = array(
            'content' => $this->load->view('user/berita_admin/listberita.php', $data, TRUE)
        );

        $this->load->view('user/berita/infoberita.php', $data, TRUE);
        $this->load->view('user/berita_admin/beritaadmin.php', $content, FALSE);
    }

    public function listberitadmin($rowno = 0)
    {
        $rowpage = 9;

        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowpage;
        }

        $allcount = $this->Model_user->usercountallberitaadmin();
        $list = $this->Model_user->userlistberitaadmin($rowpage, $rowno);

        $config['base_url'] = base_url() . 'main/listberitaadmin';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowpage;

        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end mt-5">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $list;
        $data['row'] = $rowno;

        echo json_encode($data);
    }

    public function beritadmin()
    {
        $this->session->set_flashdata('location', "Berita Alumni");

        $id_berita = $this->uri->segment(3);

        if (!empty($this->uri->segment(3)) && $this->Model_user->getberitadminbyid($id_berita)->num_rows() != 0) {

            $this->Model_user->counterberitadmin($id_berita);

            $data = array(
                'kontenberita' => $this->Model_user->getberitadminbyid($id_berita)->result(),
                'kategori_berita' => $this->Model_user->userlistkategoriberita()->result(),
                'beritapopuler' => $this->Model_user->userberitapopuler()->result(),
                'total_berita_admin' => $this->Model_user->getberitadmin()->num_rows(),

            );

            $content = array(
                'content' => $this->load->view('user/berita_admin/kontenberita.php', $data, TRUE)
            );

            $this->load->view('user/berita/infobacaberita.php', $data, TRUE);
            $this->load->view('user/berita_admin/beritaadmin.php', $content, FALSE);
        } else {

            redirect(base_url('main/beritaadmin'));
        }
    }

    //donasi_method
    public function donasi()
    {
        $this->session->set_flashdata('location', "Donasi");

        $data = array(
            'kategori_donasi' => $this->Model_donasi->getKategoridonasi()->result(),
            'danaterbesar' => $this->Model_donasi->danaterbesar()->result()
        );

        $content = array(
            'content' => $this->load->view('user/donasi/listdonasi.php', $data, TRUE)
        );

        $this->load->view('user/donasi/samping.php', $data, TRUE);
        $this->load->view('user/donasi/donasi.php', $content, FALSE);
    }

    public function listdonasi($rowno = 0)
    {
        $rowpage = 9;

        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowpage;
        }

        $allcount = $this->Model_donasi->usercountalldonasiadmin();
        $list = $this->Model_donasi->listdonasi($rowpage, $rowno);

        $config['base_url'] = base_url() . 'main/listdonasi';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowpage;

        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end mt-5">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $list;
        $data['row'] = $rowno;

        echo json_encode($data);
    }

    public function kategoridonasi()
    {
        $this->session->set_flashdata('location', "Donasi");

        if (empty($this->uri->segment(3))) {

            redirect(base_url('main/donasi'));
        }

        $idkategori = $this->uri->segment(3);

        $allcount = $this->Model_donasi->usercountalldonasikategori($idkategori);

        $config['base_url'] = base_url() . 'main/kategoridonasi/' . $idkategori . '/';
        $config['total_rows'] = $allcount;
        $config['per_page'] = 9;
        $config['uri_segment'] = 4;

        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end mt-5">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data = array(
            'listdonasi' => $this->Model_donasi->listdonasikategori($config['per_page'], $data['page'], $idkategori),
            'kategori_donasi' => $this->Model_donasi->getKategoridonasi()->result(),
            'danaterbesar' => $this->Model_donasi->danaterbesar()->result(),
            'kategori' => $this->Model_donasi->getNamaKategori($this->uri->segment(3))
        );

        $content = array(
            'content' => $this->load->view('user/donasi/listdonasikategori.php', $data, TRUE)
        );

        $this->load->view('user/donasi/samping.php', $data, TRUE);
        $this->load->view('user/donasi/donasi.php', $content, FALSE);
    }

    public function detaildonasi()
    {

        $this->session->set_flashdata('location', "Donasi");
        $id = $this->uri->segment(3);

        if (empty($id)) {

            redirect(base_url('main/donasi'));
        } else {

            $this->Model_donasi->counterdonasi($id);

            $data = array(
                'kategori_donasi' => $this->Model_donasi->getKategoridonasi()->result(),
                'danaterbesar' => $this->Model_donasi->danaterbesar()->result(),
                'data' => $this->Model_donasi->getDonasiByid($id)->result(),
                'total_donatur' => $this->Model_donasi->totalDonatur($id),
                'danaterkumpul' => $this->Model_donasi->totalDanaTerkumpul($id),
                'donatur' => $this->Model_donasi->viewdoadonatur_total($id)->result(),
                'perbandingan' => $this->Model_donasi->viewperbandingandonasi($id)->result()
            );

            $content = array(
                'content' => $this->load->view('user/donasi/detaildonasi.php', $data, TRUE)
            );

            $this->load->view('user/donasi/samping.php', $data, TRUE);
            $this->load->view('user/donasi/donasi_detail.php', $content, FALSE);
        }
    }

    public function bayardonasi()
    {

        $this->session->set_flashdata('location', "Donasi");
        $id = $this->uri->segment(3);

        if (empty($id) || empty($_SESSION['nisn_session'])) {

            redirect(base_url('main/donasi'));
        } else {

            $this->Model_donasi->counterdonasi($id);

            $data = array(
                'kategori_donasi' => $this->Model_donasi->getKategoridonasi()->result(),
                'danaterbesar' => $this->Model_donasi->danaterbesar()->result(),
                'tipepembayaran' => $this->Model_donasi->getTipePembayaran()->result(),
                'tahun_lulus' => $this->Model_user->gettahunlulusbynisn(),
                'data' => $this->Model_donasi->getDonasiByid($id)->result(),
            );

            $content = array(
                'content' => $this->load->view('user/donasi/formdonasi.php', $data, TRUE)
            );

            $this->load->view('user/donasi/samping.php', $data, TRUE);
            $this->load->view('user/donasi/donasi.php', $content, FALSE);
        }
    }

    public function bayardonasi_action()
    {
        $config = array(
            'upload_path' => 'assets/donasi/file/',
            'allowed_types' => 'png|jpg|jpeg|rar|zip|pdf|pptx|docx|xlsx|xls|doc|txt|PNG'
        );

        $this->load->library('upload', $config);
        $this->load->initialize($config);

        if ($this->upload->do_upload('bukti_transfer')) {

            if (empty($this->input->post('doa_donatur'))) {

                $doa = "kosong";
            } else {

                $doa = $this->input->post('doa_donatur');
            }

            $data = array(
                'id_donasi' => $this->input->post('id_donasi'),
                'nisn' => $_SESSION['nisn_session'],
                'tanggal_bayar' => date('Y-m-d H:i:s'),
                'bukti_transfer' => $this->upload->data('file_name'),
                'doa_donatur' => $doa,
                'total_donasi' => str_replace(',', '', $this->input->post('total_donasi')),
                'status_pembayaran' => 'N',
                'id_tipepembayaran' => $this->input->post('id_tipepembayaran')
            );

            $this->Model_donasi->tambahdonasi($data);

            echo json_encode('Anda Berhasil Melakukan Donasi, Silahkan Cek Riwayat Donasi anda di Menu Kontribusi Donasi');
        } else {

            echo json_encode('Ekstensi File Salah');
        }
    }

    public function doadonatur($rowno = 0)
    {
        $rowpage = 10;

        $id = $this->input->get('id');

        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowpage;
        }

        $allcount = $this->Model_donasi->viewdoadonatur_total($id)->num_rows();
        $list = $this->Model_donasi->viewdoadonatur($rowpage, $rowno, $id);

        $config['base_url'] = base_url() . 'main/doadonatur/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowpage;

        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end mt-5">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $list;
        $data['row'] = $rowno;

        echo json_encode($data);
    }

    //alumni donasi
    public function alumnidonasi()
    {

        if (isset($_SESSION['nisn_session'])) {

            if (isset($_GET['data'])) {

                if ($_GET['data'] == "success") {

                    $data = $this->Model_donasi->getDonasiByNisnSuccess()->result();
                } else if ($_GET['data'] == "process") {

                    $data = $this->Model_donasi->getDonasiByNisnProcess()->result();
                } else if ($_GET['data'] == "gagal") {

                    $data = $this->Model_donasi->getDonasiByNisnGagal()->result();
                } else {

                    $data = $this->Model_donasi->getDonasiByNisn()->result();
                }
            } else {

                $data = $this->Model_donasi->getDonasiByNisn()->result();
            }

            $data = array(
                'data' => $data,
                'all' => $this->Model_donasi->getDonasiByNisn()->num_rows(),
                'process' => $this->Model_donasi->getDonasiByNisnProcess()->num_rows(),
                'gagal' => $this->Model_donasi->getDonasiByNisnGagal()->num_rows(),
                'success' => $this->Model_donasi->getDonasiByNisnSuccess()->num_rows()
            );

            $content = array(

                'content' => $this->load->view('user/alumni_donasi/listdonasi.php', $data, TRUE)

            );

            $this->load->view('user/alumni_donasi/alumni_donasi.php', $content, FALSE);
        } else {

            redirect(base_url('main/login'));
        }
    }

    public function alumnidetaildonasi()
    {

        $id = $this->uri->segment(3);

        if (isset($_SESSION['nisn_session']) && !empty($id)) {

            $data = array(
                'data' => $this->Model_donasi->getdetailDonasi($id)->result(),
                'tipepembayaran' => $this->Model_donasi->getTipePembayaran()->result(),
            );

            $content = array(
                'content' => $this->load->view('user/alumni_donasi/detail_donasi.php', $data, TRUE)
            );

            $this->load->view('user/alumni_donasi/alumni_donasi.php', $content, FALSE);
        } else {

            redirect(base_url('main/login'));
        }
    }

    public function download_buktitransfer()
    {

        ob_start();
        $nama_file = $_GET['data'];
        $file = base_url('assets/donasi/file/' . $nama_file);
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file) . "\"");
        readfile($file);
        exit;
        ob_flush();
    }

    public function savesubscribe()
    {
        $data = array(
            'email' => $this->input->post('email')
        );
        $this->Model_user->tambahsubscribe($data);
        echo json_encode('Email ' . $data['email'] . ' Akan Selalu Mendapat Notifikasi Berita');
    }

    public function getGaleri($rowno = 0)
    {
        $rowpage = 9;

        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowpage;
        }

        $allcount = $this->Model_Dashboard->TotGaleri();
        $list = $this->Model_Dashboard->getGaleri($rowpage, $rowno);

        $config['base_url'] = base_url() . 'main/getGaleri/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowpage;

        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end mt-5">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $list;
        $data['row'] = $rowno;

        echo json_encode($data);
    }

    //baru
    public function getDataGaleri()
    {

        $id = $this->input->post('id_galeri');

        $data = array(
            'data' => $this->Model_Dashboard->getDetailGaleri($id)->result(),
            'nama' => $this->Model_Dashboard->getGaleriKegiatanById($id)
        );

        $this->load->view('user/dashboard/modal_galeri.php', $data, FALSE);
    }

    //04 - 06 - 2021

    public function galeri()
    {

        $this->session->set_flashdata('location', "Galeri");
        $id = $this->uri->segment(3);

        if (empty($id)) {

            redirect(base_url('main'));
        } else {

            $data = array(
                'judul_kegiatan' => $this->Model_Dashboard->getGaleriKegiatanById($id),
                'data' => $this->Model_Dashboard->getDetailGaleri($id)->result()
            );

            $content = array(
                'content' => $this->load->view('user/galeri/data.php', $data, TRUE)
            );

            $this->load->view('user/galeri/galeri.php', $content, FALSE);
        }
    }

    //tambahan riwayat pekerjaan dan pendidikan

    public function hapusRiwayatPekerjaanByid()
    {
        $this->Model_Alumni->hapusRiwayatPekerjaanByid($_POST['id']);
    }

    public function hapusRiwayatPendidikanByid()
    {
        $this->Model_Alumni->hapusRiwayatPendidikanByid($_POST['id']);
    }
}
