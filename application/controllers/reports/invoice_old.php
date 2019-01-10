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
        $this->template->load('template/template_dataTable', 'reports/invoice/index', $data);
    }

    public function list_report(){
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
            $row[] = $idatatables->CreateDate;
            $row[] = $idatatables->ID_PO;
            $row[] = $idatatables->TTL_HARGA;
            $row[] = $idatatables->VendorName;
            $row[] = $idatatables->TERMIN;
            $row[] = $idatatables->ID_IAS;
            $row[] = $idatatables->NO_DOC;
            $row[] = $idatatables->PERSENTASE;
            $row[] = $idatatables->NILAI_DIBAYARKAN;
            $row[] = $idatatables->TGL_JATUH_TEMPO;
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
        $this->load->helper('download');
        $this->load->library('Excel/phpexcel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('REPORT INVOICE');
        $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Nama Report');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Periode Report');
        $objPHPExcel->getActiveSheet()->setCellValue('B4', '> H+7');
        $objPHPExcel->getActiveSheet()->setCellValue('B5', 'H Sampai H + 7');
        $objPHPExcel->getActiveSheet()->setCellValue('B6', '< H');
        $objPHPExcel->getActiveSheet()->setCellValue('B7', 'Jumlah Request');

        $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Jumlah PO');
        $objPHPExcel->getActiveSheet()->setCellValue('F4', 'Jumlah Inv Vs Termin');
        $objPHPExcel->getActiveSheet()->setCellValue('F5', 'Belum di Inv');
        $objPHPExcel->getActiveSheet()->setCellValue('F6', 'inv terbayar');
        $objPHPExcel->getActiveSheet()->setCellValue('F7', 'inv Belum terbayar');

        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'TANGGAL KIRIM');
        $objPHPExcel->getActiveSheet()->setCellValue('B4', 'VENDOR');
        $objPHPExcel->getActiveSheet()->setCellValue('C3',  date('Y-m-d h:i:s'));
        $objPHPExcel->getActiveSheet()->setCellValue('C4', "test");

        $objPHPExcel->getActiveSheet()->setCellValue('B9', 'NO PR');
        $objPHPExcel->getActiveSheet()->setCellValue('C9', 'Deskripsi');
        $objPHPExcel->getActiveSheet()->setCellValue('D9', 'DIV/CAB');
        $objPHPExcel->getActiveSheet()->setCellValue('E9', 'Nama PIC');
        $objPHPExcel->getActiveSheet()->setCellValue('F9', 'TGL PR');
        $objPHPExcel->getActiveSheet()->setCellValue('G9', 'No PO');
        $objPHPExcel->getActiveSheet()->setCellValue('H9', 'Nilai Po');
        $objPHPExcel->getActiveSheet()->setCellValue('I9', 'Vendor Name');
        $objPHPExcel->getActiveSheet()->setCellValue('J9', 'TERMIN');
        $objPHPExcel->getActiveSheet()->setCellValue('K9', 'NO Inv');
        $objPHPExcel->getActiveSheet()->setCellValue('L9', 'NO IAS');
        $objPHPExcel->getActiveSheet()->setCellValue('M9', '% Persentase');
        $objPHPExcel->getActiveSheet()->setCellValue('N9', 'Nilai Inv');
        $objPHPExcel->getActiveSheet()->setCellValue('O9', 'Batas tanggal Pembayaran');
        $objPHPExcel->getActiveSheet()->setCellValue('P9', 'Status pembayaran');

        ob_end_clean();

        $icolumn = array('RequestID','ProjectName','DivisionID','PIC_PO','CreateDate','ID_PO','TTL_HARGA','VendorName','TERMIN','ID_IAS','NO_DOC','PERSENTASE','NILAI_DIBAYARKAN','TGL_JATUH_TEMPO');
        $ilike = array(
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

        $igroup_by = '';

        $iorder = array();

        $list = $this->datatables_custom->get_datatables('VW_RPT_INV', $icolumn, null, $iwhere, $ilike, $igroup_by);

        $no = 10;
        foreach ($list as $idatatables) {
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $idatatables->RequestID);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$no, $idatatables->ProjectName);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$no, $idatatables->DivisionID);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$no, $idatatables->PIC_PO);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$no, $idatatables->CreateDate);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$no, $idatatables->ID_PO);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$no, $idatatables->TTL_HARGA);
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$no, $idatatables->VendorName);
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$no, $idatatables->TERMIN);

            $objPHPExcel->getActiveSheet()->getStyle('J'.$no)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');

            $objPHPExcel->getActiveSheet()->setCellValue('K'.$no, $idatatables->ID_IAS);
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$no, $idatatables->NO_DOC);
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$no, $idatatables->PERSENTASE);
            $objPHPExcel->getActiveSheet()->setCellValue('N'.$no, $idatatables->NILAI_DIBAYARKAN);
            $objPHPExcel->getActiveSheet()->setCellValue('O'.$no, $idatatables->TGL_JATUH_TEMPO);
            $objPHPExcel->getActiveSheet()->setCellValue('P'.$no, '');
            $no++;
        }

        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Pragma: no-cache");
        header("Expires: 0");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("php://output");
    }

    public function downloadReportPDF() {
        $this->load->helper('download');
        $this->load->library('Excel/phpexcel');

        $objPHPExcel = new PHPExcel();
         $objPHPExcel->setActiveSheetIndex(0);
        //name the worksheet
        $objPHPExcel->getActiveSheet()->setTitle('PR Tiket');

        $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Nama Report');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Periode Report');
        $objPHPExcel->getActiveSheet()->setCellValue('B4', '> H+7');
        $objPHPExcel->getActiveSheet()->setCellValue('B5', 'H Sampai H + 7');
        $objPHPExcel->getActiveSheet()->setCellValue('B6', '< H');
        $objPHPExcel->getActiveSheet()->setCellValue('B7', 'Jumlah Request');

        $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Jumlah PO');
        $objPHPExcel->getActiveSheet()->setCellValue('F4', 'Jumlah Inv Vs Termin');
        $objPHPExcel->getActiveSheet()->setCellValue('F5', 'Belum di Inv');
        $objPHPExcel->getActiveSheet()->setCellValue('F6', 'inv terbayar');
        $objPHPExcel->getActiveSheet()->setCellValue('F7', 'inv Belum terbayar');

        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'TANGGAL KIRIM');
        $objPHPExcel->getActiveSheet()->setCellValue('B4', 'VENDOR');
        $objPHPExcel->getActiveSheet()->setCellValue('C3',  date('Y-m-d h:i:s'));
        $objPHPExcel->getActiveSheet()->setCellValue('C4', "test");

        $objPHPExcel->getActiveSheet()->setCellValue('B9', 'NO PR');
        $objPHPExcel->getActiveSheet()->setCellValue('C9', 'Deskripsi');
        $objPHPExcel->getActiveSheet()->setCellValue('D9', 'DIV/CAB');
        $objPHPExcel->getActiveSheet()->setCellValue('E9', 'Nama PIC');
        $objPHPExcel->getActiveSheet()->setCellValue('F9', 'TGL PR');
        $objPHPExcel->getActiveSheet()->setCellValue('G9', 'No PO');
        $objPHPExcel->getActiveSheet()->setCellValue('H9', 'Nilai Po');
        $objPHPExcel->getActiveSheet()->setCellValue('I9', 'Vendor Name');
        $objPHPExcel->getActiveSheet()->setCellValue('J9', 'TERMIN');
        $objPHPExcel->getActiveSheet()->setCellValue('K9', 'NO Inv');
        $objPHPExcel->getActiveSheet()->setCellValue('L9', 'NO IAS');
        $objPHPExcel->getActiveSheet()->setCellValue('M9', '% Persentase');
        $objPHPExcel->getActiveSheet()->setCellValue('N9', 'Nilai Inv');
        $objPHPExcel->getActiveSheet()->setCellValue('O9', 'Batas tanggal Pembayaran');
        $objPHPExcel->getActiveSheet()->setCellValue('P9', 'Status pembayaran');

        ob_end_clean();

        $icolumn = array('RequestID','ProjectName','DivisionID','PIC_PO','CreateDate','ID_PO','TTL_HARGA','VendorName','TERMIN','ID_IAS','NO_DOC','PERSENTASE','NILAI_DIBAYARKAN','TGL_JATUH_TEMPO');
        $ilike = array(
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

        $igroup_by = '';

        $iorder = array();

        $list = $this->datatables_custom->get_datatables('VW_RPT_INV', $icolumn, null, $iwhere, $ilike, $igroup_by);

        $no = 10;
        foreach ($list as $idatatables) {
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $idatatables->RequestID);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$no, $idatatables->ProjectName);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$no, $idatatables->DivisionID);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$no, $idatatables->PIC_PO);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$no, $idatatables->CreateDate);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$no, $idatatables->ID_PO);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$no, $idatatables->TTL_HARGA);
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$no, $idatatables->VendorName);
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$no, $idatatables->TERMIN);

            $objPHPExcel->getActiveSheet()->getStyle('J'.$no)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');

            $objPHPExcel->getActiveSheet()->setCellValue('K'.$no, $idatatables->ID_IAS);
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$no, $idatatables->NO_DOC);
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$no, $idatatables->PERSENTASE);
            $objPHPExcel->getActiveSheet()->setCellValue('N'.$no, $idatatables->NILAI_DIBAYARKAN);
            $objPHPExcel->getActiveSheet()->setCellValue('O'.$no, $idatatables->TGL_JATUH_TEMPO);
            $objPHPExcel->getActiveSheet()->setCellValue('P'.$no, '');
            $no++;
        }

        $filename = "REPORT_INVOICE.pdf";
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Pragma: no-cache");
        header("Expires: 0");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
        $objWriter->save("php://output");
    }
}
?>