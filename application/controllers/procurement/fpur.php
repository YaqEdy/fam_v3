<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Fpur extends CI_Controller {

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
            $this->load->model('procurement/fpur_mdl');
            $this->load->model('api/api_m');
            $this->load->model('datatables_custom');
        }
    }

    public function index(){
    	$menuId = $this->home_m->get_menu_id('procurement/fpur');
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
        $data['fpum'] = $this->fpur_mdl->get_vm_fpur();
        $data['my_fpur_fpum'] = $this->fpur_mdl->get_my_fpur_fpum();
        
    	$this->template->set('title', 'IAS');
        $this->template->load('template/template_dataTable', 'procurement/fpur/fpur', $data);
    }

    public function ajax_table_fpur() {
        $icolumn = array('RequestID', 'Tgl_Req', 'ReqTypeName', 'HargaHPS', 'Kelengkapan', 'Jns_pengadaan', 'Tipe_pembayaran');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );

        if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
            $iwhere = array(
                'Tgl_Req <' => date("Y-m-d", strtotime($this->input->post('sMulai'))),
                'Tgl_Req >' => date("Y-m-d", strtotime($this->input->post('sSampai')))
            );
        }else{
            $iwhere = array();
        }
        // print_r($iwhere); die();
        $iorder = array('RequestID' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_PR_FPUR_FPUM', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();

            $row[] = $idatatables->RequestID;
            $row[] = $idatatables->Tgl_Req;
            $row[] = $idatatables->ReqTypeName;
            $row[] = $idatatables->HargaHPS;
            $row[] = $idatatables->Kelengkapan;
            $row[] = $idatatables->Jns_pengadaan;
            $row[] = $idatatables->Tipe_pembayaran;
            $row[] = ' 

            <button value="'.$idatatables->RequestID.'" id="idAddSetting" onclick="add_fpur(this.value)" class="btn btn-primary" data-toggle="modal" data-target="#mdl_fpur">Add FPUR</button>
            ';
            // <a href="'.base_url().'procurement/fpur/detail_fpur/'.$idatatables->RequestID.'" class="btn btn-primary">VIEW</a>

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


    public function ajax_table_fpum() {
      
        $list = $this->datatables_custom->get_vm_fpur();
        // print_r($list[0]); die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables => $idatatable) {

            $no++;
            $row = array();

            $row[] = $idatatable->RequestID;
            $row[] = $idatatable->Tgl_Req;
            $row[] = $idatatable->ReqTypeName;
            $row[] = $idatatable->HargaHPS;
            $row[] = $idatatable->Kelengkapan;
            $row[] = $idatatable->Jns_pengadaan;
            $row[] = $idatatable->Tipe_pembayaran;
            $row[] = ' 
            <button class="btn btn-primary" data-toggle="modal" data-target="#mdl_fpum">Add FPUM</button>
            <a href="'.base_url().'procurement/fpur/detail_fpur/'.$idatatable->RequestID.'" class="btn btn-primary">VIEW</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            // "recordsTotal" => $this->datatables_custom->count_all(),
            // "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_fpum_() {
        $icolumn = array('ID_PO', 'ID_PR', 'NAMA_BARANG', 'STATUS_CEK', 'status_ke', 'TGL_PR', 'BranchID', 'BRANCH_DESC');
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

        $iorder = array('ID_PR' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_IAS', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();

            $row[] = $idatatables->ID_PR;
            $row[] = $idatatables->ID_PO;
            $row[] = $idatatables->TGL_PR;
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = $idatatables->NAMA_BARANG;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->status_ke;
            $row[] = $idatatables->STATUS_CEK;
            $row[] = '<a href="'.base_url().'procurement/fpur/detail_fpum/'.$idatatables->ID_PO.'" class="btn btn-primary">VIEW</a>';

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

    public function input_fpur(){
        $this->template->set('title', 'FORM FPUR');
        $this->template->load('template/template_dataTable', 'procurement/fpur/input_fpur');
        
    }
    public function detail_fpur($id_detail){
        
    	$ops = $this->ias_mdl->get_var();
        $ret_val = "<option disabled selected>Pilih Variable</option>";
        foreach ($ops as $op) {
            $ret_val .= "<option value='".$op->BOBOT."-".$op->ID_VNILAI."'>".$op->VARIABEL."</option>";
        }
        $data['var'] = $ret_val;

        $ndoc = $this->ias_mdl->get_doc();
        $doc_val = "<option disabled selected>Pilih Dokumen</option>";
        foreach ($ndoc as $doc) {
            $doc_val .= "<option value='".$doc->ID_DOC."'>".$doc->NAMA_DOC."</option>";
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
        $get_ias = $this->ias_mdl->get_all_ias($id_detail);
        $data['dpp'] = $this->ias_mdl->get_dpp($id_detail);
        $data['quant'] = $this->ias_mdl->get_quant($id_detail);
        $data['detail'] = $this->cek_barang_mdl->get_detail($id_detail);
        $data['barang'] = $this->cek_barang_mdl->get_one_barang($id_detail);
        $data['ias'] = $this->ias_mdl->get_ias($data['detail']->ID_PO);
        // $data['ias'] = $this->fpur_mdl->get_fpur($data['detail']->RequestID);
        $all_termin = $this->ias_mdl->get_all_termin($id_detail);
        if ((count($all_termin)-1) == count($get_ias)) {
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
        $data['total'] = intval((1/1000)*$total*$diff->days);
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");

        $this->template->set('title', 'FORM FPUR');
        $this->template->load('template/template_dataTable', 'procurement/fpur/detail_fpur', $data);
    }

    public function detail_fpum($id_detail){
    	 $ops = $this->ias_mdl->get_var();
        $ret_val = "<option disabled selected>Pilih Variable</option>";
        foreach ($ops as $op) {
            $ret_val .= "<option value='".$op->BOBOT."-".$op->ID_VNILAI."'>".$op->VARIABEL."</option>";
        }
        $data['var'] = $ret_val;

        $ndoc = $this->ias_mdl->get_doc();
        $doc_val = "<option disabled selected>Pilih Dokumen</option>";
        foreach ($ndoc as $doc) {
            $doc_val .= "<option value='".$doc->ID_DOC."'>".$doc->NAMA_DOC."</option>";
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
        $get_ias = $this->ias_mdl->get_all_ias($id_detail);
        $data['dpp'] = $this->ias_mdl->get_dpp($id_detail);
        $data['quant'] = $this->ias_mdl->get_quant($id_detail);
        $data['detail'] = $this->cek_barang_mdl->get_detail($id_detail);
        $data['barang'] = $this->cek_barang_mdl->get_one_barang($id_detail);
        $data['ias'] = $this->ias_mdl->get_ias($data['detail']->ID_PO);
        $all_termin = $this->ias_mdl->get_all_termin($id_detail);
        if ((count($all_termin)-1) == count($get_ias)) {
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
        $data['total'] = intval((1/1000)*$total*$diff->days);
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");

        $this->template->set('title', 'FORM FPUM');
        $this->template->load('template/template_dataTable', 'procurement/fpur/detail_fpum', $data);
    }


    public function update_fpur($id){
		$head['TYPE_FPUR'] = $this->input->post("type_fpur");
		$head['NO_FPUR'] = $this->input->post("no_fpur");
		$head['JML'] = $this->input->post("jumlah");
		$head['NAMA_REK'] = $this->input->post("nama_rekening");
		$head['NO_REK'] = $this->input->post("no_rekening");
		$head['NAMA_BANK'] = $this->input->post("bank");
		$head['ALAMAT_BANK'] = $this->input->post("alamat_bank");
		$head['DOC_FPUR_PATH'] = $this->input->post("dokumen_kelengkapan");
    	$this->fpur_mdl->save_fpur($head);
    	redirect('procurement/fpur/');
    }

     public function update_fpum(){
    	$head['TYPE_FPUR'] = $this->input->post("type_fpur");
		$head['NO_FPUR'] = $this->input->post("no_fpur");
		$head['JML'] = $this->input->post("jumlah");
		$head['NAMA_REK'] = $this->input->post("nama_rekening");
		$head['NO_REK'] = $this->input->post("no_rekening");
		$head['NAMA_BANK'] = $this->input->post("bank");
		$head['ALAMAT_BANK'] = $this->input->post("alamat_bank");
		$head['DOC_FPUR_PATH'] = $this->input->post("dokumen_kelengkapan");
    	$id_pfur = $this->fpur_mdl->save_fpur($head);

    	$head_fpum['ID_FPUR'] = $id_pfur;
    	$head_fpum['NO_FPUM'] = $this->input->post("no_fpum");
    	$head_fpum['KET_JML'] = $this->input->post("ket_jumlah_fpum");
    	$head_fpum['JUMLAH'] = $this->input->post("jumlah_fpum");
    	$head_fpum['DOC_FPUM_PATH'] = $this->input->post("dokumen_kelengkapan_fpum");
    	$this->fpur_mdl->save_fpum($head_fpum);
    	redirect('procurement/fpur/');
    }

    //Math 24.11.2018
    public function save_fpur(){
        
//         die('in');
        $head['ID_PR'] = $this->input->post("id_pr");
        $head['TYPE_FPUR'] = $this->input->post("type_fpur");
        $head['NO_FPUR'] = $this->input->post("no_fpur");
        $head['JML'] = $this->input->post("jml");
        $head['NAMA_REK'] = $this->input->post("nm_rekening");
        $head['NO_REK'] = $this->input->post("no_rekening");
        $head['NAMA_BANK'] = $this->input->post("bank");
        $head['ALAMAT_BANK'] = $this->input->post("alamat_bank");
        $head['DOC_FPUR_PATH'] = $this->input->post("doc_kelengkapan");
        // print_r($_POST); die();

        $name_file_up = $_FILES['doc_kelengkapan']['name'];
        $ext_file_up = strtoupper(end((explode(".", $name_file_up))));
        // die($ext_file_up);
        if (empty($name_file_up)) {
                               // print_r('tes'); die();
        // } else if ($ext_file_up !== 'ZIP' && $ext_file_up !== 'RAR') {
        //     print_r('Kosong'); die();
        //     $istatus = false;
        //     $iremarks = 'FAID! Eksistensi File tidak diizinkan !. Harus Zip atau Rar !';
//                    $this->session->set_flashdata('math', 'FAID! Eksistensi File tidak diizinkan !. Harus Zip atau Rar !');
            //echo "Eksistensi File tidak diizinkan !. Harus Zip atau Rar !";
//                    redirect('requestproc_tab');
        } else {
            // print_r('ada'); die();
            $config['upload_path'] = "./uploads/fpur/";
            $config['allowed_types'] = '*';
            $config['max_size'] = '0';
//                                die($config);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("doc_kelengkapan")) {
                // print_r('1'); die();
                $error = array('array' => $this->upload->display_errors());
                $data = $this->upload->data();
                $source = "./uploads/fpur/" . $data['file_name'];
                chmod($source, 0777);
                $paydata = $data['file_name'];
            } else {
                // print_r('2'); die();
                $istatus = false;
                $iremarks = $this->upload->display_errors();
            }
        }
        $result = $this->fpur_mdl->save_fpur($head);
        if ($result) {
            $result = array('istatus' => true, 'type' => 'success', 'iremarks' => 'Transfer Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
             $result = array('istatus' => false, 'type' => 'error', 'iremarks' => 'Transfer Gagal.!'); //, 'body'=>'Data Berhasil Disimpan');
        }

        redirect('procurement/fpur/',$result);
        
    }

    public function get_fpur($idfpur){
       $data = $this->global_m->tampil_data("SELECT * FROM TBL_T_FPUR where ID_FPUR='$idfpur'");
       foreach ($data as $value) {
            $fpur='<input type="text" name="id_fpur" id="id_pr" value="'.$value->ID_FPUR.'" class="form-control hidden">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Type FPUR</label>
                        <div class="col-sm-7">
                            <input type="radio" name="type_fpur" value="1"> Reimbursement &nbsp;
                            <input type="radio" name="type_fpur" value="2" checked="checked"> UM-FPUR 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">No. FPUR</label>
                        <div class="col-sm-7">
                            <input type="text" name="no_fpur" value="'.$value->NO_FPUR.'" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Jumlah</label>
                        <div class="col-sm-7">
                            <input type="text" name="jml" value="'.$value->JML.'" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Nama Rekening</label>
                        <div class="col-sm-7">
                            <input type="text" name="nm_rekening" value="'.$value->NAMA_REK.'" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">No. Rekening</label>
                        <div class="col-sm-7">
                            <input type="text" name="no_rekening" value="'.$value->NO_REK.'" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Bank</label>
                        <div class="col-sm-7">
                            <input type="text" name="bank" value="'.$value->NAMA_BANK.'" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Alamat bank</label>
                        <div class="col-sm-7">
                            <textarea name="alamat_bank" class="form-control">'.$value->ALAMAT_BANK.'</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-3">Document Kelengkapan</label>
                         <label class="control-label col-sm-5">'.$value->DOC_FPUR_PATH.'</label>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success"><i class="fa fa-eye style="font-size:3px""></i></button>
                        </div>
                    </div>
                    <label class="control-label">
                        <center>-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</center>       
                    </label>
                    <div class="form-group">
                        <label class="control-label col-sm-3">No. FPUM</label>
                        <div class="col-sm-7">
                            <label class="control-label">'.$value->NO_FPUR.'</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Jumlah Petanggungan</label>
                        <div class="col-sm-7">
                            <label class="control-label">'.$value->JML.'</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Keterangan</label>
                        <div class="col-sm-7">
                            <input type="radio" name="ket" value="k"> Kurang &nbsp;
                            <input type="radio" name="ket" value="l"> Lebih &nbsp;
                            <input type="radio" name="ket" value="s"> Sama
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Jumlah Lebih / Kurang</label>
                        <div class="col-sm-7">
                            <input type="number" name="jml_l_k" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Document Kelengkapan</label>
                        <div class="col-sm-7">
                            <input type="file" name="doc_kel_fpum" class="form-control">
                        </div>
                    </div>
                    ';
                
        }
        // print_r($fpur);die();
        $dataku = Array(
                    'table' => $fpur,
                );
            echo json_encode($dataku);
    }

    public function save_fpum(){
        
        // die('in');
        $name_file_up = $_FILES['doc_kel_fpum']['name'];
        $head['ID_FPUR'] = $this->input->post("id_fpur");
        $head['NO_FPUM'] = $this->input->post("no_fpur");
        $head['KET_JML'] = $this->input->post("ket");
        $head['JUMLAH'] = $this->input->post("jml_l_k");
        $head['DOC_FPUM_PATH'] =$name_file_up;
        $head['CREATE_DATE'] = date("Y-m-d H:i:s");
        // print_r($name_file_up); die();

        $name_file_up = $_FILES['doc_kel_fpum']['name'];
        $ext_file_up = strtoupper(end((explode(".", $name_file_up))));
        // die($ext_file_up);
        if (empty($name_file_up)) {
                               // print_r('tes'); die();
        // } else if ($ext_file_up !== 'ZIP' && $ext_file_up !== 'RAR') {
        //     print_r('Kosong'); die();
        //     $istatus = false;
        //     $iremarks = 'FAID! Eksistensi File tidak diizinkan !. Harus Zip atau Rar !';
//                    $this->session->set_flashdata('math', 'FAID! Eksistensi File tidak diizinkan !. Harus Zip atau Rar !');
            //echo "Eksistensi File tidak diizinkan !. Harus Zip atau Rar !";
//                    redirect('requestproc_tab');
        } else {
            // print_r('ada'); die();
            $config['upload_path'] = "./uploads/fpum/";
            $config['allowed_types'] = '*';
            $config['max_size'] = '0';
                               // die($config);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("doc_kel_fpum")) {
                // print_r('1'); die();
                $error = array('array' => $this->upload->display_errors());
                $data = $this->upload->data();
                $source = "./uploads/fpum/" . $data['file_name'];
                chmod($source, 0777);
                $paydata = $data['file_name'];
            } else {
                // print_r('2'); die();
                $istatus = false;
                $iremarks = $this->upload->display_errors();
            }
        }
        $result = $this->fpur_mdl->save_fpum($head);
        if ($result) {
            $result = array('istatus' => true, 'type' => 'success', 'iremarks' => 'Transfer Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
             $result = array('istatus' => false, 'type' => 'error', 'iremarks' => 'Transfer Gagal.!'); //, 'body'=>'Data Berhasil Disimpan');
        }

        redirect('procurement/fpur/',$result);
        
    }

}