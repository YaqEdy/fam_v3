<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class penilaian_vendor extends CI_Controller {

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
            $this->load->model('procurement/cek_barang_mdl');
            $this->load->model('procurement/penilaian_vendor_mdl');
            $this->load->model('api/api_m');
            $this->load->model('datatables_custom');
        }
    }

    public function index(){
        $menuId = $this->home_m->get_menu_id('procurement/penilaian_vendor');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");


        $this->template->set('title', 'PENILAIAN VENDOR');
        $this->template->load('template/template_dataTable', 'procurement/penilaian_vendor/index', $data);
    }

    public function list_penilaian_vendor(){
        $icolumn = array('ID_PR', 'ID_PO', 'ID_PO_DETAIL', 'VendorName');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );

        if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
            $iwhere = array(
                'TGL_PR <' => date("Y-m-d", strtotime($this->input->post('sMulai'))),
                'TGL_PR >' => date("Y-m-d", strtotime($this->input->post('sSampai')))
            );
        }else{
            $iwhere = array();
        }

        $igroup_by = 'ID_PO_DETAIL';

        $iorder = array('ID_PO_DETAIL' => 'desc');
        $list = $this->datatables_custom->get_datatables('VW_PENILAIAN_VENDOR', $icolumn, $iorder, $iwhere, $ilike, $igroup_by);

        $data = array();
        $no = $_POST['start'];

         foreach ($list as $idatatables) {
            $termin = $this->ias_mdl->count_termin($idatatables->ID_PO_DETAIL);

            $no++;
            $row = array();

            $row[] = $idatatables->ID_PR;
            $row[] = $idatatables->ID_PO;
            $row[] = $idatatables->ID_PO_DETAIL;
            $row[] = $idatatables->VendorName;
            $row[] = '<a href="'.base_url().'procurement/penilaian_vendor/view/'.$idatatables->ID_PO_DETAIL.'" class="btn btn-primary">View</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function view($id_po_detail){
        $menuId = $this->home_m->get_menu_id('procurement/penilaian_vendor');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);

        $data['nilai'] = $this->penilaian_vendor_mdl->get_penilaian_vendor($id_po_detail);
        $data['variables'] = $this->penilaian_vendor_mdl->get_variable_penilaian();
        $data['ID_PO_DETAIL'] = $id_po_detail;

        $this->template->set('title', 'PENILAIAN VENDOR');
        $this->template->load('template/template_dataTable', 'procurement/penilaian_vendor/detail', $data);
    }

    public function submit($id_po_detail){
        $this->penilaian_vendor_mdl->delete_penilaian($id_po_detail);
        for ($i=0; $i < count($_POST['varia']); $i++) {
            $nilai = array(
                            'ID_PENILAIAN' => $this->global_m->getIdMax('ID_PENILAIAN','TBL_T_PENILAIAN_VENDOR'),
                            'ID_PO_DETAIL' => $id_po_detail,
                            'VARIABEL' => $_POST['variable'][$i],
                            'PENILAIAN' => $_POST['penilaian'][$i],
                            'BOBOT' => $_POST['vars'][$i]
                            );

            $this->penilaian_vendor_mdl->save_penilaian($nilai);
        }
        redirect('procurement/penilaian_vendor');
    }
}
?>