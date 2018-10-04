<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class project_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select ReqCategoryID from Mst_RequestCategory";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $ReqCategoryID = "001";
            return $ReqCategoryID;
        } else {
            $sql = "select max(right(ReqCategoryID,6)) as ReqCategoryID from Mst_RequestCategory";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $ReqCategoryID = $hasil[0]->ReqCategoryID;
            $ReqCategoryID = sprintf('%06u', $ReqCategoryID + 1);
            return $ReqCategoryID;
        }
    }

    function getitemupdate($id){
        $data = $this->db->query('SELECT ReqCategoryID,ReqCategoryName FROM Mst_RequestCategory 
            where Is_trash=0 AND ReqCategoryID = '.$id.';');
        return $data->result(); 
    }


    function getclass(){
        $data = $this->db->query('SELECT IClassID, IClassName FROM Mst_ItemClass where Is_trash=0;');
        return $data->result(); 
    }

    function seldetil($id){
        //echo $id;die;
        $querydata = $this->db->query("SELECT * FROM Mst_RequestCategory where Is_trash=0 and ReqCategoryID='".$id."'");
        if(count($querydata) > 0) {
            return $querydata->result();
        } else {
            return false;
        }
        $querydata->close();
    }

    function getdivision(){
        $data = $this->db->query('SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0;');
        return $data->result(); 
    }


    function getClassByID($id){
        $qdata = $this->db->query('SELECT det.ReqCatDetail_ID, det.ReqCategoryID, det.IClassID, cl.IClassName FROM Mst_RequestCategoryDetail det 
                                    INNER JOIN Mst_ItemClass cl ON det.IClassID = cl.IClassID
                                    Where det.Is_trash = 0 AND det.ReqCategoryID='.$id.';');
        return $qdata->result();
    }




    function  getCOA(){
        $qdata = $this->db->query('SELECT bud.BudgetID, bud.BudgetCOA, div.DivisionName, br.BranchCode, br.BranchName 
                                    FROM Mst_Budget bud
                                    INNER JOIN Mst_Branch br ON br.BranchID = bud.BranchID                                  
                                    LEFT JOIN Mst_Division div ON div.DivisionID = bud.DivisionID
                                    WHERE bud.Is_trash=0 AND Year='.date('Y'));
        return $qdata->result();
    }



 
    public function get_level_user() {
        $rows = array(); //will hold all results
        $sql = "select * from sec_level order by level_id asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

   function deleteUser($userId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('userid', $userId);
        $query2 = $this->db->delete('sec_passwd');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
            
        }
    }

        function getItemCategory(){
        // $this->db2 = $this->load->database('ms', true);
        $notin = $this->input->get('notin');
        if(empty($this->input->get('notin')) || $this->input->get('notin') == " ")
            $notin = -1;
        
        $qdata = $this->db->query("SELECT * FROM Mst_ItemClass WHERE Is_trash=0 AND IClassID NOT IN (".$notin.")");
        return $qdata->result();
    }

      public function getUserInfo() {
        $sql = "SELECT mc.*,reqcat.ReqCategoryID, reqcat.ReqCategoryName, reqcat.CreateDate, reqtype.ReqTypeName, reqcat.Is_trash, div.DivisionName, br.BranchName
                                FROM Mst_RequestCategory reqcat
                INNER JOIN Mst_RequestType reqtype ON reqcat.ReqTypeID = reqtype.ReqTypeID
                                LEFT JOIN Mst_Budget mc ON mc.BudgetCOA=reqcat.BudgetCOA
                                LEFT JOIN Mst_Division div ON div.DivisionID=mc.DivisionID/*ON reqcat.BudgetCoa = div.DivisionCode*/
                                LEFT JOIN ams_cabang br ON br.BranchID=mc.BranchID /*reqcat.BudgetCoa = br.BranchCode*/";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row

       echo  $this->db->last_query();
    }





        function get_budget($chk){
        if((int)$chk==1){
            $whr="and BranchID=1";
        }else if((int)$chk==2){
            $whr="and BranchID!=1";
        }else if((int)$chk==3){
            $whr="";
        }
                $tahun=date('Y');
       // $db2 = $this->load->database('ms', true);
                //$querydata = $db2->query("SELECT * FROM Mst_Budget where Is_trash=0 ".$whr."");
        $querydata =$this->db->query("SELECT * FROM Mst_Budget where Year='$tahun' and Is_trash=0 ".$whr."");
        return $querydata->result();

    }



        function gettype() {
        $branchID = $this->session->userdata('BranchID');
        // $this->db = $this->load->database('ms', true);
        if ($branchID == 1) {
            $data = $this->db->query('SELECT ReqTypeID, ReqTypeName FROM Mst_RequestType where Is_trash=0;');
        } else {
            $data = $this->db->query('SELECT ReqTypeID, ReqTypeName FROM Mst_RequestType where Is_trash=0 and ReqTypeID !=2;');
        }
        return $data->result();
    }



 //    function updatedata($id){
 //        $querydata =$this->db->query("SELECT * FROM Mst_Budget where Year='".date('Y')."' and Is_trash=0 AND BudgetID='".$this->input->post('COA')."' ")->result_array();
 //        // print_r("SELECT * FROM Mst_Budget where Year='".date('Y')."' and Is_trash=0 AND BudgetID='".$this->input->post('COA')."' ");die();
 //        foreach ($querydata as $querydata) {
      
 //        $data=array(
 //           'ReqCategoryName'=>$this->input->post('txtReqTypeName'),
 //            'ReqTypeID'=>$this->input->post('txtReqTypeCode'),       
 //            'UpdateDate'=>date('Y-m-d H:i:s'),
 //            'BudgetID'=>$querydata['BudgetID'],
 //            'BudgetCOA' =>$querydata['BudgetCOA'],
 //            'UpdateBy'=>$this->session->userdata('user_id'),            
 //        );

 //        $this->db->where('ReqCategoryID',$id);
 //        $this->db->update('Mst_RequestCategory',$data);

 //          $this->db->where('ReqCategoryID',$id);
 //          $this->db->delete('Mst_RequestCategoryDetail');
 //        for($i=0;$i<$this->input->post('tot');$i++){

 //            if(!empty($_POST['classID'][$i])){
 //                $itemdata=array(
 //                    'ReqCategoryID'=>$id,
 //                    'IClassID'=>$_POST['classID'][$i],
 //                    'Is_trash'=>0
 //                );

 //                $this->db->insert('Mst_RequestCategoryDetail',$itemdata);
 //                $this->db->close();
 //            }
 //        }
 //    }
 // }



    function getbranch2(){
        // $branch = $this->session->userdata('BranchID');
        $branch='1';//pusat
        $data = $this->db->query("SELECT BranchID, BranchName, BranchCode FROM Mst_Branch where Is_trash=0 and BranchID='$branch' ");
        return $data->result(); 
    }

    function getdivisi($unit){
        $division = $this->db->query('SELECT DivisionID, DivisionName 
                        FROM Mst_Division where Is_trash=0 AND BranchID='.$unit);
        return $division->result(); 
    }

        function getKategori($unit){
        $ReqCategoriCab = $this->db->query('select * from Mst_Branch a
                                                join Mst_RequestCategory b on a.BranchCode =b.BudgetCOA 
                                                where b.Is_trash=0 and ReqTypeID IN (2,5) and BranchID ='.$unit);
        return $ReqCategoriCab->result();   
    }


        function getzone($branch){
        $data = $this->db->query('SELECT ZoneID FROM Mst_Branch where Is_trash=0 AND BranchID='.$branch.';');
        return $data->row();
    }


function savedata($zona){       
        $data=array(
            'RktName'=>$this->input->post('name'),
            'RktYear'=>$this->input->post('period'),
            'ReqCategoryID'=>$this->input->post('kategori'),
            'BranchID'=>$this->input->post('branch'),
            'ZoneID'=>$zona,            
            'DivisionID'=>$this->input->post('divison'),
            'CreateDate'=>date('Y-m-d H:i:s'),
            'CreateBy'=>$this->session->userdata('user_id'),
            'Is_trash'=>0
        );
        // print_r($data);
        $this->db->insert('Mst_Rkt',$data);                
        $this->db->close();        
       return true;
    }


    function detail_proj($id){  

    $data=$this->db->query("SELECT RktID,RktName,
                            RktYear,
                            ReqCategoryID,
                            BranchID,
                            ZoneID,
                            DivisionID from Mst_Rkt where RktID='$id' ")->result();          
       return $data;
    }


    function updatedata($id, $zona){
        $data=array(
            'RktName'=>$this->input->post('name'),
            'RktYear'=>$this->input->post('period'),
            'ReqCategoryID'=>$this->input->post('kategori'),
            'BranchID'=>$this->input->post('branch'),
            'ZoneID'=>$zona,                    
            'DivisionID'=>$this->input->post('divison'),
            'UpdateDate'=>date('Y-m-d H:i:s'),
            'UpdateBy'=>$this->session->userdata('user_id'),            
        );
        $this->db->where('RktID',$id);
        $this->db->update('Mst_Rkt',$data);
        // $this->db2->close();
        // for($i=0;$i<$this->input->post('tot');$i++){

        //     if(!empty($_POST['classID'][$i])){
        //         $itemdata=array(
        //             'ReqCategoryID'=>$id,
        //             'IClassID'=>$_POST['classID'][$i],
        //             'Is_trash'=>0
        //         );
        //         $this->db3 = $this->load->database('ms', true);
        //         $this->db3->insert('Mst_RequestCategoryDetail',$itemdata);
        //         $this->db3->close();
        //     }
        // }
        return true;
    }



        
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */