<!-- BEGIN PAGE BREADCRUMB -->

<style type="text/css">

table#table_gridItemProcess th:nth-child(2){
    display: none;
} 
table#table_gridItemProcess td:nth-child(2){
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
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                        Transfer</a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                        Data Transfer</a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">
                        Terima Transfer</a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="panel panel-inverse">
                            <hr class="dotted">
                            <!--tambahkan enctype="multipart/form-data" u/ upload-->
                            <form class="validator-form form-horizontal" id="fm_datasave" enctype="multipart/form-data" method="POST">
                                <div class="validator-form form-horizontal">

                                    <div class="row">

                                       <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Nama Pengirim</label>
                                            <div class="col-sm-8">
                                             <input type="text" readonly class="form-control" id="id_PENGIRIM" name="PENGIRIM" value="<?= $nama_pengirim?>">
                                         </div>
                                     </div>
                                 </div>


                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Tanggal Pengiriman</label>
                                        <div class="col-sm-8">
                                            <input id="id_TGL_PENGIRIM" class="form-control 
                                            date-picker input-sm cls_tglhariini" name="TGL_PENGIRIM" value="<?php echo date("d-m-Y") ?>" autocomplete="off" data-date-format="dd-mm-yyyy"
                                            type="text" placeholder="dd-mm-yyyy"/>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                            
                            <div class="row">
                              
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Branch</label>
                                    <div class="col-sm-8">
                                        <select class="form-control input-sm" type="text" id="id_ID_Branch" name="ID_Branch">
                                            <option value="" >--Select--</option>    
                                            <?php foreach ($item_branch as $row) { ?>
                                                <option value="<?php echo $row->FLEX_VALUE; ?>"><?php echo $row->BRANCH_DESC; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Division</label>
                                    <div class="col-sm-8">
                                        <select class="form-control input-sm" type="text" id="id_ID_div" name="ID_div">
                                            <option value="" >--Select--</option>    
                                            <?php foreach ($item_div as $row) { ?>
                                                <option value="<?php echo $row->FLEX_VALUE; ?>"><?php echo $row->DIV_DESC; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Tujuan Transfer</label>
                                    <div class="col-sm-8">
                                        <select class="form-control input-sm" type="text" id="id_ID_tujuan" name="ID_tujuan">

                                          
                                           <option value="" >--Select--</option>    
                                           <?php foreach ($item_branch as $row) { ?>
                                            <option value="<?php echo $row->FLEX_VALUE; ?>"><?php echo $row->BRANCH_DESC; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Resi</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control" id="id_RESI" name="RESI">
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Kota</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm" type="text" id="id_ID_kota" name="ID_kota">
                                    <option value="" >--Select--</option>    
                                    <?php foreach ($item_kota as $row) { ?>
                                        <option value="<?php echo $row->FLEX_VALUE; ?>"><?php echo $row->DESCRIPTION; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Lokasi</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm" type="text" id="id_ID_lokasi" name="ID_lokasi">
                                    <option value="" >--Select--</option>    
                                    <?php foreach ($item_lokasi as $row) { ?>
                                        <option value="<?php echo $row->SEGMENT2; ?>"><?php echo $row->SEGMENT1.$row->SEGMENT3; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                 

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Old Kota</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm" type="text" id="id_ID_oldkota" name="ID_oldkota">
                                    <option value="" >--Select--</option>    
                                    <?php foreach ($item_kota as $row) { ?>
                                        <option value="<?php echo $row->FLEX_VALUE; ?>"><?php echo $row->DESCRIPTION; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Old Lokasi</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm" type="text" id="id_ID_oldlokasi" name="ID_oldlokasi">
                                    <option value="" >--Select--</option>    
                                    <?php foreach ($item_kota as $row) { ?>
                                        <option value="<?php echo $row->FLEX_VALUE; ?>"><?php echo $row->DESCRIPTION; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                 <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Sub Lokasi</label>
                        <div class="col-sm-8">
                         <input type="text" class="form-control" id="id_sublokasi" name="id_sublokasi">
                     </div>
                 </div>
             </div>

             <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-sm-4">Old Sub Lokasi</label>
                    <div class="col-sm-8">
                     <input type="text" class="form-control" id="id_sublokasi" name="id_sublokasi">
                 </div>
             </div>
         </div>

         
     </div>

     <hr>

     <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label col-sm-4">Jml Asset Transfer</label>
                <div class="col-sm-3">
                 <input type="text" class="form-control" id="id_transfer" name="transfer">
             </div>
         </div>
     </div>

 </div>


 <!----------------------->

 <hr class="dotted">
 <a href="#" onclick="itemList()" class="btn btn-success">Pilih Asset</a>
 <hr>
 <div class="form-group" style="margin-top:1em">
    <div class="col-sm-12" align="center">
        <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridItemProcess">
            <thead>
                <tr>
                 <th>NO</th>
                 <th></th>     
                 <th>ID_ASSET</th>
                 <th>Zona</th>
                 <th>Branch</th>
                 <th>Unit</th>
                 <th>Tanggal Pengakuan Asset</th>
                 <th>Fix Asset id</th>
                 <th>Fix Asset id Lama</th>
                 <th>Nama Asset</th>
                 <th>QTY</th>
                 <th>Image</th>
                 <th>Kode QR</th>

             </tr>
         </thead>
         <tbody>


         </tbody>
         <tfoot>

         </tfoot>
     </table>
 </div>
</div>


<hr class="dotted">


<div id="load_termin"></div>

<div class="form-group">
    <label class="control-label col-sm-6"></label>
    <div class="col-sm-7">
        <div id="prosessloading"/>
        <button type="button"  class="btn btn-success" id="reqsave" onclick="getSaveTransfer()" name="reqsave" value="Submit" >Save & Transfer</button>       
    </div>
</div>
</div>
</form>
</div>
</div>



<div tabindex="-1" id="mdl_Add" class="modal fade draggable-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closetab" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Transfer</h4>
            </div>

            <div class="modal-body">
             <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footern" id="idTabelBarang">
                <thead>
                    <tr>
                        <th>NO</th>     
                        <th>ID_ASSET</th>
                        <th></th>
                        <th>Zona</th>
                        <th>Branch</th>
                        <th>Unit</th>
                        <th>Tanggal Pengakuan Asset</th>
                        <th>Fix Asset id</th>
                        <th>Fix Asset id Lama</th>
                        <th>Nama Asset</th>
                        <th>QTY</th>
                        <th>Image</th>
                        <th>Kode QR</th>


                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn green-jungle" onclick="processtransfer()" data-dismiss="modal"><i class="fa fa-check"></i> Process</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
</div>
<!--end--> 
<div class="tab-pane fade" id="tab_2_2">
    <div class="row">
        <input type="hidden" class="form-control" name="src" id="src"/>

        <div class="col-md-12" id="table_outReq">

            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="table_asset" >
                <thead>
                    <tr>
                        <th>NO</th>     
                        <th>ID</th>
                        <th>Branch</th>
                        <th>Divisi</th>
                        <th>Jml Asset Transfer</th>
                        <th>Tujuan Transfer</th>
                        <th>Tanggal Pengiriman</th>
                        <th>Nama Pengirim</th>
                        <th>Status</th>

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

<div class="tab-pane fade" id="tab_2_3">
    <div class="row">
        <input type="hidden" class="form-control" name="src" id="src"/>

        <div class="col-md-12" id="table_outReq">

            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="table_asset_transfer" >
                <thead>
                    <tr>
                        <th>NO</th>     
                        <th>ID</th>
                        <th>Branch</th>
                        <th>Divisi</th>
                        <th>Jml Asset Transfer</th>
                        <th>Tujuan Transfer</th>
                        <th>Tanggal Pengiriman</th>
                        <th>Nama Pengirim</th>
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
    <form class="validator-form form-horizontal" id="datasave" action="" enctype="multipart/form-data" method="POST">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Budget</h4>
                </div>
                <div class="modal-body" >
                    <div class="form-group">
                        <label class="control-label col-sm-3">Upload File (.xlsx/.xls)</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" name="namafile" id="namafile" required>                
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="signup" value="Submit" id="simandata">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeupload">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal UPDATE-->
<div class="modal fade draggable-modal" id="mdl_Update" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <div class="panel panel-inverse">
                    <hr class="dotted">
                    <div class="validator-form form-horizontal">
                        <input type="hidden" id="BudgetID">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Budget COA</label>
                            <div class="col-sm-7">
                                <input type="text" requered="" name="BudgetCOA" class="form-control" id="BudgetCOA">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Branch Name </label>
                            <div class="col-sm-7">
                                <div id="ddBranch"></div>
                            </div>
                        </div>        
                        <div class="form-group" id="displaydivisi">
                            <label class="control-label col-sm-3">Division Name</label>
                            <div class="col-sm-7">
                                <div id="ddDivisi"></div>
                            </div>
                        </div>        

                        <div class="form-group">
                            <label class="control-label col-sm-3">Budget Value</label>
                            <div class="col-sm-7">
                                <input type="text" requered="" name="BudgetValue" class="form-control nomor" id="BudgetValue">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Period</label>
                            <div class="col-sm-7">
                                <input type="text" requered="" name="period" class="form-control nomor1" id="period">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <div class="btnSC">
                        <button type="button" class="btn btn-success save" onclick="clickUpdate()">Save</button>
                        <button type="button" class="btn btn-success update" onclick="clickUpdate()">Update</button>
                        <button type="button" class="btn btn-warning close_" data-dismiss="modal">Close</button>                
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--Modal detail-->
<div id="mdl_DetailOR" class="modal fade" >
    <form class='validator-form form-horizontal' method='post' action='simpan_headlinevideo'>
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detil Purchase Request (PR)</h4>
                </div>
                <div id="modal-body1" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!--Modal delete-->
<div id="mdl_delete" class="modal fade" >
    <form class='validator-form form-horizontal' id="deletepr" action="" method="POST">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Hapus PR</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            Masukkan alasan penghapusan PR
                        </div>
                        <br><br>
                        <div class="col-sm-12">
                            <textarea style="radius:5px;" class="form-control" maxlength="450" id="note" name="note"  type="text"> </textarea> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" name="req" id="req" class="hidden">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="" value="Submit">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!--Modal Upload-->
<div id="myUploadPR" class="modal fade" >
    <form class='validator-form form-horizontal' enctype="multipart/form-data" id="uploadpr" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Uplaod PR</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            Uplaod Purchase Request (PR) yang sudah di TTD
                        </div>
                        <br><br>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" name="FileUploadPR" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="hidden" name="requestid" id="requestid" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submit_upload" value="Submit">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCloseUpload">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php $this->load->view('app.min.inc.php'); ?>

<script>


    $('.date-picker').datepicker({
        orientation: "left",
        autoclose: true
    });


    $(document).ready(function () {
        $("#id_ID_Branch").select2({
            placeholder: "Please Select"
        });

        $("#id_ID_div").select2({
            placeholder: "Please Select"
        });

        $("#id_ID_tujuan").select2({
            placeholder: "Please Select"
        });
        $("#id_ID_kota").select2({
            placeholder: "Please Select"
        });
        $("#id_ID_lokasi").select2({
            placeholder: "Please Select"
        });
        $("#id_ID_oldkota").select2({
            placeholder: "Please Select"
        });
        $("#id_ID_oldlokasi").select2({
            placeholder: "Please Select"
        });
        
    });


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

    $('#table_gridCategory').on('click', '#btnDetail', function () {
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

        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        // console.log(idata);
        $("#txtRaw_ID").val(idata[1]);
        $("#txtVendorTypeID").val(idata[2]);
        $("#txtVendorTypeName").val(idata[3]);


        document.getElementById("txtVendorTypeID").readOnly = true;
        document.getElementById("txtVendorTypeName").readOnly = false;

        $(".btnSC").show();
        $(".btnSC .save").hide();
        $(".btnSC .update").show();
        $(".btnSC .close_").show();
        $(".status").hide();

    });

    jQuery(document).ready(function () {

        getfamtransfer();
        getfamdata();
        getfamdata_transfer();
        getfamdataku();

    });

    function itemList() {
        $('#mdl_Add').modal({show: true});

        // dataTableItmPr.destroy();
    }


    function getfamtransfer(){
        dataTable1 = $('#idTabelBarang').DataTable({
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
                    url: "<?php echo base_url("/assetmanagement/transferout/get_server_side"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".idTabelBarang-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#idTabelBarang tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#idTabelBarang_processing").css("display", "none");

                    }
                }
            });
    }

    var iID_ASSET ='';

    function processtransfer(){

        
      var rows_selected = dataTable1.column(2).checkboxes.selected();

      iID_ASSET =iID_ASSET + rows_selected.join(",");

      // alert(iID_ASSET);
      $('#table_gridItemProcess').DataTable().ajax.reload();


  }


  function terima(data){

     $.ajax({
        type: "POST",
        cache: false,
        data : {id: data},
        dataType: "JSON",
        url: "<?php echo base_url("/assetmanagement/transferout/terima_asset"); ?>", // json datasource
        success: function (e) {
         location.reload();
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
       


                // $('# table_asset').DataTable2().ajax.reload();
                // $('#table_asset_transfer').DataTable().ajax.reload();
                // $('#table_gridItemProcess').DataTable1().ajax.reload();
                // $('#idTabelBarang').DataTable1().ajax.reload();
            }
        });
 }




 function getSaveTransfer() {
    var i_clsUpdate = {
        ID_ASSET : iID_ASSET,
        id_ranch: $("#id_ID_Branch").val(),
        id_pengirim: $("#id_PENGIRIM").val(),
        tgl_pengirim: $("#id_TGL_PENGIRIM").val(),
        tujuan: $("#id_ID_tujuan").val(),
        division: $("#id_ID_div").val(),
        resi: $("#id_RESI").val(),
        kota: $("#id_ID_kota").val(),
        lokasi: $("#id_ID_lokasi").val(),
        sublokasi: $("#id_sublokasi").val()

    }


    $.ajax({
        type: "POST",
        cache: false,
        data : {sTbl: i_clsUpdate},
        dataType: "JSON",
        url: "<?php echo base_url("/assetmanagement/transferout/savedatatransfer"); ?>", // json datasource
        success: function (e) {
         location.reload();
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
                    url: "<?php echo base_url("/assetmanagement/transferout/get_datatransfer"); ?>", // json datasource
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


function transferasset(){

  var rows_selected = dataTable2.column(2).checkboxes.selected();

  iID_ASSET =iID_ASSET + rows_selected.join(",");

  $('#table_asset').DataTable().ajax.reload();


}


function getfamdata_transfer(){
    dataTable = $('#table_asset_transfer').DataTable({
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
                    url: "<?php echo base_url("/assetmanagement/transferout/get_terimatransfer"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".table_asset_transfer-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#table_asset_transfer tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#table_asset_transfer_processing").css("display", "none");

                    }
                }
            });
}



function getfamdataku(){
    

    dataTable = $('#table_gridItemProcess').DataTable({
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
                    url: "<?php echo base_url("/assetmanagement/transferout/get_server_side_asset_dataku"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        // console.log(z);
                         // var data = $.parseJSON(z);
                         $("#id_transfer").val(z.recordsTotal);
                         
                         z.sID_ASSET = iID_ASSET;
                         z.sSearch = iSearch;
                         
                     },

                    error: function () {  // error handling
                        $(".table_gridItemProcess-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#table_gridItemProcess tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#table_gridItemProcess_processing").css("display", "none");

                    }
                }
            });

    
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
