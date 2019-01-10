<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $laporan . "_" . date('d-m-Y h:i:sa') . ".xls");
header("Pragma: no-chace");
header("Expires: 0");
error_reporting(0);
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php $laporan ?></title>
    <style type="text/css">
    table.tableizer-table {
        width: 100%;
        border: 0px solid #000; 
    }
    .tableizer-table td {
        margin: 3px;
        border: 0px solid #000;
    }
    .tableizer-table th {
        color: #000;
        font-weight: bold;
        text-align: center;
    }

    table.tableizer-table2{
        width: 100%;
        border: 1px solid #000; 
    }
    .tableizer-table2 td {
        margin: 3px;
        border: 1px solid #000;
    }
    .tableizer-table2 th {
        color: #000;
        border: 1px solid #000;
        font-weight: bold;
        text-align: center;
    }

</style>
</head>
<body class="tabel">
    <label>&nbsp;</label>
    <div class="row">
        <div class="col-md-5">
            <?php
            $ax = 0;
            $bx = 0;
            $cx = 0;
            foreach ($list as $i) {
                $rand = $i->AGING;
                if(($rand > 30) && ($rand <= 90)){
                    $ax = $ax + 1;
                } else if (($rand >= 0) && ($rand <= 30)){
                    $bx = $bx + 1;
                } else if ($rand < 0) {
                    $cx = $cx + 1;
                } 
            }
            ?>
            <table class="tableizer-table" style="width:45%">
                <div class="row">
                <tr>
                    <td width="10%" style="font-weight: bold;">Nama Report</td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%">Invoice</td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">Periode Report </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $periode; ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">>H+7 </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $ax; ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">H Sampai H + 7 </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $bx; ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">< H </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $cx; ?></td>
                </tr>
            </div>
            <div class="row">
                <tr>
                    <td width="10%" style="font-weight: bold;">Jumlah Request </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $cx; ?></td>
                </tr>
                 <tr>
                    <td width="10%" style="font-weight: bold;">Jumlah PO </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $cx; ?></td>
                </tr>
                 <tr>
                    <td width="10%" style="font-weight: bold;">Jumlah Inv VS Termin </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $cx; ?></td>
                </tr>
                 <tr>
                    <td width="10%" style="font-weight: bold;">Belum di INV </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $cx; ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">INV Terbayar </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $cx; ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">INV Belum Terbayar </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $cx; ?></td>
                </tr>
            </div>

            </table>
        </div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>
    <table class="judul tableizer-table" width="100%">
        <tr><td colspan="9">
            <table class="tableizer-table2" style="width:100%;">
                <thead>
                    <tr>
                        <th>NO PR</th>  
                        <th>Deskripsi</th>   
                        <th>DIV/CAB</th>
                        <th>Nama PIC</th>
                        <th>Tanggal PR</th>
                        <th>No PO</th>
                        <th>Nilai PO</th>
                        <th>Vendor Name</th>
                        <th>Termin</th>
                        <th>No INV</th>
                        <th>No IAS</th>
                        <th>Presentase (%)</th>
                        <th>Nilai INV</th>
                        <th>Batas Tgl Pembayaran</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = '';
                    foreach ($list as $i) {
                        // $rand = $i->ID_PR;
                        // if(($rand > 30) && ($rand <= 90)){
                        //     $a = "#00FF00";
                        // } else if (($rand >= 0) && ($rand <= 30)){
                        //     $a = "#ffe441";
                        // } else if ($rand < 0) {
                        //     $a = "#FF0000";
                        // } 
                        ?>
                        <tr bgcolor="<?php echo $a ?>" >
                            <td><?php echo $i->RequestID; ?> </td>
                            <td><?php echo $i->ProjectName; ?> </td>
                            <td><?php echo $i->DivisionID; ?> </td>
                            <td><?php echo $i->PIC_PO; ?> </td>
                            <td><?php echo date('d-m-Y', strtotime($i->CreateDate)); ?> </td>
                            <td><?php echo $i->ID_PO; ?> </td>
                            <td><?php echo $i->TTL_HARGA; ?> </td>
                            <td><?php echo $i->VendorName; ?> </td>
                            <td><?php echo $i->TERMIN; ?> </td>
                            <td><?php echo $i->ID_IAS; ?> </td>
                            <td><?php echo $i->NO_DOC; ?> </td>
                            <td><?php echo $i->PERSENTASE; ?>% </td>
                            <td align="right"><?php echo number_format($i->NILAI_DIBAYARKAN,2); ?> </td>
                            <td><?php echo date('d-m-Y', strtotime($i->TGL_JATUH_TEMPO)); ?> </td>
                        </tr>
                        <?php
                        ?>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>
    <table class="judul tableizer-table">
        <tr><td colspan="9">
            <table class="tableizer-table2">
                <thead>
                    <tr>
                        <th colspan="2">Keterangan Warna</th>
                        <th>Parameter</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>> H+7</td>
                        <td bgcolor="#00FF00">&nbsp;</td>
                        <td>Batas tanggal Pembayaran </td>
                        
                    </tr>
                    <tr>
                        <td>H Sampai H + 7</td>
                        <td bgcolor="#ffe441">&nbsp;</td>
                        <td>Batas tanggal Pembayaran </td>
                        
                    </tr>
                    <tr>
                        <td>< H</td>
                        <td bgcolor="#FF0000">&nbsp;</td>
                        <td>Batas tanggal Pembayaran </td>
                      <!--   <td colspan="0">cszcsczc</td> -->
                       
                    </tr>


                   
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
<script>
//    window.print();
</script>