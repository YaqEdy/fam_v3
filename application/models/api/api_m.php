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

    function get_data_orc($JsonArr = array()) {
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
        $result = $query->result()[0];

//        $jsonarr = [
//            'table' => 'PNM_FAM_FA_WORKBENCH_V',
//            'filter_where_in' => ["ASSET_NUMBER" => $ID_ASSETS]
//        ];

        $curlurl = $result->LINK . "/get_all";

        $ch = curl_init($curlurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($JsonArr));
        $responsejson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responsejson, true);

        return $response['data'];
    }

    function insert_to_orc($JsonArr = array()) {
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
        $result = $query->result()[0];

//        $jsonarr = [
//            'to_table' => 'TBL_ANGGOTA',
//            'nik' => '1234',
//            'nama' => 'afrizal'
//        ];

        $curlurl = $result->LINK . "/insert_to_table";

        $ch = curl_init($curlurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($JsonArr));
        $responsejson = curl_exec($ch);
//        print_r($responsejson);die();
        curl_close($ch);

        $response = json_decode($responsejson, true);

        return $response;
    }

    public function insert_ias_orc($ID_PO, $ID_IAS, $ID_PO_DETAIL) {
//        $this->load->database();
//Link Api
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
        $result = $query->row();
//header insert orc
        $query2 = $this->db->query("SELECT * FROM VW_IAS_TO_ORC_HEADER WHERE ID_PO_DETAIL=" . $ID_PO_DETAIL);
        $dataH = $query2->result();
        // var_dump($dataH);exit();
//Parent dari Branch/Division
        $query3 = $this->db->query("SELECT *,B.FLEX_VALUE AS FLEX_VALUE_,LEFT(BRANCH_DESC,3) AS PARENT FROM TBL_M_DIVISION AS A INNER JOIN TBL_M_BRANCH AS B ON A.PARENT_FLEX = B.FLEX_VALUE WHERE A.FLEX_VALUE='" . $this->session->userdata('DivisionID') . "'"); //
        $result3 = $query3->row();
//AMOUNT cek TBL_T_PO_DTL_TOTAL, TBL_T_IAS
        $query4 = $this->db->query("SELECT DPP,PPN,PERSEN_PPN,PPH,DENDA,NILAI_DIBAYARKAN,DPP+PPN-DENDA AS TTL_BYR FROM  TBL_T_IAS WHERE ID_IAS=" . $ID_IAS);
//        $query4 = $this->db->query("SELECT PPN,PPH,DENDA,TOTAL AS NILAI_DIBAYARKAN FROM  TBL_T_PO_DTL_TOTAL WHERE ID_PO_DETAIL=" . $ID_PO_DETAIL);
        $result4 = $query4->row();
//Faktur pajak
        $query5 = $this->db->query("SELECT NO_DOC FROM TBL_T_IAS_DOC WHERE NAMA_DOC=3 AND ID_IAS=" . $ID_IAS);
        $result5 = $query5->row();
        if (sizeof($result5) != 0) {
            $faktur = $result5->NO_DOC;
        } else {
            $faktur = 0;
        }
//Infoice
        $query6 = $this->db->query("SELECT NO_DOC FROM TBL_T_IAS_DOC WHERE NAMA_DOC=2 AND ID_IAS=" . $ID_IAS);
        $result6 = $query6->row();
        if (sizeof($result6) != 0) {
            $invoice = $result6->NO_DOC;
        } else {
            $invoice = 0;
        }

        $arrData = [];
        foreach ($dataH as $hdr) {
//detail data insert to orc
//            $query3 = $this->db->query("SELECT * FROM VW_IAS_TO_ORC_DETAIL WHERE ID_PO_=" . $ID_PO . " AND VENDOR_ID=" . $hdr->VendorID);
            $query7 = $this->db->query("SELECT DISTINCT CONVERT(VARCHAR(50),B.TypeCode) AS TypeCode,A.ID AS FAM_ASSET_ID,C.Coa,B.*,dbo.xfn_po_disc(B.ID_PO_DETAIL,B.HARGA) as HARGA_DISC
                                        FROM TBL_T_TB_DETAIL as A LEFT JOIN VW_IAS_TO_ORC_DETAIL AS B ON A.ID_PO_DETAIL=B.ID_PO_DETAIL AND A.ID_TB=B.ID
                                        LEFT JOIN  TBL_REQUEST_ITEMLIST AS C ON B.ID_PR=C.RequestID
                                        WHERE B.ID_PO_=" . $ID_PO . " AND VENDOR_ID=" . $hdr->VendorID . " AND A.STATUS = 0 order by A.ID"); //
            $dtl = $query7->result();
            $i = 0;
            //Nilai
//            $NilaiTotal = $this->db->query("SELECT SUM(TOTAL) AS NILAI FROM TBL_T_PO_DTL_TOTAL WHERE ID_PO_DETAIL=" . $ID_PO_DETAIL)->row()->NILAI;
//            $NilaiIas = $this->db->query("SELECT SUM(NILAI_DIBAYARKAN) AS NILAI FROM TBL_T_IAS WHERE ID_PO_DETAIL=" . $ID_PO_DETAIL)->row()->NILAI;

            $NilaiTermin = $this->db->query("SELECT Top 1 TERMIN AS NILAI FROM TBL_T_TERMIN WHERE ID_PO_DETAIL=" . $ID_PO_DETAIL . " order by TERMIN desc")->row()->NILAI;
            $NilaiIas = $this->db->query("SELECT COUNT(*) AS NILAI FROM TBL_T_IAS WHERE ID_PO_DETAIL=" . $ID_PO_DETAIL)->row()->NILAI;
            $iiLine = 0;
//            print_r($NilaiTermin);
//            print_r($NilaiIas);

            if ($NilaiTermin == $NilaiIas) { 
                $iTop = $NilaiIas - 1;
                $Ias_old = $this->db->query("SELECT TOP " . $iTop . " DPP FROM TBL_T_IAS WHERE ID_PO_DETAIL=" . $ID_PO_DETAIL . " order by CREATE_DATE asc")->result();
                $iDPP=0;
                for ($d = 0; $d < count($Ias_old); $d++) {
                    $iDPP=$iDPP+$Ias_old[$d]->DPP;
                    //DPP
                    $iiLine = $iiLine + 1;
                    $arrdt[] = array(
                        'OPERATING_UNIT' => $result3->BRANCH_DESC,
                        'INVOICE_NUM' => $invoice, //TBL_T_IAS_DOC=>NAMA_DOC=2(INVOICE)
                        'INVOICE_TYPE' => 'STANDARD',
                        'VENDOR_NAME' => $hdr->VendorName,
                        'VENDOR_SITE_CODE' => $hdr->City, //kapital ?
                        'INVOICE_DATE' => date('Y-m-d h:i:s'),
                        'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                        'INVOICE_AMOUNT' => $result4->TTL_BYR,
                        'TERMS_NAME' => 'Immediate',
                        'LIABILITY_ACCOUNT' => $result3->FLEX_VALUE_ . '-' . $dtl[$i]->AccountLiability . '-000000-00-0000-00-0000-0000-0000', //VENDOR paren-liability-9segmen ?
                        'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                        'FAKTUR_PAJAK' => $faktur, //TBL_T_IAS_DOC=>NAMA_DOC=2(FAKTUR PAJAK)
                        'NOMORPO' => $ID_PO_DETAIL,
                        'LINE_NUMBER' => $iiLine,
                        'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
                        'AMOUNT' => -$Ias_old[$d]->DPP, //$dtl->HARGA, //TAMBAH 1 ROW PPN 1182001
                        'AKUN_DISTRIBUSI' => $result3->FLEX_VALUE_ . '-1190000-000000-00-0000-00-0000-0000-0000', //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                        'LINE_DESCRIPTION' => 'DPP', //NAMA ITEM PPN
                        'SOURCE' => 'INTEGRATION', //DEFAULT
                        'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                        'FAM_INVOICE_ID' => $ID_IAS //NO IAS -> UNTUK ASSET
                    );
                }

                //PPH
                if ($result4->PPH > 0) {
                    $iiLine = $iiLine + 1;
                    $arrdt[] = array(
                        'OPERATING_UNIT' => $result3->BRANCH_DESC,
                        'INVOICE_NUM' => $invoice, //TBL_T_IAS_DOC=>NAMA_DOC=2(INVOICE)
                        'INVOICE_TYPE' => 'STANDARD',
                        'VENDOR_NAME' => $hdr->VendorName,
                        'VENDOR_SITE_CODE' => $hdr->City, //kapital ?
                        'INVOICE_DATE' => date('Y-m-d h:i:s'),
                        'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                        'INVOICE_AMOUNT' => $result4->TTL_BYR,
                        'TERMS_NAME' => 'Immediate',
                        'LIABILITY_ACCOUNT' => $result3->FLEX_VALUE_ . '-' . $dtl[$i]->AccountLiability . '-000000-00-0000-00-0000-0000-0000', //VENDOR paren-liability-9segmen ?
                        'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                        'FAKTUR_PAJAK' => $faktur, //TBL_T_IAS_DOC=>NAMA_DOC=2(FAKTUR PAJAK)
                        'NOMORPO' => $ID_PO_DETAIL,
                        'LINE_NUMBER' => $iiLine,
                        'LINE_TYPE_LOOKUP_CODE' => 'AWT ', //ASER 'AWT' BARANG 'ITEM'
                        'AMOUNT' => $result4->PPH, //$dtl->HARGA, //TAMBAH 1 ROW PPN
                        'AKUN_DISTRIBUSI' => $result3->FLEX_VALUE_ . '-1181004-000000-00-0000-00-0000-0000-0000', //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                        'LINE_DESCRIPTION' => 'PPH', //NAMA ITEM PPH
                        'SOURCE' => 'INTEGRATION', //DEFAULT
                        'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                        'FAM_INVOICE_ID' => $ID_IAS //NO IAS -> UNTUK ASSET
                    );
                }
                //DENDA
                if ($result4->DENDA > 0) {
                    $iiLine = $iiLine + 1;
                    $arrdt[] = array(
                        'OPERATING_UNIT' => $result3->BRANCH_DESC,
                        'INVOICE_NUM' => $invoice, //TBL_T_IAS_DOC=>NAMA_DOC=2(INVOICE)
                        'INVOICE_TYPE' => 'STANDARD',
                        'VENDOR_NAME' => $hdr->VendorName,
                        'VENDOR_SITE_CODE' => $hdr->City, //kapital ?
                        'INVOICE_DATE' => date('Y-m-d h:i:s'),
                        'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                        'INVOICE_AMOUNT' => $result4->TTL_BYR,
                        'TERMS_NAME' => 'Immediate',
                        'LIABILITY_ACCOUNT' => $result3->FLEX_VALUE_ . '-' . $dtl[$i]->AccountLiability . '-000000-00-0000-00-0000-0000-0000', //VENDOR paren-liability-9segmen ?
                        'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                        'FAKTUR_PAJAK' => $faktur, //TBL_T_IAS_DOC=>NAMA_DOC=2(FAKTUR PAJAK)
                        'NOMORPO' => $ID_PO_DETAIL,
                        'LINE_NUMBER' => $iiLine,
                        'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
                        'AMOUNT' => $result4->DENDA, //$dtl->HARGA, //TAMBAH 1 ROW PPN
                        'AKUN_DISTRIBUSI' => $result3->FLEX_VALUE_ . '-2020300-000000-00-0000-00-0000-0000-0000', //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                        'LINE_DESCRIPTION' => 'DENDA', //NAMA ITEM PPH
                        'SOURCE' => 'INTEGRATION', //DEFAULT
                        'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                        'FAM_INVOICE_ID' => $ID_IAS //NO IAS -> UNTUK ASSET
                    );
                }
//                ITEM & ASSET_ID
                $N_Termin = $this->db->query("SELECT Top 1 PERSENTASE FROM TBL_T_TERMIN WHERE ID_PO_DETAIL=" . $ID_PO_DETAIL . " order by TERMIN desc")->row()->PERSENTASE;
                $iPPN=$dtl[0]->HARGA_DISC*$dtl[0]->QTY * $N_Termin / 100 * $result4->PERSEN_PPN / 100;
                $INV_AMOUNT=($dtl[0]->HARGA_DISC*$dtl[0]->QTY)+$iPPN-$iDPP;
                for ($i = 0; $i < COUNT($dtl); $i++) {
                    $update = array('STATUS' => 1);
                    $this->db->where('ID', $dtl[$i]->FAM_ASSET_ID);
                    $this->db->update('TBL_T_TB_DETAIL', $update);
//                    $iAMOUNT = $iAMOUNT + $dtl[$i]->HARGA_DISC;

                    $iiLine = $iiLine + 1;
                    $arrData[] = array(
                        'OPERATING_UNIT' => $result3->BRANCH_DESC,
                        'INVOICE_NUM' => $invoice, //TBL_T_IAS_DOC=>NAMA_DOC=2(INVOICE)
                        'INVOICE_TYPE' => 'STANDARD',
                        'VENDOR_NAME' => $hdr->VendorName,
                        'VENDOR_SITE_CODE' => $hdr->City, //huruf besar
                        'INVOICE_DATE' => date('Y-m-d h:i:s'),
                        'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                        'INVOICE_AMOUNT' => $INV_AMOUNT,
                        'TERMS_NAME' => 'Immediate',
                        'LIABILITY_ACCOUNT' => $result3->FLEX_VALUE_ . '-' . $dtl[$i]->AccountLiability . '-000000-00-0000-00-0000-0000-0000', //VENDOR 
                        'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                        'FAKTUR_PAJAK' => $faktur, //
//                        'NOMORPO' => 'PO/' . $hdr->ID_PO,
                        'NOMORPO' => $ID_PO_DETAIL,
                        'LINE_NUMBER' => $iiLine,
                        'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
                        'AMOUNT' => $dtl[$i]->HARGA_DISC, //$dtl->HARGA, //TAMBAH 1 ROW PPN
                        'AKUN_DISTRIBUSI' => str_replace(" ", "", $dtl[$i]->Coa), //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                        'LINE_DESCRIPTION' => $dtl[$i]->NAMA_BARANG, //NAMA ITEM
//                    'ITEM_DESCRIPTION' => '',
                        'ASSET_BOOK_NAME' => 'PNM COMMERCIAL BOOK', //$result3->PARENT . ' COM BOOK', //PAREN COM BOOK
//                        'ASSET_CATEGORY' => '106', //ITEM CATEGORY ->ID
//                        'JENIS_BARANG' => '01', //ITEM TYPE ->ID
//                        'UMUR_FISKAL' => 'A1', //ITEM CATEGORY //masih kosong
                        'ASSET_CATEGORY' => $dtl[$i]->ClassCode, //ITEM CATEGORY ->ID
                        'JENIS_BARANG' => $dtl[$i]->TypeCode, //ITEM TYPE ->ID
                        'UMUR_FISKAL' => $dtl[$i]->umurfiskal, //ITEM CATEGORY 
////                    'AMORTIZATION' => '',
                        'FAM_ASSET_ID' => $dtl[$i]->FAM_ASSET_ID, // SN
//                    'DEFERRED_ACCTG_FLAG' => '',
//                    'DEF_ACCTG_START_DATE' => '',
//                    'DEF_ACCTG_END_DATE' => '',
                        'SOURCE' => 'INTEGRATION', //DEFAULT
                        'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                        'FAM_INVOICE_ID' => $ID_IAS //NO IAS
//                    'TGL_PENGAKUAN_BRG' => '',
//                    'STATUS' => '',
//                    'ERROR_CODE' => '',
//                    'ERROR_MESSAGE' => '',
//                    'PROCESS_ID' => ''
                    );
                }
                //PPN
                if ($result4->PPN > 0) {
                    $iiLine = $iiLine + 1;
                    $arrdt[] = array(
                        'OPERATING_UNIT' => $result3->BRANCH_DESC,
                        'INVOICE_NUM' => $invoice, //TBL_T_IAS_DOC=>NAMA_DOC=2(INVOICE)
                        'INVOICE_TYPE' => 'STANDARD',
                        'VENDOR_NAME' => $hdr->VendorName,
                        'VENDOR_SITE_CODE' => $hdr->City, //kapital ?
                        'INVOICE_DATE' => date('Y-m-d h:i:s'),
                        'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                        'INVOICE_AMOUNT' => $INV_AMOUNT, //$result4->NILAI_DIBAYARKAN
                        'TERMS_NAME' => 'Immediate',
                        'LIABILITY_ACCOUNT' => $result3->FLEX_VALUE_ . '-' . $dtl[0]->AccountLiability . '-000000-00-0000-00-0000-0000-0000', //VENDOR paren-liability-9segmen ?
                        'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                        'FAKTUR_PAJAK' => $faktur, //TBL_T_IAS_DOC=>NAMA_DOC=2(FAKTUR PAJAK)
                        'NOMORPO' => $ID_PO_DETAIL,
                        'LINE_NUMBER' => $iiLine,
                        'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
                        'AMOUNT' => $iPPN, //$result4->PPN
                        'AKUN_DISTRIBUSI' => $result3->FLEX_VALUE_ . '-1182000-000000-00-0000-00-0000-0000-0000', //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                        'LINE_DESCRIPTION' => 'PPN', //NAMA ITEM PPN
                        'SOURCE' => 'INTEGRATION', //DEFAULT
                        'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                        'FAM_INVOICE_ID' => $ID_IAS //NO IAS -> UNTUK ASSET
                    );
                }
            } else {
                //PPN
                if ($result4->PPN > 0) {
                    $iiLine = $iiLine + 1;
                    $arrdt[] = array(
                        'OPERATING_UNIT' => $result3->BRANCH_DESC,
                        'INVOICE_NUM' => $invoice, //TBL_T_IAS_DOC=>NAMA_DOC=2(INVOICE)
                        'INVOICE_TYPE' => 'STANDARD',
                        'VENDOR_NAME' => $hdr->VendorName,
                        'VENDOR_SITE_CODE' => $hdr->City, //kapital ?
                        'INVOICE_DATE' => date('Y-m-d h:i:s'),
                        'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                        'INVOICE_AMOUNT' => $result4->TTL_BYR, //$result4->NILAI_DIBAYARKAN,
                        'TERMS_NAME' => 'Immediate',
                        'LIABILITY_ACCOUNT' => $result3->FLEX_VALUE_ . '-' . $dtl[$i]->AccountLiability . '-000000-00-0000-00-0000-0000-0000', //VENDOR paren-liability-9segmen ?
                        'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                        'FAKTUR_PAJAK' => $faktur, //TBL_T_IAS_DOC=>NAMA_DOC=2(FAKTUR PAJAK)
                        'NOMORPO' => $ID_PO_DETAIL,
                        'LINE_NUMBER' => $iiLine,
                        'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
                        'AMOUNT' => $result4->PPN, //$dtl->HARGA, //TAMBAH 1 ROW PPN 1182001
                        'AKUN_DISTRIBUSI' => $result3->FLEX_VALUE_ . '-1182001-000000-00-0000-00-0000-0000-0000', //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                        'LINE_DESCRIPTION' => 'PPN', //NAMA ITEM PPN
                        'SOURCE' => 'INTEGRATION', //DEFAULT
                        'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                        'FAM_INVOICE_ID' => $ID_IAS //NO IAS -> UNTUK ASSET
                    );
                }
                //PPH
                if ($result4->PPH > 0) {
                    $iiLine = $iiLine + 1;
                    $arrdt[] = array(
                        'OPERATING_UNIT' => $result3->BRANCH_DESC,
                        'INVOICE_NUM' => $invoice, //TBL_T_IAS_DOC=>NAMA_DOC=2(INVOICE)
                        'INVOICE_TYPE' => 'STANDARD',
                        'VENDOR_NAME' => $hdr->VendorName,
                        'VENDOR_SITE_CODE' => $hdr->City, //kapital ?
                        'INVOICE_DATE' => date('Y-m-d h:i:s'),
                        'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                        'INVOICE_AMOUNT' => $result4->TTL_BYR,
                        'TERMS_NAME' => 'Immediate',
                        'LIABILITY_ACCOUNT' => $result3->FLEX_VALUE_ . '-' . $dtl[$i]->AccountLiability . '-000000-00-0000-00-0000-0000-0000', //VENDOR paren-liability-9segmen ?
                        'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                        'FAKTUR_PAJAK' => $faktur, //TBL_T_IAS_DOC=>NAMA_DOC=2(FAKTUR PAJAK)
                        'NOMORPO' => $ID_PO_DETAIL,
                        'LINE_NUMBER' => $iiLine,
                        'LINE_TYPE_LOOKUP_CODE' => 'AWT ', //ASER 'AWT' BARANG 'ITEM'
                        'AMOUNT' => $result4->PPH, //$dtl->HARGA, //TAMBAH 1 ROW PPN
                        'AKUN_DISTRIBUSI' => $result3->FLEX_VALUE_ . '-1181004-000000-00-0000-00-0000-0000-0000', //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                        'LINE_DESCRIPTION' => 'PPH', //NAMA ITEM PPH
                        'SOURCE' => 'INTEGRATION', //DEFAULT
                        'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                        'FAM_INVOICE_ID' => $ID_IAS //NO IAS -> UNTUK ASSET
                    );
                }
                //DENDA
                if ($result4->DENDA > 0) {
                    $iiLine = $iiLine + 1;
                    $arrdt[] = array(
                        'OPERATING_UNIT' => $result3->BRANCH_DESC,
                        'INVOICE_NUM' => $invoice, //TBL_T_IAS_DOC=>NAMA_DOC=2(INVOICE)
                        'INVOICE_TYPE' => 'STANDARD',
                        'VENDOR_NAME' => $hdr->VendorName,
                        'VENDOR_SITE_CODE' => $hdr->City, //kapital ?
                        'INVOICE_DATE' => date('Y-m-d h:i:s'),
                        'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                        'INVOICE_AMOUNT' => $result4->TTL_BYR,
                        'TERMS_NAME' => 'Immediate',
                        'LIABILITY_ACCOUNT' => $result3->FLEX_VALUE_ . '-' . $dtl[$i]->AccountLiability . '-000000-00-0000-00-0000-0000-0000', //VENDOR paren-liability-9segmen ?
                        'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                        'FAKTUR_PAJAK' => $faktur, //TBL_T_IAS_DOC=>NAMA_DOC=2(FAKTUR PAJAK)
                        'NOMORPO' => $ID_PO_DETAIL,
                        'LINE_NUMBER' => $iiLine,
                        'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
                        'AMOUNT' => $result4->DENDA, //$dtl->HARGA, //TAMBAH 1 ROW PPN
                        'AKUN_DISTRIBUSI' => $result3->FLEX_VALUE_ . '-2020300-000000-00-0000-00-0000-0000-0000', //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                        'LINE_DESCRIPTION' => 'DENDA', //NAMA ITEM PPH
                        'SOURCE' => 'INTEGRATION', //DEFAULT
                        'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                        'FAM_INVOICE_ID' => $ID_IAS //NO IAS -> UNTUK ASSET
                    );
                }
                //DPP
                $iiLine = $iiLine + 1;
                $arrdt[] = array(
                    'OPERATING_UNIT' => $result3->BRANCH_DESC,
                    'INVOICE_NUM' => $invoice, //TBL_T_IAS_DOC=>NAMA_DOC=2(INVOICE)
                    'INVOICE_TYPE' => 'STANDARD',
                    'VENDOR_NAME' => $hdr->VendorName,
                    'VENDOR_SITE_CODE' => $hdr->City, //kapital ?
                    'INVOICE_DATE' => date('Y-m-d h:i:s'),
                    'INVOICE_CURRENCY_CODE' => $hdr->Currency,
                    'INVOICE_AMOUNT' => $result4->TTL_BYR,
                    'TERMS_NAME' => 'Immediate',
                    'LIABILITY_ACCOUNT' => $result3->FLEX_VALUE_ . '-' . $dtl[$i]->AccountLiability . '-000000-00-0000-00-0000-0000-0000', //VENDOR paren-liability-9segmen ?
                    'INVOICE_DESCRIPTION' => $hdr->ProjectName, //NAMA PROJECT PR
                    'FAKTUR_PAJAK' => $faktur, //TBL_T_IAS_DOC=>NAMA_DOC=2(FAKTUR PAJAK)
                    'NOMORPO' => $ID_PO_DETAIL,
                    'LINE_NUMBER' => $iiLine,
                    'LINE_TYPE_LOOKUP_CODE' => 'ITEM ', //ASER 'AWT' BARANG 'ITEM'
                    'AMOUNT' => $result4->DPP, //$dtl->HARGA, //TAMBAH 1 ROW PPN 1182001
                    'AKUN_DISTRIBUSI' => $result3->FLEX_VALUE_ . '-1199099-000000-00-0000-00-0000-0000-0000', //AMBIL DARI COA PER ITEM(tunggu design table)=>SEMENTARA
                    'LINE_DESCRIPTION' => 'DPP', //NAMA ITEM PPN
                    'SOURCE' => 'INTEGRATION', //DEFAULT
                    'PAYMENT_METHOD_CODE' => 'PNM PAYMENT METHOD', //PNM PAYMENT METHOD
                    'FAM_INVOICE_ID' => $ID_IAS //NO IAS -> UNTUK ASSET
                );
            }
            // $this->db->update_batch('TBL_T_TB_DETAIL', $update, 'ID');
            // print_r($this->db->last_query());exit();
//            }
        }
        foreach ($arrdt as $arr) {
            array_push($arrData, $arr);
        }

//        die();

        $data['data'] = $arrData;
        $curlurl = $result->LINK . "/insert_invoice";
//        print_r($data['data']);
//        die();

        foreach ($data['data'] as $value) {
            $idata['data'] = array($value);
            $ch = curl_init($curlurl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($idata));
            $responsejson = curl_exec($ch);
//            print_r($responsejson);
            curl_close($ch);
        }

//        $ch = curl_init($curlurl);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//        $responsejson = curl_exec($ch);
////        print_r($responsejson);die();
//        curl_close($ch);

        $response = json_decode($responsejson, true);
//        print_r($response);
//        die();
        return $response;
    }

    function insert_update_vendor($param, $iBranch) {
        $update = null;
        if ($param == 1) {
            $update = 'Y';
        }
        $id_kyw = (int) $this->session->userdata('id_kyw');

        $Raw_ID = trim($this->input->post('Raw_ID'));

        $VendorID = trim($this->input->post('VendorID'));
        $VendorName = strtoupper(trim(($this->input->post('VendorName'))));
        $VendorAlias = trim($this->input->post('VendorAlias'));
        $AFILIASI = trim($this->input->post('AFILIASI'));
        $NPWP = trim($this->input->post('NPWP'));
        $NamaProvinsi = trim($this->input->post('IdProvinsi'));
        $City = strtoupper(trim(($this->input->post('city'))));
        $CountryName = trim($this->input->post('ID_Country'));
        $ID_Branch = trim($this->input->get('sBranch'));
        $AccountLiability = trim($this->input->post('AccountLiability'));
        $AccountPrepayment = trim($this->input->post('AccountPrepayment'));
        $Terms = trim($this->input->post('Terms'));
        $Currency = trim($this->input->post('Currency'));
        $NomorRekening = trim($this->input->post('NomorRekening'));
        $NamaBank = trim($this->input->post('NamaBank'));
        $MasaBerlakuTDP = date('Y-m-d', strtotime(trim($this->input->post('MasaBerlakuTDP'))));
        $Image = trim($this->input->post('Image'));
        $AlamatNPWP = trim($this->input->post('AlamatNPWP'));
        $AlamatSupplier = trim($this->input->post('AlamatSupplier'));
        $VendorAddress = trim($this->input->post('VendorAddress'));
        $Performance = trim($this->input->post('Performance'));
        $PKP = trim($this->input->post('PKP'));
        $NamaRekening = trim($this->input->post('NamaRekening'));
        $NamaRekening2 = trim($this->input->post('NamaRekening2'));
        $NamaBank2 = trim($this->input->post('NamaBank2'));
        $NomorRekening2 = trim($this->input->post('NomorRekening2'));
        $NamaRekening3 = trim($this->input->post('NamaRekening3'));
        $NamaBank3 = trim($this->input->post('NamaBank3'));
        $NomorRekening3 = trim($this->input->post('NomorRekening3'));
        $iStatus = trim($this->input->post('iStatus'));

        $this->load->database();
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
        $result = $query->result()[0];

        // $query = $this->db->query("Select a.NamaKabupaten from Mst_Kabupaten a where IdKabupaten  ='" . $NamaKabupaten . "'");
        // $NamaKabupaten = $query->result()[0]->NamaKabupaten;

        $query = $this->db->query("Select a.NamaProvinsi from Mst_Provinsi a where IdProvinsi  ='" . $NamaProvinsi . "'");
        $NamaProvinsi = $query->result()[0]->NamaProvinsi;

        // $query = $this->db->query("Select a.BRANCH_DESC from TBL_M_BRANCH a where ID  ='" . $ID_Branch . "'");      
        // $BRANCH_DESC = $query->result()[0]->BRANCH_DESC;

        foreach ($iBranch as $data) {
            $data_oracle = array(
                'VENDOR_NAME' => $VendorAlias,
                'ALT_VENDOR_NAME' => $VendorName,
                'NPWP' => $NPWP,
                'ADDRESS1' => $VendorAddress,
                'City' => $City,
                'PROVINCE' => $NamaProvinsi,
                'COUNTRY' => $CountryName,
                'BRANCH' => $data,
                'SITE_NAME' => $data,
                'ACCOUNT_LIABILITY' => $AccountLiability,
                'ACCOUNT_PREPAYMENT' => $AccountPrepayment,
                'CURRENCY' => $Currency,
                'TERMS' => $Terms,
                'NOMOR_REK_VENDOR1' => $NomorRekening,
                'NAMA_REKENING1' => $NamaRekening,
                'NAMA_BANK1' => $NamaBank,
                'NOMOR_REK_VENDOR2' => $NomorRekening2,
                'NAMA_REKENING2' => $NamaRekening2,
                'NAMA_BANK2' => $NamaBank2,
                'NOMOR_REK_VENDOR3' => $NomorRekening3,
                'NAMA_REKENING3' => $NamaRekening3,
                'NAMA_BANK3' => $NamaBank3,
                'UPDATE_FLAG' => $update,
            );
            print_r($data_oracle);
            die();
            $curlurl = $result->LINK . "/insert_vendor";

            $ch = curl_init($curlurl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_oracle));
            $responsejson = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($responsejson, true);
            // print_r($data);die();
        }
    }

    function get_status_ias($ID_PO_DETAIL, $STATUS) {
        $this->load->database();
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
        $result = $query->result()[0];
//        $INV_NUM = 'FPUM83153-KUSTYDI';
//        $INV_ID = 'FPUR148215';
//        $STATUS='FULLY APPLIED';

        $jsonarr = [
            'table' => 'PNM_AP_INV_PAID_V',
            'filter' => ["STATUS" => "where/" . $STATUS,
                "NO_PO" => "where/" . $ID_PO_DETAIL
            ]
        ];
        $curlurl = $result->LINK . "/get_all";

        $ch = curl_init($curlurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($jsonarr));
        $responsejson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responsejson, true);
        if (sizeof($response['data']) == 0) {
            $response['data'] = 0;
        } else {
            $response['data'] = count($response['data']);
        }
//        print_r($response['data']);die();

        return $response['data'];
    }

    function sync_user_fam() {
        $this->load->database();
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='GET USER FAM'");
        $result = $query->result()[0];

        $curlurl = $result->LINK . "?app_code=MASSET";

        $auth = base64_encode("event:event");
        $context = stream_context_create(['http' => ['header' => "Authorization: Basic $auth"]]);
        $homepage = file_get_contents($curlurl, false, $context);
        $result = json_decode($homepage);

        foreach ($result->profile[0]->data as $data) {
            $CEK = $this->db->query("SELECT COUNT(*) as count FROM TBL_M_USER_FAM WHERE profile_id_sdm='" . $data->profile_id_sdm . "'")->result()[0]->count;
            if ($CEK == 0) {
                $ArrInsert = array(
                    'profile_id_sdm' => $data->profile_id_sdm,
                    'profile_nip' => $data->profile_nip,
                    'profile_nama' => $data->profile_nama,
                    'profile_username' => $data->profile_username,
                    'profile_email' => $data->profile_email,
                    'create_by' => 'SYSTEM',
                    'create_date' => date('Y-m-d h:i:s')
                );
                $this->db->insert('TBL_M_USER_FAM', $ArrInsert);
            } else {
                $ArrUpdate = array(
//                    'profile_id_sdm' => $data->profile_id_sdm,
                    'profile_nip' => $data->profile_nip,
                    'profile_nama' => $data->profile_nama,
                    'profile_username' => $data->profile_username,
                    'profile_email' => $data->profile_email,
                    'update_by' => 'SYSTEM',
                    'update_date' => date('Y-m-d h:i:s')
                );
                $this->db->update('TBL_M_USER_FAM', $ArrUpdate);
                $this->db->where('profile_id_sdm', $data->profile_id_sdm);
            }
        }

        return $result;
    }

    function get_kehilangan($ID_ASSETS = array()) {
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
        $result = $query->result()[0];

        $jsonarr = [
            'table' => 'PNM_FAM_FA_WORKBENCH_V',
            'filter_where_in' => ["ASSET_NUMBER" => $ID_ASSETS]
        ];

        $curlurl = $result->LINK . "/get_all";

        $ch = curl_init($curlurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($jsonarr));
        $responsejson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responsejson, true);

        return $response['data'];
    }

    function inserttransferAPI($id) {

        $this->load->database();
        $query = $this->db->query("SELECT LINK FROM TBL_API_LINK WHERE API_NAME='CRUD ORACLE'");
        $result = $query->result()[0];

        $query1 = $this->db->query("SELECT * FROM TBL_T_ASSETS WHERE ID = " . $id . " AND IS_TRASH=0 AND STATUS_TRANS=2");
        $result1 = $query1->result()[0];

        $data = array(
            'to_table' => 'PNM_FAM_FA_TRANSFER_STG',
            'ASSET_NUMBER' => $result1->ID_ASSET,
            'UNITS' => $result1->QTY,
            'OLD_KOTA' => $result1->OLD_KOTA,
            'OLD_LOKASI' => $result1->OLD_LOKASI,
            'OLD_SUBLOKASI' => $result1->OLD_SUB_LOKASI,
            'ASSET_BOOK_NAME' => 'PNM COMMERCIAL BOOK',
            'OLD_EXPENSE_ACCOUNT' => $result1->BRANCH . '-6062107-000000-UL-0000-KV-0000-0000-0000',
            'NEW_EXPENSE_ACCOUNT' => $result1->DIV_TUJUAN . '-6062107-000000-UL-0000-KV-0000-0000-0000',
            'NEW_LOKASI' => $result1->LOKASI,
            'NEW_KOTA' => $result1->KOTA,
            'NEW_SUBLOKASI' => $result1->SUB_LOKASI
                // 'STATUS' => '',
                // 'PROCESS_ID' => l
        );
//        print_r($data);die();

        $curlurl = $result->LINK . "/insert_to_table";

        $ch = curl_init($curlurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $responsejson = curl_exec($ch);
        // print_r($responsejson); die();
        curl_close($ch);

        $response = json_decode($responsejson, true);

        // print_r($response);
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */