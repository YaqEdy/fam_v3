<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cek_jatuh_tempo_brg extends CI_Controller {

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
            $this->load->model('procurement/cek_jatuh_tempo_brg_mdl');
            $this->load->model('datatables_custom');
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
        $menuId = $this->home_m->get_menu_id('procurement/cek_jatuh_tempo_brg/home');
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

        $this->template->set('title', 'Cek Barang');
        $this->template->load('template/template_dataTable', 'procurement/cek_barang/cek_jatuh_tempo_brg_v', $data);
    }


       function get_server_side() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus = $this->input->post('sStatus');
        $iSearch = $this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID_PR',
            1 => 'TGL_PR',
            2 => 'REQ_NAME',
            3 => 'NAMA_BARANG',
            4 => 'BRANCH_DESC',
            5 => 'STATUS_AKHIR',
            6 => 'STATUS_CEK',
            7 => 'ID_PO'
        );

        $sql = "SELECT * from VW_CEK_BARANG where status_ke ='6-2'";
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch == '1') {
                $sql = "SELECT * from VW_CEK_BARANG where status_ke ='6-2'" . $iStatus . "%'and NAMA_BARANG like '%" . $requestData['search']['value'] . "%'";
            }else if ($iSearch == '2') {
                $sql = "SELECT * from VW_CEK_BARANG where status_ke ='6-2'" . $iStatus . "%'and BRANCH_DESC like '%" . $requestData['search']['value'] . "%'";
            }{
                $sql = "SELECT * from VW_CEK_BARANG where status_ke ='6-2'" . $iStatus . "%'";
                $sql .= "and ID_PO like '%" . $requestData['search']['value'] . "%'";
                $sql .= "or NAMA_BARANG  like '%" . $requestData['search']['value'] . "%'";
                $sql .= "or BRANCH_DESC  like '%" . $requestData['search']['value'] . "%'";
            }

            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET " . $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";

            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();
            $totalFiltered = $totalData;
        } else {
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET " . $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array();

        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();

            $nestedData[] = $no++;
            $nestedData[] = $row["ID_PR"];
            $nestedData[] = $row["TGL_PR"]; 
            $nestedData[] = $row["REQ_NAME"];
            $nestedData[] = $row["NAMA_BARANG"];
            $nestedData[] = $row["BRANCH_DESC"];
            $nestedData[] = $row["STATUS_AKHIR"];
            $nestedData[] = $row["STATUS_CEK"];
            $nestedData[] = $row["ID_PO"];



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



      function get_server_side_cekbarang() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus = $this->input->post('sStatus');
        $iSearch = $this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'ID_PR',
            1 => 'TGL_PR',
            2 => 'REQ_NAME',
            3 => 'NAMA_BARANG',
            4 => 'BRANCH_DESC',
            5 => 'STATUS_AKHIR',
            6 => 'STATUS_CEK',
            7 => 'ID_PO'
        );

        $sql = "SELECT * from VW_CEK_BARANG where status_ke ='6-2'";
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch == '1') {
                $sql = "SELECT * from VW_CEK_BARANG where status_ke ='6-2'" . $iStatus . "%'and NAMA_BARANG like '%" . $requestData['search']['value'] . "%'";
            }else if ($iSearch == '2') {
                $sql = "SELECT * from VW_CEK_BARANG where status_ke ='6-2'" . $iStatus . "%'and BRANCH_DESC like '%" . $requestData['search']['value'] . "%'";
            }{
                $sql = "SELECT * from VW_CEK_BARANG where status_ke ='6-2'" . $iStatus . "%'";
                $sql .= "and ID_PO like '%" . $requestData['search']['value'] . "%'";
                $sql .= "or NAMA_BARANG  like '%" . $requestData['search']['value'] . "%'";
                $sql .= "or BRANCH_DESC  like '%" . $requestData['search']['value'] . "%'";
            }

            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET " . $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";

            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();
            $totalFiltered = $totalData;
        } else {
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET " . $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array();

        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();

            $nestedData[] = $no++;
            $nestedData[] = $row["ID_PR"];
            $nestedData[] = $row["TGL_PR"]; 
            $nestedData[] = $row["REQ_NAME"];
            $nestedData[] = $row["NAMA_BARANG"];
            $nestedData[] = $row["BRANCH_DESC"];
            $nestedData[] = $row["STATUS_AKHIR"];
            $nestedData[] = $row["STATUS_CEK"];
            $nestedData[] = $row["ID_PO"];
            $nestedData[] = '<a class="btn btn-xs btn blue" href="#" id="btncekitem" class =" fa fa-edit"data-toggle="modal"       data-target="#idDivTabelBarang">Action</a>';

          




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