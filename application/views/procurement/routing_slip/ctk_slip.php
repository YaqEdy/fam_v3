

<!-- <?php
error_reporting(0);
?>
 -->
<style >
    
table, tr, td {
    border-collapse:collapse;
   /* border:1px solid #999;*/
    font-family:Tahoma, Geneva, sans-serif;
    font-size:18px;
}

table, tr, th {
    border-collapse:collapse;
    /*border:1px solid #999;*/
    font-family:Tahoma, Geneva, sans-serif;
    font-size:18px;
}


</style>








<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-title">
                <div class="caption">
                   
                </div>
            <div class="portlet-body">

                    <br>
                    <br>
                 

                    <div class="col-md-12">
                        <table class="table" width="1100PX"  right="100px" >
                            <tr>
                                <th colspan="1"  width="100px" ><br><img src="<?php echo base_url('metronic/img/logo.png'); ?>" alt="gambar duniailkom" width="170px"  height="100px" align="left"/></th>
                                <th colspan="1" width="600px"  ><center><h3>ROUTIN SLIP</h3
                                ></center></th>
                                    
                            </tr>
                            <tr>
                                <td colspan="1" width="100px" ><br>&nbsp;Divisi</td>
                                <td colspan="1" width="600px" ><br>&nbsp; : PPI (Kantor Pusat)</td>
                            </tr>
                            <tr>
                                <td colspan="1" width="100px" ><br>&nbsp;Divisi</td>
                                <td colspan="1" width="600px" ><br>&nbsp; : <?php  echo $cetak_slip[0]->DIV_DESC ?></td>
                            </tr>
                            <tr>
                                <td colspan="1" width="100px" ><br>&nbsp;Vendor</td>
                                <td colspan="1" width="600px" ><br>&nbsp; : <?php  echo $cetak_slip[0]->VendorName ?></td>
                            </tr>

                             
                        </table>
                    </div>

                    <br>
                    <br>
                    <br>

                  <!-- <td>&nbsp;$row->date</td>       <?=date("d-m-Y", strtotime($row->date))?>   -->
             
                    
                    <div class="col-md-12">
                        <table class="table" width="1100PX" right="800px"  border="1">
                            <tr>
                                <th rowspan="2" width="300px" right="100px">&nbsp;Kegiatan&nbsp;</th>
                                <th rowspan="2" width="100px" >&nbsp;Date&nbsp;</th>
                                <th rowspan="2" width="100px" >&nbsp;Action&nbsp;</th>
                                <th colspan="2" width="200px" >&nbsp;Paraf Pejabat&nbsp;</th>
                                <th rowspan="2" width="200px" >&nbsp;Ket.&nbsp;</th>
                            </tr>
                            <tr>
                                <th colspan="1" width="100px" >User</th>
                                <th colspan="1" width="100px" >Png Jawab</th>
                            </tr>
                                <?php
                                foreach ($cetak_slip as $row) {
                                    $date_action = '';
                                    if($row->date != NULL){
                                        $date_action = date("d M Y",strtotime($row->date));
                                    }
                                    echo 
                                        "<tr>
                                            <td>&nbsp;$row->status</td>
                                            <td>&nbsp;$date_action</td>
                                            <td>&nbsp;$row->action</td>
                                            <td>&nbsp;$row->name</td>
                                            <td></td>
                                            <td>&nbsp;$row->notes</td>
                                        </tr>";
                                    }
                                ?>
                           <!--  <tr>
                                <td colspan="1" >&nbsp;2.a.Verifikasi Bill Of Quantity Asset/PR PA/RGR</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                             <tr>
                                <td colspan="1" >&nbsp;&nbsp;&nbsp;&nbsp;b.Verifikasi Kelengkapan Dokument</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;3.Verifikasi Kabag Div PPI</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;4.Approval Kadiv Divisi Lain</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="3" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;5.Approval Kadiv Div PPI</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;6.Approval Kadiv DIvisi Lain</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                             <tr>
                                <th colspan="1" >&nbsp;Divisi KDP</th>
                                <th colspan="2" >&nbsp;</th>
                                <th colspan="2" ></th>
                                <th colspan="1" >&nbsp;</th>
                                <th colspan="1" >&nbsp;</th>
                                <th colspan="2" >&nbsp;</th>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;7.Verifikasi Bagian Anggaran Div KDP</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;8.Verifikasi Bagian Pajak I Div KDP</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;9.Verifikasi Bagian Pajak II Div KDP</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;10.Verifikasi Bagian Akunting I Div KDP</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;11.Verifikasi Bagian Akunting II Div KDP</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;12.Verifikasi Kabag Div KDP</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;13.Verifikasi kadiv Div KDP</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr>
                            <tr>
                                <th colspan="1" >&nbsp;Divisi Operasi</th>
                                <th colspan="2" >&nbsp;</th>
                                <th colspan="2" ></th>
                                <th colspan="1" >&nbsp;</th>
                                <th colspan="1" >&nbsp;</th>
                                <th colspan="2" >&nbsp;</th>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;14.Melakukan Transaksi Pembayaran Div &nbsp;Operasi(TROPS)</td>
                                <td colspan="2" >&nbsp;</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="2" >&nbsp;</td>
                            </tr> -->
                            
                        </table>
                    </div>
                    <br>
                    <br>
                   

                           
                    
            </div>
        </div>
    </div>
    <!-- END VALIDATION STATES-->

</div>




<script>
    window.print();
</script> 