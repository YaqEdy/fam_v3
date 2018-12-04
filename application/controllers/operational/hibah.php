<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class hibah extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('operational/hibah_m');

        session_start();
    }

    public $tabel_utama = 'TBL_T_OPEX_HIBAH';

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

            //$data ['nama'] = $this->home_m->get_nama_kantor ();
            $this->template->set('title', 'Home');
            $this->template->load('template/template1', 'global/index', $data);
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('operational/hibah/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->hibah_m->get_level_user();

        if (isset($_POST["userId"])) {
            $id = trim($_POST["userId"]);
            if ($id == '') {
                $this->simpan();
            } else {
                $this->ubah();
            }
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

            $this->template->set('title', 'Hibah');
            $this->template->load('template/template_dataTable', 'operational/hibah/hibah_v', $data);
        }
    }

    public function getUserInfo() {
        $this->CI = & get_instance(); 
        
        $sql = "select * from $this->tabel_utama";
        
        $rows = $this->global_m->tampil_data($sql);
        $data['data'] = array();
        foreach ($rows as $key => $row) {
            $STS = trim($row->IS_TRASH);
            if($STS <= 0 ){
                $status = "Active";
            }else{
                $status = "NonActive";
            }
            $array = array(
                'NO' => $key+1,
                'HIBAH_DESC' => trim($row->HIBAH_DESC),
                'QTY' => trim($row->QTY),
                'ASAL_HIBAH' => trim($row->ASAL_HIBAH),
                'KONDISI' => trim($row->KONDISI),
                'IMAGE_PATH' => trim($row->IMAGE_PATH),
                'ID_HIBAH' => trim($row->ID_HIBAH),
                'IS_TRASH' => $status,
//                'SELECT_STS' => "<select><option value=''>Pilih</option><option value='0'>Active</option><option value='1'>NonActive</option></select>"
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function upload_kuy($target_dirnya,$name_file) {
        $target_dir = $target_dirnya;
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        
        
        $target_file = $target_dir . basename($name_file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        //if(isset($_POST["submit"])) {
        //    $check = getimagesize($name_file["tmp_name"]);
        //    if($check !== false) {
        //        echo "File is an image - " . $check["mime"] . ".";
        //        $uploadOk = 1;
        //    } else {
        //        echo "File is not an image.";
        //        $uploadOk = 0;
        //    }
        //}
        // Check if file already exists
        //if (file_exists($target_file)) {
        //    echo "Sorry, file already exists.";
        //    $uploadOk = 0;
        //}
        // Check file size
        if ($name_file["size"] > 500000) {
//            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        //if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        //&& $imageFileType != "gif" ) {
        //    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //    $uploadOk = 0;
        //}
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
//            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            $uploadOk == 0;
        } else {
            if (move_uploaded_file($name_file["tmp_name"], $target_file)) {
//                echo "The file " . basename($name_file["name"]) . " has been uploaded.";
                $uploadOk == 1;
            } else {
                $uploadOk == 0;
//                echo "Sorry, there was an error uploading your file.";
            }
        }
        return $uploadOk;
    }

    function simpan() {

        $TmpAksiBtn = trim($this->input->post('TmpAksiBtn'));
        $user = $this->session->userdata('user_id');
        $date = date('Y-m-d h:i:s');
        $target_dir = "uploads/hibah/";
        $name_file = $_FILES["file_upload"]["name"];
        $path = $target_dir.$name_file;
        $tgl = trim($this->input->post('tgl_hibah'));

        $tgl_hibah = date("Y-m-d",strtotime($tgl));
        // die($tgl);
        if ($TmpAksiBtn <= 0) { //simpan
            $data = array(
                'HIBAH_DESC' => trim($this->input->post('HIBAH_DESC')),
                'QTY' => trim($this->input->post('QTY')),
                'BRANCH' => $this->session->userdata('BranchID'),
                'DIV' => $this->session->userdata('DivisionID'),
                // 'NOTE' => trim($this->input->post('NOTE')),
                'ASAL_HIBAH' => trim($this->input->post('HIBAH_DARI')),
                'IMAGE_PATH' => $path,
                'SAFE_VALUE' =>  trim($this->input->post('save_val')),
                // 'TGL_HIBAH' =>  trim($this->input->post('tgl_hibah')),
                'TGL_HIBAH' => $tgl_hibah,
                'KONDISI' =>  trim($this->input->post('kondisi')),
                'CREATE_BY' => $user,
                'CREATE_DATE' => $date,

            );
        } else { // EDIT
            $data = array(
                'HIBAH_DESC' => trim($this->input->post('HIBAH_DESC')),
                'QTY' => trim($this->input->post('QTY')),
                'BRANCH' => $this->session->userdata('BranchID'),
                'DIV' => $this->session->userdata('DivisionID'),
                'NOTE' => trim($this->input->post('NOTE')),
                'HIBAH_DARI' => trim($this->input->post('HIBAH_DARI')),
                'IMAGE_PATH' => $path,
                'UPDATE_BY' => $user,
                'UPDATE_DATE' => $date,
            );
        }
       // print_r($data);die();
        $target_dir = "uploads/hibah/";
        $name_file = $_FILES["file_upload"];
        $uploads = $this->upload_kuy($target_dir,$name_file);
      
        if($uploads."" <=0){
            $notifikasi = Array(
                    'msgType' => 'error',
                    'msgTitle' => 'Error',
                    'msg' => 'Data Gagal ' . $notif
                );
        }else{
//            print_r($data);die();   
            if ($TmpAksiBtn <= 0) { //SIMPAN
                $model = $this->global_m->simpan($this->tabel_utama, $data);
                $notif = 'Disimpan';
            } else {
                $model = $this->global_m->ubah($this->tabel_utama, $data, 'ID_HIBAH', $TmpAksiBtn);
                $notif = 'Diubah';
            }
             if ($model) {
                $notifikasi = Array(
                    'msgType' => 'success',
                    'msgTitle' => 'Success',
                    'msg' => 'Data Berhasil ' . $notif
                );
            } else {
                $notifikasi = Array(
                    'msgType' => 'error',
                    'msgTitle' => 'Error',
                    'msg' => 'Data Gagal ' . $notif
                );
            }
        }
        

       
        $this->session->set_flashdata('notif', $notifikasi);
        redirect('operational/hibah/home');
    }



}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */