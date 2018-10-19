<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class ias extends CI_Controller {

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
            $this->load->model('datatables_custom');
            $this->load->model('api/api_m');
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
        $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");

//        print_r($this->global_m->tampil_data('SELECT * FROM TBL_R_JNS_BUDGET'));die();
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'IAS');
        $this->template->load('template/template_dataTable', 'procurement/ias/ias_v', $data);
    }

    function ias_form($id) {
        $ops = $this->ias_mdl->get_var();
        $ret_val = "<option disabled selected>Pilih Variable</option>";
        foreach ($ops as $op) {
            $ret_val .= "<option value='" . $op->BOBOT . "-" . $op->ID_VNILAI . "'>" . $op->VARIABEL . "</option>";
        }
        $data['var'] = $ret_val;

        $ndoc = $this->ias_mdl->get_doc();
        $doc_val = "<option disabled selected>Pilih Dokumen</option>";
        foreach ($ndoc as $doc) {
            $doc_val .= "<option value='" . $doc->ID_DOC . "'>" . $doc->NAMA_DOC . "</option>";
        }
        $data['doc'] = $doc_val;

        $menuId = $this->home_m->get_menu_id('procurement/budget/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['ias'] = $this->ias_mdl->get_ias($id);
        $data['dpp'] = $this->ias_mdl->get_dpp($id);
        $data['detail'] = $this->cek_barang_mdl->get_detail($id);
        $data['barang'] = $this->cek_barang_mdl->get_one_barang($id);
        $data['all_item'] = $this->cek_barang_mdl->get_all_barang($data['detail']->ID_PO);
        $jt_barang = new DateTime($this->cek_barang_mdl->get_termin($data['detail']->ID_PO)->TGL_JT_TERIMA_BRG);
        $jt_po = new DateTime($data['barang']->TGL_TERIMA);
        $diff = $jt_barang->diff($jt_po);
        $total = $data['detail']->TTL_HARGA;
        $data['total'] = intval((1 / 1000) * $total * $diff->days);

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");

//        print_r($this->global_m->tampil_data('SELECT * FROM TBL_R_JNS_BUDGET'));die();
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Upload IAS & Penilaian');
        $this->template->load('template/template_dataTable', 'procurement/ias/form_ias', $data);
    }

    public function savedata() {
        $id_ias = $this->global_m->getIdMax('ID_IAS', 'TBL_T_IAS');
        $head['ID_IAS'] = $id_ias;
        $head['NO_PA'] = $this->input->post('id_pa');
        $head['NO_PO'] = $this->input->post('id_po');
        $head['DPP'] = $this->input->post('dpp');
        $head['PPN'] = $this->input->post('ppn');
        $head['PPH'] = $this->input->post('pph');
        $head['DENDA'] = $this->input->post('denda');
        $head['NILAI_DIBAYARKAN'] = $this->input->post('dibayarkan');
        $head['NILAI_VENDOR'] = $this->input->post('akhir');
        if ($_FILES["dok"]['name'] != NULL) {
            $new_name = time() . $_FILES["foto"]['name'];
            $config = array(
                'upload_path' => "./uploads/doc/",
                'allowed_types' => "zip|rar",
                'file_name' => $new_name,
                'overwrite' => TRUE,
                    // 'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    // 'max_height' => "2048",
                    // 'max_width' => "2048"
            );
            $upload = $this->load->library('upload', $config);
            if ($this->upload->do_upload('dok')) {
                $head['DOC_PATH'] = 'uploads/doc/' . $new_name;
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('procurement/ias/home');
            }
        }

        $this->ias_mdl->save_ias($head);

        for ($i = 0; $i < count($_POST['nama_dokumen']); $i++) {
            $doc = array(
                'ID' => $this->global_m->getIdMax('ID', 'TBL_T_IAS_DOC'),
                'ID_IAS' => $id_ias,
                'NAMA_DOC' => $_POST['nama_dokumen'][$i],
                'NO_DOC' => $_POST['no_dokumen'][$i],
                'TGL' => DateTime::createFromFormat('d/m/Y', $_POST['tanggal'][$i])->format('Y-m-d')
            );


            $this->ias_mdl->save_ias_doc($doc);
        }

        for ($i = 0; $i < count($_POST['varia']); $i++) {
            $nilai = array(
                'ID_PENILAIAN' => $this->global_m->getIdMax('ID_PENILAIAN', 'TBL_T_PENILAIAN_VENDOR'),
                'ID_IAS' => $id_ias,
                'VARIABEL' => $_POST['variable'][$i],
                'PENILAIAN' => $_POST['penilaian'][$i],
                'BOBOT' => $_POST['vars'][$i]
            );

            $this->ias_mdl->save_penilaian($nilai);
        }

        $this->api_m->insert_ias_orc($this->input->post('id_po'), $id_ias);
        $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
        redirect('procurement/ias/home');
    }

    function insert_ias_orc($ID_PO, $ID_IAS) {
        $response=$this->api_m->insert_ias_orc($ID_PO, $ID_IAS);
        print_r($response);
    }

    public function ajax_GridBudgetCapex() {
        $icolumn = array('ID_PO', 'ID_PR', 'NAMA_BARANG', 'STATUS_CEK', 'status_ke', 'TGL_PR', 'BranchID', 'BRANCH_DESC');
//        $icolumn = array('BudgetID');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );

        if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
            $iwhere = array(
                'TGL_PR <' => date("Y-m-d", strtotime($this->input->post('sMulai'))),
                'TGL_PR >' => date("Y-m-d", strtotime($this->input->post('sSampai')))
            );
        } else {
            $iwhere = array();
        }

        $iorder = array('ID_PR' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_IAS', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();

            $row[] = $idatatables->ID_PR;
            $row[] = $idatatables->TGL_PR;
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = $idatatables->NAMA_BARANG;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->status_ke;
            $row[] = $idatatables->STATUS_CEK;
            $row[] = $idatatables->ID_PO;
            $row[] = '<a href="' . base_url() . 'procurement/ias/ias_form/' . $idatatables->ID_PO . '" class="btn btn-primary">Upload</a>';

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

    public function get_var() {
        $ops = $this->ias_mdl->get_var();
        $ret_val = "<option disabled selected>Pilih Variable</option>";
        foreach ($ops as $op) {
            $ret_val .= "<option value='" . $op->BOBOT . '-' . $op->ID_VNILAI . "'>" . $op->VARIABEL . "</option>";
        }

        echo $ret_val;
    }

    public function readExcel() {
        $config['upload_path'] = "./uploads/";
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = '25000';
        $config['file_name'] = 'BUDGET-' . date('YmdHis');

        $this->load->library('upload', $config);


        if ($this->upload->do_upload("namafile")) {
            $data = $this->upload->data();
            $file = './uploads/' . $data['file_name'];

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
                    $this->ias_mdl->simpan($value["A"], $value["B"], $value["D"], $value["E"], $value["F"]);
                }
            }

            // $this->ias_mdl->simpanData($data);	
        } else {
            $this->session->set_flashdata('msg', $this->upload->display_errors());
        }
        echo json_encode(TRUE);
    }

    public function downloadWord() {
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
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'COA');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'YEAR');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Branch - (Divisi)');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'BranchID');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'DivisionID');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'BudgetValue');

        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'LENGKAPI DATA HANYA DI BAGIAN COA, YEAR DAN BUDGET VALUE');
        $objPHPExcel->getActiveSheet()->setCellValue('I2', 'DILARANG MENGUBAH DATA SELAIN KOLOM YANG DISEBUTKAN DIATAS');

        //make the font become bold
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $data = $this->ias_mdl->allBranch();
        $counter = 2;
        foreach ($data as $key) {

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, " " . $key->coa);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, date("Y"));
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $counter, ((int) $key->BranchCode == 00000) ? $key->BranchName . "-" . $key->DivisionName : $key->BranchName);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $counter, $key->BranchID);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, ((int) $key->BranchCode == 00000) ? $key->DivisionID : " ");
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $counter, "");
            $objPHPExcel->getActiveSheet()->getStyle('A1:A' . $counter)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
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
        $ddBranchTujuan = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0 and DivisionID!=$iAsal");
        $options = "<select id='dd_tf_tujuan' name='tf_tujuan' class='form-control input-sm select2me'>";
        $options .= "<option value=''>-- Select --</option>";
        foreach ($ddBranchTujuan as $k) {
            $options .= "<option  value='" . $k->DivisionID . "'>" . $k->DivisionName . "</option>";
        }
        $options .= "</select>";

        echo json_encode($options);
    }

    public function ddBranch() {
        $ddBranch = $this->ias_mdl->getBranch();
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
        $ddDivisi = $this->ias_mdl->getdivisi($BranchID);
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
        $this->ias_mdl->updatedata($budgetid);

        $result = array('istatus' => true, 'iremarks' => 'Success! budget COA: ' . $COA . ' Success Update data'); //, 'body'=>'Data Berhasil Disimpan');

        echo json_encode($result);
    }

    public function ajax_delete() {
        $id = $this->input->post('sbudgetID');
        $this->ias_mdl->deletedata($id);

        $result = array('istatus' => true, 'iremarks' => 'Success.!'); //, 'body'=>'Data Berhasil Disimpan');

        echo json_encode($result);
    }

    public function ajax_Transfer() {
        $data = array(
            'TANGGAL' => date('Y-m-d', strtotime($this->input->post('tf_tanggal'))),
            'NAMA' => $this->input->post('tf_nama'),
            'POSISI' => $this->input->post('tf_posisi'),
            'BRANCH_DIV_ASAL' => (int) $this->input->post('tf_asal'),
            'BRANCH_DIV_TUJUAN' => (int) $this->input->post('tf_tujuan'),
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
        $icolumn = array('ID_PO', 'ID_PR', 'NAMA_BARANG', 'STATUS_CEK', 'status_ke', 'TGL_PR', 'BranchID', 'BRANCH_DESC');
//        $icolumn = array('BudgetID');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );

        if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
            $iwhere = array(
                'TGL_PR <' => date("Y-m-d", strtotime($this->input->post('sMulai'))),
                'TGL_PR >' => date("Y-m-d", strtotime($this->input->post('sSampai')))
            );
        } else {
            $iwhere = array();
        }

        $iorder = array('ID_PR' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_IAS', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();

            $row[] = $idatatables->ID_PR;
            $row[] = $idatatables->TGL_PR;
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = $idatatables->NAMA_BARANG;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->status_ke;
            $row[] = $idatatables->STATUS_CEK;
            $row[] = $idatatables->ID_PO;
            $row[] = 'Lunas';

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

    //
//    function insert_ias_orc($ID_PO, $ID_IAS) {
//        $this->load->database();
////Link Api
//        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
//        $result = $query->result()[0];
////header insert orc
//        $query2 = $this->db->query("SELECT * FROM VW_IAS_TO_ORC_HEADER WHERE ID_PO=" . $ID_PO);
//        $dataH = $query2->result();
////Parent dari Branch/Division
//        $query3 = $this->db->query("SELECT *,LEFT(BRANCH_DESC,3) AS PARENT FROM TBL_M_DIVISION AS A INNER JOIN TBL_M_BRANCH AS B ON A.PARENT_FLEX = B.FLEX_VALUE WHERE A.FLEX_VALUE='" . $this->session->userdata('DivisionID') . "'"); //
//        $result3 = $query3->result()[0];
////AMOUNT
//        $query4 = $this->db->query("SELECT PPN,NILAI_DIBAYARKAN FROM  TBL_T_IAS WHERE ID_IAS=" . $ID_IAS);
//        $result4 = $query4->result()[0];
////Faktur pajak
//        $query5 = $this->db->query("SELECT NO_DOC FROM TBL_T_IAS_DOC WHERE NAMA_DOC=3 AND ID_IAS=" . $ID_IAS);
//        $result5 = $query5->result()[0];
////        die();
//        $arrData = [];
//        foreach ($dataH as $hdr) {
////detail data insert to orc
////            $query3 = $this->db->query("SELECT * FROM VW_IAS_TO_ORC_DETAIL WHERE ID_PO_=" . $ID_PO . " AND VENDOR_ID=" . $hdr->VendorID);
//            $query3 = $this->db->query("SELECT A.ID AS FAM_ASSET_ID,B.*
//                                        FROM TBL_T_TB_DETAIL as A LEFT JOIN VW_IAS_TO_ORC_DETAIL AS B ON A.ID_PO=B.ID_PO_ AND A.ID_TB=B.ID
//                                        WHERE B.ID_PO_=" . $ID_PO . " AND VENDOR_ID=" . $hdr->VendorID . " order by A.ID"); //
//            $dtl = $query3->result();
//            $PPN = $result4->PPN;
//            $i = 0;
//            $arrDataPPH[] = array(
//                'OPERATING_UNIT' => $result3->BRANCH_DESC,
//                'INVOICE_NUM' => $hdr->ID_PO,
//                'INVOICE_TYPE' => 'STANDARD B',
//                'VENDOR_NAME' => $hdr->VendorName,
//                'VENDOR_SITE_CODE' => $hdr->City,
//                'INVOICE_DATE' => date('Y-m-d h:i:s'),
//                'INVOICE_CURRENCY_CODE' => $hdr->Currency,
//                'INVOICE_AMOUNT' => $result4->NILAI_DIBAYARKAN,
//                'TERMS_NAME' => 'Immediate',
//                'LIABILITY_ACCOUNT' => $dtl[$i]->AccountLiability, //VENDOR 
//                'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
//                'FAKTUR_PAJAK' => $result5->NO_DOC, //
//                'NOMORPO' => 'PO/' . $hdr->ID_PO,
//                'LINE_NUMBER' => COUNT($dtl) + 1,
//                'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
//                'AMOUNT' => $PPN, //$dtl->HARGA, //TAMBAH 1 ROW PPN
//                'AKUN_DISTRIBUSI' => $hdr->COA, //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
//                'LINE_DESCRIPTION' => 'PPN', //NAMA ITEM PPN
//                'ITEM_DESCRIPTION' => '',
//                'ASSET_BOOK_NAME' => 'PNM COMMERCIAL BOOK', //$result3->PARENT . ' COM BOOK', //PAREN COM BOOK
//                'ASSET_CATEGORY' => $dtl[$i]->ClassCode, //ITEM CATEGORY ->ID
//                'JENIS_BARANG' => $dtl[$i]->ItemTypeID, //ITEM TYPE ->ID
//                'UMUR_FISKAL' => $dtl[$i]->umurfiskal, //ITEM CATEGORY 
//                'AMORTIZATION' => '',
//                'FAM_ASSET_ID' => '', // SN
//                'DEFERRED_ACCTG_FLAG' => '',
//                'DEF_ACCTG_START_DATE' => '',
//                'DEF_ACCTG_END_DATE' => '',
//                'SOURCE' => 'INTEGRATION', //DEFAULT
//                'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
//                'FAM_INVOICE_ID' => '',
//                'TGL_PENGAKUAN_BRG' => '',
//                'STATUS' => '',
//                'ERROR_CODE' => '',
//                'ERROR_MESSAGE' => '',
//                'PROCESS_ID' => ''
//            );
////            print_r($iCountDtl);die();
//            for ($i = 0; $i < COUNT($dtl); $i++) {
////                
//                $iLine = $i + 1;
//                $arrData[] = array(
//                    'OPERATING_UNIT' => $result3->BRANCH_DESC,
//                    'INVOICE_NUM' => $hdr->ID_PO,
//                    'INVOICE_TYPE' => 'STANDARD B',
//                    'VENDOR_NAME' => $hdr->VendorName,
//                    'VENDOR_SITE_CODE' => $hdr->City,
//                    'INVOICE_DATE' => date('Y-m-d h:i:s'),
//                    'INVOICE_CURRENCY_CODE' => $hdr->Currency,
//                    'INVOICE_AMOUNT' => $result4->NILAI_DIBAYARKAN,
//                    'TERMS_NAME' => 'Immediate',
//                    'LIABILITY_ACCOUNT' => $dtl[$i]->AccountLiability, //VENDOR 
//                    'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
//                    'FAKTUR_PAJAK' => $result5->NO_DOC, //
//                    'NOMORPO' => 'PO/' . $hdr->ID_PO,
//                    'LINE_NUMBER' => $iLine,
//                    'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
//                    'AMOUNT' => $dtl[$i]->HARGA, //$dtl->HARGA, //TAMBAH 1 ROW PPN
//                    'AKUN_DISTRIBUSI' => $hdr->COA, //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
//                    'LINE_DESCRIPTION' => $dtl[$i]->NAMA_BARANG, //NAMA ITEM
//                    'ITEM_DESCRIPTION' => '',
//                    'ASSET_BOOK_NAME' => 'PNM COMMERCIAL BOOK', //$result3->PARENT . ' COM BOOK', //PAREN COM BOOK
//                    'ASSET_CATEGORY' => $dtl[$i]->ClassCode, //ITEM CATEGORY ->ID
//                    'JENIS_BARANG' => $dtl[$i]->ItemTypeID, //ITEM TYPE ->ID
//                    'UMUR_FISKAL' => $dtl[$i]->umurfiskal, //ITEM CATEGORY 
//                    'AMORTIZATION' => '',
//                    'FAM_ASSET_ID' => $dtl[$i]->FAM_ASSET_ID, // SN
//                    'DEFERRED_ACCTG_FLAG' => '',
//                    'DEF_ACCTG_START_DATE' => '',
//                    'DEF_ACCTG_END_DATE' => '',
//                    'SOURCE' => 'INTEGRATION', //DEFAULT
//                    'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
//                    'FAM_INVOICE_ID' => '',
//                    'TGL_PENGAKUAN_BRG' => '',
//                    'STATUS' => '',
//                    'ERROR_CODE' => '',
//                    'ERROR_MESSAGE' => '',
//                    'PROCESS_ID' => ''
//                );
//            }
//        }
//         array_push($arrData, $arrDataPPH[0]);
////        print_r($arrData);
////        die();
//
//        $data['data'] = $arrData;
//        $curlurl = $result->LINK . "/insert_invoice";
//
//        $ch = curl_init($curlurl);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//        $responsejson = curl_exec($ch);
//        curl_close($ch);
//
//        $response = json_decode($responsejson, true);
//        print_r($response);
//    }
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */