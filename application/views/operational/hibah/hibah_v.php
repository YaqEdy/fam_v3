<!-- BEGIN PAGE BREADCRUMB -->
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
                            Data Hibah </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Hibah</a>
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
                                                    No
                                                </th>
                                                <th>
                                                    HIBAH DESC
                                                </th>
                                                <th>
                                                    QTY
                                                </th>
                                                <th>
                                                    HIBAH DARI
                                                </th>
                                                <th>
                                                    KONDISI
                                                </th>
                                                <th>
                                                    IMAGE PATH
                                                </th>
                                                <th>
                                                    ID HIBAH
                                                </th>
                                                <th>
                                                    STATUS
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
                        <form enctype="multipart/form-data" method="post" class="form-horizontal cls_from_sec_user cls_form_validate"
                              action="<?php echo base_url('operational/hibah/simpan'); ?>" id="idFormUser" novalidate="novalidate">    
                            <input type="hidden" value="0" name="TmpAksiBtn" id="idTmpAksiBtn">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama Barang
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="HIBAH_DESC" id="HIBAH_DESC_ID"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Qty
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-2">
                                        <input class="form-control number" type="number" name="QTY" id="QTY_ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Upload File
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="file" name="file_upload" id="file_upload_ID">
                                        <span id="filenya"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Hibah Dari
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input class="form-control number" type="text" name="HIBAH_DARI" id="HIBAH_DARI_ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Note 
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="NOTE" id="NOTE_ID"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Save Value
                                    </label>
                                    <div class="col-md-2">
                                         <input class="form-control number" type="number" name="save_val" id="save_val">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Tanggal Hibah
                                    </label>
                                    <div class="col-md-2">
                                         <input type="text" required="" name="tgl_hibah" id="tgl_hibah" onchange="ddMulai(this.value)" value="<?php echo date("d-m-Y");?>" class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Aset Type
                                    </label>
                                    <div class="col-md-2">
                                         <select name="aset_type" class="form-control">
                                             <option value="0">Capex</option>
                                             <option value="1">Opex</option>
                                         </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Kondisi
                                    </label>
                                    <div class="col-md-2">
                                         <textarea name="kondisi"  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type ="button" name="btnSimpan" class="btn blue" id="id_btnSimpanHibah">
                                            <i class="fa fa-check"></i> <span id="btnSimpanEditID">Simpan</span>
                                        </button>
<!--                                        <button type ="button" name="btnHapus" class="btn red" id="id_btnHapusHibah">
                                            <i class="fa fa-trash"></i> <span id="btnStatusID"></span>
                                        </button>-->
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
        ComponentsDateTimePickers.init();
    });
    function ddMulai(e) {
        iMulai = e;
    }
    var TableManaged = function () {

        var initTable1 = function () {
            var table = $('#idTabelUser');
            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/operational/hibah/getUserInfo"); ?>",
                "columns": [
                    {"data": "NO"},
                    {"data": "HIBAH_DESC"},
                    {"data": "QTY"},
                    {"data": "ASAL_HIBAH"},
                    {"data": "KONDISI"},
                    {"data": "IMAGE_PATH"},
                    {"data": "ID_HIBAH"},
                    {"data": "IS_TRASH"},
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                    "lengthMenu": "Show _MENU_ entries",
                    "search": "Search:",
                    "zeroRecords": "No matching records found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.


                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "pagingType": "bootstrap_full_number",
                "language": {
                    "search": "Cari: ",
                    "lengthMenu": "  _MENU_ records",
                    "paginate": {
                        "previous": "Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "aaSorting": [[0, 'asc']/*, [5,'desc']*/],
                "columnDefs": [{// set default column settings
                        'orderable': true,
                        "searchable": true,
                        'targets': [0]
                    }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });
            $('#id_Reload').click(function () {
                table.api().ajax.reload();
            });

            var tableWrapper = jQuery('#example_wrapper');

            table.find('.group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }
                });
                jQuery.uniform.update(set);
            });

            table.on('change', 'tbody tr .checkboxes', function () {
                $(this).parents('tr').toggleClass("active");
            });
            table.on('click', 'tbody tr', function () {
                $("#navitab_2_2").trigger('click');
                var hibah_desc = $(this).find("td").eq(1).html();
                var qty = $(this).find("td").eq(2).html();
                var hibah_dari = $(this).find("td").eq(3).html();
                var note = $(this).find("td").eq(4).html();
                var file = $(this).find("td").eq(5).html();
                var id_kyw = $(this).find("td").eq(6).html();
                
                
                $('#HIBAH_DESC_ID').val(hibah_desc);
                $('#QTY_ID').val(qty);
                $('#HIBAH_DARI_ID').val(hibah_dari);
                $('#NOTE_ID').val(note);
                
                var fileku = "<a href='../../"+file+"' download>Download File</a>"
                $('#filenya').html(fileku);
                $('#idTmpAksiBtn').val(id_kyw);
                $('#btnSimpanEditID').html('Update');

            });

            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        }

        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTable1();
            }
        };
    }();
    jQuery(document).ready(function () {
        TableManaged.init();
    });
    btnStart();
    

    $('#id_btnBatal').click(function () {
        btnStart();
        $('#btnSimpanEditID').html('Simpan');
        $('#filenya').html('');
    });

    $("#id_btnSimpanHibah").click(function () {
//        $('#idTmpAksiBtn').val('1');
        bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
            if (o == true) {
                $('#idFormUser').submit();
            }
        });

    });
    
  
  

</script>


<!-- END JAVASCRIPTS -->