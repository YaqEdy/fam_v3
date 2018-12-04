<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_vendorlist_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select VendorID from Mst_Vendor";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $VendorID = "001";
            return $VendorID;
        } else {
            $sql = "select max(VendorID)+1 as VendorID from Mst_Vendor";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $VendorID = $hasil[0]->VendorID;
            // $Raw_ID = sprintf('%06u', $Raw_ID + 1);
            return $VendorID;
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




       function selitem_typekab($idprov) {
        // $db2 = $this->load->database('ms', true);
        $query = 'SELECT * FROM Mst_Kabupaten where IdKabupaten like ' . $idprov . '%';
        // print_r($query);die();
        $qdata = $this->db->query("SELECT * FROM Mst_Kabupaten where IdKabupaten like '" . $idprov . "%'");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        // $qdata->close();
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



       public function tampil_zone() {
        $sql = "select * from ams_itemcategory ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function tampil_item() {
        $sql = "select * from ams_itemcategory a left join item_type b on  a.IClassID = b.IClassID ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

        public function tampil_zone1() {
            $sql = "select * from Mst_Zonasi";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }
        

        public function tampil_division() {
            $sql = "select * from Mst_Branch";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }

        public function tampilitemcategory() {
            $sql = "select * from Mst_RequestType ";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }

        public function tampil_vendor() {

            $sql = "select * from VendorType";
            $query = $this->db->query($sql);
            $result = $query->result();

            return$result;
        }


         public function tampil_provinsi() {
        $sql = "select * from Mst_Provinsi";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

        public function tampil_country() {
        $sql = "select * from TBL_CountryNew";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

         public function tampil_branch() {
        $sql = "select * from TBL_M_BRANCH";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
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
                $this->db->from('select a.Raw_ID, a.VendorName, a.VendorTypeID, a.NPWP, c.NamaProvinsi, d.NamaKabupaten, a.Terms, a.Currency, a.NoRekening, a.NamaBank, a.Image, a.Performance, a.VendorAlias, a.AlamatNPWP, a.AlamatSupplier,a.VendorAddress,a.MasaBerlakuTDP, e.CountryName, b.BRANCH_DESC, a.Status, a.AccountLiability, a.AccountPrepayment  
            from Mst_Vendor a 
            left join TBL_M_BRANCH b on a.VendorID = b.ID  
            left join Mst_Provinsi c on a.VendorID = c.IdProvinsi
            left join Mst_Kabupaten d on a.VendorID = d.IdKabupaten
            left join TBL_CountryNew e on a.VendorID = e.ID_Country');
                $query = $this->db->get();
                return $query->result();
                
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */