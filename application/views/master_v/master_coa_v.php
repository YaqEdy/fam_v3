<!-- BEGIN PAGE BREADCRUMB --> 


<style type="text/css">


/*
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
    */
     table#table_gridCategory th:nth-child(4){
        display: none;
    } 
    table#table_gridCategory td:nth-child(4){
        display: none;
    }


    table#coa_table th:nth-child(5){
        display: none;
    } 
    table#coa_table td:nth-child(5){
        display: none;
  
    }
     table#coa_table th:nth-child(4){
        display: none;
    } 
    table#coa_table td:nth-child(4){
        display: none;
    }


    table#subcoa_table th:nth-child(5){
        display: none;
    } 
    table#subcoa_table td:nth-child(5){
        display: none;
  
    }
     table#subcoa_table th:nth-child(4){
        display: none;
    } 
    table#subcoa_table td:nth-child(4){
        display: none;
    }


    table#lob_table th:nth-child(5){
        display: none;
    } 
    table#lob_table td:nth-child(5){
        display: none;
  
    }
     table#lob_table th:nth-child(4){
        display: none;
    } 
    table#lob_table td:nth-child(4){
        display: none;
    }



    table#div_table th:nth-child(5){
        display: none;
    } 
    table#div_table td:nth-child(5){
        display: none;
  
    }
     table#div_table th:nth-child(4){
        display: none;
    } 
    table#div_table td:nth-child(4){
        display: none;
    }

    table#type_table th:nth-child(5){
        display: none;
    } 
    table#type_table td:nth-child(5){
        display: none;
  
    }
     table#type_table th:nth-child(4){
        display: none;
    } 
    table#type_table td:nth-child(4){
        display: none;
    }

    table#project_table th:nth-child(5){
        display: none;
    } 
    table#project_table td:nth-child(5){
        display: none;
  
    }
     table#project_table th:nth-child(4){
        display: none;
    } 
    table#project_table td:nth-child(4){
        display: none;
    }

    table#future1_table th:nth-child(5){
        display: none;
    } 
    table#future1_table td:nth-child(5){
        display: none;
  
    }
     table#future1_table th:nth-child(4){
        display: none;
    } 
    table#future1_table td:nth-child(4){
        display: none;
    }

     table#future2_table th:nth-child(5){
        display: none;
    } 
    table#future2_table td:nth-child(5){
        display: none;
  
    }
     table#future2_table th:nth-child(4){
        display: none;
    } 
    table#future2_table td:nth-child(4){
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
               <!--  <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div> -->
                 <div class="tools">
                     <button class="btn green-meadow" onclick="sys_coa()">Button Sync API <i class="fa fa-refresh green"></i></button>
                    <!-- <a href="javascript:;" class="collapse"> -->
                    <!-- </a> -->
                    <!-- <a href="javascript:;" class="fullscreen"> -->
                    <!-- </a> -->
                </div>
            </div>
            <div class="portlet-body">
                 <ul class="nav nav-pills">
                     <li class="linav active" id="linav1">
                         <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                             Data Branch </a>
                     </li>
                     <li class="linav" id="linav2">
                         <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Data Account</a>
                     </li>

                      <li class="linav" id="linav3">
                         <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">
                            Data Sub Account</a>
                     </li>

                      <li class="linav" id="linav4">
                         <a href="#tab_2_4" data-toggle="tab" id="navitab_2_4" class="anavitab">
                            Data LOB</a>
                     </li>

                        <li class="linav" id="linav5">
                         <a href="#tab_2_5" data-toggle="tab" id="navitab_2_5" class="anavitab">
                            Data Division</a>
                     </li>

                        <li class="linav" id="linav5">
                         <a href="#tab_2_6" data-toggle="tab" id="navitab_2_6" class="anavitab">
                            Data Type</a>
                     </li>

                      <li class="linav" id="linav5">
                         <a href="#tab_2_7" data-toggle="tab" id="navitab_2_7" class="anavitab">
                            Data Project</a>
                     </li>

                     <li class="linav" id="linav5">
                         <a href="#tab_2_8" data-toggle="tab" id="navitab_2_8" class="anavitab">
                            Data Future1</a>
                     </li>

                      <li class="linav" id="linav5">
                         <a href="#tab_2_9" data-toggle="tab" id="navitab_2_9" class="anavitab">
                            Data Future2</a>
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
                                                <th>
                                                    ID
                                                </th>                                      
                                                <th >
                                                   Kode Cabang
                                                </th>
                                                <th>
                                                    Nama Cabang
                                                </th>
                                                 <th>
                                                    ID
                                                </th>
                                                 <th>
                                                    ZONASI
                                                </th>
                                                 <th>
                                                    AKSI
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
                                                    ID
                                                </th>                                      
                                                <th >
                                                   Kode Account
                                                </th>
                                                <th>
                                                    Nama Account
                                                </th>
                                                <th>
                                                    ENABLED_FLAG
                                                </th>
                                                 <th>
                                                    SUMMARY_FLAG
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

                <div class="tab-pane" id="tab_2_3">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                              
                                  <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="subcoa_table">
                                        <thead>
                                            <tr>
                                                <th width="5%">
                                                    NO
                                                </th >     
                                                <th>
                                                    ID
                                                </th>                                      
                                                <th >
                                                  Kode Sub Account
                                                </th>
                                                <th>
                                                    Nama Sub Account
                                                </th>
                                                <th>
                                                    ENABLED_FLAG
                                                </th>
                                                 <th>
                                                    SUMMARY_FLAG
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



                        <div class="tab-pane" id="tab_2_4">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="lob_table">
                                        <thead>
                                            <tr>
                                                <th width="5%">
                                                    NO
                                                </th >     
                                                <th>
                                                    ID
                                                </th>                                      
                                                <th >
                                                  Kode Line of business
                                                </th>
                                                <th>
                                                   Nama Line of business
                                                </th>
                                                <th>
                                                    ENABLED_FLAG
                                                </th>
                                                 <th>
                                                    SUMMARY_FLAG
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




                        <div class="tab-pane" id="tab_2_5">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="div_table">
                                        <thead>
                                            <tr>
                                                <th width="5%">
                                                    NO
                                                </th >     
                                                <th>
                                                    ID
                                                </th>                                      
                                                <th >
                                                 Kode Division
                                                </th>
                                                <th>
                                                   Nama Division
                                                </th>
                                                <th>
                                                    ENABLED_FLAG
                                                </th>
                                                 <th>
                                                    SUMMARY_FLAG
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





                        <div class="tab-pane" id="tab_2_6">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="type_table">
                                        <thead>
                                            <tr>
                                                <th width="5%">
                                                    NO
                                                </th >     
                                                <th>
                                                    ID
                                                </th>                                      
                                                <th >
                                                  Kode Type
                                                </th>
                                                <th>
                                                   Nama Type
                                                </th>
                                                <th>
                                                    ENABLED_FLAG
                                                </th>
                                                 <th>
                                                    SUMMARY_FLAG
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





                           <div class="tab-pane" id="tab_2_7">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="project_table">
                                        <thead>
                                            <tr>
                                                <th width="5%">
                                                    NO
                                                </th >     
                                                <th>
                                                    ID
                                                </th>                                      
                                                <th >
                                                  Kode Project
                                                </th>
                                                <th>
                                                  Nama Project
                                                </th>
                                                <th>
                                                    ENABLED_FLAG
                                                </th>
                                                 <th>
                                                    SUMMARY_FLAG
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



                           <div class="tab-pane" id="tab_2_8">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="future1_table">
                                        <thead>
                                            <tr>
                                                <th width="5%">
                                                    NO
                                                </th >     
                                                <th>
                                                    ID
                                                </th>                                      
                                                <th >
                                                   Kode Future 1
                                                </th>
                                                <th>
                                                  Nama Future 1
                                                </th>
                                                <th>
                                                    ENABLED_FLAG
                                                </th>
                                                 <th>
                                                    SUMMARY_FLAG
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




                    <div class="tab-pane" id="tab_2_9">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="future2_table">
                                        <thead>
                                            <tr>
                                                <th width="5%">
                                                    NO
                                                </th >     
                                                <th>
                                                    ID
                                                </th>                                      
                                                <th >
                                                   Kode Future 2
                                                </th>
                                                <th>
                                                  Nama Future 2
                                                </th>
                                                <th>
                                                    ENABLED_FLAG
                                                </th>
                                                 <th>
                                                    SUMMARY_FLAG
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
                <button type="button" class="close" data-dismiss="modal" id="btncloseupdate">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
           
            <div class="modal-body">

                <input type="hidden" class="form-control" id="ID" >

                <div class="validator-form form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-3">ZONASI</label>
                        <div class="col-sm-7">
                        <?php
                        $data = array();
                        $data[''] = '';
                         foreach ($dd_zonasi as $k) :
                            $data[$k->ZoneID] = $k->ZoneName;
                            endforeach;
                            echo form_dropdown('ZoneName', $data, '', 'id="id_zonasi" name="id_zonasi" class="form-control " required');
                        ?>
                            <!-- <input type="text" class="form-control" id="id_zonasi" nama="id_zonasi"> -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="btnSC">
                 <!--        <button type="button" class="btn btn-success save" onclick="clickUpdate('add')">Save</button> -->
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

    // $("#btnAdd").click(function () {
    //     $('#mdl_Update').find('.modal-title').text('Add');
    //     $("#txtRaw_ID").val("Generate");
    //     $("#txtVendorTypeID").val("");
    //     $("#txtVendorTypeName").val("");



    //     document.getElementById("txtVendorTypeID").readOnly = true;
    //     document.getElementById("txtVendorTypeName").readOnly = false;

    //     $(".btnSC").show();
    //     $(".btnSC .save").show();
    //     $(".btnSC .update").hide();
    //     $(".btnSC .close_").show();
    //     $(".status").hide();
    // });
    // function statusAdd(e) {
    //     iStatusAdd = e;
    // }
    // function search(e) {
    //     iSearch = e;
    // }
    // function status(e) {
    //     iStatus = e;
    //     $('#table_gridCategory').DataTable().ajax.reload();
    // }
    // $('#table_gridCategory').on('click', '#btnAktiv', function () {
    //     var iclosestRow = $(this).closest('tr');
    //     var idata = dataTable.row(iclosestRow).data();

    //     var i_clsUpdate = {
    //         Raw_ID: idata[1],
    //         name: idata[3],
    //         Status: 1
    //     }
    //     bootbox.confirm("Apakah anda yakin meng-aktifkan data " + idata[3] + "?", function (o) {
    //         if (o == true) {
    //             $.ajax({
    //                 type: "POST",
    //                 cache: false,
    //                 dataType: "JSON",
    //                 url: "<?php echo base_url("/master/master_vendortype/ajax_UpdateStatusCategory"); ?>", // json datasource
    //                 data: {sTbl: i_clsUpdate},
    //                 success: function (e) {
    //                     // console.log(e);
    //                     if (e.msgType == true) {
    //                         bootbox.alert({
    //                             message: e.msg,
    //                             backdrop: true
    //                         });
    //                         $('#mdl_Update').modal('hide');
    //                         $('#table_gridCategory').DataTable().ajax.reload();
    //                     } else {
    //                         alert(e.msgTitle);
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // });

    // $('#table_gridCategory').on('click', '#btnDeactivate', function () {
    //     var iclosestRow = $(this).closest('tr');
    //     var idata = dataTable.row(iclosestRow).data();

    //     var i_clsUpdate = {
    //         Raw_ID: idata[1],
    //         Status: 0
    //     }
    //     bootbox.confirm("Apakah anda yakin meng-nonaktifkan data " + idata[3] + "?", function (o) {
    //         if (o == true) {
    //             $.ajax({
    //                 type: "POST",
    //                 cache: false,
    //                 dataType: "JSON",
    //                 url: "<?php echo base_url("/master/master_vendortype/ajax_UpdateStatusCategory"); ?>", // json datasource
    //                 data: {sTbl: i_clsUpdate},
    //                 success: function (e) {
    //                     // console.log(e);
    //                     if (e.msgType == true) {
    //                         bootbox.alert({
    //                             message: e.msg,
    //                             backdrop: true
    //                         });
    //                         $('#mdl_Update').modal('hide');
    //                         $('#table_gridCategory').DataTable().ajax.reload();
    //                     } else {
    //                         alert(e.msgTitle);
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // });





    // $('#table_gridCategory').on('click', '#btnUpdateku', function () {
    //     alert('dsd');
    //     $('#mdl_Update').find('.modal-title').text('Update');

    //     var iclosestRow = $(this).closest('tr');
    //     var idata = dataTable.row(iclosestRow).data();
    //     console.log(idata);
    //     // alert(idata);
    //     $("#ID").val(idata[1]);
    //     // $("#txtVendorTypeID").val(idata[2]);
    //     $("#id_zonasi").val(idata[4]);

    //     // document.getElementById("ID").readOnly = true;
    //     document.getElementById("id_zonasi").readOnly = false;

    //     $(".btnSC").show();
    //     $(".btnSC .save").hide();
    //     $(".btnSC .update").show();
    //     $(".btnSC .close_").show();
    //     $(".status").hide();

    // });

    function tmplEdit(value){
                // alert(value);
                console.log(value);
            var res = value.split("#");
            var ID = res[0];
            var ZONE_ID = res[1];
            $("#ID").val(ID);
            $("#id_zonasi").val(ZONE_ID);
    }

        // console.log(value);

        // $('#mdl_Update').trigger("click");
        
        // var res = value.split("#");
        // var ID = res[0];
        // var ZONE_ID = res[1];
        // $('#ID').val(value);
        // $('#id_zonasi').val(value);


 function clickUpdate(){
        var ID = $('#ID').val();
        var id_zonasi = $('#id_zonasi').val();

         $.ajax({

            url: "<?php echo base_url("/master/master_coa/update_masterzonasi"); ?>", // json datasource
            type: 'POST',
            data: {ID : ID,id_zonasi : id_zonasi},       
            dataType: "JSON",
            success: function (e) {
                // alert('sdad');
                console.log();
                $('#btncloseupdate').click();
                    UIToastr.init(e.tipePesan, e.pesan);
              
                    event.preventDefault(); 

               
            },
            complete:function(e){
                $('#table_gridCategory').DataTable().ajax.reload();
            }
        }); 
    } 

    //     function editData(input) {
    //         alert('erv');
    //     $('#myModaleki').trigger("click");
    //     // $('#table_gridUSER').on('click', '#btnUpdate2');
    //     $.post("tampil_data",
    //         {
    //             'user_id': input //id yang dilempar
    //         },
    //         function (data) {
    //             console.log(data);
    //             if (data.data_res.length > 0) {
    //                 // $group = '1';
    //                 for (i = 0; i < data.data_res.length; i++) {
    //                     // alert(data.data_res[i].);
    //                     // console.log(data.data_res[i].DivisionID);
    //                     $('#idsdm2').val(data.data_res[i].idsdm);
    //                     $('#user_id2').val(data.data_res[i].user_id);
    //                     $('#nik_edit').val(data.data_res[i].nik);
    //                     $('#user_name_edit').val(data.data_res[i].user_name);
    //                     $('#name_edit').val(data.data_res[i].name);
    //                     $('#email_edit').val(data.data_res[i].user_email);
    //                     $('#id_groupUser_edit').select2('val',data.data_res[i].user_groupid);
    //                     $('#id_division_edit').select2('val',data.data_res[i].DivisionID);
    //                     $('#id_branch_edit').select2('val',data.data_res[i].BranchID);
    //                     $('#id_statusUser_edit').select2('val',data.data_res[i].status);
    //                     $('#id_position_edit').select2('val',data.data_res[i].PositionID);
    //                     $('#id_zone_edit').select2('val',data.data_res[i].ZoneID); 
    //                     $('#id_btnUbah').attr("disabled", false);
    //                     $('#id_btnSimpan').attr("disabled", true);
    //                     $('#id_data').val(input);
    //                     // id_groupUser_edit
    //                 }
    //             }       
    //         }, "JSON");

    // }


    // $('#idFormUser2').submit(function (event) {
    //         // alert('asd')  
    //     var iclosestRow = $(this).closest('tr');
    //     var idata = dataTable.row(iclosestRow).data();      
    //     var r = confirm('Apakah anda ingin merubah data ini ?');
    //         if (r == true) {
    //             $.ajax({

    //         url: "ubah", // json datasource
    //         type: 'POST',
    //         data: new FormData(this),
    //         async: false,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         dataType: "JSON",
    //         success: function (e) {
    //             if(e.act){
    //                 UIToastr.init(e.tipePesan, e.pesan);
    //                 iPID=e.iPid;
    //                 console.log(idata);
    //                     $('#idsdm2').val(data.data_res[i].idsdm);
    //                     // $('#user_id2').val(data.data_res[i].user_id);
    //                     $('#nik_edit').val(data.data_res[i].nik);
    //                     $('#user_name_edit').val(data.data_res[i].user_name);
    //                     $('#name_edit').val(data.data_res[i].name);
    //                     $('#email_edit').val(data.data_res[i].email);
    //                     $('#edit_usergroup').val(data.data_res[i].user_groupid);
    //                     $('#DivisionID2').val(data.data_res[i].DivisionID);
    //                     $('#status2').val(data.data_res[i].status);
    //                     $('#id_btnUbah').attr("disabled", false);
    //                     $('#id_btnSimpan').attr("disabled", true);
    //                     // $('#id_data').val(input);
    //             }else{
    //                 UIToastr.init(e.tipePesan, e.pesan);
    //             }
    //         },
    //         complete:function(e){
    //             $('#table_gridUSER').DataTable().ajax.reload();
    //         }
    //     }); 
    //             event.preventDefault(); 
    //         } else {//if(r)
    //             return false;
    //         }
             
    // });  




    // function clickUpdate() {
    //     // alert('DSAD');
    //     var i_clsUpdate = {
    //         ID: $("#ID").val(),
    //         // VendorTypeID: $("#txtVendorTypeID").val(),
    //         id_zonasi: $("#id_zonasi").val(),
    //         // Status: iStatusAdd
    //     }
    //     console.log(i_clsUpdate);
      
    //     if ($("#id_zonasi").val() == "") {
    //         bootbox.alert({
    //             message: "Required zonasi",
    //             backdrop: true
    //         });
    //     } else {
    //         if (status == "add") {
    //             var message = 'Apakah anda yakin ingin menambahkan data vendor type?';
    //         } else {
    //             var message = 'Apakah anda yakin ingin Mengubah data ZONASI?';
    //         }
    //         bootbox.confirm(message, function (o) {
    //             if (o == true) {
    //                 $.ajax({
    //                     type: "POST",
    //                     cache: false,
    //                     dataType: "JSON",
    //                     url: "<?php echo base_url("/master/master_coa/ajax_UpdateCategory"); ?>", // json datasource
    //                     data: {sTbl: i_clsUpdate},
    //                     success: function (e) {
    //                         console.log(e);
    //                         if (e.msgType == true) {
    //                             bootbox.alert({
    //                                 message: e.msg,
    //                                 backdrop: true
    //                             }); 
    //                             $('#mdl_Update').modal('hide');
    //                             $('#table_gridCategory').DataTable().ajax.reload();
    //                         } else {
    //                             alert(e.msgTitle);
    //                         }
    //                     }
    //                 });
    //             }
    //         });
    //     }

    // }

    // $('#table_gridCategory').on('click', '#btnDetail', function () {
    //     $('#mdl_Update').find('.modal-title').text('Detail');

    //     var iclosestRow = $(this).closest('tr');
    //     var idata = dataTable.row(iclosestRow).data();
    //     // console.log(idata);
    //     $("#txtRaw_ID").val(idata[1]);
    //     $("#txtVendorTypeID").val(idata[2]);
    //     $("#txtVendorTypeName").val(idata[3]);


    //     document.getElementById("txtRaw_ID").readOnly = true;
    //     document.getElementById("txtVendorTypeID").readOnly = true;
    //     document.getElementById("txtVendorTypeName").readOnly = true;
    //     $(".btnSC").hide();
    //     $(".status").hide();

    // });


    
    jQuery(document).ready(function () {

        kancut();
        subcoa_tableku();
        coa_table();
        lob_table();
        div_table();
        type_table();
        project_table();
        future1_table();
        future2_table();


    });



        // var IUpdate= '';



     function kancut(){
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
                    url: "<?php echo base_url("/master/master_coa/get_server_side"); ?>", // json datasource
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
                    url: "<?php echo base_url("/master/master_coa/get_server_side_coa"); ?>", // json datasource
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


// ============================= permasalahan ================================================

         function subcoa_tableku(){
            dataTable = $('#subcoa_table').DataTable({
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
                    url: "<?php echo base_url("/master/master_coa/get_server_side_subcoa"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".subcoa_table-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#subcoa_table tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#subcoa_table_processing").css("display", "none");

                    }
                }
            });
        }

// ============================= akhir permasalahan ================================================



        function lob_table(){
            dataTable = $('#lob_table').DataTable({
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
                    url: "<?php echo base_url("/master/master_coa/get_server_side_lob"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".lob_table-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#lob_table tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#lob_table_processing").css("display", "none");

                    }
                }
            });
        }



        function div_table(){
            dataTable = $('#div_table').DataTable({
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
                    url: "<?php echo base_url("/master/master_coa/get_server_side_division"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".div_table-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#div_table tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#div_table_processing").css("display", "none");

                    }
                }
            });
        }



        function type_table(){
            dataTable = $('#type_table').DataTable({
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
                    url: "<?php echo base_url("/master/master_coa/get_server_side_type"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".type_table-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#type_table tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#type_table_processing").css("display", "none");

                    }
                }
            });
        }


          function project_table(){
            dataTable = $('#project_table').DataTable({
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
                    url: "<?php echo base_url("/master/master_coa/get_server_side_project"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".project_table-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#project_table tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#project_table_processing").css("display", "none");

                    }
                }
            });
        }




        function future1_table(){
            dataTable = $('#future1_table').DataTable({
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
                    url: "<?php echo base_url("/master/master_coa/get_server_side_future1"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".future1_table-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#future1_table tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#future1_table_processing").css("display", "none");

                    }
                }
            });
        }



         function future2_table(){
            dataTable = $('#future2_table').DataTable({
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
                    url: "<?php echo base_url("/master/master_coa/get_server_side_future2"); ?>", // json datasource
                    type: "post", // method  , by default get
                    data: function (z) {
                        z.sStatus = iStatus;
                        z.sSearch = iSearch;
                    },

                    error: function () {  // error handling
                        $(".future2_table-error").html("");
                        // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $('#future2_table tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#future2_table_processing").css("display", "none");

                    }
                }
            });
        }

        //  function show_qty(val){
        // alert(val);

        //      console.log(val);
        // $('#myModalUpdate').trigger("click");
        // // Qty
        // var res = val.split("#");
        // var id = res[0];
        // var qty = res[1];
        // $('#ID').val(id);
        // $('#Qty').val(qty);
        // $('#ItemName').val(ItemName);




    // }

function sys_coa(){

 $.ajax({
        type: "POST",
        url: "<?php echo site_url('master/master_coa/getfamdatabranch'); ?>",
        // data: form.serialize(), // <--- THIS IS THE CHANGE
        dataType: "JSON",
        success: function(data){
             $('#table_gridCategory').DataTable().ajax.reload();
        },
        error: function() { alert("Sinkronisasi Berhasil."); }
   });

}


</script>


<!-- END JAVASCRIPTS