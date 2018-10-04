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
		$get = $this->db->where('Is_trash',0)->where('SUMMARY_FLAG','N')->get($table);
		
		return $get;
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

	function get_list_approval($grup){
		$this->db->like('status', $grup.'-', 'after');
		$this->db->where('is_trash', 0);
		// $get = $this->db->get('tbl_request');
		$get = $this->db->get('VW_PR_OUT_REQ');
		
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
	
	function delete_PR($id){
		$data_up['is_trash']=1;
		$up = $this->db
				->where('RequestID',$id)
				->update('TBL_REQUEST',$data_up);
		
		return $up;
	}
	
	function get_pic(){
		$get = $this->db
				->where('user_groupid',5)
				->where('is_trash',0)
				->get('user');
		
		return $get;
	}
	
}

?>