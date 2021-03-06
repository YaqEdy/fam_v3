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
            $this->load->model('api/api_m');
            $this->load->model('datatables_custom');
            $this->load->model('datatables');
        }
    }

    function get_kehilangan() {
        $idt = '100000,100001';
        $idt = explode(',', $idt);
        print_r($this->api_m->get_kehilangan($idt));
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
        $menuId = $this->home_m->get_menu_id('procurement/ias/home');
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

    function ias_form($id_detail) {
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

        $menuId = $this->home_m->get_menu_id('procurement/ias/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        // $id = $this->ias_mdl->get_termin($id_termin);
        $get_ias = $this->ias_mdl->get_all_ias($id_detail);
        $data['dpp'] = $this->ias_mdl->get_dpp($id_detail);
        $data['ppn'] = $this->ias_mdl->get_ppn($id_detail);
        $data['pph'] = $this->ias_mdl->get_pph($id_detail);
        $data['persen_ppn'] = $this->ias_mdl->get_persen_ppn($id_detail);
        $data['quant'] = $this->ias_mdl->get_quant($id_detail);
        $data['po_dtl'] = $this->ias_mdl->get_po_dtl($id_detail);
        $data['detail'] = $this->cek_barang_mdl->get_detail($id_detail);
        $data['barang'] = $this->cek_barang_mdl->get_one_barang($id_detail);
        $data['ias'] = $this->ias_mdl->get_ias($data['detail']->ID_PO);
//        print_r($data['ias']);die();
        $all_termin = $this->ias_mdl->get_all_termin($id_detail);
        // var_dump($data['quant']->quant.' '.$data['dpp']->TTL_QTY);exit();
        if ((count($all_termin) - 1) == count($get_ias)) {
            $data['last_termin'] = '1';
        }

        if (count($get_ias) >= count($all_termin)) {
            $data['done_termin'] = '1';
        }

        $data['all_item'] = $this->cek_barang_mdl->get_all_barang($id_detail);
        $jt_barang = new DateTime($this->cek_barang_mdl->get_termin($data['detail']->ID_PO)->TGL_JT_TERIMA_BRG);
        $jt_po = new DateTime($data['barang']->TGL_TERIMA);
        $diff = $jt_barang->diff($jt_po);
        $total = $data['detail']->TTL_HARGA;
        $data['total'] = intval((1 / 1000) * $total * $diff->days);
        // for ($i=0; $i < $id->TERMIN; $i++) { 
        //     $persen += $all_termin[$i]->PERSENTASE;
        // }
        // $data['persen'] = ceil($data['dpp']->TTL_QTY);
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
        $id_po_detail = $this->input->post('id_po_detail');
        $head['ID_IAS'] = $id_ias;
//        $head['NO_PA'] = $this->input->post('id_pa');
        $head['TERMIN'] = $this->global_m->tampil_data("SELECT COUNT(ID_PO_DETAIL)+1 TERMIN FROM TBL_T_IAS WHERE ID_PO_DETAIL=".$id_po_detail)[0]->TERMIN;
        $head['ID_PO_DETAIL'] = $id_po_detail;
        $head['DPP'] = str_replace(',', '',$this->input->post('dpp'));
        $head['PPN'] = str_replace(',', '',$this->input->post('ppn'));
        $head['PERSEN_PPN'] = $this->input->post('presentase');
        $head['PPH'] = str_replace(',', '',$this->input->post('pph'));
        $head['DENDA'] = str_replace(',', '',$this->input->post('denda'));
        $head['NILAI_DIBAYARKAN'] = str_replace(',', '',$this->input->post('dibayarkan'));
        $head['CREATE_BY'] = $this->session->userdata('user_id');
        $head['CREATE_DATE'] = date('Y-m-d H:i:s');
//        $head['NILAI_VENDOR'] = $this->input->post('akhir');
        if ($_FILES["dok"]['name'] != NULL) {
            $new_name = time() . $_FILES["dok"]['name'];
            $config = array(
                'upload_path' => "./uploads/doc/",
                'allowed_types' => "zip|rar",
                'file_name' => $new_name,
                'overwrite' => TRUE,
            );
            $upload = $this->load->library('upload', $config);
            if ($this->upload->do_upload('dok')) {
                $head['DOC_PATH'] = 'uploads/doc/' . $new_name;
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('procurement/ias/home');
            }
        }
        $insert_ias=$this->ias_mdl->save_ias($head);

        for ($i = 0; $i < count($_POST['nama_dokumen']); $i++) {
            $doc = array(
                'ID' => $this->global_m->getIdMax('ID', 'TBL_T_IAS_DOC'),
                'ID_IAS' => $id_ias,
                'NAMA_DOC' => $_POST['nama_dokumen'][$i],
                'NO_DOC' => $_POST['no_dokumen'][$i],
                'TGL' => DateTime::createFromFormat('d/m/Y', $_POST['tanggal'][$i])->format('Y-m-d'),
                'CREATE_BY' => $this->session->userdata('user_id'),
                'CREATE_DATE' => date('Y-m-d H:i:s')
            );

            $this->ias_mdl->save_ias_doc($doc);
        }

//        for ($i=0; $i < count($_POST['varia']); $i++) {
//            $nilai = array(
//                            'ID_PENILAIAN' => $this->global_m->getIdMax('ID_PENILAIAN','TBL_T_PENILAIAN_VENDOR'),
//                            'ID_IAS' => $id_ias,
//                            'VARIABEL' => $_POST['variable'][$i],
//                            'PENILAIAN' => $_POST['penilaian'][$i],
//                            'BOBOT' => $_POST['vars'][$i]
//                            );
//
//            $this->ias_mdl->save_penilaian($nilai);
//        }
        $integrasi = $this->global_m->tampil_data("SELECT INTEGRASI_ORACLE FROM VW_IAS_GRID WHERE ID_PO_DETAIL=".$id_po_detail)[0]->INTEGRASI_ORACLE;
        if($insert_ias && $integrasi==1){
            $this->insert_ias_orc($this->input->post('id_po'), $id_ias, $this->input->post('id_po_detail'));
        }
        $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
        redirect('procurement/ias/home');
    }

    function insert_ias_orc($ID_PO, $ID_IAS, $ID_PO_DETAIL) {
        $this->api_m->insert_ias_orc($ID_PO, $ID_IAS, $ID_PO_DETAIL);
    }

    public function ajax_GridBudgetCapex() {
        $icolumn = array( 'ID_PR', 'TGL_PR','ID_PO', 'ID_PO_DETAIL','INTEGRASI_ORACLE','NILAI','ACT_TERMIN');
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

        $igroup_by = 'ID_PO_DETAIL';

        $iorder = array('ID_PO' => 'ASC');
        $list = $this->datatables_custom->get_datatables('VW_IAS_GRID', $icolumn, $iorder, $iwhere, $ilike, $igroup_by);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            $termin = $this->ias_mdl->count_termin($idatatables->ID_PO_DETAIL);

            $no++;
            $row = array();

            $row[] = $idatatables->ID_PR;
            $row[] = $idatatables->ID_PO_DETAIL;
            $row[] = $termin->jml;
            $row[] = $idatatables->ACT_TERMIN;
            $row[] = $this->get_status_ias($idatatables->ID_PO_DETAIL, 'VALIDATED');
            $row[] = $this->get_status_ias($idatatables->ID_PO_DETAIL, 'FULLY APPLIED');
            $row[] = $this->get_status_ias($idatatables->ID_PO_DETAIL, 'CANCELLED');

            if($idatatables->INTEGRASI_ORACLE == '0' && $idatatables->ACT_TERMIN==0){
                $row[] = "<select class='form-control' onchange='update(this.value, ". $idatatables->ID_PO_DETAIL.",". $idatatables->ID_PO.")'>
                <option value='0' selected>TIDAK</option>
                <option value='1'>YA</option></select>";
            } else if($idatatables->INTEGRASI_ORACLE == '1' && $idatatables->ACT_TERMIN==0){
                $row[] = "<select class='form-control' onchange='update(this.value, ". $idatatables->ID_PO_DETAIL.",". $idatatables->ID_PO.")'>
                <option value='0'>TIDAK</option>
                <option value='1' selected>YA</option></select>";
            }else if( $idatatables->ACT_TERMIN>0){
				if($idatatables->INTEGRASI_ORACLE==1){
					 $row[] = "<select class='form-control' onchange='update(this.value, ". $idatatables->ID_PO_DETAIL.",". $idatatables->ID_PO.")' disabled>
					<option value='0'>TIDAK</option>
					<option value='1' selected>YA</option></select>";
				}else{
					 $row[] = "<select class='form-control' onchange='update(this.value, ". $idatatables->ID_PO_DETAIL.",". $idatatables->ID_PO.")' disabled>
					<option value='0' selected>TIDAK</option>
					<option value='1'>YA</option></select>";
				}
				
			}

            if($idatatables->NILAI >= $termin->jml){
                $row[] = '<a href="#" class="btn btn-primary" disabled>Upload</a> <a href="javascript:void(0)" title="Edit" onclick="History(' . $idatatables->ID_PO_DETAIL . ')" class="btn btn-primary">History</a>'.'
                <a <div class="col-md-15">
                            <div class="form-group">
                            <div class="col-sm-20">
                            <select  onchange="generate_rpt(this.value);"
                            name="rpt" class="form-control" 
                            id="id_rpt">
                            <option value="">--Pilih--</option>

                            <option value="'. base_url() . 'procurement/ias/report_fam/'.$idatatables->ID_PR.'">PR</option>
                            <option value="'. base_url() . 'procurement/ias/cetak_pa/'.$idatatables->ID_PR.'">PA</option>
                            <option value="'. base_url() . 'procurement/ias/cetak_po/'.$idatatables->ID_PO_DETAIL.'">PO</option>
                            <option value="'. base_url() . 'procurement/ias/ctk_slip/'.$idatatables->ID_PO_DETAIL.'">Routing Slip</option>  
                        </select>
                    </div>
                </div>
            </div>
            </a>';
                // .'<a href="' . base_url() . 'procurement/ias/ctk_slip/'.$idatatables->ID_PO_DETAIL.'" class="btn btn-primary" target="_blank">Cetak Slip</a>'
                ;
            } else {
                $row[] = '<a href="' . base_url() . 'procurement/ias/ias_form/' . $idatatables->ID_PO_DETAIL . '" class="btn btn-primary">Upload</a>'
                . '<a href="javascript:void(0)" title="Edit" onclick="History(' . $idatatables->ID_PO_DETAIL . ')" class="btn btn-primary">History</a>'.'
                <a <div class="col-md-15">
                            <div class="form-group">
                            <div class="col-sm-20">
                            <select  onchange="generate_rpt(this.value);"
                            name="rpt" class="form-control" 
                            id="id_rpt">
                            <option value="">--Pilih--</option>

                            <option value="'. base_url() . 'procurement/ias/report_fam/'.$idatatables->ID_PR.'">PR</option>
                            <option value="'. base_url() . 'procurement/ias/cetak_pa/'.$idatatables->ID_PR.'">PA</option>
                            <option value="'. base_url() . 'procurement/ias/cetak_po/'.$idatatables->ID_PO_DETAIL.'">PO</option>
                            <option value="'. base_url() . 'procurement/ias/ctk_slip/'.$idatatables->ID_PO_DETAIL.'">Routing Slip</option>  
                        </select>
                    </div>
                </div>
            </div>
            </a>';;
            }

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


      public function report_fam($idAssets) {

        // $idAssets = $this->input->get('');
        // print_r($idAssets); die();
        $data['qr_code'] = $this->global_m->tampil_data("SELECT * FROM VW_G_PR WHERE RequestID = " . $idAssets . "");    
        // print_r($data); 
        // exit();x
        $this->load->view('procurement/generate_rpt/laporan_inv_v',$data);
    }

    public function cetak_pa($idAssets) {
         // die('asd');

    // $data['cetak_pa1'] = $this->ias_mdl->get_cetak_pa($id);
    $data['cetak_pa1'] = $this->global_m->tampil_data("SELECT * FROM VW_G_PA WHERE RequestID = " . $idAssets . "");  
    // echo "<pre>";
    // print_r($data); die(); 
    // echo $this->db->last_query(); die('');
    $this->load->view('procurement/generate_rpt_pa_v/cetak_rpt_pa_v',$data);
    }


    public function ctk_slip($idAssets) {

         $data['cetak_slip'] = $this->global_m->tampil_data("SELECT * FROM VW_G_ROUTING_SLIP WHERE ID_PO_DETAIL = " . $idAssets . "ORDER BY [order]");  
        // print_r($data);die();
         // echo $this->db->last_query(); die('');
        $this->load->view('procurement/routing_slip/ctk_slip',$data);
    }

      public function cetak_po($idAssets) {

         $data['cetak_po_1'] = $this->global_m->tampil_data("SELECT * FROM VW_IAS_TO_ORC_DETAIL WHERE ID_PO_DETAIL = " . $idAssets . "");  
        // echo $this->db->last_query(); die('');
        $this->load->view('procurement/po/cetak_po',$data);
    }

    public function ajax_Updateias() {
        $id_po_detail = $this->input->post('iID_PO_DETAIL');
        $status = $this->input->post('status');
        $id_po = $this->input->post('iID_PO');
        $this->ias_mdl->updatedatadetailpo($id_po_detail,$status,$id_po);
    $result = array('istatus' => true, 'iremarks' => 'Success! Detail PO: ' . $id_po_detail . ' Success Update data'); //, 'body'=>'Data Berhasil Disimpan');
    echo json_encode($result);
}

function get_status_ias($ID_PO_DETAIL, $STATUS) {
//    $STATUS='VALIDATED';
//    $ID_PO_DETAIL = 'PO1823';
//        print_r($this->api_m->get_status_ias($ID_PO_DETAIL,$STATUS));die();
    return $this->api_m->get_status_ias($ID_PO_DETAIL, $STATUS);
}

public function get_sn($id_tb, $id_po) {
    $data = $this->cek_barang_mdl->get_sn($id_tb, $id_po);

    echo json_encode($data);
}

public function ajax_GridHistory() {
    $icolumn = array( 'ID_PR','ID_IAS', 'ID_PO_DETAIL', 'TERMIN', 'VendorName', 'DPP', 'PPN', 'PPH', 'DENDA', 'NILAI_DIBAYARKAN');
    $iwhere = array(
        'ID_PO_DETAIL' => $this->input->post('sID_PO_DETAIL')
    );
    $iorder = array('ID_PR' => 'asc');
    $list = $this->datatables->get_datatables('VW_IAS_HISTORY', $icolumn, $iorder, $iwhere);

    $data = array();
    $no = $_POST['start'];
    foreach ($list as $idatatables) {

        $no++;
        $row = array();
//            $row[] = $no;

        $row[] = $idatatables->ID_PR;
        $row[] = $idatatables->ID_PO_DETAIL;
        $row[] = $idatatables->TERMIN;
        $row[] = $idatatables->VendorName;
        $row[] = 'Rp.'.number_format(($idatatables->DPP),2);
        $row[] = 'Rp.'.number_format(($idatatables->PPN),2);
        $row[] = 'Rp.'.number_format(($idatatables->PPH),2);
        $row[] = 'Rp.'.number_format(($idatatables->DENDA),2);
        $row[] = 'Rp.'.number_format(($idatatables->NILAI_DIBAYARKAN),2);$idatatables->NILAI_DIBAYARKAN;
        $row[] = '<a href="' . base_url() . 'procurement/ias/cetak_ias/'.$idatatables->ID_IAS.'" class="btn btn-primary" target="_blank">Cetak</a>';
//            $row[] = $idatatables->DOC_PATH;

        $data[] = $row;
    }

    $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => $this->datatables->count_all(),
        "recordsFiltered" => $this->datatables->count_filtered(),
        "data" => $data,
    );
        //output to json format
    echo json_encode($output);
}

public function cetak_ias($id) {
    // die($id);
    $data['tes'] = $this->ias_mdl->get_cetak_ias($id);
     // print_r($data); die();
    // echo $this->db->last_query(); die('');
    $this->load->view('procurement/ias/cetak_ias',$data);
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

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */