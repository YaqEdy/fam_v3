<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class opex_inv_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select ID from TBL_M_BRANCH";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $ID = "001";
            return $ID;
        } else {
            $sql = "select max(ID)+1 as ID from TBL_M_BRANCH";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $ID = $hasil[0]->ID;
            // $ID = sprintf('%06u', $ID + 1);
            return $ID;
        }
    }

  public function getIdMax_typeid(){
        $sql = "select VendorTypeID from Mst_VendorType";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $VendorTypeID = "00000000";
            return $VendorTypeID;
        } else {
            $sql = "select right('00000000'+convert(varchar,convert(int,max(VendorTypeID))+1),8) as VendorTypeID from Mst_VendorType";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $VendorTypeID = $hasil[0]->VendorTypeID;
            return $VendorTypeID;
        }
    
        }

          function getZoneID() {
        $sql = "SELECT * from ams_zone";
        $query = $this->db->query($sql);
        return $query->result();
    }


       public function simpan($tabel, $data) {
        // die('fsdfd');
        $this->db->query("SET IDENTITY_INSERT [dbo].[$tabel] ON");
        $this->db->trans_begin();
        $this->db->insert($tabel, $data);
        $this->db->query("SET IDENTITY_INSERT [dbo].[$tabel] OFF");
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    
    function ubah($tabel, $data, $id_kolom, $id_data) {
        $this->db->trans_begin();
         $this->db->query("SET IDENTITY_INSERT [dbo].[$tabel] ON");
        $query1 = $this->db->where($id_kolom, $id_data);
        $query2 = $this->db->update($tabel, $data);
        $this->db->query("SET IDENTITY_INSERT [dbo].[$tabel] OFF");

        // echo $this->db->last_query(); die('');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


        public function getUserzone($ZoneID) {
        $this->db->select('kab.*,p.ZoneID');
        $this->db->from('ams_zone kab');
        $this->db->join('ams_cabang p', 'p.BranchID=kab.BranchID', 'inner');
        $this->db->where('p.BranchID', $ZoneID);

        $query = $this->db->get();
        // echo $this->db->last_query(); die();
        return $query->result();
    }



    public function get_level_user() {
        $rows = array(); //will hold all results
        $sql = "select * from sec_level order by level_id asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

   function deleteUser($userId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('userid', $userId);
        $query2 = $this->db->delete('sec_passwd');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
            
        }
    }



    //   public function getUserInfo() {
    //     $sql = "SELECT ven.*, type.VendorTypeName FROM 
    //                                         VendorType ven
    //                                         INNER JOIN VendorType type ON ven.VendorTypeID = type.VendorTypeID
    //                                         where ven.Is_trash=0 
    //                                         ORDER BY ven.Raw_ID ";
    //     $query = $this->db->query($sql);
    //     return $query->result(); // returning rows, not row
    // }


       public function getUserInfo() {
        $this->db->select ( '*' );
                $this->db->from('Mst_VendorType');
                $query = $this->db->get();
                return $query->result();
                
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */