<script>

       
    var dataTable;
    var iStatus = '%';
    var iSearch = 'ItemName';
    var iZone = 1;

    jQuery(document).ready(function () {
        // alert('dsd');
        $('#id_btnflowUbah').attr('disabled',true);
        $('#id_btnSimpan').attr('disabled',false);
        $('#id_btnflowUbahgroup').attr('disabled',true);
        $('#id_btnSimpangroup').attr('disabled',false);
        $('#id_btnubahstatus').attr('disabled',true);
        $('#id_btnSimpanstatus').attr('disabled',false);


        loadGridGroup();
//        dd_Zone("A");
        $('.date-picker').datepicker({
            orientation: "left",
            autoclose: true
        });

    });
    
        jQuery(document).ready(function () {
        loadGridFlow();
//        dd_Zone("A");
        $('.date-picker').datepicker({
            orientation: "left",
            autoclose: true
        });

    });

        jQuery(document).ready(function () {
        loadGridStatus();
//        dd_Zone("A");
        $('.date-picker').datepicker({
            orientation: "left",
            autoclose: true
        });

    });
    
    btnStart();

    function search(e) {
        iSearch = e;
    }

// function simpan(){
//     alert('1212');
//     var r = confirm('Do you want to save this file ?');
//     if (r == true) {
//         $.ajax({
//             url: "simpan/1", // json datasource
//             type: 'POST',
//             data: new FormData(this),
//             async: false,
//             cache: false,
//             contentType: false,
//             processData: false,
//             dataType: "JSON",
//             success: function (e) {
//                 if(e.act){
//                     UIToastr.init(e.tipePesan, e.pesan);
//                     iPID=e.iPid;
//                     $("#id_btnBatal22").trigger('click');
//                 }else{
//                     UIToastr.init(e.tipePesan, e.pesan);
//                 }
//             },
//         }); 
//         event.preventDefault(); 
//     } else {//if(r)
//         return false;
//     }
// }

    $('#id_formRoom_flow').submit(function (event) {
        // alert('dsds')
        $nilai = $('#idTmpAksiBtn').val();
        if($nilai == '1'){
            var r = confirm('Do you want to save this flow ?');
                if (r == true) {
                    $.ajax({
                        url: "simpan/1", // json datasource
                        type: 'POST',
                        data: new FormData(this),
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function (e) {
                            if(e.act){
                                UIToastr.init(e.tipePesan, e.pesan);
                                iPID=e.iPid;
                                $("#id_btnBatal22").trigger('click');
                            }else{
                                UIToastr.init(e.tipePesan, e.pesan);
                            }
                        },
                    }); 
                    event.preventDefault(); 
                } else {//if(r)
                    return false;
                }
        }
        if($nilai == '2'){
            var r = confirm('Do you want to update this flow ?');
                if (r == true) {
                    $.ajax({
                        url: "edit_flow", // json datasource
                        type: 'POST',
                        data: new FormData(this),
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function (e) {
                            if(e.act){
                                UIToastr.init(e.tipePesan, e.pesan);
                                iPID=e.iPid;
                                $("#id_btnBatal22").trigger('click');
                            }else{
                                UIToastr.init(e.tipePesan, e.pesan);
                            }
                        },
                    }); 
                    event.preventDefault(); 
                } else {//if(r)
                    return false;
                }
        }
             
    });

     $('#id_formRoom_grup').submit(function (event) {
        // alert('wewe');
        $nilai = $('#idTmpAksiBtn').val();
        if($nilai == '4'){
            var r = confirm('Do you want to save this grup ?');
                if (r == true) {
                    $.ajax({
                        url: "simpan/2", // json datasource
                        type: 'POST',
                        data: new FormData(this),
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function (e) {
                            if(e.act){
                                UIToastr.init(e.tipePesan, e.pesan);
                                iPID=e.iPid;
                                $("#id_btnBatal22").trigger('click');
                            }else{
                                UIToastr.init(e.tipePesan, e.pesan);
                            }
                        },
                    }); 
                    event.preventDefault(); 
                } else {//if(r)
                    return false;
                }
        }
        if($nilai == '5'){
            var r = confirm('Do you want to update this grup ?');
                if (r == true) {
                    $.ajax({
                        url: "edit_grup", // json datasource
                        type: 'POST',
                        data: new FormData(this),
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function (e) {
                            if(e.act){
                                UIToastr.init(e.tipePesan, e.pesan);
                                iPID=e.iPid;
                                $("#id_btnBatal22").trigger('click');
                            }else{
                                UIToastr.init(e.tipePesan, e.pesan);
                            }
                        },
                    }); 
                    event.preventDefault(); 
                } else {//if(r)
                    return false;
                }
        }
             
    });

      $('#id_formRoom_STATUS').submit(function (event) {
        // alert('wewe');
        $nilai = $('#idTmpAksiBtn').val();
        if($nilai == '6'){
            var r = confirm('Do you want to save this status ?');
                if (r == true) {
                    $.ajax({
                        url: "simpan/3", // json datasource
                        type: 'POST',
                        data: new FormData(this),
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function (e) {
                            if(e.act){
                                UIToastr.init(e.tipePesan, e.pesan);
                                iPID=e.iPid;
                                $("#id_btnBatal22").trigger('click');
                            }else{
                                UIToastr.init(e.tipePesan, e.pesan);
                            }
                        },
                    }); 
                    event.preventDefault(); 
                } else {//if(r)
                    return false;
                }
        }
        if($nilai == '7'){
            var r = confirm('Do you want to update this status ?');
                if (r == true) {
                    $.ajax({
                        url: "edit_status", // json datasource
                        type: 'POST',
                        data: new FormData(this),
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function (e) {
                            if(e.act){
                                UIToastr.init(e.tipePesan, e.pesan);
                                iPID=e.iPid;
                                $("#id_btnBatal22").trigger('click');
                            }else{
                                UIToastr.init(e.tipePesan, e.pesan);
                            }
                        },
                    }); 
                    event.preventDefault(); 
                } else {//if(r)
                    return false;
                }
        }
             
    });


    // $('#id_formRoom_grup').submit(function (event) {
    //   // $nilai = $('#idTmpAksiBtn').val();
    //   //   if($nilai == '1'){
    //     var r = confirm('Do you want to save this file ?');
    //         if (r == true) {
    //             $.ajax({
    //         url: "simpan/2", // json datasource
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
    //                 $("#id_btnBatal22").trigger('click');
    //             }else{
    //                 UIToastr.init(e.tipePesan, e.pesan);
    //                 location.reload();
    //             }

    //         },
    //     }); 
    //             event.preventDefault(); 
    //         } else {//if(r)
    //             return false;
    //         }
        // }
        //  if($nilai == '2'){
        //     var r = confirm('Do you want to update this file ?');
        //         if (r == true) {
        //             $.ajax({
        //                 url: "edit_grup", // json datasource
        //                 type: 'POST',
        //                 data: new FormData(this),
        //                 async: false,
        //                 cache: false,
        //                 contentType: false,
        //                 processData: false,
        //                 dataType: "JSON",
        //                 success: function (e) {
        //                     if(e.act){
        //                         UIToastr.init(e.tipePesan, e.pesan);
        //                         iPID=e.iPid;
        //                         $("#id_btnBatal22").trigger('click');
        //                     }else{
        //                         UIToastr.init(e.tipePesan, e.pesan);
        //                     }
        //                 },
        //             }); 
        //             event.preventDefault(); 
        //         } else {//if(r)
        //             return false;
        //         }
        // }
             
    // });

    //     $('#id_formRoom_STATUS').submit(function (event) {
    //     var r = confirm('Do you want to save this file ?');
    //         if (r == true) {
    //             $.ajax({
    //         url: "simpan/3", // json datasource
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
    //                 $("#id_btnBatal22").trigger('click');
    //             }else{
    //                 UIToastr.init(e.tipePesan, e.pesan);
    //             }
    //         },
    //     }); 
    //             event.preventDefault(); 
    //         } else {//if(r)
    //             return false;
    //         }
             
    // });
    
    function loadGridFlow() {
        iZone = $("#dd_id_zone_A").val();
        dataTable = $('#table_gridflow').DataTable({
            dom: 'C<"clear">l<"toolbar">frtip',
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
            <div class="row">\n\
                <div class="col-md-1"></div>\n\
                </div>\n\
            </div>\n\
        </div>');
                // dd_Zone("A");
            }, "lengthMenu": [
                [10, 20, 50, -1],
                [10, 20, 50, "All"] // change per page values here
            ],
//                // set the initial value
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/master/master_flow/ajax_GridFLOW"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_gridflow-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridflow tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridflow_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
//                {"targets": [0], "orderable": false},
//                {"targets": [1], "orderable": false},
//                {"targets": [2], "orderable": false},
//                {"targets": [3], "orderable": false},
//                {"targets": [4], "orderable": false},
//                {"targets": [5], "orderable": false},
                // {"targets": [6], "orderable": false},
                // {"targets": [7], "visible": true, "searchable": true},
                // {"targets": [7], "visible": false, "searchable": false},
            ],
        });
    }

        $('#table_gridflow').on('click', '#btnUpdate', function () {
        $('#mdl_Update').find('.modal-title').text('Update');

        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        // dd_Zone(idata[8]);
        console.log(idata);
        $("#flow_id").val(idata[1]);
        $("#status_dari").val(idata[3]);
        $("#action").val(idata[5]);
        $("#status_ke").val(idata[4]);
        $("#nama_flow").val(idata[2]);
        $("#nama_flow").val(idata[2]);



    });

    // ===========================================================================

 function loadGridGroup() {
        dataTable = $('#table_gridgroup').DataTable({
            // dom: 'C<"clear">l<"toolbar">frtip',
        //     initComplete: function () {
        //         $("div.toolbar").append('<div class="col-md-8">\n\
        //     <div class="row">\n\
        //         <div class="col-md-1"></div>\n\
        //         </div>\n\
        //     </div>\n\
        // </div>');
        //     }, 
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
//                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/master/master_flow/ajax_GridGROUP"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_gridgroup-error").html("");
                    $('#table_gridgroup tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridgroup_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
//                {"targets": [0], "orderable": false},
//                {"targets": [1], "orderable": false},
//                {"targets": [2], "orderable": false},
//                {"targets": [3], "orderable": false},
//                {"targets": [4], "orderable": false},
//                {"targets": [5], "orderable": false},
                // {"targets": [6], "orderable": false},
                // {"targets": [7], "visible": true, "searchable": true},
                // {"targets": [3], "visible": false, "searchable": false},
            ],
        });
    }

 function loadGridStatus() {
        iZone = $("#dd_id_zone_A").val();
        dataTable = $('#table_gridstatus').DataTable({
            // dom: 'C<"clear">lfrtip',
        //     initComplete: function () {
        //         $("div.toolbar").append('<div class="col-md-8">\n\
        //     <div class="row">\n\
        //         <div class="col-md-1"></div>\n\
        //         </div>\n\
        //     </div>\n\
        // </div>');
        //     }, 
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
//                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/master/master_flow/ajax_GridSTATUS"); ?>", // json datasource
                type: "post", // method  , by default get

                error: function () {  // error handling
                    $(".table_gridstatus-error").html("");
                    $('#table_gridstatus tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridstatus_processing").css("display", "none");

                }
            },
            "columnDefs": [
                // {"targets": [-1], "orderable": false, "searchable": false},
//                {"targets": [0], "orderable": false},
//                {"targets": [1], "orderable": false},
               // {"targets": [2], "orderable": false},
//                {"targets": [3], "orderable": false},
//                {"targets": [4], "orderable": false},
//                {"targets": [5], "orderable": false},
                // {"targets": [6], "orderable": false},
                // {"targets": [7], "visible": true, "searchable": true},
                // {"targets": [7], "visible": false, "searchable": false},
            ],
        });
    }
     


       $('#table_gridgroup').on('click', '#btnUpdate', function () {
        $('#mdl_Update').find('.modal-title').text('Update');

        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        dd_Zone(idata[8]);
        console.log(idata);
        $("#grup").val(idata[2]);

    });

        $('#table_gridstatus').on('click', '#btnUpdate', function () {
        $('#mdl_Update').find('.modal-title').text('Update');

        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        console.log(idata);
        $("#status").val(idata[3]);
        $("#id").val(idata[2]);

    });


    function reload2 (){
    // btnStart();
    // resetForm();
    readyToStart();
    }

    function onDelete(a) {
        $.ajax({
            url: "<?php echo base_url("/master/master_flow/ajax_setDelete"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {sID: a},
            success: function (e) {
                if (e.istatus) {
                    $('#table_gridflow').DataTable().ajax.reload();
                    UIToastr.init(e.type, e.iremarks);
                }
            }
        });
    }

       function hapus_flow_(input) {
        // alert(input);
//        ajaxModal();
        var r = confirm('Do you want to remove this file ?');
        if (r == true) {
             $.ajax({
                type: "POST",
                dataType: "json",
                url: "hapus_flow",
                data: {data : input},
                success: function (data) {
                    $('#table_gridflow').DataTable().ajax.reload();
                    UIToastr.init(data.tipePesan, data.pesan);
                }

            });
        }else{
            return false;
        }
       
        
    }

           function hapus_grup_(input) {
        // alert(input);
//        ajaxModal();
        var r = confirm('Do you want to remove this file ?');
        if (r == true) {
             $.ajax({
                type: "POST",
                dataType: "json",
                url: "hapus_grup",
                data: {data : input},
                success: function (data) {
                    $('#table_gridgroup').DataTable().ajax.reload();
                    UIToastr.init(data.tipePesan, data.pesan);
                }

            });
        }else{
            return false;
        }
       
        
    }

          function hapus_status_(input) {
        // alert(input);
//        ajaxModal();
        var r = confirm('Do you want to remove this file ?');
        if (r == true) {
             $.ajax({
                type: "POST",
                dataType: "json",
                url: "hapus_status",
                data: {data : input},
                success: function (data) {
                    $('#table_gridstatus').DataTable().ajax.reload();
                    UIToastr.init(data.tipePesan, data.pesan);
                }

            });
        }else{
            return false;
        }
       
        
    }


    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });

    $('#id_btnflowUbah').click(function () {
        $('#idTmpAksiBtn').val('2');
    });
    // $('#id_btnHapus').click(function () {
    //     $('#idTmpAksiBtn').val('3');
    // });

    //  $('#id_btnBatal').click(function () {
    //     // btnStart();

        
    //     $('#id_btnSimpanstatus').attr('disabled',false);
        

    // });


    $("#id_btnSimpangroup").click(function () {
        $('#idTmpAksiBtn').val('4');
    });

    $('#id_btnflowUbahgroup').click(function () {
        $('#idTmpAksiBtn').val('5');
    });

     $("#id_btnSimpanstatus").click(function () {
        $('#idTmpAksiBtn').val('6');
    });

    $('#id_btnubahstatus').click(function () {
        $('#idTmpAksiBtn').val('7');
    });


    // $("#btngrupSimpan").click(function () {
    //     $('#idTmpAksiBtn').val('4');
    // });

    // $('#id_btnflowUbah').click(function () {
    //     $('#idTmpAksiBtn').val('5');


     function myFunction() {
    var x = document.getElementById("id_aksi").selectedIndex;
    // alert(x);
    }


    function show_flow_(val){
        // alert(val);

             console.log(val);
        $('#id_formRoom_flow').trigger("click");
        // Qty
        var res = val.split("#");
        var id_flow_id = res[0];
        var id_nama_flow = res[1];
        var id_status_dari = res[2];
        var id_aksi = res[3];
        var id_status_ke = res[4];
        var id_tipe = res[5];
        var id_min_hps = res[6];
        var id_max_hps = res[7];
       

        $('#id_flow_id').val(id_flow_id);
        $('#id_nama_flow').val(id_nama_flow);
        $('#id_status_dari').val(id_status_dari);
        $('#id_aksi').val(id_aksi);
        $('#id_status_ke').val(id_status_ke);
        $('#id_tipe').val(id_tipe);
        $('#id_min_hps').val(id_min_hps);
        $('#id_max_hps').val(id_max_hps);
        // $('#ItemName').val(ItemName);

        $('#id_btnHapus').attr('disabled',false);
        $('#id_btnflowUbah').attr('disabled',false);
        $('#id_btnSimpan').attr('disabled',true);




    }


    //  function update_flow(){
    //      var id_flow_id = $('#id_flow_id').val();
    //      var id_nama_flow = $('#id_nama_flow').val();
    //      var id_status_dari = $('#id_status_dari').val();
    //      var id_aksi = $('#id_aksi').val();
    //      var id_status_ke = $('#id_status_ke').val();
    //      var id_tipe = $('#id_tipe').val();
    //      var id_min_hps = $('#id_min_hps').val();
    //      var id_max_hps = $('#id_max_hps').val();
    //     var dataku  = $('#id_formRoom_flow').serialize();

    //     $.ajax({
    //         url: "edit_flow", // json datasource
    //         type: 'POST',
    //         data: dataku,
    //         async: false,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         dataType: "JSON",
      
    //     }); 


    // }

     function show_status_(val){
        // alert(val);
             console.log(val);
        $('#id_formRoom_STATUS').trigger("click");
    
        var res = val.split("#");
        var id_id = res[0];
        var id_grup_status = res[1];

        var idd = id_grup_status.split("-");
        var id_grup_status = idd[0];

        var input_status = res[2];

       // document.getElementById("id_grup_status").readOnly = true;
       
        $('#id_id').val(id_id);
        $('#id_grup_status').val(id_grup_status);
        $('#input_status').val(input_status);


        $('#id_btnHapus').attr('disabled',false);
        $('#id_btnubahstatus').attr('disabled',false);
        $('#id_btnSimpanstatus').attr('disabled',true);
        $('#id_grup_status').attr('disabled',true);

    }

     function show_grup_(val){
        // alert(val);

             console.log(val);
        $('#id_formRoom_grup').trigger("click");
        // Qty
        var res = val.split("#");
        var id_group = res[0];
        var grup = res[1];
       
       

        $('#id_group').val(id_group);
        $('#grup').val(grup);
      

        $('#id_btnHapus').attr('disabled',false);
        $('#id_btnflowUbahgroup').attr('disabled',false);
        $('#id_btnSimpangroup').attr('disabled',true);
       

    }

    function btlflow() {
        // alert('dsds');
        $('#id_btnHapus').attr('disabled',false);
        $('#id_btnflowUbah').attr('disabled',true);
        $('#id_btnSimpan').attr('disabled',false);
      
    }

    function btlstatus() {
        // alert('dsds');
        $('#id_btnubahstatus').attr('disabled',true);
        $('#id_btnSimpanstatus').attr('disabled',false);
        $('#id_grup_status').attr('disabled',false);
      
    }

    function btlgrup() {
        // alert('dsds');
        $('#id_btnHapus').attr('disabled',false);
        $('#id_btnflowUbahgroup').attr('disabled',true);
        $('#id_btnSimpangroup').attr('disabled',false);
      
    }

    //  $("#btngrupSimpan").click(function () {
    //     $('#idTmpAksiBtn').val('4');
    // });

    // $('#id_btnflowUbah').click(function () {
    //     $('#idTmpAksiBtn').val('5');




</script>