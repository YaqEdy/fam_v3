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
					<h5 class="sbold uppercase"><?=$approve_pr->status_request?></h5>
                        <div class="panel panel-inverse">
                            <hr class="dotted">
                            <!--tambahkan enctype="multipart/form-data" u/ upload-->
                            <!--<form class="validator-form form-horizontal" id="datasavez" enctype="multipart/form-data"  action="<?php echo base_url(); ?>procurement/requestproc/add_requestproc/prc" method="POST">-->
                            <div class="col-md-12">
								<div class="col-md-6">
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Nomor PR </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->RequestID?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Request Type </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->ReqTypeName?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Request Category </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->ReqCategoryName?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Request Project </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->ProjectName?>
                                        </div>
                                    </div>
								</div>
								<div class="col-md-6">
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Request Date </label>
                                        <div class="col-sm-7">
                                            <?=date("d-m-Y", strtotime($approve_pr->CreateDate))?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Jenis Request </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->JenisPR?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Branch </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->BRANCH_DESC?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Division </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->DIV_DESC?>
                                        </div>
                                    </div>
								</div>
                            </div>
							
							<table class="table table-striped table-bordered table-hover" id="item_table">
							  <thead>
								<tr align="center">
									<th>Item Name</th>
									<th>Quantity</th>
									<th>HPS</th>
									<th>Sub Total</th>
								</tr>
							  </thead>
							  <tbody>
								<?php
								foreach($item as $itm){
									echo '
								<tr>
									<td>'.$itm['ItemName'].'</td>
									<td>'.$itm['Qty'].'</td>
									<td align="right">Rp. '.number_format($itm['HargaHPS'],2,',','.').'</td>
									<td align="right">Rp. '.number_format($itm['harga_sub_total'],2,',','.').'</td>
								</tr>
									';
								}
								?>
								<tr>
									<td></td>
									<td></td>
									<td><b>Total</b></td>
									<td align="right"><b>Rp. <?=number_format($approve_pr->BudgetUsed,2,',','.')?></b></td>
								</tr>
							  </tbody>
							</table>
							
							<hr class="dotted">
                            
							<form class="validator-form form-horizontal" id="fm_apppr" enctype="multipart/form-data" method="POST">
                                <div class="validator-form form-horizontal" style="margin-top:2em">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Jenis Pengadaan </label>
                                        <div class="col-md-7">
											<select id="JenisPengadaan" name="JenisPengadaan" class="form-control">
												<option value="Langsung">Penunjukan Langsung</option>
												<option value="Tertutup">Leleng Tertutup</option>
												<option value="Terbuka">Leleng Terbuka</option>
											</select>
										</div>
                                    </div>
                                </div>
							    <a href="#" onclick="VendorList()" class="btn btn-success">Add Vendor</a>
                                    <div class="form-group" style="margin-top:1em">
                                        <div class="col-sm-12" align="center">
                                            <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridItemProcess">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>     
                                                        <th>Name</th>
                                                        <th>Wilayah</th>
                                                        <th>Status WP</th>
                                                        <th>Barang & Jasa</th>
                                                        <th>Harga Penawaran</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                                <tfoot>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
								<hr class="dotted">
                            
								<div class="validator-form form-horizontal" style="margin-top:2em">
                            	    <div class="form-group">
                                        <label class="control-label col-sm-3">Vendor Pemenang </label>
                                        <div class="col-md-7">
                                            <select id="VendorPemenang" name="VendorPemenang" class="form-control">
											</select>
										</div>
                                    </div>
                            	    <div class="form-group">
                                        <label class="control-label col-sm-3">Harga Setelah Penawaran </label>
                                        <div class="col-md-7">
                                            <input type="text" id="HargaVendor" name="HargaVendor" class="form-control">
										</div>
                                    </div>
                            	    <div class="form-group">
                                        <label class="control-label col-sm-3">PPN </label>
                                        <div class="col-md-2">
                                            <input type="number" id="ppn" name="ppn" class="form-control" value="10" width="50%">
										</div>
                                        <label class="col-sm-1" style="padding-top:7px; margin-left: 0px; align:left !important" align="left">% </label>
                                    </div>
                            	    <div class="form-group">
                                        <label class="control-label col-sm-3">Scoring Vendor </label>
                                        <div class="col-md-7">
                                            <input type="file" id="ScoringVendor" name="ScoringVendor" class="form-control" value="10%">
										</div>
                                    </div>
                            	    <div class="form-group">
                                        <label class="control-label col-sm-3">Dokumen Vendor </label>
                                        <div class="col-md-7">
                                            <input type="file" id="DokumenVendor" name="DokumenVendor" class="form-control" value="10%">
										</div>
                                    </div>
									<hr class="dotted">
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
                                        <div class="col-sm-12">
										</div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
											
										</div>
                                        <div class="col-sm-7">
                                            <div id="prosessloading"/>
											<input type="hidden" id="RequestID" name="RequestID" value="<?=$approve_pr->RequestID?>">
											<input type="hidden" id="flow_id" name="flow_id" value="<?=$approve_pr->flow_id?>">
											<input type="hidden" id="status" name="status" value="<?=$approve_pr->status?>">
											<!--
											<button type="submit" class="btn btn-primary" id="appreq" name="appreq" value="Submit" >Submit</button>       
                                        	-->
											<a class="btn btn-primary" onclick="submit_app()">Submit</a>       
                                        </div>
                                    </div>
                                </div>
							</form>
                        </div>

                    
					
                    <div tabindex="-1" id="mdl_Add" class="modal fade draggable-modal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" id="closetab" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Vendor</h4>
                                </div>
                                <div class="modal-body">
                                   <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footern" id="table_gridVendorList">
                                        <thead>
                                            <tr>
                                                <th>NO</th>     
                                                <th>Name</th>
                                                <th>Wilayah</th>
                                                <th>Status WP</th>
                                                <th>Barang & Jasa</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot></tfoot>
                                    </table>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn green-jungle" onclick="processItem()" data-dismiss="modal"><i class="fa fa-check"></i> Process</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

					
                </div>
            </div>

        </div>   
    </div>

</div>

<?php $this->load->view('app.min.inc.php'); ?>

<script>
	$(document).ready( function () {
		$('#item_table').DataTable({
			"aaSorting": [],
			"searching": false,
			"paging": false,
			"info": false
		});
	} );

	function go_to_list(){
		$(location).attr("href","<?php echo base_url("/procurement/purchase_request/list_pemilihan_vendor")?>");
	}

    function submit_app() { 
		var action = document.getElementById('action').value;
		var RequestID = document.getElementById('RequestID').value;
		var flow_id = document.getElementById('flow_id').value;
		var status = document.getElementById('status').value;
		var notes = document.getElementById('notes').value;
		var JenisPengadaan = document.getElementById('JenisPengadaan').value;
		var VendorPemenang = document.getElementById('VendorPemenang').value;
		var HargaVendor = document.getElementById('HargaVendor').value;
		var ppn = document.getElementById('ppn').value;
        $.post('<?= base_url("/procurement/purchase_request/app_requestproc_vendor");?>', {
			action:action,
			RequestID:RequestID,
			flow_id:flow_id,
			status:status,
			notes:notes,
			JenisPengadaan:JenisPengadaan,
			VendorPemenang:VendorPemenang,
			HargaVendor:HargaVendor,
			ppn:ppn
		},
		function(data){
			alert(data);
			go_to_list();
		})
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

	
</script>



