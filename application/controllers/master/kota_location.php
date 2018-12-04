<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class kota_location extends CI_Controller {

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
            $this->load->model('master_m/kota_location_m');
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
        $menuId = $this->home_m->get_menu_id('master/kota_location/home');
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
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Master Kota Dan Location');
        $this->template->load('template/template_dataTable', 'master_v/kota_location_v', $data);
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

//     }
//     function getfamlocation() {
//         $this->getfamkota();
//         // die("j");
//       $jsonarr=[ 
//         'table'=>'PNM_FA_LOCATIONS_V'
//     ];
//     $curlurl="http://192.168.10.241/OCI/index.php/api/v1/fam/get_all";

//     $ch = curl_init($curlurl);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($jsonarr));
//     $responsejson = curl_exec($ch);
//     curl_close($ch);

//     $response=json_decode($responsejson,true);
// // print_r($response['data']);die();

//     $no = 1;
//     $data['data'] = array();
//     foreach ( $response['data'] as $row) {
//         // echo "<pre>";
//         // print_r($response['data']);

//         $cek=$this->global_m->tampil_data("SELECT COUNT(*) as JML FROM TBL_M_LOCATION WHERE LOCATION_ID='".$row['LOCATION_ID']."'")[0]->JML;

//         $data = array(
//             // 'no'=>$no,
//             'LOCATION_ID'=>$row['LOCATION_ID'],
//             'SEGMENT1'=>$row['SEGMENT1'],
//             'SEGMENT2' => $row['SEGMENT2'],
//             'SEGMENT3' => $row['SEGMENT3'],
//             'SUMMARY_FLAG' => $row['SUMMARY_FLAG'],
//             'ENABLED_FLAG' => $row['ENABLED_FLAG'],
//             'UPDATE_DATE' => $row['LAST_UPDATE_DATE'],
//         );

// // array_push($data['data'], $array);

// // $no++;
//         if($cek==0){

//             $model=$this->global_m->simpan('TBL_M_LOCATION',$data);
//         }else{
//             $model=$this->global_m->ubah('TBL_M_LOCATION',$data,'LOCATION_ID',$row['LOCATION_ID']);    
//         }
//     }

//    echo json_encode($model);
// }





  public function get_server_side() {    
       $icolumn = array('LOCATION_ID', 'SEGMENT1', 'SEGMENT2', 'SEGMENT3',  'SUMMARY_FLAG', 'ENABLED_FLAG', 'UPDATE_DATE');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_M_LOCATION', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->LOCATION_ID;
            $row[] = $idatatables->SEGMENT1;
            $row[] = $idatatables->SEGMENT2;
            $row[] = $idatatables->SEGMENT3;
            $row[] = $idatatables->SUMMARY_FLAG;
            $row[] = $idatatables->ENABLED_FLAG;
            $row[] = $idatatables->UPDATE_DATE;


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


     public function get_server_side_kota() {    
       $icolumn = array('FLEX_VALUE_SET_ID', 'FLEX_VALUE_SET_NAME', 'SEGMENT_NAME', 'SEGMENT_PROMPT',  'MAXIMUM_SIZE', 'FLEX_VALUE_ID', 'FLEX_VALUE', 'PARENT_FLEX_VALUE_LOW', 'DESCRIPTION', 'ENABLED_FLAG', 'SUMMARY_FLAG', 'PARENT_FLEX_VALUE');
        // $iwhere = array('STATUS' => 0);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_M_KOTA', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->FLEX_VALUE_SET_ID;
            $row[] = $idatatables->FLEX_VALUE_SET_NAME;
            $row[] = $idatatables->SEGMENT_NAME;
            $row[] = $idatatables->SEGMENT_PROMPT;
            $row[] = $idatatables->MAXIMUM_SIZE;
            $row[] = $idatatables->FLEX_VALUE_ID;
            $row[] = $idatatables->FLEX_VALUE;
            $row[] = $idatatables->PARENT_FLEX_VALUE_LOW;
            $row[] = $idatatables->DESCRIPTION;
            $row[] = $idatatables->ENABLED_FLAG;
            $row[] = $idatatables->SUMMARY_FLAG;
            $row[] = $idatatables->PARENT_FLEX_VALUE;

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







//  function get_server_side() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'LOCATION_ID',
//             1 => 'SEGMENT1',
//             2 => 'SEGMENT2',
//             3 => 'SEGMENT3',
//             4 => 'SUMMARY_FLAG',
//             5 => 'ENABLED_FLAG',
//             6 => 'IS_TRASH',
//             7 => 'CREATE_BY',
//             8 => 'CREATE_DATE',
//             9 => 'UPDATE_BY',
//             10 => 'UPDATE_DATE'
           
//         );

//         $sql = "SELECT * from TBL_M_LOCATION";   

        
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 

//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from TBL_M_LOCATION where IS_TRASH like '%".$iStatus."%'and LOCATION_ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from TBL_M_LOCATION where IS_TRASH like '%".$iStatus."%'and SEGMENT1 like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from TBL_M_LOCATION where IS_TRASH like '%".$iStatus."%'and SEGMENT2 like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from TBL_M_LOCATION where IS_TRASH like '%".$iStatus."%'and SEGMENT3 like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from TBL_M_LOCATION where IS_TRASH like '%".$iStatus."%'and SUMMARY_FLAG like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='6'){
//                 $sql = "SELECT * from TBL_M_LOCATION where IS_TRASH like '%".$iStatus."%'and ENABLED_FLAG like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from TBL_M_LOCATION where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and LOCATION_ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or SEGMENT1 like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SEGMENT2 like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or SEGMENT3 like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SUMMARY_FLAG like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or ENABLED_FLAG like '%".$requestData['search']['value']."%'"; 
               
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
//             $nestedData = array();
           
//             $nestedData[] = $no++;     
//             $nestedData[] = $row["LOCATION_ID"];     
//             $nestedData[] = $row["SEGMENT1"];
//             $nestedData[] = $row["SEGMENT2"];
//             $nestedData[] = $row["SEGMENT3"];     
//             $nestedData[] = $row["SUMMARY_FLAG"];
//             $nestedData[] = $row["ENABLED_FLAG"];
//             $nestedData[] = $row["UPDATE_DATE"];

            
//             // $nestedData[] = $row["Status"];

//             if($row["IS_TRASH"]==0)
//             {
//                 $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
//             }
//             else
//             {
//                 $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
//             }

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





// function getfamkota() {
//         // die("j");
//   $jsonarr=[ 
//     'table'=>'PNM_FA_KOTA_V'
// ];
// $curlurl="http://192.168.10.241/OCI/index.php/api/v1/fam/get_all";

// $ch = curl_init($curlurl);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($jsonarr));
// $responsejson = curl_exec($ch);
// curl_close($ch);

// $response=json_decode($responsejson,true);
// // print_r($response['data']);die();

// foreach ( $response['data'] as $row) {

//     $cek=$this->global_m->tampil_data("SELECT COUNT(*) as JML FROM TBL_M_KOTA WHERE FLEX_VALUE_ID='".$row['FLEX_VALUE_ID']."'")[0]->JML;

//     $data = array(
//         'FLEX_VALUE_SET_ID'=>$row['FLEX_VALUE_SET_ID'],
//         'FLEX_VALUE_SET_NAME'=>$row['FLEX_VALUE_SET_NAME'],
//         'SEGMENT_NAME' => $row['SEGMENT_NAME'],
//         'SEGMENT_PROMPT' => $row['SEGMENT_PROMPT'],
//         'MAXIMUM_SIZE' => $row['MAXIMUM_SIZE'],
//         'FLEX_VALUE_ID' => $row['FLEX_VALUE_ID'],
//         'FLEX_VALUE' => $row['FLEX_VALUE'],
//         'PARENT_FLEX_VALUE_LOW' => $row['PARENT_FLEX_VALUE_LOW'],
//         'DESCRIPTION' => $row['DESCRIPTION'],
//         'ENABLED_FLAG' => $row['ENABLED_FLAG'],
//         'SUMMARY_FLAG' => $row['SUMMARY_FLAG'],
//         'PARENT_FLEX_VALUE' => $row['PARENT_FLEX_VALUE']
//     );

//     if($cek==0){

//         $model=$this->global_m->simpan('TBL_M_KOTA',$data);
//     }else{
//         $model=$this->global_m->ubah('TBL_M_KOTA',$data,'FLEX_VALUE_ID',$row['FLEX_VALUE_ID']);    
//     }
// }

// echo json_encode($model);
// }








//  function get_server_side_kota() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         $iSearch=$this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name

      

//             0 => 'FLEX_VALUE_SET_ID',
//             1 => 'FLEX_VALUE_SET_NAME',
//             2 => 'SEGMENT_NAME',
//             3 => 'SEGMENT_PROMPT',
//             4 => 'MAXIMUM_SIZE',
//             5 => 'FLEX_VALUE_ID',
//             6 => 'FLEX_VALUE',
//             7 => 'PARENT_FLEX_VALUE_LOW',
//             8 => 'DESCRIPTION',
//             9 => 'ENABLED_FLAG',
//             10 => 'SUMMARY_FLAG',
//             11 => 'PARENT_FLEX_VALUE',
//             12 => 'IS_TRASH',
//             13 => 'CREATE_BY',
//             14 => 'CREATE_DATE',
//             15 => 'UPDATE_BY',
//             16 => 'UPDATE_DATE'
           
//         );

//         $sql = "SELECT * from TBL_M_KOTA";   

        
//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 

//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch=='1'){
//                 $sql = "SELECT * from TBL_M_KOTA where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE_SET_ID like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='2'){
//                 $sql = "SELECT * from TBL_M_KOTA where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE_SET_NAME like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='3'){
//                 $sql = "SELECT * from TBL_M_KOTA where IS_TRASH like '%".$iStatus."%'and SEGMENT_NAME like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='4'){
//                 $sql = "SELECT * from TBL_M_KOTA where IS_TRASH like '%".$iStatus."%'and SEGMENT_PROMPT like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='5'){
//                 $sql = "SELECT * from TBL_M_KOTA where IS_TRASH like '%".$iStatus."%'and MAXIMUM_SIZE like '%".$requestData['search']['value']."%'";
//             }else if ($iSearch=='6'){
//                 $sql = "SELECT * from TBL_M_KOTA where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE_ID like '%".$requestData['search']['value']."%'";
//             }
//             else if ($iSearch=='7'){
//                 $sql = "SELECT * from TBL_M_KOTA where IS_TRASH like '%".$iStatus."%'and FLEX_VALUE like '%".$requestData['search']['value']."%'";
//             }else{
//                 $sql = "SELECT * from TBL_M_KOTA where IS_TRASH like '%".$iStatus."%'"; 
//                 $sql .= "and FLEX_VALUE_SET_ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE_SET_NAME like '%".$requestData['search']['value']."%'";
//                 $sql .= "and SEGMENT_PROMPT like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or MAXIMUM_SIZE like '%".$requestData['search']['value']."%'";
//                 $sql .= "and FLEX_VALUE_ID like '%".$requestData['search']['value']."%'"; 
//                 $sql .= "or FLEX_VALUE like '%".$requestData['search']['value']."%'"; 
               
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
//             $nestedData = array();

//             $nestedData[] = $no++;     
//             $nestedData[] = $row["FLEX_VALUE_SET_ID"];     
//             $nestedData[] = $row["FLEX_VALUE_SET_NAME"];
//             $nestedData[] = $row["SEGMENT_NAME"];
//             $nestedData[] = $row["SEGMENT_PROMPT"];     
//             $nestedData[] = $row["MAXIMUM_SIZE"];
//             $nestedData[] = $row["FLEX_VALUE_ID"];
//             $nestedData[] = $row["FLEX_VALUE"];
//             $nestedData[] = $row["PARENT_FLEX_VALUE_LOW"];     
//             $nestedData[] = $row["DESCRIPTION"];
//             $nestedData[] = $row["ENABLED_FLAG"];
//             $nestedData[] = $row["SUMMARY_FLAG"];
//             $nestedData[] = $row["PARENT_FLEX_VALUE"];     
            

            
//             // $nestedData[] = $row["Status"];

//             if($row["IS_TRASH"]==0)
//             {
//                 $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
//             }
//             else
//             {
//                 $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
//             }

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