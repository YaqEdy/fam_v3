<?php

Class Requestproc_v3_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	function getData($table){
		$get = $this->db->get($table);
		
		return $get;
	}
	
	function getMaster($table){
		$get = $this->db->where('Is_trash',0)->get($table);
		
		return $get;
	}
	
	function getMasterOra($table){
		$get = $this->db->where('IS_TRASH',0)->where('SUMMARY_FLAG','N')->get($table);
		
		return $get;
	}
	
	function getOptMasterOra($table,$id,$value){
		$opt=[];
		$get = $this->db->where('IS_TRASH',0)->where('SUMMARY_FLAG','N')->get($table)->result_array();
		foreach($get as $optt){
			$opt[$optt[$id]] = $optt[$value];
		}
		
		return $opt;
	}
	
	function getDataID($table,$colomn_id,$id){
		$this->db->where($colomn_id,$id);
		$get = $this->db->get($table);
		
		return $get;
	}
	
	function get_ItemType($ItemClass){
		$this->db->where('Is_trash',0);
		$this->db->where('IClassID',$ItemClass);
		$get = $this->db->get('Mst_ItemType');
		
		return $get;
	}
	
	function get_ItemList($ItemType){
		// $this->db->where('Is_trash',0);
		$this->db->where('ItemTypeID',$ItemType);
		$this->db->where('ZoneID',$this->session->userdata('ZoneID'));
		$get = $this->db->get('VW_ITEM_LIST');
		
		return $get;
	}
	
	function getMax($colomn,$table){
		$this->db->select_max($colomn);
		$get = $this->db->get($table);
		
		return $get;
	}
	
	function get_flow($tipe,$action,$status_dari){
		$this->db->like('nama_flow', $tipe);
		$this->db->where('status_dari', $status_dari);
		$this->db->where('action', $action);
		$get = $this->db->get('MS_FLOW');
		
		return $get;
	}
	
	function update_request($RequestID,$data){
		$up = $this->db
				->where('RequestID',$RequestID)
				->update('TBL_REQUEST',$data);
		
		return $up;
	}
	
	function update_status($data){
		$ambil_flow = $this->db->query("
							SELECT * FROM MS_FLOW 
							WHERE 
								flow_id = ".$data['flow_id']."
								and status_dari = '".$data['status_current']."' 
								and action = '".$data['action']."'
						")->row();
        $up = $this->db->query("
							UPDATE TBL_REQUEST 
							SET status = '".$ambil_flow->status_ke."',
								PIC_PO = '".$data['pic_po']."',
								UpdateDate = GETDATE(),
								UpdateBy = '".$this->session->userdata('id_user')."'
							WHERE RequestID = ".$data['RequestID']."	
						");
						
		#log
		$data_log['RequestID'] = $data['RequestID'];
		$data_log['status_dari'] = $ambil_flow->status_dari;
		$data_log['action'] = $ambil_flow->action;
		$data_log['status_ke'] = $ambil_flow->status_ke;
		$data_log['user_id'] = $this->session->userdata('id_user');
		$data_log['date'] = date("Y-m-d H:i:s");
		$data_log['notes'] = $data['notes'];
		$in_log = $this->db->insert('TBL_REQUEST_LOG',$data_log);
		#
		
		
		return $up;
	}
	
	function update_status_po($data){
		$ambil_flow = $this->db->query("
							SELECT * FROM MS_FLOW 
							WHERE 
								flow_id = ".$data['flow_id']."
								and status_dari = '".$data['status_po']."' 
								and action = '".$data['action']."'
						")->row();
        $up = $this->db->query("
							UPDATE TBL_T_PO 
							SET status = '".$ambil_flow->status_ke."'
							WHERE ID_PO = ".$data['ID_PO']."	
						");
						
		#log
		
		return $up;
	}
	
	function update_pr_action($data,$action,$note){
		$ambil_flow = $this->db->query("
							SELECT * FROM MS_FLOW 
							WHERE 
								flow_id = ".$data['flow_id']."
								and status_dari = '".$data['status']."' 
								and action = '".$action."'
						")->row();
						
		$data['status'] = $ambil_flow->status_ke;
		$data['UpdateDate'] = date('Y-m-d H:i:s');
		$data['UpdateBy'] = $this->session->userdata('id_user');
		
		$up = $this->db
				->where('RequestID',$data['RequestID'])
				->update('TBL_REQUEST',$data);
						
		#log
		$data_log['RequestID'] = $data['RequestID'];
		$data_log['status_dari'] = $ambil_flow->status_dari;
		$data_log['action'] = $ambil_flow->action;
		$data_log['status_ke'] = $ambil_flow->status_ke;
		$data_log['user_id'] = $this->session->userdata('id_user');
		$data_log['date'] = date("Y-m-d H:i:s");
		$data_log['notes'] = $note;
		$in_log = $this->db->insert('TBL_REQUEST_LOG',$data_log);
		#
		
		
		return $up;
	}
	
	function update_flow($RequestID,$jns_pengadaan=null){
		$req = $this->db->where('RequestID',$RequestID)
						->get('VW_PR_OUT_REQ')
						->row();
		
		if($jns_pengadaan == null){$jns_pengadaan='ias';}
		
		$ambil_flow = $this->db->query("
							SELECT * FROM MS_FLOW 
							WHERE 
								tipe = '".$jns_pengadaan."'
								and min_hps < ".$req->BudgetUsed."
								and max_hps > ".$req->BudgetUsed."
						")->row();
						
		$data['flow_id'] = $ambil_flow->flow_id;
		$data['UpdateDate'] = date('Y-m-d H:i:s');
		$data['UpdateBy'] = $this->session->userdata('id_user');
		
		$up = $this->db
				->where('RequestID',$RequestID)
				->update('TBL_REQUEST',$data);		
		
		return $up;
	}
	
	function set_pr_vendor($data){
		$del_vendor_pr = $this->db->where('RequestID', $data['RequestID'])->delete('TBL_REQUEST_VENDOR');
		
		$VendorID = explode(",", $data['VendorID']);
		$VendorPemenang = explode(",", $data['VendorPemenang']);
		$HargaSebelumPenawaran = explode(",", $data['HargaSebelumPenawaran']);
		$HargaSetelahPenawaran = explode(",", $data['HargaSetelahPenawaran']);
		$VendorItemID = explode(",", $data['VendorItemID']);
		$PPNVendor = explode(",", $data['PPNVendor']);
		for($i = 0; $i < $data['row_vendor']; $i++){
			$datain['RequestID'] = $data['RequestID'];
			$datain['VendorID'] = $VendorID[$i];
			$datain['Pemenang'] = $VendorPemenang[$i];
			$datain['ItemID'] = $VendorItemID[$i];
			$datain['HargaVendorAwal'] = $HargaSebelumPenawaran[$i];
			$datain['HargaVendor'] = $HargaSetelahPenawaran[$i];
			$datain['PPN'] = $PPNVendor[$i];
			$in_vendor_pr = $this->db->insert('TBL_REQUEST_VENDOR',$datain);
		}
		#
		
		
		return $in_vendor_pr;
	}
	
	function tbl_insert($table,$data){	
		$add = $this->db->insert($table,$data);
		
		return $add;
	}
	
	function get_listPR(){
		$get = $this->db->query("
				SELECT * FROM 
		");
		
		return $get;
	}

	function get_history_approval($RequestID){
		$this->db->where('RequestID', $RequestID);
		$this->db->order_by('RequestID', 'ASC');
		$this->db->order_by('order', 'ASC');
		$get = $this->db->get('VW_APPROVAL');
		
		return $get;
	}
	
	function get_list_approval($grup){
		$this->db->like('status', $grup.'-', 'after');
		$this->db->where('is_trash', 0);
		// $get = $this->db->get('tbl_request');
		$this->db->order_by('Priority', 'desc');
		$this->db->order_by('CreateDate', 'desc');
		$get = $this->db->get('VW_PR_OUT_REQ');
		
		return $get;
	}
	
	function get_list_approve_request($status){
		$this->db->where('status', $status);
		$this->db->where('is_trash', 0);
		$this->db->order_by('Priority', 'desc');
		$this->db->order_by('CreateDate', 'desc');
		$get = $this->db->get('VW_PR_OUT_REQ');
		
		return $get;
	}
	
	function get_list_all_request_after($status){
		$arr_status = [];
		
		$list_flow = $this->db	->distinct()
								->select('flow_id')
								->get('MS_FLOW')
								->result_array();
		foreach($list_flow as $lf){
			$flow = $this->db	->where('flow_id',$lf['flow_id'])
								->order_by('order', 'asc')
								->get('MS_FLOW')
								->result_array();
			$ord = 0;
			foreach($flow as $f){
				if($f['status_dari'] == $status){$ord=1;}
				if($ord==1){
					if (!in_array($f['status_dari'], $arr_status)){
						array_push($arr_status,$f['status_dari']);
					}
				}
			}
		}
		
		$get = $this->db->where('is_trash', 0)
						->where_in('status', $arr_status)
						->order_by('CreateDate', 'desc')
						->get('VW_PR_OUT_REQ');
		
		return $get;
	}
	
	function get_list_approval_status($status){
		$this->db->where('status', $status);
		$this->db->where('is_trash', 0);
		$get = $this->db->get('VW_PR_OUT_REQ');
		
		return $get;
	}
	
	function get_list_request_after($status){
		// $flow = $this->db->get
		$get = $this->db
		
		->where('status', $status)	
		->where('is_trash', 0)
		// $get = $this->db->get('tbl_request');
		->get('VW_PR_OUT_REQ');
		
		return $get;
	}
	
	function get_data_request($RequestID){
		$this->db->where('RequestID', $RequestID);
		$get = $this->db->get('VW_PR_OUT_REQ');
		
		return $get;
	}
	
    function selreqcategory($reqtypeid) {
        $branchid = $this->session->userdata('BranchID');
        $divid = $this->session->userdata('DivisionID');

        if ($branchid == 1) {
            $querdiv = 'and b.DivisionID=' . $divid . '';
        } else {
            $querdiv = '';
        }
        $thn = date('Y');
        $db2 = $this->load->database('config1', true);
		$qdata = $db2->query('
			SELECT DISTINCT a.ReqCategoryID, a.ReqCategoryName
			FROM Mst_RequestCategory a
		    WHERE a.Is_trash=0 and a.ReqTypeID=' . $reqtypeid . '');
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

	function get_outReq($user){
		$get = $this->db
				->where('CreateBy',$user)
				->where('is_trash',0)
				->get('VW_PR_OUT_REQ');
		
		return $get;
	}
	
	function get_item($RequestID){
		$get = $this->db
				->where('RequestID',$RequestID)
				->get('VW_ITEM_REQUEST');
				
		return $get;
	}
	
	function get_doc($RequestID){
		$get = $this->db
				->where('RequestID',$RequestID)
				->order_by('id','desc')
				->get('TBL_REQUEST_DOC');
				
		return $get;
	}
	
	function get_vendor_pr($RequestID){
		$get = $this->db
				->where('RequestID',$RequestID)
				->get('VW_PR_VENDOR_LIST');
				
		return $get;
	}
	
	function delete_PR($id){
		$data_up['is_trash']=1;
		$up = $this->db
				->where('RequestID',$id)
				->update('TBL_REQUEST',$data_up);
		
		return $up;
	}
	
	function get_pic($RequestID){
		$pengadaan = $this->db
				->where('RequestID',$RequestID)
				->get('VW_PR_OUT_REQ')->row();
				
		$get = $this->db
				->where('TYPE_DESC',$pengadaan->tipe_pengadaan)
				->get('VW_PIC');
		
		return $get;
	}
	
	function get_item_vendor($RequestID,$VendorID){
		$get = $this->db
				->where('RequestID',$RequestID)
				->where	('VendorID',$VendorID)
				->get('VW_PR_VENDOR_LIST');
				
		return $get;	
	}
	
	function get_item_in($ItemID){
		$get = $this->db->query("SELECT * FROM Mst_ItemList WHERE ItemID in ($ItemID)");
		
		return $get;
	}
	
	function update_item_request($data){
		$up = $this->db
				->where('RequestID',$data['RequestID'])
				->where('ItemID',$data['ItemID'])
				->update('TBL_REQUEST_ITEMLIST',$data);
		
		return $up;
	}
	
	
	
	
	
}

?>