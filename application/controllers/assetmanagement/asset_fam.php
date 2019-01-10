<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class asset_fam extends CI_Controller {

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
            $this->load->model('assetmanagement_m/asset_fam_m');
            $this->load->model('datatables_custom');
            $this->load->model('datatables');
        }
    }

    public function print_qr() {
        $idAssets = $this->input->get('sId');
        $data['qr_code'] = $this->global_m->tampil_data("SELECT * FROM VW_ASSETS_QRCODE WHERE ID_ASSET IN (" . $idAssets . ")");
        $this->load->view('assetmanagement_v/print_qr_c', $data);
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
        $menuId = $this->home_m->get_menu_id('assetmanagement/asset_fam/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['item_user'] = $this->asset_fam_m->tampil_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Data Asset Fam');
        $this->template->load('template/template_dataTable', 'assetmanagement_v/asset_fam_v', $data);
    }

//     function get_server_side() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus = $this->input->post('sStatus');
//         $iSearch = $this->input->post('sSearch');
//         $columns = array(
//             // datatable column index  => database column name
//             0 => 'ID_ASSET',
//             1 => 'ITEM_ID',
//             2 => 'ItemName',
//             3 => 'SN',
//             4 => 'QTY',
//             5 => 'TGL_ASSET',
//             6 => 'BranchID',
//             7 => 'BRANCH_DESC',
//             8 => 'DivisionID',
//             9 => 'DIV_DESC',
//             10 => 'ZONE_ID',
//             11 => 'ZoneName',
//             12 => 'AssetType',
//             13 => 'IMAGE_PATH',
//             14 => 'KONDISI',
//             15 => 'ID_ASSET_OLD'
//         );

//         $sql = "SELECT * from VW_ASSET";


//         $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();

//         $totalFiltered = $totalData;

//         if (!empty($requestData['search']['value'])) {
//             if ($iSearch == '1') {
//                 $sql = "SELECT * from VW_ASSET";
//             } else {
//                 $sql = "SELECT * from VW_ASSET";
//             }

//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET " . $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";

//             $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();
//             $totalFiltered = $totalData;
//         } else {
//             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET " . $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
//         }

//         $row = $this->global_m->tampil_semua_array($sql)->result_array();
//         // print_r($row); die();
//         $data = array();
//         $no = $_POST['start'] + 1;
//         foreach ($row as $row) {
//             # code...
//             // preparing an array
//             $nestedData = array();

//             $nestedData[] = $no++;
//             $nestedData[] = $row["ID_ASSET"];
//             $nestedData[] = $row["ID_ASSET"];
//             $nestedData[] = $row["ZoneName"];
//             $nestedData[] = $row["BRANCH_DESC"];
//             $nestedData[] = $row["DIV_DESC"];
//             $nestedData[] = date('d-m-Y', strtotime($row["TGL_ASSET"]));
//             $nestedData[] = $row["ID_ASSET"];
//             $nestedData[] = $row["ID_ASSET_OLD"];
//             $nestedData[] = $row["ItemName"];
//             $nestedData[] = $row["QTY"];
//             $nestedData[] = $row["IMAGE_PATH"];
//             $nestedData[] = $row["KONDISI"];

