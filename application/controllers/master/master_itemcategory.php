<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_itemcategory extends CI_Controller {

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
           $this->load->model('master_m/master_itemcategory_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_itemcategory/home');
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

        $this->template->set('title', 'Master Item Category');
        $this->template->load('template/template_dataTable', 'master_v/master_itemcategory_v', $data);
    }


        function get_server_side() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus = $this->input->post('sStatus');
        $iSearch = $this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'IClassID',
            1 => 'ClassCode',
            2 => 'IClassName',
            // 3 => 'umurfiskal',
            3 => 'Priod',
            4 => 'Status'
        );

        $sql = "SELECT * from Mst_ItemClass where Status like '%" . $iStatus . "%'";
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch == '1') {
                $sql = "SELECT * from Mst_ItemClass where Status like '%" . $iStatus . "%'and ClassCode like '%" . $requestData['search']['value'] . "%'";
            } else if ($iSearch == '2') {
                $sql = "SELECT * from Mst_ItemClass where Status like '%" . $iStatus . "%'and IClassName like '%" . $requestData['search']['value'] . "%'";
            } else {
                $sql = "SELECT * from Mst_ItemClass where Status like '%" . $iStatus . "%'";
                $sql .= "and ClassCode like '%" . $requestData['search']['value'] . "%'";
                $sql .= "or IClassName like '%" . $requestData['search']['value'] . "%'";
                $sql .= "or Priod like '%" . $requestData['search']['value'] . "%'";
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
            $nestedData[] = $row["IClassID"];
            $nestedData[] = $row["ClassCode"];
            $nestedData[] = $row["IClassName"];
            // $nestedData[] = $row["umurfiskal"];
            $nestedData[] = $row["Priod"];
            // $nestedData[] = $row["Status"];

            if ($row["Status"] == 0) {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            } else {
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



    public function ajax_UpdateStatusCategory() {
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id = trim(element('IClassID', $i_list));
        $ItemCategoryName = trim(element('ItemCategoryName', $i_list));
        $id_kyw = (int) $this->session->userdata('id_kyw');
        $Status = trim(element('Status', $i_list));

        $data = array(
            //  'IClassID' => $id,
            'Status' => $Status,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
        );
        $model = $this->global_m->ubah('Mst_ItemClass', $data, 'IClassID', $id);
        if ($model) {
            if ($Status == 1) {
                $message = 'Data ' . $ItemCategoryName . ' Berhasil Di Aktifkan';
            } else {
                $message = 'Data ' . $ItemCategoryName . ' Berhasil Di Non Aktifkan';
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
                'msg' => 'Data Tidak Berhasil Diubah'
            );
        }
        echo json_encode($notifikasi);
    }

    public function ajax_UpdateCategory() {
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');
// print_r($i_list); die();
        $id_kyw = (int) $this->session->userdata('id_kyw');
        $ClassCode = trim(element('ClassCode', $i_list));
        $IClassName = element('IClassName', $i_list);
        $Priod = trim(element('Priod', $i_list));
        // $umurfiskal = trim(element('umurfiskal', $i_list));
        $iStatus = trim(element('Status', $i_list));

        if (element('IClassID', $i_list) == "Generate") {
            $id = $this->master_itemcategory_m->getIdMax() + 1;
            $data = array(
                'IClassID' => $id,
                'ClassCode' => $ClassCode,
                'IClassName' => $IClassName,
                // 'umurfiskal' => $umurfiskal,
                'Priod' => $Priod,
                'Status' => $iStatus,
                'CreateBy' => $id_kyw,
                'CreateDate' => date('Y-m-d H:i:s'),
            );
        } else {
            $id = trim(element('IClassID', $i_list));
            $data = array(
                //'IClassID' => trim(element('IClassID',$i_list)),
                'ClassCode' => $ClassCode,
                'IClassName' => $IClassName,
                // 'umurfiskal' => $umurfiskal,
                'Priod' => $Priod,
                'UpdateBy' => $id_kyw,
                'UpdateDate' => date('Y-m-d H:i:s'),
            );

        }


        if (element('IClassID', $i_list) == "Generate") {
            $model = $this->master_itemcategory_m->simpan_no_iden('Mst_ItemClass', $data);
            if ($model) {
                $msg = 'Data Berhasil Disimpan';
            } else {
                $msg = 'Data gagal Disimpan';
            }
        } else {
            $model = $this->master_itemcategory_m->ubah_no_iden('Mst_ItemClass', $data, 'IClassID', $id);
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
        $rows = $this->master_itemcategory_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(
                'IClassID' => trim($roq->IClassID),
                'ClassCode' => trim($row->ClassCode),
                'IClassName' => trim($row->IClassName),
                // 'umurfiskal' => trim($row->umurfiskal),
                'Priod' => trim($row->Priod)
            );

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
    }

}
