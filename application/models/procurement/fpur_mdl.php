<?php

Class Fpur_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	function save_fpur($data)
    {
        $this->db->trans_begin();
        $model =$this->db->insert('TBL_T_FPUR', $data);
//         echo $this->db->last_query(); die();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function save_fpum($data)
    {
        $this->db->trans_begin();
        $model =$this->db->insert('TBL_T_FPUM', $data);
        // echo $this->db->last_query(); die();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
        // $this->db->insert('TBL_T_FPUM', $data);
        // return $this->db->insert_id();
    }


    //math_gober
    function get_fpur($id){
        $this->db->where('RequestID', $id);
        return $this->db->get('VW_PR_FPUR_FPUM')->row();
    }

    public function get_vm_fpur() {
        $query = $this->db->query("SELECT fpur.*,vm_rm.* 
            FROM TBL_T_FPUR  AS fpur
            LEFT JOIN VW_PR_FPUR_FPUM AS vm_rm ON vm_rm.REQUESTID = fpur.ID_PR
            where fpur.TYPE_FPUR='2'
            ");
        return $query->result();
    }

    public function get_my_fpur_fpum() {
        $query = $this->db->query("SELECT fpur.*,vm_rm.* 
            FROM TBL_T_FPUR  AS fpur
            LEFT JOIN VW_PR_FPUR_FPUM AS vm_rm ON vm_rm.REQUESTID = fpur.ID_PR
            ");
        return $query->result();
    }
}
?>