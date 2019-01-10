
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
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <!-- <div class="row"> -->
                                <!-- <div class="cotable_gridHPSl-md-4"> -->
                                    <div class="form-body">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-primary" href="#" id="btnAdd" data-toggle="modal" data-target="#myadd" onclick="dd_Zone('B')">Upload HPS</a>
                                    <a class="btn btn-sm btn-success" href="<?php echo base_url("/procurement/hps/downloadWord"); ?>" download>Download Template HPS</a>
                                   <!--  <a class="btn btn-sm btn-warning" href="#" id="btnAdd" data-toggle="modal" data-target="" modal="#" ><i class="fa fa-eye"></i>&nbsp;Lihat</a> -->
                                    <!-- <a class="btn btn-sm btn-warning" href="<?php echo base_url(""); ?>" ><i class="fa fa-refresh"></i>&nbsp;Refresh</a> -->
                                    <!-- <button class="btn btn-sm btn-default">Add Item Category</button> -->
                                </div>
                                <br>

                                <div class="col-md-12">&nbsp;</div>

                                <!-- <div class="col-md-12"> -->
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <label>Branch</label>
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($dd_BRANCH as $row) :
                                        $data[$row->FLEX_VALUE] = $row->BRANCH_DESC;
                                    endforeach;
                                    echo form_dropdown('FLEX_VALUE', $data, '', 'id="FLEX_VALUE" class="form-control  input-sm select2me" required="required"');
                                    ?>
                                <!-- </div> -->
                                </div>
                                </div>

                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridHPS">
                                        <thead>
                                            <tr>
                                                <th>NO</th>     
                                                <th>Nama Item</th>
                                                <th>Branch</th>
                                                <th>Harga</th>
                                                <th>Tanggal Berlaku</th>
                                                <th>Tanggal Selesai Berlaku</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                                <!-- <th class='row-md-3'></th> -->

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
       <!--              <div class="form-group">
                        <label class="control-label col-sm-3">Zone Name</label>
                        <div class="col-sm-7">
                            <div id="ddZone2"></div>                
                        </div>
                    </div>   -->
                    <div class="form-group">
                        <label class="control-label col-sm-3">Upload File (.xlsx/.xls)</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" name="namafile" id="namafile" required>                
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="Submit" value="Submit" id="simandata">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeupload">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal UPDATE-->
<div class="modal fade draggable-modal" id="mdl_Update" tabindex="-1" role="basic" aria-hidden="true">
    <form class="validator-form form-horizontal" id="fmUpdateHPS" action="" enctype="multipart/form-data" method="POST">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">                
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                    <input type="text" id="HpsID" name="HpsID" style="display: none;">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Item Name</label>
                        <div class="col-sm-7">
                            <input type="text" requered="" name="ItemName" class="form-control" id="ItemName" readonly>
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



<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/hps/hps.js.php'); ?>

