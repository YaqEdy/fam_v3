<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_coa extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
//        $this->load->model('zsessions_m');
            $this->load->model('global_m');
            $this->load->model('master_m/master_coa_m');
            $this->load->model('datatables');
        }
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


function home() {
        $menuId = $this->home_m->get_menu_id('master/master_coa/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_zonasi'] = $this->global_m->tampil_data("SELECT ZoneID, ZoneName FROM Mst_Zonasi");
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Master Coa');
        $this->template->load('template/template_dataTable', 'master_v/master_coa_v', $data);
    }


    function getfamdatabranch() {

    $this->getfamdataaccount();
    $this->getfamdatasubaccount();
    $this->getfamdatasubaccount();
    $this->getfamdataLOB();
    $this->getfamdataDivision();
    $this->getfamdatatype();
    $this->getfamdataproject();
    $this->getfamdatafuture1();
    $this->getfamdatafuture2();
    

        $Table='TBL_M_BRANCH';
        $DescTable='BRANCH_DESC';
        $ValueParam='BRANCH';
        $Param='SEGMENT_NAME';
        $this->getCOA($Param,$ValueParam,$Table,$DescTable);


        //$this setiap function APIs
    }

    function getfamdataaccount() {
        $Table='TBL_M_ACCOUNT';
        $DescTable='ACCOUNT_DESC';
        $ValueParam='ACCOUNT';
        $Param='SEGMENT_NAME';
        $this->getCOA($Param,$ValueParam,$Table,$DescTable);
    }
 
    function getfamdatasubaccount() {
        $Table='TBL_M_SUBACCOUNT';
        $DescTable='SUBACCOUNT_DESC';
        $ValueParam='SUB_ACCOUNT';
        $Param='SEGMENT_NAME';
        $this->getCOA($Param,$ValueParam,$Table,$DescTable);
    }

       function getfamdataLOB() {
        $Table='TBL_M_LOB';
        $DescTable='LOB_DESC';
        $ValueParam='LOB';
        $Param='SEGMENT_NAME';
        $this->getCOA($Param,$ValueParam,$Table,$DescTable);
    }


       function getfamdataDivision() {
        $Table='TBL_M_DIVISION';
        $DescTable='DIV_DESC';
        $ValueParam='DIVISION';
        $Param='SEGMENT_NAME';
        $this->getCOA($Param,$ValueParam,$Table,$DescTable);
    }


      function getfamdatatype() {
        $Table='TBL_M_TYPE';
        $DescTable='TYPE_DESC';
        $ValueParam='TYPE';
        $Param='SEGMENT_NAME';
        $this->getCOA($Param,$ValueParam,$Table,$DescTable);
    }

       function getfamdataproject() {
        $Table='TBL_M_PROJECT';
        $DescTable='PROJECT_DESC';
        $ValueParam='PROJECT';
        $Param='SEGMENT_NAME';
        $this->getCOA($Param,$ValueParam,$Table,$DescTable);
    }

      function getfamdatafuture1() {
        $Table='TBL_M_FUTURE1';
        $DescTable='FUTURE1_DESC';
        $ValueParam='FUTURE1';
        $Param='SEGMENT_NAME';
        $this->getCOA($Param,$ValueParam,$Table,$DescTable);
    }

       function getfamdatafuture2() {
        $Table='TBL_M_FUTURE2';
        $DescTable='FUTURE2_DESC';
        $ValueParam='FUTURE2';
        $Param='SEGMENT_NAME';
        $this->getCOA($Param,$ValueParam,$Table,$DescTable);
    }


    function getCOA($Param,$ValueParam,$Table,$DescTable) {
    // $this->getfamkota();
        // die("j");
      $jsonarr=[ 
        'table'=>'PNM_COA_V',
        // 'filter'=>array($Param=>"WHERE/".$ValueParam)
        'filter'=>[ $Param=>"where/".$ValueParam

        ]

    ];
    // print_r($jsonarr); die();
    // $curlurl="http://192.168.10.241/OCI/index.php/api/v1/fam/get_all";
     $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
     $result = $query->result()[0];
     $curlurl = $result->LINK . "/get_all";

    $ch = curl_init($curlurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($jsonarr));
    $responsejson = curl_exec($ch);
    curl_close($ch);

    $response=json_decode($responsejson,true);
// print_r($response);die();

    $no = 1;
    $data['data'] = array();
    foreach ( $response['data'] as $row) {
        // echo "<pre>";
        // print_r($row); die();

        $cek=$this->global_m->tampil_data("SELECT COUNT(*) as JML FROM $Table WHERE FLEX_VALUE ='".$row['FLEX_VALUE']."'")[0]->JML;

        $data = array(
            // 'no'=>$no,
            'FLEX_VALUE'=>$row['FLEX_VALUE'],
             $DescTable=>$row['DESCRIPTION'],
            'ENABLED_FLAG' => $row['ENABLED_FLAG'],
            'SUMMARY_FLAG' => $row['SUMMARY_FLAG'],
            'PARENT_FLEX' => $row['PARENT_FLEX_VALUE'],
           
        );

// array_push($data['data'], $array);

// $no++;
        if($cek==0){

            $model=$this->global_m->simpan($Table,$data);
        }else{
            $model=$this->global_m->ubah($Table,$data,'FLEX_VALUE',$row['FLEX_VALUE']);    
        }
    }

   echo json_encode($model);
}




    public function get_server_side() {    
       $icolumn = array('ID', 'FLEX_VALUE', 'BRANCH_DESC',  'ZONE_ID', 'ZoneName');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('VW_TBL_BRANCH', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $ID = $idatatables->ID;
            $ZONE_ID = $idatatables->ZONE_ID;

            $gbg=$ID."#".$ZONE_ID;

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->FLEX_VALUE;
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = $idatatables->ZONE_ID;
            $row[] = $idatatables->ZoneName;
            $row[] = '<button onclick="tmplEdit(this.value)" value="'.$gbg.'" class="btn btn-sm btn-warning" href="#" id="btnUpdateku" data-toggle="modal" data-target="#mdl_Update">Update</button>';
           

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








//===================================================================================================================================




         function get_server_side_coa() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID',
            1 => 'FLEX_VALUE',
            2 => 'ACCOUNT_DESC',
            3 => 'ENABLED_FLAG',
            4 => 'SUMMARY_FLAG',
            5 => 'CREATE_DATE',
            6 => 'CREATE_BY',
            7 => 'UPDATE_BY',
            8 => 'UPDATE_DATE',
            9 => 'IS_TRASH'
           
        );

        $sql = "SELECT * from TBL_M_ACCOUNT";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'and ACCOUNT_DESC like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='4'){
                $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='5'){
                $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'"; 
                $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
                $sql .= "and ACCOUNT_DESC like '%".$requestData['search']['value']."%'"; 
                $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
                $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
            }
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
           
            $nestedData[] = $no++;     
            $nestedData[] = $row["ID"];     
            $nestedData[] = $row["FLEX_VALUE"];
            $nestedData[] = $row["ACCOUNT_DESC"];
            $nestedData[] = $row["ENABLED_FLAG"];     
            $nestedData[] = $row["SUMMARY_FLAG"];
          
            
            // $nestedData[] = $row["Status"];

            if($row["IS_TRASH"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
            }

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  
    }




         function get_server_side_subcoa() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID',
            1 => 'FLEX_VALUE',
            2 => 'SUBACCOUNT_DESC',
            3 => 'ENABLED_FLAG',
            4 => 'SUMMARY_FLAG',
            5 => 'CREATE_DATE',
            6 => 'CREATE_BY',
            7 => 'UPDATE_BY',
            8 => 'UPDATE_DATE',
            9 => 'IS_TRASH'
           
        );

        $sql = "SELECT * from TBL_M_SUBACCOUNT";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'and SUBACCOUNT_DESC like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='4'){
                $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='5'){
                $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'"; 
                $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
                $sql .= "and SUBACCOUNT_DESC like '%".$requestData['search']['value']."%'"; 
                $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
                $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
            }
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
           
            $nestedData[] = $no++;     
            $nestedData[] = $row["ID"];     
            $nestedData[] = $row["FLEX_VALUE"];
            $nestedData[] = $row["SUBACCOUNT_DESC"];
            $nestedData[] = $row["ENABLED_FLAG"];     
            $nestedData[] = $row["SUMMARY_FLAG"];
          
            
            // $nestedData[] = $row["Status"];

            if($row["IS_TRASH"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
            }

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  
    }


   function get_server_side_lob() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID',
            1 => 'FLEX_VALUE',
            2 => 'LOB_DESC',
            3 => 'ENABLED_FLAG',
            4 => 'SUMMARY_FLAG',
            5 => 'CREATE_DATE',
            6 => 'CREATE_BY',
            7 => 'UPDATE_BY',
            8 => 'UPDATE_DATE',
            9 => 'IS_TRASH'
           
        );

        $sql = "SELECT * from TBL_M_LOB";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'and LOB_DESC like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='4'){
                $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='5'){
                $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'"; 
                $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
                $sql .= "and LOB_DESC like '%".$requestData['search']['value']."%'"; 
                $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
                $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
            }
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
           
            $nestedData[] = $no++;     
            $nestedData[] = $row["ID"];     
            $nestedData[] = $row["FLEX_VALUE"];
            $nestedData[] = $row["LOB_DESC"];
            $nestedData[] = $row["ENABLED_FLAG"];     
            $nestedData[] = $row["SUMMARY_FLAG"];
          
            
            // $nestedData[] = $row["Status"];

            if($row["IS_TRASH"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
            }

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  
    }




   function get_server_side_division() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID',
            1 => 'FLEX_VALUE',
            2 => 'DIV_DESC',
            3 => 'ENABLED_FLAG',
            4 => 'SUMMARY_FLAG',
            5 => 'CREATE_DATE',
            6 => 'CREATE_BY',
            7 => 'UPDATE_BY',
            8 => 'UPDATE_DATE',
            9 => 'IS_TRASH'
           
        );

        $sql = "SELECT * from TBL_M_DIVISION";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'and DIV_DESC like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='4'){
                $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='5'){
                $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'"; 
                $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
                $sql .= "and DIV_DESC like '%".$requestData['search']['value']."%'"; 
                $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
                $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
            }
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
           
            $nestedData[] = $no++;     
            $nestedData[] = $row["ID"];     
            $nestedData[] = $row["FLEX_VALUE"];
            $nestedData[] = $row["DIV_DESC"];
            $nestedData[] = $row["ENABLED_FLAG"];     
            $nestedData[] = $row["SUMMARY_FLAG"];
          
            
            // $nestedData[] = $row["Status"];

            if($row["IS_TRASH"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
            }

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  
    }





   function get_server_side_type() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID',
            1 => 'FLEX_VALUE',
            2 => 'TYPE_DESC',
            3 => 'ENABLED_FLAG',
            4 => 'SUMMARY_FLAG',
            5 => 'CREATE_DATE',
            6 => 'CREATE_BY',
            7 => 'UPDATE_BY',
            8 => 'UPDATE_DATE',
            9 => 'IS_TRASH'
           
        );

        $sql = "SELECT * from TBL_M_TYPE";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'and TYPE_DESC like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='4'){
                $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='5'){
                $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'"; 
                $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
                $sql .= "and TYPE_DESC like '%".$requestData['search']['value']."%'"; 
                $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
                $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
            }
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
           
            $nestedData[] = $no++;     
            $nestedData[] = $row["ID"];     
            $nestedData[] = $row["FLEX_VALUE"];
            $nestedData[] = $row["TYPE_DESC"];
            $nestedData[] = $row["ENABLED_FLAG"];     
            $nestedData[] = $row["SUMMARY_FLAG"];
          
            
            // $nestedData[] = $row["Status"];

            if($row["IS_TRASH"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
            }

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  
    }



function get_server_side_project() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID',
            1 => 'FLEX_VALUE',
            2 => 'PROJECT_DESC',
            3 => 'ENABLED_FLAG',
            4 => 'SUMMARY_FLAG',
            5 => 'CREATE_DATE',
            6 => 'CREATE_BY',
            7 => 'UPDATE_BY',
            8 => 'UPDATE_DATE',
            9 => 'IS_TRASH'
           
        );

        $sql = "SELECT * from TBL_M_PROJECT";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'and PROJECT_DESC like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='4'){
                $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='5'){
                $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'"; 
                $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
                $sql .= "and TYPE_DESC like '%".$requestData['search']['value']."%'"; 
                $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
                $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
            }
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
           
            $nestedData[] = $no++;     
            $nestedData[] = $row["ID"];     
            $nestedData[] = $row["FLEX_VALUE"];
            $nestedData[] = $row["PROJECT_DESC"];
            $nestedData[] = $row["ENABLED_FLAG"];     
            $nestedData[] = $row["SUMMARY_FLAG"];
          
            
            // $nestedData[] = $row["Status"];

            if($row["IS_TRASH"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
            }

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  
    }





    function get_server_side_future1() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID',
            1 => 'FLEX_VALUE',
            2 => 'FUTURE1_DESC',
            3 => 'ENABLED_FLAG',
            4 => 'SUMMARY_FLAG',
            5 => 'CREATE_DATE',
            6 => 'CREATE_BY',
            7 => 'UPDATE_BY',
            8 => 'UPDATE_DATE',
            9 => 'IS_TRASH'
           
        );

        $sql = "SELECT * from TBL_M_FUTURE1";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'and FUTURE1_DESC like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='4'){
                $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='5'){
                $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'"; 
                $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
                $sql .= "and FUTURE1_DESC like '%".$requestData['search']['value']."%'"; 
                $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
                $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
            }
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
           
            $nestedData[] = $no++;     
            $nestedData[] = $row["ID"];     
            $nestedData[] = $row["FLEX_VALUE"];
            $nestedData[] = $row["FUTURE1_DESC"];
            $nestedData[] = $row["ENABLED_FLAG"];     
            $nestedData[] = $row["SUMMARY_FLAG"];
          
            
            // $nestedData[] = $row["Status"];

            if($row["IS_TRASH"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
            }

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  
    }



     function get_server_side_future2() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID',
            1 => 'FLEX_VALUE',
            2 => 'FUTURE2_DESC',
            3 => 'ENABLED_FLAG',
            4 => 'SUMMARY_FLAG',
            5 => 'CREATE_DATE',
            6 => 'CREATE_BY',
            7 => 'UPDATE_BY',
            8 => 'UPDATE_DATE',
            9 => 'IS_TRASH'
           
        );

        $sql = "SELECT * from TBL_M_FUTURE2";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'and FUTURE2_DESC like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='4'){
                $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='5'){
                $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'"; 
                $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
                $sql .= "and FUTURE2_DESC like '%".$requestData['search']['value']."%'"; 
                $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
                $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
            }
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
           
            $nestedData[] = $no++;     
            $nestedData[] = $row["ID"];     
            $nestedData[] = $row["FLEX_VALUE"];
            $nestedData[] = $row["FUTURE2_DESC"];
            $nestedData[] = $row["ENABLED_FLAG"];     
            $nestedData[] = $row["SUMMARY_FLAG"];
          
            
            // $nestedData[] = $row["Status"];

            if($row["IS_TRASH"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
            }

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  
    }




 function update_masterzonasi() {
        // die('aa');
        // print_r($_POST);die();
       // print_r(trim($this->input->post('user_id'))) ; die();
        $id_kyw = trim($this->input->post('id_kyw',TRUE));
        $ID = trim($this->input->post('ID',TRUE));
        $id_zonasi = trim($this->input->post('id_zonasi',TRUE));
       
        
        // print_r($_POST);die('ds');

        $datax = array(
          
            'ZONE_ID' => $id_zonasi,
         
            );
         // print_r($datax); die();

           $table = "TBL_M_BRANCH";
           $id_kolom = "ID";
           $id_data = $ID;
          $model = $this->global_m->ubah($table,$datax, $id_kolom,$id_data);
          
           if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil diubah.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal diubah.'
            );
        }
        $this->output->set_output(json_encode($array));
    }











    public function ajax_UpdateStatusCategory(){
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id_Raw = trim(element('Raw_ID',$i_list));
        $name = trim(element('name',$i_list));
        // $id = trim(element('VendorTypeID',$i_list));
        $id_kyw=(int)$this->session->userdata('id_kyw');
        $Status = trim(element('Status',$i_list));
        
        $data = array(
            // 'Raw_ID' => $id_Raw,
            // 'VendorTypeID' => $id,
            'Status' => $Status,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
        $model = $this->global_m->ubah('Mst_VendorType', $data,'Raw_ID',$id_Raw);
        if ($model) {
            if ($Status == 1) {
                $message = 'Data ' . $name . ' Berhasil Di Aktifkan';
            } else {
                $message = 'Data ' . $name . ' Berhasil Di Non Aktifkan';
            }
            $notifikasi = Array(
                'msgType' => true,
                'msgTitle' => 'Success',
                'msg' => $message
            );
        } else {
            $notifikasi = Array(
                'msgType' => false,
                'msgTitle' => 'Error',
                'msg' => 'Data Vendor Type ' . $name . ' Tidak Berhasil Di Non Aktifkan'
            );
        }
        echo json_encode($notifikasi);
    }



    public function ajax_UpdateCategory(){

        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id_kyw=(int)$this->session->userdata('id_kyw');
        $VendorTypeID = trim(element('VendorTypeID',$i_list));
        $VendorTypeName = element('VendorTypeName',$i_list); 
        $iStatus = trim(element('Status',$i_list));
         
         $id_Raw = $this->master_vendortype_m->getIdMax();
         $id = $this->master_vendortype_m->getIdMax_typeid();
        if(element('Raw_ID',$i_list)=="Generate"){
            // echo "1";
           
             $data = array(
            'Raw_ID' => $id_Raw,
            'VendorTypeID' => $id,
            'VendorTypeName' => $VendorTypeName,
            
            'Status' => $iStatus,
            'CreateBy' => $id_kyw,
            'CreateDate' => date('Y-m-d H:i:s'),
            
        );
       }else{
        // echo "2";
            $id = trim(element('Raw_ID',$i_list));
         $data = array(
            
            
            'VendorTypeName' => $VendorTypeName,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
       }
      
       // print_r($data); die();
        if(element('Raw_ID',$i_list)=="Generate"){
        $model = $this->master_vendortype_m->simpan('Mst_VendorType', $data);
        if ($model) {
                $msg = 'Data Berhasil Disimpan';
            } else {
                $msg = 'Data gagal Disimpan';
            }
       }else{
        $model = $this->master_vendortype_m->ubah('Mst_VendorType', $data,'Raw_ID',$id);
        if ($model) {
                $msg = 'Data Berhasil Diubah';
            } else {
                $msg = 'Data gagal Diubah';
            }
       }

        if ($model) {
            $notifikasi = Array(
                'msgType' => true,
                'msgTitle' => 'Success',
                'msg' => $msg
            );
        } else {
            $notifikasi = Array(
                'msgType' => false,
                'msgTitle' => 'Error',
                'msg' => $msg
            );
        }
        echo json_encode($notifikasi);
    }

   public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_vendortype_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(
                                 
               'Raw_ID' => trim($roq->Raw_ID),    
               'VendorTypeID' => trim($row->VendorTypeID),
               'VendorTypeName' => trim($row->VendorTypeName),
               
               
            );

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
    }

  

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */