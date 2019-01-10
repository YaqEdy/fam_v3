<?php

Class Ias_mdl extends CI_Model {

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

    function updatedatadetailpo($id_po_detail,$status,$id_po) {
        $data = array(
            'INTEGRASI_ORACLE' => $status
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('ID_PO_DETAIL', $id_po_detail);
        $this->db2->where('ID_PO', $id_po);
        $this->db2->update('TBL_T_PO_DETAIL', $data);
        $this->db2->close();
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

    function get_ias($id) {
        $this->db->where('ID_PO', $id);
        return $this->db->get('VW_IAS_GRID')->row();
    }

    function get_all_ias($id) {
        $this->db->where('ID_PO_DETAIL', $id);
        return $this->db->get('TBL_T_IAS')->result();
    }

    function get_var() {
        return $this->db->get('TBL_R_VARIABEL')->result();
    }

    function get_doc() {
        return $this->db->get('TBL_R_DOC')->result();
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

    function save_ias($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('TBL_T_IAS', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function save_ias_doc($data) {
        return $this->db->insert('TBL_T_IAS_DOC', $data);
    }

    function save_penilaian($data) {
        return $this->db->insert('TBL_T_PENILAIAN_VENDOR', $data);
    }

    function get_persen_ppn($id) {
        $this->db->where('ID_PO_DETAIL', $id);
        return $this->db->get('TBL_T_PO_DTL_TOTAL')->row();
    }

    function get_dpp($id) {
//        inv Dpp = total(po) * termin 
//        $TotalDppPO = $this->db->query("select sum(TOTAL) as TOTAL from TBL_T_PO_DTL_TOTAL WHERE ID_PO_DETAIL =" . $id)->row()->TOTAL;
//        $CountIas = $this->db->query("SELECT COUNT(ID_PO_DETAIL)+1 COUNT_ FROM TBL_T_IAS WHERE ID_PO_DETAIL=" . $id)->row()->COUNT_;
//        $NILAITermin = $this->db->query("SELECT NILAI as TOTAL FROM TBL_T_TERMIN WHERE ID_PO_DETAIL=" . $id . " AND TERMIN=" . $CountIas . " ORDER BY TERMIN DESC")->row();

        $TotalDppPO = $this->db->query("select sum(SUB_TOTAL) as TOTAL from TBL_T_PO_DTL_TOTAL WHERE ID_PO_DETAIL =" . $id)->row()->TOTAL;
        $CountIas = $this->db->query("SELECT COUNT(ID_PO_DETAIL)+1 COUNT_ FROM TBL_T_IAS WHERE IS_TRASH=0 AND ID_PO_DETAIL=" . $id)->row()->COUNT_;
        $NILAITermin = $this->db->query("SELECT ".$TotalDppPO."*PERSENTASE/100 as TOTAL FROM TBL_T_TERMIN WHERE ID_PO_DETAIL=" . $id . " AND TERMIN=" . $CountIas . " ORDER BY TERMIN DESC")->row();

        return $NILAITermin;
    }

    function get_ppn($id) {
//        inv PPN = total(po) * termin * %ppn(po)
//        $TotalDppPO = $this->db->query("select sum(TOTAL) as TOTAL from TBL_T_PO_DTL_TOTAL WHERE ID_PO_DETAIL =" . $id)->row()->TOTAL;
//        $CountIas = $this->db->query("SELECT COUNT(ID_PO_DETAIL)+1 COUNT_ FROM TBL_T_IAS WHERE ID_PO_DETAIL=" . $id)->row()->COUNT_;
//        $NILAITermin = $this->db->query("SELECT A.NILAI*B.PERSEN_PPN/100 as PPN FROM TBL_T_TERMIN AS A INNER JOIN TBL_T_PO_DTL_TOTAL AS B ON A.ID_PO_DETAIL=B.ID_PO_DETAIL WHERE A.ID_PO_DETAIL=" . $id . " AND A.TERMIN=" . $CountIas . " ORDER BY A.TERMIN DESC")->row();

        $TotalDppPO = $this->db->query("select sum(PPN) as TOTAL from TBL_T_PO_DTL_TOTAL WHERE ID_PO_DETAIL =" . $id)->row()->TOTAL;
        $CountIas = $this->db->query("SELECT COUNT(ID_PO_DETAIL)+1 COUNT_ FROM TBL_T_IAS WHERE IS_TRASH=0 AND ID_PO_DETAIL=" . $id)->row()->COUNT_;
        $NILAITermin = $this->db->query("SELECT ".$TotalDppPO."*PERSENTASE/100 as PPN FROM TBL_T_TERMIN WHERE ID_PO_DETAIL=" . $id . " AND TERMIN=" . $CountIas . " ORDER BY TERMIN DESC")->row();

        return $NILAITermin;
    }

        function get_pph($id) {
//        inv PPH =  termin * %ppn(po)
        $TotalDppPO = $this->db->query("select sum(TOTAL) as TOTAL from TBL_T_PO_DTL_TOTAL WHERE ID_PO_DETAIL =" . $id)->row()->TOTAL;
        $CountIas = $this->db->query("SELECT COUNT(ID_PO_DETAIL)+1 COUNT_ FROM TBL_T_IAS WHERE IS_TRASH=0 AND ID_PO_DETAIL=" . $id)->row()->COUNT_;
        $PPH = $this->db->query("SELECT B.PPH*B.PERSEN_PPN/100 as PPH FROM TBL_T_TERMIN AS A INNER JOIN TBL_T_PO_DTL_TOTAL AS B ON A.ID_PO_DETAIL=B.ID_PO_DETAIL WHERE A.ID_PO_DETAIL=" . $id . " AND A.TERMIN=" . $CountIas . " ORDER BY A.TERMIN DESC")->row();
        return $PPH;
    }

        function get_po_dtl($id) {
        $this->db->where('ID_PO_DETAIL', $id);
        return $this->db->get('TBL_T_PO_DTL_TOTAL')->row();

    }
    
    function get_termin($id) {
        $this->db->where('ID_TERMIN', $id);
        return $this->db->get('TBL_T_TERMIN')->row();
    }

    function get_all_termin($id) {
        $this->db->where('ID_PO_DETAIL', $id);
        return $this->db->get('TBL_T_TERMIN')->result();
    }

    public function get_quant($id) {
        $query = "select sum(QTY) as quant from TBL_T_TERIMA_BARANG WHERE ID_PO_DETAIL = $id";
        $get = $this->db->query($query);
        return $get->row();
    }

    public function count_termin($id) {
        $query = "select count(ID_PO_DETAIL) as jml from TBL_T_TERMIN WHERE ID_PO_DETAIL = $id";
        $get = $this->db->query($query);
        return $get->row();
    }
    
    public function get_division(){
        $this->db->select('DivisionID');
        $this->db->group_by('DivisionID'); 
        return $this->db->get('TBL_REQUEST')->result();
    }


    public function get_cetak_ias($id) {
        $query = "select b.ID_DOC,a.NO_DOC,a.TGL,b.NAMA_DOC,d.DPP,d.PPN,d.NomorRekening,d.NamaRekening,
                    d.NamaBank,d.QTY,d.ItemName,d.DivisionID
                    from TBL_T_IAS_DOC a
                        LEFT JOIN  TBL_R_DOC b ON b.ID_DOC = a.NAMA_DOC
                        LEFT JOIN  TBL_T_IAS c ON c.ID_IAS = a.ID_IAS
                        LEFT JOIN  [dbo].[VW_G_IAS_DOC] d ON d.ID_IAS = a.ID_IAS
                    WHERE a.ID_IAS='$id'";
        // echo '<pre>'; die($query);
        $get = $this->db->query($query);
        return $get->result();
    }

     function get_cetak_po_1($id){
         $query = "select * from VW_IAS_TO_ORC_DETAIL where ID='$id'";
        // echo '<pre>'; die($query);
        $get = $this->db->query($query);
        return $get->result();
    }

         function get_cetak_pa($id){
         $query = "select * from VW_G_PA where RequestID='$id'";
        // echo '<pre>'; die($query);
        $get = $this->db->query($query);
        return $get->result();
    }

    //   function get_ctk_slip($id){
    //      $query = "select * from VW_G_ROUTING_SLIP where ID_PO_DETAIL='$id' ORDER BY [order]";
    //     // echo '<pre>'; die($query);
    //     $get = $this->db->query($query);
    //     return $get->result();
    // }


}

?>