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
                <tr>
                    <td width="10%" style="font-weight: bold;">Nama Report </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%">NOTIFIKASI SEWA & NON SEWA</td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">Periode Report </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $periode; ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">30-90 </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $ax; ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">H Sampai H + 30 </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $bx; ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">< H </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $cx; ?></td>
                </tr>
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
                        <th>Tanggal PR</th>   
                        <th>DIV/CAB</th>
                        <th>Kategori</th>
                        <th>Jenis Sewa</th>
                        <th>Periode Awal Sewa</th>
                        <th>Periode Akhir Sewa</th>
                        <th>No PSW/PO</th>
                        <th>Nilai PSW/PO</th>
                        <th>Batas KPBJ/SEWA</th>
                        <th>Aging</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = '';
                    foreach ($list as $i) {
                        $rand = $i->AGING;
                        if(($rand > 30) && ($rand <= 90)){
                            $a = "#00FF00";
                        } else if (($rand >= 0) && ($rand <= 30)){
                            $a = "#ffe441";
                        } else if ($rand < 0) {
                            $a = "#FF0000";
                        }

                        if(trim($i->START_PERIODE) == ''){
                            $startdate = '';
                        } else {
                            $startdate = date('d-m-Y', strtotime($i->START_PERIODE));
                        }

                        if(trim($i->END_PERIODE) == ''){
                            $enddate = '';
                        } else {
                            $enddate = date('d-m-Y', strtotime($i->END_PERIODE));
                        }  
                        ?>
                        <tr bgcolor="<?php echo $a ?>" >
                            <td><?php echo $i->ID_PR; ?> </td>
                            <td><?php echo date('d-m-Y', strtotime($i->CreateDate)); ?> </td>
                            <td><?php echo $i->DivisionID; ?> </td>
                            <td><?php echo $i->ReqTypeName; ?> </td>
                            <td><?php echo $i->JNS_PERIODE; ?> </td>
                            <td><?php echo $startdate; ?> </td>
                            <td><?php echo $enddate; ?> </td>
                            <td><?php echo $i->PSW_PO; ?> </td>
                            <td align="right"><?php echo number_format($i->TOTAL,2); ?> </td>
                            <td><?php echo date('d-m-Y', strtotime($i->TGL_BTS_KPBJ_SEWA)); ?> </td>
                            <td><?php echo $i->AGING; ?> </td>
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>30 - 90</td>
                        <td bgcolor="#00FF00">&nbsp;</td>
                        <td>Notifikasi</td>
                    </tr>
                    <tr>
                        <td>H Sampai H + 30</td>
                        <td bgcolor="#ffe441">&nbsp;</td>
                        <td>Notifikasi</td>
                    </tr>
                    <tr>
                        <td>< H</td>
                        <td bgcolor="#FF0000">&nbsp;</td>
                        <td>Notifikasi</td>
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