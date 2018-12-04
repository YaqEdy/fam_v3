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
                                    <a class="btn btn-sm btn-primary" href="#" id="btnAdd" data-toggle="modal" data-target="#mdl_Update">Add Request Category</a>
                                     <!-- <button class="btn btn-sm btn-default">Add Item Category</button> -->
                                 </div>
                                 <div class="col-md-2">
                                        <select id="statustype" name="statustype" onchange="status(this.value)" class="form-control">
                                            <option value="%">--All--</option>
                                            <option value="1">Active</option>
                                            <option value="0">Non-Active</option>
                                        </select>
                                    </div>
                                 <div class="col-md-2">
                                        <select id="cat_itemclass" name="cat_itemclass" onchange="search(this.value)" class="form-control">
                                            <option value="%">--All--</option>
                                            <option value="1">Category Code</option>
                                            <option value="2">Item Category Name</option>
                                        </select>
                                    </div>


                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridCategory">
                                        <thead>
                                            <tr>
                                              <th>
                                                NO
                                            </th>
                                             <th>
                                                ReqCategoryID
                                            </th>
                                             <th>
                                                Request Category Name
                                            </th>
                                            <th>
                                                Request Type
                                            </th>
                                            <th>
                                                Division 
                                            </th>
                                             <th>
                                                Cabang 
                                            </th>
                                            <th>
                                                Create Date 
                                            </th>
                                             <th>
                                                Action
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
     <form class="validator-form form-horizontal" id="savereqcat" action="" method="POST">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">                
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">

        <input type="hidden" class="form-control" id="txtId" name="txtId" >
         <div class="validator-form form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-3">Request Type</label>
            <div class="col-sm-7">
               <select id="txtReqTypeCode" name="txtReqTypeCode" required="required" class="form-control option" type="text">
                                <option value="">--Pilih--</option>
                                    <?php foreach ($Requestcategory as $value) { ?>
                                        <option value="<?php echo $value->ReqTypeID ?>"><?php echo $value->ReqTypeName ?></option>
                                                <?php } ?>
                                                
                                            </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Request Category Name</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="txtReqTypeName" name="txtReqTypeName">
            </div>
        </div>

              <div class="form-group" id="chk_list">
            <label class="control-label col-sm-3"></label>
            <div class="col-sm-7">
                <label>
                    <input class="inverted" name="chk" id="chk" value="1" type="radio">
                    <span class="text">Pusat</span>
                </label>
                <label>
                    <input class="inverted" name="chk" id="chk" value="2" type="radio">
                    <span class="text">Cabang</span>
                </label>
                <label>
                    <input class="inverted" name="chk" id="chk" value="3" type="radio">
                    <span class="text">All</span>
                </label>
            </div>
        </div>

     <div class="form-group" id='id_detail'>
            <label class="control-label col-sm-3">Main COA</label>
            <div class="col-sm-7">
                <select class="form-control option" name="COA" id="COA">
                    <?php foreach ($coa as $row) { ?>
                        <option value="<?php echo $row->BudgetID;?>"><?php echo $row->BudgetCOA . " - ";
                    echo ((int) $row->BranchCode == 00000) ? $row->BranchName . " (" . $row->DivisionName . ")" : $row->BranchName ?></option>
<?php } ?>
                </select>
            </div>
        </div>




         <hr class="dotted">

                <div class="form-group">
            <div class="col-sm-12" align="center">
                <div id="loaditemClass">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="skor">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="50%">Item Category</th>
                                <th><a class="btn btn-primary addrows" title="Klik disini untuk menambahkan data baru" onclick="addrow()">Add</a></th>
                            </tr>
                        </thead>
                        <tbody class="sorter" id="sorter">

                        </tbody>
                    </table> 
                </div>
            </div>
        </div>

  

         <div class="form-group status hidden">
            <label class="control-label col-sm-3">Status</label>
            <div class="col-sm-3">
                <select id="statustypeAdd" name="statustypeAdd" onchange="statusAdd(this.value)" class="form-control option">
                <option value="1">Active</option>
                <option value="0">Non-Active</option>
            </select>
            </div>
        </div>


    </div>

        <div class="modal-footer">
            <div class="btnSC">
                 <button type="submit" class="btn btn-primary save" name="signup" value="Submit">Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><!-- 
              <button type="button" class="btn btn-success save" onclick="clickUpdate()">Save</button>
              <button type="button" class="btn btn-success update" onclick="clickUpdate()">Update</button>
              <button type="button" class="btn btn-warning close_" data-dismiss="modal">Close</button>  -->               
          </div>

        </div>
      </div>
    </div>
  </div>
</form>
</div>


<?php $this->load->view('app.min.inc.php'); ?>

<script>
    $('#sorter').html('');

    var dataTable;
    var iStatusAdd='1';
    var iStatus='%';
    var iSearch='%';

    $('#id_detail').hide();
    $(".addrows").show();

     $("#btnAdd").click(function(){
                  $('input').attr('readonly',false);
                  $('textarea').attr('readonly',false);
                  $('.option').prop('disabled',false);
        $("#chk_list").show();
        $('#sorter').html('');
     $('#id_detail').hide();
     $('#mdl_Update').find('.modal-title').text('Add');
     $("#txtId").val("Generate");
     $("#txtReqCategoryName").val("");
     $("#txtReqTypeName").val("");
  
    
    $(".btnSC").show();
    $(".btnSC .save").show();
    $(".btnSC .update").hide();
    $(".btnSC .close_").show();
    $(".status").show();
    });



 function statusAdd(e){
        iStatusAdd=e;
    }
    function search(e){
        iSearch=e;
    }
    function status(e){
        iStatus=e;
        $('#table_gridType').DataTable().ajax.reload();
    }
    $('#table_gridCategory').on('click', '#btnAktiv', function () {
        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        console.log(idata[1]);

        var i_clsUpdate={
            txtId:idata[1],
            Status: 1
        }
        $.ajax({
          type: "POST",
          cache:false,
          dataType: "JSON",
      url: "<?php echo base_url("/master/master_requestcategory/ajax_UpdateStatusType"); ?>/"+idata[1], // json datasource
      data: { sTbl: i_clsUpdate },
      success: function (e) {
        alert('success');
        $('#mdl_Update').modal('hide');            
            $('#table_gridCategory').DataTable().ajax.reload();
        if(e.msgType==true){
            // alert(e.msgTitle);
            $('#mdl_Update').modal('hide');            
            $('#table_gridType').DataTable().ajax.reload();
        }else{
          alert(e.msgTitle);
      }
  }
});
    });

    $('#table_gridCategory').on('click', '#btnDeactivate', function () {
  var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        console.log(idata[1]);

        var i_clsUpdate={
            txtId:idata[1],
            Status: 0
        }
        $.ajax({
          type: "POST",
          cache:false,
          dataType: "JSON",
      url: "<?php echo base_url("/master/master_requestcategory/ajax_UpdateStatusType"); ?>/"+idata[1], // json datasource
      data: { sTbl: i_clsUpdate },
      success: function (e) {
        alert('success');
        $('#mdl_Update').modal('hide');            
            $('#table_gridCategory').DataTable().ajax.reload();
        if(e.msgType==true){
            // alert(e.msgTitle);
            $('#mdl_Update').modal('hide');            
            $('#table_gridType').DataTable().ajax.reload();
        }else{
          alert(e.msgTitle);
      }
  }
});
    });


      function clickUpdate(){
        var a =$('input[name=chk]:checked').val();//$("#chk").is(":checked");
        var datastring = $("#loaditemClass").serialize();
        var i_clsUpdate={
            ReqCategoryID: $("#txtId").val(),
            txtReqTypeCode: $("#txtReqTypeCode").val(),
            txtReqTypeName: $("#txtReqTypeName").val(),
            kelompok : a,
            classID : $("#classID").val(),
            statustypeAdd: $("#statustypeAdd").val(),
            // DivisionName: $("#txtDivisionName").val(),
            Status: iStatusAdd
        }
        console.log(datastring);
//         $.ajax({
//           type: "POST",
//           cache:false,
//           dataType: "JSON",
//       url: "<?php echo base_url("/master_requestcategory/ajax_UpdateType"); ?>", // json datasource
//       data: { sTbl: i_clsUpdate },
//       success: function (e) {
//         console.log(e);
//         if(e.msgType==true){
//             alert(e.msgTitle);
//             $('#mdl_Update').modal('hide');            
//             $('#table_gridType').DataTable().ajax.reload();
//         }else{
//           alert(e.msgTitle);
//       }
//   }
// });

   }

 $('#table_gridCategory').on('click', '#btnDetail', function () {
    // alert('#btnDetail');
    $('#mdl_Update').find('.modal-title').text('Detail');
     $('#sorter').html('');
    var iclosestRow = $(this).closest('tr');
    var idata = dataTable.row(iclosestRow).data();

    $(".addrows").hide();

    // var idata = document.getElementById("id_detail");
    // console.log(idata);
     var a =$('input[name=chk]:checked').val();
     var i_clsUpdate={
            ReqCategoryID: $("#txtId").val(),
            txtReqTypeCode: $("#txtReqTypeCode").val(),
            txtReqTypeName: $("#txtReqTypeName").val(),
            kelompok : a,
            classID : $("#classID").val(),
            statustypeAdd: $("#statustypeAdd").val(),
            // DivisionName: $("#txtDivisionName").val(),
            Status: iStatusAdd
        }

    $("#txtId").val(idata[1]);
    $("#txtReqCategoryName").val(idata[2]);
    $("#txtReqTypeName").val(idata[3]);
    $("#txtDivisionName").val(idata[4]);

            $("#chk_list").hide();
            $.ajax({
              type: "POST",
              cache:false,
              dataType: "JSON",
          url: "<?php echo base_url("/master/master_requestcategory/detil_reqcat"); ?>/"+idata[1], // json datasource
          data: { sTbl: i_clsUpdate },
          success: function (e) {
            $('#sorter').html('');
            console.log(e);
            console.log(e.listdata.BudgetID);
             $('#sorter').append(e.list);
             $("#COA").val(e.listdata.BudgetID.trim());
             $("#txtReqTypeCode").val(e.listdata.ReqTypeID.trim());
             $("#txtReqTypeName").val(e.listdata.ReqCategoryName.trim());
          
                  $('input').attr('readonly',true);
                  $('textarea').attr('readonly',true);
                  $('.option').prop('disabled',true);
      }
    });
    
    $(".btnSC").show();
    $(".btnSC .save").hide();
    $(".btnSC .update").hide();
    $(".btnSC .close_").show();
    $(".status").show();

  });


    $('#table_gridCategory').on('click', '#btnUpdate', function () {
          $("#id_detail").show();
    $('#mdl_Update').find('.modal-title').text('Update');

     $('#sorter').html('');
    var iclosestRow = $(this).closest('tr');
    var idata = dataTable.row(iclosestRow).data();

    $(".addrows").show();
    // var idata = document.getElementById("id_detail");
    console.log(idata);
     var a =$('input[name=chk]:checked').val();
     var i_clsUpdate={
            ReqCategoryID: $("#txtId").val(),
            txtReqTypeCode: $("#txtReqTypeCode").val(),
            txtReqTypeName: $("#txtReqTypeName").val(),
            kelompok : a,
            classID : $("#classID").val(),
            statustypeAdd: $("#statustypeAdd").val(),
            // DivisionName: $("#txtDivisionName").val(),
            Status: iStatusAdd
        }

    $("#txtId").val(idata[1]);
    $("#txtReqCategoryName").val(idata[2]);
    $("#txtReqTypeName").val(idata[3]);
    $("#txtDivisionName").val(idata[4]);

            $("#chk_list").hide();
            $.ajax({
              type: "POST",
              cache:false,
              dataType: "JSON",
          url: "<?php echo base_url("/master/master_requestcategory/edit_reqcat"); ?>/"+idata[1], // json datasource
          data: { sTbl: i_clsUpdate },
          success: function (e) {
            $('#sorter').html('');
            console.log(e);
            $("#txtId").val(e.listdata.ReqCategoryID);
             $('#sorter').append(e.list);
             $("#COA").val(e.listdata.BudgetID.trim());
             $("#txtReqTypeCode").val(e.listdata.ReqTypeID.trim());
             $("#txtReqTypeName").val(e.listdata.ReqCategoryName.trim());
          
                  $('input').attr('readonly',false);
                  $('textarea').attr('readonly',false);
                  $('.option').prop('disabled',false);
      }
    });
    
   $(".btnSC").show();
    $(".btnSC .save").show();
    $(".btnSC .update").hide();
    $(".btnSC .close_").show();
    $(".status").show();
  });

//     $('#table_gridCategory').on('click', '#btnAktiv', function () {
//         var iclosestRow = $(this).closest('tr');
//         var idata = dataTable.row(iclosestRow).data();

//         var i_clsUpdate={
//             ItemID:idata[1],
//             Status: 1
//         }
//         $.ajax({
//           type: "POST",
//           cache:false,
//           dataType: "JSON",
//       url: "<?php echo base_url("/master_itemlist/ajax_UpdateStatusCategory"); ?>", // json datasource
//       data: { sTbl: i_clsUpdate },
//       success: function (e) {
//         // console.log(e);
//         if(e.msgType==true){
//             // alert(e.msgTitle);
//             $('#mdl_Update').modal('hide');            
//             $('#table_gridCategory').DataTable().ajax.reload();
//         }else{
//           alert(e.msgTitle);
//       }
//   }
// });
//     });



     jQuery(document).ready(function () {
        dataTable = $('#table_gridCategory').DataTable({
             "columnDefs": [
                  {"targets":[ -1 ],"searchable":false,"orderable": false},
                  {"targets":[ 1 ],"visible":false,"searchable":false,"orderable": false},
                  {"targets":[ 4 ],"searchable":false,"orderable": false},
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
                url: "<?php echo base_url("/master/master_requestcategory/get_server_side"); ?>", // json datasource
                type: "post", // method  , by default get
                  data:function(z){
                    z.sStatus=iStatus;
                    z.sSearch=iSearch;
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

function objek(){ 
      $('#loaditemClass').fadeIn('slow');
          

          pos = $('.objek').length + 1;
          html = '<tr id="row_'+pos+'" class="objek">'
              +'<td width="5px">'+pos+'</td>'
              +'<td width="5px"><select  name="classID[]" id="classID[]" class="ass opsi pilihan form-control" ><option value="">--Select--</option></select></td>'
                  +'<td><a onclick="deleterow('+pos+')"><i class="fa fa-times"></i></a> <input type="hidden" class="form-control" id="tot" name="tot" value="'+pos+'" /></td>'
                +'</tr>'; 
          return html;
           $("#tot").removeAttr('disabled');
           document.getElementById("tot").value = pos;

          
      }
      
        $(document).on("click",".opsi",function(){
              var val = new Array();
              var ini = $(this);
              $("select.pilihan").not(this).each(function(){
                  val.push(this.value);
              });

              $(".catego").each(function(){                  
                  val.push($(this).attr('value'));
              });
            
              $.ajax({
                url: '<?php echo base_url(); ?>master/master_requestcategory/objekItem',
                type: 'POST',                                                                        
                sync: false,
                success: function (objek) {                                                                                                                                                                      
                    $(ini).append(objek);
                    $(ini).removeClass("opsi")
                }
              });

            })


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


  $(document).ready(function(){

          $("#savereqcat").validate({
                rules: {                                    
                  name: {
                    required: true,  
                    remote: {
                        url: "<?php echo base_url(); ?>master/master/requestcategory/cekName",
                        type: "post",
                        data: {
                            typeID: function() {
                                return $('#typeID').val();
                              }
                          }
                     }                   
                  }
                },
                messages: {                                  
                  name: {
                    required: "Please enter a name request category",
                    remote: "This category name is already taken! Try another."                           
                  }
                },
                submitHandler:function(form) {
                   $.ajax({
                      url: '<?php echo base_url("/master/master_requestcategory/add_reqcat"); ?>',//'<?php echo base_url(); ?>master/requestcategory/add_reqcat',
                      type: 'POST',
                      data: new FormData(form),
                      async: false,
                      cache: false,
                      contentType: false,
                      processData: false,
                      success: function (e) {
                                // if(e.msgType==true){
                                        alert('success');
                                        $('#mdl_Update').modal('hide');            
                                        $('#table_gridType').DataTable().ajax.reload();
                                  //   // }else{
                                  //     alert(e.msgTitle);
                                  // }
                          // var encripturl='<?php echo base_url(); ?>master/requestcategory/';
                          // $.ajax({
                          //         url      : encripturl,
                          //         type     : 'POST',
                          //         dataType : 'html',
                          //         success  : function(jawaban){                            
                          //         $('#loader_reqtab').html(jawaban);
                          //         //alert("Task Berhasil Di kirim, Silahkan menunggu respon dari bagian Warehouse kami");
                          //       },
                          // });
                      }
                    });                      
                }
              });
          
           });  

</script>


<!-- END JAVASCRIPTS