<?php
class Email_m extends CI_Model {

    function __construct() {
        parent::__construct();
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
        $this->load->database();
    }
    
    public function kirim_email($nopes, $id_claim, $nilaii, $keter, $statuss) {//kirim email saja
//        die($idpes);
        $sql_nopes = "select no_peserta from claim where id_claim='$id_claim' ";
        $result_nopes = $this->db->query($sql_nopes)->result();

        $nopes = $result_nopes[0]->no_peserta;
//        die($nopes);

        $sql_cari = "select * from master_peserta where no_peserta='$nopes'";
        $result = $this->db->query($sql_cari)->result();
        $no_hp = $result[0]->no_hp;
        $nama_peserta = $result[0]->nama_peserta;
        $email = $result[0]->email;
//        die($sql_cari);
        if ($no_hp == '') {
            $no = 0;
        } else {
            $no = $no_hp;
        }


        $sql_claim = "select c.*,ms.`status` as statusc,mc.ket from claim c 
                    left join master_status ms on ms.id_status = c.status
                    left join master_type_claim mc on mc.id_type_claim = c.tipe_claim 
                    where id_claim='$id_claim'";
        $result2 = $this->db->query($sql_claim)->result();

        $no_klaim = $result2[0]->no_klaim;
        $tgl_kw = date('d-m-Y', strtotime($result2[0]->tgl_kwitansi));
        $tgl_byrr = strtotime($result2[0]->tgl_bayar);
        if ($tgl_byrr != 0 || $tgl_byrr == '') {
//            die('1');
            $tgl_bayar = date('d-m-Y', strtotime($result2[0]->tgl_bayar));
        } else {
//            die('2');
            $tgl_bayar = '-';
        }
        $diagnosa = $result2[0]->diagnosa;
        $pengajuan = number_format($result2[0]->nominal_claim, 2);
        $disetujui = number_format($nilaii, 0); //$result2[0]->nominal_byr;
        $tgl_aju = date('d-m-Y', strtotime($result2[0]->tgl_req));


        $keterangan = $result2[0]->ket_claim;
        $ket_claim = $result2[0]->ket;
        $cat_asuransi = $result2[0]->remarks; //$keter

        $sql_status = "select * from master_status where id_status='$statuss'";
        $result3 = $this->db->query($sql_status)->result();

        $status = $result3[0]->status;

//        ini sms
//        if($statuss=='5'){ //approve
//            date_default_timezone_set("Asia/Bangkok");
//            $a = date("Y-m-d");
//            $pesan="d.h,\nKlaim $ket_claim Anda \na.n $nama_peserta \nNo. $no_klaim sebesar Rp.$pengajuan telah ditransfer Rp.$disetujui pada tgl $a\nTerima kasih";  
//        }elseif($statuss=='6'){ //reject
//            $pesan="d.h,\nKlaim $ket_claim Anda \na.n $nama_peserta \nNo. $no_klaim sebesar Rp.$pengajuan ditolak asuransi.\nHubungi MPM untuk info lebih lanjut.\nTerima kasih";
//        }elseif($statuss=='3'){ //proses asuransi
//            $pesan = "d.h,\nKlaim $ket_claim Anda \na.n $nama_peserta \nNo. $no_klaim sebesar Rp.$pengajuan sedang diproses asuransi \nTerima kasih";
//        }elseif($statuss=='2'){ //proses verifikasi
//            $pesan = "d.h,\nKlaim $ket_claim Anda \na.n $nama_peserta \nNo. $no_klaim sebesar Rp.$pengajuan sedang diverifikasi asuransi \nTerima kasih";
//        }elseif($statuss=='8'){ //cancel
//            $pesan="d.h,\nKlaim $ket_claim Anda \na.n $nama_peserta \nNo. $no_klaim sebesar Rp.$pengajuan dicancel asuransi.\nHubungi MPM untuk info lebih lanjut.\nTerima kasih";
//        }elseif($statuss=='4'){ //proses dok kurang
//            $pesan = "d.h,\nKlaim $ket_claim Anda \na.n $nama_peserta \nNo. $no_klaim sebesar Rp.$pengajuan dikembalikan karena berkas masih kurang \nTerima kasih";
//        }
//        
//        $user     = urlencode("PT MPM");
//        $password = "linkit";
//        $msg      = urlencode($pesan);
//        $msisdn   = "$no"; //
//        $url      = "http://smsapi.linkit360.com/sms.php?user=".$user."&pwd=".$password."&msisdn=".$msisdn."&sender=".$user."&message=".$msg;
//        $ch       = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $output = curl_exec($ch);
        //        kirim email
        $this->load->library('email/mailer');
        $recipient1 = $email;
        $recipient2 = 'afrizal@mitrateknomadani.com';

        $password = $this->master_peserta_m_1->generateRandomString();
        $pass_db = base64_encode($password);

//        date_default_timezone_set("Asia/Bangkok");
//        $a = date("Y-m-d");
//        $tgl_byr = date('d-m-Y',strtotime($a));

        $body = "<table border='0' style='width:800px'>";
        $body = $body . "<tr>";
        $body = $body . "<td colspan='2'><h2>No Claim $no_klaim</h2></td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        $body = $body . "<td>No Claim</td>";
        $body = $body . "<td>: $no_klaim</td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        $body = $body . "<td>Nama</td>";
        $body = $body . "<td>: $nama_peserta</td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        $body = $body . "<td>Tgl kwitansi</td>";
        $body = $body . "<td>: $tgl_kw</td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        //$body = $body . "<td>Diagnosa</td>";
        //$body = $body . "<td>: $diagnosa</td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        $body = $body . "<td>Nominal Pengajuan</td>";
        $body = $body . "<td>: Rp.$pengajuan</td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        $body = $body . "<td>Nominal Disetujui</td>";
        $body = $body . "<td>: Rp.$disetujui</td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        $body = $body . "<td>Tanggal Pengajuan</td>";
        $body = $body . "<td>: $tgl_aju</td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        $body = $body . "<td>Tanggal Pembayaran</td>";
        $body = $body . "<td>: $tgl_bayar</td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        $body = $body . "<td>Keterangan</td>";
        $body = $body . "<td>: $keterangan</td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        $body = $body . "<td>Catatan Asuransi</td>";
        $body = $body . "<td>: $cat_asuransi</td>";
        $body = $body . "</tr>";
        $body = $body . "<tr>";
        $body = $body . "<td>Status</td>";
        $body = $body . "<td>: $status</td>";
        $body = $body . "</tr>";
        $body = $body . "</table>";

//        print_r($body);die();

        $data = array($recipient1, $recipient2, "Claim $no_klaim", $body);
        $emaill = $this->mailer->kirimEmail($data);

//        die($email);
//        ini log sms
//        if($output[0]=="<"){
//            $isi = "Message successfully sent";
//        }else{
//            $isi = $output;
//        }
//        $this->db->query("insert into sms_report(no_peserta,no_hp,pesan) values('$nopes','$no','$isi')");
//        echo($output);
//        curl_close($ch);
//        die();
    }
}
