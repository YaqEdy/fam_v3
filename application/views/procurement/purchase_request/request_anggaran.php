<!-- BEGIN PAGE BREADCRUMB --> 

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
                <div class="tab-content">
                    <h5 class="sbold uppercase"><?= $approve_pr->status_request ?></h5>
                    <div class="panel panel-inverse">
                        <hr class="dotted">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Nomor PR </label>
                                    <div class="col-sm-7">
                                        <?= $approve_pr->RequestID ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Request Type </label>
                                    <div class="col-sm-7">
                                        <?= $approve_pr->ReqTypeName ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Request Category </label>
                                    <div class="col-sm-7">
                                        <?= $approve_pr->ReqCategoryName ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Request Project </label>
                                    <div class="col-sm-7">
                                        <?= $approve_pr->ProjectName ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Jenis Pengadaan </label>
                                    <div class="col-sm-7">
                                        <?= $approve_pr->JenisPengadaan ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Request Date </label>
                                    <div class="col-sm-7">
                                        <?= date("d-m-Y", strtotime($approve_pr->CreateDate)) ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Jenis Request </label>
                                    <div class="col-sm-7">
                                        <?= $approve_pr->JenisPR ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Branch </label>
                                    <div class="col-sm-7">
                                        <?= $approve_pr->BRANCH_DESC ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Division </label>
                                    <div class="col-sm-7">
                                        <?= $approve_pr->DIV_DESC ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Sisa Anggaran </label>
                                    <div class="col-sm-7">
                                        <?= $sisa ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Anggaran Terpakai </label>
                                    <div class="col-sm-7">
                                        <?= date("d-m-Y", strtotime($approve_pr->CreateDate)) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <hr class="dotted">

                        <div class="col-md-12" style="margin-bottom:2em">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>	
                </div>
            </div>

            <hr class="dotted">
            <hr class="dotted">
            <hr class="dotted">

            <?php
            if (count($vendor) > 0) {
                ?>

                <div class="portlet-body">
                    <div class="tab-content">
                        <h5 class="sbold uppercase">Data</h5>
                        <div class="panel panel-inverse">				
                            <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridVendorProcess">
                                <thead>
                                    <tr>
                                        <th>Name</th>     
                                        <th>Alamat</th>
                                        <th>Pemenang</th>
                                        <th>Harga Setelah Penawaran</th>
                                        <th>Item</th>
                                        <th>PPN %</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($vendor as $v) {
                                        if ($v['Pemenang'] == 1) {
                                            $pemenang = 'Pemenang';
                                        } else {
                                            $pemenang = 'Peserta';
                                        }
                                        echo '
									<tr>
										<td>' . $v['VendorName'] . '</td>
										<td>' . $v['VendorAddress'] . '</td>
										<td>' . $pemenang . '</td>
										<td align="right">Rp. ' . number_format($v['HargaVendor'], 2, ',', '.') . '</td>
										<td>' . $v['ItemName'] . '</td>
										<td>' . $v['PPN'] . '</td>
									</tr>
											';
                                    }
                                    ?>
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
    <?php
}
?>

            <div class="portlet-body">
                <div class="tab-content">
                    <h5 class="sbold uppercase">COA</h5>
                    <div class="panel panel-inverse">
                        <form class="" id="fm_apppr" enctype="multipart/form-data" method="POST">
                            <?php
                            foreach ($vendor_po as $vpo) {
                                ?>
                                <div id="vendor_<?= $vpo['VendorID'] ?>"></div>
                            <?php
                                }
                            ?>

                            <hr class="dotted">		
                            <div class="validator-form form-horizontal" style="margin-top:2em">
							<?php if ($path_doc != ''){ ?>
									<div class="form-group">
                                        <label class="control-label col-sm-3"></label>
                                        <div class="col-md-7">
                                            <div class="">
                                                <a href="<?=$path_doc?>" class="btn btn-success"><i class="fa fa-download"></i> Download Dokumen Vendor</a>
                                            </div>
										</div>
                                    </div>
								<?php } ?>
								
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Anggaran </label>
                                    <div class="col-md-7">
                                        <select id="Anggaran" name="Anggaran" class="form-control">
                                            <option value="Dalam Anggaran">Dalam Anggaran</option>
                                            <option value="Diluar Anggaran">Diluar Anggaran</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Budget Disetujui </label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control nomor" min="1" id="BudgetDisetujui" name="BudgetDisetujui">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Notes </label>
                                    <div class="col-md-7">
                                        <textarea id="notes" name="notes" class="form-control">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Action </label>
                                    <div class="col-md-7">
                                        <select id="action" name="action" class="form-control">
                                            <option value="approve">Approve</option>
                                            <option value="revisi">Revisi</option>
                                            <option value="reject">Reject</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">

                                    </div>
                                    <div class="col-sm-7">
                                        <div id="prosessloading"/>
                                        <input type="hidden" id="RequestID" name="RequestID" value="<?= $approve_pr->RequestID ?>">
                                        <input type="hidden" id="flow_id" name="flow_id" value="<?= $approve_pr->flow_id ?>">
                                        <input type="hidden" id="status" name="status" value="<?= $approve_pr->status ?>">
                                        <input type="hidden" id="pic_po" name="pic_po" value="<?= $approve_pr->PIC_PO ?>">
                                        <!--
                                        <button type="submit" class="btn btn-primary" id="appreq" name="appreq" value="Submit" >Submit</button>       
                                        -->
                                        <a class="btn btn-primary" onclick="submit_app()">Submit</a>       
                                        <!--<a class="btn btn-primary" onclick="myFunction()">myFunction</a>   -->    
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>



                </div>
            </div>

        </div>   
    </div>

</div>

<?php $this->load->view('app.min.inc.php'); ?>

<script>
    
    $("#Anggaran").select2({
            placeholder: "Please Select"
        });
    
    
    $("#action").select2({
            placeholder: "Please Select"
        });
    
    
    
    
    var sum_item = 0;
    $(document).ready(function () {
        $('#item_table').DataTable({
            "aaSorting": [],
            "searching": false,
            "paging": false,
            "info": false
        });
        $('#table_gridVendorProcess').DataTable({
            "aaSorting": [],
            "searching": false,
            "paging": false,
            "info": false
        });
<?php
foreach ($vendor_po as $vpo) {
    if ($vpo['Pemenang'] == 1) {
        echo "get_item_coa('" . $vpo['VendorID'] . "');";
        echo "console.log('" . $vpo['VendorID'] . "');";
    }
}
?>
    });

    function go_to_list() {
        $(location).attr("href", "<?php echo base_url("/procurement/purchase_request/list_request_anggaran") ?>");
    }

    function get_item_coa(vendorid) {
        var RequestID = <?= $approve_pr->RequestID ?>;
        $.post('<?= base_url("/procurement/purchase_request/get_item_coa"); ?>', {
            RequestID: RequestID,
            vendorid: vendorid
        },
                function (data) {
                    $('#vendor_' + vendorid).html(data);
                    $(".selectku").select2({
                        placeholder: "Please Select"
                    });
                })
    }

    function myFunction() {
        var x = document.getElementById("coa-data").querySelectorAll(".coa-data");
        var coa = [];
        // x.forEach(function(x){
        // coa[x.id] = x.innerText;
        // console.log(coa[x.id]);
        // console.log(coa[x.innerText]);
        // });
        // alert(x.length);

        // alert('id:'+ x[0].id +' ; value:'+ x[0].innerText);
        console.log('id:' + x[0].id + ' ; value:' + x[0].innerText);
        console.log(x.length);


        for (i = 0; i < x.length; i++) {
            var obj = {};
            obj[x[i].id] = x[i].innerText;
            // coa[x[i].id] = x[i].innerText;
            console.log(x[i].id);
            console.log(x[i].innerText);
            coa.push(obj);
        }
        console.log(coa);
        // alert('id:'+ x[0].id +' ; value:'+ x[0].innerText);
        // alert(coa);
    }

    function submit_app() {
        var action = document.getElementById('action').value;
        var RequestID = document.getElementById('RequestID').value;
        var flow_id = document.getElementById('flow_id').value;
        var status = document.getElementById('status').value;
        var notes = document.getElementById('notes').value;
        var pic_po = document.getElementById('pic_po').value;
        var Anggaran = document.getElementById('Anggaran').value;
        var BudgetDisetujui = document.getElementById('BudgetDisetujui').value;

        var x = document.getElementById("coa-data").querySelectorAll(".coa-data");
        var coa = [];
        var obj = {};
        for (i = 0; i < x.length; i++) {
            obj[x[i].id] = x[i].innerText;
            coa.push(obj);
        }

        $.post('<?= base_url("/procurement/purchase_request/app_requestproc_anggaran"); ?>', {
            action: action,
            RequestID: RequestID,
            flow_id: flow_id,
            status: status,
            notes: notes,
            pic_po: pic_po,
            Anggaran: Anggaran,
            BudgetDisetujui: BudgetDisetujui,
            coa: obj
        },
                function (data) {
                    alert(data);
                    go_to_list();
                })
        // alert(notes);
    }

    function VendorList() {
        $('#mdl_Add').modal({show: true});
        // dataTableItmPr.destroy();
        loadGridVendorList();
    }


    function loadGridVendorList() {
        $('#table_gridVendorList').dataTable().fnDestroy();
        $('#mdl_Add').modal({show: true});
        dataTable = $('#table_gridVendorList').DataTable({
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            retrieve: true,
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/purchase_request/ajax_GridPopupVendorList"); ?>",
                type: "post", // method  , by default get
                error: function () {  // error handling
                    $(".table_gridItemList-error").html("");
                    $('#table_gridItemList tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridItemList_processing").css("display", "none");
                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                {"targets": [0], "orderable": false},
                {"targets": [1], "orderable": false},
                {"targets": [2], "orderable": false},
                {"targets": [3], "orderable": false},
                {"targets": [4], "orderable": false},
                {"targets": [5], "checkboxes": {"selectRow": true}},
            ],
            "select": {"style": "multi"},
        });
    }

    function get_coa(id, ItemID, value) {
        $('#' + id + '_pil_' + ItemID).html(value);
        // alert(id+'-'+ItemID+'-'+value);
    }

</script>



