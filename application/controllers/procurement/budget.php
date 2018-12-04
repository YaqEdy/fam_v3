<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Budget extends CI_Controller {

    function __construct() {
        parent::__construct();

        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
            $this->load->model('global_m');
            $this->load->model('procurement/budget_mdl', 'Budget_mdl');
            $this->load->model('datatables_custom');
        }
    }
    public function print_qr() {
        $idAssets=$this->input->get('sId');
        $data['qr_code'] = $this->global_m->tampil_data("SELECT * FROM VW_ASSETS_QRCODE WHERE ID_ASSET IN (".$idAssets.")");
        $this->load->view('procurement/budget/print_qr_c',$data);
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
        $menuId = $this->home_m->get_menu_id('procurement/budget/home');
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
        $data['dd_Division'] = $this->global_m->tampil_data("SELECT FLEX_VALUE as DivisionID,DIV_DESC as DivisionName FROM TBL_M_DIVISION where Is_trash=0");
        $data['dd_Branch'] = $this->global_m->tampil_data("SELECT FLEX_VALUE as BranchID,BRANCH_DESC as BranchName FROM TBL_M_BRANCH where Is_trash=0");

//        print_r($this->global_m->tampil_data('SELECT * FROM TBL_R_JNS_BUDGET'));die();
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');


        $this->template->set('title', 'Budget Capex');
        $this->template->load('template/template_dataTable', 'procurement/budget/budget_v', $data);
    }

    public function ajax_GridBudgetCapex() {
        $icolumn = array( 'Year', 'BranchName', 'DivisionName', 'BudgetValue', 'sisa', 'Budget_booking', 'terpakai', 'BudgetID', 'BranchID', 'DivisionID');
//        $icolumn = array('BudgetID');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );
        $iwhere = array(
            'BranchID' => $this->input->post('sBranch'),
            'Jenis_budget' => $this->input->post('sJnsBudget'),
            'Year' => $this->input->post('sTahun')
        );
        $iorder = array('BudgetID' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_BUDGET', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->BudgetID;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->DivisionID;

//            $row[] = $idatatables->BudgetCOA;
            $row[] = $idatatables->Year;
            $row[] = $idatatables->BranchName;
            $row[] = $idatatables->DivisionName;
            $row[] = $idatatables->BudgetValue;
            $row[] = $idatatables->sisa;
            $row[] = $idatatables->Budget_booking;
            $row[] = $idatatables->terpakai;
            $row[] = '<a class="btn btn-xs btn blue" href="#" id="btnTransfer" data-toggle="modal" data-target="#mdl_Transfer">Transfer</a>'
//                    . '<a class="btn btn-xs btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a>'
                    . '<a class="btn btn-xs btn-danger" href="#" id="btnDelete">Delete</a>';

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

    public function readExcel() {
        $config['upload_path'] = "./uploads/budget/";
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = '25000';
        $config['file_name'] = 'BUDGET-' . date('YmdHis');

        $this->load->library('upload', $config);


        if ($this->upload->do_upload("namafile")) {
            $data = $this->upload->data();
            $file = './uploads/budget/' . $data['file_name'];

            //load the excel library
            $this->load->library('excel/phpexcel');
            //read file from path
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            //get only the Cell Collection
            $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
            //extract to a PHP readable array format
            foreach ($cell_collection as $cell) {
                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                //header will/should be in row 1 only. of course this can be modified to suit your need.
                if ($row == 1) {
                    $header[$row][$column] = $data_value;
                } else {
                    $arr_data[$row][$column] = $data_value;
                }
            }
            // BudgetCOA, Year, BranchID, BisUnitID, DivisionID, BudgetValue, CreateDate, CreateBy, BudgetOwnID, BudgetUsed, Status, Is_trash
            $data = '';
            $flag = 1;
            $date = date('Y-m-d');
            $by = $this->session->userdata('user_id');

            foreach ($arr_data as $key => $value) {
                if (!empty($value["F"]) && $value["F"] != "-" && $value["F"] != "" && !empty($value["A"])) {
                    $this->Budget_mdl->simpan($value["A"], $value["C"], $value["D"], $value["E"], $value["F"]);
                }
            }

            // $this->Budget_mdl->simpanData($data);	
        } else {
            $this->session->set_flashdata('msg', $this->upload->display_errors());
        }
        echo json_encode(TRUE);
    }

    public function downloadTemplate() {
        $this->load->helper('download');

        $this->load->library('excel/phpexcel');

        //membuat objek
        $objPHPExcel = new PHPExcel();
        //activate worksheet number 1
        $objPHPExcel->setActiveSheetIndex(0);
        //name the worksheet
        $objPHPExcel->getActiveSheet()->setTitle('budget worksheet');

        // $users = (array)$users[0];
        //set cell A1 content with some text
//        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'COA');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'YEAR');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Branch - (Divisi)');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'BranchID');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'DivisionID');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'BudgetValue');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'JenisBudget');

        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'LENGKAPI DATA HANYA DI BAGIAN COA, YEAR, BUDGET VALUE DAN JENIS BUDGET');
        $objPHPExcel->getActiveSheet()->setCellValue('I2', 'DILARANG MENGUBAH DATA SELAIN KOLOM YANG DISEBUTKAN DIATAS');
        $objPHPExcel->getActiveSheet()->setCellValue('I3', 'JENIS BUDGET (1=CAPEX) , (0=OPEX)');

        //make the font become bold
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
//        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $data = $this->Budget_mdl->allBranch();
        $counter = 2;
        foreach ($data as $key) {

//            $objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, " " . $key->COA);
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, date("Y"));
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, $key->BRANCH_DIV);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $counter, $key->BRANCH_ID);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $counter, $key->DIV_ID);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, "");
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $counter, "");
//            $objPHPExcel->getActiveSheet()->getStyle('A1:A' . $counter)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $counter++;
        }

        ob_end_clean();
        //Header
        $filename = "budget.xlsx";
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Pragma: no-cache");
        header("Expires: 0");

        //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //Download
        $objWriter->save("php://output");
    }

    public function ddBranchTF() {
        $iAsal = $this->input->post('sDivAsal');
//        $ddBranchTujuan = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0 and DivisionID!=$iAsal");
        $ddBranchTujuan = $this->global_m->tampil_data("SELECT FLEX_VALUE AS DivisionID, DIV_DESC AS DivisionName FROM TBL_M_DIVISION where IS_TRASH=0 and FLEX_VALUE!='$iAsal'");

        $data = array();
        $data[''] = '';
        foreach ($ddBranchTujuan as $row) :
            $data[$row->DivisionID] = $row->DivisionName;
        endforeach;
        echo json_encode(form_dropdown('tf_tujuan', $data, '', 'id="dd_tf_tujuan" class="form-control  input-sm select2me" required="required" '));

//        $options = "<select id='dd_tf_tujuan' name='tf_tujuan' class='form-control input-sm select2me'>";
//        $options .= "<option value=''>-- Select --</option>";
//        foreach ($ddBranchTujuan as $k) {
//            $options .= "<option  value='" . $k->DivisionID . "'>" . $k->DivisionName . "</option>";
//        }
//        $options .= "</select>";
//        echo json_encode($options);
    }

    public function ddBranch() {
        $ddBranch = $this->Budget_mdl->getBranch();
        $options = "<select id='dd_id_branch' class='form-control' onchange='dd_Divisi(this.id)'>";
        $options .= "<option value=''>-- Select --</option>";
        foreach ($ddBranch as $k) {
            $options .= "<option  value='" . $k->BranchID . "'>" . $k->BranchName . "</option>";
        }
        $options .= "</select>";

        echo json_encode($options);
    }

    public function ddDivisi() {
        $BranchID = $this->input->post('sBranchID');
        $ddDivisi = $this->Budget_mdl->getdivisi($BranchID);
        $options = "<select id='dd_id_divisi' class='form-control'>";
//        $options .= "<option value=''>-- Pilih Project --</option>";
        foreach ($ddDivisi as $k) {
            $options .= "<option  value='" . $k->DivisionID . "'>" . $k->DivisionName . "</option>";
        }
        $options .= "</select>";

        echo json_encode($options);
    }

    public function ajax_Update() {
        $budgetid = $this->input->post('BudgetID');
        $COA = $this->input->post('BudgetCOA');
        $this->Budget_mdl->updatedata($budgetid);

        $result = array('istatus' => true, 'iremarks' => 'Success! budget COA: ' . $COA . ' Success Update data'); //, 'body'=>'Data Berhasil Disimpan');

        echo json_encode($result);
    }

    public function ajax_delete() {
        $id = $this->input->post('sbudgetID');
        $this->Budget_mdl->deletedata($id);

        $result = array('istatus' => true, 'iremarks' => 'Success.!'); //, 'body'=>'Data Berhasil Disimpan');

        echo json_encode($result);
    }

    public function ajax_Transfer() {
        $data = array(
            'TANGGAL' => date('Y-m-d', strtotime($this->input->post('tf_tanggal'))),
            'NAMA' => $this->input->post('tf_nama'),
            'POSISI' => $this->input->post('tf_posisi'),
            'BRANCH_DIV_ASAL' => $this->input->post('tf_asal'),
            'BRANCH_DIV_TUJUAN' => $this->input->post('tf_tujuan'),
            'JUMLAH' => str_replace(",", "", $this->input->post('tf_jumlah')),
            'CREATE_BY' => $this->session->userdata("id_user"),
            'CREATE_DATE' => date('Y-m-d h:i:s')
        );
//        print_r($data);die();
        $result = $this->global_m->simpan('TBL_T_TRANSFER_BUDGET', $data);
        if ($result) {
            $result = array('istatus' => true, 'type' => 'success', 'iremarks' => 'Transfer Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
            $result = array('istatus' => false, 'type' => 'error', 'iremarks' => 'Transfer Gagal.!'); //, 'body'=>'Data Berhasil Disimpan');
        }
        echo json_encode($result);
    }

    public function ajax_GridSetting() {
        $icolumn = array('ID_SETTTING_BUDGET', 'TAHUN', 'ID_JNS_BUDGET', 'BUDGET_DESC', 'STATUS', 'IS_TRASH');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );
        $iwhere = array('IS_TRASH' => 0);
        $iorder = array('BudgetID' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_BUDGET_SETTING', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->TAHUN;
//            $row[] = $idatatables->ID_JNS_BUDGET;
            $row[] = $idatatables->BUDGET_DESC;
            $row[] = ($idatatables->STATUS == 0) ? 'Tidak Detail' : 'Detail';
            $row[] = '<a class="btn btn-xs btn-danger" href="#" onclick="onDelete(' . $idatatables->ID_SETTTING_BUDGET . ',1)">Delete</a>';
//            $row[] = ($idatatables->STATUS==0)?'<a class="btn btn-xs btn-danger" href="#" onclick="onDetail(' . $idatatables->ID_SETTTING_BUDGET . ',1)">Detail</a>':'<a class="btn btn-xs btn-danger" href="#" onclick="onDetail(' . $idatatables->ID_SETTTING_BUDGET . ',0)">Tidak Detail</a>';
//            $row[] = $idatatables->ID_SETTTING_BUDGET;

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

    public function ajax_insert_setBudget() {
        $data = array(
            'TAHUN' => $this->input->post('st_Tahun'),
            'ID_JNS_BUDGET' => (int) $this->input->post('st_jns_budget'),
            'STATUS' => (int) $this->input->post('detail'),
            'IS_TRASH' => 0
        );
//        print_r($data);die();
        $result = $this->global_m->simpan('TBL_T_SETTING_BUDGET', $data);
        if ($result) {
            $result = array('istatus' => true, 'type' => 'success', 'iremarks' => 'Transfer Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
            $result = array('istatus' => false, 'type' => 'error', 'iremarks' => 'Transfer Gagal.!'); //, 'body'=>'Data Berhasil Disimpan');
        }
        echo json_encode($result);
    }

    public function ajax_setDelete() {
        $data = array('IS_TRASH' => 1);

        $result = $this->global_m->ubah('TBL_T_SETTING_BUDGET', $data, 'ID_SETTTING_BUDGET', $this->input->post('sID'));
        if ($result) {
            $result = array('istatus' => true, 'type' => 'success', 'iremarks' => 'Delete Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
            $result = array('istatus' => false, 'type' => 'error', 'iremarks' => 'Delete Gagal.!'); //, 'body'=>'Data Berhasil Disimpan');
        }
        echo json_encode($result);
    }

    public function ajax_setBudget() {
        if ($this->input->post('sParam') == 1) {
            $data = array('STATUS' => 1);
        } else {
            $data = array('STATUS' => 0);
        }
        $result = $this->global_m->ubah('TBL_T_SETTING_BUDGET', $data, 'ID_SETTTING_BUDGET', $this->input->post('sID'));
        if ($result) {
            $result = array('istatus' => true, 'type' => 'success', 'iremarks' => 'Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
            $result = array('istatus' => false, 'type' => 'error', 'iremarks' => 'Gagal.!'); //, 'body'=>'Data Berhasil Disimpan');
        }
        echo json_encode($result);
    }

    function getfam() {
        $jsonarr = [
            'table' => 'PNM_FA_LOCATIONS_V'
        ];
        $curlurl = "http://192.168.10.241/OCI/index.php/api/v1/fam/get_all";

        $ch = curl_init($curlurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($jsonarr));
        $responsejson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responsejson, true);

        print_r($response['data']);
        // $this->response($result, 200);
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */