<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_itemlist extends CI_Controller {

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
           $this->load->model('master_m/master_itemlist_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_itemlist/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['zonasi1'] = $this->master_itemlist_m->tampil_zone1();
        $data['branch'] = $this->master_itemlist_m->tampil_division();
        $data['item_class'] = $this->master_itemlist_m->tampil_category_item();
        $data['zonasi1'] = $this->master_itemlist_m->tampil_zone1();
//         $data['branch'] = $this->global_m->tampil_division();
        // $data['item_class'] = $this->master_itemlist_m->tampil_category_item();
//         //$data['level_user'] = $this->sec_user_m->get_level_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Master Item Type');
        $this->template->load('template/template_dataTable', 'master_v/master_itemlist_v', $data);
    }

// if (!defined('BASEPATH'))
//     exit('No direct script access allowed');

// class master_itemlist extends CI_Controller {

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
//             $this->load->model('master_m/master_itemlist_m');
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

// function home() {
//         $menuId = $this->home_m->get_menu_id('master/master_itemlist/home');
//         $data['menu_id'] = $menuId[0]->menu_id;
//         $data['menu_parent'] = $menuId[0]->parent;
//         $data['menu_nama'] = $menuId[0]->menu_nama;
//         $data['menu_header'] = $menuId[0]->menu_header;
//         $this->auth->restrict($data['menu_id']);
//         $this->auth->cek_menu($data['menu_id']);
//         $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
//         $data['zonasi1'] = $this->global_m->tampil_zone1();
//         $data['branch'] = $this->global_m->tampil_division();
//         $data['item_class'] = $this->global_m->tampil_category_item();
//         //$data['level_user'] = $this->sec_user_m->get_level_user();

//         $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
//         $data['menu_all'] = $this->user_m->get_menu_all(0);
// //            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
// //            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
// //            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

//         $this->template->set('title', 'Item List');
//         $this->template->load('template/template_dataTable', 'master_v/master_itemlist_v', $data);
//     }


    function get_server_side() {
        $requestData = $_REQUEST;
        // print_r($requestData);die();
        $iStatus = $this->input->post('sStatus');
        $iSearch = $this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'IClassID',
            1 => 'ItemTypeID',
            2 => 'ItemID',
            3 => 'ItemName',
            4 => 'Image',
            // 5 => 'VendorID',
            5 => 'StatusMadya',
            6 => 'StatusPratama',
            7 => 'StatusUtama',
            8 => 'AssetType',
            9 => 'Status'
        );

        // $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'";            
        //$sql = "SELECT * from Mst_ItemList"; 
        $sql = " SELECT A.Status,C.IClassName,B.ItemTypeName, A.ItemName,A.IClassID,A.ItemTypeID ,A.ItemID,
                A.Image,  A.StatusMadya,A.StatusUtama,A.StatusPratama,A.StatusMekar,
                A.Is_trash,A.AssetType     
                from Mst_ItemList A
                LEFT JOIN Mst_ItemType B ON B.ItemTypeID=A.ItemTypeID
                LEFT JOIN Mst_ItemClass C ON C.IClassID=A.IClassID";
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();
        // print_r($totalData); die();
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value']) or ! empty($iStatus) or ! empty($iSearch)) {
            if ($iSearch == '1') {
                $sql .= "SELECT A.Status,C.IClassName,B.ItemTypeName, A.ItemName,A.IClassID,A.ItemTypeID ,A.ItemID,
                        A.Image,A.VendorID,A.StatusMadya,A.StatusUtama,A.StatusPratama,A.StatusMekar,
                        A.Is_trash,A.AssetType     
                        from Mst_ItemList A
                        LEFT JOIN Mst_ItemType B ON B.ItemTypeID=A.ItemTypeID
                        LEFT JOIN Mst_ItemClass C ON C.IClassID=A.IClassID where A.Status like '%" . $iStatus . "%'and C.IClassName like '%" . $requestData['search']['value'] . "%'";
            } else if ($iSearch == '2') {
                $sql .= "/*SELECT * from Mst_ItemList */ where A.Status like '%" . $iStatus . "%'and A.ItemTypeID like '%" . $requestData['search']['value'] . "%'";
            } else if ($iSearch == '3') {
                $sql .= "/*SELECT * from Mst_ItemList */ where A.Status like '%" . $iStatus . "%'and A.ItemID like '%" . $requestData['search']['value'] . "%'";
            } else {

                $sql .= "/*SELECT * from Mst_ItemList */ where A.Status like '%" . $iStatus . "%'";
                // $sql .= "and IClassID like '%".$requestData['search']['value']."%'"; 
                // $sql .= "or ItemTypeID  like '%".$requestData['search']['value']."%'";
                // $sql .= "or ItemID  like '%".$requestData['search']['value']."%'";
                // $sql .= "or ItemName  like '%".$requestData['search']['value']."%'";
                // $sql .= "or Image  like '%".$requestData['search']['value']."%'";
                // $sql .= "or VendorID  like '%".$requestData['search']['value']."%'";
                // $sql .= "or StatusMadya  like '%".$requestData['search']['value']."%'";
                // $sql .= "or StatusPratama  like '%".$requestData['search']['value']."%'";
                // $sql .= "or StatusUtama  like '%".$requestData['search']['value']."%'";
                // $sql .= "or AssetType  like '%".$requestData['search']['value']."%'";
            }

            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows();
            $totalFiltered = $totalData;
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET " . $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
        } else {
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET " . $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array();
        // print_r($sql); die;
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();

            $nestedData[] = $no++;
            $nestedData[] = $row["ItemID"];
            $nestedData[] = "<img height='50px' src='" . base_url() . "/uploads/itemlist/" . $row["Image"] . "' >";
            $nestedData[] = $row["IClassName"];
            $nestedData[] = $row["ItemTypeName"];
            $nestedData[] = $row["ItemName"];


            // $nestedData[] = $row["VendorID"];     
            // $nestedData[] = $row["StatusMadya"];
            // $nestedData[] = $row["StatusPratama"];
            // $nestedData[] = $row["StatusUtama"];
            // $nestedData[] = $row["AssetType"];
            // $nestedData[] = $row["Status"];

            if ($row["Status"] == 0) {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            } else {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
            }
            $nestedData[] = $row['IClassID'];
            $nestedData[] = $row['ItemTypeID'];
            $nestedData[] = $row['StatusMadya'];
            $nestedData[] = $row['StatusUtama'];
            $nestedData[] = $row['StatusPratama'];
            $nestedData[] = $row['StatusMekar'];

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

    public function ajax_UpdateStatusCategory() {
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id = trim(element('ItemID', $i_list));
        $ItemName = trim(element('ItemName', $i_list));
        $id_kyw = (int) $this->session->userdata('id_kyw');
        $Status = trim(element('Status', $i_list));

        $data = array(
            // 'ItemID' => $id,
            'Status' => $Status,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
        );
        $model = $this->global_m->ubah('Mst_ItemList', $data, 'ItemID', $id);
        if ($model) {
            if ($Status == 1) {
                $message = 'Data ' . $ItemName . ' Berhasil Di Aktifkan';
            } else {
                $message = 'Data ' . $ItemName . ' ini Berhasil Di Non Aktifkan';
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
                'msg' => 'Data Berhasil Diubah'
            );
        }
        echo json_encode($notifikasi);
    }

    public function ajax_UpdateCategory() {
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');
        // print_r($_FILES['file']);    
        // echo json_encode($i_list);die();
        // $nm_file=trim(element('txtImage',$i_list)); 
        // if ($id_file=='') {
        //     $nm_file='';
        // }
        $id_kyw = (int) $this->session->userdata('id_kyw');
        $IClassID = trim(element('txtIClassID', $i_list));
// print_r($i_list);
//         die(); 
        // $ItemTypeID = trim(element('ItemTypeID',$i_list));
        // $ItemID = trim(element('ItemID',$i_list)); 
        // $ItemName = trim(element('ItemName',$i_list));
        // $Image = trim(element('Image',$i_list));
        // $VendorID = trim(element('VendorID',$i_list));
        // $StatusMadya = trim(element('StatusMadya',$i_list));
        // $StatusPratama = trim(element('StatusPratama',$i_list));
        // $StatusUtama = trim(element('StatusUtama',$i_list));
        // $StatusMekar = trim(element('StatusMekar',$i_list));
        // // $AssetType = trim(element('AssetType',$i_list)); 
        // $iStatus = trim(element('Status',$i_list));
        if (substr($IClassID, 0, 1) == '1') {
            $AssetType = "CAPEK";
        } elseif (substr($IClassID, 0, 1) == '0') {
            $AssetType = "OPEK";
        } else {
            $AssetType = "OPEXINVENTORIS";
        }

        if (element('ItemID', $i_list) == "Generate") {
            $id = $this->master_itemlist_m->getIdMax();

            $data = array(
                // 'VendorID' => '00000000',
                'ItemID' => $id,
                //  'Status' => $Status,
                'CreateBy' => $id_kyw,
                'CreateDate' => date('Y-m-d H:i:s'),
                'IClassID' => trim(element('txtIClassID', $i_list)),
                'ItemTypeID' => trim(element('txtItemTypeID', $i_list)),
                'ItemName' => trim(element('txtitemname', $i_list)),
                'Image' => trim(element('txtImage', $i_list)),
                'StatusUtama' => trim(element('utama', $i_list)),
                'StatusMadya' => trim(element('madya', $i_list)),
                'StatusPratama' => trim(element('pratama', $i_list)),
                'StatusMekar' => trim(element('mekaar', $i_list)),
                'Status' => trim(element('statustypeAdd', $i_list)),
                'AssetType' => $AssetType
            );
        } else {
            $id = trim(element('ItemID', $i_list));
            $data = array(
                //  'ItemID' => $id,
                //  'Status' => $Status,
                // 'VendorID' => '00000000',
                'UpdateBy' => $id_kyw,
                'UpdateDate' => date('Y-m-d H:i:s'),
                'IClassID' => trim(element('txtIClassID', $i_list)),
                'ItemTypeID' => trim(element('txtItemTypeID', $i_list)),
                'ItemName' => trim(element('txtitemname', $i_list)),
                // 'Image' =>'',
                'StatusUtama' => trim(element('utama', $i_list)),
                'StatusMadya' => trim(element('madya', $i_list)),
                'StatusPratama' => trim(element('pratama', $i_list)),
                'StatusMekar' => trim(element('mekaar', $i_list)),
                'Status' => trim(element('statustypeAdd', $i_list)),
                'AssetType' => $AssetType
            );
        }

        if (element('ItemID', $i_list) == "Generate") {
            $model = $this->master_itemlist_m->simpan_no_iden('Mst_ItemList', $data);
        } else {
            $model = $this->master_itemlist_m->ubah_no_iden('Mst_ItemList', $data, 'ItemID', $id);
        }
        if ($model) {
            $notifikasi = Array(
                'msgType' => true,
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Diubah'
            );
        } else {
            $notifikasi = Array(
                'msgType' => false,
                'msgTitle' => 'Error',
                'msg' => 'Data Berhasil Diubah'
            );
        }
        echo json_encode($notifikasi);
    }

    function doc_upload($elementId, $docType, $cifKode = 'all') {
        // print_r($_FILES[$elementId]);
        // echo $elementId." - ".$docType." - ".$cifKode;
        $error = "";
        $msg = "";
        if (!empty($_FILES[$elementId]['error'])) {
            switch ($_FILES[$elementId]['error']) {
                case '1':
                    $error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                    break;
                case '2':
                    $error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                    break;
                case '3':
                    $error = 'The uploaded file was only partially uploaded';
                    break;
                case '4':
                    $error = 'No file was uploaded.';
                    break;
                case '6':
                    $error = 'Missing a temporary folder';
                    break;
                case '7':
                    $error = 'Failed to write file to disk';
                    break;
                case '8':
                    $error = 'File upload stopped by extension';
                    break;
                case '999':
                default:
                    $error = 'No error code avaiable';
            }
        } elseif (empty($_FILES[$elementId]['tmp_name']) || $_FILES[$elementId]['tmp_name'] == 'none') {
            $error = 'No file was uploaded..';
        } else {
            $msg .= " File Name: " . $_FILES[$elementId]['name'] . ", ";
            $msg .= " File Size: " . @filesize($_FILES[$elementId]['tmp_name']);

            $fName = $_FILES[$elementId]['tmp_name'];
            $fSize = @filesize($_FILES[$elementId]['tmp_name']);

            //for security reason, we force to remove all uploaded file
            @unlink($_FILES[$elementId]);

            $msg = $_FILES[$elementId]['name'] . "|" . $fSize;
            $filename = basename($_FILES[$elementId]['name']);
            $upload_dir = "uploads/itemlist/"; //".$docType."/";     
            if (!file_exists($upload_dir))
                mkdir($upload_dir, 0777, true);
            $uploadfile = $upload_dir . $filename;
            move_uploaded_file($_FILES[$elementId]['tmp_name'], $uploadfile);



            // $dataDocs = $this->getDocuments($docType, $cifKode);
            // $msg = json_encode($dataDocs);
            $data = array(
                    'Image' => $filename,
            );

            $model = $this->global_m->ubah('Mst_ItemList', $data, 'ItemID', $cifKode);
        }

        echo "{";
        echo "error: '" . $error . "',\n";
        echo "msg: '" . $msg . "'\n";
        echo "}";
    }

    public function OnClassItem($prop = '') {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_itemcategory_m->getUserKab($prop);
        $options = "";
        $options .= "<option  value='NULL' selected>-Pilih-</option>";
        foreach ($rows as $v) {
            $options .= "<option  value='" . $v->IClassID . "'>" . $v->ItemTypeName . "</option>";
        };

        //$this->output->set_output(json_encode($data));
        $this->output->set_output(json_encode($options));
    }

    public function OnItemType($prop = '') {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $options = $this->master_itemlist_m->getItemType($prop);
        // $options = "";
        // $options .= "<option  value='NULL' selected>-Pilih-</option>";
        // foreach ($rows as $v) {
        //     $options .= "<option  value='" . $v->IClassID . "'>" . $v->ItemTypeName . "</option>";
        // };
        //$this->output->set_output(json_encode($data));
        $this->output->set_output(json_encode($options));
    }

    public function getItemList() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_itemlist_m->getItemList();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(
                'ItemID' => trim($roq->ItemID),
                'ItemTypeID' => trim($row->ItemTypeID),
                'itemname' => trim($row->itemname),
                'Image' => trim($row->Image)
            );

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */
