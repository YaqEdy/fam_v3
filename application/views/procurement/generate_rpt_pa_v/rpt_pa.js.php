<script>
    var dataTable;
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



// function generate_rpt(e){


//     var nilai = e.split(",");


//     window.open("<?php echo base_url("/procurement/generate_rpt_pa/report_fam"); ?>?sId="+ nilai[0],"_blank");


//     }


</script>