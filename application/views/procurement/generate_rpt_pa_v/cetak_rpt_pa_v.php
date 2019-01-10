<?php
error_reporting(0);
?>

     <?php foreach ($cetak_pa1 as $row) {?>
    
    <?php }?>
<input type="hidden" id="id_userName" value="<?php echo $this->session->userdata('user_name'); ?>">
<input type="hidden" id="id_posisi" value="<?php echo $this->session->userdata('posisi_desc'); ?>">
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">

            <div class="portlet-body">
                <div class="tab-content">
                        <div class="row">
                        
                            <div class="col-md-12 invoice-payment">
                                <center><h3>PT. PERMODALAN NASIONAL MADANI (PERSERO)</h3></center>
                                <center><h3><u><b>PURCHASE APPROVAL (PERSETUJUAN PEMBELIAN)</b></u></h3></center>
                                
                                <ul class="list-unstyled">
                                    <li>
                                        <center><strong>Purchase Request No :</strong>&nbsp;<?php  echo $row->RequestID; ?></li></center>
                                </ul>
                            </div>

                            <center>
                                <div id="divBudget">
                                <div class="col-md-12" >
                                    <p>Di isi oleh bagian <i>Purchasing</i> : </p>
                                    <table  class="table table-striped table-responsive table-bordered table-hover text_kanan" id="">
                                        <thead>
                                            <tr>
                                                <th width="30px">NO</th>     
                                                <th width="320px">Daftar Vendor yang di rekomendasikan</th>     
                                                <th width="140px">Harga</th>
                                                <th width="130px">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    
                                         <?php
                                        $no=0;
                foreach ($cetak_pa1 as $row) {
                    $nominal = number_format($row->HargaVendor,2);
                    $no++;
                    echo 

                    
                                        "<tr>
                                            <td>$no</td>
                                            <td>&nbsp;$row->VendorName</td> 
                                            <td>&nbsp;Rp.$nominal </td>
                                            <td>&nbsp;$row->PPN</td>
                                        </tr>";
                                    }
                             ?>
                                       <!--  <tr>
                                            <td>2</td>
                                            <td>Pengadaan LCD LG K8890</td>
                                            <td>Rp.1.750.000</td>
                                            <td>Belum termasuk PPN</td>
                                        </tr> -->

                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </center>
                            <br>

                                <center><div class="col-md-12" >
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridBudget3">
                                        <thead>
                                            <tr>
                                                <tr>
                                                <td colspan="5"><center><b>Rekomendasi Pembelian</b></center></td>
                                                </tr>
                                                <tr>     
                                                <td colspan="5"><b>&nbsp;Nama Vendor :&nbsp;<?php  echo $row->VendorName; ?></b></td>
                                                </tr>
                                                <tr> 
                                        <td colspan="5"><b>&nbsp;Rp.<?php  echo number_format($row->HargaVendor ,2,",","."); ?></b></td>
                                                </tr>
                                            <tr>    
                                                <td width="337px" rowspan="6"><b>&nbsp;Alasan : &nbsp;<?php  echo $row->JenisPengadaan; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><center><b>Tanda Tangan</b></center></td>
                                            </tr>
                                            <tr>
                                                <td><br><br><br><br></td>
                                                <td><br><br><br><br></td>
                                                <td><br><br><br><br></td>
                                            </tr>
                                            <tr>
                                                <td width="150px"><center>Expense Analyst</center></td>
                                                <td width="150px"><center>Ka. Dept Pembelian</center></td>
                                                <td width="150px"><center>Ka. Div. General Affairs</center></td>
                                                </tr>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                            </center>
                            <!-- end col-12 -->
                            <center>
                             <div class="col-md-12" > 
                                    <p>Di isi oleh bagian <i>Anggaran</i> : </p>
                                    <table class="table"  width="800px" height="250px" right="100px"  id="table_gridBudget2">
                                        <thead>
                                            <tr>
                                                <tr>
                                                <td colspan="3"><center><b>Verifikasi Anggaran</b></center></td>
                                                </tr>
                                            <tr>    
                                                <td width="200px"><b>&nbsp;Anggaran :<ul><br>
                                                   <input type="checkbox" name="vehicle1" value="Bike"> Dalam Anggaran<br>
                                                    <input type="checkbox" name="vehicle1" value="Bike"> Diluar anggaran<br>
                                               <input type="checkbox" name="vehicle1" value="Bike"> Tidak dalam Anggaran<br>
                                                </ul></td>
                                                <td width="260px"><b>&nbsp;Alasan : Rp.<?php  echo number_format($row->BudgetDisetujui ,2,",","."); ?></td>
                                                <td width="200px"><b>&nbsp;Tanda tangan :</td>
                                            </tr>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                                </center>
                           <br>
                            <br>
                            <br>
                                <center><div class="col-md-12" >
                                    <!-- <p>Di isi oleh bagian <i>Purchasing</i> : </p> -->
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridBudget2">
                                        <thead>
                                            <tr>
                                                <tr>
                                                <td colspan="6"><center><b>Persetujuan Pembelian</b></center></td>
                                                </tr>
                                            <tr>    
                                                <td  width="200px" rowspan="2"><ul><br>
                                                    <li ><b>Tanda tangan</b></li><br>
                                                    <li><b>Nama</b></li><br>
                                                </ul></td>
                                                <td><br><br><br></td>
                                                <td><br><br><br></td>
                                                <td><br><br><br></td>
                                                <td><br><br><br></td>
                                                <td><br><br><br></td>
                                            </tr>
                                            <tr>
                                                <td width="100px"><center>Direktur</center></td>
                                                <td width="100px"><center>Direktur</center></td>
                                                <td width="100px"><center>Direktur</center></td>
                                                <td width="100px"><center>Direktur</center></td>
                                                <td  width="180px"><center>Direktur Utama</center></td>
                                                </tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </center>

                      <!--   <div class="col-md-12">
                            <div class="col-md-5">
                            <font size="2">Putih :&nbsp;&nbsp;&nbsp;Bagian Akutansi(Dilampirkan dengan Purchase Order)</font>
                            <font size="2">Hijau :&nbsp;&nbsp;&nbsp;Seksi Procurement</font>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-3">
                            <font size="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kuning :&nbsp;&nbsp;&nbsp;Bagian Anggaran</font></br>
                            <font size="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Merah :&nbsp;&nbsp;&nbsp;Seksi Expense</font>
                            </div>
                        </div> -->
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    <!-- END VALIDATION STATES-->
</div>
</div>

<script>
    window.print();
</script>
<!-- END PAGE CONTENT-->

<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/ias/ias.js.php'); ?>


<style >
    
table, tr, td {
    border-collapse:collapse;
    border:1px solid #999;
    font-family:Tahoma, Geneva, sans-serif;
    font-size:12px;
}

table, tr, th {
    border-collapse:collapse;
    border:1px solid #999;
    font-family:Tahoma, Geneva, sans-serif;
    font-size:12px;
}


</style>



