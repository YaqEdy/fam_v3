<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class hps_tiket extends CI_Controller {

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
            $this->load->model('procurement/hps_tiket_mdl', 'hps');
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
        $menuId = $this->home_m->get_menu_id('procurement/hps_tiket/home');
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
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('userID'));
        $data ['tanggal'] = $this->input->post('tanggal',true);
        $data ['divisi'] = $this->input->post('divisi',true);
        $data ['nama_barang'] = $this->input->post('nama_barang',true);
        $data ['nama_barang2'] = $this->input->post('nama_barang2',true);
        $data ['jumlah'] = $this->input->post('jumlah',true);
        $data ['spesifikasi'] = $this->input->post('spesifikasi',true);
        $data ['status'] = $this->input->post('status',true);
        // print_r("$data");die();

     $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
     $data['menu_all'] = $this->user_m->get_menu_all(0);
     $data['dd_id_tiket_hps']= $this->global_m->tampil_data("SELECT count(*) AS JML FROM TBL_T_TIKET_HPS WHERE STATUS = 'PENGAJUAN'");
     $data['dd_onproses']= $this->global_m->tampil_data("SELECT count(*) AS JML FROM TBL_T_TIKET_HPS WHERE STATUS = 'ONPROSES'");
     $data['dd_done']= $this->global_m->tampil_data("SELECT count (*) AS JML FROM TBL_T_TIKET_HPS WHERE STATUS = 'DONE'");
     $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
     $data['dd_item_class'] = $this->global_m->tampil_data("SELECT IClassID, IClassName FROM Mst_ItemClass");
     $data['dd_item_type'] = $this->global_m->tampil_data("SELECT ItemTypeID, ItemTypeName FROM Mst_ItemType");
     $data['dd_Branch'] = $this->global_m->tampil_data("SELECT FLEX_VALUE AS BranchID, BRANCH_DESC AS BranchName FROM TBL_M_BRANCH WHERE Is_trash=0");
     $data['dd_Zona'] = $this->global_m->tampil_data("SELECT ZoneID, ZoneName FROM Mst_Zonasi");
     // print_r($data['dd_Zona']); die();
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'HPS TIKET');
        $this->template->load('template/template_dataTable', 'procurement/hps/hps_tiket_v', $data);
    }

    public function getItemTypeID($prop = '') {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->hps->getItemTypeID($prop);
        $options = "";
        $options .= "<option value='NULL' selected>-Pilih-</option>";
        foreach ($rows as $v) {
            $options .= "<option  value='" . $v->ItemTypeID . "'>" . $v->ItemTypeName . "</option>";
        };
        $this->output->set_output(json_encode($options));
    }

       function read($pg = 1) { //CIS

        $data ['tanggal'] = $this->input->post('tanggal',true);
        $data ['divisi'] = $this->input->post('divisi',true);
        $data ['nama_barang'] = $this->input->post('nama_barang',true);
        $data ['jumlah'] = $this->input->post('jumlah',true);
        $data ['spesifikasi'] = $this->input->post('spesifikasi',true);
        $data ['status'] = $this->input->post('status',true);

        $key = trim($this->input->post('cari', true));
        $limit = trim($this->input->post('limit', true));

        
        $offset = ($limit * $pg) - $limit;
        $like = '';

        if ($key)
            $like = "(tanggal LIKE '%$key%' or divisi LIKE '%$key%' or nama_barang LIKE '%$key%' or jumlah LIKE '%$key%' or spesifikasi LIKE '%$key%')";

        
        $page = array();
        $page['limit'] = $limit;

        $result = $this->hps_tiket_mdl->tiketband($like, $limit, $offset);
//        print_r($result);
        $data['list'] = $result['results'];
        $page['count_row'] = $result['rows'];
        $page['current'] = $pg;
        $page['list'] = gen_paging($page);
        $data['paging'] = $page;
        $this->load->view('procurement/hps/hps_tiket_v', $data);
    }


    function tampil_data() {
        $id = trim($this->input->post('id', true));
        $sql = "select tanggal, divisi, nama_barang, jumlah, spesifikasi, status, id_tiket_hps
        FROM TBL_T_TIKET_HPS
        WHERE Id='$id'";
        $query = $this->db->query($sql)->result();
        $rows['data_res'] = $query;
        return $this->output->set_output(json_encode($rows));
    }

    function simpan_msthps (){
         // die('asd');

        $StartDate = trim($this->input->post('StartDate'));
        $EndDate = trim($this->input->post('EndDate'));
        // $Price = trim($this->input->post('Price'));
        $Price = trim($this->input->post('Price'));
        $Price = str_replace(',', '', $Price);
        $ZoneID = trim($this->input->post('ZoneID'));
        $id_tiket = trim($this->input->post('id_tiket2'));
       // $test =  $this->global_m->tampil_data(" SELECT top 1 ItemID FROM Mst_ItemList WHERE ID_TIKET_HPS = $id_tiket")[0]->ItemID;
        // print_r($test); die();
        $data = array(

            'StartDate' => $StartDate,
            'EndDate' => $EndDate,
            'ZoneID' => $ZoneID,
            'CreateDate' => date('Y-m-d h:i:s'),
            // 'ItemID' => $id_tiket,
            'ItemID' => $this->global_m->tampil_data(" SELECT top 1 ItemID FROM Mst_ItemList WHERE ID_TIKET_HPS = $id_tiket")[0]->ItemID,
            'Price' => (int) $Price,
            'CreateBy' =>  $this->session->userdata('user_id'),
           // 'status' => 0 //aktif
        );
         // print_r($data); die();
        $table = "Mst_HPS";
        
        $model = $this->global_m->ubah('TBL_T_TIKET_HPS', array('STATUS'=>'DONE'),'ID_TIKET_HPS',$id_tiket);
        $model = $this->global_m->simpan($table, $data);
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

 function simpan() {
        $Image = '';
        $nama_barang = trim($this->input->post('nama_barang'));
        $IClassID = trim($this->input->post('IClassID'));
        $ItemName = trim($this->input->post('ItemName'));
        $ItemTypeID = trim($this->input->post('ItemTypeID'));
        // $AssetType = trim($this->input->post('AssetType'));
        $id_tiket = trim($this->input->post('id_tiket'));

        // $StartDate = trim($this->input->post('StartDate'));
        // $EndDate = trim($this->input->post('EndDate'));
        // $Price = trim($this->input->post('Price'));

        // print_r($_POST);die();
        $this->load->library('upload');
        $config['upload_path'] = './uploads/hps_tiket/'; //path folder
        $config['max_size'] = '0'; //maksimum besar file 5M
        $config['allowed_types'] = '*'; //type yang dapat diakses bisa anda sesuaikan
        $atflag = 'T';
        $atwaktuupdate = date("Y/m/d H:i:s");

        $files = $_FILES;
        $nilai = 0;

        $query = $this->db->query("SELECT LEFT(ClassCode, 1) as code FROM Mst_ItemClass where IClassID = '$IClassID'")->result();

        $code = $query[0]->code;

  
        for ($i = 0; $i < count($_FILES['Image']['name']); $i++) {
            $namafile = $files['Image']['name'][$i];
            $ext = pathinfo($namafile, PATHINFO_EXTENSION);
            $namafileasli = explode(".", strrev($namafile));
            $nama_file_baru = $this->global_m->generateRandomString();
            $nama_file_baru2 = $nama_file_baru . "." . $ext;
            $namafile = $nama_file_baru2;
            $_FILES['userfile']['name'] = $nama_file_baru2;
            $_FILES['userfile']['type'] = $files['Image']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['Image']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['Image']['error'][$i];
            $_FILES['userfile']['size'] = $files['Image']['size'][$i];

            $this->upload->initialize($config);
            $this->upload->do_upload('userfile');
            // if ($this->upload->do_upload('userfile')) {
                $data = $this->upload->data();
                $Image = $data['file_name'];
                $data = array(
                    'IClassID' => $IClassID,
                    'ItemTypeID' => $ItemTypeID,
                    'ID_TIKET_HPS' => $id_tiket,
                    'ItemName' => $nama_barang,
                    'AssetType' => $code,
                    'Image' => 'uploads/hps_tiket/'.$Image,
                    'CreateDate' => date('Y-m-d h:i:s'),
                    'CreateBy' =>  $this->session->userdata('user_id'),
                    'Status' => 0
                );
                // echo "<pre>";
                // print_r($data); die();
                $table = "Mst_ItemList";

                $model = $this->global_m->simpan($table, $data);
                $model = $this->global_m->ubah('TBL_T_TIKET_HPS', array('STATUS'=>'ONPROSES'),'ID_TIKET_HPS',$id_tiket);
            // }
        }


                // $data = array(

                //     'StartDate' => $StartDate,
                //     'EndDate' => $EndDate,
                //     'ItemID' => $this->global_m->getIdMax('ItemID','Mst_ItemList'),
                //     'Price' => $Price

                // );

     
                // $table = "Mst_HPS";

                if ($model) {
                    $array = array(
                        'act' => 1,
                        'tipePesan' => 'success',
                        'title' => 'Data berhasil di simpan',
                        'pesan' =>  'Apakah anda ingin menginput kembali ?',
                        'itemname'=>$nama_barang
                    );

                } else {
                    $array = array(
                        'act' => 0,
                        'tipePesan' => 'error',
                        'pesan' => 'Data gagal disimpan.',
                        'itemname'=>$nama_barang
                    );
                }
                $this->output->set_output(json_encode($array));
            }



    public function ajax_GridHPS() {
        $icolumn = array('tanggal', 'divisi', 'nama_barang', 'jumlah', 'spesifikasi', 'status', 'id_tiket_hps');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('id_tiket_hps' => 'asc');
        $list = $this->datatables_custom->get_datatables('TBL_T_TIKET_HPS', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = date('d-m-Y', strtotime($idatatables->tanggal) ); 
            $row[] = $idatatables->divisi;
            $row[] = $idatatables->nama_barang;
            $row[] = $idatatables->spesifikasi;
            $row[] = $idatatables->jumlah;
            $row[] = $idatatables->status;
            // $row[] = '<a class="btn btn-xs btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a>'
            //         . '<a class="btn btn-xs btn-danger" href="#" id="btnDelete">Delete</a>';
			if($idatatables->status=="PENGAJUAN"){
            $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';       				
			}else{
			$row[] ="";	
			}
            $row[] = $idatatables->id_tiket_hps;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_GridHPSZone() {
        $icolumn = array('nama_barang', 'id_tiket_hps', 'StartDate', 'EndDate', 'Price');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('id_tiket_hps' => 'asc');
        $list = $this->datatables_custom->get_datatables('Mst_HPS', $icolumn, $iorder, $iwhere);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->nama_barang;
            $row[] = $idatatables->StartDate;
            $row[] = $idatatables->EndDate;
            $row[] = $idatatables->Price;

                     // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';

            $row[] = $idatatables->id_tiket_hps;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    // public function ddZone() {
    //     $ddZone = $this->hps->getzone3();
    //     if ($this->input->get('sParam') == 'A') {
    //         $options = "<select id='dd_id_zone_A' class='form-control' onclick='onZone(this)'>";
    //     } else if ($this->input->get('sParam') == 'B') {
    //         $options = "<select id='dd_id_zone_B' class='form-control'>";
    //     } else {
    //         $options = "<select id='dd_id_zone' class='form-control'>";
    //     }
    //     $options .= "<option value=''>-- Select --</option>";
    //     foreach ($ddZone as $k) {
    //         $options .= "<option  value='" . $k->ZoneID . "'>" . $k->ZoneName . "</option>";
    //     }
    //     $options .= "</select>";

    //     echo json_encode($options);
    // }


    public function update_hps() {
        $idhps = $this->input->post('HpsID');
        $iZone = $this->input->get('sZone');
        $iZone = $this->input->get('divisi');
        $iZone = $this->input->get('nama_barang');
        $iZone = $this->input->get('nama_barang2');
        $result = $this->hps->updatedata($idhps, $iZone);

        $data = array(

            'UpdateDate' => date('Y-m-d h:i:s'),
        );

        if ($result == true) {
            $result = array('istatus' => true, 'iremarks' => 'Update! HPS ID: ' . $idhps . ' Success Update data');
        } else {
            $result = array('istatus' => false, 'iremarks' => 'Failed! HPS ID: ' . $idhps . 'Failed Update data');
        }
        echo json_encode($result);
    }

    public function ajax_Delete() {
        $id = $this->input->post('sID');
        $result = $this->hps->deletedata($id);

        $data = array(

            'UpdateDate' => date('Y-m-d h:i:s'),
        );
//        $this->session->set_flashdata('msg', 'Success! HPS ID: ' . $id . ' Success Delete data');
        if ($result == true) {
            $result = array('istatus' => true, 'iremarks' => 'Success! HPS ID: ' . $id . ' Success Delete data');
        } else {
            $result = array('istatus' => false, 'iremarks' => 'Failed! HPS ID: ' . $id . 'Failed Delete data');
        }
        echo json_encode($result);
    }

}


/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */