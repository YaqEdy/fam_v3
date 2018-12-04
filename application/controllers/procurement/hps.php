<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Hps extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
//        $this->load->model('zsessions_m');
            $this->load->model('global_m');
            $this->load->model('procurement/hps_mdl', 'hps');
            $this->load->model('datatables_custom');
            $this->load->model('datatables');
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
        $menuId = $this->home_m->get_menu_id('procurement/hps/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data ['ItemID'] = $this->input->post('ItemID', true);
        $data ['Price'] = $this->input->post('Price', true);
        $data ['StartDate'] = $this->input->post('StartDate', true);
        $data ['EndDate'] = $this->input->post('EndDate', true);
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'HPS');
        $this->template->load('template/template_dataTable', 'procurement/hps/hps_v', $data);
    }

    function tampil_data() {
        $id = trim($this->input->post('id', true));
        $sql = "select ItemID, Price, StartDate, EndDate
        FROM Mst_HPS
        WHERE Id='$HpsID'";
        $query = $this->db->query($sql)->result();
        $rows['data_res'] = $query;
        return $this->output->set_output(json_encode($rows));
    }

    public function ajax_GridHPS() {
        $icolumn = array('HpsID', 'ItemName', 'Price', 'StartDate', 'EndDate');
//        $icolumn = array('HpsID');
        $iwhere = array(
                // 'ItemID' => $this->input->post('sItemID'),
                // $this->input->post('sSearch') => $_POST['search']['value']
        );
        $iorder = array('HpsID' => 'asc');
        $list = $this->datatables->get_datatables('VW_M_HPS', $icolumn, $iorder, $iwhere);
        // print_r($list); die ();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->Price;
            $row[] = $idatatables->StartDate;
            $row[] = $idatatables->EndDate;
            $row[] = '<a class="btn btn-xs btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a>'
                    . '<a class="btn btn-xs btn-danger" href="#" id="btnDelete">Delete</a>';
            $row[] = $idatatables->HpsID;
            // $row[] = $idatatables->ZoneID;

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

    public function ddZone() {
        $ddZone = $this->hps->getzone3();
        if ($this->input->get('sParam') == 'A') {
            $options = "<select id='dd_id_zone_A' class='form-control' onclick='onZone(this)'>";
        } else if ($this->input->get('sParam') == 'B') {
            $options = "<select id='dd_id_zone_B' class='form-control'>";
        } else {
            $options = "<select id='dd_id_zone' class='form-control'>";
        }
        $options .= "<option value=''>-- Select --</option>";
        foreach ($ddZone as $k) {
            $options .= "<option  value='" . $k->ZoneID . "'>" . $k->ZoneName . "</option>";
        }
        $options .= "</select>";

        echo json_encode($options);
    }

    public function update_hps() {
        $idhps = $this->input->post('HpsID');
        // $iZone = $this->input->get('sZone');
        $result = $this->hps->updatedata($idhps);

        if ($result == true) {
            $result = array('istatus' => true, 'iremarks' => 'Update! HPS ID: ' . $idhps . ' Success Update data');
        } else {
            $result = array('istatus' => false, 'iremarks' => 'Failed! HPS ID: ' . $idhps . 'Failed Update data');
        }
        echo json_encode($result);
    }

    public function ajax_Delete() {
        $id = $this->input->post('sID');
        // print_r($id); die();
        $result = $this->hps->deletedata($id);

//        $this->session->set_flashdata('msg', 'Success! HPS ID: ' . $id . ' Success Delete data');
        if ($result == true) {
            $result = array('istatus' => true, 'iremarks' => 'Success! HPS ID: ' . $id . ' Success Delete data');
        } else {
            $result = array('istatus' => false, 'iremarks' => 'Failed! HPS ID: ' . $id . 'Failed Delete data');
        }
        echo json_encode($result);
    }

    public function branch() {
        $ddZone = $this->hps->getzone3();
        if ($this->input->get('branch') == 'A') {
            $options = "<input id='branch' class='form-control' >";
        } else if ($this->input->get('branch') == 'B') {
            $options = "<input id='branch' class='form-control'>";
        } else {
            $options = "<input id='branch' class='form-control'>";
        }
        $options .= "<input value=''></input>";
        foreach ($ddZone as $k) {
            $options .= "<option  value='" . $k->ZoneID . "'>" . $k->ZoneName . "</option>";
        }
        $options .= "</input>";

        echo json_encode($options);
    }

    public function readExcela() {
        $config['upload_path'] = "./uploads/hps/";
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = '0';
        $config['file_name'] = 'HPS-' . date('YmdHis');

        $this->load->library('upload', $config);


        if ($this->upload->do_upload("namafile")) {
            $data = $this->upload->data();
            $file = './uploads/hps/' . $data['file_name'];

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
//                if ($row == 1) {
//                    $header[$row][$column] = $data_value;
//                } else {
//                    $arr_data[$row][$column] = $data_value;
//                }
            }
            // BudgetCOA, Year, BranchID, BisUnitID, DivisionID, BudgetValue, CreateDate, CreateBy, BudgetOwnID, BudgetUsed, Status, Is_trash
            $date = date('Y-m-d');
            $by = $this->session->userdata('id_user');
            // $zone = $this->input->get('sZone');
            // print_r($arr_data );die();

            foreach ($arr_data as $key => $value) {
                // print_r($value['E'] );die();
                // if ($value["E"] != '-' && !empty($value["E"])) {
                // $this->hps->simpanData($zone, $value['A'],  $value['B'],  $value['C'],  $value['D'],  $value['E'] );
                if (PHPExcel_Shared_Date::ExcelToPHP($value["E"]) < 0) {
                    // $this->hps->simpanData( $value['A'], $value['B'], $value['C'], $value['D'], $value['E']);
                } else {
                    $this->hps->simpanData($value["A"], $value["B"], date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value["C"])), date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value["D"])), $value["E"]);
                }
                // }
            }

            // $this->hps->simpanData($data);	
        } else {
            $this->session->set_flashdata('msg', $this->upload->display_errors());
        }
        echo json_encode(TRUE);
    }

    public function readExcel() {
        $config['upload_path'] = "./uploads/hps/";
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = '0';
        $config['file_name'] = 'HPS-' . date('YmdHis');

        $this->load->library('upload', $config);


        if ($this->upload->do_upload("namafile")) {
            $data = $this->upload->data();
            $file = './uploads/hps/' . $data['file_name'];

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
                if (!empty($value["E"]) && $value["E"] != "-" && $value["E"] != "") {
                    $this->hps->simpanData($value["A"], $value["B"], date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value["C"])), date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value["D"])), $value["E"], $value["F"]);
                }
            }

            // $this->Budget_mdl->simpanData($data);    
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
        $objPHPExcel->getActiveSheet()->setTitle('hps worksheet');

        // $users = (array)$users[0];
        //set cell A1 content with some text
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'ITEM ID');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'ITEM NAME');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'START DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'END DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'HARGA');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'ZONA');

        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'HANYA DI PERBOLEHKAN MENGUBAH START DATE, END DATE DAN HARGA. JIKA TIDAK ADA HARGA, BIARKAN DI ISI DENGAN ANGKA NOL (0)');
        $objPHPExcel->getActiveSheet()->setCellValue('H2', 'MENU HPS HANYA UNTUK UPDATE HARGA, TIDAK UNTUK MENAMBAH ITEM MASTER');
        $objPHPExcel->getActiveSheet()->setCellValue('H3', 'UNTUK START & END DATE, GUNAKAN FORMAT TEXT');
        $objPHPExcel->getActiveSheet()->setCellValue('H4', 'UNTUK START & END DATE, FORMATNYA (YYYY-MM-DD) CONTOH = 1945-08-17');
        $objPHPExcel->getActiveSheet()->setCellValue('H5', 'Untuk Zona Diisi "ID"(Pilih ID Sesuai NAMA ZONA) DIBAWAH Ini');

        //SAMPLE ZONASI
        $zona = $this->global_m->tampil_data('SELECT ZoneID,ZoneName FROM Mst_Zonasi');
        $counter_ = 6;
        foreach ($zona as $key) {
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $counter_, 'ID='. $key->ZoneID . ' | NAMA=' . $key->ZoneName);
            $counter_++;
        }

        //make the font become bold
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);

        $data = $this->hps->getAllItem();
        $counter = 2;
        foreach ($data as $key) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $key->ItemID);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, $key->ItemName);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, '-');
            $counter++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('C1:C' . $counter)->getNumberFormat()->setFormatCode('#,##0.00');
        $objPHPExcel->getActiveSheet()->getStyle('D1:D' . $counter)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->getStyle('E1:E' . $counter)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

        ob_end_clean();
        //Header
        $filename = "list_item.xlsx";
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

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */