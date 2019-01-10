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
            $this->load->model('datatables');
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
         $data['dd_grup'] = $this->global_m->tampil_data("SELECT id, grup FROM MS_GRUP where id !=0");
         $data['dd_tipe'] = $this->global_m->tampil_data("SELECT ID_TYPE, TYPE_DESC FROM TBL_R_FLOW_TYPE");
         $data['dd_status'] = $this->global_m->tampil_data("SELECT id, status FROM MS_STATUS");


        $this->template->set('title', 'HPS TIKET');
        $this->template->load('template/template_dataTable', 'master_v/flow/master_flow_tampil', $data);
    }

   function simpan ($val){
         // die('asd');
        $id = trim($this->input->post('id'));
        $status = trim($this->input->post('status'));
        $id_grup = $this->global_m->getIdMax('id','MS_GRUP');
        $grup = trim($this->input->post('grup'));
        $status = trim($this->input->post('status_ke'));


        $input_status = trim($this->input->post('input_status'));
        $id_id = trim($this->input->post('id_id'));
        $grup_status = trim($this->input->post('grup_status'));

// data dari table flow
        // print_r($grup_status);die();



        $id_flow_id = trim($this->input->post('id_flow_id'));
        $id_nama_flow = trim($this->input->post('id_nama_flow'));
        $id_status_dari = trim($this->input->post('id_status_dari'));
        $id_aksi = trim($this->input->post('id_aksi'));
        $id_status_ke = trim($this->input->post('id_status_ke'));
        $id_tipe = trim($this->input->post('ID_TYPE'));
        $id_min_hps = trim($this->input->post('id_min_hps'));
        $id_max_hps = trim($this->input->post('id_max_hps'));


      // print_r($grup_status);die();
        

        if($val == '1'){


            $data = array(

                // 'flow_id' => 1,
                // 'nama_flow' => $nama_flow,
                // 'status_dari' => $id_grup,
                // 'status_ke' => $id,
                // 'action' => $action,
                // 'status' => 0 //aktif


                'flow_id' => $id_flow_id,
                'nama_flow' => $id_nama_flow,
                'status_dari' => $id_status_dari,
                'action' => $id_aksi,
                'status_ke' => $id_status_ke,
                'tipe' => $id_tipe,
                'min_hps' => $id_min_hps,
                'max_hps' => $id_max_hps,
        );
            
     
        // print_r($data); die();
        $table = "MS_FLOW";


        }elseif($val =='2'){

            $data = array(
               'id' => $this->global_m->getIdMax('id','MS_GRUP'),
               'grup' => $grup,


        );
           
        $table = "MS_GRUP";

        }else{
           ;
             $data = array(
               
               'id' => $this->global_m->tampil_data('select [dbo].[xfn_StatusID]('.$grup_status.') as id')[0]->id,
               'status' => $input_status

        );
             // print_r($data);die();

        $table = "MS_STATUS";

        }


         // print_r($data); die();
         
        $model = $this->global_m->simpan($table, $data);

        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data  Berhasil DiSimpan.'

            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data  gagal disimpan.'

            );
        }
        $this->output->set_output(json_encode($array));
    }

    public function ajax_GridFLOW() {
        $icolumn = array('id', 'flow_id', 'nama_flow', 'status_dari', 'action', 'status_ke', 'tipe', 'min_hps', 'max_hps');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('id' => 'asc');
        $list = $this->datatables->get_datatables('MS_FLOW', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            $flow_id = $idatatables->flow_id;
            $nama_flow = $idatatables->nama_flow;
            $status_dari = $idatatables->status_dari;
            $action = $idatatables->action;
            $status_ke = $idatatables->status_ke;
            $tipe = $idatatables->tipe;
            $min_hps = $idatatables->min_hps;
            $max_hps = $idatatables->max_hps;
            $kmp = $flow_id."#".$nama_flow."#".$status_dari."#".$action."#".$status_ke."#".$tipe."#".$min_hps."#".$max_hps;

         
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $idatatables->flow_id;
            $row[] = $idatatables->nama_flow;
            $row[] = $idatatables->status_dari;
            $row[] = $idatatables->action;
            $row[] = $idatatables->status_ke;
            $row[] = $idatatables->tipe;
            $row[] = $idatatables->min_hps;
            $row[] = $idatatables->max_hps;
            
            $row[] = '<button title="Ubah" value="'.$kmp.'" onclick="show_flow_(this.value)" type="button" class="btn btn-warning btn-xs" id="updateflow">Update</button>
           
                    <button title="Hapus" value="'.$idatatables->id.'" onclick="hapus_flow_(this.value)" type="button" class="btn btn-danger btn-xs">Delete</button>';
            // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';       
            // $row[] = $idatatables->id;


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

    public function ajax_GridGROUP() {
        $icolumn = array('id', 'grup');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('id' => 'asc');
        $list = $this->datatables->get_datatables('MS_GRUP', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            $id = $idatatables->id;
            $grup = $idatatables->grup;
            $grp = $id."#".$grup;

            
            $row = array();
            $row[] = $idatatables->id;
            $row[] = $idatatables->grup;
            $row[] = '<button title="Ubah" value="'.$grp.'" onclick="show_grup_(this.value)" type="button" class="btn btn-warning btn-xs" 
                        id="updategrup">Update</button>
                      <button title="Hapus" value="'.$idatatables->id.'" onclick="hapus_grup_(this.value)" 
                        type="button" class="btn btn-danger btn-xs">Delete</button>';
            // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';       
            $row[] = $idatatables->id;


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

 public function ajax_GridSTATUS() {
        $icolumn = array('pid','id', 'status');
//        $icolumn = array('HpsID');
        $iwhere = array();
        // $iwhere = array(
        //     'ZoneID' => $this->input->post('sZone'),
        //     $this->input->post('sSearch') => $_POST['search']['value']
        // );
        $iorder = array('id' => 'asc');
        $list = $this->datatables->get_datatables('MS_STATUS', $icolumn, $iorder, $iwhere);
            // print_r($list);
            // die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            $pid = $idatatables->pid;
            $id = $idatatables->id;
            $status = $idatatables->status;
            $sts = $pid."#".$id."#".$status;


            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $idatatables->id;
            $row[] = $idatatables->status;
            $row[] = '<button title="Ubah" value="'.$sts.'" onclick="show_status_(this.value)" type="button" class="btn btn-warning btn-xs" 
                        id="updatestatus">Update</button>
                     <button title="Hapus" value="'.$idatatables->id.'" onclick="hapus_status_(this.value)" 
                        type="button" class="btn btn-danger btn-xs">Delete</button>';
            // $row[] = '<button type="button" id="btnUpdate"  class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsha">View</button>';       
            


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


     function edit_flow() {
        // die('aa');
        // print_r($_POST);die();
       // print_r(trim($this->input->post('user_id'))) ; die();
        $id_flow_id = trim($this->input->post('id_flow_id',TRUE));
        $id_nama_flow = trim($this->input->post('id_nama_flow',TRUE));
        $id_status_dari = trim($this->input->post('id_status_dari',TRUE));
        $id_aksi = trim($this->input->post('id_aksi',TRUE));
        $id_status_ke = trim($this->input->post('id_status_ke',TRUE));
        $id_tipe= trim($this->input->post('ID_TYPE',TRUE));
        $id_min_hps = trim($this->input->post('id_min_hps',TRUE));
        $id_max_hps = trim($this->input->post('id_max_hps',TRUE));
        


        $datax = array(
            'flow_id' => $id_flow_id,
            'nama_flow' => $id_nama_flow,
            'status_dari' => $id_status_dari,
            'action' => $id_aksi,
            'status_ke' => $id_status_ke,
            'tipe' => $id_tipe,
            'min_hps' => $id_min_hps,
            'max_hps' => $id_max_hps,
            // 'ID' => $data['ID']
          
            );
         // print_r($datax); die();
           $table = "MS_FLOW";
           $id_kolom = "flow_id";
           $id_data = $id_flow_id;
          $model = $this->global_m->ubah($table,$datax, $id_kolom,$id_data);
          // redirect('atk/atk/home');
           if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil diubah.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal diubah.'
            );
        }
        $this->output->set_output(json_encode($array));
    }


    function edit_grup(){
        // print_r('dds');

        $id_group = trim($this->input->post('id_group',TRUE));
        $grup = trim($this->input->post('grup',TRUE));

        // print_r($_POST);
         $datax = array(
           
         
            'grup' => $grup,
           
            );

            print_r($datax);die();
           $table = "MS_GRUP";
           $id_kolom = "id";
           $id_data = $id_group;

          $model = $this->global_m->ubah($table,$datax, $id_kolom,$id_data);
          // redirect('atk/atk/home');
           if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil diubah.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal diubah.'
            );
        }
        $this->output->set_output(json_encode($array));
    }


    function edit_status(){
        // print_r('saa');
        $id_id = trim($this->input->post('id_id',TRUE));
        $id_grup_status = trim($this->input->post('grup_status',TRUE));
        $input_status = trim($this->input->post('input_status',TRUE));

        // print_r($_POST);die();

         $datax = array(
            // 'pid' => $this->input->post('id_id'),
            // 'id' => $this->global_m->tampil_data('select [dbo].[xfn_StatusID]('.$id_grup_status.') as id')[0]->id,
            // 'id' => $this->input->post('grup_status'),
            'status' => $input_status
           
            );

            // print_r($datax);die();
           $table = "MS_STATUS";
           $id_kolom = "pid";
           $id_data = $id_id;

          $model = $this->global_m->ubah($table,$datax, $id_kolom,$id_data);
          // redirect('atk/atk/home');
           if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil diubah.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal diubah.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

}


/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */