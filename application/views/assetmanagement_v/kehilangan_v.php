<!-- BEGIN PAGE BREADCRUMB --> 



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
                             Data Asset List </a>
                     </li>
                            </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row">
                        


                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridCategory">
                                        <thead>
                                            <tr>
                                                <th width="5%">
                                                    NO
                                                </th >     
                                                                                    
                                                <th >
                                                   ID
                                                </th>
                                                <th>
                                                   Zona
                                                </th>
                                                <th>
                                                    Branch
                                                </th>
                                                 <th>
                                                    Divisi/Cabang
                                                </th>
                                                 <th>
                                                    Tanggal Pengakuan Asset
                                                </th>
                                                <th>
                                                    FIx Asset ID
                                                </th>
                                                 <th>
                                                    Fix Asset ID Lama
                                                </th>
                                                <th>
                                                    Nama Asset
                                                </th>
                                                 <th>
                                                    QTY
                                                </th>
                                                 <th>
                                                    Image
                                                </th>
                                                <th>
                                                    Kondisi
                                                </th>
                                                <th>
                                                    
                                                </th>
                                                       <th>
                                           &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                    <div class="col-md-15">
                                        <div class="form-group">
                                            <div class="col-sm-15">
                                    <select  onchange="asset_kehilangan(this.value);"
                                        name="laporan" class="form-control" 
                                       id="id_laporan">
                                       <option value="">--Pilih--</option>
                                        <option value="Kehilangan">Kehilangan</option>
                                         <option value="Kerusakan">Kerusakan</option>
                                         
                                    </select>
                                             </div>
                                        </div>
                                     </div>
                                     
                                        </th>
                                              
                                                <!-- <th width="25%">
                                                    Action
                                                </th> -->

                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>

                                    </div>
                            <!-- END ROW-->
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
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelBarang">
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
                                        <tbody id="id_row_kehilangan">

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







    var dataTable;
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

    });


  function asset_kehilangan(data,id){

    // ajaxModal();
    // $('#mdl_depresiasi').modal('show');
    // $('#mdl_adjustman').modal('show');


                    if (data == 'Kehilangan') { 
                    $('#mdl_kehilangan').modal('show');
                    
                }else if(data == 'Adjustman'){
                    $('#mdl_kehilangan').modal('hide');
                    $('#mdl_adjustman').modal('show');
                }else{
                  $('#mdl_kehilangan').modal('hide');
                    $('#mdl_adjustman').modal('hide');
                }
                











 }


   function getfamasset(){
               $.ajax({
                    type: "POST",
                    cache: false,
                    dataType: "JSON",
                    url: "<?php echo base_url("/assetmanagement/Kehilangan/get_server_kehilangan"); ?>", // json datasource
                    data: {sid: 100000},
                    success: function (e) {
                        console.log('tes',e);
                        $('#id_row_kehilangan').empty();
                       
                        $('#id_row_kehilangan').html(e);
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
            $('#idTabelBarang').DataTable().ajax.reload();

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


         function getfamku(){
            dataTable = $('#idTabelBarang').DataTable({
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
                    url: "<?php echo base_url("/assetmanagement/assetlist/get_server_side_depresiasi"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = '100000';

                        // z.sSearch = iSearch;
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
    


     function getfamlocation(){
            dataTable = $('#table_gridCategory').DataTable({
            // "order": [[ 0, "asc" ],[6, "desc" ]],
                "columnDefs": [
                    {"targets": [-1], "searchable": false, "orderable": false},
                    {"targets": [1], "visible": false, "searchable": false, "orderable": false},
                    {"targets": [4], "searchable": false, "orderable": false},
                    {"targets": [12], "checkboxes": {"selectRow": true}},
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
                    url: "<?php echo base_url("/assetmanagement/Kehilangan/get_server_side"); ?>", // json datasource
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