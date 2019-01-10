<!DOCTYPE html>
<?php
error_reporting(0);
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $laporan ?></title>
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
    @page {
        size: A4;
        margin-top: 2em;
        margin-right: 2em;
        margin-left: 2em;
        margin-bottom: 2em;
    }
    @media print {
        @page {size: landscape};
    }

</style>
</head>
<body class="tabel">
    <label>&nbsp;</label>
    <div class="row">
        <div class="col-md-5">
            <?php
            $jmlbarang  = 0;
            $belumdiajukan = 0;
            $pengajuan = 0;
            $done = 0;
            $penjualan = 0;
            $kerusakan = 0;
            $kehilangan = 0;
            foreach ($list as $i) {
                $jmlbarang = $jmlbarang + $i->JML;
                if(strtoupper($i->STATUS_DESC) == "BELUM DIAJUKAN"){
                    $belumdiajukan = $belumdiajukan + 1;
                }
                if(strtoupper($i->STATUS_DESC) == "PENGAJUAN KOMITE"){
                    $pengajuan = $pengajuan + 1;
                }
                if(strtoupper($i->HAPUS) == "PENJUALAN"){
                    $penjualan = $penjualan + 1;
                }
                if(strtoupper($i->HAPUS) == "KERUSAKAN"){
                    $kerusakan = $kerusakan + 1;
                }
                if(strtoupper($i->HAPUS) == "KEHILANGAN"){
                    $kehilangan = $kehilangan + 1;
                }
                if ((strtoupper($i->STATUS_DESC) == "DONE") || (strtoupper($i->STATUS_DESC) == "TERJUAL") || (strtoupper($i->STATUS_DESC) == "TERJUAL / DONE")){
                    $done = $done + 1;
                }
            }
            ?>
            <table class="tableizer-table" style="width:100%">
                <tr>
                    <td width="10%" style="font-weight: bold;">Nama Report </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%">PENILAIAN VENDOR</td>
                    <td width="1%" style="font-weight: bold;">&nbsp;</td>
                    <td width="1%" style="font-weight: bold;">&nbsp;</td>
                    <td width="10%" style="font-weight: bold;">Done </td>
                    <td width="20%"><?php echo number_format($done,0); ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">Periode Report </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo $periode; ?></td>
                    <td width="1%" style="font-weight: bold;">&nbsp;</td>
                    <td width="1%" style="font-weight: bold;">&nbsp;</td>
                    <td width="10%" style="font-weight: bold;">Penjualan </td>
                    <td width="20%"><?php echo number_format($penjualan,0); ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">Jumlah Barang </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo number_format($jmlbarang,0); ?></td>
                    <td width="1%" style="font-weight: bold;">&nbsp;</td>
                    <td width="1%" style="font-weight: bold;">&nbsp;</td>
                    <td width="10%" style="font-weight: bold;">Kerusakan </td>
                    <td width="20%"><?php echo number_format($kerusakan,0); ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">Belum Diajukan</td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo number_format($belumdiajukan,0); ?></td>
                    <td width="1%" style="font-weight: bold;">&nbsp;</td>
                    <td width="1%" style="font-weight: bold;">&nbsp;</td>
                    <td width="10%" style="font-weight: bold;">Kehilangan </td>
                    <td width="20%"><?php echo number_format($kehilangan,0); ?></td>
                </tr>
                <tr>
                    <td width="10%" style="font-weight: bold;">Pengajuan </td>
                    <td width="1%" style="font-weight: bold;">:</td>
                    <td width="20%"><?php echo number_format($pengajuan,0); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>
    <table class="tableizer-table2" style="width:100%;">
        <thead>
            <tr>
                <th>Asset Number</th>  
                <th>Book Name</th>   
                <th>Tanggal Penghapusan</th>
                <th>Jumlah</th>
                <th>Harga Jual</th>
                <th>Nama Transaksi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $a = '';
            foreach ($list as $i) {
                ?>
                <tr>
                    <td><?php echo $i->ID_ASSET; ?> </td>
                    <td><?php echo $i->BOOK_NAME; ?> </td>
                    <td><?php echo date('d-m-Y', strtotime($i->CREATE_DATE)); ?> </td>
                    <td align="right"><?php echo number_format($i->JML,0); ?> </td>
                    <td align="right"><?php echo number_format($i->HARGA,2); ?> </td>
                    <td><?php echo $i->HAPUS; ?> </td>
                    <td><?php echo $i->STATUS_DESC; ?> </td>
                </tr>
                <?php
                ?>
                <?php } ?>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </body>
    </html>
    <script>
        window.print();
    </script>