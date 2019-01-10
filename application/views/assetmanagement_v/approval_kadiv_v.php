<!-- BEGIN PAGE BREADCRUMB --> 

   <style type="text/css">

table#idTabeldetail th:nth-child(2){
    display: none;
} 
table#idTabeldetail td:nth-child(2){
    display: none;
}
</style>

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>


            </div>
            <div class="portlet-body">
       <!--         <ul class="nav nav-pills">
                   <li class="linav active" id="linav1">
                       <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                       Data Asset List </a>
                   </li>

                      <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                        Data Daftar Pengajuan</a>
                    </li>

               </ul> -->
               <div class="tab-content">
                <div class="tab-pane fade active in" id="tab_2_1">
                    <div class="scroller" style="height:400px; ">
                        <div class="row">
                            <div class="col-md-12">
                                <button id="id_Reload" style="display: none;"></button>
                            </div>
                        </div>
</br>

                        <div class="row">
                    <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow-lemon">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                         <?php 
                            $sql_jml_pengajuan = $this->global_m->tampil_data("SELECT COUNT(*) as tot_jml_pengajuan 
                                                                FROM TBL_T_ASSETS_PENJUALAN 
                                                                WHERE STATUS=1");
                        ?>
                            <label id="id_request" style="font-size: 50px;"><?=$sql_jml_pengajuan[0]->tot_jml_pengajuan?></label>
                        </div>
                       
                        <div class="desc">
                           
                            Jumlah Pengajuan
                        </div>
                    </div>
                </div>
            </div>
            
                <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <?php 
                            $sql_jml_approved = $this->global_m->tampil_data("SELECT COUNT(*) as tot_approved 
                                                                FROM TBL_T_ASSETS_PENJUALAN 
                                                                WHERE STATUS=1");

                       ?>
                            <label id="id_request" style="font-size: 50px;"><?=$sql_jml_approved[0]->tot_approved?></label>
                        </div>
                        <div class="desc">
                            Pengajuan Approve
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php 
                            $sql_jml_reject = $this->global_m->tampil_data("SELECT COUNT(*) as tot_approved 
                                                                FROM TBL_T_ASSETS_PENJUALAN 
                                                                WHERE STATUS=2");
                           
                            ?>
                            <label id="id_request" style="font-size: 50px;"><?=$sql_jml_reject[0]->tot_approved?></label>
                        </div>
                        <div class="desc">
                            Pengajuan Reject
                        </div>
                    </div>
                </div>
            </div>

        </br>
            </div>

        <hr>
               
<!--                 <div class="row">

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label col-sm-4">Mulai</label>
        <div class="col-sm-8">
            <input id="id_MasaBerlakuTDP" class="form-control 
            date-picker input-sm cls_tglhariini" name="MasaBerlakuTDP" value="<?php echo date("d-m-Y") ?>" autocomplete="off" data-date-format="dd-mm-yyyy"
            type="text" placeholder="dd-mm-yyyy"/>
        </div>
    </div>
</div>


<div class="col-md-4">
    <div class="form-group">
        <label class="control-label col-sm-4">Sampai</label>
        <div class="col-sm-8">
            <input id="id_MasaBerlakuTDP" class="form-control 
            date-picker input-sm cls_tglhariini" name="MasaBerlakuTDP" value="<?php echo date("d-m-Y") ?>" autocomplete="off" data-date-format="dd-mm-yyyy"
            type="text" placeholder="dd-mm-yyyy"/>
        </div>
    </div>
</div>

 <button type="button"  class="btn btn-success" id="reqsave" onclick="getsavekerusakan()" name="reqsave" value="Submit" >Process</button>
             </div> -->

             

          <div class="row">
          

                    <div class="col-md-12">

                                <table class="table table-striped table-bordered table-hover text_kanan" id="table_approval">
                                    <thead>
                                        <tr>
                                    <th>NO</th>     
                                    <th>ID Pengajuan</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama PIC</th>
                                    <th>Jumlah Item</th>
                                    <th>Wilayah Balai Lelang</th>
                                    <!-- <th>Harga Perkiraan</th> -->
                                    <th>Status</th>
                                    
                                    <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>

                         </div>   



                    <div class="tab-pane fade" id="tab_2_2">
        <div class="row">
        <input type="hidden" class="form-control" name="src" id="src"/>
        <div class="col-md-12" id="table_outReq">

            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="table_asset" >
                <thead>
                    <tr>
                        <th>NO</th>     
                        <th>ID Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Nama PIC</th>
                        <th>Jumlah Item</th>
                        <th>Wilayah Balai Lelang</th>
                        <th>Harga Perkiraan</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>


                </tbody>
                <tfoot>


                </tfoot>
            </table>
        </div>
        <!-- end col-12 -->
    </div>
</div>
    <!-- end col-12 -->
                </div>
                <!-- END ROW-->
            </div>
        </div>
    </div>    
</div>
</div>
</div>
<!-- END VALIDATION STATES-->
</div>
</div>
<!-- END PAGE CONTENT-->

<!-- Modal Depresiasi-->

<div class="modal fade draggable-modal" id="mdl_detail_pengajuan" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Detail Pegajuan</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadBarang" style="display: none;"></button>
                        </div>
                    </div>

                    <div class="row">

                     <div class="col-md-6" style="display: none">
                         <label>ID</label>
                         <td>:</td>
                         <label id="ID"></label>
                     </div>

                     <div class="col-md-6">
                         <label>Tanggal Pengajuan</label>
                         <td>:</td>
                         <label id="id_TANGGAL"></label>
                     </div> 

                     <div class="col-md-6">
                         
                         <label>ID Pengajuan</label>
                         <td>:</td>
                         <label id="id_pengajuan"></label>
                     </div>
                     </div>

                     <div class="row">
                       <div class="col-md-6">
                         <label>Nama PIC</label>
                         <td>:</td>
                         <label id="id_PIC"></label>
                           </div>

                           <div class="col-md-6">
                         <label>Wilayah Balai Lelang</label>
                         <td>:</td>
                         <label id="id_WIL_BALAI_LELANG"></label>
                     </div>
                                           
                     </div>

                      <div class="row">
                      
                           <div class="col-md-6">
                         <label>Jumlah Item</label>
                         <td>:</td>
                         <label id="id_JML_ITEM"></label>
                     </div>                      
                        </div> 
                     <hr>
                        <h4>List Asset Jual</h4>
                     <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabeldetail">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>ID</th>
                                            <th>Zona</th>
                                            <th>Branch</th>
                                            <th>Nama Asset</th>
                                            <th>Fix Asset ID</th>
                                            <th>Kondisi Asset</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>

                            </div>
                      
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                  <button type="button"  class="btn btn-success" id="reqsave" onclick="getsaveapprove()" name="reqsave" value="Submit" >Approve</button>

                <button type="button" class="btn default" onclick="getsavereject()" id="btnCloseModalDataBarang">Reject</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>  







<div class="modal fade draggable-modal" id="mdl_kehilangan" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">KEHILANGAN</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadBarang" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelkehilangan">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Fix Asset ID</th>
                                            <th>Item Name</th>
                                            <th>QR Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>

                            </div>
                        </br>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Tanggal Kehilangan</label>
                                    <div class="col-sm-8">
                                        <input id="id_TANGGAL" class="form-control 
                                        date-picker input-sm cls_tglhariini" name="id_TANGGAL" value="<?php echo date("d-m-Y") ?>" autocomplete="off" data-date-format="dd-mm-yyyy"
                                        type="text" placeholder="dd-mm-yyyy"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                  <button type="button"  class="btn btn-success" id="reqsave" onclick="getsavekehilangan()" name="reqsave" value="Submit" >Save</button> 
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataBarang">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>    



<div class="modal fade draggable-modal" id="mdl_kerusakan" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">KERUSAKAN</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadBarang" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelkerusakan">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Fix Asset ID</th>
                                            <th>Item Name</th>
                                            <th>QR Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>

                            </div>
                        </br>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Tanggal Kerusakan</label>
                                    <div class="col-sm-8">
                                        <input id="id_TANGGAL" class="form-control 
                                        date-picker input-sm cls_tglhariini" name="id_TANGGAL" value="<?php echo date("d-m-Y") ?>" autocomplete="off" data-date-format="dd-mm-yyyy"
                                        type="text" placeholder="dd-mm-yyyy"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                  <button type="button"  class="btn btn-success" id="reqsave" onclick="getsavekerusakan()" name="reqsave" value="Submit" >Save</button> 
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataBarang">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>  


<div class="modal fade draggable-modal" id="mdl_pengajuan" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">PENGAJUAN</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadBarang" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelpengajuan">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Zona</th>
                                            <th>Branch</th>
                                            <th>Unit</th>
                                            <th>Nama Asset</th>
                                            <th>Fix Asset ID</th>
                                            <th>Kondisi Asset</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>

                            </div>
                        </br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Tanggal Pengajuan</label>
                                    <div class="col-sm-8">
                                        <input id="id_TGL_PENGAJUAN" class="form-control 
                                        date-picker input-sm cls_tglhariini" name="id_TGL_PENGAJUAN" value="<?php echo date("d-m-Y") ?>" autocomplete="off" data-date-format="dd-mm-yyyy"
                                        type="text" placeholder="dd-mm-yyyy"/>
                                        <!-- <input type="text" style="display: none; class="form-control" id="ID_ASSET" name="iID_ASSET"> -->
                                    </div>
                                </div>
                            </div>

                                 <div class="col-md-6">
                            <div class="form-group">
                <label class="control-label col-sm-4">Nama PIC</label>
                <div class="col-sm-8">
                 <input type="text" class="form-control" id="id_PIC" name="id_PIC">
             </div>
         </div>
     </div>
 </div>

</br>
                          <div class="row">   

                           <div class="col-md-6">
                            <div class="form-group">
                <label class="control-label col-sm-4">Jumlah Item</label>
                <div class="col-sm-8">
                 <input type="text" class="form-control" id="id_JML_ITEM" name="id_JML_ITEM">
             </div>
         </div>
     </div>

                           <div class="col-md-6">
                            <div class="form-group">
                    <label class="control-label col-sm-4">Wilayah Balai Lelang</label>
                <div class="col-sm-8">
                 <input type="text" class="form-control" id="id_WIL_BALAI_LELANG" name="id_WIL_BALAI_LELANG">
             </div>
         </div>
     </div>

 </div>

                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                  <button type="button"  class="btn btn-success" id="reqsave" onclick="getsavepengajuan()" name="reqsave" value="Submit" >Save</button> 
                    
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataBarang">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>  








<div class="modal fade draggable-modal" id="mdl_depresiasi" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Depresiasi</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadBarang" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelreclass">
                                    <thead>
                                        <tr>
                                            <th>
                                                NO
                                            </th>

                                            <th>
                                                Bulan
                                            </th>
                                            <th>
                                                Nilai Depresiasi
                                            </th>
                                            <th>
                                                Sisa Buku
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataBarang">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="modal fade draggable-modal" id="mdl_adjustman" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Adjustman</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadBarang" style="display: none;"></button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabeladjustman">
                                    <thead>
                                        <tr>
                                            <th>
                                                ASSET NUMBERS
                                            </th>
                                            <th>
                                             ADJUSTED COST
                                         </th>
                                               <!--  <th>
                                                   SALVAGE VALUE
                                               </th> -->
                                               <th>
                                                 LIFE YEARS
                                             </th>

                                         </tr>
                                     </thead>
                                     <tbody id="id_row_adjustman">

                                     </tbody>
                                     <tfoot>

                                     </tfoot>
                                 </table>

                             </div>
                         </div>

                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-sm-4">ADJUSTED COST</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control" id="id_VendorAlias" name="VendorAlias" autocomplete="off">
                               </div>
                           </div>
                       </div>
                       <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-sm-4">SALVAGE VALUE</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control" id="id_VendorAlias" name="VendorAlias" autocomplete="off">
                           </div>
                       </div>
                   </div>

                   <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-sm-4">LIFE YEARS</label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" id="id_VendorAlias" name="VendorAlias autocomplete="off"">
                       </div>
                   </div>
               </div>
           </div>

           <!-- END ROW-->
       </div>
       <!-- END SCROLLER-->
   </div>
   <!-- END MODAL BODY-->

   <div class="modal-footer">
    <button type="button" class="btn green-jungle" onclick="processtransfer()" data-dismiss="modal"><i class="fa fa-check"></i> Process</button>
    <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataBarang">Close</button>
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>




<div class="modal fade draggable-modal" id="mdl_reclass" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Reclass</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadBarang" style="display: none;"></button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idtablereclass">
                                    <thead>
                                        <tr>
                                            <th>
                                                ASSET NUMBERS
                                            </th>
                                            <th>
                                             ADJUSTED COST
                                         </th>
                                               <!--  <th>
                                                   SALVAGE VALUE
                                               </th> -->
                                               <th>
                                                 LIFE YEARS
                                             </th>

                                         </tr>
                                     </thead>
                                     <tbody id="id_row_adjustman">

                                     </tbody>
                                     <tfoot>

                                     </tfoot>
                                 </table>

                             </div>
                         </div>

                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-sm-4">ADJUSTED COST</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control" id="id_VendorAlias" name="VendorAlias" autocomplete="off">
                               </div>
                           </div>
                       </div>
                       <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-sm-4">SALVAGE VALUE</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control" id="id_VendorAlias" name="VendorAlias" autocomplete="off">
                           </div>
                       </div>
                   </div>

                   <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-sm-4">LIFE YEARS</label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" id="id_VendorAlias" name="VendorAlias autocomplete="off"">
                       </div>
                   </div>
               </div>
           </div>

           <!-- END ROW-->
       </div>
       <!-- END SCROLLER-->
   </div>
   <!-- END MODAL BODY-->

   <div class="modal-footer">
    <button type="button" class="btn green-jungle" onclick="processtransfer()" data-dismiss="modal"><i class="fa fa-check"></i> Process</button>
    <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataBarang">Close</button>
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>


<!-- /. end modal-dialog -->



<div class="modal fade draggable-modal" id="mdl_fam" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <input type="hidden" class="form-control" id="txtRaw_ID" >
                <div class="validator-form form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Vendor Type ID</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="txtVendorTypeID">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Vendor Type Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="txtVendorTypeName">
                        </div>
                    </div>      

                    <div class="form-group status">
                        <label class="control-label col-sm-3">Status</label>
                        <div class="col-sm-3">
                            <select id="statustypeAdd" name="statustypeAdd" onchange="statusAdd(this.value)" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Non-Active</option>
                            </select>
                        </div>
                    </div>          
                </div>

                <div class="modal-footer">
                    <div class="btnSC">
                        <button type="button" class="btn btn-success save" onclick="clickUpdate('add')">Save</button>
                        <button type="button" class="btn btn-success update" onclick="clickUpdate('update')">Update</button>
                        <button type="button" class="btn btn-warning close_" data-dismiss="modal">Close</button>                
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>






<div class="modal fade draggable-modal" id="mdl_Update" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <input type="hidden" class="form-control" id="txtRaw_ID" >
                <div class="validator-form form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Vendor Type ID</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="txtVendorTypeID">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Vendor Type Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="txtVendorTypeName">
                        </div>
                    </div>      

                    <div class="form-group status">
                        <label class="control-label col-sm-3">Status</label>
                        <div class="col-sm-3">
                            <select id="statustypeAdd" name="statustypeAdd" onchange="statusAdd(this.value)" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Non-Active</option>
                            </select>
                        </div>
                    </div>          
                </div>

                <div class="modal-footer">
                    <div class="btnSC">
                        <button type="button" class="btn btn-success save" onclick="clickUpdate('add')">Save</button>
                        <button type="button" class="btn btn-success update" onclick="clickUpdate('update')">Update</button>
                        <button type="button" class="btn btn-warning close_" data-dismiss="modal">Close</button>                
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('app.min.inc.php'); ?>

<script>




    var dataTable, dataTable1;
    var iStatusAdd = '1';
    var iStatus = '%';
    var iSearch = '%';

    $("#btnAdd").click(function () {
        $('#mdl_Update').find('.modal-title').text('Add');
        $("#txtRaw_ID").val("Generate");
        $("#txtVendorTypeID").val("");
        $("#txtVendorTypeName").val("");



        document.getElementById("txtVendorTypeID").readOnly = true;
        document.getElementById("txtVendorTypeName").readOnly = false;

        $(".btnSC").show();
        $(".btnSC .save").show();
        $(".btnSC .update").hide();
        $(".btnSC .close_").show();
        $(".status").hide();
    });
    function statusAdd(e) {
        iStatusAdd = e;
    }
    function search(e) {
        iSearch = e;
    }
    function status(e) {
        iStatus = e;
        $('#table_gridCategory').DataTable().ajax.reload();
    }



    

    $('#table_gridCategory').on('click', '#btnAktiv', function () {
        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();

        var i_clsUpdate = {
            Raw_ID: idata[1],
            name: idata[3],
            Status: 1
        }
        bootbox.confirm("Apakah anda yakin meng-aktifkan data " + idata[3] + "?", function (o) {
            if (o == true) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    dataType: "JSON",
                    url: "<?php echo base_url("/master/master_vendortype/ajax_UpdateStatusCategory"); ?>", // json datasource
                    data: {sTbl: i_clsUpdate},
                    success: function (e) {
                        // console.log(e);
                        if (e.msgType == true) {
                            bootbox.alert({
                                message: e.msg,
                                backdrop: true
                            });
                            $('#mdl_Update').modal('hide');
                            $('#table_gridCategory').DataTable().ajax.reload();
                        } else {
                            alert(e.msgTitle);
                        }
                    }
                });
            }
        });
    });


    $('#table_gridCategory').on('click', '#btnDeactivate', function () {
        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();

        var i_clsUpdate = {
            Raw_ID: idata[1],
            Status: 0
        }
        bootbox.confirm("Apakah anda yakin meng-nonaktifkan data " + idata[3] + "?", function (o) {
            if (o == true) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    dataType: "JSON",
                    url: "<?php echo base_url("/master/master_vendortype/ajax_UpdateStatusCategory"); ?>", // json datasource
                    data: {sTbl: i_clsUpdate},
                    success: function (e) {
                        // console.log(e);
                        if (e.msgType == true) {
                            bootbox.alert({
                                message: e.msg,
                                backdrop: true
                            });
                            $('#mdl_Update').modal('hide');
                            $('#table_gridCategory').DataTable().ajax.reload();
                        } else {
                            alert(e.msgTitle);
                        }
                    }
                });
            }
        });
    });


    function sys_kotalocation(){

       $.ajax({
        type: "POST",
        url: "<?php echo site_url('master/kota_location/getfamlocation'); ?>",
        // data: form.serialize(), // <--- THIS IS THE CHANGE
        dataType: "JSON",
        success: function(data){
           $('#table_gridCategory').DataTable().ajax.reload();
       },
       error: function() { alert("Error posting feed."); }
   });

   }

   



   jQuery(document).ready(function () {

    getfamlocation();
    getfamku();
    getfamasset();
    getfamkerusakan();
    getfamdata();
    // getfamdataapproval();
    getfamdetail_pengajuan();

});


   function asset_fam(data,id){

    // ajaxModal();
    // $('#mdl_depresiasi').modal('show');
    // $('#mdl_adjustman').modal('show');

    if (data == 'Depresiasi') { 
        $('#mdl_depresiasi').modal('show');
        $('#mdl_adjustman').modal('hide');
    }else if(data == 'Adjustman'){
        $('#mdl_depresiasi').modal('hide');
        $('#mdl_adjustman').modal('show');
    }else{
      $('#mdl_depresiasi').modal('hide');
      $('#mdl_adjustman').modal('hide');
  }

}




