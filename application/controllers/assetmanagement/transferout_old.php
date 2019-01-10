<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class transferout extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
//          $this->load->model('zsessions_m');
            $this->load->model('global_m');
            $this->load->model('api/api_m');
            $this->load->model('assetmanagement_m/transferout_m');
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
        $menuId = $this->home_m->get_menu_id('assetmanagement/transferout/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['item_branch'] = $this->transferout_m->tampil_branch();
        $data['item_div'] = $this->transferout_m->tampil_division();
        $data['item_tujuan'] = $this->transferout_m->tampil_tujuantransfer();
        $data['item_kota'] = $this->transferout_m->tampil_kota();
        $data['item_lokasi'] = $this->transferout_m->tampil_lokasi();
        $data['nama_pengirim'] = $this->session->userdata('name');
        //$data['level_user'] = $this->sec_user_m->get_level_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        // $this->api_m->inserttransferAPI('1');
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Transfer');
        $this->template->load('template/template_dataTable', 'assetmanagement_v/transferout_v', $data);
    }


//datatabel di button pilih asset
    public function get_server_side() { 
        $icolumn = array('ID_ASSET', 'ITEM_ID', 'ItemName',  'QTY', 'TGL_ASSET', 'BranchID', 'BranchID', 'BRANCH_DESC', 'DivisionID','DIV_DESC','ZONE_ID','ZoneName','AssetType','IMAGE_PATH','KONDISI','ID_ASSET_OLD');

        $iorder = array('ID_ASSET' => 'asc');
        $list = $this->datatables->get_datatables('VW_ASSET', $icolumn, $iorder);
            // print_r($list);
            // die();
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
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->QTY;
            $row[] = $idatatables->IMAGE_PATH;
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

  //datatable datatransfer        
    public function get_datatransfer() { 
        $icolumn = array('ID', 'ID_ASSET', 'ID_ASSET_OLD', 'ITEM_ID', 'QTY', 'IMAGE_PATH', 'QR', 'KONDISI', 'TGL_PENGAKUAN', 'ZONE_ID','BRANCH','DIV','IS_TRASH','CREATE_BY','CREATE_DATE','UPDATE_BY','TGL_PENGIRIMAN',
            'PENGIRIM','RESI','STATUS_TRANS');
        // $iwhere = array('STATUS_TRANS' => 1);
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_T_ASSETS', $icolumn, $iorder);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->BRANCH;
            $row[] = $idatatables->DIV;
            $row[] = '';
            $row[] = $idatatables->BRANCH;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_PENGIRIMAN));
            $row[] = $idatatables->PENGIRIM;
            $row[] = $idatatables->STATUS_TRANS;
            

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



//datatable terimatransfer
    public function get_terimatransfer() { 
        $icolumn = array('ID', 'ID_ASSET', 'ID_ASSET_OLD', 'ITEM_ID', 'QTY', 'IMAGE_PATH', 'QR', 'KONDISI', 'TGL_PENGAKUAN', 'ZONE_ID','BRANCH','DIV','IS_TRASH','CREATE_BY','CREATE_DATE','UPDATE_BY','TGL_PENGIRIMAN',
            'PENGIRIM','RESI','STATUS_TRANS');
        $iwhere = array('STATUS_TRANS' => 1);    
        $iorder = array('ID' => 'asc');
        $list = $this->datatables->get_datatables('TBL_T_ASSETS', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();


        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->ID;
            $row[] = $idatatables->BRANCH;
            $row[] = $idatatables->DIV;
            $row[] = '';
            $row[] = $idatatables->BRANCH;
            $row[] = date('d-m-Y', strtotime($idatatables->TGL_PENGIRIMAN));
            $row[] = $idatatables->PENGIRIM;
            $row[] = $idatatables->STATUS_TRANS;
            $row[] = '<button type="button" class="btn green-jungle" id="'.$idatatables->ID.'" onclick="terima(this.id)" data-dismiss="modal"><i class="fa fa-check"></i> Terima</button>';
            

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

    public function terima_asset(){

        // print_r('dada'); die();
        $id = $this->input->post('id');
        $id_kyw=(int)$this->session->userdata('id_kyw');

        $data = array(

            'STATUS_TRANS' => 2,
            'UPDATE_BY' => $id_kyw,
            'UPDATE_DATE' => date('Y-m-d H:i:s'),

        );
        $model = $this->global_m->ubah('TBL_T_ASSETS', $data,'ID',$id);
        $this->api_m->inserttransferAPI($id);
    // $this->api_m->inserttransferAPI($id);


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


//datatable hasil pilih asset
    public function get_server_side_asset_dataku() { 
        $icolumn = array('ID_ASSET', 'ITEM_ID', 'ItemName', 'QTY', 'TGL_ASSET', 'BranchID', 'BranchID', 'BRANCH_DESC', 'DivisionID','DIV_DESC','ZONE_ID','ZoneName','AssetType','IMAGE_PATH','KONDISI','ID_ASSET_OLD');
//        $icolumn = array('HpsID');
        // $iwhere = array();
        $ID_ASSET =  explode(',', $this->input->post('sID_ASSET'));

        // print_r($ID_ASSET); die();
        // $iwhere = array(
        //     'RequestID' => $this->input->post('sID_PR')
        //     // $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('ID_ASSET' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_ASSET', $icolumn, $iorder, array(),array(),$ID_ASSET,'ID_ASSET');
            // print_r($list);
            // die();
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
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->QTY;
            $row[] = $idatatables->IMAGE_PATH;
            $row[] = '';
            // $row[] = '<a class="btn btn-xs btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a>'
            //         . '<a class="btn btn-xs btn-danger" href="#" id="btnDelete">Delete</a>';
            // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';       
            // $row[] = $idatatables->id_tiket_hps;

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


    public function count_data_assets() {
        $output = array(
            "recordsTotal" => $this->datatables_custom->count_all(),
        );

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


//functionsavetransfer
function savedatatransfer (){
    $this->load->helper('array');
    $i_list = $this->input->post('sTbl');

    $ID_ASSET = trim(element('ID_ASSET',$i_list));
    $id_branch = trim(element('id_ranch',$i_list));
    $id_pengirim = trim(element('id_pengirim',$i_list));
    $tgl_pengirim = date('Y-m-d', strtotime(trim(element('tgl_pengirim',$i_list)))); 
    $tujuan = trim(element('tujuan',$i_list));
    $division = trim(element('division',$i_list));
    $resi = trim(element('resi',$i_list));
    $kota = trim(element('kota',$i_list));
    $lokasi = trim(element('lokasi',$i_list));
    $sublokasi = trim(element('sublokasi',$i_list));

    $By = $this->session->userdata('user_id');

    $PARAMS=array(
        'ID_ASSET'=>$ID_ASSET,
        'TGL_PENGIRIMAN'=>$tgl_pengirim,
        'RESI'=>$resi,
        'BRANCH'=>$id_branch,
        'DIV'=>$division,
        'CREATE_BY'=>$By,
        'KOTA' => $kota,
        'LOKASI' => $lokasi,
        'SUB_LOKASI' => $sublokasi,
        'DIV_TUJUAN' => $tujuan
    );
        // print_r($PARAMS); die();

        // $this->db->query("zsp_Create_PR_Group ?,?",$PARAMS);
    $model = $this->global_m->sp("zsp_Create_Transfer_Assets ?,?,?,?,?,?,?,?,?,?",$PARAMS);
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

//==============================================================================================

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