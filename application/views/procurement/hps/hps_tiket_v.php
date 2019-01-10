<!-- BEGIN PAGE BREADCRUMB --> 

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
    <div class="row">
           

    </div>


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

            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat red">
                <div class="visual">
                    <i class="fa fa-eye"></i>
                </div>
                <div class="details">
                    <div class="number"><?php echo $dd_id_tiket_hps[0]->JML; ?></div>
                    <div class="desc">TIKET</div>
                </div>
                <a class="more" href="#"> PNM
                    <i class="m-icon-check m-icon-white"></i>
                </a>
            </div>
        </div>
                   <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="fa fa-cogs"></i>
                </div>
                <div class="details">
                    <div class="number"> <?php echo $dd_onproses[0]->JML; ?> </div>
                    <div class="desc"> TIIKET ON PROCESS </div>
                </div>
                <a class="more" href="#"> PNM
                    <i class="m-icon-check m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue">
                <div class="visual">
                    <i class="fa fa-check"></i>
                </div>
                <div class="details">
                    <div class="number"><?php echo $dd_done[0]->JML; ?> </div>
                    <div class="desc"> TIKET DONE </div>
                </div>
                <a class="more" href="#"> PNM
                    <i class="m-icon-check m-icon-white"></i>
                </a>
            </div>
        </div>


            <div class="portlet-body">
                <!--  <ul class="nav nav-pills">
                     <li class="linav active" id="linav1">
                         <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                             Data Item Category </a>
                     </li>
                     <li class="linav" id="linav2">
                         <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                             Form Data Item Category</a>
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

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridHPS">
                                        <thead>
                                            <tr>
                                                <th class='row-2'>NO</th>     
                                                <th class='row-md-3'>Tanggal Request</th>
                                                <th class='row-md-3'>Divisi Request</th>
                                                <th class='row-md-6'>Nama Barang</th>
                                                <th class='row-md-5'>Spesifikasi</th>
                                                <th class='row-md-6'>Jumlah barang</th>
                                                <th class='row-md-6'>Status Tiket</th>
                                                <th class='row-md-3'>Aksi</th>
                                                <th></th>
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

<!--Modal Add-->
<div id="myadd" class="modal fade" >
    <form class="validator-form form-horizontal" id="fmsaveUpload" action="" enctype="multipart/form-data" method="POST">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload HPS</h4>
                </div>
                <div class="modal-body" >
                    <div class="form-group">
                        <label class="control-label col-sm-3">Zone Name</label>
                        <div class="col-sm-7">
                            <div id="ddZone2"></div>                
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-sm-3">Upload File (.xlsx/.xls)</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" name="namafile" id="namafile" required>                
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="Submit" value="Submit" id="fmsaveUpload">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeupload">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal UPDATE-->
<div class="modal fade draggable-modal" id="mdl_Update" tabindex="-1" role="basic" aria-hidden="true">
    <!-- <form class="validator-form form-horizontal" id="fmUpdateHPS" action="" enctype="multipart/form-data" method="POST"> -->
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">                
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="HpsID" name="HpsID">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Item Name</label>
                        <div class="col-sm-7">
                            <input type="text" requered="" name="ItemName" class="form-control" id="ItemName" readonly>
                        </div>
                    </div>        
                    <div class="form-group" id="displaydivisi">
                        <label class="control-label col-sm-3">Zone Name</label>
                        <div class="col-sm-7">
                            <div id="ddZone"></div>
                        </div>
                    </div>        
                    <div class="form-group">
                        <label class="control-label col-sm-3">Start - End Date</label>
                        <div class="col-sm-7">
                            <div class="input-group input-large date-picker input-daterange" data-date="" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control" name="StartDate" id="StartDate">
                                <span class="input-group-addon"> To </span>
                                <input type="text" class="form-control" name="EndDate" id="EndDate"> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Price</label>
                        <div class="col-sm-7">
                            <input type="text" requered="" name="price" class="form-control nomor" id="price">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="btnSC">
                            <!--<button type="button" class="btn btn-success save" onclick="clickUpdate()">Save</button>-->
                            <button type="submit" class="btn btn-success update" id="btnUpdateHPS">Update</button>
                            <button type="button" class="btn btn-warning close_" data-dismiss="modal" id="btnCloseHPS">Close</button>                
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
</div>



 <!-- ===================================================== Modal Start ========================================================== -->

 <!-- Modal -->
 <head>
 
 </head>
 <!-- <div class="PrintArea area1 all" id="Retain"> -->
    <div id="myModalsha" class="modal fade" role="dialog">
        <div class="col-xs-12 col-md-12 big-box" >
        <div class="modal-dialog">
           <div class="modal-content width="2000px"">
             <div class="modal-responsive">
                 <div class="modal-header">
                    <button type="button" class="close" id="close_myModalsha" data-dismiss="modal" id="btnCloseModalDataBarang">&times;</button>
                      <h4 class="modal-title">Master Item dan HPS</h4>
                        <div class="modal-body">

                    <div class="row" id="itemmodal">
    <div class="col-md-12">
           <form role="form" method="post" class="cls_from_sec_room" 
           id="id_formRoom"  enctype="multipart/form-data" >
         <div class="portlet light bordered">
            <div class="portlet-body">
                <form role="form" method="post" class="cls_from_sec_user"
                      id="idFormUser" >
                    <div class="row">
                        <input class="form-control hidden " enctype="multipart/form-data" type="text" id="id_data" name="id_data"/>
                        <div class="form-body">
                            <div class="col-md-6">
                                <input type="hidden" name="id_tiket" id="id_tiket">

                                <div class="form-group">
                                    <label>Item Barang </label> <span class="">*</span>
                                    <input required="required" class="form-control" id="nama_barang" name="nama_barang" type="text" readonly/>
                                </div>
                                <div class="form-group">
                                    <label>Divisi Request</label> <span class="">*</span>
                                    <input required="required" class="form-control" type="text" id="divisi" name="divisi" readonly/>
                                </div>
                               <div class="form-group">
                                    <label>Item Category </label>
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($dd_item_class as $row) :
                                        $data[$row->IClassID] = $row->IClassName;
                                    endforeach;
                                    echo form_dropdown('IClassID', $data, '', 'id="IClassID" class="form-control  input-sm select2me" required="required" onchange="getItemID(this.value)"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>Item Type Nama </label> <span class="">*</span>
                                    <select name="ItemTypeID" id="ItemTypeID" class="form-control input-sm select2me">
                                            <option value="">-Pilih-</option>
                                    </select>
                                      <!-- <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($dd_item_type as $row) :
                                        $data[$row->ItemTypeID] = $row->ItemTypeName;
                                    endforeach;
                                    echo form_dropdown('ItemTypeID', $data, '', 'id="ItemTypeID" class="form-control  input-sm select2me" required="required"');
                                    ?> -->
                                </div>
                          <!--       <div class="form-group">
                                         <label>Asset Type </label>
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($dd_jns_budget as $row) :
                                        $data[$row->ID_JNS_BUDGET] = $row->BUDGET_DESC;
                                    endforeach;
                                    echo form_dropdown('AssetType', $data, '', 'id="id_AssetType" class="form-control  input-sm select2me" required=""');
                                    ?>
                            </div> -->

                        </div>  
                  <div class="row">
                     <div class="form-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Please select a file to upload :</label>
                                <div class="input-group">
                                    <span class="input-group-addon"> <i class="fa fa-file"></i>
                                    </span> <input type="file" name="Image[]" class="form-control" 
                                           id="Image" multiple>
                                </div>
                            </div>
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Note</h3>
                                </div>
                                <div class="panel-body">
                                    <ul>
                                        <li>
                                            Maximum upload size only <strong>5 MB</strong>.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
           
                        <!-- HIDDEN INPUT -->
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->

                    </div>

                     <div class="row">
                          <input class="form-control hidden" enctype="multipart/form-data" type="text" id="id_data" name="id_data"/>
                        <div class="form-body">
                         
                        </div>
                    </div>

                    <!--END ROW 1 -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions">

                                <button name="btnSimpan" class="btn blue" id="id_btnSimpan"  >
                                    <i class="fa fa-save">&nbsp;</i>Save</button>
                                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataBarang">Close</button>
                                <!-- <button type="reset" class="btn default" >Reset</button> -->
                            </div>
                        </div>

                    </div>
                </form>    

            </div>
        </div>
    </div>

</div>

</div>
    </div>
  
        </div>
         </div>
             </div>
         </div>
    </div>
</div>

<!-- <==================================================== akhir modal ============================================================> -->
<head>
 
 </head>
<div class="row" id="hps_modal_tiket" >
    <div class="row" id="itemmodal">
    <div class="col-md-12">
         <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom_no" >
           <!-- <form role="form" method="post" class="cls_from_sec_user" id="idFormUseri" > -->
        <div class="portlet light bordered">
<div id="modalku" class="modal fade" role="dialog">
        <div class="col-xs-12 col-md-12 big-box" >
        <div class="modal-dialog">
            <div class="modal-content width="2000px"">
                <div class="modal-responsive">
                <div class="modal-header">
                    <button type="button" class="close" id="tutupmodalnyadong" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">HPS</h4>
                <div class="modal-body">
                      <div class="row">
                        <input class="form-control hidden" enctype="multipart/form-data"  type="text" id="id_data" name="id_data"/>
                        <div class="form-body">
                            <div class="col-md-8">
                                <input type="hidden" name="id_tiket2" id="id_tiket2">

                                <div class="form-group">
                                    <label>Item Barang </label> <span class="required">*</span>
                                    <input required="required" class="form-control"
                                           type="readonly" id="nama_barang2" name="nama_barang2"  />
                                </div>
                                  <div class="form-group">
                                    <label>Zona </label>
                                    <?php
                                    // echo($dd_Zona)
                                    $data = array();
                                    $data[''] = '--Select--';
                                    // print_r($dd_Zona); die();
                                    foreach ($dd_Zona as $row) :
                                        $data[$row->ZoneID] = $row->ZoneName;
                                    endforeach;
                                    echo form_dropdown('ZoneID', $data, '', 'id="ZoneID" class="form-control  input-sm select" required="required"');
                                    ?>
                                </div>
                            
                                <div class="form-group">
                                    <label>Tanggal Mulai </label> <span class="required">*</span>
                                    <input type="text" autocomplete="off" required="required" name="StartDate" id="StartDate" class="form-control input-sm date-picker" >
                                 <!--    <input required="required" class="form-control"
                                          class="form-control form-control-inline input-medium date-picker" size="16" type="date"  id="StartDate" name="StartDate"/> -->
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Selesai </label> <span class="required">*</span>
                                     <input type="text" autocomplete="off" required="required" name="EndDate" id="EndDate" class="form-control input-sm date-picker" >
                                    <!-- <input required="required" class="form-control"
                                           class="form-control form-control-inline input-medium date-picker" size="16" type="date" id="EndDate" name="EndDate"/> -->
                                </div>
                                <div class="form-group">
                                    <label>Harga </label> <span class="required">*</span>
                                    <input required="required" autocomplete="off" class="form-control nomor"
                                           type="text" id="Price" name="Price"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions">
                                <button name="btnSimpan" class="btn btn-success" id="id_btnSimpan" >
                                    <i class="fa fa-save">&nbsp;</i>Save</button>
                                <button id="id_btnBatal22" type="button"  data-dismiss="modal" class="btn default">Cancel</button>
                            </div>
                        </div>

                    </div>
                        <!-- HIDDEN INPUT -->
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->

                          </div>
                      </div>
                  </div>
              </div>
         </div>
      </div>
    </div>
       <!-- </form> -->
     </form>
        </div>
             </div>
         </div>

               


<!-- ================================================== modal save end ======================================================== -->

<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/hps/hps_tiket.js.php'); ?>

