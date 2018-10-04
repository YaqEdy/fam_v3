<?php

// if (!defined('BASEPATH'))
//     exit('No direct script access allowed');

// class master_vendorlist extends CI_Controller {

//     function __construct() {
//         parent::__construct();
//         if ($this->session->userdata("is_login") === FALSE) {
//             $this->sso->log_sso();
//         } else {
//             session_start();
//             $this->load->model('home_m');
//             $this->load->model('admin/konfigurasi_menu_status_user_m');
// //        $this->load->model('zsessions_m');
//             $this->load->model('global_m');
//             $this->load->model('master_m/master_vendorlist_m');
//             $this->load->model('datatables_custom');
//         }

//     }

//     public function index() {
//         if ($this->auth->is_logged_in() == false) {
//             $this->login();
//         } else {
//             $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

//             $this->template->set('title', 'Home');
//             $this->template->load('template/template1', 'global/index', $data);
//         }


//     }


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
        $data['item_classprov'] = $this->master_vendorlist_m->tampil_provinsi();
        $data['item_country'] = $this->master_vendorlist_m->tampil_country();
        $data['item_branch'] = $this->master_vendorlist_m->tampil_branch();

        //$data['level_user'] = $this->sec_user_m->get_level_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Master Vendor');
        $this->template->load('template/template_dataTable', 'master_v/master_vendorlist_v', $data);
    }

// function home() {
//         $menuId = $this->home_m->get_menu_id('master/master_vendorlist/home');
//         $data['menu_id'] = $menuId[0]->menu_id;
//         $data['menu_parent'] = $menuId[0]->parent;
//         $data['menu_nama'] = $menuId[0]->menu_nama;
//         $data['menu_header'] = $menuId[0]->menu_header;
//         $this->auth->restrict($data['menu_id']);
//         $this->auth->cek_menu($data['menu_id']);
//         $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
//         $data['item_classprov'] = $this->global_m->tampil_provinsi();
//         $data['item_country'] = $this->global_m->tampil_country();
//         $data['item_branch'] = $this->global_m->tampil_branch();
//         //$data['level_user'] = $this->sec_user_m->get_level_user();

//         $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
//         $data['menu_all'] = $this->user_m->get_menu_all(0);
// //            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
// //            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
// //            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

