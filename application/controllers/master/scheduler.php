<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Scheduler extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('global_m');
        $this->index();
    }

    public function index() {
        $timeNow = date("H:i", time());
//        if ($timeNow == '23:22') {
            $this->global_m("INSERT INTO [dbo].[aaa_tes]([tes_desc]) VALUES('ya')");
//        }
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */