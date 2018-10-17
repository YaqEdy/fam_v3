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
        $data['titem'] = count($this->master_po_m->getItemList($id));
        $data['thps'] = 0;
        $data['tqty'] = 0;
        foreach ($data['item'] as $item) {
            $data['thps'] += $item->total;
            $data['tqty'] += $item->Qty;
        }

        $data['request'] = $this->master_po_m->getRequest($id);
        $data['hargatotal'] = 0;
        foreach ($this->master_po_m->getItemList($id) as $total) {
            $data['hargatotal'] += $total->total;
        }

        $data['doc_po'] = [];
        $data['doc_spk'] = [];
        $data['doc_kpbj'] = [];
        $data['doc_psw'] = [];

        for ($i=1; $i <= 2; $i++) { 
            $doc_po = "PO-00000000000-0000";
            $doc_spk = "SPK";
            $doc_kpbj = "KPBJ";
            $doc_psw = "PSW";

            if (!empty($this->master_po_m->get_t_po())) {
                $urut_dpo = (int) $this->master_po_m->get_t_po()->ID_PO;
            }else{
                $urut_dpo = (int) substr($doc_po, 15, 18);
            }
            $kode_dpo = substr($doc_po, 0, 15);
            $data['doc_po'][] = $kode_dpo.sprintf("%04s", $urut_dpo+$i);

            $get_spk = $this->master_po_m->no_doc($doc_spk, strlen($doc_spk));
            if (!empty($get_spk)) {
                $max_spk = $get_spk->NO_DOC;
            }else{
                $max_spk = "SPK-00000000000-0000";
            }

            $urut_spk = (int) substr($max_spk, 16, 19);
            $kode_spk = substr($max_spk, 0, 16);
            $data['doc_spk'][] = $kode_spk.sprintf("%04s", $urut_spk+$i);


            $get_kpbj = $this->master_po_m->no_doc($doc_kpbj, strlen($doc_kpbj));
            if (!empty($get_kpbj)) {
                $max_kpbj = $get_kpbj->NO_DOC;
            }else{
                $max_kpbj = "KPBJ-00000000000-0000";
            }

            $urut_kpbj = (int) substr($max_kpbj, 17, 20);
            $kode_kpbj = substr($max_kpbj, 0, 17);
            $data['doc_kpbj'][] = $kode_kpbj.sprintf("%04s", $urut_kpbj+$i);

            $get_psw = $this->master_po_m->no_doc($doc_psw, strlen($doc_psw));
            if (!empty($get_psw)) {
                $max_psw = $get_psw->NO_DOC;
            }else{
                $max_psw = "PSW-00000000000-0000";
            }

            $urut_psw = (int) substr($max_psw, 16, 19);
            $kode_psw = substr($max_psw, 0, 16);
            $data['doc_psw'][] = $kode_psw.sprintf("%04s", $urut_psw+$i);
        }

        $data['nama_po'] = "PO";
        $data['nama_spk'] = "SPK";
        $data['nama_kpbj'] = "KPBJ";
        $data['nama_psw'] = "PSW";


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
        $rows = $this->master_po_m->getList('7-2');
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
        $cek_po = $this->master_po_m->cek_po($this->input->post('id_pr'));
        if (!empty($cek_po)) {
            $id_po = $cek_po->ID_PO;
        }else{
            $id_po = $this->global_m->getIdMax('ID_PO','TBL_T_PO');
            $head['ID_PO'] = $id_po;
            $head['ID_PR'] = $this->input->post('id_pr');
            $head['flow_id'] = 1;
            $head['status'] = '7-2';
            $this->master_po_m->save_po($head);
        }
        
        //request log
        $log['RequestID'] = $this->input->post('id_pr');
        $log['status_dari'] = $flow->status_dari;
        $log['action'] = $flow->ACTION;
        $log['status_ke'] = $flow->status_ke;
        $log['user_id'] = $this->session->userdata('user_id');
        $log['date'] = date('Y-m-d H:i:s');
        $this->master_po_m->save_log($log);

        //berdasarkan vendor

        for ($i=0; $i < count($_POST['barang']); $i++) { 
            $data['ID_PO'] = $id_po;
            $data['VENDOR_ID'] = $this->input->post('id_vendor');
            $data['ID_PO_DETAIL'] = $this->input->post('id_vendor');
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
                            'TERMIN' => $_POST['term'][$i],
                            'ID_PO_DETAIL' => $this->input->post('id_vendor'),
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

        for ($i=0; $i < count($_POST['check']); $i++) { 
            $ex_cek = explode('-', $_POST['check'][$i]);
            $doc['ID'] = $this->global_m->getIdMax('ID','TBL_T_PO_GENERATE_DOC');
            $doc['ID_PO_DETAIL'] = $this->input->post('id_vendor');
            $doc['NAMA_DOC'] = $ex_cek[0];
            $doc['NO_DOC'] = $_POST['check'][$i];
            $doc['CREATE_BY'] = $this->session->userdata('user_id');
            $doc['CREATE_DATE'] = date('Y-m-d H:i:s');

            $this->master_po_m->save_doc($doc);
        }

        $return['status'] = true;
        if (!empty($this->input->post('redirect'))) {
            $return['redirect'] = true;
        }

        echo json_encode($return);
    }
  
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */