<?php

Class Penilaian_vendor_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	function get_list_penilaian_vendor(){
        $querydata = $this->db2->query("SELECT PR.RequestID, PO.ID_PO, POD.ID_PO_DETAIL, V.VendorName FROM TBL_T_PO_DETAIL POD
                                        JOIN TBL_T_PO PO ON (PO.ID_PO = POD.ID_PO)
                                        JOIN TBL_REQUEST PR ON (PO.ID_PR = PR.RequestID)
                                        JOIN Mst_Vendor V ON (V.VendorID = POD.VENDOR_ID)");
        return $querydata->result();
        $querydata->close();
    }

    function save_fpum($data) {
        $this->db->insert('TBL_T_FPUM', $data);
        return $this->db->insert_id();
    }

    function get_penilaian_vendor($id) {
        $this->db->select('*');
        $this->db->where('TBL_T_PENILAIAN_VENDOR.ID_PO_DETAIL', $id);
        $this->db->from('TBL_T_PENILAIAN_VENDOR');
        // $this->db->join('TBL_R_VARIABEL', 'TBL_R_VARIABEL.ID_VNILAI = TBL_T_PENILAIAN_VENDOR.VARIABEL');
        $query = $this->db->get();
        return $query->result();
    }

    function get_variable_penilaian(){
        return $this->db->get('TBL_R_VARIABEL')->result();
    }

    function delete_penilaian($id)
    {
        $this->db->delete('TBL_T_PENILAIAN_VENDOR', array('ID_PO_DETAIL' => $id));
    }

    function save_penilaian($data)
    {
        return $this->db->insert('TBL_T_PENILAIAN_VENDOR', $data);
    }
}
?>