function getfamasset(){
 $.ajax({
    type: "POST",
    cache: false,
    dataType: "JSON",
                    url: "<?php echo base_url("/assetmanagement/assetlist/get_server_adjustman"); ?>", // json datasource
                    data: {sid: 100000},
                    success: function (e) {
                        console.log('tes',e);
                        $('#id_row_adjustman').empty();

                        $('#id_row_adjustman').html(e);
                        // if (e.msgType == true) {
                        //     bootbox.alert({
                        //         message: e.msg,
                        //         backdrop: true
                        //     });
                        //     $('#mdl_Update').modal('hide');
                        //     $('#table_gridCategory').DataTable().ajax.reload();
                        // } else {
                        //     alert(e.msgTitle);
                        // }
                    }
                });
}





//  function detail_pengajuanassetfam(idatatables) {
//     alert(idatatables);

//     var i_clsUpdate = {
//         id_TGL_PENGAJUAN: $("#id_TGL_PENGAJUAN").val(),
//         id_PIC : $("#id_PIC").val(),
//         id_JML_ITEM : $("#id_JML_ITEM").val(),
//         id_WIL_BALAI_LELANG : $("#id_WIL_BALAI_LELANG").val(),
//         ID_ASSET :iID_ASSET,
    
//     }

//     $.ajax({
//         type: "POST",
//         cache: false,
//         data : {sTbl: i_clsUpdate},
//         dataType: "JSON",
//         url: "<?php echo base_url("/assetmanagement/approval_kabag/datadetail"); ?>", // json datasource
//         success: function (e) {
//          // location.reload();
//          if(e.act){
//             UIToastr.init(e.tipePesan, e.pesan);
//             iPID=e.iPid;
//             $("#").trigger('click');
//             ID_ASSET ='';
            
//         }else{
//             UIToastr.init(e.tipePesan, e.pesan);
//         }
        
//     },
   
//         });
// }

 function getsavereject() {

console.log($("#ID").text());
    $.ajax({
        type: "POST",
        cache: false,
        data : {ID : $("#ID").text()},
        dataType: "JSON",
        url: "<?php echo base_url("/assetmanagement/approval_kadiv/rejectdata"); ?>", // json datasource
        success: function (e) {
         // location.reload();
         if(e.act){
            UIToastr.init(e.tipePesan, e.pesan);
            iPID=e.iPid;
            $("#").trigger('click');
            ID_ASSET ='';
            $('#mdl_detail_pengajuan').modal('hide');
            $('#table_approval').DataTable().ajax.reload();

        }else{
            UIToastr.init(e.tipePesan, e.pesan);
        }
        
    },
    complate:function(){
                // $('#table_asset').DataTable().ajax.reload();
                // $('#table_asset_transfer').DataTable().ajax.reload();
                // $('#table_gridItemProcess').DataTable().ajax.reload();
                // $('#idTabelBarang').DataTable().ajax.reload();
            }
        });
}




 function getsaveapprove() {

console.log($("#ID").text());
    $.ajax({
        type: "POST",
        cache: false,
        data : {ID : $("#ID").text()},
        dataType: "JSON",
        url: "<?php echo base_url("/assetmanagement/approval_kadiv/approvedata"); ?>", // json datasource
        success: function (e) {
         // location.reload();
         if(e.act){
            UIToastr.init(e.tipePesan, e.pesan);
            iPID=e.iPid;
            $("#").trigger('click');
            ID_ASSET ='';
            $('#mdl_detail_pengajuan').modal('hide');
            $('#table_approval').DataTable().ajax.reload();

        }else{
            UIToastr.init(e.tipePesan, e.pesan);
        }
        
    },
    complate:function(){
                // $('#table_asset').DataTable().ajax.reload();
                // $('#table_asset_transfer').DataTable().ajax.reload();
                // $('#table_gridItemProcess').DataTable().ajax.reload();
                // $('#idTabelBarang').DataTable().ajax.reload();
            }
        });
}






 function getsavekehilangan() {
    var i_clsUpdate = {
        ID_ASSET : iID_ASSET,
        id_TANGGAL: $("#id_TANGGAL").val(),
    
    }


    $.ajax({
        type: "POST",
        cache: false,
        data : {sTbl: i_clsUpdate},
        dataType: "JSON",
        url: "<?php echo base_url("/assetmanagement/assetlist/savedata"); ?>", // json datasource
        success: function (e) {
         // location.reload();
         if(e.act){
            UIToastr.init(e.tipePesan, e.pesan);
            iPID=e.iPid;
            $("#").trigger('click');
            ID_ASSET ='';

            

        }else{
            UIToastr.init(e.tipePesan, e.pesan);
        }
        
    },
    complate:function(){
                // $('#table_asset').DataTable().ajax.reload();
                // $('#table_asset_transfer').DataTable().ajax.reload();
                // $('#table_gridItemProcess').DataTable().ajax.reload();
                // $('#idTabelBarang').DataTable().ajax.reload();
            }
        });
}



 function getsavepengajuan() {
    var i_clsUpdate = {
        // ID_ASSET : iID_ASSET,
        id_TGL_PENGAJUAN: $("#id_TGL_PENGAJUAN").val(),
        id_PIC : $("#id_PIC").val(),
        id_JML_ITEM : $("#id_JML_ITEM").val(),
        id_WIL_BALAI_LELANG : $("#id_WIL_BALAI_LELANG").val(),
        ID_ASSET :iID_ASSET,
    
    }

    $.ajax({
        type: "POST",
        cache: false,
        data : {sTbl: i_clsUpdate},
        dataType: "JSON",
        url: "<?php echo base_url("/assetmanagement/assetlist/savedatapengajuan"); ?>", // json datasource
        success: function (e) {
         // location.reload();
         if(e.act){
            UIToastr.init(e.tipePesan, e.pesan);
            iPID=e.iPid;
            $("#").trigger('click');
            ID_ASSET ='';

        }else{
            UIToastr.init(e.tipePesan, e.pesan);
        }
        
    },
    complate:function(){
                // $('#table_asset').DataTable().ajax.reload();
                // $('#table_asset_transfer').DataTable().ajax.reload();
                // $('#table_gridItemProcess').DataTable().ajax.reload();
                // $('#idTabelBarang').DataTable().ajax.reload();
            }
        });
}



 function getsavekerusakan() {
    var i_clsUpdate = {
        ID_ASSET : iID_ASSET,
        id_TANGGAL: $("#id_TANGGAL").val(),
    
    }


    $.ajax({
        type: "POST",
        cache: false,
        data : {sTbl: i_clsUpdate},
        dataType: "JSON",
        url: "<?php echo base_url("/assetmanagement/assetlist/savedatakerusakan"); ?>", // json datasource
        success: function (e) {
         // location.reload();
         if(e.act){
            UIToastr.init(e.tipePesan, e.pesan);
            iPID=e.iPid;
            $("#").trigger('click');
            ID_ASSET ='';

            

        }else{
            UIToastr.init(e.tipePesan, e.pesan);
        }
        
    },
    complate:function(){
                // $('#table_asset').DataTable().ajax.reload();
                // $('#table_asset_transfer').DataTable().ajax.reload();
                // $('#table_gridItemProcess').DataTable().ajax.reload();
                // $('#idTabelBarang').DataTable().ajax.reload();
            }
        });
}






function getfamasset(){
 $.ajax({
    type: "POST",
    cache: false,
    dataType: "JSON",
                    url: "<?php echo base_url("/assetmanagement/assetlist/get_server_adjustman"); ?>", // json datasource
                    data: {sid: 100000},
                    success: function (e) {
                        console.log('tes',e);
                        $('#id_row_adjustman').empty();

                        $('#id_row_adjustman').html(e);
                        // if (e.msgType == true) {
                        //     bootbox.alert({
                        //         message: e.msg,
                        //         backdrop: true
                        //     });
                        //     $('#mdl_Update').modal('hide');
                        //     $('#table_gridCategory').DataTable().ajax.reload();
                        // } else {
                        //     alert(e.msgTitle);
                        // }
                    }
                });
}


function clickUpdate() {
    var i_clsUpdate = {
        Raw_ID: $("#txtRaw_ID").val(),
        VendorTypeID: $("#txtVendorTypeID").val(),
        VendorTypeName: $("#txtVendorTypeName").val(),
        Status: iStatusAdd
    }
    console.log(i_clsUpdate);

    if ($("#txtVendorTypeName").val() == "") {
        bootbox.alert({
            message: "Required Vendor Type Name",
            backdrop: true
        });
    } else {
        if (status == "add") {
            var message = 'Apakah anda yakin ingin menambahkan data vendor type?';
        } else {
            var message = 'Apakah anda yakin ingin Mengubah data vendor type?';
        }
        bootbox.confirm(message, function (o) {
            if (o == true) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    dataType: "JSON",
                        url: "<?php echo base_url("/master/master_vendortype/ajax_UpdateCategory"); ?>", // json datasource
                        data: {sTbl: i_clsUpdate},
                        success: function (e) {
                            console.log(e);
                            if (e.msgType == true) {
                                bootbox.alert({
                                    message: e.msg,
                                    backdrop: true
                                }); 
                                $('#mdl_Update').modal('hide');
                                $('#table_gridCategory').DataTable().ajax.reload();
                            } else {
                                alert(e.msgTitle);
                            }
                        }
                    });
            }
        });
    }

}

$('#table_gridCategory').on('click', '#btnDetaisdfsdfl', function () {
    $('#mdl_Update').find('.modal-title').text('Detail');

    var iclosestRow = $(this).closest('tr');
    var idata = dataTable.row(iclosestRow).data();
        // console.log(idata);
        $("#txtRaw_ID").val(idata[1]);
        $("#txtVendorTypeID").val(idata[2]);
        $("#txtVendorTypeName").val(idata[3]);


        document.getElementById("txtRaw_ID").readOnly = true;
        document.getElementById("txtVendorTypeID").readOnly = true;
        document.getElementById("txtVendorTypeName").readOnly = true;
        $(".btnSC").hide();
        $(".status").hide();

    });
$('#table_gridCategory').on('click', '#btnUpdate', function () {



    $('#mdl_Update').find('.modal-title').text('Update');
    $('#idTabelkehilangan').DataTable().ajax.reload();
    $('#idTabelkerusakan').DataTable().ajax.reload();
    $('#idTabelpengajuan').DataTable().ajax.reload();
    $('#idTabeldetail').DataTable().ajax.reload();


            // var iclosestRow = $(this).closest('tr');
            // var idata = dataTable.row(iclosestRow).data();
            // // console.log(idata);
            // $("#txtRaw_ID").val(idata[1]);
            // $("#txtVendorTypeID").val(idata[2]);
            // $("#txtVendorTypeName").val(idata[3]);


            // document.getElementById("txtVendorTypeID").readOnly = true;
            // document.getElementById("txtVendorTypeName").readOnly = false;

            // $(".btnSC").show();
            // $(".btnSC .save").hide();
            // $(".btnSC .update").show();
            // $(".btnSC .close_").show();
            // $(".status").hide();

        });



    $('.date-picker').datepicker({
        orientation: "left",
        autoclose: true
    });




function getfamdetail_pengajuan(){
    dataTable = $('#idTabeldetail').DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
            // "order": [[ 0, "asc" ],[6, "desc" ]],
            "columnDefs": [
            {"targets": [-1], "searchable": false, "orderable": false},
                    // {"targets": [1], "visible": false, "searchable": false, "orderable": false},
                    // {"targets": [4], "searchable": false, "orderable": false},
                    ],
                    "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                    ],
    //                // set the initial value
                // "pageLength": 5,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "<?php echo base_url("/assetmanagement/approval_kadiv/get_server_side_detail"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {

                          z.IDetail = IDetail;
                          z.sSearch = iSearch;

                        // z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".idTabeldetail-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#idTabeldetail tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#idTabeldetail_processing").css("display", "none");

                    }
                }
            });
}





function getfamkerusakan(){
    dataTable = $('#idTabelkerusakan').DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
            // "order": [[ 0, "asc" ],[6, "desc" ]],
            "columnDefs": [
            {"targets": [-1], "searchable": false, "orderable": false},
                    // {"targets": [1], "visible": false, "searchable": false, "orderable": false},
                    // {"targets": [4], "searchable": false, "orderable": false},
                    ],
                    "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                    ],
    //                // set the initial value
                // "pageLength": 5,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "<?php echo base_url("/assetmanagement/assetlist/get_server_side_kerusakan"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {

                          z.sID_ASSET = iID_ASSET;
                         z.sSearch = iSearch;

                        // z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".idTabelkerusakan-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#idTabelkerusakan tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#idTabelkerusakan_processing").css("display", "none");

                    }
                }
            });
}







function getfamdata(){
    dataTable = $('#table_asset').DataTable({
            // "order": [[ 0, "asc" ],[6, "desc" ]],
            "columnDefs": [
            {"targets": [-1], "searchable": false, "orderable": false},
            {"targets": [1], "visible": false, "searchable": false, "orderable": false},
            {"targets": [4], "searchable": false, "orderable": false},
            ],
            "lengthMenu": [
            [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                    ],
    //                // set the initial value
    "pageLength": 5,
    "processing": true,
    "serverSide": true,
    "ajax": {
                    url: "<?php echo base_url("/assetmanagement/assetlist/get_datatransfer"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".table_asset-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#table_asset tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#table_asset_processing").css("display", "none");

                    }
                }
            });
}

var IDetail = '';
$('#table_approval tbody').on('click', '#btnDetail', function () {
        // alert('tester');
    // $('#mdl_detail_pengajuan').find('.modal-title').text('Detail');

        var iclosestRow = $(this).closest('tr');
        // var iclosestRow = $(this).children('tr:first');
        var idata = dataTable.row(iclosestRow).data();
        console.log(idata);

        IDetail = idata[1];
        
        $("#ID").text(idata[1])
        $("#id_TANGGAL").text(idata[2]);
        $("#id_PIC").text(idata[3]);
        $("#id_JML_ITEM").text(idata[4]);
        $("#id_WIL_BALAI_LELANG").text(idata[5]);
        $('#idTabeldetail').DataTable().ajax.reload();
    });
    

    jQuery(document).ready(function () {
    dataTable = $('#table_approval').DataTable({
            // "order": [[ 0, "asc" ],[6, "desc" ]],
            "columnDefs": [
            {"targets": [-1], "searchable": false, "orderable": false},
            {"targets": [1], "visible": false, "searchable": false, "orderable": false},
            {"targets": [4], "searchable": false, "orderable": false},
            ],
            "lengthMenu": [
            [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                    ],
    //                // set the initial value
    "pageLength": 5,
    "processing": true,
    "serverSide": true,
    "ajax": {
                    url: "<?php echo base_url("/assetmanagement/approval_kadiv/get_dataapproval"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".table_approval-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#table_approval tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#table_approval_processing").css("display", "none");

                    }
                }
            });
        });



function getfamku(){
    dataTable = $('#idTabelkehilangan').DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
            // "order": [[ 0, "asc" ],[6, "desc" ]],
            "columnDefs": [
            {"targets": [-1], "searchable": false, "orderable": false},
                    // {"targets": [1], "visible": false, "searchable": false, "orderable": false},
                    // {"targets": [4], "searchable": false, "orderable": false},
                    ],
                    "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                    ],
    //                // set the initial value
                // "pageLength": 5,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "<?php echo base_url("/assetmanagement/assetlist/get_server_side_kehilangan"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {

                          z.sID_ASSET = iID_ASSET;
                         z.sSearch = iSearch;

                        // z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".idTabelkehilangan-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#idTabelkehilangan tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#idTabelkehilangan_processing").css("display", "none");

                    }
                }
            });
}



function getfamlocation(){
    dataTable1 = $('#table_gridCategory').DataTable({
            // "order": [[ 0, "asc" ],[6, "desc" ]],
            "columnDefs": [
            {"targets": [-1], "searchable": false, "orderable": false},
            {"targets": [1], "visible": false, "searchable": false, "orderable": false},
            {"targets": [4], "searchable": false, "orderable": false},
            {"targets": [2], "checkboxes": {"selectRow": true}},

            ],
            "select": {"style": "multi"},
            "lengthMenu": [
            [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                    ],
    //                // set the initial value
    "pageLength": 5,
    "processing": true,
    "serverSide": true,
    "ajax": {
                    url: "<?php echo base_url("/assetmanagement/assetlist/get_server_side"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".table_gridCategory-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#table_gridCategory tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#table_gridCategory_processing").css("display", "none");

                    }
                }
            });
}


var iID_ASSET ='';

    function processtransferkehilangan(){

        
      var rows_selected = dataTable1.column(2).checkboxes.selected();

      iID_ASSET =iID_ASSET + rows_selected.join(",");
      console.log(iID_ASSET);

      // alert(iID_ASSET);
      $('#idTabelkehilangan').DataTable().ajax.reload();


  }



    function processtransferkerusakan(){

        
      var rows_selected = dataTable1.column(2).checkboxes.selected();

      iID_ASSET =iID_ASSET + rows_selected.join(",");
      console.log(iID_ASSET);

      // alert(iID_ASSET);
      $('#idTabelkerusakan').DataTable().ajax.reload();


  }



    function processpengajuan(){

        
      var rows_selected = dataTable1.column(2).checkboxes.selected();

      iID_ASSET =iID_ASSET + rows_selected.join(",");
      console.log(iID_ASSET);

      // alert(iID_ASSET);
      $('#idTabelpengajuan').DataTable().ajax.reload();


  }





btnStart();
$("#id_userName").focus();
$("#id_showPassword").click(function () {
    if ($('#id_chckshowPassword').is(':checked')) {
        $('.clsPasswd').attr('type', 'text');
    } else {
        $('.clsPasswd').attr('type', 'password');
    }
});
$("#id_btnSimpan").click(function () {
    $('#idTmpAksiBtn').val('1');
    var passwd = $('#id_kataKunci').val();
    var confPasswd = $('#id_confKataKunci').val();
    if (passwd == confPasswd) {
        return true;
    } else {
        alert("Password dan konfirmasi password tidak sama.");
        $("#id_password").focus();
        return false;
    }
});

$('#id_btnBatal').click(function () {
    btnStart();
});

$("#id_btnSimpan").click(function () {
    $('#idTmpAksiBtn').val('1');
    bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
        if (o == true) {
            $('#idFormUser').submit();
        }
    });

});
$("#id_btnUbah").click(function () {
    $('#idTmpAksiBtn').val('2');
    bootbox.confirm("Apakah anda yakin mengubah data ini?", function (o) {
        if (o == true) {
            $('#idFormUser').submit();
        }
    });

});

$("#id_btnHapus").click(function () {
    $('#idTmpAksiBtn').val('3');
    bootbox.confirm("Apakah anda yakin menghapus data ini?", function (o) {
        if (o == true) {
            $('#idFormUser').submit();
        }
    });

});








</script>


<!-- END JAVASCRIPTS