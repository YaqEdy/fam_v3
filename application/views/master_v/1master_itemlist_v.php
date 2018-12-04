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
                            <div class="row">
                                <div class="col-md-8">
                                    <a class="btn btn-sm btn-primary" href="#" id="btnAdd" data-toggle="modal" data-target="#mdl_Update">Add Master Item List</a>
                                    <!-- <button class="btn btn-sm btn-default">Add Item Category</button> -->
                                </div>
                                <div class="col-md-2">
                                    <select id="cat_itemclass" name="cat_itemclass" onchange="search(this.value)" class="form-control">
                                        <option value="%">--All--</option>
                                        <option value="1">Category </option>
                                        <option value="2">Item Type</option>
                                        <option value="3">Item Name</option>
                                    </select>
                                </div> 
                                <div class="col-md-2">
                                    <select id="statustype" name="statustype" onchange="status(this.value)" class="form-control">
                                        <option value="%">--All--</option>
                                        <option value="1">Active</option>
                                        <option value="0">Non-Active</option>
                                    </select>
                                </div> <br/><br/><br/>


                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridCategory">
                                        <thead>
                                            <tr>
                                                <th>
                                                    NO
                                                </th> 
                                                <th>
                                                    ItemID
                                                </th>
                                                <th>
                                                    Image
                                                </th>    
                                                <th>
                                                    Category
                                                </th> 

                                                <th>
                                                    Item Type
                                                </th>

                                                <th>
                                                    Item Name 
                                                </th>

                                                <th>
                                                    Action
                                                </th>

                                                <th>IClassID</th>
                                                <th>ItemTypeID</th>
                                                <th>StatusMadya</th>
                                                <th>StatusUtama</th>
                                                <th>StatusPratama</th>
                                                <th>StatusMekar</th>


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

<!-- Modal UPDATE-->
<div class="modal fade draggable-modal" id="mdl_Update" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="txtItemID" >
                <input style="display:none;" class="form-control" id="txtBranchID" >
                <div class="validator-form form-horizontal">

                    <div class="form-group">
                        <label class="control-label col-sm-3">Category</label>
                        <div class="col-sm-7">
                            <!--<input type="text" class="form-control" name="classid" requered/>-->
                            <select class="form-control" type="text" id="txtIClassID"  onchange="OnClassItem(this.value);">
                                <option value="" >--Select--</option>
                                <?php foreach ($item_class as $row) { ?>
                                    <option value="<?php echo $row->IClassID; ?>"><?php echo $row->IClassName; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-sm-3">Item Type</label>
                        <div class="col-sm-7">
                            <div>
                                <select class="form-control" type="text" id="txtItemTypeID">
                                    <option value="" >--Select--</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-3">Item Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="txtitemname">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-3">Image Item</label>
                        <div class="col-sm-7">
                            <input id="uploadDoc_txt" type="text" style="width: 190px; border: 0px; display: none">
                            <input type="file" id="txtImage" name="txtImage" type="text" class="form-control" size="40">
                                 <!-- <input type="file" id="txtImage" name="txtImage" type="text" class="form-control" size="40"
                                onchange="$('#uploadDoc_txt').val(this.value); $('#uploadDoc_title').attr('title', this.value);"
                                > -->
                            <!-- <a href="javascript:uploadDoc();" class="input-group-addon btn blue"> Upload </a> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-7" >
                            <div id="txtImagediv">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Include</label>
                        <div class="col-sm-7">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="inverted" name="utama" id="utama" value="1"> <span class="text">Utama  &nbsp;</span>
                                </label> 
                                &nbsp;
                                &nbsp;
                                <label>
                                    <input type="checkbox" class="inverted" name="madya" id="madya" value="1"> <span class="text">Madya  &nbsp;</span>
                                </label>
                                &nbsp;
                                &nbsp;
                                <label>
                                    <input type="checkbox" class="inverted" name="pratama" id="pratama" value="1"> <span class="text">Pratama  &nbsp;</span>
                                </label>
                                &nbsp;
                                &nbsp;
                                <label>
                                    <input type="checkbox" class="inverted" name="mekaar" id="mekaar" value="1"> <span class="text">Mekaar  &nbsp;</span>
                                </label>
                            </div>
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
                        <button type="button" class="btn btn-success update" onclick="clickUpdate('status')">Update</button>
                        <button type="button" id="id_keluar" class="btn btn-warning close_" data-dismiss="modal">Close</button>                
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('app.min.inc.php'); ?>
<script type="text/javascript" src="<?php echo base_url('metronic/global/ajaxfileupload.js'); ?>"></script>
<script>

                            $('input[type="file"]').change(function (e) {
                                var fileName = e.target.files[0].name;
                                $("#uploadDoc_txt").val(fileName);
                                // alert('The file "' + fileName +  '" has been selected.');
                            });

                            function uploadDoc() {
                                elementId = 'txtImage';
                                docType = 'itemlist';
                                cifKode = $("#txtItemID").val();
                                // console.log($("#txtImage").files.name);

                                __ajaxFileUpload(elementId, docType, cifKode);

                                // $("#uploadDoc").val('');
                                // $('#uploadDoc_txt').val('');
                                // $('#uploadDoc_title').attr('title', '');
                            }


                            function __ajaxFileUpload(elementId, docType, cifKode) {
                                $("#loading").ajaxStart(function () {
                                    $(this).show();
                                })
                                        .ajaxComplete(function () {
                                            $(this).hide();
                                        });

                                $.ajaxFileUpload({
                                    url: "<?php echo base_url("/master/master_itemlist/doc_upload"); ?>/" + elementId + '/' + docType + '/' + cifKode,
                                    // url: host+'index.php/kemitraan/doc_upload/'+elementId+'/'+docType+'/'+cifKode, 
                                    secureuri: false,
                                    fileElementId: elementId,
                                    dataType: 'json',
                                    success: function (data, status) {
                                        if (typeof (data.error) != 'undefined') {
                                            if (data.error != '') {
                                                alert(data.error);
                                            } else {
                                                // dataDocs = JSON.parse(data.msg);
                                                // dataJSON[selectedRow].docs = [];
                                                // dataJSON[selectedRow].docs = dataDocs;
                                                // getDataDocs();
                                            }
                                        }
                                    },
                                    error: function (data, status, e) {
                                        alert(e);
                                    }
                                });
                                return false;
                            }
                            ;

                            var dataTable;
                            var iStatusAdd = '1';
                            var iStatus = '%';
                            var iSearch = '%';


                            $("#uploadDoc_txt").val("");
                            $("#btnAdd").click(function () {
                                $('#mdl_Update').find('.modal-title').text('Add');
                                $("#txtItemID").val("Generate");
                                $("#txtImage").val("");
                                $("#txtItemName").val("");
                                // $("#txtItemTypeName").val("");
                                // $("#txtIClassName").val("");

//                                document.getElementById("txtImage").readOnly = false;
//                                document.getElementById("txtItemName").readOnly = false;
                                // document.getElementById("txtItemTypeName").readOnly = false;
                                // document.getElementById("txtIClassName").readOnly = false;


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
                                console.log(idata);
                                var i_clsUpdate = {
                                    ItemID: idata[1],
                                    ItemName: idata[5],
                                    Status: 1
                                }

                                bootbox.confirm("Apakah anda yakin meng-aktifkan data " + idata[5] + "?", function (o) {
                                    if (o == true) {
                                        $.ajax({
                                            type: "POST",
                                            cache: false,
                                            dataType: "JSON",
                                            url: "<?php echo base_url("/master/master_itemlist/ajax_UpdateStatusCategory"); ?>", // json datasource
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
                                    ItemID: idata[1],
                                    ItemName: idata[5],
                                    Status: 0
                                }

                                bootbox.confirm("Apakah anda yakin meng-nonaktifkan data " + idata[5] + "?", function (o) {
                                    if (o == true) {
                                        $.ajax({
                                            type: "POST",
                                            cache: false,
                                            dataType: "JSON",
                                            url: "<?php echo base_url("/master/master_itemlist/ajax_UpdateStatusCategory"); ?>", // json datasource
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

                                var x = $("#checkbox").is(":checked");
                                var a = $("#utama").is(":checked");
                                var b = $("#madya").is(":checked");
                                var c = $("#pratama").is(":checked");
                                var d = $("#mekaar").is(":checked");


                                var i_clsUpdate = {
                                    ItemID: $("#txtItemID").val(),
                                    // Image: $("#txtImage").val(),
                                    // ItemName: $("#txtItemName").val(),
                                    // ItemTypeName: $("#txtItemTypeName").val(),
                                    // IClassName: $("#txtIClassName").val(),
                                    txtIClassID: $("#txtIClassID").val(),
                                    txtItemTypeID: $("#txtItemTypeID").val(),
                                    txtitemname: $("#txtitemname").val(),
                                    txtImage: $("#uploadDoc_txt").val(),
                                    utama: +a,
                                    madya: +b,
                                    pratama: +c,
                                    mekaar: +d,
                                    statustypeAdd: $("#statustypeAdd").val(),

                                    Status: iStatusAdd
                                }

                                if ($("#txtIClassID").val() == "") {
                                    bootbox.alert({
                                        message: "Required Type Category",
                                        backdrop: true
                                    });
                                } else if ($("#txtItemTypeID").val() == "") {
                                    bootbox.alert({
                                        message: "Required Item Type",
                                        backdrop: true
                                    });
                                } else if ($("#txtitemname").val() == "") {
                                    bootbox.alert({
                                        message: "Required Item Name",
                                        backdrop: true
                                    });
                                } else {
                                    if (status == "add") {
                                        var message = 'Apakah anda yakin ingin menambahkan data Item list?';
                                    } else {
                                        var message = 'Apakah anda yakin ingin mengubah data Item List?';
                                    }
                                    bootbox.confirm(message, function (o) {
                                        if (o == true) {
                                            $.ajax({
                                                type: "POST",
                                                cache: false,
                                                dataType: "JSON",
                                                url: "<?php echo base_url("/master/master_itemlist/ajax_UpdateCategory"); ?>", // json datasource
                                                data: {sTbl: i_clsUpdate},
                                                success: function (e) {
                                                    $('#id_keluar').trigger('click');

                                                    if (e.msgType == true) {
                                                        uploadDoc();
                                                        setTimeout(function () {
                                                            alert(e.msgTitle);
                                                            $('#mdl_Update').modal('hide');
                                                            $('#table_gridCategory').DataTable().ajax.reload();
                                                        }, 2000)
                                                    } else {
                                                        alert(e.msgTitle);
                                                    }
                                                }
                                            });
                                        }
                                    });
                                }

                            }
                            ;



                            $('#table_gridCategory').on('click', '#btnDetail', function () {
                                $('#mdl_Update').find('.modal-title').text('Detail');

                                var iclosestRow = $(this).closest('tr');
                                var idata = dataTable.row(iclosestRow).data();
                                console.log(idata);

                                $("#txtItemID").val(idata[1]);
// $("#txtBranchID").val(idata[0]);
                                $("#txtIClassID").val(idata[7]);
                                OnClassItem(idata[7]);
                                setTimeout(function () {
                                    $("#txtItemTypeID").val(idata[8]);
                                }, 2000)


                                $("#txtitemname").val(idata[5]);
                                // $("#txtImage").val(idata[2]);
                                if (idata[9] == 1) {
                                    $("#utama").prop("checked", true);
                                }
                                if (idata[10] == 1) {
                                    $("#madya").prop("checked", true);
                                }
                                if (idata[11] == 1) {
                                    $("#pratama").prop("checked", true);
                                }
                                if (idata[12] == 1) {
                                    $("#mekaar").prop("checked", true);
                                }


                                // $("#txtItemID").val(idata[1]);
                                $("#txtImagediv").html(idata[2]);
                                $("#txtItemName").val(idata[3]);

                                //  $("#txtItemName").val(idata[7]);
                                //  $("#txtItemName").val(idata[8]);
                                //  $("#txtItemName").val(idata[9]);
                                //  $("#txtItemName").val(idata[10]);
                                //  $("#txtItemName").val(idata[11]);
                                //  $("#txtItemName").val(idata[12]);
                                // $("#txtItemTypeName").val(idata[4]);
                                // $("#txtIClassName").val(idata[5]);



                                // document.getElementById("txtItemID").readOnly = true;
                                // document.getElementById("txtImage").readOnly = true;
                                // document.getElementById("txtItemName").readOnly = true;
                                // document.getElementById("txtItemTypeName").readOnly = true;
                                // document.getElementById("txtIClassName").readOnly = true;




                                $(".btnSC").hide();
                                $(".status").hide();

                            });


                            $('#table_gridCategory').on('click', '#btnUpdate', function () {
                                $('#mdl_Update').find('.modal-title').text('Update');

                                var iclosestRow = $(this).closest('tr');
                                var idata = dataTable.row(iclosestRow).data();
                                // console.log(idata);
                                console.log(idata);

                                $("#txtItemID").val(idata[1]);
// $("#txtBranchID").val(idata[0]);
                                $("#txtIClassID").val(idata[7]);
                                OnClassItem(idata[7]);
                                setTimeout(function () {
                                    $("#txtItemTypeID").val(idata[8]);
                                }, 2000)


                                $("#txtitemname").val(idata[5]);
// $("#txtImage").val(idata[2]);
                                if (idata[9] == 1) {
                                    $("#utama").prop("checked", true);
                                }
                                if (idata[10] == 1) {
                                    $("#madya").prop("checked", true);
                                }
                                if (idata[11] == 1) {
                                    $("#pratama").prop("checked", true);
                                }
                                if (idata[12] == 1) {
                                    $("#mekaar").prop("checked", true);
                                }


                                // $("#txtItemID").val(idata[1]);
                                $("#txtImagediv").html(idata[2]);
                                $("#txtItemName").val(idata[3]);


                                // document.getElementById("txtItemID").readOnly = false;
                                // document.getElementById("txtImage").readOnly = false;
                                // document.getElementById("txtItemName").readOnly = false;
                                // document.getElementById("txtItemTypeName").readOnly = false;
                                // document.getElementById("txtItemTypeName").readOnly = false;


                                $(".btnSC").show();
                                $(".btnSC .save").hide();
                                $(".btnSC .update").show();
                                $(".btnSC .close_").show();
                                $(".status").hide();
                            });
                            jQuery(document).ready(function () {
                                dataTable = $('#table_gridCategory').DataTable({
                                    "columnDefs": [
                                        {"targets": [-1], "searchable": false, "orderable": false},
                                        {"targets": [1, 7, 8, 9, 10, 11, 12], "visible": false, "searchable": false, "orderable": false},
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
                                        url: "<?php echo base_url("/master/master_itemlist/get_server_side"); ?>", // json datasource
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


                            });

                            function OnClassItem(input) {

                                $('#txtItemTypeID').empty();
                                $('#txtItemTypeID').append("<option value='NULL'>-Pilih-</option>");
                                var no = 0;
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    "url": "<?php echo base_url("master/master_itemlist/OnItemType/"); ?>/" + input,
                                    // "url": "<?php echo base_url("master/master_itemlist/OnClassItem/"); ?>/" + input, //<?php echo base_url() ?>+"kemitraanonline/getkota/"+input,//<?php echo base_url("referensi/daftar_vendor/getkabupaten/3") ?>, //
                                    data: input, success: function (data) {
                                        $('#txtItemTypeID').append(data);
                                    }
                                });
                                event.preventDefault();
                            }

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