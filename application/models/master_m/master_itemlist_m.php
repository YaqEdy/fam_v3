<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_itemlist_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select ItemID from Mst_ItemList";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $ItemID = "001";
            return $ItemID;
        } else {
            $sql = "select max(ItemID) as ItemID from Mst_ItemList";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $ItemID = $hasil[0]->ItemID;
            $ItemID = sprintf('%06u', $ItemID + 1);
            return $ItemID;
        }
    }

          function getItemList() {
        $sql = "SELECT a.IClassID,a.ItemTypeID,a.ItemID,a.ItemName,a.VendorID,a.Image,
                                                  b.IClassName,c.ItemTypeName, a.Is_trash 
                                           FROM Mst_ItemList a
                                           INNER JOIN ams_itemcategory b ON a.IClassID=b.IClassID 
                                           INNER JOIN item_type c ON a.ItemTypeID=c.ItemTypeID                                         
                                           WHERE a.Is_trash=0 ORDER BY a.ItemID";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getuserInfo(){

        $sql = "Select * from Mst_ItemList";
            $query = $this->db->query($sql);
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


       public function simpan_no_iden($tabel, $data) {
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

    function ubah_no_iden($tabel, $data, $id_kolom, $id_data) {
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



      public function tampil_zone() {
        $sql = "select * from Mst_ItemClass ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function tampil_item() {
        $sql = "select * from Mst_ItemClass a left join item_type b on  a.IClassID = b.IClassID ";
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

        public function tampil_category_item() {
        $sql = "select * from Mst_ItemClass ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }







    public function getItemType($id) {
        $sql = "select b.ItemTypeID,b.itemTypeName,* from 
                Mst_ItemClass a left join Mst_ItemType b on  a.IClassID = b.IClassID
                Where a.IClassID=$id ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $options = "";
            foreach ($result as $v) {
                $options .= "<option value='" . $v['ItemTypeID'] . "'>   " . $v['itemTypeName']."</option>";
                //return $options;
            };

        return $options;
    }
     

    //    public function getUserInfo() {
    //     $this->db->select ( '*' );
    //             $this->db->from('Mst_ItemList');
    //             $query = $this->db->get();
    //             return $query->result();
                
    // }



    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */