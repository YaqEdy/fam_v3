<script>
    var dataTable;
    var iStatus = '%';
    var iSearch = 'ItemName';
    var iZone = 1;

    jQuery(document).ready(function () {
        loadGridGroup();
        loadGridStatus();
        loadGridFlow();
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



    $('#id_formRoom_flow').submit(function (event) {
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
             
    });

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
            dom: 'C<"clear">l<"toolbar">frtip',
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
            <div class="row">\n\
                <div class="col-md-1"></div>\n\
                </div>\n\
            </div>\n\
        </div>');
            }, "lengthMenu": [
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
            dom: 'C<"clear">lfrtip',
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

         function reload_ () {
        // alert('new');
        btnStart();
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

    $('#id_btnUbah').click(function () {
        $('#idTmpAksiBtn').val('2');
    });
    $('#id_btnHapus').click(function () {
        $('#idTmpAksiBtn').val('3');
    });


</script>