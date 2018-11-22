<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_m extends CI_Model {

    public function get_cm($tgl_trans) {
        $sql = "select count(id_master_cm) as jml_cm from master_cm where tgl_trans = '$tgl_trans' and status_ambil = 0";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->jml_cm;
    }
    public function get_ca($tgl_trans) {
        $sql = "select count(id_master_cm) as jml_cm from master_cm where tgl_ambil = '$tgl_trans' and status_ambil = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->jml_cm;
    }
    public function get_cs($tgl_trans) {
        $sql = "select count(id_master_cm) as jml_cm from master_cm where tgl_selesai = '$tgl_trans'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->jml_cm;
    }
    public function get_chs($tgl_trans) {
        $sql = "select count(id_master_cm) as jml_cm from master_cm where e_tgl_selesai = '$tgl_trans'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->jml_cm;
    }
    public function get_um($tgl_trans) {
        $sql = "select coalesce(sum(jml_bayar),0) as jml_cm from master_cm where tgl_ambil = '$tgl_trans' or tgl_trans = '$tgl_trans'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->jml_cm;
    }




public function getCdisplay() {
        $sql = "select ket,nilai from(
        SELECT 'id_request' as ket, Count(*) as nilai        
        FROM TBL_REQUEST WHERE status='2-1' AND Is_trash =0        
 union ALL
        SELECT 'id_proses' as ket,Count(*) as nilai
        FROM TBL_REQUEST WHERE status > '2' AND Is_trash =0 
        AND RequestID not in (select  c.ID_PR from TBL_T_IAS a
		INNER JOIN TBL_T_PO_DETAIL as b on a.ID_PO_DETAIL = b.ID_PO_DETAIL
        INNER JOIN TBL_T_PO as c on b.ID_PO = c.ID_PO)
 union ALL
		SELECT 'id_close' as ket,ISNULL(COUNT(*),0) as nilai
		FROM(
		select B.ID_PO
		from TBL_T_IAS AS A INNER JOIN
		TBL_T_PO_DETAIL as B on A.ID_PO_DETAIL = B.ID_PO_DETAIL
		where A.IS_TRASH=0 
		group by B.ID_PO
		having SUM(A.NILAI_DIBAYARKAN) >= SUM(B.TTL_HARGA)) AS ZZ 
 union ALL
        select 'id_reject' as ket, count(*) as nilai 
        from TBL_REQUEST AS A left JOIN
        TBL_REQUEST_LOG AS B ON A.RequestID=B.RequestID and A.status=B.status_dari
        where b.action='Reject'
    )x";
        // print_r($sql);die();
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    

    public function getdisplay() {
         $sql = "SELECT 'id_request' as ket, Count(*) as nilai
         FROM TBL_REQUEST WHERE status='2-1' AND Is_trash =0
    union
        SELECT 'id_proses' as ket,Count(*) as nilai
        FROM TBL_REQUEST WHERE status > '2' AND Is_trash =0 
        AND RequestID not in (select  b.ID_PR from TBL_T_IAS a
        INNER JOIN TBL_T_PO b on a.NO_PO = b.ID_PO)
    union
        select 'id_close' as ket,ISNULL((
        select A.NO_PO
        from TBL_T_IAS AS A INNER JOIN
        TBL_T_PO_DETAIL AS B ON A.NO_PO=B.ID_PO
        where A.IS_TRASH=0 
        group by A.NO_PO
        having SUM(A.NILAI_DIBAYARKAN) >= SUM(B.TTL_HARGA)),0) as nilai
    union
        select 'id_reject' as ket, count(*) as nilai 
        from TBL_REQUEST AS A left JOIN
        TBL_REQUEST_LOG AS B ON A.RequestID=B.RequestID and A.status=B.status_dari
        where b.action='Reject'";

        $query = $this->db->query($sql);
        $rows['data_file'] = $query->result();
        return $rows;
    }





}