//             // $nestedData[] = '<a class="btn btn-sm btn-primary"<a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_depresiasi">Depresiasi';
//             // $nestedData[] = $row["Status"];


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
        $icolumn = array('ID_ASSET', 'ITEM_ID', 'ItemName', 'QTY', 'TGL_ASSET', 'BranchID','BRANCH_DESC','DivisionID','DIV_DESC','ZONE_ID','ZoneName','AssetType','IMAGE_PATH','ID_ASSET_OLD','KONDISI','STATUS_TRANS','QR','ASSET_NUMBER','ASSET_DESC','JNS_PERIODE','START_PERIODE','END_PERIODE','NOTIF','SN');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );

        if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
            $iwhere = array(
                'Tgl_Req <' => date("Y-m-d", strtotime($this->input->post('sMulai'))),
                'Tgl_Req >' => date("Y-m-d", strtotime($this->input->post('sSampai')))
            );
        }else{
            $iwhere = array();
        }
        // print_r($iwhere); die();
        $iorder = array('ID_ASSET' => 'asc');
        $list = $this->datatables->get_datatables('VW_ASSET', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;



            $row[] = $idatatables->ID_ASSET;
            $row[] = $idatatables->ID_ASSET;
            $row[] = $idatatables->ZoneName;
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = $idatatables->DIV_DESC;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_ASSET));
            $row[] = $idatatables->ID_ASSET;
            $row[] = $idatatables->ID_ASSET_OLD;
            // $row[] = $idatatables->JML_ITEM;
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->QTY;
            $row[] = $idatatables->IMAGE_PATH;
            $row[] = $idatatables->KONDISI;
            // <a href="'.base_url().'procurement/fpur/detail_fpur/'.$idatatables->RequestID.'" class="btn btn-primary">VIEW</a>

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

    public function get_datatransfer() {
        $icolumn = array('ID', 'TGL_PENGAJUAN', 'PIC', 'JML_ITEM', 'WIL_BALAI_LELANG', 'HARGA_PERKIRAAN', 'CREATE_BY', 'CREATE_DATE');
        // $iwhere = array('STATUS_TRANS' => 1);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_T_ASSETS_PENJUALAN', $icolumn, $iorder);
        // print_r($list);
        // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_PENGAJUAN));
            $row[] = $idatatables->PIC;
            $row[] = $idatatables->JML_ITEM;
            $row[] = $idatatables->WIL_BALAI_LELANG;
            $row[] = $idatatables->HARGA_PERKIRAAN;
            $row[] = '';
            $row[] = '';


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

    public function get_server_side_kehilangan() {

        $icolumn = array('ID_ASSET', 'ItemName', 'QR');
//        $icolumn = array('HpsID');
        // $iwhere = array();
        $ID_ASSET = explode(',', $this->input->post('sID_ASSET'));

        // print_r($ID_ASSET); die();
        // $iwhere = array(
        //     'RequestID' => $this->input->post('sID_PR')
        //     // $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('ID_ASSET' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_ASSET', $icolumn, $iorder, array(), array(), $ID_ASSET, 'ID_ASSET');
        // print_r($list);
        // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID_ASSET;
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->QR;


            $data[] = $row;
        }

        // $count_asset = $this->transferout_m->count_asset();

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );


        //output to json format
        echo json_encode($output);
    }

    public function get_server_side_kerusakan() {

        $icolumn = array('ID_ASSET', 'ItemName', 'QR');
//        $icolumn = array('HpsID');
        // $iwhere = array();
        $ID_ASSET = explode(',', $this->input->post('sID_ASSET'));

        // print_r($ID_ASSET); die();
        // $iwhere = array(
        //     'RequestID' => $this->input->post('sID_PR')
        //     // $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('ID_ASSET' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_ASSET', $icolumn, $iorder, array(), array(), $ID_ASSET, 'ID_ASSET');
        // print_r($list);
        // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID_ASSET;
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->QR;


            $data[] = $row;
        }

        // $count_asset = $this->transferout_m->count_asset();

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );


        //output to json format
        echo json_encode($output);
    }

    public function get_server_side_pengajuan() {

        $icolumn = array('ID_ASSET', 'ZoneName', 'BRANCH_DESC', 'ItemName', 'KONDISI');
//        $icolumn = array('HpsID');
        // $iwhere = array();
        $ID_ASSET = explode(',', $this->input->post('sID_ASSET'));

        // print_r($ID_ASSET); die();
        // $iwhere = array(
        //     'RequestID' => $this->input->post('sID_PR')
        //     // $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('ID_ASSET' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_ASSET', $icolumn, $iorder, array(), array(), $ID_ASSET, 'ID_ASSET');
        // print_r($list);
        // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ZoneName;
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = '';
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->ID_ASSET;
            $row[] = $idatatables->KONDISI;


            $data[] = $row;
        }

        // $count_asset = $this->transferout_m->count_asset();

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );


        //output to json format
        echo json_encode($output);
    }

