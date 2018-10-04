<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class project extends CI_Controller {

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
           $this->load->model('master_m/project_m');
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
        $menuId = $this->home_m->get_menu_id('master/project/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $coa = $this->project_m->getCOA();
        $data['coa']=$coa;
        $data['cabang']= $this->project_m->getbranch2();
        //$data['level_user'] = $this->sec_user_m->get_level_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Master RequestProject');
        $this->template->load('template/template_dataTable', 'master_v/project_v', $data);
    }

// if (!defined('BASEPATH'))
//     exit('No direct script access allowed');

// class master_zonasi extends CI_Controller {

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
//             $this->load->model('master_m/master_zonasi_m');
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
//         $menuId = $this->home_m->get_menu_id('master/master_zonasi/home');
//         $data['menu_id'] = $menuId[0]->menu_id;
//         $data['menu_parent'] = $menuId[0]->parent;
//         $data['menu_nama'] = $menuId[0]->menu_nama;
//         $data['menu_header'] = $menuId[0]->menu_header;
//         $this->auth->restrict($data['menu_id']);
//         $this->auth->cek_menu($data['menu_id']);
//         $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
//         //$data['level_user'] = $this->sec_user_m->get_level_user();

//         $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
//         $data['menu_all'] = $this->user_m->get_menu_all(0);
// //            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
// //            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
// //            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

//         $this->template->set('title', 'Zonasi');
//         $this->template->load('template/template_dataTable', 'master_v/master_zonasi_v', $data);
//     }


      function get_server_side() {

        $brans='';//'br.BranchID = '.$sessidbrans.' and';
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $columns = array(
            // datatable column index  => database column name
            0 => 'ReqCategoryID',
            1 => 'ReqCategoryName',
            2 => 'ReqTypeID',
            3 => 'BudgetID',
            4 => 'BudgetCOA',
            5 => 'Status',
            6 => 'CreateDate',
            7 => 'CreateBy'
           
        );

        $sql= "SELECT proj.RktName, proj.RktYear, cat.ReqCategoryName, proj.RktID, br.BranchID,br.BranchName, zo.ZoneName, div.DivisionName, proj.Is_trash
                FROM Mst_Rkt proj
                LEFT JOIN Mst_RequestCategory cat ON proj.ReqCategoryID = cat.ReqCategoryID
                LEFT JOIN Mst_Branch br ON proj.BranchID = br.BranchID              
                LEFT JOIN Mst_Division div ON proj.DivisionID = div.DivisionID
                LEFT JOIN Mst_Zonasi zo ON proj.ZoneID = zo.ZoneID
                WHERE $brans 1=1 and proj.Is_trash LIKE '%".$iStatus."%'  
                ";


        // $sql = "SELECT mc.*,reqcat.ReqCategoryID, reqcat.ReqCategoryName, reqcat.CreateDate, reqtype.ReqTypeName, reqcat.Is_trash, div.DivisionName, br.BranchName, reqcat.Status
        //                         FROM Mst_RequestCategory reqcat
        //         INNER JOIN Mst_RequestType reqtype ON reqcat.ReqTypeID = reqtype.ReqTypeID
        //                         LEFT JOIN Mst_Budget mc ON mc.BudgetCOA=reqcat.BudgetCOA
        //                         LEFT JOIN Mst_Division div ON div.DivisionID=mc.DivisionID/*ON reqcat.BudgetCoa = div.DivisionCode*/
        //                         LEFT JOIN Mst_Branch br ON br.BranchID=mc.BranchID /*reqcat.BudgetCoa = br.BranchCode*/
        //          where  mc. YEAR = '".date('Y')."' AND reqcat.Status like '%".$iStatus."%'";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;        

        if (!empty($requestData['search']['value'])) {

                if($iSearch ==1 ){//'BranchName')
                    $src_category = 'br.BranchName ';//.$src_category;
                }elseif ($iSearch ==2){// 'unit') 
                    $src_category = 'un.BisUnitName ';//.$src_category;
                }elseif ($iSearch ==3){// 'DivisionName ') 
                    $src_category = 'div.DivisionName  ';//.$src_category;
                }elseif ($iSearch ==4){// 'RktName ') 
                    $src_category = 'proj.RktName  ';//.$src_category;
                }else{// 'RktName') 
                    $src_category = 'br.BranchName ';
                }

            if ($iSearch=='1'){

                $sql="SELECT proj.RktName, proj.RktYear, cat.ReqCategoryName, proj.RktID, br.BranchID,br.BranchName, zo.ZoneName, div.DivisionName, proj.Is_trash
                FROM Mst_Rkt proj
                LEFT JOIN Mst_RequestCategory cat ON proj.ReqCategoryID = cat.ReqCategoryID
                LEFT JOIN Mst_Branch br ON proj.BranchID = br.BranchID              
                LEFT JOIN Mst_Division div ON proj.DivisionID = div.DivisionID
                LEFT JOIN Mst_Zonasi zo ON proj.ZoneID = zo.ZoneID
                WHERE proj.Is_trash LIKE '%".$iStatus."%' and $src_category like '%".trim($requestData['search']['value'])."%'   ";


              
            }else if ($iSearch=='2'){
                 $sql="SELECT proj.RktName, proj.RktYear, cat.ReqCategoryName, proj.RktID, br.BranchID,br.BranchName, zo.ZoneName, div.DivisionName, proj.Is_trash
                FROM Mst_Rkt proj
                LEFT JOIN Mst_RequestCategory cat ON proj.ReqCategoryID = cat.ReqCategoryID
                LEFT JOIN Mst_Branch br ON proj.BranchID = br.BranchID              
                LEFT JOIN Mst_Division div ON proj.DivisionID = div.DivisionID
                LEFT JOIN Mst_Zonasi zo ON proj.ZoneID = zo.ZoneID
                WHERE proj.Is_trash LIKE '%".$iStatus."%' and $src_category like '%".trim($requestData['search']['value'])."%' ";
                // $sql = "SELECT mc.*,reqcat.ReqCategoryID, reqcat.ReqCategoryName, reqcat.CreateDate, reqtype.ReqTypeName, reqcat.Is_trash, div.DivisionName, br.BranchName, reqcat.Status
                //                 FROM Mst_RequestCategory reqcat
                // INNER JOIN Mst_RequestType reqtype ON reqcat.ReqTypeID = reqtype.ReqTypeID
                //                 LEFT JOIN Mst_Budget mc ON mc.BudgetCOA=reqcat.BudgetCOA
                //                 LEFT JOIN Mst_Division div ON div.DivisionID=mc.DivisionID/*ON reqcat.BudgetCoa = div.DivisionCode*/
                //                 LEFT JOIN Mst_Branch br ON br.BranchID=mc.BranchID /*reqcat.BudgetCoa = br.BranchCode*/
                //   where  mc. YEAR = '".date('Y')."' AND reqcat.Status like '%".$iStatus."%'and ReqCategoryName like '%".trim($requestData['search']['value'])."%'";
            }else{
                 $sql="SELECT proj.RktName, proj.RktYear, cat.ReqCategoryName, proj.RktID, br.BranchID,br.BranchName, zo.ZoneName, div.DivisionName, proj.Is_trash
                FROM Mst_Rkt proj
                LEFT JOIN Mst_RequestCategory cat ON proj.ReqCategoryID = cat.ReqCategoryID
                LEFT JOIN Mst_Branch br ON proj.BranchID = br.BranchID              
                LEFT JOIN Mst_Division div ON proj.DivisionID = div.DivisionID
                LEFT JOIN Mst_Zonasi zo ON proj.ZoneID = zo.ZoneID
                WHERE proj.Is_trash LIKE '%".$iStatus."%' and $src_category like '%".trim($requestData['search']['value'])."%'   ";
                // $sql = "SELECT mc.*,reqcat.ReqCategoryID, reqcat.ReqCategoryName, reqcat.CreateDate, reqtype.ReqTypeName, reqcat.Is_trash, div.DivisionName, br.BranchName, reqcat.Status
                //                 FROM Mst_RequestCategory reqcat
                // INNER JOIN Mst_RequestType reqtype ON reqcat.ReqTypeID = reqtype.ReqTypeID
                //                 LEFT JOIN Mst_Budget mc ON mc.BudgetCOA=reqcat.BudgetCOA
                //                 LEFT JOIN Mst_Division div ON div.DivisionID=mc.DivisionID/*ON reqcat.BudgetCoa = div.DivisionCode*/
                //                 LEFT JOIN Mst_Branch br ON br.BranchID=mc.BranchID /*reqcat.BudgetCoa = br.BranchCode*/
                //   where  mc. YEAR = '".date('Y')."' AND reqcat.Status like '%".$iStatus."%'"; 
                // $sql .= "and ReqCategoryID like '%".$requestData['search']['value']."%'"; 
           
            }
           
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
            $sql.=" ORDER BY proj.ZoneID, proj.BranchID, proj.ReqCategoryID  OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            
        }else {

               $sql.=" ORDER BY proj.ZoneID, proj.BranchID, proj.ReqCategoryID  OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
            
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        // echo "<pre>";
        // print_r($sql);die();
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
             $divisi='';
                if ($row['DivisionName'] !='') {
                    $divisi='( Division : '.$row['DivisionName'].' )';
                }

            $nestedData[] = $no++; 
            $nestedData[] = $row["RktID"];
            $nestedData[] = $row["ZoneName"];    
            $nestedData[] = $row['BranchName'].' '.$divisi;
            $nestedData[] = $row["ReqCategoryName"];
            $nestedData[] = $row["RktName"];
            $nestedData[] = $row["RktYear"];

            if($row["Is_trash"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning " href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
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


    public function add_reqcat()
    {
        $txtId=$this->input->post('txtId');
        $reqname=$this->input->post('txtReqTypeName');
        $COA=$this->input->post('coa');
        $ReqTypeID=$this->input->post('txtReqTypeCode');
        // print_r($_POST);
        if($reqname!="" && $txtId =="Generate"){   
            // echo "asdasdasd";die();
            
            $chk=$this->input->post('chk');
            $selbudget=$this->project_m->get_budget($chk);
            //print_r($selbudget);die();
            $model=$this->project_m->savedata($selbudget);
            $this->session->set_flashdata('msg', 'Success! Request Category Name '.$reqname.' Success Insert data');
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

        }else{
        // echo "22222";die();   
        $model=$this->project_m->updatedata($txtId);       
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
    }





    public function objekItem(){        
        $data = $this->project_m->getItemCategory();
        // $pilihan = "<option value=''>--Select--</option>";
        $pilihan = '';
        foreach ($data as $row) {
            $pilihan .=' <option value="'.$row->IClassID.'">'. $row->IClassName.'</option>';
        }

        echo $pilihan;
    }

    public function ajax_UpdateStatusType($id){
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        //$id = trim(element('ReqCategoryID',$i_list));
        $id_kyw=(int)$this->session->userdata('id_kyw');
        $Status = trim(element('Status',$i_list));
        
        $data = array(
           // 'ReqCategoryID' => $id,
            'Is_trash' => $Status,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
        // print_r($data);
        $model = $this->global_m->ubah('Mst_Rkt', $data,'RktID',$id);
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


 public function ajax_UpdateType(){
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id_kyw=(int)$this->session->userdata('id_kyw');
        $ReqCategoryID = trim(element('ReqCategoryID',$i_list));
        $ReqCategoryName = trim(element('ReqCategoryName',$i_list));
        $BudgetID = trim (element('BudgetID',$i_list));
        $BudgetCOA = trim (element('BudgetCOA',$i_list));
       
        $iStatus = trim(element('Status',$i_list));
        
        if(element('ReqCategoryID',$i_list)=="Generate"){
            $id = $this->project_m->getIdMax();
            $data = array(
            'ReqCategoryID' => $id,
            'ReqCategoryName' => $ReqCategoryName,
            'BudgetID' => $BudgetID,
            'BudgetCOA' => $BudgetCOA,

            'Status' => $iStatus,
            'CreateBy' => $id_kyw,
            'CreateDate' => date('Y-m-d H:i:s'),
            'CreateBy'=>$this->session->userdata('user_id'),
            'Is_trash' =>0
            
        );
       }else{
            $id = trim(element('ReqCategoryID',$i_list));
         $data = array(

            
            'ReqCategoryName' => $ReqCategoryName,
            'BudgetID' => $BudgetID,
            'BudgetCOA' => $BudgetCOA,
           

            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
       }
      
       
        if(element('ReqCategoryID',$i_list)=="Generate"){
        $model = $this->global_m->simpan('Mst_RequestCategory', $data);
       }else{
        $model = $this->global_m->ubah('Mst_RequestCategory', $data,'ReqCategoryID',$id);
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



   public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->project_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(
                
               'ReqCategoryID' => trim($row->ReqCategoryID), 
               'ReqCategoryName' => trim($row->ReqCategoryName),
               'ReqTypeName' => trim($row->ReqTypeName), 
               'DivisionName' => trim($row->DivisionName)
                   
               
            );

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
    }


    public function detil_reqcat($id){
            $detail=$this->project_m->seldetil($id);
            $reqtype = $this->project_m->gettype();
            $reqdivisi = $this->project_m->getdivision();
            $clas = $this->project_m->getclass();
            $item = $this->project_m->getitemupdate($id);
           $listclass = $this->project_m->getClassByID($id); 
          // print_r($listclass);
            $list_s='';
            $i=1;
            foreach ($listclass as $key) {
                $list_s.=" <tr id='row_$i' class='objek'>
              <td width='5px'>$i</td>
              <td width='5px'><select  name='classID[]' id='classID[]' class='ass opsi pilihan form-control' >
              <option value='$key->IClassID'>$key->IClassName</option></select></td>
              <td><a onclick='deleterow($i)' class='hidden' >
              <i class='fa fa-times'></i></a> <input type='hidden' class='form-control' id='tot' name='tot' value='$i'/></td>
                </tr>";
                $i++;
            }
            
            $coa = $this->project_m->getCOA();
            $data=array(
                'listdata' =>$detail[0],
                'type'=>$reqtype,
                'divisi'=>$reqdivisi,
                'class'=>$clas,
                'item'=>$item,
                'list'=>$list_s,
                'coa'=>$coa,
            );
             $this->output->set_output(json_encode($data));
    }



        public function edit_reqcat($id){
            $detail=$this->project_m->seldetil($id);
            $reqtype = $this->project_m->gettype();
            $reqdivisi = $this->project_m->getdivision();
            $clas = $this->project_m->getclass();
            $item = $this->project_m->getitemupdate($id);
           $listclass = $this->project_m->getClassByID($id); 
          // print_r($listclass);
            $list_s='';
            $i=1;
            foreach ($listclass as $key) {
                $list_s.=" <tr id='row_$i' class='objek'>
              <td width='5px'>$i</td>
              <td width='5px'><select  name='classID[]' id='classID[]' class='ass opsi pilihan form-control' >
              <option value='$key->IClassID'>$key->IClassName</option></select></td>
              <td><a onclick='deleterow($i)' class='' >
              <i class='fa fa-times'></i></a> <input type='hidden' class='form-control' id='tot' name='tot' value='$i'/></td>
                </tr>";
                $i++;
            }
            
            $coa = $this->project_m->getCOA();
            $data=array(
                'listdata' =>$detail[0],
                'type'=>$reqtype,
                'divisi'=>$reqdivisi,
                'class'=>$clas,
                'item'=>$item,
                'list'=>$list_s,
                'coa'=>$coa,
            );
             $this->output->set_output(json_encode($data));
    }




//::new
 public function OnBranch($prop = '') {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->project_m->getdivisi($prop);
        $options = "";
       // $options .= "<option  value='NULL' selected>-Pilih-</option>";
        foreach ($rows as $v) {
            $options .= "<option  value='" . $v->DivisionID . "'>" . $v->DivisionName . "</option>";
        };


        //$this->output->set_output(json_encode($data));
        $this->output->set_output(json_encode($options));
    } 


     public function OnDiv($prop = '') {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->project_m->getKategori($prop);
        $options = "";
       // $options .= "<option  value='NULL' selected>-Pilih-</option>";
        foreach ($rows as $v) {
            $options .= "<option  value='" . $v->ReqCategoryID . "'>" . $v->ReqCategoryName . "</option>";
        };

        //$this->output->set_output(json_encode($data));
        $this->output->set_output(json_encode($options));
    } 


        public function add_reqproj()
    {
        $reqname=$this->input->post('name');
        $txtId=$this->input->post('txtId');

        
        if($reqname!="" && $txtId=='Generate'){   
            $zona = $this->project_m->getzone($this->input->post('branch'));              
            $model=$this->project_m->savedata($zona->ZoneID);

        if ($model) {
            $notifikasi = Array(
                'msgType' => true,
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil disimpan'
            );
        } else {
            $notifikasi = Array(
                'msgType' => false,
                'msgTitle' => 'Error',
                'msg' => 'Data gagal disimpan'
            );
        }
        echo json_encode($notifikasi);

                  
        }else{                          

            $zona = $this->project_m->getzone($this->input->post('branch'));              
            $model=$this->project_m->updatedata($txtId,$zona->ZoneID);
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
                'msg' => 'Data gagal Diubah'
            );
        }
        echo json_encode($notifikasi);
        }
    }


    public function edit_reqproj($id){
            $detail=$this->project_m->detail_proj($id);
            $data=array();
            $list_s='';
            $i=1;
            foreach ($detail as $key) {
                 $data=array(
                'RktID' =>trim($key->RktID),
                'RktName' =>trim($key->RktName),
                'RktYear'=>trim($key->RktYear),
                'ReqCategoryID'=>trim($key->ReqCategoryID),
                'BranchID'=>trim($key->BranchID),
                'ZoneID'=>trim($key->ZoneID),
                'DivisionID'=>trim($key->DivisionID)
             );
            }
            

           
             $this->output->set_output(json_encode($data));
    }


}