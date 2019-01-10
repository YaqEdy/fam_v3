<!-- BEGIN PAGE BREADCRUMB --> 

    <style type="text/css">

table#table_gridCategory th:nth-child(2){
    display: none;
} 
table#table_gridCategory td:nth-child(2){
    display: none;
}

table#table_gridCategory th:nth-child(4){
display: none;
} 
table#table_gridCategory td:nth-child(4){
display: none;
}

table#table_gridCategory th:nth-child(5){
display: none;
} 
table#table_gridCategory td:nth-child(5){
display: none;
}

table#table_gridCategory th:nth-child(6){
display: none;
} 
table#table_gridCategory td:nth-child(6){
display: none;
}

table#table_gridCategory th:nth-child(7){
display: none;
} 
table#table_gridCategory td:nth-child(7){
display: none;
}

table#table_gridCategory th:nth-child(13){
display: none;
} 
table#table_gridCategory td:nth-child(13){
display: none;
}
table#table_gridCategory th:nth-child(14){
display: none;
} 
table#table_gridCategory td:nth-child(14){
display: none;
}
table#table_gridCategory th:nth-child(15){
display: none;
} 
table#table_gridCategory td:nth-child(15){
display: none;
}
table#table_gridCategory th:nth-child(16){
display: none;
} 
table#table_gridCategory td:nth-child(16){
display: none;
}
table#table_gridCategory th:nth-child(17){
display: none;
} 
table#table_gridCategory td:nth-child(17){
display: none;
}
table#table_gridCategory th:nth-child(18){
display: none;
} 
table#table_gridCategory td:nth-child(18){
display: none;
}
table#table_gridCategory th:nth-child(21){
display: none;
} 
table#table_gridCategory td:nth-child(21){
display: none;
}
table#table_gridCategory th:nth-child(22){
display: none;
} 
table#table_gridCategory td:nth-child(22){
display: none;
}

table#table_gridCategory th:nth-child(23){
display: none;
} 
table#table_gridCategory td:nth-child(23){
display: none;
}
table#table_gridCategory th:nth-child(24){
display: none;
} 
table#table_gridCategory td:nth-child(24){
display: none;
}
table#table_gridCategory th:nth-child(25){
display: none;
} 
table#table_gridCategory td:nth-child(25){
display: none;
}
table#table_gridCategory th:nth-child(26){
display: none;
} 
table#table_gridCategory td:nth-child(26){
display: none;
}
table#table_gridCategory th:nth-child(27){
display: none;
} 
table#table_gridCategory td:nth-child(27){
display: none;
}
table#table_gridCategory th:nth-child(28){
display: none;
} 
table#table_gridCategory td:nth-child(28){
display: none;
}
table#table_gridCategory th:nth-child(29){
display: none;
} 
table#table_gridCategory td:nth-child(29){
display: none;
}
table#table_gridCategory th:nth-child(30){
display: none;
} 
table#table_gridCategory td:nth-child(30){
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
                                <a class="btn btn-sm btn-primary" href="#" id="btnAdd" data-toggle="modal" data-target="#mdl_Update">Add Vendor List</a>
                                <!-- <button class="btn btn-sm btn-default">Add Item Category</button> -->
                            </div>
                       
                            <div class="col-md-4">
                                <select id="statustype" name="statustype" onchange="status(this.value)" class="form-control">
                                    <option value="%">--All--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Non-Active</option>
                                </select>
                            </div> <br/><br/><br/>


                            <div class="col-md-12">

                                <table class="table table-striped table-bordered table-hover text_kanan" 
                                id="table_gridCategory">
                                <thead>
                                    <tr>
                                        <th>
                                            NO
                                        </th >

                                        <th>
                                            Vendor ID
                                        </th>

                                        <th>
                                            Raw ID
                                        </th>

                                        <th>
                                         Supplier Name
                                     </th>

                                     <th>
                                      Supplier Name Alias
                                  </th>

                                  <th>
                                     Type Supplier
                                 </th>

                                 <th>
                                     NPWP
                                 </th>

                                 <th>
                                     Provinsi
                                 </th>

                                 <th>
                                     City
                                 </th>

                                 <th>
                                     Country
                                 </th>

                                 <th>
                                     Branch
                                 </th>

                                 <th>
                                     Account Liability
                                 </th>
                                 <th>
                                     Account Prepayment
                                 </th>

                                 <th>
                                     Terms
                                 </th>

                                 <th>
                                  Currency
                              </th>

                              <th>
                               Nomor Rekening
                           </th>


                           <th>
                               Nama Bank
                           </th>

                           <th>
                               Masa Berlaku TDP
                           </th>

                           <th>
                               Uploud Document

                           </th>

                           <th>
                               Alamat NPWP
                           </th>

                           <th>
                               Alamat Supplier
                           </th>

                           <th>
                              Address1 &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                          </th>

                          <th>
                           Performance
                       </th>

                       <th>
                           PKP
                       </th>
                       <th>
                           Nama Rekening
                       </th>

                         <th>
                           NamaRekening2
                       </th>

                       <th>
                           NamaBank2
                       </th>
                       <th>
                           NomorRekening2
                       </th>

                        <th>
                           NamaRekening3
                       </th>

                       <th>
                           NamaBank3
                       </th>
                       <th>
                           NomorRekening3
                       </th>


                       <th>
                        Action &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    </th>

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
            <form enctype="multipart/form-data" id="formVendorList">
                <input type="hidden" class="form-control" id="id_Raw_ID" name="Raw_ID" >
                <div class="validator-form form-horizontal">

                   <div class="row">

                      <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Supplier Name</label>
                            <div class="col-sm-8">
                             <input type="text" class="form-control" required id="id_VendorName" name="VendorName">
                         </div>
                     </div>
                 </div>


                 <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Supplier Name Alias </label>
                        <div class="col-sm-8">
                         <input type="text" class="form-control" required id="id_VendorAlias" name="VendorAlias">
                     </div>
                 </div>
             </div>

             <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-sm-4">Type Supplier</label>
                    <div class="col-sm-8">
                        <select   name="AFILIASI" class="form-control" 
                        id="id_AFILIASI">
                        <option value="">--Pilih--</option>
                        <option value="Afiliasi">Afiliasi</option>
                        <option value="NonAfiliasi">Non Afiliasi</option>
                        >
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

       <div class="col-md-4">
        <div class="form-group">
            <label class="control-label col-sm-4">NPWP</label>
            <div class="col-sm-8">
             <input type="text" class="form-control" id="id_NPWP" name="NPWP">
         </div>
     </div>
 </div>

 <div class="col-md-4">
    <div class="form-group">
        <label class="control-label col-sm-4">Provinsi</label>
        <div class="col-sm-8">
          <select class="form-control" type="text" id="id_IdProvinsi" name="IdProvinsi">
            <option value="" >--Select--</option>
            <?php foreach ($item_classprov as $row) { ?>
                <option value="<?php echo $row->IdProvinsi; ?>"><?php echo $row->NamaProvinsi; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
</div>


<div class="col-md-4">
    <div class="form-group">
        <label class="control-label col-sm-4">City</label>
        <div class="col-sm-8">
         <select class="form-control input-sm" type="text" required id="id_city" name="city">
            <option value="" >--Select--</option>
            <?php foreach ($item_branch as $row) { ?>
                <option value="<?php echo $row->FLEX_VALUE; ?>"><?php echo $row->BRANCH_DESC; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
</div>
</div>


<div class="row">

<div class="col-md-4">
<div class="form-group">
    <label class="control-label col-sm-4">Country</label>
    <div class="col-sm-8">
     <select class="form-control input-sm" id="id_ID_Country" required name="ID_Country" >
        <option value="" >--Select--</option>
        <?php foreach ($item_country as $row) { ?>
            <option value="<?php echo $row->ID_Country; ?>"><?php echo $row->CountryName; ?></option>
        <?php } ?>
    </select>
</div>
</div>
</div>


<div class="col-md-4">
<div class="form-group">
    <label class="control-label col-sm-4">Branch</label>
    <div class="col-sm-8">
     <select class="form-control input-sm" type="text" required id="id_ID_Branch" name="ID_Branch" multiple="multiple">
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
    <label class="control-label col-sm-4">Account Liability</label>
    <div class="col-sm-8">
        <select   name="AccountLiability" class="form-control" required 
        id="id_AccountLiability" disabled>
        <option value="2159998">2159998</option>
        <!-- <option value="">--Pilih--</option> -->
       
        
    </select>
</div>
</div>
</div>

</div>


<div class="row">





<div class="col-md-4">
<div class="form-group">
    <label class="control-label col-sm-4">Terms</label>
    <div class="col-sm-8">
        <select   name="Terms" class="form-control" required 
        id="id_Terms">
        <option value="">--Pilih--</option>
        <option value="Immediate">Immediate</option>

    </select>
</div>
</div>
</div>


<div class="col-md-4">
<div class="form-group">
    <label class="control-label col-sm-4">Currency</label>
    <div class="col-sm-8">
        <select   name="Currency" class="form-control" required 
        id="id_Currency">
        <option value="">--Pilih--</option>
        <option value="IDR">IDR</option>

    </select>
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
    <label class="control-label col-sm-4">Account Prepayment</label>
    <div class="col-sm-8">
        <select   name="AccountPrepayment" class="form-control"  id="id_AccountPrepayment" required disabled>
       
            <option value="1209098">1209098</option>

        </select>
    </div>
</div>
</div>

</div>

<div class="row">

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label col-sm-4">PKP</label>
        <div class="col-sm-8">
            <select   name="PKP" class="form-control" 
            id="id_PKP">
            <option value="">--Pilih--</option>
            <option value="0">NON PKP</option>
            <option value="1">PKP</option>
            >
        </select>
    </div>
</div>
</div>



<div class="col-md-4">
<div class="form-group">
    <label class="control-label col-sm-4">Masa Berlaku TDP</label>
    <div class="col-sm-8">
        <input id="id_MasaBerlakuTDP" class="form-control 
        date-picker input-sm cls_tglhariini" name="MasaBerlakuTDP" value="<?php echo date("d-m-Y") ?>" autocomplete="off" data-date-format="dd-mm-yyyy"
        type="text" placeholder="dd-mm-yyyy"/>
    </div>
</div>
</div>



<div class="col-md-4">
<div class="form-group">
    <label class="control-label col-sm-4">Uploud Document (Zip) (5MB)</label>
    <div class="col-sm-8">
        <input id="uploadDoc_txt" type="text" style="width: 190px; border: 0px; display: none">
        <input type="file" id="id_Image" name="Image" type="text" class="form-control" size="40">
        <br/> <div id="imagesrc"></div>
    </div>
</div>
</div>
</div>


<div class="row">

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label col-sm-4">Alamat NPWP</label>
        <div class="col-md-8">
            <textarea required id="id_AlamatNPWP"  name="AlamatNPWP" class="form-control input-sm" type="text"></textarea>
        </div>
    </div>
</div>


<div class="col-md-4">
    <div class="form-group">
        <label class="control-label col-sm-4">Alamat Supplier</label>
        <div class="col-md-8">
            <textarea required id="id_AlamatSupplier"  name="AlamatSupplier" class="form-control input-sm" type="text"></textarea>
        </div>
    </div>
</div>



<div class="col-md-4">
    <div class="form-group">
        <label class="control-label col-sm-4">Address1</label>
        <div class="col-md-8">
            <textarea required id="id_VendorAddress"  name="VendorAddress" class="form-control input-sm" type="text"></textarea>
        </div>
    </div>
</div>

</div>

<div class="row">

<div class="col-md-4">
<div class="form-group">
    <label class="control-label col-sm-4">Performance</label>
    <div class="col-md-8">
        <select class="form-control" type="text"  name="Performance" id="id_Performance" >
            <option value="">-- Select --</option>
            <option value="1">Baik</option>                
            <option value="2">Kurang Baik</option>
            <option value="3">Tidak Baik</option>
        </select>
    </div>
</div>
</div>


</div>

</div>

<div class="row" id="id_bank1">


<div class="col-md-4">
<div class="form-group">
    <!-- <div id="loaditemclass"> -->
        <label class="control-label col-sm-4">Nomor Rekening</label>
        <div class="col-sm-8">
         <input type="text" class="form-control" id="id_NomorRekening" name="NomorRekening" onkeypress="return isNumber(event)">
     </div>
 </div>
</div>



<div class="col-md-4">
<div class="form-group">
    <!-- <div id="loaditemclass"> -->
        <label class="control-label col-sm-3">Nama Rekening</label>
        <div class="col-sm-8">
         <input type="text" class="form-control" id="id_NamaRekening" name="NamaRekening">
     </div>
 </div>
</div>


<div class="col-md-4">
<div class="form-group">
    <!-- <div id="loaditemclass"> -->
        <label class="control-label col-sm-3">Nama Bank</label>
        
        <div class="col-sm-8">
        <div class="input-group"> 
             <input type="text" class="form-control" id="id_NamaBank" name="NamaBank">
             <span class="input-group-btn" style='vertical-align: top;'>
             <a href="javascript:;" class="btn btn-icon-only green" onclick="addbank()">
                <i class="fa fa-plus"></i>
            </a>
        </span>
        </div>
    </div>
</div>
</div>
</div>



<div class="row" id="id_bank2" hidden>


<div class="col-md-4">
<div class="form-group">
    <!-- <div id="loaditemclass"> -->
        <label class="control-label col-sm-4">Nomor Rekening</label>
        <div class="col-sm-8">
         <input type="text" class="form-control" id="id_NomorRekening2" name="NomorRekening2" onkeypress="return isNumber(event)">
     </div>
 </div>
</div>



<div class="col-md-4">
<div class="form-group">
    <!-- <div id="loaditemclass"> -->
        <label class="control-label col-sm-3">Nama Rekening</label>
        <div class="col-sm-8">
         <input type="text" class="form-control" id="id_NamaRekening2" name="NamaRekening2">
     </div>
 </div>
</div>


<div class="col-md-4">
<div class="form-group">
    <!-- <div id="loaditemclass"> -->
        <label class="control-label col-sm-3">Nama Bank</label>
        
        <div class="col-sm-8">
        <div class="input-group"> 
             <input type="text" class="form-control" id="id_NamaBank2" name="NamaBank2">
             
        </div>
    </div>
</div>
</div>
</div>


<div class="row" id="id_bank3" hidden>


<div class="col-md-4">
<div class="form-group">
    <!-- <div id="loaditemclass"> -->
        <label class="control-label col-sm-4">Nomor Rekening</label>
        <div class="col-sm-8">
         <input type="text" class="form-control" id="id_NomorRekening3" name="NomorRekening3" onkeypress="return isNumber(event)">
     </div>
 </div>
</div>



<div class="col-md-4">
<div class="form-group">
    <!-- <div id="loaditemclass"> -->
        <label class="control-label col-sm-3">Nama Rekening</label>
        <div class="col-sm-8">
         <input type="text" class="form-control" id="id_NamaRekening3" name="NamaRekening3">
     </div>
 </div>
</div>


<div class="col-md-4">
<div class="form-group">
    <!-- <div id="loaditemclass"> -->
        <label class="control-label col-sm-3">Nama Bank</label>
        
        <div class="col-sm-8">
        <div class="input-group"> 
             <input type="text" class="form-control" id="id_NamaBank3" name="NamaBank3">
             
        </div>
    </div>
</div>
</div>
</div>



<div class="modal-footer">

<div class="btnSC">
    <button type="submit" class="btn btn-success save" >Save</button>
    <button type="submit" class="btn btn-success update" >Update</button>
    <button type="button" class="btn btn-warning close_" data-dismiss="modal">Close</button>                
</div>

</div>
</form>
</div>
</div>
</div>
</div>



<?php $this->load->view('app.min.inc.php'); ?>

<script>
$("#id_ID_Branch").select2({
placeholder: "Please Select",
width:'100%'
});
$("#id_IdProvinsi").select2({
placeholder: "Please Select",
width:'100%'
});
$("#id_city").select2({
placeholder: "Please Select",
width:'100%'
});


$('#id_ID_Branch').on('change', function() {
  var iVal = $("#id_ID_Branch").val();      
  if(iVal!=null){
   idata=iVal.join();          
  }
  console.log(idata);
});

var dataTable;
var idata=null;
var iStatusAdd = '1';
var iStatus = '%';
var iSearch = '%';
$('#id_bankkamu').show();


$("#btnAdd").click(function () {
      if (ibank>=2){
                ibank=0;
                $('#id_bank2').hide();
                $('#id_bank3').hide();
            }
    $('#mdl_Update').find('.modal-title').text('Add');
    $("#id_Raw_ID").val("Generate");
    $("#VendorID").val("");
    $("#id_VendorName").val("");
    $("#id_VendorAlias").val("");
    $("#id_AFILIASI").val("");
    $("#id_NPWP").val("");
    $("#id_NamaProvinsi").select2("");
    // $("#id_city").select2("");
    $("#id_city").val("");
    $("#id_CountryName").val("");
    $("#id_ID_Branch").select2("val","");
    // $("#id_AccountLiability").val("");
    // $("#id_AccountPrepayment").val("");
    $("#id_Terms").val("");
    $("#id_Currency").val("");
    $("#id_NoRekening").val("");
    $("#id_NamaBank").val("");
    $("#id_MasaBerlakuTDP").val("");
    $("#id_Image").val("");
    $("#id_AlamatNPWP").val("");
    $("#id_AlamatSupplier").val("");
    $("#id_VendorAddress").val("");
    $("#id_Performance").val("");
    $("#id_PKP").val("");
    $("#id_NamaRekening").val("");
    $("#id_NamaRekening2").val("");
    $("#id_NamaBank2").val("");
    $("#id_NomorRekening2").val("");
    $("#id_NamaRekening3").val("");
    $("#id_NamaBank3").val("");
    $("#id_NomorRekening3").val("");
    $("#imagesrc").hide();


    document.getElementById("id_Raw_ID").readOnly = false;
    document.getElementById("id_VendorName").readOnly = false;
    document.getElementById("id_VendorAlias").readOnly = false;
    document.getElementById("id_AFILIASI").readOnly = false;
    document.getElementById("id_NPWP").readOnly = false;
    document.getElementById("id_AccountLiability").readOnly = false;


    $(".btnSC").show();
    $(".btnSC .save").show();
    $(".btnSC .update").hide();
    $(".btnSC .close_").show();
    $(".status").show();
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
                url: "<?php echo base_url("/master/master_vendorlist/ajax_UpdateStatusCategory"); ?>", // json datasource
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
                url: "<?php echo base_url("/master/master_vendorlist/ajax_UpdateStatusCategory"); ?>", // json datasource
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


window.onload = function () {
            $('#id_bank2').hide();
            $('#id_bank3').hide();
            
        };

function hidden() {
             document.getElementById('id_bank2').style.display = "none";
             document.getElementById('id_bank3').style.display = "none";
           
        }




        var ibank=0;
        function addbank() {

            // alert('addbank');
            if(ibank==0){
                $('#id_bank2').show();
            }else if(ibank==1){
                $('#id_bank3').show();
            }
            ibank=ibank+1;
            

            //     if (elem == '0') { 
            //     $('#id_bank2').hide();
            //     $('#id_bank3').hide();
           
            // }else if(elem == '1'){
            //     $('#id_bank2').show();
            //     $('#id_bank3').show();
               
            // } else{
            //     $('#id_bank2').hide();
            //     $('#id_bank2').hide();
            //     $('#id_bank3').hide();
            // }

}



//     function submit(status) {
// // alert('dasdas');
//     //alert($("#VendorName").val());
//         var i_clsUpdate = {

//             Raw_ID: $("#Raw_ID").val(),
//             VendorName: $("#VendorName").val(),
//             VendorAlias: $("#VendorAlias").val(),  
//             VendorTypeID : $("#VendorTypeID").val(),
//             NPWP: $("#NPWP").val(),
//             IdProvinsi: $("#NamaProvinsi").val(),
//             IdKabupaten: $("#NamaKabupaten").val(),  
//             IdCountry : $("#CountryName").val(),
//             ID_Branch : $("#ID_Branch").val(),
//             AccountLiability: $("#AccountLiability").val(),
//             AccountPrepayment: $("#AccountPrepayment").val(),
//             VendorTypeName: $("#txtVendorTypeName").val(),  
//             Terms : $("#Terms").val(),
//             Currency: $("#Currency").val(),
//             NoRekening: $("#NoRekening").val(),
//             NamaBank: $("#NamaBank").val(),  
//             MasaBerlakuTDP : $("#MasaBerlakuTDP").val(),
//             Image: $("#Image").val(),  
//             AlamatNPWP : $("#AlamatNPWP").val(),
//             AlamatSupplier: $("#AlamatSupplier").val(),
//             VendorAddress: $("#VendorAddress").val(),
//             Performance: $("#Performance").val(),  

//             Status: iStatusAdd
//         }
//        // console.log(i_clsUpdate);

//         if ($("#VendorName").val() == "") {
//             bootbox.alert({
//                 message: "Required Vendor  Name",
//                 backdrop: true
//             });
//         } else if ($("#VendorName").val() == "") {
//             bootbox.alert({
//                 message: "Required Vendor  Name",
//                 backdrop: true
//             });
//         } else if ($("#VendorName").val() == "") {
//             bootbox.alert({
//                 message: "Required Vendor  Name",
//                 backdrop: true
//             });
//         }else if ($("#VendorName").val() == "") {
//             bootbox.alert({
//                 message: "Required Vendor  Name",
//                 backdrop: true
//             });
//         } else {
//             if (status == "add") {
//                 var message = 'Apakah anda yakin ingin menambahkan data vendor type?';
//             } else {
//                 var message = 'Apakah anda yakin ingin Mengubah data vendor type?';
//             }
//             bootbox.confirm(message, function (o) {
//                 if (o == true) {
//                     $.ajax({
//                         type: "POST",
//                         cache: false,
//                         dataType: "JSON",
//                         url: "<?php echo base_url("/master/master_vendorlist/ajax_UpdateCategory"); ?>", // json datasource
//                         data: {sTbl: i_clsUpdate},
//                         success: function (e) {
//                            // console.log(e);
//                             if (e.msgType == true) {
//                                 bootbox.alert({
//                                     message: e.msg,
//                                     backdrop: true
//                                 }); 
//                                 $('#mdl_Update').modal('hide');
//                                 $('#table_gridCategory').DataTable().ajax.reload();
//                             } else {
//                                 alert(e.msgTitle);
//                             }
//                         }
//                     });
//                 }
//             });
//         }

//     }


// Ajax Upload Image

$('#formVendorList').submit(function(e){
    // alert('hmmmmm');
    e.preventDefault(); 



    if($("#id_VendorName").val() == "") {
        bootbox.alert({
            message: "Required Supplier Name ",
            backdrop: true
        }); 
    }else if ($("#id_VendorAlias").val() == "") {
        bootbox.alert({
            message: "Required Supplier Name Alias",
            backdrop: true
        });
    } else if ($("#id_AccountLiability").val() == "") {
        bootbox.alert({
            message: "Required Account Liability",
            backdrop: true
        });
    } else if ($("#id_AccountPrepayment").val() == "") {
        bootbox.alert({
            message: "Required Account Prepayment",
            backdrop: true
        });
    }else if ($("#id_VendorAddress").val() == "") {
        bootbox.alert({
            message: "Required dAddress1",
            backdrop: true
        });
    }else if ($("#id_AlamatSupplier").val() == "") {
        bootbox.alert({
            message: "Required Alamat Supplier ",
            backdrop: true
        });
    }else{
        var myform = $('#formVendorList');
        var disabled = myform.find(':input:disabled').removeAttr('disabled');
        $.ajax({
           url: "<?php echo base_url("/master/master_vendorlist/ajax_UpdateImage"); ?>?sBranch="+idata,
           type:"POST",
           data:new FormData(this),
           dataType: "JSON",
           processData:false,
           contentType:false,
           cache:false,
           // async:false,
           success: function(e){
            // alert(e);
                if (e.msgType == true) {
                    bootbox.alert({
                        message: e.msg,
                        backdrop: true
                    }); 
                    $('#mdl_Update').modal('hide');
                    $('#table_gridCategory').DataTable().ajax.reload();
                } else if(e.msgType == 'error_upload') {
                    bootbox.alert({
                        message: e.msg,
                        backdrop: true
                    }); 
                } else {
                    alert(e.msgTitle);
                } 
            }
        });
        disabled.attr('disabled', 'disabled'); 
 }  



});  


$('#table_gridCategory').on('click', '#btnDetail', function () {
    $('#mdl_Update').find('.modal-title').text('Detail');

    var iclosestRow = $(this).closest('tr');
    var idata = dataTable.row(iclosestRow).data();
 $('#id_bankkamu').hide();

    // OnKabItem(idata[7].trim(),idata[8].trim());
    // alert(idata[19]);
    console.log('tes',idata[35].split(','));
    console.log(iclosestRow);

    if (idata[25]){
        $('#id_bank2').show();
    }

    if (idata[28]){
        $('#id_bank3').show();
    }

// alert((idata[]));

$("#id_Raw_ID").val(idata[1]);
$("#VendorID").val(idata[2]);
$("#id_VendorName").val(idata[3]);
$("#id_VendorAlias").val(idata[4]);
$("#id_AFILIASI").val(idata[5]);
$("#id_NPWP").val(idata[6]);
$("#id_IdProvinsi").select2('val',idata[32]);
$("#id_city").select2('val',idata[8]);
$("#id_ID_Country").val(idata[34]);
$("#id_ID_Branch").select2('val',idata[35].split(','));
$("#id_AccountLiability").val(idata[11]);
$("#id_AccountPrepayment").val(idata[12]);
$("#id_Terms").val(idata[13]);
$("#id_Currency").val(idata[14]);
$("#id_NomorRekening").val(idata[15]);
$("#id_NamaBank").val(idata[16]);
$("#id_MasaBerlakuTDP").val(idata[17]);
$("#imagesrc").show();
$("#imagesrc").html(idata[18]);
$("#id_AlamatNPWP").val(idata[19]);
$("#id_AlamatSupplier").val(idata[20]);
$("#id_VendorAddress").val(idata[21]);
$("#id_Performance").val(idata[22]);
$("#id_PKP").val(idata[23]); 
$("#id_NamaRekening").val(idata[24]);
$("#id_NamaRekening2").val(idata[25]);
$("#id_NamaBank2").val(idata[26]);
$("#id_NomorRekening2").val(idata[27]);
$("#id_NamaRekening3").val(idata[28]);
$("#id_NamaBank3").val(idata[29]); 
$("#id_NomorRekening3").val(idata[30]);






    // document.getElementById("id_Raw_ID").readOnly = true;
    // document.getElementById("id_VendorName").readOnly = true;
    // document.getElementById("id_VendorAlias").readOnly = true;
    // document.getElementById("id_AFILIASI").readOnly = true;
    // document.getElementById("id_NPWP").readOnly = true;
    // document.getElementById("id_IdProvinsi").readOnly = true;
    // document.getElementById("id_AccountLiability").readOnly = true;
    
    


    $(".btnSC").hide();
    $(".status").hide();

});
$('#table_gridCategory').on('click', '#btnUpdate', function () {
    $('#mdl_Update').find('.modal-title').text('Update');

    var iclosestRow = $(this).closest('tr');
    var idata = dataTable.row(iclosestRow).data();
   
   if (idata[25]){
        $('#id_bank2').show();
    }

    if (idata[28]){
        $('#id_bank3').show();
    }

    // OnKabItem(idata[7].trim(),idata[8].trim())
    console.log(idata);
    $("#id_Raw_ID").val(idata[1]);
$("#VendorID").val(idata[2]);
$("#id_VendorName").val(idata[3]);
$("#id_VendorAlias").val(idata[4]);
$("#id_AFILIASI").val(idata[5]);
$("#id_NPWP").val(idata[6]);
$("#id_IdProvinsi").select2('val',idata[32]);
$("#id_city").select2('val',idata[8]);
$("#id_ID_Country").val(idata[34]);
$("#id_ID_Branch").select2('val',idata[35].split(','));
$("#id_AccountLiability").val(idata[11]);
$("#id_AccountPrepayment").val(idata[12]);
$("#id_Terms").val(idata[13]);
$("#id_Currency").val(idata[14]);
$("#id_NomorRekening").val(idata[15]);
$("#id_NamaBank").val(idata[16]);
$("#id_MasaBerlakuTDP").val(idata[17]);
$("#imagesrc").show();
$("#imagesrc").html(idata[18]);
$("#id_AlamatNPWP").val(idata[19]);
$("#id_AlamatSupplier").val(idata[20]);
$("#id_VendorAddress").val(idata[21]);
$("#id_Performance").val(idata[22]);
$("#id_PKP").val(idata[23]); 
$("#id_NamaRekening").val(idata[24]);
$("#id_NamaRekening2").val(idata[25]);
$("#id_NamaBank2").val(idata[26]);
$("#id_NomorRekening2").val(idata[27]);
$("#id_NamaRekening3").val(idata[28]);
$("#id_NamaBank3").val(idata[29]); 
$("#id_NomorRekening3").val(idata[30]);


    document.getElementById("id_VendorName").readOnly = false;
    document.getElementById("id_VendorAlias").readOnly = false;
    document.getElementById("id_AFILIASI").readOnly = false;
    document.getElementById("id_NPWP").readOnly = false;
    document.getElementById("id_AccountLiability").readOnly = false;


    $(".btnSC").show();
    $(".btnSC .save").hide();
    $(".btnSC .update").show();
    $(".btnSC .close_").show();
    $(".status").hide();

});


// jQuery(document).ready(function () {
//     dataTable = $('#table_gridCategory').DataTable({
//             "order": [[ 0, "asc" ],[6, "desc" ]],
//             "columnDefs": [
//             {"targets": [-1], "searchable": false, "orderable": false},
//             {"targets": [1], "visible": false, "searchable": false, "orderable": false},
//             {"targets": [4], "searchable": false, "orderable": false},
//             ],
//             "lengthMenu": [
//             [5, 10, 15, 20, 100000],
//                     [5, 10, 15, 20, "All"] // change per page values here
//                     ],
//     //                // set the initial value
//     "pageLength": 5,
//     "processing": true,
//     "serverSide": true,
//     "ajax": {
//                     url: "<?php echo base_url("/master/master_vendorlist/get_server_side"); ?>", // json datasource
//                     type: "post", // method  , by default get
//                     data: function (z) {
//                         z.sStatus = iStatus;
//                         z.sSearch = iSearch;
//                     },

//                     error: function () {  // error handling
//                         $(".table_gridCategory-error").html("");
//                         // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
//                         $('#table_gridCategory tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
//                         $("#table_gridCategory_processing").css("display", "none");

//                     }
//                 }
//             });


// });



jQuery(document).ready(function () {
    dataTable = $('#table_gridCategory').DataTable({
        "order": [[ 0, "asc" ],[22, "desc" ]],
        "columnDefs": [
        {"targets": [-1], "searchable": false, "orderable": false},
        {"targets": [1], "visible": false, "searchable": false, "orderable": false},
        {"targets": [4], "searchable": false, "orderable": false},
        ],
        "lengthMenu": [
        [5, 10, 15, 20, 100000],
            [5, 10, 15, 20, "All"] // change per page values here
            ],
//                // set the initial value
"pageLength": 5,
"processing": true,
"serverSide": true,
"ajax": {
            url: "<?php echo base_url("/master/master_vendorlist/get_server_side"); ?>", // json datasource
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
    
    // dataTable.on('click', 'tbody tr', function () {
    //             $("#navitab_2_2").trigger('click');
    //             var IClassID = $(this).find("td").eq(0).html();
    //             var ClassCode = $(this).find("td").eq(1).html();
    //             var IClassName = $(this).find("td").eq(2).html();
    //             var Priod = $(this).find("td").eq(3).html();

    //             // alert(passwd);
    //             $('#id_IClassID').val(IClassID);
    //             $('#id_ClassCode').val(ClassCode);
    //             $('#id_IClassName').val(IClassName);
    //             $('#id_Priod').val(Priod);
    //             $('#id_btnSimpan').attr('disabled', true);
    //             $('#id_btnUbah').attr('disabled', false);
    //             $('#id_btnHapus').attr('disabled', false);


    //         });


});






//   $(document).ready(function() {
//     $('#example-getting-started').multiselect();
// });



$('.date-picker').datepicker({
    orientation: "left",
    autoclose: true
});



function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}


function addrow() {
    $('#sorter').append(objek);
}

function deleterow(id){
    $('#row_'+id).fadeOut("medium",function(){
      $(this).remove(); 
      sort();      
  }); 
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