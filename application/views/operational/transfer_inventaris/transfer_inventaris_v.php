
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-body">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase"><?php echo $menu_header; ?></span>
                    </div>
                    <div class="portlet-body">
                        <ul class="nav nav-pills">
                            <li class="linav active" id="linav1">
                                <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                                    Transfer </a>
                            </li>
                            <li class="linav" id="linav2">
                                <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                                    Data Transfer </a>
                            </li>
                            <li class="linav" id="linav2">
                                <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">
                                    Terima Transfer </a>
                            </li>
                        </ul>     
                        <div class="tab-content"> 
                            <div class="tab-pane fade active in" id="tab_2_1">
                                <form role="form" method="post" class="cls_from_sec_room" 
                                      id="id_formRoom_flow"  enctype="multipart/form-data" > 
                                    <div class="scroller" style="height:810px; ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button id="id_Reload" style="display: none;"></button>
                                            </div>
                                        </div>   
                                       <div class="col-md-12">
                                <div class="dataTables_filter">
                            <div class="row">
                        <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Branch:</label><br><input type="text" name="cari" id='cari' class="form-control input-small input-inline" placeholder="" onblur="pageLoad(1)" onkeypress='handle2(event)'>            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Divisi:</label><br> <input type="text" name="cari" id='cari' class="form-control input-small input-inline" placeholder="" onblur="pageLoad(1)" onkeypress='handle2(event)'>
                            
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Tujuan Transfer:</label><br> <input type="text" name="cari" id='cari' class="form-control input-small input-inline" placeholder="" onblur="pageLoad(1)" onkeypress='handle2(event)'>
                            
                        </div>
                    </div>
                </div>
             </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                        <div class="form-group">
                        <label> Tanggal Pengiriman:</label><br> <input type="text" name="cari" id='cari' class="form-control input-small input-inline" placeholder="" onblur="pageLoad(1)" onkeypress='handle2(event)'>          
                </div>
            </div>
        <div class="col-md-4">
            <div class="form-group">
                 <label> Nama Pengirim: </label><br> <input type="text" name="cari" id='cari' class="form-control input-small input-inline" placeholder="" onblur="pageLoad(1)" onkeypress='handle2(event)'>
           
        </div>
    </div> 
        <div class="col-md-4">
            <div class="form-group">
                <label> Resi:</label><br> <input type="text" name="cari" id='cari' class="form-control input-small input-inline" placeholder="" onblur="pageLoad(1)" onkeypress='handle2(event)'>&nbsp;&nbsp; <button class="btn btn-primary">&nbsp;Pilih&nbsp;</button>


                    
                        </div>
                    </div>
                </div>
             </div>  

            <div class="col-md-6">
                <div class="form-group">
                    <label> Jumlan Inventaris Transfer :</label><br>
                    <input class="form-control input-inline" type="text" name="" id="">&nbsp;&nbsp; <button class="btn btn-sm btn-primary">Pilih Inventaris</button>
                </div>
            </div>
</div>
</div>
        <!-- End -->

                                        <!--END ROW 1 -->
                                </form>    


                                <div class="col-md-12">&nbsp;</div>

                                <!--       <div class="col-sm-4">
                                          <div class="form-group" id="displaydivisi">
                                              <label class="control-label col-sm-4">Zone Name</label>
                                              <div class="col-sm-7">
                                                  <div id="ddZone3"></div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-2">Search Param :</div>
                                      <div class="col-md-2">
                                          <select id="cat_itemclass" name="cat_itemclass" onchange="search(this.value)" class="form-control">
                                              <option value="ItemName">Item Name</option>
                                              <option value="ZoneName">Zone</option>
                                          </select>
                                      </div> -->


                                         <div class="col-md-12">

                                     <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridflow">
                                        <thead>
                                            <tr>
                                                <th class='row-2'>Zona</th>     
                                                <th class='row-md-3'>Branch Divisi</th>
                                                <th class='row-md-3'>Unit </th>
                                                <th class='row-md-6'>Tanggal Pengakuan Inventaris</th>
                                                <th class='row-md-5'>Inventaris ID</th>
                                                <th class='row-md-3'>Nama Inventaris</th>
                                                <th class='row-md-3'>Kode QR</th>
                                     
                                                  <!-- <th>Opsi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-sm btn-primary">TRANSFER</button>
                                        </div>
                                    </div>
                            </div>
                            
                                <!-- end col-12 -->                   
                                <!-- END ROW-->
                                </form>
                            </div>
                        </div>
                        <!--=================================================== GROUP =========================================================-->
                        <div class="tab-pane fade active" id="tab_2_2">
                            <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom_grup"  enctype="multipart/form-data" > 
                                <div class="scroller" style="height:810px; ">
                                    <div class="scroller" style="height:810px; ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button id="id_Reload" style="display: none;"></button>
                                            </div>
                                        </div>   
                                        <div class="row">
                                            <input class="form-control hidden" type="text" id="id_data" name="id_data"/>
                                            <!-- HIDDEN INPUT -->
                                            <div class="form-body">
                                        <div class="row">
                                        <div class="col-md-12">
                                    <div class="col-md-6">
                                <div class="form-group">
                            <label> Search:</label> <br>
                            <label>
                                <select name='limit' id='limit' class="form-control col-sm-4 col-md-4 col" onchange='pageLoad(1)'>
                                    <option value='5' >-SELECT-</option>
                                    <option value='10' >TEST</option>
                                    <option value='25' >TEST </option>
                                </select>

                            </label>
                            <br>
                             <input type="text" name="cari" id='cari' class="form-control input-small input-inline" placeholder="" onblur="pageLoad(1)" onkeypress='handle2(event)'> 
                                   </div>
                                         <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-actions">
                                                        <button name="btnSimpan" target="_blank" class="btn blue" id="id_btnSimpan">
                                                            <!--<i class="fa fa-check"></i>--> Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                  </div>
                             </div> 
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->
                            </div>
                                </div>
                                    <div class="col-md-12">&nbsp;</div>
                                        <div class="col-md-12">
                                            <div class="col-md-12">&nbsp;</div>
                                         <br>
                                     <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridgroup">
                            <thead>
                                <tr>
                                    <th class='row-2'>ID TRansfer</th>     
                                    <th class='row-md-3'>Branch</th>
                                    <th class='row-md-3'>Divisi</th>
                                    <th class='row-md-6'>Jumlah Aset Inventaris</th>
                                    <th class='row-md-5'>Tujuan Transfer</th>
                                    <th class='row-md-3'>Tanggal Pengiriman</th>
                                    <th class='row-md-3'>Tanggal Pengirim</th>
                                    <th class='row-md-3'>Status</th>
                                    <th>Opsi</th>
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
                <!-- END ROW-->
                    </div>
                        </form>
                            </div>
                                </div>
                    <!-- =================================================== STATUS ==================================================== -->
                    <div class="tab-pane fade active" id="tab_2_3">
                        <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom_STATUS"  enctype="multipart/form-data" > 
                            <div class="scroller" style="height:810px; ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="id_Reload" style="display: none;"></button>
                                    </div>
                                </div>   
                                <div class="row">
                                    <input class="form-control hidden" type="text" id="id_data" name="id_data"/>
                                     <!-- HIDDEN INPUT -->
                                            <div class="form-body">
                                        <div class="row">
                                        <div class="col-md-12">
                                    <div class="col-md-6">
                                <div class="form-group">
                            <label> Search:</label> <br>
                            <label>
                                <select name='limit' id='limit' class="form-control col-sm-4 col-md-4 col" onchange='pageLoad(1)'>
                                    <option value='5' >-SELECT2-</option>
                                    <option value='10' >TEST</option>
                                    <option value='25' >TEST </option>
                                </select>

                            </label>
                            <br>
                             <input type="text" name="cari" id='cari' class="form-control input-small input-inline" placeholder="" onblur="pageLoad(1)" onkeypress='handle2(event)'> 
                                   </div>
                                         <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-actions">
                                                        <button name="btnSimpan" target="_blank" class="btn blue" id="id_btnSimpan">
                                                            <!--<i class="fa fa-check"></i>--> Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                  </div>
                             </div> 
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->
                            </div>
                                    <input type="text" id="idTmpAksiBtn" class="hidden">
                                <!-- END HIDDEN INPUT -->
                            </div>
                        <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-12">
               <div class="col-md-12">&nbsp;</div>
                    <br>
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridstatus">
                                <thead>
                                         <tr>
                                            <th class='row-2'>ID TRansfer</th>     
                                            <th class='row-md-3'>Branch</th>
                                            <th class='row-md-3'>Divisi</th>
                                            <th class='row-md-6'>Jumlah Aset Inventaris</th>
                                            <th class='row-md-5'>Tujuan Transfer</th>
                                            <th class='row-md-3'>Tanggal Pengiriman</th>
                                            <th class='row-md-3'>Tanggal Pengirim</th>
                                            <th class='row-md-3'>Status</th>
                                            <th>Opsi</th>
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
                    <!-- END ROW-->
                </form>
             </div>




                    <!-- END VALIDATION STATES-->


 <!-- ========================================= javascript =========================================================== -->

<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('operational/transfer_inventaris/transfer_inventaris_js.php'); ?>

