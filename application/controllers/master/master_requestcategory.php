<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_requestcategory extends CI_Controller {

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
           $this->load->model('master_m/master_requestcategory_m');
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
      $menuId = $this->home_m->get_menu_id('master/master_requestcategory/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);

        $data['itemcategory'] = $this->master_requestcategory_m->tampil_zone();
        $data['Requestcategory'] = $this->master_requestcategory_m->tampilitemcategory();
        $coa = $this->master_requestcategory_m->getCOA();
        $data['coa']=$coa;


        $this->template->set('title', 'Master Request Category');
        $this->template->load('template/template_dataTable', 'master_v/master_requestcategory_v', $data);
    }


    function get_server_side() {
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

        
        $sql = "SELECT mc.*,reqcat.ReqCategoryID, reqcat.ReqCategoryName, reqcat.CreateDate, reqtype.ReqTypeName, reqcat.Is_trash, div.DIV_DESC, br.FLEX_VALUE, reqcat.Status
                                FROM Mst_RequestCategory reqcat
                INNER JOIN Mst_RequestType reqtype ON reqcat.ReqTypeID = reqtype.ReqTypeID
                 LEFT JOIN Mst_Budget mc ON mc.BudgetCOA=reqcat.BudgetCOA
                                LEFT JOIN TBL_M_DIVISION div ON div.FLEX_VALUE= mc.DivisionID/*ON reqcat.BudgetCoa = div.DivisionCode*/
                                LEFT JOIN TBL_M_BRANCH br ON br.FLEX_VALUE=mc.BranchID /*reqcat.BudgetCoa = br.BranchCode*/
                 where  mc. YEAR = '".date('Y')."' AND reqcat.Status like '%".$iStatus."%'";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;        

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT mc.*,reqcat.ReqCategoryID, reqcat.ReqCategoryName, reqcat.CreateDate, reqtype.ReqTypeName, reqcat.Is_trash, div.DivisionName, br.BranchName, reqcat.Status
                                FROM Mst_RequestCategory reqcat
                INNER JOIN Mst_RequestType reqtype ON reqcat.ReqTypeID = reqtype.ReqTypeID
                                LEFT JOIN Mst_Budget mc ON mc.BudgetCOA=reqcat.BudgetCOA
                                LEFT JOIN Mst_Division div ON div.DivisionID=mc.DivisionID/*ON reqcat.BudgetCoa = div.DivisionCode*/
                                LEFT JOIN Mst_Branch br ON br.BranchID=mc.BranchID /*reqcat.BudgetCoa = br.BranchCode*/
                  where  mc. YEAR = '".date('Y')."' AND reqcat.Status like '%".$iStatus."%' and ReqCategoryID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT mc.*,reqcat.ReqCategoryID, reqcat.ReqCategoryName, reqcat.CreateDate, reqtype.ReqTypeName, reqcat.Is_trash, div.DivisionName, br.BranchName, reqcat.Status
                                FROM Mst_RequestCategory reqcat
                INNER JOIN Mst_RequestType reqtype ON reqcat.ReqTypeID = reqtype.ReqTypeID
                                LEFT JOIN Mst_Budget mc ON mc.BudgetCOA=reqcat.BudgetCOA
                                LEFT JOIN Mst_Division div ON div.DivisionID=mc.DivisionID/*ON reqcat.BudgetCoa = div.DivisionCode*/
                                LEFT JOIN Mst_Branch br ON br.BranchID=mc.BranchID /*reqcat.BudgetCoa = br.BranchCode*/
                  where  mc. YEAR = '".date('Y')."' AND reqcat.Status like '%".$iStatus."%' and ReqCategoryName like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT mc.*,reqcat.ReqCategoryID, reqcat.ReqCategoryName, reqcat.CreateDate, reqtype.ReqTypeName, reqcat.Is_trash, div.DivisionName, br.BranchName, reqcat.Status
                                FROM Mst_RequestCategory reqcat
                INNER JOIN Mst_RequestType reqtype ON reqcat.ReqTypeID = reqtype.ReqTypeID
                                LEFT JOIN Mst_Budget mc ON mc.BudgetCOA=reqcat.BudgetCOA
                                LEFT JOIN Mst_Division div ON div.DivisionID=mc.DivisionID/*ON reqcat.BudgetCoa = div.DivisionCode*/
                                LEFT JOIN Mst_Branch br ON br.BranchID=mc.BranchID /*reqcat.BudgetCoa = br.BranchCode*/
                  where  mc. YEAR = '".date('Y')."' AND reqcat.Status like '%".$iStatus."%'"; 
                $sql .= " and ReqCategoryID like '%".$requestData['search']['value']."%'"; 
           
            }
           
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            
        }else {

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
            $nestedData[] = $row["ReqCategoryID"];
            $nestedData[] = $row["ReqCategoryName"];//.' - '.$row["Status"];
            $nestedData[] = $row["ReqTypeName"];
            $nestedData[] = $row["DivisionName"];
            $nestedData[] = $row["BranchName"];
            $nestedData[] = $row["CreateDate"];

            if($row["Status"]==0)
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
            $selbudget=$this->master_requestcategory_m->get_budget($chk);
            //print_r($selbudget);die();
            $model=$this->master_requestcategory_m->savedata($selbudget);
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
        $model=$this->master_requestcategory_m->updatedata($txtId);       
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
        $data = $this->master_requestcategory_m->getItemCategory();
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
            'Status' => $Status,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
        // print_r($data);
        $model = $this->global_m->ubah('Mst_RequestCategory', $data,'ReqCategoryID',$id);
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
            $id = $this->master_requestcategory_m->getIdMax();
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
        $rows = $this->master_requestcategory_m->getUserInfo();
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
            $detail=$this->master_requestcategory_m->seldetil($id);
            $reqtype = $this->master_requestcategory_m->gettype();
            $reqdivisi = $this->master_requestcategory_m->getdivision();
            $clas = $this->master_requestcategory_m->getclass();
            $item = $this->master_requestcategory_m->getitemupdate($id);
           $listclass = $this->master_requestcategory_m->getClassByID($id); 
          // print_r($listclass);
            $list_s='';
            $i=1;
            foreach ($listclass as $key) {
                $list_s.=" <tr id='row_$i' class='objek'>
              <td width='5px'>$i</td>
              <td width='5px'><select  name='classID[]' id='classID[]' class='ass option  opsi pilihan form-control' >
              <option value='$key->IClassID'>$key->IClassName</option></select></td>
              <td><a onclick='deleterow($i)' class='hidden' >
              <i class='fa fa-times'></i></a> <input type='hidden' class='form-control' id='tot' name='tot' value='$i'/></td>
                </tr>";
                $i++;
            }
            
            $coa = $this->master_requestcategory_m->getCOA();
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
            $detail=$this->master_requestcategory_m->seldetil($id);
            $reqtype = $this->master_requestcategory_m->gettype();
            $reqdivisi = $this->master_requestcategory_m->getdivision();
            $clas = $this->master_requestcategory_m->getclass();
            $item = $this->master_requestcategory_m->getitemupdate($id);
           $listclass = $this->master_requestcategory_m->getClassByID($id); 
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
            
            $coa = $this->master_requestcategory_m->getCOA();
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



}
/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */