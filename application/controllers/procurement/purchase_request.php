<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class purchase_request extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('procurement/budget_mdl', 'Budget_mdl');
        $this->load->model('procurement/requestproc_mdl', 'Requestproc_mdl');
        $this->load->model('procurement/requestproc_v3_mdl', 'Requestproc_v3_mdl');
        $this->load->model('procurement/menu_mdl', 'Menu_mdl');
        $this->load->model('datatables');
        $this->load->model('datatables_custom');
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
## //------------- v3 ----------// ##
    function home() {
		// die();
        $menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        // $data['menu_all'] = $this->user_m->get_menu_all(0);
        // $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
        // $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
        // $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $data['selreqtype'] = $this->Requestproc_mdl->selreqtype();
		
        $data['outReq'] = $this->Requestproc_v3_mdl->get_outReq($this->session->userdata('user_id'))->result_array();
        $data['Mst_ItemClass'] = $this->Requestproc_v3_mdl->getMaster('Mst_ItemClass')->result_array();
        $data['ms_branch'] = $this->Requestproc_v3_mdl->getMasterOra('TBL_M_BRANCH')->result_array();
        $data['ms_divisi'] = $this->Requestproc_v3_mdl->getMasterOra('TBL_M_DIVISION')->result_array();
		

        $this->template->set('title', 'Purchase Request');
        $this->template->load('template/template_dataTable', 'procurement/purchase_request/purchase_request_v', $data);
    }
	
	function see_session(){
		print_r($this->session->userdata);
	}

    function add_requestproc() {
		$post = $this->input->post();

        $divid = $this->input->post('DivisionID');
        $ReqTypeID = $this->input->post('ReqTypeID');
        $BranchID = $this->input->post('BranchID');
        $ReqCategoryID = $this->input->post('ReqCategoryID');
        $ProjectName = $this->input->post('ProjectName');
        $budgetCOA = $this->input->post('budgetCOA');
        $BudgetUsed = $this->input->post('BudgetUsed');
		
        $JenisPR = $this->input->post('JenisPR');
        $NomorMemo = $this->input->post('NomorMemo');
		
		# ambil max RequestID
		$max_RequestID = $this->Requestproc_v3_mdl->getMax('RequestID','tbl_request')->row()->RequestID;
		$new_RequestID = $max_RequestID + 1;
		
		# ambil flow 
		$ambil_flow = $this->Requestproc_v3_mdl->get_flow('ias','approve','1-1')->row();
		
		# insert table transaksi tbl_request
		$data_add['RequestID'] = $new_RequestID;
		$data_add['flow_id'] = $ambil_flow->flow_id;
		$data_add['status'] = $ambil_flow->status_ke;
		$data_add['BranchID'] = $BranchID;
		$data_add['DivisionID'] = $divid;
		$data_add['ReqTypeID'] = $ReqTypeID;
		$data_add['ReqCategoryID'] = $ReqCategoryID;
		$data_add['ProjectName'] = $ProjectName;
		$data_add['budgetCOA'] = $budgetCOA;
		$data_add['BudgetUsed'] = $BudgetUsed;
		$data_add['JenisPR'] = $JenisPR;
		$data_add['NomorMemo'] = $NomorMemo;
		$data_add['CreateDate'] = date("Y-m-d H:i:s");
		$data_add['CreateBy'] = $this->session->userdata('id_user');
		
		$add = $this->Requestproc_v3_mdl->tbl_insert('tbl_request',$data_add);
		
		# insert item
        $row = $this->input->post('row');
		for($i=1;$i<=$row;$i++){
			$data_add_item['RequestID'] = $new_RequestID;
			$data_add_item['ItemID'] = $this->input->post('ItemID_'.$i);
			$data_add_item['Qty'] = $this->input->post('price_'.$i);
			$data_add_item['HargaHPS'] = $this->input->post('HargaHPS_'.$i);
			$data_add_item['AssetType'] = $this->input->post('AssetType_'.$i);
			$data_add_item['keterangan'] = $this->input->post('Keterangan'.$i);
			$add_item = $this->Requestproc_v3_mdl->tbl_insert('tbl_request_itemlist',$data_add_item);
		}
        
		# tinggal tambah insert log
		$data_log['RequestID'] = $new_RequestID;
		$data_log['status_dari'] = $ambil_flow->status_dari;
		$data_log['action'] = $ambil_flow->action;
		$data_log['status_ke'] = $ambil_flow->status_ke;
		$data_log['user_id'] = $this->session->userdata('id_user');
		$data_log['date'] = date("Y-m-d H:i:s");
		$add_request_log = $this->Requestproc_v3_mdl->tbl_insert('tbl_request_log',$data_log);
		
        $result = array('istatus' => true, 'iremarks' => 'Data Berhasil Diinput.');
        echo json_encode($result);
    }

	function app_requestproc() {
		$data['RequestID'] = $this->input->post('RequestID');
		$data['flow_id'] = $this->input->post('flow_id');
		$data['status_current'] = $this->input->post('status');
		$data['action'] = $this->input->post('action');
		$data['notes'] = $this->input->post('notes');
		$data['pic_po'] = $this->input->post('pic_po');
		
		$up_status = $this->Requestproc_v3_mdl->update_status($data);

		if($up_status){
			echo "Success.";
		}
        else{
			echo "Gagal.";
		}
    }
	
	function app_check_request() {
		$RequestID = $this->input->post('RequestID');
		
		$data_update['Priority'] = $this->input->post('Priority');
		$up_status = $this->Requestproc_v3_mdl->update_request($RequestID,$data_update);
		
		$data['RequestID'] = $this->input->post('RequestID');
		$data['flow_id'] = $this->input->post('flow_id');
		$data['status_current'] = $this->input->post('status');
		$data['action'] = $this->input->post('action');
		$data['notes'] = $this->input->post('notes');
		$data['pic_po'] = '';
		
		
		$up_status = $this->Requestproc_v3_mdl->update_status($data);
		
        if($up_status){
			echo "Success.";
		}
        else{
			echo "Gagal.";
		}
    }
	
	function list_approve(){
		$menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
		
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        
		$data['grup'] = $this->Requestproc_v3_mdl->getData('ms_grup')->result_array();
		
        $this->template->set('title', 'Approve');
		$this->template->load('template/template_dataTable', 'procurement/purchase_request/list_approve', $data);
	}
	
	function check_request(){
		$menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
		
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        
		$data['grup'] = $this->Requestproc_v3_mdl->getData('ms_grup')->result_array();
		
        $this->template->set('title', 'Approve');
		$this->template->load('template/template_dataTable', 'procurement/purchase_request/check_purchase_request_v', $data);
	}
	
	function get_list_approval(){
		$grup = $this->input->post('grup');
		$get_list = $this->Requestproc_v3_mdl->get_list_approval($grup)->result_array();
		
		echo '
		<table id="datatables" class="datatables">
			<thead>
				<tr>
                    <th>No PR</th>
                    <th>Request Date</th>
                    <th>Request Type</th>
                    <th>Request Category</th>
                    <th>Request Project</th>
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Status</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
		';
		foreach($get_list as $ls){
			echo '
				<tr>
					<td>PR-'.$ls['RequestID'].'</td>
					<td>'.date("d-m-Y", strtotime($ls['CreateDate'])).'</td>
					<td>'.$ls['ReqTypeName'].'</td>
					<td>'.$ls['ReqCategoryName'].'</td>
					<td>'.$ls['ProjectName'].'</td>
					<td>'.$ls['BRANCH_DESC'].'</td>
					<td>'.$ls['DIV_DESC'].'</td>
					<td>'.$ls['status_request'].'</td>
					<td><a href="'.base_url().'procurement/purchase_request/appove_requestproc/'.$ls['RequestID'].'" class="btn btn-primary">Lihat</a></td>
				</tr>
			';
		}
		echo '
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
				$(\'#datatables\').DataTable();
			} );
		</script>
		';
	}
	
	function get_list_check_request(){
		$grup = $this->input->post('grup');
		$get_list = $this->Requestproc_v3_mdl->get_list_approval($grup)->result_array();
		
		echo '
		<table id="datatables" class="datatables">
			<thead>
				<tr>
                    <th>No PR</th>
                    <th>Request Date</th>
                    <th>Request Type</th>
                    <th>Request Kategori</th>
                    <th>Request Project</th>
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Status</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
		';
		foreach($get_list as $ls){
			echo '
				<tr>
					<td>PR-'.$ls['RequestID'].'</td>
					<td>'.date("d-m-Y", strtotime($ls['CreateDate'])).'</td>
					<td>'.$ls['ReqTypeName'].'</td>
					<td>'.$ls['ReqCategoryName'].'</td>
					<td>'.$ls['ProjectName'].'</td>
					<td>'.$ls['BRANCH_DESC'].'</td>
					<td>'.$ls['DIV_DESC'].'</td>
					<td>'.$ls['status_request'].'</td>
					<td><a href="'.base_url().'procurement/purchase_request/data_check_request/'.$ls['RequestID'].'" class="btn btn-primary">Lihat</a></td>
				</tr>
			';
		}
		echo '
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
				$(\'#datatables\').DataTable();
			} );
		</script>
		';
	}
	
	function get_list_close_check_request(){
		$grup = $this->input->post('grup');
		$get_list = $this->Requestproc_v3_mdl->get_list_request_after($grup)->result_array();
		
		echo '
		<table id="datatables" class="datatables">
			<thead>
				<tr>
                    <th>No PR</th>
                    <th>Request Date</th>
                    <th>Request Type</th>
                    <th>Request Kategori</th>
                    <th>Request Project</th>
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Status</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
		';
		foreach($get_list as $ls){
			echo '
				<tr>
					<td>PR-'.$ls['RequestID'].'</td>
					<td>'.date("d-m-Y", strtotime($ls['CreateDate'])).'</td>
					<td>'.$ls['ReqTypeID'].'</td>
					<td>'.$ls['ReqCategoryID'].'</td>
					<td>'.$ls['RktID'].'</td>
					<td>'.$ls['BranchID'].'</td>
					<td>'.$ls['DivisionID'].'</td>
					<td>'.$ls['status_request'].'</td>
					<td><a href="'.base_url().'procurement/purchase_request/data_check_request/'.$ls['RequestID'].'" class="btn btn-primary">Lihat</a></td>
				</tr>
			';
		}
		echo '
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
				$(\'#datatables\').DataTable();
			} );
		</script>
		';
	}
	
	function appove_requestproc(){
		$menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
		
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
		
		$RequestID = $this->uri->segment(4);
        
		$data['approve_pr'] = $this->Requestproc_v3_mdl->get_data_request($RequestID)->row();
		$data['item'] = $this->Requestproc_v3_mdl->get_item($RequestID)->result_array();
		$data['list_pic'] = $this->Requestproc_v3_mdl->get_pic()->result_array();
		
        $this->template->set('title', 'Approve');
		$this->template->load('template/template_dataTable', 'procurement/purchase_request/appove_requestproc', $data);
	}

	function data_check_request(){
		$menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
		
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
		
		$RequestID = $this->uri->segment(4);
        
		$data['approve_pr'] = $this->Requestproc_v3_mdl->get_data_request($RequestID)->row();
		$data['item'] = $this->Requestproc_v3_mdl->get_item($RequestID)->result_array();
		
        $this->template->set('title', 'Approve');
		$this->template->load('template/template_dataTable', 'procurement/purchase_request/data_check_request', $data);
	}

	function dd_selreqcategory() {
        $reqtypeid = $this->input->post('sRequestID');
        $ddSelReqcategory = $this->Requestproc_v3_mdl->selreqcategory($reqtypeid);
        $branchid = $this->session->userdata('BranchID');
        $divid = $this->session->userdata('DivisionID');
        // $last_query = $this->db->last_query();
		// print_r($last_query);die();
        //KONDISI JIKA REQUEST TYPENYA SAMA DENGAN 2/PROJECT MAKA ONCHANGE Tidak BELAKU-------------------/
        if ($reqtypeid == 2 || $reqtypeid == 5) {
            // echo "<select class='form-control' name='ReqCategoryID' id='ReqCategoryID' onchange='loadGridItemList()'>";
            echo "<select class='form-control' name='ReqCategoryID' id='ReqCategoryID'>";
        } else {
            // echo "<select class='form-control' name='ReqCategoryID' id='ReqCategoryID' onchange='loadGridItemList()'>";
            echo "<select class='form-control' name='ReqCategoryID' id='ReqCategoryID'>";
        }
        echo "<option value='' disabled='' selected=''>--Select--</option>";
        foreach ($ddSelReqcategory as $row) {
            echo "<option value='$row->ReqCategoryID'>$row->ReqCategoryName</option>";
        }
        echo "</select>";
    }

    function ajax_GridProcessItem() {
        $iparam_in = null;
        $iwhere_in = array();
        $i_param_in = array();
        $iparam_not_in = null;
        $iwhere_not_in = array();
        $i_param_not_in = array();
        $icolumn = array('ItemID', 'ItemName', 'Image', 'AssetType', 'Price','ItemTypeName');
        $iwhere = array();
        $iParam = explode(",", $this->input->post('sItemID'));
        $iParamDel = explode(",", $this->input->post('sItemIDDelete'));

        if ($this->input->post('sItemIDDelete') != "") {
            foreach ($iParamDel as $ielementDel) {
                $i_param_not_in[] = $ielementDel;
            }
        }
        foreach ($iParam as $ielement) {
            $i_param_in[] = $ielement;
        }
        $iparam_in = 'ItemID';
        $iwhere_in = $i_param_in;

        if ($this->input->post('sItemIDDelete') != "") {
            $iparam_not_in = 'ItemID';
            $iwhere_not_in = $i_param_not_in;
        }
        $iorder = array('ItemID' => 'asc');
        $list = $this->datatables->get_datatables('VW_ITEM_LIST', $icolumn, $iorder, $iwhere
                , $iwhere_in, $iparam_in, $iwhere_not_in, $iparam_not_in);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = '<img src="' . base_url() . 'uploads/Item_Images/' . $idatatables->Image . '" width="45">';
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->ItemTypeName;
            $row[] = $idatatables->AssetType;
            $row[] = '<input type="text" class="form-control nomor1" name="price_' . $no . '" id="' . $idatatables->Price . '" onkeyup="totalPrice(this)">';
            $row[] = $idatatables->Price;
            $row[] = '<textarea rows="2" cols="40" name="Keterangan'.$no.'" id="keteranganID'.$no.'"></textarea>';
            $row[] = '<input type="text" id="price_' . $no . '" class="form-control nomor" style="border:0px; width:auto" value="0" readonly>
					  <input type="hidden" name="ItemID_'.$no.'" value="'.$idatatables->ItemID.'">
					  <input type="hidden" name="AssetType_'.$no.'" value="'.$idatatables->AssetType.'">
					  <input type="hidden" name="HargaHPS_'.$no.'" value="'.$idatatables->Price.'">
					  <input type="hidden" name="row" value="'.$no.'">
					';
            $row[] = '<button id="' . $idatatables->ItemID . '" onclick="deleteItem(this)" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></button>';

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

    function dd_Rkt() {
        $code = $this->input->post('sReqCategoryID');
        $reqCategotyid = explode('--', $code);
		// print_r($code);
		// print_r(count($reqCategotyid));
		// die();
		$selcatid = $code;
		if(count($reqCategotyid)>1){$selcatid=$reqCategotyid[1];}
        $sel_rkt = $this->Requestproc_mdl->sel_optrtk($selcatid);
        echo "<div class='form-group'>";
        echo "<label class='control-label col-sm-3'>RKT / Project</label>";
        echo "<div class='col-sm-7'>";
        echo "<select class='form-control' name='Rkt' id='Rkt'>";
        echo "<option value='0' disabled='' selected=''>--Select--</option>";
        foreach ($sel_rkt as $row) {
            echo "<option value='$row->RktID-$row->ZoneID'>$row->RktName</option>";
        }
        echo "</select>";
        echo "</div>";
        echo "</div>";
        //$this->load->view('requestproc/js/popupitem_list.js');
    }
	
	function ajax_GridOutRequest() {
        $list = $this->Requestproc_v3_mdl->get_outReq($this->session->userdata('user_id'))->result_array();
		// print_r($list);die();

        $data = array();
		echo '
		<table class="table table-striped table-bordered table-hover dataTable no-footer" id="table_gridOutRequest_new" >
            <thead>
                <tr>
                    <th>No PR</th>
                    <th>Request Date</th>
                    <th>Request Type</th>
                    <th>Request Category</th>
                    <th>Request Project</th>
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
		';
        foreach ($list as $idatatables) {
			echo '
				<tr>
					<td>PR-'.$idatatables['RequestID'].'</td>
					<td>'.date("d-m-Y", strtotime($idatatables['CreateDate'])).'</td>
					<td>'.$idatatables['ReqTypeID'].'</td>
					<td>'.$idatatables['ReqCategoryID'].'</td>
					<td>'.$idatatables['ProjectName'].'</td>
					<td>'.$idatatables['BranchID'].'</td>
					<td>'.$idatatables['DivisionID'].'</td>
					<td>'.$idatatables['status_request'].'</td>
					<td><a onclick="delete_pr('.$idatatables['RequestID'].')" class="btn btn-danger" title="Hapus"><i class="fa fa-remove"></i></a></td>
				</tr>
			';
        }
		echo '
			</tbody>
        </table>
		<script>
			$(\'#table_gridOutRequest_new\').DataTable({
			});
		</script>
		';
        
    }

	function delete_Request(){
		$RequestID = $this->input->post('RequestID');
		$up = $this->Requestproc_v3_mdl->delete_PR($RequestID);
		if($up){
			echo 'ok';
		}
		else{
			echo 'fail';
		}
	}
	
	function get_dropdown_ItemType(){
		$ItemClass = $this->input->post('ItemClass');
		$get_ItemType = $this->Requestproc_v3_mdl->get_ItemType($ItemClass)->result_array();
		// echo $this->db->last_query();die();
		echo '<select onchange="loadGridItemList(this.value)" id="ItemType" name="ItemType" class="form-control">';
			echo '<option value="">- Type Item -</option>';
		foreach($get_ItemType as $it){
			echo '<option value="'.$it['ItemTypeID'].'">'.$it['ItemTypeName'].'</option>';
		}
		echo '</select>';
	}
	
	function ajax_GridPopupItemList() {
        // $icolumn = array('ItemID', 'ItemName', 'Image', 'AssetType', 'Price');
        // $iorder = array('ItemID' => 'asc');
		// $iwhere = array('ItemTypeID' => $_GET['ItemType']);
        // $list = $this->datatables->get_datatables('VW_ITEM_LIST', $icolumn, $iorder, $iwhere);
		
		// $ItemType = $this->input->post('ItemType');
		$ItemType = $_GET['ItemType'];
		$list = $this->Requestproc_v3_mdl->get_ItemList($ItemType)->result();

        $data = array();
        $no = 0;
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->Image;
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->AssetType;
            $row[] = $idatatables->Price;
            $row[] = $idatatables->ItemID;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $no,
            "recordsFiltered" => $no,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

	function list_pemilihan_vendor(){
		// echo 'A';
		$menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
		
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        
		$data['grup'] = $this->Requestproc_v3_mdl->getData('ms_grup')->result_array();
		
        $this->template->set('title', 'Pemilihan Vendor');
		$this->template->load('template/template_dataTable', 'procurement/purchase_request/list_pemilihan_vendor', $data);
	}
	
	function get_list_pemilihan_vendor(){
		$status = '7-1';
		$get_list = $this->Requestproc_v3_mdl->get_list_approval_status($status)->result_array();
		
		echo '
		<table id="datatables" class="datatables">
			<thead>
				<tr>
                    <th>No PR</th>
                    <th>Request Date</th>
                    <th>Request Type</th>
                    <th>Request Category</th>
                    <th>Request Project</th>
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Status</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
		';
		foreach($get_list as $ls){
			echo '
				<tr>
					<td>PR-'.$ls['RequestID'].'</td>
					<td>'.date("d-m-Y", strtotime($ls['CreateDate'])).'</td>
					<td>'.$ls['ReqTypeName'].'</td>
					<td>'.$ls['ReqCategoryName'].'</td>
					<td>'.$ls['ProjectName'].'</td>
					<td>'.$ls['BRANCH_DESC'].'</td>
					<td>'.$ls['DIV_DESC'].'</td>
					<td>'.$ls['status_request'].'</td>
					<td><a href="'.base_url().'procurement/purchase_request/pemilihan_vendor/'.$ls['RequestID'].'" class="btn btn-primary">Lihat</a></td>
				</tr>
			';
		}
		echo '
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
				$(\'#datatables\').DataTable();
			} );
		</script>
		';
	}
	
	function pemilihan_vendor(){
		$menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
		
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
		
		$RequestID = $this->uri->segment(4);
        
		$data['approve_pr'] = $this->Requestproc_v3_mdl->get_data_request($RequestID)->row();
		$data['item'] = $this->Requestproc_v3_mdl->get_item($RequestID)->result_array();
		$data['list_pic'] = $this->Requestproc_v3_mdl->get_pic()->result_array();
		
        $this->template->set('title', 'Approve');
		$this->template->load('template/template_dataTable', 'procurement/purchase_request/pemilihan_vendor', $data);
	}
	
	function ajax_GridPopupVendorList() {
        $list = $this->Requestproc_v3_mdl->getMaster('Mst_Vendor')->result();

        $data = array();
        $no = 0;
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->VendorName;
            $row[] = $idatatables->VendorAddress;
            $row[] = $idatatables->NoTlp;
            $row[] = $idatatables->NoRekening;
            $row[] = $idatatables->JoinDate;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $no,
            "recordsFiltered" => $no,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

	function app_requestproc_vendor() {
		$data['RequestID'] = $this->input->post('RequestID');
		$data['flow_id'] = $this->input->post('flow_id');
		$data['status'] = $this->input->post('status');
		// $data['action'] = $this->input->post('action');
		// $data['notes'] = $this->input->post('notes');
		$data['JenisPengadaan'] = $this->input->post('JenisPengadaan');
		$data['VendorPemenang'] = $this->input->post('VendorPemenang');
		$data['HargaVendor'] = $this->input->post('HargaVendor');
		$data['PPN'] = $this->input->post('ppn');
		
		$up_status = $this->Requestproc_v3_mdl->update_pr_action($data,$this->input->post('action'),$this->input->post('notes'));

		if($up_status){
			echo "Success.";
		}
        else{
			echo "Gagal.";
		}
    }
	
	function list_request_anggaran(){
		// echo 'A';
		$menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
		
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        
		$data['grup'] = $this->Requestproc_v3_mdl->getData('ms_grup')->result_array();
		
        $this->template->set('title', 'Request Anggaran');
		$this->template->load('template/template_dataTable', 'procurement/purchase_request/list_request_anggaran', $data);
	}
	
	function get_list_request_anggaran(){
		$status = '8-1';
		$get_list = $this->Requestproc_v3_mdl->get_list_approval_status($status)->result_array();
		
		echo '
		<table id="datatables" class="datatables">
			<thead>
				<tr>
                    <th>No PR</th>
                    <th>Request Date</th>
                    <th>Request Type</th>
                    <th>Request Category</th>
                    <th>Request Project</th>
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Status</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
		';
		foreach($get_list as $ls){
			echo '
				<tr>
					<td>PR-'.$ls['RequestID'].'</td>
					<td>'.date("d-m-Y", strtotime($ls['CreateDate'])).'</td>
					<td>'.$ls['ReqTypeName'].'</td>
					<td>'.$ls['ReqCategoryName'].'</td>
					<td>'.$ls['ProjectName'].'</td>
					<td>'.$ls['BRANCH_DESC'].'</td>
					<td>'.$ls['DIV_DESC'].'</td>
					<td>'.$ls['status_request'].'</td>
					<td><a href="'.base_url().'procurement/purchase_request/request_anggaran/'.$ls['RequestID'].'" class="btn btn-primary">Lihat</a></td>
				</tr>
			';
		}
		echo '
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
				$(\'#datatables\').DataTable();
			} );
		</script>
		';
	}
	
	function request_anggaran(){
		$menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
		
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
		
		$RequestID = $this->uri->segment(4);
        
		$data['approve_pr'] = $this->Requestproc_v3_mdl->get_data_request($RequestID)->row();
		$data['item'] = $this->Requestproc_v3_mdl->get_item($RequestID)->result_array();
		$data['list_pic'] = $this->Requestproc_v3_mdl->get_pic()->result_array();
		
        $this->template->set('title', 'Approve');
		$this->template->load('template/template_dataTable', 'procurement/purchase_request/request_anggaran', $data);
	}
	
	function list_verifikasi_vendor(){
		// echo 'A';
		$menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
		
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        
		$data['grup'] = $this->Requestproc_v3_mdl->getData('ms_grup')->result_array();
		
        $this->template->set('title', 'Verifikasi Vendor');
		$this->template->load('template/template_dataTable', 'procurement/purchase_request/list_verifikasi_vendor', $data);
	}
	
	function get_list_verifikasi_vendor(){
		$status = '11-1';
		$get_list = $this->Requestproc_v3_mdl->get_list_approval_status($status)->result_array();
		
		echo '
		<table id="datatables" class="datatables">
			<thead>
				<tr>
                    <th>No PR</th>
                    <th>Request Date</th>
                    <th>Request Type</th>
                    <th>Request Category</th>
                    <th>Request Project</th>
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Status</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
		';
		foreach($get_list as $ls){
			echo '
				<tr>
					<td>PR-'.$ls['RequestID'].'</td>
					<td>'.date("d-m-Y", strtotime($ls['CreateDate'])).'</td>
					<td>'.$ls['ReqTypeName'].'</td>
					<td>'.$ls['ReqCategoryName'].'</td>
					<td>'.$ls['ProjectName'].'</td>
					<td>'.$ls['BRANCH_DESC'].'</td>
					<td>'.$ls['DIV_DESC'].'</td>
					<td>'.$ls['status_request'].'</td>
					<td><a href="'.base_url().'procurement/purchase_request/verifikasi_vendor/'.$ls['RequestID'].'" class="btn btn-primary">Lihat</a></td>
				</tr>
			';
		}
		echo '
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
				$(\'#datatables\').DataTable();
			} );
		</script>
		';
	}
	
	function verifikasi_vendor(){
		$menuId = $this->home_m->get_menu_id('procurement/purchase_request/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
		
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
		
		$RequestID = $this->uri->segment(4);
        
		$data['approve_pr'] = $this->Requestproc_v3_mdl->get_data_request($RequestID)->row();
		$data['item'] = $this->Requestproc_v3_mdl->get_item($RequestID)->result_array();
		// $data['list_pic'] = $this->Requestproc_v3_mdl->get_pic()->result_array();
		
        $this->template->set('title', 'Verifikasi Vendor');
		$this->template->load('template/template_dataTable', 'procurement/purchase_request/verifikasi_vendor', $data);
	}
	
	
	
	
## //------------- v3 ----------// ##
	
//======== Form Request =========
    public function dd_selreqcategory_old() {
        $reqtypeid = $this->input->post('sRequestID');
        $ddSelReqcategory = $this->Requestproc_mdl->selreqcategory($reqtypeid);
        $branchid = $this->session->userdata('BranchID');
        $divid = $this->session->userdata('DivisionID');
        $last_query = $this->db->last_query();
		print_r($last_query);die();
        //KONDISI JIKA REQUEST TYPENYA SAMA DENGAN 2/PROJECT MAKA ONCHANGE Tidak BELAKU-------------------/
        if ($reqtypeid == 2 || $reqtypeid == 5) {
            echo "<select class='form-control' name='ReqCategoryID' id='ReqCategoryID' onchange='loadGridItemList()'>";
        } else {
            echo "<select class='form-control' name='ReqCategoryID' id='ReqCategoryID' onchange='loadGridItemList()'>";
        }
        echo "<option value='' disabled='' selected=''>--Select--</option>";
        foreach ($ddSelReqcategory as $row) {
            if ($row->BudgetUsed != 0) {
                $RestofBudget = $row->BudgetValue - $row->BudgetUsed;
            } else {
                $RestofBudget = $row->BudgetValue - $row->BudgetUsed;
            }
            echo "<option value='$RestofBudget>$row->BudgetCOA--$row->ReqCategoryID'>$row->BudgetCOA - $row->ReqCategoryName</option>";
//            $options .= "<option  value='" . $k->DivisionID . "'>" . $k->DivisionName . "</option>";
        }
        echo "</select>";
//        $this->load->view('procurement/popupitem_list.js.php');
    }

    public function dd_Rkt_old() {
        $code = $this->input->post('sReqCategoryID');
        $reqCategotyid = explode('--', $code);
//        echo $reqCategotyid[1];die;
        $sel_rkt = $this->Requestproc_mdl->sel_optrtk($reqCategotyid[1]);
        echo "<div class='form-group'>";
        echo "<label class='control-label col-sm-3'>RKT / Project</label>";
        echo "<div class='col-sm-7'>";
        echo "<select class='form-control' name='Rkt' id='Rkt'>";
        echo "<option value='0' disabled='' selected=''>--Select--</option>";
        foreach ($sel_rkt as $row) {
            echo "<option value='$row->RktID-$row->ZoneID'>$row->RktName</option>";
        }
        echo "</select>";
        echo "</div>";
        echo "</div>";
        //$this->load->view('requestproc/js/popupitem_list.js');
    }

    public function ajax_GridPopupItemList_old() {
        $icolumn = array('ItemID', 'ItemName', 'Image', 'AssetType', 'Price');

        $iorder = array('ItemID' => 'asc');
        $list = $this->datatables->get_datatables('vw_pr_itemlist', $icolumn, $iorder);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->Image;
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->AssetType;
            $row[] = $idatatables->Price;
            $row[] = $idatatables->ItemID;

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

    public function ajax_GridProcessItem_old() {
        $iparam_in = null;
        $iwhere_in = array();
        $i_param_in = array();
        $iparam_not_in = null;
        $iwhere_not_in = array();
        $i_param_not_in = array();
        $icolumn = array('ItemID', 'ItemName', 'Image', 'AssetType', 'Price','ItemTypeName');
        $iwhere = array();
        $iParam = explode(",", $this->input->post('sItemID'));
        $iParamDel = explode(",", $this->input->post('sItemIDDelete'));

        if ($this->input->post('sItemIDDelete') != "") {
            foreach ($iParamDel as $ielementDel) {
                $i_param_not_in[] = $ielementDel;
            }
        }
        foreach ($iParam as $ielement) {
            $i_param_in[] = $ielement;
        }
        $iparam_in = 'ItemID';
        $iwhere_in = $i_param_in;

        if ($this->input->post('sItemIDDelete') != "") {
            $iparam_not_in = 'ItemID';
            $iwhere_not_in = $i_param_not_in;
        }
        $iorder = array('ItemID' => 'asc');
        $list = $this->datatables->get_datatables('vw_pr_itemlist', $icolumn, $iorder, $iwhere
                , $iwhere_in, $iparam_in, $iwhere_not_in, $iparam_not_in);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = '<img src="' . base_url() . 'uploads/Item_Images/' . $idatatables->Image . '" width="45">';
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->ItemTypeName;
            $row[] = $idatatables->AssetType;
            $row[] = '<input type="text" class="form-control nomor1" name="price_' . $no . '" id="' . $idatatables->Price . '" onkeyup="totalPrice(this)">';
            $row[] = $idatatables->Price;
            $row[] = '<textarea rows="2" cols="40" name="keterangan'.$no.'" id="keteranganID'.$no.'"></textarea>';
            $row[] = '<input type="text" id="price_' . $no . '" class="form-control nomor" style="border:0px; width:auto" value="0" readonly>
					  <input type="hidden" name="ItemID_'.$no.'" value="'.$idatatables->ItemID.'">
					  <input type="hidden" name="row" value="'.$no.'">
					';
            $row[] = '<button id="' . $idatatables->ItemID . '" onclick="deleteItem(this)" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></button>';

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

    public function add_requestproc_ori() {
		// print_r($this->input->post());die();
        $divid = $this->session->userdata('DivisionID');
        $reqid = $this->input->post('ReqTypeID');
//        $reqname = $this->input->post('requestprocName');

        if ($reqid != "") {

            if ($reqid != '3') {
                $_POST['jenis_periode_sewa'] = "";
                $_POST['jangka_waktu'] = "";
                $_POST['priod'] = "";
                $_POST['jtempo_sewa'] = "";
            }
            // print_r($_POST);die();
            $max = $this->Requestproc_mdl->maxid();
            if (empty($max)) {
                $idnumber = 1;
            } else {
                $idnumber = $max[0]->idmax + 1;
            }
//            //echo $idnumber; die;
            $rtk = $this->input->post('Rkt');
//            print_r($rtk);die();
            if ($rtk != "0") {
                $pecah = explode('-', $rtk);
                $rktID = $pecah[0];
                $RktZoneID = $pecah[1];
            } else {
                $rktID = "";
                $RktZoneID = "";
            }
            $reqcat = $this->input->post('ReqCategoryID');
            $potong = explode('--', $reqcat);
            $reqCatID = $potong[1];
            $BudgetCOA = explode('>', $potong[0]);

            /* CHECK SUBTOTAL UNTUK MENENTUKAN APROVAL BERDASARKAN SUBTOTAL */
            $subtotal = $this->input->post('BudgetUsed');
            $appcat = $this->Requestproc_mdl->sel_aprovcat($subtotal);

            if (!empty($appcat)) {
                $name_file_up = $_FILES["file_zip"]["name"];
                $ext_file_up = strtoupper(end((explode(".", $name_file_up))));
                if (empty($name_file_up)) {
//                                print_r('Kosong'); die();
                } else if ($ext_file_up !== 'ZIP' && $ext_file_up !== 'RAR') {
                    $istatus = false;
                    $iremarks = 'FAID! Eksistensi File tidak diizinkan !. Harus Zip atau Rar !';
//                    $this->session->set_flashdata('math', 'FAID! Eksistensi File tidak diizinkan !. Harus Zip atau Rar !');
                    //echo "Eksistensi File tidak diizinkan !. Harus Zip atau Rar !";
//                    redirect('requestproc_tab');
                } else {
                    $config['upload_path'] = "./uploads/purchase_request/";
                    $config['allowed_types'] = '*';
                    $config['max_size'] = '0';
//                                die($config);
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload("file_zip")) {
                        $error = array('array' => $this->upload->display_errors());
                        $data = $this->upload->data();
                        $source = "./uploads/purchase_request/" . $data['file_name'];
                        chmod($source, 0777);
                        $paydata = $data['file_name'];
                    } else {
                        $istatus = false;
                        $iremarks = $this->upload->display_errors();
                    }
                }
//                            die($paydata);

                $calbud = $this->Requestproc_mdl->calculatbudget($BudgetCOA[1]);
                $BudgetUsed = $calbud[0]->BudgetUsed;
                $BudgetID = $calbud[0]->BudgetID;
                //print_r($calbud[0]->BudgetID);die();
                $savedata = $this->Requestproc_mdl->savedata($paydata, $reqid, $idnumber, $rktID, $RktZoneID, $reqCatID, $BudgetCOA[1], $divid, $BudgetUsed, $BudgetID);
                $ck_aprvlist = $this->Requestproc_mdl->sel_aprovallist($appcat[0]->AppvCategoryID);
                foreach ($ck_aprvlist as $row) {
                    if ($row->ApprovalLevel == 1) {
                        $notif_status = 1;
                    } else {
                        $notif_status = 0;
                    }
                    $appv = array(
                        'RequestID' => $idnumber,
                        'AppvID' => $row->AppvID,
                        'PositionID' => $row->PositionID,
                        'AppvStatus' => 0,
                        'StatusNotif' => $notif_status,
                        'AppvDate' => date('Y-m-d H:i:s')
                    );
                    //print_r($appv);die;
                    $this->db2 = $this->load->database('config1', true);
                    $this->db2->insert('Appv_Request', $appv);
                    $this->db2->close();
                }
                $istatus = true;
                $iremarks = 'Success! Request Success Insert data';
//                $this->session->set_flashdata('msg', 'Success! Request Success Insert data');
            } else {
                $istatus = false;
                $iremarks = 'FAID! System Tidak Dapat Menentukan Jumlah approval, Mohon Hubungi Administrator';
//                $this->session->set_flashdata('msg', 'FAID! System Tidak Dapat Menentukan Jumlah approval, Mohon Hubungi Administrator');
            }
//            redirect('requestproc_tab');
        } else {
            $selreqtype = $this->Requestproc_mdl->selreqtype();
            $data = array(
                'selreqtype' => $selreqtype
            );
            $istatus = false;
            $iremarks = 'Request Type harus dipilih.!';
//            $this->load->view('requestproc/js/index_requestproc.js', $data);
//            $this->load->view('requestproc/add_requestproc', $data);
        }

        $result = array('istatus' => $istatus, 'iremarks' => $iremarks);
        echo json_encode($result);
    }

//======== End Form Request =========
//======== Out Request =========
    public function ajax_GridOutRequest_old() {
		print_r($this->input->post());die();
        $sessid = $this->session->userdata('usergroup');
        $method = $this->uri->segment('2');
        $accesdata = $this->Menu_mdl->get_menusetting2($sessid, $method);
        if ($this->input->post('sSearch') == 'ReqTypeName') {
            $param_ = 'param_';
        } else {
            $param_ = $this->input->post('sSearch');
        }
        $icolumn = array('Direktory_PR', 'RequestID', 'DivisionCode', 'DeleteDate', 'Is_trash', 'Jenis_periode_sewa', 'Jangka_waktu', 'Termin_sewa', 'BudgetCOA', 'CreateDate', 'Status', 'ReqCategoryName', 'ReqTypeName', 'EmployeeName', 'DivisionName', 'BranchCode', 'BranchName', 'RktName', 'param_');
        $iwhere = array(
            $param_ => $_POST['search']['value']
        );

        $iorder = array('RequestID' => 'asc');
        $list = $this->datatables_custom->get_datatables('vw_pr_out_request', $icolumn, $iorder, $iwhere);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $jenisperiode = $idatatables->Jenis_periode_sewa;
            if ($jenisperiode == '1') {
                $jenisperiode_ket = "[ Harian ]";
                $add_ket = "Hari";
            } elseif ($jenisperiode == '2') {
                $jenisperiode_ket = "[ Bulanan ]";
                $add_ket = "Bulan";
            } elseif ($jenisperiode == '3') {
                $jenisperiode_ket = "[ Tahunan ]";
                $add_ket = "Tahun";
            } else {
                $jenisperiode_ket = "";
                $add_ket = "Month";
            }

            $direktoriUpload = $idatatables->Direktory_PR;
            $jangkawaktu = $idatatables->Jangka_waktu;
            $terminsewa = $idatatables->Termin_sewa;

            $format = 'Y-m-d H:i:s.u';
            $date = DateTime::createFromFormat($format, $idatatables->CreateDate);
            $date_del = DateTime::createFromFormat($format, $idatatables->DeleteDate);
            if ($idatatables->Status == 0) {
                $st = "<p class='warning'>Waiting Approval</p>";
            } else if ($idatatables->Status == 1) {
                $st = "<p class='success'>Set PO</p>";
            } else if ($idatatables->Status == 2) {
                $st = "<p class='warning'>Set Termin</p>";
            } else if ($idatatables->Status == 3) {
                $st = "<p class='warning'>Upload IAS</p>";
            } else if ($idatatables->Status == 4) {
                $st = "<p class='warning'>Payment(Closing)</p>";
            } elseif ($idatatables->Status == 5) {
                $st = "<p class='danger'>Rejected</p>";
            }
//                
//                if ($row->Is_trash == 1) {
//                    $style = "class='danger' ";
//                    $st = "<td>Tanggal Hapus :<br>" . $date_del->format('d-m-Y  H:i:s') . "</td>";
//                } else {
//                    $style = "";
//                }


            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->BudgetCOA;
            $row[] = 'PR-' . $idatatables->DivisionCode . '-' . sprintf('%03u', $idatatables->RequestID);
            if ($idatatables->RktName == null || $idatatables->RktName == '') {
                $row[] = '<b>' . $idatatables->ReqTypeName . ' ' . $jenisperiode_ket . '</b> -' . $idatatables->ReqCategoryName;
            } else {
                $row[] = $idatatables->ReqTypeName . '-' . $idatatables->ReqCategoryName . ' (' . $idatatables->RktName . ')';
            }
            $row[] = $idatatables->ReqCategoryName . ' (' . $idatatables->RktName . ')';
            $row[] = $idatatables->EmployeeName . ' (' . $idatatables->BranchName . ')';
            $row[] = $date->format('d-m-Y  H:i:s');
            $row[] = $st;
            if ($idatatables->Is_trash == 1) {
                $row[] = '<a><button class="btn btn-success btn-xs disabled" onclick="set_reqid( ' . $idatatables->RequestID . ')" type="button">Upload PR</button></a>';
            } else {
                if ($direktoriUpload == 'kosong' || $direktoriUpload == '' || $direktoriUpload == 'NULL') {

                    $row[] = '<a data-toggle="modal" data-target="#myUploadPR" data-id="' . $idatatables->RequestID . '"><button class="btn btn-success btn-xs" onclick="set_reqid(' . $idatatables->RequestID . ')" type="button">Upload PR</button></a>';
                } else {
                    $row[] = 'Sudah Upload PR';
                }
            }

            if ($idatatables->Is_trash != 1) {
                $subrow = '<a href="' . base_url() . 'procurement/purchase_request/cetak/' . $idatatables->RequestID . '" class="btn green fa fa-print" target="_blank"></a>'
                        . '<a data-toggle="modal" data-target="#mdl_DetailOR" ><button class="btn btn-primary btn-xs" type="button" onclick="detailOR(' . $idatatables->RequestID . ')">Detail</button></a>';
//                if ($accesdata[0]->is_delete == 1 && $idatatables->Status != 5) {
                if ($idatatables->Status != 5) {
                    $chekapproval = $this->Requestproc_mdl->cheking_aproval($idatatables->RequestID);
                    $chekpay = $this->Requestproc_mdl->cheking_paytermin($idatatables->RequestID);
                    if (empty($chekpay)) {
                        $subrow.= '<a data-toggle="modal" data-target="#mdl_delete" data-id="' . $idatatables->RequestID . '"><button class="btn btn-primary btn-xs" onclick="set_req(' . $idatatables->RequestID . ')" type="button">Delete</button></a>';
                    }
                }
                $row[] = $subrow;
            } else {
                $row[] = '<a data-toggle="modal" data-target="#mdl_DetailOR"><button class="btn btn-primary btn-xs" type="button" onclick="detailOR(' . $idatatables->RequestID . ')">Detail</button></a>';
            }
                $row[]=$idatatables->Is_trash;
                
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

    public function cetak($id) {
//                die('in');
        $branchid = $this->session->userdata('BranchID');
        $reqdetail = $this->Requestproc_mdl->seldetil_cetak($id, $branchid);
        $itemdetail = $this->Requestproc_mdl->req_itemdetail($id);
        $infoaprove = $this->Requestproc_mdl->info_aproval($id);
        $data = array(
            'listdata' => $reqdetail,
            'reqitem' => $itemdetail,
            'infoaprove' => $infoaprove
        );
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $data['image1'] = base_url('metronic/img/logo.jpg');
        $this->load->view('procurement/purchase_request/Purchase_request_c', $data);
    }

    public function detil_requestproc() {
        $id = $this->input->post('sId');
//        die($id);
        $reqdetail = $this->Requestproc_mdl->seldetil($id);
        $itemdetail = $this->Requestproc_mdl->req_itemdetail($id);
        $infoaprove = $this->Requestproc_mdl->info_aproval($id);
        // print_r($infoaprove);die;
        $data = array(
            'listdata' => $reqdetail[0],
            'reqitem' => $itemdetail,
            'infoaprove' => $infoaprove
        );
        $this->load->view('procurement/purchase_request/detil_requestproc', $data);
    }

    public function delete_requestproc2() {
        $id = $this->input->post('req');
        $note = $this->input->post('note');

        $delbudget = $this->Requestproc_mdl->delbudget($id);
        $COA = $delbudget[0]->BudgetCOA;
        $sbtotal = $delbudget[0]->SubTotalPrice;
        $used = $delbudget[0]->BudgetUsed;
        $PriceVendor = $delbudget[0]->PriceVendor;

        if ($PriceVendor == '') {
            $backtobudget = $used - $sbtotal;
        } else {
            $backtobudget = $used - $PriceVendor;
        }

        //echo $backtobudget; die;
        $data = array(
            'BudgetUsed' => $backtobudget
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('BudgetCOA', $COA);
        $this->db2->update('Mst_Budget', $data);
        $this->db2->close();

        $this->Requestproc_mdl->deletedata2($id, $note);
//        $this->session->set_flashdata('msg', 'Success! requestproc ID: ' . $id . ' Success Delete data');
        $result = array('istatus' => true, 'iremarks' => 'Success! requestproc ID: ' . $id . ' Success Delete data');
        echo json_encode($result);
    }

    public function upload_requestproc() {
        $DivisionCode = $this->session->userdata('DivisionCode');
        $BranchID = $this->session->userdata('BranchID');
        $BranchCode = $this->session->userdata('BranchCode');

        if ($BranchID == 1) {
            $inisial = 'FilePurchaseRequest-' . $DivisionCode;
        } elseif ($BranchID <> 1) {
            $inisial = 'FilePurchaseRequest-' . $BranchCode;
        } else {
            $inisial = 'FilePurchaseRequest-';
        }

        $requestid = $this->input->post('requestid');
        $name_file_up = $_FILES["FileUploadPR"]["name"];
        $ext_file_up = strtoupper(end((explode(".", $name_file_up))));
        if (empty($name_file_up)) {
            $this->session->set_flashdata('math', 'File tidak boleh kosong !');
        } else if ($ext_file_up !== 'jpg' && $ext_file_up !== 'JPG' && $ext_file_up !== 'PNG' && $ext_file_up !== 'png' && $ext_file_up !== 'jpeg' && $ext_file_up !== 'JPEG' && $ext_file_up !== 'pdf' && $ext_file_up !== 'PDF' && $ext_file_up !== 'doc' && $ext_file_up !== 'DOC' && $ext_file_up !== 'docx' && $ext_file_up !== 'DOCX') {
            $this->session->set_flashdata('math', 'File harus berbentuk gambar / pdf / doc');
        } else {

            $config['upload_path'] = "./uploads/upload_PR/";
            $config['allowed_types'] = '*';
            $config['max_size'] = '0';
            $config['file_name'] = date('Y-m-d') . "-" . time() . '-' . $inisial . '.' . $ext_file_up;
            $this->load->library('upload', $config);
            $hasil_rename = date('Y-m-d') . "-" . time() . '-' . $inisial . '.' . $ext_file_up;
            if ($this->upload->do_upload("FileUploadPR")) {
                $model = $this->Requestproc_mdl->updatefilepr($hasil_rename, $requestid);
                if ($model === TRUE) {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('msg', 'Success! Upload File');
                    $istatus = true;
                    $iremarks = "Success! Upload File";
                } else {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('msg', 'Gagal! Upload File');
                    $istatus = FALSE;
                    $iremarks = "Gagal! Upload File";
                }
            } else {
                $istatus = FALSE;
                $iremarks = $this->upload->display_errors();
            }
        }
        $result = array('istatus' => $istatus, 'iremarks' => $iremarks);
        echo json_encode($result);
    }

    //======== End Out Request =========




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
                    $this->Budget_mdl->simpan($value["A"], $value["B"], $value["D"], $value["E"], $value["F"]);
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
        $data = $this->Budget_mdl->allBranch();
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

//    =================================
    public function ajax_saveProject() {
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

//        $id_kyw = (int) $this->session->userdata('id_kyw');
        $id_project = element('id_project', $i_list);
        $project_desc = element('project_desc', $i_list);
        $id_instansi = element('id_instansi', $i_list);
//        $instansi_desc = element('instansi_desc', $i_list);
        $instansi_desc = $this->global_m->tampil_data("select instansi_desc FROM tbl_m_instansi where id_instansi='$id_instansi'");

        if ($id_project == "Generate") {
            $id_ = $this->global_m->tampil_data("select generate_id_project() as id_project");
            $data = array(
                'id_project' => $id_[0]->id_project,
                'project_desc' => $project_desc,
                'id_instansi' => $id_instansi,
                'instansi_desc' => $instansi_desc[0]->instansi_desc,
            );
        } else {
            $data = array(
                'project_desc' => $project_desc,
                'id_instansi' => $id_instansi,
                'instansi_desc' => $instansi_desc[0]->instansi_desc,
            );
        }


        if ($id_project == "Generate") {
            $result = $this->global_m->simpan('tbl_m_project', $data);
        } else {
            $result = $this->global_m->ubah('tbl_m_project', $data, 'id_project', $id_project);
        }

        if ($result) {
            $result = array('istatus' => true, 'iremarks' => 'Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
            $result = array('istatus' => false, 'iremarks' => 'Gagal');
        }

        echo json_encode($result);
    }

    public function ajax_delete() {
        $id = $this->input->post('sbudgetID');
        $this->Budget_mdl->deletedata($id);

        $result = array('istatus' => true, 'iremarks' => 'Success.!'); //, 'body'=>'Data Berhasil Disimpan');

        echo json_encode($result);
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */