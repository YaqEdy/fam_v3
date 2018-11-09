<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chekinglogin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/Chekinglogin_mdl');
    }

    public function index() {
        $this->load->database();
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='LOGIN SSO'");
        $result = $query->result()[0];

        $secret_code = strtoupper("$3cretc0d3" . $_GET['UserName'] . ",MASSET," . $_GET['IDSDM']);
        //$apiuser = file_get_contents("http://103.76.17.197/SSO_WebService/crosscheck.php?secret=" . $secret_code . "&&app_code=MASSET&username=" . $_GET['UserName'] . "");
        $apiuser = file_get_contents($result->LINK . "?secret=" . $secret_code . "&&app_code=MASSET&username=" . $_GET['UserName'] . "");
        if ($apiuser) {
            $userlog = json_decode($apiuser);
            $userdata = $userlog->login[0];
        } else {
            echo 'Maaf untuk sementara didapat diakses. Coba beberapa saat lagi!!!';
        }

//         echo "<pre>";
//        print_r($userdata->data[0]);
//        die();
        if (!empty(trim($userdata->data[0]->nik))) {
            $chekinguser2 = $this->Chekinglogin_mdl->chek_user($userdata->data[0]->nik);
            if (sizeof($chekinguser2) > 0) {
                $this->Chekinglogin_mdl->update_user($userdata->data[0]->nik,$userdata->data[0]->foto);
                $usr2 = $chekinguser2[0];
                //multiinserting
//            if ($usr2->user_groupid == '1') {
//                $this->check_user_avail();
//            }
                if ($usr2->BranchID == "") {
                    $brc = 'KTRPST';
                } else {
                    $brc = $usr2->BranchID;
                }

                if ($usr2->user_photo == '') {
                    $foto = "" . base_url() . "metronic/img/noPhoto.jpg";
                } else {
                    $foto = $usr2->user_photo;
                }
                $session_data = array(
                    'user_id' => $usr2->nik,
                    'name' => $usr2->name,
                    'user_name' => $usr2->user_name,
                    'user_email' => $usr2->user_email,
                    'PositionID' => $usr2->PositionID,
                    'BranchID' => $brc,
                    'BranchName' => $usr2->BranchName,
                    'BranchCode' => $usr2->BranchCode,
                    'DivisionID' => $usr2->DivisionID,
                    'DivisionCode' => $usr2->DivisionCode,
                    'ZoneName' => $usr2->ZoneName,
                    'ZoneID' => $usr2->ZoneID,
                    'groupid' => $usr2->user_groupid,
                    'groupname' => $usr2->usergroup_desc,
                    'foto' => $foto,
                    'is_login' => 1,
//                ==================local mtm
                    'id_user' => $usr2->nik,
                    'namaKyw' => $usr2->user_name,
                    'usergroup' => $usr2->user_groupid,
                    'usergroup_desc' => $usr2->usergroup_desc,
//                =====tambahan
                    'posisi_desc' => $usr2->PositionName
                );
//                print_r($session_data);die();
                $this->session->set_userdata($session_data);
                $this->auth->redirect_me();
            } else {
                $this->auth->redirect_me();
            }
        } else {
            $this->auth->redirect_me();
        }
//        $this->auth->redirect_me();
    }

    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */