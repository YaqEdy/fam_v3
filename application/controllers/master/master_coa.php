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
            $this->load->model('datatables_custom');
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

// if (!defined('BASEPATH'))
//     exit('No direct script access allowed');

// class master_coa extends CI_Controller {

//     function __construct() {
//         parent::__construct();
//         if ($this->session->userdata("is_login") === FALSE) {
//             $this->sso->log_sso();
//         } else {
//             session_start();
//             $this->load->model('home_m');
//             $this->load->model('admin/konfigurasi_menu_status_user_m');
// //        $this->load->model('zsessions_m');
//             $this->load->model('global_m');
//             $this->load->model('master_m/master_coa_m');
//             $this->load->model('datatables_custom');
//         }
//     }

//     public function index() {
//         if ($this->auth->is_logged_in() == false) {
//             $this->login();
//         } else {
//             $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

//             $this->template->set('title', 'Home');
//             $this->template->load('template/template1', 'global/index', $data);
//         }
//     }

// function home() {
//         $menuId = $this->home_m->get_menu_id('master/master_coa/home');
//         $data['menu_id'] = $menuId[0]->menu_id;
//         $data['menu_parent'] = $menuId[0]->parent;
//         $data['menu_nama'] = $menuId[0]->menu_nama;
//         $data['menu_header'] = $menuId[0]->menu_header;
//         $this->auth->restrict($data['menu_id']);
//         $this->auth->cek_menu($data['menu_id']);
//         $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
//         //$data['level_user'] = $this->sec_user_m->get_level_user();

//         $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
//         $data['menu_all'] = $this->user_m->get_menu_all(0);
// //            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
// //            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
// //            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

//         $this->template->set('title', 'Master COA');
//         $this->template->load('template/template_dataTable', 'master_v/master_coa_v', $data);
//     }


//      function get_server_side() {
//         $requestData = $_REQUEST;
//        // print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'ID',
//             1 => 'FLEX_VALUE',
//             2 => 'BRANCH_DESC',
//             3 => 'ZONE_ID',
//             4 => 'ZoneName',
//             5 => 'CREATE_BY',
//             6 => 'CREATE_DATE',
//             7 => 'UPDATE_BY',
//             8 => 'UPDATE_DATE',
//             9 => 'IS_TRASH'
           
//         );

//         // print($columns);die('dsda');

//         $sql = "SELECT * from VW_TBL_BRANCH";
        
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 

//         $totalFiltered = $totalData;

//         // print_r($totalData);die('ewew');

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from VW_TBL_BRANCH where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from VW_TBL_BRANCH where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from VW_TBL_BRANCH where IS_TRASH like '%".$iStatus."%'and BRANCH_DESC like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from VW_TBL_BRANCH where IS_TRASH like '%".$iStatus."%'and ZONE_ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from VW_TBL_BRANCH where IS_TRASH like '%".$iStatus."%'and ZoneName like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from VW_TBL_BRANCH where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
//                 $sql .= "and BRANCH_DESC like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or ZONE_ID like '%".$requestData['search']['value']."%'";
//                 $sql .= "and ZoneName like '%".$requestData['search']['value']."%'"; 
             
//             }
           
//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
//             $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//             $totalFiltered = $totalData;
//         } else {
//              $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
//         }

//         $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
//          // print_r($row); die();
//         $data = array();
//         $no=$_POST['start']+1;
//         foreach ($row as $row) {
//             # code...
//             // preparing an array

//             $ID = $row["ID"];
//             $ZONE_ID = $row["ZONE_ID"];
//          // // $ItemName = $idatatables->ItemName;

//             $gbg=$ID."#".$ZONE_ID;


//             $nestedData = array();
           
//             $nestedData[] = $no++;     
//             $nestedData[] = $row["ID"];     
//             $nestedData[] = $row["FLEX_VALUE"];
//             $nestedData[] = $row["BRANCH_DESC"];   
//             $nestedData[] = $row["ZONE_ID"];     
//             $nestedData[] = $row["ZoneName"];
//             $nestedData[] = '<button onclick="tmplEdit(this.value)" value="'.$gbg.'" class="btn btn-sm btn-warning" href="#" id="btnUpdateku" data-toggle="modal" data-target="#mdl_Update">Update</button>';


//             $data[] = $nestedData;
//         }

//         $json_data = array(
//             "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//             "recordsTotal" => intval($totalData), // total number of records
//             "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//             "data" => $data   // total data array
//         );

//         echo json_encode($json_data);  
//     }



//          function get_server_side_coa() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'ID',
//             1 => 'FLEX_VALUE',
//             2 => 'ACCOUNT_DESC',
//             3 => 'ENABLED_FLAG',
//             4 => 'SUMMARY_FLAG',
//             5 => 'CREATE_DATE',
//             6 => 'CREATE_BY',
//             7 => 'UPDATE_BY',
//             8 => 'UPDATE_DATE',
//             9 => 'IS_TRASH'
           
//         );

//         $sql = "SELECT * from TBL_M_ACCOUNT";            
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'and ACCOUNT_DESC like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from TBL_M_ACCOUNT where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
//                 $sql .= "and ACCOUNT_DESC like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
//             }
           
//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
//             $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//             $totalFiltered = $totalData;
//         } else {
//              $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
//         }

//         $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
//         $data = array();
//         $no=$_POST['start']+1;
//         foreach ($row as $row) {
//             # code...
//             // preparing an array
//             $nestedData = array();
           
//             $nestedData[] = $no++;     
//             $nestedData[] = $row["ID"];     
//             $nestedData[] = $row["FLEX_VALUE"];
//             $nestedData[] = $row["ACCOUNT_DESC"];
//             $nestedData[] = $row["ENABLED_FLAG"];     
//             $nestedData[] = $row["SUMMARY_FLAG"];
          
            
//             // $nestedData[] = $row["Status"];

//             // if($row["IS_TRASH"]==0)
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate1" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
//             // }
//             // else
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate1" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
//             // }

//             $data[] = $nestedData;
//         }

//         $json_data = array(
//             "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//             "recordsTotal" => intval($totalData), // total number of records
//             "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//             "data" => $data   // total data array
//         );

//         echo json_encode($json_data);  
//     }





//          function get_server_side_subcoa() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'ID',
//             1 => 'FLEX_VALUE',
//             2 => 'SUBACCOUNT_DESC',
//             3 => 'ENABLED_FLAG',
//             4 => 'SUMMARY_FLAG',
//             5 => 'CREATE_DATE',
//             6 => 'CREATE_BY',
//             7 => 'UPDATE_BY',
//             8 => 'UPDATE_DATE',
//             9 => 'IS_TRASH'
           
//         );

//         $sql = "SELECT * from TBL_M_SUBACCOUNT";            
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'and SUBACCOUNT_DESC like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from TBL_M_SUBACCOUNT where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SUBACCOUNT_DESC like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
//             }
           
//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
//             $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//             $totalFiltered = $totalData;
//         } else {
//              $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
//         }

//         $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
//         $data = array();
//         $no=$_POST['start']+1;
//         foreach ($row as $row) {
//             # code...
//             // preparing an array
//             $nestedData = array();
           
//             $nestedData[] = $no++;     
//             $nestedData[] = $row["ID"];     
//             $nestedData[] = $row["FLEX_VALUE"];
//             $nestedData[] = $row["SUBACCOUNT_DESC"];
//             $nestedData[] = $row["ENABLED_FLAG"];     
//             $nestedData[] = $row["SUMMARY_FLAG"];
          
            
//             // $nestedData[] = $row["Status"];

//             // if($row["IS_TRASH"]==0)
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate2" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
//             // }
//             // else
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate2" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
//             // }

//             $data[] = $nestedData;
//         }

//         $json_data = array(
//             "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//             "recordsTotal" => intval($totalData), // total number of records
//             "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//             "data" => $data   // total data array
//         );

//         echo json_encode($json_data);  
//     }


//    function get_server_side_lob() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'ID',
//             1 => 'FLEX_VALUE',
//             2 => 'LOB_DESC',
//             3 => 'ENABLED_FLAG',
//             4 => 'SUMMARY_FLAG',
//             5 => 'CREATE_DATE',
//             6 => 'CREATE_BY',
//             7 => 'UPDATE_BY',
//             8 => 'UPDATE_DATE',
//             9 => 'IS_TRASH'
           
//         );

//         $sql = "SELECT * from TBL_M_LOB";            
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'and LOB_DESC like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from TBL_M_LOB where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
//                 $sql .= "and LOB_DESC like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
//             }
           
//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
//             $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//             $totalFiltered = $totalData;
//         } else {
//              $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
//         }

//         $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
//         $data = array();
//         $no=$_POST['start']+1;
//         foreach ($row as $row) {
//             # code...
//             // preparing an array
//             $nestedData = array();
           
//             $nestedData[] = $no++;     
//             $nestedData[] = $row["ID"];     
//             $nestedData[] = $row["FLEX_VALUE"];
//             $nestedData[] = $row["LOB_DESC"];
//             $nestedData[] = $row["ENABLED_FLAG"];     
//             $nestedData[] = $row["SUMMARY_FLAG"];
          
            
//             // $nestedData[] = $row["Status"];

//             // if($row["IS_TRASH"]==0)
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate3" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
//             // }
//             // else
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate3" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
//             // }

//             $data[] = $nestedData;
//         }

//         $json_data = array(
//             "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//             "recordsTotal" => intval($totalData), // total number of records
//             "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//             "data" => $data   // total data array
//         );

//         echo json_encode($json_data);  
//     }




//    function get_server_side_division() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'ID',
//             1 => 'FLEX_VALUE',
//             2 => 'DIV_DESC',
//             3 => 'ENABLED_FLAG',
//             4 => 'SUMMARY_FLAG',
//             5 => 'CREATE_DATE',
//             6 => 'CREATE_BY',
//             7 => 'UPDATE_BY',
//             8 => 'UPDATE_DATE',
//             9 => 'IS_TRASH'
           
//         );

//         $sql = "SELECT * from TBL_M_DIVISION";            
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'and DIV_DESC like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from TBL_M_DIVISION where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
//                 $sql .= "and DIV_DESC like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
//             }
           
//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
//             $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//             $totalFiltered = $totalData;
//         } else {
//              $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
//         }

//         $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
//         $data = array();
//         $no=$_POST['start']+1;
//         foreach ($row as $row) {
//             # code...
//             // preparing an array
//             $nestedData = array();
           
//             $nestedData[] = $no++;     
//             $nestedData[] = $row["ID"];     
//             $nestedData[] = $row["FLEX_VALUE"];
//             $nestedData[] = $row["DIV_DESC"];
//             $nestedData[] = $row["ENABLED_FLAG"];     
//             $nestedData[] = $row["SUMMARY_FLAG"];
          
            
//             // $nestedData[] = $row["Status"];

//             // if($row["IS_TRASH"]==0)
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate4" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
//             // }
//             // else
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate4" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
//             // }

//             $data[] = $nestedData;
//         }

//         $json_data = array(
//             "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//             "recordsTotal" => intval($totalData), // total number of records
//             "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//             "data" => $data   // total data array
//         );

//         echo json_encode($json_data);  
//     }





//    function get_server_side_type() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'ID',
//             1 => 'FLEX_VALUE',
//             2 => 'TYPE_DESC',
//             3 => 'ENABLED_FLAG',
//             4 => 'SUMMARY_FLAG',
//             5 => 'CREATE_DATE',
//             6 => 'CREATE_BY',
//             7 => 'UPDATE_BY',
//             8 => 'UPDATE_DATE',
//             9 => 'IS_TRASH'
           
//         );

//         $sql = "SELECT * from TBL_M_TYPE";            
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'and TYPE_DESC like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from TBL_M_TYPE where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
//                 $sql .= "and TYPE_DESC like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
//             }
           
//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
//             $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//             $totalFiltered = $totalData;
//         } else {
//              $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
//         }

//         $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
//         $data = array();
//         $no=$_POST['start']+1;
//         foreach ($row as $row) {
//             # code...
//             // preparing an array
//             $nestedData = array();
           
//             $nestedData[] = $no++;     
//             $nestedData[] = $row["ID"];     
//             $nestedData[] = $row["FLEX_VALUE"];
//             $nestedData[] = $row["TYPE_DESC"];
//             $nestedData[] = $row["ENABLED_FLAG"];     
//             $nestedData[] = $row["SUMMARY_FLAG"];
          
            
//             // $nestedData[] = $row["Status"];

//             // if($row["IS_TRASH"]==0)
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate5" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
//             // }
//             // else
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate5" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
//             // }

//             $data[] = $nestedData;
//         }

//         $json_data = array(
//             "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//             "recordsTotal" => intval($totalData), // total number of records
//             "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//             "data" => $data   // total data array
//         );

//         echo json_encode($json_data);  
//     }



// function get_server_side_project() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'ID',
//             1 => 'FLEX_VALUE',
//             2 => 'PROJECT_DESC',
//             3 => 'ENABLED_FLAG',
//             4 => 'SUMMARY_FLAG',
//             5 => 'CREATE_DATE',
//             6 => 'CREATE_BY',
//             7 => 'UPDATE_BY',
//             8 => 'UPDATE_DATE',
//             9 => 'IS_TRASH'
           
//         );

//         $sql = "SELECT * from TBL_M_PROJECT";            
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'and PROJECT_DESC like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from TBL_M_PROJECT where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
//                 $sql .= "and TYPE_DESC like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
//             }
           
//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
//             $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//             $totalFiltered = $totalData;
//         } else {
//              $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
//         }

//         $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
//         $data = array();
//         $no=$_POST['start']+1;
//         foreach ($row as $row) {
//             # code...
//             // preparing an array
//             $nestedData = array();
           
//             $nestedData[] = $no++;     
//             $nestedData[] = $row["ID"];     
//             $nestedData[] = $row["FLEX_VALUE"];
//             $nestedData[] = $row["PROJECT_DESC"];
//             $nestedData[] = $row["ENABLED_FLAG"];     
//             $nestedData[] = $row["SUMMARY_FLAG"];
          
            
//             // $nestedData[] = $row["Status"];

//             // if($row["IS_TRASH"]==0)
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate6" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
//             // }
//             // else
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate6" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
//             // }

//             $data[] = $nestedData;
//         }

//         $json_data = array(
//             "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//             "recordsTotal" => intval($totalData), // total number of records
//             "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//             "data" => $data   // total data array
//         );

//         echo json_encode($json_data);  
//     }





//     function get_server_side_future1() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'ID',
//             1 => 'FLEX_VALUE',
//             2 => 'FUTURE1_DESC',
//             3 => 'ENABLED_FLAG',
//             4 => 'SUMMARY_FLAG',
//             5 => 'CREATE_DATE',
//             6 => 'CREATE_BY',
//             7 => 'UPDATE_BY',
//             8 => 'UPDATE_DATE',
//             9 => 'IS_TRASH'
           
//         );

//         $sql = "SELECT * from TBL_M_FUTURE1";            
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'and FUTURE1_DESC like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from TBL_M_FUTURE1 where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
//                 $sql .= "and FUTURE1_DESC like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
//             }
           
//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
//             $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//             $totalFiltered = $totalData;
//         } else {
//              $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
//         }

//         $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
//         $data = array();
//         $no=$_POST['start']+1;
//         foreach ($row as $row) {
//             # code...
//             // preparing an array
//             $nestedData = array();
           
//             $nestedData[] = $no++;     
//             $nestedData[] = $row["ID"];     
//             $nestedData[] = $row["FLEX_VALUE"];
//             $nestedData[] = $row["FUTURE1_DESC"];
//             $nestedData[] = $row["ENABLED_FLAG"];     
//             $nestedData[] = $row["SUMMARY_FLAG"];
          
            
//             // $nestedData[] = $row["Status"];

//             // if($row["IS_TRASH"]==0)
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate7" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
//             // }
//             // else
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate7" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
//             // }

//             $data[] = $nestedData;
//         }

//         $json_data = array(
//             "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//             "recordsTotal" => intval($totalData), // total number of records
//             "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//             "data" => $data   // total data array
//         );

//         echo json_encode($json_data);  
//     }



//      function get_server_side_future2() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'ID',
//             1 => 'FLEX_VALUE',
//             2 => 'FUTURE2_DESC',
//             3 => 'ENABLED_FLAG',
//             4 => 'SUMMARY_FLAG',
//             5 => 'CREATE_DATE',
//             6 => 'CREATE_BY',
//             7 => 'UPDATE_BY',
//             8 => 'UPDATE_DATE',
//             9 => 'IS_TRASH'
           
//         );

//         $sql = "SELECT * from TBL_M_FUTURE2";            
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'and ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'and FUTURE2_DESC like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from TBL_M_FUTURE2 where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'";
//                 $sql .= "and FUTURE2_DESC like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
               
               
//             }
           
//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
//             $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
//             $totalFiltered = $totalData;
//         } else {
//              $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
//         }

//         $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
//         $data = array();
//         $no=$_POST['start']+1;
//         foreach ($row as $row) {
//             # code...
//             // preparing an array
//             $nestedData = array();
           
//             $nestedData[] = $no++;     
//             $nestedData[] = $row["ID"];     
//             $nestedData[] = $row["FLEX_VALUE"];
//             $nestedData[] = $row["FUTURE2_DESC"];
//             $nestedData[] = $row["ENABLED_FLAG"];     
//             $nestedData[] = $row["SUMMARY_FLAG"];
          
            
//             // $nestedData[] = $row["Status"];

//             // if($row["IS_TRASH"]==0)
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate8" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
//             // }
//             // else
//             // {
//             //     $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate8" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
//             // }

//             $data[] = $nestedData;
//         }

//         $json_data = array(
//             "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//             "recordsTotal" => intval($totalData), // total number of records
//             "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//             "data" => $data   // total data array
//         );

//         echo json_encode($json_data);  
//     }




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



    public function get_server_side_coa() {    
       $icolumn = array('ID', 'FLEX_VALUE', 'ACCOUNT_DESC',  'ENABLED_FLAG', 'SUMMARY_FLAG', 'PARENT_FLEX');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_M_ACCOUNT', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->FLEX_VALUE;
            $row[] = $idatatables->ACCOUNT_DESC;
            $row[] = $idatatables->ENABLED_FLAG;
            $row[] = $idatatables->SUMMARY_FLAG;
            $row[] = $idatatables->PARENT_FLEX;
           

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



    public function get_server_side_subcoa() {    
       $icolumn = array('ID', 'FLEX_VALUE', 'SUBACCOUNT_DESC',  'ENABLED_FLAG', 'SUMMARY_FLAG');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_M_SUBACCOUNT', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->FLEX_VALUE;
            $row[] = $idatatables->SUBACCOUNT_DESC;
            $row[] = $idatatables->ENABLED_FLAG;
            $row[] = $idatatables->SUMMARY_FLAG;
            // $row[] = $idatatables->PARENT_FLEX;
           

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




     public function get_server_side_lob() {    
       $icolumn = array('ID', 'FLEX_VALUE', 'LOB_DESC',  'ENABLED_FLAG', 'SUMMARY_FLAG');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_M_LOB', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->FLEX_VALUE;
            $row[] = $idatatables->LOB_DESC;
            $row[] = $idatatables->ENABLED_FLAG;
            $row[] = $idatatables->SUMMARY_FLAG;
            // $row[] = $idatatables->PARENT_FLEX;
           

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



     public function get_server_side_division() {    
       $icolumn = array('ID', 'FLEX_VALUE', 'DIV_DESC',  'ENABLED_FLAG', 'SUMMARY_FLAG');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_M_DIVISION', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->FLEX_VALUE;
            $row[] = $idatatables->DIV_DESC;
            $row[] = $idatatables->ENABLED_FLAG;
            $row[] = $idatatables->SUMMARY_FLAG;
            // $row[] = $idatatables->PARENT_FLEX;
           

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



     public function get_server_side_type() {    
       $icolumn = array('ID', 'FLEX_VALUE', 'TYPE_DESC',  'ENABLED_FLAG', 'SUMMARY_FLAG');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_M_TYPE', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->FLEX_VALUE;
            $row[] = $idatatables->TYPE_DESC;
            $row[] = $idatatables->ENABLED_FLAG;
            $row[] = $idatatables->SUMMARY_FLAG;
            // $row[] = $idatatables->PARENT_FLEX;
           

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


     public function get_server_side_project() {    
       $icolumn = array('ID', 'FLEX_VALUE', 'PROJECT_DESC',  'ENABLED_FLAG', 'SUMMARY_FLAG');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_M_PROJECT', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->FLEX_VALUE;
            $row[] = $idatatables->PROJECT_DESC;
            $row[] = $idatatables->ENABLED_FLAG;
            $row[] = $idatatables->SUMMARY_FLAG;
            // $row[] = $idatatables->PARENT_FLEX;
           

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


     public function get_server_side_future1() {    
       $icolumn = array('ID', 'FLEX_VALUE', 'FUTURE1_DESC',  'ENABLED_FLAG', 'SUMMARY_FLAG');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_M_FUTURE1', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->FLEX_VALUE;
            $row[] = $idatatables->FUTURE1_DESC;
            $row[] = $idatatables->ENABLED_FLAG;
            $row[] = $idatatables->SUMMARY_FLAG;
            // $row[] = $idatatables->PARENT_FLEX;
           

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


      public function get_server_side_future2() {    
       $icolumn = array('ID', 'FLEX_VALUE', 'FUTURE2_DESC',  'ENABLED_FLAG', 'SUMMARY_FLAG');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_M_FUTURE2', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->FLEX_VALUE;
            $row[] = $idatatables->FUTURE2_DESC;
            $row[] = $idatatables->ENABLED_FLAG;
            $row[] = $idatatables->SUMMARY_FLAG;
            // $row[] = $idatatables->PARENT_FLEX;
           

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
















    public function ajax_UpdateStatusCategory(){
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id_Raw = trim(element('Raw_ID',$i_list));
        $name = trim(element('name',$i_list));
        // $id = trim(element('VendorTypeID',$i_list));
        $id_kyw=(int)$this->session->userdata('id_kyw');
        $Status = trim(element('Status',$i_list));
        
        $data = array(
            'Raw_ID' => $id_Raw,
            'VendorTypeID' => $id,
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



    // public function ajax_UpdateCategory(){
    //     // print_r('dsds');
    //     $this->load->helper('array');
    //     $i_list = $this->input->post('sTbl');

    //     $id_kyw=(int)$this->session->userdata('id_kyw');
    //     $ID = trim(element('ID',$i_list));
    //     $id_zonasi = element('id_zonasi',$i_list); 
    //     // $iStatus = trim(element('Status',$i_list));
         
    //      $id_Raw = $this->master_coa_m->getIdMax();
    //      $id = $this->master_coa_m->getIdMax_typeid();
    //     if(element('ID',$i_list)=="Generate"){
    //         // echo "1";
           
    //          $data = array(
    //         'ID' => $ID,
    //         'ZONE_ID' => $id_zonasi,
    //         // 'VendorTypeName' => $VendorTypeName,
            
    //         'Status' => $iStatus,
    //         'CreateBy' => $id_kyw,
    //         'CreateDate' => date('Y-m-d H:i:s'),
            
    //     );
    //         // print_r($data); die(); 
    //    }else{
    //     // echo "2";
    //         $ID = trim(element('ID',$i_list));
    //      $data = array(
            
            
    //         'ZONE_ID' => $id_zonasi,
    //         // 'UpdateBy' => $id_kyw,
    //         // 'UpdateDate' => date('Y-m-d H:i:s'),
            
    //     );
    //    }
      
    //    // print_r($data); die();
    //     if(element('ID',$i_list)=="Generate"){
    //     $model = $this->master_coa_m->simpan('TBL_M_BRANCH', $data);
    //     if ($model) {
    //             $msg = 'Data Berhasil Disimpan';
    //         } else {
    //             $msg = 'Data gagal Disimpan';
    //         }
    //    }else{
    //     $model = $this->global_m->ubah('TBL_M_BRANCH', $data,'ID',$ID);
    //     if ($model) {
    //             $msg = 'Data Berhasil Diubah';
    //         } else {
    //             $msg = 'Data gagal Diubah';
    //         }
    //    }

    //     if ($model) {
    //         $notifikasi = Array(
    //             'msgType' => true,
    //             'msgTitle' => 'Success',
    //             'msg' => $msg
    //         );
    //     } else {
    //         $notifikasi = Array(
    //             'msgType' => false,
    //             'msgTitle' => 'Error',
    //             'msg' => $msg
    //         );
    //     }
    //     echo json_encode($notifikasi);
    // }

    //    function edit_user() {
    //    // print_r(trim($this->input->post('email'))) ; die();
    //     $data['nik'] = trim($this->input->post('nik'));
    //     $data['user_name'] = trim($this->input->post('user_name'));
    //     $data['name'] = trim($this->input->post('name'));
    //     $data['email'] = trim($this->input->post('email'));
    //     $data['idsdm'] = trim($this->input->post('idsdm'));
    //     $data['user_groupid'] = trim($this->input->post('userGroup'));
    //     $data['status'] = trim($this->input->post('statusUser'));
    //     $data['FLEX_VALUE_DIVISI'] = trim($this->input->post('FLEX_VALUE_DIVISI'));
    //     $data['FLEX_VALUE_BRANCH'] = trim($this->input->post('FLEX_VALUE_BRANCH'));
    //     $data['PositionID'] = trim($this->input->post('PositionID'));
    //     $data['ZoneID'] = trim($this->input->post('ZoneID'));
    //     $data['user_id'] = trim($this->input->post('user_id'));

    //     // print_r($data); die();

    //     // $id_kolom = array(

    //     // 'user_id' => $data['user_id']

    //     // );

    //     $datax = array(
    //         'nik' => $data['nik'],
    //         'user_name' => $data['user_name'],
    //         'name' => $data['name'],
    //         'user_email' => $data['email'],
    //         // 'user_id' => $data['user_id'],
    //         'update_date' => date('Y-m-d h:i:s'),
    //         // 'ZoneID' => 123,
    //         'status' => $data['status'],
    //         'user_groupid' => $data['user_groupid'],
    //         'DivisionID' => $data['FLEX_VALUE_DIVISI'],
    //         'BranchID' => $data['FLEX_VALUE_BRANCH'],
    //         'PositionID' =>  $data['PositionID'],
    //         'ZoneID' => $data['ZoneID'],
    //         'idsdm' => $data['idsdm']  
    //         );
    //      print_r($datax); die();
    //       $table = "user";
    //       $id_kolom = "user_id = '".$data['user_id']."'";
    //       $model = $this->global_m->ubah($table,$datax, $id_kolom);
    //       redirect('admin/sec_user/home');

    // }



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