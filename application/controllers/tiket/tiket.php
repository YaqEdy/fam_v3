<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class tiket extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
            $this->load->model('global_m');
            $this->load->model('tiket/tiket_m');
//            $this->load->model('procurement/ias_mdl');
//            $this->load->model('procurement/cek_barang_mdl');
            $this->load->model('datatables_custom');
            $this->load->model('procurement/ias_mdl');
        }
    }

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

            $this->template->set('title', 'Home');
            $this->template->load('template/template1', 'global/index', $data);
        }
    }

    function home() {
        // die('asd');
        $menuId = $this->home_m->get_menu_id('tiket/tiket/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET, BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_vendor'] = $this->global_m->tampil_data("SELECT Raw_ID, VendorName FROM Mst_Vendor");
        $this->template->set('title', 'Tiket');
        $this->template->load('template/template_dataTable', 'tiket/tiket_v', $data);
    }

      function prtiket() {
        // die('asd');
        $menuId = $this->home_m->get_menu_id('tiket/tiket/prtiket');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET, BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_vendor'] = $this->global_m->tampil_data("SELECT Raw_ID, VendorName FROM Mst_Vendor");
        $this->template->set('title', 'PR Tiket');
        $this->template->load('template/template_dataTable', 'tiket/pr_tiket_v', $data);
    }

    function traveltiket() {
        // die('asd');
        $menuId = $this->home_m->get_menu_id('tiket/tiket/traveltiket');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET, BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_vendor'] = $this->global_m->tampil_data("SELECT Raw_ID, VendorName FROM Mst_Vendor");
        $this->template->set('title', 'Pilih Travel');
        $this->template->load('template/template_dataTable', 'tiket/travel_tiket_v', $data);
    }

       function uptiket() {
        // die('asd');
        $menuId = $this->home_m->get_menu_id('tiket/tiket/uptiket');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET, BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_vendor'] = $this->global_m->tampil_data("SELECT Raw_ID, VendorName FROM Mst_Vendor");
        $this->template->set('title', 'UPLOAD TIKET');
        $this->template->load('template/template_dataTable', 'tiket/up_tiket_v', $data);
    }

        function addtermin() {
        // die('asd');
        $menuId = $this->home_m->get_menu_id('tiket/tiket/addtermin');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET, BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_vendor'] = $this->global_m->tampil_data("SELECT Raw_ID, VendorName FROM Mst_Vendor");
        $this->template->set('title', 'UPLOAD TIKET');
        $this->template->load('template/template_dataTable', 'tiket/add_termin_v', $data);
    }

        function invoice() {
        // die('asd');
        $menuId = $this->home_m->get_menu_id('tiket/tiket/invoice');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET, BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_vendor'] = $this->global_m->tampil_data("SELECT Raw_ID, VendorName FROM Mst_Vendor");
        $this->template->set('title', 'invoice');
        $this->template->load('template/template_dataTable', 'tiket/invoice_v', $data);
    }

        function payment() {
        // die('asd');
        $menuId = $this->home_m->get_menu_id('tiket/tiket/payment');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET, BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_vendor'] = $this->global_m->tampil_data("SELECT Raw_ID, VendorName FROM Mst_Vendor");
        $this->template->set('title', 'Payment');
        $this->template->load('template/template_dataTable', 'tiket/payment_v', $data);
    }

    function simpan_spd() {
        // die('asd');
        $ID_TIKET = $this->global_m->getIdMax('ID_TIKET', 'TBL_T_TIKET');
        $this->load->library('upload');
        $config['upload_path'] = './uploads/tiket/'; //path folder
        $config['max_size'] = '0'; //maksimum besar file 5M
        $config['allowed_types'] = '*'; //type yang dapat diakses bisa anda sesuaikan
        $atflag = 'T';
        $atwaktuupdate = date("Y/m/d H:i:s");

        $files = $_FILES;
        $nilai = 0;

        for ($i = 0; $i < count($_FILES['Image']['name']); $i++) {
            $namafile = $files['Image']['name'][$i];
            $ext = pathinfo($namafile, PATHINFO_EXTENSION);
            $namafileasli = explode(".", strrev($namafile));
            $nama_file_baru = $this->global_m->generateRandomString();
            $nama_file_baru2 = $nama_file_baru . "." . $ext;
            $namafile = $nama_file_baru2;
            $_FILES['userfile']['name'] = $nama_file_baru2;
            $_FILES['userfile']['type'] = $files['Image']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['Image']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['Image']['error'][$i];
            $_FILES['userfile']['size'] = $files['Image']['size'][$i];

            $this->upload->initialize($config);
            if ($this->upload->do_upload('userfile')) {
                $data = $this->upload->data();
                $Image = $data['file_name'];

                $data = array(
                    // 'ID_TIKET' => $ID_TIKET,
                    'SPD_PATH' => 'uploads/tiket/' . $Image,
                    'UPDATE_DATE' => date("Y/m/d H:i:s"),
                    'UPDATE_BY' => $this->session->userdata('user_id')
                );
                // print_r($data); die();
                $table = 'TBL_T_TIKET';
                $id_kolom = 'ID_TIKET';
                // $id_data = $tik_explode[$i];
                $model = $this->global_m->ubah($table, $data, $id_kolom);
                // $model = $this->global_m->ubah('TBL_T_TIKET', $data);


                if ($model) {
                    $array = array(
                        'act' => 1,
                        'tipePesan' => 'success',
                        'pesan' => 'File has been saved.'
                    );
                } else {
                    $array = array(
                        'act' => 0,
                        'tipePesan' => 'error',
                        'pesan' => 'Data gagal disimpan.'
                    );
                }
                $this->output->set_output(json_encode($array));
            }
        }
    }

    function simpan($icount) {
        // die('asd');

        $NO_SPD = trim($this->input->post('NO_SPD'));
        $SPD = trim($this->input->post('SPD'));
        $tanggal_pr = trim($this->input->post('tanggal_pr'));
        $asal_berangkat = trim($this->input->post('asal_berangkat'));
        $tujuan_berangkat = trim($this->input->post('tujuan_berangkat'));
        $tanggal_berangkat = trim($this->input->post('tanggal_berangkat'));
        $asal_pulang = trim($this->input->post('asal_pulang'));
        $tujuan_pulang = trim($this->input->post('tujuan_pulang'));
        $tanggal_pulang = trim($this->input->post('tanggal_pulang'));
        $atasnama = trim($this->input->post('atasnama'));
        $GENDER = trim($this->input->post('GENDER'));
        $akomodasi = trim($this->input->post('akomodasi'));
        $ID_TIKET = $this->global_m->getIdMax('ID_TIKET', 'TBL_T_TIKET');
        $note = trim($this->input->post('note'));
        //  echo "<pre>";
        // print_r($_POST);die();        
        $this->load->library('upload');
        $config['upload_path'] = './uploads/tiket/'; //path folder
        $config['max_size'] = '0'; //maksimum besar file 5M
        $config['allowed_types'] = '*'; //type yang dapat diakses bisa anda sesuaikan
        $atflag = 'T';
        $atwaktuupdate = date("Y/m/d H:i:s");

        $files = $_FILES;
        $nilai = 0;

        for ($i = 0; $i < count($_FILES['Image']['name']); $i++) {
            $namafile = $files['Image']['name'][$i];
            $ext = pathinfo($namafile, PATHINFO_EXTENSION);
            $namafileasli = explode(".", strrev($namafile));
            $nama_file_baru = $this->global_m->generateRandomString();
            $nama_file_baru2 = $nama_file_baru . "." . $ext;
            $namafile = $nama_file_baru2;
            $_FILES['userfile']['name'] = $nama_file_baru2;
            $_FILES['userfile']['type'] = $files['Image']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['Image']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['Image']['error'][$i];
            $_FILES['userfile']['size'] = $files['Image']['size'][$i];

            $this->upload->initialize($config);
            if ($this->upload->do_upload('userfile')) {
                $data = $this->upload->data();
                $Image = $data['file_name'];
                $tanggal = $tanggalhariini;

                $data = array(
                    'ID_TIKET' => $ID_TIKET,
                    'NO_SPD' => $NO_SPD,
                    'SPD_PATH' => $SPD,
                    'TGL_PR' => $tanggal_pr,
                    'AKOMODASI' => $akomodasi,
                    'note' => $note,
                    'ASAL_BERANGKAT' => $asal_berangkat,
                    'TUJUAN_BERANGKAT' => $tujuan_berangkat,
                    'TGL_BERANGKAT' => $tanggal_berangkat,
                    'ASAL_PULANG' => $asal_pulang,
                    'TUJUAN_PULANG' => $tujuan_pulang,
                    'TGL_PULANG' => $tanggal_pulang,
                    // 'TGL_PULANG' => date('Y-m-d', strtotime($tanggal_pulang)),             
                    'STATUS_TIKET' => 0,
                    'BRANCH' => $this->session->userdata('BranchID'),
                    'DIVISION' => $this->session->userdata('DivisionID'),
                    'SPD_PATH' => 'uploads/tiket/' . $Image,
                    'CREATE_DATE' => date('Y-m-d h:i:s'),
                    'CREATE_BY' => $this->session->userdata('user_id')
                );
                // print_r($data); 
                // die();
                $model = $this->global_m->simpan('TBL_T_TIKET', $data);
            }
        

            for ($i = 1; $i <= $icount; $i++) {
                // print_r($i); die();
                $datax = array(
                    'AN_TIKET' => trim($this->input->post('atasnama' . $i)),
                    'GENDER' => trim($this->input->post('GENDER' . $i)),
                    'DIV' => trim($this->input->post('DIV' . $i)),
                    'NO_HP' => trim($this->input->post('NO_HP' . $i)),
                    'JABATAN' => trim($this->input->post('JABATAN' . $i)),
                    'JNS_IDENTITAS' => trim($this->input->post('jnsidentitas' . $i)),
                    'NO_IDENTITAS' => trim($this->input->post('no_identitas' . $i)),
                    'ID_KRY' => trim($this->input->post('id_kyw' . $i)),
                    'ID_TIKET' => $ID_TIKET,
                    'CREATE_DATE' => date('Y-m-d h:i:s'),
                    'CREATE_BY' => $this->session->userdata('user_id')
                );
                //       echo "<pre>";
                // print_r($datax); 
                $model = $this->global_m->simpan('TBL_T_TIKET_DETAIL', $datax);


                if ($model) {
                    $array = array(
                        'act' => 1,
                        'tipePesan' => 'success',
                        'pesan' => 'File has been saved.'
                    );
                } else {
                    $array = array(
                        'act' => 0,
                        'tipePesan' => 'error',
                        'pesan' => 'Data gagal disimpan.'
                    );
                }
                $this->output->set_output(json_encode($array));
            }
        }
    }

    function hapus_itembarang() { //hapus
        $id_data = trim($this->input->post('data'));
//        print_r($id_data);die();
        $table = "TBL_T_ATK_PR_GROUP_TEMP";
        $id_kolom = "id";


        $model = $this->global_m->deleteUser($table, $id_kolom, $id_data);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dinon-aktifkan.'
            );
        } else {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been removed.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    public function ajax_GridPRTiket() {
        $icolumn = array('ID_TIKET', 'NOTE', 'TGL_PR', 'NO_SPD', 'SPD_PATH', 'AKOMODASI', 'ASAL_BERANGKAT', 'ASAL_PULANG', 'TUJUAN_BERANGKAT', 'TGL_BERANGKAT', 'TGL_PULANG');
        $iwhere = array('STATUS_TIKET' => '0');

        $iorder = array('ID_TIKET' => 'asc');
        $list = $this->datatables_custom->get_datatables('TBL_T_TIKET', $icolumn, $iorder, $iwhere);
        // print_r($list);
        // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            if (strlen(trim($idatatables->SPD_PATH)) > 0) {
                $str1 = 'Tersedia';
            } else {
                $str1 = '<b><i>SPD Belum di unggah</i></b>';
            }

            if($idatatables->ASAL_PULANG == ''){
             $tanggal_pulang = "";
            }else{
            $tanggal_pulang = date('d-m-Y', strtotime($idatatables->TGL_PULANG));
            }
            // $no++;
            $row = array();
            // $row[] = $no; 
            // $row[] = $idatatables->ID_TIKET_DETAIL;
            $row[] = $idatatables->ID_TIKET;
            $row[] = $idatatables->ID_TIKET;
            $row[] = $idatatables->ID_TIKET;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_PR));
            $row[] = $idatatables->NO_SPD;
            $row[] = $str1;
            $row[] = $idatatables->AKOMODASI;
            $row[] = $idatatables->NOTE;
            $row[] = $idatatables->ASAL_BERANGKAT;
            $row[] = $idatatables->TUJUAN_BERANGKAT;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_BERANGKAT));
            $row[] = $tanggal_pulang;
            $row[] = '<button class="btn btn blue" href="#"  onclick="pilihtravel()" data-toggle="modal"  data-target="#myModalpilihtravel">Detail PR</button>';
            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

        public function ajax_GridHistoryPRTiket() {
        $icolumn = array('ID_TIKET', 'AN_TIKET', 'DIV', 'JABATAN', 'NOTE', 'TGL_PR', 'NO_SPD', 'SPD_PATH', 'AKOMODASI', 'ASAL_BERANGKAT', 'ASAL_PULANG', 'TUJUAN_BERANGKAT', 'TGL_BERANGKAT', 'TGL_PULANG');
        $iwhere = array('');

        $iorder = array('ID_TIKET' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_TIKET', $icolumn, $iorder, $iwhere);
        // print_r($list);
        // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            if (strlen(trim($idatatables->SPD_PATH)) > 0) {
                $str1 = 'Tersedia';
            } else {
                $str1 = '<b><i>SPD Belum di unggah</i></b>';
            }

            if($idatatables->ASAL_PULANG == ''){
             $tanggal_pulang = "";
            }else{
            $tanggal_pulang = date('d-m-Y', strtotime($idatatables->TGL_PULANG));
            }
            // $no++;
            $row = array();
            // $row[] = $no; 
            $row[] = $idatatables->ID_TIKET;
            $row[] = $idatatables->NO_SPD;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_PR));
            $row[] = $idatatables->AN_TIKET;
            $row[] = $idatatables->DIV;
            $row[] = $idatatables->JABATAN;
            $row[] = $str1;
            $row[] = $idatatables->AKOMODASI;
            $row[] = $idatatables->NOTE;
            $row[] = $idatatables->ASAL_BERANGKAT;
            $row[] = $idatatables->TUJUAN_BERANGKAT;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_BERANGKAT));
            $row[] = $tanggal_pulang;
            $row[] = '<a href="#" data-toggle="modal" data-target="#ModalHistoryPR" class="btn btn-xs btn-primary">Note</a>';
            $data[] = $row;
            
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function Pilih_tiketPopUp() {
        $id = $this->input->post('sID_TIKET', true);
        $icolumn = array('ID_TIKET_DETAIL', 'AN_TIKET', 'JNS_IDENTITAS', 'NO_IDENTITAS', 'ID_KRY', 'NO_HP', 'DIV', 'GENDER', 'JABATAN', 'STATUS_TIKET', 'ID_TIKET');
        $iwhere = array('STATUS_TIKET IN' => $id);
        $ID_TIKET_DETAIL = explode(',', $this->input->post('sID_TIKET'));
        $iorder = array('ID_TIKET' => 'asc');
        // print_r($_POST); die();
        $list = $this->datatables_custom->get_datatables('TBL_T_TIKET_DETAIL', $icolumn, $iorder, array(), array(), $ID_TIKET_DETAIL, 'ID_TIKET');
//         echo "<pre>";
//             print_r($this->db->last_query());
//             die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $idatatables->ID_TIKET_DETAIL;
            $row[] = $idatatables->AN_TIKET;
            $row[] = $idatatables->GENDER;
            $row[] = $idatatables->NO_HP;            
            $row[] = $idatatables->JNS_IDENTITAS;
            $row[] = $idatatables->NO_IDENTITAS;
            $row[] = $idatatables->DIV;
            $row[] = $idatatables->JABATAN;
            $row[] = $idatatables->ID_KRY;
            $data[] = $row;
        }

        $output = array(
            "STATUS_TIKET" => 1,
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_Grid_Etiket() {
        $icolumn = array('ID_TIKET', 'NOTE', 'ID_TIKET_DETAIL', 'TGL_PR', 'NO_SPD', 'SPD_PATH', 'AKOMODASI', 'AN_TIKET', 'JNS_IDENTITAS', 'NO_IDENTITAS', 'TIKET_PATH', 'ASAL_BERANGKAT', 'TUJUAN_BERANGKAT', 'TGL_KIRIM', 'TRAVEL', 'TGL_BERANGKAT', 'TGL_PULANG', 'STATUS_TIKET', 'KATEGORI');
        $iwhere = array('STATUS_TIKET' => '1');

        $iorder = array('ID_TIKET_DETAIL' => 'desc');
        $list = $this->datatables_custom->get_datatables('VW_TIKET', $icolumn, $iorder, $iwhere);
        // print_r($list);
        // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            if (strlen(trim($idatatables->SPD_PATH)) > 0) {
                $str1 = 'Tersedia';
            } else {
                $str1 = '<b><i>SPD Belum di unggah</i></b>';
            }

            if (strlen(trim($idatatables->TIKET_PATH)) > 0) {
                $str2 = 'Tersedia';
            } else {
                $str2 = '<b><i>E-Tiket belum di unggah</i></b>';
            }

            $no++;
            $row = array();
            $row[] = $idatatables->ID_TIKET;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_PR));
            // $row[] = $idatatables->ID_TIKET;
            $row[] = $idatatables->NO_SPD;
            $row[] = $str1;
            $row[] = $idatatables->AN_TIKET;
            $row[] = $idatatables->JNS_IDENTITAS;
            $row[] = $idatatables->NO_IDENTITAS;
            $row[] = $idatatables->ASAL_BERANGKAT;
            $row[] = $idatatables->TUJUAN_BERANGKAT;
            $row[] = $idatatables->KATEGORI;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_BERANGKAT));
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_PULANG));
            $row[] = $idatatables->AKOMODASI;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_KIRIM));
            $row[] = $idatatables->TRAVEL;
            $row[] = $str2;
            // $row[] = $idatatables->NOTE;            
            $row[] = '<a href="#" data-toggle="modal" onclick="editDataSPD(' . $idatatables->ID_TIKET . ')" data-target="#myModaluploadSPD" class="btn btn-xs btn-primary">SPD</a>';
            $row[] = '<a href="#" data-toggle="modal" onclick="editData(' . $idatatables->ID_TIKET . ')"   data-target="#myModalUploadEtiket" class="btn btn-xs btn-primary">Upload E-Tiket</a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_GridAddPRtoInv() {
        $icolumn = array('ID_TIKET', 'NOTE', 'TGL_PR', 'NO_SPD', 'SPD_PATH', 'AKOMODASI', 'ASAL_BERANGKAT', 'TUJUAN_BERANGKAT', 'TGL_BERANGKAT', 'TGL_PULANG', 'STATUS_');
        $iwhere = array('STATUS_TIKET' => '2');

        $iorder = array('ID_TIKET' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_TIKET_TERMIN', $icolumn, $iorder, $iwhere);
        // print_r($list);
        // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            if (strlen(trim($idatatables->SPD_PATH)) > 0) {
                $str1 = 'Tersedia';
            } else {
                $str1 = '<b><i>SPD Belum di unggah</i></b>';
            }

            if (trim($idatatables->STATUS_) != 'CLOSE') {
                $str2 = '<button class="btn btn blue" href="#" onclick="pilihtermin(' . $idatatables->ID_TIKET . ')"  data-toggle="modal"  data-target="#myModalInvoice">Pilih</button> ';
            } else {
                $str2 = '';
            }

            $no++;
            $row = array();
            // $row[] = $no; 
            $row[] = $idatatables->ID_TIKET;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_PR));
            $row[] = $idatatables->NO_SPD;
            $row[] = $str1;
            $row[] = $idatatables->AKOMODASI;
            $row[] = $idatatables->ASAL_BERANGKAT;
            $row[] = $idatatables->TUJUAN_BERANGKAT;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_BERANGKAT));
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_PULANG));
            $row[] = $idatatables->STATUS_;
            $row[] = $str2;
            // $row[] =  '<button class="btn btn blue" href="#" onclick="pilihtermin('.$idatatables->ID_TIKET.')"  data-toggle="modal"  data-target="#myModalInvoice">Pilih</button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function Pilih_tiketPopUpInvoice() {

        $id = $this->input->post('sID_TIKET', true);
        $icolumn = array('ID_TIKET_DETAIL', 'ID_TIKET', 'ID_KRY', 'STATUS_TIKET', 'AN_TIKET', 'CREATE_DATE', 'JNS_IDENTITAS', 'NO_IDENTITAS');
        $ID_TIKET = explode(',', $this->input->post('sID_TIKET'));
        $iwhere_notin = $this->global_m->tampil_data("SELECT A.ID_TIKET_DETAIL
      FROM TBL_T_TIKET_TERMIN_DETAIL as A RIGHT JOIN TBL_T_TIKET_DETAIL
      AS B ON A.ID_TIKET_DETAIL=B.ID_TIKET_DETAIL WHERE B.ID_TIKET = $id AND A.ID_TIKET_DETAIL IS NOT NULL");
        // print_r($iwhere_notin); 
        // $iwhere_notin_= implode(',', $iwhere_notin );
        // print_r(json_encode($iwhere_notin)); die();
        $iwhere_notin_ = array();
        $iwhere_notin_[] = "";
        foreach ($iwhere_notin as $key) {
            $iwhere_notin_[] = $key->ID_TIKET_DETAIL;
        }

        $iorder = array('ID_TIKET' => 'asc');
        // print_r($_POST); die();
        $list = $this->datatables_custom->get_datatables('TBL_T_TIKET_DETAIL', $icolumn, $iorder, array(), array(), $ID_TIKET, 'ID_TIKET', $iwhere_notin_, 'ID_TIKET_DETAIL');
        // $list = $this->datatables_custom->get_datatables('TBL_T_TIKET_DETAIL', $icolumn, $iorder, array(),array(),$ID_TIKET_DETAIL,'ID_TIKET');
        // echo "<pre>";
        //     print_r($this->db->last_query());
        //     die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            // $row[] = $idatatables->ID_TIKET;
            $row[] = $idatatables->ID_TIKET_DETAIL;
            $row[] = date('d-m-Y', strtotime($idatatables->CREATE_DATE));
            $row[] = $idatatables->AN_TIKET;
            $row[] = $idatatables->JNS_IDENTITAS;
            $row[] = $idatatables->NO_IDENTITAS;
            $row[] = $idatatables->ID_KRY;
            $data[] = $row;
        }

        $output = array(
            "STATUS_TIKET" => 1,
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_Grid_InvoicePembayaran() {
        $icolumn = array('ID_TIKET', 'TRAVEL', 'JML_TERMIN', 'PERSENTASE', 'NILAI', 'ID_TERMIN_DETAIL','COUNT_TERMIN','COUNT_INV');
        $iwhere = array();

        $iorder = array('ID_TIKET' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_PR_TIKET_INV', $icolumn, $iorder, $iwhere);
        // print_r($list);
        // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            if ($idatatables->COUNT_TERMIN != $idatatables->COUNT_INV) {
                $no++;
                $row = array();
                // $row[] = $no; 
                $row[] = $idatatables->ID_TIKET;
                $row[] = $idatatables->JML_TERMIN;
                $row[] = $idatatables->TRAVEL;
                $row[] = $idatatables->PERSENTASE . '%';
                $row[] = 'Rp.' . number_format(($idatatables->NILAI), 2);
                $row[] = '<button class="btn btn blue" href="#" onclick="editpayment(' . $idatatables->ID_TIKET . ',' . $idatatables->NILAI . ',' . $idatatables->ID_TERMIN_DETAIL . ')"  data-toggle="modal"  data-target="#ModalInputInvoice">BAYAR INVOICE</button>';
                $data[] = $row;
            }
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_Grid_Payment() {
        $icolumn = array('ID_TIKET', 'ID_TIKET_INVOICE', 'NILAI_DIBAYARKAN', 'CREATE_DATE');
        $iwhere = array();

        $iorder = array('ID_TIKET_INVOICE' => 'asc');
        $list = $this->datatables_custom->get_datatables('TBL_T_TIKET_INVOICE', $icolumn, $iorder, $iwhere);
        // print_r($list);
        // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $idatatables->ID_TIKET;
            $row[] = date('d-m-Y', strtotime($idatatables->CREATE_DATE));
            $row[] = 'Rp.' . number_format(($idatatables->NILAI_DIBAYARKAN), 2);
            $row[] = 'TERBAYAR';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function downloadTiket() {
        // die('asd');
        $data ['ID_TIKET2'] = explode(',', $this->input->get('sID_TIKET'));
        $data ['STATUS_TIKET'] = trim($this->input->get('STATUS_TIKET'));
        $data ['Raw_ID'] = trim($this->input->post('Raw_ID'));
        // print_r($data);die();
        // $Raw_ID = trim($this->input->post('Raw_ID'));
        // print_r(); die();


        $ID_TIKET = $this->input->get('sID_TIKET');
        $Tgl_kirim = $this->input->get('sTgl_kirim');
        $Vendor = $this->input->get('sVendor');
        $this->load->helper('download');
        $this->load->library('Excel/phpexcel');
        // print_r($Tgl_kirim); 
        // print_r($Vendor); die();
        //membuat objek
        $objPHPExcel = new PHPExcel();
        //activate worksheet number 1
        $objPHPExcel->setActiveSheetIndex(0);
        //name the worksheet
        $objPHPExcel->getActiveSheet()->setTitle('PR Tiket');

        // $users = (array)$users[0];
        //set cell A1 content with some text
        
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'DAFTAR PR');

        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'TANGGAL KIRIM');
        $objPHPExcel->getActiveSheet()->setCellValue('B4', 'VENDOR');
        // $objPHPExcel->getActiveSheet()->setCellValue('C3',  $date('Y-m-d h:i:s'));
        $objPHPExcel->getActiveSheet()->setCellValue('C3', $Tgl_kirim);
        $objPHPExcel->getActiveSheet()->setCellValue('C4', $Vendor);
        // $objPHPExcel->getActiveSheet()->getStyle('C3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        // $objPHPExcel->getActiveSheet()->setCellValue('B6', 'PR');
        $objPHPExcel->getActiveSheet()->setCellValue('A6', 'PR');
        $objPHPExcel->getActiveSheet()->setCellValue('B6', 'AKOMODASI');
        $objPHPExcel->getActiveSheet()->setCellValue('C6', 'AN TIKET');
        $objPHPExcel->getActiveSheet()->setCellValue('D6', 'GENDER');
        $objPHPExcel->getActiveSheet()->setCellValue('E6', 'NO HP');
        $objPHPExcel->getActiveSheet()->setCellValue('F6', 'DIVISI');
        $objPHPExcel->getActiveSheet()->setCellValue('G6', 'JABATAN');
        $objPHPExcel->getActiveSheet()->setCellValue('H6', 'NIP');
        $objPHPExcel->getActiveSheet()->setCellValue('I6', 'JENIS IDENTITAS');
        $objPHPExcel->getActiveSheet()->setCellValue('J6', 'NO IDENTITAS');
        $objPHPExcel->getActiveSheet()->setCellValue('K6', 'ASAL');
        $objPHPExcel->getActiveSheet()->setCellValue('L6', 'TUJUAN');
        $objPHPExcel->getActiveSheet()->setCellValue('M6', 'KATEGORI PERJALANAN');
        $objPHPExcel->getActiveSheet()->setCellValue('N6', 'TANGGAL BERANGKAT');
        $objPHPExcel->getActiveSheet()->setCellValue('O6', 'MASKAPAI');
        $objPHPExcel->getActiveSheet()->setCellValue('P6', 'TANGGAL PULANG');
        $objPHPExcel->getActiveSheet()->setCellValue('Q6', 'MASKAPAI');
        // print_r( $objPHPExcel); die();


        $data = $this->tiket_m->getAllTiket($ID_TIKET);
        $counter = 7;
        // $counter1 = 3;
        // for($i=1;$i<=$icount;$i++){
        foreach ($data as $key) {
            // if($idatatables->TGL_PULANG == ''){
            //  $tanggal_pulang = "";
            // }else{
            // $tanggal_pulang = $key->TGL_PULANG;
            // }

             if($key->ASAL_PULANG == ''){
             $tanggal_pulang = "";
            }else{
            $tanggal_pulang = date('d-m-Y', strtotime($key->TGL_PULANG));
            }

            // $objPHPExcel->getActiveSheet()->setCellValue('C'. $counter1, $key->VendorName);
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $key->ID_TIKET);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, $key->AKOMODASI);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $counter, $key->AN_TIKET);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $counter, $key->GENDER);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, $key->NO_HP);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $counter, $key->DIV);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $counter, $key->JABATAN);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $counter, $key->ID_KRY);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $counter, $key->JNS_IDENTITAS);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $counter, $key->NO_IDENTITAS);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $counter, $key->ASAL_BERANGKAT);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $counter, $key->TUJUAN_BERANGKAT);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $counter, $key->KATEGORI);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $counter, date('d-m-Y', strtotime($key->TGL_BERANGKAT)));
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $counter, $key->NOTE);
            $objPHPExcel->getActiveSheet()->setCellValue('P' . $counter, $tanggal_pulang);
            $objPHPExcel->getActiveSheet()->setCellValue('Q' . $counter, $key->NOTE);
            

            $objPHPExcel->getActiveSheet()->getStyle('G1:G' . $counter)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $counter++;



            // $objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, '-');
            //     $counter++;
            // }
        }

        // //make the font become bold
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('J6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('K6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('L6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('M6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('N6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('O6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('P6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('Q6')->getFont()->setBold(true);

        ob_end_clean();

        //Header
        $filename = "list_PR_Tiket.xlsx";
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Pragma: no-cache");
        header("Expires: 0");

        //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


        //Download
        $objWriter->save("php://output");

        $ID_TIKET = explode(',', $this->input->get('sID_TIKET'));
        foreach ($ID_TIKET as $val) {
            $data = array(
                // 'TGL_KIRIM' => date("d-m-Y", strtotime($Tgl_kirim)), 
                'TGL_KIRIM' => date('Y-m-d h:i:s'),
                'TRAVEL' => $Vendor,
                'STATUS_TIKET' => 1,
                'UPDATE_DATE' => date("Y/m/d H:i:s"),
                'UPDATE_BY' => $this->session->userdata('user_id')
            );
            $model = $this->global_m->ubah('TBL_T_TIKET', $data, 'ID_TIKET', $val);

            $idata = array(
                'STATUS_TIKET' => 1,
                'UPDATE_DATE' => date("Y/m/d H:i:s"),
                'UPDATE_BY' => $this->session->userdata('user_id')
            );
            $model = $this->global_m->ubah('TBL_T_TIKET_DETAIL', $idata, 'ID_TIKET', $val);
        }
        // redirect('tiket/tiket/traveltiket');
        //redirect(base_url('tiket/tiket/traveltiket'));
    }

    function simpan_invoice() {
        // die('asd');
        $ID_TIKET_INVOICE = $this->global_m->getIdMax('ID_TIKET_INVOICE', 'TBL_T_TIKET_INVOICE');
        //$ID_TIKET = $this->input->get('ID_TIKET');
        $ID_TIKET = trim($this->input->post('ID_TIKET'));     
        $pembayaran_inv = $this->input->post('pembayaran_inv');
        $NILAI = $this->input->post('NILAI');
        $dok = $this->input->post('dok');
        $nama_dokumen = $this->input->post('nama_dokumen');
        $tanggal = $this->input->post('tanggal');
        $no_dokumen = $this->input->post('no_dokumen');
        $ID_TERMIN_DETAIL = $this->input->post('ID_TERMIN_DETAIL');
        // print_r($_POST); die();

        $this->load->library('upload');
        $config['upload_path'] = './uploads/doc_inv/'; //path folder
        $config['max_size'] = '0'; //maksimum besar file 5M
        $config['allowed_types'] = '*'; //type yang dapat diakses bisa anda sesuaikan
        $atflag = 'T';
        $atwaktuupdate = date("Y/m/d H:i:s");

        $files = $_FILES;
        $nilai = 0;

        for ($i = 0; $i < count($_FILES['dok']['name']); $i++) {
            $namafile = $files['dok']['name'][$i];
            $ext = pathinfo($namafile, PATHINFO_EXTENSION);
            $namafileasli = explode(".", strrev($namafile));
            $nama_file_baru = $this->global_m->generateRandomString();
            $nama_file_baru2 = $nama_file_baru . "." . $ext;
            $namafile = $nama_file_baru2;
            $_FILES['userfile']['name'] = $nama_file_baru2;
            $_FILES['userfile']['type'] = $files['dok']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['dok']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['dok']['error'][$i];
            $_FILES['userfile']['size'] = $files['dok']['size'][$i];

            $this->upload->initialize($config);
            if ($this->upload->do_upload('userfile')) {
                $data = $this->upload->data();
                $dok = $data['file_name'];

                $data = array(
                    'ID_TIKET_INVOICE' => $ID_TIKET_INVOICE,
                    'ID_TERMIN_DETAIL' => $ID_TERMIN_DETAIL,
                    'ID_TIKET' => $ID_TIKET,
                    'NILAI_DIBAYARKAN' => $NILAI,
                    'DOC_PATH' => 'uploads/doc_inv/' . $dok,
                    'CREATE_DATE' => date('Y-m-d h:i:s'),
                    'CREATE_BY' => $this->session->userdata('user_id')
                );

                $model = $this->global_m->simpan('TBL_T_TIKET_INVOICE', $data);

                for ($i = 0; $i < count($nama_dokumen); $i++) {
                    $datadoc = array(
                        'ID_TIKET_INVOICE' => $ID_TIKET_INVOICE,
                        'NAMA_DOC' => $nama_dokumen[$i],
                        'NO_DOC' => $no_dokumen[$i],
                        'TGL' => $tanggal[$i],
                        'CREATE_DATE' => date('Y-m-d h:i:s'),
                        'CREATE_BY' => $this->session->userdata('user_id')
                            // 'status' => 0 //aktif
                    );
                    // print_r($datadoc); die();
                    $model = $this->global_m->simpan('TBL_T_TIKET_DOC', $datadoc);
                }
            }
        }
        // $model = $this->global_m->simpan('TBL_T_TIKET_INVOICE', $data);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been saved.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function simpan_termin() {
        $ID_TIKET = trim($this->input->get('ID_TIKET'));
        $ID_TIKET_DETAIL = explode(',', trim($this->input->get('sID_TIKET_DETAIL')));
        $pay = trim($this->input->post('pay'));
        $payment = trim($this->input->post('payment'));
        $pay_term = trim($this->input->post('pay_term'));
        $status = trim($this->input->post('status'));
        $jml = trim($this->input->post('jml'));
//        print_r($_POST);
        $ID_TERMIN_DETAIL = $this->global_m->getIdMax('ID_TERMIN_DETAIL', 'TBL_T_TIKET_TERMIN_DETAIL');
        if ($jml > 0) {
            for ($i = 1; $i <= $jml; $i++) {
                $pay = $_POST['pay' . $i];
                if (isset($pay)) {
                    $ID_TERMIN = $this->global_m->getIdMax('ID_TERMIN', 'TBL_T_TIKET_TERMIN');

                    $nilpay = $_POST['nilpay' . $i];
                    $tglpay = $_POST['tglpay' . $i];
                    $datax = array(
                        'ID_TERMIN' => $ID_TERMIN,
                        'ID_TERMIN_DETAIL' => $ID_TERMIN_DETAIL,
                        'ID_TIKET' => $ID_TIKET,
                        'TGL_JATUH_TEMPO' => date("Y-m-d",  strtotime($tglpay)),
                        'NILAI' => str_replace(',', '', $nilpay),
                        'PERSENTASE' => $pay,
                        'TERMIN' => $i,
                        'STATUS' => 0,
                        'CREATE_DATE' => date('Y-m-d h:i:s'),
                        'CREATE_BY' => $this->session->userdata('user_id')
                    );
                    $model = $this->global_m->simpan('TBL_T_TIKET_TERMIN', $datax);
                }
            }
        }

        foreach ($ID_TIKET_DETAIL as $key) {
            $ID = $this->global_m->getIdMax('ID', 'TBL_T_TIKET_TERMIN_DETAIL');
            $idata = array(
                'ID' => $ID,
                'ID_TERMIN_DETAIL' => $ID_TERMIN_DETAIL,
                'ID_TIKET_DETAIL' => $key,
                'CREATE_DATE' => date('Y-m-d h:i:s'),
                'CREATE_BY' => $this->session->userdata('user_id')
            );
            $model = $this->global_m->simpan('TBL_T_TIKET_TERMIN_DETAIL', $idata);
        }

        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been saved.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

      function tampil_data() {

        $ID_TIKET = trim($this->input->post('ID_TIKET', true));
        $sql = "select ID_TIKET
        FROM TBL_T_TIKET
        WHERE ID_TIKET='$ID_TIKET'";
        $query = $this->db->query($sql)->result();
        $rows['data_res'] = $query;
        return $this->output->set_output(json_encode($rows));
    }

    function tampil_data_History() {

        $ID_TIKET = trim($this->input->post('ID_TIKET', true));
        $sql = "SELECT ID_TIKET_DETAIL, ID_TIKET, AN_TIKET, JNS_IDENTITAS, NO_IDENTITAS, ID_KRY, DIV, GENDER, NO_HP 
        FROM TBL_T_TIKET_DETAIL
        WHERE ID_TIKET='$ID_TIKET'";
        $query = $this->db->query($sql)->result();
        $rows['data_history'] = $query;
        return $this->output->set_output(json_encode($rows));

    }

    function tampil_data_spd() {
        // die('asd');
        $ID_TIKET = trim($this->input->post('ID_TIKET', true));
        $sql = "select ID_TIKET
    FROM TBL_T_TIKET
    WHERE ID_TIKET='$ID_TIKET'";
        $query = $this->db->query($sql)->result();
        $rows['data_res'] = $query;
        return $this->output->set_output(json_encode($rows));
    }

    function tampil_payment() {

        $ID_TIKET = trim($this->input->post('ID_TIKET', true));
        $sNILAI = trim($this->input->post('sNILAI', true));
        $sID_TERMIN_DETAIL = trim($this->input->post('sID_TERMIN_DETAIL', true));

        $rows['ID_TIKET'] = $ID_TIKET;
        $rows['data_res'] = $sNILAI;
        $rows['ID_TERMIN_DETAIL'] = $sID_TERMIN_DETAIL;
        $ndoc = $this->ias_mdl->get_doc();
        $doc_val = "<option disabled selected>Pilih Dokumen</option>";
        foreach ($ndoc as $doc) {
            $doc_val .= "<option value='" . $doc->ID_DOC . "'>" . $doc->NAMA_DOC . "</option>";
        }
        $rows['doc'] = $doc_val;
        $this->load->view('tiket/form_inv_tiket', $rows);

    }

    function edit_uploadEtiket() {
        // die('ads');

        $data['Image_Etiket'] = trim($this->input->post('Image_Etiket'));
        $data['ID_TIKET'] = trim($this->input->post('ID_TIKET'));

        // print_r($data); die();

        $datax = array(
            'Image_Etiket' => $data['TIKET_PATH'],
            'update_date' => date('Y-m-d h:i:s')
        );
        // print_r($datax); die();
        $table = "TBL_T_TIKET";
        $id_kolom = "ID_TIKET = '" . $data['ID_TIKET'] . "'";
        $model = $this->global_m->ubah($table, $datax, $id_kolom);

        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been succsess to changed.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal diubah.'
            );
        }

        $this->output->set_output(json_encode($array));
    }

    public function ubah_etiket() {
        $this->load->helper('form', 'url');
        $ID_TIKET = $_POST['ID_TIKET'];
        $fileName = md5(date('Y-m-d H:i:s'));
        $path = 'uploads/e_tiket/';

        $config = array(
            'upload_path' => './' . $path,
            'file_name' => $fileName,
            'overwrite' => true,
            'allowed_types' => '*',
            // 'allowed_types'=>'gif|jpg|png|jpeg|xlsx',
            'max_size' => 0,
            'max_width' => 0,
            'max_height' => 0
        );

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('fileUpload')) {
            $result = array('istatus' => false, 'iremarks' => $this->upload->display_errors());
        } else {
            $resultUpload = $this->upload->data();
            $data = array(
                'TIKET_PATH' => $path . $fileName . $resultUpload['file_ext'],
                'STATUS_TIKET' => 2,
                'UPDATE_BY' => $this->session->userdata('id_user'),
                'UPDATE_DATE' => date('Y-m-d H:i:s')
            );
            $result = $this->global_m->ubah('TBL_T_TIKET', $data, 'ID_TIKET', $ID_TIKET);


            if ($result) {
                $result = array('istatus' => true, 'iremarks' => 'Upload Success.!'); //, 'body'=>'Data Berhasil Disimpan');
            } else {
                $result = array('istatus' => false, 'iremarks' => 'Gagal');
            }
        }
        echo json_encode($result);
    }

    public function ubah_SPD() {
        $this->load->helper('form', 'url');
        $ID_TIKET = $_POST['ID_TIKET'];
        $fileName = md5(date('Y-m-d H:i:s'));
        $path = 'uploads/tiket/';

        $config = array(
            'upload_path' => './' . $path,
            'file_name' => $fileName,
            'overwrite' => true,
            'allowed_types' => '*',
            // 'allowed_types'=>'gif|jpg|png|jpeg|xlsx',
            'max_size' => 0,
            'max_width' => 0,
            'max_height' => 0
        );

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('fileUpload')) {
            $result = array('istatus' => false, 'iremarks' => $this->upload->display_errors());
        } else {
            $resultUpload = $this->upload->data();
            $data = array(
                'SPD_PATH' => $path . $fileName . $resultUpload['file_ext'],
                'UPDATE_BY' => $this->session->userdata('id_user'),
                'UPDATE_DATE' => date('Y-m-d H:i:s')
            );
            $result = $this->global_m->ubah('TBL_T_TIKET', $data, 'ID_TIKET', $ID_TIKET);


            if ($result) {
                $result = array('istatus' => true, 'iremarks' => 'Upload Success.!'); //, 'body'=>'Data Berhasil Disimpan');
            } else {
                $result = array('istatus' => false, 'iremarks' => 'Gagal');
            }
        }
        echo json_encode($result);
    }

}

/* End of file atk.php */
/* Location: ./application/controllers/atk.php */