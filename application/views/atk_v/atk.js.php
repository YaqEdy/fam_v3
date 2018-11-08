<script>
    var dataTable, dataTable1, dataTable2, dataTable3;
    var iStatus = '%';
    var iSearch = 'ItemName';
    var iZone = 1;
    var iID_PR = '';
    var iSES = '';

    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        loadGridDPR_Group();
        loadGridDaftarPR();
        loadGridPRDivisi();
        loadGridDataPR();
        loadGridItemBarang();


    });
    btnStart();

    function search(e) {
        iSearch = e;
    }



function daftar_pr (){
var r = confirm('Apakah anda yakin dengan data yang anda pilih ?');
if (r == true) {
        var selected = dataTable2.column(0).checkboxes.selected();
         
        iID_PR = iID_PR + selected.join(',');
        console.log(iID_PR);
        
       $.ajax({
            url: "tampil_data", // json datasource
            input : "HargaHPS",  //id yang dilempar
            type: 'POST',
            data: {sID_PR: iID_PR},
            cache: false,
            dataType: "JSON",
            success: function (e) {
                console.log(e);
                $('#total_hps').val(e.HPS.HargaHPS);
                $('#total_item').val(e.ITEM.TTL_ITEM);
                $('#total_qty').val(e.QTY.QTY);
                iSES=e.SES.SESSION;

            },
              complete:function(e){
            $('#table_grid_daftarPR').DataTable().ajax.reload();
            $('#table_grid_daftarItemBarang').DataTable().ajax.reload();
            $('#btnCloseModalDataBarang3').trigger('click');

              }
          }); 


      }else{//if(r)
            return false;
        }    
}


 function loadGridDPR_Group() {
        // iZone = $("#dd_id_zone_A").val();
        dataTable = $('#tabel_atk_pr_group').DataTable({
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
                url: "<?php echo base_url("/atk/atk/ajax_GridPRGroup"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".tabel_atk_pr_group-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#tabel_atk_pr_group tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#tabel_atk_pr_group_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                 // {"targets": [0], "checkboxes": {"selectRow": true}},
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
              // "select": {"style": "multi"},
        });

    }

    function loadGridDaftarPR() {
        // iZone = $("#dd_id_zone_A").val();
        dataTable1 = $('#table_grid_daftarPR').DataTable({
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
                url: "<?php echo base_url("/atk/atk/ajax_GridDaftarPR"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sID_PR = iID_PR;
                },
                error: function () {  // error handling
                    $(".table_grid_daftarPR-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_grid_daftarPR tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_grid_daftarPR_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                 // {"targets": [0], "checkboxes": {"selectRow": true}},
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
              // "select": {"style": "multi"},
        });
    }

         function loadGridDataPR() {
        // iZone = $("#dd_id_zone_A").val();
        dataTable2 = $('#table_grid_PilihData').DataTable({
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
                url: "<?php echo base_url("/atk/atk/ajax_GridDataPR"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_grid_PilihData-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_grid_PilihData tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_grid_PilihData_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                 {"targets": [0], "checkboxes": {"selectRow": true}},
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
                 "select": {"style": "multi"},
        });
    }


     function loadGridItemBarang() {
        // iZone = $("#dd_id_zone_A").val();
        dataTable3 = $('#table_grid_daftarItemBarang').DataTable({
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
                url: "<?php echo base_url("/atk/atk/ajax_GridItemBarang"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                   z.sSES = iSES;
                },
                    error: function () {  // error handling
                    $(".table_grid_daftarItemBarang-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_grid_daftarItemBarang tbody').html('<tbody class="employee-grid-error"><tr><th colspan="9">No data found in the server</th></tr></tbody>');
                    $("#table_grid_daftarItemBarang_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false}
            ],

        });
        // $.post("SumItemBarang",
        //     {
        //         'user_id': input //id yang dilempar
        //     },
    }


    function loadGridPRDivisi() {
        // iZone = $("#dd_id_zone_A").val();
        dataTable = $('#tabel_atk_pr_Divisi').DataTable({
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
                url: "<?php echo base_url("/atk/atk/ajax_GridPRDivisi"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".tabel_atk_pr_Divisi-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#tabel_atk_pr_Divisi tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#tabel_atk_pr_Divisi_processing").css("display", "none");

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
                {"targets": [9], "visible": false, "searchable": false},
            ],
        });
    }

    function hapus_item(input) {
        
        var r = confirm('Do you want to remove this file ?');
        if (r == true) {
             $.ajax({
                type: "POST",
                dataType: "json",
                url: "hapus_itembarang",
                data: {data : input},
                success: function (data) {
                    $('#table_grid_daftarItemBarang').DataTable().ajax.reload();
                    UIToastr.init(data.tipePesan, data.pesan);
                }

            });
        }else{
            return false;
        }
       
        
    }

    function teruskanPR (){
        console.log(iID_PR);
        $.ajax({
            url: "teruskan_dataPR", // json datasource
            type: 'POST',
            data: {sID_PR: iID_PR,sSES:iSES},
            cache: false,
            dataType: "JSON",
            success: function (e) {
                    $("#").val($("#").val());

                // alert('asd');
                if(e.act){
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID=e.iPid;
                    $("#").trigger('click');
                }else{
                    UIToastr.init(e.tipePesan, e.pesan);
                }
            },
              complete:function(e){
                    $('#tabel_atk_pr_group').DataTable().ajax.reload();
                    $('#tabel_atk_pr_Divisi').DataTable().ajax.reload();
              }
          }); 
        $('#btnCloseModalDataBarang2').trigger('click');
         // location.reload('#navitab_2_1');
   }

    function edit_qty(input) {
            alert('eki');
        $('#myModalUpdate').trigger("click");

        // $('#table_gridUSER').on('click', '#btnUpdate2');
        $.post("tampil_QTY",
            {
                'id': input //id yang dilempar
            },
            function (data) {
                console.log(data);
                if (data.data_res.length > 0) {
                    // $group = '1';
                    for (i = 0; i < data.data_res.length; i++) {
                        $('#Qty').val(data.data_res[i].Qty);
                        $('#id').val(data.data_res[i].id);

              
                    }
                }       
            }, "JSON");

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