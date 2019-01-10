<!-- BEGIN PAGE BREADCRUMB --> 
<style type="text/css">

table#idTabelchangestatus th:nth-child(2){
    display: none;
} 
table#idTabelchangestatus td:nth-child(2){
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

                                <table class="table table-striped table-bordered table-hover text_kanan" id="table_statusku">
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

                        </div>


                    </div>

                    <!-- END ROW-->
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
















<div class="modal fade draggable-modal" id="mdl_changestatus" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Change Status</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadBarang" style="display: none;"></button>
                        </div>
                    </div>
                    
                    <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Status</label>
                            <div class="col-sm-8">
                                <select   name="STATUS_PENJUALAN" class="form-control" 
                                id="id_STATUS_PENJUALAN" onchange="detail(this.value)">
                                <option value="">--Pilih--</option>
                                <option value="3">Pengajuan Komite</option>
                                <option value="4">Di Setujui Komite</option>
                                <option value="5">Harga Limit Bawah</option>
                                <option value="6">Balai Lelang</option>
                                <option value="7">Terjual</option>
                          
                   

                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Tanggal Status</label>
                        <div class="col-sm-8">
                            <input id="id_TANGGAL" class="form-control 
                            date-picker input-sm cls_tglhariini" name="TANGGAL" value="<?php echo date("d-m-Y") ?>" autocomplete="off" data-date-format="dd-mm-yyyy"
                            type="text" placeholder="dd-mm-yyyy"/>
                        </div>
                    </div>
                </div>

            </div>

              <div class="col-md-6" style="display: none">
                         <label>ID</label>
                         <td>:</td>
                         <label id="ID"></label>
                     </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-body" id="id_disetujui">
                        <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelchangestatus">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ID</th>
                                    <th>FAM Asset ID</th>
                                    <th>Nama Asset</th>
                                    <th>Asset Number</th>
                                    <th>QTY</th>
                                    <th>Deskripsi</th>
                                    <th>Presentase</th>
                                    <th>Harga Perkiraan</th>
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
                <!-- end col-12 -->
            </div>
        </br>

        <div class="col-md-6">
            <div class="form-group" id="id_terjual">
                <!-- <div id="loaditemclass"> -->
                    <label class="control-label col-sm-3">Terjual</label>

                    <div class="col-sm-8">
                        <div class="input-group"> 
                         <input type="text" class="form-control" id="id_TTL_HARGA_JUAL" name="TTL_HARGA_JUAL">

                     </div>
                 </div>
             </div>
         </div>


         <div class="col-md-6">
            <div class="form-group" id="id_uploud">
                <label class="control-label col-sm-3">Uploud Document (Zip) (5MB)</label>
                <div class="col-sm-8">
                    <input id="uploadDoc_txt" type="text" style="width: 190px; border: 0px; display: none">
                    <input type="file" id="id_DISETUJUI_PATH" name="DISETUJUI_PATH" type="text" class="form-control" size="40">
                    <br/> <div id="imagesrc"></div>
                </div>
            </div>
        </div>



</div>
</div>

  
    <!-- END SCROLLER-->

<!-- END MODAL BODY-->
<div class="modal-footer">
  <button type="button"  class="btn btn-success" id="reqsave" onclick="getsavechangestatus()" name="reqsave" value="Submit" >Save</button> 
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

<div class="modal fade draggable-modal" id="mdl_hargaperkiraan" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

        
                <!-- <input type="hidden" class="form-control" id="ID" > -->
                <div class="validator-form form-horizontal">

                <!--        <div class="form-group">
                        <label class="control-label col-sm-3">ID</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="id_ID" name="ID">
                        </div>
                    </div> -->


                      <div class="form-group">
                        <label class="control-label col-sm-3">Harga Perkiraan</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="id_HARGA" name="HARGA">
                        </div>
                    </div>      

                
                <div class="modal-footer">
                    <div class="btnSC">
                         <button type="button"  class="btn btn-success" id="reqsave" onclick="getsavehargaperkiraan()" name="reqsave" value="Submit" >Save</button> 
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



    window.onload = function () {
        $('#id_disetujui').hide();
        $('#id_terjual').hide();
        $('#id_uploud').hide();


    };

    function hiden() {
     document.getElementById('disetujui').style.display = "none";
     document.getElementById('terjual').style.display = "none";
     document.getElementById('uploud').style.display = "none";

 }

 function detail(elem) {


    if (elem == '3') { 
        $('#id_disetujui').hide();
        $('#id_terjual').hide();
        $('#id_uploud').hide();

    }else if(elem == '4'){
        $('#id_disetujui').hide();
        $('#id_terjual').hide();
        $('#id_uploud').show();

    }else if(elem == '5'){
        $('#id_disetujui').show();
        $('#id_terjual').hide();
         $('#id_uploud').hide();
    }else if(elem == '6'){
        $('#id_disetujui').hide();
        $('#id_terjual').hide();
         $('#id_uploud').hide();
    }else if(elem == '7'){
        $('#id_disetujui').hide();
        $('#id_terjual').show(); 
        $('#id_uploud').hide();
    }

}


$("#id_STATUS_PENJUALAN").select2({
    placeholder: "Please Select",
    width:'100%'
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

   
    getfamasset();
    getfamkerusakan();
    getfampengajuan();
    getfamdata();

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


function getstatus(data) {
 IDetail = data;

 $('#idTabelchangestatus').DataTable().ajax.reload();
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

// function getsavechangestatus(data) {
//  IDetail = data;

//  $('#idTabelchangestatus').DataTable().ajax.reload();
// }

function uploadAss() {
    var file_data = $('#id_DISETUJUI_PATH').prop('files')[0];
    var form_data = new FormData();
    form_data.append('ID', IDetail);
    form_data.append('STATUS_PENJUALAN', $("#id_STATUS_PENJUALAN").val());
    form_data.append('TANGGAL', $("#id_TANGGAL").val());
    form_data.append('fileUpload', file_data);
    $.ajax({
            url: "<?php echo base_url("/assetmanagement/change_status/ajax_uploadAss"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (e) {
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $("#idAss").empty();
                    $("#idAss").append('<a href="#" ><i class="jstree-icon jstree-themeicon glyphicon glyphicon-ok icon-state-success jstree-themeicon-custom"></i></a>');
                    $('#table_gridProgress').DataTable().ajax.reload();
                     $('#mdl_changestatus').modal('hide');
                    $('#table_statusku').DataTable().ajax.reload();
                }
            }
        });
}

function getsavechangestatus() {
        if($("#id_STATUS_PENJUALAN").val()==4){
uploadAss();
        }else{

    var i_clsUpdate = {
      
        ID : IDetail,
        TANGGAL: $("#id_TANGGAL").val(),
        TTL_HARGA_JUAL : $("#id_TTL_HARGA_JUAL").val(),
        // id_JML_ITEM : $("#id_JML_ITEM").val(),
        DISETUJUI_PATH : $("#id_DISETUJUI_PATH").val(),
        STATUS_PENJUALAN : $("#id_STATUS_PENJUALAN").val(),
    }

    $.ajax({
        type: "POST",
        cache: false,
        data : {sTbl: i_clsUpdate},
        dataType: "JSON",
        url: "<?php echo base_url("/assetmanagement/change_status/savedata"); ?>", // json datasource
        success: function (e) {

             $('#mdl_changestatus').modal('hide');
             $('#table_statusku').DataTable().ajax.reload();
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
}


 $('#idTabelchangestatus tbody').on('click', '#btnHarga', function () {
        // alert('tester');
    // $('#mdl_detail_pengajuan').find('.modal-title').text('Detail');

        var iclosestRow = $(this).closest('tr');
        // var iclosestRow = $(this).children('tr:first');
        var idata = dataTable.row(iclosestRow).data();
        console.log(idata);

        $("#ID").text(idata[2])
        $("#id_HARGA").val(idata[8]);
    });






var IDassethapus="";
function gethargaperkiraan(data) {
 IDassethapus = data;

       
}





function getsavehargaperkiraan(data) {
 

    var i_clsUpdate = {
      
        ID : IDassethapus,

        HARGA: $("#id_HARGA").val(),

    }

    $.ajax({
        type: "POST",
        cache: false,
        data : {sTbl: i_clsUpdate},
        dataType: "JSON",
        url: "<?php echo base_url("/assetmanagement/change_status/savedatahargaperkiraan"); ?>", // json datasource
        success: function (e) {

             $('#mdl_hargaperkiraan').modal('hide');
             $('#idTabelchangestatus').DataTable().ajax.reload();

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

$('#table_gridCategory').on('click', '#btnDetsadasdail', function () {
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
$('#table_gridCategory').on('click', '#btnUpdadsadte', function () {



    $('#mdl_Update').find('.modal-title').text('Update');
    $('#idTabelkehilangan').DataTable().ajax.reload();
    $('#idTabelkerusakan').DataTable().ajax.reload();
    $('#idTabelpengajuan').DataTable().ajax.reload();

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


function getfampengajuan(){
    dataTable = $('#idTabelpengajuan').DataTable({
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
                    url: "<?php echo base_url("/assetmanagement/assetlist/get_server_side_pengajuan"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {

                      z.sID_ASSET = iID_ASSET;
                      z.sSearch = iSearch;

                        // z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".idTabelpengajuan-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#idTabelpengajuan tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#idTabelpengajuan_processing").css("display", "none");

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
var IDassethapus = '';

// $('#idTabelchangestatus tbody').on('click', '#btnHarga', function () {
//         alert('tester');
//     // $('#mdl_detail_pengajuan').find('.modal-title').text('Detail');

//         var iclosestRow = $(this).closest('tr');
//         // var iclosestRow = $(this).children('tr:first');
//         var idata = dataTable.row(iclosestRow).data();
//         console.log(idata);

//         IDassethapus = idata[1];
//         $("#ID").text(idata[1])
//         $("#id_HARGA").val(idata[3]);
//     });



      jQuery(document).ready(function () {
        dataTable = $('#idTabelchangestatus').DataTable({
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
                    url: "<?php echo base_url("/assetmanagement/change_status/get_server_side_changestatus"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {

                     z.IDetail = IDetail;
                     z.sSearch = iSearch;

                        // z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".idTabelchangestatus-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#idTabelchangestatus tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#idTabelchangestatus_processing").css("display", "none");

                    }
                }
            });
    });


// var IDetail = '';
// $('#table_statusku tbody').on('click', '#btnUpdate', function () {
//         // alert('tester');


//     // $('#mdl_detail_pengajuan').find('.modal-title').text('Detail');

//         var iclosestRow = $(this).closest('tr');
//         // var iclosestRow = $(this).children('tr:first');
//         var idata = dataTable.row(iclosestRow).data();
//         console.log(idata);

//         // IDetail = idata[1];




//         $('#idTabelchangestatus').DataTable().ajax.reload();
//     });



jQuery(document).ready(function () {
    dataTable1 = $('#table_statusku').DataTable({
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
                    url: "<?php echo base_url("/assetmanagement/change_status/get_server_side"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".table_statusku-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#table_statusku tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#table_statusku_processing").css("display", "none");

                    }
                }
            });
});


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