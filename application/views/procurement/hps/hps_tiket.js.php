<script>
    var dataTable;
    var iStatus = '%';
    var iSearch = 'ItemName';
    var iZone = 1;

    jQuery(document).ready(function () {
        loadGridHPS();
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




     $('#id_formRoom').submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "simpan", // json datasource
            type: 'POST',
            data: new FormData(this),
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (e) {
                    $("#nama_barang2").val($("#nama_barang").val());

                // alert('asd');
                if(e.act){
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID=e.iPid;
                    $("#id_btnBatal").trigger('click');
                }else{
                    UIToastr.init(e.tipePesan, e.pesan);
                }
            },
            complete:function(e){
                $('#idGridAnggotaKel').DataTable().ajax.reload();
            }
        });       
    });



    $('#id_formRoom_no').submit(function (event) {
        var r = confirm('Do you want to save this file ?');
            if (r == true) {
                $.ajax({
            url: "simpan_msthps", // json datasource
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
            complete:function(e){
                $('#idGridAnggotaKel').DataTable().ajax.reload();
            }
        }); 
                event.preventDefault(); 
            } else {//if(r)
                return false;
            }
             
    });



    function loadGridHPS() {
        iZone = $("#dd_id_zone_A").val();
        dataTable = $('#table_gridHPS').DataTable({
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
                url: "<?php echo base_url("/procurement/hps_tiket/ajax_GridHPS"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_gridHPS-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridHPS tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridHPS_processing").css("display", "none");

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
                {"targets": [8], "visible": false, "searchable": false},
            ],
        });
    }

     
    $('#table_gridHPS').on('click', '#btnUpdate', function () {
        $('#mdl_Update').find('.modal-title').text('Update');

        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        // dd_Zone(idata[8]);
        console.log(idata);
        $("#ItemName").val(idata[2]);
        $("#StartDate").val(idata[4]);
        $("#EndDate").val(idata[5]);
        // $("#price").val(idata[8]);
        $("#HpsID").val(idata[7]);
        $("#divisi").val(idata[2]);
        $("#nama_barang").val(idata[3]);
        $("#id_tiket").val(idata[8]);
        $("#id_tiket2").val(idata[8]);

    });

    function new22(){
    // alert('new');
    $('#btnCloseModalDataBarang').trigger('click');
}

     function reload_ () {
        // alert('new');
        $('#IClassID').select2('val','');
        $('#ZoneID').select2('val','');
        $('#ItemTypeID').select2('val','');
        $('#ID_JNS_BUDGET').select2('val','');

    }


    function reload2 (){
    btnStart();
    resetForm();
    readyToStart();
    }


//     function dd_Zone(a) {

//         $.ajax({
//             url: "<?php echo base_url("/procurement/hps_tiket/ddZone"); ?>?sParam=" + a, // json datasource
//             dataType: "JSON", // what to expect back from the PHP script, if anything
//             type: 'post',
//             cache: false,
// //            data: {sBranchID: $("#dd_id_branch").val()},
//             success: function (e) {
//                 if (a == "B") {
//                     $("#ddZone2").empty();
//                     $("#ddZone2").append(e);
//                 } else if (a == "A") {
//                     $("#ddZone3").empty();
//                     $("#ddZone3").append(e);
//                 } else {
//                     $("#ddZone").empty();
//                     $("#ddZone").append(e);
//                 }
//             },
//             complete: function (e) {
//                 if (a != "A" || a != "B") {
//                     $("#dd_id_zone").val(a);
//                 }
//             }
//         });
//     }


       $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');

    });

    $('#id_btnUbah').click(function () {
        $('#idTmpAksiBtn').val('2');
    });
    $('#id_btnHapus').click(function () {
        $('#idTmpAksiBtn').val('3');
    });




    $( "#buttonal" ).click(function() {
      $('#myModalsha').modal('hide');
      $('#close_myModalsha').trigger('click');
    });


</script>