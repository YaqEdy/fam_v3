<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class invoice extends CI_Controller {

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
        $menuId = $this->home_m->get_menu_id('reports/invoice');
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

        $data['divisions'] = $this->ias_mdl->get_division();

        $this->template->set('title', 'REPORT');
        $this->template->load('template/template_dataTable', 'reports/invoice/index_inv', $data);
    }


    public function list_report_inv_(){
        $icolumn = array('RequestID','ProjectName','DivisionID','PIC_PO','CreateDate','ID_PO','TTL_HARGA','VendorName','TERMIN','ID_IAS','NO_DOC','PERSENTASE','NILAI_DIBAYARKAN','TGL_JATUH_TEMPO');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );

        if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
            $iwhere = array(
                'CreateDate >' => date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('sMulai')))),
                'CreateDate <' => date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('sSampai'))))
            );
        }else{
            $iwhere = array();
        }

        if (!empty($this->input->post('sDiv'))){
            $iwhereDiv = array(
                'DivisionID =' => $this->input->post('sDiv')
            );
            $iwhere = array_merge($iwhere,$iwhereDiv);
        }
        // print_r($iwhere); exit;

        $igroup_by = '';

        $iorder = array();
        $list = $this->datatables_custom->get_datatables('VW_RPT_INV', $icolumn, $iorder, $iwhere, $ilike, $igroup_by);

        $data = array();
        $no = $_POST['start'];

        foreach ($list as $idatatables) {

            $no++;
            $row = array();

            $row[] = $idatatables->RequestID;
            $row[] = $idatatables->ProjectName;
            $row[] = $idatatables->DivisionID;
            $row[] = $idatatables->PIC_PO;
            $row[] =  date("d-m-Y", strtotime($idatatables->CreateDate));
            $row[] = $idatatables->ID_PO;
            $row[] = $idatatables->TTL_HARGA;
            $row[] = $idatatables->VendorName;
            $row[] = $idatatables->TERMIN;
            $row[] = $idatatables->ID_IAS;
            $row[] = $idatatables->NO_DOC;
            $row[] = $idatatables->PERSENTASE;
            $row[] = $idatatables->NILAI_DIBAYARKAN;
            $row[] = date("d-m-Y", strtotime($idatatables->TGL_JATUH_TEMPO)); 
            $row[] = '';
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

    public function downloadReport() {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $data['laporan'] = 'REPORT INVOICE';
            $tglmulai = date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('sMulai'))));
            $tglakhir = date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('sSampai'))));
            $data['periode'] = date("m-Y", strtotime($tglmulai)) . " To " . date("m-Y", strtotime($tglakhir));
            $icolumn = array('RequestID','ProjectName','DivisionID','PIC_PO','CreateDate','ID_PO','TTL_HARGA','VendorName','TERMIN','ID_IAS','NO_DOC','PERSENTASE','NILAI_DIBAYARKAN','TGL_JATUH_TEMPO');
            $ilike = array();

            if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
                $iwhere = array(
                    'CreateDate >' => date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('sMulai')))),
                    'CreateDate <' => date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('sSampai'))))
                );
            }else{
                $iwhere = array();
            }

            $igroup_by = '';

            $iorder = "RequestID";
            $data ['list'] = $this->datatables_custom->get_datatables_print('VW_RPT_INV', $icolumn, $iorder, $iwhere, $ilike, $igroup_by);
            // print_r($data ['list']);die();
            $this->load->view('reports/invoice/invoice_excel', $data);
        }
    }

    public function downloadReportPDF() {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $data['laporan'] = 'REPORT INVOICE';
            $tglmulai = date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('sMulai'))));
            $tglakhir = date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('sSampai'))));
            $data['periode'] = date("m-Y", strtotime($tglmulai)) . " To " . date("m-Y", strtotime($tglakhir));
            $icolumn = array('RequestID','ProjectName','DivisionID','PIC_PO','CreateDate','ID_PO','TTL_HARGA','VendorName','TERMIN','ID_IAS','NO_DOC','PERSENTASE','NILAI_DIBAYARKAN','TGL_JATUH_TEMPO');
            $ilike = array();

            if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
                $iwhere = array(
                    'CreateDate >' => date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('sMulai')))),
                    'CreateDate <' => date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('sSampai'))))
                );
            }else{
                $iwhere = array();
            }

             $igroup_by = '';

            $iorder = "RequestID";
            $data ['list'] = $this->datatables_custom->get_datatables_print('VW_RPT_INV', $icolumn, $iorder, $iwhere, $ilike, $igroup_by);
            $this->load->view('reports/invoice/invoice_pdf', $data);
        }
    }
}
?>