<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class generate_rpt_pa extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
            $this->load->model('global_m');
           $this->load->model('procurement/ias_mdl');
            // $this->load->model('procurement/cek_barang_mdl');
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
        $menuId = $this->home_m->get_menu_id('procurement/generate_rpt_pa/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        // $data['cetak_pa1'] = $this->ias_mdl->get_cetak_pa($id);
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        // $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        // $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");
//        print_r($this->global_m->tampil_data('SELECT * FROM TBL_R_JNS_BUDGET'));die();

        $this->template->set('title', 'RPT PA');
        $this->template->load('template/template_dataTable', 'procurement/generate_rpt_pa_v/rpt_pa_v', $data);
        // $this->template->load('template/template_dataTable', 'procurement/generate_rpt_pa_v/rpt_vendor', $data);
    }

    public function cetak_pa($id) {
         // die('asd');

    $data['cetak_pa1'] = $this->ias_mdl->get_cetak_pa($id);
    // echo "<pre>";
    // print_r($cetak_pa1); die(); 
    $this->load->view('procurement/generate_rpt_pa_v/cetak_rpt_pa_v',$data);
}

    public function tampil_no_purchase() {
        // die('asd');
        $RequestIDS = $this->input->get('sId');
        $data['qr_code'] = $this->global_m->tampil_data("SELECT * FROM VW_G_PA WHERE RequestID IN (" . $RequestIDS . ")");
        // print_r($data); die();
        $this->load->view('procurement/generate_rpt_pa_v/cetak_rpt_pa_v', $data);
    }

       public function ajax_GridDaftarPR() { 
        $icolumn = array('RequestID', 'tgl_req', 'ReqTypeID', 'ReqTypeName', 'ReqCategoryID', 'ReqCategoryName', 'ProjectName', 'BranchID', 'BRANCH_DESC', 'DivisionID');
//        $icolumn = array('HpsID');
        // $iwhere = array();
        $ID_PR =  explode(',', $this->input->post('sID_PR'));
        $iorder = array('RequestID' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_ATK_PR_HEADER', $icolumn, $iorder, array(),array(),$ID_PR,'RequestID');
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->RequestID;
            $row[] = date('d-m-Y', strtotime($idatatables->tgl_req)); 
            $row[] = $idatatables->ReqTypeName;
            $row[] = $idatatables->ReqCategoryName;
            $row[] = $idatatables->ProjectName;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->DivisionID;

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