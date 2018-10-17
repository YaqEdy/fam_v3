<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class master_flow extends CI_Controller {

    function __construct() {
        parent::__construct();
        // if ($this->session->userdata("is_login") === FALSE) {
        //     $this->sso->log_sso();
        // } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
//        $this->load->model('zsessions_m');
            $this->load->model('global_m');
            // $this->load->model('procurement/hps_tiket_mdl', 'hps');
            $this->load->model('datatables_custom');
        }
    // }

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
        $menuId = $this->home_m->get_menu_id('master/master_flow/home');
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
         $data['dd_status_ke'] = $this->global_m->tampil_data("SELECT flow_id, status_ke FROM MS_FLOW");
         $data['dd_action'] = $this->global_m->tampil_data("SELECT flow_id, action FROM MS_FLOW");
         $data['dd_status_dari'] = $this->global_m->tampil_data("SELECT flow_id, status_dari FROM MS_FLOW");
         $data['dd_grup'] = $this->global_m->tampil_data("SELECT id, grup FROM MS_GRUP");
         $data['dd_status'] = $this->global_m->tampil_data("SELECT id, status FROM MS_STATUS");


        $this->template->set('title', 'HPS TIKET');
        $this->template->load('template/template_dataTable', 'master_v/flow/master_flow_tampil', $data);
    }

    function simpan ($val){
         // die('asd');
        $id = trim($this->input->post('id'));
        $status = trim($this->input->post('status'));
        $id_grup = $this->global_m->getIdMax('id','MS_GRUP');
         $grup = trim($this->input->post('status_dari'));
         $status = trim($this->input->post('status_ke'));
        $nama_flow = trim($this->input->post('nama_flow'));
        $status_dari = trim($this->input->post('status_dari'));
        $status_ke = trim($this->input->post('status_ke'));
        $action = trim($this->input->post('action'));
        $input_status = trim($this->input->post('status'));
        // print_r($_POST); die();


        if($val == '1'){


            $data = array(

                'flow_id' => 1,
                'nama_flow' => $nama_flow,
                'status_dari' => $id_grup,
                'status_ke' => $id,
                'action' => $action
                // 'status' => 0 //aktif
        );
        $table = "MS_FLOW";

        }elseif($val =='2'){

            $data = array(
               'id' => $this->global_m->getIdMax('id','MS_GRUP'),
               'grup' => $grup

        );
        $table = "MS_GRUP";

        }else{
            // print_r($id); die();
             $data = array(

               'id' => $this->global_m->tampil_data('select [dbo].[xfn_StatusID]('.$id.') as id')[0]->id,
               'status' => $input_status

        );
        $table = "MS_STATUS";

        }


         // print_r($data); die();
         
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

    public function ajax_GridFLOW() {
        $icolumn = array('id', 'flow_id', 'nama_flow', 'status_dari', 'action', 'status_ke');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('id' => 'asc');
        $list = $this->datatables_custom->get_datatables('MS_FLOW', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $idatatables->flow_id;
            $row[] = $idatatables->nama_flow;
            $row[] = $idatatables->status_dari;
            $row[] = $idatatables->status_ke;
            $row[] = $idatatables->action;
            $row[] = '<button title="Hapus" value="'.$idatatables->id.'" onclick="hapus_flow_(this.value)" 
                                            type="button" class="btn btn-danger btn-xs">Delete</button>';
            // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';       
            // $row[] = $idatatables->id;


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

    public function ajax_GridGROUP() {
        $icolumn = array('id', 'grup');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('id' => 'asc');
        $list = $this->datatables_custom->get_datatables('MS_GRUP', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $idatatables->grup;
            $row[] = '<button title="Hapus" value="'.$idatatables->id.'" onclick="hapus_grup_(this.value)" 
                                            type="button" class="btn btn-danger btn-xs">Delete</button>';
            // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';       
            $row[] = $idatatables->id;


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

 public function ajax_GridSTATUS() {
        $icolumn = array('id', 'status');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('id' => 'asc');
        $list = $this->datatables_custom->get_datatables('MS_STATUS', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $idatatables->id;
            $row[] = $idatatables->status;
            $row[] = '<button title="Hapus" value="'.$idatatables->id.'" onclick="hapus_status_(this.value)" 
                                            type="button" class="btn btn-danger btn-xs">Delete</button>';
            // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';       
            


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

 

    public function update_hps() {
        $idhps = $this->input->post('HpsID');
        $iZone = $this->input->get('sZone');
        $iZone = $this->input->get('divisi');
        $iZone = $this->input->get('nama_barang');
        $iZone = $this->input->get('nama_barang2');
        $result = $this->hps->updatedata($idhps, $iZone);

        if ($result == true) {
            $result = array('istatus' => true, 'iremarks' => 'Update! HPS ID: ' . $idhps . ' Success Update data');
        } else {
            $result = array('istatus' => false, 'iremarks' => 'Failed! HPS ID: ' . $idhps . 'Failed Update data');
        }
        echo json_encode($result);
    }


     function hapus_flow () { //hapus
        $id_data = trim($this->input->post('data'));
//        print_r($id_data);die();
       
        $table = "MS_FLOW";
        $id_kolom = "id";
      
        
        $model = $this->global_m->deleteUser($table, $id_kolom, $id_data);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dinon-aktifkan.'
            );
        } else {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been removed.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

     function hapus_grup () { //hapus
        $id_data = trim($this->input->post('data'));
//        print_r($id_data);die();
       
        $table = "MS_GRUP";
        $id_kolom = "id";
      
        
        $model = $this->global_m->deleteUser($table, $id_kolom, $id_data);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dinon-aktifkan.'
            );
        } else {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been removed.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

         function hapus_status () { //hapus
        $id_data = trim($this->input->post('data'));
//        print_r($id_data);die();
       
        $table = "MS_STATUS";
        $id_kolom = "id";
      
        
        $model = $this->global_m->deleteUser($table, $id_kolom, $id_data);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dinon-aktifkan.'
            );
        } else {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'File has been removed.'
            );
        }
        $this->output->set_output(json_encode($array));
    }


}


/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */