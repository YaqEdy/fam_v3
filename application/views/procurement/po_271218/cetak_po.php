<?php
error_reporting(0);
?>
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

<?php   
    foreach($cetak_po_1 as $row){
        
 
 ?><?php
    }
?>

 




<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-title">
                <div class="caption">
                   
                </div>
            <div class="portlet-body">



                <!-- ===================================================== -->

                <div class="col-md-12">
                <!-- Vendor : -->
                    <table  height="100px" width="250" right="100px" align="right" border="1">
                    
                        <tr>
                            <td colspan="4" >&nbsp;Purchase Order No&nbsp;</td>
                            <td colspan="2" >&nbsp;<?php  echo $row->VENDOR_ID; ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4" >&nbsp;-&nbsp;</td>
                            <td colspan="2" >&nbsp;-&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4" >&nbsp;Date&nbsp;</td>
                            <td colspan="2" >&nbsp;<?php  echo $row->TGL_TERIMA; ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4" >&nbsp;-&nbsp;</td>
                            <td colspan="2" >&nbsp;-&nbsp;</td>
                        </tr>
                  
                      
                    </table>
                </div>
    
                           
                <!-- ======================================================== -->


              
                          
                            <img src="<?php echo base_url('metronic/img/logo.png'); ?>" alt="gambar duniailkom" width="120px"  height="60px"
                            align="left"/>
                    <br>
                    <br>
                    <br>
                    <br>
                            <caption> Gedung Artdaloka Lantai 1,6&10 <br> Jl.Jend. Sudirman Kav.2 Jakarta DKI 10220</caption>
                                
                     
                    <br>
                     <br>
                    <br>
                  
                 
                    <!-- ====================================================== -->
                <div class="col-md-12">
                <!-- Vendor : -->
                    <table  height="100px" right="100px" align="left" border="1">
                    <caption> Vendor :</caption>
                            <tr>
                                <td width="300px" height="15px" colspan="1" >&nbsp;<?php  echo $row->VendorName; ?></td>
                               
                            </tr>
                    </table>
                </div>

                <div class="col-md-12">
                <!-- Ship To : -->
                    <table  height="100px" right="100px" align="right" border="1">
                    <caption> Ship To :</caption>
                        <tr>
                                <td width="300px" height="20px" colspan="1" >&nbsp;Address listed witd item below&nbsp;</td>
                               
                                <!-- <td colspan="10" ><br><br><br><br></td>
                                <td colspan="1" ><br><br><br><br><br></td> -->
                            </tr>
                    </table>
                </div>
                <br>
                <br>
                <br>
                 <br>
                <br>
                <br>
                 <br>
                <br>
             
                           
                           
                       



                    <div class="col-md-12">
                        <caption> &nbsp;&nbsp; Contract Number :</caption>
                    </div>
                    <div class="col-md-12">
                        <caption> * Change Since the Previous Revision</caption>
                    </div>
                    
                    <div class="col-md-12">
                        <table class="table"  width="800px" height="250px" right="100px"  border="1">
                            <tr>
                                <th colspan="2" >&nbsp;Shipping Method&nbsp;</th>
                                <th colspan="2" >&nbsp;Payment Terma&nbsp;</th>
                                <th colspan="2" >&nbsp;Confirm With&nbsp;</th>
                                <th colspan="1" >&nbsp;Page&nbsp;</th>
                            </tr>
                             <tr>
                                <td colspan="2" ></td>
                                <td colspan="2" >&nbsp;14</td>
                                <td colspan="2" ></td>
                                <td colspan="1" >&nbsp;1</td>
                            </tr>
                             <tr>
                                <th colspan="1" >&nbsp;L/N  Item Number</th>
                                <th colspan="1" >Description</th>
                                <th colspan="1" >Req. Data</th>
                                <th colspan="1" >U/M</th>
                                <th colspan="1" >Ordered</th>
                                <th colspan="1" >Unit Price</th>
                                <th colspan="1" >Ext.Price</th>
                            </tr>
                            <tr>
                                <th colspan="1" >Shipping Method</th>
                                <th colspan="1" >Reference Number</th>
                                <th colspan="1" >FOB</th>
                                <th colspan="4" ></th>
                            </tr>
                            <tr>
                                <td colspan="1" >&nbsp;<?php  echo $row->NAMA_BARANG; ?> </td>
                                <td colspan="1" ></td>
                                <td colspan="1" > &nbsp;03/10/2018</td>
                                <td colspan="1" >&nbsp;QTY</td>
                                <td colspan="1" >&nbsp;<?php  echo $row->QTY; ?></td>
                                <td colspan="1" >&nbsp;Rp.<?php echo number_format($row->HARGA); ?></td>

                                        <?php
                                            $perkalian = '';
                                                if($row->HARGA != null){
                                                    $perkalian = $row->QTY*$row->HARGA;
                                                }
                                        ?>

                                <td colspan="1" >&nbsp;Rp.<?php echo number_format($perkalian); ?></td>
                            </tr>
                             <tr>
                                <td colspan="1" >&nbsp;DELIVERY</td>
                                <td colspan="1" >&nbsp;PRINTER EPSON L120</td>
                                <td colspan="1" >&nbsp;NONE</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                                <td colspan="1" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td  height="100px" colspan="1" >&nbsp;Deliver To :</td>
                                <td  height="20px" colspan="1" >&nbsp;PT PNM Persero<br>&nbsp;Gedung Artdaloka Lantai 1,6&10 <br>&nbsp;Jl.Jend. Sudirman Kav.2 <br>&nbsp;Jakarta DKI 10220</td>
                                <td  height="20px" colspan="1" >&nbsp;</td>
                                <td  height="20px" colspan="1" >&nbsp;</td>
                                <td  height="20px" colspan="1" >&nbsp;</td>
                                <td  height="20px" colspan="1" >&nbsp;</td>
                                <td  height="20px" colspan="1" >&nbsp;</td>
                            </tr>
                            
                        </table>
                    </div>
                    <br>
                    <br>
                   

                        <div class="col-md-12">

                            <table  height="100px" width="250" right="100px" align="right" border="1">
                                <tr>
                                    <td bgcolor="#00ff80">&nbsp;Subtotal</td>
                                    <td> &nbsp;Rp.<?php echo number_format($perkalian); ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#00ff80">&nbsp;Trade Discount&nbsp;</td>
                                    <td> &nbsp;Rp.0,00</td>
                                </tr>
                                 <tr>
                                    <td bgcolor="#00ff80">&nbsp;Freight</td>
                                    <td>&nbsp;Rp.0,00 </td>
                                </tr>
                               <tr>
                                    <td bgcolor="#00ff80">&nbsp;Miscellaneous</td>
                                    <td>&nbsp;Rp.0,00</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#00ff80">&nbsp;Tax</td>
                                    <td>&nbsp;Rp.150.000,00&nbsp; </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#00ff80">&nbsp;Order Total </td>
                                    <td>&nbsp;Rp.1.650.000,00 &nbsp;</td>
                                </tr>
                            </table>
                        </div>

                           
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                                                 

                            <hr width="25%" align="left" color="black">
                            <caption> Kepala Divisi PPI</caption>
                        

                       
                         <div class="col-md-12">
                          <br>
                        
                            <caption> PT.PERMODALAN NASIONAL MADANI (PERSERO)</caption>
                         </div>

                          <div class="col-md-12">
                            <caption> Kantor Pusat : Menara Taspen Lt.1,2,6,7,10,13 Jl.Jend.Sudirman Kav.2-Jakarta 10220 Indonesia Telp. (62-21)2511405 Email : madani@pnm.co.id http://www.pnm.co.id</caption>
                         </div>
            </div>
        </div>
    </div>
    <!-- END VALIDATION STATES-->

</div>




<script>
    window.print();
</script> 