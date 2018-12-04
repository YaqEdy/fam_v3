<script>
    var dataTable;
    var iSampai = '';
    var iMulai = '';
    var iSearch = 'ID_PO';

    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        loadTablePenilaianVendor();
    });

    function loadTablePenilaianVendor() {
        dataTable = $('#table_penilaian_vendor').DataTable({
            dom: 'C<"clear">l<"toolbar">frtip',
            "lengthMenu": [
                [10, 20, 30, 40, 50, -1],
                [10, 20, 30, 40, 50, "All"]
            ],
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/penilaian_vendor/list_penilaian_vendor"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sMulai = iMulai;
                    z.sSampai = iSampai;
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

</script>