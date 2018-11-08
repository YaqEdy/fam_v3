<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class po extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('procurement/master_po_m');
        
        session_start();
    }
    public $tabel_utama ='sec_passwd';

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

        $menuId = $this->home_m->get_menu_id('procurement/po/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['zonasi1'] = $this->global_m->tampil_zone1();
        $data['branch'] = $this->global_m->tampil_division();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
         if (isset($_POST["idTmpAksiBtn"])) {
             $act=$_POST["idTmpAksiBtn"];
        if ($act==1) {
            $this->simpan();
        }elseif ($act==2) {
            $this->ubah();
        }elseif ($act=='3') {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            $this->template->set('title', 'PO');
            // $this->template->load('template/template_dataTable', 'procurement/po/test', $data);
            $this->template->load('template/template_dataTable', 'procurement/po/index_po_v', $data);
            // $this->template->load('template/template_dataTable', 'v_po_2', $data);
        }
    } else {
      $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            
            $this->template->set('title', 'PO');
            // $this->template->load('template/template_dataTable', 'procurement/po/test', $data);
            $this->template->load('template/template_dataTable', 'procurement/po/index_po_v', $data);
            // $this->template->load('template/template_dataTable', 'v_po_2', $data);
        }
    }

    function po_form($id){
        $menuId = $this->home_m->get_menu_id('procurement/po/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['zonasi1'] = $this->global_m->tampil_zone1();
        $data['branch'] = $this->global_m->tampil_division();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['po'] = $this->master_po_m->get_po($id);
        // var_dump($data['po']->ReqTypeID);exit();
         if (isset($_POST["idTmpAksiBtn"])) {
             $act=$_POST["idTmpAksiBtn"];
        if ($act==1) {
            $this->simpan();
        }elseif ($act==2) {
            $this->ubah();
        }elseif ($act=='3') {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            $this->template->set('title', 'PO');
            $this->template->load('template/template_dataTable', 'procurement/po/master_po_v', $data);
        }
    } else {
      $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            
            $this->template->set('title', 'PO');
            $this->template->load('template/template_dataTable', 'procurement/po/master_po_v', $data);
        }
    }

    public function getTableList() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_po_m->getList($this->global_m->getFlow('7-2'));
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'noPr' => trim($row->RequestID),
                'tglReq' => trim($row->DATE),
                'reqType' => trim($row->ReqTypeName),
                'catName' => trim($row->ReqCategoryName),
                'projName' => trim($row->PROJECT_NAME),
                'branch' => trim($row->BRANCH_DESC),
                'divisi' => trim($row->DIV_DESC),
                'catatan' => trim($row->NOTE),
                'status' => trim($row->status),
                'jumlah' => $row,
            );
            // var_dump($array['jumlah']);exit();

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    public function savedata()
    {
        $data['ID_PR'] = $this->input->post('id_pr');
        $data['NAMA_BARANG'] = $this->input->post('barang');
        $data['QTY'] = $this->input->post('qty');
        $data['HARGA'] = $this->input->post('satuan');
        $data['TTL_HARGA'] = $this->input->post('hargatotal');
        $data['flow_id'] = 1;
        $data['status'] = '6-2';

        $po_id = $this->master_po_m->save_po($data);
        for ($i=0; $i < count($_POST['persentase']); $i++) {
            $termin = array(
                            'ID_PO' => $po_id,
                            'PERSENTASE' => $_POST['persentase'][$i],
                            'NILAI' => $_POST['nilai'][$i],
                            'TGL_JATUH_TEMPO' => date("Y-m-d", strtotime($_POST['tempo'][$i])),
                            );

            if (!empty($this->input->post('dterima'))) {
                $termin['TGL_JT_TERIMA_BRG'] = date("Y-m-d", strtotime($this->input->post('dterima')));
            }else{
                $termin['TGL_JT_TERIMA_BRG'] = date("Y-m-d", strtotime($_POST['akhir'][$i]));
            }

            $this->master_po_m->save_termin($termin);
        }

        redirect('procurement/po/home');
    }
  
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */