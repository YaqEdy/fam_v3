<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_itemcategory_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select IClassID from Mst_ItemClass";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $IClassID = "001";
            return $IClassID;
        } else {
            $sql = "select max(IClassID)+1 as IClassID from Mst_ItemClass";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $IClassID = $hasil[0]->IClassID;
            // $IClassID = sprintf('%06u', $IClassID + 1);
            return $IClassID;
        }
    }

  public function getzone(){
        $sql= "select Raw_ID from ams_zone";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if($jml == 0){
            $id_Raw = 1;
            return $id_Raw;
        }else{
            $sql= "select max((Raw_ID)) as id_Raw from ams_zone";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_Raw =  ($hasil[0]->id_Raw)+1;
            return $id_Raw;
            }
        }

          function getZoneID() {
        $sql = "SELECT * from ams_zone";
        $query = $this->db->query($sql);
        return $query->result();
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





    




 function selitem_type($reqtypeid){
        // $db2 = $this->load->database('ms', true);       
        $qdata = $this->db->query('SELECT ItemTypeID,ItemTypeName FROM Mst_ItemType where Is_trash=0 and IClassID='.$reqtypeid.'');
        if(count($qdata) > 0) {
            return $qdata->result();
        } 
        else {
            return false;
        }
        // $qdata->close();
    }


    //  function getUserKab($prop) {
    //     $sql = "select * from ams_itemcategory a left join item_type b on  a.IClassID = b.IClassID" where ='IClassID';
    //     $query = $this->db->query($sql);
    //     return $query->result();
    // }


    // public function getUserKab($prop) {
    //     $this->db->select('kab.*,p.IClassName');
    //     $this->db->from('item_type kab');
    //     $this->db->join('ams_itemcategory p', 'p.ItemTypeID=kab.ItemTypeID', 'inner');
    //     $this->db->where('p.ItemTypeID', $prop);

    //     $query = $this->db->get();
    //     // echo $this->db->last_query(); die();
    //     return $query->result();
    // }

     public function getUserKab($prop) {
        $sql = "select kab.ItemTypeName,kec.* from Mst_ItemClass kec
                         left join item_type kab on kab.IClassID = kec.IClassID
                         where kab.IClassID = '$prop'";


        $query = $this->db->query($sql);
        return $query->result();
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


       public function getUserInfo() {
        $this->db->select ( '*' );
                $this->db->from('Mst_ItemClass');
                $query = $this->db->get();
                return $query->result();
                
    }


    function updatedata($id){
        $type = $this->getTypeAsset($this->input->post('classid'));
        $data=array(
            'IClassID'  =>$this->input->post('classid'),
            'ItemTypeID'=>$this->input->post('item_typeid'),
            'ItemName'  =>$this->input->post('itemname'),
            'VendorID'  =>0,
            'Status'    =>0,
            'CreateDate'=>date('Y-m-d H:i:s'),
            'CreateBy'=>$this->session->userdata('user_id'),
            'Is_trash'  =>0,
            'AssetType' => $type,
            'Knd_NoSPK'=>$this->input->post('nospk'),
            'Knd_NoPSWADD'=>$this->input->post('nopswadd'),
            'Knd_NoPSW'=>$this->input->post('nopsw'),
            'Knd_TglPSW'=>$this->input->post('tglpsw'),
            'Knd_AkhrSewa'=>$this->input->post('akhirsewa'),
            'Knd_MasaSewa'=>$this->input->post('masasewa'),
            'Knd_AnSTNK'=>$this->input->post('namastnk'),
            'Knd_NoPolisi'=>$this->input->post('nopolisismntra'),
            'Knd_NoPolisiFix'=>$this->input->post('nopolisi'),
            'Knd_Merk'=>$this->input->post('merek'),
            'Knd_Type'=>$this->input->post('tipe'),
            'Knd_ThnPmbtn'=>$this->input->post('thnpmbt'),
            'Knd_NoStnk'=>$this->input->post('nostnk'),
            'Knd_NoRangka'=>$this->input->post('norangka'),
            'Knd_Mesin'=>$this->input->post('nomesin'),
            'Knd_NoBPKB'=>$this->input->post('nobpkb'),
            'Knd_PosisiBPKB'=>$this->input->post('posbpkb'),
            'Knd_PosisiKendaraan'=>$this->input->post('posknd'),
            'Tnh_Provinsi'=>$this->input->post('provinsiid'),
            'Tnh_Kabupaten'=>$this->input->post('kabupatenid'),
            'Tnh_Tujuan'=>$this->input->post('cabang'),
            'Id_Company'=>$this->input->post('perusahaanid')
        );
        $this->db2 = $this->load->database('ms', true);
        $this->db2->where('ItemID', $id);
        $this->db2->update('Mst_ItemListAP', $data);
        $this->db2->close();
    }




    

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */