<script>

$("#userGroup").select2({
placeholder: "Please Select",
width:'100%'
});

$("#id_groupUser_edit").select2({
placeholder: "Please Select",
width:'100%'
});

var iuserGroup='';
$('#userGroup').on('change', function() {
  var iVal = $("#userGroup").val();      
  if(iVal!=null){
   iuserGroup=iVal.join();          
  }
});


var iid_groupUser_edit='';
$('#id_groupUser_edit').on('change', function() {
  var iVal = $("#id_groupUser_edit").val();      
  if(iVal!=null){
   iid_groupUser_edit=iVal.join();          
  }
});





    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');

    });

    $('#id_btnUbah').click(function () {
        $('#idTmpAksiBtn').val('2');
    });
    $('#id_btnHapus').click(function () {
        $('#idTmpAksiBtn').val('3');
    });

    function reload6() {
        $("#close_btn").trigger("click");

    }

    $("#buttonal").click(function () {
        $('#myModalsha').modal('hide');
        $('#close_myModalsha').trigger('click');
    });


    $('#idFormUser').submit(function (event) {
        // alert('asd')  
        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        var r = confirm('Do you want to save this file ?');
        if (r == true) {
            $.ajax({
                url: "simpan_popup?id_group="+iuserGroup, // json datasource
                type: 'POST',
                data: new FormData(this),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (e) {
                    if (e.act) {
                        UIToastr.init(e.tipePesan, e.pesan);
                        iPID = e.iPid;
                        console.log(idata);
                        $("#idsdm3").val(idata[7]);
                        $("#nik").val(idata[1]);
                        $("#user_name").val(idata[2]);
                        $("#name").val(idata[3]);
                        $("#user_groupid").val(idata[4]);
                        $("#id_btnBatal22").trigger('click');
                    } else {
                        UIToastr.init(e.tipePesan, e.pesan);
                    }
                },
                complete: function (e) {
                    $('#idGridAnggotaKel').DataTable().ajax.reload();
                }
            });
            event.preventDefault();
        } else {//if(r)
            return false;
        }

    });

    $('#id_btnBatal').click(function () {
        btnStart();

    });

    function btl() {
        // // alert('dsds');
        $("#id_branch").select2("val", "");
        $("#id_division").select2("val", "");
        $("#id_position").select2("val", "");
        $("#id_zone").select2("val", "");
        $("#userGroup").select2("val", "");
        $("#id_statusUser").select2("val", "");
    }


    jQuery(document).ready(function () {
        loadGridUSER();
        loadGridUpdateUSER();
        // ajaxUbah();

//        dd_Zone("A");
        $('.date-picker').datepicker({
            orientation: "left",
            autoclose: true
        });

    });

    function sync_user_fam() {
        $.ajax({
            url: "<?php echo base_url("/admin/sec_user/sync_user_fam"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            success: function (e) {
            }
        });
    }

    function new22() {
        $('#btnCloseModalDataBarang2').trigger('click');
    }


    function reload3() {
        btnStart();
        resetForm();
        readyToStart();
    }

    function loadGridUpdateUSER() {
        // iZone = $("#dd_id_zone_A").val();
        dataTable = $('#table_gridUpdateUser').DataTable({
        //     dom: 'C<"clear">l<"toolbar">frtip',
        //     initComplete: function () {
        //          //sync_user_fam();
        //         $("div.toolbar").append('<div class="col-md-8">\n\
        //     <div class="row">\n\
        //         <div class="col-md-1"></div>\n\
        //         </div>\n\
        //     </div>\n\
        // </div>');
        //         // dd_Zone("A");
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
                url: "<?php echo base_url("/admin/sec_user/ajax_GridPopUpUser"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    // z.sSearch = iSearch;
                    // z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_gridUpdateUser-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridUpdateUser tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridUpdateUser_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                 {"targets": [6], "visible": false, "searchable": false}
            ],
        });
    }

    $('#table_gridUpdateUser').on('click', '#btnUpdate', function () {
        $('#mdl_Update').find('.modal-title').text('Update');
        // alert('asd')
        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        // dd_Zone(idata[8]);
        console.log(idata);
        $("#nik").val(idata[1]);
        $("#idsdm3").val(idata[7]);
        $("#user_name").val(idata[3]);
        $("#name").val(idata[2]);
        $("#email").val(idata[4]);
        $("#user_groupid").val(idata[5]);



    });

    function loadGridUSER() {
        // iZone = $("#dd_id_zone_A").val();
        dataTable = $('#table_gridUSER').DataTable({
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
                url: "<?php echo base_url("/admin/sec_user/ajax_GridUser"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    // z.sSearch = iSearch;
                    // z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_gridUSER-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridUSER tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridUSER_processing").css("display", "none");

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
                // {"targets": [8], "visible": false, "searchable": false},
            ],
        });
    }


    // ================================================================

    function editData(input) {
        // alert('jgj');
        $('#myModaleki').trigger("click");
        // $('#table_gridUSER').on('click', '#btnUpdate2');
        $.post("tampil_data",
                {
                    'user_id': input //id yang dilempar
                },
                function (data) {
                  
                    if (data.data_res.length > 0) {
                     
                        for (i = 0; i < data.data_res.length; i++) {

                            console.log(data.data_res[i].user_groupid);
                            $('#idsdm2').val(data.data_res[i].idsdm);
                            $('#user_id2').val(data.data_res[i].user_id);
                            $('#nik_edit').val(data.data_res[i].nik);
                            $('#user_name_edit').val(data.data_res[i].user_name);
                            $('#name_edit').val(data.data_res[i].name);
                            $('#email_edit').val(data.data_res[i].user_email);
                            $('#id_groupUser_edit').select2('val', data.data_res[i].user_groupid.split(','));
                            $('#id_division_edit').select2('val', data.data_res[i].DivisionID);
                            $('#id_branch_edit').select2('val', data.data_res[i].BranchID);
                            $('#id_statusUser_edit').select2('val', data.data_res[i].status);
                            $('#id_position_edit').select2('val', data.data_res[i].PositionID);
                            $('#id_zone_edit').select2('val', data.data_res[i].ZoneID);
                            $('#id_btnUbah').attr("disabled", false);
                            $('#id_btnSimpan').attr("disabled", true);
                            $('#id_data').val(input);
                            // id_groupUser_edit
                        }
                    }
                }, "JSON");

    }


    // =================================================================

    $('#idFormUser2').submit(function (event) {
        // alert('asd')  
        // event.preventDefault();
        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        var r = confirm('Apakah anda ingin merubah data ini ?');
        if (r == true) {
            $.ajax({
                url: "ubah?id_group1="+iid_groupUser_edit, // json datasource
                type: 'POST',
                data: new FormData(this),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (e) {
                    // if (e.act) {
                        UIToastr.init(e.tipePesan, e.pesan);
                        $('#table_gridUSER').DataTable().ajax.reload();
                    //     iPID = e.iPid;
                    //     console.log(idata);
                    //     $('#idsdm2').val(data.data_res[i].idsdm);
                    //     // $('#user_id2').val(data.data_res[i].user_id);
                    //     $('#nik_edit').val(data.data_res[i].nik);
                    //     $('#user_name_edit').val(data.data_res[i].user_name);
                    //     $('#name_edit').val(data.data_res[i].name);
                    //     $('#email_edit').val(data.data_res[i].email);
                    //     $('#edit_usergroup').val(data.data_res[i].user_groupid);
                    //     $('#DivisionID2').val(data.data_res[i].DivisionID);
                    //     $('#status2').val(data.data_res[i].status);
                    //     $('#id_btnUbah').attr("disabled", false);
                    //     $('#id_btnSimpan').attr("disabled", true);
                    //     // $('#id_data').val(input);
                    // } else {
                    //     UIToastr.init(e.tipePesan, e.pesan);
                    // }
                },
                complete: function (e) {
                    $('#table_gridUSER').DataTable().ajax.reload();
                }
            });
            event.preventDefault();
            setTimeout(function (){
                location.reload();
            },1500);
        } else {//if(r)
            return false;
        }

    });




</script>

