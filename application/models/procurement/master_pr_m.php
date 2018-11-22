<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_pr_m extends CI_Model {

	public function getList() {
                $this->db->order_by("TANGGAL", "DESC");
		return $this->db->get('TBL_T_TIKET_HPS')->result();
	}

	public function save_tiket($data)
	{
		return $this->db->insert('TBL_T_TIKET_HPS', $data);
	}

}


/* End of file master_po_m.php */
/* Location: ./application/models/master_po_m.php */

