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
//            echo '<pre>';
//            print_r($chekinguser2);die();
            $grupnya = $chekinguser2[0]->user_groupid;
            $query = "SELECT B.usergroup_id ,B.usergroup_desc
                    FROM xfn_SplitString('$grupnya',',') AS A
                    INNER JOIN [dbo].[sec_usergroup] AS B ON A.splitdata=B.usergroup_id";
            $cari_grup = $this->db->query($query)->result();
            $cari_grup = json_encode($cari_grup, true);
//            echo '<pre>';
//            print_r($cari_grup);die();

            if (sizeof($chekinguser2) > 0) {
                $this->Chekinglogin_mdl->update_user($userdata->data[0]->nik, $userdata->data[0]->foto);
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
//                    'groupid' => $usr2->user_groupid,
//                    'groupname' => $usr2->usergroup_desc,
                    'foto' => $foto,
                    'is_login' => 0,
//                ==================local mtm
                    'id_user' => $usr2->nik,
                    'namaKyw' => $usr2->user_name,
//                    'usergroup' => $usr2->user_groupid, //ganti sama select an di function sess()
//                    'usergroup_desc' => $usr2->usergroup_desc, //ganti sama select an di function sess()
//                =====tambahan
                    'posisi_desc' => $usr2->PositionName,
                    'pilihan_grupuser' => $cari_grup,
                );
//                echo '<pre>';
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

    function sess() {
        
        $data = $_POST['pilihGroup'];
        $exp = explode("-", $data);
        $usergroup  = $exp[0];
        $usergroup_desc  = $exp[1];
        $session_data = array(
            'groupid' => $usergroup,
            'groupname' => $usergroup_desc,
            'usergroup' => $usergroup, //ganti sama select an
            'usergroup_desc' => $usergroup_desc, //ganti sama select an
            'is_login' => 1,
        );
//                echo '<pre>';
//                print_r($session_data);die();
        $this->session->set_userdata($session_data);
        redirect('main/home');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */