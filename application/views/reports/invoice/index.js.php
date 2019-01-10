<script>
    var dataTable, dataTable1;
    var iSampai = '';
    var iMulai = '';
    var iDiv = '';
    var iSearch = 'ID_PR';

    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        loadTablePenilaianVendor();
        loadGridPilihEtiket();
    });


     function loadGridPilihEtiket() {

        dataTable1 = $('#table_inv_report').DataTable({
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
                url: "<?php echo base_url("/reports/invoice/list_report_inv_"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    // z.sSearch = iSearch;
                    // z.sMulai = iMulai;
                    // z.sSampai = iSampai;
                },
                error: function () {  // error handling
                    $(".table_inv_report-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_inv_report tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_inv_report_processing").css("display", "none");

                }
            }
        });


    }


    function loadTablePenilaianVendor() {
        dataTable = $('#table_report').DataTable({
            dom: 'C<"clear">l<"toolbar">Bfrtip',
            "lengthMenu": [
                [10, 20, 30, 40, 50, -1],
                [10, 20, 30, 40, 50, "All"]
            ],
            buttons: [
                
            ],
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/reports/invoice/list_report"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    // z.sSearch = iSearch;
                    // z.sMulai = iMulai;
                    // z.sSampai = iSampai;
                },
                error: function () {  // error handling
                    $(".table_gridBudget-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridBudget tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridBudget_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                // {"targets": [1], "visible": false, "searchable": false},
                // {"targets": [2], "visible": false, "searchable": false},
                // {"targets": [3], "visible": false, "searchable": false},
            ],
        });
    }

    function ddMulai(e) {
        iMulai = e;
    }
    function ddSampai(e) {
        iSampai = e;
    }

    function onChangeDiv(e){
        iDiv = e
    }
    $('.date-picker').datepicker({
        orientation: "left",
        format: "dd/mm/yyyy",
        autoclose: true
    });

    $( "#filter_report" ).click(function() {
        $('#table_report').DataTable().ajax.reload();
      // alert("iDiv : " + iDiv + " , iSampai : " + iSampai + " , iMulai : " + iMulai);
    });

    function submit_post_via_hidden_form(url, params) {
        var f = $("<form target='_blank' method='POST' style='display:none;'></form>").attr({
            action: url
        }).appendTo(document.body);

        for (var i in params) {
            if (params.hasOwnProperty(i)) {
                $('<input type="hidden" />').attr({
                    name: i,
                    value: params[i]
                }).appendTo(f);
            }
        }

        f.submit();

        f.remove();
    }

    $( "#export_excel" ).click(function() {
        submit_post_via_hidden_form(
            '<?php echo base_url("/reports/invoice/downloadReport"); ?>',
            {
                order : '',
                start: 0,
                search : '',
                sSearch : iSearch,
                sMulai : iMulai,
                sSampai : iSampai,
                length: -1
            }
        );
    });

    $( "#export_pdf" ).click(function() {
        submit_post_via_hidden_form(
            '<?php echo base_url("/reports/invoice/downloadReportPDF"); ?>',
            {
                order : '',
                start: 0,
                search : '',
                sSearch : iSearch,
                sMulai : iMulai,
                sSampai : iSampai,
                length: -1
            }
        );
    });

</script>