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

     function loadGridHPS() {

              dataTable = $('#table_gridHPS').DataTable({
               // dom: 'C<"clear">l<"toolbar">frtip',
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
                url: "<?php echo base_url("/procurement/hps/ajax_GridHPS"); ?>",// json datasource
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

                // {"targets": [7], "visible": false, "searchable": true},

                // {"targets": [0], "checkboxes": {"selectRow": true}},
                ],
                // "select": {"style": "multi"},
              });
          }

    $('#table_gridHPS').on('click', '#btnUpdate', function () {
        $('#mdl_Update').find('.modal-title').text('Update');

        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        // dd_Zone(idata[8]);
        console.log(idata);
        $("#ItemID").val(idata[1]);
        $("#price").val(idata[2].trim());
        $("#StartDate").val(idata[3]);
        $("#EndDate").val(idata[3]);
        $("#HpsID").val(idata[6]);
    });

    function dd_Zone(a) {
        $.ajax({
            url: "<?php echo base_url("/procurement/hps/ddZone"); ?>?sParam=" + a, // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
//            data: {sBranchID: $("#dd_id_branch").val()},
            success: function (e) {
                if (a == "B") {
                    $("#ddZone2").empty();
                    $("#ddZone2").append(e);
                } else if (a == "A") {
                    $("#ddZone3").empty();
                    $("#ddZone3").append(e);
                } else {
                    $("#ddZone").empty();
                    $("#ddZone").append(e);
                }
            },
            complete: function (e) {
                if (a != "A" || a != "B") {
                    $("#dd_id_zone").val(a);
                }
            }
        });
    }

    function branch(b){
        $.ajax({
            url: "<?php echo base_url("/procurement/hps/ddZone"); ?>?sParam=" + a, // json datasource
            dataType: "JSON",
            type: 'input',
            cache: true,
        })
    }

    function onZone(e) {
        iZone = e.value;
        $('#table_gridHPS').DataTable().ajax.reload();
    }
    $("#fmUpdateHPS").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url("/procurement/hps/update_hps"); ?>?sZone=" + $("#dd_id_zone").val(), // json datasource
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "JSON",
            success: function (e) {
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $('#table_gridHPS').DataTable().ajax.reload();
                    $('#btnCloseHPS').trigger('click');
                } else {
                    alert(e.iremarks);
                }
            }
        });
    });

    // $('#table_gridHPS').on('click', '#btnDelete', function () {
    //     var iclosestRow = $(this).closest('tr');
    //     var idata = dataTable.row(iclosestRow).data();

    //     $.ajax({
    //         type: "POST",
    //         cache: false,
    //         dataType: "JSON",
    //         url: "<?php echo base_url("/procurement/hps/ajax_Delete"); ?>", // json datasource
    //         data: {Hps_id: idata[6]},
    //         success: function (e) {
    //             // console.log(e);
    //             if (e.istatus == true) {
    //                 alert(e.iremarks);
    //                 $('#table_gridHPS').DataTable().ajax.reload();
    //             } else {
    //                 alert(e.iremarks);
    //             }
    //         }
    //     });
    // });

//    function onUpload() {
//        dd_Zone("");
//    }
    $("#fmsaveUpload").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url("/procurement/hps/readExcel"); ?>", // json datasource
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "JSON",
            success: function (e) {
                if (e == true) {
//                    alert(e.iremarks);
                    $('#table_gridHPS').DataTable().ajax.reload();
                    $('#closeupload').trigger('click');
                }
            }
        });
    });


         function editData(input) {
            // alert('erv');
        $('#myadd').trigger("click");
        // $('#table_gridUSER').on('click', '#btnUpdate2');
        $.post("tampil_dataHPS",
            {
                'HpsID': input //id yang dilempar
            },
            function (data) {
                console.log(data);
                if (data.data_res.length > 0) {
                    // $group = '1';
                    for (i = 0; i < data.data_res.length; i++) {
                        $('#HpsID').val(data.data_res[i].HpsID);
                        $('#ItemName').val(data.data_res[i].ItemName);
                        $('#id_btnUbah').attr("disabled", false);
                        $('#id_btnSimpan').attr("disabled", true);
                        $('#id_data').val(input);
                        // id_groupUser_edit
                    }
                }       
            }, "JSON");
    }

    function hapus_hps_js(input) {
        // alert(input);
//        ajaxModal();
        var r = confirm('Do you want to remove this file ?');
        if (r == true) {
             $.ajax({
                type: "POST",
                dataType: "json",
                url: "hapushps",
                data: {data : input},
                success: function (data) {
                    $('#table_gridHPS').DataTable().ajax.reload();
                    UIToastr.init(data.tipePesan, data.pesan);
                }

            });
        }else{
            return false;
        }
       
        
    }


</script>