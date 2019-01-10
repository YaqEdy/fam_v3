   <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class tiket_m extends CI_Model {



    function getAllTiket($ID_TIKET_DETAIL) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query("SELECT ID_TIKET, AKOMODASI, AN_TIKET, NOTE, NO_HP, ID_KRY, GENDER, JABATAN, DIV, JNS_IDENTITAS, NO_IDENTITAS, ASAL_BERANGKAT, ASAL_PULANG, STATUS_TIKET,  TUJUAN_BERANGKAT, KATEGORI, TGL_BERANGKAT, TGL_PULANG, ID_TIKET_DETAIL
                        FROM  VW_TIKET WHERE ID_TIKET IN (".$ID_TIKET_DETAIL.") ");
        // print_r($division); die();
        return $division->result();
    }

    public function simpanubah($datax=array(),$data,$ID_TIKET){
		$this->db->trans_begin();
		$this->db->insert_batch('TBL_T_TIKET_TERMIN', $datax);
		$this->db->where('ID_TIKET', $ID_TIKET);
		$this->db->update('TBL_T_TIKET',$data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}

    public function simpanubahnobatch($datax,$data,$ID_TIKET){
		$this->db->trans_begin();
		$this->db->insert('TBL_T_TIKET_TERMIN', $datax);
		$this->db->where('ID_TIKET', $ID_TIKET);
		$this->db->update('TBL_T_TIKET_INVOICE',$data);
		// print_r($this->db->last_query()); die();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}

}