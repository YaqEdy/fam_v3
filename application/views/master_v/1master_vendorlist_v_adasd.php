<!--BEGIN PAGE BREADCRUMB -->
<!--

-->
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data Kabupaten </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form data Kabupaten </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelUser">
                                        <thead>
                                            <tr>

                                                <th>
                                                    Kode Propinsi
                                                </th>
                                                <th>
                                                    Nama Propinsi
                                                </th>
                                                <th>
                                                    Kode Kabupaten
                                                </th>
                                                <th>
                                                    Nama Kabupaten
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- end col-12 -->
                            </div>
                            <!-- END ROW-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_2_2">
                        <!-- BEGIN FORM-->
                        <form role="form" method="post" class="form-horizontal cls_from_sec_user cls_form_validate "
                              action="<?php echo base_url('parameter/parameter_kabupaten/home'); ?>" id="idFormUser">    

                            <div class="form-body">
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Kode Kabupaten

                                    </label>
                                    <div class="col-md-9">
                                        <input readonly="" id="id_kab"  name="kab" data-required="1" class="form-control input-sm" type="text"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Pilih Propinsi

                                    </label>
                                    <div class="col-md-9"><div class="">
                                            <select id="id_prop" required="required" class="form-control" name="prop">
                                                <option value="">---pilih---</option>
                                                <?php foreach ($propinsi as $value) { ?>

                                                    <option value="<?php echo $value->kodepropinsi ?>"><?php echo $value->namapropinsi ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama Kabupaten

                                    </label>
                                    <div class="col-md-9">
                                        <input required id="id_namaKab"  name="namaKab" data-required="1" class="form-control input-sm" type="text"> 
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <i class="fa fa-check"></i> Simpan
                                        </button>
                                        <button name="btnUbah" class="btn green" id="id_btnUbah">
                                            <i class="fa fa-edit-o"></i> Ubah
                                        </button>
                                        <button name="btnHapus" class="btn red" id="id_btnHapus">
                                            <i class="fa fa-trash-o"></i> Hapus
                                        </button>
                                        <button id="id_btnBatal" type="reset" class="btn default"><i class="fa fa-refresh"></i> Batal</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>    
                </div>

            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>

<?php $this->load->view('app.min.inc.php'); ?>
<script>



jQuery(document).ready(function () {
        var dataTable = $('#idTabelUser').DataTable({
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
//                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/parameter/parameter_kabupaten/get_server_side"); ?>", // json datasource
                type: "post", // method  , by default get
                error: function () {  // error handling
                    $(".idTabelUser-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#idTabelUser tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#idTabelUser_processing").css("display", "none");

                }
            },
        });
            dataTable.on('click', 'tbody tr', function () {
                $("#navitab_2_2").trigger('click');
                var kode_propinsi = $(this).find("td").eq(0).html();
                var nm_propinsi = $(this).find("td").eq(1).html();
                var kode_kab = $(this).find("td").eq(2).html();
                var nm_kab = $(this).find("td").eq(3).html();

                // alert(kode_propinsi);

                $('#id_kab').val(kode_kab);
                $('#id_prop').val(kode_propinsi);
                $('#id_namaKab').val(nm_kab);
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr('disabled', false);
                $('#id_btnHapus').attr('disabled', false);


            });



    });

    // var TableManaged = function () {

    //     var initTable1 = function () {
    //         var table = $('#idTabelUser');
    //         // begin first table
    //         table.dataTable({
    //             "ajax": "<?php echo base_url("parameter/parameter_kabupaten/getUserInfo"); ?>",
    //             "columns": [
    //                 {"data": "kodepropinsi"},
    //                 {"data": "namapropinsi"},
    //                 {"data": "kodekabupaten"},
    //                 {"data": "namakabupaten"}

    //             ],
    //             // Internationalisation. For more info refer to http://datatables.net/manual/i18n
    //             "language": {
    //                 "aria": {
    //                     "sortAscending": ": activate to sort column ascending",
    //                     "sortDescending": ": activate to sort column descending"
    //                 },
    //                 "emptyTable": "No data available in table",
    //                 "info": "Showing _START_ to _END_ of _TOTAL_ entries",
    //                 "infoEmpty": "No entries found",
    //                 "infoFiltered": "(filtered1 from _MAX_ total entries)",
    //                 "lengthMenu": "Show _MENU_ entries",
    //                 "search": "Search:",
    //                 "zeroRecords": "No matching records found"
    //             },
    //             "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.


    //             "lengthMenu": [
    //                 [5, 10, 15, 20, -1],
    //                 [5, 10, 15, 20, "All"] // change per page values here
    //             ],
    //             // set the initial value
    //             "pageLength": 5,
    //             "pagingType": "bootstrap_full_number",
    //             "language": {
    //                 "search": "Cari: ",
    //                 "lengthMenu": "  _MENU_ records",
    //                 "paginate": {
    //                     "previous": "Prev",
    //                     "next": "Next",
    //                     "last": "Last",
    //                     "first": "First"
    //                 }
    //             },
    //             "aaSorting": [[0, 'asc']/*, [5,'desc']*/],
    //             "columnDefs": [{// set default column settings
    //                     'orderable': true,
    //                     "searchable": true,
    //                     'targets': [0]
    //                 }],
    //             "order": [
    //                 [0, "asc"]
    //             ] // set first column as a default sort by asc
    //         });
    //         $('#id_Reload').click(function () {
    //             table.api().ajax.reload();
    //         });

    //         var tableWrapper = jQuery('#example_wrapper');

    //         table.find('.group-checkable').change(function () {
    //             var set = jQuery(this).attr("data-set");
    //             var checked = jQuery(this).is(":checked");
    //             jQuery(set).each(function () {
    //                 if (checked) {
    //                     $(this).attr("checked", true);
    //                     $(this).parents('tr').addClass("active");
    //                 } else {
    //                     $(this).attr("checked", false);
    //                     $(this).parents('tr').removeClass("active");
    //                 }
    //             });
    //             jQuery.uniform.update(set);
    //         });

    //         table.on('change', 'tbody tr .checkboxes', function () {
    //             $(this).parents('tr').toggleClass("active");
    //         });
    //         table.on('click', 'tbody tr', function () {
    //             $("#navitab_2_2").trigger('click');
    //             var kode_propinsi = $(this).find("td").eq(0).html();
    //             var nm_propinsi = $(this).find("td").eq(1).html();
    //             var kode_kab = $(this).find("td").eq(2).html();
    //             var nm_kab = $(this).find("td").eq(3).html();

    //             // alert(kode_propinsi);

    //             $('#id_kab').val(kode_kab);
    //             $('#id_prop').val(kode_propinsi);
    //             $('#id_namaKab').val(nm_kab);
    //             $('#id_btnSimpan').attr('disabled', true);
    //             $('#id_btnUbah').attr('disabled', false);
    //             $('#id_btnHapus').attr('disabled', false);


    //         });

    //         tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    //     }

    //     return {
    //         //main function to initiate the module
    //         init: function () {
    //             if (!jQuery().dataTable) {
    //                 return;
    //             }
    //             initTable1();
    //         }
    //     };
    // }();
    // jQuery(document).ready(function () {
    //     TableManaged.init();
    // });
    // btnStart();
    // $("#id_namakyw").focus();
    // $("#id_btnSimpan").click(function () {
    //     $('#idTmpAksiBtn').val('1');
    // });

    // $('#id_btnBatal').click(function () {
    //     btnStart();
    // });

    // $("#id_btnSimpan").click(function () {
    //     $('#idTmpAksiBtn').val('1');
    //     var o = confirm("Apakah anda yakin menyimpan data ini?");
    //     if (o == true) {
    //         $('#idFormUser').submit();
    //     }
    // });
    // $("#id_btnUbah").click(function () {
    //     $('#idTmpAksiBtn').val('2');
    //     var o = confirm("Apakah anda yakin mengubah data ini?");
    //     if (o == true) {
    //         $('#idFormUser').submit();
    //     }
    // });
    // $("#id_btnHapus").click(function () {
    //     $('#idTmpAksiBtn').val('3');
    //     var o = confirm("Apakah anda yakin menghapus data ini?");
    //     if (o == true) {
    //         $('#idFormUser').submit();
    //     }

    // });

</script>


<!-- END JAVASCRIPTS