//         $this->template->set('title', 'Vendor List');
//         $this->template->load('template/template_dataTable', 'master_v/master_vendorlist_v', $data);
//     }


     function get_server_side() {
        $requestData = $_REQUEST;
        //  echo "<pre>";
        //  print_r($requestData);
        //  echo "</pre>";
        //  die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
             0 => 'Raw_ID',   
             1 => 'VendorID',   
             2 => 'VendorName',
             3 => 'VendorAlias',
             4 => 'VendorTypeID',
             5 => 'NPWP',
             6 => 'AccountLiability',
             7 => 'AccountPrepayment',
             8 => 'Terms',
             9 => 'Currency',
             10 => 'NoRekening',
             11 => 'NamaBank',
             12 => 'MasaBerlakuTDP',
             13 => 'Image',
             14 => 'AlamatNPWP',
             15 => 'AlamatSupplier',
             16 => 'VendorAddress',
             17 => 'Status',
             18 => 'CreateDate',
             19 => 'CreateBy',
             20 => 'Is_trash',
             21 => 'IdProvinsi',
             22 => 'CreateDate',
             23 => 'ID_Branch',
             23 => 'ID_Country',
             24 => 'ID_Branch',
             25 => 'IdKabupaten'

             
        );

        $sql = "select a.Raw_ID, a.VendorID, a.VendorName, a.ID_Country, a.ID_Branch, b.ID, b.BRANCH_DESC, a.VendorTypeID, a.NPWP, c.NamaProvinsi, 
                d.NamaKabupaten, a.Terms, a.Currency, a.NoRekening, a.NamaBank, a.Image,
                a.Performance, a.VendorAlias, a.AlamatNPWP, a.AlamatSupplier,a.VendorAddress,a.IdProvinsi, a.IdKabupaten, 
                a.ID_Country,a.MasaBerlakuTDP, e.CountryName,  a.Status, a.AccountLiability, a.AccountPrepayment, a.CreateDate
                from Mst_Vendor a 
                left join TBL_M_BRANCH b on a.ID_Branch = b.ID  
                left join Mst_Provinsi c on a.IdProvinsi = c.IdProvinsi
                left join Mst_Kabupaten d on a.IdKabupaten = d.IdKabupaten
                left join TBL_CountryNew e on a.ID_Country = e.ID_Country where Status like '%".$iStatus."%'";            
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
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][1]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
            // , " . $columns[$requestData['order'][0]['column']] . " ROW_ID
             $sql.=" ORDER BY " . $columns[$requestData['order'][1]['column']] . "   " . $requestData['order'][1]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
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
            $nestedData[] = $row["VendorID"];        
            $nestedData[] = $row["VendorName"];
            $nestedData[] = $row["VendorAlias"];
            $nestedData[] = $row["VendorTypeID"];
            $nestedData[] = $row["NPWP"]; 
            $nestedData[] = $row["IdProvinsi"]; 
            $nestedData[] = $row["IdKabupaten"];
            $nestedData[] = $row["ID_Country"];
            $nestedData[] = $row["ID"];
            $nestedData[] = $row["AccountLiability"];
            $nestedData[] = $row["AccountPrepayment"];
            $nestedData[] = $row["Terms"];
            $nestedData[] = $row["Currency"];
            $nestedData[] = $row["NoRekening"];
            $nestedData[] = $row["NamaBank"]; 
            $nestedData[] = $row["MasaBerlakuTDP"]; 
            $nestedData[] = '<a href="' . base_url() . 'uploads/vendorlist/' . $row["Image"] . '" >Download '.$row["Image"].'</a>';
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

            $nestedData[] = $row["IdProvinsi"];
            

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
        echo "<select class='form-control' name='IdKabupaten' id='id_IdKabupaten' >";
        echo "<option value='' disabled' selected=''>--Select--</option>";
        foreach ($sel_optiontype as $row) {
            echo "<option value='$row->IdKabupaten'>$row->NamaKabupaten</option>";
        }
        echo "</select>";
    }

    public function ajax_UpdateStatusCategory(){
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id_Raw = trim(element('Raw_ID',$i_list));
        $name = trim(element('name',$i_list));
        // $id = trim(element('VendorTypeID',$i_list));
        $id_kyw=(int)$this->session->userdata('id_kyw');
        $Status = trim(element('Status',$i_list));
        
        $data = array(
           
            'Status' => $Status,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
        $model = $this->global_m->ubah('Mst_Vendor', $data,'Raw_ID',$id_Raw);
        if ($model) {
            if ($Status == 1) {
                $message = 'Data ' . $name . ' Berhasil Di Aktifkan';
            } else {
                $message = 'Data ' . $name . ' Berhasil Di Non Aktifkan';
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
                'msg' => 'Data Vendor Type ' . $name . ' Tidak Berhasil Di Non Aktifkan'
            );
        }
        echo json_encode($notifikasi);
    }



    public function ajax_UpdateCategory(){

        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id_kyw=(int)$this->session->userdata('id_kyw');
        // $Raw_ID = trim(element('Raw_ID',$i_list));
        $VendorID = trim(element('VendorID',$i_list));
        $VendorName = trim(element('VendorName',$i_list));
        $VendorAlias = trim(element('VendorAlias',$i_list));
        $VendorTypeID = trim(element('VendorTypeID',$i_list));
        $NPWP = trim(element('NPWP',$i_list));
        $NamaProvinsi = trim (element('IdProvinsi',$i_list)); 
        $NamaKabupaten = trim(element('IdKabupaten',$i_list));
        $IdCountry = trim (element('IdCountry',$i_list)); 
        $ID_Branch = trim (element('ID_Branch',$i_list));
        $AccountLiability = trim (element('AccountLiability',$i_list));
        $AccountPrepayment = trim (element('AccountPrepayment',$i_list)); 
        $Terms = trim (element('Terms',$i_list));
        $Currency = trim (element('Currency',$i_list));
        $NoRekening = trim (element('NoRekening',$i_list));
        $NamaBank = trim (element('NamaBank',$i_list)); 
        $MasaBerlakuTDP = date('Y-m-d', strtotime (trim (element('MasaBerlakuTDP',$i_list))));
        $Image = trim (element('Image',$i_list));
        $AlamatNPWP = trim (element('AlamatNPWP',$i_list));
        $AlamatSupplier = trim (element('AlamatSupplier',$i_list)); 
        $VendorAddress = trim (element('VendorAddress',$i_list));
        $Performance = trim (element('Performance',$i_list));
        $iStatus = trim(element('Status',$i_list));


         
         $id_Raw = $this->master_vendorlist_m->getIdMax();
         // $id = $this->master_vendorlist_m->getIdMax_typeid();
        if(element('Raw_ID',$i_list)=="Generate"){
       // echo $VendorName;
             $data = array(
            // 'Raw_ID' => $Raw_ID,
            'VendorID' => $id_Raw,
            'VendorName' => $VendorName,
            'VendorAlias' => $VendorAlias,
            'VendorTypeID' => $VendorTypeID,
            'NPWP' => $NPWP,
            'JoinDate' => date('Y-m-d'),
            'IdProvinsi' => $NamaProvinsi,
            'IdKabupaten' => $NamaKabupaten,
            'ID_Country' => $IdCountry,
            'ID_Branch' => $ID_Branch,
            'AccountLiability' => $AccountLiability,
            'AccountPrepayment' => $AccountPrepayment,
            'Terms' => $Terms,
            'Currency' => $Currency,
            'NoRekening' => $NoRekening,
            'NamaBank' => $NamaBank,
            'MasaBerlakuTDP' => $MasaBerlakuTDP,
            'Image' => $Image,
            'AlamatNPWP' => $AlamatNPWP,
            'AlamatSupplier' => $AlamatSupplier,
            'VendorAddress' => $VendorAddress,
            'Performance' => $Performance,
            'Status' => $iStatus,
            'CreateBy' => $id_kyw,
            'CreateDate' => date('Y-m-d H:i:s'),
            
        );

      // print_r($data); die();

       }else{
        // echo "2";
            $id = trim(element('Raw_ID',$i_list));
         $data = array(
            
            
            'VendorName' => $VendorName,
            'VendorAlias' => $VendorAlias,
            'VendorTypeID' => $VendorTypeID,
            'NPWP' => $NPWP,
            'IdProvinsi' => $NamaProvinsi,
            'IdKabupaten' => $NamaKabupaten,
            'ID_Country' => $CountryName,
            'ID_Branch' => $BRANCH_DESC,
            'AccountLiability' => $AccountLiability,
            'AccountPrepayment' => $AccountPrepayment,
            'Terms' => $Terms,
            'Currency' => $Currency,
            'NoRekening' => $NoRekening,
            'NamaBank' => $NamaBank,
            'MasaBerlakuTDP' => $MasaBerlakuTDP,
            'Image' => $Image,
            'AlamatNPWP' => $AlamatNPWP,
            'AlamatSupplier' => $AlamatSupplier,
            'VendorAddress' => $VendorAddress,
            'Performance' => $Performance,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
        
       }
      
       // print_r($data); die();
        if(element('Raw_ID',$i_list)=="Generate"){
            $model = $this->global_m->simpan('Mst_Vendor', $data);
            if ($model) {
                $msg = 'Data Berhasil Disimpan';
            } else {
                $msg = 'Data gagal Disimpan';
            }
       }else{
        $model = $this->global_m->ubah('Mst_Vendor', $data,'Raw_ID',$id);
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







    public function ajax_UpdateImage(){
        $config['upload_path']="./uploads/vendorlist/";
        $config['allowed_types']='zip|rar';
        $config['max_size'] = '5048';
        $this->load->library('upload',$config);

         $id_kyw=(int)$this->session->userdata('id_kyw');

         $Raw_ID = trim($this->input->post('Raw_ID'));

         $VendorID = trim($this->input->post('VendorID'));
         $VendorName = trim($this->input->post('VendorName'));
         $VendorAlias = trim($this->input->post('VendorAlias'));
         $VendorTypeID = trim($this->input->post('VendorTypeID'));
         $NPWP = trim($this->input->post('NPWP'));
         $NamaProvinsi = trim($this->input->post('IdProvinsi'));
         $NamaKabupaten = trim($this->input->post('IdKabupaten'));
         $CountryName = trim($this->input->post('ID_Country'));
         $ID_Branch = trim($this->input->post('ID_Branch'));
         $AccountLiability = trim($this->input->post('AccountLiability'));
         $AccountPrepayment = trim($this->input->post('AccountPrepayment')); 
         $Terms = trim($this->input->post('Terms'));
         $Currency = trim($this->input->post('Currency'));
         $NoRekening = trim($this->input->post('NoRekening')); 
         $NamaBank = trim($this->input->post('NamaBank'));
         $MasaBerlakuTDP =date('Y-m-d', strtotime(trim($this->input->post('MasaBerlakuTDP'))));
         $Image = trim($this->input->post('Image'));
         $AlamatNPWP = trim($this->input->post('AlamatNPWP'));
         $AlamatSupplier = trim($this->input->post('AlamatSupplier')); 
         $VendorAddress = trim($this->input->post('VendorAddress'));
         $Performance = trim($this->input->post('Performance'));
         $iStatus = trim($this->input->post('iStatus'));


        $id_Raw = $this->master_vendorlist_m->getIdMax();

        if($Raw_ID =="Generate"){
       // echo $VendorName;

            if(!$this->upload->do_upload("Image")){
                $error = array('error' => $this->upload->display_errors());

                $notifikasi = Array(
                    'msgType' => "error_upload",
                    'msgTitle' => $error['error'],
                    'msg' => $error['error']
                );
            } else {
            $data_img = array('upload_data' => $this->upload->data());
             $data = array(
                // 'Raw_ID' => $Raw_ID,
                'VendorID' => $id_Raw,
                'VendorName' => $VendorName,
                'VendorAlias' => $VendorAlias,
                'VendorTypeID' => $VendorTypeID,
                'NPWP' => $NPWP,
                'JoinDate' => date('Y-m-d'),
                'IdProvinsi' => $NamaProvinsi,
                'IdKabupaten' => $NamaKabupaten,
                'ID_Country' => $CountryName,
                'ID_Branch' => $ID_Branch,
                'AccountLiability' => $AccountLiability,
                'AccountPrepayment' => $AccountPrepayment,
                'Terms' => $Terms,
                'Currency' => $Currency,
                'NoRekening' => $NoRekening,
                'NamaBank' => $NamaBank,
                'MasaBerlakuTDP' => $MasaBerlakuTDP,
                'Image' => $data_img['upload_data']['file_name'],
                'AlamatNPWP' => $AlamatNPWP,
                'AlamatSupplier' => $AlamatSupplier,
                'VendorAddress' => $VendorAddress,
                'Performance' => $Performance,
                'Status' => $iStatus,
                'CreateBy' => $id_kyw,
                'CreateDate' => date('Y-m-d H:i:s'),
                
            );

              // print_r($data); die();  
             

             $model = $this->global_m->simpan('Mst_Vendor', $data);

            if ($model) {
                $msg = 'Data Berhasil Disimpan';
                $notifikasi = Array(
                    'msgType' => true,
                    'msgTitle' => 'Success',
                    'msg' => $msg
                );
            } else {
                $msg = 'Data gagal Disimpan';
                $notifikasi = Array(
                    'msgType' => false,
                    'msgTitle' => 'Error',
                    'msg' => $msg
                );
            }
        }

      // print_r($data); die();

       }else{
        // echo "2";
            if ($_FILES AND $_FILES['Image']['name']) {

                $config = array(
                    'upload_path' => './uploads/vendorlist/',
                    'allowed_types' => 'zip|rar',
                    'max_size' => '2048',
                    'max_width' => '2000',
                    'max_height' => '2000'
                );
                $this->load->library('upload', $config);
               
                if (!$this->upload->do_upload('Image')) {
                     $error = array('error' => $this->upload->display_errors());

                    $notifikasi = Array(
                        'msgType' => "error_upload",
                        'msgTitle' => $error['error'],
                        'msg' => $error['error']
                    );
                } else {
                   $file = $this->upload->data();  
                    // print_r($file);
                // exit();
                  $data = array(
                    // 'Raw_ID' => $Raw_ID,
                    'VendorID' => $id_Raw,
                    'VendorName' => $VendorName,
                    'VendorAlias' => $VendorAlias,
                    'VendorTypeID' => $VendorTypeID,
                    'NPWP' => $NPWP,
                    'JoinDate' => date('Y-m-d'),
                    'IdProvinsi' => $NamaProvinsi,
                    'IdKabupaten' => $NamaKabupaten,
                    'ID_Country' => $CountryName,
                    'ID_Branch' => $ID_Branch,
                    'AccountLiability' => $AccountLiability,
                    'AccountPrepayment' => $AccountPrepayment,
                    'Terms' => $Terms,
                    'Currency' => $Currency,
                    'NoRekening' => $NoRekening,
                    'NamaBank' => $NamaBank,
                    'MasaBerlakuTDP' => $MasaBerlakuTDP,
                    'Image' => $file['file_name'],
                    'AlamatNPWP' => $AlamatNPWP,
                    'AlamatSupplier' => $AlamatSupplier,
                    'VendorAddress' => $VendorAddress,
                    'Performance' => $Performance,
                    'Status' => $iStatus,
                    'CreateBy' => $id_kyw,
                    'CreateDate' => date('Y-m-d H:i:s'),
                  );
              }
            } else {
                $data = array(
                    // 'Raw_ID' => $Raw_ID,
                    'VendorID' => $id_Raw,
                    'VendorName' => $VendorName,
                    'VendorAlias' => $VendorAlias,
                    'VendorTypeID' => $VendorTypeID,
                    'NPWP' => $NPWP,
                    'JoinDate' => date('Y-m-d'),
                    'IdProvinsi' => $NamaProvinsi,
                    'IdKabupaten' => $NamaKabupaten,
                    'ID_Country' => $CountryName,
                    'ID_Branch' => $ID_Branch,
                    'AccountLiability' => $AccountLiability,
                    'AccountPrepayment' => $AccountPrepayment,
                    'Terms' => $Terms,
                    'Currency' => $Currency,
                    'NoRekening' => $NoRekening,
                    'NamaBank' => $NamaBank,
                    'MasaBerlakuTDP' => $MasaBerlakuTDP,
                    'AlamatNPWP' => $AlamatNPWP,
                    'AlamatSupplier' => $AlamatSupplier,
                    'VendorAddress' => $VendorAddress,
                    'Performance' => $Performance,
                    'Status' => $iStatus,
                    'CreateBy' => $id_kyw,
                    'CreateDate' => date('Y-m-d H:i:s'),
                  );
            }

            $model = $this->global_m->ubah('Mst_Vendor', $data,'Raw_ID',$Raw_ID);
            if ($model) {
                $msg = 'Data Berhasil DiUpdate';
                $notifikasi = Array(
                    'msgType' => true,
                    'msgTitle' => 'Success',
                    'msg' => $msg
                );
            } else {
                $msg = 'Data gagal DiUpdate';
                $notifikasi = Array(
                    'msgType' => false,
                    'msgTitle' => 'Error',
                    'msg' => $msg
                );
            }
        
       }

        echo json_encode($notifikasi);
    }









   public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_vendorlist_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(

                  
               'Raw_ID' => trim($roq->Raw_ID),    
               'VendorName' => trim($row->VendorName),
               'VendorAlias' => trim($row->VendorAlias),
               'VendorTypeID' => trim($row->VendorTypeID),
               'NPWP' => trim($row->NPWP),
               'NamaProvinsi' => trim($row->NamaProvinsi),
               'NamaKabupaten' => trim($row->NamaKabupaten),
               'CountryName' => trim($row->CountryName),
               'BRANCH_DESC' => trim($row->BRANCH_DESC),
               'AccountLiability' => trim($row->AccountLiability),
               'AccountPrepayment' => trim($row->AccountPrepayment),
               'Terms' => trim($row->Terms),
               'Currency' => trim($roq->Currency),    
               'NoRekening' => trim($row->NoRekening),
               'NamaBank' => trim($row->NamaBank),
               'MasaBerlakuTDP' => trim($roq->MasaBerlakuTDP),    
               'Image' => trim($row->Image),
               'AlamatNPWP' => trim($row->AlamatNPWP),
               'AlamatSupplier' => trim($row->AlamatSupplier),
               'VendorAddress' => trim($row->VendorAddress),
               'Performance' => trim($row->Performance) 
               
            );

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
    }

  

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */