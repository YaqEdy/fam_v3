<?php

Class Cek_barang_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function seldata($num, $offset, $src_category = null, $src = null) {
        //Koneksi keSQL SERVER
        $this->db2 = $this->load->database('config1', true);
        $tahun = date('Y');
        if ($src != null) {
            $querydata = $this->db2->query("SELECT a.BudgetID,a.BudgetCOA,a.BisUnitID,a.Year,a.BranchID,a.DivisionID,a.BudgetOwnID,a.BudgetValue
											,a.BudgetValue,a.BudgetUsed,c.BranchName,c.BranchCode, d.DivisionName, e.BisUnitName
											FROM Mst_Budget a 											
											LEFT JOIN Mst_Branch c ON c.BranchID=a.BranchID 
											LEFT JOIN Mst_Division d ON d.DivisionID=a.DivisionID 
											LEFT JOIN Mst_BisUnit e ON e.BisUnitID = a.BisUnitID
											where a.Is_trash=0 and $src_category like '%$src%' ORDER BY a.Year DESC");
        } else {
            if ($offset != null) {
                $of = $offset;
            } else {
                $of = 0;
            }

            $querydata = $this->db2->query("SELECT a.BudgetID,a.BudgetCOA,a.BisUnitID,a.Year,a.BranchID,a.DivisionID,a.BudgetOwnID,a.BudgetValue
											,a.BudgetValue,a.BudgetUsed,c.BranchName,c.BranchCode, d.DivisionName, e.BisUnitName
											FROM Mst_Budget a 											
											LEFT JOIN Mst_Branch c ON c.BranchID=a.BranchID 
											LEFT JOIN Mst_Division d ON d.DivisionID=a.DivisionID 
											LEFT JOIN Mst_BisUnit e ON e.BisUnitID = a.BisUnitID
											where a.Is_trash=0 ORDER BY a.Year DESC OFFSET $of ROWS FETCH NEXT $num ROWS ONLY ");
        }
        return $querydata->result();
        $querydata->close();
    }

    function get_jns_budget() {
        $db2 = $this->load->database('config1', true);
        $querydata = $db2->query("SELECT * FROM TBL_R_JNS_BUDGET");
        return $querydata->result();
    }

    function sel_branch() {
        $db2 = $this->load->database('config1', true);
        $querydata = $db2->query("SELECT * FROM Mst_Branch where Is_trash=0");
        return $querydata->result();
    }

    function sel_reqtype() {
        $db2 = $this->load->database('config1', true);
        $querydata = $db2->query("SELECT * FROM Mst_RequestType where Is_trash=0");
        return $querydata->result();
    }

    function selupdbudget($id) {
        $db2 = $this->load->database('config1', true);

        $querydata = $db2->query("SELECT a.BudgetID,a.Year, a.BudgetCOA,a.BudgetValue,a.BranchID ,a.DivisionID,a.BisUnitID	,b.BranchName, b.BranchCode,d.DivisionName, e.BisUnitName 
								  FROM Mst_budget a
								  LEFT JOIN Mst_Branch b ON b.BranchID=a.BranchID 
								  LEFT JOIN Mst_Division d ON d.DivisionID=a.DivisionID 
								  LEFT JOIN Mst_BisUnit e ON e.BisUnitID = a.BisUnitID								  
								  WHERE a.Is_trash=0 and a.BudgetID='" . $id . "'");
        if (count($querydata) > 0) {
            return $querydata->row();
        } else {
            return false;
        }
        $querydata->close();
    }

    function get_ias($id){
        $this->db->where('ID_PO', $id);
        return $this->db->get('VW_CEK_BARANG')->row();
    }

    function get_list($id)
    {
        $query1 = $this->db->query("SELECT ID_PO_DETAIL FROM TBL_T_PO_DETAIL WHERE ID_PO = $id GROUP BY ID_PO_DETAIL");
        $id_pos = [];
        foreach ($query1->result_array() as $id_po) {
            $id_pos[] = $id_po['ID_PO_DETAIL'];
        }
        $this->db->select("*, (SELECT sum(QTY) from TBL_T_TERIMA_BARANG where ID_PO_DETAIL = TBL_T_PO_DETAIL.ID_PO_DETAIL AND ITEM_ID = TBL_T_PO_DETAIL.ITEM_ID) as kurang");
        // var_dump($query1->result_array());exit();
        $this->db->where_in('ID_PO_DETAIL', $id_pos);
        return $this->db->get('TBL_T_PO_DETAIL')->result();
        // var_dump($this->db->last_query());exit();
    }

    function get_detail($id){
        $this->db->where('ID_PO_DETAIL', $id);
        return $this->db->get('TBL_T_PO_DETAIL')->row();
    }

    function get_termin($id){
        $this->db->where('ID_PO', $id);
        $this->db->order_by('TGL_JT_TERIMA_BRG', 'desc');
        return $this->db->get('TBL_T_TERMIN')->row();
    }

    function get_barang($id){
        $query1 = $this->db->query("SELECT ID_PO_DETAIL FROM TBL_T_PO_DETAIL WHERE ID_PO = $id GROUP BY ID_PO_DETAIL");
        // var_dump($query1->result_array());exit();
        $id_pos = [];
        foreach ($query1->result_array() as $id_po) {
            $id_pos[] = $id_po['ID_PO_DETAIL'];
        }
        // var_dump($id_pos);exit();
        $this->db->where_in('ID_PO_DETAIL', $id_pos);
        return $this->db->get('TBL_T_TERIMA_BARANG')->result();
        // var_dump($this->db->last_query());exit();
    }

    function get_all_barang($id){
        $this->db->where('ID', $id);
        return $this->db->get('TBL_T_PO_DETAIL')->result();
    }

   

    function get_one_barang($id)
    {
        $this->db->where('ID_PO_DETAIL', $id);
        return $this->db->get('TBL_T_TERIMA_BARANG')->row();
    }

    function cancelpr($id)
    {
        $data = array(
            'UpdateDate' => date('Y-m-d H:i:s'),
            'UpdateBy' => $this->session->userdata('user_id'),
            'Is_trash' => 1
        );

        $this->db->where('RequestID', $id);
        return $this->db->update('TBL_REQUEST', $data);
    }

    function getpr($id){
        $this->db->where('RequestID', $id);
        return $this->db->get('TBL_REQUEST')->row();
    }

    function save_pr($data)
    {
        return $this->db->insert('TBL_REQUEST', $data);
    }

    function save_barang($data)
    {
        return $this->db->insert('TBL_T_TERIMA_BARANG', $data);
    }

    function save_sn($data)
    {
        return $this->db->insert('TBL_T_TB_DETAIL', $data);
    }

    function get_var()
    {
        $this->db->select('BOBOT, VARIABEL');
        return $this->db->get('TBL_R_VARIABEL')->result();
    }

    function get_sn($idtb, $idpo)
    {
        $this->db->where('ID_PO_DETAIL', $idpo);
        $this->db->where('ID_TB', $idtb);
        return $this->db->get('TBL_T_TB_DETAIL')->result();
    }

    function update_sn($where, $data)
    {
        $this->db->update('TBL_T_TB_DETAIL', $data, $where);
        return $this->db->affected_rows();
    }

    function savedata($branchid) {
        for ($i = 1; $i <= 5; $i++) {
            $data = array(
                'ReqTypeID' => $this->input->post('ReqTypeID' . $i),
                'BudgetCOA' => $this->input->post('BudgetCOA' . $i),
                'BranchID' => $branchid,
                'DivisionID' => $this->input->post('divisi'),
                'Year' => $this->input->post('priode'),
                'BudgetValue' => $this->input->post('BudgetValue' . $i),
                'BudgetOwnID' => 1,
                'BudgetUsed' => 0,
                'Status' => 0,
                'CreateDate' => date('Y-m-d H:i:s'),
                'CreateBy' => $this->session->userdata('user_id')
            );
            //print_r($data);die;
            $this->db2 = $this->load->database('config1', true);
            $this->db2->insert('Mst_Budget', $data);
            $this->db2->close();
        }
    }

    function updatedata($id) {
        $data = array(
            'BudgetValue' => str_replace(",", "", $this->input->post('BudgetValue')),
            'BudgetCOA' => $this->input->post('BudgetCOA'),
            'BranchID' => $this->input->post('branch'),
            'DivisionID' => (($this->input->post('branch') == 1) ? $this->input->post('divisi') : '0'),
            'Year' => $this->input->post('period'),
            'UpdateDate' => date('Y-m-d H:i:s'),
            'UpdateBy' => $this->session->userdata('user_id')
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('BudgetID', $id);
        $this->db2->update('Mst_Budget', $data);
        $this->db2->close();
    }

    function deletedata($id) {
        $data = array(
            'DeleteDate' => date('Y-m-d H:i:s'),
            'DeleteBy' => $this->session->userdata('user_id'),
            'Is_trash' => 1
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('BudgetID', $id);
        $this->db2->update('Mst_Budget', $data);
        $this->db2->close();
    }

    function jumlah() {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT COUNT(BudgetID) AS jml FROM Mst_Budget where Is_trash=0');
        return $division->result();
    }

    function getBranch() {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT BranchID, BranchName, BranchCode FROM Mst_Branch where Is_trash=0');
        return $division->result();
    }

    function getunit($branch) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT BisUnitID, BisUnitName FROM Mst_BisUnit where Is_trash=0 AND BisUnitBranchID=' . $branch);
        return $division->result();
    }

    function getdivisi($unit) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0 AND BranchID=' . $unit);
        return $division->result();
    }

    function getBudgetID($coa) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT BudgetID FROM Mst_Budget where Is_trash=0 AND BudgetCOA=' . $coa);
        return $division->row();
    }

    function getdetail($budgetID) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT * FROM Mst_BudgetDetail where Is_trash=0 AND BudgetID=' . $budgetID);
        return $division->result();
    }

    function simpanData($data) {
        $this->db2 = $this->load->database('config1', true);

        $status = $this->db2->query('INSERT INTO Mst_Budget ( BudgetCOA, Year, BranchID, BisUnitID, DivisionID, BudgetValue, CreateDate, CreateBy, BudgetOwnID, BudgetUsed, Status, Is_trash)
		 VALUES ' . $data);

        if ($status)
            $this->session->set_flashdata('msg', 'Success! Budget Success Insert Data');
        else
            $this->session->set_flashdata('msg', 'Error! Budget Failed Insert Data');
    }

    function allBranch() {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query("SELECT ISNULL(div.DivisionCode,br.BranchCode) as coa,br.BranchID, br.BranchName, br.BranchCode,div.DivisionID, div.DivisionName
										FROM Mst_Branch br
										FULL OUTER JOIN Mst_Division div ON div.BranchID = br.BranchID										
										WHERE br.Is_trash = 0");
        return $division->result();
    }

    function simpan($coa, $year, $branch, $divisi, $budget) {
        $this->db2 = $this->load->database('config1', true);

        $status = $this->db2->query("IF NOT EXISTS ( SELECT BudgetCOA, Year FROM Mst_Budget WHERE BudgetCOA = '" . $coa . "' AND Year = '" . $year . "' AND (BranchID = '" . $branch . "' OR DivisionID = '" . $divisi . "'))
					BEGIN
					    INSERT INTO Mst_Budget (BudgetCOA, Year, BranchID, DivisionID, BudgetValue, CreateDate, CreateBy, BudgetOwnID, BudgetUsed, Status, Is_trash) VALUES 
					    ('" . $coa . "', '" . $year . "', '" . $branch . "','" . $divisi . "','" . $budget . "','" . date('Y-m-d H:i:s') . "','" . $this->session->userdata('user_id') . "','0','0','0','0')
					END
					ELSE 
					BEGIN 
					    UPDATE Mst_Budget 
					    SET BudgetValue = '" . $budget . "', UpdateDate ='" . date('Y-m-d H:i:s') . "' , UpdateBy = '" . $this->session->userdata('user_id') . "'
					    WHERE BudgetCOA = '" . $coa . "' AND Year = '" . $year . "' AND (BranchID = '" . $branch . "' OR DivisionID = '" . $divisi . "')
					END ");

        if ($status)
            $this->session->set_flashdata('msg', 'Success! Budget Success Insert Data');
        else
            $this->session->set_flashdata('msg', 'Error! Budget Failed Insert Data');
    }

}

?>