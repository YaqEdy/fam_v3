<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_m extends CI_Model {

    function __construct() {
        parent::__construct();
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
        $this->load->database();
    }

    public function insert_ias_orc($ID_PO, $ID_IAS) {
//        $this->load->database();
//Link Api
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
        $result = $query->result()[0];
//header insert orc
        $query2 = $this->db->query("SELECT * FROM VW_IAS_TO_ORC_HEADER WHERE ID_PO=" . $ID_PO);
        $dataH = $query2->result();
//Parent dari Branch/Division
        $query3 = $this->db->query("SELECT *,LEFT(BRANCH_DESC,3) AS PARENT FROM TBL_M_DIVISION AS A INNER JOIN TBL_M_BRANCH AS B ON A.PARENT_FLEX = B.FLEX_VALUE WHERE A.FLEX_VALUE='" . $this->session->userdata('DivisionID') . "'"); //
        $result3 = $query3->result()[0];
//AMOUNT
        $query4 = $this->db->query("SELECT PPN,NILAI_DIBAYARKAN FROM  TBL_T_IAS WHERE ID_IAS=" . $ID_IAS);
        $result4 = $query4->result()[0];
//Faktur pajak
        $query5 = $this->db->query("SELECT NO_DOC FROM TBL_T_IAS_DOC WHERE NAMA_DOC=3 AND ID_IAS=" . $ID_IAS);
        $result5 = $query5->result()[0];
//        die();
        $arrData = [];
        foreach ($dataH as $hdr) {
//detail data insert to orc
//            $query3 = $this->db->query("SELECT * FROM VW_IAS_TO_ORC_DETAIL WHERE ID_PO_=" . $ID_PO . " AND VENDOR_ID=" . $hdr->VendorID);
            $query3 = $this->db->query("SELECT A.ID AS FAM_ASSET_ID,B.*
                                        FROM TBL_T_TB_DETAIL as A LEFT JOIN VW_IAS_TO_ORC_DETAIL AS B ON A.ID_PO=B.ID_PO_ AND A.ID_TB=B.ID
                                        WHERE B.ID_PO_=" . $ID_PO . " AND VENDOR_ID=" . $hdr->VendorID . " order by A.ID"); //
            $dtl = $query3->result();
            $PPN = $result4->PPN;
            $i = 0;
            $arrDataPPH[] = array(
                'OPERATING_UNIT' => $result3->BRANCH_DESC,
                'INVOICE_NUM' => $hdr->ID_PO,
                'INVOICE_TYPE' => 'STANDARD B',
                'VENDOR_NAME' => $hdr->VendorName,
                'VENDOR_SITE_CODE' => $hdr->City,
                'INVOICE_DATE' => date('Y-m-d h:i:s'),
                'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                'INVOICE_AMOUNT' => $result4->NILAI_DIBAYARKAN,
                'TERMS_NAME' => 'Immediate',
                'LIABILITY_ACCOUNT' => $dtl[$i]->AccountLiability, //VENDOR 
                'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                'FAKTUR_PAJAK' => $result5->NO_DOC, //
                'NOMORPO' => 'PO/' . $hdr->ID_PO,
                'LINE_NUMBER' => COUNT($dtl) + 1,
                'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
                'AMOUNT' => $PPN, //$dtl->HARGA, //TAMBAH 1 ROW PPN
                'AKUN_DISTRIBUSI' => $hdr->COA, //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                'LINE_DESCRIPTION' => 'PPN', //NAMA ITEM PPN
                'ITEM_DESCRIPTION' => '',
                'ASSET_BOOK_NAME' => 'PNM COMMERCIAL BOOK', //$result3->PARENT . ' COM BOOK', //PAREN COM BOOK
                'ASSET_CATEGORY' => $dtl[$i]->ClassCode, //ITEM CATEGORY ->ID
                'JENIS_BARANG' => $dtl[$i]->ItemTypeID, //ITEM TYPE ->ID
                'UMUR_FISKAL' => $dtl[$i]->umurfiskal, //ITEM CATEGORY 
                'AMORTIZATION' => '',
                'FAM_ASSET_ID' => '', // SN
                'DEFERRED_ACCTG_FLAG' => '',
                'DEF_ACCTG_START_DATE' => '',
                'DEF_ACCTG_END_DATE' => '',
                'SOURCE' => 'INTEGRATION', //DEFAULT
                'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                'FAM_INVOICE_ID' => '',
                'TGL_PENGAKUAN_BRG' => '',
                'STATUS' => '',
                'ERROR_CODE' => '',
                'ERROR_MESSAGE' => '',
                'PROCESS_ID' => ''
            );
//            print_r($iCountDtl);die();
            for ($i = 0; $i < COUNT($dtl); $i++) {
//                
                $iLine = $i + 1;
                $arrData[] = array(
                    'OPERATING_UNIT' => $result3->BRANCH_DESC,
                    'INVOICE_NUM' => $hdr->ID_PO,
                    'INVOICE_TYPE' => 'STANDARD B',
                    'VENDOR_NAME' => $hdr->VendorName,
                    'VENDOR_SITE_CODE' => $hdr->City,
                    'INVOICE_DATE' => date('Y-m-d h:i:s'),
                    'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                    'INVOICE_AMOUNT' => $result4->NILAI_DIBAYARKAN,
                    'TERMS_NAME' => 'Immediate',
                    'LIABILITY_ACCOUNT' => $dtl[$i]->AccountLiability, //VENDOR 
                    'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                    'FAKTUR_PAJAK' => $result5->NO_DOC, //
                    'NOMORPO' => 'PO/' . $hdr->ID_PO,
                    'LINE_NUMBER' => $iLine,
                    'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
                    'AMOUNT' => $dtl[$i]->HARGA, //$dtl->HARGA, //TAMBAH 1 ROW PPN
                    'AKUN_DISTRIBUSI' => $hdr->COA, //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                    'LINE_DESCRIPTION' => $dtl[$i]->NAMA_BARANG, //NAMA ITEM
                    'ITEM_DESCRIPTION' => '',
                    'ASSET_BOOK_NAME' => 'PNM COMMERCIAL BOOK', //$result3->PARENT . ' COM BOOK', //PAREN COM BOOK
                    'ASSET_CATEGORY' => $dtl[$i]->ClassCode, //ITEM CATEGORY ->ID
                    'JENIS_BARANG' => $dtl[$i]->ItemTypeID, //ITEM TYPE ->ID
                    'UMUR_FISKAL' => $dtl[$i]->umurfiskal, //ITEM CATEGORY 
                    'AMORTIZATION' => '',
                    'FAM_ASSET_ID' => $dtl[$i]->FAM_ASSET_ID, // SN
                    'DEFERRED_ACCTG_FLAG' => '',
                    'DEF_ACCTG_START_DATE' => '',
                    'DEF_ACCTG_END_DATE' => '',
                    'SOURCE' => 'INTEGRATION', //DEFAULT
                    'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                    'FAM_INVOICE_ID' => '',
                    'TGL_PENGAKUAN_BRG' => '',
                    'STATUS' => '',
                    'ERROR_CODE' => '',
                    'ERROR_MESSAGE' => '',
                    'PROCESS_ID' => ''
                );
            }
        }
        array_push($arrData, $arrDataPPH[0]);
//        print_r($arrData);
//        die();

        $data['data'] = $arrData;
        $curlurl = $result->LINK . "/insert_invoice";

        $ch = curl_init($curlurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $responsejson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responsejson, true);
//        print_r($response);
        return $response;
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */