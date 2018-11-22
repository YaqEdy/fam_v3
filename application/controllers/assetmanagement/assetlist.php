<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class assetlist extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
            $this->load->model('global_m');
            $this->load->model('assetmanagement_m/assetlist_m');
            $this->load->model('datatables_custom');
            $this->load->model('api/api_m');
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
        $menuId = $this->home_m->get_menu_id('assetmanagement/assetlist/home');
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
    
        $this->template->set('title', 'Data Asset List');
        $this->template->load('template/template_dataTable', 'assetmanagement_v/assetlist_v', $data);
    }

    function get_server_side() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus = $this->input->post('sStatus');
        $iSearch = $this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID_ASSET',
            1 => 'ITEM_ID',
            2 => 'ItemName',
            3 => 'SN',
            4 => 'QTY',
            5 => 'TGL_ASSET',
            6 => 'BranchID',
            7 => 'BRANCH_DESC',
            8 => 'DivisionID',
            9 => 'DIV_DESC',
            10 => 'ZONE_ID',
            11 => 'ZoneName',
            12 => 'AssetType',
            13 => 'IMAGE_PATH',
            14 => 'KONDISI',
            15 => 'ID_ASSET_OLD'
        );

        $sql = "SELECT * from VW_ASSET";


        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();

        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch == '1') {
                $sql = "SELECT * from VW_ASSET";
            } else {
                $sql = "SELECT * from VW_ASSET";
            }

            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET " . $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";

            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();
            $totalFiltered = $totalData;
        } else {
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET " . $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array();
        // print_r($row); die();
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();

            $nestedData[] = $no++;
            $nestedData[] = $row["ID_ASSET"];
            $nestedData[] = $row["ZoneName"];
            $nestedData[] = $row["BRANCH_DESC"];
            $nestedData[] = $row["DIV_DESC"];
            $nestedData[] = date('d-m-Y', strtotime($row["TGL_ASSET"]));
            $nestedData[] = $row["ID_ASSET"];
            $nestedData[] = $row["ID_ASSET_OLD"];
            $nestedData[] = $row["ItemName"];
            $nestedData[] = $row["QTY"];
            $nestedData[] = $row["IMAGE_PATH"];
            $nestedData[] = $row["KONDISI"];
            $nestedData[] = '<div class="col-md-15">
                            <div class="form-group">
                            <div class="col-sm-8">
                            <select  onchange="asset_fam(this.value,' . $row["ID_ASSET"] . ');"
                            name="laporan" class="form-control" 
                            id="id_laporan">
                            <option value="">--Pilih--</option>
                            <option value="Depresiasi">Depresiasi</option>
                            <option value="Adjustman">Adjustman</option>
                            <option value="Reclass">Reclass</option>
                            >
                        </select>
                    </div>
                </div>
            </div>';
            // $nestedData[] = '<a class="btn btn-sm btn-primary"<a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_depresiasi">Depresiasi';
            // $nestedData[] = $row["Status"];


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

    function get_server_side_depresiasi() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus = $this->input->post('sStatus');
        // $iSearch=$this->input->post('sSearch');


        $rows = $this->getfamassetlist($iStatus);
        $rows = $rows['data'];
        // print_r(count($rows)); die();
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($rows as $row) {

            // print_r($row); die();
            # code...
            // preparing an array
            $nestedData = array();

            $nestedData[] = $no++;
            // $nestedData[] = $row["FAM_ASSET_ID"];     
            $nestedData[] = $row["PERIOD_NAME"];
            $nestedData[] = $row["TOTAL_AMOUNT"];
            $nestedData[] = $row["NET_BOOK_VALUE"];
            $data[] = $nestedData;
        }

        $json_data = array(
            // "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => count($rows), // total number of records
            // "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);
    }
    
    function simpanStgList(){
        $jenisSelect = trim($this->input->post('pilihannya'));
        $idAsset = trim($this->input->post('id_asset'));
//        print_r($_POST);dies();
        if($jenisSelect =='Depresiasi'){
            $jsonarr = array();
        }elseif($jenisSelect =='Adjustman'){
            $jsonarr = [
                'to_table' => 'PNM_FAM_FA_ADJUST_STG',
                'ASSET_BOOK_NAME' => 'PNM COMMERCIAL BOOK',
                'COST_ADJUST' => $_POST['adjust_cost'],
                'SALVAGE_VALUE' => $_POST['salvage_val'],
                'LIFE_IN_YEAR' => $_POST['life_years'],
                'FAM_ASSET_ID' => $idAsset,
            ];
            $tabel = "TBL_T_ASSETS_ADJUST";
            $data_local = array(
                'ID_ASSET' => $idAsset,
                'COST_ADJUST' => $_POST['adjust_cost'],
                'SALVAGE_VALUE' => $_POST['salvage_val'],
                'LIFE_IN_YEAR' => $_POST['life_years'],
                'IS_TRASH' => 0,
                'CREATE_BY' => $this->session->userdata('user_id'),
                'CREATE_DATE' => date('Y-m-d h:i:s'),
            );
        }else{ //Reclass
            
            $KODE = $_POST['assetListKategory'];
            $EXP = explode("#",$KODE);
            $asset = $EXP[0];
            $umur_fiskal = $EXP[1];
            
            $jsonarr = [
                'to_table' => 'PNM_FAM_FA_RECLASS_STG',
                'ASSET_BOOK_NAME' => 'PNM COMMERCIAL BOOK',
                'ASSET_CATEGORY' => $asset,
                'UMUR_FISKAL' => $umur_fiskal,
                'JENIS_BARANG' => $_POST['jnsbrg'],
                'FAM_ASSET_ID' => $idAsset,
            ];
            
            $tabel = "TBL_T_ASSETS_RECLASS";
            $data_local = array(
                'ID_ASSET' => $idAsset,
                
                'ASSET_CATEGORY' => $asset,
                'UMUR_FISKAL' => $umur_fiskal,
                'JNS_BARANG' => $_POST['jnsbrg'],
                'ID_ASSET' => $idAsset,
                
                'IS_TRASH' => 0,
                'CREATE_BY' => $this->session->userdata('user_id'),
                'CREATE_DATE' => date('Y-m-d h:i:s'),
            );
            
        }
        
        
//print_r($jsonarr);die();
        $model = $this->api_m->insert_to_orc($jsonarr);
        if ($model) {
            $model = $this->global_m->simpan($tabel,$data_local);
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Disimpan'
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Data Gagal Disimpan'
            );
        }
        $this->session->set_flashdata('notif', $notifikasi);
        //echo $model;
        redirect('assetmanagement/assetlist/home');
    }
    function cariBrg(){
        $idnya = $this->input->post('idnya',true);
        $query = $this->db->query("select distinct(TypeCode),itemTypeName from Mst_ItemType where IClassID ='$idnya'")->result();
//        echo $this->db->last_query();die();
            $opt[] = "<option value=''></option>";
        foreach ($query as $value) {
            $TypeCode = trim($value->TypeCode);
            $opt[] .= "<option value='$TypeCode'>$value->itemTypeName</option>";
        }
        echo json_encode($opt);
    }
    function get_server_assetlist() {

        $Param = $this->input->post('sid');
        $jenisSelect = trim($this->input->post('jenisSelect'));
//        die($jenisSelect);
        
        if($jenisSelect =='Depresiasi'){
            $filter_where = 'ASSET_NUMBER';
            $table = 'PNM_FA_DEPRN_V';
            $rows = $this->getfamfilterApi($table,$Param,$filter_where);
            if(count($rows) <= 0 ){
                $data['depresi'] = array(0);
            }else{
                $data['depresi'] = $rows['data'];
            }
            $this->load->view('assetmanagement_v/depresi_v', $data);
        }elseif($jenisSelect =='Adjustman'){
            $filter_where = 'ASSET_NUMBER';
            $table = 'PNM_FAM_FA_WORKBENCH_V';
            $rows = $this->getfamfilterApi($table,$Param,$filter_where);
            if(count($rows) <= 0 ){
                 $data['adjustman'] = array(0);
            }else{
                 $data['adjustman'] = $rows['data'];
            }
            $this->load->view('assetmanagement_v/adjustman_v', $data);
        }else{ //Reclass
            $filter_where = 'ASSET_NUMBER';
//            $table = 'PNM_FA_RCLS_V';
            $table = 'PNM_FAM_FA_WORKBENCH_V';
            $rows = $this->getfamfilterApi($table,$Param,$filter_where);
            if(count($rows) <= 0 ){
                 $data['reclass'] = array(0);
            }else{
                 $data['reclass'] = $rows['data'];
            }
            $sql = "SELECT * from Mst_ItemClass";
            $data['itemClass'] = $this->db->query($sql)->result();
           
            $this->load->view('assetmanagement_v/reclass_v', $data);
        }
        
        
        
    }
    
    //punya izal
    function getfamfilterApi($table,$Param,$filter_where) {
        $jsonarr = [
            'table' => $table,
            'filter' => [$filter_where => "where/" . $Param]
        ];
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
        $result = $query->result()[0];
        $curlurl = $result->LINK . "/get_all";

        $ch = curl_init($curlurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($jsonarr));
        $responsejson = curl_exec($ch);
        // print_r($responsejson); die();
        curl_close($ch);

        $response = json_decode($responsejson, true);
        // print_r($response);die();

        return $response;
        // echo json_encode($model);
    }
    
    
    

    function getfamassetlist($Param) {
        // $Param='100000';
        // $this->getfamkota();
        // die("j");
        $jsonarr = [
            'table' => 'PNM_FA_DEPRN_V',
            // 'filter'=>array($Param=>"WHERE/".$ValueParam)
            'filter' => ['ASSET_NUMBER' => "where/" . $Param]
            // 'filter'=>[ 'FAM_ASSET_ID'=>"where/".$Param]
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

        $response = json_decode($responsejson, true);
        // print_r($response);die();

        return $response;
        // echo json_encode($model);
    }

    function getfamadjustman($Param) {
        // $Param='100000';
        // $this->getfamkota();
        // die("j");
        $jsonarr = [
            'table' => 'PNM_FAM_FA_WORKBENCH_V',
            // 'filter'=>array($Param=>"WHERE/".$ValueParam)
            'filter' => ['ASSET_NUMBER' => "where/" . $Param]

            // 'filter'=>[ 'FAM_ASSET_ID'=>"where/".$Param]
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
        // print_r($responsejson); die();
        curl_close($ch);

        $response = json_decode($responsejson, true);
        // print_r($response);die();

        return $response;
        // echo json_encode($model);
    }

    public function ajax_UpdateStatusCategory() {
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id_Raw = trim(element('Raw_ID', $i_list));
        $name = trim(element('name', $i_list));
        // $id = trim(element('VendorTypeID',$i_list));
        $id_kyw = (int) $this->session->userdata('id_kyw');
        $Status = trim(element('Status', $i_list));

        $data = array(
            // 'Raw_ID' => $id_Raw,
            // 'VendorTypeID' => $id,
            'Status' => $Status,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
        );
        $model = $this->global_m->ubah('Mst_VendorType', $data, 'Raw_ID', $id_Raw);
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

    public function ajax_UpdateCategory() {

        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id_kyw = (int) $this->session->userdata('id_kyw');
        $VendorTypeID = trim(element('VendorTypeID', $i_list));
        $VendorTypeName = element('VendorTypeName', $i_list);
        $iStatus = trim(element('Status', $i_list));

        $id_Raw = $this->master_vendortype_m->getIdMax();
        $id = $this->master_vendortype_m->getIdMax_typeid();
        if (element('Raw_ID', $i_list) == "Generate") {
            // echo "1";

            $data = array(
                'Raw_ID' => $id_Raw,
                'VendorTypeID' => $id,
                'VendorTypeName' => $VendorTypeName,
                'Status' => $iStatus,
                'CreateBy' => $id_kyw,
                'CreateDate' => date('Y-m-d H:i:s'),
            );
        } else {
            // echo "2";
            $id = trim(element('Raw_ID', $i_list));
            $data = array(
                'VendorTypeName' => $VendorTypeName,
                'UpdateBy' => $id_kyw,
                'UpdateDate' => date('Y-m-d H:i:s'),
            );
        }

        // print_r($data); die();
        if (element('Raw_ID', $i_list) == "Generate") {
            $model = $this->master_vendortype_m->simpan('Mst_VendorType', $data);
            if ($model) {
                $msg = 'Data Berhasil Disimpan';
            } else {
                $msg = 'Data gagal Disimpan';
            }
        } else {
            $model = $this->master_vendortype_m->ubah('Mst_VendorType', $data, 'Raw_ID', $id);
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