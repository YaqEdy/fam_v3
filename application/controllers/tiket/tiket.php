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
//            $this->load->model('procurement/ias_mdl');
//            $this->load->model('procurement/cek_barang_mdl');
            $this->load->model('datatables_custom');
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
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_vendor'] = $this->global_m->tampil_data("SELECT Raw_ID, VendorName FROM Mst_Vendor");
        // $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        // $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");
//        print_r($this->global_m->tampil_data('SELECT * FROM TBL_R_JNS_BUDGET'));die();

        $this->template->set('title', 'Tiket');
        $this->template->load('template/template_dataTable', 'tiket/tiket_v', $data);
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
        $akomodasi = trim($this->input->post('akomodasi'));
        $ID_TIKET = $this->global_m->getIdMax('ID_TIKET','TBL_T_TIKET');
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
            'SPD_PATH' => 'uploads/tiket/'.$Image,
            'CREATE_DATE' => date('Y-m-d h:i:s'),
            'CREATE_BY' => $this->session->userdata('user_id')

        );
       //    echo "<pre>";
       // print_r($data);
        $model = $this->global_m->simpan('TBL_T_TIKET', $data);
    }

            // $dataxz = array();
        for($i=1;$i<=$icount;$i++){
            // print_r($i); die();
        $datax = array(
            'AN_TIKET' => trim($this->input->post('atasnama'.$i)),
            'JNS_IDENTITAS' => trim($this->input->post('jnsidentitas'.$i)),
            'NO_IDENTITAS' => trim($this->input->post('no_identitas'.$i)),
            'ID_KRY' => trim($this->input->post('id_kyw'.$i)),
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
      

     function hapus_itembarang () { //hapus
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
        $icolumn = array('ID_TIKET', 'ID_TIKET_DETAIL', 'TGL_PR', 'NO_SPD', 'SPD_PATH', 'AKOMODASI', 'AN_TIKET', 'JNS_IDENTITAS', 'NO_IDENTITAS', 'ASAL_BERANGKAT', 'TUJUAN_BERANGKAT', 'TGL_BERANGKAT', 'TGL_PULANG', 'KATEGORI');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('ID_TIKET' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_TIKET', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            // $row[] = '<input type="checkbox" name="check">';
            $row[] = $no; 
            $row[] = $idatatables->ID_TIKET_DETAIL;
            $row[] = $idatatables->ID_TIKET;
            $row[] = $idatatables->TGL_PR;
            $row[] = $idatatables->NO_SPD;
            $row[] = $idatatables->SPD_PATH;
            $row[] = $idatatables->AKOMODASI;
            $row[] = $idatatables->AN_TIKET;
            $row[] = $idatatables->JNS_IDENTITAS;
            $row[] = $idatatables->NO_IDENTITAS;
            $row[] = $idatatables->ASAL_BERANGKAT;
            $row[] = $idatatables->TUJUAN_BERANGKAT;
            $row[] = $idatatables->KATEGORI;
            $row[] = $idatatables->TGL_BERANGKAT;
            $row[] = $idatatables->TGL_PULANG;
            // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';       
            
            


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
        $icolumn = array('ID_TIKET_DETAIL', 'TGL_PR', 'NO_SPD', 'SPD_PATH', 'AKOMODASI', 'AN_TIKET', 'JNS_IDENTITAS', 'NO_IDENTITAS', 'ASAL_BERANGKAT', 'TUJUAN_BERANGKAT', 'TGL_BERANGKAT', 'TGL_PULANG', 'KATEGORI');
        $iwhere = array();
        $ID_TIKET_DETAIL =  explode(',', $this->input->post('sID_TIKET'));
        $iorder = array('ID_TIKET_DETAIL' => 'asc');
        // print_r($ID_TIKET_DETAIL); die();
        $list = $this->datatables_custom->get_datatables('VW_TIKET', $icolumn, $iorder, array(),array(),$ID_TIKET_DETAIL,'ID_TIKET_DETAIL');
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            // $row[] = '<input type="checkbox" name="check">';
            // $row[] = $no; 
            $row[] = $idatatables->AKOMODASI;
            $row[] = $idatatables->AN_TIKET;
            $row[] = $idatatables->JNS_IDENTITAS;
            $row[] = $idatatables->NO_IDENTITAS;
            $row[] = $idatatables->ASAL_BERANGKAT;
            $row[] = $idatatables->TUJUAN_BERANGKAT;
            $row[] = $idatatables->KATEGORI;
            $row[] = $idatatables->TGL_BERANGKAT;
            $row[] = $idatatables->TGL_PULANG;
            $row[] = $idatatables->ID_TIKET_DETAIL;
            // $row[] = $idatatables->TGL_PR;
            // $row[] = $idatatables->NO_SPD;
            // $row[] = $idatatables->SPD_PATH;
            // $row[] = $idatatables->AKOMODASI;
            
            
            
            
            
            
            // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';       
            
            


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


}

/* End of file atk.php */
/* Location: ./application/controllers/atk.php */