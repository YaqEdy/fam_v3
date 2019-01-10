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


                <button class="btn blue" onclick="sys_kotalocation()">Button Sync API <i class="fa fa-refresh green"></i></button>
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
                             Data Lokasi </a>
                     </li>
                     <li class="linav" id="linav2">
                         <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Data Kota</a>
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
                                                   LOCATION_ID
                                                </th>
                                                <th>
                                                   SEGMENT1
                                                </th>
                                                <th>
                                                    SEGMENT2
                                                </th>
                                                 <th>
                                                    SEGMENT3
                                                </th>
                                                 <th>
                                                    SUMMARY_FLAG
                                                </th>
                                                <th>
                                                    ENABLED_FLAG
                                                </th>
                                                 <th>
                                                    LAST_UPDATE_DATE
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




                    <div class="tab-pane" id="tab_2_2">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="coa_table">
                                        <thead>
                                            <tr>
 
                                                <th width="5%">
                                                    NO
                                                </th >     
                                                <th>
                                                    FLEX_VALUE_SET_ID
                                                </th>                                      
                                                <th >
                                                  FLEX_VALUE_SET_NAME
                                                </th>
                                                <th>
                                                    SEGMENT_NAME
                                                </th>
                                                <th>
                                                    SEGMENT_PROMPT
                                                </th>
                                                 <th>
                                                    MAXIMUM_SIZE
                                                </th>
                                                 <th>
                                                    FLEX_VALUE_ID
                                                </th>
                                                 <th>
                                                    FLEX_VALUE
                                                </th>
                                                  <th>
                                                    PARENT_FLEX_VALUE_LOW
                                                </th>
                                                 <th>
                                                    DESCRIPTION
                                                </th>
                                                 <th>
                                                    ENABLED_FLAG
                                                </th>

                                                <th>
                                                    SUMMARY_FLAG
                                                </th>
                                                <th>
                                                    PARENT_FLEX_VALUE
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

<!-- Modal UPDATE-->
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
        dataType: "JSON",
        cache: false,
        success: function(data){
             $('#table_gridCategory').DataTable().ajax.reload();
             $('#coa_table').DataTable().ajax.reload();
              alert(data.msg);
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

        getfamlocation();
        coa_table();

    });


     function getfamlocation(){
            dataTable = $('#table_gridCategory').DataTable({
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
                    url: "<?php echo base_url("/master/kota_location/get_server_side"); ?>", // json datasource
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







     function coa_table(){
            dataTable = $('#coa_table').DataTable({
            // "order": [[ 0, "asc" ],[5, "desc" ]],
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
                    url: "<?php echo base_url("/master/kota_location/get_server_side_kota"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".coa_table-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#coa_table tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#coa_table_processing").css("display", "none");

                    }
                }
            });
        }



 

//     function getfamlocationasset() {
//         var table = $('#table_gridCategory');
//         table.dataTable({
//             "ajax": "<?php echo base_url("/master/kota_location/getfamlocation"); ?>",
//             "columns": [
              
//                 {"data": "LOCATION_ID"},
//                 {"data": "SEGMENT1"},
//                 {"data": "SEGMENT2"},
//                 {"data": "SEGMENT3"},
//                 {"data": "SUMMARY_FLAG"},
//                 {"data": "ENABLED_FLAG"},
//                 {"data": "UPDATE_DATE"}
//             ],
//             "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
//             "lengthMenu": [
//                 [5, 10, 15, 20, 50],
//                 [5, 10, 15, 20, 50],
//             ],
//             "aaSorting": [[0, 'asc']/*, [5,'desc']*/],
//             "columnDefs": [{
//                     'orderable': false,
//                     "searchable": false,
//                     'targets': [0]
//                 }],
//             "order": [
//                 [1, "asc"]
//             ]
//         });
//         jQuery("#table_gridCategory_wrapper");
//         table.find(".group-checkable").change(function () {
//             var table = jQuery(this).attr("data-set"),
//                     t = jQuery(this).is(":checked");
//             jQuery(table).each(function () {
//                 if (t) {
// //                    alert($('tr .checkboxes').val());
//                     handleClick_all(this);
//                     $(this).prop("checked", !0);
//                     console.log(this.value);
//                     $(this).parents("tr").addClass("active");
//                     var idGroup = $('#table_gridCategory tbody tr td').eq(2).html();
//                 } else {
//                     handleClick_all(this);
//                     console.log(this.value);
//                     $(this).prop("checked", !1);
//                     $(this).parents("tr").removeClass("active");
//                 }
//             })
//         }), table.on("change", "tbody tr .checkboxes", function () {
            
//             $(this).parents("tr").toggleClass("active");
//             var idGroup = $('#table_gridCategory tbody tr td').eq(2).html();
//         });
//         $('#id_Reload').click(function () {
//             table.api().ajax.reload();
//         });
//         table.on('click', 'tbody tr', function () {
           
//             var idAgen = $(this).find("td").eq(0).html();
//             // $('#id_agenId').val(idAgen.trim());
//             var namaAgen = $(this).find("td").eq(1).html();
//             // $('#id_namaAgen').val(namaAgen.trim());
//             $("#navitab_2_2").trigger('click');
//             $('#id_btnSimpan').attr('disabled', true);
//             $('#id_btnUbah').attr("disabled", false);
//             $('#id_btnHapus').attr("disabled", false);
//             $('#id_namaAgen').focus();
//         });
//     }






    // jQuery(document).ready(function () {
    //     TableManaged.init();
    // });
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