//      function get_server_side_depresiasi() {
//         $requestData = $_REQUEST;
// //        print_r($requestData);die();
//         $iStatus=$this->input->post('sStatus');
//         // $iSearch=$this->input->post('sSearch');
//         // $rows = $this->getfamassetlist($iStatus); 
//         $rows =$rows['data'];
//          // print_r(count($rows)); die();
//         $data = array();
//         $no=$_POST['start']+1;
//         foreach ($rows as $row) {
//             // print_r($row); die();
//             # code...
//             // preparing an array
//             $nestedData = array();
//             $nestedData[] = $no++;     
//             // $nestedData[] = $row["FAM_ASSET_ID"];     
//             $nestedData[] = $row["ID_ASSET"];
//             $nestedData[] = $row["TOTAL_AMOUNT"];
//             $nestedData[] = $row["QR"];   
//             $data[] = $nestedData;
//         }
//         $json_data = array(
//             // "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//             "recordsTotal" => count($rows), // total number of records
//             // "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//             "data" => $data   // total data array
//         );
//         echo json_encode($json_data);  
//     }








    function get_server_adjustman() {

//        print_r($requestData);die();
        $iStatus = $this->input->post('sid');
        // $iSearch=$this->input->post('sSearch');

        $rows = $this->getfamadjustman($iStatus);
        $html = '';
        $html.='<tr>';
        foreach ($rows['data'] as $data) {
            // print_r($data); die();
            $html.='<td>' . $data['ASSET_NUMBER'] . '</td>';
            $html.='<td>' . $data['ADJUSTED_COST'] . '</td>';
            $html.='<td>' . $data['LIFE_YEARS'] . '</td>';
            // $html.='<td>'.$data['ASSET_NUMBER'].'</td>';
        }
        $html.='</tr>';

        echo json_encode($html);
    }

    function getfamassetlist($Param) {
        // $Param='100000';
        // $this->getfamkota();
        // die("j");
        $jsonarr = [
            'table' => 'PNM_FA_DEPRN_V',
            // 'filter'=>array($Param=>"WHERE/".$ValueParam)
            'filter' => [ 'ASSET_NUMBER' => "where/" . $Param]

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
            'filter' => [ 'ASSET_NUMBER' => "where/" . $Param]

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

    function savedata() {
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $ID_ASSET = trim(element('ID_ASSET', $i_list));

        $id_TANGGAL = date('Y-m-d', strtotime(trim(element('id_TANGGAL', $i_list))));
// print_r(explode(',', $ID_ASSET)); die();
        foreach (explode(',', $ID_ASSET) as $ID) {
            $PARAMS = array(
                'ID_ASSET' => $ID,
                'TANGGAL' => $id_TANGGAL,
                'HAPUS' => 'KEHILANGAN',
                'STATUS' => 0,
                'CREATE_BY' => 'CREATE_BY',
                'CREATE_DATE' => date("Y/m/d H:i:s")
            );
            $model = $this->global_m->simpan('TBL_T_ASSETS_HAPUS', $PARAMS);
        }


        // print_r($PARAMS); die();
        // $this->db->query("zsp_Create_PR_Group ?,?",$PARAMS);

        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been saved.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function savedatapengajuan() {
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $ID_ASSET = trim(element('ID_ASSET', $i_list));
        $id_JML_ITEM = trim(element('id_JML_ITEM', $i_list));
        $id_PIC = trim(element('id_PIC', $i_list));
        $id_WIL_BALAI_LELANG = trim(element('id_WIL_BALAI_LELANG', $i_list));
        $id_TANGGAL = date('Y-m-d', strtotime(trim(element('id_TGL_PENGAJUAN', $i_list))));
        $ID_PENJUALAN = $this->global_m->getIdMax('ID', 'TBL_T_ASSETS_PENJUALAN');
        $PARAMS = array(
            'ID' => $ID_PENJUALAN,
            'TGL_PENGAJUAN' => $id_TANGGAL,
            'JML_ITEM' => $id_JML_ITEM,
            'PIC' => $id_PIC,
            'WIL_BALAI_LELANG' => $id_WIL_BALAI_LELANG,
            'STATUS' => 0,
            'CREATE_BY' => 'CREATE_BY',
            'CREATE_DATE' => date("Y/m/d H:i:s")
        );
        // print_r($PARAMS); die();
        // $this->db->query("zsp_Create_PR_Group ?,?",$PARAMS);
        $model = $this->global_m->simpan('TBL_T_ASSETS_PENJUALAN', $PARAMS);

        foreach (explode(',', $ID_ASSET) as $ID) {
            $PARAMS = array(
                'ID_ASSET' => $ID,
                'ID_ASSET_PENJUALAN' => $ID_PENJUALAN,
                'TANGGAL' => $id_TANGGAL,
                'HAPUS' => 'PENJUALAN',
                'STATUS' => 0,
                'CREATE_BY' => 'CREATE_BY',
                'CREATE_DATE' => date("Y/m/d H:i:s")
            );
            $model = $this->global_m->simpan('TBL_T_ASSETS_HAPUS', $PARAMS);
        }


        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been saved.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function savedatakerusakan() {
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $ID_ASSET = trim(element('ID_ASSET', $i_list));

        $id_TANGGAL = date('Y-m-d', strtotime(trim(element('id_TANGGAL', $i_list))));
// print_r(explode(',', $ID_ASSET)); die();
        foreach (explode(',', $ID_ASSET) as $ID) {
            $PARAMS = array(
                'ID_ASSET' => $ID,
                'TANGGAL' => $id_TANGGAL,
                'HAPUS' => 'KERUSAKAN',
                'STATUS' => 0,
                'CREATE_BY' => 'CREATE_BY',
                'CREATE_DATE' => date("Y/m/d H:i:s")
            );
            $model = $this->global_m->simpan('TBL_T_ASSETS_HAPUS', $PARAMS);
        }


        // print_r($PARAMS); die();
        // $this->db->query("zsp_Create_PR_Group ?,?",$PARAMS);

        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been saved.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.'
            );
        }
        $this->output->set_output(json_encode($array));
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