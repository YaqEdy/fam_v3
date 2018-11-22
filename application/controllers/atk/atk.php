<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class atk extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
            $this->load->model('global_m');
//            $this->load->model('procurement/ias_mdl');
//            $this->load->model('procurement/cek_barang_mdl');
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
        $menuId = $this->home_m->get_menu_id('atk/atk/home');
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
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        // $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        // $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");
//        print_r($this->global_m->tampil_data('SELECT * FROM TBL_R_JNS_BUDGET'));die();

        $this->template->set('title', 'Alat Tulis Kantor');
        $this->template->load('template/template_dataTable', 'atk_v/atk_tampil_v', $data);
    }


    public function ajax_GridPRGroup() {
        $icolumn = array('RequestID','CreateDate', 'ReqCategoryID', 'ReqTypeID', 'ProjectName', 'BranchID', 'DivisionID', 'status', 'status_desc');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('RequestID' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_ATK_PR_GROUP', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            // $row[] = $no;

            $row[] = $idatatables->RequestID;
            $row[] = $idatatables->CreateDate;
            // $row[] = $idatatables->ReqTypeID;
            // $row[] = $idatatables->ReqCategoryID;
            $row[] = $idatatables->ProjectName;
            $row[] = $idatatables->BranchID;
            // $row[] = $idatatables->DivisionID;
            $row[] = $idatatables->status_desc;
            $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalUpdate">Aksi</button>';    


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

       public function ajax_GridDaftarPR() { 
        $icolumn = array('RequestID', 'tgl_req', 'ReqTypeID', 'ReqTypeName', 'ReqCategoryID', 'ReqCategoryName', 'ProjectName', 'BranchID', 'BRANCH_DESC', 'DivisionID');
//        $icolumn = array('HpsID');
        // $iwhere = array();
        $ID_PR =  explode(',', $this->input->post('sID_PR'));
        // print_r($ID_PR); die();
        // $iwhere = array(
        //     'RequestID' => $this->input->post('sID_PR')
        //     // $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('RequestID' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_ATK_PR_HEADER', $icolumn, $iorder, array(),array(),$ID_PR,'RequestID');
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $idatatables->RequestID;
            $row[] = $idatatables->tgl_req;
            $row[] = $idatatables->ReqTypeName;
            $row[] = $idatatables->ReqCategoryName;
            $row[] = $idatatables->ProjectName;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->DivisionID;

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


        public function ajax_GridDataPR() {
        $icolumn = array('RequestID', 'tgl_req', 'ReqTypeName', 'ReqCategoryName', 'ProjectName', 'BRANCH_DESC', 'DivisionID');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('RequestID' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_ATK_PR_HEADER_1', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $idatatables->RequestID;
            $row[] = $idatatables->tgl_req;
            $row[] = $idatatables->ReqTypeName;
            $row[] = $idatatables->ReqCategoryName;
            $row[] = $idatatables->ProjectName;    
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = $idatatables->DivisionID;


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

  
        function tampil_data() {
        $ID_PR = trim($this->input->post('sID_PR', true));
         $By = $this->session->userdata('user_id');
         $PARAMS=array(
            'ID_PR'=>$ID_PR,
            'CREATE_BY'=>$By
        );
//         print_r($PARAMS);die();

        $this->global_m->sp("zsp_Create_PR_Group_Temp ?,?",$PARAMS);
        // $ses =$this->db->query("zsp_Create_PR_Group_Temp ?,?",$PARAMS);
        $ses = $this->db->query("SELECT TOP 1 SESSION FROM  TBL_T_ATK_PR_GROUP_TEMP WHERE CREATE_BY=".$By." ORDER BY CREATE_DATE DESC")->row();

        $sql = "SELECT SUM(HargaHPS) as HargaHPS FROM VW_ATK_PR_DETAIL WHERE RequestID IN (SELECT splitdata FROM xfn_SplitString('".$ID_PR."',','))"; 
        $query = $this->db->query($sql)->row();
        $sql1 = "SELECT count(*) as TTL_ITEM FROM VW_ATK_PR_DETAIL WHERE RequestID IN (SELECT splitdata FROM xfn_SplitString('".$ID_PR."',','))"; 
        $query1 = $this->db->query($sql1)->row();
        $sql2 = "SELECT SUM(CONVERT(FLOAT,Qty)) as QTY FROM VW_ATK_PR_DETAIL WHERE RequestID IN (SELECT splitdata FROM xfn_SplitString('".$ID_PR."',','))"; 
        $query2 = $this->db->query($sql2)->row();

        $rows['HPS'] = $query;
        $rows['ITEM'] = $query1;
        $rows['QTY'] = $query2;
        $rows['SES'] = $ses;

        return $this->output->set_output(json_encode($rows));
    }


   public function ajax_GridItemBarang() {
        $icolumn = array('ID','ItemID', 'ItemName', 'ReqTypeID', 'ReqTypeName', 'Qty', 'HargaHPS', 'ID_PR_DIV');
      
         // $ID_PR =  explode(',', $this->input->post('sID_PR'));
        $iwhere = array('SESSION'=>$this->input->post('sSES'));
        $iorder = array('ID' => 'asc');
          $list = $this->datatables_custom->get_datatables('TBL_T_ATK_PR_GROUP_TEMP', $icolumn, $iorder,$iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
// print_r($idatatables);
         $id = $idatatables->ID;
         $qty = $idatatables->Qty;
         // $ItemName = $idatatables->ItemName;
        $gbg=$id."#".$qty;



            $no++;
            $row = array();
            // $row[] = $idatatables->no;    
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->ReqTypeName;
            $row[] = $idatatables->Qty;
            $row[] = $idatatables->HargaHPS;
            $row[] = $idatatables->ID_PR_DIV; 
            $row[] =   '<button value="'.$gbg.'" type="button" id="btnUpdate"  class="btn btn-xs btn-warning btn-md"
             data-toggle="modal" onclick="show_qty(this.value)"  data-target="#myModalUpdate">Update</button> &nbsp;&nbsp;
                        <button value="'.$id.'" type="button" id="btnUpdate"  class="btn btn-xs btn-danger btn-md" onclick="hapus_item(this.value)"  data-target="#myModalHapus">Delete</button>';      


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);


    }

     function tampil_QTY() {
            // die('asd');
        $ID = trim($this->input->post('ID', true));
        // print_r($_POST); die('dsd');
        $sql = "select ID, Qty
                FROM [TBL_T_ATK_PR_GROUP_TEMP]
                WHERE ID =".$ID;
        $query = $this->db->query($sql)->result();
        $rows['data_res'] = $query;
        return $this->output->set_output(json_encode($rows));
 // print_r($data['results']); die; 
    }

         public function ajax_GridPRDivisi() {

      $icolumn = array('RequestID', 'tgl_req','ID_PR_GROUP','TGL_PR_GROUP', 'ReqTypeID', 'ReqTypeName', 'ReqCategoryID', 'ReqCategoryName', 'ProjectName', 'BranchID', 'BRANCH_DESC', 'DivisionID');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('RequestID' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_ATK_PR_HEADER', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            // $row[] = $no;

            $row[] = $idatatables->RequestID;
            $row[] = $idatatables->tgl_req;
            $row[] = $idatatables->ID_PR_GROUP;
            $row[] = $idatatables->TGL_PR_GROUP;
            $row[] = $idatatables->ReqTypeName;
            $row[] = $idatatables->ReqCategoryName;
            $row[] = $idatatables->ProjectName;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->DivisionID;
            $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">Aksi</button>';       

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


     function teruskan_dataPR (){
        $ID_PR =  $this->input->post('sID_PR');
        $SESSION =  $this->input->post('sSES');
        $By = $this->session->userdata('user_id');
        $PARAMS=array(
            'ID_PR'=>$ID_PR,
            'CREATE_BY'=>$By,
            'SESSION'=>$SESSION
        );
        // print_r($ID_PR); die();

        // $this->db->query("zsp_Create_PR_Group ?,?",$PARAMS);
        $model = $this->global_m->sp("zsp_Create_PR_Group ?,?,?",$PARAMS);
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

    //  function hapus_itembarang() {
    //     $this->CI = & get_instance();
    //     $userId = $this->input->post('ID', TRUE);
    //     $model = $this->atk_m->deleteUser($ID);
    //     // print_r($_POST);die('dsd');
    //     if ($model) {
    //         $array = array(
    //             'act' => 1,
    //             'tipePesan' => 'success',
    //             'pesan' => 'Data berhasil dihapus.'
    //         );
    //     } else {
    //         $array = array(
    //             'act' => 0,
    //             'tipePesan' => 'error',
    //             'pesan' => 'Data gagal dihapus.'
    //         );
    //     }
    //     $this->output->set_output(json_encode($array));
    // }

//      function hapus_item () { //hapus
//         $id_data = trim($this->input->post('data'));
// //        print_r($id_data);die();
       
//         $table = "TBL_T_ATK_PR_GROUP_TEMP";
//         $id_kolom = "ID";
      
        
//         $model = $this->atk_m->deleteUser($table, $id_kolom, $id_data);
//         if ($model) {
//             $array = array(
//                 'act' => 1,
//                 'tipePesan' => 'success',
//                 'pesan' => 'Data berhasil dinon-aktifkan.'
//             );
//         } else {
//             $array = array(
//                 'act' => 1,
//                 'tipePesan' => 'success',
//                 'pesan' => 'File has been removed.'
//             );
//         }
//         $this->output->set_output(json_encode($array));
//     }

    function edit_user() {
        // die('aa');
       // print_r(trim($this->input->post('user_id'))) ; die();
        $data['Qty'] = trim($this->input->post('Qty',TRUE));
        $data['ID'] = trim($this->input->post('ID',TRUE));
       

        // print_r($_POST); die();

        // $id_kolom = array(

        // 'user_id' => $data['user_id']

        // );

        $datax = array(
            'Qty' => $data['Qty']
            // 'ID' => $data['ID']
          
            );
         // print_r($datax); die();
           $table = "TBL_T_ATK_PR_GROUP_TEMP";
           $id_kolom = "ID";
           $id_data = $data['ID'];
          $model = $this->global_m->ubah($table,$datax, $id_kolom,$id_data);
          // redirect('atk/atk/home');
           if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil disimpan.'
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

    

    function ubah(){

         $Qty = trim($this->input->post('Qty'));
         $ID = trim($this->input->post('ID'));
         // $itemname = trim($this->input->post('itemname'));

         // print_r($_POST);

         $datax = array(

            'Qty' => $Qty,
           // 'ID' => $ID,
            // 'itemname' => $itemname,

        );

           // print_r($datax); die('asd');
           // print_r($id_kolom);die();
           $table = "TBL_T_ATK_PR_GROUP_TEMP";
           $id_kolom = "ID";
           // print_r($id_kolom);die();
           $model = $this->global_m->ubah($table,$datax, $id_kolom,$ID);
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
        // redirect('atk/atk/home');

    }

    function hapus() {

        $data['ID'] = trim($this->input->post('ID',TRUE));
        
        $this->CI = & get_instance();
        $tabel = "TBL_T_ATK_PR_GROUP_TEMP";
        $id_kolom = "ID";
        $id_data = $data['ID'];
        // $ID = $this->input->post('ID', TRUE);
        $model = $this->global_m->deleteUser($tabel, $id_kolom, $id_data);
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


}

/* End of file atk.php */
/* Location: ./application/controllers/atk.php */