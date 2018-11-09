<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class sec_user extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('datatables_custom');
        $this->load->model('admin/sec_user_m');
        
        session_start();
    }
    // public $tabel_utama ='sec_passwd';

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

            //$data ['nama'] = $this->home_m->get_nama_kantor ();
            $this->template->set('title', 'Home');
            $this->template->load('template/template1', 'global/index', $data);
        }
    }

    function home() {
        // die('asd');
        $menuId = $this->home_m->get_menu_id('admin/sec_user/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();

            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            $data['dd_usergroup'] = $this->global_m->tampil_data("SELECT usergroup_id, usergroup_desc FROM sec_usergroup");
            $data['dd_divisi'] = $this->global_m->tampil_data("SELECT FLEX_VALUE, DIV_DESC FROM TBL_M_DIVISION");
            $data['dd_Branch'] = $this->global_m->tampil_data("SELECT FLEX_VALUE, BRANCH_DESC FROM TBL_M_BRANCH");
            $data['dd_Zona'] = $this->global_m->tampil_data("SELECT ZoneID, ZoneName FROM Mst_Zonasi");
            $data['dd_Position'] = $this->global_m->tampil_data("SELECT PositionID, PositionName FROM Mst_Position");
            // $data['dd_grup'] = $this->global_m->tampil_data("SELECT id, grup FROM MS_GRUP");
            // print_r($data); die();
            $this->template->set('title', 'Konfigurasi User');
            $this->template->load('template/template_dataTable', 'admin/sec_user_v', $data);
            // $this->template->load('template/template_dataTable', 'admin/sec_user_edit', $data);
            
        // }
    }

    public function getUserInfo() {
        // die('asd');
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->sec_user_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {
            $passwd = base64_decode($row->password);
            $array = array(
                'userid' => trim($row->userid),
                'nik' => trim($row->nik),
                'user_name' => trim($row->user_name),
                'name' => $name,
                // 'usergroup' => trim($row->usergroup),
                // 'id_kyw' => trim($row->id_kyw)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    public function ajax_GridUser() {
        // die('asd');
        $icolumn = array('user_id', 'idsdm','nik', 'user_name', 'name', 'user_groupid');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('idsdm' => 'asc');
        $list = $this->datatables_custom->get_datatables('user', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die('asd');
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->nik;
            $row[] = $idatatables->user_name;
            $row[] = $idatatables->name;
            $row[] = $idatatables->user_groupid;
            $row[] = '<button class="btn btn-xs btn-warning" value="<?php echo $idatatables->idsm; ?>" href="#" id="btnUpdate2" onclick="editData('.$idatatables->user_id.')" data-toggle="modal" data-target="#myModaleki"">Update</button>';
            //         . '<a class="btn btn-xs btn-danger" href="#" id="btnDelete">Delete</a>';
            // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>'; 
            $row[] = $idatatables->idsdm;      
            $row[] = $idatatables->user_id;

            $data[] = $row;
        }

        // print_r($data); die();

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

      public function ajax_GridPopUpUser() {

        $list = $this->get_user_fam();
            // print_r($list);
            // die('asd');
        $data = array();
        $no = $_POST['start'];

        foreach ($list->profile[0]->data as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $idatatables->profile_nip;
            $row[] = $idatatables->profile_nama;
            $row[] = $idatatables->profile_username;
            $row[] = $idatatables->profile_email;
//            $row[] = $idatatables->profile_unit_kerja;
            $row[] =  '<a class="btn btn-sm btn-primary" href="#" id="btnUpdate" onclick="new22();" data-target="#navitab_2_2">Pilih User</a></div>'; 
            $row[] = $idatatables->profile_id_sdm;

            $data[] = $row;
        }

        // print_r($data); die();

        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => count($list->profile[0]->data),
            // "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


        function get_user_fam() {
        $this->load->database();
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='GET USER FAM'");
        $result = $query->result()[0];

        $curlurl = $result->LINK . "?app_code=MASSET";

        $auth = base64_encode("event:event");
        $context = stream_context_create(['http' => ['header' => "Authorization: Basic $auth"]]);
        $homepage = file_get_contents($curlurl, false, $context);
        $result=  json_decode($homepage);

        return $result;
    }

//     function edit_user_update() {
// //        print_r($_POST) ; die();
//         $data['nik'] = trim($this->input->post('nik'));
//         $data['user_name'] = trim($this->input->post('user_name'));
//         $data['name'] = trim($this->input->post('name'));
//         $data['user_groupid'] = trim($this->input->post('user_groupid'));
//         $data['FLEX_VALUE_DIVISI'] = trim($this->input->post('FLEX_VALUE_DIVISI'));
//         $data['status'] = trim($this->input->post('status'));
//         $data['idsdm'] = trim($this->input->post('idsdm'));

//         // print_r($data); die();

//         $datax = array(
//             'nik' => $data['nik'],
//             'user_name' => $data['user_name'],
//             'name' => $data['name'],
//             'user_groupid' => $data['user_groupid'],
//             'DivisionID' => $data['FLEX_VALUE_DIVISI'],
//             'status' => $data['status'],
//             );
           
//         $this->global_m->ubah($table, $data['idsdm']);
//         redirect('admin/sec_user_v');
//     }


    function simpan_popup (){
         // die('asd');

        $nik = trim($this->input->post('nik'));
        $user_name = trim($this->input->post('user_name'));
        $name = trim($this->input->post('name'));
        $FLEX_VALUE_BRANCH = trim($this->input->post('FLEX_VALUE_BRANCH'));
        $FLEX_VALUE_DIVISI = trim($this->input->post('FLEX_VALUE_DIVISI'));
        $PositionID = trim($this->input->post('PositionID'));
        $ZoneID = trim($this->input->post('ZoneID'));
        $user_groupid = trim($this->input->post('userGroup'));
        $status = trim($this->input->post('statusUser')); 

        $idsdm = trim($this->input->post('idsdm'));
        // $user_id = trim($this->input->post('user_id'));
  
       
        // print_r($_POST); die();

        $data = array(

            'nik' => $nik,
            'user_name' => $user_name,
            'name' => $name,
            'BranchID' => $FLEX_VALUE_BRANCH, 
            'DivisionID' => $FLEX_VALUE_DIVISI, 
            'PositionID' => $PositionID, 
            'ZoneID' => $ZoneID, 
            'user_groupid' => $user_groupid,
            'status' => $status,

            'idsdm' => $idsdm,
            // 'user_id' => $user_id, 
            
            
           // 'status' => 0 //aktif
        );

         // print_r($data); die();
        $table = "user";

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

    function hapus() {
        $this->CI = & get_instance();
        $userId = $this->input->post('userId', TRUE);
        $model = $this->sec_user_m->deleteUser($userId);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dihapus.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal dihapus.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function tampil_data() {
            // die('asd');
        $user_id = trim($this->input->post('user_id', true));
        // print_r($idsm); die();
        $sql = "select nik, user_name, name, DivisionID, status, user_groupid, idsdm, ZoneID, PositionID, BranchID, user_id
                FROM [user]
                WHERE user_id=".$user_id;
        $query = $this->db->query($sql)->result();
        $rows['data_res'] = $query;
        return $this->output->set_output(json_encode($rows));
    }

    function edit_user() {
       // print_r(trim($this->input->post('user_id'))) ; die();
        $data['nik'] = trim($this->input->post('nik'));
        $data['user_name'] = trim($this->input->post('user_name'));
        $data['name'] = trim($this->input->post('name'));
        $data['idsdm'] = trim($this->input->post('idsdm'));
        $data['user_groupid'] = trim($this->input->post('userGroup'));
        $data['status'] = trim($this->input->post('statusUser'));
        $data['FLEX_VALUE_DIVISI'] = trim($this->input->post('FLEX_VALUE_DIVISI'));
        $data['FLEX_VALUE_BRANCH'] = trim($this->input->post('FLEX_VALUE_BRANCH'));
        $data['PositionID'] = trim($this->input->post('PositionID'));
        $data['ZoneID'] = trim($this->input->post('ZoneID'));
        $data['user_id'] = trim($this->input->post('user_id'));

        // print_r($data); die();

        // $id_kolom = array(

        // 'user_id' => $data['user_id']

        // );

        $datax = array(
            'nik' => $data['nik'],
            'user_name' => $data['user_name'],
            'name' => $data['name'],
            // 'user_id' => $data['user_id'],
            'update_date' => date('Y-m-d h:i:s'),
            // 'ZoneID' => 123,
            'status' => $data['status'],
            'user_groupid' => $data['user_groupid'],
            'DivisionID' => $data['FLEX_VALUE_DIVISI'],
            'BranchID' => $data['FLEX_VALUE_BRANCH'],
            'ZoneID' => $data['ZoneID'],
            'idsdm' => $data['idsdm']  
            );
         // print_r($datax); die();
          $table = "user";
          $id_kolom = "user_id = '".$data['user_id']."'";
          $model = $this->global_m->ubah($table,$datax, $id_kolom);
          redirect('admin/sec_user/home');

    }

        function ubah() {
            // die('kiw');

        $nik = trim($this->input->post('nik'));
        $user_name = trim($this->input->post('user_name'));
        $name = trim($this->input->post('name'));
        $user_id = trim($this->input->post('user_id'));
        $idsdm = trim($this->input->post('idsdm'));
        $user_groupid = trim($this->input->post('userGroup'));
        $status = trim($this->input->post('statusUser'));
        $FLEX_VALUE_DIVISI = trim($this->input->post('FLEX_VALUE_DIVISI'));
        $FLEX_VALUE_BRANCH = trim($this->input->post('FLEX_VALUE_BRANCH'));
        $PositionID = trim($this->input->post('PositionID'));
        $ZoneID = trim($this->input->post('ZoneID'));

         // print_r($_POST);die();

        // $id_kolom = array(
        //     'user_id' => $user_id,
        // );

        $datax = array(
            'nik' => $nik,
            'user_name' => $user_name,
            'name' => $name,
            'status' => $status,
            'user_groupid' => $user_groupid,
            'DivisionID' => $FLEX_VALUE_DIVISI,
            'BranchID' => $FLEX_VALUE_BRANCH,
            'PositionID' => $PositionID,
            'ZoneID' => $ZoneID,
            'update_date' => date('Y-m-d h:i:s'),
            'idsdm' => $idsdm
        );

           // print_r($datax); die('asd');
           // print_r($id_kolom);die();
           $table = "user";
           $id_kolom = "nik";
           // print_r($id_kolom);die();
           $model = $this->global_m->ubah($table,$datax, $id_kolom,$nik);
             if ($model) {
             $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been succsess to changed.'
            );
             } else {
             $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal diubah.'
            );
        }

        $this->output->set_output(json_encode($array));
        // redirect('admin/sec_user/edit_user');

    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */