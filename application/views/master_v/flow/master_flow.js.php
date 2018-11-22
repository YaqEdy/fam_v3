<script>

       
    var dataTable;
    var iStatus = '%';
    var iSearch = 'ItemName';
    var iZone = 1;

    jQuery(document).ready(function () {
        // alert('dsd');
        $('#id_btnflowUbah').attr('disabled',true);
        $('#id_btnSimpan').attr('disabled',false);

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

function simpan(){
    var r = confirm('Do you want to save this file ?');
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

    $('#id_formRoom_flow').submit(function (event) {
        $nilai = $('#idTmpAksiBtn').val();
        if($nilai == '1'){
            var r = confirm('Do you want to save this file ?');
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
            var r = confirm('Do you want to update this file ?');
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

        // $('#id_btnHapus').attr('disabled',false);
        // $('#id_btnUbah').attr('disabled',true);
        // $('#id_btnSimpan').attr('disabled',false);
             
    });

//       table.on('click', 'tbody tr', function () {
//                 alert(id_id);
//                 $("#navitab_2_1").trigger('click');
//                 var id_id = $(this).find("td").eq(1).html();
//                 var id_entity_name = $(this).find("td").eq(2).html();
//                 var id_latitude = $(this).find("td").eq(3).html();
//                 var id_location_name = $(this).find("td").eq(4).html();
//                 var id_longitude = $(this).find("td").eq(5).html();
//                 var id_permitted_radius = $(this).find("td").eq(6).html();
//                 var id_locationDesc = $(this).find("td").eq(7).html();
//                 var gbr_id = $(this).find("td").eq(8).html();
//                 var downloadQrId = $(this).find("td").eq(9).html();
//                 //var userFullName = $(this).find("td").eq(2).html();
// //                var passwd = $(this).find("td").eq(3).html();
// //                var userGroup = $(this).find("td").eq(4).html();
// //                var id_kyw = $(this).find("td").eq(5).html();

//                 $('#id_id').val(id_id);
//                 $('#id_entity_name').val(id_entity_name);
//                 $('#id_latitude').val(id_latitude);
//                 $('#id_location_name').val(id_location_name);
//                 $('#id_longitude').val(id_longitude);
//                 $('#id_permitted_radius').val(id_permitted_radius);
//                 $('#id_locationDesc').val(id_locationDesc);
//                 var url = "../../images/qr_code/"+gbr_id;
//                 if(gbr_id != ''){ //file ada
//                     var file_gbr = '<img class="zoom" src="'+url+'" alt="Smiley face" width="42" height="42">';
//                     var dwnld = '<a class="btn btn-danger" href="'+url+'" download>DownloadQr</a>'
                   

                
//                 }else{
//                     var file_gbr = '<img class="zoom" src="../../images/Not-Found.png" alt="Smiley face" width="60" height="30">';
//                     var dwnld = '';
//                 }
//                 $('#gbr_id').html(file_gbr);
//                 $('#downloadQrId').html(dwnld);
                

                
//                 $('#id_btnHapus').attr('disabled',false);
//                 $('#id_btnUbah').attr('disabled',false);
//                 $('#id_btnSimpan').attr('disabled',true);
// //                $('#id_karyawan').val(id_kyw);
// //                $('#id_kataKunci').val(passwd);
// //                $('#id_confKataKunci').val(passwd);
// //                $('#id_groupUser').val(userGroup);
// //                //$('#').val();
// //                $('#id_userName').focus();

//             });


        $('#id_formRoom_grup').submit(function (event) {
        var r = confirm('Do you want to save this file ?');
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
                    location.reload();
                }

            },
        }); 
                event.preventDefault(); 
            } else {//if(r)
                return false;
            }
             
    });

        $('#id_formRoom_STATUS').submit(function (event) {
        var r = confirm('Do you want to save this file ?');
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
             
    });
    
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
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
//                // set the initial value
            "pageLength": 5,
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
    $('#id_btnHapus').click(function () {
        $('#idTmpAksiBtn').val('3');
    });

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


     function update_flow(){
         var id_flow_id = $('#id_flow_id').val();
         var id_nama_flow = $('#id_nama_flow').val();
         var id_status_dari = $('#id_status_dari').val();
         var id_aksi = $('#id_aksi').val();
         var id_status_ke = $('#id_status_ke').val();
         var id_tipe = $('#id_tipe').val();
         var id_min_hps = $('#id_min_hps').val();
         var id_max_hps = $('#id_max_hps').val();
        var dataku  = $('#id_formRoom_flow').serialize();

        $.ajax({
            url: "edit_flow", // json datasource
            type: 'POST',
            data: dataku,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
      
        }); 


    }



</script>