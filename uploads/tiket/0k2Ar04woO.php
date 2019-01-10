<?php
// $jsonarr=[ 
					// 'table'=>'PNM_COA_V',
					// 'filter'=>	[
									// 'FLEX_VALUE_ID'=>'where/63909'
								// ]
				// ];
				
			
$data['data'] = array(
            array(
                'OPERATING_UNIT' => 'PNM Kantor Pusat',
                'INVOICE_NUM' => 'HM/UPL/STD/18/10/2018',
                'INVOICE_TYPE' => 'STANDARD 1',
                'VENDOR_NAME' => '2NET MEDIA 1 HSJ 18okt',
                'VENDOR_SITE_CODE' => 'PENAJAM',
                'INVOICE_DATE' => '2018-09-11',
                'INVOICE_CURRENCY_CODE' => 'IDR',
                'INVOICE_AMOUNT' => '9999',
                'TERMS_NAME' => 'Immediate',
                'LIABILITY_ACCOUNT' => 'KTRPST-2159998-000000-00-0000-00-0000-0000-0000',
                'INVOICE_DESCRIPTION' => 'FAM TES',
                'FAKTUR_PAJAK' => '',
                'NOMORPO' => 'PO/123/XII/111',
                'LINE_NUMBER' => '1',
                'LINE_TYPE_LOOKUP_CODE' => 'ITEM ',
                'AMOUNT' => '9999',
                'AKUN_DISTRIBUSI' => 'KTRPST-1202008-000000-00-0000-00-0000-0000-0000',
                'LINE_DESCRIPTION' => 'ITEM NAME TES',
                'ITEM_DESCRIPTION' => '',
                'ASSET_BOOK_NAME' => '',
                'ASSET_CATEGORY' => '',
                'JENIS_BARANG' => '',
                'UMUR_FISKAL' => '',
                'AMORTIZATION' => '',
                'FAM_ASSET_ID' => '',
                'DEFERRED_ACCTG_FLAG' => '',
                'DEF_ACCTG_START_DATE' => '',
                'DEF_ACCTG_END_DATE' => '',
                'SOURCE' => '',
                'PAYMENT_METHOD_CODE' => '',
                'FAM_INVOICE_ID' => '',
                'TGL_PENGAKUAN_BRG' => '',
                'STATUS' => '',
                'ERROR_CODE' => '',
                'ERROR_MESSAGE' => '',
                'PROCESS_ID' => ''
            ),
			array(
                'OPERATING_UNIT' => 'PNM Kantor Pusat',
                'INVOICE_NUM' => 'HM/UPL/STD/18/10/2018',
                'INVOICE_TYPE' => 'STANDARD 1',
                'VENDOR_NAME' => '2NET MEDIA 1 HSJ 18okt',
                'VENDOR_SITE_CODE' => 'PENAJAM',
                'INVOICE_DATE' => '2018-09-11',
                'INVOICE_CURRENCY_CODE' => 'IDR',
                'INVOICE_AMOUNT' => '9999',
                'TERMS_NAME' => 'Immediate',
                'LIABILITY_ACCOUNT' => 'KTRPST-2159998-000000-00-0000-00-0000-0000-0000',
                'INVOICE_DESCRIPTION' => 'FAM TES',
                'FAKTUR_PAJAK' => '',
                'NOMORPO' => 'PO/123/XII/111',
                'LINE_NUMBER' => '2',
                'LINE_TYPE_LOOKUP_CODE' => 'ITEM ',
                'AMOUNT' => '9999',
                'AKUN_DISTRIBUSI' => 'KTRPST-1202008-000000-00-0000-00-0000-0000-0000',
                'LINE_DESCRIPTION' => 'ITEM NAME TES',
                'ITEM_DESCRIPTION' => '',
                'ASSET_BOOK_NAME' => '',
                'ASSET_CATEGORY' => '',
                'JENIS_BARANG' => '',
                'UMUR_FISKAL' => '',
                'AMORTIZATION' => '',
                'FAM_ASSET_ID' => '',
                'DEFERRED_ACCTG_FLAG' => '',
                'DEF_ACCTG_START_DATE' => '',
                'DEF_ACCTG_END_DATE' => '',
                'SOURCE' => '',
                'PAYMENT_METHOD_CODE' => '',
                'FAM_INVOICE_ID' => '',
                'TGL_PENGAKUAN_BRG' => '',
                'STATUS' => '',
                'ERROR_CODE' => '',
                'ERROR_MESSAGE' => '',
                'PROCESS_ID' => ''
            )
        );
				
$curlurl="http://192.168.10.241/OCI/index.php/api/v1/fam/insert_invoice";
// $curlurl="http://192.168.10.241/OCI/index.php/api/v1/fam/get_all";

$ch = curl_init($curlurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$responsejson = curl_exec($ch);
curl_close($ch);

$response=json_decode($responsejson,true);

print_r($response);


?>