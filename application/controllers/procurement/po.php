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
        $flow = $this->master_po_m->getflow();
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
        $data['item'] = $this->master_po_m->getItemList($id);
        $data['hargatotal'] = 0;
        foreach ($this->master_po_m->getItemList($id) as $total) {
            $data['hargatotal'] += $total->total;
        }
        // var_dump($data['hargatotal']);exit();
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
//        $rows = $this->master_po_m->getList('7-2');
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
        $flow = $this->master_po_m->getflow();
        $id_po = $this->global_m->getIdMax('ID_PO','TBL_T_PO');
        $head['ID_PO'] = $id_po;
        $head['ID_PR'] = $this->input->post('id_pr');
        $head['flow_id'] = 1;
        $head['status'] = '7-2';
        $this->master_po_m->save_po($head);

        //request log
        $log['RequestID'] = $this->input->post('id_pr');
        $log['status_dari'] = $flow->status_dari;
        $log['action'] = $flow->ACTION;
        $log['status_ke'] = $flow->status_ke;
        $log['user_id'] = $this->session->userdata('user_id');
        $log['date'] = date('Y-m-d H:i:s');
        $this->master_po_m->save_log($log);

        for ($i=0; $i < count($_POST['barang']); $i++) { 
            $data['ID_PO'] = $id_po;
            $data['ITEM_ID'] = $_POST['itemid'][$i];
            $data['NAMA_BARANG'] = $_POST['barang'][$i];
            $data['QTY'] = $_POST['qty'][$i];
            $data['HARGA'] = $_POST['satuan'][$i];
            $data['TTL_HARGA'] = $_POST['hargatotal'][$i];

            $this->master_po_m->save_po_detail($data);
        }
        

        for ($i=0; $i < count($_POST['persentase']); $i++) {
            $termin = array(
                            'ID_PO' => $id_po,
                            'PERSENTASE' => $_POST['persentase'][$i],
                            'NILAI' => $_POST['nilai'][$i],
                            'TGL_JATUH_TEMPO' => DateTime::createFromFormat('d/m/Y', $_POST['tempo'][$i])->format('Y-m-d')
                            );

            if (!empty($this->input->post('dterima'))) {
                // $date2 = DateTime::createFromFormat('d/m/Y', $this->input->post('dterima'));
                $termin['TGL_JT_TERIMA_BRG'] = DateTime::createFromFormat('d/m/Y', $this->input->post('dterima'))->format('Y-m-d');
            }else{
                $termin['TGL_JT_TERIMA_BRG'] = DateTime::createFromFormat('d/m/Y', $_POST['akhir'][$i])->format('Y-m-d');
            }

            $this->master_po_m->save_termin($termin);
        }

        redirect('procurement/po/home');
    }
  
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */