<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_vendorlist extends CI_Controller {

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
            $this->load->model('master_m/master_vendorlist_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_vendorlist/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['item_classprov'] = $this->global_m->tampil_provinsi();
        $data['item_country'] = $this->global_m->tampil_country();
        $data['item_branch'] = $this->global_m->tampil_branch();
        //$data['level_user'] = $this->sec_user_m->get_level_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Vendor List');
        $this->template->load('template/template_dataTable', 'master_v/master_vendorlist_v', $data);
    }


     function get_server_side() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
             0 => 'VendorName',
             1 => 'VendorAlias',
             2 => 'VendorTypeID',
             3 => 'NPWP',
             4 => 'AccountLiability',
             5 => 'AccountPrepayment',
             6 => 'Terms',
             7 => 'Currency',
             8 => 'NoRekening',
             9 => 'NamaBank',
             10 => 'MasaBerlakuTDP',
             11 => 'Image',
             12 => 'AlamatNPWP',
             13 => 'AlamatSupplier',
             14 => 'VendorAddress',
             15 => 'Status',
             16 => 'CreateDate',
             17 => 'CreateBy',
             18 => 'Is_trash'
             
        );

        $sql = "select a.Raw_ID, a.VendorName, a.VendorTypeID, a.NPWP, c.NamaProvinsi, d.NamaKabupaten, a.Terms, a.Currency, a.NoRekening, a.NamaBank, a.Image, a.Performance, a.VendorAlias, a.AlamatNPWP, a.AlamatSupplier,a.VendorAddress,a.MasaBerlakuTDP, e.CountryName, b.BRANCH_DESC, a.Status, a.AccountLiability, a.AccountPrepayment  
            from Mst_Vendor a 
            left join TBL_M_BRANCH b on a.VendorID = b.ID  
            left join Mst_Provinsi c on a.VendorID = c.IdProvinsi
            left join Mst_Kabupaten d on a.VendorID = d.IdKabupaten
            left join TBL_CountryNew e on a.VendorID = e.ID_Country  where Status like '%".$iStatus."%'";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) { 
            if ($iSearch=='1'){
                $sql = "SELECT * from Mst_Vendor where Status like '%".$iStatus."%'and VendorTypeID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from Mst_Vendor where Status like '%".$iStatus."%'and VendorID  like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from Mst_Vendor where Status like '%".$iStatus."%'and VendorName like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT * from Mst_Vendor where Status like '%".$iStatus."%'"; 
                $sql .= "and VendorTypeID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or VendorID like '%".$requestData['search']['value']."%'";
                $sql .= "or VendorName like '%".$requestData['search']['value']."%'";
                $sql .= "or VendorAddress like '%".$requestData['search']['value']."%'";
                $sql .= "or NoTlp like '%".$requestData['search']['value']."%'";
                $sql .= "or Location like '%".$requestData['search']['value']."%'";
                $sql .= "or NoRekening like '%".$requestData['search']['value']."%'";
                $sql .= "or JoinDate like '%".$requestData['search']['value']."%'";
                $sql .= "or CreateDate like '%".$requestData['search']['value']."%'";
                $sql .= "or CreateBy like '%".$requestData['search']['value']."%'";
                $sql .= "or Is_trash like '%".$requestData['search']['value']."%'";
                $sql .= "or bank like '%".$requestData['search']['value']."%'";  
               
            }
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        foreach ($row as $row) {
            # code...
            // preparing an array

            $nestedData = array();
            $nestedData[] = $no++;
            $nestedData[] = $row["Raw_ID"];     
            $nestedData[] = $row["VendorName"];
            $nestedData[] = $row["VendorAlias"];
            $nestedData[] = $row["VendorTypeID"];
            $nestedData[] = $row["NPWP"]; 
            $nestedData[] = $row["NamaProvinsi"]; 
            $nestedData[] = $row["NamaKabupaten"];
            $nestedData[] = $row["CountryName"];
            $nestedData[] = $row["BRANCH_DESC"];
            $nestedData[] = $row["AccountLiability"];
            $nestedData[] = $row["AccountPrepayment"];
            $nestedData[] = $row["Terms"];
            $nestedData[] = $row["Currency"];
            $nestedData[] = $row["NoRekening"];
            $nestedData[] = $row["NamaBank"]; 
            $nestedData[] = $row["MasaBerlakuTDP"]; 
            $nestedData[] = $row["Image"]; 
            $nestedData[] = $row["AlamatNPWP"]; 
            $nestedData[] = $row["AlamatSupplier"];
            $nestedData[] = $row["VendorAddress"]; 
            $nestedData[] = $row["Performance"];    

            
            // $nestedData[] = $row["Status"];

            if($row["Status"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
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

        public function seloptiontypekab($reqtypeid = null) {
        $reqtypeid = substr($reqtypeid, 0, 2);
        $sel_optiontype = $this->master_vendorlist_m->selitem_typekab($reqtypeid);
        echo "<select class='form-control' name='NamaKabupaten' id='NamaKabupaten' >";
        echo "<option value='' disabled' selected=''>--Select--</option>";
        foreach ($sel_optiontype as $row) {
            echo "<option value='$row->IdKabupaten'>$row->NamaKabupaten</option>";
        }
        echo "</select>";
    }

    public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->parameter_kabupaten_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'kodepropinsi' => trim($row->kodepropinsi),
                'kodekabupaten' => trim($row->kodekabupaten),
                'namakabupaten' => trim($row->namakabupaten),
                'namapropinsi' => trim($row->namapropinsi),
               
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function simpan() {
      
       $KodePropinsi = $this->master_propinsi_m->getIdMax();
       
       $NamaPropinsi = trim($this->input->post('id_namapropinsi'));
  

        $data = array(
            'kodepropinsi' => $KodePropinsi,
            'namapropinsi' => $NamaPropinsi
        );
        $model = $this->global_m->simpan('amsparpropinsi', $data);
        if ($model) {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Disimpan'
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Data Gagal Disimpan'
            );
        }
        $this->session->set_flashdata('notif', $notifikasi);
        //echo $model;
        redirect('parameter/master_propinsi/home');
        
    }

    function ubah() {
       $KodePropinsi = trim($this->input->post('id_kodepropinsi'));
       $NamaPropinsi = trim($this->input->post('id_namapropinsi'));


        $data = array(
            'namapropinsi' => $NamaPropinsi,
        );
        $model = $this->global_m->ubah('amsparpropinsi', $data,'kodepropinsi',$KodePropinsi);
        if ($model) {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Diubah'
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Data Berhasil Diubah'
            );
        }
        $this->session->set_flashdata('notif', $notifikasi);
        //echo $model;
        redirect('parameter/master_propinsi/home');
    }


    function hapus() {
        $this->CI = & get_instance();
        $KodePropinsi = trim($this->input->post('id_kodepropinsi'));
        $model = $this->global_m->deleteUser('amsparpropinsi','kodepropinsi',$KodePropinsi);
        if ($model) {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Dihapus'
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Data Berhasil Dihapus'
            );
        }
         $this->session->set_flashdata('notif', $notifikasi);
        //echo $model;
        redirect('parameter/master_propinsi/home');
    }

  

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */